<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	function get_city($city_id)
	{
		$return = array();
		$i = 0;

		$this->db->select('city_id, city_name');
		$this->db->where_in('city_id', rtrim($city_id, ','), FALSE);
		$this->db->order_by('city_name', 'ASC');

		$query = $this->db->get('city');
		$state_array = $query->result();
		foreach ($state_array as $state_details) {
			$return[$i] =
				array(
					'id' => $state_details->city_id,
					'name' => $state_details->city_name
				);
			$i = $i + 1;
			$status = 1;
			$msg = "Details here";
		}
		$information = array(
			'status' => $status,
			'msg' =>   $msg,
			'data' => $return
		);
		return $information;
	}

	function get_rents_data_request($pid)
	{
		$return = array();
		$i = 0;
		$this->db->select('rent_from_date, rent_to_date');
		$this->db->where_in('prod_id', $pid);

		$query = $this->db->get('order_product');
		$state_array = $query->result_object();
		foreach ($state_array as $state_details) {
			$return[$i] =
				array(
					'rent_from_date' => $state_details->rent_from_date,
					'rent_to_date' => $state_details->rent_to_date
				);
			$i = $i + 1;
			$status = 1;
			$msg = "Details here";
		}
		$information = array(
			'status' => $status,
			'msg' =>   $msg,
			'prod_id' =>   $pid,
			'daterange' => $return
		);
		return $information;
	}

	//Functiofor for get category product
	function get_product_request($language, $pid, $sku, $sid = '', $devicetype = '')
	{
		$prod_result = array();
		$product_array = array();
		$product_id = $pid;
		$user_id = $this->session->userdata('user_id');
		$product_response = array();

		$order_count = $this->db->where(array('order_product.prod_id' => $product_id, 'orders.user_id' => $user_id))->join('order_product', 'order_product.order_id = orders.order_id')->count_all_results('orders');
		$wishlist_count = $this->db->where(array('prod_id' => $product_id, 'user_id' => $user_id))->count_all_results('wishlistdetails');

		//get products details
		$this->db->select('pd.product_unique_id as id , pd.prod_name as name,pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active, vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark, pd.prod_desc,pd.prod_desc_ar, pd.prod_fulldetail,pd.prod_fulldetail_ar,pd.product_video_url,pd.prod_img_url,vp1.product_purchase_limit,brnd.brand_name,pd.prod_rating,pd.prod_rating_count,pd.return_policy_id,vp1.stock_status,vp1.coupon_code,seller.phone, vp1.is_usd_price, vp1.affiliate_commission, vp1.offer_start_date, vp1.offer_end_date,pd.type as product_type,pd.day1_price,pd.day3_price,pd.day5_price,pd.day7_price,pd.city as product_city,pd.security_deposit,pd.usage_info,pd.is_buy,seller.seller_badge,seller.seller_badge1,seller.seller_badge2');

		//join for get minumum price
		$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
				FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_id) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');

		//join for get brand
		$this->db->join('brand brnd', 'pd.brand_id = brnd.brand_id', 'INNER');

		//join for get vendor details
		if ($sid) {
			$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id', 'INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('pd.status' => 1, 'vp1.enable_status' => 1, 'seller.status' => 1, 'pd.product_sku' => $sku, 'vp1.vendor_id' => $sid));
		} else {
			$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('pd.status' => 1, 'vp1.enable_status' => 1, 'seller.status' => 1, 'pd.product_sku' => $sku));
		}

		$query_prod = $this->db->get('product_details as pd');
		//print_r($this->db->last_query()); 
		if ($query_prod->num_rows() > 0) {
			$prod_result = $query_prod->result_object();


			foreach ($prod_result as $product_details) {

				$gallery_img = array();
				$gallery_img_array = array();

				$gallery_img_decode = json_decode($product_details->prod_img_url);

				if (is_array($gallery_img_decode)) {
					foreach ($gallery_img_decode as $muti_image) {

						if ($devicetype == 1) {
							if (isset($muti_image->{MOBILE})) {
								$img = $muti_image->{MOBILE};
							} else {
								$img = '';
							}
						} else {
							if (isset($muti_image->{DESKTOP})) {
								$img = $muti_image->{DESKTOP};
							} else {
								$img = '';
							}
						}
						$gallery_img['url'] = $img;
						$gallery_img_array[] = $gallery_img;
					}
				}

				$product_response['id'] = $product_details->id;
				if ($language == 1) {
					$product_response['name'] = html_entity_decode($product_details->name_ar);
				} else {
					$product_response['name'] = html_entity_decode($product_details->name);
				}
				$product_response['web_url'] = $product_details->web_url;
				$product_response['sku'] = $product_details->sku;
				$product_response['vendor_id'] = $product_details->vendor_id;
				$product_response['mrp'] = $product_details->is_usd_price === '1' ? price_format_usd($product_details->mrp) : price_format($product_details->mrp);
				$product_response['price'] = $product_details->is_usd_price === '1' ? price_format_usd($product_details->price) : price_format($product_details->price);
				$product_response['stock'] = $product_details->stock;
				$product_response['stock_status'] = $product_details->stock_status;
				$product_response['remark'] = html_entity_decode($product_details->remark);
				if ($language == 1) {
					$product_response['short_desc'] = html_entity_decode($product_details->prod_desc_ar);
				} else {
					$product_response['short_desc'] = html_entity_decode($product_details->prod_desc);
				}
				if ($language == 1) {
					$product_response['fulldetail'] = html_entity_decode($product_details->prod_fulldetail_ar);
				} else {
					$product_response['fulldetail'] = html_entity_decode($product_details->prod_fulldetail);
				}
				$product_response['purchase_limit'] = $product_details->product_purchase_limit;

				$product_response['gallary_img_url'] = $gallery_img_array;
				$product_response['brand'] = $product_details->brand_name;
				$product_response['rating'] = $product_details->prod_rating;
				$product_response['prod_rating_count'] = $product_details->prod_rating_count;
				$product_response['cat_name'] = $this->get_product_category($product_details->id);
				$product_response['youtube_url'] = $product_details->product_video_url;
				$product_response['seller_mobile'] = $product_details->phone;
				$product_response['is_usd_price'] = $product_details->is_usd_price;
				$product_response['affiliate_commission'] = $product_details->affiliate_commission;
				$product_type = $product_details->product_type;
				if ($product_type == 1) {
					$product_type = 'Sell';
				} else if ($product_type == 2) {
					$product_type = 'Rent';
				}

				$badge_img_decode = json_decode($product_details->seller_badge);
				$seller_badge = '';
				if ($devicetype == 1) {
					if (isset($badge_img_decode->{MOBILE})) {
						$seller_badge = $badge_img_decode->{MOBILE};
					} else {
						$seller_badge = '';
					}
				} else {
					if (isset($badge_img_decode->{DESKTOP})) {
						$seller_badge = $badge_img_decode->{DESKTOP};
					} else {
						$seller_badge = '';
					}
				}

				$badge1_img_decode = json_decode($product_details->seller_badge1);
				$seller_badge1 = '';
				if ($devicetype == 1) {
					if (isset($badge1_img_decode->{MOBILE})) {
						$seller_badge1 = $badge1_img_decode->{MOBILE};
					} else {
						$seller_badge1 = '';
					}
				} else {
					if (isset($badge1_img_decode->{DESKTOP})) {
						$seller_badge1 = $badge1_img_decode->{DESKTOP};
					} else {
						$seller_badge1 = '';
					}
				}

				$badge2_img_decode = json_decode($product_details->seller_badge2);
				$seller_badge2 = '';
				if ($devicetype == 1) {
					if (isset($badge2_img_decode->{MOBILE})) {
						$seller_badge2 = $badge2_img_decode->{MOBILE};
					} else {
						$seller_badge2 = '';
					}
				} else {
					if (isset($badge2_img_decode->{DESKTOP})) {
						$seller_badge2 = $badge2_img_decode->{DESKTOP};
					} else {
						$seller_badge2 = '';
					}
				}

				$product_response['seller_badge'] = $seller_badge;
				$product_response['seller_badge1'] = $seller_badge1;
				$product_response['seller_badge2'] = $seller_badge2;


				$product_response['product_type'] = $product_type;
				$product_response['day1_price'] = $product_details->day1_price;
				$product_response['day3_price'] = $product_details->day3_price;
				$product_response['day5_price'] = $product_details->day5_price;
				$product_response['day7_price'] = $product_details->day7_price;
				$product_response['security_deposit'] = $product_details->security_deposit;
				$product_response['usage_info'] = html_entity_decode($product_details->usage_info);
				$product_response['is_buy'] = $product_details->is_buy;
				$product_response['product_city'] = $product_details->product_city;
				$product_response['seller_data'] = $this->get_seller_details($product_details->vendor_id);
				//get other seller 
				$other_seller_price = $this->get_other_seller_price($product_details->id, $product_details->vendor_id);
				$other_seller = '';
				if (count($other_seller_price) > 0) {
					$other_seller = $other_seller_price[0]['product_sale_price'];
				}
				$product_response['other_seller_price'] = $other_seller;
				$product_response['other_seller'] = $other_seller_price;
				$policy_details = $this->get_return_policy($product_details->return_policy_id);
				$product_response['return_policy_title'] =  $policy_details['title'];
				$product_response['return_policy_description'] =  $policy_details['policy'];
				$product_response['expected_delivery'] = '';

				$coupon_details = $this->get_vendor_coupon($product_details->coupon_code);
				$product_response['coupon_name'] =  $coupon_details['name'];
				$product_response['coupon_type'] =  $coupon_details['coupon_type'];
				$product_response['coupon_value'] =  $coupon_details['coupon_value'];
				$product_response['coupon_description'] =  $coupon_details['coupon_description'];
				$product_response['coupon_todate'] =  $coupon_details['coupon_todate'];
				$product_response['coupon_terms'] =  $coupon_details['coupon_terms'];


				$meta_details = $this->get_meta_details($product_details->id);
				$product_response['meta_title'] =  $meta_details['meta_title'];
				$product_response['meta_key'] =  $meta_details['meta_key'];
				$product_response['meta_value'] =  $meta_details['meta_value'];


				$product_response['configure_attr'] = $this->get_product_attributes_details($product_details->id, $product_details->vendor_id);;

				$discount_per = 0;
				$discount_price = 0;
				if ($product_details->price > 0) {
					$discount_price = ($product_details->mrp - $product_details->price);

					$discount_per = ($discount_price / $product_details->mrp) * 100;
				}
				$product_response['totaloff'] = price_format($discount_price);
				$product_response['offpercent'] = round($discount_per) . ' % ' . $this->lang->line('off');
				$img_decode = json_decode($product_details->img);

				if ($devicetype == 1) {
					if (isset($img_decode->{MOBILE})) {
						$img = $img_decode->{MOBILE};
					} else {
						$img = '';
					}
				} else {
					if (isset($img_decode->{DESKTOP})) {
						$img = $img_decode->{DESKTOP};
					} else {
						$img = '';
					}
				}
				$product_response['imgurl'] = $img;

				$product_review_array = $this->get_product_review($product_details->id);
				$product_reviews = array();
				if (count($product_review_array) > 0) {
					$product_reviews = $product_review_array;
				}

				$product_response['product_reviews'] = $product_reviews;
				$product_response['product_info'] = $this->getProductInfo($product_id, $language);
				$product_response['order_count'] = $order_count;
				$product_response['wishlist_count'] = $wishlist_count;

				// Convert offer dates to DateTime objects
				$start_date_obj = new DateTime($product_details->offer_start_date);
				$end_date_obj = new DateTime($product_details->offer_end_date);
				$current_date_obj = new DateTime($this->date_time);
				if ($current_date_obj >= $start_date_obj && $current_date_obj <= $end_date_obj)
					$product_response['offer'] = 1;
				else
					$product_response['offer'] = 0;
				$product_response['offer_start_date'] = $product_details->offer_start_date;
				$product_response['offer_end_date'] = $product_details->offer_end_date;
			}
		} else {

			//get products details
			$this->db->select('pd.product_unique_id as id , pd.prod_name as name,pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,vp1.vendor_id, pdattr.mrp as mrp, pdattr.price as price, vp1.product_stock as stock, vp1.product_remark as remark, pd.prod_desc,pd.prod_desc_ar, pd.prod_fulldetail,pd.prod_fulldetail_ar,pd.product_video_url,pd.prod_img_url,vp1.product_purchase_limit,brnd.brand_name,pd.prod_rating,pd.prod_rating_count,pd.return_policy_id, vp1.stock_status,vp1.coupon_code,,seller.phone');

			//join for get minumum price
			$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
						FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_id) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');

			//join for get brand
			$this->db->join('brand brnd', 'pd.brand_id = brnd.brand_id', 'INNER');

			//join for get vendor details
			if ($sid) {
				$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id', 'INNER');
				$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
				$this->db->join('product_attribute_value pdattr', 'pdattr.product_id = pd.product_unique_id', 'INNER');
				$this->db->where_in('pd.product_unique_id', $product_id);
				$this->db->where(array('pd.status' => 1, 'vp1.enable_status' => 1, 'seller.status' => 1, 'pdattr.product_sku' => $sku, 'vp1.vendor_id' => $sid));
			} else {
				$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
				$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
				$this->db->join('product_attribute_value pdattr', 'pdattr.product_id = pd.product_unique_id', 'INNER');
				$this->db->where_in('pd.product_unique_id', $product_id);
				$this->db->where(array('pd.status' => 1, 'vp1.enable_status' => 1, 'seller.status' => 1, 'pdattr.product_sku' => $sku));
			}



			$query_prod = $this->db->get('product_details as pd');
			//print_r($this->db->last_query()); 
			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();


				foreach ($prod_result as $product_details) {

					$gallery_img = array();
					$gallery_img_array = array();

					$gallery_img_decode = json_decode($product_details->prod_img_url);

					if (is_array($gallery_img_decode)) {
						foreach ($gallery_img_decode as $muti_image) {

							if ($devicetype == 1) {
								if (isset($muti_image->{MOBILE})) {
									$img = $muti_image->{MOBILE};
								} else {
									$img = '';
								}
							} else {
								if (isset($muti_image->{DESKTOP})) {
									$img = $muti_image->{DESKTOP};
								} else {
									$img = '';
								}
							}
							$gallery_img['url'] = $img;
							$gallery_img_array[] = $gallery_img;
						}
					}

					$product_response['id'] = $product_details->id;
					if ($language == 1) {
						$product_response['name'] = html_entity_decode($product_details->name_ar);
					} else {
						$product_response['name'] = html_entity_decode($product_details->name);
					}
					$product_response['web_url'] = $product_details->web_url;
					$product_response['sku'] = $product_details->sku;
					$product_response['vendor_id'] = $product_details->vendor_id;
					$product_response['mrp'] = price_format($product_details->mrp);
					$product_response['price'] = price_format($product_details->price);
					$product_response['stock'] = $product_details->stock;
					$product_response['stock_status'] = $product_details->stock_status;
					$product_response['remark'] = html_entity_decode($product_details->remark);
					if ($language == 1) {
						$product_response['short_desc'] = html_entity_decode($product_details->prod_desc_ar);
					} else {
						$product_response['short_desc'] = html_entity_decode($product_details->prod_desc);
					}
					if ($language == 1) {
						$product_response['fulldetail'] = html_entity_decode($product_details->prod_fulldetail_ar);
					} else {
						$product_response['fulldetail'] = html_entity_decode($product_details->prod_fulldetail);
					}
					$product_response['purchase_limit'] = $product_details->product_purchase_limit;

					$product_response['gallary_img_url'] = $gallery_img_array;
					$product_response['brand'] = $product_details->brand_name;
					$product_response['rating'] = $product_details->prod_rating;
					$product_response['prod_rating_count'] = $product_details->prod_rating_count;
					$product_response['cat_name'] = $this->get_product_category($product_details->id);
					$product_response['youtube_url'] = $product_details->product_video_url;
					$product_response['seller_mobile'] = $product_details->phone;
					$product_response['seller_data'] = $this->get_seller_details($product_details->vendor_id);
					//get other seller 
					$other_seller_price = $this->get_other_seller_price($product_details->id, $product_details->vendor_id);
					$other_seller = '';
					if (count($other_seller_price) > 0) {
						$other_seller = $other_seller_price[0]['product_sale_price'];
					}
					$product_response['other_seller_price'] = $other_seller;
					$product_response['other_seller'] = $other_seller_price;
					$policy_details = $this->get_return_policy($product_details->return_policy_id);
					$product_response['return_policy_title'] =  $policy_details['title'];
					$product_response['return_policy_description'] =  $policy_details['policy'];
					$product_response['expected_delivery'] = '';

					$coupon_details = $this->get_vendor_coupon($product_details->coupon_code);
					$product_response['coupon_name'] =  $coupon_details['name'];
					$product_response['coupon_type'] =  $coupon_details['coupon_type'];
					$product_response['coupon_value'] =  $coupon_details['coupon_value'];
					$product_response['coupon_todate'] =  $coupon_details['coupon_todate'];



					$product_response['configure_attr'] = $this->get_product_attributes_details($product_details->id, $product_details->vendor_id);;

					$discount_per = 0;
					$discount_price = 0;
					if ($product_details->price > 0) {
						$discount_price = ($product_details->mrp - $product_details->price);

						$discount_per = ($discount_price / $product_details->mrp) * 100;
					}
					$product_response['totaloff'] = price_format($discount_price);
					$product_response['offpercent'] = round($discount_per) . ' % ' . $this->lang->line('off');
					$img_decode = json_decode($product_details->img);

					if ($devicetype == 1) {
						if (isset($img_decode->{MOBILE})) {
							$img = $img_decode->{MOBILE};
						} else {
							$img = '';
						}
					} else {
						if (isset($img_decode->{DESKTOP})) {
							$img = $img_decode->{DESKTOP};
						} else {
							$img = '';
						}
					}
					$product_response['imgurl'] = $img;

					$product_review_array = $this->get_product_review($product_details->id);
					$product_reviews = array();
					if (count($product_review_array) > 0) {
						$product_reviews = $product_review_array;
					}

					$product_response['product_reviews'] = $product_reviews;
					$product_response['product_info'] = $this->getProductInfo($product_id, $language);
					$product_response['order_count'] = $order_count;
					$product_response['wishlist_count'] = $wishlist_count;
				}
			}
		}

		return $product_response;
	}

	// function for get product info
	function getProductInfo($prod_id, $language)
	{
		$attributeField = ($language == 1) ? 'pis.attribute_ar' : 'pis.attribute';
		$data = $this->db->select("distinct(pi.product_info_set_id), $attributeField as attribute")
			->where('pi.prod_id', $prod_id)
			->join('product_info_set pis', 'pis.id = pi.product_info_set_id')
			->get('product_info pi')
			->result_array();
		$attributeValueField = ($language == 1) ? 'pisv.product_info_set_value_ar' : 'pisv.product_info_set_value';
		foreach ($data as $key => $value) {
			$data1 = $this->db->select("pi.product_info_set_val_id, $attributeValueField as product_info_set_value, colour_code")
				->where(['pi.prod_id' => $prod_id, 'pi.product_info_set_id' => $value['product_info_set_id']])
				->join('product_info_set_val pisv', 'pisv.id = pi.product_info_set_val_id')
				->get('product_info pi')
				->result_array();

			$data[$key]['info'] = $data1;
		}
		return $data;
	}

	//function for get product attributes
	function get_product_attributes_details($prod_id, $sid)
	{
		$this->db->select("pa.attr_value, pa.prod_attr_id, pas.attribute");
		$this->db->join('product_attributes_set pas', 'pas.id = pa.prod_attr_id', 'INNER');
		$this->db->where(array('prod_id' => $prod_id, 'vendor_id' => $sid));

		$attribute = $attribute_array = array();
		$query = $this->db->get('product_attribute pa');

		if ($query->num_rows() > 0) {
			$attr_result = $query->result_object();
			foreach ($attr_result as $attr) {
				$val_decode = json_decode($attr->attr_value);
				$new_attr = array();
				foreach ($val_decode as $key => $val) {
					$new_attr[]['itemvalue'] = $val;
				}

				$attribute['attr_id'] = $attr->prod_attr_id;
				$attribute['attr_name'] = $attr->attribute;
				$attribute['item'] = $new_attr;
				$attribute_array[] = $attribute;
			}
		}
		return $attribute_array;
	}

	//function for create product sort by options
	function get_product_sortby($language)
	{

		$sort_array = array();
		if ($language == 1) {
			$sort_array[0]['name'] = 'السعر من الارخص للاعلى';
			$sort_array[0]['sort_id'] = 1;

			$sort_array[1]['name'] = 'السعر الاعلى الى الادنى';
			$sort_array[1]['sort_id'] = 2;

			$sort_array[2]['name'] = 'الأحدث أولاً';
			$sort_array[2]['sort_id'] = 3;

			$sort_array[3]['name'] = 'شعبية';
			$sort_array[3]['sort_id'] = 4;
		} else {
			$sort_array[0]['name'] = 'Price low to high';
			$sort_array[0]['sort_id'] = 1;

			$sort_array[1]['name'] = 'Price high to low';
			$sort_array[1]['sort_id'] = 2;

			$sort_array[2]['name'] = 'Newest First';
			$sort_array[2]['sort_id'] = 3;

			$sort_array[3]['name'] = 'Popularity';
			$sort_array[3]['sort_id'] = 4;
		}


		return $sort_array;
	}

	//function for get product category
	function get_product_category($prod_id)
	{
		$cat = '';
		$this->db->select("group_concat(concat(`cat`.`cat_name`) separator ',') as category");
		$this->db->join('category cat', 'cat.cat_id = p_cat.cat_id', 'INNER');
		$this->db->where(array('p_cat.prod_id' => $prod_id, 'cat.status' => 1));


		$query = $this->db->get('product_category p_cat');
		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();
			$cat = $category_result[0]->category;
		}
		return $cat;
	}

	//function for get seller details
	function get_seller_details($sid)
	{
		$seller = '';
		$this->db->select("companyname,logo,description,fullname");
		$this->db->where(array('seller_unique_id' => $sid, 'status' => 1));


		$query = $this->db->get('sellerlogin');
		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();
			$selller_result['seller'] = $category_result[0]->companyname;
			$selller_result['fullname'] = $category_result[0]->fullname;

			$img_decode = json_decode($category_result[0]->logo);


			$img = $img_decode->{DESKTOP};


			$selller_result['logo'] = $img;
			$selller_result['description'] = $category_result[0]->description;
		}
		return $selller_result;
	}

	//function for get other seller price details	
	function get_other_seller_price($prod_id, $sid)
	{
		$selller_result = $selller_other = array();
		$this->db->select("sellerlogin.seller_unique_id as seller_id,sellerlogin.companyname as seller, vp.product_mrp, vp.product_sale_price, vp.product_stock");
		$this->db->join('sellerlogin', 'sellerlogin.seller_unique_id = vp.vendor_id', 'INNER');
		$this->db->where(array('vp.product_id' => $prod_id, 'vp.enable_status' => 1));
		$this->db->where_not_in('seller_unique_id', $sid);


		$query = $this->db->get('vendor_product vp');

		if ($query->num_rows() > 0) {
			foreach ($query->result_object() as $other_seller) {
				$selller_result['seller_id'] = $other_seller->seller_id;
				$selller_result['seller'] = $other_seller->seller;
				$selller_result['product_mrp'] = price_format($other_seller->product_mrp);
				$selller_result['product_sale_price'] = price_format($other_seller->product_sale_price);
				$selller_result['product_stock'] = $other_seller->product_stock;
				$selller_other[] = $selller_result;
			}
		}
		return $selller_other;
	}

	//function for get return policy details
	function get_return_policy($id)
	{
		$policy_details = array('title' => '', 'policy' => '');
		$this->db->select("title,policy");
		$this->db->where(array('id' => $id, 'status' => 1));


		$query = $this->db->get('product_return_policy');
		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();
			$policy_details['title'] = html_entity_decode($category_result[0]->title);
			$policy_details['policy'] = html_entity_decode($category_result[0]->policy);
		}
		return $policy_details;
	}

	function get_vendor_coupon($id)
	{
		$coupon_details = array('name' => '', 'coupon_type' => '', 'coupon_value' => '', 'coupon_todate' => '');
		$this->db->select("name,coupon_type,value,coupandesc,todate,terms");
		$this->db->where(array('sno' => $id, 'activate' => 'active'));


		$query = $this->db->get('coupancode_vendor');
		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();
			if ($category_result[0]->coupon_type == 1) {
				$coupon_value = $category_result[0]->value . '%';
			} else {
				$coupon_value = price_format($category_result[0]->value);
			}


			$coupon_details['name'] = html_entity_decode($category_result[0]->name);
			$coupon_details['coupon_type'] = html_entity_decode($category_result[0]->coupon_type);
			$coupon_details['coupon_value'] = html_entity_decode($coupon_value);
			$coupon_details['coupon_description'] = html_entity_decode($category_result[0]->coupandesc);
			$coupon_details['coupon_todate'] = html_entity_decode($category_result[0]->todate);
			$coupon_details['coupon_terms'] = html_entity_decode($category_result[0]->terms);
		}
		return $coupon_details;
	}

	function get_meta_details($id)
	{
		$meta_details = array('meta_title' => '', 'meta_key' => '', 'meta_value' => '');
		$this->db->select("meta_title,meta_key,meta_value");
		$this->db->where(array('prod_id' => $id));


		$query = $this->db->get('product_meta');
		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();


			$meta_details['meta_title'] = html_entity_decode($category_result[0]->meta_title);
			$meta_details['meta_key'] = html_entity_decode($category_result[0]->meta_key);
			$meta_details['meta_value'] = html_entity_decode($category_result[0]->meta_value);
		}
		return $meta_details;
	}

	function get_popular_product_track_request($langauge, $devicetype, $product_id)
	{
		$prod_result = array();
		$product_array = array();

		//get products details
		$this->db->select('pd.product_unique_id as id , pd.prod_name as name, pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark');


		$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
				FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_id) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');
		$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
		$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
		$this->db->where_in('pd.product_unique_id', $product_id);
		$this->db->where(array('pd.status' => 1, 'seller.status' => 1, 'vp1.enable_status' => 1));
		$this->db->group_by("pd.product_unique_id");

		$this->db->order_by("vp2.mrp_min", 'asc');
		$this->db->limit(2, 0);

		$query_prod = $this->db->get('product_details as pd');


		if ($query_prod->num_rows() > 0) {
			$prod_result = $query_prod->result_object();

			$product_array = array();
			foreach ($prod_result as $product_details) {
				$product_response = array();
				$product_response['id'] = $product_details->id;
				if ($langauge == 1) {
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
				$product_response['offpercent'] = round($discount_per) . ' % ' . $this->lang->line('off');
				$img_decode = json_decode($product_details->img);

				if ($devicetype == 1) {
					if (isset($img_decode->{MOBILE})) {
						$img = $img_decode->{MOBILE};
					} else {
						$img = '';
					}
				} else {
					if (isset($img_decode->{DESKTOP})) {
						$img = $img_decode->{DESKTOP};
					} else {
						$img = '';
					}
				}
				$product_response['imgurl'] = $img;
				$product_array[] = $product_response;
			}
		}


		return $product_array;
	}

	//Functiofor for get related product
	function get_popular_product_request($langauge, $devicetype, $product_id)
	{
		$prod_result = array();
		$product_array = array();

		//get products details
		$this->db->select('pd.product_unique_id as id , pd.prod_name as name, pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark,pd.day1_price');


		$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
				FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_id) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');
		$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
		$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
		$this->db->where_in('pd.product_unique_id', $product_id);
		$this->db->where(array('pd.status' => 1, 'seller.status' => 1, 'vp1.enable_status' => 1));
		$this->db->group_by("pd.product_unique_id");

		$this->db->order_by("vp2.mrp_min", 'asc');


		$query_prod = $this->db->get('product_details as pd');

		if ($query_prod->num_rows() > 0) {
			$prod_result = $query_prod->result_object();

			$product_array = array();
			foreach ($prod_result as $product_details) {
				$product_response = array();
				$product_response['id'] = $product_details->id;
				if ($langauge == 1) {
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
				$product_response['day1_price'] = price_format($product_details->day1_price);
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
				$product_response['offpercent'] = round($discount_per) . ' % ' . $this->lang->line('off');
				$img_decode = json_decode($product_details->img);

				if ($devicetype == 1) {
					if (isset($img_decode->{MOBILE})) {
						$img = $img_decode->{MOBILE};
					} else {
						$img = '';
					}
				} else {
					if (isset($img_decode->{DESKTOP})) {
						$img = $img_decode->{DESKTOP};
					} else {
						$img = '';
					}
				}
				$product_response['imgurl'] = $img;
				$product_array[] = $product_response;
			}
		}


		return $product_array;
	}

	function get_upsell_product_request($langauge, $devicetype, $product_id)
	{
		$prod_result = array();
		$product_array = array();
		if (!empty($product_id)) {

			//print_r($product_id);	
			//get products details
			$this->db->select('pd.product_unique_id as id , pd.prod_name as name,  pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark,pd.day1_price');


			$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
				FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_id) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');
			$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('pd.status' => 1, 'seller.status' => 1, 'vp1.enable_status' => 1));
			$this->db->group_by("pd.product_unique_id");

			$this->db->order_by("vp2.mrp_min", 'asc');


			$query_prod = $this->db->get('product_details as pd');

			//print_r($this->db->last_query()); 

			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();

				$product_array = array();
				foreach ($prod_result as $product_details) {
					$product_response = array();
					$product_response['id'] = $product_details->id;
					if ($langauge == 1) {
						$product_response['name'] = $product_details->name_ar;
					} else {
						$product_response['name'] = $product_details->name;
					}

					$product_response['web_url'] = $product_details->web_url;
					//$product_response['youtube_url'] = $product_details->youtube_url;
					$product_response['sku'] = $product_details->sku;
					$product_response['active'] = $product_details->active;
					$product_response['vendor_id'] = $product_details->vendor_id;
					$product_response['mrp'] = price_format($product_details->mrp);
					$product_response['price'] = price_format($product_details->price);
					$product_response['day1_price'] = price_format($product_details->day1_price);
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
					$product_response['offpercent'] = round($discount_per) . ' % ' . $this->lang->line('off');
					$img_decode = json_decode($product_details->img);

					if ($devicetype == 1) {
						if (isset($img_decode->{MOBILE})) {
							$img = $img_decode->{MOBILE};
						} else {
							$img = '';
						}
					} else {
						if (isset($img_decode->{DESKTOP})) {
							$img = $img_decode->{DESKTOP};
						} else {
							$img = '';
						}
					}
					$product_response['imgurl'] = $img;
					$product_array[] = $product_response;
				}
			}
			return $product_array;
		} else {

			return $product_array;
		}
	}

	function getRecentlyViewedProductDetails($langauge, $product_ids)
	{
		$prod_result = array();
		$product_array = array();
		if (!empty($product_ids)) {

			$this->db->select('pd.product_unique_id as id , pd.prod_name as name,  pd.prod_name_ar as name_ar, pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark,pd.day1_price');


			$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_ids) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');
			$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where_in('pd.product_unique_id', $product_ids);
			$this->db->where(array('pd.status' => 1, 'seller.status' => 1, 'vp1.enable_status' => 1));
			$this->db->group_by("pd.product_unique_id");

			$this->db->order_by("vp2.mrp_min", 'asc');


			$query_prod = $this->db->get('product_details as pd');

			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();

				$product_array = array();
				foreach ($prod_result as $product_details) {
					$product_response = array();
					$product_response['id'] = $product_details->id;
					if ($langauge == 1) {
						$product_response['name'] = $product_details->name_ar;
					} else {
						$product_response['name'] = $product_details->name;
					}

					$product_response['web_url'] = $product_details->web_url;
					//$product_response['youtube_url'] = $product_details->youtube_url;
					$product_response['sku'] = $product_details->sku;
					$product_response['vendor_id'] = $product_details->vendor_id;
					$product_response['mrp'] = price_format($product_details->mrp);
					$product_response['price'] = price_format($product_details->price);
					$product_response['day1_price'] = price_format($product_details->day1_price);
					$product_response['stock'] = $product_details->stock;
					$product_response['remark'] = $product_details->remark;
					$product_response['rating'] = $this->get_product_review_total($product_details->id);;

					$discount_per = 0;
					$discount_price = 0;
					if ($product_details->price > 0) {
						$discount_price = ($product_details->mrp - $product_details->price);

						$discount_per = ($discount_price / $product_details->mrp) * 100;
					}
					$product_response['totaloff'] = price_format($discount_price);
					$product_response['offpercent'] = round($discount_per) . ' % ' . $this->lang->line('off');
					$img_decode = json_decode($product_details->img);
					if (isset($img_decode->{MOBILE})) {
						$img = $img_decode->{MOBILE};
					} else {
						$img = '';
					}
					$product_response['imgurl'] = $img;
					$product_array[] = $product_response;
				}
			}
			return $product_array;
		} else {

			return $product_array;
		}
	}

	//function for get product attributes price
	function get_product_price_request($sku, $prodid, $sid, $config_attr)
	{
		$config_attr_decode =  json_decode($config_attr);


		$this->db->select("pav.product_sku, pav.price, pav.mrp,pav.stock,pav.conf_image");
		$this->db->join('vendor_product vp', 'vp.id = pav.vendor_prod_id', 'INNER');
		$this->db->where(array('pav.product_id' => $prodid, 'vp.product_id' => $prodid, 'vp.vendor_id' => $sid));

		foreach ($config_attr_decode as $config_attribute) {
			$this->db->like('prod_attr_value', ':"' . $config_attribute->attr_value . '"');
		}

		$query = $this->db->get('product_attribute_value pav');



		$attribute = array();
		if ($query->num_rows() > 0) {
			$attr_results = $query->result_object();
			$wishlist_count = $this->db->where(array('prod_id' => $prodid, 'user_id' => $this->session->userdata('user_id')))->count_all_results('wishlistdetails');
			$attr_result = $attr_results[0];

			$attribute['product_attr_sku'] = $attr_result->product_sku;
			$attribute['product_mrp'] = price_format($attr_result->mrp);
			$attribute['product_price'] = price_format($attr_result->price);
			$attribute['product_stock'] = $attr_result->stock;
			if ($attr_result->stock == 0) {
				$attribute['stock_status'] = "Out of Stock";
			} else {
				$attribute['stock_status'] = "In Stock";
			}

			$img_decode = json_decode($attr_result->conf_image);

			if (!empty($img_decode)) {

				// foreach($img_decode as $muti_image){

				if ($devicetype == 1) {
					if (isset($img_decode->{MOBILE})) {
						$img = $img_decode->{MOBILE};
					} else {
						$img = '';
					}
				} else {
					if (isset($img_decode->{DESKTOP})) {
						$img = $img_decode->{DESKTOP};
					} else {
						$img = '';
					}
				}
				$attribute['imgurl'] = $img;
				// }
			} else {
				$attribute['imgurl'] = '';
			}


			$discount_per = 0;
			$discount_price = 0;
			if ($attr_result->price > 0) {
				$discount_price = ($attr_result->mrp - $attr_result->price);

				$discount_per = ($discount_price / $attr_result->mrp) * 100;
			}
			$attribute['totaloff'] = price_format($discount_price);
			$attribute['offpercent'] = round($discount_per) . ' % ' . $this->lang->line('off');
			$attribute['wishlist_count'] = $wishlist_count;
		}
		return $attribute;
	}

	function get_product_filter($catid)
	{
		$this->db->select('product_category.prod_id');
		$this->db->join('product_details', 'product_details.product_unique_id = product_category.prod_id', 'INNER');
		$this->db->join('vendor_product vp', 'product_details.product_unique_id = vp.product_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');
		$this->db->where_in('product_category.cat_id', $catid);
		$this->db->where(array('product_details.status' => 1, 'seller.status' => 1, 'vp.enable_status' => 1));
		$this->db->group_by("product_category.prod_id");


		$query = $this->db->get('product_category');

		$attribute_array = array();
		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			$product_id = array();
			foreach ($category_result as $cat_product) {
				$product_id[] = $cat_product->prod_id;
			}

			$this->db->select("GROUP_CONCAT(`pa`.`attr_value` separator '$#$') attr_value, pa.prod_attr_id, pas.attribute");
			$this->db->join('product_attributes_set pas', 'pas.id = pa.prod_attr_id', 'INNER');
			$this->db->join('sellerlogin seller', 'pa.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where_in('prod_id', $product_id);
			$this->db->where(array('seller.status' => 1));

			$this->db->group_by("pa.prod_attr_id");

			$query = $this->db->get('product_attribute pa');
			$attribute = array();
			if ($query->num_rows() > 0) {
				$attr_result = $query->result_object();
				foreach ($attr_result as $attr) {
					$val_decode = explode('$#$', $attr->attr_value);
					$new_attr = array();


					foreach ($val_decode as $attr_json) {
						$attr_decode = json_decode($attr_json);

						foreach ($attr_decode as $attr_array) {
							if (!in_array($attr_array, $new_attr)) {
								$new_attr[] = $attr_array;
							}
						}
					}


					$attribute['attr_id'] = $attr->prod_attr_id;
					$attribute['name'] = $attr->attribute;
					$attribute['value'] = $new_attr;
					$attribute_array[] = $attribute;
				}
			}
			$price_filter = [];
			$query = $this->db->select_max('product_sale_price', 'max_price')
				->select_min('product_sale_price', 'min_price')
				->join('vendor_product', 'vendor_product.product_id = product_category.prod_id', 'INNER')
				->where('product_category.cat_id', $catid)
				->get('product_category');

			if ($query->num_rows() > 0) {
				$result = $query->row();
				$price_filter['max_price'] = $result->max_price;
				$price_filter['min_price'] = $result->min_price;
			} else {
				$price_filter['max_price'] = '';
				$price_filter['min_price'] = '';
			}
			return [
				'attribute_array' => $attribute_array,
				'price_filter' => $price_filter,
			];
		}
		return [
			'attribute_array' => '',
			'price_filter' => '',
		];
	}

	//function for get product review
	function get_product_review($prod_id, $pageno = '')
	{

		if ($pageno > 0) {
			$start = ($pageno * LIMIT);
		} else {
			$start = 0;
		}

		$this->db->select("pr.review_id,rating,pr.title as review_title,pr.comment as review_comment,pr.created_at as review_date, apl.fullname as user_name");
		$this->db->join('appuser_login apl', 'apl.user_unique_id = pr.user_id', 'INNER');
		$this->db->where(array('pr.product_id' => $prod_id, 'pr.status' => 1));
		$this->db->order_by('pr.created_at', 'DESC');
		$this->db->limit(LIMIT, $start);
		$query_review = $this->db->get('product_review pr');

		$reviews = array();
		if ($query_review->num_rows() > 0) {
			$reviews = $query_review->result_object();
		}
		return $reviews;
	}

	function get_product_review_total($prod_id)
	{
		$this->db->select('SUM(rating) as total_rating, COUNT(*) as total_rows');
		$this->db->where('product_id', $prod_id);
		$query = $this->db->get('product_review');

		$result = $query->row_array();
		// print_r($result);exit;
		return $result;
	}

	function get_product_custom_cloth($prod_id)
	{


		$this->db->select("pd.product_unique_id,pc.cat_id");
		$this->db->join('product_category pc', 'pd.product_unique_id = pc.prod_id', 'INNER');
		$this->db->where(array('pd.product_unique_id' => $prod_id, 'pd.status' => 1));
		$query_review = $this->db->get('product_details pd');

		$reviews = array();
		if ($query_review->num_rows() > 0) {
			$prod_data = $query_review->result_object();
			$attr_result = $prod_data[0];

			$cat_id = $attr_result->cat_id;

			$this->db->select("parent_id");
			$this->db->where(array('cat_id' => $cat_id, 'status' => 1));
			$query_cat = $this->db->get('category');

			$prod_cat = $query_cat->result_object();
			$cat_result = $prod_cat[0];
			$cat_id1 = $cat_result->parent_id;

			if ($cat_id1 == 10) {
				return $cat_id1;
			} else {
				$this->db->select("parent_id");
				$this->db->where(array('cat_id' => $cat_id1, 'status' => 1));
				$query_cat1 = $this->db->get('category');

				$prod_cat1 = $query_cat1->result_object();
				$cat_result1 = $prod_cat1[0];
				$cat_id2 = $cat_result1->parent_id;

				if ($cat_id2 == 10) {
					return $cat_id2;
				} else {
					$this->db->select("parent_id");
					$this->db->where(array('cat_id' => $cat_id2, 'status' => 1));
					$query_cat2 = $this->db->get('category');

					$prod_cat2 = $query_cat2->result_object();
					$cat_result2 = $prod_cat2[0];
					$cat_id3 = $cat_result2->parent_id;

					if ($cat_id3 == 10) {
						return $cat_id3;
					}
				}
			}
		}
		return $cat_id;
	}

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

	function get_wholesale_product_request($language, $pageno, $sortby, $min_price, $max_price, $rating, $config_attr)
	{
		$prod_result = array();
		$product_array = array();
		$per_page = 9;
		if ($pageno > 0) {
			$start = ($pageno * $per_page);
		} else {
			$start = 0;
		}
		$config_attr_decode =  json_decode($config_attr);
		$this->db->select('pd.product_unique_id as id, pd.prod_name as name, pd.prod_name_ar as name_ar, pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img, vp.vendor_id, vp.is_usd_price, vp.product_mrp as mrp, vp.product_sale_price price, vp.product_stock as stock, vp.stock_status, vp.product_remark as remark');
		$this->db->join('vendor_product vp', 'pd.product_unique_id = vp.product_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');

		if ($rating !== '') {
			$this->db->join('product_review', 'pd.product_unique_id = product_review.product_id', 'LEFT');
			$this->db->having('AVG(product_review.rating) >=', $rating);
		}

		if ($config_attr_decode) {
			$this->db->join('product_attribute_value pav', 'vp.id = pav.vendor_prod_id', 'INNER');
		}
		if ($min_price != '' && $max_price !== '')
			$this->db->where(array('vp.product_sale_price >=' => $min_price, 'vp.product_sale_price <=' => $max_price,));

		$this->db->where('wholesale_product', 1)
			->where(array('(pd.status' => 1, 'seller.status' => 1, 'vp.enable_status' => 1));

		if ($config_attr_decode) {
			foreach ($config_attr_decode as $key => $config_attribute) {
				$attr_id = $config_attribute->attr_id;
				$attr_name = $config_attribute->attr_name;
				$attr_value = trim($config_attribute->attr_value);


				$query_prod = $this->db->query(' SELECT id FROM product_attributes_conf WHERE 
								attribute_id = "' . $attr_id . '" AND attribute_value = "' . $attr_value . '" ');

				if ($query_prod->num_rows() > 0) {
					if ($key == 0) {
						$this->db->like('pav.prod_attr_value', ':"' . $attr_value . '"');
					} else {
						$this->db->or_like('pav.prod_attr_value', ':"' . $attr_value . '"');
					}
				} else {
					$this->db->reset_query();
					return 'invalid_filter';
					die;
				}
			}
		}

		if ($sortby == 1) {
			$this->db->order_by("price", 'ASC');
		} else if ($sortby == 2) {
			$this->db->order_by("price", 'DESC');
		} else if ($sortby == 3) {
			$this->db->order_by("pd.created_at", 'DESC');
		} else if ($sortby == 4) {
			$this->db->order_by("pd.prod_rating_count", 'DESC');
		}

		$query = $this->db->group_end()->group_by("vp.product_id");
		$cloned_query = clone $this->db;
		$total = $cloned_query->get('product_details pd')->num_rows();
		$this->db->limit($per_page, $start);

		$prod_result = $query->get('product_details pd')->result_array();
		if (!empty($prod_result)) {
			foreach ($prod_result as $key => $product_details) {

				if ($language == 1) {
					$prod_result[$key]['name'] = $product_details['name_ar'];
				} else {
					$prod_result[$key]['name'] = $product_details['name'];
				}

				$prod_result[$key]['mrp'] = price_format($product_details['mrp']);
				$prod_result[$key]['price'] = price_format($product_details['price']);

				$prod_result[$key]['rating'] = $this->get_product_review_total($product_details['id']);

				$discount_per = 0;
				$discount_price = 0;
				if ($product_details['price'] > 0) {
					$discount_price = ($product_details['mrp'] - $product_details['price']);

					$discount_per = ($discount_price / $product_details['mrp']) * 100;
				}
				$prod_result[$key]['totaloff'] = price_format($discount_price);
				$prod_result[$key]['offpercent'] = round($discount_per) . ' % ' . $this->lang->line('off');

				$img_decode = json_decode($product_details['img']);

				$prod_result[$key]['imgurl'] = $img_decode->{'72-72'};
			}
		}
		return array(
			"product_array" => $prod_result,
			"total_pages" => ceil($total / $per_page)
		);
	}

	function getWholeProductFilter()
	{
		$this->db->select('vp.product_id');
		$this->db->join('product_details', 'product_details.product_unique_id = vp.product_id');
		$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id');
		$this->db->where(array('wholesale_product' => 1, 'product_details.status' => 1, 'seller.status' => 1, 'vp.enable_status' => 1));
		$this->db->group_by("vp.product_id");


		$query = $this->db->get('vendor_product vp');

		$attribute_array = array();
		if ($query->num_rows() > 0) {
			$product_result = $query->result_object();
			$product_id = array();
			foreach ($product_result as $product) {
				$product_id[] = $product->product_id;
			}

			$this->db->select("GROUP_CONCAT(`pa`.`attr_value` separator '$#$') attr_value, pa.prod_attr_id, pas.attribute");
			$this->db->join('product_attributes_set pas', 'pas.id = pa.prod_attr_id', 'INNER');
			$this->db->join('sellerlogin seller', 'pa.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where_in('prod_id', $product_id);
			$this->db->where(array('seller.status' => 1));

			$this->db->group_by("pa.prod_attr_id");

			$query = $this->db->get('product_attribute pa');
			$attribute = array();
			if ($query->num_rows() > 0) {
				$attr_result = $query->result_object();
				foreach ($attr_result as $attr) {
					$val_decode = explode('$#$', $attr->attr_value);
					$new_attr = array();


					foreach ($val_decode as $attr_json) {
						$attr_decode = json_decode($attr_json);

						foreach ($attr_decode as $attr_array) {
							if (!in_array($attr_array, $new_attr)) {
								$new_attr[] = $attr_array;
							}
						}
					}


					$attribute['attr_id'] = $attr->prod_attr_id;
					$attribute['name'] = $attr->attribute;
					$attribute['value'] = $new_attr;
					$attribute_array[] = $attribute;
				}
			}
			$price_filter = [];
			$query = $this->db->select_max('product_sale_price', 'max_price')
				->select_min('product_sale_price', 'min_price')
				->get_where('vendor_product', array('wholesale_product' => 1));

			if ($query->num_rows() > 0) {
				$result = $query->row();
				$price_filter['max_price'] = $result->max_price;
				$price_filter['min_price'] = $result->min_price;
			} else {
				$price_filter['max_price'] = '';
				$price_filter['min_price'] = '';
			}
		}
		return [
			'attribute_array' => $attribute_array,
			'price_filter' => $price_filter
		];
	}
}
