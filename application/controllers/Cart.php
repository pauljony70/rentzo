<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Cart extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the cart model
		$this->load->model('cart_model');
		$this->load->model('delivery_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function addProductCart_post()
	{

		$requiredparameters = array('language', 'pid', 'sku', 'sid', 'user_id', 'qty', 'referid', 'devicetype', 'qouteid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$sku = removeSpecialCharacters($this->post('sku'));
		$sid = removeSpecialCharacters($this->post('sid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$qty = removeSpecialCharacters($this->post('qty'));
		$referid = removeSpecialCharacters($this->post('referid'));
		$affiliated_by = removeSpecialCharacters($this->post('affiliated_by')) == $this->session->userdata('user_id') ? null : removeSpecialCharacters($this->post('affiliated_by'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$qouteid = removeSpecialCharacters($this->post('qouteid'));

		if (empty($this->session->userdata('qoute_id'))) {
			$newdata = array(
				'qoute_id'  => date("dm") . date("hi") . rand(1, 99),
				'logged_in' => TRUE
			);

			$set_data = $this->session->set_userdata($newdata);
			$qouteid = $this->session->userdata('qoute_id');
		}

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {

			if ($pid && $sku && $sid && $qty) {
				$conf = $this->cart_model->check_product_conf($pid, $sku, $sid, $user_id, $qty, $referid, $qouteid);
				$validate_product_cart = $this->cart_model->validate_product_cart($pid, $sku, $sid);
				if ($validate_product_cart['stock_status'] == 'Out of Stock') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('product_out_of_stock', $language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0,
						'qouteid' => $qouteid

					], self::HTTP_OK);
				} else if ($qty > $validate_product_cart['product_stock']) {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('product_stock_limit', $language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0,
						'qouteid' => $qouteid
					], self::HTTP_OK);
				} else if ($qty > $validate_product_cart['product_purchase_limit'] && $validate_product_cart['product_purchase_limit'] > 0) {
					$cart_detail = $this->cart_model->get_cart_full_details($language_code, $user_id, $devicetype, $qouteid, '');
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => "You can purchase only " . $validate_product_cart['product_purchase_limit'] . " qty of this item",
						$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
						'total_mrp' => $cart_detail['total_mrp'],
						'total_discount' => $cart_detail['total_discount'],
						'total_price' => $cart_detail['total_price'],
						'total_item' => $cart_detail['total_item'],
						'qouteid' => $qouteid
					], self::HTTP_OK);
				} else if ($conf == 'yes') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('product_attribute_mandotary', $language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0,
						'qouteid' => $qouteid
					], self::HTTP_OK);
				} else {
					$cart = $this->cart_model->add_product_cart($pid, $sku, $sid, $user_id, $qty, $referid, $affiliated_by, $qouteid);
					if (count($cart) > 0) {
						if ($qouteid == '') {
							$qoute_id = $cart['quote_id'];
						} else {
							$qoute_id = $qouteid;
						}
						if ($cart['status'] == 'add') {
							if (empty($this->session->userdata('qoute_id'))) {
								$newdata = array(
									'qoute_id'  => $qoute_id,
									'logged_in' => TRUE
								);
								$set_data = $this->session->set_userdata($newdata);
							}
							$cart_detail = $this->cart_model->get_cart_full_details($language_code, $user_id, $devicetype, $qoute_id, '');
							$this->response([
								$this->config->item('rest_status_field_name') => 1,
								$this->config->item('rest_message_field_name') => get_phrase('cart_added', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
								'total_mrp' => $cart_detail['total_mrp'],
								'total_discount' => $cart_detail['total_discount'],
								'total_price' => $cart_detail['total_price'],
								'total_item' => $cart_detail['total_item'],
								'qouteid' => $qoute_id

							], self::HTTP_OK);
						} else if ($cart['status'] == 'update') {
							$cart_detail = $this->cart_model->get_cart_full_details($language_code, $user_id, $devicetype, $qoute_id, '');

							$this->response([
								$this->config->item('rest_status_field_name') => 1,
								$this->config->item('rest_message_field_name') => get_phrase('cart_updated', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
								'total_mrp' => $cart_detail['total_mrp'],
								'total_discount' => $cart_detail['total_discount'],
								'total_price' => $cart_detail['total_price'],
								'total_item' => $cart_detail['total_item'],
								'qouteid' => $qoute_id
							], self::HTTP_OK);
						}
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('please_try_again', $language_code),
							$this->config->item('rest_data_field_name') => array(),
							'total_mrp' => 0,
							'total_discount' => 0,
							'total_price' => 0,
							'total_item' => 0,
							'qouteid' => $qouteid

						], self::HTTP_OK);
					}
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('cart_invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => array(),
					'total_mrp' => 0,
					'total_discount' => 0,
					'total_price' => 0,
					'total_item' => 0,
					'qouteid' => $qouteid

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	public function buynowProductCart_post()
	{

		$requiredparameters = array('language', 'pid', 'sku', 'sid', 'user_id', 'qty', 'referid', 'devicetype', 'qouteid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$sku = removeSpecialCharacters($this->post('sku'));
		$sid = removeSpecialCharacters($this->post('sid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$qty = removeSpecialCharacters($this->post('qty'));
		$referid = removeSpecialCharacters($this->post('referid'));
		$affiliated_by = removeSpecialCharacters($this->post('affiliated_by')) == $this->session->userdata('user_id') ? null : removeSpecialCharacters($this->post('affiliated_by'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$qouteid = removeSpecialCharacters($this->post('qouteid'));

		if (empty($this->session->userdata('qoute_id'))) {
			$newdata = array(
				'qoute_id'  => date("dm") . date("hi") . rand(1, 99),
				'logged_in' => TRUE
			);

			$set_data = $this->session->set_userdata($newdata);
			$qouteid = $this->session->userdata('qoute_id');
		}


		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			$cart = $this->cart_model->delete_product_buynow_cart($user_id, $qouteid);
			if ($pid && $sku && $sid && $qty) {
				$conf = $this->cart_model->check_product_conf($pid, $sku, $sid, $user_id, $qty, $referid, $qouteid);
				$validate_product_cart = $this->cart_model->validate_product_cart($pid, $sku, $sid);

				if ($validate_product_cart['stock_status'] == 'Out of Stock') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('product_out_of_stock', $language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0,
						'qouteid' => $qouteid

					], self::HTTP_OK);
				} else if ($qty > $validate_product_cart['product_stock']) {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('product_stock_limit', $language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0,
						'qouteid' => $qouteid

					], self::HTTP_OK);
				} else if ($qty > $validate_product_cart['product_purchase_limit'] && $validate_product_cart['product_purchase_limit'] > 0) {

					$cart_detail = $this->cart_model->get_cart_full_details($language_code, $user_id, $devicetype, $qouteid, '');
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => "You can purchase only " . $validate_product_cart['product_purchase_limit'] . " qty of this item",
						$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
						'total_mrp' => $cart_detail['total_mrp'],
						'total_discount' => $cart_detail['total_discount'],
						'total_price' => $cart_detail['total_price'],
						'total_item' => $cart_detail['total_item'],
						'qouteid' => $qouteid

					], self::HTTP_OK);
				} else if ($conf == 'yes') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('product_attribute_mandotary', $language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0,
						'qouteid' => $qouteid

					], self::HTTP_OK);
				} else {

					$cart = $this->cart_model->add_product_cart($pid, $sku, $sid, $user_id, $qty, $referid, $affiliated_by, $qouteid);

					if (count($cart) > 0) {

						if ($qouteid == '') {
							$qoute_id = $cart['quote_id'];
						} else {
							$qoute_id = $qouteid;
						}

						if ($cart['status'] == 'add') {
							if (empty($this->session->userdata('qoute_id'))) {
								$newdata = array(
									'qoute_id'  => $qoute_id,
									'logged_in' => TRUE
								);

								$set_data = $this->session->set_userdata($newdata);
							}


							$cart_detail = $this->cart_model->get_cart_full_details($language_code, $user_id, $devicetype, $qoute_id, '');



							$this->response([
								$this->config->item('rest_status_field_name') => 1,
								$this->config->item('rest_message_field_name') => get_phrase('cart_added', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
								'total_mrp' => $cart_detail['total_mrp'],
								'total_discount' => $cart_detail['total_discount'],
								'total_price' => $cart_detail['total_price'],
								'total_item' => $cart_detail['total_item'],
								'qouteid' => $qoute_id

							], self::HTTP_OK);
						} else if ($cart['status'] == 'update') {
							$cart_detail = $this->cart_model->get_cart_full_details($language_code, $user_id, $devicetype, $qoute_id, '');

							$this->response([
								$this->config->item('rest_status_field_name') => 1,
								$this->config->item('rest_message_field_name') => get_phrase('cart_updated', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
								'total_mrp' => $cart_detail['total_mrp'],
								'total_discount' => $cart_detail['total_discount'],
								'total_price' => $cart_detail['total_price'],
								'total_item' => $cart_detail['total_item'],
								'qouteid' => $qoute_id
							], self::HTTP_OK);
						}
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('please_try_again', $language_code),
							$this->config->item('rest_data_field_name') => array(),
							'total_mrp' => 0,
							'total_discount' => 0,
							'total_price' => 0,
							'total_item' => 0,
							'qouteid' => $qouteid

						], self::HTTP_OK);
					}
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('cart_invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => array(),
					'total_mrp' => 0,
					'total_discount' => 0,
					'total_price' => 0,
					'total_item' => 0,
					'qouteid' => $qouteid

				], self::HTTP_OK);
			}
		} else {
			echo $validation;
		}
	}

	// function for delete cart product
	public function deleteProductCart_post()
	{
		$requiredparameters = array('language', 'pid', 'user_id', 'devicetype', 'qouteid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$qouteid = removeSpecialCharacters($this->post('qouteid'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if (($user_id || $qouteid) && $pid) {
				$cart = $this->cart_model->delete_product_cart($pid, $user_id, $qouteid);
				if ($cart == 'delete') {
					$cart_detail = $this->cart_model->get_cart_full_details($language_code, $user_id, $devicetype, $qouteid, '');
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('cart_deleted', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
						'total_mrp' => $cart_detail['total_mrp'],
						'total_discount' => $cart_detail['total_discount'],
						'total_price' => $cart_detail['total_price'],
						'total_item' => $cart_detail['total_item'],
						'qouteid' => $cart_detail['qoute_id']
					], self::HTTP_OK);
				} else {
					$this->responses(1, get_phrase('please_try_again', $language_code));
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('cart_invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => array(),
					'total_mrp' => 0,
					'total_discount' => 0,
					'total_price' => 0,
					'total_item' => 0,
					'qouteid' => $qouteid

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function deleteProductCart_buynow_post()
	{
		$requiredparameters = array('language', 'user_id', 'devicetype', 'qouteid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$qouteid = removeSpecialCharacters($this->post('qouteid'));



		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			if (($user_id || $qouteid)) {
				$cart = $this->cart_model->delete_product_buynow_cart($user_id, $qouteid);
				/*echo $cart;
				return $cart;*/
			}
		} else {
			echo $validation;
		}
	}


	// function for get cart product
	public function getProductCart_post()
	{
		$requiredparameters = array('language', 'user_id', 'devicetype', 'qouteid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$qouteid = removeSpecialCharacters($this->post('qouteid'));
		$shipping_city = removeSpecialCharacters($this->post('shipping_city'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($user_id || $qouteid) {
				$cart_detail = $this->cart_model->get_cart_full_details($language_code, $user_id, $devicetype, $qouteid, $shipping_city);

				if (count($cart_detail['cart_full']) > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('cart_details', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
						'total_mrp' => $cart_detail['total_mrp'],
						'total_discount' => $cart_detail['total_discount'],
						'total_price' => $cart_detail['total_price'],
						'total_item' => $cart_detail['total_item'],
						'total_shipping_fee' => $cart_detail['total_shipping_fee'],
						'payable_amount' => $cart_detail['payable_amount'],
						'qouteid' => $qouteid

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('cart_empty', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
						'total_mrp' => $cart_detail['total_mrp'],
						'total_discount' => $cart_detail['total_discount'],
						'total_price' => $cart_detail['total_price'],
						'total_item' => $cart_detail['total_item'],
						'total_shipping_fee' => $cart_detail['total_shipping_fee'],
						'payable_amount' => $cart_detail['payable_amount'],
						'qouteid' => $qouteid

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('cart_invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => array(),
					'total_mrp' => 0,
					'total_discount' => 0,
					'total_price' => 0,
					'total_item' => 0,
					'total_shipping_fee' => 0,
					'payable_amount' => 0,
					'qouteid' => $qouteid

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	// function for get cart count
	public function getCartCount_post()
	{
		$requiredparameters = array('language', 'user_id', 'qouteid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$qouteid = removeSpecialCharacters($this->post('qouteid'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($user_id || $qouteid) {
				$cart_detail = $this->cart_model->get_cart_details($user_id, $qouteid);

				if ($cart_detail > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('cart_details', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail['qty'],
						'qouteid' => $qouteid

					], self::HTTP_OK);
				} else {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('cart_empty', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail,
						'qouteid' => $qouteid

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('cart_empty', $language_code),
					$this->config->item('rest_data_field_name') => '',
					'qouteid' => $qouteid

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
