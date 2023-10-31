<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class CategoryProductController extends REST_Controller {
	
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
	
	public function getCategoryProduct_post(){
		$requiredparameters = array('language','catid','pageno','sortby','devicetype','config_attr');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$catid = removeSpecialCharacters($this->post('catid'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby = removeSpecialCharacters($this->post('sortby'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$config_attr = removeSpecialCharacters($this->post('config_attr'));
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post()); //$this->post() holds post values
		
		$product_array = array();
    	if($validation=='valid') {
			if($catid){
				$subcat_array = $this->categoryProduct_model->get_subcatWithFilter_request($language_code,$catid, $devicetype);
				$category_result = array();
				$category_array = $this->category_model->get_subcategory_request($language_code, $category_result, $catid,$devicetype);
				
				$catid_array = array($catid);
				if(count($category_array) >0){
					
					foreach($category_array as $cat_ids){
						$catid_array[] = $cat_ids['id'];
					}
				}
				
				$product_array = $this->categoryProduct_model->get_category_product_request($language_code,$catid_array,$pageno,$sortby,$devicetype,$config_attr);
				if($product_array){
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => '',
						'pageno' => $pageno,
						'sub_cat' => $subcat_array,
						'sub_product' => $product_array
						
					], self::HTTP_OK);
				}else{
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found',$language_code),
						'pageno' => $pageno,
						'sub_cat' => $subcat_array,
						'sub_product' => $product_array
						
					], self::HTTP_OK);
				}
			}else if(!$catid){
				$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('category_id_mandatory',$language_code),
						'pageno' => $pageno,
					    'sub_cat' => $subcat_array,
						'sub_product' => $product_array
						
					], self::HTTP_OK);
			}
			
    	}
    	else {
      		echo $validation; //These are parameters are missing.
    	}
		
	}
	
	public function getCategoryProduct_sponsor_post(){
		$requiredparameters = array('language','catid','pageno','sortby','devicetype','config_attr');
		
		$language_code = removeSpecialCharacters($this->post('language'));
		$catid = removeSpecialCharacters($this->post('catid'));
		$pageno = removeSpecialCharacters($this->post('pageno'));
		$sortby = removeSpecialCharacters($this->post('sortby'));
		$devicetype = removeSpecialCharacters($this->post('devicetype'));
		$config_attr = removeSpecialCharacters($this->post('config_attr'));
		
		
		
		$validation = $this->parameterValidation($requiredparameters,$this->post());
		
		$product_array = array();
    	if($validation=='valid') {
			if($catid){
				$subcat_array = $this->categoryProduct_model->get_subcatWithFilter_request($language_code,$catid, $devicetype);
				$category_result = array();
				$category_array = $this->category_model->get_subcategory_request($language_code, $category_result, $catid,$devicetype);
				
				$catid_array = array($catid);
				if(count($category_array) >0){
					
					foreach($category_array as $cat_ids){
						$catid_array[] = $cat_ids['id'];
					}
				}
				
				$product_array = $this->categoryProduct_model->get_category_product_sponsor_request($language_code,$catid_array,$pageno,$sortby,$devicetype,$config_attr);
				if($product_array){
					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => '',
						'pageno' => $pageno,
						'title' => 'Sponsor Product',
						'sub_cat' => $subcat_array,
						'sponsor_product' => $product_array
						
					], self::HTTP_OK);
				}else{
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('no_record_found',$language_code),
						'pageno' => $pageno,
						'title' => 'Sponsor Product',
						'sub_cat' => $subcat_array,
						'sponsor_product' => $product_array
						
					], self::HTTP_OK);
				}
			}else if(!$catid){
				$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('category_id_mandatory',$language_code),
						'pageno' => $pageno,
						'title' => 'Sponsor Product',
					    'sub_cat' => $subcat_array,
						'sponsor_product' => $product_array
						
					], self::HTTP_OK);
			}
			
    	}
    	else {
      		echo $validation;
    	}
	}

}
