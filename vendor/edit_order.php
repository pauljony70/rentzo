<?php
include('session.php');
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

$ordersno = $_REQUEST['orderid'];
$product_id = $_REQUEST['product_id'];
$datetime = date('Y-m-d H:i:s');
if (!$ordersno || !$product_id) {
	header("Location: manage_orders.php");
}
include("header.php");
?>

<style>
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 320px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		-ms-transform: translate3d(0%, 0, 0);
		-o-transform: translate3d(0%, 0, 0);
		transform: translate3d(0%, 0, 0);
	}

	.modal.right .modal-content {
		height: 100%;
	}

	.modal.right .modal-body {
		overflow-y: scroll;
	}

	.modal.right.fade .modal-dialog {
		right: 0px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		-moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		-o-transition: opacity 0.3s linear, right 0.3s ease-out;
		transition: opacity 0.3s linear, right 0.3s ease-out;
	}

	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

	.modal-content {
		border-radius: 0;
		border: none;
	}

	#chatModal .modal-header {
		background-color: var(--primary);
		height: 66px;
		border-radius: 18px 18px 0px 0px;
	}

	#chatModal .modal-header .profile-img {
		width: 33px;
		height: 33px;
		border-radius: 50%;
		flex-shrink: 0;
		background: #fff;
	}

	#chatModal .modal-header .profile-img img {
		width: 24px;
		height: 24px;
		object-fit: contain;
	}

	#chatModal .modal-body {
		border: 1px solid var(--primary);
		display: flex;
		flex-direction: column-reverse;
		overflow-y: auto;
		color: #000;
		font-size: 12px;
		font-style: normal;
		font-weight: 400;
		line-height: 15px;
		letter-spacing: 0.24px;
	}

	#chatModal .modal-body .user-message .message {
		border-radius: 2px 0px 0px 2px;
		border: 1px solid var(--primary);
		border-right: none;
		background: rgba(0, 142, 204, 0.60);
	}

	#chatModal .modal-body .seller-message .message {
		border-radius: 0px 2px 2px 0px;
		border: 1px solid var(--primary);
		border-left: none;
		background: #F0ECEC;
	}

	#chatModal .modal-footer .input-group {
		height: 46px;
		border: 1px solid var(--primary);
	}

	#chatModal .modal-footer .input-group .form-control {
		border: none;
	}

	#chatModal #send-message-btn {
		border: none;
	}

	.btn:disabled {
		cursor: not-allowed;
	}
</style>

<?php if (isset($_POST['orderstatus']) && $ordersno && $product_id) {

	$orderstatus = $_POST['orderstatus'];
	$ordermessage = trim($_POST['ordermessage']);
	$sql_status = $conn->prepare("INSERT INTO `order_tracking_status`(`order_id`, `product_id`, `status`, `message`, `created_at`) VALUES (
					'" . $ordersno . "','" . $product_id . "','" . $orderstatus . "','" . $ordermessage . "','" . $datetime . "')");
	$sql_status->execute();
	$sql_status->store_result();
	$rows = $sql_status->affected_rows; 


	$reverse_shipping = 0;
	if ($orderstatus == 'Returned Completed') {
		$reverse_shipping = $Common_Function->get_system_settings($conn, 'reverse_shipping');
	}

	$sql1 = $conn->prepare("UPDATE order_product SET status = '" . $orderstatus . "', status_date = '" . $datetime . "', update_date = '" . $datetime . "', reverse_shipping = '" . $reverse_shipping . "' WHERE order_id = '" . $ordersno . "' AND prod_id = '" . $product_id . "'");
	$sql1->execute();
	$sql1->store_result();

	if ($rows > 0) {
		$Common_Function->send_delivered_email_invoice_user($conn, $ordersno, $product_id, $_SESSION['admin'], $orderstatus);
		echo "<script>successmsg1('Order updated successfully.', 'edit_order.php?orderid={$ordersno}&product_id={$product_id}'); </script>";
		//if($orderstatus =='Delivered'){
		
		//}
		
	}
}

if (isset($_POST['new_orderstatus'])) {
	$new_orderstatus = trim($_POST['new_orderstatus']);

	$new_pickupdate = trim($_POST['pick_date']);
	$curier_name = trim($_POST['curier_name']);

	$curtime = date('H:i:s');
	$pick_date = date("Y-m-d H:i:s", strtotime($new_pickupdate . $curtime));

	$sql_new = $conn->prepare("UPDATE order_product SET status = '" . $new_orderstatus . "', pickup_date = '" . $pick_date . "',pickup_type = '" . $curier_name . "', update_date = '" . $datetime . "' WHERE order_id = '" . $ordersno . "' AND prod_id = '" . $product_id . "'");
	$sql_new->execute();
	$sql_new->store_result();
	echo "<script>successmsg1('Order updated successfully.', 'edit_order.php?orderid={$ordersno}&product_id={$product_id}'); </script>";
}

if (isset($_POST['delivery_date']) && $ordersno && $product_id) {
	$delivery_date = trim($_POST['delivery_date']);
	$tracking_id = trim($_POST['tracking_id']);
	$tracking_url = trim($_POST['tracking_url']);

	$sql1 = $conn->prepare("UPDATE order_product SET delivery_date = '" . $delivery_date . "', tracking_id = '" . $tracking_id . "', tracking_url = '" . $tracking_url . "', update_date = '" . $datetime . "' WHERE order_id = '" . $ordersno . "'
							AND prod_id = '" . $product_id . "'");
	$sql1->execute();
	$sql1->store_result();

	echo "<script>successmsg1('Order updated successfully.', 'edit_order.php?orderid={$ordersno}&product_id={$product_id}'); </script>";
}

if (isset($_POST['pickup_date']) && isset($_POST['pickup_status']) && $ordersno && $product_id) {
	$pickup_date = trim($_POST['pickup_date']);
	$pickup_status = trim($_POST['pickup_status']);

	$sql1 = $conn->prepare("UPDATE order_product SET pickup_date = '" . $pickup_date . "', pickup_status = '" . $pickup_status . "', update_date = '" . $datetime . "' WHERE order_id = '" . $ordersno . "'
							AND prod_id = '" . $product_id . "'");
	$sql1->execute();
	$sql1->store_result();


	$sql_status = $conn->prepare("INSERT INTO `order_tracking_status`(`order_id`, `product_id`, `status`, `message`, `created_at`) VALUES (
					'" . $ordersno . "','" . $product_id . "','" . $pickup_status . "','','" . $datetime . "')");
	$sql_status->execute();
	$sql_status->store_result();
	$rows = $sql_status->affected_rows;

	echo '<script>successmsg("Order pickup status updated successfully."); </script> ';
}
?>


<!-- main content start-->
<?php
$invoice_number = '';

$query = $conn->query("SELECT invoice_number,status FROM `order_product` WHERE order_id = '" . $ordersno . "' AND prod_id = '" . $product_id . "' ");
if ($query->num_rows > 0) {

	$rows = $query->fetch_assoc();

	$invoice_number = $rows['invoice_number'];
	$order_status =  $rows['status'];
}

$col1 = $col2 = $col3 = $col4 = $col5 = $col6 = $col7 = $col8 = $col9 = $col10 = $col11 = $col12 = $col13 = $col14 = $col15 = $col16 = '';

$stmt = $conn->prepare("SELECT order_id, user_id, status, total_price, payment_orderid, payment_id, payment_mode, qoute_id, create_date, discount, total_qty, fullname, mobile, fulladdress, country, city, state, area, lat, lng, addresstype, email,pincode FROM orders o WHERE o.order_id = '" . $ordersno . "' ");


$stmt->execute();
$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15, $col16, $col17, $col18, $col19, $col20, $col21, $col22, $col23);

while ($stmt->fetch()) {

	$orderid =  $col1;
	$user_id =  $col2;
	$total_price =  $col4;
	$payment_orderid =  $col5;
	$payment_id =  $col6;
	$payment_mode =  $col7;
	$qoute_id =  $col8;
	$create_date =   date('d-m-Y', strtotime($col9));
	$total_discount =  $col10;
	$payment_status =   'Paid';
	$total_qty =  $col11;
	$fullname =  $col12;
	$mobile =  $col13;
	$fulladdress =  $col14;
	$country =  $col15;
	$city =  $col16;
	$state =  $col17;
	$area =  $col18;
	$lat =  $col19;
	$lng =  $col20;
	$addresstype =  $col21;
	$email =  $col22;
	$pincode =  $col23;
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

$stmt_country = $conn->prepare("SELECT name FROM  country WHERE id = '" . $country . "' ");

	$stmt_country->execute();
	$data1 = $stmt_country->bind_result($country_name);
	$country_name  = '';
	while ($stmt_country->fetch()) {
		$country_name = $country_name;
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
						<div class="page-title-right">
							<ol class="breadcrumb m-0" id="category_bradcumb">
								<li class="breadcrumb-item">
									<a href="javascript: void(0);">Invoice : <?= $invoice_number; ?></a>
								</li>
							</ol>
						</div>
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
									<input type="hidden" class="form-control1" id="site_url" value=<?= BASEURL; ?>></input>
									<input type="hidden" class="form-control1" id="sno_order" value=<?= $ordersno; ?>></input>
									<input type="hidden" class="form-control1" id="prod_id" value=<?= $product_id; ?>></input>
									<input type="hidden" class="form-control1" id="user_id" value=<?= $user_id; ?>></input>
									<input type="hidden" class="form-control1" id="seller_id" value=<?= $_SESSION['admin']; ?>></input>
									<input type="hidden" class="form-control1" id="cust_phone" value=<?= $cust_phone; ?>></input>
									<input type="hidden" class="form-control1" id="cust_email" value=<?= $cust_email; ?>></input>
									<input type="hidden" name="code_ajax" id="code_ajax" value="<?= $code_ajax; ?>" />

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
														<th> <b>Order Date </b>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?= $ordersno; ?> </td>
														<td>
															<?= $user_name . '(' . $user_type . ')';
															echo $html; ?>
														</td>
														<td>
															<?= $fullname . '<br>' . $mobile . ', ' . $email;
															echo '<br>' . $fulladdress . ',<br>' . $city . ', ' . $state . ', ' . $country_name . '(' . $addresstype . ')';
															?>
															<br>
															<!--<a href="https://www.google.com/maps/search/?api=1&query=<?= $lat ?>,<?= $lng ?>" target="_blank" class="text-dark"><strong>View in map <i class="fa fa-external-link" aria-hidden="true"></i></strong></a>-->
														</td>
														<td><?= $order_status; ?> </td>
														<td><?= $create_date; ?> </td>
													</tr>
												</tbody>

											</table>
										</div>
									</div>

									<div class="row invoice-info">

										<div class="col-12 table-responsive">
											<table class="table table-hover" style="border: 0.5px solid #ccc;">
												<thead class="thead-light">
													<tr>
														<th>#</th>
														<th>Product Name</th>
														<th>ProductID</th>
														<th>SKU</th>
														<th>Attribute</th>
														<th>Price</th>
														<th>Qty</th>

														<th class="dontprint">Action</th>

													</tr>
												</thead>

												<tbody id="tbodyPostid">
													<?php
													$stmtp = $conn->prepare("SELECT op.prod_id,op.prod_sku,op.prod_name,op.prod_img,op.prod_attr,op.qty,op.prod_price,op.shipping,op.igst,op.discount,op.status, sl.companyname, op.invoice_number,op.pickup_type,op.pickup_date,op.p_weight,op.p_length,op.p_width,op.p_height,op.coupon_value,op.tracking_id,op.delivery_date, op.tracking_url,op.security_deposit FROM `order_product` op, sellerlogin sl WHERE op.order_id = '" . $ordersno . "' AND op.prod_id = '" . $product_id . "' AND sl.seller_unique_id = op.vendor_id ");

													$stmtp->execute();
													$datap = $stmtp->bind_result($prod_id, $prod_sku, $prod_name, $prod_img, $prod_attr, $qty, $prod_price, $shipping, $igst, $discount, $status, $seller, $invoice_number, $pickup_type, $pickup_date, $p_weight, $p_length, $p_width, $p_height, $coupon_value, $tracking_id, $delivery_date, $tracking_url,$security_deposit);
													$prod_id1 = $prod_sku1 = $prod_name1 = $prod_img1 = $prod_attr1 = $qty1 = $prod_price1 = $shipping1 = $igst = $discount = $status1 = $seller  = $invoice_number1 = $pickup_type = $pickup_date = $p_weight = $p_length = $p_width = $p_height = $coupon_value = $tracking_id = $security_deposit = '';
													while ($stmtp->fetch()) {
														$prod_attr1 = '';
														if ($prod_attr) {
															$attr = json_decode($prod_attr);
															$attribute = '';
															foreach ($attr as $prod_attr) {
																$attribute .= $prod_attr->attr_name . ': ' . $prod_attr->item . ', ';
															}

															$prod_attr1 = rtrim($attribute, ', ');
														}

													?>
														<tr>
															<td><img src="<?= MEDIAURL . str_replace('-430-590', '', $prod_img); ?>" style="width:50px;"> </td>


															<td><?= $prod_name; ?> </td>
															<td><?= $prod_id; ?> </td>
															<td><?= $prod_sku; ?> </td>
															<td><?= $prod_attr1; ?> </td>
															<td><?= $prod_price; ?> </td>
															<td><?= $qty; ?> </td>
															<td class="dontprint"><button type="submit" onclick="back_page('view_product.php?id=<?= $prod_id; ?>')" id="back_btn" class="btn btn-danger" style="margin-right:10px; margin-top:-4px;"> View Product</button> </td>
														</tr>
													<?php	}

													?>
													<tr></tr>
												</tbody>
											</table>
										</div>
									</div>
									<!-- /.col -->
									<span id="qty_save"></span> <br>
									<!-- /.row -->

									<?php
									$status_track1 = $conn->prepare("SELECT bo.delivery_boy,bl.fullname,bl.phone,bl.email FROM delivery_boy_orders bo INNER JOIN deliveryboy_login bl ON bl.deliveryboy_unique_id = bo.delivery_boy WHERE  bo.order_id = '" . $ordersno . "'AND bo.product_id = '" . $prod_id . "' ");

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
									<div class="row">
										<!-- accepted payments column -->
										<div class="col-md-6">

											<strong>Payment Methods:</strong> <br>
											<a style="color:black;"><span id="deliverymode"><?= $payment_mode; ?></span></a><br><br>
											<strong>Payment TXN ID: </strong><br>
											<a style="color:black;"><span id="paymentid"><?= $payment_id; ?></span></a>
											<?php if ($pickup_type != '') { ?>
												<br><br><br><br>
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
												<div class="row">
													<div class="col-md-6">
														<strong>Product Weight(gm): </strong><br>
														<a style="color:black;"><span><?= $p_weight; ?></span></a>
													</div>
													<div class="col-md-6">
														<strong>Product Length(cm): </strong><br>
														<a style="color:black;"><span><?= $p_length; ?></span></a>
													</div>
													<div class="col-md-6">
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
											$stmt_check = $conn->prepare("SELECT print_label,status,tracking_id FROM order_product WHERE order_id = '" . $ordersno . "' AND prod_id = '" . $prod_id . "'");


											$stmt_check->execute();
											$stmt_check->store_result();
											$stmt_check->bind_result($print_label, $ord_status, $tracking_id);

											while ($stmt_check->fetch()) {
												$print_label_data = $print_label;
												$ord_status_data = $ord_status;
												$tracking_id_data = $tracking_id;
											}
											if ($tracking_id_data != '') {
											?>
												<strong>Tracking ID: </strong><br>
												<a style="color:black;"><span><?= $tracking_id_data; ?></span></a>
											<?php
											}
											if ($ord_status_data == 'Placed') {
											?>

												<div class="form-three widget-shadow dontprint">
													<strong>Order Status:</strong><br>
													<form class="form-horizontal" method="post" id="myform">

														<div class="form-group row align-items-center">
															<label class="col-4 control-label m-0"> Status*</label>
															<div class="col-8">
																<select class="form-control" id="new_orderstatus" name="new_orderstatus" required>
																	<option value="">Select</option>
																	<option value="Accepted">Accept</option>
																	<option value="Rejected">Reject</option>
																</select>
															</div>
														</div>
														<div class="form-group row align-items-center">
															<label class="col-4 control-label m-0"> Courier By*</label>
															<div class="col-8">
																<select class="form-control" id="curier_name" name="curier_name">
																	<option value="">Select Courier</option>
																	<option value="self">Self Ship</option>
																	<option value="rentzo">Ship By Rentzo</option>
																</select>
															</div>
														</div>
														
														<?php
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
															"email" : "rentzoin+928@gmail.com",
															"password" : "smFrs6JUAI"				
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
														CURLOPT_CUSTOMREQUEST => 'POST',
														CURLOPT_POSTFIELDS => '{
															"origin" : ' . $_SESSION['seller_pincode'] . ',
															"destination" : ' . $pincode . ',
															"payment_type" : "cod",
															"order_amount" : "50",
															"weight" : "10",	
															"length" : "10",
															"breadth" : "10",
															"height" : "10"
														}',
														CURLOPT_HTTPHEADER => array(
															'Content-Type: application/json',
															'Authorization: token ' . $token . ''
														),
													));
													$response_rate = curl_exec($curl);
													curl_close($curl);
													$response_rate = json_decode($response_rate);
													/*print_r($response_rate);*/
													?>
													<div class="form-group row align-items-center">
														<label for="focusedinput" class="col-4 control-label m-0">Courier Name</label>
														<div class="col-8">
															<select class="form-control" id="curier_company" name="curier_company">
																<option>select Courier</option>
																<?php
																foreach ($response_rate->data as $ship_data) {
																	if ($ship_data->id != '' && $ship_data->id == 179) /*Blue dark */ { ?>
																		<option value="<?php echo $ship_data->id; ?>"><?php echo $ship_data->name.' (Rs.'.$ship_data->freight_charges.')'; ?></option>
																	<?php } else if ($ship_data->id != '' && $ship_data->id == 67) /* Smartr */ { ?>
																		<option value="<?php echo $ship_data->id; ?>"><?php echo $ship_data->name.' (Rs.'.$ship_data->freight_charges.')'; ?></option>
																	<?php } else if ($ship_data->id != '' && $ship_data->id == 17) /* Kerry Indev */ { ?>
																		<option value="<?php echo $ship_data->id; ?>"><?php echo $ship_data->name.' (Rs.'.$ship_data->freight_charges.')'; ?></option>
																	<?php } else if ($ship_data->id != '' && $ship_data->id == 3) /* Xpressbees Air */ { ?>
																		<option value="<?php echo $ship_data->id; ?>"><?php echo $ship_data->name.' (Rs.'.$ship_data->freight_charges.')'; ?></option>
																	<?php } else if ($ship_data->id != '' && $ship_data->id == 79) /* DTDC Air */ { ?>
																		<option value="<?php echo $ship_data->id; ?>"><?php echo $ship_data->name.' (Rs.'.$ship_data->freight_charges.')'; ?></option>
																	<?php } else if ($ship_data->id != '' && $ship_data->id == 10) /* Ecom EXP */ { ?>
																		<option value="<?php echo $ship_data->id; ?>"><?php echo $ship_data->name.' (Rs.'.$ship_data->freight_charges.')'; ?></option>
																	<?php } else if ($ship_data->id != '' && $ship_data->id == 15) /* Ekart */ { ?>
																		<option value="<?php echo $ship_data->id; ?>"><?php echo $ship_data->name.' (Rs.'.$ship_data->freight_charges.')'; ?></option>
																		<?php } else if ($ship_data->id != '' && $ship_data->id == 92) /* Delhivery Air Reverse */ { ?>
																		<option value="<?php echo $ship_data->id; ?>"><?php echo $ship_data->name.' (Rs.'.$ship_data->freight_charges.')'; ?></option>
																	<?php } else if ($ship_data->id != '' && $ship_data->id == 66) /* Amazon Shipping */ { ?>
																		<option value="<?php echo $ship_data->id; ?>"><?php echo $ship_data->name.' (Rs.'.$ship_data->freight_charges.')'; ?></option>
																<?php }
																}
																?>
															</select>
														</div>
													</div>

														<div class="form-group row align-items-center" id="new_pickupdate" style="display:none;">
															<label for="focusedinput" class="col-4 control-label m-0">Pickup Date</label>
															<div class="col-8">
																<input type="date" class="form-control" id="pick_date" name="pick_date" placeholder="">
															</div>
														</div>

														<div class="col-sm-offset-2">
															<button type="submit" class="btn btn-dark" href="javascript:void(0)" id="updatestatus">Order Update</button>
														</div>
													</form>
												</div>
											<?php } else if ($print_label_data != '') { ?>
												<br><br><a class="btn btn-success" href="<?= $print_label_data; ?>"><i class="fa fa-download"></i> Label</a>
											<?php } ?>
											<br>
											<?php
													$status_array = array();
													
													if($order_status == 'Placed')
													{
														$status_array = array('Packed' => 'Packed','Shipped' => 'Shipped','Cancelled' => 'Cancelled','Return Request' => 'Return Request','Returned Completed' => 'Returned Completed','Delivered' => 'Delivered');
													}
													if($order_status == 'Accepted')
													{
														$status_array = array('Packed' => 'Packed','Cancelled' => 'Cancelled');
													}
													else if($order_status == 'Packed')
													{
														$status_array = array('Shipped' => 'Shipped','Cancelled' => 'Cancelled');
													}
													else if($order_status == 'Shipped')
													{
														$status_array = array('Cancelled' => 'Cancelled','Delivered' => 'Delivered','RTO' => 'RTO');
													}
													else if($order_status == 'Cancelled')
													{
														$status_array = array();
													}
													else if($order_status == 'Return Request')
													{
														$status_array = array('Returned Completed' => 'Returned Completed');
													}
													else if($order_status == 'Returned Completed')
													{
														$status_array = array();
													}
													else if($order_status == 'RTO')
													{
														$status_array = array();
													}
													else if($order_status == 'Delivered')
													{
														$status_array = array('Return Request' => 'Return Request','Returned Completed' => 'Returned Completed');
													}
													

											?>
											<?php if ($order_status != 'Placed' || $order_status == 'Rejected' || $order_status == 'Cancelled') : ?> 
												<div class="form-three widget-shadow mt-2 dontprint">
													<strong>Update Status:</strong><br>
													<form class="form-horizontal" method="post" id="myform">

														<div class="form-group row align-items-center">
															<label class="col-4 control-label m-0"> Status*</label>
															<div class="col-8">
																<select class="form-control" id="orderstatus" name="orderstatus" required>
																	<option value="">Select</option>
																	<?php foreach($status_array as $status_key => $status_val)  { ?>
																		<option value="<?php echo $status_key; ?>"><?php echo $status_val; ?></option>
																	<?php } ?>
																	<!--<option value="Packed">Packed</option>
																	<option value="Shipped">Shipped</option>
																	<option value="Cancelled">Cancelled</option>
																	<option value="Return Request">Return Request</option>
																	<option value="Returned Completed">Return Completed</option>
																	<option value="RTO">RTO</option>
																	<option value="Delivered">Delivered</option>-->
																</select>
															</div>
														</div>
														
														

														<div class="form-group row align-items-center">
															<label for="focusedinput" class="col-4 control-label m-0">Message</label>
															<div class="col-8">
																<input type="text" class="form-control" id="ordermessage" name="ordermessage" placeholder="">
															</div>
														</div>
														<div class="col-sm-offset-2">
															<button type="submit" class="btn btn-dark" href="javascript:void(0)" id="updatestatus">Update</button>
														</div>
													</form>
												</div>
											<?php endif; ?>
										</div>
										<!-- /.col -->
										<div class="col-md-6">

											<div class="table-responsive">
												<table class="table table-hover">
													<tbody>
														<tr>
															<th style="width:50%">Total:</th>
															<td><span id="subtotal"><?= ($prod_price * $qty) + ($discount * $qty); ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">Security Deposit:</th>
															<td><span id="subtotal"><?= $security_deposit; ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">Discount:</th>
															<td><span id="subtotal"><?= ($discount * $qty); ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">Coupon Discount:</th>
															<td><span id="subtotal"><?= number_format($coupon_value); ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">Shipping:</th>
															<td><span id="subtotal"><?= ($shipping); ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">GST:</th>
															<td><span id="subtotal"><?= $igst; ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">Subtotal:</th>
															<td><span id="subtotal"><?= $Common_Function->price_formate($conn, ($prod_price * $qty) + $shipping); ?></span></td>
														</tr>


													</tbody>
												</table>
											</div>

											<?php if ($order_status !== 'Placed') { ?>
												<div class="form-three widget-shadow dontprint mb-3">
													<strong>Courier Details</strong> <br>
													<form class="form-horizontal" method="post" id="myform_tracking">
														<div class="form-group row align-items-center">
															<label for="focusedinput" class="col-4 control-label m-0">Delivery Date</label>
															<div class="col-8">
																<input type="text" class="form-control" id="delivery_date" name="delivery_date" placeholder="" value="<?php if($delivery_date != '0000-00-00') { echo $delivery_date; } ?>">
															</div>
														</div>
														<div class="form-group row align-items-center">
															<label for="focusedinput" class="col-4 control-label m-0">Tracking Id</label>
															<div class="col-8">
																<input type="text" class="form-control" id="tracking_id" name="tracking_id" placeholder="" value="<?= $tracking_id ?>">
															</div>
														</div>

														<div class="form-group row align-items-center">
															<label for="focusedinput" class="col-4 control-label m-0">Tracking Url</label>
															<div class="col-8">
																<input type="text" class="form-control" id="tracking_url" name="tracking_url" placeholder="" value="<?= $tracking_url ?>">
															</div>
														</div>
														<div class="col-sm-offset-2">
															<button type="submit" class="btn btn-dark" href="javascript:void(0)" id="updatetracking">Update</button>
														</div>
													</form>
												</div>
											<?php } ?>

											<div class="position-relative" style="width: fit-content;">
												<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#chatModal">
													Talk to customer
												</button>
												<div id="unseen-message-count"></div>
											</div>

											<div class="modal right fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content p-3">
														<div class="modal-header mb-0">
															<div class="d-flex align-items-center">
																<div class="d-flex align-items-center justify-content-center profile-img">
																	<img src="<?= BASEURL . 'assets_web/images/icons/user.svg' ?>" alt="Seller name" srcset="">
																</div>
																<div class="seller-name text-light ml-2 line-clamp-1">Seller Name</div>
															</div>
															<a href="#">
																<img src="<?= BASEURL . 'assets_web/images/icons/add-call.svg' ?>" alt="Call" srcset="">
															</a>
														</div>

														<div class="modal-body px-0" id="messageContainer"></div>

														<div class="modal-footer px-0 pb-0">
															<form action="#" method="post" id="send-message-form" class="m-0 w-100">
																<div class="input-group">
																	<img src="<?= BASEURL . 'assets_web/images/icons/emoji-pen.svg' ?>" class="pl-2" alt="Pen">
																	<input type="text" class="form-control h-100" autocomplete="off" id="message" name="message" value="" placeholder="Enter Message">
																	<button type="submit" class="btn pr-1" id="send-message-btn" disabled>
																		<img src="<?= BASEURL . 'assets_web/images/icons/send-message.svg' ?>" class="pr-2" alt="Send">
																	</button>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-12 dontprint mt-2">
											<div class="form-three widget-shadow">
												<strong>Track Status</strong> <br>
												<table class="table table-hover" style="border: 0.5px solid #ccc;">
													<thead class="thead-light">
														<tr>
															<th>Status</th>
															<th>Date</th>
															<th>Message</th>

														</tr>
													</thead>
													<tbody>
														<?php
														$status_track = $conn->prepare("SELECT `status`, `message`, `created_at` FROM `order_tracking_status` WHERE order_id = '" . $ordersno . "' AND product_id = '" . $product_id . "' ORDER BY id asc ");

														$status_track->execute();
														$datap = $status_track->bind_result($trackst, $trackmag, $tracktime);

														while ($status_track->fetch()) {

														?>
															<tr>
																<td><?= $trackst; ?> </td>
																<td><?= $tracktime; ?> </td>
																<td><?= $trackmag; ?> </td>
															</tr>

														<?php } ?>
													</tbody>
												</table>
											</div>


										</div>
										<!-- /.col -->
									</div>
									<!--- /.row -->
								</div> <!-- print area close-->

								<?php

								/* $curl_handle=curl_init();
									curl_setopt($curl_handle,CURLOPT_URL,'https://api.postalpincode.in/pincode/'.$_SESSION['seller_pincode']);
									curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
									curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
									$buffer = curl_exec($curl_handle);
									curl_close($curl_handle);
										$satte_data = json_decode($buffer);	
										$seller_state_name = $satte_data[0]->PostOffice[0]->State;
										
										$curl_handle0=curl_init();
									curl_setopt($curl_handle0,CURLOPT_URL,'https://api.postalpincode.in/pincode/'.$pincode);
									curl_setopt($curl_handle0,CURLOPT_CONNECTTIMEOUT,2);
									curl_setopt($curl_handle0,CURLOPT_RETURNTRANSFER,1);
									$buffer1 = curl_exec($curl_handle0);
									curl_close($curl_handle0);
									$satte1_data = json_decode($buffer1);	
									$user_state_name = $satte1_data[0]->PostOffice[0]->State; */

								?>

								<button type="submit" style="position: fixed;bottom: 62px;right: 5px;" href="javascript:void(0)" onclick="generate_invoice('<?= $prod_id; ?>','<?= $ordersno; ?>'); " class="btn btn-danger pull-right" style="margin-right: 5px;margin-top: 11px;">
									<i class="fa fa-download"></i> Generate Invoice
								</button>


								<script>
									function generate_invoice(prod_id, ordersno) {
										location.href = 'generate_invoice.php?orderid=' + ordersno + '&product_id=' + prod_id;
									}
								</script>
								<!-- this row will not appear when printing -->
								<div class="row no-print">
									<div class="col-xs-8">





									</div>


									<div class="col-xs-4">




									</div>
								</div></br></br>
								<center>
									<p id="test1" style="color:green;"></p>
								</center>


								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="clearfix"> </div>

			<div class="col_1">

				<div class="clearfix"> </div>

			</div>

		</div>
	</div>
</div>
<!--footer-->
<?php include('footernew.php'); ?>
<!--//footer-->

<script src="<?= BASEURL . 'vendor/js/admin/edit-order.js' ?>"></script>

<script>
	$(function() {
		/* $("#delivery_date1").datepicker({
			dateFormat: "yy-mm-dd"
		}); */

		$('#delivery_date1').flatpickr({
			weekStart: 0,
			time: false,
		});
	});


	$('#new_orderstatus').change(function() {
		if ($(this).val() == 'Accepted') {
			$('#new_pickupdate').show();
			$('#curier_name').show();
			$('#curier_company').show();
		} else {
			$('#new_pickupdate').hide();
			$('#curier_name').hide();
			$('#curier_company').hide();
		}



	});


	$(document).ready(function() {
		$("#updatetracking").click(function(event) {
			event.preventDefault();
			var delivery_date = $("#delivery_date").val();

			if (!delivery_date) {
				successmsg("Please select delivery date.");
			} else {
				$("#myform_tracking").submit();
			}
		});


		$("#updatepickup").click(function(event) {
			event.preventDefault();
			var delivery_date1 = $("#delivery_date1").val();
			var pickup_status = $("#pickup_status").val();

			if (!delivery_date1) {
				successmsg("Please select pickup date.");
			} else if (!pickup_status) {
				successmsg("Please select pickup status.");
			} else {
				$("#myform_tracking").submit();
			}
		});
	});

	function refreshdata() {
		var order_id = $('#sno_order').val();

		//  alert("--"+order_id); 
		$.ajax({
			method: 'POST',
			url: 'edit_order_data.php',
			data: {
				code: "123",
				orderid: order_id
			},
			success: function(response) {
				//  alert(response); // display response from the PHP script, if any
				//$('#msgdiv').val("subsdfa");
				var data = $.parseJSON(response);

				if (data["status"] == "1") {
					// alert("status "+data["deliveryid"]);
					$('#orderidvalue').html(data["orderId"]);
					$('#orderdate').html(data["orderdate"]);
					$('#custname').html(data["username"]);
					$('#custphonevalue').html(data["phone"]);
					$('#custemailvalue').html(data["email"]);
					$('#shipping').html(data["address"]);
					$('#orderstatus').html(data["orderstatus"]);
					$('#deliverymode').html(data["deliverymode"]);
					$('#paymentid').html(data["paymentid"]);
					$('#subtotal').html(data["subtotal"]);
					$('#ship').html(data["ship"]);
					$('#grandtotal').html(data["grandtotal"]);
					$('#deliveryid').html(data["deliveryid"]);
					$('#couriername').val(data["courier"]);
					$('#trackingid').val(data["trackid"]);
					$('#coupancode').html(data["coupancode"]);


					// add prod details
					$("#tbodyPostid").empty();
					var count = 1;
					$(data["proddetails"]).each(function() {
						var btnstatus = '<button type = "button" class = "btn-alert">View</button>';

						//	alert( "btn "+this.prodid);
						$("#tbodyPostid").append('<tr> <th style="display:none;"><input type="text" class="nrprodid" style="width:30px;" value="' + this.prodid + '"></input></th><th scope="row">' + count + '</th><td style="display:none;"><img   src=' + this.img + ' style="width: 121px; height: 72px;"></td><td class="dontprint">' + this.sellername + '</td><td>' + this.prodname + '</td> <td> ' + this.otherart + '</td><td >' + this.price + '</td><td class="nrqtyorg">' + this.orgqty + '</td><td>' + this.cgst + '</td><td>' + this.sgst + '</td><td style="display:none;">' + this.ship + '</td><td>' + this.total + '</td><td style="color:red">' + this.prodstatus + '</td><td class="dontprint">' + btnstatus + '</td></tr> ');
						//	alert(this.orgqty);

						count = count + 1
					});

					$(".btn-alert").click(function() {
						var $row = $(this).closest("tr"); // Find the row
						var $text = $row.find(".nrprodid").val(); // Find the text
						viewProduct($text, "20");
						// alert("prod ID "+$text); 


					});


				} else {


				}


			}
		});
	}

	$('#delivery_date').flatpickr({
		weekStart: 0,
		minDate: "today",
	});
</script>