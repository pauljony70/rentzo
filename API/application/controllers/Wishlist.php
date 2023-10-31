<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Wishlist extends REST_Controller {
	
	protected $request_method ='post'; 
	
		 
	 public function __construct() { 
        parent::__construct();
                
        // Load the Wishlist model
        $this->load->model('wishlist_model');
    }
	public function index_get()
	{
		$this->responses(1,'Server OK');
	}
	
	public function addProductWishlist_post(){
		$requiredparameters = array('language','pid','sku','sid','user_id','qty','referid','devicetype');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$sku = removeSpecialCharacters($this->post('sku'));
		$sid = removeSpecialCharacters($this->post('sid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$qty = removeSpecialCharacters($this->post('qty'));
		$referid = removeSpecialCharacters($this->post('referid'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
			if($pid && $sku && $sid && $user_id && $qty){
				$cart = $this->wishlist_model->add_product_cart($pid,$sku,$sid,$user_id,$qty,$referid);
				if($cart){
					
					
					if($cart =='add'){
						$cart_detail = $this->wishlist_model->get_cart_full_details($language_code,$user_id,$devicetype);
						
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('wishlist_added',$language_code),
							$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
							'total_mrp' => $cart_detail['total_mrp'],
							'total_discount' => $cart_detail['total_discount'],
							'total_price' => $cart_detail['total_price'],
							'total_item' => $cart_detail['total_item']
							
						], self::HTTP_OK);
						
					}else if($cart =='update'){
						$cart_detail = $this->wishlist_model->get_cart_full_details($language_code,$user_id,$devicetype);
								
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('wishlist_updated',$language_code),
							$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
							'total_mrp' => $cart_detail['total_mrp'],
							'total_discount' => $cart_detail['total_discount'],
							'total_price' => $cart_detail['total_price'],
							'total_item' => $cart_detail['total_item']							
						], self::HTTP_OK);
					}
				
				}else{
					$this->responses(1,get_phrase('please_try_again',$language_code));
				}
			}else{
				
				$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('wishlist_invalid_request',$language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0
						
					], self::HTTP_OK);
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
		
	}
	
	// function for delete Wishlist product
	public function deleteProductWishlist_post(){
		$requiredparameters = array('language','pid','user_id','devicetype');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));		
		$user_id = removeSpecialCharacters($this->post('user_id'));		
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
			if($pid && $user_id){
				$cart = $this->wishlist_model->delete_product_cart($pid,$user_id);
				if($cart =='delete'){					
					$cart_detail = $this->wishlist_model->get_cart_full_details($language_code,$user_id,$devicetype);
										
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('wishlist_deleted',$language_code),
							$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
							'total_mrp' => $cart_detail['total_mrp'],
							'total_discount' => $cart_detail['total_discount'],
							'total_price' => $cart_detail['total_price'],
							'total_item' => $cart_detail['total_item']							
						], self::HTTP_OK);
				
				}else{
					
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('please_try_again',$language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0
						
					], self::HTTP_OK);
				}
			}else{
				
				$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('wishlist_invalid_request',$language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0
						
					], self::HTTP_OK);
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
	}
	
	
	// function for get Wishlist product
	public function getProductWishlist_post(){
		$requiredparameters = array('language','user_id','devicetype');
		
		$language_code = removeSpecialCharacters($this->post('language'));	
		$user_id = removeSpecialCharacters($this->post('user_id'));		
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
			if($user_id){
				$cart_detail = $this->wishlist_model->get_cart_full_details($language_code,$user_id,$devicetype);
				
				if(count($cart_detail['cart_full']) >0){						
						
					$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('wishlist_details',$language_code),
							$this->config->item('rest_data_field_name') => $cart_detail['cart_full'],
							'total_mrp' => $cart_detail['total_mrp'],
							'total_discount' => $cart_detail['total_discount'],
							'total_price' => $cart_detail['total_price'],
							'total_item' => $cart_detail['total_item']
							
						], self::HTTP_OK);
				}else{
					
				$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('wishlist_empty',$language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0
						
					], self::HTTP_OK);
				}
			}else{
				
				$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('wishlist_invalid_request',$language_code),
						$this->config->item('rest_data_field_name') => array(),
						'total_mrp' => 0,
						'total_discount' => 0,
						'total_price' => 0,
						'total_item' => 0
						
					], self::HTTP_OK);
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
	}
	
	
	// function for get cart count
	public function getWishlistCount_post(){
		$requiredparameters = array('language','user_id');
		
		$language_code = removeSpecialCharacters($this->post('language'));	
		$user_id = removeSpecialCharacters($this->post('user_id'));	
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
			if($user_id){
				$cart_detail = $this->wishlist_model->get_cart_details($user_id);
				
				if($cart_detail >0){						
						
					$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('wishlist_details',$language_code),
							$this->config->item('rest_data_field_name') => $cart_detail
							
						], self::HTTP_OK);
				}else{
				
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('wishlist_empty',$language_code),
						$this->config->item('rest_data_field_name') => $cart_detail
						
					], self::HTTP_OK);
				}
			}else{
				$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('wishlist_empty',$language_code),
						$this->config->item('rest_data_field_name') => ''
						
					], self::HTTP_OK);
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
	}

}
