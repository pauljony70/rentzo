<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkout_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('email_model');
		$this->date_time = date('Y-m-d H:i:s');
		$this->date = date('Y-m-d');
	}



	function get_checkout_full_details($language, $user_id, $quote_id, $shipping_city = '', $coupon_code = '')
	{
		$delivery_array = array();
		if ($shipping_city) {
			$delivery_array = $this->delivery_model->get_delivery_city_details_request($shipping_city);
		}
		/*$this->db->select("prod_id, attr_sku, vendor_id, qty,qoute_id");*/
		if ($coupon_code != '') {
			$validate_coupon = $this->Validate_coupon_code($user_id, $coupon_code, '');
		}


		$this->db->select("prod_id, attr_sku, vendor_id, qty");

		if ($user_id) {
			$this->db->where(array('user_id' => $user_id));
		} else if ($quote_id) {
			$this->db->where(array('qoute_id' => $quote_id));
		}
		$coupon_discount = 0;
		$tax_amount = 0;
		$query = $this->db->get('cartdetails');

		$product_detail_array = array();
		$total_mrp = $total_discount = $total_price = $total_item = 0;
		$total_shipping_fee = 0;
		if ($query->num_rows() > 0) {
			$cart_result = $query->result_object();
			foreach ($cart_result as $cart_detail) {
				$prod_id = $cart_detail->prod_id;
				$sku = $cart_detail->attr_sku;
				$vendor_id = $cart_detail->vendor_id;
				$qty = $cart_detail->qty;

				//check product details
				$this->db->select("product_sku, prod_name, prod_name_ar,featured_img,web_url,is_heavy,sellerlogin.companyname as seller, vp.product_mrp, vp.product_sale_price, vp.product_stock, vp.product_purchase_limit, vp.id as vendor_prod_id,vp.coupon_code,vp.seller_price,vp.product_tax_class");
				//join for get vendor product
				$this->db->join('vendor_product vp', 'vp.product_id = product_details.product_unique_id', 'INNER');
				$this->db->join('sellerlogin', 'sellerlogin.seller_unique_id = vp.vendor_id', 'INNER');

				$this->db->where(array('product_details.status' => 1, 'vp.enable_status' => 1, 'sellerlogin.status' => 1, 'product_unique_id' => $prod_id, 'vendor_id' => $vendor_id));

				$query_prod = $this->db->get('product_details');

				$product_detail = array();
				$product_detail['mrp1'] = 0;
				$product_detail['price1'] = 0;
				$product_detail['qty'] = 0;
				if ($query_prod->num_rows() > 0) {
					$prod_result = $query_prod->result_object();

					$product_detail['prodid'] = $prod_id;
					$product_detail['qty'] = $qty;
					$product_detail['mrp'] = price_format(0);
					$product_detail['price'] = price_format(0);
					$product_detail['totaloff'] = price_format(0);
					$product_detail['offpercent'] = 0;
					$product_detail['shipping_fee'] = '';
					$product_detail['coupon_code_vendor'] = $prod_result[0]->coupon_code;
					$product_detail['seller_price'] = $prod_result[0]->seller_price;


					$ger_vendor_coupon_name = '';
					if ($prod_result[0]->coupon_code != '') {
						$this->db->where(array('sno' => $prod_result[0]->coupon_code, 'activate' => 'active'));
						$query_coupon = $this->db->get('coupancode_vendor');
						$status = '';
						if ($query_coupon->num_rows() > 0) {
							$coupon_result = $query_coupon->result_object()[0];
							$ger_vendor_coupon_name = $coupon_result->name;
						}
					}


					$tax_details = $this->get_tax_data($prod_result[0]->product_tax_class);

					$product_detail['coupon_tax'] =  $tax_details['percent'];


					$net_tax_amount = ($prod_result[0]->product_sale_price * 100) / ($product_detail['coupon_tax'] + 100);
					$tax_amount += round($net_tax_amount * $product_detail['coupon_tax'] / 100, 2);


					/*$tax_amount += ($product_detail['seller_price'] / 100) * $product_detail['coupon_tax'];*/

					if ($prod_result[0]->product_sku == $sku) {
						//check vendor product details

						$tot_mrp = ($prod_result[0]->product_mrp * $qty);
						$tot_price = ($prod_result[0]->product_sale_price * $qty);

						$product_detail['mrp'] = price_format($tot_mrp);
						$product_detail['price'] = price_format($tot_price);

						$product_detail['mrp1'] = $tot_mrp;
						$product_detail['price1'] = $tot_price;

						$discount_price = 0;
						if ($tot_price > 0) {
							$discount_price = ($tot_mrp - $tot_price);

							$discount_per = ($discount_price / $tot_mrp) * 100;
						}
						$product_detail['totaloff'] = price_format($discount_price);
						$product_detail['offpercent'] = round($discount_per) . '% off';
					} else {
						$vendor_prod_id = $prod_result[0]->vendor_prod_id;

						$this->db->select("prod_attr_value, price, mrp, stock");
						$this->db->where(array('product_id' => $prod_id, 'vendor_prod_id' => $vendor_prod_id, 'product_sku' => $sku));

						$query_prod_attr = $this->db->get('product_attribute_value');

						if ($query_prod_attr->num_rows() > 0) {
							$prod_attr_result = $query_prod_attr->result_object();

							$tot_mrp1 = ($prod_attr_result[0]->mrp * $qty);
							$tot_price1 = ($prod_attr_result[0]->price * $qty);

							$product_detail['mrp'] = price_format($tot_mrp1);
							$product_detail['price'] = price_format($tot_price1);

							$product_detail['mrp1'] = $tot_mrp1;
							$product_detail['price1'] = $tot_price1;

							$discount_price = 0;
							if ($tot_price1 > 0) {
								$discount_price = ($tot_mrp1 - $tot_price1);

								$discount_per = ($discount_price / $tot_mrp1) * 100;
							}
							$product_detail['totaloff'] = price_format($discount_price);
							$product_detail['offpercent'] = round($discount_per) . '% off';
						}
					}
					$is_heavy = $prod_result[0]->is_heavy;
					$shipping_fee1 = 0;
					if ($delivery_array) {
						$total_price_value = preg_replace('/\D/', "", $product_detail['price'], -1);
						if ($is_heavy == 1 &&  $total_price_value < $delivery_array['order_value']) {
							$shipping_fee1 = $delivery_array['big_item_fee'];
							$product_detail['shipping_fee'] = price_format($delivery_array['big_item_fee']);
						} else if ($is_heavy == 0) {
							$shipping_fee1 = $delivery_array['basic_fee'];
							$product_detail['shipping_fee'] = price_format($delivery_array['basic_fee']);
						}
					}
				}


				$total_mrp += $product_detail['mrp1'];

				$total_price += $product_detail['price1'];
				$total_item += $product_detail['qty'];
				$total_shipping_fee += $shipping_fee1;

				if ($validate_coupon != 'invalid') {

					$this->db->where(array('name' => $coupon_code, 'activate' => 'active'));
					$query_coupon = $this->db->get('coupancode');

					$this->db->where(array('name' => $coupon_code, 'activate' => 'active'));
					$query_coupon_vendor = $this->db->get('coupancode_vendor');

					$status = '';
					if ($query_coupon->num_rows() > 0) {
						$coupon_result = $query_coupon->result_object()[0];
						$product_detail['coupon_type'] = $coupon_result->coupon_type;
						$product_detail['user_apply'] = $coupon_result->user_apply;
						$product_detail['coupon_value'] = $coupon_result->value;
						$product_detail['cap_value'] = $coupon_result->cap_value;
						if ($product_detail['coupon_type'] == 1) {
							$coupon_discount0 =  ($product_detail['price1'] / 100) * $coupon_result->value;
						} else if ($coupon_type == 2) {
							$coupon_discount0 =  $product_detail['price1'] - $coupon_result->value;
						}
						$payable_amount = ($product_detail['price1'] - $coupon_result->value);
						$product_detail['coupon_discount_text'] = price_format($coupon_result->value);
						$product_detail['coupon_discount'] = $coupon_result->value;
						$product_detail['payable_amount'] = price_format($payable_amount);
						$product_detail['payable_amount_value'] = $payable_amount;
						$product_detail['total_price_value'] = $payable_amount;
						$product_detail['price1'] = $product_detail['payable_amount'];
						$coupon_discount += $coupon_discount0;
					} else if ($query_coupon_vendor->num_rows() > 0 && $coupon_code == $ger_vendor_coupon_name) {
						$coupon_result = $query_coupon_vendor->result_object()[0];
						$product_detail['coupon_type'] = $coupon_result->coupon_type;
						$product_detail['user_apply'] = $coupon_result->user_apply;
						$product_detail['coupon_value'] = $coupon_result->value;
						$product_detail['cap_value'] = $coupon_result->cap_value;
						if ($product_detail['coupon_type'] == 1) {
							$coupon_discount0 =  ($product_detail['price1'] / 100) * $coupon_result->value;
						} else if ($product_detail['coupon_type'] == 2) {
							$coupon_discount0 =  $product_detail['price1'] - $product_detail['coupon_value'];
						}
						if ($coupon_discount0 >= $product_detail['cap_value']) {
							$coupon_discount0 = $product_detail['cap_value'];
						}
						$payable_amount = ($product_detail['price1'] - $coupon_result->value);
						$product_detail['coupon_discount_text'] = price_format($coupon_result->value);
						$product_detail['coupon_discount'] = $coupon_result->value;
						$product_detail['payable_amount'] = price_format($payable_amount);
						$product_detail['payable_amount_value'] = $payable_amount;
						$product_detail['total_price_value'] = $payable_amount;
						$product_detail['price1'] = $product_detail['payable_amount'];
						$coupon_discount += $coupon_discount0;
					} else {
						$product_detail['coupon_type'] = "";
						$product_detail['user_apply'] = "";
						$product_detail['coupon_value'] = "";
						$product_detail['cap_value'] = "";
						$product_detail['coupon_discount_text'] = "";
						$product_detail['coupon_discount'] = "";
						$product_detail['payable_amount'] = "";
						$product_detail['payable_amount_value'] = "";
						$product_detail['total_price_value'] = "";
					}
				}



				unset($product_detail['mrp1']);
				unset($product_detail['price1']);
				$product_detail_array[] = $product_detail;
			}
		}

		$address = array();
		$user_address = array("address_id" => '', "fullname" => '', "mobile" => '', "locality" => '', "fulladdress" => '', "city" => '', "state" => '', "pincode" => '', "email" => '', "addresstype" => '');

		if ($user_id) {
			$this->db->select("user_id, addressarray, defaultaddress");
			$this->db->where(array('user_id' => $user_id));

			$query = $this->db->get('address');

			if ($query->num_rows() > 0) {
				$address_result = $query->result_object();

				$addressarray = $address_result[0]->addressarray;
				$defaultaddress = $address_result[0]->defaultaddress;

				$address_arr = json_decode($addressarray, true);
				//print_r($address_arr);

				foreach ($address_arr as $address) {
					if ($address['address_id'] == $defaultaddress) {
						$user_address = $address;
					}
				}
			}
		}

		/*$tax_payable = 0;*/
		$shipping_fee = $total_shipping_fee;
		//$coupon_code = '';
		//$coupon_discount = 0;

		if ($total_item > 0) {
			return array(
				'user_address' => $user_address, 'Products' => $product_detail_array, 'total_mrp' => price_format($total_mrp), 'total_discount' => price_format($total_mrp - $total_price), 'total_price' => price_format($total_price),
				'total_item' => $total_item, 'tax_payable' => number_format($tax_amount), 'coupon_code' => $coupon_code, 'coupon_discount' => number_format($coupon_discount), 'shipping_fee' => price_format($shipping_fee), 'payable_amount' => price_format($total_price + $shipping_fee - $coupon_discount), 'payable_amount_value' => number_format($total_price + $shipping_fee - $coupon_discount, 2, '.', ''), 'total_price_value' => number_format($total_price + $shipping_fee - $coupon_discount, 2, '.', '')
			);
		} else {
			return false;
		}
	}


	function get_tax_data($id)
	{
		$tax_details = array('percent' => '');
		$this->db->select("percent");
		$this->db->where(array('tax_id' => $id, 'status' => '1'));


		$query = $this->db->get('tax');
		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			$tax_details['percent'] = html_entity_decode($category_result[0]->percent);
		}
		return $tax_details;
	}

	//function for place order

	function place_order_details($user_id, $qouteid, $fullname, $mobile, $area, $fulladdress, $country, $region, $governorates, $lat, $lng, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $coupon_value,$city,$state,$pincode)
	{
		$status = array('status' => '');
		$delivery_array = $order = array();
		$this->load->model('cart_model');

		$order_id = '';

		$devicetype = 1;
		$this->db->select("prod_id, attr_sku, vendor_id, qty, affiliated_by, qoute_id");

		if ($user_id) {
			$this->db->where(array('user_id' => $user_id));
		} else {
			$this->db->where(array('qoute_id' => $qouteid));
		}
		$query = $this->db->get('cartdetails');

		$product_detail_array = array();
		$total_mrp = $total_discount = $total_price = $total_item = $qoute_id = 0;

		if ($query->num_rows() > 0) {
			$order_id = strtoupper('ODR' . $this->random_strings(6) . date("hi") . rand(1, 99));
			
			$add_order = $this->create_order($order_id, $user_id, $qouteid, $fullname, $mobile, $area, $fulladdress,  $country, $region, $governorates, $lat, $lng, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $coupon_value,$city,$state,$pincode);

			if ($add_order != 'add') {
				return false;
			}
			$cart_result = $query->result_object();

			foreach ($cart_result as $cart_detail) {
				$prod_id = $cart_detail->prod_id;
				$sku = $cart_detail->attr_sku;
				$vendor_id = $cart_detail->vendor_id;
				$qty = $cart_detail->qty;
				$affiliated_by = $cart_detail->affiliated_by;
				$qoute_id = $cart_detail->qoute_id;

				//check product details
				$this->db->select("product_sku, prod_name, prod_name_ar,featured_img,web_url,is_heavy,return_policy_id, vp.product_mrp, vp.product_sale_price, vp.affiliate_commission, vp.product_stock, vp.product_purchase_limit, vp.id as vendor_prod_id, prp.policy_validity,prp.policy_type_refund,prp.policy_type_replace,prp.policy_type_exchange,sellerlogin.pincode as seller_pincode,sellerlogin.phone as seller_phone,shipping,vp.coupon_code,vp.seller_price,vp.product_tax_class,product_hsn_code,product_unique_code");

				//join for get product return policy
				$this->db->join('product_return_policy prp', 'prp.id = product_details.return_policy_id', 'LEFT');

				//join for get vendor product
				$this->db->join('vendor_product vp', 'vp.product_id = product_details.product_unique_id', 'INNER');
				$this->db->join('sellerlogin', 'sellerlogin.seller_unique_id = vp.vendor_id', 'INNER');

				$this->db->where(array('product_unique_id' => $prod_id, 'vendor_id' => $vendor_id));

				$query_prod = $this->db->get('product_details');

				$product_detail = array();
				$product_detail['qty'] = 0;
				$product_detail['mrp'] = 0;
				$product_detail['price'] = 0;
				$product_detail['price1'] = 0;
				$product_detail['totaloff'] = 0;
				$product_detail['totaloff1'] = 0;
				if ($query_prod->num_rows() > 0) {
					$prod_result = $query_prod->result_object();
					$is_heavy = $prod_result[0]->is_heavy;

					$product_detail['prodid'] = $prod_id;
					$product_detail['sku'] = $prod_result[0]->product_sku;
					$product_detail['vendor_id'] = $vendor_id;
					$product_detail['name'] = $prod_result[0]->prod_name;
					$product_detail['name_ar'] = $prod_result[0]->prod_name_ar;
					$product_detail['web_url'] = $prod_result[0]->web_url;
					$product_detail['seller_pincode'] = $prod_result[0]->seller_pincode;
					$product_detail['shipping'] = $prod_result[0]->shipping;
					$product_detail['seller_phone'] = $prod_result[0]->seller_phone;
					$product_detail['coupon_code'] = $prod_result[0]->coupon_code;
					$product_detail['seller_price'] = $prod_result[0]->seller_price;
					$product_detail['product_hsn_code'] = $prod_result[0]->product_hsn_code;
					$product_detail['product_unique_code'] = $prod_result[0]->product_unique_code;

					$tax_details = $this->get_tax_data($prod_result[0]->product_tax_class);

					$product_detail['coupon_tax'] =  $tax_details['percent'];

					$ger_vendor_coupon_name = '';
					if ($prod_result[0]->coupon_code != '') {
						$this->db->where(array('sno' => $prod_result[0]->coupon_code, 'activate' => 'active'));
						$query_coupon0 = $this->db->get('coupancode_vendor');
						if ($query_coupon0->num_rows() > 0) {
							$coupon_result = $query_coupon0->result_object()[0];
							$ger_vendor_coupon_name = $coupon_result->name;
						}
					}

					$product_detail['qty'] = $qty;
					$product_detail['configure_attr'] = array();
					$product_detail['mrp'] = 0;
					$product_detail['price'] = 0;
					$product_detail['totaloff'] = 0;

					$img_decode = json_decode($prod_result[0]->featured_img);
					$img = '';

					if ($devicetype == 1) {
						if (isset($img_decode->{MOBILE})) {
							$img = $img_decode->{MOBILE};
						} else {
							$img = $prod_result[0]->featured_img;
						}
					} else {
						if (isset($img_decode->{DESKTOP})) {
							$img = $img_decode->{DESKTOP};
						} else {
							$img = $prod_result[0]->featured_img;
						}
					}


					$product_detail['imgurl'] = $img;
					$prod_type = "";
					if ($prod_result[0]->product_sku == $sku) {
						//check vendor product details

						$tot_mrp = $prod_result[0]->product_mrp;
						$tot_price = $prod_result[0]->product_sale_price;

						$product_detail['mrp'] = $tot_mrp;
						$product_detail['price'] = $tot_price;

						$tot_mrp1 = ($prod_result[0]->product_mrp * $qty);
						$tot_price1 = ($prod_result[0]->product_sale_price * $qty);

						$product_detail['mrp1'] = $tot_mrp1;
						$product_detail['price1'] = $tot_price1;

						$discount_price = $discount_price1 = 0;
						if ($tot_price > 0) {
							$discount_price = ($tot_mrp - $tot_price);
							$discount_price1 = ($tot_mrp1 - $tot_price1);
						}
						$product_detail['totaloff'] = $discount_price;
						$product_detail['totaloff1'] = $discount_price1;
						$prod_type = "simple";
					} else {
						$vendor_prod_id = $prod_result[0]->vendor_prod_id;

						$this->db->select("prod_attr_value, price, mrp, stock");
						$this->db->where(array('product_id' => $prod_id, 'vendor_prod_id' => $vendor_prod_id, 'product_sku' => $sku));

						$query_prod_attr = $this->db->get('product_attribute_value');


						if ($query_prod_attr->num_rows() > 0) {
							$prod_attr_result = $query_prod_attr->result_object();

							$tot_mrp1 = $prod_attr_result[0]->mrp;
							$tot_price1 = $prod_attr_result[0]->price;

							$product_detail['mrp'] = $tot_mrp1;
							$product_detail['price'] = $tot_price1;

							$tot_mrp12 = ($prod_attr_result[0]->mrp * $qty);
							$tot_price12 = ($prod_attr_result[0]->price * $qty);

							$product_detail['mrp1'] = $tot_mrp12;
							$product_detail['price1'] = $tot_price12;

							$discount_price = $discount_price1 = 0;
							if ($tot_price1 > 0) {
								$discount_price = ($tot_mrp1 - $tot_price1);
								$discount_price1 = ($tot_mrp12 - $tot_price12);
							}
							$product_detail['totaloff'] = $discount_price;
							$product_detail['totaloff1'] = $discount_price1;
							$product_detail['configure_attr'] = $this->cart_model->get_product_configure_attr(json_decode($prod_attr_result[0]->prod_attr_value), $prod_id, $vendor_id);

							$prod_type = "configure";
						}
					}

					$invoice_number = $this->generate_invoice_number($product_detail['vendor_id']);

					//calculate shipping fee
					$shipping_fee1 = 0;
					$delivery_date = '';

					// if ($pincode != 0 && $pincode != '') {
					// 	$shipping_fee1 = $this->address_model->get_shippinf_details_full($product_detail['seller_pincode'], $pincode, $product_detail['price']);
					// }

					//calculate shipping fee

					//calculate return date
					$policy_validity = $prod_result[0]->policy_validity;
					$policy_type_refund = $prod_result[0]->policy_type_refund;

					$return_last_date = '';
					if ($policy_validity > 0 && $policy_type_refund > 0) {
						$return_last_date =  date('Y-m-d', strtotime('+' . $policy_validity . ' days'));
					}
					//calculate return date
					$coupon_discount = 0;
					$validate_coupon = $this->Validate_coupon_code($user_id, $coupon_code, '');
					if ($validate_coupon != 'invalid') {

						$this->db->where(array('name' => $coupon_code, 'activate' => 'active'));
						$query_coupon_vendor = $this->db->get('coupancode_vendor');

						if ($query_coupon_vendor->num_rows() > 0 && $coupon_code == $ger_vendor_coupon_name) {
							$coupon_result = $query_coupon_vendor->result_object()[0];
							$product_detail['coupon_type'] = $coupon_result->coupon_type;
							if ($product_detail['coupon_type'] == 1) {
								$coupon_discount =  ($product_detail['price'] / 100) * $coupon_result->value;
							} else if ($product_detail['coupon_type'] == 2) {
								$coupon_discount =  $product_detail['price'] - $coupon_result->value;
							}
						} else {
							$coupon_discount = 0;
						}
					}


					$this->db->select("commission");
					$this->db->where("FLOOR(price_from) <= ", $prod_result[0]->seller_price);
					$this->db->where("FLOOR(price_to) >= ", $prod_result[0]->seller_price);



					$query_comm = $this->db->get('seller_commission');
					if ($query_comm->num_rows() > 0) {
						$comm_result = $query_comm->result_object();

						$admin_profit = number_format($comm_result[0]->commission);
					}

					$sgst = 0;
					$cgst = 0;
					$igst = 0;
					$taxable_amount = round(($product_detail['price'] * $product_detail['qty'] * 100) / ($product_detail['coupon_tax'] + 100), 2);
					$tax_value = ($product_detail['price'] * $product_detail['qty']) - $taxable_amount;

					$igst = $tax_value;

					/*$admin_profit = $prod_result[0]->product_sale_price - $prod_result[0]->seller_price;*/

					$tax_class = ($prod_result[0]->product_sale_price / 100) * $product_detail['coupon_tax'];

					$payable_value = $prod_result[0]->product_sale_price - $tax_class;

					$tds = round(($payable_value / 100) * 1, 2);
					$tcs = round(($payable_value / 100) * 1, 2);

					$gross_amount = round($prod_result[0]->seller_price - ($tds +  $tcs), 2);

					$gst_input = round(($admin_profit / 100) * 18, 2);

					$net_amount = round($gross_amount - $gst_input, 2);


					//order summary
					$order_prod = array();

					$order_prod['order_id'] = $order_id;
					$order_prod['prod_id'] = $product_detail['prodid'];
					$order_prod['prod_sku'] = $product_detail['sku'];
					$order_prod['vendor_id'] = $product_detail['vendor_id'];
					$order_prod['prod_name'] = $product_detail['name'];
					$order_prod['prod_name_ar'] = $product_detail['name_ar'];
					$order_prod['prod_img'] = $product_detail['imgurl'];
					$order_prod['prod_attr'] = json_encode($product_detail['configure_attr']);
					$order_prod['qty'] = $product_detail['qty'];
					$order_prod['prod_price'] = $product_detail['price'];
					$order_prod['shipping'] = $product_detail['shipping'];
					$order_prod['discount'] = $product_detail['totaloff'];
					$order_prod['create_date'] = date('Y-m-d H:i:s');
					$order_prod['status'] = 'Placed';
					$order_prod['status_date'] = date('Y-m-d');
					$order_prod['invoice_number'] = $invoice_number;
					$order_prod['delivery_date'] = $delivery_date;
					$order_prod['return_last_date'] = $return_last_date;
					$order_prod['coupon_code'] = $coupon_code;
					$order_prod['coupon_value'] = $coupon_discount;
					$order_prod['seller_price'] = $product_detail['seller_price'];
					$order_prod['admin_profit'] = $admin_profit;
					$order_prod['tds'] = $tds;
					$order_prod['tcs'] = $tcs;
					$order_prod['gross_amount'] = $gross_amount;
					$order_prod['gst_input'] = $gst_input;
					$order_prod['net_amount'] = $net_amount;
					$order_prod['taxable_amount'] = $taxable_amount;
					$order_prod['cgst'] = $cgst;
					$order_prod['sgst'] = $sgst;
					$order_prod['igst'] = $igst;
					$order_prod['product_hsn_code'] = $product_detail['product_hsn_code'];
					$order_prod['product_unique_code'] = $product_detail['product_unique_code'];

					$query = $this->db->insert('order_product', $order_prod);

					if ($query) {
						$this->update_vendor_stock($product_detail['prodid'], $product_detail['vendor_id'], $sku, $prod_type, $qty);
						//$this->update_vendor_payment($product_detail['prodid'],$product_detail['vendor_id'],$qty,$product_detail['price'],$shipping);
						if ($affiliated_by) {
							$wallet_data = $this->db->get_where('wallet_summery', array('user_id' => $affiliated_by))->row_array();
							if (!empty($wallet_data)) {
								$commission = $prod_result[0]->product_sale_price * $qty * ($prod_result[0]->affiliate_commission / 100);
								$insert_wallet_transaction_history = $this->db->insert('wallet_transaction_history', array(
									'wallet_id' => $wallet_data['wallet_id'],
									'payment_type' => '0',
									'transaction_id' => generateTransactionID(),
									'transaction_type' => 'cr',
									'amount' => $commission,
									'balance' => $wallet_data['amount'] + $commission,
									'product_id' => $product_detail['prodid'],
									'order_id' => $order_id,
									'user_id' => $user_id,
								));
								if ($insert_wallet_transaction_history) {
									$this->db->where('user_id', $affiliated_by);
									$this->db->update('wallet_summery', array(
										'amount' => $wallet_data['amount'] + $commission
									));
								}
							}
						}
					}
				}



				$total_price += $product_detail['price1'];
				$total_item += $product_detail['qty'];
				$total_discount += $product_detail['totaloff1'];
				$seller_phone = $product_detail['seller_phone'];
			}


			$this->db->where(array('name' => $coupon_code, 'activate' => 'active'));
			$query_coupon0 = $this->db->get('coupancode');
			if ($query_coupon0->num_rows() > 0) {

				$this->db->select("*");
				$this->db->where(array('name' => $coupon_code, 'activate' => 'active'));

				$query_coupon = $this->db->get('coupancode');
				$coupon_discount = 0;
				if ($query_coupon->num_rows() > 0) {
					$coupon_result = $query_coupon->result_object()[0];

					$coupon_type = $coupon_result->coupon_type;
					$value = $coupon_result->value;

					if ($coupon_type == 1) {
						$coupon_discount =  ($total_price / 100) * $value;
					} else if ($coupon_type == 2) {
						$coupon_discount =  $value;
					}
				}
			}

			$order['total_price'] = $total_price;
			$order['discount'] = $total_discount;
			$order['total_qty'] = $total_item;
			/*$order['coupon_value'] = $coupon_discount;*/

			$this->db->where(array('order_id' => $order_id));
			$queryup = $this->db->update('orders', $order);

			$status['order_detail'] = $order;
			$status['order_id'] = $order_id;

			if ($queryup) {
				$status['status'] = 'update';
			}
		}

		// $message = 'Dear customer your Order has been Placed Successfully. Order Id is ' . $order_id . ' and Total price is Rs.' . $total_price . '. Thank You For Shopping with EBuy. EBUY';
		// $this->sms_model->send_sms_new($message, '968', $mobile);

		// $message_seller = 'Dear Ebuy seller, you have Received a New Order . Please login into seller dashboard to see details. Order Id is ' . $order_id . ' – Regards, Marurang. MRURNG';
		// $this->sms_model->send_sms_new($message_seller, '968', $seller_phone);

		return $status;
	}

	function generate_invoice_number($vendor_id)
	{
		$this->db->select("fullname, invoice_number");

		$this->db->where(array('seller_unique_id' => $vendor_id));

		$query = $this->db->get('sellerlogin');
		$seller_result = $query->result_object();

		$seller_name = $seller_result[0]->fullname;
		$invoice_number = $seller_result[0]->invoice_number;
		$next_inv = ($invoice_number + 1);

		$seller_inv = strtoupper(substr($seller_name, 0, 2));

		$current_year = date('y');
		$current_month = 4; // date('m');

		$pre_year = ($current_year - 1);
		$next_year = ($current_year + 1);

		if ($current_month <= 3) {
			$seller_inv .= '-' . $pre_year . $current_year . '-000' . $next_inv;
		} else if ($current_month > 3 && $current_month  <= 12) {
			$seller_inv .= '-' . $current_year . $next_year . '-000' . $next_inv;
		}

		$this->db->where(array('seller_unique_id' => $vendor_id));
		$queryup = $this->db->update('sellerlogin', array('invoice_number' => $next_inv));

		return $seller_inv;
	}

	function create_order($order_id, $user_id, $qouteid, $fullname, $mobile, $area, $fulladdress, $country, $region, $governorates, $lat, $lng, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $coupon_value,$city,$state,$pincode)
	{
		$status = '';
		$order = array();

		$order['order_id'] = $order_id;
		$order['user_id'] = $user_id;
		$order['total_price'] = '';
		$order['payment_orderid'] = '';
		$order['payment_id'] = $payment_id;
		$order['payment_mode'] = $payment_mode;
		$order['qoute_id'] = $qouteid;
		$order['create_date'] = date('Y-m-d H:i:s');
		$order['discount'] = '';
		$order['fullname'] = $fullname;
		$order['mobile'] = $mobile;
		$order['area'] = $area;
		$order['fulladdress'] = $fulladdress;
		$order['country'] = $country;
		$order['region'] = $region;
		$order['governorate'] = $governorates;
		$order['lat'] = $lat;
		$order['lng'] = $lng;
		$order['addresstype'] = $addresstype;
		$order['email'] = $email;
		$order['status'] = 'Placed';
		$order['coupon_code'] = $coupon_code;
		$order['coupon_value'] = $coupon_value;
		$order['city'] = $city;
		$order['state'] = $state;
		$order['pincode'] = $pincode;

		$query = $this->db->insert('orders', $order);
		if ($query) {
			$status = 'add';
		}
		return $status;
	}

	//delete cart items

	function empty_cart($user_id, $quote_id)
	{
		if ($user_id) {
			$this->db->where(array('user_id' => $user_id));
		} else if ($quote_id) {
			$this->db->where(array('qoute_id' => $quote_id));
		}

		$query = $this->db->delete('cartdetails');
	}


	//update stock
	function update_vendor_stock($prodid, $vendor_id, $sku, $prod_type, $qty)
	{
		if ($prod_type == 'simple') {

			//check product stock
			$this->db->select("product_stock");

			$this->db->where(array('product_id' => $prodid, 'vendor_id' => $vendor_id));

			$query_prod = $this->db->get('vendor_product');

			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();

				$total_stock = $prod_result[0]->product_stock;
				$remain_stock = ($total_stock - $qty);

				if ($remain_stock > 0) {
					$stock_status = 'In Stock';
				} else {
					$stock_status = 'Out of Stock';
				}
				$stock = array();
				$stock['product_stock'] = $remain_stock;
				$stock['stock_status'] = $stock_status;

				$this->db->where(array('product_id' => $prodid, 'vendor_id' => $vendor_id));
				$queryup = $this->db->update('vendor_product', $stock);
			}
		} else if ($prod_type == 'configure') {
			//check product stock
			$this->db->select("pav.stock, vp.id");

			$this->db->join('vendor_product vp', 'vp.id = pav.vendor_prod_id', 'INNER');

			$this->db->where(array('vp.product_id' => $prodid, 'vp.vendor_id' => $vendor_id, 'pav.product_sku' => $sku));

			$query_prod = $this->db->get('product_attribute_value pav');

			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();

				$vendor_prod_id = $prod_result[0]->id;

				$total_stock = $prod_result[0]->stock;

				$remain_stock = ($total_stock - $qty);

				$stock = array();
				$stock['stock'] = $remain_stock;

				$this->db->where(array('product_id' => $prodid, 'vendor_prod_id' => $vendor_prod_id));
				$queryup = $this->db->update('product_attribute_value', $stock);
			}
		}
	}


	function update_vendor_payment($prodid, $vendor_id, $qty, $price, $shipping)
	{
	}
	///check copuon code

	function Validate_coupon_code($user_id, $coupon_code, $type = '')
	{

		$this->db->select("*");
		$date = date('Y-m-d');
		$this->db->where(array('name' => $coupon_code, 'activate' => 'active'));

		$query_coupon = $this->db->get('coupancode');
		$this->db->where(array('name' => $coupon_code, 'activate' => 'active'));
		$query_coupon_vendor = $this->db->get('coupancode_vendor');
		$status = '';
		if ($query_coupon->num_rows() > 0) {
			$coupon_result = $query_coupon->result_object()[0];

			$user_apply = $coupon_result->user_apply;

			if ($type != 'product') {
				if ($user_id) {
					$this->db->select("user_id");
					$this->db->where(array('user_id' => $user_id));

					$query_order = $this->db->get('orders');
					$total_applied = $query_order->num_rows();

					if ($total_applied > $user_apply) {
						return 'applied_exced';
					}
				} else {
					return $status = 'login_required';
				}
			}

			$fromdate = $coupon_result->fromdate;
			$todate = $coupon_result->todate;
			if ($fromdate != '0000-00-00' && $todate != '0000-00-00') {
				if ($date >= $fromdate && $date <= $todate) {
					return $coupon_result;
				} else {
					$status = 'expired';
				}
			} else {
				$status = 'invalid';
			}
		} else if ($query_coupon_vendor->num_rows() > 0) {
			$coupon_result = $query_coupon_vendor->result_object()[0];
			$user_apply = $coupon_result->user_apply;
			if ($type != 'product') {
				if ($user_id) {
					$this->db->select("user_id");
					$this->db->where(array('user_id' => $user_id));
					$query_order = $this->db->get('orders');
					$total_applied = $query_order->num_rows();
					if ($total_applied > $user_apply) {
						return 'applied_exced';
					}
				} else {
					return $status = 'login_required';
				}
			}
			$fromdate = $coupon_result->fromdate;
			$todate = $coupon_result->todate;
			if ($fromdate != '0000-00-00' && $todate != '0000-00-00') {
				if ($date >= $fromdate && $date <= $todate) {
					return $coupon_result;
				} else {
					$status = 'expired';
				}
			} else {
				$status = 'invalid';
			}
		} else {
			$status = 'invalid';
		}
		return $status;
	}

	function Validate_coupon_code_old($user_id, $coupon_code, $type = '')
	{

		$this->db->select("*");
		$date = date('Y-m-d');
		$this->db->where(array('name' => $coupon_code, 'activate' => 'active'));

		$query_coupon = $this->db->get('coupancode');
		$this->db->where(array('name' => $coupon_code, 'activate' => 'active'));
		$query_coupon_vendor = $this->db->get('coupancode_vendor');
		$status = '';
		if ($query_coupon->num_rows() > 0) {
			$coupon_result = $query_coupon->result_object()[0];

			$user_apply = $coupon_result->user_apply;

			if ($type != 'product') {
				if ($user_id) {
					$this->db->select("user_id");
					$this->db->where(array('user_id' => $user_id));

					$query_order = $this->db->get('orders');
					$total_applied = $query_order->num_rows();

					if ($total_applied > $user_apply) {
						return 'applied_exced';
					}
				} else {
					return $status = 'login_required';
				}
			}

			$fromdate = $coupon_result->fromdate;
			$todate = $coupon_result->todate;
			if ($fromdate != '0000-00-00' && $todate != '0000-00-00') {
				if ($date >= $fromdate && $date <= $todate) {
					return $coupon_result;
				} else {
					$status = 'expired';
				}
			} else {
				$status = 'invalid';
			}
		} else if ($query_coupon_vendor->num_rows() > 0) {
			$coupon_result = $query_coupon_vendor->result_object()[0];
			$user_apply = $coupon_result->user_apply;
			if ($type != 'product') {
				if ($user_id) {
					$this->db->select("user_id");
					$this->db->where(array('user_id' => $user_id));
					$query_order = $this->db->get('orders');
					$total_applied = $query_order->num_rows();
					if ($total_applied > $user_apply) {
						return 'applied_exced';
					}
				} else {
					return $status = 'login_required';
				}
			}
			$fromdate = $coupon_result->fromdate;
			$todate = $coupon_result->todate;
			if ($fromdate != '0000-00-00' && $todate != '0000-00-00') {
				if ($date >= $fromdate && $date <= $todate) {
					return $coupon_result;
				} else {
					$status = 'expired';
				}
			} else {
				$status = 'invalid';
			}
		} else {
			$status = 'invalid';
		}
		return $status;
	}

	//update order status
	function update_order_by_delivery_boy($user_id, $order_id, $prod_id, $status, $otp)
	{
		if ($status == 'Delivered') {
			$this->update_order_status($user_id, $order_id, $prod_id, $status, '');
			$this->update_order_tracking_status($user_id, $order_id, $prod_id, $status);
			$this->email_model->send_order_email($order_id, DELIVERED_TEMP, $prod_id);
			return  array('order_id' => $order_id, 'otp' => '');
		} else if ($status == 'Out for Delivery') {
			$otp = ''; //$this->sms_model->generateNumericOTP(6);

			$this->update_order_status($user_id, $order_id, $prod_id, $status, $otp);
			$this->update_order_tracking_status($user_id, $order_id, $prod_id, $status);


			//query for get order _details
			$this->db->select("mobile");
			$this->db->where(array('order_id' => $order_id));

			$query_order_prod = $this->db->get('orders');

			if ($query_order_prod->num_rows() > 0) {
				$order_prod_result = $query_order_prod->result_object();
				$mobile_number = $order_prod_result[0]->mobile;

				//$sms_sent = $this->sms_model->send_sms($message, $mobile_number);
			}
			//$this->email_model->send_order_email($order_id ,DELIVERED_TEMP, $prod_id);
			return  array('order_id' => $order_id, 'otp' => $otp);
		} else if ($status == 'Reschedule') {
			$this->update_order_status($user_id, $order_id, $prod_id, $status, '');
			$this->update_order_tracking_status($user_id, $order_id, $prod_id, $status);
			return  array('order_id' => $order_id, 'otp' => '');
		} else if ($status == 'Undelivered') {
			$this->update_order_status($user_id, $order_id, $prod_id, $status, '');
			$this->update_order_tracking_status($user_id, $order_id, $prod_id, $status);
			return  array('order_id' => $order_id, 'otp' => '');
		} else if ($status == 'Return Received' || $status == 'Return Cancelled' || $status == 'Return Reschedule') {
			$this->update_order_status($user_id, $order_id, $prod_id, $status, '');
			$this->update_order_tracking_status($user_id, $order_id, $prod_id, $status);
			return  array('order_id' => $order_id, 'otp' => '');
		}
	}

	function update_order_status($user_id, $order_id, $prod_id, $status, $otp = '')
	{
		$order = array();
		$order['status'] = $status;
		if ($status == 'Delivered') {
			$order['delivery_date'] = $this->date;
		}
		$order['update_date'] = $this->date_time;
		$order['status_date'] = $this->date_time;
		$order['otp'] = $otp;

		$this->db->where(array('order_id' => $order_id, 'prod_id' => $prod_id));
		$queryup = $this->db->update('order_product', $order);
	}

	function update_order_tracking_status($user_id, $order_id, $prod_id, $status)
	{
		$order = array();
		$order['status'] = $status;
		$order['updated_at'] = $this->date_time;

		$this->db->where(array('order_id' => $order_id, 'product_id' => $prod_id));
		$this->db->update('delivery_boy_orders', $order);


		///insert tracking table

		$track = array();
		$track['status'] = $status;
		$track['created_at'] = $this->date_time;
		$track['order_id'] = $order_id;
		$track['product_id'] = $prod_id;
		$track['message'] = '';

		$this->db->insert('order_tracking_status', $track);
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

	// string of specified length 
	function random_strings($length_of_string)
	{

		// String of all alphanumeric character 
		$str_result = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz';

		// Shufle the $str_result and returns substring 
		// of specified length 
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}

	function submitBuyFromAnotherCountryShoppingRequest($user_id, $order_id, $product_link, $product_quantity, $product_size, $product_color, $product_des, $product_img_1, $product_img_2, $country, $status)
	{
		$request = [
			'user_id' 			=> $user_id,
			'order_id'			=> $order_id,
			'product_link' 		=> $product_link,
			'product_quantity' 	=> $product_quantity,
			'product_size' 		=> $product_size,
			'product_color' 	=> $product_color,
			'product_des'		=> $product_des,
			'product_img_1' 	=> $product_img_1,
			'product_img_2' 	=> $product_img_2,
			'country' 			=> $country,
			'status' 			=> $status,
		];

		if ($this->db->insert('buy_from_another_country_requests', $request)) {
			$insert_id = $this->db->insert_id();
			$this->email_model->send_other_country_order_update_to_user($user_id, $order_id, ORDER_UPDATE_TEMP, $product_link, $product_quantity, $product_size, $product_color, $product_img_1, $status);
			$this->email_model->send_other_country_order_update_to_admin($user_id, $order_id, ORDER_RECEIVED_NOTIFICATION_TEMP, $product_link, $product_quantity, $product_size, $product_color, $product_img_1, $status);
			return $insert_id;
		} else {
			return false;
		}
	}
}
