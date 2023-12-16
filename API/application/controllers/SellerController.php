<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class SellerController extends REST_Controller {
	
	protected $request_method ='post'; 
	
		 
	 public function __construct() { 
        parent::__construct();
                
        // Load the user model
        $this->load->model('sellerProduct_model');
        $this->load->model('home_model');
    } 
	public function index_get()
	{
		$this->responses(1,'Server OK');
	}
	
	public function delete_user_data_post(){
		$requiredparameters = array('language','devicetype','user_id');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));		
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post());
		
		$seller_product_array = array();
    	if($validation=='valid') {
			
			if($user_id){
				
				$user = $this->home_model->delete_app_user($user_id);
				if($user == 'delete'){					
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => 'Delete App User Successfully',
							$this->config->item('rest_data_field_name') => $seller_product_array
							
						], self::HTTP_OK);
					}else{
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('no_record_found',$language_code),
							$this->config->item('rest_data_field_name') => $seller_product_array
							
						], self::HTTP_OK);
			
				}
			}
			
    	}
    	else {
      		echo $validation;
    	}
	}
	
	public function getSellerDetails_post(){
		$requiredparameters = array('language','sellerid','pageno','sortby','devicetype');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$sellerid = removeSpecialCharacters($this->post('sellerid'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby = removeSpecialCharacters($this->post('sortby'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
		$seller_product_array = array('seller_details'=>array(),'seller_products'=>array());
    	if($validation=='valid') {
			if($sellerid){
				$seller_array = $this->sellerProduct_model->get_seller_request($sellerid,$devicetype);
				if($seller_array){
					$seller_product_array = array('seller_details'=>$seller_array,'seller_products'=>array());
					$product_array = $this->sellerProduct_model->get_category_product_request($language_code,$sellerid,$pageno,$sortby,$devicetype);
					
					if($product_array){
						$seller_product_array = array('seller_details'=>$seller_array,'seller_products'=>$product_array);
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => '',
							'pageno' => $pageno,
							$this->config->item('rest_data_field_name') => $seller_product_array
							
						], self::HTTP_OK);
					}else{
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('no_record_found',$language_code),
							'pageno' => $pageno,
							$this->config->item('rest_data_field_name') => $seller_product_array
							
						], self::HTTP_OK);
					}
				}else{
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('no_record_found',$language_code),
							'pageno' => $pageno,
							$this->config->item('rest_data_field_name') => $seller_product_array
							
						], self::HTTP_OK);
					}
			}else if(!$sellerid){
				$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('seller_mandatory',$language_code),
						'pageno' => $pageno,
						$this->config->item('rest_data_field_name') => $seller_product_array
						
					], self::HTTP_OK);
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
		
	}
	
	
	
  

}
