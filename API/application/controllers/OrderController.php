<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class OrderController extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the Order model
		$this->load->model('order_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	// function for get cart count
	public function getOrder_post()
	{
		$requiredparameters = array('language', 'user_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($user_id) {
				$order_detail = $this->order_model->get_order_list_details($user_id);

				if ($order_detail) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => array()

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function getOrder_seller_post()
	{
		$requiredparameters = array('language', 'user_id', 'pageno');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$pageno = removeSpecialCharacters($this->post('pageno'));



		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			if ($user_id) {
				$order_detail = $this->order_model->get_order_list_details_seller($user_id, $pageno);

				if ($order_detail) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						'pageno' => $pageno,
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						'pageno' => $pageno,
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory', $language_code),
					'pageno' => $pageno,
					$this->config->item('rest_data_field_name') => array()

				], self::HTTP_OK);
			}
		} else {
			echo $validation;
		}
	}

	public function updateOrder_post()
	{
		$requiredparameters = array('language', 'order_id', 'pid', 'user_id', 'order_status');

		$language_code = removeSpecialCharacters($this->post('language'));

		$order_id = removeSpecialCharacters($this->post('order_id'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$order_status = removeSpecialCharacters($this->post('order_status'));


		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());


			if ($order_id && $pid) {

				$cancel_detail = $this->order_model->seller_change_order_status_details($order_id, $pid, $order_status);
				if ($cancel_detail == 'done') {
					$order_detail = $this->order_model->get_order_full_details_seller($user_id, $order_id, $pid);

					if (count($order_detail['product_details']) > 0) {

						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => 'Order Status Update',
							$this->config->item('rest_data_field_name') => $order_detail

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
							$this->config->item('rest_data_field_name') => $order_detail

						], self::HTTP_OK);
					}
				} else if ($cancel_detail == 'not_exist') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('not_exist', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				} else if ($cancel_detail == 'already_cancelled') {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('already_cancelled', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				} else if ($cancel_detail == 'invalid') {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_request', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				}
			} else if (!$order_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$pid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation;
		}
	}

	public function getOrderDetails_post()
	{
		$requiredparameters = array('language', 'user_id', 'order_id', 'pid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$order_id = removeSpecialCharacters($this->post('order_id'));
		$pid = removeSpecialCharacters($this->post('pid'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());

			if ($user_id && $order_id && $pid) {
				$order_detail = $this->order_model->get_order_full_details($user_id, $order_id, $pid);
				//print_r($order_detail['product_details']);
				if (count($order_detail['product_details']) > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else if (!$user_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$order_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$pid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	// kamal api 

	// function for get cart count
	public function getOrderProd_post()
	{
		$requiredparameters = array('language', 'user_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($user_id) {
				$order_detail = $this->order_model->get_order_list_detailsProd($language_code, $user_id);

				if ($order_detail) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => array()

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	// function for get cart count
	public function getOrderDetailsProd_post()
	{
		$requiredparameters = array('language', 'user_id', 'order_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$order_id = removeSpecialCharacters($this->post('order_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());

			if ($user_id && $order_id) {
				$order_detail = $this->order_model->get_order_full_detailsProd($language_code, $user_id, $order_id);

				if (count($order_detail['product_details']) > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else if (!$user_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$order_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	// kamal api close

	// function for get cart count
	public function trackOrder_post()
	{
		$requiredparameters = array('language', 'order_id');

		$language_code = removeSpecialCharacters($this->post('language'));

		$order_id = removeSpecialCharacters($this->post('order_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());


			if ($order_id) {
				$order_detail = $this->order_model->get_order_track_details($language_code, $order_id);
				//print_r('ssss'.$order_detail);
				if (count($order_detail['product_details']) > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function order_full_details_post()
	{
		$requiredparameters = array('language', 'order_id', 'pid', 'user_id');

		$language_code = removeSpecialCharacters($this->post('language'));

		$order_id = removeSpecialCharacters($this->post('order_id'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));


		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'fulladdress' => '', 'country' => '', 'region' => '', 'governorate' => '', 'area' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());


			if ($order_id && $pid) {

				$order_detail = $this->order_model->get_order_full_details_seller($user_id, $order_id, $pid);

				if (count($order_detail['product_details']) > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => 'Order Full Details',
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else if (!$order_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$pid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation;
		}
	}

	// function for get cart count
	public function cancelOrder_post()
	{
		$requiredparameters = array('language', 'order_id', 'pid', 'user_id');

		$language_code = removeSpecialCharacters($this->post('language'));

		$order_id = removeSpecialCharacters($this->post('order_id'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));


		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());


			if ($order_id && $pid) {

				$cancel_detail = $this->order_model->change_order_status_details($order_id, $pid, 'Cancelled');
				if ($cancel_detail == 'done') {
					$order_detail = $this->order_model->get_order_full_details($user_id, $order_id, $pid); //get_order_track_details($order_id);

					if (count($order_detail['product_details']) > 0) {

						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('order_cancelled', $language_code),
							$this->config->item('rest_data_field_name') => $order_detail

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
							$this->config->item('rest_data_field_name') => $order_detail

						], self::HTTP_OK);
					}
				} else if ($cancel_detail == 'not_exist') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('not_exist', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				} else if ($cancel_detail == 'already_cancelled') {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('already_cancelled', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				} else if ($cancel_detail == 'invalid') {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_request', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				}
			} else if (!$order_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$pid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	// function for get cart count
	public function returnOrder_post()
	{
		$requiredparameters = array('language', 'order_id', 'pid');

		$language_code = removeSpecialCharacters($this->post('language'));

		$order_id = removeSpecialCharacters($this->post('order_id'));
		$pid = removeSpecialCharacters($this->post('pid'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());


			if ($order_id && $pid) {

				$cancel_detail = $this->order_model->change_order_status_details_returned($order_id, $pid, 'Returned');
				if ($cancel_detail == 'done') {
					$order_detail = $this->order_model->get_order_track_details($language_code, $order_id);

					if (count($order_detail['product_details']) > 0) {

						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('order_returned', $language_code),
							$this->config->item('rest_data_field_name') => $order_detail

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
							$this->config->item('rest_data_field_name') => $order_detail

						], self::HTTP_OK);
					}
				} else if ($cancel_detail == 'not_exist') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('not_exist', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				} else if ($cancel_detail == 'already_returned') {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('already_returned', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				} else if ($cancel_detail == 'invalid') {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_request', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				}
			} else if (!$order_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$pid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
