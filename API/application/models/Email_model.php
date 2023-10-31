<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	function send_order_email_admin_seller($order_id)
	{
		//query for get order _details
		$this->db->select("total_price, create_date, fullname,mobile,locality,fulladdress,city,state,pincode,addresstype,email");

		$this->db->where(array('order_id' => $order_id));

		$query_order = $this->db->get('orders');

		$total_price = $create_date = $fullname = '';
		if ($query_order->num_rows() > 0) {
			$order_result = $query_order->result_object();

			$total_price = price_format($order_result[0]->total_price);
			$create_date = date("M d, Y", strtotime($order_result[0]->create_date));
			$fullname = $order_result[0]->fullname;
			$mobile = $order_result[0]->mobile;
			$toemail = $order_result[0]->email;
		}


		//code for get order product details

		$this->db->select("op.prod_name, sl.companyname,sl.email,op.qty,op.prod_price,op.shipping,op.discount");
		//join for get vendor product
		$this->db->join('sellerlogin sl', 'sl.seller_unique_id = op.vendor_id', 'INNER');

		$this->db->where(array('op.order_id' => $order_id));

		$query_prod = $this->db->get('order_product op');

		$partner_email = $partner_name = $product_name = '';

		if ($query_prod->num_rows() > 0) {
			$orderp_result = $query_prod->result_object();
			$product_name = $orderp_result[0]->prod_name;
			$partner_name = $orderp_result[0]->companyname;
			$partner_email = $orderp_result[0]->email;

			$qty = $orderp_result->qty;
			$prod_price = price_format($orderp_result->prod_price);
			$shipping = price_format($orderp_result->shipping);
			$discount = price_format($orderp_result->discount);
			$total_paid += (($orderp_result->prod_price * $orderp_result->qty) + $orderp_result->shipping);
		}

		//send to admin
		$messageadmin  = "<html><body>";

		$messageadmin .= "<table width='500px;' align='center' border='1' cellpadding='0' cellspacing='0' style='font-family: sans-serif;background: rgba(220, 220, 220, 0.17);font-size: 14px;'>";

		$messageadmin .= "<tbody>
						<tr>
							<td colspan='2'>Hello Admin</td>
						</tr>
						<tr><td style='padding: 10px;' colspan='2'> </td></tr>	
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Order ID</td>
							<td style='padding: 10px;'>" . $order_id . " </td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Seller Name</td>
							<td style='padding: 10px;'>" . $partner_name . " </td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Order Date</td>
							<td style='padding: 10px;'>" . $create_date . " </td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>User Name</td>
							<td style='padding: 10px;'>" . $fullname . " </td>
						</tr>
                        <tr>
							<td style='padding: 10px;font-weight: 600;'>Amount</td>
							<td style='padding: 10px;'>" . $total_paid . " </td>
						</tr>
						<tr>
							<td style='padding: 10px;' colspan='2'> <a style='background-color: #2979fb; color: #fff; padding: 0px; border: 0px; font-size: 14px; display: inline-block; margin-top: 0px; border-radius: 2px; text-decoration: none; width: 160px; text-align: center; line-height: 32px;' href='{MANAGE_ORDER}' target='_blank' rel='noopener noreferrer' data-mce-href='{MANAGE_ORDER}' data-mce-style='background-color: #2979fb; color: #fff; padding: 0px; border: 0px; font-size: 14px; display: inline-block; margin-top: 0px; border-radius: 2px; text-decoration: none; width: 160px; text-align: center; line-height: 32px;'
							href='" . SITE_URL . "admin/manage_orders.php?status=pending' >Manage Your Order</a></td>
						</tr>
					</tbody>";

		$messageadmin .= "</table>";

		$messageadmin .= "</body></html>";

		$admin_email = get_settings('system_email');
		$admin_subj = 'New Order received for - ' . $partner_name;
		if ($admin_email) {
			send_email_smtp($admin_email, $messageadmin, $admin_subj);
		}


		//send email to 

		//send to vendor
		$messagevendor  = "<html><body>";

		$messagevendor .= "<table width='500px;' align='center' border='1' cellpadding='0' cellspacing='0' style='font-family: sans-serif;background: rgba(220, 220, 220, 0.17);font-size: 14px;'>";

		$messagevendor .= "<tbody>
						<tr>
							<td colspan='2'>HI " . $partner_name . "</td>
						</tr>
						<tr><td style='padding: 10px;' colspan='2'> </td></tr>	
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Order ID</td>
							<td style='padding: 10px;'>" . $order_id . " </td>
						</tr>
						
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Order Date</td>
							<td style='padding: 10px;'>" . $create_date . " </td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Product Name</td>
							<td style='padding: 10px;'>" . $product_name . " </td>
						</tr>
                      <tr>
							<td style='padding: 10px;' colspan='2'> <a style='background-color: #2979fb; color: #fff; padding: 0px; border: 0px; font-size: 14px; display: inline-block; margin-top: 0px; border-radius: 2px; text-decoration: none; width: 160px; text-align: center; line-height: 32px;' href='{MANAGE_ORDER}' target='_blank' rel='noopener noreferrer' data-mce-href='{MANAGE_ORDER}' data-mce-style='background-color: #2979fb; color: #fff; padding: 0px; border: 0px; font-size: 14px; display: inline-block; margin-top: 0px; border-radius: 2px; text-decoration: none; width: 160px; text-align: center; line-height: 32px;'
							href='" . SITE_URL . "vendor/manage_orders.php?status=pending' >Manage Your Order</a></td>
						</tr>
					</tbody>";

		$messagevendor .= "</table>";

		$messagevendor .= "</body></html>";


		$vendor_subj = 'Confirmation required for new order received';
		if ($partner_email) {
			send_email_smtp($partner_email, $messagevendor, $vendor_subj);
			$header = "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";
			//$retval = mail($partner_email,$vendor_subj,$messagevendor,$header);

			if ($retval == true) {
				//echo "Message sent successfully...";
			} else {
				//echo "Message could not be sent...";
			}
		}
	}

	function send_order_email($order_id, $template_id, $prod_id = '')
	{
		if (!$template_id) {
			return false;
		}

		$this->db->select("email_title, email_subject, email_body");

		$this->db->where(array('id' => $template_id));

		$query = $this->db->get('email_template');


		if ($query->num_rows() > 0) {
			$email_result = $query->result_object();
			$subject = $email_result[0]->email_subject;
			$email_body = $email_result[0]->email_body;

			//query for get order _details
			$this->db->select("total_price, create_date, fullname,mobile,locality,fulladdress,city,state,pincode,addresstype,email");

			$this->db->where(array('order_id' => $order_id));

			$query_order = $this->db->get('orders');

			if ($query_order->num_rows() > 0) {
				$order_result = $query_order->result_object();


				$create_date = date("M d, Y", strtotime($order_result[0]->create_date));
				$fullname = $order_result[0]->fullname;
				$mobile = $order_result[0]->mobile;
				$toemail = $order_result[0]->email;
				$address = $order_result[0]->fulladdress . '<br>' . $order_result[0]->locality . '<br>' . $order_result[0]->city . ',' . $order_result[0]->state . ',' . $order_result[0]->pincode;
				$android_app_link = get_settings('android_app_link');
				$ios_app_link = get_settings('ios_app_link');
				$system_name = get_settings('system_name');
				$ios_app_link_img = MEDIA_URL . 'ios_store.png';
				$and_app_img =  MEDIA_URL . 'google_play.png';


				$email_body = str_replace(array('{USER_NAME}', 'USER_NAME'), $fullname, $email_body);
				$email_body = str_replace(array('{ORDER_DATE}', 'ORDER_DATE'), $create_date, $email_body);
				$email_body = str_replace(array('{ORDER_ID}', 'ORDER_ID'), $order_id, $email_body);
				$email_body = str_replace(array('{USER_ADDRESS}', 'USER_ADDRESS'), $address, $email_body);
				$email_body = str_replace(array('{USER_PHONE}', 'USER_PHONE'), $mobile, $email_body);
				$email_body = str_replace(array('{STORE_NAME}', 'STORE_NAME'), $system_name, $email_body);
				$email_body = str_replace(array('{APP_LINK}', 'APP_LINK'), $android_app_link, $email_body);
				$email_body = str_replace(array('{IOS_APP}', 'IOS_APP'), $ios_app_link, $email_body);
				$email_body = str_replace(array('{AND_LINK_IMG}', 'AND_LINK_IMG'), $and_app_img, $email_body);
				$email_body = str_replace(array('{IOS_LINK_IMG}', 'IOS_LINK_IMG'), $ios_app_link_img, $email_body);
				$email_body = str_replace(array('{USER_EMAIL}', 'USER_EMAIL'), $toemail, $email_body);

				//query for get order _details
				$this->db->select("prod_name, prod_img, prod_attr,qty,prod_price,shipping,discount,delivery_date,companyname");
				$this->db->join('sellerlogin sl', 'sl.seller_unique_id = op.vendor_id', 'INNER');

				if ($prod_id) {
					$this->db->where(array('order_id' => $order_id, 'prod_id' => $prod_id));
				} else {
					$this->db->where(array('order_id' => $order_id));
				}

				$query_order_prod = $this->db->get('order_product op');

				$html = '';
				$total_paid = 0;
				if ($query_order_prod->num_rows() > 0) {
					$order_prod_result = $query_order_prod->result_object();
					foreach ($order_prod_result as $prod_details) {
						$prod_name = $prod_details->prod_name;
						$prod_img = MEDIA_URL . $prod_details->prod_img;
						$prod_attr = $prod_details->prod_attr;
						$qty = $prod_details->qty;
						$prod_price = price_format($prod_details->prod_price);
						$shipping = price_format($prod_details->shipping);
						$discount = price_format($prod_details->discount);
						$delivery_date = date("M d, Y", strtotime($prod_details->delivery_date));
						$companyname = $prod_details->companyname;
						$total_paid += (($prod_details->prod_price * $prod_details->qty) + $prod_details->shipping);

						$html .= '<tr>
								<td align="left">
									<table class="m_-4345841705994091849col" border="0" cellspacing="0" cellpadding="0" align="left">
										<tbody>
											<tr>
												<td class="m_-4345841705994091849link" style="padding-top: 20px;" align="center" valign="middle" width="120">
													<a style="color: #fff; text-decoration: none; outline: none; font-size: 13px;" href="" target="_blank" rel="noopener noreferrer">
														<img class="CToWUd" style="border: none; max-width: 125px; max-height: 125px;" src="' . $prod_img . '" alt="' . $prod_name . '" border="0" />
													</a>
												</td>
												<td style="padding-top: 20px; padding-left: 15px;" align="left" valign="top">
													<p class="m_-4345841705994091849link" style="margin-top: 0; margin-bottom: 7px;">
														<a style="font-family: Arial; font-size: 14px; font-weight: normal; font-style: normal; font-stretch: normal; line-height: 20px; color: #212121; text-decoration: none!important; word-spacing: 0.2em; max-width: 360px; display: inline-block; min-width: 352px; width: 352px;" href="" target="_blank" rel="noopener noreferrer">' . $prod_name . '</a>
														<span style="min-width: 100px; font-size: 12px; font-weight: bold; padding-right: 0px; line-height: 20px; text-align: right; display: inline-block; float: right;"> ' . $prod_price . '</span>
													</p>
													<p style="line-height: 18px; margin-top: 0px; margin-bottom: 2px; font-family: Arial; font-size: 12px; color: #212121;">Delivery 
														<span style="line-height: 18px; font-family: Arial; font-size: 12px; font-weight: bold; color: #139b3b;"> by ' . $delivery_date . '  </span>
													</p>
													<p style="line-height: 18px; margin-top: 0px; margin-bottom: 2px; font-family: Arial; font-size: 12px; color: #212121;">Seller: ' . $companyname . '
														<span style="float: right; font-size: 12px; padding-right: 5px;">
															<span style="color: #878787; text-align: right; margin-right: 5px;">Delivery charges</span>
															<span style="float: right; text-align: right;">' . $shipping . '</span>
														</span>
													</p>
													<p style="line-height: 18px; margin-top: 0px; margin-bottom: 0px; font-family: Arial; font-style: normal; font-size: 12px; font-stretch: normal; color: #212121;">Qty: ' . $qty . '</p>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>';
					}
				}

				$total_price = price_format($total_paid);
				$email_body = str_replace(array('{AMOUNT_PAID}', 'AMOUNT_PAID'), $total_price, $email_body);
				$email_body = str_replace(array('{PRODUCTS_DETAILS}', 'PRODUCTS_DETAILS'), $html, $email_body);

				//echo $email_body;
				send_email_smtp($toemail, $email_body, $subject);
				$header = "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html\r\n";
				//$retval = mail($toemail,$subject,$email_body,$header);

				if ($retval == true) {
					//echo "Message sent successfully...";
				} else {
					//echo "Message could not be sent...";
				}
			}
		}
	}

	function sendEmailOtp($email, $otp)
	{
		$system_name = get_settings('system_name');
		$subject = $system_name . ' One-Time Password (OTP) for Account Validation';
		$email_body =
			'<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
				<div style="margin:50px auto;width:70%;padding:20px 0; margin-top: 0px;">
					<div style="border-bottom:1px solid #eee">
						<a href="' . base_url() . '" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600"><img src="' . base_url('assets_web/images/logo-appbar.png') . '" alt="logo" width="70">
					</div>
					<p style="font-size:1.1em">Hi User,</p>
					<p>Thank you for choosing ' . $system_name . '. Use the following OTP to complete your password reset procedures. OTP is valid for 3 minutes</p>
					<h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">' . $otp . '</h2>
					<p style="font-size:0.9em; margin-bottom: 0px">Regards,<br />' . $system_name . '</p>
					<a style="font-size:0.9em;" href="' . base_url() . '">' . base_url() . '</a><br>
					<img style="margin-top: 5px;" src="' . base_url('assets_web/images/logo-appbar.png') . '" alt="logo" width="70">
					<hr style="border:none;border-top:1px solid #eee" />
					<div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
						<p>' . $system_name . ' Inc</p>
					</div>
				</div>
			</div>';

		send_email_smtp($email, $email_body, $subject);

		$header = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html\r\n";
	}

	public function sendRegistrationEmailOtp($email)
	{
		$otp = $this->sms_model->generateNumericOTP(6);
		$this->sendEmailOtp($email, $otp);
		return $otp;
	}

	public function send_other_country_order_update_to_user($user_id, $order_id, $template_id, $product_name, $product_quantity, $product_size, $product_color, $prod_img, $order_status)
	{
		$user_data = $this->db->get_where('appuser_login', array('user_unique_id' => $user_id))->row_array();
		$toemail = $user_data['email'];
		$fullname = $user_data['fullname'];
		$subject = '';
		if ($order_status == 'requested') {
			$subject = 'Order Requested';
		} else if ($order_status == 'processed') {
			// Do Something
		} else if ($order_status == 'ordered') {
			// Do Something
		} elseif ($order_status == 'delivered') {
			// Do Something
		}
		$email_body = $this->db->get_where('email_template', array('id' => $template_id))->row_array()['email_body'];
		$email_body = str_replace('{BASE_URL}', base_url(), $email_body);
		$email_body = str_replace('{ORDER_STATUS}', 'Order: Requested', $email_body);
		$email_body = str_replace('{USER_NAME}', $fullname, $email_body);
		$email_body = str_replace('{ORDER_MESSAGE}', 'We are delighted to inform you that your order has been successfully placed! We want to express our gratitude for choosing us as your preferred provider.', $email_body);
		$email_body = str_replace('{BUTTON_TEXT}', 'Check Order Status', $email_body);
		$email_body = str_replace('{BUTTON_LINK}', base_url('buy-from-turkey-orders'), $email_body);
		$email_body = str_replace('{ORDER_ID}', $order_id, $email_body);
		$email_body = str_replace('{ORDER_DATE}', $this->date_time, $email_body);
		$email_body = str_replace('{SHIPPING_ADDRESS}', '', $email_body);
		if ($order_status == 'requested') {
			$email_body = replace_occurrences($email_body, 2, "#f6e6cb");
			$email_body = replace_occurrences2($email_body, 1, "tick-circle.png");
			$email_body = str_replace('{FIRST_STATUS}', 'Requested', $email_body);
			$email_body = str_replace('{FIRST_STATUS_VAL}', date('d M, Y', strtotime($this->date_time)), $email_body);
			$email_body = str_replace('{SECOND_STATUS}', 'Processed', $email_body);
			$email_body = str_replace('{SECOND_STATUS_VAL}', '<br>', $email_body);
			$email_body = str_replace('{THIRD_STATUS}', 'Payment Received', $email_body);
			$email_body = str_replace('{THIRD_STATUS_VAL}', '<br>', $email_body);
			$email_body = str_replace('{FOURTH_STATUS}', 'Delivered', $email_body);
			$email_body = str_replace('{FOURTH_STATUS_VAL}', '<br>', $email_body);
		} else if ($order_status == 'processed') {
			// Do Something
		} else if ($order_status == 'ordered') {
			// Do Something
		} elseif ($order_status == 'delivered') {
			// Do Something
		}
		$product_details =
			'<tr>
				<td class="esdev-adapt-off" align="left"
				style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
				<table cellpadding="0" cellspacing="0" class="esdev-mso-table"
					style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px">
					<tr>
					<td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
						<table cellpadding="0" cellspacing="0" class="es-left" align="left"
						style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
						<tr>
							<td align="left" style="padding:0;Margin:0;width:125px">
							<table cellpadding="0" cellspacing="0" width="100%" role="presentation"
								style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
								<tr>
								<td align="center" style="padding:0;Margin:0;font-size:0px"><a target="_blank"
									href="' . base_url() . '"
									style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:12px"><img
										class="adapt-img p_image"
										src="' . base_url('media/') . $prod_img . '"
										alt="' . $product_name . '"
										style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
										width="125" title="' . $product_name . '" height="125"></a></td>
								</tr>
							</table>
							</td>
						</tr>
						</table>
					</td>
					<td style="padding:0;Margin:0;width:20px"></td>
					<td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
						<table cellpadding="0" cellspacing="0" class="es-left" align="left"
						style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
						<tr>
							<td align="left" style="padding:0;Margin:0;width:125px">
							<table cellpadding="0" cellspacing="0" width="100%" role="presentation"
								style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
								<tr>
								<td align="left" class="es-m-p0t es-m-p0b es-m-txt-l"
									style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px">
									<h3
									style="Margin:0;line-height:19px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;font-style:normal;font-weight:bold;color:#333333">
									<strong class="p_name">' . $product_name . '</strong>
									</h3>
								</td>
								</tr>
							</table>
							</td>
						</tr>
						</table>
					</td>
					<td style="padding:0;Margin:0;width:20px"></td>
					<td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
						<table cellpadding="0" cellspacing="0" class="es-left" align="left"
						style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
						<tr>
							<td align="left" style="padding:0;Margin:0;width:176px">
							<table cellpadding="0" cellspacing="0" width="100%" role="presentation"
								style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
								<tr>
								<td align="right" class="es-m-p0t es-m-p0b"
									style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px">
									<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px"
									class="p_description">x' . $product_quantity . '</p>
								</td>
								</tr>
							</table>
							</td>
						</tr>
						</table>
					</td>
					<td style="padding:0;Margin:0;width:20px"></td>
					<td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
						<table cellpadding="0" cellspacing="0" class="es-right" align="right"
						style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
						<tr>
							<td align="left" style="padding:0;Margin:0;width:74px">
							<table cellpadding="0" cellspacing="0" width="100%" role="presentation"
								style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
								<tr>
								<td align="right" class="es-m-p0t es-m-p0b"
									style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px">
									<p class="p_price"
									style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px">' . $product_color . ' | ' . $product_size . '</p>
								</td>
								</tr>
							</table>
							</td>
						</tr>
						</table>
					</td>
					</tr>
				</table>
				</td>
			</tr>';
		$email_body = str_replace('{PRODUCTS_DETAILS}', $product_details, $email_body);
		$email_body = str_replace('{PRICE_DETAILS_KEY}', '', $email_body);
		$email_body = str_replace('{PRICE_DETAILS_VALUE}', '', $email_body);
		$email_body = str_replace('{HR}', '<td></td>', $email_body);
		$email_body = str_replace('{SHIPPING_ADDRESS_HEAD}', '', $email_body);
		send_email_smtp($toemail, $email_body, $subject);
	}

	public function send_other_country_order_update_to_admin($user_id, $order_id, $template_id, $product_name, $product_quantity, $product_size, $product_color, $prod_img, $order_status)
	{
		$user_data = $this->db->get_where('appuser_login', array('user_unique_id' => $user_id))->row_array();
		$email = $user_data['email'];
		$phone = $user_data['phone'];
		$fullname = $user_data['fullname'];
		$subject = 'New Buy From Turkey Order Recived';
		
		$email_body = $this->db->get_where('email_template', array('id' => $template_id))->row_array()['email_body'];
		$admin_email = get_settings('system_email');
		send_email_smtp($admin_email, $email_body, $subject);
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

	// string of specified length 
	function random_strings($length_of_string)
	{

		// String of all alphanumeric character 
		$str_result = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz';

		// Shufle the $str_result and returns substring 
		// of specified length 
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}
}
