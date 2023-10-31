<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class DeliveryAuthController extends REST_Controller {
	
	protected $request_method ='post'; 
	
		 
	 public function __construct() { 
        parent::__construct();
       require_once APPPATH.'third_party/encryptfun.php';
       
        // Load the user model
        $this->load->model('sms_model');
        $this->load->model('delivery_boy_model');
        $this->load->model('checkout_model');
    }
	public function index_get()
	{
		//$this->load->view('welcome_message');
	}
	
	public function login_post(){
		$requiredparameters = array('language','phone','user_password');
		
		$language_code = removeSpecialCharacters($this->post('language'));
	 	$mobile_number  = removeSpecialCharacters($this->post('phone'));
	 	$user_password  = removeSpecialCharacters($this->post('user_password'));
	 	
		$publickey_server = $this->config->item("encryption_key");
        $encruptfun = new encryptfun();
        $encryptedpassword = $encruptfun->encrypt($publickey_server, $this->post('user_password'));
		$user_password  = $encryptedpassword;
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		$invalid_response = array( "id"=> "","user_unique_id"=> "","fullname"=> "", "address"=> "", "city"=> "","pincode"=> "", "state"=> "", "country"=> "",
                                "region"=> "", "phone"=> "", "email"=> "", "password"=> "", "profile_pic"=> "", "status"=> "","flagid"=> "","create_by"=> "",
        "update_by"=> "");
    	if($validation=='valid') {
			if(!$mobile_number){
				$this->responses(0,get_phrase('mobile_mandatory',$language_code),$invalid_response);
			}else if(!$user_password){
				$this->responses(0,get_phrase('user_password_mandatory',$language_code));
			}else if(is_numeric($mobile_number) && $user_password){
				$validate_user = $this->delivery_boy_model->validate_user_login($mobile_number,$user_password);
				if($validate_user){
					if($validate_user['status'] ==1){
						$this->responses(1,get_phrase('login_successfully',$language_code),$validate_user);
					}else if($validate_user['status'] =='not_exist'){
						$this->responses(0,get_phrase('user_not_exist',$language_code),$invalid_response);
					}else{
						$this->responses(0,get_phrase('user_status_disabled',$language_code),$invalid_response);
					}
					
				}else{
					$this->responses(0,get_phrase('invalid_request',$language_code),$invalid_response);
				}
			}else{
				$this->responses(0,get_phrase('invalid_request',$language_code),$invalid_response);
			}
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
	}
	
	public function delivery_boy_token_post(){
	    $requiredparameters = array('language','user_id','token','add_date');
		
		$language_code = removeSpecialCharacters($this->post('language'));
	 	$user_id  = removeSpecialCharacters($this->post('user_id'));
	 	$token  = removeSpecialCharacters($this->post('token'));
	 	$add_date  = removeSpecialCharacters($this->post('add_date'));
	 	
		$review_array = array();
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		if($validation=='valid') {
			      		
			if($user_id){
				$review_array = $this->delivery_boy_model->delivery_boy_token($user_id,$token,$add_date);
				if($review_array['status'] == '1'){
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => 'Update Token Successfully',	
							$this->config->item('rest_data_field_name') => $review_array
							
						], self::HTTP_OK);
					}else{
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('no_record_found',$language_code),							
							$this->config->item('rest_data_field_name') => $review_array							
						], self::HTTP_OK);
					}
			}else{
				$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('user_id_missing',$language_code),					
							$this->config->item('rest_data_field_name') => $review_array							
						], self::HTTP_OK);
			}
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
	}

	public function getUserProfile_post(){
	    $requiredparameters = array('language','user_id');
		
		$language_code = removeSpecialCharacters($this->post('language'));
	 	$user_id  = removeSpecialCharacters($this->post('user_id'));
	 	
		$review_array = array();
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		if($validation=='valid') {
			      		
			if($user_id){
				$review_array = $this->delivery_boy_model->get_user_profile($user_id);
				if($review_array){
						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => '',	
							$this->config->item('rest_data_field_name') => $review_array
							
						], self::HTTP_OK);
					}else{
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('no_record_found',$language_code),							
							$this->config->item('rest_data_field_name') => $review_array							
						], self::HTTP_OK);
					}
			}else{
				$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('user_id_missing',$language_code),					
							$this->config->item('rest_data_field_name') => $review_array							
						], self::HTTP_OK);
			}
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
	}
	
	public function get_delivery_status_post()
	{
		$status_array = array(array('name'=>'Placed'),array('name'=>'Packed'),array('name'=>'Shipped'),array('name'=>'Delivered'),array('name'=>'Cancelled'),array('name'=>'Return Request'),array('name'=>'Returned Completed')); 
		$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => 'Get Delivery Status',
							$this->config->item('rest_data_field_name') => $status_array], self::HTTP_OK);
	}
	
	public function getOrder_sortby_post(){
		$requiredparameters = array('language','user_id','date','status','pageno');
		
		$language_code = removeSpecialCharacters($this->post('language'));	
		$user_id = removeSpecialCharacters($this->post('user_id'));	
		$sort_date = removeSpecialCharacters($this->post('date'));	
		$sort_status = removeSpecialCharacters($this->post('status'));	
		$pageno = removeSpecialCharacters($this->post('pageno'));	
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
			
			
			if($user_id){
				$order_detail = $this->delivery_boy_model->get_order_list_details_sortby($user_id,$sort_date,$sort_status,$pageno);
				///print_r($order_detail['total_orders']);
				if($order_detail['total_orders'] > 0){	
					$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('order_details',$language_code),
							'total_orders'=>$order_detail['total_orders'],
							'pending_order'=>$order_detail['pending_order'],
							'delivered_order'=>$order_detail['delivered_order'],
							'returned_pickup_order'=>$order_detail['returned_pickup_order'],
							$this->config->item('rest_data_field_name') => $order_detail['order_details']
							
						], self::HTTP_OK);
				}else{
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('no_order_found',$language_code),
							'total_orders'=>0,
							'pending_order'=>0,
							'delivered_order'=>0,
							'returned_pickup_order'=>0,
							$this->config->item('rest_data_field_name') => array()
							
						], self::HTTP_OK);
				}
		
			}else{				
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory',$language_code),
							'total_orders'=>0,
							'pending_order'=>0,
							'delivered_order'=>0,
							'returned_pickup_order'=>0,
							$this->config->item('rest_data_field_name') =>array()
							
						], self::HTTP_OK);
			}
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
	}
  
	public function getOrder_post(){
		$requiredparameters = array('language','user_id');
		
		$language_code = removeSpecialCharacters($this->post('language'));	
		$user_id = removeSpecialCharacters($this->post('user_id'));	
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
			if($user_id){
				$order_detail = $this->delivery_boy_model->get_order_list_details($user_id);
				///print_r($order_detail['total_orders']);
				if($order_detail['total_orders'] > 0){	
					$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('order_details',$language_code),
							'total_orders'=>$order_detail['total_orders'],
							'pending_order'=>$order_detail['pending_order'],
							'delivered_order'=>$order_detail['delivered_order'],
							'returned_pickup_order'=>$order_detail['returned_pickup_order'],
							$this->config->item('rest_data_field_name') => $order_detail['order_details']
							
						], self::HTTP_OK);
				}else{
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('order_empty',$language_code),
							'total_orders'=>0,
							'pending_order'=>0,
							'delivered_order'=>0,
							'returned_pickup_order'=>0,
							$this->config->item('rest_data_field_name') => array()
							
						], self::HTTP_OK);
				}
		
			}else{				
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory',$language_code),
							'total_orders'=>0,
							'pending_order'=>0,
							'delivered_order'=>0,
							'returned_pickup_order'=>0,
							$this->config->item('rest_data_field_name') =>array()
							
						], self::HTTP_OK);
			}
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
	}
	
	public function search_order_list_post(){
		$requiredparameters = array('language','search');
		
		$language_code = removeSpecialCharacters($this->post('language'));	
		$search = removeSpecialCharacters($this->post('search'));	
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
			if($search != ''){
				$order_detail = $this->delivery_boy_model->get_search_order_list_details($search);
				//print_r($order_detail['total_orders']);
				if($order_detail['total_orders'] > 0){	
					$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('order_details',$language_code),
							'total_orders'=>$order_detail['total_orders'],
							'pending_order'=>$order_detail['pending_order'],
							'delivered_order'=>$order_detail['delivered_order'],
							'returned_pickup_order'=>$order_detail['returned_pickup_order'],
							$this->config->item('rest_data_field_name') => $order_detail['order_details']
							
						], self::HTTP_OK);
				}else{
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('no_order_found',$language_code),
							'total_orders'=>0,
							'pending_order'=>0,
							'delivered_order'=>0,
							'returned_pickup_order'=>0,
							$this->config->item('rest_data_field_name') => array()
							
						], self::HTTP_OK);
				}
		
			}
			else {				
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('search_mandotary',$language_code),							
							'total_orders'=>0,
							'pending_order'=>0,
							'delivered_order'=>0,
							'returned_pickup_order'=>0,
							$this->config->item('rest_data_field_name') => array()
							
						], self::HTTP_OK);
			}
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
	}
	
	
	public function UpdateOrderStatus_post(){
	
		$requiredparameters = array('language','user_id','order_id','prod_id','status');
		
		$language_code = removeSpecialCharacters($this->post('language'));	
		$user_id = removeSpecialCharacters($this->post('user_id'));	
		$order_id = removeSpecialCharacters($this->post('order_id'));	
		$prod_id = removeSpecialCharacters($this->post('prod_id'));	
		$status = removeSpecialCharacters($this->post('status'));	
		$otp = '';//removeSpecialCharacters($this->post('otp'));	
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		$invalid_response = array('order_id'=>$order_id,'otp'=>'');
    	if($validation=='valid') {
			if($user_id && $order_id && $prod_id && $status){
				$user_detail =  $this->delivery_boy_model->get_user_profile($user_id);
				
				if($user_detail){
					$validate_order =  $this->delivery_boy_model->validate_order($user_id,$order_id , $prod_id);	
					
					if($validate_order =='exist'){
						$update_order =  $this->checkout_model->update_order_by_delivery_boy($user_id,$order_id , $prod_id,$status,$otp);
						$this->response([
								$this->config->item('rest_status_field_name') => 1,
								$this->config->item('rest_message_field_name') => get_phrase('order_details',$language_code),								
								$this->config->item('rest_data_field_name') => $update_order
								
							], self::HTTP_OK);
					}else{
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('invalid_order',$language_code),							
							$this->config->item('rest_data_field_name') => $invalid_response
							
						], self::HTTP_OK);
					}
				}else{
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('invalid_delivery_boy',$language_code),							
							$this->config->item('rest_data_field_name') => $invalid_response
							
						], self::HTTP_OK);
				}
		
			}else if(!$user_id ){				
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory',$language_code),							
							$this->config->item('rest_data_field_name') =>$invalid_response
							
						], self::HTTP_OK);
			}else if(!$order_id ){				
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory',$language_code),							
							$this->config->item('rest_data_field_name') =>$invalid_response
							
						], self::HTTP_OK);
			}else if(!$prod_id ){				
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('prod_id_mandatory',$language_code),							
							$this->config->item('rest_data_field_name') =>$invalid_response
							
						], self::HTTP_OK);
			}else if(!$status ){				
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('status_mandatory',$language_code),							
							$this->config->item('rest_data_field_name') =>$invalid_response
							
						], self::HTTP_OK);
			}else{				
					$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('invalid_request',$language_code),
							
							$this->config->item('rest_data_field_name') =>$invalid_response
							
						], self::HTTP_OK);
			}
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
	}

}
