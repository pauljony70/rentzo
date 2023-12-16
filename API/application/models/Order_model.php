<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('email_model');
		$this->date_time = date('Y-m-d H:i:s');
	}



	function get_order_list_details($user_id)
	{
		$this->db->select("o.order_id, o.status, o.total_price, o.payment_mode, o.create_date, o.discount,o.total_qty");


		$this->db->where(array('o.user_id' => $user_id));

		$this->db->order_by("o.sno", 'desc');

		$query = $this->db->get('orders o');

		$product_detail_array = array();
		$orders = array();

		if ($query->num_rows() > 0) {
			$order_result = $query->result_object();
			foreach ($order_result as $order_detail) {
				$orders['order_id'] = $order_detail->order_id;
				$orders['status'] = $order_detail->status;
				$orders['payment_mode'] = $order_detail->payment_mode;
				$orders['create_date'] = $order_detail->create_date;
				$orders['total_qty'] = $order_detail->total_qty;
				$orders['total_price'] = price_format($order_detail->total_price);
				$orders['discount'] = price_format($order_detail->discount);

				$product_detail_array[] = $orders;
			}
		}

		return $product_detail_array;
	}



	function get_order_full_details($user_id, $order_id, $pid)
	{
		$this->db->select("o.order_id, o.status, o.total_price,o.payment_mode,o.create_date, o.discount,o.total_qty, o.fullname, o.mobile, o.fulladdress, o.country, o.region, o.governorate, o.area, o.addresstype, o.email, o.coupon_code, o.coupon_value,o.city,o.state,o.pincode");

		$this->db->where(array('o.user_id' => $user_id, 'o.order_id' => $order_id));
		$query = $this->db->get('orders o');

		$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
		$shipping_address = array('fullname' => '', 'mobile' => '', 'fulladdress' => '', 'country' => '', 'region' => '', 'area' => '', 'governorate' => '', 'addresstype' => '', 'email' => '');
		$orders = $shipping = array();
		$order_product_array = $order_product = array();

		if ($query->num_rows() > 0) {
			$order_result = $query->result_object();
			$order_detail = $order_result[0];
			$orders['order_id'] = $order_detail->order_id;

			$orders['payment_mode'] = $order_detail->payment_mode;
			$orders['create_date'] = date('d-m-Y', strtotime($order_detail->create_date));




			$shipping['fullname'] = $order_detail->fullname;
			$shipping['mobile'] = $order_detail->mobile;
			$shipping['fulladdress'] = $order_detail->fulladdress;
			$shipping['city'] = $order_detail->city;
			$shipping['state'] = $order_detail->state;
			$shipping['country'] = $order_detail->country;
			$shipping['region'] = $order_detail->region;
			$shipping['area'] = $order_detail->area;
			$shipping['pincode'] = $order_detail->pincode;
			$shipping['governorate'] = $order_detail->governorate;
			$shipping['addresstype'] = $order_detail->addresstype;
			$shipping['email'] = $order_detail->email;

			$shipping_address = $shipping;

			$this->db->select("op.prod_id,op.prod_sku,op.prod_name,op.prod_img,op.prod_attr,op.qty,op.prod_price,op.shipping,op.discount,op.status, sl.companyname,sl.seller_unique_id");

			$this->db->JOIN('sellerlogin sl', 'sl.seller_unique_id = op.vendor_id', 'INNER');

			$this->db->where(array('op.order_id' => $order_id, 'op.prod_id' => $pid));


			$query_prod = $this->db->get('order_product op');


			if ($query_prod->num_rows() > 0) {
				$order_prod_result = $query_prod->result_object();

				foreach ($order_prod_result as $order_prod_detail) {
					$order_product['prod_id'] = $order_prod_detail->prod_id;
					$order_product['prod_sku'] = $order_prod_detail->prod_sku;
					$order_product['prod_name'] = $order_prod_detail->prod_name;
					$order_product['prod_img'] = base_url('media/') . $order_prod_detail->prod_img;
					$order_product['qty'] = $order_prod_detail->qty;
					$order_product['prod_price'] = price_format($order_prod_detail->prod_price);
					$order_product['shipping'] = price_format($order_prod_detail->shipping);
					$order_product['discount'] = price_format($order_prod_detail->discount);
					$order_product['prod_mrp'] = price_format($order_prod_detail->prod_price + $order_prod_detail->discount);
					$order_product['status'] = $order_prod_detail->status;
					$order_product['coupon_code'] = $order_detail->coupon_code;
					$order_product['coupon_value'] = price_format($order_detail->coupon_value);
					$order_product['final_value'] = price_format(($order_prod_detail->prod_price - $order_detail->coupon_value) + $order_prod_detail->shipping);
					$order_product['companyname'] = $order_prod_detail->companyname;
					$order_product['vendor_id'] = $order_prod_detail->seller_unique_id;
					$order_product['tax'] = 0;
					if ($order_prod_detail->prod_attr) {
						$attr = json_decode($order_prod_detail->prod_attr);
						/*$attribute = '';
							foreach($attr as $prod_attr){
								$attribute .= $prod_attr->attr_name.': '.$prod_attr->item.', ';
							}
							
							$order_product['attribute'] = rtrim($attribute,', ');*/
						$order_product['attribute'] = $attr;
					} else {
						$order_product['attribute'] = '';
					}

					$orders['status'] = $order_prod_detail->status;
					$orders['total_qty'] = $order_prod_detail->qty;
					$orders['total_price'] = price_format($order_prod_detail->prod_price);
					$orders['discount'] = price_format($order_prod_detail->discount);
					$orders['total_mrp'] = price_format($order_prod_detail->discount + $order_prod_detail->prod_price);

					$order_summery = $orders;
					$order_product_array[] = $order_product;
				}
			}
		}

		return array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => $order_product_array);
	}

	function seller_change_order_status_details($order_id, $pid, $status1)
	{
		$msg = "";
		$this->db->select("op.prod_id,op.status,op.prod_name,o.user_id,op.prod_price");


		$this->db->where(array('op.order_id' => $order_id, 'op.prod_id' => $pid));

		$this->db->JOIN('orders o', 'o.order_id = op.order_id', 'INNER');
		$this->db->JOIN('appuser_login ul', 'ul.user_unique_id = o.user_id', 'INNER');

		$query_prod = $this->db->get('order_product op');

		if ($query_prod->num_rows() > 0) {
			$order_prod_result = $query_prod->result_object();

			$status = $order_prod_result[0]->status;
			$prod_name = $order_prod_result[0]->prod_name;
			$user_id = $order_prod_result[0]->user_id;
			$prod_price = $order_prod_result[0]->prod_price;
			if ($status == $status1 && $status1 == 'Cancelled' || $status == 'Cancelled') {
				$msg = 'already_cancelled';
			} else if ($status1 != 'Cancelled' && $status != 'Cancelled') {

				$this->db->where(array('order_id' => $order_id, 'prod_id' => $pid));

				$query_prod1 = $this->db->update('order_product', array('status' => $status1));

				$msg = 'done';
			} else if ($status1 == 'Cancelled') {
				$this->db->where(array('order_id' => $order_id, 'prod_id' => $pid));

				$query_prod1 = $this->db->update('order_product', array('status' => $status1));


				/*$this->email_model->send_order_email($order_id,CANCEL_ORDER_TEMP, $pid);*/
				$msg = "done";
			} else {
				$msg = "invalid";
			}
		} else {
			$msg = "not_exist";
		}

		return $msg;
	}

	function get_order_list_details_seller($user_id, $pageno)
	{

		if ($pageno > 0) {
			$start = ($pageno * LIMIT);
		} else {
			$start = 0;
		}

		$this->db->select("o.order_id,op.status, o.total_price,o.payment_mode,o.create_date,
							o.discount,o.total_qty,op.vendor_id,op.prod_id,op.prod_name,op.prod_img");

		$this->db->JOIN('order_product op', 'o.order_id = op.order_id', 'INNER');

		$this->db->where(array('op.vendor_id' => $user_id));

		$this->db->order_by("o.sno", 'desc');
		$this->db->limit(LIMIT, $start);
		$query = $this->db->get('orders o');

		$product_detail_array = array();
		$orders = array();

		if ($query->num_rows() > 0) {
			$order_result = $query->result_object();
			foreach ($order_result as $order_detail) {
				$orders['order_id'] = $order_detail->order_id;
				$orders['status'] = $order_detail->status;
				$orders['payment_mode'] = $order_detail->payment_mode;
				$orders['create_date'] = date('d-m-Y h:i:sA', strtotime($order_detail->create_date));
				$orders['total_qty'] = $order_detail->total_qty;
				$orders['total_price'] = price_format($order_detail->total_price);
				$orders['discount'] = price_format($order_detail->discount);
				$orders['prod_id'] = $order_detail->prod_id;
				$orders['prod_name'] = $order_detail->prod_name;
				$orders['prod_img'] = $order_detail->prod_img;

				$product_detail_array[] = $orders;
			}
		}

		return $product_detail_array;
	}

	function get_order_full_details_seller($user_id, $order_id, $pid)
	{
		$this->db->select("o.order_id, o.status, o.total_price, o.payment_mode, o.create_date, o.discount, o.total_qty, o.fullname, o.mobile, o.fulladdress, o.country, o.region, o.governorate, o.area, o.email, o.coupon_code, o.coupon_value");

		$this->db->JOIN('order_product op', 'o.order_id = op.order_id', 'INNER');

		$this->db->where(array('op.vendor_id' => $user_id, 'o.order_id' => $order_id));


		$query = $this->db->get('orders o');

		$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
		$shipping_address = array('fullname' => '', 'mobile' => '', 'fulladdress' => '', 'country' => '', 'region' => '', 'governorate' => '', 'area' => '', 'addresstype' => '', 'email' => '');
		$orders = $shipping = array();
		$order_product_array = $order_product = array();

		if ($query->num_rows() > 0) {
			$order_result = $query->result_object();
			$order_detail = $order_result[0];
			$orders['order_id'] = $order_detail->order_id;

			$orders['payment_mode'] = $order_detail->payment_mode;
			$orders['create_date'] = date('d-m-Y', strtotime($order_detail->create_date));




			$shipping['fullname'] = $order_detail->fullname;
			$shipping['mobile'] = $order_detail->mobile;
			$shipping['fulladdress'] = $order_detail->fulladdress;
			$shipping['country'] = $order_detail->country;
			$shipping['region'] = $order_detail->region;
			$shipping['governorate'] = $order_detail->governorate;
			$shipping['area'] = $order_detail->area;
			$shipping['addresstype'] = $order_detail->addresstype;
			$shipping['email'] = $order_detail->email;

			$shipping_address = $shipping;

			$this->db->select("op.prod_id,op.prod_sku,op.prod_name,op.prod_img,op.prod_attr,op.qty,op.prod_price,op.shipping,op.discount,op.status, sl.companyname,sl.seller_unique_id");

			$this->db->JOIN('sellerlogin sl', 'sl.seller_unique_id = op.vendor_id', 'INNER');

			$this->db->where(array('op.order_id' => $order_id, 'op.prod_id' => $pid));


			$query_prod = $this->db->get('order_product op');


			if ($query_prod->num_rows() > 0) {
				$order_prod_result = $query_prod->result_object();

				foreach ($order_prod_result as $order_prod_detail) {
					$order_product['prod_id'] = $order_prod_detail->prod_id;
					$order_product['prod_sku'] = $order_prod_detail->prod_sku;
					$order_product['prod_name'] = $order_prod_detail->prod_name;
					$order_product['prod_img'] = $order_prod_detail->prod_img;
					$order_product['qty'] = $order_prod_detail->qty;
					$order_product['prod_price'] = price_format($order_prod_detail->prod_price);
					$order_product['shipping'] = price_format($order_prod_detail->shipping);
					$order_product['discount'] = price_format($order_prod_detail->discount);
					$order_product['prod_mrp'] = price_format($order_prod_detail->prod_price + $order_prod_detail->discount);
					$order_product['status'] = $order_prod_detail->status;
					$order_product['coupon_code'] = $order_detail->coupon_code;
					$order_product['coupon_value'] = price_format($order_detail->coupon_value);
					$order_product['final_value'] = price_format(($order_prod_detail->prod_price - $order_detail->coupon_value) + $order_prod_detail->shipping);
					$order_product['companyname'] = $order_prod_detail->companyname;
					$order_product['vendor_id'] = $order_prod_detail->seller_unique_id;
					$order_product['tax'] = "0";
					if ($order_prod_detail->prod_attr) {
						$attr = json_decode($order_prod_detail->prod_attr);
						/*$attribute = '';
							foreach($attr as $prod_attr){
								$attribute .= $prod_attr->attr_name.': '.$prod_attr->item.', ';
							}
							
							$order_product['attribute'] = rtrim($attribute,', ');*/
						$order_product['attribute'] = $attr;
					} else {
						$order_product['attribute'] = '';
					}

					$orders['status'] = $order_prod_detail->status;
					$orders['total_qty'] = $order_prod_detail->qty;
					$orders['total_price'] = price_format($order_prod_detail->prod_price);
					$orders['discount'] = price_format($order_prod_detail->discount);
					$orders['total_mrp'] = price_format($order_prod_detail->discount + $order_prod_detail->prod_price);

					$order_summery = $orders;
					$order_product_array[] = $order_product;
				}
			}
		}

		return array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => $order_product_array);
	}



	function get_order_track_details($language_code, $order_id)
	{
		$this->db->select("o.order_id,o.status, o.total_price,o.payment_mode,o.create_date,
							o.discount,o.total_qty, o.fullname, o.mobile,o.locality, o.fulladdress,o.city,o.state,o.pincode,o.addresstype,o.email");


		$this->db->where(array('o.order_id' => $order_id));


		$query = $this->db->get('orders o');
		$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
		$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');

		$order_product_array = array();
		$orders = $shipping = array();
		//print_r($this->db->last_query());
		if ($query->num_rows() > 0) {
			$order_result = $query->result_object();
			$order_detail = $order_result[0];
			$orders['order_id'] = $order_detail->order_id;
			$orders['status'] = $order_detail->status;
			$orders['payment_mode'] = $order_detail->payment_mode;
			$orders['create_date'] = $order_detail->create_date;
			$orders['total_qty'] = $order_detail->total_qty;
			$orders['total_price'] = price_format($order_detail->total_price);
			$orders['discount'] = price_format($order_detail->discount);

			$order_summery = $orders;

			$shipping['fullname'] = $order_detail->fullname;
			$shipping['mobile'] = $order_detail->mobile;
			$shipping['locality'] = $order_detail->locality ?? '';
			$shipping['fulladdress'] = $order_detail->fulladdress;
			$shipping['city'] = $order_detail->city;
			$shipping['state'] = $order_detail->state;
			$shipping['pincode'] = $order_detail->pincode ?? '';
			$shipping['addresstype'] = $order_detail->addresstype;
			$shipping['email'] = $order_detail->email;

			$shipping_address = $shipping;

			$this->db->select("op.prod_id,op.prod_sku,op.prod_name,op.prod_img,op.prod_attr,op.qty,op.prod_price,op.shipping,op.discount,op.status, sl.companyname,sl.seller_unique_id");

			$this->db->JOIN('sellerlogin sl', 'sl.seller_unique_id = op.vendor_id', 'INNER');

			$this->db->where(array('op.order_id' => $order_id));


			$query_prod = $this->db->get('order_product op');

			$order_product_array = $order_product = array();

			if ($query_prod->num_rows() > 0) {
				$order_prod_result = $query_prod->result_object();

				foreach ($order_prod_result as $order_prod_detail) {
					$order_product['prod_id'] = $order_prod_detail->prod_id;
					$order_product['prod_sku'] = $order_prod_detail->prod_sku;
					$order_product['prod_name'] = $order_prod_detail->prod_name;
					$order_product['prod_img'] = $order_prod_detail->prod_img;
					$order_product['qty'] = $order_prod_detail->qty;
					$order_product['prod_price'] = price_format($order_prod_detail->prod_price);
					$order_product['shipping'] = price_format($order_prod_detail->shipping);
					$order_product['discount'] = price_format($order_prod_detail->discount);
					$order_product['prod_mrp'] = price_format($order_prod_detail->prod_price + $order_prod_detail->discount);
					$order_product['status'] = $order_prod_detail->status;
					$order_product['companyname'] = $order_prod_detail->companyname;
					$order_product['vendor_id'] = $order_prod_detail->seller_unique_id;
					if ($order_prod_detail->prod_attr) {
						$attr = json_decode($order_prod_detail->prod_attr);
						$attribute = '';
						foreach ($attr as $prod_attr) {
							$attribute .= $prod_attr->attr_name . ': ' . $prod_attr->item . ', ';
						}

						$order_product['attribute'] = rtrim($attribute, ', ');
					} else {
						$order_product['attribute'] = '';
					}

					$order_product_array[] = $order_product;
				}
			}
		}

		return array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => $order_product_array);
	}

	function change_order_status_details($order_id, $pid, $status1)
	{
		$msg = "";
		$this->db->select("op.prod_id,op.status,op.prod_name");


		$this->db->where(array('op.order_id' => $order_id, 'op.prod_id' => $pid));

		$query_prod = $this->db->get('order_product op');

		if ($query_prod->num_rows() > 0) {
			$order_prod_result = $query_prod->result_object();

			$status = $order_prod_result[0]->status;
			$prod_name = $order_prod_result[0]->prod_name;

			if ($status == $status1) {
				$msg = 'already_cancelled';
			} else if ($status != 'Delivered') {
				$this->db->where(array('order_id' => $order_id, 'prod_id' => $pid));

				$query_prod1 = $this->db->update('order_product', array('status' => $status1));
				$this->email_model->send_order_email($order_id, CANCEL_ORDER_TEMP, $pid);
				$msg = "done";
			} else {
				$msg = "invalid";
			}
		} else {
			$msg = "not_exist";
		}

		return $msg;
	}

	function change_order_status_details_returned($order_id, $pid, $status1)
	{
		$msg = "";
		$this->db->select("op.prod_id,op.status,op.prod_name,op.return_last_date");


		$this->db->where(array('op.order_id' => $order_id, 'op.prod_id' => $pid));

		$query_prod = $this->db->get('order_product op');

		if ($query_prod->num_rows() > 0) {
			$order_prod_result = $query_prod->result_object();

			$status = $order_prod_result[0]->status;
			$prod_name = $order_prod_result[0]->prod_name;
			$return_last_date = $order_prod_result[0]->return_last_date;

			if ($status == $status1) {
				$msg = 'already_returned';
			} else if ($return_last_date < $this->date) {
				$msg = "invalid";
			} else if ($status == 'Delivered' && $return_last_date != '0000-00-00') {
				$this->db->where(array('order_id' => $order_id, 'prod_id' => $pid));

				$query_prod1 = $this->db->update('order_product', array('status' => $status1));
				$msg = "done";
			} else {
				$msg = "invalid";
			}
		} else {
			$msg = "not_exist";
		}

		return $msg;
	}

	// kamal order api
	function get_order_list_detailsProd($langauge, $user_id)
	{
		/*		$this->db->select("o.order_id,o.status, o.total_price,o.payment_mode,o.create_date,	o.discount,o.total_qty");
		$this->db->where(array('o.user_id'=>$user_id));
		$this->db->order_by("o.sno",'desc'); 
		$query = $this->db->get('orders o');
*/
		//   $sql = "SELECT o.order_id,o.status, o.total_price,o.payment_mode,o.create_date, o.discount,o.total_qty FROM orders o WHERE o.user_id = '$user_id'";
		$sql = "SELECT o.order_id, o.status, op.prod_id, op.vendor_id, op.prod_name ,  op.prod_name_ar , op.prod_img, op.prod_attr, o.total_price, op.qty, op.prod_price,op.shipping,
                op.status, op.discount, o.payment_mode,o.create_date, o.discount,o.total_qty FROM orders o, order_product op WHERE o.order_id= op.order_id
                AND o.user_id = '$user_id' ORDER BY  o.sno DESC";
		$query = $this->db->query($sql); // $query = $this->db->$sql;
		$product_detail_array = array();
		$orders = array();

		if ($query->num_rows() > 0) {
			$order_result = $query->result_object();
			foreach ($order_result as $order_detail) {
				$orders['order_id'] = $order_detail->order_id;
				$orders['status'] = $order_detail->status;
				$orders['prod_id'] = $order_detail->prod_id;
				$orders['vendor_id'] = $order_detail->vendor_id;
				if ($langauge == 1) {
					$orders['prod_name'] = $order_detail->prod_name_ar;
				} else {
					$orders['prod_name'] = $order_detail->prod_name;
				}
				//$orders['prod_name'] = $order_detail->prod_name;
				$orders['prod_img'] = $order_detail->prod_img;
				$orders['prod_attr'] = $order_detail->prod_attr;
				$orders['prod_qty'] = $order_detail->qty;
				$orders['total_price'] = price_format($order_detail->total_price);
				$orders['prod_status'] = $order_detail->status;
				$orders['payment_mode'] = $order_detail->payment_mode;
				$orders['create_date'] = $order_detail->create_date;
				$orders['deliverd_date'] = date('d-m-Y');

				$product_detail_array[] = $orders;
			}
		}

		return $product_detail_array;
	}

	function get_order_full_detailsProd($user_id, $order_id)
	{
		$this->db->select("o.order_id,o.status, o.total_price,o.payment_mode,o.create_date,
							o.discount,o.total_qty, o.fullname, o.mobile,o.locality, o.fulladdress,o.city,o.state,o.pincode,o.addresstype,o.email");


		$this->db->where(array('o.user_id' => $user_id, 'o.order_id' => $order_id));


		$query = $this->db->get('orders o');

		$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
		$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
		$orders = $shipping = array();
		$order_product_array = $order_product = array();

		if ($query->num_rows() > 0) {
			$order_result = $query->result_object();
			$order_detail = $order_result[0];
			$orders['order_id'] = $order_detail->order_id;
			$orders['status'] = $order_detail->status;
			$orders['payment_mode'] = $order_detail->payment_mode;
			$orders['create_date'] = $order_detail->create_date;
			$orders['total_qty'] = $order_detail->total_qty;
			$orders['total_price'] = price_format($order_detail->total_price);
			$orders['discount'] = price_format($order_detail->discount);
			$orders['total_mrp'] = price_format($order_detail->discount + $order_detail->total_price);

			$order_summery = $orders;

			$shipping['fullname'] = $order_detail->fullname;
			$shipping['mobile'] = $order_detail->mobile;
			$shipping['locality'] = $order_detail->locality;
			$shipping['fulladdress'] = $order_detail->fulladdress;
			$shipping['city'] = $order_detail->city;
			$shipping['state'] = $order_detail->state;
			$shipping['pincode'] = $order_detail->pincode;
			$shipping['addresstype'] = $order_detail->addresstype;
			$shipping['email'] = $order_detail->email;

			$shipping_address = $shipping;

			$this->db->select("op.prod_id,op.prod_sku,op.prod_name,op.prod_img,op.prod_attr,op.qty,op.prod_price,op.shipping,op.discount,op.status, sl.companyname,sl.seller_unique_id");

			$this->db->JOIN('sellerlogin sl', 'sl.seller_unique_id = op.vendor_id', 'INNER');

			$this->db->where(array('op.order_id' => $order_id));


			$query_prod = $this->db->get('order_product op');


			if ($query_prod->num_rows() > 0) {
				$order_prod_result = $query_prod->result_object();

				foreach ($order_prod_result as $order_prod_detail) {
					$order_product['prod_id'] = $order_prod_detail->prod_id;
					$order_product['prod_sku'] = $order_prod_detail->prod_sku;
					$order_product['prod_name'] = $order_prod_detail->prod_name;
					$order_product['prod_img'] = $order_prod_detail->prod_img;
					$order_product['qty'] = $order_prod_detail->qty;
					$order_product['prod_price'] = price_format($order_prod_detail->prod_price);
					$order_product['shipping'] = price_format($order_prod_detail->shipping);
					$order_product['discount'] = price_format($order_prod_detail->discount);
					$order_product['prod_mrp'] = price_format($order_prod_detail->prod_price + $order_prod_detail->discount);
					$order_product['status'] = $order_prod_detail->status;
					$order_product['companyname'] = $order_prod_detail->companyname;
					$order_product['vendor_id'] = $order_prod_detail->seller_unique_id;
					$order_product['tax'] = 0;
					if ($order_prod_detail->prod_attr) {
						$attr = json_decode($order_prod_detail->prod_attr);
						$attribute = '';
						foreach ($attr as $prod_attr) {
							$attribute .= $prod_attr->attr_name . ': ' . $prod_attr->item . ', ';
						}

						$order_product['attribute'] = rtrim($attribute, ', ');
					} else {
						$order_product['attribute'] = '';
					}

					$order_product_array[] = $order_product;
				}
			}
		}

		return array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => $order_product_array);
	}
	/*
		Break All The Values In Valid Form
	*/

	function getValues($var)
	{
		if (is_array($var)) {
			$values = "'" . implode("','", $var) . "'";
		} else {
			$delm = array(",", "\n");
			$values = "'" . str_replace($delm, "','", $var) . "'";
		}
		return $values;
	}
}
