<?php
include('session.php');


if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

if (!isset($_GET['id'])) {
	header("Location: manage_product.php");
}
$record_exist = 'N';


$prod_unique_id = trim($_GET['id']);

$stmt15 = $conn->prepare("SELECT status, prod_name,prod_type,prod_desc,prod_fulldetail,prod_img_url,featured_img, attr_set_id,brand_id,web_url,
   		product_sku,product_visibility,product_manuf_country,product_hsn_code,product_video_url,return_policy_id ,meta_title,meta_key,meta_value ,is_heavy,
		prod_name_ar,prod_desc_ar ,prod_fulldetail_ar,usage_info,type,day1_price,day3_price,day5_price,day7_price,city
   		FROM product_details pd LEFT JOIN product_meta pm ON pd.product_unique_id = pm.prod_id WHERE pd.product_unique_id='" . $prod_unique_id . "'	");

$stmt15->execute();
$data = $stmt15->bind_result(
	$status,
	$prod_name,
	$prod_type,
	$prod_desc,
	$prod_fulldetail,
	$prod_img_url,
	$featured_img,
	$attr_set_id,
	$brand_id,
	$web_url,
	$product_sku,
	$product_visibility,
	$product_manuf_country,
	$product_hsn_code,
	$product_video_url,
	$return_policy_id,
	$meta_title,
	$meta_key,
	$meta_value,
	$is_heavy,
	$prod_name_ar,
	$prod_desc_ar,
	$prod_fulldetail_ar,
	$usage_info,$type,$day1_price,$day3_price,$day5_price,$day7_price,$city
);

while ($stmt15->fetch()) {
	$record_exist = 'Y';
}


if ($record_exist == 'N') {
	header("Location: manage_product.php");
}

//include header
include("header.php");
?>

<style>
	.subList {
		list-style-type: none;
	}

	.ms-options-wrap>.ms-options {
		width: 96.5% !important;
		border: 1px solid #ced4da !important;
		border-radius: .2rem !important;
	}

	.ms-options-wrap>.ms-options .ms-selectall:hover {
		text-decoration: none !important;
	}

	.ms-options-wrap>button[disabled] {
		background-color: #f3f3f3 !important;
		opacity: 1 !important;
		color: #6c757d !important;
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
						<h4 class="page-title">View Pending Product</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">

							<div class="bs-example widget-shadow" data-example-id="hoverable-table">
								<div class="row align-items-center">
									<div class="col-md-6 mb-2">
										<button id="back_btn" type="submit" class="btn btn-dark waves-effect waves-light" onclick="back_page('pending_products.php');"><i class="fa fa-arrow-left"></i> Back</button>
									</div>
								</div>


								<div class="form-three widget-shadow">
									<form class="form-horizontal" id="myform" action="edit_pending_product_process.php" method="post" enctype="multipart/form-data">
										<input type="hidden" name="code" value="<?php echo $code_ajax; ?>" />
										<?php
										$stmtr = $conn->prepare("SELECT vp.id, vp.is_usd_price, wholesale_product, vp.affiliate_commission, vp.product_mrp,vp.product_sale_price,vp.product_stock, sl.companyname,vp.stock_status,vp.product_tax_class, vp.product_remark, vp.product_purchase_limit FROM vendor_product vp, sellerlogin sl WHERE vp.product_id ='" . $prod_unique_id . "' AND sl.seller_unique_id=vp.vendor_id ORDER BY sl.companyname ASC");

										$stmtr->execute();
										$data = $stmtr->bind_result($vp_id, $is_usd_price, $wholesale_product, $affiliate_commission, $product_mrp, $product_sale_price, $product_stock, $companyname, $stock_status, $product_tax_class, $product_remark, $product_pur_limit);

										while ($stmtr->fetch()) {
										}

										?>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Seller</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_mrp" name="prod_mrp" disabled value="<?php echo $companyname; ?>" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Attribute Set<span class="text-danger">&#42;&#42;</span> </label>
											<div class="col-sm-8">
												<select class="form-control" id="selectattrset" name="selectattrset">
													<?php
													$stmtas = $conn->prepare("SELECT sno, name FROM attribute_set WHERE status ='1' ORDER BY name ASC");
													$stmtas->execute();
													$data = $stmtas->bind_result($col1, $col2);

													while ($stmtas->fetch()) {
														if ($attr_set_id == $col1) {
															echo '<option value="' . $col1 . '" selected>' . $col2 . '</option>';
														} else {
															echo '<option value="' . $col1 . '">' . $col2 . '</option>';
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Category Set<span class="text-danger">&#42;&#42;</span> </label>
											<div id="example1" class="col-sm-8">
												<div id="treeSelect">
													<div class="pt-2 pl-2">
														<?php
														$stmtcs = $conn->prepare("SELECT cat_id	FROM product_category WHERE prod_id= '" . $prod_unique_id . "'");
														$stmtcs->execute();
														$data = $stmtcs->bind_result($cat_id);

														$product_cat = array();
														while ($stmtcs->fetch()) {
															$product_cat[] = $cat_id;
														}

														$query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND status ='1' ORDER BY cat_name ASC");

														if ($query->num_rows > 0) {
															while ($row = $query->fetch_assoc()) {
																//echo "SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' ";
																$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1'");
																//	print_r($query1);
																if ($query1->num_rows > 0) {
																	echo '<span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><span class="mainList"> ' . $row['cat_name'] . '</span>
																<br />    
																<ul id="ul' . $row['cat_id'] . '" class="subList"  style="display:block;">';
																	echo categoryTree($row['cat_id'], $product_cat);
																	echo	'</ul>';
																} else {
																	if (in_array($row['cat_id'], $product_cat)) {
																		echo '<span class="expand"><input type="checkbox" checked name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><span class="mainList"> ' . $row['cat_name'] . '</span><br />';
																	} else {
																		echo '<span class="expand"><input type="checkbox" name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><span class="mainList"> ' . $row['cat_name'] . '</span><br />';
																	}
																}
															}
														}

														function categoryTree($parent_id, $product_cat)
														{
															global $conn;
															$query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id  AND status ='1' ORDER BY cat_name ASC");

															if ($query->num_rows > 0) {
																while ($row = $query->fetch_assoc()) {

																	$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1'");
																	//	print_r($query1);
																	if ($query1->num_rows > 0) {
																		echo '<span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><span class="mainList"> ' . $row['cat_name'] . '</span>
																	<br />    
																	<ul id="ul' . $row['cat_id'] . '" class="subList" style="display:block;">';
																		echo categoryTree($row['cat_id'], $product_cat);
																		echo '</ul>';
																	} else {
																		if (in_array($row['cat_id'], $product_cat)) {
																			echo '<li><input type="checkbox" checked name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> ' . $row['cat_name'] . '</li>';
																		} else {
																			echo '<li><input type="checkbox" name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> ' . $row['cat_name'] . '</li>';
																		}
																	}
																}
															}
														}
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Name <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_name" name="prod_name" value="<?php echo $prod_name; ?>" placeholder="Name" required>
											</div>
										</div>
										<!--<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Name (Arabic) <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_name_ar" name="prod_name_ar" value="<?php // echo $prod_name_ar; ?>" placeholder="Name" required>
											</div>
										</div>-->
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Type</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_type" name="prod_type" disabled value="<?php if ($prod_type == 1) {
																																			echo 'Simple';
																																		} else if ($prod_type == 2) {
																																			echo 'Configurable';
																																		} ?>" placeholder="Name" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">SKU</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_sku" name="prod_sku" value="<?php echo $product_sku; ?>" placeholder="SKU auto generate">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">URL key</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_url" name="prod_url" value="<?php echo $web_url; ?>">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Short details <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<textarea rows="6" cols="65" id="prod_short" name="prod_short" placeholder="Short description 300 letter" required maxlength="50"><?php echo $prod_desc; ?></textarea>

											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Full Details <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<textarea rows="6" cols="65" id="editor" name="prod_details" required placeholder="Miximum 1000 letters"><?php echo $prod_fulldetail; ?></textarea>
											</div>
										</div>
										
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Usage Instructions <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<textarea rows="6" cols="65" id="editor" name="usage_info" required placeholder="Miximum 1000 letters"><?php echo $usage_info; ?></textarea>
											</div>
										</div>
										
										
										<!--<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Short details (Arabic) <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<textarea rows="6" cols="65" id="prod_short_ar" name="prod_short_ar" placeholder="Short description 300 letter" required maxlength="50"><?= $prod_desc_ar; ?></textarea>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Full Details (Arabic) <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<textarea rows="6" cols="65" id="editor_ar" name="prod_details_ar" required placeholder="Miximum 1000 letters"><?=  $prod_fulldetail_ar; ?></textarea>
											</div>
										</div>-->
										<div id="product_info"></div>
										<!--<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0"></label>
											<div class="col-sm-8">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" name="wholesale_product" id="wholesale_product" onclick="return false" <?=  $wholesale_product  === 1 ? 'checked' : '' ?>>
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
													<input class="form-check-input" type="checkbox" value="" name="is_usd_price" id="is_usd_price" onclick="return false" <?=  $is_usd_price === 1 ? 'checked' : '' ?>>
													<label class="form-check-label" for="is_usd_price">
														The price of this product will be shown in USD
													</label>
												</div>
											</div>
										</div>-->
										
										 <div class="form-group row align-items-center">
								<label for="focusedinput" class="col-sm-2 control-label m-0">Type</label>
								<div class="col-sm-8">
									<select class="form-control" id="type" name="type">
										<option>Select Type</option>
										<option <?php if($type == 1) { echo 'selected'; } ?> value="1">Sell</option>
										<option <?php if($type == 2) { echo 'selected'; } ?> value="2">Rent</option>
									</select>
								</div>
							</div>
							<div class="form-group row align-items-center">
								<label for="focusedinput" class="col-sm-2 control-label m-0">1/Day Price (<?= $currency ?>)</label>
								<div class="col-sm-8">
									<input type="number" class="form-control" id="day1_price" name="day1_price" maxlength="7" value="<?php echo $day1_price; ?>" placeholder="1/Day Price ex. 214">
								</div>
							</div>
							<div class="form-group row align-items-center">
								<label for="focusedinput" class="col-sm-2 control-label m-0">3/Day Price (<?= $currency ?>)</label>
								<div class="col-sm-8">
									<input type="number" class="form-control" id="day3_price" name="day3_price" maxlength="7" value="<?php echo $day3_price; ?>" placeholder="3/Day Price ex. 214">
								</div>
							</div>
							<div class="form-group row align-items-center">
								<label for="focusedinput" class="col-sm-2 control-label m-0">5/Day Price (<?= $currency ?>)</label>
								<div class="col-sm-8">
									<input type="number" class="form-control" id="day5_price" name="day5_price" maxlength="7" value="<?php echo $day5_price; ?>" placeholder="5/Day Price ex. 214">
								</div>
							</div>
							<div class="form-group row align-items-center">
								<label for="focusedinput" class="col-sm-2 control-label m-0">7/Day Price (<?= $currency ?>)</label>
								<div class="col-sm-8">
									<input type="number" class="form-control" id="day7_price" name="day7_price" maxlength="7" value="<?php echo $day7_price; ?>" placeholder="7/Day Price ex. 214">
								</div>
							</div>
										
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">MRP <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="prod_mrp" name="prod_mrp" disabled value="<?php echo $product_mrp; ?>" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Sale Price <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="prod_price" name="prod_price" disabled value="<?php echo $product_sale_price; ?>" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">TAX Class </label>
											<div class="col-sm-8">
												<select class="form-control" id="selecttaxclass" disabled name="selecttaxclass">
													<?php
													$stmtt = $conn->prepare("SELECT tax_id, name,percent FROM tax WHERE status ='1' ORDER BY name ASC");
													$stmtt->execute();
													$data = $stmtt->bind_result($idt, $namet, $per);

													while ($stmtt->fetch()) {
														if ($product_tax_class == $idt) {
															echo '<option value="' . $idt . '" selected>' . $namet . '</option>';
														} else {
															echo '<option value="' . $idt . '">' . $namet . '</option>';
														}
													}
													?>
												</select>
											</div>
										</div>
										<!--<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Affiliate Commission (%) <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="affiliate_commission" name="affiliate_commission" placeholder="Affiliate Commission" value="<?=  $affiliate_commission ?>" disabled>
											</div>
										</div>-->
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Quantity</label>
											<div class="col-sm-8">
												<input type="number" class="form-control" id="prod_qty" name="prod_qty" readonly value="<?php echo $product_stock; ?>" <br><br>
												<!--<button type="submit" return false;" class="btn btn-sm btn-warning"  style="float:left; display: inline-block; margin-right:20px;" >Advanced Inventory</button>-->

											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Stock Status</label>
											<div class="col-sm-8">

												<select class="form-control" id="selectstock" disabled name="selectstock">
													<option value="In Stock" <?php if ($stock_status == 'In Stock') {
																					echo 'selected';
																				} ?>>In Stock</option>
													<option value="Out of Stock" <?php if ($stock_status == 'Out of Stock') {
																						echo 'selected';
																					} ?>>Out of Stock</option>

												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Visibility</label>
											<div class="col-sm-8">
												<select class="form-control" id="selectvisibility" name="selectvisibility">
													<option value="">Select</option>
													<?php
													$stmtv = $conn->prepare("SELECT id, name FROM visibility ORDER BY id ASC");
													$stmtv->execute();
													$data = $stmtv->bind_result($idv, $namev);

													while ($stmtv->fetch()) {
														if ($product_visibility == $idv) {
															echo '<option value="' . $idv . '" selected>' . $namev . '</option>';
														} else {
															echo '<option value="' . $idv . '">' . $namev . '</option>';
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Country of Manufacture </label>
											<div class="col-sm-8">
												<select class="form-control" id="selectcountry" name="selectcountry">
													<option value="">Select</option>
													<?php
													$stmtc = $conn->prepare("SELECT id, name, countrycode FROM country ORDER BY name ASC");
													$stmtc->execute();
													$data = $stmtc->bind_result($idc, $namec, $countrycode);
													$return = array();
													$i = 0;
													while ($stmtc->fetch()) {
														if ($product_manuf_country == $idc) {
															echo '<option value="' . $idc . '" selected>(' . $countrycode . ')' . $namec . '</option>';
														} else {
															echo '<option value="' . $idc . '">(' . $countrycode . ')' . $namec . '</option>';
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">HSN Code </label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_hsn" name="prod_hsn" value="<?php echo $product_hsn_code; ?>" placeholder="Product HSN code">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Purchase Limit for Customer </label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="purchase_limit" name="purchase_limit" readonly value="<?php echo $product_pur_limit; ?>" placeholder="Product Purchase limit">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select Brand <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<select class="form-control" id="selectbrand" name="selectbrand">
													<?php
													$stmtb = $conn->prepare("SELECT brand_id, brand_name FROM brand WHERE status ='1' ORDER BY brand_order ASC");

													$stmtb->execute();
													$data = $stmtb->bind_result($brand_id1, $brand_name);

													while ($stmtb->fetch()) {
														if ($brand_id == $brand_id1) {
															echo '<option value="' . $brand_id1 . '" selected>' . $brand_name . '</option>';
														} else {
															echo '<option value="' . $brand_id1 . '">' . $brand_name . '</option>';
														}
													}

													?>
												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select Return Policy</label>
											<div class="col-sm-8">
												<select class="form-control" id="return_policy" name="return_policy">
													<option value="">Select</option>
													<?php
													$stmtr = $conn->prepare("SELECT id, title FROM product_return_policy WHERE status ='1' ORDER BY title ASC");

													$stmtr->execute();
													$data = $stmtr->bind_result($idr, $titler);

													while ($stmtr->fetch()) {
														if ($return_policy_id == $idr) {
															echo '<option value="' . $idr . '" selected>' . $titler . '</option>';
														} else {
															echo '<option value="' . $idr . '">' . $titler . '</option>';
														}
													}

													?>
												</select>
											</div>
										</div>
										<?php

										$stmtcp = $conn->query("SELECT product_sku,price, mrp ,stock FROM product_attribute_value WHERE product_id = '" . $prod_unique_id . "' AND vendor_prod_id ='" . $vp_id . "'");

										//$stmtcp->execute();	

										//$data = $stmtcp->bind_result($product_sku, $prices, $mrps,$stocks);

										if ($stmtcp->num_rows > 0) {

										?>
											<div class="form-group row align-items-center">
												<label for="focusedinput" class="col-sm-2 control-label m-0">Configurations</label>
												<div class="col-sm-8">
													<div id="configurations_div_html" style="background-color: #dad9d9;">
														<table class="table table-bordered">
															<thead>
																<tr>
																	<th>Product Name</th>
																	<th>Product SKU</th>
																	<th>Sale Price</th>
																	<th>MRP </th>
																	<th>STOCK </th>
																</tr>
															</thead>
															<tbody>
																<?php

																while ($rows = $stmtcp->fetch_assoc()) {
																	$product_sku = $rows['product_sku'];
																	$prices = $rows['price'];
																	$mrps = $rows['mrp'];
																	$stocks = $rows['stock'];

																?>
																	<tr id="remove_attr_tr1">
																		<td><?php echo $product_sku; ?></td>
																		<td><input type="text" name="prod_skus[]" readonly="" value="<?php echo $product_sku; ?>"></td>
																		<td><input type="number" name="sale_price[]" class="sale_prices" value="<?php echo $prices; ?>" style="width: 100%;"></td>
																		<td><input type="number" name="mrp_price[]" class="mrp_price" value="<?php echo $mrps; ?>" style="width: 100%;"></td>
																		<td><input type="number" name="stocks[]" value="<?php echo $stocks; ?>" style="width: 100%;"></td>

																	</tr>

																<?php } ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										<?php } ?>
										<!--<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Heavy Product</label>
											<div class="col-sm-8">
												<input type="checkbox" id="is_heavy" value='1' <?php  if ($is_heavy == 1) {
																									echo "checked";
																								} ?> name="is_heavy">
											</div>
										</div>-->
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Remarks</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_remark" readonly name="prod_remark" value="<?php echo $product_remark; ?>">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Featured Images</label>
											<div class="col-sm-8">

												<div class="d-flex flex-wrap mt-3">
													<div class="thumbnail">
														<div class="image view view-first">
															<?php
															$featured_decod =  json_decode($featured_img);

															$img = MEDIAURL . $featured_decod->{$img_dimension_arr[2][0] . '-' . $img_dimension_arr[2][1]};
															?>
															<img height="75" style="display: block;" src="<?= $img; ?>" alt="" />
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Product Images</label>
											<div class="col-sm-8 input-files">
												<div class="d-flex flex-wrap mt-1">
													<?php
													$prod_img_decode =  json_decode($prod_img_url);

													if (is_array($prod_img_decode)) {
														$im = 0;
														foreach ($prod_img_decode as $prod_imgs) {
															$img1 = MEDIAURL . $prod_imgs->{$img_dimension_arr[1][0] . '-' . $img_dimension_arr[1][1]};
													?>
															<div class="mr-1 mb-1" id="imgs_div<?= $im; ?>">
																<div class="thumbnail">
																	<div class="image view view-first">
																		<div class="mask">
																			<div class="tools tools-bottom">
																				<a class="text-dark" href="javascript:void(0);" style="float: right;" title="Delete"><i class="fa-solid fa-circle-xmark"></i></a>
																			</div>
																		</div>
																		<img height="75" style="display: block;" src="<?= $img1; ?>" />

																	</div>
																</div>
															</div>
													<?php $im++;
														}
													} ?>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Upload Video</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_youtubeid" value="<?php echo $product_video_url; ?>" name="prod_youtubeid">
											</div>
										</div>

										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0"> Meta Title</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_meta" name="prod_meta" value="<?php echo $meta_title; ?>" placeholder="60 Letters">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Meta Keywords</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="prod_keyword" name="prod_keyword" value="<?php echo $meta_key; ?>" placeholder="250 letters">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Meta Description</label>
											<div class="col-sm-8">
												<textarea class="form-control rows=" 7" id="prod_meta_desc" name="prod_meta_desc" placeholder="150 letters"><?php echo $meta_value; ?></textarea>
											</div>
										</div>

										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Reject Reason</label>
											<div class="col-sm-8">
												<?php echo $Common_Function->select_reject_reason($conn, $prod_unique_id, 'product');

												?>
											</div>
										</div>
										<input type="hidden" name="product_id" id="product_id" value="<?php echo $prod_unique_id; ?>">
										<div class="form-group row align-items-center">
											<div class="col-12 text-center">
												<button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="addProduct_btn">Update Details</button>
											</div>
										</div>
									</form>
									<div class="col-sm-offset-2">
										<button style="font-size: 12px;" type="submit" class="btn btn-danger  waves-effect waves-light" name="delete" onclick="deleteRecord('<?php echo $prod_unique_id; ?>');">Reject</button>
										<button style=" margin-left: 30px;font-size: 12px;" type="submit" class="btn btn-dark waves-effect waves-light" name="edit" onclick="verifyRecord('<?php echo $prod_unique_id; ?>')" ;>Approve</button>

									</div>

								</div>

							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="col_1">
		<div class="clearfix"> </div>
	</div>
</div>

<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->
<script>
	$(document).ready(function() {
		if ($("#editor").length > 0) {
			tinymce.init({
				selector: "textarea#editor",
				theme: "modern",
				height: 300,
				plugins: [
					"advlist lists print",
					//  "wordcount code fullscreen",
					"save table directionality emoticons paste textcolor"
				],
				toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
			});
		}

		if ($("#prod_short").length > 0) {
			tinymce.init({
				selector: "textarea#prod_short",
				theme: "modern",
				height: 300,
				plugins: [
					"advlist lists print",
					//  "wordcount code fullscreen",
					"save table directionality emoticons paste textcolor"
				],
				toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
			});
		}

		if ($("#prod_short_ar").length > 0) {
			tinymce.init({
				selector: "textarea#prod_short_ar",
				theme: "modern",
				height: 300,
				directionality: 'rtl',
				plugins: [
					"advlist lists print",
					//  "wordcount code fullscreen",
					"save table directionality emoticons paste textcolor"
				],
				toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
			});
		}

		if ($("#editor_ar").length > 0) {
			tinymce.init({
				selector: "textarea#editor_ar",
				theme: "modern",
				height: 300,
				directionality: 'rtl',
				plugins: [
					"advlist lists print",
					//  "wordcount code fullscreen",
					"save table directionality emoticons paste textcolor"
				],
				toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
			});
		}
		$('#selectattrset').change(function() {
			get_product_info_data();
		});

		get_product_info_data();
	});

	const get_product_info_data = () => {
		var selectedValue = $('#selectattrset').val();
		var product_id = '<?= $prod_unique_id ?>';
		var count = 0;
		$.busyLoadFull("show");

		$.ajax({
			method: 'POST',
			url: 'get_product_info_data.php',
			data: {
				code: '<?= $code_ajax; ?>',
				page: 1,
				rowno: 0,
				attribute_set_id: selectedValue,
				product_id: product_id,
				perpage: 100
			},
			success: function(response) {
				$.busyLoadFull("hide");
				var parsedJSON = $.parseJSON(response);
				$("#product_attributes_set_id").empty();

				var data = parsedJSON.data;
				document.getElementById('product_info').innerHTML = '';
				// <input type="text" class="form-control" id="${convertToUnderscore(element.attribute)}" name="product_info_set_val_id[]" placeholder="${element.attribute}"></input>
				if (data !== '') {
					var html = '';
					data.forEach(element => {
						var selected_product_info_set_val_data = [];
						html = '';
						var selectBoxId = ''
						element.selected_product_info_set_val_data.forEach(selected_product_info_set_val => {
							selected_product_info_set_val_data.push(selected_product_info_set_val.selected_product_info_set_val_id);
						});
						html +=
							`<div class="form-group row align-items-center">
							<label for="focusedinput" class="col-sm-2 control-label m-0">${element.attribute} </label>
							<div class="col-sm-8">
								<input type="hidden" id="product_info_set_id" name="product_info_set_id[]" value="${element.product_info_set_id}">
								<select class="form-control" id="${convertToUnderscore(element.attribute)}" name="product_info_set_val_id_${element.product_info_set_id}[]" multiple disabled>`;
						element.product_info_set_val_data.forEach(product_info_set_val => {
							html +=
								`<option value="${product_info_set_val.product_info_set_value_id}" ${selected_product_info_set_val_data.includes(product_info_set_val.product_info_set_value_id) ? 'selected' : ''}>${product_info_set_val.product_info_set_value}</option>`;
						});
						html +=
							`</select>
							</div>
						</div>`;
						document.getElementById('product_info').innerHTML += html;
						// selectBoxId = convertToUnderscore(element.attribute);

					});
					$('select[multiple]').multiselect({
						columns: 3,
						search: true,
						selectAll: true,
						texts: {
							placeholder: 'Select Attribute',
							search: 'Search Attribute'
						}
					});
					// $("select[multiple]").multiselect('reload');

					Array.from(document.getElementsByClassName('ms-options-wrap')).forEach(msOPtionWrap => {
						msOPtionWrap.classList.add('form-control', 'p-0');
						msOPtionWrap.getElementsByTagName('button')[0].classList.add('w-100', 'h-100', 'm-0', 'pl-2');
						msOPtionWrap.getElementsByTagName('span')[0].style.cssText = 'font-size: .875rem; font-weight: 400; line-height: 1.5; color: #6c757d;';
						msOPtionWrap.getElementsByTagName('button')[0].style.cssText = 'border: 0; border-radius: 5px;';
					});
					Array.from(document.getElementsByClassName('ms-options')).forEach(msOPtion => {
						msOPtion.getElementsByTagName('input')[0].classList.add('form-control');
					});
					Array.from(document.getElementsByClassName('ms-selectall global')).forEach(msSelectAll => {
						msSelectAll.classList.add('btn', 'btn-sm', 'btn-dark', 'waves-effect', 'waves-light');
					});
				}
			}
		});
	}

	function convertToUnderscore(str) {
		// Remove special characters and replace with underscores
		var underscoredStr = str.replace(/[^a-zA-Z0-9]/g, "_");

		// Remove consecutive underscores
		underscoredStr = underscoredStr.replace(/_+/g, "_");

		// Remove leading and trailing underscores
		underscoredStr = underscoredStr.replace(/^_+|_+$/g, "");

		return underscoredStr;
	}

	function deleteRecord(cat_id) {
		var rejectreason = $("#rejectreason" + cat_id).val();

		if (!rejectreason) {
			successmsg("Please select Reject Reason.");
		} else {
			xdialog.confirm('Are you sure want to reject Product?', function() {
				$.busyLoadFull("show");
				$.ajax({
					method: 'POST',
					url: 'verfiy_pending_products.php',
					data: {
						code: '<?php echo $code_ajax; ?>',
						record_id: cat_id,
						rejectreason: rejectreason
					},
					success: function(response) {
						$.busyLoadFull("hide");
						if (response == 'Failed to Delete.') {
							successmsg("Failed to Rejected.");
						} else if (response == 'Deleted') {

							successmsg("Product Rejected Successfully.");
							location.href = "pending_products.php";
						}
					}
				});
			}, {
				style: 'width:420px;font-size:0.8rem;',
				buttons: {
					ok: 'yes ',
					cancel: 'no '
				},
				oncancel: function() {
					// console.warn('Cancelled!');
				}
			});
		}
	}

	function verifyRecord(cat_id) {

		xdialog.confirm('Are you sure want to approve Product?', function() {
			$.busyLoadFull("show");
			$.ajax({
				method: 'POST',
				url: 'verfiy_pending_products.php',
				data: {
					code: '<?php echo $code_ajax; ?>',
					verify_record_id: cat_id
				},
				success: function(response) {
					$.busyLoadFull("hide");
					if (response == 'Failed to approve.') {
						successmsg("Failed to approve.");
					} else if (response == 'approve') {
						successmsg("Product approved Successfully.");
						location.href = "pending_products.php";

					}
				}
			});
		}, {
			style: 'width:420px;font-size:0.8rem;',
			buttons: {
				ok: 'yes ',
				cancel: 'no '
			},
			oncancel: function() {
				// console.warn('Cancelled!');
			}
		});
	}
</script>