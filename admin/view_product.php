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
   		product_sku,product_visibility,product_manuf_country,product_hsn_code,product_video_url,return_policy_id ,meta_title,meta_key,meta_value,is_heavy,
		prod_name_ar,prod_desc_ar ,prod_fulldetail_ar
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
	$prod_fulldetail_ar
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
	.switch {
		position: relative;
		display: block;
		vertical-align: top;
		width: 66.5px;
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
		left: 40px;
		box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
	}

	.switch-label,
	.switch-handle {
		transition: All 0.3s ease;
		-webkit-transition: All 0.3s ease;
		-moz-transition: All 0.3s ease;
		-o-transition: All 0.3s ease;
	}

	.subList {
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
						<h4 class="page-title">View Product</h4>
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
										<button id="back_btn" type="submit" class="btn btn-dark waves-effect waves-light" onclick="back_page('manage_product.php');"><i class="fa fa-arrow-left"></i> Back</button>
									</div>
								</div>


								<div class="form-three widget-shadow">
									<form class="form-horizontal" id="myform" action="edit_product_process.php" method="post" enctype="multipart/form-data">
										<input type="hidden" name="code" value="<?php echo $code_ajax; ?>" />
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Enable product</label>
											<div class="col-sm-8">
												<label class="switch">
													<input class="switch-input" type="checkbox" id="togglebtn" name="enableproduct" disabled <?= $status == 1 ? 'checked' : '' ?> value="1" />
													<span class="switch-label" data-on="On" data-off="Off"></span>
													<span class="switch-handle"></span>
												</label>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Attribute Set** </label>
											<div class="col-sm-8">
												<select class="form-control disabled" id="selectattrset" disabled name="selectattrset">
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
											<label class="col-sm-2 control-label m-0">Category Set** </label>
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
																		echo '<span class="expand"><input type="checkbox" disabled checked name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><span class="mainList"> ' . $row['cat_name'] . '</span><br />';
																	} else {
																		echo '<span class="expand"><input type="checkbox" disabled name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><span class="mainList"> ' . $row['cat_name'] . '</span><br />';
																	}
																}
															}
														}

														function categoryTree($parent_id, $product_cat)
														{
															global $conn;
															$query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id AND status ='1' ORDER BY cat_name ASC");

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
																			echo '<li><input type="checkbox" disabled checked name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> ' . $row['cat_name'] . '</li>';
																		} else {
																			echo '<li><input type="checkbox" disabled name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> ' . $row['cat_name'] . '</li>';
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
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Name **</label>
											<div class="col-sm-8">
												<input type="text" class="form-control disabled" disabled id="prod_name" name="prod_name" value="<?php echo $prod_name; ?>" placeholder="Name" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Arabic Name **</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" disabled id="prod_name_ar" name="prod_name_ar" placeholder="Name" value="<?php echo $prod_name_ar; ?>" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Type</label>
											<div class="col-sm-8">
												<input type="text" class="form-control disabled" disabled id="prod_type" name="prod_type" value="<?php if ($prod_type == 1) {
																																						echo 'Simple';
																																					} else if ($prod_type == 2) {
																																						echo 'Configurable';
																																					} ?>" placeholder="Name" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">SKU</label>
											<div class="col-sm-8">
												<input type="text" class="form-control disabled" disabled id="prod_sku" name="prod_sku" value="<?php echo $product_sku; ?>" placeholder="SKU auto generate">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">URL key</label>
											<div class="col-sm-8">
												<input type="text" class="form-control disabled" disabled id="prod_url" name="prod_url" value="<?php echo $web_url; ?>">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Short details **</label>
											<div class="col-sm-8">
												<textarea rows="6" cols="65" id="prod_short" class="disabled" disabled name="prod_short" placeholder="Short description 300 letter" required maxlength="50"><?php echo $prod_desc; ?></textarea>

											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Full Details **</label>
											<div class="col-sm-8">
												<textarea rows="6" cols="65" id="editor" class="disabled" disabled name="prod_details" required placeholder="Miximum 1000 letters"><?php echo $prod_fulldetail; ?></textarea>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Short details Arabic **</label>
											<div class="col-sm-8">
												<textarea rows="6" cols="65" id="prod_short_ar" name="prod_short_ar" placeholder="Short description 300 letter" required maxlength="50"><?= $prod_desc_ar; ?></textarea>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Product Full Details Arabic **</label>
											<div class="col-sm-8">
												<textarea rows="6" cols="65" id="editor_ar" name="prod_details_ar" required placeholder="Miximum 1000 letters"><?= $prod_fulldetail_ar; ?></textarea>
											</div>
										</div>
										<div id="product_info"></div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Visibility</label>
											<div class="col-sm-8">
												<select class="form-control disabled" disabled id="selectvisibility" name="selectvisibility">
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
												<select class="form-control disabled" disabled id="selectcountry" name="selectcountry">
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
												<input type="text" class="form-control disabled" disabled id="prod_hsn" name="prod_hsn" value="<?php echo $product_hsn_code; ?>" placeholder="Product HSN code">
											</div>
										</div>

										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select Brand **</label>
											<div class="col-sm-8">
												<select class="form-control disabled" disabled id="selectbrand" name="selectbrand">
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
												<select class="form-control disabled" disabled id="return_policy" name="return_policy">
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
											<label class="col-sm-2 control-label m-0">Heavy Product</label>
											<div class="col-sm-8">
												<input type="checkbox" id="is_heavy" value='1' <?php if ($is_heavy == 1) {
																									echo "checked";
																								} ?> name="is_heavy">
											</div>
										</div>
										<div class="form-group row align-items-center mt-2">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Featured Images</label>
											<div class="col-sm-9">

												<div class="d-flex flex-wrap mt-1">
													<div class="thumbnail">
														<div class="image view view-first">
															<?php
															$featured_decod =  json_decode($featured_img);

															$img = MEDIAURL . $featured_decod->{$img_dimension_arr[2][0] . '-' . $img_dimension_arr[2][1]};
															?>
															<img height="75;" style="display: block;" src="<?php echo $img; ?>" alt="" />
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center mt-2">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Product Images</label>
											<div class="col-sm-8 input-files">
												<div class="d-flex flex-wrap mt-1">

													<?php
													$prod_img_decode =  json_decode($prod_img_url);

													if ($prod_img_url) {
														$im = 0;
														foreach ($prod_img_decode as $prod_imgs) {
															$img1 = MEDIAURL . $prod_imgs->{$img_dimension_arr[2][0] . '-' . $img_dimension_arr[2][1]};
													?>
															<div class="mr-1 mb-2" id="imgs_div<?php echo $im; ?>">
																<!-- <div class="thumbnail">
																	<div class="image view view-first">
																		<div class="mask">
																			<div class="tools tools-bottom">
																				<a href="javascript:void(0);" onclick="delete_images('<?php echo $prod_unique_id; ?>','<?php echo $im; ?>');" style="float: right;" title="Delete"><i class="fa fa-times text-dark"></i></a>
																			</div>
																		</div>
																		<img height="75;" style="display: block;" src="<?php echo $img1; ?>" />
																	</div>
																</div> -->
																<div class="d-flex flex-column" style="width: fit-content;">
																	<a class="text-right text-dark" href="javascript:void(0);" onclick="delete_images('<?php echo $prod_unique_id; ?>','<?php echo $im; ?>');" title="Delete">
																		<i class="fa-solid fa-circle-xmark"></i>
																	</a>
																	<div class="image-container">
																		<img style="display: block; height: 75px; width: auto;" src="<?php echo $img1; ?>" />
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
											<label for="focusedinput" class="col-sm-2 control-label m-0">Youtube Video ID</label>
											<div class="col-sm-8">
												<input type="text" class="form-control disabled" disabled id="prod_youtubeid" value="<?php echo $product_video_url; ?>" name="prod_youtubeid">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0"> Meta Title</label>
											<div class="col-sm-8">
												<input type="text" class="form-control disabled" disabled id="prod_meta" name="prod_meta" value="<?php echo $meta_title; ?>">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Meta Keywords</label>
											<div class="col-sm-8">
												<input type="text" class="form-control disabled" disabled id="prod_keyword" name="prod_keyword" value="<?php echo $meta_key; ?>">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Meta Description</label>
											<div class="col-sm-8">
												<textarea rows="6" class="form-control disabled" disabled id="prod_meta_desc" name="prod_meta_desc"><?php echo $meta_value; ?></textarea>
											</div>
										</div>
										</br></br>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Vendor Details</label><br>
											<div class="col-sm-8">
												<div class="table-responsive">
													<table class="table table-bordered table-centered">
														<thead class="thead-light">
															<tr>
																<th>Vendor Name</th>
																<th>Sale Price</th>
																<th>MRP </th>
																<th>Dispay in USD</th>
																<th>Available for Wholesale</th>
																<th>Affiliate Commission</th>
																<th>STOCK </th>
																<th>View </th>
															</tr>
														</thead>
														<tbody>
															<?php
															$stmtr = $conn->prepare("SELECT vp.is_usd_price, vp.wholesale_product, vp.affiliate_commission, vp.product_mrp,vp.product_sale_price,vp.product_stock, sl.companyname FROM vendor_product vp, sellerlogin sl WHERE vp.product_id ='" . $prod_unique_id . "' AND sl.seller_unique_id=vp.vendor_id ORDER BY sl.companyname ASC");

															$stmtr->execute();
															$data = $stmtr->bind_result($is_usd_price, $wholesale_product, $affiliate_commission, $product_mrp, $product_sale_price, $product_stock, $companyname);

															while ($stmtr->fetch()) {
																echo '<tr>';
																echo '<td>' . $companyname . '</td>';
																echo '<td>' . $product_sale_price . '</td>';
																echo '<td>' . $product_mrp . '</td>';
																if ($is_usd_price === 1) {
																	echo '<td><div class="d-flex align-items-center justify-content-center h-100 w-100"><input class="" type="checkbox" value="" name="is_usd_price" id="is_usd_price" onclick="return false" checked></div></td>';
																} else {
																	echo '<td><div class="d-flex align-items-center justify-content-center h-100 w-100"><input class="" type="checkbox" value="" name="is_usd_price" id="is_usd_price" onclick="return false"></div></td>';
																}
																if ($wholesale_product === 1) {
																	echo '<td><div class="d-flex align-items-center justify-content-center h-100 w-100"><input class="" type="checkbox" value="" name="wholesale_product" id="wholesale_product" onclick="return false" checked></div></td>';
																} else {
																	echo '<td><div class="d-flex align-items-center justify-content-center h-100 w-100"><input class="" type="checkbox" value="" name="wholesale_product" id="wholesale_product" onclick="return false"></div></td>';
																}
																echo '<td>' . $affiliate_commission . '</td>';
																echo '<td>' . $product_stock . '</td>';
																echo '<td><a class="btn btn-sm btn-dark waves-effect waves-light" href ="">View</a></td>';
																echo '</tr>';
															}

															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>

									</form>
								</div>

							</div>
							<?php //} 
							?>
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
				readonly: 1,
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
				readonly: 1,
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
				readonly: 1,
				selector: "textarea#prod_short_ar",
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
		if ($("#editor_ar").length > 0) {
			tinymce.init({
				readonly: 1,
				selector: "textarea#editor_ar",
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
		get_product_info_data();
	});

	const get_product_info_data = () => {
		var selectedValue = $('#selectattrset').val();
		var product_id = '<?= $prod_unique_id  ?>';
		var count = 0;
		$.busyLoadFull("show");

		$.ajax({
			method: 'POST',
			url: 'get_product_info_data.php',
			data: {
				code: code_ajax,
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
							<label for="focusedinput" class="col-sm-2 control-label m-0">${element.attribute} (${element.attribute_ar}) </label>
							<div class="col-sm-8">
								<input type="hidden" id="product_info_set_id" name="product_info_set_id[]" value="${element.product_info_set_id}">
								<select class="form-control" id="${convertToUnderscore(element.attribute)}" name="product_info_set_val_id_${element.product_info_set_id}[]" multiple>`;
						element.product_info_set_val_data.forEach(product_info_set_val => {
							html +=
								`<option value="${product_info_set_val.product_info_set_value_id}" ${selected_product_info_set_val_data.includes(product_info_set_val.product_info_set_value_id) ? 'selected' : ''}>${product_info_set_val.product_info_set_value} (${product_info_set_val.product_info_set_value_ar})</option>`;
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
</script>