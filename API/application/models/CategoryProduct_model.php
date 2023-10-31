<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CategoryProduct_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	//Function for get sub category
	function get_subcatWithFilter_request($language, $parent_id = '', $devicetype)
	{
		$category_result = array();

		$this->db->select('cat_id as id,cat_name as name,cat_name_ar as name_ar,cat_img,cat_slug');

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
			}
		}

		return $category_result;
	}

	function get_category_product_request($language, $catid, $pageno, $sortby, $devicetype, $config_attr)
	{
		$prod_result = array();
		$product_array = array();

		if ($pageno > 0) {
			$start = ($pageno * LIMIT);
		} else {
			$start = 0;
		}
		$config_attr_decode =  json_decode($config_attr);
		// $catid = implode(',', $catid);
		//echo $catid;
		$this->db->select('product_category.prod_id');
		$this->db->join('product_details', 'product_details.product_unique_id = product_category.prod_id', 'INNER');
		$this->db->join('vendor_product vp', 'product_details.product_unique_id = vp.product_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');

		if ($config_attr_decode) {
			$this->db->join('product_attribute_value pav', 'vp.id = pav.vendor_prod_id', 'INNER');
		}

		$this->db->where_in('product_category.cat_id', $catid);
		$this->db->where(array('product_details.status' => 1, 'seller.status' => 1, 'vp.enable_status' => 1));

		//print_r($this->db);
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

		$this->db->group_by("product_category.prod_id");



		$query = $this->db->get('product_category');
		//print_r($this->db);

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

			if ($sortby == 1) {
				//echo " inside sorft 1";
				$this->db->order_by("vp2.mrp_min", 'ASC');
			} else if ($sortby == 2) {
				$this->db->order_by("vp2.mrp_min", 'DESC');
			} else if ($sortby == 3) {
				$this->db->order_by("pd.created_at", 'DESC');
			} else if ($sortby == 4) {
				$this->db->order_by("pd.prod_rating_count", 'DESC');
			}
			$this->db->group_by("pd.product_unique_id");
			$this->db->limit(LIMIT, $start);
			//	echo " secont uesry ";

			$query_prod = $this->db->get('product_details as pd');
			//print_r($this->db);
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

	function get_category_product_sponsor_request($language, $catid, $pageno, $sortby, $devicetype, $config_attr)
	{
		$prod_result = array();
		$product_array = array();

		if ($pageno > 0) {
			$start = ($pageno * LIMIT);
		} else {
			$start = 0;
		}
		$config_attr_decode =  json_decode($config_attr);
		// $catid = implode(',', $catid);
		//echo $catid;
		$this->db->select('sponsor_product.product_id');
		$this->db->join('product_details', 'product_details.product_unique_id = sponsor_product.product_id', 'INNER');
		$this->db->join('vendor_product vp', 'product_details.product_unique_id = vp.product_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');

		if ($config_attr_decode) {
			$this->db->join('product_attribute_value pav', 'vp.id = pav.vendor_prod_id', 'INNER');
		}

		$this->db->where_in('sponsor_product.cat_id', $catid);
		$this->db->where(array('product_details.status' => 1, 'seller.status' => 1, 'vp.enable_status' => 1));


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

		$this->db->group_by("sponsor_product.product_id");



		$query = $this->db->get('sponsor_product');
		//print_r($this->db);
		//print_r($this->db->last_query());
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
			$this->db->where(array('pd.status' => 1, 'seller.status' => 1, 'vp1.enable_status' => 1));

			if ($sortby == 1) {
				//echo " inside sorft 1";
				$this->db->order_by("vp2.mrp_min", 'ASC');
			} else if ($sortby == 2) {
				$this->db->order_by("vp2.mrp_min", 'DESC');
			} else if ($sortby == 3) {
				$this->db->order_by("pd.created_at", 'DESC');
			} else if ($sortby == 4) {
				$this->db->order_by("pd.prod_rating_count", 'DESC');
			}
			$this->db->group_by("pd.product_unique_id");
			$this->db->limit(LIMIT, $start);
			//	echo " secont uesry ";

			$query_prod = $this->db->get('product_details as pd');
			//print_r($this->db);
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


	//Functio for for get category product
	function get_category_product_request0($language, $catid, $pageno, $sortby, $devicetype, $config_attr)
	{
		// get product array
		$prod_result = array();
		$product_array = array();
		if ($pageno > 0) {
			$start = ($pageno * LIMIT);
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

		$this->db->where_in(array('product_category.cat_id' => $catid));
		$this->db->where(array('product_details.status' => 1, 'seller.status' => 1, 'vp.enable_status' => 1));

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

		$this->db->group_by("product_category.prod_id");

		$this->db->limit(LIMIT, $start);

		$query = $this->db->get('product_category');

		//echo 'fffffffff';
		//print_r($this->db);die;
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
}
