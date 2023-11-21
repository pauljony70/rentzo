<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	//Functiofor for add product into cart
	function add_product_cart($prod_id, $sku, $sid, $user_id, $qty, $referid, $affiliated_by, $qouteid)
	{
		if ($qouteid == 0 || $qouteid == "") {
			$quote_id =  date("dm") . date("hi") . rand(1, 99); //    rand(1000,9999).substr(strtotime("now"), 4, 10);
		} else {
			$quote_id =  $qouteid;
		}

		$this->db->select("id");

		if ($user_id) {
			$this->db->where(array('prod_id' => $prod_id, 'user_id' => $user_id));
		} else if ($quote_id) {
			$this->db->where(array('prod_id' => $prod_id, 'qoute_id' => $quote_id));
		}
		$query = $this->db->get('cartdetails');

		$cart = $status = array();

		if ($query->num_rows() > 0) {
			$cart['prod_id'] = $prod_id;
			$cart['attr_sku'] = $sku;
			$cart['vendor_id'] = $sid;
			$cart['user_id'] = $user_id;
			$cart['qty'] = $qty;
			$cart['refer_id'] = $referid;
			$cart['affiliated_by'] = $affiliated_by;
			$cart['qoute_id'] = $quote_id;

			if ($user_id) {
				$this->db->where(array('prod_id' => $prod_id, 'user_id' => $user_id));
			} else if ($quote_id) {
				$this->db->where(array('prod_id' => $prod_id, 'qoute_id' => $quote_id));
			}

			$query = $this->db->update('cartdetails', $cart);
			if ($query) {
				$status['status'] = 'update';
			}
		} else {

			$cart['prod_id'] = $prod_id;
			$cart['attr_sku'] = $sku;
			$cart['vendor_id'] = $sid;
			$cart['user_id'] = $user_id;
			$cart['qty'] = $qty;
			$cart['refer_id'] = $referid;
			$cart['affiliated_by'] = $affiliated_by;
			$cart['qoute_id'] = $quote_id;

			$query = $this->db->insert('cartdetails', $cart);
			if ($query) {
				$status['status'] = 'add';
			}
		}
		$status['quote_id'] = $quote_id;
		return $status;
	}
	
	function add_product_cart_rent($prod_id, $sku, $sid, $user_id, $qty, $referid, $affiliated_by, $qouteid,$rent_price,$rent_from_date,$rent_to_date,$cart_type)
	{
		if ($qouteid == 0 || $qouteid == "") {
			$quote_id =  date("dm") . date("hi") . rand(1, 99); //    rand(1000,9999).substr(strtotime("now"), 4, 10);
		} else {
			$quote_id =  $qouteid;
		}

		$this->db->select("id");

		if ($user_id) {
			$this->db->where(array('prod_id' => $prod_id, 'user_id' => $user_id));
		} else if ($quote_id) {
			$this->db->where(array('prod_id' => $prod_id, 'qoute_id' => $quote_id));
		}
		$query = $this->db->get('cartdetails');

		$cart = $status = array();

		if ($query->num_rows() > 0) {
			$cart['prod_id'] = $prod_id;
			$cart['attr_sku'] = $sku;
			$cart['vendor_id'] = $sid;
			$cart['user_id'] = $user_id;
			$cart['qty'] = $qty;
			$cart['refer_id'] = $referid;
			$cart['affiliated_by'] = $affiliated_by;
			$cart['qoute_id'] = $quote_id;
			$cart['rent_price'] = $rent_price;
			$cart['rent_from_date'] = $rent_from_date;
			$cart['rent_to_date'] = $rent_to_date;
			$cart['cart_type'] = $cart_type;

			if ($user_id) {
				$this->db->where(array('prod_id' => $prod_id, 'user_id' => $user_id));
			} else if ($quote_id) {
				$this->db->where(array('prod_id' => $prod_id, 'qoute_id' => $quote_id));
			}

			$query = $this->db->update('cartdetails', $cart);
			if ($query) {
				$status['status'] = 'update';
			}
		} else {

			$cart['prod_id'] = $prod_id;
			$cart['attr_sku'] = $sku;
			$cart['vendor_id'] = $sid;
			$cart['user_id'] = $user_id;
			$cart['qty'] = $qty;
			$cart['refer_id'] = $referid;
			$cart['affiliated_by'] = $affiliated_by;
			$cart['qoute_id'] = $quote_id;
			$cart['rent_price'] = $rent_price;
			$cart['rent_from_date'] = $rent_from_date;
			$cart['rent_to_date'] = $rent_to_date;
			$cart['cart_type'] = $cart_type;

			$query = $this->db->insert('cartdetails', $cart);
			if ($query) {
				$status['status'] = 'add';
			}
		}
		$status['quote_id'] = $quote_id;
		return $status;
	}


	//Functiofor for delete product from cart
	function delete_product_cart($pid, $user_id, $quote_id)
	{

		$this->db->where(array('prod_id' => $pid, 'user_id' => $user_id));
		$query = $this->db->delete('cartdetails');

		if ($query) {
			return 'delete';
		}
	}

	function delete_product_buynow_cart($user_id, $quote_id)
	{

		if ($user_id) {
			$this->db->where(array('user_id' => $user_id));
		} else if ($quote_id) {
			$this->db->where(array('qoute_id' => $quote_id));
		}

		$query = $this->db->delete('cartdetails');

		if ($query) {
			return 'delete';
		}
	}

	//function for get user cart details

	function get_cart_details($user_id, $quote_id)
	{
		$this->db->select("cd.prod_id, cd.attr_sku, cd.vendor_id, cd.qty,cd.qoute_id");

		$this->db->join('product_details pd', 'pd.product_unique_id = cd.prod_id', 'INNER');
		$this->db->join('vendor_product vp', 'vp.product_id = pd.product_unique_id AND vp.vendor_id = cd.vendor_id', 'INNER');
		$this->db->join('sellerlogin', 'sellerlogin.seller_unique_id = vp.vendor_id', 'INNER');

		if ($user_id) {
			$this->db->where(array('pd.status' => 1, 'vp.enable_status' => 1, 'sellerlogin.status' => 1, 'user_id' => $user_id));
		} else {
			$this->db->where(array('pd.status' => 1, 'vp.enable_status' => 1, 'sellerlogin.status' => 1, 'qoute_id' => $quote_id));
		}


		$query = $this->db->get('cartdetails cd');

		$cart = array();
		$qty = 0;
		$qoute_id = "";
		if ($query->num_rows() > 0) {
			$cart_result = $query->result_object();
			foreach ($cart_result as $cart_detail) {

				$qty += $cart_detail->qty;
				$qoute_id = $cart_detail->qoute_id;
			}
		}
		return array('qty' => $qty, 'qoute_id' => $qoute_id);
	}


	function check_product_conf($pid, $sku, $sid, $user_id, $qty, $referid, $qouteid)
	{

		$this->db->select("product_sku,product_unique_id ");

		$this->db->where(array('product_unique_id' => $pid, 'product_sku' => $sku));
		$query_prod = $this->db->get('product_details');

		$product_detail = array();
		$conf =  '';
		if ($query_prod->num_rows() > 0) {

			$this->db->select("pav.product_sku, pav.product_id ");
			$this->db->join('vendor_product vp', 'vp.id = pav.vendor_prod_id', 'INNER');

			$this->db->where(array('pav.product_id' => $pid, 'vp.vendor_id' => $sid));
			$query_prod_conf = $this->db->get('product_attribute_value pav');

			if ($query_prod_conf->num_rows() > 0) {
				$conf = "yes";
			} else {
				$conf = "no";
			}
		} else {
			/*$this->db->select("pav.product_sku, pav.product_id ");	
			$this->db->join('vendor_product vp', 'vp.id = pav.vendor_prod_id','INNER');			
			
			$this->db->where(array('pav.product_id'=>$pid, 'pav.product_sku'=>$sku, 'vp.vendor_id'=>$sid));		
			$query_prod_conf = $this->db->get('product_attribute_value pav');
			
			if($query_prod_conf->num_rows() >0){
				$conf = "yes";
			}*/
		}
		return $conf;
	}
	function validate_product_cart($pid, $sku, $sid)
	{

		$this->db->select("id, product_stock,stock_status,product_purchase_limit ");

		$this->db->where(array('product_id' => $pid, 'vendor_id' => $sid));
		$query_prod = $this->db->get('vendor_product');

		$product_detail = array();
		$conf =  '';
		if ($query_prod->num_rows() > 0) {
			$p_result = $query_prod->result_object();

			$product_stock = $p_result[0]->product_stock;
			$stock_status = $p_result[0]->stock_status;
			$product_purchase_limit = $p_result[0]->product_purchase_limit;

			$this->db->select("stock");

			$this->db->where(array('product_id' => $pid, 'vendor_prod_id' => $p_result[0]->id, 'product_sku' => $sku));
			$query_prod_conf = $this->db->get('product_attribute_value');

			if ($query_prod_conf->num_rows() > 0) {
				$pc_result = $query_prod_conf->result_object();
				$product_stock = $pc_result[0]->stock;
			}
		}
		return array('product_stock' => $product_stock, 'stock_status' => $stock_status, 'product_purchase_limit' => $product_purchase_limit);
	}

	function get_cart_full_details($language, $user_id, $devicetype = '', $qouteid, $shipping_city = '')
	{

		// get delivery details
		$delivery_array = array();
		if ($shipping_city) {
			$delivery_array = $this->delivery_model->get_delivery_city_details_request($shipping_city);
		}
		$this->db->select("prod_id, attr_sku, vendor_id, qty,qoute_id,rent_price,rent_from_date,rent_to_date,cart_type");

		$this->db->where(array('user_id' => $user_id));

		$query = $this->db->get('cartdetails');

		$product_detail_array = array();
		$total_mrp = $total_discount = $total_price = $total_item = $qoute_id = 0;

		// print_r($qoute_id);exit;
		$total_shipping_fee = 0;
		if ($query->num_rows() > 0) {
			$cart_result = $query->result_object();
			foreach ($cart_result as $cart_detail) {
				$prod_id = $cart_detail->prod_id;
				$sku = $cart_detail->attr_sku;
				$vendor_id = $cart_detail->vendor_id;
				$qty = $cart_detail->qty;
				$qoute_id = $cart_detail->qoute_id;
				$rent_price = $cart_detail->rent_price;
				$rent_from_date = $cart_detail->rent_from_date;
				$rent_to_date = $cart_detail->rent_to_date;
				$cart_type = $cart_detail->cart_type;
				if($cart_type == '')
				{
					$cart_type = 'Purchase';
				}
				$total_days = '';
				if($rent_from_date != '' && $rent_to_date != '')
				{
					$earlier = new DateTime($rent_from_date);
					$later = new DateTime($rent_to_date);
					
					$total_days = $later->diff($earlier)->format("%a")+1;
				}

				//check product details
				$this->db->select("product_sku, prod_name, prod_name_ar,featured_img,web_url,is_heavy	,sellerlogin.companyname as seller, vp.product_mrp, vp.product_sale_price, vp.product_stock, vp.product_purchase_limit, vp.id as vendor_prod_id,security_deposit");
				//join for get vendor product
				$this->db->join('vendor_product vp', 'vp.product_id = product_details.product_unique_id', 'INNER');
				$this->db->join('sellerlogin', 'sellerlogin.seller_unique_id = vp.vendor_id', 'INNER');

				$this->db->where(array('product_details.status' => 1, 'vp.enable_status' => 1, 'sellerlogin.status' => 1, 'product_unique_id' => $prod_id, 'vendor_id' => $vendor_id));

				$query_prod = $this->db->get('product_details');

				$product_detail = array();
				$product_detail['qty'] = 0;
				$product_detail['mrp1'] = price_format(0);
				$product_detail['price1'] = price_format(0);
				$product_detail['qty'] = 0;

				if ($query_prod->num_rows() > 0) {
					$prod_result = $query_prod->result_object();

					$product_detail['prodid'] = $prod_id;
					//$product_detail['sku'] = $prod_result[0]->product_sku;

					$product_detail['sku'] = $sku;
					$product_detail['vendor_id'] = $vendor_id;
					if ($language == 1) {
						$product_detail['name'] = $prod_result[0]->prod_name_ar;
					} else {
						$product_detail['name'] = $prod_result[0]->prod_name;
					}

					$product_detail['web_url'] = $prod_result[0]->web_url;
					$product_detail['purchase_limit'] = $prod_result[0]->product_purchase_limit;
					$product_detail['available_stock'] = $prod_result[0]->product_stock;
					$product_detail['security_deposit'] = $prod_result[0]->security_deposit;
					$product_detail['qty'] = $qty;
					$product_detail['configure_attr'] = array();
					$product_detail['mrp'] = price_format(0);
					$product_detail['price'] = price_format(0);
					$product_detail['totaloff'] = price_format(0);
					$product_detail['offpercent'] = 0;
					$product_detail['shipping_fee'] = 0;
					$product_detail['rent_price'] = $rent_price;
					$product_detail['rent_from_date'] = $rent_from_date;
					$product_detail['rent_to_date'] = $rent_to_date;
					$product_detail['total_days'] = $total_days;
					$product_detail['cart_type'] = $cart_type;
					if ($devicetype == 1) {
						$img_decode = json_decode($prod_result[0]->featured_img);
						$img = '';
						if ($img_decode) {
							$img = $img_decode->{MOBILE};
						}
						$product_detail['imgurl'] = $img;
					} else {
						$img_decode = json_decode($prod_result[0]->featured_img);
						$img = '';
						if ($img_decode) {
							$img = $img_decode->{DESKTOP};
						}
						$product_detail['imgurl'] = $img;
					}

					if ($prod_result[0]->product_sku == $sku) {
						//check vendor product details

						$tot_mrp = ($prod_result[0]->product_mrp * $qty);
						$tot_price = ($prod_result[0]->product_sale_price * $qty);

						$product_detail['mrp'] = price_format($prod_result[0]->product_mrp);
						$product_detail['price'] = price_format($prod_result[0]->product_sale_price);

						$product_detail['mrp1'] = $tot_mrp;
						$product_detail['price1'] = $tot_price;

						$discount_price = 0;
						if ($prod_result[0]->product_sale_price > 0) {
							$discount_price = ($prod_result[0]->product_mrp - $prod_result[0]->product_sale_price);

							$discount_per = ($discount_price / $prod_result[0]->product_mrp) * 100;
						}
						$product_detail['totaloff'] = price_format($discount_price);
						$product_detail['offpercent'] = round($discount_per) . '% ' . $this->lang->line('off');
					} else {
						$vendor_prod_id = $prod_result[0]->vendor_prod_id;

						$this->db->select("prod_attr_value, price, mrp, stock");
						$this->db->where(array('product_id' => $prod_id, 'vendor_prod_id' => $vendor_prod_id, 'product_sku' => $sku));

						$query_prod_attr = $this->db->get('product_attribute_value');


						if ($query_prod_attr->num_rows() > 0) {
							$prod_attr_result = $query_prod_attr->result_object();

							$tot_mrp1 = ($prod_attr_result[0]->mrp * $qty);
							$tot_price1 = ($prod_attr_result[0]->price * $qty);

							$product_detail['mrp'] = price_format($prod_attr_result[0]->mrp);
							$product_detail['price'] = price_format($prod_attr_result[0]->price);

							$product_detail['mrp1'] = $tot_mrp1;
							$product_detail['price1'] = $tot_price1;

							$discount_price = 0;
							if ($prod_attr_result[0]->price > 0) {
								$discount_price = ($prod_attr_result[0]->mrp - $prod_attr_result[0]->price);

								$discount_per = ($discount_price / $prod_attr_result[0]->mrp) * 100;
							}
							$product_detail['totaloff'] = price_format($discount_price);
							$product_detail['offpercent'] = round($discount_per) . '% ' . $this->lang->line('off');
							$product_detail['available_stock'] = $prod_attr_result[0]->stock;
							$product_detail['configure_attr'] = $this->get_product_configure_attr(json_decode($prod_attr_result[0]->prod_attr_value), $prod_id, $vendor_id);
						}
					}

					$is_heavy = $prod_result[0]->is_heavy;
					$shipping_fee1 = 0;
					if ($delivery_array) {
						if ($is_heavy == 1 && $product_detail['price'] < $delivery_array['order_value']) {
							$shipping_fee1 = $delivery_array['big_item_fee'];
							$product_detail['shipping_fee'] = price_format($delivery_array['big_item_fee']);
						} else if ($is_heavy == 0) {
							$shipping_fee1 = $delivery_array['basic_fee'];
							$product_detail['shipping_fee'] = price_format($delivery_array['basic_fee']);
						}
					}
					
					if($rent_price != '')
					{
						$product_detail['mrp'] = $rent_price;
						$product_detail['mrp1'] = $rent_price * $qty;
						$product_detail['price1'] = $rent_price * $qty;
						$product_detail['price'] = $rent_price;
						$product_detail['totaloff'] = '';
					}
					
					
				}


				$total_mrp += $product_detail['mrp1'];

				$total_price += $product_detail['price1'];
				//$total_item += $product_detail['qty'];
				$total_item += $query_prod->num_rows();
				$total_shipping_fee += $shipping_fee1;


				unset($product_detail['mrp1']);
				unset($product_detail['price1']);
				$product_detail_array[] = $product_detail;
			}
		}


		return array(
			'cart_full' => $product_detail_array, 'qoute_id' => $qoute_id, 'total_mrp' => price_format($total_mrp), 'total_discount' => price_format($total_mrp - $total_price),
			'total_price' => price_format($total_price), 'total_item' => $total_item, 'total_shipping_fee' => price_format($total_shipping_fee), 'payable_amount' => price_format($total_price + $total_shipping_fee)
		);
	}


	//function for get product attribute 

	function get_product_configure_attr($configure_attr, $prod_id, $vendor_id)
	{
		$attribute_full_array = array();
		foreach ($configure_attr as $attribute) {

			$this->db->select("prod_attr_id, attribute");
			$this->db->join('product_attributes_set pas', 'pas.id = pa.prod_attr_id', 'INNER');

			$this->db->where(array('prod_id' => $prod_id, 'vendor_id' => $vendor_id));
			$this->db->like('attr_value', "" . $attribute . "");
			$query = $this->db->get('product_attribute pa');

			$attribute_array = array();

			if ($query->num_rows() > 0) {
				$attr_result = $query->result_object();
				$attribute_array['attr_id'] = $attr_result[0]->prod_attr_id;
				$attribute_array['attr_name'] = $attr_result[0]->attribute;
				$attribute_array['item'] = $attribute;
			}
			$attribute_full_array[] = $attribute_array;
		}
		return $attribute_full_array;
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
