<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Checkout extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the Checkout model
		$this->load->model('checkout_model');
		$this->load->model('delivery_model');
		$this->load->model('sms_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	// function for get cart count
	public function checkout_post()
	{
		$requiredparameters = array('language', 'user_id', 'qouteid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$qouteid = removeSpecialCharacters($this->post('qouteid'));
		$coupon_code = removeSpecialCharacters($this->post('coupon_code'));
		$shipping_city = removeSpecialCharacters($this->post('shipping_city'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($user_id || $qouteid) {
				$cart_detail = $this->checkout_model->get_checkout_full_details($language_code, $user_id, $qouteid, $shipping_city, $coupon_code);

				if ($cart_detail) {

					$validate_coupon = '';
					$coupon_discount = '';
					/*if(trim($coupon_code)){*/
					if (($cart_detail['coupon_discount1'])) {
						$validate_coupon = $this->checkout_model->Validate_coupon_code($user_id, $coupon_code, '');
						//print_r($validate_coupon);
						if ($validate_coupon == 'invalid') {
							/* get_phrase('invalid_coupon',$language_code) msg */
							$this->response([
								$this->config->item('rest_status_field_name') => 1,
								$this->config->item('rest_message_field_name') => '',
								$this->config->item('rest_data_field_name') => $cart_detail,
								'qouteid' => $qouteid

							], self::HTTP_OK);
						} else if ($validate_coupon == 'login_required') {
							$this->response([
								$this->config->item('rest_status_field_name') => 2,
								$this->config->item('rest_message_field_name') => get_phrase('login_requireed', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail,
								'qouteid' => $qouteid

							], self::HTTP_OK);
						} else if ($validate_coupon == 'applied_exced') {
							$this->response([
								$this->config->item('rest_status_field_name') => 2,
								$this->config->item('rest_message_field_name') => get_phrase('applied_exced', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail,
								'qouteid' => $qouteid

							], self::HTTP_OK);
						} else if ($validate_coupon == 'expired') {
							$this->response([
								$this->config->item('rest_status_field_name') => 2,
								$this->config->item('rest_message_field_name') => get_phrase('coupon_expired', $language_code),
								$this->config->item('rest_data_field_name') => $cart_detail,
								'qouteid' => $qouteid

							], self::HTTP_OK);
						} else if ($validate_coupon->min_order > 0 && $cart_detail['total_price_value'] < $validate_coupon->min_order) {
							$validate_coupon = 'less_amount';
						} else {
							/*$coupon_type = $validate_coupon->coupon_type;
							$value = $validate_coupon->value;
							$coupon_discount =0;
							if($coupon_type ==1){
								$coupon_discount =  ($cart_detail['total_price_value']/100)*$value;
							}else if($coupon_type ==2){
								$coupon_discount =  $value;
							}
							$payable_amount = ($cart_detail['total_price_value']-$coupon_discount);
							
							$cart_detail['coupon_discount'] = $coupon_discount;
							$cart_detail['payable_amount'] = price_format($payable_amount);
							$cart_detail['payable_amount_value'] = $payable_amount;
							$cart_detail['total_price_value'] = $payable_amount;
							*/
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
					$user_address = array("address_id" => '', "fullname" => '', "mobile" => '', "locality" => '', "fulladdress" => '', "city" => '', "state" => '', "pincode" => '', "email" => '', "addresstype" => '');

					$res = array(
						'user_address' => $user_address, 'total_mrp' => 0, 'total_discount' => 0, 'total_price' => 0,
						'total_item' => 0, 'tax_payable' => 0, 'coupon_code' => $coupon_code, 'coupon_discount' => 0, 'shipping_fee' => 0, 'payable_amount' => 0, 'payable_amount_value' => 0, 'total_price_value' => 0
					);
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('cart_empty', $language_code),
						$this->config->item('rest_data_field_name') => $res,
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
		//$total_price_value = preg_replace('/\D/', "", $total_price_value, -1);

		$total_price_value = ltrim($total_price_value, 'JD');


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
					if ($coupon_type == 1) { // ye coupon percentage discount vala he
						$coupon_discount =  ($total_price_value / 100) * $value;
					} else if ($coupon_type == 2) { // fixes vala he
						$coupon_discount =  $total_price_value - $value;
					}
					//$payable_amount = ($total_price_value-$coupon_discount);
					$payable_amount = ($total_price_value - $value);

					$cart_detail['coupon_discount'] = price_format($value);
					$cart_detail['payable_amount'] = price_format($payable_amount);
					//$cart_detail['payable_amount_value'] = $total_price_value;
					//$cart_detail['total_price_value'] = $payable_amount;
					$cart_detail['coupon_code'] = $coupon_code;

					if ($coupon_discount > 0) {
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
		$requiredparameters = array('language', 'user_id', 'qouteid', 'fullname', 'mobile', 'email', 'area', 'fulladdress', 'country', 'region', 'governorate', 'lat', 'lng', 'addresstype', 'payment_id', 'payment_mode', 'coupon_code', 'coupon_value','city','state','pincode');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$qouteid = removeSpecialCharacters($this->post('qouteid'));
		$fullname = removeSpecialCharacters($this->post('fullname'));
		$mobile = removeSpecialCharacters($this->post('mobile'));
		$email = removeSpecialCharacters($this->post('email'));
		$area = removeSpecialCharacters($this->post('area'));
		$fulladdress = removeSpecialCharacters($this->post('fulladdress'));
		$country = removeSpecialCharacters($this->post('country'));
		$region = removeSpecialCharacters($this->post('region'));
		$governorate = removeSpecialCharacters($this->post('governorate'));
		$lat = removeSpecialCharacters($this->post('lat'));
		$lng = removeSpecialCharacters($this->post('lng'));
		$addresstype = removeSpecialCharacters($this->post('addresstype'));
		$payment_id = removeSpecialCharacters($this->post('payment_id'));
		$payment_mode = removeSpecialCharacters($this->post('payment_mode'));
		$coupon_code = removeSpecialCharacters($this->post('coupon_code'));
		$coupon_value = removeSpecialCharacters($this->post('coupon_value'));
		$city = removeSpecialCharacters($this->post('city'));
		$state = removeSpecialCharacters($this->post('state'));
		$pincode = removeSpecialCharacters($this->post('pincode'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if (($user_id || $qouteid) && $fullname && $mobile && $fulladdress && $country && $addresstype && $payment_id && $payment_mode) {

				$order_detail = $this->checkout_model->place_order_details($user_id, $qouteid, $fullname, $mobile, $area, $fulladdress, $country, $region, $governorate, $lat, $lng, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $coupon_value,$city,$state,$pincode);

				if ($order_detail['status'] == 'update') {
					$order_details['order_id'] = $order_detail['order_id'];
					$order_details['order_total'] = price_format($order_detail['order_detail']['total_price']);
					$order_details['order_discount'] = price_format($order_detail['order_detail']['discount']);
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

				], self::HTTP_OK);
			} else if (!$fullname) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('username_mandatory', $language_code)

				], self::HTTP_OK);
			} else if (!is_numeric($mobile)) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('phone_mandatory', $language_code)

				], self::HTTP_OK);
			} else if (!$fulladdress) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('address_mandatory', $language_code)

				], self::HTTP_OK);
			} else if (!$addresstype) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('addresstype_mandatory', $language_code)

				], self::HTTP_OK);
			} else if (!$email) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('email_mandatory', $language_code)

				], self::HTTP_OK);
			} else if (!$payment_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('payment_id_mandatory', $language_code)

				], self::HTTP_OK);
			} else if (!$payment_mode) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('payment_mode_mandatory', $language_code)

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function sendOrderNotifications_post()
	{
		$order_id = $this->post('order_id');
		// $message_admin = 'Hello Admin, new order placed by customer. Please login into admin dashboard to see details. Order Id is ' . $order_id . ' – Regards, Marurang. MRURNG';
		// $admin_phone = get_settings('system_phone');
		// $this->sms_model->send_sms_new($message_admin, '968', $admin_phone);

		if ($order_id) {
			$this->email_model->send_order_email($order_id, PLACE_ORDER_TEMP);
			$this->email_model->send_order_email_admin_seller($order_id);
		}
		$this->response([
			$this->config->item('rest_status_field_name') => 1,
			$this->config->item('rest_message_field_name') => 'Email sent successfully'

		], self::HTTP_OK);
	}
}
