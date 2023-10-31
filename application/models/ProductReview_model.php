<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductReview_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
		$this->date_time = date('Y-m-d H:i:s');
    }

    //Functiofor for add review
    function add_product_review($pid,$user_id,$review_title,$review_comment,$review_rating){
		
		$product_response = array('user_name'=>'','rating'=>0,'review_title'=>'','review_comment'=>'','review_date'=>'');
		
		//check product
		$this->db->select("id");
		$this->db->where(array('product_unique_id' => $pid,'status'=>1));
		

		$query = $this->db->get('product_details');
		
		if($query->num_rows() ==0){
			return 'product_error';
		}
		
		//check user		
		$this->db->select("id,fullname");
		$this->db->where(array('user_unique_id' => $user_id,'status'=>1));
		

		$query_user = $this->db->get('appuser_login');
		$user_name = '';
		if($query_user->num_rows() ==0){
			return 'user_error';
		}else {
			$user_result = $query_user->result_object();
			
			$user_name = $user_result[0]->fullname;
		}
		
		//check user product		
		$this->db->select("op.id");
		$this->db->join('orders o', 'o.order_id = op.order_id','INNER');
		$this->db->where(array('op.prod_id' => $pid,'o.user_id'=>$user_id));
		

		$query_user_prod = $this->db->get('order_product op');
		
		if($query_user_prod->num_rows() ==0){
			return 'user_prod_error';
		}
		
		
		$review = array();
		
		$review['user_id'] = $user_id;				
		$review['rating'] = $review_rating;				
		$review['title'] = $review_title;				
		$review['comment'] = $review_comment;				
		$review['created_at'] = $this->date_time;				
		$review['product_id'] = $pid;
		$review['status'] = 1;
		
		//check review
		$this->db->select("review_id");
		$this->db->where(array('user_id' => $user_id,'product_id'=>$pid));
		

		$query_review = $this->db->get('product_review');
		
		if($query_review->num_rows() ==0){
			$query = $this->db->insert('product_review', $review);
		}else{
			$this->db->where(array('user_id' => $user_id,'product_id'=>$pid));
		
			$query = $this->db->update('product_review', $review);
		}
		
		
		if($query){
			$product_response = array('user_name'=>$user_name,'rating'=>$review_rating,'review_title'=>$review_title,'review_comment'=>$review_comment,'review_date'=>$review['created_at']);
		
		}
		
		return $product_response;
    }
	
	
	//Functiofor for delete review
    function delete_product_review($pid,$user_id,$review_id){
		
		$product_response = array();
		
		//check review
		$this->db->select("review_id");
		$this->db->where(array('review_id' => $review_id));
		

		$queryr = $this->db->get('product_review');
		
		if($queryr->num_rows() ==0){
			return 'review_error';
		}
		
		
		//check product
		$this->db->select("id");
		$this->db->where(array('product_unique_id' => $pid,'status'=>1));
		

		$query = $this->db->get('product_details');
		
		if($query->num_rows() ==0){
			return 'product_error';
		}
		
		//check user		
		$this->db->select("id,fullname");
		$this->db->where(array('user_unique_id' => $user_id,'status'=>1));
		

		$query_user = $this->db->get('appuser_login');
		$user_name = '';
		if($query_user->num_rows() ==0){
			return 'user_error';
		}
		
		//check user product		
		$this->db->select("op.id");
		$this->db->join('orders o', 'o.order_id = op.order_id','INNER');
		$this->db->where(array('op.prod_id' => $pid,'o.user_id'=>$user_id));
		

		$query_user_prod = $this->db->get('order_product op');
		
		if($query_user_prod->num_rows() ==0){
			return 'user_prod_error';
		}
		
		
	
		$this->db->where(array('user_id' => $user_id,'product_id'=>$pid,'review_id'=>$review_id));
		

		$query_review = $this->db->delete('product_review');
		
		
		
		if($query_review){
			$product_response = 'done';
		
		}
		
		return $product_response;
    }

}
