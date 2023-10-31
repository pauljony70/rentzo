<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Brand_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	//Functiofor for get category
	function get_brand_request($langauge, $devicetype)
	{
		$category_result = array();

		$this->db->select('brand_id,brand_name, brand_name_ar,brand_img');
		$this->db->where(array('status' => 1));
		$this->db->order_by('brand_name', 'ASC');
		$query = $this->db->get('brand');

		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			foreach ($category_array as $cat_details) {
				$cat_response = array();
				$cat_response['brand_id'] = $cat_details->brand_id;
				if ($langauge == "1") {
					$cat_response['brand_name'] = $cat_details->brand_name_ar;
				} else {
					$cat_response['brand_name'] = $cat_details->brand_name;
				}

				if ($devicetype == 1) {
					$img_decode = json_decode($cat_details->brand_img);
					$img = '';
					if ($img_decode) {
						$img = $img_decode->{MOBILE};
					}
					$cat_response['imgurl'] = $img;
				} else {
					$img_decode = json_decode($cat_details->brand_img);
					$img = '';
					if ($img_decode) {
						$img = $img_decode->{DESKTOP};
					}
					$cat_response['imgurl'] = $img;
				}
				$category_result[] = $cat_response;
			}
		}

		return $category_result;
	}

	public function getTurkishBrands($language)
	{
		$brand_name = $language == 1 ? 'brand_name_ar' : 'brand_name';

		$brands =  $this->db->select('brand_id, ' . $brand_name . ' as brand_name, brand_img, brand_site_url')
			->where(array('status' => 1, 'brand_site_url !=' => ''))
			->get('brand')
			->result_array();
		foreach ($brands as $key => $brand) {
			$brands[$key]['brand_img'] = base_url('media/' . json_decode($brand['brand_img'])->{"72-72"});
		}
		return $brands;
	}

	//Functiofor for get brand product
	function get_brand_product_request($language, $brand_id, $pageno, $sortby, $devicetype)
	{
		$prod_result = array();
		$product_array = array();

		if ($pageno > 0) {
			$start = ($pageno * LIMIT);
		} else {
			$start = 0;
		}


		//get products details
		$this->db->select('vp1.product_sale_price as mrp_min, pd.product_unique_id as id , pd.prod_name as name,pd.prod_name_ar as name_ar,pd.web_url as web_url, 
							pd.product_sku as sku, pd.featured_img as img , "active" as active,
							vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_stock as stock, vp1.product_remark as remark');

		$this->db->join('vendor_product vp1', 'vp1.product_id = pd.product_unique_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
		$this->db->join('brand brand', 'brand.brand_id = pd.brand_id', 'INNER');

		$this->db->where(array('pd.status' => 1, 'vp1.enable_status' => 1, 'seller.status' => 1, 'brand.status' => 1, 'pd.brand_id' => $brand_id));
		$this->db->group_by("pd.product_unique_id");

		if ($sortby == 1) {
			$this->db->order_by("mrp_min", 'ASC');
		} else if ($sortby == 2) {
			$this->db->order_by("mrp_min", 'DESC');
		} else if ($sortby == 3) {
			$this->db->order_by("pd.created_at", 'DESC');
		} else if ($sortby == 4) {
			$this->db->order_by("pd.prod_rating_count", 'DESC');
		}

		$this->db->limit(LIMIT, $start);
		$query_prod = $this->db->get('product_details as pd');
		//print_r($this->db->last_query());die();
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
				$product_response['price'] = price_format($product_details->mrp_min);
				$product_response['stock'] = $product_details->stock;
				$product_response['remark'] = $product_details->remark;
				$product_response['rating'] = 0;

				$discount_per = 0;
				$discount_price = 0;
				if ($product_details->mrp_min > 0) {
					$discount_price = ($product_details->mrp - $product_details->mrp_min);

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

		//get products total
		$this->db->select('vp1.product_sale_price as mrp_min, pd.product_unique_id as id , pd.prod_name as name,pd.web_url as web_url, 
							pd.product_sku as sku, pd.featured_img as img , "active" as active,
							vp1.vendor_id, vp1.product_mrp as mrp, vp1.product_stock as stock, vp1.product_remark as remark');

		$this->db->join('vendor_product vp1', 'vp1.product_id = pd.product_unique_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp1.vendor_id = seller.seller_unique_id', 'INNER');
		$this->db->join('brand brand', 'brand.brand_id = pd.brand_id', 'INNER');

		$this->db->where(array('pd.status' => 1, 'vp1.enable_status' => 1, 'seller.status' => 1, 'brand.status' => 1, 'pd.brand_id' => $brand_id));
		$this->db->group_by("pd.product_unique_id");

		$query_prod1 = $this->db->get('product_details as pd');
		$total_record = $query_prod1->num_rows();
		return array("product_array" => $product_array, "total_count" => $total_record);
	}

	public function getTopBrands($language)
	{
		$brands = $this->db->distinct()
			->select('brand.brand_id, ' . ($language == 1 ? 'brand_name_ar' : 'brand_name') . ' as brand_name, brand_img, brand_site_url')
			->where(array('brand.status' => 1))
			->join('product_details', 'brand.brand_id = product_details.brand_id', 'right')
			->get('brand')
			->result_array();

		foreach ($brands as $key => $brand) {
			$brands[$key]['brand_img'] = json_decode($brand['brand_img'])->{'72-72'};
		}
		return $brands;
	}
}
