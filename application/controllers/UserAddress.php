<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class UserAddress extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the UserAddress model
		$this->load->model('address_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function addUserAddress_post()
	{

		$requiredparameters = array('language', 'username', 'email', 'country_code', 'mobile', 'fulladdress', 'lat', 'lng', 'country_id', 'country', 'region_id', 'region', 'governorate_id', 'governorate', 'area_id', 'area', 'addresstype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->session->userdata('user_id'));
		$username = removeSpecialCharacters($this->post('username'));
		$email = removeSpecialCharacters($this->post('email'));
		$country_code = removeSpecialCharacters($this->post('country_code'));
		$mobile = removeSpecialCharacters($this->post('mobile'));
		$fulladdress = removeSpecialCharacters($this->post('fulladdress'));
		$lat = removeSpecialCharacters($this->post('lat'));
		$lng = removeSpecialCharacters($this->post('lng'));
		$country_id = removeSpecialCharacters($this->post('country_id'));
		$country = removeSpecialCharacters($this->post('country'));
		$region_id = removeSpecialCharacters($this->post('region_id'));
		$region = removeSpecialCharacters($this->post('region'));
		$governorate_id = removeSpecialCharacters($this->post('governorate_id'));
		$governorate = removeSpecialCharacters($this->post('governorate'));
		$area_id = removeSpecialCharacters($this->post('area_id'));
		$area = removeSpecialCharacters($this->post('area'));
		$addresstype = removeSpecialCharacters($this->post('addresstype'));


		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if (trim($user_id) !== '' && trim($country_code) !== '' && is_numeric($mobile) && trim($username) !== '' && trim($email) !== '' && trim($fulladdress) !== '' && trim($lat) !== '' && trim($lng) !== '' && trim($country) !== '' && trim($region) !== '' && trim($governorate) !== '' && trim($area) !== '' && trim($addresstype) !== '') {
				$address = $this->address_model->add_user_address($user_id, $country_code, $mobile, $username, $email, $fulladdress, $lat, $lng, $country_id, $country, $region_id, $region, $governorate_id, $governorate, $area_id, $area, $addresstype);
				if ($address == 'done') {
					//$address_detail = $this->address_model->get_user_address_details_full($user_id);
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('address_added', $language_code)
						//$this->config->item('rest_data_field_name') => $address_detail
					], self::HTTP_OK);
				} else if ($address == 'not_exist') {
					$this->responses(0, get_phrase('please_try_again', $language_code));
				} else {
					$this->responses(0, get_phrase('please_try_again', $language_code));
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('required_field_missing', $language_code)
				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function editUserAddress_post()
	{
		$requiredparameters = array('language', 'username', 'email', 'country_code', 'mobile', 'fulladdress', 'lat', 'lng', 'country', 'region', 'governorate', 'area', 'addresstype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$address_id = removeSpecialCharacters($this->post('address_id'));
		$user_id = removeSpecialCharacters($this->session->userdata('user_id'));
		$username = removeSpecialCharacters($this->post('username'));
		$email = removeSpecialCharacters($this->post('email'));
		$country_code = removeSpecialCharacters($this->post('country_code'));
		$mobile = removeSpecialCharacters($this->post('mobile'));
		$fulladdress = removeSpecialCharacters($this->post('fulladdress'));
		$lat = removeSpecialCharacters($this->post('lat'));
		$lng = removeSpecialCharacters($this->post('lng'));
		$country_id = removeSpecialCharacters($this->post('country_id'));
		$country = removeSpecialCharacters($this->post('country'));
		$region_id = removeSpecialCharacters($this->post('region_id'));
		$region = removeSpecialCharacters($this->post('region'));
		$governorate_id = removeSpecialCharacters($this->post('governorate_id'));
		$governorate = removeSpecialCharacters($this->post('governorate'));
		$area_id = removeSpecialCharacters($this->post('area_id'));
		$area = removeSpecialCharacters($this->post('area'));
		$addresstype = removeSpecialCharacters($this->post('addresstype'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if (trim($user_id) !== '' && trim($country_code) !== '' && is_numeric($mobile) && trim($username) !== '' && trim($email) !== '' && trim($fulladdress) !== '' && trim($lat) !== '' && trim($lng) !== '' && trim($country) !== '' && trim($region) !== '' && trim($governorate) !== '' && trim($area) !== '' && trim($addresstype) !== '') {
				$address = $this->address_model->edit_user_address($address_id, $user_id, $username, $email, $country_code, $mobile, $fulladdress, $lat, $lng, $country_id, $country, $region_id, $region, $governorate_id, $governorate, $area_id, $area, $addresstype);
				if ($address == 'done') {
					//$address_detail = $this->address_model->get_user_address_details_full($user_id);

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('address_added', $language_code)
						//$this->config->item('rest_data_field_name') => $address_detail

					], self::HTTP_OK);
				} else if ($address == 'not_exist') {
					$this->responses(0, get_phrase('please_try_again', $language_code));
				} else {
					$this->responses(0, get_phrase('please_try_again', $language_code));
				}
			} else {
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	// function for delete address
	public function deleteUserAddress_post()
	{
		$requiredparameters = array('language', 'user_id', 'address_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$address_id = removeSpecialCharacters($this->post('address_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($address_id && $user_id) {
				$address = $this->address_model->delete_address($user_id, $address_id);
				if ($address == 'delete') {
					$address_detail = $this->address_model->get_user_address_details_full($user_id);

					if (count($address_detail['address_details']) > 0) {

						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('address_deleted', $language_code),
							$this->config->item('rest_data_field_name') => $address_detail

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('address_empty', $language_code),
							$this->config->item('rest_data_field_name') => $address_detail

						], self::HTTP_OK);
					}
				} else if ($address == 'invalid') {
					$address = array();
					$address['defaultaddress'] = '';
					$address['address_details'] = array();
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_address_id', $language_code),
						$this->config->item('rest_data_field_name') => $address

					], self::HTTP_OK);
				} else {

					$address = array();
					$address['defaultaddress'] = '';
					$address['address_details'] = array();
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('please_try_again', $language_code),
						$this->config->item('rest_data_field_name') => $address

					], self::HTTP_OK);
				}
			} else {

				$address = array();
				$address['defaultaddress'] = '';
				$address['address_details'] = array();
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('address_invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => $address

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	// function for update address
	public function updateUserAddress_post()
	{
		$requiredparameters = array('language', 'user_id', 'address_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$address_id = removeSpecialCharacters($this->post('address_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($address_id && $user_id) {
				$address = $this->address_model->update_address($user_id, $address_id);
				if ($address == 'update') {
					$address_detail = $this->address_model->get_user_address_details_full($user_id);

					if (count($address_detail['address_details']) > 0) {

						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('address_updated', $language_code),
							$this->config->item('rest_data_field_name') => $address_detail

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('address_empty', $language_code),
							$this->config->item('rest_data_field_name') => $address_detail

						], self::HTTP_OK);
					}
				} else {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('please_try_again', $language_code),
						$this->config->item('rest_data_field_name') => array()

					], self::HTTP_OK);
				}
			} else {

				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('address_invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => array()

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function getshippingcost_post()
	{
		$requiredparameters = array('language', 'seller_pincode', 'user_pincode', 'total_value');

		$language_code = removeSpecialCharacters($this->post('language'));
		$seller_pincode = removeSpecialCharacters($this->post('seller_pincode'));
		$user_pincode = removeSpecialCharacters($this->post('user_pincode'));
		$total_value = removeSpecialCharacters($this->post('total_value'));

		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			$shiping_detail = $this->address_model->get_shippinf_details_full($seller_pincode, $user_pincode, $total_value);

			$this->response([
				$this->config->item('rest_status_field_name') => 1,
				$this->config->item('rest_message_field_name') => 'get Shipping Data',
				$this->config->item('rest_data_field_name') => $shiping_detail

			], self::HTTP_OK);
		} else {
			echo $validation;
		}
	}

	// function for get cart product
	public function getUserAddress_post()
	{
		$requiredparameters = array('language', 'user_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($user_id) {
				$address_detail = $this->address_model->get_user_address_details_full($user_id);

				if (count($address_detail['address_details']) > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('address_details', $language_code),
						$this->config->item('rest_data_field_name') => $address_detail

					], self::HTTP_OK);
				} else {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('address_empty', $language_code),
						$this->config->item('rest_data_field_name') => $address_detail

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('address_invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => array()

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
