<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SellerProduct_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	function validate_user_login($email = '', $user_password)
	{
		$user_result = array();
		$this->db->select('*');
		$this->db->where(array('email' => $email, 'password' => $user_password));
		$query = $this->db->get('sellerlogin');
		if ($query->num_rows() > 0) {
			$user_result1 = $query->result_object()[0];
			$user_result['user_id'] = $user_result1->seller_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = 1;
		} else {
			$user_result['status'] = 'not_exist';
			return $user_result;
			die();
		}
		return $user_result;
	}

	function add_seller_product($seller_id, $category, $prod_name, $prod_name_ar, $prod_sku, $prod_url, $prod_short, $prod_short_ar, $prod_details, $prod_details_ar, $prod_mrp, $prod_price, $selecttaxclass, $is_wholesale_product, $is_usd_price, $affiliate_commission, $prod_qty, $selectstock, $prod_hsn, $prod_purchase_lmt, $selectbrand, $selectseller, $return_policy, $prod_remark, $prod_youtubeid, $is_heavy, $selectrelatedprod, $selectupsell, $prod_status, $selectvisibility, $selectcountry) {
		$this->db->trans_start(); // Start a database transaction.
	
		try {
			$media_path = '../media/';
			$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			$product_unique_id = 'P' . substr(str_shuffle($str_result), 0, 10);
	
			$featured_img = '';
			if (strlen($_FILES['featured_img']['name']) > 1) {
				$featured_img = json_encode(file_upload_array('featured_img', $media_path, $this->img_dimension_arr));
			}
	
			$product_image = '';
			if (is_array($_FILES['product_image']['name'])) {
				$product_image = json_encode(file_upload_array('product_image', $media_path, $this->img_dimension_arr));
			}
	
			if ($prod_sku == '') {
				$prod_sku = makeSKUbyname($prod_name);
				$this->db->where(array('product_sku' => $prod_sku));
				$query01 = $this->db->get('product_details');
				if ($query01->num_rows() > 0) {
					$prod_sku = $prod_sku . '-' . $product_unique_id;
				}
			}
	
			$prod_type = 1;
			$enableproduct = 1;
			$price_type = '';
			$datetime = date('Y-m-d');
			$prod_short = substr($prod_short, 0, 100);
			$seller_array = array();
	
			$seller_array['status'] = $prod_status;
			$seller_array['prod_name'] = $prod_name;
			$seller_array['prod_name_ar'] = $prod_name_ar;
			$seller_array['prod_desc'] = $prod_short;
			$seller_array['prod_desc_ar'] = $prod_short_ar;
			$seller_array['prod_fulldetail'] = $prod_details;
			$seller_array['prod_fulldetail_ar'] = $prod_details_ar;
			$seller_array['featured_img'] = $featured_img;
			$seller_array['prod_img_url'] = $product_image;
			$seller_array['attr_set_id'] = 1;
			$seller_array['brand_id'] = $selectbrand;
			$seller_array['prod_type'] = $prod_type;
			$seller_array['price_type'] = $price_type;
			$seller_array['web_url'] = $prod_url;
			$seller_array['product_sku'] = $prod_sku;
			$seller_array['product_visibility'] = $selectvisibility;
			$seller_array['product_manuf_country'] = $selectcountry;
			$seller_array['product_hsn_code'] = $prod_hsn;
			$seller_array['product_video_url'] = $prod_youtubeid;
			$seller_array['return_policy_id'] = $return_policy;
			$seller_array['product_unique_id'] = $product_unique_id;
			$seller_array['created_at'] = $datetime;
			$seller_array['created_by'] = $seller_id;
			$seller_array['is_heavy'] = $is_heavy;
	
			$query = $this->db->insert('product_details', $seller_array);
			$product_id = $this->db->insert_id();
	
			if ($query) {
				$prod_id = $product_unique_id;
				$cat_array = array();
				$cat_array['cat_id'] = $category;
				$cat_array['prod_id'] = $prod_id;
				$cat_array['created_at'] = $datetime;
				$cat_array['updated_at'] = $datetime;
	
				$query1 = $this->db->insert('product_category', $cat_array);
	
				$vendor_product_array['product_id'] = $prod_id;
				$vendor_product_array['vendor_id'] = $selectseller;
				$vendor_product_array['wholesale_product'] = $is_wholesale_product;
				$vendor_product_array['is_usd_price'] = $is_usd_price;
				$vendor_product_array['affiliate_commission'] = $affiliate_commission;
				$vendor_product_array['product_mrp'] = $prod_mrp;
				$vendor_product_array['product_sale_price'] = $prod_price;
				$vendor_product_array['product_tax_class'] = $selecttaxclass;
				$vendor_product_array['product_stock'] = $prod_qty;
				$vendor_product_array['stock_status'] = $selectstock;
				$vendor_product_array['product_purchase_limit'] = $prod_purchase_lmt;
				$vendor_product_array['product_remark'] = $prod_remark;
				$vendor_product_array['product_related_prod'] = $selectrelatedprod;
				$vendor_product_array['product_upsell_prod'] = $selectupsell;
				$vendor_product_array['enable_status'] = $enableproduct;
				$vendor_product_array['created_at'] = $datetime;
	
				$query1 = $this->db->insert('vendor_product', $vendor_product_array);
	
				$vendor_prod_id = $this->db->insert_id();
	
				$this->db->trans_commit(); // Commit the transaction after all database operations are successful.
	
				$user_result['status'] = '1';
				$user_result['product_id'] = $product_id;
			}
	
			return $user_result;
		} catch (Exception $e) {
			// Something went wrong, rollback the transaction to undo any changes.
			$this->db->trans_rollback();
	
			// Handle the exception or log the error.
			$error_message = $e->getMessage();
			// You may want to return or log the error message for debugging.
	
			$user_result['status'] = '0';
			$user_result['error'] = $error_message;
	
			return $user_result;
		}
	}
	

	function update_seller_product($seller_id, $product_id, $prod_name, $prod_details, $prod_active, $prod_mrp, $prod_price, $selectbrand, $category, $product_video_url, $in_stock, $prod_qty, $_files)
	{

		$this->db->select('*');
		$this->db->where(array('product_unique_id' => $product_id));
		$query000 = $this->db->get('product_details');
		if ($query000->num_rows() > 0) {

			$prod_result = $query000->result_object();

			require '../admin/common_function.php';
			$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			$product_unique_id = 'P' . substr(str_shuffle($str_result), 0, 10);
			$featured_img = '';
			$prod_img_url = '';

			/* if (strlen($_FILES['featured_img']['name']) > 1) {
				$Common_Function = new Common_Function();
				$featured_img1 = $Common_Function->file_upload_app('featured_img', '../media/');
				$featured_img = json_encode($featured_img1);
			} else {
				$featured_img = $prod_result['featured_img'];
			} */


			$media_path = '../media/';
			$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			$product_unique_id = 'P' . substr(str_shuffle($str_result), 0, 10);
			$featured_img = '';
			$prod_img_url = '';


			$featured_img = '';
			if (strlen($_FILES['featured_img']['name']) > 1) {
				$featured_img = json_encode(file_upload('featured_img', $media_path, $this->img_dimension_arr));
			} else {
				$featured_img = $prod_result['featured_img'];
			}

			if (is_array($_FILES['product_image']['name'])) {
				$prod_img_url = json_encode(file_upload('product_image', $media_path, $this->img_dimension_arr));
			} else {
				$prod_img_url = $prod_result['prod_img_url'];
			}




			/* if ($_files['product_image']['name']) {
				$Common_Function = new Common_Function();
				$prod_img_url_arr = $Common_Function->file_upload_app('product_image', '../media/');
				$prod_img_url0 = json_encode($prod_img_url_arr);

				$prod_img_url = json_encode(array_merge(json_decode($prod_img_url0, true), json_decode($prod_result[0]->prod_img_url, true)));
			} else {
				$prod_img_url = $prod_result['prod_img_url'];
			} */

			$enableproduct	=  1;
			$price_type = '';
			$datetime = date('Y-m-d');

			$prod_short = substr($prod_short, 0, 100);
			$seller_array = array();


			$seller_array['prod_name'] = $prod_name;
			$seller_array['prod_fulldetail'] = $prod_details;
			$seller_array['brand_id'] = $selectbrand;
			if ($prod_img_url != '') {
				$seller_array['prod_img_url'] = $prod_img_url;
			}
			if ($featured_img != '') {
				$seller_array['featured_img'] = $featured_img;
			}
			$seller_array['updated_at'] = $datetime;
			$seller_array['created_by'] = $seller_id;
			$seller_array['product_video_url'] = $product_video_url;

			$this->db->where('product_unique_id', $product_id);
			$upd_query = $this->db->update('product_details', $seller_array);

			if ($upd_query) {

				$prod_id = $product_unique_id;
				$sql_cat = '';
				/*foreach($category as $category_id){
						$category_id = $category_id;
					}*/


				$cat_array = array();
				$cat_array['cat_id'] = $category;
				$cat_array['updated_at'] = $datetime;

				$this->db->where('prod_id', $product_id);
				$upd_query1 = $this->db->update('product_category', $cat_array);

				$vendor_product_array['enable_status'] = $prod_active;
				$vendor_product_array['product_mrp'] = str_replace('Rs.', '', $prod_mrp);
				$vendor_product_array['product_sale_price'] = str_replace('Rs.', '', $prod_price);
				$vendor_product_array['product_stock'] = $prod_qty;
				$vendor_product_array['stock_status'] = $in_stock;
				$vendor_product_array['updated_at'] = $datetime;

				$this->db->where(array('product_id' => $product_id, 'vendor_id' => $seller_id));
				$query1 = $this->db->update('vendor_product', $vendor_product_array);

				$vendor_prod_id = $this->db->insert_id();

				$user_result['status'] = '1';
			}
		} else {
			$user_result['status'] = 'notexist';
		}


		return $user_result;
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

			if ($devicetype == 1) {
				$img_decode = json_decode($seller_result[0]->logo);

				$img = $img_decode->{MOBILE};
				$seller_details['logo'] = $img;
			} else {
				$img_decode = json_decode($seller_result[0]->logo);
				$img = $img_decode->{DESKTOP};
				$seller_details['logo'] = $img;
			}

			if ($devicetype == 1) {
				$img_decode1 = json_decode($seller_result[0]->seller_banner);

				$img1 = $img_decode1->{MOBILE};
				$seller_details['seller_banner'] = $img1;
			} else {
				$img_decode1 = json_decode($seller_result[0]->seller_banner);
				$img1 = $img_decode1->{DESKTOP};
				$seller_details['seller_banner'] = $img1;
			}
		}
		return $seller_details;
	}
	//Functiofor for get seller product
	function get_category_product_request($language, $sellerid, $pageno, $sortby, $devicetype)
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
			$this->db->select('pd.product_unique_id as id , pd.prod_name as name,pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
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
					if ($language == "1") {
						$product_response['name'] = $product_details->name_ar;
					} else {
						$product_response['name'] = $product_details->name;
					}

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

					if ($devicetype == 1) {
						$img_decode = json_decode($product_details->img);

						$img = $img_decode->{MOBILE};
						$product_response['imgurl'] = $img;
					} else {
						$img_decode = json_decode($product_details->img);
						$img = $img_decode->{DESKTOP};
						$product_response['imgurl'] = $img;
					}

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
}
