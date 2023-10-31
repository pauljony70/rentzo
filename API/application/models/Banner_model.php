<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
		$this->date_time = date('Y-m-d H:i:s');
    }

    //Functiofor for get Main Banners
    function get_banner_request($language, $devicetype){
       $banner_result = array();
	   
		$this->db->select('id,img_url,banner_id,banner_order,clicktype');
		
		//$this->db->order_by('cat_order','desc');
		$query = $this->db->get('banners');
		
		$banner_array = array();
		if($query->num_rows() >0){
		   $banner_result = $query->result_object();
		   
		   foreach($banner_result as $banners_details){
			   $banner_response = array();
			   $banner_response['prod_sku'] = '';
			   $banner_response['cat_slug'] = '';
			   $banner_response['prod_id'] = '';
			   $banner_response['cat_id'] = '';
			   $banner_response['search_name'] = '';
			   $banner_response['click_type'] = $banners_details->clicktype;
			   
				if($devicetype == 1){
					$img_decode = json_decode($banners_details->img_url);
					$img = $img_decode->{MOBILE};
					$banner_response['imgurl'] = $img;
				}else{
					$img_decode = json_decode($banners_details->img_url);
					$img = $img_decode->{DESKTOP};
					$banner_response['imgurl'] = $img;
				}
				
				if($banners_details->clicktype == 1){
				    $cat_details = $this->get_category_details_byid($language, $banners_details->banner_id,$devicetype);
					$banner_response['cat_slug'] = $cat_details[0]['cat_slug'];
					$banner_response['cat_id'] = $banners_details->banner_id;
				}else if($banners_details->clicktype == 2){
					$banner_response['prod_id'] = $banners_details->banner_id;
					
					$prod_details = $this->get_product_details_byid($language,$banners_details->banner_id,$devicetype);
					
					$banner_response['prod_sku'] = $prod_details[0]['sku'];
				}else if($banners_details->clicktype == 3){
					$banner_response['search_name'] = $banners_details->banner_id;
				}
				$banner_array[] = $banner_response;
		   }
		   
		}
		
		return $banner_array;
    } 
	
	
	
	function delete_custon_banner_request($devicetype){
		
		
		
		

		$this->db->select('id,title,layout');
		$this->db->order_by('orders','asc');
		$query_home_banner = $this->db->get('homepage_banners');

	   

		if($query_home_banner->num_rows() >0){

			$home_banner_result = $query_home_banner->result_object();

			$i=0;

			foreach($home_banner_result as $home_banners_details){

				$banner_array = array();

				$this->db->select('hcb.id,hcb.img_url,hcb.banner_id,hcb.clicktype');
				
				$this->db->join('vendor_product vp', 'hcb.banner_id = vp.product_id','INNER');
				
				$this->db->where(array('vp.enable_status'=>0,'hcb.clicktype'=>2));
				$this->db->where('hcb.banner_for',$home_banners_details->id);

				

				$query = $this->db->get('home_custom_banner hcb');

				

				if($query->num_rows() >0){

					$banner_result = $query->result_object();

					

					foreach($banner_result as $banners_details){
						
						$prod_id = $banners_details->banner_id;
						

						$this->db->where(array('banner_id'=>$banners_details->banner_id));

						$query00 = $this->db->delete('home_custom_banner');
						
		
					}
				}
			}
		}
	}

	
	
	//Functiofor for get Custom Banners
    function get_custon_banner_request($language, $devicetype){
		$home_banners = array();		
		$home_banners_final = array();		
		
		
		$this->db->select('id,title,layout');
		
		$this->db->order_by('orders','ASC');
		$query_home_banner = $this->db->get('homepage_banners');
	   
		if($query_home_banner->num_rows() >0){
			$home_banner_result = $query_home_banner->result_object();
			$i=0;
			foreach($home_banner_result as $home_banners_details){
				$banner_array = array();
				$this->db->select('id,img_url,banner_id,clicktype');
				
				$this->db->where('banner_for',$home_banners_details->id);
				
				$query = $this->db->get('home_custom_banner');
				
				if($query->num_rows() >0){
					$banner_result = $query->result_object();
					
					foreach($banner_result as $banners_details){
						$banner_response = array();
						$banner_response['sku'] = '';
						$banner_response['prod_id'] = '';
						$banner_response['cat_id'] = '';
						$banner_response['search_name'] = '';
						$banner_response['click_type'] = $banners_details->clicktype;
						
						$banner_response['name'] = '';
						$banner_response['web_url'] = '';
						$banner_response['vendor_id'] = '';
						$banner_response['mrp'] = price_format(0);
						$banner_response['price'] = price_format(0);
						$banner_response['remark'] = '';
						$banner_response['totaloff'] = price_format(0);
						$banner_response['offpercent'] = price_format(0);
						$banner_response['rating'] = 0;
						$banner_response['imgurl'] = '';
						
						if($banners_details->img_url){
							if($devicetype == 1){
								$img_decode = json_decode($banners_details->img_url);																								$img ='';								if($img_decode){									$img = $img_decode->{MOBILE};								}								
								$img = $img_decode->{MOBILE};
								$banner_response['imgurl'] = $img;
							}else{
								$img_decode = json_decode($banners_details->img_url);																$img ='';								if($img_decode){									$img = $img_decode->{DESKTOP};								}		

								$banner_response['imgurl'] = $img;
							}
						}
							
						if($banners_details->clicktype == 1){
							$cat_details = $this->get_category_details_byid( $language,$banners_details->banner_id,$devicetype);
							
							$banner_response['name'] = $cat_details[0]['cat_name'];
							$banner_response['web_url'] = $cat_details[0]['cat_slug'];
							$banner_response['cat_id'] = $banners_details->banner_id;
							if(!$banner_response['imgurl']){
								$banner_response['imgurl'] = $cat_details[0]['imgurl'];
							}
						}else if($banners_details->clicktype == 2){
							$banner_response['prod_id'] = $banners_details->banner_id;
							
							$prod_details = $this->get_product_details_byid($language,$banners_details->banner_id,$devicetype);
							
							$banner_response['name'] = $prod_details[0]['name'];
							$banner_response['web_url'] = $prod_details[0]['web_url'];
							$banner_response['sku'] = $prod_details[0]['sku'];
							$banner_response['vendor_id'] = $prod_details[0]['vendor_id'];
							$banner_response['mrp'] = price_format($prod_details[0]['mrp']);
							$banner_response['price'] = price_format($prod_details[0]['price']);
							$banner_response['remark'] = $prod_details[0]['remark'];
							$banner_response['totaloff'] = price_format($prod_details[0]['totaloff']);
							$banner_response['offpercent'] = $prod_details[0]['offpercent'].'% off';
							
							
							if(!$banner_response['imgurl']){
								$banner_response['imgurl'] = $prod_details[0]['imgurl'];
							}
						}else if($banners_details->clicktype == 3){
							$banner_response['search_name'] = $banners_details->banner_id;
						}
						$banner_array[] = $banner_response;
					}
					
					$home_banners[$i]['title'] = $home_banners_details->title;
					$home_banners[$i]['layout'] = $home_banners_details->layout;
					$home_banners[$i]['banners_result'] = $banner_array;
					$i++;
				}
			$home_banners_final[] = $home_banners;
			}
		}
		//print_r($home_banners);
		return $home_banners;
    }


	function get_product_details_byid($language, $product_id,$devicetype){
		//get products details
			$this->db->select('pd.product_unique_id as id , pd.prod_name as name,pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark');
			
			
			$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
				FROM vendor_product vp WHERE  vp.product_id IN('.$this->getValues($product_id).') AND vp.enable_status=1 group by vp.product_id  ) as vp2','pd.product_unique_id = vp2.product_id');
			$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min','INNER');
			$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('status' => 1,'vp1.enable_status'=>1));
			$this->db->group_by("pd.product_unique_id"); 
			
			
				$this->db->order_by("vp2.mrp_min",'asc'); 
			
			
			$query_prod = $this->db->get('product_details as pd');
			
			$product_array = array();
			if($query_prod->num_rows() >0){
				$prod_result = $query_prod->result_object();
				
				
				foreach($prod_result as $product_details){
					$product_response = array();
					$product_response['id'] = $product_details->id;
					 if($language =="1"){
							$product_response['name'] = $product_details->name_ar;
						}else{
							$product_response['name'] = $product_details->name;
						}
					
					$product_response['web_url'] = $product_details->web_url;
					$product_response['sku'] = $product_details->sku;
					$product_response['active'] = $product_details->active;
					$product_response['vendor_id'] = $product_details->vendor_id;
					$product_response['mrp'] = $product_details->mrp;
					$product_response['price'] = $product_details->price;
					$product_response['stock'] = $product_details->stock;
					$product_response['remark'] = $product_details->remark;
					
					$discount_per = 0;
					$discount_price = 0;
					if($product_details->price >0){
						$discount_price = ($product_details->mrp-$product_details->price);
						
						$discount_per = ($discount_price/$product_details->mrp)*100;
						
					}
					$product_response['totaloff'] = $discount_price;
					$product_response['offpercent'] = round($discount_per);
					
					if($devicetype == 1){
						$img_decode = json_decode($product_details->img);
						
						$img = $img_decode->{MOBILE};
						$product_response['imgurl'] = $img;
					}else{
						$img_decode = json_decode($product_details->img);
						$img = $img_decode->{DESKTOP};
						$product_response['imgurl'] = $img;
					}
					
					$product_array[] = $product_response;
				}
			}
			return $product_array;
		
	}
	
	 //Functio for get category details
    function get_category_details_byid($language, $category_id,$devicetype){
       $category_result = array();
	   
		$this->db->select('cat_id,cat_name, cat_name_ar,cat_img,parent_id,cat_slug');
		
		$this->db->where('cat_id',$category_id);
		$query = $this->db->get('category');
		
		if($query->num_rows() >0){
		   $category_array = $query->result_object();
		   foreach($category_array as $cat_details){
			   $cat_response = array();
			   $cat_response['cat_id'] = $cat_details->cat_id;
			    if($language =="1"){
							$cat_response['cat_name'] = $cat_details->cat_name_ar;
						}else{
							$cat_response['cat_name'] = $cat_details->cat_name;
						}
			   
			   $cat_response['parent_id'] = $cat_details->parent_id;
			   $cat_response['cat_slug'] = $cat_details->cat_slug;
			   
			   if($devicetype == 1){
					$img_decode = json_decode($cat_details->cat_img);
					$img ='';
					if($img_decode){
						$img = $img_decode->{MOBILE};
					}
					$cat_response['imgurl'] = $img;
				}else{
					$img_decode = json_decode($cat_details->cat_img);
					$img ='';
					if($img_decode){
						$img = $img_decode->{DESKTOP};
					}
					$cat_response['imgurl'] = $img;
				}
				$category_result[] = $cat_response;
		   }
		}
		
		return $category_result;
    }
	
	
	/*
		Break All The Values In Valid Form
	*/
	
	function getValues($var){
		if(is_array($var)){
			$values = "'".implode("','" , $var )."'";
		}else{ 
			$delm = Array(",","\n");
			$values = "'".str_replace($delm , "','" , $var)."'";  
		}
		return $values;
	}
   
}
