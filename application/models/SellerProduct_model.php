<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SellerProduct_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('email_model');
		$this->date_time = date('Y-m-d H:i:s');
	}

	function get_seller_request($sellerid, $devicetype)
	{
		$this->db->select('companyname,fullname,description,logo,seller_banner');

		$this->db->where(array('status' => 1, 'seller_unique_id' => $sellerid));

		$query = $this->db->get('sellerlogin');

		$seller_details = array();
		if ($query->num_rows() > 0) {
			$seller_result = $query->result_object();

			$seller_details['companyname'] = $seller_result[0]->companyname;
			$seller_details['fullname'] = $seller_result[0]->fullname;
			$seller_details['description'] = $seller_result[0]->description;

			$img_decode = json_decode($seller_result[0]->logo);
			if ($devicetype == 1) {
				if (isset($img_decode->{MOBILE})) {
					$img = $img_decode->{MOBILE};
				} else {
					$img = $seller_result[0]->logo;
				}
			} else {
				if (isset($img_decode->{DESKTOP})) {
					$img = $img_decode->{DESKTOP};
				} else {
					$img = $seller_result[0]->logo;
				}
			}
			$seller_details['logo'] = $img;

			$img_decode1 = json_decode($seller_result[0]->seller_banner);

			if ($devicetype == 1) {
				if (isset($img_decode1->{MOBILE})) {
					$img1 = $img_decode1->{MOBILE};
				} else {
					$img1 = $seller_result[0]->seller_banner;
				}
			} else {
				if (isset($img_decode1->{DESKTOP})) {
					$img1 = $img_decode1->{DESKTOP};
				} else {
					$img1 = $seller_result[0]->seller_banner;
				}
			}
			$seller_details['seller_banner'] = $img1;
		}
		return $seller_details;
	}
	//Functiofor for get seller product
	function get_category_product_request($sellerid, $pageno, $sortby, $devicetype)
	{
		$prod_result = array();
		$product_array = array();

		if ($pageno > 0) {
			$start = ($pageno * LIMIT);
		} else {
			$start = 0;
		}
		$this->db->select('product_category.prod_id');
		$this->db->join('product_details', 'product_details.product_unique_id = product_category.prod_id', 'INNER');
		$this->db->join('vendor_product vp', 'product_details.product_unique_id = vp.product_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');
		$this->db->where_in('seller.seller_unique_id', $sellerid);
		$this->db->where(array('product_details.status' => 1, 'seller.status' => 1, 'vp.enable_status' => 1));
		$this->db->group_by("product_category.prod_id");

		$this->db->limit(LIMIT, $start);

		$query = $this->db->get('product_category');


		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			$product_id = array();
			foreach ($category_result as $cat_product) {
				$product_id[] = $cat_product->prod_id;
			}


			//get products details
			$this->db->select('pd.product_unique_id as id , pd.prod_name as name,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark');


			$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
				FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_id) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');
			$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');

			$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('pd.status' => 1, 'seller.status' => 1, 'vp1.enable_status' => 1));
			$this->db->group_by("pd.product_unique_id");

			if ($sortby == 1) {
				$this->db->order_by("vp2.mrp_min", 'ASC');
			} else if ($sortby == 2) {
				$this->db->order_by("vp2.mrp_min", 'DESC');
			} else if ($sortby == 3) {
				$this->db->order_by("pd.created_at", 'DESC');
			} else if ($sortby == 4) {
				$this->db->order_by("pd.prod_rating_count", 'DESC');
			}

			$query_prod = $this->db->get('product_details as pd');

			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();

				foreach ($prod_result as $product_details) {
					$product_response = array();
					$product_response['id'] = $product_details->id;
					$product_response['name'] = $product_details->name;
					$product_response['web_url'] = $product_details->web_url;
					$product_response['sku'] = $product_details->sku;
					$product_response['active'] = $product_details->active;
					$product_response['vendor_id'] = $product_details->vendor_id;
					$product_response['mrp'] = price_format($product_details->mrp);
					$product_response['price'] = price_format($product_details->price);
					$product_response['stock'] = $product_details->stock;
					$product_response['remark'] = $product_details->remark;
					$product_response['rating'] = 0;

					$discount_per = 0;
					$discount_price = 0;
					if ($product_details->price > 0) {
						$discount_price = ($product_details->mrp - $product_details->price);

						$discount_per = ($discount_price / $product_details->mrp) * 100;
					}
					$product_response['totaloff'] = price_format($discount_price);
					$product_response['offpercent'] = round($discount_per) . '% off';
					$img_decode = json_decode($product_details->img);

					if ($devicetype == 1) {
						if (isset($img_decode->{MOBILE})) {
							$img = $img_decode->{MOBILE};
						} else {
							$img = $product_details->img;
						}
					} else {
						if (isset($img_decode->{DESKTOP})) {
							$img = $img_decode->{DESKTOP};
						} else {
							$img = $product_details->img;
						}
					}
					$product_response['imgurl'] = $img;
					$product_array[] = $product_response;
				}
			}
		}

		return $product_array;
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

	function get_countrycode()
	{
		$delivery_result = array();

		$this->db->select('id, name');
		$this->db->order_by('name', 'ASC');


		$query = $this->db->get('country');

		if ($query->num_rows() > 0) {
			$delivery_array = $query->result_object();
			foreach ($delivery_array as $delivery_details) {
				$delivery_response = array();
				$delivery_response['id'] = $delivery_details->id;
				$delivery_response['name'] = $delivery_details->name;

				$delivery_result[] = $delivery_response;
			}
		}

		return $delivery_result;
	}
	function get_state()
	{
		$delivery_result = array();

		$this->db->select('stateid, name');
		$this->db->order_by('name', 'ASC');
		$this->db->where('countryid', '1');

		$query = $this->db->get('state');

		if ($query->num_rows() > 0) {
			$delivery_array = $query->result_object();
			foreach ($delivery_array as $delivery_details) {
				$delivery_response = array();
				$delivery_response['id'] = $delivery_details->stateid;
				$delivery_response['name'] = $delivery_details->name;

				$delivery_result[] = $delivery_response;
			}
		}

		return $delivery_result;
	}




	function add_seller($business_type, $seller_name, $business_name, $business_address, $business_details, $state_id, $state, $city_id, $city, $pincode, $phone, $email, $website_link, $facebook_link, $instagram_link, $password, $business_logo, $aadhar_card, $pan_card, $gst_certificate)
	{
		$status = '';
		$seller_array = array();
		$n = 10;
		require './admin/common_function.php';
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
		$seller_unique_id = 'S' . $randomString;
		$datetime = date('Y-m-d H:i:s');

		$seller_array['seller_unique_id'] = $seller_unique_id;
		$seller_array['business_type'] = $business_type;
		$seller_array['fullname'] = $seller_name;
		$seller_array['companyname'] = $business_name;
		$seller_array['address'] = $business_address;
		$seller_array['description'] = $business_details;
		$seller_array['state_id'] = $state_id;
		$seller_array['state'] = $state;
		$seller_array['city_id'] = $city_id;
		$seller_array['city'] = $city;
		$seller_array['pincode'] = $pincode;
		$seller_array['phone'] = $phone;
		$seller_array['email'] = $email;
		$seller_array['websiteurl'] = $website_link;
		$seller_array['facebook_link'] = $facebook_link;
		$seller_array['instagram_link'] = $instagram_link;
		$seller_array['password'] = $password;
		$seller_array['logo'] = $business_logo;
		$seller_array['aadhar_card'] = $aadhar_card;
		$seller_array['pan_card'] = $pan_card;
		$seller_array['gst_certificate'] = $gst_certificate;
		$seller_array['create_by'] = $datetime;
		$seller_array['update_by'] = $datetime;
		$seller_array['update_by'] = 0;
		$seller_array['groupid'] = 1;

		$query = $this->db->insert('sellerlogin', $seller_array);
		if ($query) {
			$status = $this->db->insert_id();
			$this->email_model->send_become_seller_success_mail_to_seller_admin($seller_name, $email, $phone);
		}
		return $status;
	}

	function get_city()
	{
		$delivery_result = array();

		$this->db->select('city_id, city_name');
		$this->db->order_by('city_name', 'ASC');
		//$this->db->where('state_code', '38');


		$query = $this->db->get('city');

		if ($query->num_rows() > 0) {
			$delivery_array = $query->result_object();
			foreach ($delivery_array as $delivery_details) {
				$delivery_response = array();
				$delivery_response['id'] = $delivery_details->city_id;
				$delivery_response['name'] = $delivery_details->city_name;

				$delivery_result[] = $delivery_response;
			}
		}

		return $delivery_result;
	}
}
