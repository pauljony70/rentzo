<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class WalletController extends REST_Controller
{
    protected $request_method = 'post';

    public function __construct()
    {
        parent::__construct();

        // Load Model
        $this->load->model('wallet_model');
    }

    public function index_get()
    {
        $this->responses(1, 'Server OK');
    }

    public function getIndexPage_get()
    {
        if ($this->session->userdata("user_id")) {
            $this->data['wallet'] = $this->wallet_model->get_wallet_data();
            $this->data['wallet_summery'] = $this->wallet_model->get_wallet_summery($this->data['wallet']['wallet_id']);
            $this->load->view('website/user-wallet.php', $this->data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function getuserWalletTransaction_get()
    {
        if ($this->session->userdata("user_id")) {
            $this->data['wallet'] = $this->wallet_model->get_wallet_data();
            $this->data['wallet_summery'] = $this->wallet_model->get_wallet_summery_full($this->data['wallet']['wallet_id']);
            $this->load->view('website/user-wallet-transaction.php', $this->data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function addMoney_post()
    {
        $requiredparameters = array('language', 'amount');
        $language_code = removeSpecialCharacters($this->post('language'));
        $amount = removeSpecialCharacters($this->post('amount'));
        $validation = $this->parameterValidation($requiredparameters, $this->post());

        if ($validation == 'valid') {
            // echo $amount; exit;
            $add_money = $this->wallet_model->addMoney($amount);
            if ($add_money) {
                $this->response([
                    $this->config->item('rest_status_field_name') => 1,
                    $this->config->item('rest_message_field_name') => get_phrase('add_money_succesfully', $language_code),
                    $this->config->item('rest_data_field_name') => $amount
                ], self::HTTP_OK);
            } else {
                $this->response([
                    $this->config->item('rest_status_field_name') => 0,
                    $this->config->item('rest_message_field_name') => get_phrase('add_money_failed', $language_code),
                    $this->config->item('rest_data_field_name') => ''
                ], self::HTTP_OK);
            }
        } else {
            echo $validation;
        }
    }

    public function withdrawMoney_get()
    {
        if ($this->session->userdata("user_id")) {
            $this->data['wallet'] = $this->wallet_model->get_wallet_data();
            $this->data['wallet_summery'] = $this->wallet_model->get_wallet_summery($this->data['wallet']['wallet_id']);
            $this->load->view('website/withdraw-money.php', $this->data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function sendWithdrawMoneyRequest_post()
    {
        $requiredparameters = array('language', 'amount');
        $language_code = removeSpecialCharacters($this->post('language'));
        $amount = removeSpecialCharacters($this->post('amount'));
        $validation = $this->parameterValidation($requiredparameters, $this->post());

        if ($validation == 'valid') {
            if ($amount >= 1 && $amount <= 25) {
                $wallet_data = $this->wallet_model->get_wallet_data();
                if ($amount <= $wallet_data['amount']) {
                    $withdraw_money = $this->wallet_model->sendWithdrawMoneyRequest($wallet_data, $amount);
                    if ($withdraw_money) {
                        $this->response([
                            $this->config->item('rest_status_field_name') => 1,
                            $this->config->item('rest_message_field_name') => get_phrase('send_withdraw_request_succesfully', $language_code),
                            $this->config->item('rest_data_field_name') => $amount
                        ], self::HTTP_OK);
                    } else {
                        $this->response([
                            $this->config->item('rest_status_field_name') => 0,
                            $this->config->item('rest_message_field_name') => get_phrase('withdraw_request_failed', $language_code),
                            $this->config->item('rest_data_field_name') => ''
                        ], self::HTTP_OK);
                    }
                } else {
                    $this->response([
                        $this->config->item('rest_status_field_name') => 0,
                        $this->config->item('rest_message_field_name') => get_phrase('insufficient_balance', $language_code),
                        $this->config->item('rest_data_field_name') => ''
                    ], self::HTTP_OK);
                }
            } else {
                $this->response([
                    $this->config->item('rest_status_field_name') => 0,
                    $this->config->item('rest_message_field_name') => get_phrase('please_enter_an_amount_between ' . price_format('1') . ' and ' . price_format(25), $language_code),
                    $this->config->item('rest_data_field_name') => ''
                ], self::HTTP_OK);
            }
        } else {
            echo $validation;
        }
    }

    public function searchWalletTransaction_post()
    {
        $requiredparameters = array('language', 'transaction_id', 'payment_type', 'start_date', 'end_date');
        $language_code = removeSpecialCharacters($this->post('language'));
        $transaction_id = removeSpecialCharacters($this->post('transaction_id'));
        $payment_type = removeSpecialCharacters($this->post('payment_type'));
        $start_date = removeSpecialCharacters($this->post('start_date'));
        $end_date = removeSpecialCharacters($this->post('end_date'));

        $validation = $this->parameterValidation($requiredparameters, $this->post());

        if ($validation == 'valid') {
            $response = $this->wallet_model->searchWalletTransaction($transaction_id, $payment_type, $start_date, $end_date);
            if ($response) {
                $this->response([
                    $this->config->item('rest_status_field_name') => 1,
                    $this->config->item('rest_message_field_name') => get_phrase('get_transactions_successfully', $language_code),
                    $this->config->item('rest_data_field_name') => $response
                ], self::HTTP_OK);
            } else {
                $this->response([
                    $this->config->item('rest_status_field_name') => 0,
                    $this->config->item('rest_message_field_name') => get_phrase('no_trasactions_found', $language_code),
                    $this->config->item('rest_data_field_name') => ''
                ], self::HTTP_OK);
            }
        } else {
            echo $validation;
        }
    }
}
