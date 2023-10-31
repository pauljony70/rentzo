<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delivery_boy_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
		$this->date_time = date('Y-m-d H:i:s');
    }

    //Functiofor validate user
    function validate_user($user_phone = '',$qouteid,$user_name,$user_password){
       $user_result = array();
	   
		$this->db->select('*');
		$this->db->where(array('phone' => $user_phone));
		$query = $this->db->get('appuser_login');
		
		if($query->num_rows() >0){
			$user_result['status'] = 'exist';
		   return $user_result;
		   die();
		}else {
			$user_unique_id = 'U'.$this->random_strings(10);
			$data['phone'] = $user_phone;
			$data['status'] = 1;
			$data['user_unique_id'] = $user_unique_id;
			$data['fullname'] = $user_name;
			$data['password'] = $user_password;
			$data['create_by'] = $this->date_time;
			
			$this->db->insert('appuser_login',$data);
			
			$this->db->select('*');
			$this->db->where(array('phone' => $user_phone));
			$query1 = $this->db->get('appuser_login');
			
			$user_result1 = $query1->result_object()[0];
			
			$img_decode = json_decode($user_result1->profile_pic);
						
			if(isset($img_decode->{MOBILE})){		
			    $img = $img_decode->{MOBILE};
			}else{
			    $img =$user_result1->profile_pic;
			}			
			
			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
			$user_result['profile_pic'] = $img;
		}
		if($qouteid){
			//get_cart_product
			$usercart = $this->get_cart_details($user_result1->user_unique_id,'');
			
			$quotecart = $this->get_cart_details('',$qouteid);
			
			foreach($usercart as $product_id){
				if(in_array($product_id,$quotecart)){
					$this->db->where(array('prod_id'=>$product_id,'user_id'=>$user_result1->user_unique_id));
					$this->db->delete('cartdetails');
				}
			}
			$cart = array();
			
			$cart['user_id'] = $user_result1->user_unique_id;
			
			$this->db->where(array('qoute_id'=>$qouteid));
			$this->db->update('cartdetails', $cart);
			
		}
		
		return $user_result;
    }
    
	//Functiofor validate login user
    function validate_user_login($user_phone = '',$user_password){
       $user_result = array();
	   
		$this->db->select('*');
		$this->db->where(array('phone' => $user_phone,'password' => $user_password));
		$query = $this->db->get('deliveryboy_login');
		
		if($query->num_rows() >0){
		   $user_result1 = $query->result_object()[0];
			
			$img_decode = json_decode($user_result1->profile_pic);
						
			if(isset($img_decode->{MOBILE})){		
			    $img = $img_decode->{MOBILE};
			}else{
			    $img =$user_result1->profile_pic;
			}			
			
			$user_result['user_id'] = $user_result1->deliveryboy_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
			$user_result['profile_pic'] = $img;
		}else {
			$user_result['status'] = 'not_exist';
		   return $user_result;
		   die();
		}
				
		return $user_result;
    }
	
	//function for save user opt
	
	function save_user_otp($user_phone,$otp){
		$this->db->delete('app_user_otp',array('phone'=>$user_phone));
		
		$data['phone'] = $user_phone;
		$data['otp'] = $otp;
		
		$this->db->insert('app_user_otp',$data);
	}
	
	//function for get user opt
	
	function get_user_otp($user_phone){
		$otp = '';
		
		$this->db->select('otp');
		$this->db->where(array('phone' => $user_phone));
		$query = $this->db->get('app_user_otp');
		
		if($query->result_object()){
			$user_result = $query->result_object()[0];
			$otp = $user_result->otp;
		}
		return $otp;
	}
	
	function delivery_boy_token($user_id,$token,$add_date){		
		$user_result = array();
		$this->db->select('*');
		$this->db->where(array('deliveryboy_unique_id	' => $user_id));
		$query = $this->db->get('deliveryboy_login');
		
		if($query->num_rows() >0){
			
			$data['token'] = $token;
			$data['token_date'] = date('Y-m-d H:i:sa',strtotime($add_date));
			
			$this->db->where(array('deliveryboy_unique_id'=>$user_id));
			$query1 = $this->db->update('deliveryboy_login',$data);
			
			if($query1)
			{
				$user_result['status'] = '1';
			}
			return $user_result;
			
		}else {
			
			$user_result['status'] = '0';
		   return $user_result;
			
		}
		return $user_result;
	}
	
	
	function get_user_profile($user_id){		
	   
		$this->db->select('deliveryboy_unique_id, fullname, phone, email,profile_pic');
		$this->db->where(array('deliveryboy_unique_id' => $user_id));
		$query = $this->db->get('deliveryboy_login');
		
		$user_result = array();
		if($query->num_rows() >0){
			$user_result1 = $query->result_object()[0];
			
			$img_decode = json_decode($user_result1->profile_pic);
						
			if(isset($img_decode->{MOBILE})){		
			    $img = $img_decode->{MOBILE};
			}else{
			    $img =$user_result1->profile_pic;
			}			
			
			$user_result['user_id'] = $user_result1->deliveryboy_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['profile_pic'] = $img;
		}
		return $user_result;
	}
	
	function get_order_list_details_sortby($user_id,$sort_date,$sort_status,$pageno)
	{
		if($pageno >0){
		   $start = ($pageno*LIMIT);
	   }else{
		   $start = 0;
	   }
		
		
		
		
		$shipped_status = array('Out for Delivery','Delivered','Reschedule','Undelivered');
		$packed_status = array('Order Picked');
		$placed_status = array();
		$status = array();
		$return_status = array('Return Received','Return Cancelled','Return Reschedule');
		
		
		$this->db->select("op.order_id,op.prod_id,op.prod_name,op.prod_name_ar,op.qty,op.prod_price,DATE(op.create_date) as orderdate,op.status,op.delivery_date,
				o.payment_mode,o.fullname,o.mobile,o.locality,o.fulladdress,o.city,o.state,o.pincode,o.addresstype,o.lat,o.lang");
		
		//join for get vendor product
		$this->db->join('order_product op', 'op.prod_id = dbo.product_id AND op.order_id = dbo.order_id ','INNER');
		
		$this->db->join('orders o', 'o.order_id = dbo.order_id','LEFT');
				
		$this->db->where(array('dbo.delivery_boy'=>$user_id));
		
		if($sort_date != '')
		{
			$this->db->where('DATE(op.create_date)',date('Y-m-d',strtotime($sort_date)));
		}
		
		if($sort_status != '')
		{
			$this->db->where('op.status',$sort_status);
		}
		
		$this->db->order_by("op.create_date", "desc");
		$this->db->limit(LIMIT,$start);
		
		$query1 = $this->db->get('delivery_boy_orders dbo');
		
		//print_r($this->db->last_query());
		
		$total_orders = $pending_order= $delivered_order = $returned_pickup_order = 0;
		$order_details = $order_list = array();
		if($query1->num_rows() >0){
			$delivery_boy_orders = $query1->result_object();
			
			foreach($delivery_boy_orders as $orders){
				$order_list['orderid'] = $orders->order_id;
				$order_list['prod_id'] = $orders->prod_id;
				$order_list['orderdate'] = date('d-m-Y',strtotime($orders->orderdate));
				$order_list['orderstatus'] = $orders->status;
				$order_list['shippingParcelId'] = '';
				$order_list['prod_name'] = $orders->prod_name;
				$order_list['prod_name_ar'] = $orders->prod_name_ar;
				$order_list['name'] = $orders->fullname;
				$order_list['phone'] = $orders->mobile;
				$order_list['address'] = $orders->fulladdress;
				$order_list['city'] = $orders->city;
				$order_list['pincode'] = $orders->pincode;
				$order_list['addresstype'] = $orders->addresstype;
				$order_list['deliverydate'] = date('d-m-Y',strtotime($orders->delivery_date));
				$order_list['orderprice'] = price_format($orders->prod_price);
				$order_list['item'] = $orders->qty;
				$order_list['lat'] = $orders->lat;
				$order_list['lang'] = $orders->lang;
				$order_list['paymentmode'] = $orders->payment_mode;
				if($orders->status=='Shipped' || $orders->status=='Out for Delivery' || $orders->status=='Reschedule' || $orders->status=='Undelivered'){
					$order_list['update_status'] = $shipped_status;
				}else if($orders->status=='Placed'){
					$order_list['update_status'] = $placed_status;
				}else if($orders->status=='Picked'){
					$order_list['update_status'] = $packed_status;
				}
				else if($orders->status=='Return Request'){
					$order_list['update_status'] = $return_status;
				}
				else
				{
					$order_list['update_status'] = $status;
				}
				$order_list['paymentmode'] = $orders->payment_mode;
				$order_details[] = $order_list;
				
				if($orders->status =='Delivered'){
					$delivered_order++;
				}
				
				if($orders->status =='Returned'){
					$returned_pickup_order++;
				}
				$total_orders++;
			}
			$pending_order = $total_orders-($delivered_order);
			return array('total_orders'=>$total_orders,'pending_order'=>$pending_order,'delivered_order'=>$delivered_order,'returned_pickup_order'=>$returned_pickup_order,'order_details'=>$order_details);
		}
	}
	
	function get_order_list_details($user_id){ //Returned
		$shipped_status = array('Out for Delivery','Delivered','Reschedule','Undelivered');
		$packed_status = array('Order Picked');
		$placed_status = array();
		$status = array();
		$return_status = array('Return Received','Return Cancelled','Return Reschedule');
		
		
		$this->db->select("op.order_id,op.prod_id,op.prod_name,op.prod_name_ar,op.qty,op.prod_price,DATE(op.create_date) as orderdate,op.status,op.delivery_date,
				o.payment_mode,o.fullname,o.mobile,o.locality,o.fulladdress,o.city,o.state,o.pincode,o.addresstype,o.lat,o.lang");
		
		//join for get vendor product
		$this->db->join('order_product op', 'op.prod_id = dbo.product_id AND op.order_id = dbo.order_id ','INNER');
		
		$this->db->join('orders o', 'o.order_id = dbo.order_id','LEFT');
				
		// 'o.status !='=> 'Delivered'		
		$this->db->where(array('dbo.delivery_boy'=>$user_id));
		
		$todaydays = DATE('Y-m-d');
		//$this->db->where('DATE(op.create_date) BETWEEN ',$todaydays.' - INTERVAL 30 DAY and  CURDATE()');
		//$this->db->where('DATE(op.create_date) >= ',$todaydays);
		
		//$this->db->where('op.create_date BETWEEN DATE_SUB(NOW(), INTERVAL 10 DAY) AND CURDATE()');
		$date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 3, date('Y')));
        $this->db->where('op.create_date >', $date);
		
		$this->db->order_by("op.create_date", "desc");
		$query1 = $this->db->get('delivery_boy_orders dbo');
		
		//print_r($this->db->last_query());
		
		$total_orders = $pending_order= $delivered_order = $returned_pickup_order = 0;
		$order_details = $order_list = array();
		if($query1->num_rows() >0){
			$delivery_boy_orders = $query1->result_object();
			
			foreach($delivery_boy_orders as $orders){
				$order_list['orderid'] = $orders->order_id;
				$order_list['prod_id'] = $orders->prod_id;
				$order_list['orderdate'] = date('d-m-Y',strtotime($orders->orderdate));
				$order_list['orderstatus'] = $orders->status;
				$order_list['shippingParcelId'] = '';
				$order_list['prod_name'] = $orders->prod_name;
				$order_list['prod_name_ar'] = $orders->prod_name_ar;
				$order_list['name'] = $orders->fullname;
				$order_list['phone'] = $orders->mobile;
				$order_list['address'] = $orders->fulladdress;
				$order_list['city'] = $orders->city;
				$order_list['pincode'] = $orders->pincode;
				$order_list['addresstype'] = $orders->addresstype;
				$order_list['deliverydate'] = date('d-m-Y',strtotime($orders->delivery_date));
				$order_list['orderprice'] = price_format($orders->prod_price);
				$order_list['item'] = $orders->qty;
				$order_list['lat'] = $orders->lat;
				$order_list['lang'] = $orders->lang;
				$order_list['paymentmode'] = $orders->payment_mode;
				if($orders->status=='Shipped' || $orders->status=='Out for Delivery' || $orders->status=='Reschedule' || $orders->status=='Undelivered'){
					$order_list['update_status'] = $shipped_status;
				}else if($orders->status=='Placed'){
					$order_list['update_status'] = $placed_status;
				}else if($orders->status=='Picked'){
					$order_list['update_status'] = $packed_status;
				}
				else if($orders->status=='Return Request'){
					$order_list['update_status'] = $return_status;
				}
				else
				{
					$order_list['update_status'] = $status;
				}
				$order_list['paymentmode'] = $orders->payment_mode;
				$order_details[] = $order_list;
				
				if($orders->status =='Delivered'){
					$delivered_order++;
				}
				
				if($orders->status =='Returned'){
					$returned_pickup_order++;
				}
				$total_orders++;
			}
			$pending_order = $total_orders-($delivered_order);
			return array('total_orders'=>$total_orders,'pending_order'=>$pending_order,'delivered_order'=>$delivered_order,'returned_pickup_order'=>$returned_pickup_order,'order_details'=>$order_details);
		}

	}
	
	function get_search_order_list_details($search){ //Returned
		$shipped_status = array('Out for Delivery','Delivered','Reschedule','Undelivered');
		$packed_status = array('Order Picked');
		$placed_status = array();
		$status = array();
		$return_status = array('Return Received','Return Cancelled','Return Reschedule');
		
		
		$this->db->select("op.order_id,op.prod_id,op.prod_name,op.prod_name_ar,op.qty,op.prod_price,DATE(op.create_date) as orderdate,op.status,op.delivery_date,
				o.payment_mode,o.fullname,o.mobile,o.locality,o.fulladdress,o.city,o.state,o.pincode,o.addresstype,o.lat,o.lang");
		
		//join for get vendor product
		$this->db->join('order_product op', 'op.prod_id = dbo.product_id AND op.order_id = dbo.order_id ','INNER');
		
		$this->db->join('orders o', 'o.order_id = dbo.order_id','LEFT');
				
		$this->db->like(array('op.order_id'=>$search));
		
		
		$query1 = $this->db->get('delivery_boy_orders dbo');
		
		//print_r($this->db->last_query());
		
		$total_orders = $pending_order= $delivered_order = $returned_pickup_order = 0;
		$order_details = $order_list = array();
		if($query1->num_rows() >0){
			$delivery_boy_orders = $query1->result_object();
			
			foreach($delivery_boy_orders as $orders){
				$order_list['orderid'] = $orders->order_id;
				$order_list['prod_id'] = $orders->prod_id;
				$order_list['orderdate'] = date('d-m-Y',strtotime($orders->orderdate));
				$order_list['orderstatus'] = $orders->status;
				$order_list['shippingParcelId'] = '';
				$order_list['prod_name'] = $orders->prod_name;
				$order_list['prod_name_ar'] = $orders->prod_name_ar;
				$order_list['name'] = $orders->fullname;
				$order_list['phone'] = $orders->mobile;
				$order_list['address'] = $orders->fulladdress;
				$order_list['city'] = $orders->city;
				$order_list['pincode'] = $orders->pincode;
				$order_list['addresstype'] = $orders->addresstype;
				$order_list['deliverydate'] = date('d-m-Y',strtotime($orders->delivery_date));
				$order_list['orderprice'] = price_format($orders->prod_price);
				$order_list['item'] = $orders->qty;
				$order_list['lat'] = $orders->lat;
				$order_list['lang'] = $orders->lang;
				$order_list['paymentmode'] = $orders->payment_mode;
				if($orders->status=='Shipped' || $orders->status=='Out for Delivery' || $orders->status=='Reschedule' || $orders->status=='Undelivered'){
					$order_list['update_status'] = $shipped_status;
				}else if($orders->status=='Placed'){
					$order_list['update_status'] = $placed_status;
				}else if($orders->status=='Picked'){
					$order_list['update_status'] = $packed_status;
				}
				else if($orders->status=='Return Request'){
					$order_list['update_status'] = $return_status;
				}
				else
				{
					$order_list['update_status'] = $status;
				}
				$order_list['paymentmode'] = $orders->payment_mode;
				$order_details[] = $order_list;
				
				if($orders->status =='Delivered'){
					$delivered_order++;
				}
				
				if($orders->status =='Returned'){
					$returned_pickup_order++;
				}
				$total_orders++;
			}
			$pending_order = $total_orders-($delivered_order);
			return array('total_orders'=>$total_orders,'pending_order'=>$pending_order,'delivered_order'=>$delivered_order,'returned_pickup_order'=>$returned_pickup_order,'order_details'=>$order_details);
		}

	}
	
	function validate_order($user_id,$order_id , $prod_id){
		$this->db->select("dbo.product_id, dbo.order_id");
		
		$this->db->where(array('dbo.delivery_boy'=>$user_id,'dbo.product_id'=>$prod_id,'dbo.order_id'=>$order_id, 'dbo.status !='=> 'Delivered'));
		
		
		$query1 = $this->db->get('delivery_boy_orders dbo');
		
		if($query1->num_rows() >0){
			return "exist";
		}
	}
	
	
	// string of specified length 
	function random_strings($length_of_string){ 
  
		// String of all alphanumeric character 
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
		// Shufle the $str_result and returns substring 
		// of specified length 
		return substr(str_shuffle($str_result),0, $length_of_string); 
	}
	
   
}
