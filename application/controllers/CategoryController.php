<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class CategoryController extends REST_Controller {
	
	protected $request_method ='post'; 
	
		 
	 public function __construct() { 
        parent::__construct();
                
        // Load the user model
        $this->load->model('category_model');
		$this->load->model('categoryProduct_model');
    }
	public function index_get()
	{
		$this->responses(1,'Server OK');
	}
	
	public function getCategory_post(){
		$requiredparameters = array('language','devicetype');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
      		$category_array = $this->category_model->get_category_request($devicetype);
			
			if(count($category_array) >0){
				$this->responses(1,'home_category',$category_array);
			}else{
				$this->responses(0,get_phrase('no_record_found',$language_code),$category_array);
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
		
	}
	
	public function getHomeCategory_post(){
		$requiredparameters = array('language','devicetype');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
      		$category_array = $this->category_model->get_home_category_request($devicetype);
			
			if(count($category_array) >0){
				$this->responses(1,'home_category',$category_array);
			}else{
				$this->responses(0,get_phrase('no_record_found',$language_code),$category_array);
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
		
	}
	
	public function getSubCategory_post(){
		$requiredparameters = array('language','catid','devicetype','pageno');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$catid = removeSpecialCharacters($this->post('catid'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby =1;
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
			if($catid || $catid  ==0){
				$category_array = $this->category_model->get_subcategory_request($catid,$devicetype);
				
				$catid_array = array($catid);
				if(count($category_array) >0){
					
					foreach($category_array as $cat_ids){
						$catid_array[] = $cat_ids['id'];
					}
				}
				
				$product_array = $this->categoryProduct_model->get_category_product_request($catid_array,$pageno,$sortby,$devicetype);
					
				if(count($category_array) >0 || count($product_array) >0){	
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') =>get_phrase('sub_category',$language_code),
						'parent_cat_id' => $catid,
						'sub_cat' => $category_array,
						'sub_product' => $product_array
						
					], self::HTTP_OK);
				}else{
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found',$language_code),
						'parent_cat_id' => $catid,
						'sub_cat' => $category_array,
						'sub_product' =>array()
						
					], self::HTTP_OK);
				}
			}else{
				$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('category_mandatory',$language_code),
						'parent_cat_id' => $catid,
						'sub_cat' => array(),
						'sub_product' =>array()
						
					], self::HTTP_OK);
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
		
	}
	
	
	public function getHeaderCategory_post(){
		$requiredparameters = array('language','devicetype');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
    	if($validation=='valid') {
      		$category_array = $this->category_model->get_header_category_request($devicetype);
			
			if(count($category_array) >0){
				$this->responses(1,'home_category',$category_array);
			}else{
				$this->responses(0,get_phrase('no_record_found',$language_code),$category_array);
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
		
	}
	
	
  

}
