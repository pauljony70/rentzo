<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class ProductDetail extends REST_Controller
{
	protected $request_method = 'get';
	public function __construct()
	{
		parent::__construct();

		//$recent_array = array();
		$pid = $_REQUEST['pid'];
		if (empty($this->session->userdata('recent_session'))) {
			$old_recent_session = array();
		} else {
			$old_recent_session =  $this->session->userdata('recent_session');
		}
		if (!in_array($pid, $old_recent_session)) {
			//array_push($recent_array,$pid); 
			array_push($old_recent_session, $pid);
			$this->session->set_userdata('recent_session', $old_recent_session);
		}
		//print_r($this->session->userdata('recent_session'));


	}


	public function details_get($id)
	{
		$this->load->model('product_model');
		$this->load->model('delivery_model');
		$this->load->model('address_model');
		$pid = $_REQUEST['pid'];
		$sku = $_REQUEST['sku'];
		$sid = $_REQUEST['sid'];
		$default_language = $this->session->userdata("default_language");
		$this->data['get_city'] = $this->delivery_model->get_delivery_city_request();
		$this->data['get_rents'] = $this->product_model->get_rents_data_request($pid);
		echo "<pre>";
		print_r($this->data['get_rents']);exit;
		$this->data['productdetails'] = $this->product_model->get_product_request($default_language, $pid, $sku, $sid, 1);
		if($this->data['productdetails']['product_city'] != '')
		{
			$this->data['prod_city'] = $this->product_model->get_city($this->data['productdetails']['product_city']);
		}
		if (!$this->data['productdetails']) {
			redirect('/404', 'refresh');
		}

		$this->db->select('product_related_prod');

		$this->db->where(array('product_id' => $pid, 'vendor_id' => $sid));


		$query = $this->db->get('vendor_product');


		if ($query->num_rows() > 0) {
			$products_result = $query->result_object();
			$product_exp = explode(',', $products_result[0]->product_related_prod);

			$product_id = array();
			foreach ($product_exp as $pids) {
				$product_id[] = $pids;
			}
		}

		$this->db->select('product_upsell_prod');

		$this->db->where(array('product_id' => $pid, 'vendor_id' => $sid));


		$query0 = $this->db->get('vendor_product');


		if ($query0->num_rows() > 0) {
			$products_result = $query0->result_object();
			$product_exp = explode(',', $products_result[0]->product_upsell_prod);

			$product_id_up = array();
			foreach ($product_exp as $pids) {
				/*if(removeSpecialCharacters($pids)){
					$product_id_up[] = removeSpecialCharacters($pids);
				}*/
				$product_id_up[] = $pids;
			}
		}

		$this->data['product_custom_cloth'] = $this->product_model->get_product_custom_cloth($pid);
		$this->data['product_review'] = $this->product_model->get_product_review($pid, '');
		$this->data['product_review_total'] = $this->product_model->get_product_review_total($pid);
		$this->data['related_product'] = $this->product_model->get_popular_product_request($default_language, 2, $product_id);
		$this->data['upsell_product'] = $this->product_model->get_upsell_product_request($default_language, 1, $product_id_up);
		$this->data['offers'] =  $this->db->get_where('settings', array('type' => 'offers'))->row()->description;

		$user_id = $this->session->userdata("user_id");
		$this->data['address'] = $this->address_model->get_user_address_details_full($user_id);

		$this->data['attributes'] = $this->product_model->get_product_price_request($sku, $pid, $sid, '[{"attr_id":"0","attr_name":"Weight","attr_value":"10 Kg"}]');
		//$this->data['productdetails'] = $this->product_model->get_product_attributes_details('P0b5U87ps9a','SlN82LwrPFg');
		// echo "<pre>";
		// print_r($this->data);
		// exit;

		// Get the existing IDs from the session, if any
		$recently_viewed_products = $this->session->userdata('recently_viewed_products');
		$this->data['recently_viewed_product_details'] = $this->product_model->getRecentlyViewedProductDetails($default_language, $recently_viewed_products);
		// print_r($recently_viewed_products);
		// exit;
		// If no IDs exist, initialize the array
		if (!$recently_viewed_products) {
			$recently_viewed_products = array();
		}

		if (!in_array($pid, $recently_viewed_products)) {
			// Add the new ID to the existing IDs array
			$recently_viewed_products[] = $pid;

			// Store the updated IDs array in the session
			$this->session->set_userdata('recently_viewed_products', $recently_viewed_products);
		}


		$this->load->view('website/product-details.php', $this->data);  // ye view/website folder hai
	}
	public function attr_details_get()
	{
		$this->load->model('product_model');
		$pid = $this->input->get('pid');
		$sku = $this->input->get('sku');
		$sid = $this->input->get('sid');
		$btnradio_Color = $this->input->get('btnradio_Color');
		$btnradio_Weight = $this->input->get('btnradio_Weight');
		$btnradio_Size = $this->input->get('btnradio_Size');
		$Weight_attr_id = $this->input->get('Weight_attr_id');
		$Color_attr_id = $this->input->get('Color_attr_id');
		$Size_attr_id = $this->input->get('Size_attr_id');
		$Color_attr_name = $this->input->get('Color_attr_name');
		$Weight_attr_name = $this->input->get('Weight_attr_name');
		$Size_attr_name = $this->input->get('Size_attr_name');

		$attribute_wei = array();
		$attribute_siz = array();
		$attribute_col = array();
		$product_array = array();

		if ($btnradio_Weight != '') {


			$attribute_wei['attr_id'] = $Weight_attr_id;
			$attribute_wei['attr_name'] = $Weight_attr_name;
			$attribute_wei['attr_value'] = $btnradio_Weight;
			$product_array[] = $attribute_wei;
		} else if ($btnradio_Size != '') {

			$attribute_siz['attr_id'] = $Size_attr_id;
			$attribute_siz['attr_name'] = $Size_attr_name;
			$attribute_siz['attr_value'] = $btnradio_Size;
			$product_array[] = $attribute_siz;
		} else if ($btnradio_Color != '') {

			$attribute_col['attr_id'] = $Color_attr_id;
			$attribute_col['attr_name'] = $Color_attr_name;
			$attribute_col['attr_value'] = $btnradio_Color;
			$product_array[] = $attribute_col;
		}




		$array_data = json_encode($product_array);


		//print_r($array_data);
		$response = $this->product_model->get_product_price_request($sku, $pid, $sid, $array_data);
		echo json_encode($response);
	}
}
