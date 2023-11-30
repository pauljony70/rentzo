<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class HomeController extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();
		require_once APPPATH . 'third_party/encryptfun.php';

		// Load the user model
		$this->load->model('home_model');
		$this->load->model('sellerProduct_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function getPopularProduct_post()
	{
		$requiredparameters = array('language', 'pageno', 'sortby', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby = removeSpecialCharacters($this->post('sortby'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$product_array = $this->home_model->get_popular_product_request($language_code, $pageno, $sortby, $devicetype);

			if ($product_array) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => '',
					'label' => get_phrase('popular_product', $language_code),
					'pageno' => $pageno,
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
					'label' => get_phrase('popular_product', $language_code),
					'pageno' => $pageno,
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function add_seller_product_post()
	{

		$requiredparameters = array('seller_id', 'prod_name', 'prod_name_ar', 'prod_details', 'prod_details_ar', 'prod_mrp', 'prod_price', 'brand', 'category');
		$seller_id = removeSpecialCharacters($this->post('seller_id'));
		$category = removeSpecialCharacters($this->post('category'));
		$prod_name = removeSpecialCharacters($this->post('prod_name'));
		$prod_name_ar = removeSpecialCharacters($this->post('prod_name_ar'));
		$prod_sku = removeSpecialCharacters($this->post('prod_sku'));
		$prod_url = removeSpecialCharacters($this->post('prod_url'));
		$prod_short = removeSpecialCharacters($this->post('prod_short_details'));
		$prod_short_ar = removeSpecialCharacters($this->post('prod_short_details_ar'));
		$prod_details = removeSpecialCharacters($this->post('prod_details'));
		$prod_details_ar = removeSpecialCharacters($this->post('prod_details_ar'));
		$prod_mrp = removeSpecialCharacters($this->post('prod_mrp'));
		$prod_price = removeSpecialCharacters($this->post('prod_price'));
		$selecttaxclass = 1;
		$is_wholesale_product = removeSpecialCharacters($this->post('is_wholesale_product'));
		$is_usd_price = removeSpecialCharacters($this->post('is_usd_price'));
		$affiliate_commission = removeSpecialCharacters($this->post('affiliate_commission'));
		$prod_qty = removeSpecialCharacters($this->post('prod_qty'));
		$selectstock = 'In Stock';
		$prod_hsn = '';
		$selectbrand = removeSpecialCharacters($this->post('brand'));
		$prod_youtubeid = removeSpecialCharacters($this->post('product_video_url'));
		$prod_status = 0;
		$selectvisibility = 1;
		$selectcountry = 1;
		$prod_purchase_lmt = 10;
		$selectseller = $seller_id;
		$return_policy = 0;
		$prod_remark = '';
		$is_heavy = 0;
		$prod_name_ar = '';
		$prod_short_ar = '';
		$prod_details_ar = '';
		$selectrelatedprod = '';
		$selectupsell = '';
		$invalid_response = array("status" => "", "seller_id" => "");

		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			$add_product = $this->sellerProduct_model->add_seller_product($seller_id, $category, $prod_name, $prod_name_ar, $prod_sku, $prod_url, $prod_short, $prod_short_ar, $prod_details, $prod_details_ar, $prod_mrp, $prod_price, $selecttaxclass, $is_wholesale_product, $is_usd_price, $affiliate_commission, $prod_qty, $selectstock, $prod_hsn, $prod_purchase_lmt, $selectbrand, $selectseller, $return_policy, $prod_remark, $prod_youtubeid, $is_heavy, $selectrelatedprod, $selectupsell, $prod_status, $selectvisibility, $selectcountry);
			if ($add_product) {
				if ($add_product['status'] == 1) {
					$this->responses(1, 'Add Product successfully', $add_product);
				} else if ($add_product['status'] == 'exist') {
					$this->responses(0, 'Product already exist', $invalid_response);
				} else {
					$this->responses(0, 'user status disabled', $invalid_response);
				}
			} else {
				$this->responses(0, 'invalid_request', $invalid_response);
			}
		}
	}

	public function update_seller_product_post()
	{

		$requiredparameters = array('seller_id', 'product_id', 'prod_name', 'prod_details', 'prod_mrp', 'prod_price', 'brand', 'category', 'prod_active');

		$category = removeSpecialCharacters($this->post('category'));
		$seller_id = removeSpecialCharacters($this->post('seller_id'));
		$product_id = removeSpecialCharacters($this->post('product_id'));
		$prod_name = removeSpecialCharacters($this->post('prod_name'));
		$prod_details = removeSpecialCharacters($this->post('prod_details'));
		$prod_mrp = removeSpecialCharacters($this->post('prod_mrp'));
		$prod_price = removeSpecialCharacters($this->post('prod_price'));
		$selectbrand = removeSpecialCharacters($this->post('brand'));
		$prod_active = removeSpecialCharacters($this->post('prod_active'));


		$product_video_url = removeSpecialCharacters($this->post('product_video_url'));
		$in_stock = removeSpecialCharacters($this->post('in_stock'));
		$prod_qty = removeSpecialCharacters($this->post('prod_qty'));

		$invalid_response = array("status" => "", "seller_id" => "");


		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			/*if($seller_id && $prod_name && $prod_details && $prod_mrp && $prod_price && $brand && $category){*/

			$validate_user = $this->sellerProduct_model->update_seller_product($seller_id, $product_id, $prod_name, $prod_details, $prod_active, $prod_mrp, $prod_price, $selectbrand, $category, $product_video_url, $in_stock, $prod_qty, $_FILES);
			if ($validate_user) {
				if ($validate_user['status'] == 1) {
					$this->responses(1, 'Update Product successfully', $validate_user);
				} else if ($validate_user['status'] == 'notexist') {
					$this->responses(0, 'Product Not exist', $invalid_response);
				} else {
					$this->responses(0, 'user status disabled', $invalid_response);
				}
			} else {
				$this->responses(0, 'invalid_request', $invalid_response);
			}
		}
	}

	public function login_post()
	{
		$requiredparameters = array('email', 'password');
		$email  = removeSpecialCharacters($this->post('email'));
		$user_password  = removeSpecialCharacters($this->post('password'));
		$publickey_server = $this->config->item("encryption_key");
		$encruptfun = new encryptfun();
		$encryptedpassword = $encruptfun->encrypt($publickey_server, $this->post('password'));
		$user_password  = $encryptedpassword;
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		$invalid_response = array("user_id" => "", "name" => "", "phone" => "", "email" => "", "status" => "");
		if ($validation == 'valid') {
			if (!$email) {
				$this->responses(0, 'Email Mandatory', $invalid_response);
			} else if (!$user_password) {
				$this->responses(0, 'Password Mandatory', $invalid_response);
			} else if ($email && $user_password) {
				$validate_user = $this->sellerProduct_model->validate_user_login($email, $user_password);
				if ($validate_user) {
					if ($validate_user['status'] == 1) {
						$this->responses(1, 'Login sucessfully', $validate_user);
					} else if ($validate_user['status'] == 'not_exist') {
						$this->responses(0, 'seller not exist', $invalid_response);
					} else {
						$this->responses(0, 'seller status disabled', $invalid_response);
					}
				} else {
					$this->responses(0, 'invalid request', $invalid_response);
				}
			} else {
				$this->responses(0, 'invalid_request', $invalid_response);
			}
		} else {
			echo $validation;
		}
	}

	public function home_top_category_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$city_array = $this->home_model->home_top_category_request($language_code);
			if (count($city_array) > 0) {

				$this->responses(1, 'Shop Our Top Categories', $city_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $city_array);
			}
		} else {
			echo $validation;
		}
	}

	public function getTopNotifications_post()
	{
		$requiredparameters = array('language');
		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());
		if ($validation == 'valid') {
			$notifications = $this->home_model->getTopNotifications($language_code);
			if (count($notifications) > 0) {
				$this->responses(1, 'Get top notifications succesfully', $notifications);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code), $notifications);
			}
		} else {
			echo $validation;
		}
	}

	function get_address_post()
	{
		$requiredparameters = array('language', 'pincode');
		$language_code = removeSpecialCharacters($this->post('language'));
		$address_pincode = removeSpecialCharacters($this->post('pincode'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			$data = file_get_contents('http://www.postalpincode.in/api/pincode/' . $address_pincode);
			$data = json_decode($data);
			if (isset($data->PostOffice['0'])) {

				$citydata = array(
					'city'  => $data->PostOffice['0']->Taluk,
				);
				$this->responses(1, 'Get city succesfully', $citydata);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code));
			}
		} else {
			echo $validation;
		}
	}

	public function check_pincode_post()
	{

		$requiredparameters = array('language', 'pincode');

		$language_code = removeSpecialCharacters($this->post('language'));
		$check_pincode = removeSpecialCharacters($this->post('pincode'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$city_array = $this->home_model->get_check_pincode_request($language_code, $check_pincode);
			if (count($city_array) > 0) {

				$this->responses(1, 'Check Delivery Status', $city_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $city_array);
			}
		} else {
			echo $validation;
		}
	}
	
	public function rent_product_dates_post()
	{

		$requiredparameters = array('language', 'prod_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$prod_id = removeSpecialCharacters($this->post('prod_id'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$rent_array = $this->home_model->get_rents_data_request($prod_id);
			if (count($rent_array) > 0) {

				$this->responses(1, 'Details', $rent_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $rent_array);
			}
		} else {
			echo $validation;
		}
	}


	public function home_all_data_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		$main_array = array();
		if ($validation == 'valid') {

			$top_slider_array = $this->home_model->get_header_banner_request('section1', '1920-680');
			$main_array[0] = [
				'index' => '1',
				'label' => 'Top Slider',
				'data_banner' => $top_slider_array,
				'data_product' => array()

			];

			$top_banner_array = $this->home_model->get_header_banner_request('section6', '1900-320');

			$main_array[1] = [
				'index' => '2',
				'label' => 'Top Banner',
				'data_banner' => $top_banner_array,
				'data_product' => array()

			];

			$today_deals_array = $this->home_model->get_home_products($language_code, 'New');

			$main_array[2] = [
				'index' => '3',
				'label' => "Today's Deal",
				'data_banner' => array(),
				'data_product' => $today_deals_array

			];

			$top_selling_banner_array = $this->home_model->get_header_banner_request('section4', '1930-150');

			$main_array[3] = [
				'index' => '4',
				'label' => "Top Selling Banner",
				'data_banner' => $top_selling_banner_array,
				'data_product' => array()

			];

			$top_selling_product_array = $this->home_model->get_home_products($language_code, 'Popular');

			$main_array[4] = [
				'index' => '5',
				'label' => "Top Selling Products",
				'data_banner' => array(),
				'data_product' => $top_selling_product_array

			];

			$trendind_banner_array = $this->home_model->get_header_banner_request('section10', '1900-320');

			$main_array[5] = [
				'index' => '6',
				'label' => "Trending Products Banner",
				'data_banner' => $trendind_banner_array,
				'data_product' => array()

			];

			$this->responses(1, 'All data', $main_array);
		} else {
			echo $validation;
		}
	}

	public function home_all_data2_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		$main_array = array();
		if ($validation == 'valid') {


			$trending_products_array = $this->home_model->get_home_products($language_code, 'Recommended');
			$main_array[0] = [
				'index' => '1',
				'label' => "Trending Products",
				'data_banner' => array(),
				'data_product' => $trending_products_array
			];

			$three_banner_array = $this->home_model->get_header_banner_request('section8', '610-400');
			$main_array[1] = [
				'index' => '2',
				'label' => '1*2 Banner',
				'data_banner' => $three_banner_array,
				'data_product' => array()

			];

			$like_array = $this->home_model->get_home_products($language_code, 'Offers');
			$main_array[2] = [
				'index' => '3',
				'label' => "You May Like Products",
				'data_banner' => array(),
				'data_product' => $like_array
			];

			$populor_array = $this->home_model->get_header_banner_request('section11', '1900-320');
			$main_array[3] = [
				'index' => '4',
				'label' => 'Most Popular Banner',
				'data_banner' => $populor_array,
				'data_product' => array()
			];

			$populor_products_array = $this->home_model->get_home_products($language_code, 'Most');
			$main_array[4] = [
				'index' => '5',
				'label' => "Most Popular Products",
				'data_banner' => array(),
				'data_product' => $populor_products_array
			];

			$custom_array = $this->home_model->get_header_banner_request('section12', '1900-320');
			$main_array[5] = [
				'index' => '6',
				'label' => 'Customize Your Clothing Banner',
				'data_banner' => $custom_array,
				'data_product' => array()
			];

			$custom_product_array = $this->home_model->get_home_products($language_code, 'Custom');
			$main_array[6] = [
				'index' => '7',
				'label' => "Customize Your Clothing Products",
				'data_banner' => array(),
				'data_product' => $custom_product_array
			];


			$this->responses(1, 'All data 2', $main_array);
		} else {
			echo $validation;
		}
	}

	public function home_top_slider_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$city_array = $this->home_model->get_header_banner_request('section1', '1920-680');
			if (count($city_array) > 0) {

				$this->responses(1, 'Top Slider', $city_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $city_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_top_banner_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$city_array = $this->home_model->get_header_banner_request('section6', '1900-320');
			if (count($city_array) > 0) {

				$this->responses(1, 'Top Banner', $city_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $city_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_today_deal_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_home_products($language_code, 'New');
			if (count($data_array) > 0) {

				$this->responses(1, "Today's Deal", $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_top_selling_banner_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_header_banner_request('section4', '1930-150');
			if (count($data_array) > 0) {

				$this->responses(1, 'Top Selling', $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_top_selling_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_home_products($language_code, 'Popular');
			if (count($data_array) > 0) {

				$this->responses(1, 'Top Selling', $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_trending_products_banner_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_header_banner_request('section10', '1900-320');
			if (count($data_array) > 0) {

				$this->responses(1, 'Trending Products', $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_trending_products_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_home_products($language_code, 'Recommended');
			if (count($data_array) > 0) {

				$this->responses(1, 'Trending Products', $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_three_banner_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_header_banner_request('section8', '610-400');
			if (count($data_array) > 0) {

				$this->responses(1, '1*2 Banner', $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_you_may_like_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_home_products($language_code, 'Offers');
			if (count($data_array) > 0) {

				$this->responses(1, 'You May Like', $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_most_populor_banner_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_header_banner_request('section11', '1900-320');
			if (count($data_array) > 0) {

				$this->responses(1, 'Most Popular', $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_most_populor_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_home_products($language_code, 'Most');
			if (count($data_array) > 0) {

				$this->responses(1, 'Most Popular', $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}


	public function home_customize_clothing_banner_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_header_banner_request('section12', '1900-320');
			if (count($data_array) > 0) {

				$this->responses(1, 'Customize Your Clothing', $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}

	public function home_customize_clothing_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));
		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$data_array = $this->home_model->get_home_products($language_code, 'Custom');
			if (count($data_array) > 0) {

				$this->responses(1, 'Customize Your Clothing', $data_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $data_array);
			}
		} else {
			echo $validation;
		}
	}

	public function customize_clothing_products_post()
	{

		$requiredparameters = array('language', 'catid', 'pageno', 'sortby', 'devicetype', 'config_attr');

		$language_code = removeSpecialCharacters($this->post('language'));
		$cat_id = removeSpecialCharacters($this->post('catid'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby = removeSpecialCharacters($this->post('sortby'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$config_attr = removeSpecialCharacters($this->post('config_attr'));


		$category_result = array();
		$category_array = $this->home_model->get_subcategory_request($language_code, $category_result, $cat_id, 1);
		$catid_array = array('10');
		if (count($category_array) > 0) {

			foreach ($category_array as $cat_ids) {
				$catid_array[] = $cat_ids['id'];
			}
		}

		$exolore_category_product = array();

		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {

			$exolore_category_product['category'] = $this->home_model->get_explore_category_request(2, $devicetype, $cat_id);
			$exolore_category_product['product'] = $this->home_model->get_category_product_request($language_code, $catid_array, $pageno, $sortby, $devicetype, $config_attr);

			if (count($exolore_category_product) > 0) {

				$this->responses(1, 'Customize Your Own Clothing', $exolore_category_product);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $exolore_category_product);
			}
		} else {
			echo $validation;
		}
	}


	public function city_list_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));


		$validation = $this->parameterValidation($requiredparameters, $this->post());



		if ($validation == 'valid') {

			$city_array = $this->home_model->city_list_request();
			if (count($city_array) > 0) {

				$this->responses(1, 'City List', $city_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $city_array);
			}
		} else {

			echo $validation;
		}
	}


	public function state_list_post()
	{

		$requiredparameters = array('language');

		$language_code = removeSpecialCharacters($this->post('language'));


		$validation = $this->parameterValidation($requiredparameters, $this->post());



		if ($validation == 'valid') {

			$city_array = $this->home_model->state_list_request();
			if (count($city_array) > 0) {

				$this->responses(1, 'State List', $city_array);
			} else {

				$this->responses(0, get_phrase('no_record_found', $language_code), $city_array);
			}
		} else {

			echo $validation;
		}
	}

	public function get_offers_post()
	{
		$requiredparameters = array('language', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			// $product_array = $this->home_model->get_offers_product_request($language_code,'Offers');
			$product_array = $this->home_model->get_home_products($language_code, 'home_bottom');

			if ($product_array) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					$this->config->item('rest_message_field_name') => '',
					'label' => 'Offers',
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('no_record_found', $language_code),
					'label' => 'Offers',
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	public function getnotification_post()
	{
		$requiredparameters = array('language', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			$seller_array = $this->home_model->getnotification_request($devicetype);

			if (count($seller_array) > 0) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					'msg' => 'Get Notification Successfully',
					$this->config->item('rest_data_field_name') => $seller_array

				], self::HTTP_OK);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code), $seller_array);
			}
		} else {
			echo $validation;
		}
	}

	public function getnotification_newpost_post()
	{
		$requiredparameters = array('language', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			$seller_array = $this->home_model->getnotification_newpost_request($devicetype);

			if (count($seller_array) > 0) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					'msg' => 'Get Notification Successfully',
					$this->config->item('rest_data_field_name') => $seller_array

				], self::HTTP_OK);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code), $seller_array);
			}
		} else {
			echo $validation;
		}
	}

	public function get_coupon_code_post()
	{
		$requiredparameters = array('language', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			$seller_array = $this->home_model->get_vendor_coupon();

			if (count($seller_array) > 0) {
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					'msg' => 'Get Offers Successfully',
					$this->config->item('rest_data_field_name') => $seller_array

				], self::HTTP_OK);
			} else {
				$this->responses(0, get_phrase('no_record_found', $language_code), $seller_array);
			}
		} else {
			echo $validation;
		}
	}

	//searh product

	public function search_post()
	{
		$requiredparameters = array('language', 'search', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$search = removeSpecialCharacters($this->post('search'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($search) {
				$product_array = $this->home_model->get_search_product_request($language_code, $search, $devicetype);

				if ($product_array) {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => '',
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
				$product_array = array();
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('search_mandotary', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function search_sponsor_post()
	{
		$requiredparameters = array('language', 'search', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$search = removeSpecialCharacters($this->post('search'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($search) {
				$product_array = $this->home_model->get_search_sponsor_product_request($language_code, $search, $devicetype);

				if ($product_array) {
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => '',
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
				$product_array = array();
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('search_mandotary', $language_code),
					$this->config->item('rest_data_field_name') => $product_array

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function get_app_update_post()
	{
		$res = array('appversion' => 3, 'date' => '17-12-2022', 'contactus' => '9856323333', 'whatsapp' => '8563254444');
		$this->response([
			$this->config->item('rest_status_field_name') => 1,
			$this->config->item('rest_message_field_name') => 'Please Update The APP',
			'forcelogout' => true,
			'logoutversion' => 3,
			$this->config->item('rest_data_field_name') => $res

		], self::HTTP_OK);
	}

	public function get_storesetting_post()
	{
		$requiredparameters = array('language', 'devicetype');

		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$user_id = removeSpecialCharacters($this->post('user_id'));


		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$seller_array = $this->home_model->get_storesetting_request($devicetype);


			if ($seller_array) {
				$seller_array = array("name" => $seller_array[0]['name'], "phone" => $seller_array[0]['phone'], "email_1" => $seller_array[0]['email_1'], "email_2" => $seller_array[0]['email_2'], "whatsapp" => '+91' . $seller_array[0]['whatsapp']);
				$this->response([
					$this->config->item('rest_status_field_name') => 1,
					'msg' => 'Get Settings Successfully',
					$this->config->item('rest_data_field_name') => $seller_array

				], self::HTTP_OK);
			} else {
				$seller_array = array("name" => '', "phone" => '', "email_1" => '', "email_2" => '', "whatsapp" => '');
				$this->responses(0, get_phrase('no_record_found', $language_code), $seller_array);
			}
		} else {
			echo $validation;
		}
	}
}
