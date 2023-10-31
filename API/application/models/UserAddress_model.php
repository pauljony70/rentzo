<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserAddress_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
		$this->date_time = date('Y-m-d H:i:s');
    }

    //Functiofor for add product into cart
    function add_user_address($username,$mobile,$pincode,$user_id,$locality,$fulladdress,$state, $city, $addresstype,$email){
		$this->db->select("user_id");
		$this->db->where(array('user_id'=>$user_id));
		
		$query = $this->db->get('address');
		
		$address = array();
		$status = '';
		
		
		if($query->num_rows() >0){
			$all_address1 = $this->get_user_address_details($user_id);
			$all_address = $all_address1['address'];
			
			$addressid_count =count($all_address)+1;
			$address_json_array =	array(
		 			 'address_id' => $addressid_count,
		 			 'fullname' => $username,
		 			 'mobile' => $mobile,
		 			 'locality' => $locality,
		 			 'fulladdress' => $fulladdress,
		 			 'city' => $city,
		 			 'state' => $state,
		 			 'pincode' =>$pincode,
		 			 'email' =>$email,
		 			 'addresstype' => $addresstype );
					 
			
			$address_json = array_merge($all_address,array($address_json_array));
			
			$address['addressarray'] = json_encode($address_json);
			$address['defaultaddress'] = $addressid_count;
			
			
			$this->db->where(array('user_id'=>$user_id));
			
			$query = $this->db->update('address', $address);
			if($query){
				$status = 'done';
			}
		}else{
			$addressid_count =1;
			$address_json_array =	array(
		 			 'address_id' => $addressid_count,
		 			 'fullname' => $username,
		 			 'mobile' => $mobile,
		 			 'locality' => $locality,
		 			 'fulladdress' => $fulladdress,
		 			 'city' => $city,
		 			 'state' => $state,
		 			 'pincode' =>$pincode,
		 			 'addresstype' => $addresstype );
					 
			$address['addressarray'] = json_encode(array($address_json_array));
			$address['defaultaddress'] = 1;
			$address['user_id'] = $user_id;
			
			
			$query = $this->db->insert('address', $address);
			if($query){
				$status = 'done';
			}
		}
		return $status;
    }
	
	
	//Functiofor for delete product from cart
	function delete_address($user_id,$address_id){
		$status='';
		$valid_id = '';
		$add_arry = $this->get_user_address_details($user_id);
		
		$address_array =$add_arry['address'];
		
		
		foreach($address_array as $key => $all_address){
			
			if($address_id == $all_address['address_id']){
				unset($address_array[$key]);
				$valid_id = 'yes';
			}
		}
		
		if($valid_id == 'yes'){
			$address_array_new = array_values($address_array);
			
			$defaultaddress =$add_arry['defaultaddress'];
			if($defaultaddress == $address_id){
				$defaultaddress_new = $address_array_new[0]['address_id'];
			}else{
				$defaultaddress_new = $defaultaddress;
			}
			
			$address['addressarray'] = json_encode($address_array_new);
			$address['defaultaddress'] = $defaultaddress_new;
			
			
			$this->db->where(array('user_id'=>$user_id));
			
			$query = $this->db->update('address', $address);
			if($query){
				$status = 'delete';
			}
		}else{
			$status = 'invalid';
		}
		return $status;
	}
	
	//Functiofor for update product from cart
	function update_address($user_id,$address_id){
		$status='';		
		
		$address['defaultaddress'] = $address_id;		
		
		$this->db->where(array('user_id'=>$user_id));
		
		$query = $this->db->update('address', $address);
		if($query){
			$status = 'update';
		}
		return $status;
	}
	
	//function for get user cart details
	
	function get_user_address_details($user_id){
		$this->db->select("user_id, addressarray, defaultaddress");
		$this->db->where(array('user_id'=>$user_id));
		
		$query = $this->db->get('address');
		
		$address = array();
		$address1 = array();
		$defaultaddress = '';
		if($query->num_rows() >0){
			$address_result = $query->result_object();
			
			$addressarray = $address_result[0]->addressarray;
			$defaultaddress = $address_result[0]->defaultaddress;
			
			$address1 = json_decode($addressarray,true);
		}
		
		 $address['address']= $address1;
		 $address['defaultaddress']= $defaultaddress;
		 return $address;
	}
	
	
		
	//function for get user address details
	
	function get_user_address_details_full($user_id){
		$this->db->select("user_id, addressarray, defaultaddress");
		$this->db->where(array('user_id'=>$user_id));
		
		$query = $this->db->get('address');
		
		$defaultaddress = '';
		$address = array();
		$address_array = array();
		if($query->num_rows() >0){
			$address_result = $query->result_object();
			
			$defaultaddress = $address_result[0]->defaultaddress;
			$addressarray = $address_result[0]->addressarray;
			
			$address_array = json_decode($addressarray,true);
		}
		$address['defaultaddress'] = $defaultaddress;
		$address['address_details'] = $address_array;
			
		return $address;
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
