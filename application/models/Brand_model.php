<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Brand_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	//Functiofor for get category
	function get_brand_request($language, $devicetype)
	{
		$brands =  $this->db->select('brand_id, brand_name, brand_name_ar, brand_img, brand_site_url')
			->where(array('status' => 1))
			->get('brand')
			->result_array();

		return $brands;
	}

	public function getTurkishBrands($language)
	{
		$brand_name = $language == 1 ? 'brand_name_ar' : 'brand_name';

		$brands =  $this->db->select('brand_id, ' . $brand_name . ' as brand_name, brand_img, brand_site_url, popular_brand')
			->where(array('status' => 1, 'brand_site_url !=' => ''))
			->get('brand')
			->result_array();

		return $brands;
	}

	public function getTopBrands($language)
	{
		$brands =  $this->db->distinct()
			->select('brand.brand_id, brand_name_ar, brand_name, brand_img, brand_site_url')
			->where(array('brand.status' => 1))
			->join('product_details', 'brand.brand_id = product_details.brand_id', 'right')
			->get('brand')
			->result_array();

		return $brands;
	}

	//Functiofor for get brand product
	function get_brand_product_request($language, $brand_name, $pageno, $sortby, $min_price, $max_price, $rating, $config_attr)
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
		$this->db->select('pd.product_unique_id as id, pd.prod_name as name, pd.prod_name_ar as name_ar, pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img, vp.vendor_id, vp.is_usd_price, vp.product_mrp as mrp, vp.product_sale_price price, vp.product_stock as stock, vp.stock_status, vp.product_remark as remark,pd.day1_price')
			->join('vendor_product vp', 'pd.product_unique_id = vp.product_id', 'INNER')
			->join('brand', 'brand.brand_id = pd.brand_id', 'INNER')
			->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');

		if ($rating !== '') {
			$this->db->join('product_review', 'pd.product_unique_id = product_review.product_id', 'LEFT');
			$this->db->having('AVG(product_review.rating) >=', $rating);
		}

		if ($config_attr_decode) {
			$this->db->join('product_attribute_value pav', 'vp.id = pav.vendor_prod_id', 'INNER');
		}

		if ($min_price != '' && $max_price !== '')
			$this->db->where(array('vp.product_sale_price >=' => $min_price, 'vp.product_sale_price <=' => $max_price,));

		$this->db->where('brand.brand_name', $brand_name)
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
				$prod_result[$key]['day1_price'] = price_format($product_details['day1_price']);
				$prod_result[$key]['rating'] = $this->product_model->get_product_review_total($product_details['id']);
				$discount_per = 0;
				$discount_price = 0;
				if ($product_details['price'] > 0) {
					$discount_price = ($product_details['mrp'] - $product_details['price']);

					$discount_per = ($discount_price / $product_details['mrp']) * 100;
				}
				$prod_result[$key]['totaloff'] = price_format($discount_price);
				$prod_result[$key]['offpercent'] = round($discount_per) . '% ' . $this->lang->line('off');
				$img_decode = json_decode($product_details['img']);
				$prod_result[$key]['imgurl'] = $img_decode->{'72-72'};
			}
		}
		return array(
			"product_array" => $prod_result,
			"total_pages" => ceil($total / $per_page),
			"brand_name" => $brand_name
		);
	}

	function getBrandProductFilter($language, $brand_name)
	{
		$this->db->select('vp.product_id, ' . ($language == 1 ? 'brand_name_ar' : 'brand_name') . ' as brand_name');
		$this->db->join('product_details', 'product_details.product_unique_id = vp.product_id');
		$this->db->join('brand', 'brand.brand_id = product_details.brand_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id');
		$this->db->where('brand.brand_name', $brand_name);
		$this->db->where(array('product_details.status' => 1, 'seller.status' => 1, 'vp.enable_status' => 1));
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
				->join('product_details', 'product_details.product_unique_id = vendor_product.product_id')
				->join('brand', 'brand.brand_id = product_details.brand_id', 'INNER')
				->where('brand.brand_name', $brand_name)
				->get('vendor_product');

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
				'brand_name' => $product_result[0]->brand_name
			];
		}
		return [
			'attribute_array' => '',
			'price_filter' => '',
			'brand_name' => ''
		];
	}
}
