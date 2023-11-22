<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkout_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('email_model');
		$this->load->model('delivery_model');
		$this->load->model('sms_model');
		$this->load->model('address_model');
		$this->date_time = date('Y-m-d H:i:s');
		$this->date = date('Y-m-d');
	}



	function get_checkout_full_details($user_id, $coupon_code = '')
	{

		$validate_coupon = $this->Validate_coupon_code($user_id, $coupon_code, '');
		if ($coupon_code  != '') {
			if ($validate_coupon == 'invalid') {
				return $validate_coupon;
			}
		}
		

		$shiping_detail = 0;
		$shipping_fee1 = 0;
		// get delivery details
		$delivery_array = array();

		$this->db->select("prod_id, attr_sku, vendor_id, qty,rent_price,rent_from_date,cart_type");

		$this->db->where(array('user_id' => $user_id));

		$coupon_discount = 0;
		$query = $this->db->get('cartdetails');

		$product_detail_array = array();
		$total_mrp = $total_discount = $total_price = $total_item = $total_tax = 0;
		$total_shipping_fee = 0;
		$seller_pincode = 0;
		$imgurl = 0;
		if ($query->num_rows() > 0) {
			$cart_result = $query->result_object();
			foreach ($cart_result as $cart_detail) {
				$prod_id = $cart_detail->prod_id;
				$sku = $cart_detail->attr_sku;
				$vendor_id = $cart_detail->vendor_id;
				$qty = $cart_detail->qty;
				$rent_price = $cart_detail->rent_price;
				$rent_from_date = $cart_detail->rent_from_date;
				$rent_to_date = $cart_detail->rent_to_date;
				$cart_type = $cart_detail->cart_type;

				//check product details
				$this->db->select("product_sku, prod_name,featured_img,web_url,is_heavy,sellerlogin.companyname as seller,sellerlogin.pincode as seller_pincode, vp.product_mrp, vp.product_sale_price, vp.product_stock, vp.product_purchase_limit, vp.id as vendor_prod_id,shipping,featured_img,vp.coupon_code,vp.product_tax_class,security_deposit");
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
					$product_detail['shipping_fee'] = $prod_result[0]->shipping;;
					$product_detail['seller_pincode'] = $prod_result[0]->seller_pincode;
					$product_detail['coupon_code_vendor'] = $prod_result[0]->coupon_code;
					$product_detail['security_deposit'] = $prod_result[0]->security_deposit;

					$tax_details = $this->get_tax_data($prod_result[0]->product_tax_class);
					$product_detail['product_tax'] =  $tax_details['percent'];

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

					$img_decode = json_decode($prod_result[0]->featured_img);
					$img = $img_decode->{DESKTOP};
					$product_detail['imgurl'] = $img;

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
					
					if($rent_price != '')
					{
						$product_detail['mrp'] = ($product_detail['security_deposit']+$rent_price);
						$product_detail['mrp1'] = ($product_detail['security_deposit']+$rent_price) * $qty;
						$product_detail['price1'] = ($product_detail['security_deposit']+$rent_price) * $qty;
						$product_detail['price'] = ($product_detail['security_deposit']+$rent_price);
						$product_detail['totaloff'] = '';
					}
					
					
					
				}

				$net_tax_amount = ($product_detail['price1'] * 100) / ($product_detail['product_tax'] + 100);
				$tax_get = round($net_tax_amount * $product_detail['product_tax'] / 100, 2);


				$total_mrp += $product_detail['mrp1'];
				$total_tax += $tax_get;

				$total_price += $product_detail['price1'];
				$total_item += $product_detail['qty'];
				/*$total_shipping_fee += $shipping_fee1;*/
				$seller_pincode = $product_detail['seller_pincode'];
				$imgurl = $product_detail['imgurl'];



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
						} else if ($product_detail['coupon_type'] == 2) {
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

				/*if($shipping_pincode != 0 && $shipping_pincode != ''){
					$shiping_detail = $this->address_model->get_shippinf_details_full($seller_pincode,$shipping_pincode,$total_price);		
				}
				
				$total_shipping_fee += $shiping_detail;*/
				$total_shipping_fee += $product_detail['shipping_fee'];
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

		return array(
			'user_address' => $user_address, 'total_mrp' => price_format($total_mrp), 'total_discount' => price_format($total_mrp - $total_price), 'total_price' => price_format($total_price),
			'total_item' => $total_item, 'tax_payable' => round($total_tax, 0), 'coupon_code' => $coupon_code, 'coupon_discount' => round($coupon_discount, 0), 'shipping_fee' => $shipping_fee, 'payable_amount' => price_format($total_price + $shipping_fee - round($coupon_discount, 0)), 'payable_amount_value' => $total_price + $shipping_fee - round($coupon_discount, 0), 'total_price_value' => $total_price + $shipping_fee - round($coupon_discount, 0), 'seller_pincode' => $seller_pincode, 'imgurl' => $imgurl
		);
	}

	//function for place order

	function place_order_details($user_id, $qouteid, $fullname, $mobile, $area, $fulladdress, $country, $region, $governorates, $lat, $lng, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $coupon_value,$state,$city,$city_id)
	{
		$status = array('status' => '');
		$delivery_array = $order = array();
		$this->load->model('cart_model');

		$order_id = '';

		$devicetype = 1;
		$this->db->select("prod_id, attr_sku, vendor_id, qty, affiliated_by, qoute_id,rent_price,rent_from_date,rent_to_date,cart_type");

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

			$add_order = $this->create_order($order_id, $user_id, $qouteid, $fullname, $mobile, $area, $fulladdress,  $country, $region, $governorates, $lat, $lng, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $coupon_value,$state,$city,$city_id);

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
				$rent_price = $cart_detail->rent_price;
				$rent_from_date = $cart_detail->rent_from_date;
				$rent_to_date = $cart_detail->rent_to_date;
				$cart_type = $cart_detail->cart_type;

				//check product details
				$this->db->select("product_sku, prod_name, prod_name_ar,featured_img,web_url,is_heavy,return_policy_id, vp.product_mrp, vp.product_sale_price, vp.affiliate_commission, vp.product_stock, vp.product_purchase_limit, vp.id as vendor_prod_id, prp.policy_validity,prp.policy_type_refund,prp.policy_type_replace,prp.policy_type_exchange,sellerlogin.pincode as seller_pincode,sellerlogin.phone as seller_phone,shipping,vp.coupon_code,vp.seller_price,vp.product_tax_class,product_hsn_code,product_unique_code,security_deposit");

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
					$product_detail['security_deposit'] = $prod_result[0]->security_deposit;

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
					
					if($rent_price != '')
					{
						$product_detail['mrp'] = ($product_detail['security_deposit']+$rent_price);
						$product_detail['mrp1'] = ($product_detail['security_deposit']+$rent_price) * $qty;
						$product_detail['price1'] = ($product_detail['security_deposit']+$rent_price) * $qty;
						$product_detail['price'] = ($product_detail['security_deposit']+$rent_price);
						$product_detail['totaloff'] = '';
					}

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
					$order_prod['rent_from_date'] = $rent_from_date;
					$order_prod['rent_to_date'] = $rent_to_date;
					$order_prod['type'] = $cart_type;

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

		$message = 'Dear customer your Order has been Placed Successfully. Order Id is ' . $order_id . ' and Total price is Rs.' . $total_price . '. Thank You For Shopping with EBuy. EBUY';
		$this->sms_model->send_sms_new($message, '968', $mobile);

		$message_seller = 'Dear Marurang seller, you have Received a New Order . Please login into seller dashboard to see details. Order Id is ' . $order_id . ' – Regards, Marurang. MRURNG';
		$this->sms_model->send_sms_new($message_seller, '968', $seller_phone);

		return $status;
	}

	function online_place_order_details($user_id, $qouteid, $order_id, $fullname, $mobile, $locality, $fulladdress, $city, $state, $pincode, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $coupon_value, $city_id)
	{
		$status = array('status' => '');
		$delivery_array = $order = array();
		$this->load->model('cart_model');


		if ($city_id) {
			$delivery_array = $this->delivery_model->get_delivery_details_byid($city_id);
		}

		$devicetype = 1;
		$this->db->select("prod_id, attr_sku, vendor_id, qty,qoute_id");

		if ($user_id) {
			$this->db->where(array('user_id' => $user_id));
		} else {
			$this->db->where(array('qoute_id' => $qouteid));
		}
		$query = $this->db->get('cartdetails');

		$product_detail_array = array();
		$total_mrp = $total_discount = $total_price = $total_item = $qoute_id = 0;

		if ($query->num_rows() > 0) {

			if (!empty($user_id)) {
				$address_detail = $this->address_model->get_user_address_details_full($user_id);
				$isNewAddress = true;
				foreach ($address_detail['address_details'] as $address) {
					if (
						$address['fullname'] === $fullname &&
						$address['mobile'] === $mobile &&
						$address['state'] === $state &&
						$address['pincode'] === $pincode &&
						$address['city_id'] === $city_id &&
						$address['email'] === $email &&
						$address['fulladdress'] === $fulladdress
					) {
						$isNewAddress = false;
						break; // Break the loop
					}
				}
				if ($isNewAddress) {
					// The new address is different, add it to the addresses array
					// Perform any additional actions or save the updated addresses array
					$this->address_model->add_user_address($fullname, $mobile, $pincode, $user_id, $locality, $fulladdress, $state, $city, $addresstype, $email, $city_id);
				} else {
					// The new address is not different, handle accordingly
				}
			}

			$add_order = $this->create_order($order_id, $user_id, $qouteid, $fullname, $mobile, $locality, $fulladdress, $city, $state, $pincode, $governorates, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $coupon_value, $city_id);

			if ($add_order != 'add') {
				return false;
			}
			$cart_result = $query->result_object();

			foreach ($cart_result as $cart_detail) {
				$prod_id = $cart_detail->prod_id;
				$sku = $cart_detail->attr_sku;
				$vendor_id = $cart_detail->vendor_id;
				$qty = $cart_detail->qty;
				$qoute_id = $cart_detail->qoute_id;

				//check product details
				$this->db->select("product_sku, prod_name, prod_name_ar,featured_img,web_url,is_heavy,return_policy_id, vp.product_mrp, vp.product_sale_price, vp.product_stock, vp.product_purchase_limit, vp.id as vendor_prod_id,
									prp.policy_validity,prp.policy_type_refund,prp.policy_type_replace,prp.policy_type_exchange,sellerlogin.pincode as seller_pincode,sellerlogin.phone as seller_phone,shipping,vp.coupon_code,vp.seller_price,vp.product_tax_class");

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

					$tax_details = $this->get_tax_data($prod_result[0]->product_tax_class);

					$product_detail['coupon_tax'] =  $tax_details['percent'];

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
					if ($delivery_array) {

						$total_price_value = preg_replace('/\D/', "", $product_detail['price'], -1);
						if ($is_heavy == 1 &&  $total_price_value < $delivery_array->order_value) {
							$shipping_fee1 = $delivery_array->big_item_fee;
						} else if ($is_heavy == 0) {
							$shipping_fee1 = $delivery_array->basic_fee;
						}
						$estimated_delivery_time = $delivery_array->estimated_delivery_time;
						if ($estimated_delivery_time >= 1) {
							$delivery_date = date('Y-m-d', strtotime('+' . $estimated_delivery_time . ' days'));
						} else {
							$delivery_date = date('Y-m-d', strtotime('+1 days'));
						}
					}
					if ($pincode != 0 && $pincode != '') {
						$shipping_fee1 = $this->address_model->get_shippinf_details_full($product_detail['seller_pincode'], $pincode, $product_detail['price']);
					}

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

						$status = '';
						if ($query_coupon_vendor->num_rows() > 0 && $coupon_code == $ger_vendor_coupon_name) {
							$coupon_result = $query_coupon_vendor->result_object()[0];
							if ($product_detail['coupon_type'] == 1) {
								$coupon_discount =  ($product_detail['price'] / 100) * $coupon_result->value;
							} else if ($coupon_type == 2) {
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
					$order_prod['seller_price'] = $seller_price;
					$order_prod['admin_profit'] = $admin_profit;
					$order_prod['tds'] = $tds;
					$order_prod['tcs'] = $tcs;
					$order_prod['gross_amount'] = $gross_amount;
					$order_prod['gst_input'] = $gst_input;
					$order_prod['net_amount'] = $net_amount;

					$query = $this->db->insert('order_product', $order_prod);

					if ($query) {
						$this->update_vendor_stock($product_detail['prodid'], $product_detail['vendor_id'], $sku, $prod_type, $qty);
						//$this->update_vendor_payment($product_detail['prodid'],$product_detail['vendor_id'],$qty,$product_detail['price'],$shipping);
					}
				}



				$total_price += $product_detail['price1'];
				$total_item += $product_detail['qty'];
				$total_discount += $product_detail['totaloff1'];
				$seller_phone = $product_detail['seller_phone'];
			}


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

		$message = 'Dear customer your Order has been Placed Successfully. Order Id is ' . $order_id . ' and Total price is Rs.' . $total_price . '. Thank You For Shopping with Marurang. MRURNG';
		/*$sms_sent = $this->sms_model->send_sms($message, $mobile);*/

		$user = 'marurangecommerce';
		$pass = '79624227';
		$header_name = 'MRURNG';
		$templete_id = '1707167698445161295';
		$ch = curl_init('https://www.txtguru.in/imobile/api.php?');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$user&password=$pass&source=$header_name&dmobile=+91$mobile&dlttempid=$templete_id&&message=$message");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);

		$message_seller = 'Dear Marurang seller, you have Received a New Order . Please login into seller dashboard to see details. Order Id is ' . $order_id . ' – Regards, Marurang. MRURNG';
		$templete_id1 = '1707167698471095760';
		$ch1 = curl_init('https://www.txtguru.in/imobile/api.php?');
		curl_setopt($ch1, CURLOPT_POST, 1);
		curl_setopt($ch1, CURLOPT_POSTFIELDS, "username=$user&password=$pass&source=$header_name&dmobile=+91$seller_phone&dlttempid=$templete_id1&&message=$message_seller");
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
		$data1 = curl_exec($ch1);


		$admin_phone = get_settings('system_phone');
		$message_admin = 'Hello Admin, new order placed by customer. Please login into admin dashboard to see details. Order Id is ' . $order_id . ' – Regards, Marurang. MRURNG';
		$templete_id2 = '1707167698477367042';
		$ch2 = curl_init('https://www.txtguru.in/imobile/api.php?');
		curl_setopt($ch2, CURLOPT_POST, 1);
		curl_setopt($ch2, CURLOPT_POSTFIELDS, "username=$user&password=$pass&source=$header_name&dmobile=+91$admin_phone&dlttempid=$templete_id2&&message=$message_admin");
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		$data2 = curl_exec($ch2);



		if ($order_id) {
			if ($email != '') {
				$this->email_model->send_order_email($order_id, PLACE_ORDER_TEMP);
			}
			$this->email_model->send_order_email_admin_seller($order_id);
		}

		return $status;
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
		$current_month = date('m');

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

	function create_order($order_id, $user_id, $qouteid, $fullname, $mobile, $area, $fulladdress, $country, $region, $governorates, $lat, $lng, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $coupon_value,$state,$city,$city_id)
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
		$order['state'] = $state;
		$order['city'] = $city;
		$order['cityid'] = $city_id;
		
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
		} else {
			$status = 'invalid';
		}

		return $status;
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
			$this->email_model->send_other_country_order_update_to_admin($user_id, $order_id, ORDER_RECEIVED_NOTIFICATION_TEMP);
			return $insert_id;
		} else {
			return false;
		}
	}
}
