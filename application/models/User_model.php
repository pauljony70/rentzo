<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}


	//Functiofor validate user
	function validate_user($fullname, $phone, $email)
	{
		$user_result = array();

		$this->db->select('*');
		$this->db->where(array('phone' => $phone));
		$this->db->or_where(array('email' => $email));
		$query = $this->db->get('appuser_login');

		if ($query->num_rows() > 0) {
			$user_result['status'] = 'exist';
			return $user_result;
			die();
		} else {
			$user_unique_id = 'U' . $this->random_strings(10);
			
			$data['login_method'] = 'general';
			$data['status'] = 1;
			$data['user_unique_id'] = $user_unique_id;
			$data['fullname'] = $fullname;
			$data['phone'] = $phone;
			$data['email'] = $email;
			$data['password'] = '';
			$data['create_by'] = $this->date_time;

			$this->db->insert('appuser_login', $data);
			$insert_id = $this->db->insert_id();

			$this->db->select('*');
			$this->db->where(array('id' => $insert_id));
			$query1 = $this->db->get('appuser_login');

			$user_result1 = $query1->result_object()[0];

			$img_decode = json_decode($user_result1->profile_pic);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_result1->profile_pic;
			}

			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
			$user_result['profile_pic'] = $img;
		}

		return $user_result;
	}

	//Functiofor validate user
	function validate_user_old($user_phone = '', $qouteid)
	{
		$user_result = array();

		$this->db->select('*');
		$this->db->where(array('phone' => $user_phone));
		$query = $this->db->get('appuser_login');

		if ($query->num_rows() > 0) {
			$user_result1 = $query->result_object()[0];

			$img_decode = json_decode($user_result1->profile_pic);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_result1->profile_pic;
			}

			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
			$user_result['profile_pic'] = $img;
		} else {
			$user_unique_id = 'U' . $this->random_strings(10);
			$data['phone'] = $user_phone;
			$data['status'] = 1;
			$data['user_unique_id'] = $user_unique_id;
			$data['create_by'] = $this->date_time;

			$this->db->insert('appuser_login', $data);

			$this->db->select('*');
			$this->db->where(array('phone' => $user_phone));
			$query1 = $this->db->get('appuser_login');

			$user_result1 = $query1->result_object()[0];

			$img_decode = json_decode($user_result1->profile_pic);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_result1->profile_pic;
			}

			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
			$user_result['profile_pic'] = $img;
		}
		if ($qouteid) {
			//get_cart_product
			$usercart = $this->get_cart_details($user_result1->user_unique_id, '');

			$quotecart = $this->get_cart_details('', $qouteid);

			foreach ($usercart as $product_id) {
				if (in_array($product_id, $quotecart)) {
					$this->db->where(array('prod_id' => $product_id, 'user_id' => $user_result1->user_unique_id));
					$this->db->delete('cartdetails');
				}
			}
			$cart = array();

			$cart['user_id'] = $user_result1->user_unique_id;

			$this->db->where(array('qoute_id' => $qouteid));
			$this->db->update('cartdetails', $cart);
		}

		return $user_result;
	}

	//Functiofor validate login user
	function validate_user_login($user_phone = '', $qouteid, $otp_login = '')
	{
		$user_result = array();


		$this->db->select('*');
		$this->db->where(array('phone' => $user_phone, 'otp' => $otp_login));
		$query_m = $this->db->get('app_user_otp');
		if ($query_m->num_rows() > 0) {
			$user_result['otp_status'] = 1;
		} else {
			$user_result['status'] = 'wrong_otp';
			return $user_result;
		}


		$this->db->select('*');
		$this->db->where(array('phone' => $user_phone));
		$query = $this->db->get('appuser_login');

		if ($query->num_rows() > 0) {
			$user_result1 = $query->result_object()[0];

			$img_decode = json_decode($user_result1->profile_pic);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_result1->profile_pic;
			}

			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
			$user_result['profile_pic'] = $img;
		} else {
			$user_result['status'] = 'not_exist';
			return $user_result;
			die();
		}
		if ($qouteid) {
			//get_cart_product
			$usercart = $this->get_cart_details($user_result1->user_unique_id, '');

			$quotecart = $this->get_cart_details('', $qouteid);

			foreach ($usercart as $product_id) {
				if (in_array($product_id, $quotecart)) {
					$this->db->where(array('prod_id' => $product_id, 'user_id' => $user_result1->user_unique_id));
					$this->db->delete('cartdetails');
				}
			}
			$cart = array();

			$cart['user_id'] = $user_result1->user_unique_id;

			$this->db->where(array('qoute_id' => $qouteid));
			$this->db->update('cartdetails', $cart);
		}

		return $user_result;
	}

	function validateEmailLogin($email = '', $qouteid, $otp_login = '')
	{
		$user_result = array();
		if ($otp_login === $this->session->tempdata('email_otp')) {
			$user_result['otp_status'] = 1;
		} else {
			$user_result['status'] = 'wrong_otp';
			return $user_result;
		}


		$this->db->select('*');
		$this->db->where(array('email' => $email));
		$query = $this->db->get('appuser_login');

		if ($query->num_rows() > 0) {
			$user_result1 = $query->result_object()[0];

			$img_decode = json_decode($user_result1->profile_pic);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_result1->profile_pic;
			}

			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
			$user_result['profile_pic'] = $img;
		} else {
			$user_result['status'] = 'not_exist';
			return $user_result;
			die();
		}
		if ($qouteid) {
			//get_cart_product
			$usercart = $this->get_cart_details($user_result1->user_unique_id, '');

			$quotecart = $this->get_cart_details('', $qouteid);

			foreach ($usercart as $product_id) {
				if (in_array($product_id, $quotecart)) {
					$this->db->where(array('prod_id' => $product_id, 'user_id' => $user_result1->user_unique_id));
					$this->db->delete('cartdetails');
				}
			}
			$cart = array();

			$cart['user_id'] = $user_result1->user_unique_id;

			$this->db->where(array('qoute_id' => $qouteid));
			$this->db->update('cartdetails', $cart);
		}

		return $user_result;
	}

	function createUserUsingThirdPartyLoginMethod($data, $method)
	{
		$user_result = array();
		$user_result['error'] = '';
		$this->db->select('*');
		$this->db->where(array('email' => $data['email']));
		$query = $this->db->get('appuser_login');

		if ($query->num_rows() > 0) {
			// Do Something
			$user_data = $this->db->get_where('appuser_login', array('email' => $data['email']))->row_array();
			// if ($user_data['login_method'] != $method) {
			// 	// Do Something
			// 	$user_result['error'] = 'login_method_error';
			// } else {
			$user_result['user_id'] = $user_data['user_unique_id'];
			$user_result['name'] = $user_data['fullname'];
			$user_result['phone'] = $user_data['phone'];
			$user_result['email'] = $user_data['email'];
			$user_result['status'] = $user_data['status'];
			$img_decode = json_decode($user_data['profile_pic']);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_data['profile_pic'];
			}
			$user_result['profile_pic'] = $img;
			// }
		} else {
			$user_unique_id = 'U' . $this->random_strings(10);
			$data['user_unique_id'] = $user_unique_id;
			$data['password'] = '';
			$data['create_by'] = $this->date_time;
			$data['login_method'] = $method;
			$data['status'] = 1;

			$this->db->insert('appuser_login', $data);
			$insert_id = $this->db->insert_id();

			$this->db->select('*');
			$this->db->where(array('id' => $insert_id));
			$query1 = $this->db->get('appuser_login');

			$user_result1 = $query1->result_object()[0];
			$wallet_id = generateUniqueWalletID();

			$data_wallet['user_id'] = $user_result1->user_unique_id;
			$data_wallet['wallet_id'] = $wallet_id;
			$data_wallet['amount'] = 0;
			$data_wallet['created_at'] = $this->date_time;
			$this->db->insert('wallet_summery', $data_wallet);

			$img_decode = json_decode($user_result1->profile_pic);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_result1->profile_pic;
			}

			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
			$user_result['profile_pic'] = $img;
		}

		return $user_result;
	}

	function validate_user_login_first($user_phone = '', $email = '')
	{
		$user_result = array();



		$this->db->select('*');
		if (!empty($user_phone))
			$this->db->where(array('phone' => $user_phone));
		if (!empty($email))
			$this->db->where(array('email' => $email));
		// $this->db->where(array('login_method' => 'general'));
		$query = $this->db->get('appuser_login');

		if ($query->num_rows() > 0) {

			$user_result['status'] = $user_result1->status;

			return $user_result;
		} else {
			$user_result['status'] = 'not_exist';
			return $user_result;
			die();
		}
	}

	//function for save user opt
	function save_user_otp($user_phone, $otp)
	{
		$this->db->delete('app_user_otp', array('phone' => $user_phone));

		$data['phone'] = $user_phone;
		$data['otp'] = $otp;

		$this->db->insert('app_user_otp', $data);
	}

	//function for get user opt
	function get_user_otp($user_phone)
	{
		$otp = '';

		$this->db->select('otp');
		$this->db->where(array('phone' => $user_phone));
		$query = $this->db->get('app_user_otp');

		if ($query->result_object()) {
			$user_result = $query->result_object()[0];
			$otp = $user_result->otp;
		}
		return $otp;
	}

	function get_cart_details($user_id, $quote_id)
	{
		$this->db->select("prod_id");

		if ($user_id) {
			$this->db->where(array('user_id' => $user_id));
		} else {
			$this->db->where(array('qoute_id' => $quote_id));
		}


		$query = $this->db->get('cartdetails');

		$cart_result = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result_object() as $result) {
				$cart_result[] = $result->prod_id;
			}
		}
		return $cart_result;
	}

	function get_user_review_ratings($user_id, $pageno)
	{
		if ($pageno > 0) {
			$start = ($pageno * LIMIT);
		} else {
			$start = 0;
		}

		$this->db->select("pr.review_id,rating,pr.title as review_title,pr.comment as review_comment,pr.created_at as review_date, apl.fullname as user_name, pd.prod_name as product_name");
		$this->db->join('appuser_login apl', 'apl.user_unique_id = pr.user_id', 'INNER');
		$this->db->join('product_details pd', 'pd.product_unique_id = pr.product_id', 'INNER');
		$this->db->where(array('pr.user_id' => $user_id));
		$this->db->order_by('pr.created_at', 'DESC');
		$this->db->limit(LIMIT, $start);
		$query_review = $this->db->get('product_review pr');

		$reviews = array();
		if ($query_review->num_rows() > 0) {
			$reviews = $query_review->result_object();
		}
		return $reviews;
	}

	function get_user_profile($user_id)
	{

		$this->db->select('user_unique_id, fullname, phone, email,profile_pic');
		$this->db->where(array('user_unique_id' => $user_id));
		$query = $this->db->get('appuser_login');

		$user_result = array();
		if ($query->num_rows() > 0) {
			$user_result1 = $query->result_object()[0];

			$img_decode = json_decode($user_result1->profile_pic);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_result1->profile_pic;
			}

			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['profile_pic'] = $img;
		}
		return $user_result;
	}

	// string of specified length 
	function random_strings($length_of_string)
	{

		// String of all alphanumeric character 
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		// Shufle the $str_result and returns substring 
		// of specified length 
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}
}
