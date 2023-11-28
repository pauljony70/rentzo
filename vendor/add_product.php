<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>
<style>
	.bank-statement-panel {
		border: 1px solid #ced4da;
		border-radius: 5px;
		color: rgba(0, 0, 0, 1);
		margin-bottom: 0px !important;
	}

	.bank-statement-panel h6 {
		padding: 8px;
	}

	table {
		border-collapse: collapse;
		width: 100%;
	}

	.bank-statement-panel td {
		font-size: 14px;
	}

	.bank-statement-panel tr td:nth-child(2) {
		text-align: right;
	}

	td {
		border: noen;
		padding: 8px;
		text-align: left;
	}

	.toggle-btn {
		background-color: #fff;
		border: none;
		color: #fff;
		cursor: pointer;
		font-size: 16px;
		padding: 10px;
		position: relative;
		transition: background-color 0.2s ease-in-out;
	}

	.toggle-btn:hover {
		background-color: #fff;
	}

	.fa-info {
		color: #ccc;
		font-size: 10px;
		border: 1px solid #ccc;
		border-radius: 50%;
		padding: 2px 5px;
	}

	.info-icon {
		background-color: rgba(255, 255, 255, 0.8);
		border-radius: 50%;
		color: #000000;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 12px;
		height: 20px;
		position: absolute;
		right: 10px;
		top: 50%;
		transform: translateY(-50%);
		width: 20px;
		cursor: pointer;
		position: relative;
	}

	.hover-card {
		background-color: #000;
		border: 1px solid #000;
		border-radius: 5px;
		color: #fff;
		display: none;
		font-size: 12px;
		padding: 10px;
		position: absolute;
		bottom: calc(100% + 10px);
		left: 50%;
		transform: translateX(-50%);
		width: 200px;
		z-index: 1;
	}

	.dotted-border {
		border-top: 1px dashed #333;
	}

	.arrow {
		position: absolute;
		bottom: -10px;
		left: calc(50% - 10px);
		width: 0;
		height: 0;
		border-left: 10px solid transparent;
		border-right: 10px solid transparent;
		border-top: 10px solid #000;
	}


	.info-icon:hover .hover-card {
		display: block;
	}

	#total-bank-settlement {
		font-size: 12px;
		font-weight: 600;
	}

	#customer-price-breakdown {
		border-radius: 0.5em;
		margin-bottom: 5px;
	}

	#customer-price-breakdown .panel-body {
		padding: 8px;
		margin-bottom: 0px;
	}

	.fa-arrow-right {
		transition: transform 0.3s ease-in-out;
	}

	#image-viewer {
		max-height: 100px;
	}

	#rendered-image {
		display: block;
		max-width: 100%;
		max-height: 100px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
		border-radius: 4px;
	}

	#myUL,
	.subList {
		list-style-type: none;
	}

	.mainList {
		font-weight: 400;
	}
</style>


<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">

			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Add Product</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center mb-lg-3">
								<button type="button" onclick="back_page('manage_product.php')" id="back_btn" class="btn btn-danger waves-effect waves-light"><i class="fa fa-arrow-left"></i> Back</button>

								<h4 class="ml-3"><b>Add New Product :</b></h4>
							</div>

							<div class="form-three widget-shadow mt-2">
								<form class="form-horizontal" id="myform" action="add_product_process.php" method="post" enctype="multipart/form-data">
									<div class="form-group row align-items-center">
										<input type="hidden" name="code" value="<?php echo $code_ajax; ?>" />
										<input type="hidden" name="select_cat_id" id="select_cat_id" />
										<a> <span class="text-danger">&#42;&#42;</span> required field</a>
									</div>

									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Attribute Set<span class="text-danger">&#42;&#42;</span> </label>
										<div class="col-sm-8">
											<select class="form-control" id="selectattrset" name="selectattrset">
											</select>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-2 control-label mt-1">Category Set<span class="text-danger">&#42;&#42;</span> </label>
										<div id="example1" class="col-sm-8">
											<input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

											<div id="treeSelect">
												<ul id="myUL" class="pt-2">
													<?php

													$query = $conn->query("SELECT * FROM category WHERE parent_id = '0'  AND status ='1' ORDER BY cat_name ASC");

													if ($query->num_rows > 0) {
														while ($row = $query->fetch_assoc()) {
															//echo "SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' ";
															$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "'  AND status ='1'");
															//	print_r($query1);
															if ($query1->num_rows > 0) {
																echo '<li><span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><label style="font-weight:bold" class="mainList ml-1">' . $row['cat_name'] . '</label></li>
																			 
																			<ul id="ul' . $row['cat_id'] . '" class="subList" style="display:block;">';
																echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
																echo	'</ul>';
															} else {
																echo '<li><span class="expand"><input type="checkbox" name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this,' . $row['cat_id'] . ');"></span><label class="mainList ml-1"> ' . $row['cat_name'] . '</label></li>';
															}
														}
													}

													function categoryTree($parent_id, $sub_mark = '')
													{
														global $conn;
														$query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id  AND status ='1' ORDER BY cat_name ASC");

														if ($query->num_rows > 0) {
															while ($row = $query->fetch_assoc()) {

																$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "'  AND status ='1'");
																//	print_r($query1);
																if ($query1->num_rows > 0) {
																	echo '<li><span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><label    style="font-weight:bold" class="mainList ml-1">' . $row['cat_name'] . '</label></li>
																			 
																			<ul id="ul' . $row['cat_id'] . '" class="subList" style="display:block;">';
																	echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
																	echo '</ul>';
																} else {
																	echo '<li><input type="checkbox" name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this,' . $row['cat_id'] . ');"> <label class="mainList ml-1"> ' . $row['cat_name'] . '</label></li>';
																}
															}
														}
													}





													?>
												</ul>
											</div>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Name <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="prod_name" name="prod_name" placeholder="Name" required>
										</div>
									</div>
									<!--<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Arabic Name <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="prod_name_ar" name="prod_name_ar" placeholder="Name" required>
										</div>
									</div>-->
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">SKU</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="prod_sku" name="prod_sku" placeholder="SKU auto generate">
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">URL key</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="prod_url" name="prod_url" placeholder="URL auto generate">
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Short details <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<textarea rows="6" cols="65" id="prod_short" class="form-control" name="prod_short" required placeholder="Miximum 300 letters"></textarea>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Full Details <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<textarea rows="6" cols="65" id="editor" name="prod_details" required placeholder="Miximum 1000 letters"></textarea>
										</div>
									</div>
									
									<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Usage Instructions </label>
											<div class="col-sm-8">
												<textarea class="form-control" rows="6" cols="65" id="usage_info" name="usage_info" placeholder="Miximum 1000 letters"></textarea>
											</div>
										</div>
										
									<!--<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label">Product Short details (Arabic) <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<textarea rows="6" cols="65" id="prod_short_ar" name="prod_short_ar" placeholder="Short description 300 letter" required maxlength="50"></textarea>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label">Product Full Details (Arabic) <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<textarea rows="6" cols="65" id="editor_ar" name="prod_details_ar" required placeholder="Miximum 1000 letters"></textarea>
										</div>
									</div>-->
									<div id="product_info"></div>
									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">TAX Class </label>
										<div class="col-sm-8">
											<select class="form-control" id="selecttaxclass" name="selecttaxclass">

											</select>
										</div>
									</div>
									<!--<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0"></label>
										<div class="col-sm-8">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" name="wholesale_product" id="wholesale_product">
												<label class="form-check-label" for="wholesale_product">
													This product will be available for wholesale
												</label>
											</div>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0"></label>
										<div class="col-sm-8">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" name="is_usd_price" id="is_usd_price">
												<label class="form-check-label" for="is_usd_price">
													The price of this product will be shown in USD
												</label>
											</div>
										</div>
									</div>-->
									
									<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Is this product available for buy</label>
											<div class="col-sm-8">
												<input type="checkbox" id="is_buy" value='1' name="is_buy">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">1/Day Price (<?= $currency ?>)</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="day1_price" name="day1_price" maxlength="7" placeholder="1/Day Price ex. 214">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">3/Day Price (<?= $currency ?>)</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="day3_price" name="day3_price" maxlength="7" placeholder="3/Day Price ex. 214">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">5/Day Price (<?= $currency ?>)</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="day5_price" name="day5_price" maxlength="7" placeholder="5/Day Price ex. 214">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">7/Day Price (<?= $currency ?>)</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="day7_price" name="day7_price" maxlength="7" placeholder="7/Day Price ex. 214">
											</div>
										</div>
									<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Security deposit (<?= $currency ?>)</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="security_deposit" name="security_deposit" maxlength="7" placeholder="Security deposit ex. 214">
											</div>
										</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">MRP (<?= $currency ?>)</label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="prod_mrp" name="prod_mrp" maxlength="7" placeholder="MRP ex. 214">
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Seller Price (<?= $currency ?>) <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="seller_price" name="seller_price" maxlength="7" placeholder="Sale Price ex. 208" value="" required>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Display Price (<?= $currency ?>) <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="prod_price" readonly name="prod_price" maxlength="7" placeholder="" required>
										</div>	
									</div>
									<div class="form-group row align-items-center d-none">
										<label for="focusedinput" class="col-sm-2 control-label m-0">MRP ($)</label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="prod_mrp_usd" disabled name="prod_mrp_usd" maxlength="7" placeholder="">
										</div>
									</div>
									<div class="form-group row align-items-center d-none">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Seller Price ($) </label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="seller_price_usd" disabled name="seller_price_usd" maxlength="7" placeholder="">
										</div>
									</div>
									<div class="form-group row align-items-center d-none">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Display Price ($) </label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="prod_price_usd" disabled name="prod_price_usd" maxlength="7" placeholder="">
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label"></label>
										<div class="col-sm-8">
											<div class="panel panel-default bank-statement-panel">
												<div class="panel-body">
													<h6><strong>Bank Settlement Breakdown</strong></h6>
													<table style="border: none;">
														<tbody>
															<tr>
																<td>Seller Price</td>
																<td id="marurang_price"></td>
															</tr>
															<tr>
																<td>Commision fee</td>
																<td id="commision_fee"></td>
															</tr>
															<tr>
																<td id="toggle-table" style="cursor: pointer;">
																	Tax (GST, TCS, TDS)
																	<i class="fa fa-arrow-right" aria-hidden="true"></i>
																</td>
																<td id="total-tax"></td>
															</tr>
															<tr class="price-table-breakdown" style="display: none;">
																<td>
																	GST
																	<a class="toggle-btn">
																		<span class="info-icon">
																			<i class="fa fa-info" aria-hidden="true"></i>
																			<span class="hover-card">
																				<span class="arrow"></span>
																				This is the breakdown of the prices.
																			</span>
																		</span>
																	</a>
																</td>
																<td id="gst"></td>
															</tr>
															<tr class="price-table-breakdown" style="display: none;">
																<td>
																	TCS
																	<a class="toggle-btn">
																		<span class="info-icon">
																			<i class="fa fa-info" aria-hidden="true"></i>
																			<span class="hover-card">
																				<span class="arrow"></span>
																				This is the breakdown of the prices.
																			</span>
																		</span>
																	</a>
																</td>
																<td id="tcs"></td>
															</tr>
															<tr class="price-table-breakdown" style="display: none;">
																<td>
																	TDS
																	<a class="toggle-btn">
																		<span class="info-icon">
																			<i class="fa fa-info" aria-hidden="true"></i>
																			<span class="hover-card">
																				<span class="arrow"></span>
																				This is the breakdown of the prices.
																			</span>
																		</span>
																	</a>
																</td>
																<td id="tds"></td>
															</tr>
														</tbody>
													</table>
													<div class="dotted-border"></div>
													<table style="border: none;">
														<tbody>
															<tr>
																<td>Bank Settlement Amount</td>
																<td id="total-bank-settlement"></td>
															</tr>
														</tbody>
													</table>
													<!-- <div class="panel panel-default" id="customer-price-breakdown">
														<div class="panel-body row" style="display: flex; align-items: center; height: 100%">
															<div class="col-md-4" style="background-image:url(https://www.marurang.in//media/2023-03-11/rajasthani-lehanga-12013345519-430-590.jpeg); height: 120px; width:90px; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 0.5rem;">
															</div>
															<div class="col-md-8">
																<p class="text-muted" style="font-size: 12px;">Marurang Price ₹8999</p>
																<p class="text-muted" style="font-size: 12px;">Shipping (added separately) ₹136</p>
																<h5>₹9135</h5>
															</div>
														</div>
													</div> -->
													<div class="text-muted px-1 pb-2" style="font-size: 10px;">
														Bank settlement amount may vary slightly based on the quantity in the order, Meesho commission policy at the time of the order and the actual weight of the product as calculated by our third party delivery partner.
														<br>
														Customer price on app may vary based on the shipping address and the actual weight of the product as calculated by our third party delivery partner.
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0"></label>
										<div class="col-sm-8">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" name="is_affiliate_product" id="is_affiliate_product">
												<label class="form-check-label" for="is_affiliate_product">
													This product will be available for affiliate marketing
												</label>
											</div>
										</div>
									</div>-->
									<div class="form-group row align-items-center d-none">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Affiliate Commission (%) <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="affiliate_commission" name="affiliate_commission" placeholder="Affiliate Commission" required>
										</div>
									</div>
									<!-- <div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Coupon Code </label>
										<div class="col-sm-8">
											<select class="form-control" id="coupon_code" name="coupon_code">
												<option value="">Select Coupon</option>
												<?php $query = $conn->query("SELECT * FROM coupancode_vendor WHERE  activate ='active' and  vendor_id = '" . $_SESSION['admin'] . "' ORDER BY sno ASC");
												if ($query->num_rows > 0) {
													while ($row = $query->fetch_assoc()) { ?>
														<option value="<?php echo $row['sno']; ?>"><?php echo $row['name']; ?></option>
												<?php }
												}																											?>
											</select>
										</div>
									</div> -->
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Quantity</label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="prod_qty" name="prod_qty" placeholder="stock quantity">
											<!--<button type="submit" return false;" class="btn btn-sm btn-warning"  style="float:left; display: inline-block; margin-right:20px;" >Advanced Inventory</button>-->

										</div>
									</div>
									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Stock Status</label>
										<div class="col-sm-8">

											<select class="form-control" id="selectstock" name="selectstock">
												<option value="In Stock">In Stock</option>
												<option value="Out of Stock">Out of Stock</option>

											</select>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Visibility</label>
										<div class="col-sm-8">

											<select class="form-control" id="selectvisibility" name="selectvisibility">
											</select>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Country of Manufacture </label>
										<div class="col-sm-8">
											<select class="form-control" id="selectcountry" name="selectcountry">

											</select>
										</div>
									</div>


									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">HSN Code </label>
										<div class="col-sm-8">
											<select class="form-control" id="prod_hsn" name="prod_hsn">
											</select>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Weight(GM) </label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="prod_weight" name="prod_weight" placeholder="Product Weight">
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Purchase Limit for Customer</label>

										<div class="col-sm-8">
											<input type="number" class="form-control" id="prod_purchase_lmt" name="prod_purchase_lmt" maxlength="3">

										</div>
									</div>
									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Select Brand <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<select class="form-control" id="selectbrand" name="selectbrand">
											</select>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Select Return Policy</label>
										<div class="col-sm-8">
											<select class="form-control" id="return_policy" name="return_policy">
											</select>
										</div>
									</div>
									<!--<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Heavy Product</label>
										<div class="col-sm-8">
											<input type="checkbox" id="is_heavy" value='1' name="is_heavy">
										</div>
									</div>-->
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label mt-1">Configurations </label>
										<div class="col-sm-8">
											<button type="button" onclick="check_product();" class="btn btn-hover btn-dark">Add Product Details</button>
											<br><br>

											<a>Configurable products allow customers to choose options (Ex: shirt color). You need to create a simple product for each configuration (Ex: a product for each color).</a>

										</div>
									</div>
									<div class="form-group row align-items-center mb-0">
										<label for="focusedinput" class="col-sm-2 control-label mt-1"> </label>
										<div class="col-sm-8">
											<div id="skip_pric" style="display:none;">
												<input type="checkbox" name="skip_sale_price" id="skip_sale_price" value="1">
												<span>Apply single price to all SKUs</span>
											</div>
											<div id="configurations_div_html" class="table-responsive">

											</div>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Remarks</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="prod_remark" name="prod_remark" placeholder="200 sold in 3 hours">
										</div>
									</div>

									<div class="form-group row">
										<label for="exampleInputFile" class="col-sm-2 control-label mt-1">Featured Images <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="file" name="featured_img" id="featured_img" onchange="uploadFile1('featured_img')" class="form-control-file" required>
											<div id="image-viewer"></div>
										</div>
									</div>
									<div class="form-group row">
										<label for="exampleInputFile" class="col-sm-2 control-label mt-1">Product Images</label>
										<div class="col-sm-8 input-files">
											<button type="button" class="btn btn-hover btn-dark" id="moreImg"><i class="fa-solid fa-circle-plus"></i> Add More Image</button>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Upload Video</label>
										<div class="col-sm-8">
											<input type="file" name="prod_youtubeid" id="prod_youtubeid" class="form-control-file">
										</div>
									</div>
									
									<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">City</label>
											<div id="example2" class="col-sm-8">
												<select class="form-control related_prod" id="selectcity" name="selectcity[]" multiple>
												</select>
											</div>
										</div>

									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Related Product multi select</label>
										<div id="example2" class="col-sm-8">
											<select class="form-control related_prod" id="selectrelatedprod" name="selectrelatedprod[]" multiple>
											</select>

											<a>Related products are shown to customers in addition to the item the customer is looking at.</a>
											<br>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Up-Sell Products</label>
										<div id="example1" class="col-sm-8">
											<select class="form-control related_prod" id="selectupsell" name="selectupsell[]" multiple>
											</select>

											<a>An up-sell item is offered to the customer as a pricier or higher-quality alternative to the product the customer is looking at.</a>
											<br>
										</div>
									</div>

									<div class="col-sm-offset-2">
										<button type="submit" class="btn btn-dark" href="javascript:void(0)" id="addProduct_btn">Save</button>
									</div>


								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="clearfix"> </div>

	</div>





	<div class="clearfix"> </div>

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Configurations</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-2">
				<form class="form-horizontal" id="myform_attr">
					<div class="form-group mb-0">
						<div class="col-sm-12">
							<div class="attributes">
								<table class="table table-sm table-borderless mb-0">
									<tbody id="selectattrs_div"></tbody>
								</table>
								<br>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" id="manage_configurations_btn" onclick=" return manage_configurations();">Add Configurations</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="col_1">


	<div class="clearfix"> </div>

</div>

<?php include("footernew.php"); ?>

<script src="js/admin/add-product.js"></script>
<script>
	var timeout = null;
	var usd_price = 0.00;

	var seller_price = document.getElementById('seller_price');
	var seller_price_usd = document.getElementById('seller_price_usd');
	var prod_mrp = document.getElementById('prod_mrp');
	var prod_mrp_usd = document.getElementById('prod_mrp_usd');
	var prod_price = document.getElementById('prod_price');
	var prod_price_usd = document.getElementById('prod_price_usd');
	var marurang_price = document.getElementById('marurang_price');
	var commision_fee = document.getElementById('commision_fee');
	var totalTax = document.getElementById('total-tax');
	var gst = document.getElementById('gst');
	var tcs = document.getElementById('tcs');
	var tds = document.getElementById('tds');
	var totalBankSettlement = document.getElementById('total-bank-settlement');
	var selecttaxclass = document.getElementById('selecttaxclass');
	
	const toggleBtn = document.querySelector('.toggle-btn');
	const toggleTableBtn = document.getElementById('toggle-table');
	const priceBreakdowns = document.querySelectorAll('.price-table-breakdown');
	const icon = document.querySelector(".fa-arrow-right");

	const infoBtns = document.querySelectorAll('.info-btn');

	
	seller_price.addEventListener('input', async () => {
		seller_price_usd.value = prod_mrp.value;
		calculatePrice();
	});

	
	selecttaxclass.addEventListener('change', () => {
		if (seller_price.value !== '')
			calculatePrice();
	});

	const calculatePrice = () => {
		clearTimeout(timeout);

		timeout = setTimeout(function() {
			$.ajax({
				method: "post",
				url: "get_price_calculation.php",
				data: {
					seller_price: seller_price.value
				},
			}).done(async function(response) {
				$('#prod_price').val(parseFloat(response.replace(/,/g, '')));
				prod_price_usd.value = response;
				var taxValue = document.getElementById('selecttaxclass').options[document.getElementById('selecttaxclass').selectedIndex].text.match(/\d+/)[0];

				if (seller_price.value === '') {
					marurang_price.innerText = "";
					commision_fee.innerText = "";
				} else {
					marurang_price.innerText = String(seller_price.value) + " <?= $currency ?>";
					var commision_fee_value = parseFloat(parseFloat(response.replace(/,/g, ''))) - parseFloat(seller_price.value);
					var taxableValue = 0;
					var gstValue = commision_fee_value * 0.5;
					var tcsAndTcsVal = parseFloat(taxableValue) * 0.01;
					commision_fee.innerText = String(commision_fee_value.toFixed(2)) + " <?= $currency ?>";
					totalTax.innerText = String((gstValue).toFixed(2)) + " <?= $currency ?>";
					gst.innerText = String(gstValue.toFixed(2)) + " <?= $currency ?>";
					tcs.innerText = String(tcsAndTcsVal.toFixed(2)) + " <?= $currency ?>";
					tds.innerText = String(tcsAndTcsVal.toFixed(2)) + " <?= $currency ?>";
					totalBankSettlement.innerText = String((seller_price.value - (commision_fee_value + gstValue)).toFixed(2)) + " <?= $currency ?>";
				}
			});

		}, 500);
	}

	infoBtns.forEach(infoBtn => {
		const infoTooltip = document.createElement('div');
		infoTooltip.classList.add('info-tooltip');
		infoTooltip.textContent = infoBtn.dataset.info;
		infoBtn.parentElement.appendChild(infoTooltip);
	});

	toggleTableBtn.addEventListener('click', () => {
		console.log(priceBreakdowns);
		for (let index = 0; index < priceBreakdowns.length; index++) {
			const element = priceBreakdowns[index];
			if (element.style.display === 'none') {
				element.style.display = '';
				icon.style.transform = "rotate(90deg)";
				totalTax.style.display = 'none';
			} else {
				element.style.display = 'none';
				icon.style.transform = "rotate(-0deg)";
				totalTax.style.display = '';
			}
		}
	});

	const reader = new FileReader();

	document.addEventListener("change", function(e) {
		if (e.target.tagName.toLowerCase() === 'input' && e.target.type === 'file') {
			var file = event.target.files[0];
			var parent = e.target.parentElement;
			var imgViewer = parent.querySelector('#image-viewer');

			reader.onload = function(event) {
				imgViewer.style.cssText = "margin-top: 10px;"
				imgViewer.innerHTML = `<img id="rendered-image" src="${event.target.result}" style="margin-right:20px;">`;
			};

			reader.readAsDataURL(file);
		}

	})
</script>