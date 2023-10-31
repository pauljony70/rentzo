<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/third_party/encryptfun.php';

class Home extends REST_Controller
{
	protected $request_method = 'get';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('categoryProduct_model');
		$this->load->model('category_model');
		$this->load->model('address_model');
		$this->load->model('delivery_model');
		$this->load->model('Brand_model');
	}

	public function thankyou_seller_get()
	{
		$this->load->view('website/thankyou_seller.php', $this->data);
	}

	public function logout_data_get()
	{
		$this->session->unset_userdata('user_id', 'user_name', 'user_phone', 'user_email');
		redirect('', 'refresh');
	}

	public function sitemap_get()
	{
		$data = "";
		$this->data['category'] = $this->home_model->all_category_request();
		$this->data['product'] = $this->home_model->all_product_request();
		header("Content-Type: text/xml;charset=iso-8859-1");
		$this->load->view('website/sitemap.php', $this->data);
	}

	public function send_whatsapp_msg_get()
	{


		$url = 'https://betablaster.in/api/send.php?number=' . $_REQUEST['number'] . '&type=' . $_REQUEST['type'] . '&message=' . $_REQUEST['message'] . '&media_url=' . $_REQUEST['media_url']  . '&filename=' . $_REQUEST['filename'] . '&instance_id=' . $_REQUEST['instance_id'] . '&access_token=' . $_REQUEST['access_token'];

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'charset: utf-8',
		));

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Error: ' . curl_error($ch);
		} else {
			echo $response;
		}

		curl_close($ch);
	}

	public function all_category_get()
	{
		$this->data['category'] = $this->home_model->get_category();
		$this->load->view('website/top_category.php', $this->data);
	}

	public function coupon_list_get()
	{
		$this->data['vendor_coupon'] = $this->home_model->get_vendor_coupon();
		$this->load->view('website/coupon_list.php', $this->data);
	}

	public function offers_get()
	{
		$this->data['offers_product'] = $this->home_model->get_home_products($default_language, 'home_bottom', '');
		$this->load->view('website/offers.php', $this->data);
	}

	public function notification_get()
	{
		$this->data['notification'] = $this->home_model->getnotification_request(1);
		$this->data['firebase_notification'] = $this->home_model->get_firebase_notification_request(1);
		$this->load->view('website/notification.php', $this->data);
	}

	public function myaddress_get()
	{
		$user_id = $this->session->userdata("user_id");
		if ($user_id) {
			$this->data['address'] = $this->address_model->get_user_address_details_full($user_id);;
			$this->data['get_country'] = $this->delivery_model->get_country();
			$this->load->view('website/manage-address.php', $this->data);
		} else {
			redirect(base_url('login'));
		}
	}

	public function sub_category_get($slug)
	{
		$this->data['title'] = $slug;
		$this->data['sub_cat'] = $this->home_model->sub_category($this->default_language, 2, $slug);
		$this->load->view('website/sub_category.php', $this->data);
	}

	public function explore_sub_get($cat_id)
	{
		$category_result = array();
		$category_array = $this->home_model->get_subcategory_request(2, $category_result, $cat_id, 1);
		$catid_array = array('10');
		if (count($category_array) > 0) {

			foreach ($category_array as $cat_ids) {
				$catid_array[] = $cat_ids['id'];
			}
		}
		$this->data['exolore_category_product'] = $this->categoryProduct_model->get_category_product_request(2, $catid_array, 0, 1, 1, '');
		$this->data['exolore_category'] = $this->home_model->get_explore_category_request(2, $devicetype, $cat_id);
		$this->load->view('website/customize-clothing.php', $this->data);
	}

	public function explore_get()
	{
		$category_result = array();
		$category_array = $this->home_model->get_subcategory_request(2, $category_result, 10, 1);
		$catid_array = array('10');
		if (count($category_array) > 0) {

			foreach ($category_array as $cat_ids) {
				$catid_array[] = $cat_ids['id'];
			}
		}
		$this->data['category'] = $this->home_model->get_explore_category();
		$this->data['exolore_category'] = $this->home_model->get_explore_category_request(2, $devicetype, 10);
		$this->data['exolore_category_product'] = $this->categoryProduct_model->get_category_product_request(2, $catid_array, 0, 1, 1, '');
		$this->load->view('website/explore.php', $this->data);
	}

	public function track_order_get()
	{
		$this->load->view('website/track.php', $this->data);
	}

	public function personal_info_get()
	{
		$this->load->view('website/personal_info.php', $this->data);
	}

	public function register_get()
	{
		$this->load->view('website/register.php', $this->data);  // ye view/website folder hai
	}

	public function search_data_get($search)
	{
		$default_language = $this->session->userdata("default_language");
		$src = $_REQUEST['search'];
		$this->data['search_title'] = $src;
		$this->data['search'] = $this->home_model->get_search_product_request($default_language, $src, 2);
		$this->data['search_sponsor'] = $this->home_model->get_search_sponsor_product_request($default_language, $src, 2);
		$this->load->view('website/search.php', $this->data);
	}

	public function get_search_products_get()
	{
		$default_language = $this->session->userdata("default_language");
		$src = $this->input->get('search');
		$response = $this->home_model->get_search_product_request($default_language, $src, 2);
		echo json_encode($response);
	}

	public function cart_details_get()
	{
		$default_language = $this->session->userdata("default_language");
		$qoute_id = $this->session->userdata("qoute_id");
		$user_id = $this->session->userdata("user_id");
		if ($user_id) {
			$this->load->model('cart_model');
			$this->data['cart'] = $this->cart_model->get_cart_full_details($default_language, $user_id, 1, $qoute_id, '');
			$this->load->view('website/cart.php', $this->data);
		} else {
			redirect(base_url('login'));
		}
	}

	public function privacy_get()
	{
		$this->data['page_content'] = $this->home_model->get_privacy_data_request();
		$this->load->view('website/privacy.php', $this->data);
	}

	public function refund_get()
	{
		$this->data['page_content'] = $this->home_model->get_refund_data_request();
		$this->load->view('website/refund.php', $this->data);
	}

	public function about_get()
	{
		$this->data['page_content'] = $this->home_model->get_aboutus_data_request();
		$this->load->view('website/about.php', $this->data);
	}

	public function faq_get()
	{
		$this->data['page_content'] = $this->home_model->get_faq_data_request();
		$this->load->view('website/faq.php', $this->data);
	}

	public function free_shipping_get()
	{
		$this->data['page_content'] = $this->home_model->get_free_shipping_data_request();
		$this->load->view('website/free_shipping.php', $this->data);
	}

	public function feedback_get()
	{
		$this->data['page_content'] = $this->home_model->get_feedback_data_request();
		$this->load->view('website/feedback.php', $this->data);
	}

	public function help_get()
	{
		$this->data['page_content'] = $this->home_model->get_help_data_request();
		$this->load->view('website/help.php', $this->data);
	}


	public function contact_get()
	{
		$this->data['page_content'] = $this->home_model->get_contact_data_request();
		$this->load->view('website/contact.php', $this->data);
	}

	public function tearm_get()
	{
		$this->data['page_content'] = $this->home_model->get_term_data_request();
		$this->load->view('website/termsandcon.php', $this->data);
	}

	public function error_get()
	{
		$this->load->view('website/404.php', $this->data);
	}


	public function index_get()
	{

		// $default_language = $this->session->userdata("default_language");
		// $this->data['header_banner'] = $this->home_model->get_header_banner_request('section1', '1920-680');
		// $this->data['deals_banners'] = $this->home_model->get_header_banner_request('section_four_banner', '200-200');
		// $this->data['home_section2'] = $this->home_model->get_home_section2_request('section2');
		// $this->data['home_section4'] = $this->home_model->get_header_banner_request('section4', '1930-150');
		// $this->data['home_section10'] = $this->home_model->get_header_banner_request('section10', '1900-320');
		// $this->data['home_section11'] = $this->home_model->get_header_banner_request('section11', '1900-320');
		// $this->data['home_section12'] = $this->home_model->get_header_banner_request('section12', '1900-320');
		// $this->data['home_section5'] = $this->home_model->get_header_section5_request('section5');
		// $this->data['home_section6'] = $this->home_model->get_header_banner_request('section6', '1900-320');
		// $this->data['home_bottom_banner'] = $this->home_model->get_header_banner_request('section8', '610-400');
		// $this->data['offers_product'] = $this->home_model->get_home_products($default_language, 'Offers', '');
		// $this->data['brands'] = $this->Brand_model->getTopBrands($default_language, '1');
		// $this->data['category'] = $this->home_model->get_category();


		$this->load->view('website/comming-soon.php', $this->data);
	}


	public function home_page_get()
	{

		// $this->data['header_banner'] = $this->home_model->get_header_banner_request('section1', '1920-680');
		// $this->data['home_section2'] = $this->home_model->get_home_section2_request('section2');
		// $this->data['home_section4'] = $this->home_model->get_header_banner_request('section4', '1930-150');
		// $this->data['home_section10'] = $this->home_model->get_header_banner_request('section10', '1900-320');
		// $this->data['home_section11'] = $this->home_model->get_header_banner_request('section11', '1900-320');
		// $this->data['home_section12'] = $this->home_model->get_header_banner_request('section12', '1900-320');
		// $this->data['home_section5'] = $this->home_model->get_header_section5_request('section5');
		// $this->data['home_section6'] = $this->home_model->get_header_banner_request('section6', '1900-320');
		// $this->data['home_bottom_banner'] = $this->home_model->get_header_banner_request('section8', '610-400');

		// $default_language = $this->session->userdata("default_language");
		// $this->data['new_product'] = $this->home_model->get_home_products($default_language, 'New');
		// $this->data['popular_product'] = $this->home_model->get_home_products($default_language, 'Popular');
		// $this->data['recommended_product'] = $this->home_model->get_home_products($default_language, 'Recommended');
		// $this->data['offers_product'] = $this->home_model->get_home_products($default_language, 'Offers');
		// $this->data['most_product'] = $this->home_model->get_home_products($default_language, 'Most');
		// $this->data['custom_product'] = $this->home_model->get_home_products($default_language, 'Custom');
		// $this->data['home_bottom_product'] = $this->home_model->get_home_products($default_language, 'home_bottom');
		// $this->data['category'] = $this->home_model->get_category();


		// $this->load->view('website/home.php', $this->data);
		$default_language = $this->session->userdata("default_language");
		$this->data['header_banner'] = $this->home_model->get_header_banner_request('section1', '1920-680');
		$this->data['deals_banners'] = $this->home_model->get_header_banner_request('section_four_banner', '200-200');
		$this->data['home_section2'] = $this->home_model->get_home_section2_request('section2');
		$this->data['home_section4'] = $this->home_model->get_header_banner_request('section4', '1930-150');
		$this->data['home_section10'] = $this->home_model->get_header_banner_request('section10', '1900-320');
		$this->data['home_section11'] = $this->home_model->get_header_banner_request('section11', '1900-320');
		$this->data['home_section12'] = $this->home_model->get_header_banner_request('section12', '1900-320');
		$this->data['home_section5'] = $this->home_model->get_header_section5_request('section5');
		$this->data['home_section6'] = $this->home_model->get_header_banner_request('section6', '1900-320');
		$this->data['home_bottom_banner'] = $this->home_model->get_header_banner_request('section8', '610-400');
		$this->data['offers_product'] = $this->home_model->get_home_products($default_language, 'Offers', '');
		$this->data['brands'] = $this->Brand_model->getTopBrands($default_language, '1');
		$this->data['category'] = $this->home_model->get_category();


		$this->load->view('website/index.php', $this->data);
	}

	function get_home_products_get()
	{
		$type = $this->input->get('type');
		$timezone = $this->input->get('timezone');
		$default_language = $this->session->userdata("default_language");
		$response = $this->home_model->get_home_products($default_language, $type, $timezone);

		echo json_encode($response);
	}
	function get_home_cat_products_get()
	{
		$type = $this->input->get('type');
		$default_language = $this->session->userdata("default_language");
		$response = $this->home_model->get_home_cat_products($default_language, $type);

		echo json_encode($response);
	}
	function get_home_bottom_banner_get()
	{

		$response = $this->home_model->get_header_banner_request('section8', '610-400');

		echo json_encode($response);
	}


	function checkpincode_get()
	{

		$pincode = $this->input->get('pincode');

		$data_response = 'Item is not deliverable for selected Pincode';

		$curl1 = curl_init();
		curl_setopt_array($curl1, array(
			CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
									"email" : "marurangecommerce@gmail.com",
									"password" : "Borawar@739"				
								}',
			CURLOPT_HTTPHEADER => array(
				'content-type: application/json'
			),
		));
		$response1 = curl_exec($curl1);
		curl_close($curl1);
		$token_data = json_decode($response1);
		$token = $token_data->data;



		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Token ' . $token
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$response_pincode = json_decode($response);
		foreach ($response_pincode->data as $pin_data) {
			if ($pin_data->pincode == $pincode) {
				$data_response = 'Yeah ! Delivery available at your area';
			}
		}



		echo $data_response;
	}

	function get_home_small_banner_get()
	{

		$type = $this->input->get('type');
		$size = $this->input->get('size');
		$response = $this->home_model->get_header_banner_request($type, $size);

		echo json_encode($response);
	}


	function delete_cart()
	{

		$prod_id = $this->input->get('prod_id');
		$user_id = $this->input->get('user_id');
		$qouteid = $this->input->get('qouteid');
		$response = $this->home_model->delete_product_cart($prod_id, $user_id, $qouteid);

		echo json_encode($response);
	}

	public function cart_count_get()
	{
		$this->load->model('cart_model');
		$qoute_id = $this->session->userdata("qoute_id");
		$user_id = $this->session->userdata("user_id");

		$response = $this->cart_model->get_cart_full_details($this->session->userdata("default_language"), $user_id, 1, $qoute_id);

		echo json_encode($response['total_item']);
	}

	public function set_language_get()
	{
		$lang_Val = $this->input->get('lang_Val');
		$newdata = array(
			'default_language'  => $lang_Val,
			'logged_in' => TRUE
		);
		$set_data = $this->session->set_userdata($newdata);
	}

	public function wishlist_count_get()
	{
		$this->load->model('wishlist_model');
		$qoute_id = $this->session->userdata("qoute_id");
		$user_id = $this->session->userdata("user_id");

		$response = $this->wishlist_model->get_cart_full_details($this->session->userdata("default_language"), $user_id, 2, '', '');
		echo json_encode($response['total_item']);
	}

	public function bankDetails_get()
	{
		// Get the bank details from the model
		$this->data['bank_details'] = $this->home_model->get_bank_details();
		$this->load->view('website/bank_details.php', $this->data);
	}

	public function addBankDetails_post()
	{
		$this->load->library('form_validation');

		// Define validation rules
		$this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'required');
		$this->form_validation->set_rules('account_number', 'Account Number', 'trim|required');
		$this->form_validation->set_rules('confirm_account_number', 'Confirm Account Number', 'trim|required|callback_check_account_match');
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
		$this->form_validation->set_rules('bank_address', 'Bank Address', 'required');

		// Define a custom validation callback function
		$this->form_validation->set_message('check_account_match', 'The Account Number and Confirm Account Number do not match.');
		if ($this->form_validation->run() == FALSE) {
			// Form validation failed, get the validation errors
			$validation_errors = validation_errors();

			// Pass the errors to the view
			$this->data['validation_errors'] = $validation_errors;

			// Form validation failed, show the form again with errors
			$this->data['bank_details'] = $this->home_model->get_bank_details();
			$this->load->view('website/bank_details', $this->data);
		} else {
			// Form validation passed, insert data into the database
			$publickey_server = $this->config->item("encryption_key");
			$encruptfun = new encryptfun();
			$data = array(
				'account_holder_name' => $this->input->post('account_holder_name'),
				'account_number' => $encruptfun->encrypt($publickey_server, $this->input->post('account_number')),
				'bank_name' => $this->input->post('bank_name'),
				'bank_address' => $this->input->post('bank_address'),
				'user_id' => $this->session->userdata('user_id')
			);

			// Load the database library
			$this->load->database();

			// Insert data into the bank_details table
			$bank_details = $this->home_model->get_bank_details();

			if (empty($bank_details)) {
				$this->db->insert('bank_details', $data);
			} else {
				$this->db->update('bank_details', $data, ['id' => $bank_details['id']]);
			}

			// Redirect to a success page or perform any other actions as needed
			redirect('bank-details');
		}
	}

	public function check_account_match($confirm_account_number)
	{
		$account_number = $this->input->post('account_number');

		// Check if the account numbers match
		if ($account_number !== $confirm_account_number) {
			return FALSE;
		}
		return TRUE;
	}
}
