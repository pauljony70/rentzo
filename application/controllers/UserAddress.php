<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class UserAddress extends REST_Controller
{

	protected $request_method = 'post';


	public function __construct()
	{
		parent::__construct();

		// Load the UserAddress model
		$this->load->model('address_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function addUserAddress_post(){
		$requiredparameters = array('language','username','mobile','locality','fulladdress','state','city','addresstype','email','city_id','pincode','state_id');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$username = removeSpecialCharacters($this->post('username'));
		$mobile = removeSpecialCharacters($this->post('mobile'));
		$user_id = removeSpecialCharacters($this->session->userdata('user_id'));
		$locality = removeSpecialCharacters($this->post('locality'));
		$fulladdress = removeSpecialCharacters($this->post('fulladdress'));
		$state = removeSpecialCharacters($this->post('state'));
		$city = removeSpecialCharacters($this->post('city'));
		$addresstype = removeSpecialCharacters($this->post('addresstype'));
		$email = removeSpecialCharacters($this->post('email'));
		$city_id = removeSpecialCharacters($this->post('city_id')); 
		$state_id = removeSpecialCharacters($this->post('state_id')); 
		$pincode = removeSpecialCharacters($this->post('pincode'));
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
			if($username && is_numeric($mobile) && $pincode && $user_id && $city && $addresstype){
				$address = $this->address_model->add_user_address($username,$mobile,$pincode,$user_id,$locality,$fulladdress,$state, $city, $addresstype,$email,$city_id,$state_id);
				if($address =='done'){					
					//$address_detail = $this->address_model->get_user_address_details_full($user_id);
							
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('address_added',$language_code)
						//$this->config->item('rest_data_field_name') => $address_detail
												
					], self::HTTP_OK);
					
				
				}else if($address =='not_exist'){	
					$this->responses(0,get_phrase('please_try_again',$language_code));
				}else{
					$this->responses(0,get_phrase('please_try_again',$language_code));
				}
			}else if(!$username){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('username_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}else if(!is_numeric($mobile)){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('phone_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
			
			}/*else if(!is_numeric($pincode)){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('pincode_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}*/else if(!is_numeric($user_id)){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('please_try_again',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}/*else if(!$email){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('email_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}*/else if(!$city){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('city_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}else if(!$addresstype){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('address_type_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
		
	}

	public function editUserAddress_post(){
		$requiredparameters = array('language','username','mobile','fulladdress','state','city','addresstype','email','city_id','pincode','state_id');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$address_id = removeSpecialCharacters($this->post('address_id'));
		$username = removeSpecialCharacters($this->post('username'));
		$mobile = removeSpecialCharacters($this->post('mobile'));
		$user_id = removeSpecialCharacters($this->session->userdata('user_id'));
		$locality = removeSpecialCharacters($this->post('locality'));
		$fulladdress = removeSpecialCharacters($this->post('fulladdress'));
		$state = removeSpecialCharacters($this->post('state'));
		$city = removeSpecialCharacters($this->post('city'));
		$addresstype = removeSpecialCharacters($this->post('addresstype'));
		$email = removeSpecialCharacters($this->post('email'));
		$city_id = removeSpecialCharacters($this->post('city_id')); 
		$state_id = removeSpecialCharacters($this->post('state_id')); 
		$pincode = removeSpecialCharacters($this->post('pincode'));

		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
			if($username && is_numeric($mobile) && $pincode && $user_id && $city && $addresstype){
				$address = $this->address_model->edit_user_address($address_id, $username,$mobile,$pincode,$user_id,$locality,$fulladdress,$state, $city, $addresstype,$email,$city_id,$state_id);
				if($address =='done'){					
					//$address_detail = $this->address_model->get_user_address_details_full($user_id);
							
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('address_added',$language_code)
						//$this->config->item('rest_data_field_name') => $address_detail
												
					], self::HTTP_OK);
					
				
				}else if($address =='not_exist'){	
					$this->responses(0,get_phrase('please_try_again',$language_code));
				}else{
					$this->responses(0,get_phrase('please_try_again',$language_code));
				}
			}else if(!$username){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('username_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}else if(!is_numeric($mobile)){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('phone_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
			
			}/*else if(!is_numeric($pincode)){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('pincode_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}*/else if(!is_numeric($user_id)){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('please_try_again',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}/*else if(!$email){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('email_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}*/else if(!$city){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('city_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}else if(!$addresstype){
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('address_type_mandatory',$language_code)
					//$this->config->item('rest_data_field_name') => $address_detail
											
				], self::HTTP_OK);
				
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
		
	}
	
	// function for delete address
	public function deleteUserAddress_post()
	{
		$requiredparameters = array('language', 'user_id', 'address_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$address_id = removeSpecialCharacters($this->post('address_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($address_id && $user_id) {
				$address = $this->address_model->delete_address($user_id, $address_id);
				if ($address == 'delete') {
					$address_detail = $this->address_model->get_user_address_details_full($user_id);

					if (count($address_detail['address_details']) > 0) {

						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('address_deleted', $language_code),
							$this->config->item('rest_data_field_name') => $address_detail

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('address_empty', $language_code),
							$this->config->item('rest_data_field_name') => $address_detail

						], self::HTTP_OK);
					}
				} else if ($address == 'invalid') {
					$address = array();
					$address['defaultaddress'] = '';
					$address['address_details'] = array();
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_address_id', $language_code),
						$this->config->item('rest_data_field_name') => $address

					], self::HTTP_OK);
				} else {

					$address = array();
					$address['defaultaddress'] = '';
					$address['address_details'] = array();
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('please_try_again', $language_code),
						$this->config->item('rest_data_field_name') => $address

					], self::HTTP_OK);
				}
			} else {

				$address = array();
				$address['defaultaddress'] = '';
				$address['address_details'] = array();
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('address_invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => $address

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	// function for update address
	public function updateUserAddress_post()
	{
		$requiredparameters = array('language', 'user_id', 'address_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$pid = removeSpecialCharacters($this->post('pid'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$address_id = removeSpecialCharacters($this->post('address_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($address_id && $user_id) {
				$address = $this->address_model->update_address($user_id, $address_id);
				if ($address == 'update') {
					$address_detail = $this->address_model->get_user_address_details_full($user_id);

					if (count($address_detail['address_details']) > 0) {

						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('address_updated', $language_code),
							$this->config->item('rest_data_field_name') => $address_detail

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('address_empty', $language_code),
							$this->config->item('rest_data_field_name') => $address_detail

						], self::HTTP_OK);
					}
				} else {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('please_try_again', $language_code),
						$this->config->item('rest_data_field_name') => array()

					], self::HTTP_OK);
				}
			} else {

				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('address_invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => array()

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	public function getshippingcost_post()
	{
		$requiredparameters = array('language', 'seller_pincode', 'user_pincode', 'total_value');

		$language_code = removeSpecialCharacters($this->post('language'));
		$seller_pincode = removeSpecialCharacters($this->post('seller_pincode'));
		$user_pincode = removeSpecialCharacters($this->post('user_pincode'));
		$total_value = removeSpecialCharacters($this->post('total_value'));

		$validation = $this->parameterValidation($requiredparameters, $this->post());

		if ($validation == 'valid') {
			$shiping_detail = $this->address_model->get_shippinf_details_full($seller_pincode, $user_pincode, $total_value);

			$this->response([
				$this->config->item('rest_status_field_name') => 1,
				$this->config->item('rest_message_field_name') => 'get Shipping Data',
				$this->config->item('rest_data_field_name') => $shiping_detail

			], self::HTTP_OK);
		} else {
			echo $validation;
		}
	}

	// function for get cart product
	public function getUserAddress_post()
	{
		$requiredparameters = array('language', 'user_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($user_id) {
				$address_detail = $this->address_model->get_user_address_details_full($user_id);

				if (count($address_detail['address_details']) > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('address_details', $language_code),
						$this->config->item('rest_data_field_name') => $address_detail

					], self::HTTP_OK);
				} else {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('address_empty', $language_code),
						$this->config->item('rest_data_field_name') => $address_detail

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('address_invalid_request', $language_code),
					$this->config->item('rest_data_field_name') => array()

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
