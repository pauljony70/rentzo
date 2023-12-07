<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
		$this->date_time = date('Y-m-d H:i:s');
    }

    //Functiofor for add product into cart
    function add_product_cart($prod_id,$sku,$sid,$user_id,$qty,$referid){
		$this->db->select("id");
		$this->db->where(array('prod_id' => $prod_id,'user_id'=>$user_id));
		
		$query = $this->db->get('wishlistdetails');
		
		$cart = array();
		$status = '';
		if($query->num_rows() >0){
			$cart['prod_id'] = $prod_id;
			$cart['attr_sku'] = $sku;
			$cart['vendor_id'] = $sid;
			$cart['user_id'] = $user_id;
			$cart['qty'] = $qty;
			$cart['refer_id'] = $referid;
			
			$this->db->where(array('prod_id' => $prod_id,'user_id'=>$user_id));
			
			$query = $this->db->update('wishlistdetails', $cart);
			if($query){
				$status = 'update';
			}
		}else{
			$cart['prod_id'] = $prod_id;
			$cart['attr_sku'] = $sku;
			$cart['vendor_id'] = $sid;
			$cart['user_id'] = $user_id;
			$cart['qty'] = $qty;
			$cart['refer_id'] = $referid;
			
			$query = $this->db->insert('wishlistdetails', $cart);
			if($query){
				$status = 'add';
			}
		}
		return $status;
    }
	
	
	//Functiofor for delete product from cart
	function delete_product_cart($pid,$user_id){
		$this->db->where(array('prod_id' => $pid,'user_id'=>$user_id));
		
		$query = $this->db->delete('wishlistdetails');
		
		if($query){
			return 'delete';
		}
	}
	
	//function for get user cart details
	
	function get_cart_details($user_id){
		$this->db->select("wd.prod_id, wd.attr_sku, wd.vendor_id, wd.qty");
		
		$this->db->join('product_details pd', 'pd.product_unique_id = wd.prod_id','INNER');
		$this->db->join('vendor_product vp', 'vp.product_id = pd.product_unique_id AND vp.vendor_id = wd.vendor_id','INNER');
		$this->db->join('sellerlogin', 'sellerlogin.seller_unique_id = vp.vendor_id','INNER');
		
		$this->db->where(array('pd.status' => 1,'vp.enable_status'=>1,'sellerlogin.status'=>1,'user_id'=>$user_id));
		
		$query = $this->db->get('wishlistdetails wd');
		
		$cart = array();
		$qty = 0;
		if($query->num_rows() >0){
			$cart_result = $query->result_object();
			foreach($cart_result as $cart_detail){
			
				$qty += $cart_detail->qty;
				
			}
		}
		return $qty;
	}
	
	
	
	function get_cart_full_details($language, $user_id,$devicetype=''){
		$this->db->select("prod_id, attr_sku, vendor_id, qty");
		$this->db->where(array('user_id'=>$user_id));
		$query = $this->db->get('wishlistdetails');
		
		$product_detail_array = array();
		$total_mrp = $total_discount = $total_price = $total_item = 0;
		
		if($query->num_rows() >0){
			$cart_result = $query->result_object();
			foreach($cart_result as $cart_detail){
				$prod_id = $cart_detail->prod_id;
				$sku = $cart_detail->attr_sku;
				$vendor_id = $cart_detail->vendor_id;
				$qty = $cart_detail->qty;
				
				//check product details
				$this->db->select("product_sku, prod_name, prod_name_ar,featured_img,web_url,sellerlogin.companyname as seller, vp.product_mrp, vp.product_sale_price, vp.product_stock, vp.product_purchase_limit, vp.id as vendor_prod_id");
				//join for get vendor product
				$this->db->join('vendor_product vp', 'vp.product_id = product_details.product_unique_id','INNER');
				$this->db->join('sellerlogin', 'sellerlogin.seller_unique_id = vp.vendor_id','INNER');
				
				$this->db->where(array('product_details.status' => 1,'vp.enable_status'=>1,'sellerlogin.status'=>1,'product_unique_id'=>$prod_id,'vendor_id'=>$vendor_id));
		
				$query_prod = $this->db->get('product_details');
				
				$product_detail = array();
				
				$product_detail['qty'] = 0;
				$product_detail['mrp1'] = price_format(0);
				$product_detail['price1'] = price_format(0);
				$product_detail['qty'] = 0;
				
				if($query_prod->num_rows() >0){
					$prod_result = $query_prod->result_object();
					
					$product_detail['prodid'] = $prod_id;
					$product_detail['sku'] = $prod_result[0]->product_sku;
					$product_detail['vendor_id'] = $vendor_id;
					if($language ==1){
						$product_detail['name'] = $prod_result[0]->prod_name_ar;
					}else{
						$product_detail['name'] = $prod_result[0]->prod_name;
					}
					$product_detail['web_url'] = $prod_result[0]->web_url;
					$product_detail['purchase_limit'] = $prod_result[0]->product_purchase_limit;
					$product_detail['available_stock'] = $prod_result[0]->product_stock;
					$product_detail['qty'] = $qty;
					$product_detail['configure_attr'] = array();
					$product_detail['mrp'] = price_format(0);
					$product_detail['price'] = price_format(0);
					$product_detail['totaloff'] = price_format(0);
					$product_detail['offpercent'] = price_format(0);
					$img_decode = json_decode($prod_result[0]->featured_img);
					$img ='';
						
					 if($devicetype == 1){
						
						if(isset($img_decode->{MOBILE})){
							$img = $img_decode->{MOBILE};
						}else{
							$img = $prod_result[0]->featured_img;
						}
						
					}else{
						if(isset($img_decode->{DESKTOP})){
							$img = $img_decode->{DESKTOP};
						}else{
							$img = $prod_result[0]->featured_img;
						}
					}
					$product_detail['imgurl'] = $img;
					
					if($prod_result[0]->product_sku == $sku ){
						//check vendor product details
						
						$tot_mrp = ($prod_result[0]->product_mrp*$qty);
						$tot_price = ($prod_result[0]->product_sale_price*$qty);
						
						$product_detail['mrp'] = price_format($prod_result[0]->product_mrp);
						$product_detail['price'] = price_format($prod_result[0]->product_sale_price);
						
						$product_detail['mrp1'] = $tot_mrp;
						$product_detail['price1'] = $tot_price;
						
						$discount_price = 0;
						if($prod_result[0]->product_sale_price >0){
							$discount_price = ($prod_result[0]->product_mrp - $prod_result[0]->product_sale_price);
							
							$discount_per = ($discount_price/$prod_result[0]->product_mrp)*100;
							
						}
						$product_detail['totaloff'] = price_format($discount_price);
						$product_detail['offpercent'] = round($discount_per).'% off';
					}else{
						$vendor_prod_id = $prod_result[0]->vendor_prod_id;
						
						$this->db->select("prod_attr_value, price, mrp, stock");
						$this->db->where(array('product_id'=>$prod_id, 'vendor_prod_id'=>$vendor_prod_id, 'product_sku'=>$sku));
						
						$query_prod_attr = $this->db->get('product_attribute_value');
						
						
						if($query_prod_attr->num_rows() >0){
							$prod_attr_result = $query_prod_attr->result_object();
							
							$tot_mrp1 = ($prod_attr_result[0]->mrp*$qty);
							$tot_price1 = ($prod_attr_result[0]->price*$qty);
							
							$product_detail['mrp'] = price_format($prod_attr_result[0]->mrp);
							$product_detail['price'] = price_format($prod_attr_result[0]->price);
							
							$product_detail['mrp1'] = $tot_mrp1;
							$product_detail['price1'] = $tot_price1;
						
							$discount_price = 0;
							if($prod_attr_result[0]->price >0){
								$discount_price = ($prod_attr_result[0]->mrp - $prod_attr_result[0]->price);
								
								$discount_per = ($discount_price/$prod_attr_result[0]->mrp)*100;
								
							}
							$product_detail['totaloff'] = price_format($discount_price);
							$product_detail['offpercent'] = round($discount_per).'% off';
							$product_detail['available_stock'] = $prod_attr_result[0]->stock;
							$product_detail['configure_attr'] = $this->get_product_configure_attr(json_decode($prod_attr_result[0]->prod_attr_value),$prod_id,$vendor_id);
						}
					}
					
					
				}
				$total_mrp += $product_detail['mrp1'];
				
				$total_price += $product_detail['price1'];
				$total_item += $product_detail['qty'];
				
				unset($product_detail['mrp1']);
				unset($product_detail['price1']);
				$product_detail_array[] = $product_detail;
			}
		}
		

		return array('cart_full' =>$product_detail_array, 'total_mrp' =>price_format($total_mrp), 'total_discount' =>price_format($total_mrp-$total_price),'total_price'=>price_format($total_price),'total_item'=>$total_item);
	}
	
	
	//function for get product attribute 
	
	function get_product_configure_attr($configure_attr,$prod_id,$vendor_id){
		$attribute_full_array = array();
		foreach($configure_attr as $attribute){
			
			$this->db->select("prod_attr_id, attribute");
			$this->db->join('product_attributes_set pas', 'pas.id = pa.prod_attr_id','INNER');
			
			$this->db->where(array('prod_id'=>$prod_id, 'vendor_id'=>$vendor_id));
			$this->db->like('attr_value',"".$attribute."");
			$query = $this->db->get('product_attribute pa');
			 
			$attribute_array = array();
			
			if($query->num_rows() >0){
				$attr_result = $query->result_object();
				$attribute_array['attr_id'] = $attr_result[0]->prod_attr_id;
				$attribute_array['attr_name'] = $attr_result[0]->attribute;
				$attribute_array['item'] = $attribute;
				
			}
			$attribute_full_array[] = $attribute_array;
		}
		return $attribute_full_array;
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
