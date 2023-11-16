<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Checkout extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Load the Checkout model
		$this->load->model('checkout_model');
		$this->load->model('address_model');
		$this->load->model('delivery_model');
		$this->load->model('home_model');
	}
	public function send_email_get()
	{
		echo "hi";
		send_email_smtp('chiragsavaliya67@gmail.com', "hello", "fleek subject");
	}
	public function index_get()
	{
		$qoute_id = $this->session->userdata("qoute_id");
		$user_id = $this->session->userdata("user_id");
		if ($qoute_id != '' || $user_id != '') {
			$this->data['checkout'] = $this->checkout_model->get_checkout_full_details($user_id, '');
		} else {
			$this->data['checkout'] = array();
		}
		$this->data['address'] = $this->address_model->get_user_address_details_full($user_id);
		$this->data['get_country'] = $this->delivery_model->get_country();
		$this->load->view('website/checkout.php', $this->data);  // ye view/website folder hai

	}

	public function thankyou_get($order_id)
	{
		/*if ($this->session->tempdata('place_order_status') === 1) {
			$default_language = $this->session->userdata("default_language");
			$this->data['order_id'] = $order_id;
			$this->data['recommended_product'] = $this->home_model->get_home_products($default_language, 'Recommended', '');
			$this->load->view('website/thankyou.php', $this->data);  // ye view/website folder hai
		} else {
			redirect($this->agent->referrer());
		}*/
		$this->data['order_id'] = $order_id;
		$this->load->view('website/thankyou.php', $this->data);
	}


	public function get_city_post()
	{	
		$stateid = $this->post('stateid');
		$city_detail = $this->delivery_model->get_city($stateid);
		echo json_encode($city_detail);
	
	}

	public function get_region_post()
	{
		$country_id = $this->post('country_id');
		$city_detail = $this->delivery_model->get_region($country_id);
		echo json_encode($city_detail);
	}

	public function get_governorates_post()
	{
		$region_id = $this->post('region_id');
		$governorate_detail = $this->delivery_model->get_governorates($region_id);
		echo json_encode($governorate_detail);
	}

	public function get_areas_post()
	{
		$governorate_id = $this->post('governorate_id');
		$governorate_detail = $this->delivery_model->get_areas($governorate_id);
		echo json_encode($governorate_detail);
	}

	public function get_state_post()
	{
		$language = $this->post('language');
		$state_detail = $this->delivery_model->get_state();
		echo json_encode($state_detail);
	}

	public function addorder_get()
	{
		$user_id = $this->input->get('user_id');
		$qouteid = $this->input->get('qouteid');
		$fullname = $this->input->get('fullname');
		$mobile = $this->input->get('mobile');
		$locality = $this->input->get('locality');
		$fulladdress = $this->input->get('fulladdress');
		$city = $this->input->get('city');
		$state = $this->input->get('state');
		$pincode = ''; // $this->input->get('pincode');
		$addresstype = $this->input->get('addresstype');
		$email = $this->input->get('email');
		$payment_id = $this->input->get('payment_id');
		$payment_mode = $this->input->get('payment_mode');
		$response = $this->checkout_model->place_order_details($user_id, $qouteid, $fullname, $mobile, $locality, $fulladdress, $city, $state, $pincode, $addresstype, $email, $payment_id, $payment_mode);

		echo json_encode($response);
	}


	// function for get cart count
	public function checkout_post()
	{
		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->session->userdata('user_id'));
		$coupon_code = removeSpecialCharacters($this->post('coupon_code'));

		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			if ($user_id) {
				$cart_detail = $this->checkout_model->get_checkout_full_details($user_id, $coupon_code);
				if ($cart_detail == 'invalid') {
					$this->response([
						$this->config->item('rest_status_field_name') => 2,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_coupon', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail,

					], self::HTTP_OK);
				}
				if ($cart_detail > 0) {
					$validate_coupon = '';
					$coupon_discount = '';
					/*if(trim($coupon_code)){*/
					if (($cart_detail['coupon_discount1'])) {
						$validate_coupon = $this->checkout_model->Validate_coupon_code($user_id, $coupon_code, '');

						if ($validate_coupon == 'invalid') {
							$this->response([
								$this->config->item('rest_status_field_name') => 2,
								$this->config->item('rest_message_field_name') => get_phrase('invalid_coupon', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail,

							], self::HTTP_OK);
						} else if ($validate_coupon == 'login_required') {
							$this->response([
								$this->config->item('rest_status_field_name') => 2,
								$this->config->item('rest_message_field_name') => get_phrase('login_requireed', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail,

							], self::HTTP_OK);
						} else if ($validate_coupon == 'applied_exced') {
							$this->response([
								$this->config->item('rest_status_field_name') => 2,
								$this->config->item('rest_message_field_name') => get_phrase('applied_exced', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail,

							], self::HTTP_OK);
						} else if ($validate_coupon == 'expired') {
							$this->response([
								$this->config->item('rest_status_field_name') => 2,
								$this->config->item('rest_message_field_name') => get_phrase('coupon_expired', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail,

							], self::HTTP_OK);
						} else	if ($validate_coupon->min_order > 0 && $cart_detail['total_price_value'] < $validate_coupon->min_order) {
							$validate_coupon = 'less_amount';
						} else {
							$coupon_type = $validate_coupon->coupon_type;
							$value = $validate_coupon->value;

							if ($coupon_type == 1) {
								$coupon_discount =  ($cart_detail['total_price_value'] / 100) * $value;
							} else if ($coupon_type == 2) {
								$coupon_discount =  $cart_detail['total_price_value'] - $value;
							}
							$payable_amount = ($cart_detail['total_price_value'] - $value);

							$cart_detail['coupon_discount_text'] = price_format($value);
							$cart_detail['coupon_discount'] = $value;
							$cart_detail['payable_amount'] = price_format($payable_amount);
							$cart_detail['payable_amount_value'] = $payable_amount;
							$cart_detail['total_price_value'] = $payable_amount;
						}
						$cart_detail['coupon_code'] = $coupon_code;
					} else {
						if ($coupon_discount > 0) {
							$msgs = get_phrase('coupon_applied_successfully', $language_code);
						} else {
							$msgs = get_phrase('checkout_details', $language_code);
						}
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => $msgs,
							$this->config->item('rest_data_field_name') => $cart_detail,
							'qouteid' => $qouteid
						], self::HTTP_OK);
					}


					if ($validate_coupon == 'invalid') {
						$this->response([
							$this->config->item('rest_status_field_name') => 2,
							$this->config->item('rest_message_field_name') => get_phrase('invalid_coupon', $language_code),
							$this->config->item('rest_data_field_name') => $cart_detail,
							'qouteid' => $qouteid

						], self::HTTP_OK);
					} else if ($validate_coupon == 'less_amount') {
						$this->response([
							$this->config->item('rest_status_field_name') => 2,
							$this->config->item('rest_message_field_name') => get_phrase('amount_less_coupon_limit', $language_code),
							$this->config->item('rest_data_field_name') => $cart_detail,
							'qouteid' => $qouteid

						], self::HTTP_OK);
					} else {
						if ($coupon_discount > 0) {
							$msgs = get_phrase('coupon_applied_successfully', $language_code);
						} else {
							$msgs = get_phrase('checkout_details', $language_code);
						}
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => $msgs,
							$this->config->item('rest_data_field_name') => $cart_detail,
							'qouteid' => $qouteid

						], self::HTTP_OK);
					}
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('cart_empty', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail,
						'qouteid' => $qouteid

					], self::HTTP_OK);
				}
			} else {
				$user_address = array("address_id" => '', "fullname" => '', "mobile" => '', "locality" => '', "fulladdress" => '', "city" => '', "state" => '', "pincode" => '', "email" => '', "addresstype" => '');

				$res = array(
					'user_address' => $user_address, 'total_mrp' => 0, 'total_discount' => 0, 'total_price' => 0,
					'total_item' => 0, 'tax_payable' => 0, 'coupon_code' => $coupon_code, 'coupon_discount' => 0, 'shipping_fee' => 0, 'payable_amount' => 0, 'payable_amount_value' => 0, 'total_price_value' => 0
				);
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('checkout_details', $language_code),
					$this->config->item('rest_data_field_name') => $res,
					'qouteid' => $qouteid

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	// function for get cart count
	public function validateCoupon_post()
	{
		$requiredparameters = array('language', 'coupon_code', 'price');

		$language_code = removeSpecialCharacters($this->post('language'));
		$total_price_value = removeSpecialCharacters($this->post('price'));
		$coupon_code = removeSpecialCharacters($this->post('coupon_code'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$cart_detail = array('coupon_code' => $coupon_code, 'coupon_discount' => 0, 'payable_amount' => 0);
			if ($total_price_value && $coupon_code) {

				$validate_coupon = '';
				$validate_coupon = $this->checkout_model->Validate_coupon_code('', $coupon_code, 'product');
				//print_r($validate_coupon);
				if ($validate_coupon == 'invalid') {
					$this->response([
						$this->config->item('rest_status_field_name') => 2,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_coupon', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail

					], self::HTTP_OK);
				} else if ($validate_coupon == 'applied_exced') {
					$this->response([
						$this->config->item('rest_status_field_name') => 2,
						$this->config->item('rest_message_field_name') => get_phrase('applied_exced', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail

					], self::HTTP_OK);
				} else if ($validate_coupon == 'expired') {
					$this->response([
						$this->config->item('rest_status_field_name') => 2,
						$this->config->item('rest_message_field_name') => get_phrase('coupon_expired', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail

					], self::HTTP_OK);
				} else if ($validate_coupon->min_order > 0 && $total_price_value < $validate_coupon->min_order) {
					$this->response([
						$this->config->item('rest_status_field_name') => 2,
						$this->config->item('rest_message_field_name') => get_phrase('amount_less_coupon_limit', $language_code),
						$this->config->item('rest_data_field_name') => $cart_detail

					], self::HTTP_OK);
				} else {
					$coupon_type = $validate_coupon->coupon_type;
					$value = $validate_coupon->value;
					$coupon_discount = 0;
					if ($coupon_type == 1) {
						$coupon_discount =  ($total_price_value / 100) * $value;
					} else if ($coupon_type == 2) {
						$coupon_discount =  $total_price_value - $value;
					}
					$payable_amount = ($total_price_value - $coupon_discount);

					$cart_detail['coupon_discount'] = price_format($coupon_discount);
					$cart_detail['payable_amount'] = price_format($payable_amount);
					//$cart_detail['payable_amount_value'] = $payable_amount;
					//$cart_detail['total_price_value'] = $payable_amount;
					$cart_detail['coupon_code'] = $coupon_code;

					if ($coupon_discount > 0) {
						if (empty($this->session->userdata('coupon_code'))) {
							$newdata = array(
								'coupon_code'  => $coupon_code,
								'coupon_discount'  => price_format($coupon_discount),
								'payable_amount'  => price_format($payable_amount),
								'logged_in' => TRUE
							);

							$set_data = $this->session->set_userdata($newdata);
						}
						$msgs = get_phrase('coupon_applied_successfully', $language_code);
					} else {
						$msgs = ''; //get_phrase('checkout_details',$language_code);
					}
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => $msgs,
						$this->config->item('rest_data_field_name') => $cart_detail

					], self::HTTP_OK);
				}
			} else {

				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => '', //get_phrase('checkout_details',$language_code),
					$this->config->item('rest_data_field_name') => $cart_detail

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}



	// function for placeOrder
	public function placeOrder_post()
	{
		$requiredparameters = array('language', 'fullname', 'mobile', 'email', 'fulladdress', 'addresstype', 'payment_id', 'payment_mode','state','city_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		//$user_id = 'c2sc22sc';
		$user_id = removeSpecialCharacters($this->session->userdata('user_id'));
		$qouteid = removeSpecialCharacters($this->session->userdata('qoute_id'));
		$fullname = removeSpecialCharacters($this->post('fullname'));
		$mobile = removeSpecialCharacters($this->post('mobile'));
		$email = removeSpecialCharacters($this->post('email'));
		$area = '';
		$fulladdress = removeSpecialCharacters($this->post('fulladdress'));
		$country = '1';
		$region = '';
		$governorate = '';
		$lat = '';
		$lng = '';
		$state = removeSpecialCharacters($this->post('state'));
		$city = removeSpecialCharacters($this->post('city'));
		$city_id = removeSpecialCharacters($this->post('city_id'));
		$addresstype = removeSpecialCharacters($this->post('addresstype'));
		$payment_id = removeSpecialCharacters($this->post('payment_id'));
		$payment_mode = removeSpecialCharacters($this->post('payment_mode'));
		$coupon_code = removeSpecialCharacters($this->post('coupon_code'));
		$coupon_value = removeSpecialCharacters($this->post('coupon_value'));


		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if (($user_id || $qouteid) && $fullname && $mobile && $fulladdress && $country && $addresstype && $payment_id && $payment_mode) {

				$order_detail = $this->checkout_model->place_order_details($user_id, $qouteid, $fullname, $mobile, $area, $fulladdress, $country, $region, $governorate, $lat, $lng, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $coupon_value,$state,$city,$city_id);

				if ($order_detail['status'] == 'update') {
					$this->session->set_tempdata('place_order_status', 1, 5);
					$order_details['order_id'] = $order_detail['order_id'];
					$order_details['order_total'] = $order_detail['order_detail']['total_price'];
					$order_details['order_discount'] = $order_detail['order_detail']['discount'];
					$order_details['total_item'] = $order_detail['order_detail']['total_qty'];
					$order_details['order_msg'] = get_phrase('success_order', $language_code);

					$this->checkout_model->empty_cart($user_id, $qouteid);

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_details

					], self::HTTP_OK);
				} else {
					$order_details['order_id'] = 0;
					$order_details['order_total'] = 0;
					$order_details['order_discount'] = 0;
					$order_details['total_item'] = 0;
					$order_details['order_msg'] = '';

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('cart_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_details

					], self::HTTP_OK);
				}
			} else if (!$user_id && !$qouteid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => $cart_detail

				], self::HTTP_OK);
			} else if (!$fullname) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('username_mandatory', $language_code)
					//$this->config->item('rest_data_field_name') => $address_detail

				], self::HTTP_OK);
			} else if (!is_numeric($mobile)) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('phone_mandatory', $language_code)
					//$this->config->item('rest_data_field_name') => $address_detail

				], self::HTTP_OK);
			} else if (!$fulladdress) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('address_mandatory', $language_code)
					//$this->config->item('rest_data_field_name') => $address_detail

				], self::HTTP_OK);
			} else if (!$state) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('state_mandatory', $language_code)
					//$this->config->item('rest_data_field_name') => $address_detail

				], self::HTTP_OK);
			} else if (!$city) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('city_mandatory', $language_code)
					//$this->config->item('rest_data_field_name') => $address_detail

				], self::HTTP_OK);
			} else if (!$addresstype) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('addresstype_mandatory', $language_code)
					//$this->config->item('rest_data_field_name') => $address_detail

				], self::HTTP_OK);
			} else if (!$email) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('email_mandatory', $language_code)
					//$this->config->item('rest_data_field_name') => $address_detail

				], self::HTTP_OK);
			} else if (!$payment_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('payment_id_mandatory', $language_code)
					//$this->config->item('rest_data_field_name') => $address_detail

				], self::HTTP_OK);
			} else if (!$payment_mode) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('payment_mode_mandatory', $language_code)
					//$this->config->item('rest_data_field_name') => $address_detail

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function sendOrderNotifications_get()
	{
		$order_id = $this->get('order_id');
		$message_admin = 'Hello Admin, new order placed by customer. Please login into admin dashboard to see details. Order Id is ' . $order_id . ' – Regards, Marurang. MRURNG';
		$admin_phone = get_settings('system_phone');
		$this->sms_model->send_sms_new($message_admin, '968', $admin_phone);

		if ($order_id) {
			$this->email_model->send_order_email($order_id, PLACE_ORDER_TEMP);
			$this->email_model->send_order_email_admin_seller($order_id);
		}
		echo 'done';
	}
}
