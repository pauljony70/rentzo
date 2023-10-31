<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
		$this->date_time = date('Y-m-d H:i:s');
    }

    //Functiofor for get category
    function get_category_request($devicetype){
       $category_result = array();
	   
		$this->db->select('cat_id,cat_name,cat_img,parent_id,cat_slug');
		$this->db->where(array('status' => 1));
		$this->db->order_by('cat_order','ASC');
		$query = $this->db->get('category');
		
		if($query->num_rows() >0){
		   $category_array = $query->result_object();
		   foreach($category_array as $cat_details){
			   $cat_response = array();
			   $cat_response['cat_id'] = $cat_details->cat_id;
			   $cat_response['cat_name'] = $cat_details->cat_name;
			   $cat_response['parent_id'] = $cat_details->parent_id;
			   $cat_response['cat_slug'] = $cat_details->cat_slug;
			   
			   $img_decode = json_decode($cat_details->cat_img);
			   $img ='';
					
			   if($devicetype == 1){					
					if(isset($img_decode->{MOBILE})){
						$img = $img_decode->{MOBILE};
					}else{
						$img = $cat_details->cat_img;
					}
					
				}else{
					if(isset($img_decode->{DESKTOP})){
						$img = $img_decode->{DESKTOP};
					}else{
						$img = $cat_details->cat_img;
					}
				}
				$cat_response['imgurl'] = $img;
				
				$category_result[] = $cat_response;
		   }
		}
		
		return $category_result;
    }
	
	 //Function for for get home category
    function get_home_category_request($devicetype){
       $category_result = array();
	   
		$this->db->select('cat.cat_id,cat.cat_name,cat.cat_img,cat.parent_id,cat.cat_slug');
		$this->db->join('category cat', 'cat.cat_id = hc.cat_id','INNER');
		
		$this->db->where(array('cat.status' => 1));
		$this->db->order_by('hc.cat_order','ASC');
		
		$this->db->limit(8, 0);
		$query = $this->db->get('home_category hc');
		
		if($query->num_rows() >0){
		    $category_array = $query->result_object();
		   foreach($category_array as $cat_details){
			   $cat_response = array();
			   $cat_response['cat_id'] = $cat_details->cat_id;
			   $cat_response['cat_name'] = $cat_details->cat_name;
			   $cat_response['parent_id'] = $cat_details->parent_id;
			   $cat_response['cat_slug'] = $cat_details->cat_slug;
			   
			   $img_decode = json_decode($cat_details->cat_img);
			   $img ='';
					
			   if($devicetype == 1){					
					if(isset($img_decode->{MOBILE})){
						$img = $img_decode->{MOBILE};
					}else{
						$img = $cat_details->cat_img;
					}
					
				}else{
					if(isset($img_decode->{DESKTOP})){
						$img = $img_decode->{DESKTOP};
					}else{
						$img = $cat_details->cat_img;
					}
				}
				$cat_response['imgurl'] = $img;
				
				$category_result[] = $cat_response;
		   }
		}
		
		return $category_result;
    }
	
	
	  //Function for get sub category
    function get_subcategory_request($parent_id = '',$devicetype){
       $category_result = array();
	   
		$this->db->select('cat_id as id,cat_name as name,cat_img,cat_slug');
		
		$this->db->where(array('parent_id' => $parent_id,'status' => 1));
		$this->db->order_by('cat_order','ASC');
		$query = $this->db->get('category');
		
		if($query->num_rows() >0){
		    $category_array = $query->result_object();
		   foreach($category_array as $cat_details){
			   $cat_response = array();
			   $cat_response['id'] = $cat_details->id;
			   $cat_response['name'] = $cat_details->name;
			   $cat_response['cat_slug'] = $cat_details->cat_slug;
			   
			  $img_decode = json_decode($cat_details->cat_img);
			   $img ='';
					
			   if($devicetype == 1){					
					if(isset($img_decode->{MOBILE})){
						$img = $img_decode->{MOBILE};
					}else{
						$img = $cat_details->cat_img;
					}
					
				}else{
					if(isset($img_decode->{DESKTOP})){
						$img = $img_decode->{DESKTOP};
					}else{
						$img = $cat_details->cat_img;
					}
				}
				$cat_response['imgurl'] = $img;
				
				$category_result[] = $cat_response;
		   }
		}
		
		return $category_result;
    }
	
	
	 //Function for for get header category
    function get_header_category_request($language, $devicetype){
       $category_result = array();
	   
		$this->db->select('cat.cat_id,cat.cat_name,cat.cat_name_ar,cat.cat_img,cat.parent_id,cat.cat_slug, cat.web_banner');
		
		$this->db->where(array('cat.status' => 1, 'cat.parent_id' => 0,'cat.cat_id !=' => 10));
		$this->db->order_by('cat.cat_order','ASC');
		
		//$this->db->limit(8, 0);
		$query = $this->db->get('category cat');
		
		if($query->num_rows() >0){
		    $category_array = $query->result_object();
		   foreach($category_array as $cat_details){
			   $cat_response = array();
			   $cat_response['cat_id'] = $cat_details->cat_id;
			   // 1 arabic 2 english
			   if($language == 1){
				    $cat_response['cat_name'] = $cat_details->cat_name_ar;
			   }else{
					 $cat_response['cat_name'] = $cat_details->cat_name;	   
			   }
			  
			   
			   $cat_response['parent_id'] = $cat_details->parent_id;
			   $cat_response['cat_slug'] = $cat_details->cat_slug;
			   
			   $img_decode = json_decode($cat_details->cat_img);
			   $img ='';
				
			   if($devicetype == 1){					
					if(isset($img_decode->{MOBILE})){
						$img = $img_decode->{MOBILE};
					}else{
						$img = $cat_details->cat_img;
					}
					
				}else{
					if(isset($img_decode->{DESKTOP})){
						$img = $img_decode->{DESKTOP};
					}else{
						$img = $cat_details->cat_img;
					}
				}
				
				$web_banner = '';
				if($cat_details->web_banner){
					$web_decode = json_decode($cat_details->web_banner);
					
					if($devicetype == 1){					
						if(isset($web_decode->{MOBILE})){
							$web_banner = $web_decode->{MOBILE};
						}else{
							$web_banner = $cat_details->web_banner;
						}
						
					}else{
						if(isset($web_decode->{DESKTOP})){
							$web_banner = $web_decode->{DESKTOP};
						}else{
							$web_banner = $cat_details->web_banner;
						}
					}
				}
				
				$cat_response['imgurl'] = $img;
				$cat_response['web_banner'] = $web_banner;
				
				//get sub category 
				$this->db->select('cat.cat_id,cat.cat_name, cat.cat_name_ar,cat.cat_img,cat.parent_id,cat.cat_slug');
		
				$this->db->where(array('cat.status' => 1, 'cat.parent_id' => $cat_details->cat_id));
				$this->db->order_by('cat.cat_order','ASC');
		
				//$this->db->limit(8, 0);
				$querysubcat = $this->db->get('category cat');
				$cat_response['subcat_1'] = array();
				if($querysubcat->num_rows() >0){
					$category_sub = $querysubcat->result_object();
					foreach($category_sub as $subcat_details){
						$scat_response = array();
						$scat_response['cat_id'] = $subcat_details->cat_id;
						  // 1 arabic 2 english
						   if($language == 1){
								$scat_response['cat_name'] = $subcat_details->cat_name_ar;
						   }else{
								$scat_response['cat_name'] = $subcat_details->cat_name;	   
						   }
						$scat_response['parent_id'] = $subcat_details->parent_id;
						$scat_response['cat_slug'] = $subcat_details->cat_slug;
			   
						$img_decode = json_decode($subcat_details->cat_img);
						$img ='';
					
						if($devicetype == 1){					
							if(isset($img_decode->{MOBILE})){
								$img = $img_decode->{MOBILE};
							}else{
								$img = $subcat_details->cat_img;
							}
							
						}else{
							if(isset($img_decode->{DESKTOP})){
								$img = $img_decode->{DESKTOP};
							}else{
								$img = $subcat_details->cat_img;
							}
						}
						$scat_response['imgurl'] = $img;
						
						//getsub sub category 
						$this->db->select('cat.cat_id,cat.cat_name, cat.cat_name_ar,cat.cat_img,cat.parent_id,cat.cat_slug');
				
						$this->db->where(array('cat.status' => 1, 'cat.parent_id' => $subcat_details->cat_id));
						$this->db->order_by('cat.cat_order','ASC');
				
						//$this->db->limit(8, 0);
						$querysubcat1 = $this->db->get('category cat');
						$scat_response['subsubcat_2'] = array();
						if($querysubcat1->num_rows() >0){
							$category_sub1 = $querysubcat1->result_object();
							foreach($category_sub1 as $subcat_details1){
								$scat_response1 = array();
								$scat_response1['cat_id'] = $subcat_details1->cat_id;
								  // 1 arabic 2 english
							   if($language == 1){
									$scat_response1['cat_name'] = $subcat_details1->cat_name_ar;
							   }else{
									$scat_response1['cat_name'] = $subcat_details1->cat_name;	   
							   }
								
								$scat_response1['parent_id'] = $subcat_details1->parent_id;
								$scat_response1['cat_slug'] = $subcat_details1->cat_slug;
					
								$img_decode = json_decode($subcat_details1->cat_img);
								$img1 ='';
							
								if($devicetype == 1){					
									if(isset($img_decode->{MOBILE})){
										$img1 = $img_decode->{MOBILE};
									}else{
										$img1 = $subcat_details1->cat_img;
									}
									
								}else{
									if(isset($img_decode->{DESKTOP})){
										$img1 = $img_decode->{DESKTOP};
									}else{
										$img1 = $subcat_details1->cat_img;
									}
								}
								$scat_response1['imgurl'] = $img1;
								
								$scat_response['subsubcat_2'][] = $scat_response1;
							}
						}
						$cat_response['subcat_1'][] = $scat_response;
					}
				}
				
				$category_result[] = $cat_response;
		   }
		}
		
		return $category_result;
    }
	
   
}
