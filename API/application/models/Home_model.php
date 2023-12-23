<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	function delete_app_user($user_id)
	{
		$this->db->where(array('user_unique_id' => $user_id));

		$query = $this->db->delete('appuser_login');

		if ($query) {
			return 'delete';
		}
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
		return $return;
	}
	
	function get_home_events_request()
	{
		$this->db->select('*');
		$query = $this->db->get('events');

		$banner_result = array();
		if ($query->num_rows() > 0) {
			$home_result = $query->result_object();
			foreach ($home_result as $banners) {
				$img_decode1 = json_decode($banners->event_image);
				$banners->event_image = base_url('media/') . $img_decode1->{'430-590'};
				$banner_result[] = $banners;
			}
		}

		return $banner_result;
	}
	
	function get_events_category($language,$event_id)
	{
		$this->db->select('*');
		$this->db->where(array('event_id' => $event_id));
		$query = $this->db->get('events');

		$banner_result = array();
		if ($query->num_rows() > 0) {
			$home_result = $query->result_object();
			foreach ($home_result as $banners) {
				$img_decode1 = json_decode($banners->event_image);
				$banners->event_image = base_url('media/') . $img_decode1->{'430-590'};
				$banner_result[] = $banners;
			}
		}
		
		$cat_id = $banner_result[0]->cat_id;
		
		$prod_result = array();

		$product_array = array();

		$start = 0;

		$sortby = 1;

		$devicetype = 1;


		$this->db->select('*');

		$this->db->where("cat_id in ($cat_id)", NULL);


		/*$this->db->where_in(array('cat_id' => $cat_id));*/

		$query_prod = $this->db->get('category');



		if ($query_prod->num_rows() > 0) {

			$prod_result = $query_prod->result_object();



			$product_array = array();

			foreach ($prod_result as $productdetails) {

				$product_response = array();

				$product_response['cat_id'] = $productdetails->cat_id;

				$product_response['cat_name'] = $productdetails->cat_name;
				$product_response['cat_slug'] = $productdetails->cat_slug;

				$img_decode1 = json_decode($productdetails->cat_img);
				$banners = base_url('media/') . $img_decode1->{'430-590'};




				$product_response['web_banner'] = $banners;

				$product_array[] = $product_response;
			}
		}
		
		$res_result = array();
		
		$res_result['details'] = $banner_result;
		$res_result['product_array'] = $product_array;

		return $res_result;
		
		
	}

	function get_check_pincode_request($language, $pincode)
	{
		$data_response = 'Item is not deliverable for selected Pincode';

		$curl1 = curl_init();
		curl_setopt_array($curl1, array(
			CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
									"email" : "marurangecommerce@gmail.com",
									"password" : "Borawar@739"				
								}',
			CURLOPT_HTTPHEADER => array(
				'content-type: application/json'
			),
		));
		$response1 = curl_exec($curl1);
		curl_close($curl1);
		$token_data = json_decode($response1);
		$token = $token_data->data;



		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Token ' . $token
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$response_pincode = json_decode($response);
		foreach ($response_pincode->data as $pin_data) {
			if ($pin_data->pincode == $pincode) {
				$data_response = 'Delivery Available Your Area';
			}
		}



		return $data_response;
	}


	function get_subcategory_request($language, $category_result, $parent_id = '', $devicetype)
	{

		$this->db->select('cat_id as id,cat_name as name, cat_name as name_ar, cat_img,cat_slug');

		$this->db->where(array('parent_id' => $parent_id, 'status' => 1));
		$this->db->order_by('cat_order', 'ASC');
		$query = $this->db->get('category');

		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			foreach ($category_array as $cat_details) {
				$cat_response = array();
				$cat_response['id'] = $cat_details->id;
				if ($language == "1") {
					$cat_response['name'] = $cat_details->name_ar;
				} else {
					$cat_response['name'] = $cat_details->name;
				}

				$cat_response['cat_slug'] = $cat_details->cat_slug;

				$img_decode = json_decode($cat_details->cat_img);
				$img = '';

				if ($devicetype == 1) {
					if (isset($img_decode->{MOBILE})) {
						$img = $img_decode->{MOBILE};
					} else {
						$img = $cat_details->cat_img;
					}
				} else {
					if (isset($img_decode->{DESKTOP})) {
						$img = $img_decode->{DESKTOP};
					} else {
						$img = $cat_details->cat_img;
					}
				}
				$cat_response['imgurl'] = $img;
				$category_result[] = $cat_response;
				$category_result2 = $this->categoryTree($language, $cat_details->id, $devicetype);

				if ($category_result2) {
					$category_result = array_merge($category_result, $category_result2);
				} else {
					$category_result[] = $cat_response;
				}
			}
		}

		return $category_result;
	}

	function categoryTree($language, $parent_id, $devicetype)
	{
		$this->db->select('cat_id as id,cat_name as name, cat_name as name_ar, cat_img,cat_slug');

		$this->db->where(array('cat.status' => 1, 'cat.parent_id' => $parent_id));
		$this->db->order_by('cat.cat_order', 'ASC');

		$query = $this->db->get('category cat');

		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			foreach ($category_array as $cat_details) {

				$cat_response['id'] = $cat_details->id;
				if ($language == "1") {
					$cat_response['name'] = $cat_details->name_ar;
				} else {
					$cat_response['name'] = $cat_details->name;
				}

				$cat_response['cat_slug'] = $cat_details->cat_slug;

				$img_decode = json_decode($cat_details->cat_img);
				$img = '';

				if ($devicetype == 1) {
					if (isset($img_decode->{MOBILE})) {
						$img = $img_decode->{MOBILE};
					} else {
						$img = $cat_details->cat_img;
					}
				} else {
					if (isset($img_decode->{DESKTOP})) {
						$img = $img_decode->{DESKTOP};
					} else {
						$img = $cat_details->cat_img;
					}
				}
				$cat_response['imgurl'] = $img;
				$category_result2 = $this->categoryTree($language, $cat_details->id, $devicetype);
				if ($category_result2) {
					$category_result[] = array_merge($cat_response, $category_result2);
				} else {
					$category_result[] = $cat_response;
				}
			}

			return $category_result;
		}
	}

	function get_category_product_request($language, $catid, $pageno, $sortby, $devicetype, $config_attr)
	{
		$prod_result = array();
		$product_array = array();

		if ($pageno > 0) {
			$start = ($pageno * 20);
		} else {
			$start = 0;
		}
		$config_attr_decode =  json_decode($config_attr);

		$this->db->select('product_category.prod_id');
		$this->db->join('product_details', 'product_details.product_unique_id = product_category.prod_id', 'INNER');
		$this->db->join('vendor_product vp', 'product_details.product_unique_id = vp.product_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');

		if ($config_attr_decode) {
			$this->db->join('product_attribute_value pav', 'vp.id = pav.vendor_prod_id', 'INNER');
		}

		$this->db->where_in('product_category.cat_id', $catid);
		$this->db->where(array('(product_details.status' => 1, 'seller.status' => 1, 'vp.enable_status' => 1));

		$first_line = 0;
		if ($config_attr_decode) {
			foreach ($config_attr_decode as $config_attribute) {
				$attr_id = $config_attribute->attr_id;
				$attr_name = $config_attribute->attr_name;
				$attr_value = trim($config_attribute->attr_value);


				$query_prod = $this->db->query(' SELECT id FROM product_attributes_conf WHERE 
								attribute_id = "' . $attr_id . '" AND attribute_value = "' . $attr_value . '" ');

				if ($query_prod->num_rows() > 0) {
					if ($first_line == 0) {
						$this->db->like('pav.prod_attr_value', ':"' . $attr_value . '"');
					} else {
						$this->db->or_like('pav.prod_attr_value', ':"' . $attr_value . '"');
					}
				} else {
					$this->db->reset_query();
					return 'invalid_filter';
					die;
				}
				$first_line++;
			}
		}

		$this->db->group_end()->group_by("product_category.prod_id");

		$this->db->limit(LIMIT, $start);

		$query = $this->db->get('product_category');

		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			$product_id = array();
			foreach ($category_result as $cat_product) {
				$product_id[] = $cat_product->prod_id;
			}


			$this->db->select('pd.product_unique_id as id , pd.prod_name as name, pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock,vp1.stock_status, vp1.product_remark as remark,seller.phone');


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
					if ($language == 1) {
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
					$product_response['stock_status'] = $product_details->stock_status;
					$product_response['remark'] = $product_details->remark;
					$product_response['seller_mobile'] = $product_details->phone;
					$product_response['rating'] = 0;

					$product_review_array = $this->get_product_review($product_details->id);

					if (!empty($product_review_array)) {
						$product_response['product_total_rating'] = $product_review_array['total_rating'];
						$product_response['product_rating_count'] = $product_review_array['rating_count'];
					} else {
						$product_response['product_total_rating'] = '';
						$product_response['product_rating_count'] = '';
					}

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

					$product_response['imgurl'] = str_replace("-430-590", '', $img);
					$product_array[] = $product_response;
				}
			}
		}

		return $product_array;
	}


	function get_explore_category_request($language, $devicetype, $cat_ids)
	{
		$category_result = array();

		$this->db->select('cat.cat_id,cat.cat_name,cat.cat_name_ar,cat.cat_img,cat.parent_id,cat.cat_slug, cat.web_banner');

		$this->db->where(array('cat.status' => 1, 'cat.cat_id' => $cat_ids));
		$this->db->order_by('cat.cat_order', 'ASC');

		//$this->db->limit(8, 0);
		$query = $this->db->get('category cat');

		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			foreach ($category_array as $cat_details) {
				$cat_response = array();
				$cat_response['cat_id'] = $cat_details->cat_id;
				// 1 arabic 2 english
				if ($language == 1) {
					$cat_response['cat_name'] = $cat_details->cat_name_ar;
				} else {
					$cat_response['cat_name'] = $cat_details->cat_name;
				}


				$cat_response['parent_id'] = $cat_details->parent_id;
				$cat_response['cat_slug'] = $cat_details->cat_slug;

				$img_decode = json_decode($cat_details->cat_img);
				$img = '';

				if ($devicetype == 1) {
					if (isset($img_decode->{MOBILE})) {
						$img = $img_decode->{MOBILE};
					} else {
						$img = $cat_details->cat_img;
					}
				} else {
					if (isset($img_decode->{DESKTOP})) {
						$img = $img_decode->{DESKTOP};
					} else {
						$img = $cat_details->cat_img;
					}
				}

				$web_banner = '';
				if ($cat_details->web_banner) {
					$web_decode = json_decode($cat_details->web_banner);

					if ($devicetype == 1) {
						if (isset($web_decode->{MOBILE})) {
							$web_banner = $web_decode->{MOBILE};
						} else {
							$web_banner = $cat_details->web_banner;
						}
					} else {
						if (isset($web_decode->{DESKTOP})) {
							$web_banner = $web_decode->{DESKTOP};
						} else {
							$web_banner = $cat_details->web_banner;
						}
					}
				}

				$cat_response['imgurl'] = $img;
				$cat_response['web_banner'] = $web_banner;

				//get sub category 
				$this->db->select('cat.cat_id,cat.cat_name, cat.cat_name_ar,cat.cat_img,cat.parent_id,cat.cat_slug');

				$this->db->where(array('cat.status' => 1, 'cat.parent_id' => $cat_details->cat_id));
				$this->db->order_by('cat.cat_order', 'ASC');

				//$this->db->limit(8, 0);
				$querysubcat = $this->db->get('category cat');
				$cat_response['subcat_1'] = array();
				if ($querysubcat->num_rows() > 0) {
					$category_sub = $querysubcat->result_object();
					foreach ($category_sub as $subcat_details) {
						$scat_response = array();
						$scat_response['cat_id'] = $subcat_details->cat_id;
						// 1 arabic 2 english
						if ($language == 1) {
							$scat_response['cat_name'] = $subcat_details->cat_name_ar;
						} else {
							$scat_response['cat_name'] = $subcat_details->cat_name;
						}
						$scat_response['parent_id'] = $subcat_details->parent_id;
						$scat_response['cat_slug'] = $subcat_details->cat_slug;

						$img_decode = json_decode($subcat_details->cat_img);
						$img = '';

						if ($devicetype == 1) {
							if (isset($img_decode->{MOBILE})) {
								$img = $img_decode->{MOBILE};
							} else {
								$img = $subcat_details->cat_img;
							}
						} else {
							if (isset($img_decode->{DESKTOP})) {
								$img = $img_decode->{DESKTOP};
							} else {
								$img = $subcat_details->cat_img;
							}
						}
						$scat_response['imgurl'] = $img;

						//getsub sub category 
						$this->db->select('cat.cat_id,cat.cat_name, cat.cat_name_ar,cat.cat_img,cat.parent_id,cat.cat_slug');

						$this->db->where(array('cat.status' => 1, 'cat.parent_id' => $subcat_details->cat_id));
						$this->db->order_by('cat.cat_order', 'ASC');

						//$this->db->limit(8, 0);
						$querysubcat1 = $this->db->get('category cat');
						$scat_response['subsubcat_2'] = array();
						if ($querysubcat1->num_rows() > 0) {
							$category_sub1 = $querysubcat1->result_object();
							foreach ($category_sub1 as $subcat_details1) {
								$scat_response1 = array();
								$scat_response1['cat_id'] = $subcat_details1->cat_id;
								// 1 arabic 2 english
								if ($language == 1) {
									$scat_response1['cat_name'] = $subcat_details1->cat_name_ar;
								} else {
									$scat_response1['cat_name'] = $subcat_details1->cat_name;
								}

								$scat_response1['parent_id'] = $subcat_details1->parent_id;
								$scat_response1['cat_slug'] = $subcat_details1->cat_slug;

								$img_decode = json_decode($subcat_details1->cat_img);
								$img1 = '';

								if ($devicetype == 1) {
									if (isset($img_decode->{MOBILE})) {
										$img1 = $img_decode->{MOBILE};
									} else {
										$img1 = $subcat_details1->cat_img;
									}
								} else {
									if (isset($img_decode->{DESKTOP})) {
										$img1 = $img_decode->{DESKTOP};
									} else {
										$img1 = $subcat_details1->cat_img;
									}
								}
								$scat_response1['imgurl'] = $img1;

								$scat_response['subsubcat_2'][] = $scat_response1;
							}
						}
						$cat_response['subcat_1'][] = $scat_response;
					}
				}

				$category_result[] = $cat_response;
			}
		}

		return $category_result;
	}

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

		if ($query_review->num_rows() > 0) {
			$prod_result = $query_review->result_object();

			$product_array = array();
			$rating_count = 0;
			$rating_star = 0;
			foreach ($prod_result as $product_details) {
				$rating_star += $product_details->rating;
				$rating_count++;
			}
			$product_array['total_rating'] = $rating_star / $rating_count;
			$product_array['rating_count'] = $rating_count;
		}
		return $product_array;
	}

	function get_vendor_coupon()
	{
		$coupon = array();
		$this->db->select("name,coupon_type,value,todate,coupandesc");
		$this->db->where(array('activate' => 'active'));


		$query = $this->db->get('coupancode_vendor');
		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			foreach ($category_result as $category_data) {
				$coupon_details = array();
				if ($category_data->coupon_type == 1) {
					$coupon_value = $category_data->value . '%';
				} else {
					$coupon_value = price_format($category_data->value);
				}


				$coupon_details['name'] = html_entity_decode($category_data->name);
				$coupon_details['coupandesc'] = html_entity_decode($category_data->coupandesc);
				$coupon_details['coupon_type'] = html_entity_decode($category_data->coupon_type);
				$coupon_details['coupon_value'] = html_entity_decode($coupon_value);
				$coupon_details['coupon_todate'] = html_entity_decode($category_data->todate);

				$coupon[] = $coupon_details;
			}
		}
		return $coupon;
	}


	function get_offers_product_request($language, $type)
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;
		$sortby = 1;
		$devicetype = 1;

		if ($type != 'New') {

			$this->db->select('popular_product.product_id');
			$this->db->join('product_details', 'product_details.product_unique_id = popular_product.product_id', 'INNER');
			$this->db->join('vendor_product vp', 'product_details.product_unique_id = vp.product_id', 'INNER');
			$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where(array('product_details.status' => 1, 'vp.enable_status' => 1, 'seller.status' => 1, 'popular_product.type' => $type));
			//$this->db->group_by("popular_product.prod_id"); 
			$this->db->order_by("popular_product.id", 'ASC');

			$this->db->limit(15, $start);

			$query = $this->db->get('popular_product');
		} else {
			$this->db->select('product_unique_id as product_id');
			$this->db->where(array('status' => 1));
			$this->db->order_by("id", 'DESC');
			$this->db->limit(15, $start);
			$query = $this->db->get('product_details');
		}

		//print_r($this->db->last_query());    

		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			$product_id = array();
			foreach ($category_result as $cat_product) {
				$product_id[] = $cat_product->product_id;
			}


			//get products details
			$this->db->select('pd.product_unique_id as id , pd.prod_name as name, pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark');


			$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
				FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_id) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');
			$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('pd.status' => 1, 'vp1.enable_status' => 1, 'seller.status' => 1));
			$this->db->group_by("pd.product_unique_id");

			if ($type == 'New') {
				$this->db->order_by("pd.id", 'DESC');
			}

			/*if($sortby==1){
				$this->db->order_by("vp2.mrp_min",'ASC'); 
			}else if($sortby==2){
				$this->db->order_by("vp2.mrp_min",'DESC'); 
			}else if($sortby==3){
				$this->db->order_by("pd.created_at",'DESC'); 
			}else if($sortby==4){
				$this->db->order_by("pd.prod_rating_count",'DESC'); 
			}*/

			$query_prod = $this->db->get('product_details as pd');

			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();

				$product_array = array();
				foreach ($prod_result as $product_details) {
					$product_response = array();
					$product_response['id'] = $product_details->id;
					if ($language == 1) {
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

	//Functiofor for get category product
	function get_popular_product_request($language, $pageno, $sortby, $devicetype)
	{
		$prod_result = array();
		$product_array = array();
		if ($pageno > 0) {
			$start = ($pageno * LIMIT);
		} else {
			$start = 0;
		}
		$this->db->select('popular_product.product_id');
		$this->db->join('product_details', 'product_details.product_unique_id = popular_product.product_id', 'INNER');
		$this->db->join('vendor_product vp', 'product_details.product_unique_id = vp.product_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');
		$this->db->where(array('product_details.status' => 1, 'vp.enable_status' => 1, 'seller.status' => 1));
		//$this->db->group_by("popular_product.prod_id"); 

		$this->db->limit(LIMIT, $start);

		$query = $this->db->get('popular_product');


		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			$product_id = array();
			foreach ($category_result as $cat_product) {
				$product_id[] = $cat_product->product_id;
			}


			//get products details
			$this->db->select('pd.product_unique_id as id , pd.prod_name as name,pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark');


			$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
				FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_id) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');
			$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('pd.status' => 1, 'vp1.enable_status' => 1, 'seller.status' => 1));
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

				$product_array = array();
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

	function city_list_request($state_code = "")
	{

		$city_result = array();



		$this->db->select('city_id,city_name,state_code');
		if ($state_code !== '')
			$this->db->where('state_code', $state_code);
		$query = $this->db->get('city');


		if ($query->num_rows() > 0) {

			$city_array = $query->result_object();

			foreach ($city_array as $city_details) {

				$city_response = array();

				$city_response['city_id'] = $city_details->city_id;

				$city_response['city_name'] = $city_details->city_name;

				$city_response['state_code'] = $city_details->state_code;



				$city_result[] = $city_response;
			}
		}



		return $city_result;
	}

	function state_list_request()
	{

		$city_result = array();



		$this->db->select('stateid,name,countryid');

		$query = $this->db->get('state');

		if ($query->num_rows() > 0) {

			$city_array = $query->result_object();

			foreach ($city_array as $city_details) {

				$city_response = array();

				$city_response['stateid'] = $city_details->stateid;

				$city_response['name'] = $city_details->name;

				$city_response['countryid'] = $city_details->countryid;



				$city_result[] = $city_response;
			}
		}



		return $city_result;
	}


	function home_top_category_request($langauge)
	{

		$prod_result = array();

		$product_array = array();

		$start = 0;

		$sortby = 1;

		$devicetype = 1;


		$this->db->select('*');


		$this->db->where('cat_id != ', '10');
		$this->db->where_in('parent_id', '0');

		$this->db->limit(20, $start);
		$this->db->order_by('cat_order', 'ASC');


		$query_prod = $this->db->get('category');



		if ($query_prod->num_rows() > 0) {

			$prod_result = $query_prod->result_object();



			$product_array = array();

			foreach ($prod_result as $productdetails) {

				$product_response = array();

				$product_response['id'] = $productdetails->cat_id;

				if ($langauge == 1)
					$product_response['name'] = $productdetails->cat_name_ar;
				else
					$product_response['name'] = $productdetails->cat_name;

				$img_decode = json_decode($productdetails->cat_img);

				if ($devicetype == 1) {
					if (isset($img_decode->{MOBILE})) {
						$img = $img_decode->{MOBILE};
					} else {
						$img = $productdetails->cat_img;
					}
				} else {
					if (isset($img_decode->{DESKTOP})) {
						$img = $img_decode->{DESKTOP};
					} else {
						$img = $productdetails->cat_img;
					}
				}





				$product_response['imgurl'] = $img;

				$product_array[] = $product_response;
			}
		}





		return $product_array;
	}

	function getTopNotifications($language)
	{
		if ($language == 1)
			$this->db->select('heading_ar as heading, description_ar as description, offer_page_title_ar as offer_page_title, offer_page_link');
		elseif ($language == 2)
			$this->db->select('heading, description, offer_page_title, offer_page_link');
		$this->db->limit(3, 0);
		return $this->db->get('top_offers')->result_array();
	}

	function get_header_banner_request($section, $dimension)
	{
		$this->db->select('*');

		$this->db->where(array('section' => $section));
		$query = $this->db->get('homepage_banner');

		$banner_result = array();
		if ($query->num_rows() > 0) {
			$home_result = $query->result_object();
			foreach ($home_result as $banners) {
				$img_decode1 = json_decode($banners->image);
				$banners->image = MEDIA_URL . $img_decode1->{$dimension};
				$banner_result[] = $banners;
			}
		}

		return $banner_result;
	}
	
	function get_header_noti_request($section)
	{
		$this->db->select('*');

		$this->db->where(array('section' => $section));
		$query = $this->db->get('homepage_banner');

		$banner_result = array();
		if ($query->num_rows() > 0) {
			$home_result = $query->result_object();
			foreach ($home_result as $banners_data) {
				$banners = array();
				$banners['title'] = $banners_data->image;
				$banners['link'] = $banners_data->link;
				
				$banner_result[] = $banners;
			}
		}

		return $banner_result;
	}
	
	
	function get_home_products_new($language, $title, $type, $timezone)
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;
		$sortby = 1;
		$devicetype = 1;

		if ($type != 'New0') {

			$this->db->select('popular_product.product_id');
			$this->db->join('product_details', 'product_details.product_unique_id = popular_product.product_id', 'INNER');
			$this->db->join('vendor_product vp', 'product_details.product_unique_id = vp.product_id', 'INNER');
			$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where(array('product_details.status' => 1, 'vp.enable_status' => 1, 'seller.status' => 1, 'popular_product.type' => $type));
			$this->db->order_by("popular_product.id", 'ASC');

			$this->db->limit(15, $start);

			$query = $this->db->get('popular_product');
		} else {
			$this->db->select('product_unique_id as product_id');
			$this->db->where(array('status' => 1));
			$this->db->order_by("id", 'DESC');
			$this->db->limit(15, $start);
			$query = $this->db->get('product_details');
		}


		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			$product_id = array();
			foreach ($category_result as $cat_product) {
				$product_id[] = $cat_product->product_id;
			}


			$this->db->select('pd.product_unique_id as id , pd.prod_name as name, pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark');


			$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
				FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_id) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');
			$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('pd.status' => 1, 'vp1.enable_status' => 1, 'seller.status' => 1));
			$this->db->group_by("pd.product_unique_id");

			if ($type == 'New') {
				$this->db->order_by("pd.id", 'DESC');
			}

			/*if($sortby==1){
				$this->db->order_by("vp2.mrp_min",'ASC'); 
			}else if($sortby==2){
				$this->db->order_by("vp2.mrp_min",'DESC'); 
			}else if($sortby==3){
				$this->db->order_by("pd.created_at",'DESC'); 
			}else if($sortby==4){
				$this->db->order_by("pd.prod_rating_count",'DESC'); 
			}*/

			$query_prod = $this->db->get('product_details as pd');

			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();

				$product_array = array();
				foreach ($prod_result as $product_details) {
					$product_response = array();
					$product_response['id'] = $product_details->id;
					if ($language == 1) {
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

					$product_response['imgurl'] = MEDIA_URL . $img;
					$product_array[] = $product_response;
				}
			}
		}
		
		
		$res_result = array();
		$res_result['product_array'] = $product_array;

		$this->db->select('*');

		$this->db->where(array('section' => $title));
		$query = $this->db->get('homepage_banner');

		$banner_result = array();
		if ($query->num_rows() > 0) {
			$home_result = $query->result_object();
			foreach ($home_result as $banners) {
				$banners->image = $banners->image;
				$banner_result[] = $banners->image;
			}
		}
		$res_result['title'] = $banner_result;

		return $product_array;
	}


	function get_home_products($language, $type)
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;
		$sortby = 1;
		$devicetype = 1;

		if ($type != 'New0') {

			$this->db->select('popular_product.product_id');
			$this->db->join('product_details', 'product_details.product_unique_id = popular_product.product_id', 'INNER');
			$this->db->join('vendor_product vp', 'product_details.product_unique_id = vp.product_id', 'INNER');
			$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where(array('product_details.status' => 1, 'vp.enable_status' => 1, 'seller.status' => 1, 'popular_product.type' => $type));
			$this->db->order_by("popular_product.id", 'ASC');

			$this->db->limit(15, $start);

			$query = $this->db->get('popular_product');
		} else {
			$this->db->select('product_unique_id as product_id');
			$this->db->where(array('status' => 1));
			$this->db->order_by("id", 'DESC');
			$this->db->limit(15, $start);
			$query = $this->db->get('product_details');
		}


		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			$product_id = array();
			foreach ($category_result as $cat_product) {
				$product_id[] = $cat_product->product_id;
			}


			$this->db->select('pd.product_unique_id as id , pd.prod_name as name, pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark');


			$this->db->join('(SELECT vp.id as min_id,vp.product_id,  min(vp.product_sale_price) as mrp_min
				FROM vendor_product vp WHERE  vp.product_id IN(' . $this->getValues($product_id) . ') AND vp.enable_status=1 group by vp.product_id  ) as vp2', 'pd.product_unique_id = vp2.product_id');
			$this->db->join('vendor_product vp1', 'vp1.product_id = vp2.product_id AND vp1.product_sale_price = vp2.mrp_min', 'INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
			$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('pd.status' => 1, 'vp1.enable_status' => 1, 'seller.status' => 1));
			$this->db->group_by("pd.product_unique_id");

			if ($type == 'New') {
				$this->db->order_by("pd.id", 'DESC');
			}

			/*if($sortby==1){
				$this->db->order_by("vp2.mrp_min",'ASC'); 
			}else if($sortby==2){
				$this->db->order_by("vp2.mrp_min",'DESC'); 
			}else if($sortby==3){
				$this->db->order_by("pd.created_at",'DESC'); 
			}else if($sortby==4){
				$this->db->order_by("pd.prod_rating_count",'DESC'); 
			}*/

			$query_prod = $this->db->get('product_details as pd');

			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();

				$product_array = array();
				foreach ($prod_result as $product_details) {
					$product_response = array();
					$product_response['id'] = $product_details->id;
					if ($language == 1) {
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

					$product_response['imgurl'] = MEDIA_URL . $img;
					$product_array[] = $product_response;
				}
			}
		}

		return $product_array;
	}





	function get_storesetting_request($devicetype)
	{
		$category_result = array();
		$this->db->select('settings_id,type,description');
		$query = $this->db->get('settings');
		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			$name = '';
			$phone = '';
			$whatsapp = '';
			$email_1 = '';
			$email_2 = '';
			$aboutus = '';
			$login_banner = '';
			foreach ($category_array as $cat_details) {
				if ($cat_details->type == 'system_name') {
					$name = $cat_details->description;
				} else if ($cat_details->type == 'system_phone') {
					$phone = $cat_details->description;
				} else if ($cat_details->type == 'system_email') {
					$email_1 = $cat_details->description;
				} else if ($cat_details->type == 'system_other_email') {
					$email_2 = $cat_details->description;
				} else if ($cat_details->type == 'system_other_phone') {
					$whatsapp = $cat_details->description;
				} else if ($cat_details->type == 'aboutus') {
					$aboutus = strip_tags(html_entity_decode($cat_details->description));
				}
				else if ($cat_details->type == 'login_banner') {
					
					if ($devicetype == 1) {
						$img_decode = json_decode($cat_details->description);

						$img_login = $img_decode->{MOBILE};
					} else {
						$img_decode = json_decode($cat_details->description);
						$img_login = $img_decode->{DESKTOP};
					}
					$login_banner = $img_login;
					
				}
			}
			$data[] = array('name' => $name, 'phone' => $phone, 'email_1' => $email_1, 'email_2' => $email_2, 'whatsapp' => $whatsapp, 'aboutus' => $aboutus, 'login_banner' => $login_banner);
		}
		return $data;
	}


	//Functiofor for get category product
	function get_search_product_request($langauge, $search, $devicetype)
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;


		$this->db->select('product_id');

		$s_query = $this->db->get('sponsor_product');

		$pid = '';

		if ($s_query->num_rows() > 0) {
			$s_category_array = $s_query->result_object();
			foreach ($s_category_array as $s_cat_details) {

				$pid = $pid . '"' . $s_cat_details->product_id . '",';
			}
		}

		$pid = rtrim($pid, ',');


		$keywords = $this->filterSearchKeys($search);
		$product_like = '';
		$product_meta_like = '';
		$s = 0;
		foreach ($keywords as $keys) {

			if ($s == 0) {
				$product_like .= " (prod_name like '%" . $keys . "%'  OR prod_name_ar like '%" . $keys . "%' OR prod_desc_ar like '%" . $keys . "%'  OR prod_fulldetail_ar like '%" . $keys . "%' OR pm.meta_title like '%" . $keys . "%' OR pm.meta_key like '%" . $keys . "%'  OR pm.meta_value like '%" . $keys . "%' )";
				//$product_meta_like .= " (pm.meta_title like '%".$keys."%' OR pm.meta_key like '%".$keys."%'  OR pm.meta_value like '%".$keys."%' )";
			} else {
				$product_like .= " AND (prod_name like '%" . $keys . "%' OR prod_name_ar like '%" . $keys . "%' OR prod_desc_ar like '%" . $keys . "%'  OR prod_fulldetail_ar like '%" . $keys . "%'  OR pm.meta_title like '%" . $keys . "%' OR pm.meta_key like '%" . $keys . "%'  OR pm.meta_value like '%" . $keys . "%' )";
				//$product_meta_like .= " OR (pm.meta_title like '%".$keys."%' OR pm.meta_key like '%".$keys."%'  OR pm.meta_value like '%".$keys."%' )";
			}
			$s++;
		}
		//echo $product_like;			  
		//get products details
		/*$this->db->select('pd.product_unique_id as id , pd.prod_name as name,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark');
			
			
			$this->db->join('vendor_product vp1', 'vp1.product_id = pd.product_unique_id','INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id','INNER');
			//$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('pd.status' => 1,'vp1.enable_status'=>1,'seller.status'=>1));
			
			//$this->db->like($product_like);
			
			$this->db->group_by("pd.product_unique_id"); 
			
		
			
			$this->db->limit(LIMIT,$start);*/




		$sql_sponsor = "SELECT `pd`.`product_unique_id` as `id`, `pd`.`prod_name` as `name`, `pd`.`prod_name_ar` as `name_ar`, `pd`.`web_url` as `web_url`, `pd`.`product_sku` as `sku`, `pd`.`featured_img` as `img`,  `vp1`.`vendor_id`, `vp1`.`product_mrp` as `mrp`, `vp1`.`product_sale_price` `price`, `vp1`.`product_stock` as `stock`, `vp1`.`product_remark` as `remark`, 'active' as active
					FROM `product_details` as `pd`
					INNER JOIN `vendor_product` `vp1` ON `vp1`.`product_id` = `pd`.`product_unique_id`
					INNER JOIN `sellerlogin` `seller` ON `vp1`.`vendor_id` = `seller`.`seller_unique_id`
					LEFT JOIN  product_meta pm ON pm.prod_id = `pd`.`product_unique_id`
					LEFT JOIN  brand brand ON brand.brand_id = `pd`.`brand_id`
					WHERE `pd`.`status` = 1
					and vp1.product_id IN(" . $pid . ")
					AND `vp1`.`enable_status` = 1
					AND `seller`.`status` = 1
					AND `brand`.`status` = 1
					AND  (" . $product_like . " OR brand.brand_name like '%" . $search . "%')
					GROUP BY `pd`.`product_unique_id`
					LIMIT 100";



		$query_prod_sponsor = $this->db->query($sql_sponsor);

		if ($query_prod_sponsor->num_rows() > 0) {
			$prod_result_sponsor = $query_prod_sponsor->result_object();


			foreach ($prod_result_sponsor as $product_details_sponsor) {
				$product_response_sponsor = array();
				$product_response_sponsor['id'] = $product_details_sponsor->id;
				if ($langauge == "1") {
					$product_response_sponsor['name'] = $product_details_sponsor->name_ar;
				} else {
					$product_response_sponsor['name'] = $product_details_sponsor->name;
				}


				$product_response_sponsor['web_url'] = $product_details_sponsor->web_url;
				$product_response_sponsor['sku'] = $product_details_sponsor->sku;
				$product_response_sponsor['active'] = $product_details_sponsor->active;
				$product_response_sponsor['vendor_id'] = $product_details_sponsor->vendor_id;
				$product_response_sponsor['mrp'] = price_format($product_details_sponsor->mrp);
				$product_response_sponsor['price'] = price_format($product_details_sponsor->price);
				$product_response_sponsor['stock'] = $product_details_sponsor->stock;
				$product_response_sponsor['remark'] = $product_details_sponsor->remark;
				$product_response_sponsor['rating'] = 0;
				$product_response_sponsor['sponsor'] = 1;

				$discount_per = 0;
				$discount_price = 0;
				if ($product_details_sponsor->price > 0) {
					$discount_price = ($product_details_sponsor->mrp - $product_details_sponsor->price);

					$discount_per = ($discount_price / $product_details_sponsor->mrp) * 100;
				}
				$product_response_sponsor['totaloff'] = price_format($discount_price);
				$product_response_sponsor['offpercent'] = round($discount_per) . '% off';


				if ($devicetype == 1) {
					$img_decode = json_decode($product_details_sponsor->img);

					$img = $img_decode->{MOBILE};
					$product_response_sponsor['imgurl'] = $img;
				} else {
					$img_decode = json_decode($product_details_sponsor->img);
					$img = $img_decode->{DESKTOP};
					$product_response_sponsor['imgurl'] = $img;
				}

				$product_array[] = $product_response_sponsor;
			}
		}













		$sql = "SELECT `pd`.`product_unique_id` as `id`, `pd`.`prod_name` as `name`, `pd`.`prod_name_ar` as `name_ar`, `pd`.`web_url` as `web_url`, `pd`.`product_sku` as `sku`, `pd`.`featured_img` as `img`,  `vp1`.`vendor_id`, `vp1`.`product_mrp` as `mrp`, `vp1`.`product_sale_price` `price`, `vp1`.`product_stock` as `stock`, `vp1`.`product_remark` as `remark`, 'active' as active
					FROM `product_details` as `pd`
					INNER JOIN `vendor_product` `vp1` ON `vp1`.`product_id` = `pd`.`product_unique_id`
					INNER JOIN `sellerlogin` `seller` ON `vp1`.`vendor_id` = `seller`.`seller_unique_id`
					LEFT JOIN  product_meta pm ON pm.prod_id = `pd`.`product_unique_id`
					LEFT JOIN  brand brand ON brand.brand_id = `pd`.`brand_id`
					WHERE `pd`.`status` = 1
					and vp1.product_id NOT IN(" . $pid . ")
					AND `vp1`.`enable_status` = 1
					AND `seller`.`status` = 1
					AND `brand`.`status` = 1
					AND  (" . $product_like . " OR brand.brand_name like '%" . $search . "%')
					GROUP BY `pd`.`product_unique_id`
					LIMIT 10";



		$query_prod = $this->db->query($sql);

		if ($query_prod->num_rows() > 0) {
			$prod_result = $query_prod->result_object();


			foreach ($prod_result as $product_details) {
				$product_response = array();
				$product_response['id'] = $product_details->id;
				if ($langauge == "1") {
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
				$product_response['sponsor'] = 0;

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


		return $product_array;
	}

	function getnotification_request($devicetype)
	{
		$category_result = array();
		$this->db->select('id,title,subtitle,image,date');
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get('notification');
		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			foreach ($category_array as $cat_details) {
				$cat_response = array();
				$cat_response['id'] = $cat_details->id;
				$cat_response['title'] = $cat_details->title;
				$cat_response['subtitle'] = $cat_details->subtitle;
				$cat_response['image'] = $cat_details->image;
				$cat_response['date'] = $cat_details->date;
				$category_result[] = $cat_response;
			}
		}
		return $category_result;
	}

	function getnotification_newpost_request($devicetype)
	{
		$category_result = array();
		$this->db->select('id,title,subtitle,image,date');
		$this->db->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 3 DAY) AND NOW()');
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get('notification');
		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			foreach ($category_array as $cat_details) {
				$cat_response = array();
				$cat_response['id'] = $cat_details->id;
				$cat_response['title'] = $cat_details->title;
				$cat_response['subtitle'] = $cat_details->subtitle;
				$cat_response['image'] = $cat_details->image;
				$cat_response['date'] = $cat_details->date;
				$category_result[] = $cat_response;
			}
		}
		return $category_result;
	}

	function get_search_sponsor_product_request($langauge, $search, $devicetype)
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;


		$this->db->select('product_id');

		$s_query = $this->db->get('sponsor_product');

		$pid = '';

		if ($s_query->num_rows() > 0) {
			$s_category_array = $s_query->result_object();
			foreach ($s_category_array as $s_cat_details) {

				$pid = $pid . '"' . $s_cat_details->product_id . '",';
			}
		}

		$pid = rtrim($pid, ',');

		$keywords = $this->filterSearchKeys($search);
		$product_like = '';
		$product_meta_like = '';
		$s = 0;
		foreach ($keywords as $keys) {

			if ($s == 0) {
				$product_like .= " (prod_name like '%" . $keys . "%'  OR prod_name_ar like '%" . $keys . "%' OR prod_desc_ar like '%" . $keys . "%'  OR prod_fulldetail_ar like '%" . $keys . "%' OR pm.meta_title like '%" . $keys . "%' OR pm.meta_key like '%" . $keys . "%'  OR pm.meta_value like '%" . $keys . "%' )";
			} else {
				$product_like .= " AND (prod_name like '%" . $keys . "%' OR prod_name_ar like '%" . $keys . "%' OR prod_desc_ar like '%" . $keys . "%'  OR prod_fulldetail_ar like '%" . $keys . "%'  OR pm.meta_title like '%" . $keys . "%' OR pm.meta_key like '%" . $keys . "%'  OR pm.meta_value like '%" . $keys . "%' )";
			}
			$s++;
		}
		/*$this->db->select('pd.product_unique_id as id , pd.prod_name as name,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
				vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark');
			
			
			$this->db->join('vendor_product vp1', 'vp1.product_id = pd.product_unique_id','INNER');
			$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id','INNER');
			//$this->db->where_in('pd.product_unique_id', $product_id);
			$this->db->where(array('pd.status' => 1,'vp1.enable_status'=>1,'seller.status'=>1));
			
			//$this->db->like($product_like);
			
			$this->db->group_by("pd.product_unique_id"); 
			
		
			
			$this->db->limit(LIMIT,$start);*/

		$sql = "SELECT `pd`.`product_unique_id` as `id`, `pd`.`prod_name` as `name`, `pd`.`prod_name_ar` as `name_ar`, `pd`.`web_url` as `web_url`, `pd`.`product_sku` as `sku`, `pd`.`featured_img` as `img`,  `vp1`.`vendor_id`, `vp1`.`product_mrp` as `mrp`, `vp1`.`product_sale_price` `price`, `vp1`.`product_stock` as `stock`, `vp1`.`product_remark` as `remark`, 'active' as active
					FROM `product_details` as `pd`
					INNER JOIN `vendor_product` `vp1` ON `vp1`.`product_id` = `pd`.`product_unique_id`
					INNER JOIN `sellerlogin` `seller` ON `vp1`.`vendor_id` = `seller`.`seller_unique_id`
					LEFT JOIN  product_meta pm ON pm.prod_id = `pd`.`product_unique_id`
					LEFT JOIN  brand brand ON brand.brand_id = `pd`.`brand_id`
					WHERE `pd`.`status` = 1
					and vp1.product_id IN(" . $pid . ")
					AND `vp1`.`enable_status` = 1
					AND `seller`.`status` = 1
					AND `brand`.`status` = 1
					AND  (" . $product_like . " OR brand.brand_name like '%" . $search . "%')
					GROUP BY `pd`.`product_unique_id`
					LIMIT 100";



		$query_prod = $this->db->query($sql);

		if ($query_prod->num_rows() > 0) {
			$prod_result = $query_prod->result_object();


			foreach ($prod_result as $product_details) {
				$product_response = array();
				$product_response['id'] = $product_details->id;
				if ($langauge == "1") {
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


	// Remove unnecessary words from the search term and return them as an array
	function filterSearchKeys($query)
	{
		$query = trim(preg_replace("/(\s+)+/", " ", $query));
		$words = array();
		// expand this list with your words.
		// $list = array("or","I","you","they","to","but","that","this","those","then");
		$c = 0;
		foreach (explode(" ", $query) as $key) {
			//   if (in_array($key, $list)){
			//     continue;
			//}
			$words[] = trim($key);
			if ($c >= 15) {
				break;
			}
			$c++;
		}
		return $words;
	}
}
