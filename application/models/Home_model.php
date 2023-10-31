<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->date_time = date('Y-m-d H:i:s');
	}

	function get_admin_email()
	{
		$this->db->select('description');
		$this->db->where(array('type' => 'system_email'));
		$query = $this->db->get('settings');

		$data_result = $query->result_object();
		foreach ($data_result as $admin_data) {
			$email = $admin_data->description;
		}
		return $email;
	}

	function get_admin_phone()
	{
		$this->db->select('description');
		$this->db->where(array('type' => 'system_phone'));
		$query1 = $this->db->get('settings');

		$data1_result = $query1->result_object();
		foreach ($data1_result as $admin1_data) {
			$phone = $admin1_data->description;
		}
		return $phone;
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

	function all_product_request()
	{
		$prod_result = array();

		$product_array = array();

		$start = 0;

		$sortby = 1;

		$devicetype = 1;


		$this->db->select('pd.product_unique_id,pd.product_sku,vp1.vendor_id');
		$this->db->join('vendor_product vp1', 'vp1.product_id = pd.product_unique_id', 'INNER');
		$query_prod = $this->db->get('product_details pd');



		if ($query_prod->num_rows() > 0) {

			$prod_result = $query_prod->result_object();



			$product_array = array();

			foreach ($prod_result as $productdetails) {

				$product_response = array();

				$product_response['id'] = $productdetails->product_unique_id;
				$product_response['sku'] = $productdetails->product_sku;

				$product_response['vendor_id'] = $productdetails->vendor_id;

				$product_array[] = $product_response;
			}
		}





		return $product_array;
	}

	function all_category_request()
	{
		$prod_result = array();

		$product_array = array();

		$start = 0;

		$sortby = 1;

		$devicetype = 1;


		$this->db->select('*');

		$query_prod = $this->db->get('category');



		if ($query_prod->num_rows() > 0) {

			$prod_result = $query_prod->result_object();



			$product_array = array();

			foreach ($prod_result as $productdetails) {

				$product_response = array();

				$product_response['id'] = $productdetails->cat_id;

				$product_response['name'] = $productdetails->cat_name;
				$product_response['cat_slug'] = $productdetails->cat_slug;

				$product_response['imgurl'] = $productdetails->cat_img;

				$product_array[] = $product_response;
			}
		}





		return $product_array;
	}

	function get_firebase_notification_request($devicetype)
	{
		$category_result = array();
		$this->db->select('id,noti_title,noti_body,pid,sid,sku,cid,search,home,clicktype,noti_img,created_at');
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get('firebase_notification');
		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			foreach ($category_array as $cat_details) {
				$cat_response = array();
				$cat_response['id'] = $cat_details->id;
				$cat_response['title'] = $cat_details->noti_title;
				$cat_response['noti_body'] = $cat_details->noti_body;
				$cat_response['pid'] = $cat_details->pid;
				$cat_response['sid'] = $cat_details->sid;
				$cat_response['sku'] = $cat_details->sku;
				$cat_response['cat_id'] = $cat_details->cid;
				$cat_response['search'] = $cat_details->search;
				$cat_response['home'] = $cat_details->home;
				$cat_response['clicktype'] = $cat_details->clicktype;
				$cat_response['date'] = $cat_details->created_at;



				if ($cat_details->cid != 0) {
					$this->db->select('*');
					$this->db->where(array('cat_id' => $cat_details->cid));
					$query_cat = $this->db->get('category');

					if ($query_cat->num_rows() > 0) {
						$cat_result = $query_cat->result_object();
						foreach ($cat_result as $cat_result_data) {
							$cat_response['cat_slug'] = $cat_result_data->cat_slug;
						}
					}
				} else {
					$cat_response['cat_slug'] = '';
				}

				$img_decode = json_decode($cat_details->noti_img);

				if ($devicetype == 1) {
					if (isset($img_decode->{MOBILE})) {
						$img = $img_decode->{MOBILE};
					} else {
						$img = $cat_details->noti_img;
					}
				} else {
					if (isset($img_decode->{DESKTOP})) {
						$img = $img_decode->{DESKTOP};
					} else {
						$img = $cat_details->noti_img;
					}
				}


				$cat_response['imgurl'] = $img;


				$category_result[] = $cat_response;
			}
		}
		return $category_result;
	}

	function get_aboutus_data_request()
	{
		$this->db->select('page_content');
		//$this->db->where(array('page_slug'=>'about-us'));
		$this->db->where('metaid', '8');
		$query1 = $this->db->get('seometa');

		$data1_result = $query1->result_object();
		foreach ($data1_result as $admin1_data) {
			$page_content = $admin1_data->page_content;
		}
		return $page_content;
	}

	function get_faq_data_request()
	{
		$this->db->select('page_content');
		$this->db->where('metaid', '12');
		$query1 = $this->db->get('seometa');

		$data1_result = $query1->result_object();
		foreach ($data1_result as $admin1_data) {
			$page_content = $admin1_data->page_content;
		}
		return $page_content;
	}

	function get_feedback_data_request()
	{
		$this->db->select('page_content');
		$this->db->where('metaid', '13');
		$query1 = $this->db->get('seometa');

		$data1_result = $query1->result_object();
		foreach ($data1_result as $admin1_data) {
			$page_content = $admin1_data->page_content;
		}
		return $page_content;
	}

	function get_help_data_request()
	{
		$this->db->select('page_content');
		$this->db->where('metaid', '14');
		$query1 = $this->db->get('seometa');

		$data1_result = $query1->result_object();
		foreach ($data1_result as $admin1_data) {
			$page_content = $admin1_data->page_content;
		}
		return $page_content;
	}

	function get_free_shipping_data_request()
	{
		$this->db->select('page_content');
		$this->db->where('metaid', '15');
		$query1 = $this->db->get('seometa');

		$data1_result = $query1->result_object();
		foreach ($data1_result as $admin1_data) {
			$page_content = $admin1_data->page_content;
		}
		return $page_content;
	}

	function get_refund_data_request()
	{
		$this->db->select('page_content');
		$this->db->where('metaid', '11');
		$query1 = $this->db->get('seometa');

		$data1_result = $query1->result_object();
		foreach ($data1_result as $admin1_data) {
			$page_content = $admin1_data->page_content;
		}
		return $page_content;
	}

	function get_privacy_data_request()
	{
		$this->db->select('page_content');
		$this->db->where('metaid', '9');
		$query1 = $this->db->get('seometa');

		$data1_result = $query1->result_object();
		foreach ($data1_result as $admin1_data) {
			$page_content = $admin1_data->page_content;
		}
		return $page_content;
	}

	function get_contact_data_request()
	{
		$this->db->select('page_content');
		$this->db->where('metaid', '7');
		$query1 = $this->db->get('seometa');

		$data1_result = $query1->result_object();
		foreach ($data1_result as $admin1_data) {
			$page_content = $admin1_data->page_content;
		}
		return $page_content;
	}

	function get_term_data_request()
	{
		$this->db->select('page_content');
		$this->db->where('metaid', '10');
		$query1 = $this->db->get('seometa');

		$data1_result = $query1->result_object();
		foreach ($data1_result as $admin1_data) {
			$page_content = $admin1_data->page_content;
		}
		return $page_content;
	}

	//Functiofor for get category product
	function get_popular_product_request($pageno, $sortby, $devicetype)
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
			$this->db->select('pd.product_unique_id as id , pd.prod_name as name,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
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
					$product_response['offpercent'] = round($discount_per) . ' % ' . $this->lang->line('off');

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
	function get_search_product_request($language, $search, $devicetype)
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;

		$keywords = $this->filterSearchKeys($search);
		$product_like = '';
		$product_meta_like = '';
		$s = 0;
		foreach ($keywords as $keys) {

			if ($s == 0) {
				$product_like .= " (prod_name like '%" . $keys . "%' OR prod_name_ar like '%" . $keys . "%'   OR pm.meta_title like '%" . $keys . "%' OR pm.meta_key like '%" . $keys . "%'  OR pm.meta_value like '%" . $keys . "%' )";
				//$product_meta_like .= " (pm.meta_title like '%".$keys."%' OR pm.meta_key like '%".$keys."%'  OR pm.meta_value like '%".$keys."%' )";
			} else {
				$product_like .= " AND (prod_name like '%" . $keys . "%' OR prod_name_ar like '%" . $keys . "%'   OR pm.meta_title like '%" . $keys . "%' OR pm.meta_key like '%" . $keys . "%'  OR pm.meta_value like '%" . $keys . "%' )";
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

		$sql = "SELECT `pd`.`product_unique_id` as `id`, `pd`.`prod_name` as `name`, `pd`.`prod_name_ar` as `name_ar`, `pd`.`web_url` as `web_url`, `pd`.`product_sku` as `sku`, `pd`.`featured_img` as `img`,  `vp1`.`vendor_id`, `vp1`.`product_mrp` as `mrp`, `vp1`.`product_sale_price` `price`, `vp1`.`product_stock` as `stock`, `vp1`.`stock_status`, `vp1`.`product_remark` as `remark`, 'active' as active
					FROM `product_details` as `pd`
					INNER JOIN `vendor_product` `vp1` ON `vp1`.`product_id` = `pd`.`product_unique_id`
					INNER JOIN `sellerlogin` `seller` ON `vp1`.`vendor_id` = `seller`.`seller_unique_id`
					LEFT JOIN  product_meta pm ON pm.prod_id = `pd`.`product_unique_id`
					LEFT JOIN  brand brand ON brand.brand_id = `pd`.`brand_id`
					WHERE `pd`.`status` = 1
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
				$product_response['rating'] = $this->product_model->get_product_review_total($product_details->id);

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


		return $product_array;
	}

	function get_search_sponsor_product_request($language, $search, $devicetype)
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
				$product_like .= " (prod_name like '%" . $keys . "%' OR prod_name_ar like '%" . $keys . "%'   OR pm.meta_title like '%" . $keys . "%' OR pm.meta_key like '%" . $keys . "%'  OR pm.meta_value like '%" . $keys . "%' )";
			} else {
				$product_like .= " AND (prod_name like '%" . $keys . "%' OR prod_name_ar like '%" . $keys . "%'   OR pm.meta_title like '%" . $keys . "%' OR pm.meta_key like '%" . $keys . "%'  OR pm.meta_value like '%" . $keys . "%' )";
			}
			$s++;
		}
		$pid = $pid == '' ? "" : " and vp1.product_id IN(" . $pid . ")";
		$sql = "SELECT `pd`.`product_unique_id` as `id`, `pd`.`prod_name` as `name`, `pd`.`prod_name_ar` as `name_ar`, `pd`.`web_url` as `web_url`, `pd`.`product_sku` as `sku`, `pd`.`featured_img` as `img`,  `vp1`.`vendor_id`, `vp1`.`product_mrp` as `mrp`, `vp1`.`product_sale_price` `price`, `vp1`.`product_stock` as `stock`, `vp1`.`product_remark` as `remark`, 'active' as active
					FROM `product_details` as `pd`
					INNER JOIN `vendor_product` `vp1` ON `vp1`.`product_id` = `pd`.`product_unique_id`
					INNER JOIN `sellerlogin` `seller` ON `vp1`.`vendor_id` = `seller`.`seller_unique_id`
					LEFT JOIN  product_meta pm ON pm.prod_id = `pd`.`product_unique_id`
					LEFT JOIN  brand brand ON brand.brand_id = `pd`.`brand_id`
					WHERE `pd`.`status` = 1
					$pid
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
				$product_response['rating'] = $this->product_model->get_product_review_total($product_details->id);

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


		return $product_array;
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

	function get_home_section2_request($section)
	{
		$this->db->select('*');

		$this->db->where(array('section' => $section));
		$query = $this->db->get('homepage_banner');

		$banner_result = array();
		if ($query->num_rows() > 0) {
			$banner_result = $query->result_object();
		}

		return $banner_result;
	}
	function get_header_section5_request($section)
	{

		$query = $this->db->query('SELECT hb.*,cat.cat_name,cat.cat_name_ar,cat.cat_slug,cat.sub_title FROM `homepage_banner` hb, category cat WHERE hb.cat_id=cat.cat_id AND hb.section = "' . $section . '"');

		$banner_result = array();
		if ($query->num_rows() > 0) {
			$banner_result = $query->result_object();
		}

		return $banner_result;
	}

	function sub_category($language, $devicetype, $slag)
	{
		$category_result = array();
		$this->db->select('cat.cat_id,cat.cat_name,cat.cat_name_ar,cat.cat_img,cat.parent_id,cat.cat_slug, cat.web_banner');
		$this->db->where(array('cat.status' => 1, 'cat.cat_slug' => $slag));
		$this->db->order_by('cat.cat_id', 'desc');
		$query = $this->db->get('category cat');
		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			foreach ($category_array as $cat_details) {
				$cat_response = array();
				$cat_response['cat_id'] = $cat_details->cat_id;
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
				$this->db->select('cat.cat_id,cat.cat_name, cat.cat_name_ar,cat.cat_img,cat.parent_id,cat.cat_slug');
				$this->db->where(array('cat.status' => 1, 'cat.parent_id' => $cat_details->cat_id));
				$this->db->order_by('cat.cat_order', 'ASC');
				$querysubcat = $this->db->get('category cat');
				$cat_response['subcat_1'] = array();
				if ($querysubcat->num_rows() > 0) {
					$category_sub = $querysubcat->result_object();
					foreach ($category_sub as $subcat_details) {
						$scat_response = array();
						$scat_response['cat_id'] = $subcat_details->cat_id;
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
						$this->db->select('cat.cat_id,cat.cat_name, cat.cat_name_ar,cat.cat_img,cat.parent_id,cat.cat_slug');
						$this->db->where(array('cat.status' => 1, 'cat.parent_id' => $subcat_details->cat_id));
						$this->db->order_by('cat.cat_order', 'ASC');
						$querysubcat1 = $this->db->get('category cat');
						$scat_response['subsubcat_2'] = array();
						if ($querysubcat1->num_rows() > 0) {
							$category_sub1 = $querysubcat1->result_object();
							foreach ($category_sub1 as $subcat_details1) {
								$scat_response1 = array();
								$scat_response1['cat_id'] = $subcat_details1->cat_id;
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

	function get_category()
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



		$query_prod = $this->db->get('category');



		if ($query_prod->num_rows() > 0) {

			$prod_result = $query_prod->result_object();



			$product_array = array();

			foreach ($prod_result as $productdetails) {

				$product_response = array();

				$product_response['id'] = $productdetails->cat_id;

				$product_response['name'] = $productdetails->cat_name;





				$product_response['imgurl'] = $productdetails->cat_img;

				$product_array[] = $product_response;
			}
		}





		return $product_array;
	}

	function get_explore_category()
	{

		$prod_result = array();

		$product_array = array();

		$start = 0;

		$sortby = 1;

		$devicetype = 1;


		$this->db->select('*');





		$this->db->where_in('cat_id', '10');

		$this->db->limit(20, $start);



		$query_prod = $this->db->get('category');



		if ($query_prod->num_rows() > 0) {

			$prod_result = $query_prod->result_object();



			$product_array = array();

			foreach ($prod_result as $productdetails) {

				$product_response = array();

				$product_response['id'] = $productdetails->cat_id;

				$product_response['name'] = $productdetails->cat_name;





				$product_response['imgurl'] = $productdetails->cat_img;
				$product_response['web_banner'] = $productdetails->web_banner;

				$product_array[] = $product_response;
			}
		}





		return $product_array;
	}


	function get_home_products($language, $type, $timezone)
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
			$this->db->select('pd.product_unique_id as id , pd.prod_name as name, pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,	vp1.vendor_id, offer_start_date, offer_end_date, vp1.product_mrp as mrp, vp1.product_sale_price price, vp1.product_stock as stock, vp1.product_remark as remark, is_usd_price');


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
					$product_response['mrp'] = $product_details->is_usd_price ? price_format_usd($product_details->mrp) : price_format($product_details->mrp);
					$product_response['price'] = $product_details->is_usd_price ? price_format_usd($product_details->price) : price_format($product_details->price);
					$product_response['stock'] = $product_details->stock;
					$product_response['remark'] = $product_details->remark;
					$product_response['rating'] = $this->product_model->get_product_review_total($product_details->id);

					$discount_per = 0;
					$discount_price = 0;
					if ($product_details->price > 0) {
						$discount_price = ($product_details->mrp - $product_details->price);

						$discount_per = ($discount_price / $product_details->mrp) * 100;
					}
					$product_response['totaloff'] = $product_details->is_usd_price ? price_format_usd($discount_price) : price_format($discount_price);
					$product_response['offpercent'] = round($discount_per) . ' % ' . $this->lang->line('off');

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

					$product_response['offer'] = 0;

					$product_response['imgurl'] = MEDIA_URL . $img;
					if (!empty($product_details->offer_start_date) && !empty($product_details->offer_end_date) && !empty($timezone)) {
						// Your offer start and end dates in the "Asia/Muscat" time zone
						$offer_start_date_string = $product_details->offer_start_date;
						$offer_end_date_string = $product_details->offer_end_date;

						// Convert the dates to DateTime objects with the "Asia/Muscat" time zone
						$muscat_time_zone = new DateTimeZone("Asia/Muscat");
						$offer_start_date = new DateTime($offer_start_date_string, $muscat_time_zone);
						$offer_end_date = new DateTime($offer_end_date_string, $muscat_time_zone);

						// Convert the dates to the local time zone (modify this to your local time zone)
						$local_time_zone = new DateTimeZone($timezone);
						$offer_start_date->setTimezone($local_time_zone);
						$offer_end_date->setTimezone($local_time_zone);

						// Get the current date and time in the local time zone
						$current_date = new DateTime("now", $local_time_zone);

						// Check if the offer has started
						$offer_started = $current_date >= $offer_start_date;

						// Check if the offer has ended
						$offer_ended = $current_date >= $offer_end_date;

						// Calculate the remaining time until the offer ends
						$remaining_time = $offer_end_date->diff($current_date);

						// Output the results
						// echo "Offer Start Date (Local Time Zone): " . $offer_start_date->format('Y-m-d H:i:s') . PHP_EOL;
						// echo "Offer End Date (Local Time Zone): " . $offer_end_date->format('Y-m-d H:i:s') . PHP_EOL;
						if ($offer_ended) {
							$product_response['offer'] = 0; // Offer has ended, so remaining time is 0.
						} else if ($offer_started) {
							// Get the remaining time in hours, minutes, and seconds
							$days_to_hours = $remaining_time->days * 24; // Convert days to hours
							$hours = $days_to_hours + $remaining_time->format('%h');
							$minutes = $remaining_time->format('%i');
							$seconds = $remaining_time->format('%s');
							$product_response['offer'] = 1;
							$product_response['remaining_hours'] = $hours;
							$product_response['remaining_minutes'] = $minutes;
							$product_response['remaining_seconds'] = $seconds;
						} else {
							$product_response['offer'] = 0; // Offer has not started yet
						}
					}
					$product_array[] = $product_response;
				}
			}
		}

		return $product_array;
	}

	function get_order_details_products($language, $type)
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

			$this->db->order_by('rand()');
			$this->db->limit(2);


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
					$product_response['rating'] = $this->product_model->get_product_review_total($product_details->id);

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

	function get_home_cat_products($language, $catid)
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;
		$sortby = 1;
		$devicetype = 1;

		$this->db->select('product_category.prod_id');
		$this->db->join('product_details', 'product_details.product_unique_id = product_category.prod_id', 'INNER');
		$this->db->join('vendor_product vp', 'product_details.product_unique_id = vp.product_id', 'INNER');
		$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id', 'INNER');
		$this->db->where_in('product_category.cat_id', $catid);
		$this->db->where(array('product_details.status' => 1, 'seller.status' => 1, 'vp.enable_status' => 1));
		$this->db->group_by("product_category.prod_id");

		$this->db->limit(6, $start);

		$query = $this->db->get('product_category');

		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			$product_id = array();
			foreach ($category_result as $cat_product) {
				$product_id[] = $cat_product->prod_id;
			}


			//get products details
			$this->db->select('pd.product_unique_id as id , pd.prod_name as name, pd.prod_name_ar as name_ar,pd.prod_name_ar as name_ar,pd.web_url as web_url, pd.product_sku as sku, pd.featured_img as img , "active" as active,
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
					$product_response['remark'] = html_entity_decode($product_details->remark);
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


	//Functio for get recent product
	function get_recent_products_request($language, $devicetype, $product_ids)
	{
		$prod_result = array();
		$product_array = array();

		$start = 0;
		$sortby = 1;

		if ($product_ids) {
			$product_id = explode(',', $product_ids);

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

			$this->db->limit(10, $start);
			$query_prod = $this->db->get('product_details as pd');

			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();

				$product_array = array();
				foreach ($prod_result as $product_details) {
					$product_response = array();
					$product_response['id'] = $product_details->id;
					if ($language == 1) {
						$product_response['name'] = html_entity_decode($product_details->name_ar);
					} else {
						$product_response['name'] = html_entity_decode($product_details->name);
					}
					$product_response['web_url'] = $product_details->web_url;
					$product_response['sku'] = $product_details->sku;
					$product_response['active'] = $product_details->active;
					$product_response['vendor_id'] = $product_details->vendor_id;
					$product_response['mrp'] = price_format($product_details->mrp);
					$product_response['price'] = price_format($product_details->price);
					$product_response['stock'] = $product_details->stock;
					$product_response['remark'] = html_entity_decode($product_details->remark);
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


	function get_subcategory_request($language, $category_result, $parent_id = '', $devicetype)
	{
		//$category_result = array();

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
		//$category_result = array();
		$this->db->select('cat_id as id,cat_name as name, cat_name as name_ar, cat_img,cat_slug');

		$this->db->where(array('cat.status' => 1, 'cat.parent_id' => $parent_id));
		$this->db->order_by('cat.cat_order', 'ASC');

		//$this->db->limit(8, 0);
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

	function getTopOffers($language)
	{
		if ($language == 1)
			$this->db->select('heading_ar as heading, description_ar as description, offer_page_title_ar as offer_page_title, offer_page_link');
		elseif ($language == 2)
			$this->db->select('heading, description, offer_page_title, offer_page_link');
		$this->db->limit(3, 0);
		return $this->db->get('top_offers')->result_array();
	}

	public function get_bank_details()
	{
		$this->load->library('encryption');
		$data = $this->db->get_where('bank_details', array('user_id' => $this->session->userdata('user_id')))->row_array();
		if (!empty($data)) {
			$publickey_server = $this->config->item("encryption_key");
			$encruptfun = new encryptfun();
			$data['account_number'] = $encruptfun->decrypt($publickey_server, $data['account_number']);
		}
		return $data;
	}
}
