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

	function create_media_folder($media_path)
	{

		$folder_name = $media_path . date("Y-m-d");
		if (!is_dir($folder_name)) {
			mkdir($folder_name);

			$content = "<!DOCTYPE html>
					<html>
					<head>
						<title>403 Forbidden</title>
					</head>
					<body>
					
					<p>Directory access is forbidden.</p>
					
					</body>
					</html>";
			$fp = fopen($folder_name . "/index.html", "wb");
			fwrite($fp, $content);
			fclose($fp);
		}
		return $folder_name;
	}

	function file_upload($file_name, $media_path)
	{
		include_once('libraries/php-image-resize-master/lib/ImageResize.php');

		$media_dir = $this->create_media_folder($media_path);
		$file_full_path = '';
		if (is_array($_FILES[$file_name]["name"])) {
			$count = count($_FILES[$file_name]["name"]);
			$file_full_path = array();
			for ($i = 0; $i < $count; $i++) {
				$path_info = '';
				if ($_FILES[$file_name]["name"][$i] != "") {
					$path_info = pathinfo($_FILES[$file_name]["name"][$i]);

					$extension = $path_info['extension'];
					$filename = $this->makeimagepath($path_info['filename']);

					$intFile = mt_rand();
					$file_full_path1 = $media_dir . '/' . $filename . $intFile . '.' . $extension;
					//$file_full_path1 = $media_dir.'/'.$intFile.$this->makeimagepath($_FILES[$file_name]["name"][$i]);
					move_uploaded_file($_FILES[$file_name]["tmp_name"][$i], $file_full_path1);

					$thumb = array();
					foreach ($this->img_dimension_arr as $value) {
						$height = $value[0];
						$width = $value[1];
						$destination_file = $media_dir . '/' . $filename . $intFile . '-' . $height . '-' . $width . '.' . $extension;

						$image = new ImageResize($file_full_path1);
						$image->resizeToBestFit($height, $width);
						$image->save($destination_file);
						$thumb[$height . '-' . $width] = str_replace($media_path, '', $destination_file);
					}
					//unlink($file_full_path1);
					$file_full_path[] = $thumb;
				}
			}
		} else {
			if ($_FILES[$file_name]["name"] != "") {
				$path_info = pathinfo($_FILES[$file_name]["name"]);

				$extension = $path_info['extension'];
				$filename = $this->makeimagepath($path_info['filename']);

				$intFile = mt_rand();
				$file_full_path1 = $media_dir . '/' . $filename . $intFile . '.' . $extension;
				//$file_full_path1 = $media_dir.'/'.$intFile.$this->makeimagepath($_FILES[$file_name]["name"]);
				move_uploaded_file($_FILES[$file_name]["tmp_name"], $file_full_path1);

				$thumb = array();
				foreach ($this->img_dimension_arr as $value) {
					$height = $value[0];
					$width = $value[1];
					$destination_file = $media_dir . '/' . $filename . $intFile . '-' . $height . '-' . $width . '.' . $extension;

					$image = new ImageResize($file_full_path1);
					$image->resizeToBestFit($height, $width);
					$image->save($destination_file);
					$thumb[$height . '-' . $width] = str_replace($media_path, '', $destination_file);
				}
				//unlink($file_full_path1);
				$file_full_path = $thumb;
			}
		}

		return $file_full_path;
	}

	//function for upload products image and resize image in multiple dimention
	function doc_upload($file_name, $media_path)
	{

		$media_dir = $this->create_media_folder($media_path);
		$file_full_path = '';
		if (is_array($_FILES[$file_name]["name"])) {
			$count = count($_FILES[$file_name]["name"]);
			$file_full_path = array();
			for ($i = 0; $i < $count; $i++) {
				if ($_FILES[$file_name]["name"][$i] != "") {
					$intFile = mt_rand();
					$file_full_path1 = $media_dir . '/' . $intFile . $this->makeimagepath($_FILES[$file_name]["name"][$i]);
					move_uploaded_file($_FILES[$file_name]["tmp_name"][$i], $file_full_path1);
					$file_full_path[] = str_replace($media_path, '', $file_full_path1);
				}
			}
		} else {
			if ($_FILES[$file_name]["name"] != "") {

				$intFile = mt_rand();
				$file_full_path1 = $media_dir . '/' . $intFile . $this->makeimagepath($_FILES[$file_name]["name"]);
				move_uploaded_file($_FILES[$file_name]["tmp_name"], $file_full_path1);

				$file_full_path = str_replace($media_path, '', $file_full_path1);
			}
		}

		return $file_full_path;
	}

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
		$vat_registered = $_POST['vat_registered'];
		$vat_registratoion_no = $_POST['vat_registratoion_no'];
		$seller_name = $_POST['seller_name'];
		$business_name = $_POST['business_name'];
		$business_address = $_POST['business_address'];
		$business_details = $_POST['business_details'];
		$country_id = $_POST['country_id'];
		$country = $_POST['country'];
		$region_id = $_POST['region_id'];
		$region = $_POST['region'];
		$governorate_id = $_POST['governorate_id'];
		$governorate = $_POST['governorate'];
		$area_id = $_POST['area_id'];
		$area = $_POST['area'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$website_link = $_POST['website_link'];
		$facebook_link = $_POST['facebook_link'];
		$instagram_link = $_POST['instagram_link'];
		$password = $_POST['passwords'];
		$business_logo = '';
		$aadhar_card = '';
		$commercial_registration = null;
		$vat_certificate = null;
		$license = null;

		$publickey_server = $this->config->item("encryption_key");
		$encruptfun = new encryptfun();
		$encryptedpassword = $encruptfun->encrypt($publickey_server, $password);
		$password  = $encryptedpassword;

		if (strlen($_FILES['business_logo']['name']) > 1) {
			$business_logo = $this->doc_upload('business_logo', $media_path);
		}
		if (strlen($_FILES['aadhar_card']['name']) > 1) {
			$aadhar_card = $this->doc_upload('aadhar_card', $media_path);
		}
		if (strlen($_FILES['commercial_registration']['name']) > 1) {
			$commercial_registration = $this->doc_upload('commercial_registration', $media_path);
		}
		if (strlen($_FILES['vat_certificate']['name']) > 1) {
			$vat_certificate = $this->doc_upload('vat_certificate', $media_path);
		}
		if (strlen($_FILES['license']['name']) > 1) {
			$license = $this->doc_upload('license', $media_path);
		}




		$seller_array = $this->sellerProduct_model->add_seller($business_type, $vat_registered, $vat_registratoion_no, $seller_name, $business_name, $business_address, $business_details, $country_id, $country, $region_id, $region, $governorate_id, $governorate, $area_id, $area, $phone, $email, $website_link, $facebook_link, $instagram_link, $password, $business_logo, $aadhar_card, $commercial_registration, $vat_certificate, $license);


		echo $seller_array;
	}

	function sendPhoneOtp_post()
	{
		$requiredparameters = array('language', 'phone', 'country_code');
		$language_code = removeSpecialCharacters($this->post('language'));
		$phone  = removeSpecialCharacters($this->post('phone'));
		$country_code  = removeSpecialCharacters($this->post('country_code'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			$otp = $this->sms_model->generateNumericOTP(6);
			$message = 'Dear customer welcome onboard ! ' . $otp . ' is your OTP to login your EBuy account. EBUY';
			$sms_sent = $this->sms_model->send_sms_new($message, $country_code, $phone);
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
