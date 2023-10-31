<?php

use Google\Service\ShoppingContent\Amount;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wallet_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}


	function get_wallet_data($user_id)
	{

		$this->db->select('amount,wallet_id');
		$this->db->where(array('user_id' => $user_id));
		$query = $this->db->get('wallet_summery');

		$wallet_result = array();
		if ($query->result_object()) {
			$user_result = $query->result_object()[0];
			$wallet_result['amount'] = $user_result->amount;
			$wallet_result['wallet_id'] = $user_result->wallet_id;
		}
		return $wallet_result;
	}

	function get_wallet_summery($wallet_id)
	{

		$this->db->select("*");
		$this->db->where(array('wallet_id' => $wallet_id));
		$this->db->order_by('created_at', 'DESC')->limit(8, 0);


		$query = $this->db->get('wallet_transaction_history');

		$cart_result = array();
		if ($query->num_rows() > 0) {
			$cart_result = $query->result_object();
		}
		return $cart_result;
	}

	/* function get_wallet_summery_full($wallet_id)
	{

		$this->db->select("*");
		$this->db->order_by('created_at', 'DESC');
		$this->db->where(array('wallet_id' => $wallet_id));


		$query = $this->db->get('wallet_transaction_history');
		$transactionsByMonth = [];
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$transactionDate = date('F Y', strtotime($row['created_at']));

				if (!isset($transactionsByMonth[$transactionDate])) {
					$transactionsByMonth[$transactionDate] = [];
				}

				$transactionsByMonth[$transactionDate][] = $row;
			}
		}

		return $transactionsByMonth;
	} */

	function get_wallet_summery_full($wallet_id) {
		$this->db->select("*");
		$this->db->order_by('created_at', 'DESC');
		$this->db->where(array('wallet_id' => $wallet_id));
	
		$query = $this->db->get('wallet_transaction_history');
		$transactionsByMonth = [];
	
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				// Replace null values with empty string
				$transaction = array_map(function($value) {
					return is_null($value) ? '' : $value;
				}, $row);
	
				$transactionDate = date('F Y', strtotime($transaction['created_at']));
	
				if (!isset($transactionsByMonth[$transactionDate])) {
					$transactionsByMonth[$transactionDate] = [
						'month' => $transactionDate,
						'transactions' => []
					];
				}
	
				$transactionsByMonth[$transactionDate]['transactions'][] = $transaction;
			}
		}
	
		return array_values($transactionsByMonth);
	}
	
	

	function search_wallet_data($title, $start_date, $end_date, $wallet_id)
	{

		$title_like = '';

		$this->db->where(array('wallet_id' => $wallet_id));
		$this->db->select("*");
		if ($start_date != '' && $end_date != '') {

			$this->db->where('DATE(created_at) >=', date('Y-m-d', strtotime($start_date)));
			$this->db->where('DATE(created_at) <=', date('Y-m-d', strtotime($end_date)));
		}
		$this->db->like('remark', $title);



		$query = $this->db->get('wallet_transaction_history');
		$cart_result = array();
		if ($query->num_rows() > 0) {
			$cart_result = $query->result_object();
		}
		return $cart_result;
	}

	function withdrow_money_request($user_id, $amount)
	{
		$data['user_id'] = $user_id;
		$data['amount'] = $amount;
		$data['created_at'] = $this->date_time;


		$this->db->insert('wallet_withdrow', $data);
	}

	function addMoney($user_id, $amount)
	{
		$this->db->trans_start(); // Start the transaction

		try {
			$wallet_data = $this->get_wallet_data($user_id);
			if (empty($wallet_data))
				return false;
			$wallet_id = $wallet_data['wallet_id'];
			$current_wallet_balance = $wallet_data['amount'];
			$transaction_id = generateTransactionID();
			// Insert into wallet_transaction_history
			$this->db->insert('wallet_transaction_history', [
				'wallet_id' => $wallet_id,
				'payment_type' => 1,
				'transaction_id' => $transaction_id,
				'transaction_type' => 'cr',
				'amount' => $amount,
				'balance' => $current_wallet_balance + $amount,
				'remark' => 'Money Added to wallet'
			]);

			// Update wallet_summery
			$this->db->where('wallet_id', $wallet_id)->update('wallet_summery', [
				'amount' => $current_wallet_balance + $amount
			]);

			$this->db->trans_complete(); // Complete the transaction

			if ($this->db->trans_status() === FALSE) {
				return false; // Transaction failed
			}

			return true; // Transaction successful
		} catch (Exception $e) {
			$this->db->trans_rollback(); // Rollback the transaction in case of an exception
			return false;
		}
	}
}
