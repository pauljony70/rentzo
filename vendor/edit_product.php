<?php

include('session.php');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

if (!isset($_GET['id'])) {
	header("Location: manage_product.php");
}
$record_exist = 'N';


$prod_unique_id = trim($_GET['id']);
$seller_unique_id = trim($_SESSION['admin']);

$stmt15 = $conn->prepare("SELECT vp.id, vp.enable_status, prod_name,prod_desc,prod_fulldetail,prod_img_url,featured_img, attr_set_id,brand_id,web_url,
   		product_sku,product_visibility,product_manuf_country,product_hsn_code,prod_weight,product_video_url,return_policy_id,vp.is_usd_price,vp.wholesale_product,vp.affiliate_commission,vp.product_mrp,vp.product_sale_price,vp.product_tax_class,vp.product_stock,vp.stock_status,vp.product_purchase_limit,vp.product_remark,vp.product_related_prod,vp.product_upsell_prod,is_heavy, prod_name_ar,prod_desc_ar ,prod_fulldetail_ar,vp.coupon_code,vp.seller_price,usage_info,type,day1_price,day3_price,day5_price,day7_price,city,security_deposit,is_buy
		FROM product_details pd 
		
		INNER JOIN vendor_product vp ON pd.product_unique_id = vp.product_id
		
		WHERE pd.product_unique_id ='" . $prod_unique_id . "' AND vp.vendor_id ='" . $seller_unique_id . "'	");

$stmt15->execute();
$data = $stmt15->bind_result(
	$vp_id,
	$status,
	$prod_name,
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
	$prod_weight,
	$product_video_url,
	$return_policy_id,
	$is_usd_price,
	$wholesale_product,
	$affiliate_commission,
	$product_mrp,
	$product_sale_price,
	$product_tax_class,
	$product_stock,
	$stock_status,
	$product_purchase_limit,
	$product_remark,
	$product_related_prod,
	$product_upsell_prod,
	$is_heavy,
	$prod_name_ar,
	$prod_desc_ar,
	$prod_fulldetail_ar,
	$coupon_code,
	$seller_price,
	$usage_info,$type,$day1_price,$day3_price,$day5_price,$day7_price,$city,$security_deposit,$is_buy
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
	.ms-options-wrap>.ms-options {
		width: 96.5% !important;
		border: 1px solid #ced4da !important;
		border-radius: .2rem !important;
	}

	.ms-options-wrap>.ms-options .ms-selectall:hover {
		text-decoration: none !important;
	}

	.switch {
		position: relative;
		display: block;
		vertical-align: top;
		width: 74px;
		height: 30px;
		padding: 3px;
		margin: 0 10px 10px 0;
		background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
		background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
		border-radius: 18px;
		box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
		cursor: pointer;
		box-sizing: content-box;
	}

	.switch-input {
		position: absolute;
		top: 0;
		left: 0;
		opacity: 0;
		box-sizing: content-box;
	}

	.switch-label {
		position: relative;
		display: block;
		height: inherit;
		font-size: 10px;
		text-transform: uppercase;
		background: #eceeef;
		border-radius: inherit;
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
		box-sizing: content-box;
	}

	.switch-label:before,
	.switch-label:after {
		position: absolute;
		top: 50%;
		margin-top: -.5em;
		line-height: 1;
		-webkit-transition: inherit;
		-moz-transition: inherit;
		-o-transition: inherit;
		transition: inherit;
		box-sizing: content-box;
	}

	.switch-label:before {
		content: attr(data-off);
		right: 11px;
		color: #aaaaaa;
		text-shadow: 0 1px rgba(255, 255, 255, 0.5);
	}

	.switch-label:after {
		content: attr(data-on);
		left: 11px;
		color: #FFFFFF;
		text-shadow: 0 1px rgba(0, 0, 0, 0.2);
		opacity: 0;
	}

	.switch-input:checked~.switch-label {
		background: #FF6600;
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
	}

	.switch-input:checked~.switch-label:before {
		opacity: 0;
	}

	.switch-input:checked~.switch-label:after {
		opacity: 1;
	}

	.switch-handle {
		position: absolute;
		top: 4px;
		left: 4px;
		width: 28px;
		height: 28px;
		background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
		background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
		border-radius: 100%;
		box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
	}

	.switch-handle:before {
		content: "";
		position: absolute;
		top: 50%;
		left: 50%;
		margin: -6px 0 0 -6px;
		width: 12px;
		height: 12px;
		background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
		background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
		border-radius: 6px;
		box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
	}

	.switch-input:checked~.switch-handle {
		left: 48px;
		box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
	}

	/*
	========================== 
		Transition
	========================== 
	*/
	.switch-label,
	.switch-handle {
		transition: All 0.3s ease;
		-webkit-transition: All 0.3s ease;
		-moz-transition: All 0.3s ease;
		-o-transition: All 0.3s ease;
	}

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

	li {
		list-style-type: none;
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
						<h4 class="page-title">Edit Product</h4>
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

								<h4 class="ml-3"><b>Edit Product :</b></h4>
							</div>
							<div class="form-three widget-shadow mt-2">
								<form class="form-horizontal" id="myform" action="edit_product_process.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="code" value="<?= $code_ajax; ?>" />
									<a><span class="text-danger">&#42;&#42;</span> required field</a>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">enable product</label>
										<div class="col-sm-8">
											<label class="switch">
												<input class="switch-input" type="checkbox" id="togglebtn" name="enableproduct" <?= $status == 1 ? 'checked' : '' ?> value="1" />
												<span class="switch-label" data-on="On" data-off="Off"></span>
												<span class="switch-handle"></span>
											</label>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Attribute Set<span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<select class="form-control disabled" id="selectattrset" name="selectattrset" disabled>
												<option value="">Select</option>
												<?php
												$stmtas = $conn->prepare("SELECT sno, name FROM attribute_set where status ='1' ORDER BY name ASC");
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
												<div class="pl-2 pt-2">
													<?php
													$stmtcs = $conn->prepare("SELECT cat_id	FROM product_category WHERE prod_id= '" . $prod_unique_id . "'");
													$stmtcs->execute();
													$data = $stmtcs->bind_result($cat_id);

													$product_cat = array();
													while ($stmtcs->fetch()) {
														$product_cat[] = $cat_id;
													}

													$query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND  status ='1' ORDER BY cat_name ASC");

													if ($query->num_rows > 0) {
														while ($row = $query->fetch_assoc()) {
															//echo "SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' ";
															$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND  status ='1' ");
															//	print_r($query1);
															if ($query1->num_rows > 0) {
																echo '<span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><span class="mainList"> ' . $row['cat_name'] . '</span>
																<br />    
																<ul id="ul' . $row['cat_id'] . '" class="subList"  style="display:block;">';
																echo categoryTree($row['cat_id'], $product_cat);
																echo	'</ul>';
															} else {
																if (in_array($row['cat_id'], $product_cat)) {
																	echo '<span class="expand"><input type="checkbox" disabled checked  value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><span class="mainList"> ' . $row['cat_name'] . '</span><br />';
																} else {
																	echo '<span class="expand"><input type="checkbox" disabled  value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><span class="mainList"> ' . $row['cat_name'] . '</span><br />';
																}
															}
														}
													}

													function categoryTree($parent_id, $product_cat)
													{
														global $conn;
														$query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id AND  status ='1'  ORDER BY cat_name ASC");

														if ($query->num_rows > 0) {
															while ($row = $query->fetch_assoc()) {

																$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND  status ='1'  ");
																//	print_r($query1);
																if ($query1->num_rows > 0) {
																	echo '<span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><span class="mainList"> ' . $row['cat_name'] . '</span>
																	<br />    
																	<ul id="ul' . $row['cat_id'] . '" class="subList" style="display:block;">';
																	echo categoryTree($row['cat_id'], $product_cat);
																	echo '</ul>';
																} else {
																	if (in_array($row['cat_id'], $product_cat)) {
																		echo '<li><input type="checkbox" checked  disabled value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> ' . $row['cat_name'] . '</li>';
																	} else {
																		echo '<li><input type="checkbox"  disabled value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> ' . $row['cat_name'] . '</li>';
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
									<input type="hidden" name="product_id" id="product_id" value="<?= $prod_unique_id; ?>">
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Name <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control disabled" id="prod_name" disabled value="<?= $prod_name; ?>" placeholder="Name" required>
										</div>
									</div>
									<!--<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Arabic Name <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="prod_name_ar" name="prod_name_ar" value="<?= $prod_name_ar; ?>" placeholder="Name" disabled required>
										</div>
									</div>-->
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">SKU</label>
										<div class="col-sm-8">
											<input type="text" class="form-control disabled" disabled value="<?= $product_sku; ?>" placeholder="SKU auto generate">
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">URL key</label>
										<div class="col-sm-8">
											<input type="text" class="form-control disabled" disabled value="<?= $web_url; ?>" placeholder="URL auto generate">
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Short details <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<textarea rows="6" cols="65" id="prod_short" disabled placeholder="Miximum 300 letters"><?= $prod_desc; ?></textarea>

										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Full Details <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<textarea rows="6" cols="65" id="editor" disabled placeholder="Miximum 1000 letters"><?= $prod_fulldetail; ?></textarea>
										</div>
									</div>
									
									 <div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Usage Instructions <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="6" cols="65" id="usage_info" name="usage_info" required placeholder="Miximum 1000 letters"><?php echo $usage_info; ?></textarea>
										</div>
									</div>
									
									<!--<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Short details (Arabic) <span class="text-danger ml-2">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<textarea rows="6" cols="65" id="prod_short_ar" name="prod_short_ar" placeholder="Short description 300 letter" disabled maxlength="50"><?= $prod_desc_ar; ?></textarea>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Full Details (Arabic) <span class="text-danger ml-2">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<textarea rows="6" cols="65" id="editor_ar" name="prod_details_ar" disabled placeholder="Miximum 1000 letters"><?= $prod_fulldetail_ar; ?></textarea>
										</div>
									</div>-->
									<div id="product_info"></div>
									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">TAX Class </label>
										<div class="col-sm-8">
											<select class="form-control" id="selecttaxclass" name="selecttaxclass">
												<?php
												$stmtat = $conn->prepare("SELECT tax_id, name FROM tax where status = '1' ORDER BY tax_id ASC");
												$stmtat->execute();
												$data = $stmtat->bind_result($col1t, $col2t);

												while ($stmtat->fetch()) {
													if ($product_tax_class == $col1t) {
														echo '<option value="' . $col1t . '" selected>' . $col2t . '</option>';
													} else {
														echo '<option value="' . $col1t . '">' . $col2t . '</option>';
													}
												}
												?>
											</select>
										</div>
									</div>
									<!--<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0"></label>
										<div class="col-sm-8">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" name="wholesale_product" id="wholesale_product" <?= $wholesale_product  === 1 ? 'checked' : '' ?>>
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
												<input class="form-check-input" type="checkbox" value="" name="is_usd_price" id="is_usd_price" <?= $is_usd_price  === 1 ? 'checked' : '' ?>>
												<label class="form-check-label" for="is_usd_price">
													The price of this product will be shown in USD
												</label>
											</div>
										</div>
									</div>-->
									
									 <div class="form-group row align-items-center">
									 <label class="col-sm-2 control-label m-0">Is this product available for buy</label>
									 <div class="col-sm-8">
										<input type="checkbox" id="is_buy" value='1' <?php if ($is_buy == 1) {
																						   echo "checked";
																						} ?> name="is_buy">
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
										<label for="focusedinput" class="col-sm-2 control-label m-0">Security deposit (<?= $currency ?>)</label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="security_deposit" name="security_deposit" maxlength="7" value="<?php echo $security_deposit; ?>" placeholder="Security deposit ex. 214">
										</div>
									</div>
									
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">MRP (<?= $currency ?>) <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="prod_mrp" name="prod_mrp" value="<?= $product_mrp; ?>" maxlength="7" placeholder="MRP ex. 214" required>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Seller Price (<?= $currency ?>) <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="seller_price" name="seller_price" value="<?= $seller_price; ?>" maxlength="7" placeholder="Sale Price ex. 208" required>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Display Price (<?= $currency ?>) <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="prod_price" name="prod_price" readonly value="<?= $product_sale_price; ?>" maxlength="7" placeholder="" required>
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
										<label for="focusedinput" class="col-sm-2 control-label m-0"></label>
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
																<td>Commission fee</td>
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
									<!-- <div class="form-group row align-items-center"> <label class="col-sm-2 control-label m-0">Coupon Code </label>
										<div class="col-sm-8"> <select class="form-control" id="coupon_code" name="coupon_code">
												<option value="">Select Coupon</option>
												<?php
												$query = $conn->query("SELECT * FROM coupancode_vendor WHERE  activate ='active' ORDER BY sno ASC");
												if ($query->num_rows > 0) {
													while ($row = $query->fetch_assoc()) {
												?>
														<option <?= $coupon_code == $row['sno'] ? 'selected' : '' ?> value="<?= $row['sno']; ?>"><?= $row['name']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div> -->
									<!--<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0"></label>
										<div class="col-sm-8">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" name="is_affiliate_product" id="is_affiliate_product" <?= $affiliate_commission  > 0 ? 'checked' : '' ?>>
												<label class="form-check-label" for="is_affiliate_product">
													This product will be available for affiliate marketing
												</label>
											</div>
										</div>
									</div>-->
									<div class="form-group row align-items-center d-none">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Affiliate Commission (%) <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="affiliate_commission" name="affiliate_commission" placeholder="Affiliate Commission" value="<?= $affiliate_commission ?>">
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Quantity</label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="prod_qty" value="<?= $product_stock; ?>" name="prod_qty" placeholder="stock quantity">
											<!--<button type="submit" return false;" class="btn btn-sm btn-warning"  style="float:left; display: inline-block; margin-right:20px;" >Advanced Inventory</button>-->
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Stock Status</label>
										<div class="col-sm-8">

											<select class="form-control" id="selectstock" name="selectstock">
												<option value="">Select</option>
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
											<select class="form-control disabled" disabled>
												<option value="">Select</option>
												<?php
												$stmtv = $conn->prepare("SELECT id, name FROM visibility where status ='1' ORDER BY id ASC");
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
											<select class="form-control disabled" disabled>
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
										<label class="col-sm-2 control-label m-0">HSN Code</label>
										<div class="col-sm-8">
											<select class="form-control" id="prod_hsn" name="prod_hsn">
												<option value="">Select HSN Code</option>
												<?php
												$stmtb = $conn->prepare("SELECT id, hsn_code FROM product_hsn_code where status ='1' ORDER BY id ASC");

												$stmtb->execute();
												$data = $stmtb->bind_result($id, $hsn_code);

												while ($stmtb->fetch()) {
													if ($product_hsn_code == $hsn_code) {
														echo '<option value="' . $hsn_code . '" selected>' . $hsn_code . '</option>';
													} else {
														echo '<option value="' . $hsn_code . '">' . $hsn_code . '</option>';
													}
												}

												?>
											</select>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Weight(GM) </label>
										<div class="col-sm-8">
											<input type="text" class="form-control disabled" id="prod_weight" name="prod_weight" value="<?= $prod_weight; ?>" placeholder="Product Weight">
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Product Purchase Limit for Customer</label>

										<div class="col-sm-8">
											<input type="number" class="form-control" id="prod_purchase_lmt" value="<?= $product_purchase_limit; ?>" name="prod_purchase_lmt" maxlength="3">

										</div>
									</div>
									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Select Brand <span class="text-danger">&#42;&#42;</span></label>
										<div class="col-sm-8">
											<select class="form-control disabled" disabled>
												<option value="">Select</option>
												<?php
												$stmtb = $conn->prepare("SELECT brand_id, brand_name FROM brand where status ='1' ORDER BY brand_order ASC");

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
											<select class="form-control disabled" disabled>
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
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Configurations </label>
										<div class="col-sm-8">
											<button type="button" onclick="check_product();" class="btn btn-hover btn-dark">Create Configuration</button>
											<br><br>

											<a>Configurable products allow customers to choose options (Ex: shirt color). You need to create a simple product for each configuration (Ex: a product for each color).</a>

										</div>
									</div>
									<div class="form-group row align-items-center">

										<div class="col-sm-10" style="background-color: #dad9d9;">
											<div id="skip_pric" style="display:none;"><input type="checkbox" name="skip_sale_price" id="skip_sale_price" value="1"><span>Apply single price to all SKUs</span></div>
											<div id="configurations_div_html">
												<?php

												$stmtcp = $conn->query("SELECT id, product_sku,price, mrp ,stock FROM product_attribute_value WHERE product_id = '" . $prod_unique_id . "' AND vendor_prod_id ='" . $vp_id . "'");

												//	$stmtcp->execute();	 
												//	$data = $stmtcp->bind_result($conf_id, $product_sku, $prices, $mrps,$stocks);
												if ($stmtcp->num_rows > 0) {

												?>
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
																$conf_id = $rows['id'];


															?>
																<tr id="remove_attr_tr1"><input type="hidden" name="conf_ids[]" value="<?= $conf_id; ?>" style="width: 100%;">
																	<td><?= $product_sku; ?></td>
																	<td><input type="text" name="prod_skus[]" readonly="" value="<?= $product_sku; ?>"></td>
																	<td><input type="number" name="sale_price[]" class="sale_prices" value="<?= $prices; ?>" style="width: 100%;"></td>
																	<td><input type="number" name="mrp_price[]" class="mrp_price" value="<?= $mrps; ?>" style="width: 100%;"></td>
																	<td><input type="number" name="stocks[]" value="<?= $stocks; ?>" style="width: 100%;"></td>

																</tr>

															<?php } ?>
														</tbody>
													</table>
												<?php } ?>

											</div>
										</div>
									</div>
									<!--<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Heavy Product</label>
										<div class="col-sm-8">
											<input type="checkbox" id="is_heavy" value='1' <?= $is_heavy == 1 ? 'checked' : '' ?> disabled>
										</div>
									</div>-->
									<div class="form-group row align-items-center">
										<label for="focusedinput" class="col-sm-2 control-label m-0">Remarks</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="prod_remark" value="<?= $product_remark; ?>" name="prod_remark" placeholder="200 sold in 3 hours">
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="exampleInputFile" class="col-sm-2 control-label m-0">Featured Images</label>
										<div class="col-sm-8">
											<?php if ($featured_img) { ?>
												<div class="d-flex flex-wrap mt-3">
													<div class="thumbnail">
														<div class="image view view-first">
															<?php
															$featured_decod =  json_decode($featured_img);

															$img = MEDIAURL . $featured_decod->{$img_dimension_arr[2][0] . '-' . $img_dimension_arr[2][1]};
															?>
															<img style="height: 75px; width: auto; display: block;" src="<?= $img; ?>" alt="" />
														</div>
													</div>
												</div>
											<?php } ?>
										</div>

									</div>
									<div class="form-group row align-items-center">
										<label for="exampleInputFile" class="col-sm-2 control-label m-0">Product Images</label>
										<div class="col-sm-8 input-files">
											<div class="d-flex flex-wrap mt-1">
												<?php
												$prod_img_decode =  json_decode($prod_img_url);

												if ($prod_img_decode) {
													$im = 0;
													foreach ($prod_img_decode as $prod_imgs) {
														// print_r($prod_imgs->{$img_dimension_arr[1][0]});
														$img1 = MEDIAURL . $prod_imgs->{$img_dimension_arr[2][0] . '-' . $img_dimension_arr[2][1]};
												?>
														<div class="mr-1 mb-1" id="imgs_div<?= $im; ?>">
															<div class="thumbnail">
																<div class="image view view-first">
																	<div class="mask">
																		<div class="tools tools-bottom">
																		</div>
																	</div>
																	<img style="height: 75px; width: auto; display: block;" src="<?= $img1; ?>" />

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
											<input type="text" class="form-control disabled" disabled value="<?= $product_video_url; ?>">
										</div>
									</div>
									<?php

									$related_expl = explode(',', $product_related_prod);

									$upsell_expl = explode(',', $product_upsell_prod);
									
									
									$city_expl = explode(',', $city);

									$stmt = $conn->prepare("SELECT pd.product_unique_id, pd.prod_name FROM product_details pd INNER JOIN vendor_product vp ON pd.product_unique_id = vp.product_id WHERE vp.vendor_id ='" . $seller_unique_id . "' AND  pd.product_unique_id !='" . $prod_unique_id . "' ORDER BY pd.prod_name ASC");

									$stmt->execute();
									$data = $stmt->bind_result($col1, $col2);
									$return = array();
									$i = 0;
									while ($stmt->fetch()) {
										$return[$i] =
											array(
												'id' => $col1,
												'name' => $col2
											);
										$i = $i + 1;
									}
									
									
									  

									?>

									
									
									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Related Product multi select</label>
										<div id="example2" class="col-sm-8">
											<select class="form-control related_prod" id="selectrelatedprod" name="selectrelatedprod[]" multiple>
												<?php
												foreach ($return as $related) {
													if (in_array($related['id'], $related_expl)) {
														echo '<option value="' . $related['id'] . '" selected>' . $related['name'] . '</option>';
													} else {
														echo '<option value="' . $related['id'] . '">' . $related['name'] . '</option>';
													}
												}
												?>
											</select>

											<a>Related products are shown to customers in addition to the item the customer is looking at.</a>
											<br>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label class="col-sm-2 control-label m-0">Up-Sell Products</label>
										<div id="example1" class="col-sm-8">
											<select class="form-control related_prod" id="selectupsell" name="selectupsell[]" multiple>
												<?php
												foreach ($return as $related) {
													if (in_array($related['id'], $upsell_expl)) {
														echo '<option value="' . $related['id'] . '" selected>' . $related['name'] . '</option>';
													} else {
														echo '<option value="' . $related['id'] . '">' . $related['name'] . '</option>';
													}
												}
												?>
											</select>

											<a>An up-sell item is offered to the customer as a pricier or higher-quality alternative to the product the customer is looking at.</a>
											<br>
										</div>
									</div>


									</br></br>
									<div class="col-sm-offset-2">
										<button type="submit" class="btn btn-dark" href="javascript:void(0)" id="addProduct_btn">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php //} 
		?>
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
							<div class="input-files">
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

<script src="js/admin/edit-product.js"></script>
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
</script>