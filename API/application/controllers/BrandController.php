<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class BrandController extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the brand model
		$this->load->model('brand_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function getBrand_post()
	{
		$requiredparameters = array('language', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$brand_array = $this->brand_model->get_brand_request($language_code, $devicetype);

			if (count($brand_array) > 0) {
				$this->responses(1, get_phrase('brand_results', $language_code), $brand_array);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code), $brand_array);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function getBrandProduct_post()
	{

		//echo 'ddd';
		$requiredparameters = array('language', 'brand_id', 'pageno', 'sortby', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$brand_id = removeSpecialCharacters($this->post('brand_id'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby = removeSpecialCharacters($this->post('sortby'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$product_array = $this->brand_model->get_brand_product_request($language_code, $brand_id, $pageno, $sortby, $devicetype);

			if ($product_array) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => get_phrase('brand_product', $language_code),
					'pageno' => $pageno,
					'total_product' => $product_array['total_count'],
					$this->config->item('rest_data_field_name') => $product_array['product_array']

				], self::HTTP_OK);
			} else {

				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
					'pageno' => $pageno,
					'total_product' => 0,
					$this->config->item('rest_data_field_name') => $product_array['product_array']

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function getTopBrands_post()
	{
		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$brand_array = $this->brand_model->getTopBrands($language_code);

			if (count($brand_array) > 0) {
				$this->responses(1, get_phrase('brand_results', $language_code), $brand_array);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code), $brand_array);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
