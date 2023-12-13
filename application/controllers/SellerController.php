<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/third_party/encryptfun.php';


class SellerController extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the user model
		$this->load->model('sellerProduct_model');
		$this->load->model('delivery_model');
		$this->load->model('sms_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function seller_form_get()
	{
		$this->data['get_country'] = $this->delivery_model->get_country();

		$this->load->view('website/become_seller.php', $this->data);  // ye view/website folder hai
	}

	public function thankyouseller_get()
	{
		$this->load->view('website/thankyouseller.php', $this->data);  // ye view/website folder hai
	}

	//function for upload products image and resize image in multiple dimention
	

	function makeimagepath($str)
	{
		$inputstring = trim(strip_tags($str));
		$lowertext = strtolower($inputstring);
		//$lowertext = preg_replace('/[^A-Za-z0-9\-]/', '', $lowertext);
		$lowertext = str_replace(" ", "-", $lowertext);
		$lowertext = str_replace("&", "", $lowertext);
		$lowertext = str_replace("%", "", $lowertext);
		$lowertext = str_replace("--", "-", $lowertext);
		$lowertext = str_replace("---", "-", $lowertext);
		$lowertext = str_replace("  ", "-", $lowertext);
		$lowertext = str_replace("_", "-", $lowertext);
		$lowertext = str_replace("$", "", $lowertext);
		$lowertext = str_replace("@", "", $lowertext);
		$lowertext = str_replace("!", "", $lowertext);
		$lowertext = str_replace("#", "", $lowertext);
		$lowertext = str_replace("^", "", $lowertext);
		$lowertext = str_replace("`", "", $lowertext);
		$lowertext = str_replace("*", "", $lowertext);
		$lowertext = str_replace("(", "", $lowertext);
		$lowertext = str_replace(")", "", $lowertext);
		$lowertext = str_replace("+", "", $lowertext);
		$lowertext = str_replace("=", "", $lowertext);
		$lowertext = str_replace(":", "", $lowertext);
		$lowertext = str_replace(";", "", $lowertext);
		$lowertext = str_replace("<", "", $lowertext);
		$lowertext = str_replace("?", "", $lowertext);
		$lowertext = str_replace(">", "", $lowertext);
		$lowertext = str_replace("'", "", $lowertext);
		$lowertext = str_replace('"', "", $lowertext);
		$lowertext = str_replace(',', "", $lowertext);
		$lowertext = str_replace('[', "", $lowertext);
		$lowertext = str_replace(']', "", $lowertext);
		$lowertext = str_replace('{', "", $lowertext);
		$lowertext = str_replace('}', "", $lowertext);
		$lowertext = str_replace('|', "", $lowertext);
		$lowertext = str_replace('/', "", $lowertext);
		return $lowertext;
	}

	function add_sellers_post()
	{
		$media_path = 'media/';
		$business_type = $_POST['business_type'];
		$seller_name = $_POST['seller_name'];
		$business_name = $_POST['business_name'];
		$business_address = $_POST['business_address'];
		$business_details = $_POST['business_details'];
		$state_id = $_POST['state_id'];
		$state = $_POST['state'];
		$city_id = $_POST['city_id'];
		$city = $_POST['city'];
		$pincode = $_POST['pincode'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$website_link = $_POST['website_link'];
		$facebook_link = $_POST['facebook_link'];
		$instagram_link = $_POST['instagram_link'];
		$password = $_POST['passwords'];
		$business_logo = null;
		$aadhar_card = null;
		$pan_card = null;
		$gst_certificate = null;

		$publickey_server = $this->config->item("encryption_key");
		$encruptfun = new encryptfun();
		$encryptedpassword = $encruptfun->encrypt($publickey_server, $password);
		$password  = $encryptedpassword;

		if (strlen($_FILES['business_logo']['name']) > 1) {
			$business_logo = doc_upload('business_logo', $media_path);
		}
		if (strlen($_FILES['aadhar_card']['name']) > 1) {
			$aadhar_card = doc_upload('aadhar_card', $media_path);
		}
		if (strlen($_FILES['pan_card']['name']) > 1) {
			$pan_card = doc_upload('pan_card', $media_path);
		}
		if (strlen($_FILES['gst_certificate']['name']) > 1) {
			$gst_certificate = doc_upload('gst_certificate', $media_path);
		}

		$seller_array = $this->sellerProduct_model->add_seller($business_type, $seller_name, $business_name, $business_address, $business_details, $state_id, $state, $city_id, $city, $pincode, $phone, $email, $website_link, $facebook_link, $instagram_link, $password, $business_logo, $aadhar_card, $pan_card, $gst_certificate);


		echo $seller_array;
	}

	function sendPhoneOtp_post()
	{
		$requiredparameters = array('language', 'phone');
		$language_code = removeSpecialCharacters($this->post('language'));
		$phone  = removeSpecialCharacters($this->post('phone'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			$otp = $this->sms_model->generateNumericOTP(6);
			$message = 'Dear customer welcome onboard ! ' . $otp . ' is your OTP to login your Rentzo account. RENTZO';
			$sms_sent = $this->sms_model->send_sms_new($message, $phone);
			if ($sms_sent == 'disabled') {
				$this->responses(0, get_phrase('sms_disabled', $language_code));
			} else if ($sms_sent == 'sent') {
				$this->session->set_tempdata('become_seller_phone_otp', $otp, 180);
				$this->responses(1, get_phrase('sms_sent', $language_code), $otp);
			} else {
				$this->responses(0, get_phrase('sms_failed', $language_code));
			}
		} else {
			echo $validation;
		}
	}

	function validatePhoneOtp_post()
	{
		$requiredparameters = array('language', 'otp');
		$language_code = removeSpecialCharacters($this->post('language'));
		$otp  = removeSpecialCharacters($this->post('otp'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			if ($otp === $this->session->tempdata('become_seller_phone_otp')) {
				$this->responses(1, get_phrase('otp_validated', $language_code), $otp);
			} else {
				$this->responses(0, get_phrase('wrong_otp', $language_code));
			}
		} else {
			echo $validation;
		}
	}

	function sendEmailOtp_post()
	{
		$requiredparameters = array('language', 'email');

		$language_code = removeSpecialCharacters($this->post('language'));
		$email  = removeSpecialCharacters($this->post('email'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$this->load->model('email_model');
			$otp = $this->sms_model->generateNumericOTP(6);
			$this->email_model->sendEmailOtp($email, $otp);
			$this->session->set_tempdata('become_seller_email_otp', $otp, 180);
			$this->responses(1, get_phrase('sms_sent', $language_code));
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	function validateEmailOtp_post()
	{
		$requiredparameters = array('language', 'otp');
		$language_code = removeSpecialCharacters($this->post('language'));
		$otp  = removeSpecialCharacters($this->post('otp'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			if ($otp === $this->session->tempdata('become_seller_email_otp')) {
				$this->responses(1, get_phrase('otp_validated', $language_code), $otp);
			} else {
				$this->responses(0, get_phrase('wrong_otp', $language_code));
			}
		} else {
			echo $validation;
		}
	}

	public function getSellerDetails_post()
	{
		$requiredparameters = array('language', 'sellerid', 'pageno', 'sortby', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$sellerid = removeSpecialCharacters($this->post('sellerid'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby = removeSpecialCharacters($this->post('sortby'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		$seller_product_array = array('seller_details' => array(), 'seller_products' => array());
		if ($validation == 'valid') {
			if ($sellerid) {
				$seller_array = $this->sellerProduct_model->get_seller_request($sellerid, $devicetype);
				if ($seller_array) {
					$seller_product_array = array('seller_details' => $seller_array, 'seller_products' => array());
					$product_array = $this->sellerProduct_model->get_category_product_request($sellerid, $pageno, $sortby, $devicetype);

					if ($product_array) {
						$seller_product_array = array('seller_details' => $seller_array, 'seller_products' => $product_array);
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => '',
							'pageno' => $pageno,
							$this->config->item('rest_data_field_name') => $seller_product_array

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
							'pageno' => $pageno,
							$this->config->item('rest_data_field_name') => $seller_product_array

						], self::HTTP_OK);
					}
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						'pageno' => $pageno,
						$this->config->item('rest_data_field_name') => $seller_product_array

					], self::HTTP_OK);
				}
			} else if (!$sellerid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('seller_mandatory', $language_code),
					'pageno' => $pageno,
					$this->config->item('rest_data_field_name') => $seller_product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
