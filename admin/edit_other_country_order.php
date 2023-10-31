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
$stmt = $conn->prepare("SELECT o.order_id,o.user_id,op.status, op.prod_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date,
							op.discount,o.total_qty, o.fullname, o.mobile,o.locality, o.fulladdress,o.city,o.state,o.pincode,o.addresstype,o.email,op.coupon_value,op.coupon_code, buy_from FROM orders o, order_product op WHERE op.order_id = o.order_id and o.order_id = '" . $ordersno . "' ");


$stmt->execute();
$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15, $col16, $col17, $col18, $col19, $col20, $col21, $col22, $buy_from);

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
	$locality =  $col14;
	$fulladdress =  $col15;
	$city =  $col16;
	$state =  $col17;
	$pincode =  $col18;
	$addresstype =  $col19;
	$email =  $col20;
	$coupon_value =  $col21;
	$coupon_code =  $col22;
	$buy_from =  $buy_from;
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

if (isset($_POST['orderstatus'])) {
	$orderstatus = trim($_POST['orderstatus']);
	$expected_delivery_date = trim($_POST['expected_delivery_date']);
	if (!empty($expected_delivery_date)) {
		$sql_new = $conn->prepare("UPDATE order_product SET status = ?, delivery_date = ?, update_date = ? WHERE order_id = ?");
		$sql_new->bind_param("ssss", $orderstatus, $expected_delivery_date, $datetime, $ordersno);
	} else {
		$sql_new = $conn->prepare("UPDATE order_product SET status = ?, update_date = ? WHERE order_id = ?");
		$sql_new->bind_param("sss", $orderstatus, $datetime, $ordersno);
	}
	$sql_new->execute();
	$sql_new->store_result();

	echo '<script>successmsg1("Order updated successfully.", "edit_other_country_order.php?orderid=' . $ordersno . '"); </script> ';

?>
<?php
}

if (isset($_POST['tracking_id']) && $ordersno) {
	$tracking_id = trim($_POST['tracking_id']);
	$tracking_url = trim($_POST['tracking_url']);

	$sql1 = $conn->prepare("UPDATE order_product SET tracking_id = '" . $tracking_id . "', tracking_url = '" . $tracking_url . "', update_date = '" . $datetime . "' WHERE order_id = '" . $ordersno . "'");
	$sql1->execute();
	$sql1->store_result();

	echo '<script>successmsg1("Tracking details updated successfully.", "edit_other_country_order.php?orderid=' . $ordersno . '"); </script> ';
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
														<th> Buy From </th>
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
														<?= $fullname . '<br>' . $mobile . ', ' . $email;
														echo '<br>Landmark - ' . $locality . ',<br>' . $fulladdress . ',<br>' . $city . ', ' . $state . ', ' . $pincode . '(' . $addresstype . ')';
														?>
													</td>
													<td>
														<?= $buy_from; ?>
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
														<th>Attribute</th>
														<th>Price</th>
														<th>Qty</th>
														<!--<th>Ship</th>-->
														<th>Status</th>
													</tr>
												</thead>
												<tbody id="tbodyPostid">
													<?php
													$stmtp = $conn->prepare("SELECT op.prod_id,op.prod_sku,op.prod_name,op.prod_img,op.prod_attr,op.qty,op.prod_price,op.shipping,op.discount,op.status, op.cgst,op.sgst,op.igst,op.pickup_date,op.delivery_date,op.invoice_number,op.pickup_type,op.p_weight,op.p_length,op.p_width,op.p_height,product_size, product_color, tracking_id, tracking_url FROM `order_product` op, buy_from_another_country_requests WHERE `buy_from_another_country_requests`.`order_id` = op.`order_id` AND op.order_id = '" . $ordersno . "'");

													$stmtp->execute();
													$datap = $stmtp->bind_result($prod_id, $prod_sku, $prod_name, $prod_img, $prod_attr, $qty, $prod_price, $shipping, $discount1, $status, $cgst, $sgst, $igst, $pickup_date, $delivery_date, $invoice_number, $pickup_type, $p_weight, $p_length, $p_width, $p_height, $product_size, $product_color, $tracking_id, $tracking_url);
													$prod_id1 = $prod_sku1 = $prod_name1 = $prod_img1 = $prod_attr1 = $qty1 = $prod_price1 = $shipping1 = $discount1 = $status1 = $seller = $seller_id = $seller_pincode = $pickup_date = $seller_name = $seller_address = $seller_city_name =  $seller_state_name = $seller_phone = $invoice_number = $pickup_type = $p_weight = $p_length = $p_width = $p_height = '';
													$cgst = $sgst = $igst = $product_size = $product_color = $tracking_id = $tracking_url = 0;
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
														$product_size = $product_size;
														$product_color = $product_color;
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
																Size: <?= $product_size; ?> | Colour: <?= $product_color ?>
															</td>
															<td>
																<?= $prod_price; ?>
															</td>
															<td>
																<?= $qty; ?>
															</td>
															<td>
																<?= $status; ?>
															</td>
														</tr>
													<?php	}

													?>
													<tr> </tr>
												</tbody>
											</table>
										</div>
									</div>
									<!-- /.col -->
									<span id="qty_save"></span>

									<div class="row">
										<!-- accepted payments column -->

										<div class="col-md-6">

											<br>
											<strong>Payment Methods:</strong>
											<br>
											<a style="color:black;"><span id="deliverymode"><?= $payment_mode; ?></span></a>
											<br>
											<br> <strong>Payment TXN ID: </strong>
											<br> <a style="color:black;"><span id="paymentid"><?= $payment_id; ?></span></a>
											<br>
											<?php if ($order_status == 'pending') : ?>
												<div class="form-three widget-shadow dontprint">
													<strong>Order Status:</strong><br>
													<form class="form-horizontal" method="post" id="myform">

														<div class="form-group row align-items-center">
															<label class="col-4 control-label m-0"> Status*</label>
															<div class="col-8">
																<select class="form-control" id="orderstatus" name="orderstatus" required>
																	<option value="">Select</option>
																	<option value="Accepted">Accept</option>
																	<option value="Cancelled">Reject</option>
																</select>
															</div>
														</div>

														<div class="form-group row align-items-center" id="new_deliverydate" style="display:none;">
															<label for="focusedinput" class="col-4 control-label m-0">Expected Delivery Date</label>
															<div class="col-8">
																<input type="date" class="form-control" id="expected_delivery_date" name="expected_delivery_date" placeholder="">
															</div>
														</div>

														<div class="col-sm-offset-2">
															<button type="submit" class="btn btn-dark" href="javascript:void(0)" id="updatestatus">Order Update</button>
														</div>
													</form>
												</div>
											<?php endif; ?>
											<?php if ($order_status == 'Accepted' || $order_status == 'Out for delivery') : ?>
												<div class="form-three widget-shadow dontprint">
													<strong>Order Status:</strong><br>
													<form class="form-horizontal" method="post" id="myform">

														<div class="form-group row align-items-center">
															<label class="col-4 control-label m-0"> Status*</label>
															<div class="col-8">
																<select class="form-control" id="orderstatus" name="orderstatus" required>
																	<option value="">Select</option>
																	<option value="Out for delivery">Out for delivery</option>
																	<option value="Delivered">Delivered</option>
																</select>
															</div>
														</div>

														<div class="col-sm-offset-2">
															<button type="submit" class="btn btn-dark" href="javascript:void(0)" id="updatestatus">Order Update</button>
														</div>
													</form>
												</div>
											<?php endif; ?>
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
														<tr>
															<th style="width:50%">VAT:</th>
															<td><span id="subtotal"><?= $igst; ?></span></td>
														</tr>
														<tr>
															<th style="width:50%">Subtotal:</th>
															<?php $subtotal = $total_price + $shipping + $igst; ?>
															<td><span id="subtotal"><?= $Common_Function->price_format($subtotal, $conn) ?></span></td>
														</tr>
													</tbody>
												</table>
											</div>

											<?php if ($order_status !== 'pending') { ?>
												<div class="form-three widget-shadow dontprint mb-3">
													<strong>Courier Details</strong> <br>
													<form class="form-horizontal" method="post" id="myform_tracking">
														<div class="form-group row align-items-center">
															<label for="focusedinput" class="col-4 control-label m-0">Delivery Date</label>
															<div class="col-8">
																<input type="date" class="form-control" id="expected_delivery_date" name="expected_delivery_date" placeholder="" value="<?= $delivery_date ?>" disabled>
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
										<button type="submit" href="javascript:void(0)" onclick="myPrint('printableArea'); return false;" class="btn btn-danger waves-effect waves-light pull-right" style="    position: fixed; bottom: 62px; right: 5px;"> <i class="fa fa-download"></i> Generate Invoice </button>
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
	$('#orderstatus').change(function() {
		if ($(this).val() == 'Accepted') {
			$('#new_deliverydate').show();
		} else {
			$('#new_deliverydate').hide();
		}
	});

	$('#expected_delivery_date').flatpickr({
		weekStart: 0,
		minDate: "today",
	});
</script>