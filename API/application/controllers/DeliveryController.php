<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class DeliveryController extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the user model
		$this->load->model('delivery_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function get_delivery_city_post()
	{
		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$delivery_array = $this->delivery_model->get_delivery_city_request();

			if (count($delivery_array) > 0) {
				$this->responses(1, 'delivery_city', $delivery_array);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code), $delivery_array);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
	public function delivery_city_details_post()
	{
		$requiredparameters = array('language', 'city_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$city_id = removeSpecialCharacters($this->post('city_id'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($city_id) {
				$delivery_array = $this->delivery_model->get_delivery_city_details_request($city_id);

				if (count($delivery_array) > 0) {
					$this->responses(1, 'delivery_city', $delivery_array);
				} else {
					$this->responses(0, get_phrase('no_record_found', $language_code), $delivery_array);
				}
			} else {
				$delivery_array = array('basic_fee' => '', 'order_value' => '', 'big_item_fee' => '', 'estimated_delivery_time' => '', 'prime_delivery_time' => '');
				$this->responses(0, get_phrase('city_mandatory', $language_code), $delivery_array);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function get_country_post()
	{
		$requiredparameters = array('language');
		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			if ($language_code) {
				$country_details = $this->delivery_model->get_country($language_code);
				if (count($country_details) > 0) {
					$this->responses(1, 'get_details_sucessfully', $country_details);
				} else {
					$this->responses(0, get_phrase('no_record_found', $language_code));
				}
			} else {
				$this->responses(0, get_phrase('language_mandatory', $language_code));
			}
		} else {
			echo $validation;
		}
	}

	public function get_region_post()
	{
		$requiredparameters = array('language', 'country_id');
		$language_code = removeSpecialCharacters($this->post('language'));
		$country_id = removeSpecialCharacters($this->post('country_id'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			if ($language_code && $country_id) {
				$region_details = $this->delivery_model->get_region($language_code, $country_id);
				if (count($region_details) > 0) {
					$this->responses(1, 'get_details_sucessfully', $region_details);
				} else {
					$this->responses(0, get_phrase('no_record_found', $language_code));
				}
			} else {
				$this->responses(0, get_phrase('required_field_missing', $language_code));
			}
		} else {
			echo $validation;
		}
	}

	public function get_governorates_post()
	{
		$requiredparameters = array('language', 'region_id');
		$language_code = removeSpecialCharacters($this->post('language'));
		$region_id = removeSpecialCharacters($this->post('region_id'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			if ($language_code && $region_id) {
				$governorate_details = $this->delivery_model->get_governorate($language_code, $region_id);
				if (count($governorate_details) > 0) {
					$this->responses(1, 'get_details_sucessfully', $governorate_details);
				} else {
					$this->responses(0, get_phrase('no_record_found', $language_code));
				}
			} else {
				$this->responses(0, get_phrase('required_field_missing', $language_code));
			}
		} else {
			echo $validation;
		}
	}

	public function get_areas_post()
	{
		$requiredparameters = array('language', 'governorate_id');
		$language_code = removeSpecialCharacters($this->post('language'));
		$governorate_id = removeSpecialCharacters($this->post('governorate_id'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			if ($language_code && $governorate_id) {
				$area_details = $this->delivery_model->get_area($language_code, $governorate_id);
				if (count($area_details) > 0) {
					$this->responses(1, 'get_details_sucessfully', $area_details);
				} else {
					$this->responses(0, get_phrase('no_record_found', $language_code));
				}
			} else {
				$this->responses(0, get_phrase('required_field_missing', $language_code));
			}
		} else {
			echo $validation;
		}
	}
}
