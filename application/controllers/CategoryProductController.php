<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class CategoryProductController extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Load the user model
		$this->load->model('categoryProduct_model');
		$this->load->model('product_model');
	}
	public function index_get($cat_slug)
	{
		$default_language = $this->session->userdata("default_language");
		$this->data['cat_details'] = $this->categoryProduct_model->get_category_details($default_language, $cat_slug);
		if (!$this->data['cat_details']) {
			redirect('/404', 'refresh');
		}
		$filters = $this->product_model->get_product_filter($this->data['cat_details']->cat_id);
		$this->data['product_filter'] =  $filters['attribute_array'];
		$this->data['price_filter'] = $filters['price_filter'];
		$this->data['product_short_by'] = $this->product_model->get_product_sortby($default_language);

		$this->load->view('website/productFilter.php', $this->data);
	}

	function get_category_product_post()
	{
		$catid = $this->input->post('catid');
		$sortby = $this->input->post('sortby');
		$pageno = $this->input->post('pageno');
		$response = $this->categoryProduct_model->get_category_product_request($catid, $pageno, $sortby, 1);

		echo json_encode($response);
	}

	public function getCategoryProduct_post()
	{
		$requiredparameters = array('language', 'catid', 'pageno', 'sortby', 'devicetype', 'config_attr');

		$language_code = removeSpecialCharacters($this->post('language'));
		$catid = removeSpecialCharacters($this->post('catid'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby = removeSpecialCharacters($this->post('sortby'));
		$min_price = removeSpecialCharacters($this->post('min_price'));
		$max_price = removeSpecialCharacters($this->post('max_price'));
		$rating = removeSpecialCharacters($this->post('rating'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$config_attr = removeSpecialCharacters($this->post('config_attr'));



		$validation = $this->parameterValidation($requiredparameters, $this->post());
		$product_count = 0;
		$product_array = array();
		if ($validation == 'valid') {
			if ($catid) {
				$product_array = $this->categoryProduct_model->get_category_product_request($language_code, $catid, $pageno, $sortby, $min_price, $max_price, $rating, $devicetype, $config_attr);

				if ($product_array == 'invalid_filter') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_filter', $language_code),
						'total_pages' => 0,
						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				} else if ($product_array) {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => '',
						'total_pages' => $product_array['total_pages'],
						$this->config->item('rest_data_field_name') => $product_array['product_array']

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						'total_pages' => 0,
						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				}
			} else if (!$catid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('category_id_mandatory', $language_code),
					'total_pages' => 0,
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation;
		}
	}

	public function getCategorysponsorProduct_post()
	{
		$requiredparameters = array('language', 'catid', 'pageno', 'sortby', 'devicetype', 'config_attr');

		$language_code = removeSpecialCharacters($this->post('language'));
		$catid = removeSpecialCharacters($this->post('catid'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby = removeSpecialCharacters($this->post('sortby'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$config_attr = removeSpecialCharacters($this->post('config_attr'));



		$validation = $this->parameterValidation($requiredparameters, $this->post());
		$product_count = 0;
		$product_array = array();
		if ($validation == 'valid') {
			if ($catid) {
				$product_array = $this->categoryProduct_model->get_category_sponsor_product_request($language_code, $catid, $pageno, $sortby, $devicetype, $config_attr);

				if ($product_array == 'invalid_filter') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_filter', $language_code),
						'pageno' => ($pageno + 1),
						'productCount' => $product_count,
						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				} else if ($product_array) {
					$product_count = $this->categoryProduct_model->get_category_sponsor_product_count($catid, $pageno, $sortby, $devicetype, $config_attr);

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => '',
						'pageno' => ($pageno + 1),
						'productCount' => $product_count,
						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						'pageno' => ($pageno + 1),
						'productCount' => $product_count,
						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				}
			} else if (!$catid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('category_id_mandatory', $language_code),
					'pageno' => ($pageno + 1),
					'productCount' => $product_count,
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation;
		}
	}
}
