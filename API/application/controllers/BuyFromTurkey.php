<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class BuyFromTurkey extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();
		// Load the brand model
		$this->load->model('home_model');
		$this->load->model('Brand_model');
		$this->load->model('order_model');
		$this->load->model('Checkout_model');
		$this->load->model('address_model');
	}
	
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function getTurkishBrands_post()
	{
		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$turkish_brands = $this->Brand_model->getTurkishBrands($language_code);

			if ($turkish_brands) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => '',
					$this->config->item('rest_data_field_name') => $turkish_brands

				], self::HTTP_OK);
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code)

				], self::HTTP_OK);
			}
		} else {
			echo $validation;
		}
	}

	public function submitShoppingRequest_post()
	{
		$requiredparameters = array('language', 'user_id', 'product_link', 'product_size', 'product_quantity', 'product_size', 'product_color', 'product_des', 'country', 'status');

		$media_path = '../media/';
		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$order_id = strtoupper('ODR' . $this->Checkout_model->random_strings(6) . date("hi") . rand(1, 99));
		$product_link = removeSpecialCharacters($this->post('product_link'));
		$product_quantity = removeSpecialCharacters($this->post('product_quantity'));
		$product_size = removeSpecialCharacters($this->post('product_size'));
		$product_color = removeSpecialCharacters($this->post('product_color'));
		$product_des = removeSpecialCharacters($this->post('product_des'));
		$country = removeSpecialCharacters($this->post('country'));
		$status = removeSpecialCharacters($this->post('status'));

		$product_img_1 = '';
		if (strlen($_FILES['product_img_1']['name']) > 1) {
			$product_img_1 = file_upload('product_img_1', $media_path);
		}
		
		$product_img_2 = '';
		if (strlen($_FILES['product_img_2']['name']) > 1) {
			$product_img_2 = file_upload('product_img_2', $media_path);
		}

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid' && !empty($product_img_1) && !empty($product_img_2)) {
			$submit_request = $this->Checkout_model->submitBuyFromAnotherCountryShoppingRequest($user_id, $order_id, $product_link, $product_quantity, $product_size, $product_color, $product_des, $product_img_1, $product_img_2, $country, $status);
			
			if ($submit_request) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => get_phrase('request_has_been_submitted_succesfully', $language_code),
					$this->config->item('rest_data_field_name') => $submit_request

				], self::HTTP_OK);
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('failed_to_submit_request', $language_code)

				], self::HTTP_OK);
			}
		} else {
			$this->response([
				$this->config->item('rest_status_field_name') => 0,
				$this->config->item('rest_message_field_name') => get_phrase('required_field_missing', $language_code)

			], self::HTTP_OK);
		}
	}

	public function placeOtheCountryOrders_post()
	{
		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = $this->session->userdata("user_id");
		$order_ids = $this->post('order_ids');
		$fullname = removeSpecialCharacters($this->post('fullname'));
		$mobile = removeSpecialCharacters($this->post('mobile'));
		$email = removeSpecialCharacters($this->post('email'));
		$fulladdress = removeSpecialCharacters($this->post('fulladdress'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$place_order = $this->order_model->placeProcessedBuyFromTurkeyOrders($this->default_language, $user_id, $order_ids, $fullname, $mobile, $email, $fulladdress);

			if ($place_order) {
				$this->session->set_tempdata('buy_from_turkey_status', 1, 30);
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => get_phrase('order_placed_succesfully', $language_code)
				], self::HTTP_OK);
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('failed_to_place_order', $language_code)
				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
