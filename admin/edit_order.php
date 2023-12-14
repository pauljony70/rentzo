<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Orders)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}
$ordersno = $_REQUEST['orderid'];
$product_id = $_REQUEST['product_id'];

?>
<?php include("header.php"); ?>

<!-- main content start-->
<?php 

$col1 = $col2 = $col3 = $col4 = $col5 = $col6 = $col7 = $col8 = $col9 = $col10 = $col11 = $col12 = $col13 = $col14 = $col15 = $col16 = $col17 = $col18 = $col19 = $col20  = '';
$stmt = $conn->prepare("SELECT o.order_id,o.user_id,op.status, op.prod_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date, op.discount,o.total_qty, o.fullname, o.mobile, o.area, o.fulladdress, o.country, o.region, o.governorate, o.addresstype, o.email, op.coupon_value, op.coupon_code, o.lat, o.lng,op.security_deposit FROM orders o, order_product op WHERE op.order_id = o.order_id and op.prod_id = '" . $product_id . "' and o.order_id = '" . $ordersno . "' ");


$stmt->execute();
$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15, $col16, $col17, $col18, $col19, $col20, $col21, $col22, $col23, $col24, $col25);

while ($stmt->fetch()) {

	$orderid =  $col1;
	$user_id =  $col2;
	$order_status =  $col3;
	$total_price =  $col4;
	$payment_orderid =  $col5;
	$payment_id =  $col6;
	$payment_mode =  $col7;
	$qoute_id =  $col8;
	$create_date =  date('d-m-Y', strtotime($col9));
	$discount =  $col10;
	$payment_status =   'Paid';
	$total_qty =  $col11;
	$fullname =  $col12;
	$mobile =  $col13;
	$area =  $col14;
	$fulladdress =  $col15;
	$country =  $col16;
	$region =  $col17;
	$governorate =  $col18;
	$addresstype =  $col19;
	$email =  $col20;
	$coupon_value =  $col21;
	$coupon_code =  $col22;
	$security_deposit =  $col25;
	$lat =  $lat;
	$lng =  $lng;
}
if ($_REQUEST['meg_form'] != '') {
	$msg_title = $_REQUEST['msg_title'];
	$msg_data = $_REQUEST['msg_data'];
	$datetime = date('Y-m-d H:i:s');
	$sql_status = $conn->prepare("INSERT INTO `order_chat`(`title`, `message`, `order_id`, `datetime`) VALUES ('" . $msg_title . "','" . $msg_data . "','" . $ordersno . "','" . $datetime . "')");
	$sql_status->execute();
	$sql_status->store_result();
	$chat_rows = $sql_status->affected_rows;
	$to = $email;
	$subject = $msg_title;
	$user_result['status'] = '1';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$message = '<html><body>';
	$message .= '<h1 style="color:#f40;">' . $msg_title . '</h1>';
	$message .= '<p>Message : ' . $msg_data . '</p>';
	$message .= '</body></html>';
	if (mail($to, $subject, $message, $headers)) {
		$msg = 'Your mail has been sent successfully.';
	} else {
		$msg = 'Unable to send email. Please try again.';
	}
	$trimmed_data = trim($msg_data, " ");
	$finl_data = str_replace(' ', '%20', $trimmed_data);
	$title_data = trim($msg_title, " ");
	$final_title_data = str_replace(' ', '%20', $title_data);
	/*$sm_msg = '*'.$msg_title.'* -'.$msg_data;*/
	$sm_msg = 'Order%20Id%20' . $ordersno . '%20%0A*' . $final_title_data . '*%0A' . $finl_data . '%20Regards%20Marurang.';
	$url = 'https://betablaster.in/api/send.php?number=91' . $mobile . '&type=text&message=' . $sm_msg . '&media_url=&filename=&instance_id=64258107A62A7&access_token=14e3c33fbe98cd4ac95bb8f15c2d9023';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',			  'charset: utf-8',));
	$response = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error: ' . curl_error($ch);
	} else {
		echo $response;
	}
}

$html = '';
if ($col2) {
	$user_type = 'App User';

	$stmt1 = $conn->prepare("SELECT fullname,phone,email FROM  appuser_login WHERE user_unique_id = '" . $col2 . "' ");

	$stmt1->execute();
	$data1 = $stmt1->bind_result($fullname, $phone, $email);
	$user_name = $user_phone = $user_email = '';
	while ($stmt1->fetch()) {
		$user_name = $fullname;
		$user_phone = $phone;
		$user_email = $email;
		$html = '<br>' . $user_phone . ',<br>' . $user_email;
	}
} else {
	$user_type = 'Guest';
}

if (isset($_POST['security_deposit']) && $ordersno && $product_id) {

	
	$security_deposit = $_POST['security_deposit'];
	
	$sql_status = $conn->prepare("INSERT INTO `security_payment`(`order_id`,`user_id`, `product_id`, `payment_status`, `amount`, `create_date`) VALUES (
					'" . $ordersno . "','" . $user_id . "','" . $product_id . "','pending','" . $security_deposit . "','" . $datetime . "')");
	$sql_status->execute();
	$sql_status->store_result();
	$rows = $sql_status->affected_rows;


	$orderstatus = 'Completed';
	
	$sql1 = $conn->prepare("UPDATE order_product SET status = '" . $orderstatus . "', status_date = '" . $datetime . "', update_date = '" . $datetime . "' WHERE order_id = '" . $ordersno . "' AND prod_id = '" . $product_id . "'");
	$sql1->execute();
	$sql1->store_result();

}


?>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<!-- <div class="page-title-right">
							<ol class="breadcrumb m-0" id="category_bradcumb">
								<li class="breadcrumb-item">
									<a href="javascript: void(0);">Invoice : <?= $invoice_number; ?></a>
								</li>
							</ol>
						</div> -->
						<h4 class="page-title">Order Details</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="bs-example widget-shadow" data-example-id="hoverable-table">
								<div id="printableArea">
									<input type="hidden" class="form-control" id="sno_order" value=<?= $ordersno; ?>></input>
									<input type="hidden" class="form-control" id="cust_phone" value=<?= $cust_phone; ?>></input>
									<input type="hidden" class="form-control" id="cust_email" value=<?= $cust_email; ?>></input>
									<!-- title row -->
									<div class="row invoice-info">
										<div class="col-12 table-responsive">
											<table class="table table-hover">
												<thead class="thead-light">
													<tr>
														<th> OrderID </th>
														<th> Customer Details </th>
														<th> Shipping Address </th>
														<th> <b>Order Status </b>
														<th> <b>Order Date </b> </th>
													</tr>
												</thead>
												<tr>
													<td>
														<?= $ordersno; ?>
													</td>
													<td>
														<?= $user_name . '(' . $user_type . ')';
														echo $html; ?>
													</td>
													<td>
														<?= $fullname . '<br>' . $mobile . ', ' . $email. '<br>' ;
														echo $fulladdress . ',<br>' . $city . ', ' . $state . ', ' . $region . ', ' . $country . '(' . $addresstype . ')';
														?>
														<br>
														<!--<a href="https://www.google.com/maps/search/?api=1&query=<?= $lat ?>,<?= $lng ?>" target="_blank" class="text-dark"><strong>View in map <i class="fa fa-external-link" aria-hidden="true"></i></strong></a>-->
													</td>
													<td>
														<?= $order_status; ?>
													</td>
													<td>
														<?= $create_date; ?>
													</td>
												</tr>
											</table>
										</div>
									</div>
									<!-- /.col -->
									<!-- Table row -->

									<div class="row invoice-info">
										<div class="col-12 table-responsive">
											<table class="table table-hover" style="border: 0.5px solid black;">
												<thead class="thead-light">
													<tr>
														<th>Image</th>
														<th>Product Name</th>
														<th>ProductID</th>
														<th>Vendor</th>
														<th>SKU</th>
														<th>Attribute</th>
														<th>Price</th>
														<th>Qty</th>
														<!--<th>Ship</th>-->
														<th>Status</th>
														<th class="dontprint">Action</th>
													</tr>
												</thead>
												<tbody id="tbodyPostid">
													<?php
													$stmtp = $conn->prepare("SELECT op.prod_id,op.prod_sku,op.prod_name,op.prod_img,op.prod_attr,op.qty,op.prod_price,op.shipping,op.discount,op.status, sl.companyname,op.vendor_id,op.cgst,op.sgst,op.igst,sl.pincode,op.pickup_date,sl.fullname,sl.address,sl.phone,op.invoice_number,op.pickup_type,op.p_weight,op.p_length,op.p_width,op.p_height FROM `order_product` op,sellerlogin sl WHERE order_id = '" . $ordersno . "' and op.prod_id = '" . $product_id . "' AND sl.seller_unique_id = op.vendor_id");

													$stmtp->execute();
													$datap = $stmtp->bind_result($prod_id, $prod_sku, $prod_name, $prod_img, $prod_attr, $qty, $prod_price, $shipping, $discount1, $status, $seller, $seller_id, $cgst, $sgst, $igst, $pincode, $pickup_date, $seller_name, $seller_address, $seller_phone, $invoice_number, $pickup_type, $p_weight, $p_length, $p_width, $p_height);
													$prod_id1 = $prod_sku1 = $prod_name1 = $prod_img1 = $prod_attr1 = $qty1 = $prod_price1 = $shipping1 = $discount1 = $status1 = $seller = $seller_id = $seller_pincode = $pickup_date = $seller_name = $seller_address = $seller_city_name =  $seller_state_name = $seller_phone = $invoice_number = $pickup_type = $p_weight = $p_length = $p_width = $p_height = '';
													$cgst = $sgst = $igst = 0;
													while ($stmtp->fetch()) {
														$prod_attr1 = '-';
														if ($prod_attr) {
															$attr = json_decode($prod_attr);
															$attribute = '';
															foreach ($attr as $prod_attr) {
																$attribute .= $prod_attr->attr_name . ': ' . $prod_attr->item . ', ';
															}

															$prod_attr1 = rtrim($attribute, ', ');
														}

														$cgst += $cgst;
														$sgst += $sgst;
														$igst += $igst;

														$seller_pincode = $pincode;
														$pickup_date = date('Y-m-d', strtotime($pickup_date));

													?>
														<tr>
															<td><img src="<?= MEDIAURL . $prod_img; ?>" style="width:50px;"> </td>
															<td>
																<?= $prod_name; ?>
															</td>
															<td>
																<?= $prod_id; ?>
															</td>
															<td>
																<a style="cursor: pointer;" onclick="editSeller(<?= "'" . $seller_id . "'"; ?>)"><?= $seller; ?></a>
															</td>
															<td>
																<?= $prod_sku; ?>
															</td>
															<td>
																<?= $prod_attr1; ?>
															</td>
															<td>
																<?= $prod_price; ?>
															</td>
															<td>
																<?= $qty; ?>
															</td>
															<!--<td>
																	<?php // echo   $shipping; 
																	?>
																</td>-->
															<td>
																<?= $status; ?>
															</td>
															<td class="dontprint" style="min-width: 205px;">
																<div class="d-flex">
																	<!--<button type="button" class="btn btn-dark waves-effect waves-light" onclick="back_page('edit_shipped_order.php?orderid=<?= $ordersno ?>&product_id=<?= $prod_id; ?>')">Edit</button>-->

																	<button type="button" onclick="back_page('view_product.php?id=<?= $prod_id; ?>')" id="back_btn" class="btn  btn-danger waves-effect waves-light" style="margin-left:6px;"> View Product</button>
																</div>
															</td>
														</tr>
													<?php	}

													?>
													<tr> </tr>
												</tbody>
											</table>
										</div>
									</div>
									
									<?php if ($order_status !== '' || $order_status !== NULL || $order_status == 'Return Completed' || $order_status == 'Return Request' || $order_status == 'Cancelled') : ?> 
												<div class="col-md-6 form-three widget-shadow mt-2 dontprint">
													<strong>Return Request :</strong><br>
													<form class="form-horizontal" method="post" id="myform">


														<div class="form-group row align-items-center">
															<label for="focusedinput" class="col-4 control-label m-0">Deposit</label>
															<div class="col-8">
																<input type="text" value="<?php echo $security_deposit; ?>" class="form-control" id="security_deposit" name="security_deposit" placeholder="">
															</div>
														</div>
														<div class="col-sm-offset-2">
															<button type="submit" class="btn btn-dark" href="javascript:void(0)" id="updatestatus">Update</button>
														</div>
													</form>
												</div>
											<?php endif; ?>
									<!-- /.col -->
									<span id="qty_save"></span>






									<div class="row">
										<!-- accepted payments column -->
										<?php
										$status_track1 = $conn->prepare("SELECT bo.delivery_boy,bl.fullname,bl.phone,bl.email FROM delivery_boy_orders bo INNER JOIN deliveryboy_login bl ON bl.deliveryboy_unique_id = bo.delivery_boy WHERE  bo.order_id = '" . $ordersno . "'
													AND bo.product_id = '" . $prod_id . "' ");

										$status_track1->execute();
										$delivery_boy_rows = $status_track1->affected_rows;
										$datap = $status_track1->bind_result($col, $co2, $co3, $co4);
										$delivery_boy = '';
										while ($status_track1->fetch()) {
											$delivery_uniq_id = $col;
											$delivery_boy_name = $co2;
											$delivery_boy_phone = $co3;
											$delivery_boy_email = $co4;
										}


										?>

										<div class="col-md-6">
											<!--<strong>Delivery Boy Name:</strong>
													<br> 
													<a style="color:black;"><span id="deliveryboyname"><?php // echo $delivery_boy_name; 
																										?></span></a>
													<br>
													<br>
													<strong>Delivery Boy Mobile:</strong>
													<br> 
													<a style="color:black;"><span id="deliveryboyname"><?php // echo $delivery_boy_phone; 
																										?></span></a>
													<br>
													<br>
													<strong>Delivery Boy Email:</strong>
													<br> 
													<a style="color:black;"><span id="deliveryboyname"><?php // echo $delivery_boy_email; 
																										?></span></a>
													<br>!-->
											<br>
											<strong>Payment Methods:</strong>
											<br> 
											<a style="color:black;"><span id="deliverymode"><?= $payment_mode; ?></span></a>
											<br>
											<br> <strong>Payment TXN ID: </strong> 
											<br> <a style="color:black;"><span id="paymentid"><?= $payment_id; ?></span></a>
											<br>
											<?php if ($pickup_type != '') { ?>
												<br><br><br>
												<strong>Shipping Type: </strong><br>
												<a style="color:black;"><span id="paymentid"><?php if ($pickup_type == 'self') {
																									echo 'Self Ship';
																								} else if ($pickup_type == 'rentzo') {
																									echo 'Ship By Rentzo';
																								}; ?></span></a>
												<?php if ($pickup_type != '') { ?>
													<br><br>
													<strong>Pickup Date: </strong><br>
													<a style="color:black;"><span id="paymentid"><?= date('d-m-Y', strtotime($pickup_date)); ?></span></a>
											<?php }
											} ?>
											<?php if ($p_weight != '') { ?>
												<br><br>
												<div class="row p-2">
													<div class="col-md-6" style="padding:0 !important;">
														<strong>Product Weight(gm): </strong><br>
														<a style="color:black;"><span><?= $p_weight; ?></span></a>
													</div>
													<div class="col-md-6">
														<strong>Product Length(cm): </strong><br>
														<a style="color:black;"><span><?= $p_length; ?></span></a>
													</div>
													<div class="col-md-6" style="padding:0 !important;">
														<strong>Product Width(cm): </strong><br>
														<a style="color:black;"><span><?= $p_width; ?></span></a>
													</div>
													<div class="col-md-6">
														<strong>Product Height(cm): </strong><br>
														<a style="color:black;"><span><?= $p_height; ?></span></a>
													</div>
												</div>
											<?php } ?>
											<br> <br>
											<?php
											$stmt_check = $conn->prepare("SELECT print_label,status,pickup_type,p_weight,p_length,p_width,p_height,prod_price FROM order_product WHERE order_id = '" . $ordersno . "' AND prod_id = '" . $prod_id . "'");


											$stmt_check->execute();
											$stmt_check->store_result();
											$stmt_check->bind_result($print_label, $accept_status, $pickup_type, $p_weight, $p_length, $p_width, $p_height, $prod_price_f);

											while ($stmt_check->fetch()) {
												$print_label_data = $print_label;
												$accept_status_data = $accept_status;
												$pickup_type_data = $pickup_type;
												$p_weight_data = $p_weight;
												$p_length_data = $p_length;
												$p_width_data = $p_width;
												$p_height_data = $p_height;
												$prod_price_f_data = $prod_price_f;
											}
											?>
										</div>
										<!-- /.col -->
										<div class="col-md-6">
											<div class="table-responsive">
												<table class="table">
													<tbody>
														<tr>
															<th style="width:50%">Total:</th>
															<td><span id="subtotal"><?= $total_price + $discount; ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">Security Deposit:</th>
															<td><span id="subtotal"><?= $security_deposit; ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">Discount:</th>
															<td><span id="subtotal"><?= $discount; ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">Coupon Discount:</th>
															<td><span id="subtotal"><?= number_format($coupon_value);
																					if ($coupon_code != '') {
																						echo ' (' . $coupon_code . ')';
																					} ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">Shipping:</th>
															<td><span id="subtotal"><?= $shipping; ?></span></td>
														</tr>
														
														<!-- <tr>
															<th style="width:50%">CGST:</th>
															<td><span id="subtotal"><?= $cgst; ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">SGST:</th>
															<td><span id="subtotal"><?= $sgst; ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">VAT:</th>
															<td><span id="subtotal"><?= $igst; ?></span></td>
														</tr> -->
														
														<tr>
															<th style="width:50%">Subtotal:</th>
															<td><span id="subtotal"><?= $Common_Function->price_format($total_price + $shipping, $conn); ?></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<!-- /.col -->
									</div>
									<!--- /.row -->
								</div>
								<div>
									<div class="form-three widget-shadow dontprint">
										<h5 class="text-center"><strong>Chat With User</strong></h5> <br>
										<form class="form-horizontal text-center" method="post" id="myform_tracking">
											<div class="form-group row align-items-center">
												<label class="col-2 control-label"> Title*</label>
												<div class="col-8"> <input type="text" class="form-control" id="msg_title" name="msg_title" required placeholder=""> </div>
											</div>
											<div class="form-group row align-items-center">
												<label for="focusedinput" class="col-2 control-label">Message</label>
												<div class="col-8">
													<textarea class="form-control" id="msg_data" col="3" name="msg_data" placeholder=""></textarea>
												</div>
											</div>
											<div class="col-sm-offset-2"> <button type="submit" name="meg_form" value="meg_data" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="sendmessaga">Send</button> </div>
										</form>
									</div>
								</div>
								<!-- print area close-->
								<script>
									function myPrint(divName) {
										var printContents = document.getElementById(divName).innerHTML;
										var originalContents = document.body.innerHTML;
										document.body.innerHTML = printContents;
										window.print();
										document.body.innerHTML = originalContents;
									}

									function editSeller(sellerid) {
										//successmsg(sellerid);

										var mapForm = document.createElement("form");
										mapForm.target = "_new";
										mapForm.method = "POST"; // or "post" if appropriate
										mapForm.action = "edit_seller_profile.php";

										var mapInput = document.createElement("input");
										mapInput.type = "text";
										mapInput.name = "sellerid";
										mapInput.value = sellerid;
										mapForm.appendChild(mapInput);

										document.body.appendChild(mapForm);

										map = window.open("", "_self");

										if (map) {
											mapForm.submit();
										} else {
											successmsg('You must allow popups for this map to work.');
										}
									}
								</script>
								<!-- this row will not appear when printing -->
								<div class="row no-print">
									<div class="col-12">
										<!-- <button type="submit" href="javascript:void(0)" onclick="myPrint('printableArea'); return false;" class="btn btn-danger waves-effect waves-light pull-right" style="position: fixed; bottom: 62px; right: 5px;"> <i class="fa fa-download"></i> Generate Invoice </button> -->
										<button type="submit" href="javascript:void(0)" onclick="generate_invoice('<?php echo $prod_id; ?>','<?php echo $ordersno; ?>'); " class="btn btn-danger waves-effect waves-light pull-right" style="position: fixed; bottom: 62px; right: 5px;"> <i class="fa fa-download"></i> Generate Invoice </button>
									</div>
								</div>
								</br>
								</br>
								<center>
									<p id="test1" style="color:green;"></p>
								</center>
								<div class="clearfix"> </div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
			<div class="col_1">
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>
<!--footer-->
<?php include('footernew.php'); ?>
<!--//footer-->
<script>
	function generate_invoice(prod_id, ordersno) {

		location.href = 'generate_invoice.php?orderid=' + ordersno + '&product_id=' + prod_id;

	}
</script>