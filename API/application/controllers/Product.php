<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Product extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the user model
		$this->load->model('product_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function getProductDetails_post()
	{
		$requiredparameters = array('language', 'pid', 'sku', 'sid', 'web_url', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$sku = removeSpecialCharacters($this->post('sku'));
		$sid = removeSpecialCharacters($this->post('sid'));
		$web_url = removeSpecialCharacters($this->post('web_url'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$user_id = removeSpecialCharacters($this->post('user_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$product_custom_cloth = $this->product_model->get_product_custom_cloth($pid);
			$product_array = $this->product_model->get_product_request($language_code, $pid, $sku, $sid, $devicetype, $user_id);

			if ($product_array) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => 'Get Details',
					$this->config->item('rest_data_field_name') => $product_array,
					'product_custom_cloth' => $product_custom_cloth

				], self::HTTP_OK);
			} else {

				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	//function for get product sort by option

	function getProductSortby_post()
	{
		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$sort_array = $this->product_model->get_product_sortby($language_code);

			if ($sort_array) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => '',
					$this->config->item('rest_data_field_name') => $sort_array

				], self::HTTP_OK);
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
					$this->config->item('rest_data_field_name') => $sort_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	//function for get product filter by option

	function getProductFilter_post()
	{
		$requiredparameters = array('language', 'catid');

		$language_code = removeSpecialCharacters($this->post('language'));
		$cat_id = removeSpecialCharacters($this->post('catid'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($cat_id) {
				$sort_array = $this->product_model->get_product_filter($cat_id);

				if ($sort_array) {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('product_filter', $language_code),
						$this->config->item('rest_data_field_name') => $sort_array

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						$this->config->item('rest_data_field_name') => $sort_array

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('category_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => array()

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	//get related_product
	public function getRelatedProductDetails_post()
	{
		$requiredparameters = array('language', 'devicetype', 'pid', 'sid');

		$language_code = removeSpecialCharacters($this->post('language'));

		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$prodid = removeSpecialCharacters($this->post('pid'));
		$sid = removeSpecialCharacters($this->post('sid'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {

			$this->db->select('product_related_prod');

			$this->db->where(array('product_id' => $prodid, 'vendor_id' => $sid));


			$query = $this->db->get('vendor_product');


			if ($query->num_rows() > 0) {
				$products_result = $query->result_object();
				$product_exp = explode(',', $products_result[0]->product_related_prod);

				$product_id = array();
				foreach ($product_exp as $pids) {
					$product_id[] = $pids;
				}



				$product_array = $this->product_model->get_popular_product_request($language_code, $devicetype, $product_id);

				if ($product_array) {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('related_product', $language_code),

						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						$this->config->item('rest_data_field_name') => $product_array
					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
					$this->config->item('rest_data_field_name') => array()
				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	//get tUpsellProductDetails
	public function getUpsellProductDetails_post()
	{
		$requiredparameters = array('language', 'devicetype', 'pid', 'sid');

		$language_code = removeSpecialCharacters($this->post('language'));

		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$prodid = removeSpecialCharacters($this->post('pid'));
		$sid = removeSpecialCharacters($this->post('sid'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {

			$this->db->select('product_upsell_prod');

			$this->db->where(array('product_id' => $prodid, 'vendor_id' => $sid));


			$query = $this->db->get('vendor_product');


			if ($query->num_rows() > 0) {
				$products_result = $query->result_object();
				$product_exp = explode(',', $products_result[0]->product_upsell_prod);

				$product_id = array();
				foreach ($product_exp as $pids) {
					if (removeSpecialCharacters($pids)) {
						$product_id[] = removeSpecialCharacters($pids);
					}
				}

				if (count($product_id) > 0) {

					$product_array = $this->product_model->get_popular_product_request($language_code, $devicetype, $product_id);

					if ($product_array) {
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('upsell_product', $language_code),

							$this->config->item('rest_data_field_name') => $product_array

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
							$this->config->item('rest_data_field_name') => $product_array
						], self::HTTP_OK);
					}
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						$this->config->item('rest_data_field_name') => array()
					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
					$this->config->item('rest_data_field_name') => array()
				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	//get configure product price
	public function getProductPrice_post()
	{
		$requiredparameters = array('language', 'sku', 'pid', 'sid', 'config_attr');

		$language_code = removeSpecialCharacters($this->post('language'));

		$sku = removeSpecialCharacters($this->post('sku'));
		$prodid = removeSpecialCharacters($this->post('pid'));
		$sid = removeSpecialCharacters($this->post('sid'));
		$config_attr = removeSpecialCharacters($this->post('config_attr'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$product_array = array("product_attr_sku" => '', "product_mrp" => "", "product_price" => "", "product_stock" => "", "totaloff" => "", "offpercent" => "", "stock_status" => "");

			if ($sku && $prodid && $sid && $config_attr) {
				$product_array = $this->product_model->get_product_price_request($sku, $prodid, $sid, $config_attr);

				if ($product_array) {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => '',

						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				} else {
					$product_array = array("product_attr_sku" => '', "product_mrp" => "", "product_price" => "", "product_stock" => "", "totaloff" => "", "offpercent" => "", "stock_status" => "");
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						$this->config->item('rest_data_field_name') => $product_array
					], self::HTTP_OK);
				}
			} else if (!$sku) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('sku_required', $language_code),
					$this->config->item('rest_data_field_name') => $product_array
				], self::HTTP_OK);
			} else if (!$prodid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_required', $language_code),
					$this->config->item('rest_data_field_name') => $product_array
				], self::HTTP_OK);
			} else if (!$sid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('vendor_id_required', $language_code),
					$this->config->item('rest_data_field_name') => $product_array
				], self::HTTP_OK);
			} else if (!$config_attr) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('congigure_attribute_required', $language_code),
					$this->config->item('rest_data_field_name') => $product_array
				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	function getProductReview_post()
	{
		$requiredparameters = array('language', 'pid', 'pageno');

		$language_code = removeSpecialCharacters($this->post('language'));

		$pid = removeSpecialCharacters($this->post('pid'));
		$pageno = removeSpecialCharacters($this->post('pageno'));


		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$product_array = $product_array1 = array('user_name' => '', 'rating' => 0, 'review_title' => '', 'review_comment' => '', 'review_date' => '');

			if ($pid) {
				$product_array = $this->product_model->get_product_review($pid, $pageno);

				if ($product_array) {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => '',
						'pageno' => $pageno,
						$this->config->item('rest_data_field_name') => $product_array

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
						'pageno' => $pageno,
						$this->config->item('rest_data_field_name') => $product_array1
					], self::HTTP_OK);
				}
			} else if (!$pid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_missing', $language_code),
					'pageno' => $pageno,
					$this->config->item('rest_data_field_name') => $product_array
				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function getWholesaleProduct_post()
	{
		$requiredparameters = array('language', 'pageno', 'sortby', 'config_attr');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby = removeSpecialCharacters($this->post('sortby'));
		$min_price = removeSpecialCharacters($this->post('min_price'));
		$max_price = removeSpecialCharacters($this->post('max_price'));
		$rating = removeSpecialCharacters($this->post('rating'));
		$config_attr = removeSpecialCharacters($this->post('config_attr'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		$product_count = 0;
		$product_array = array();
		if ($validation == 'valid') {

			$product_array = $this->product_model->get_wholesale_product_request($language_code, $pageno, $sortby, $min_price, $max_price, $rating, $config_attr);
			if ($product_array == 'invalid_filter') {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('invalid_filter', $language_code),
					'pageno' => ($pageno + 1),
					'productCount' => $product_count,
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else if ($product_array) {
				// print_r($product_array);exit;
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => '',
					'pageno' => ($pageno + 1),
					'total_pages' => $product_array['total_pages'],
					$this->config->item('rest_data_field_name') => $product_array['product_array']
				], self::HTTP_OK);

				// ], self::HTTP_OK);
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
					'pageno' => ($pageno + 1),
					'productCount' => $product_count,
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation;
		}
	}

	function getWholesaleProductFilters_post()
	{
		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));

		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$filters = $this->product_model->getWholeProductFilter();

			if ($filters) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => '',
					$this->config->item('rest_data_field_name') => [
						'product_filter' => $filters['attribute_array'],
						'price_filter' => $filters['price_filter']
					]

				], self::HTTP_OK);
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
					$this->config->item('rest_data_field_name') => ''

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
