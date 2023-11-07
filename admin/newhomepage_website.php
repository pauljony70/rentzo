<?php
include('session.php');
if (!$Common_Function->user_module_premission($_SESSION, $HomepageSettings)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

if (isset($_POST['code'])) {
	if ($_POST['code'] == $_SESSION['_token'] && $_POST['product_id'] && $_POST['bannerprod_type']) {
		$stmt = $conn->prepare("SELECT id FROM popular_product WHERE product_id=? AND type =?");
		$stmt->bind_param("ss",  $_POST['product_id'], $_POST['bannerprod_type']);
		$stmt->execute();

		$stmt->bind_result($img_url);

		$exist = '';
		while ($stmt->fetch()) {
			$exist = 'yes';
		}
		if ($exist != 'yes') {

			$stmt11 = $conn->prepare("INSERT INTO `popular_product`( `product_id`,type)  VALUES (?,?)");
			$stmt11->bind_param('ss', $_POST['product_id'], $_POST['bannerprod_type']);

			$stmt11->execute();
			$stmt11->store_result();
			$rows = $stmt11->affected_rows;
			if ($rows > 0) {
				echo $_POST['bannerprod_type'] . " Product Added Successfully.";
			} else {
				echo "Failed to add " . $_POST['bannerprod_type'] . " Product.";
			}
		} else {
			echo $_POST['bannerprod_type'] . " Product already exist.";
		}
		die();
	}
	
	if ($_POST['code'] == $_SESSION['_token'] && $_POST['bannersection_type'] && $_POST['section_title']) {
		
		$stmt = $conn->prepare("SELECT id FROM homepage_banner WHERE type =?");
		$stmt->bind_param("s", $_POST['bannersection_type']);
		$stmt->execute();

		$stmt->bind_result($img_url);

		$exist = '';
		while ($stmt->fetch()) {
			$exist = 'yes';
		}
		
		if ($exist != 'yes') {


			$stmt11 = $conn->prepare("INSERT INTO `homepage_banner`(type,image,section)  VALUES (?,?,?)");
			$stmt11->bind_param('sss', $_POST['bannersection_type'],$_POST['section_title'],$_POST['bannersection_type']);

			$stmt11->execute();
			$stmt11->store_result();
			$rows = $stmt11->affected_rows;
			if ($rows > 0) {
				echo $_POST['bannersection_type'] . " Section Title Added Successfully.";
			} else {
				echo "Failed to add " . $_POST['bannersection_type'] . " Title.";
			}
		} else {
			$query1 = $conn->query("UPDATE `homepage_banner`  SET image='" . $_POST['section_title'] . "'' WHERE type ='" . $_POST['bannersection_type'] . "'");

			$query1->execute();
			$query1->store_result();
			$rows1 = $query1->affected_rows;
			if ($rows1 > 0) {
				echo $_POST['bannersection_type'] . " Section Title Update Successfully.";
			} else {
				echo "Failed to add " . $_POST['bannersection_type'] . " Title.";
			}
		}
		die();
	}

	if ($_POST['code'] == $_SESSION['_token'] && $_POST['page']) {
	}
}
?>
<?php include("header.php"); ?>
<style>
	#country-list {
		float: left;
		list-style: none;
		margin-top: -3px;
		padding: 0;
		width: 190px;
		position: absolute;
	}

	#country-list li {
		padding: 10px;
		background: #f0f0f0;
		border-bottom: #bbb9b9 1px solid;
	}

	#country-list li:hover {
		background: #ece3d2;
		cursor: pointer;
	}

	#search-box {
		padding: 10px;
		border: #a8d4b1 1px solid;
		border-radius: 4px;
	}

	li {
		list-style-type: none;
	}
</style>

<link href="assets/css/custom-style.css" rel="stylesheet">

<!-- ======= Hero Section ======= -->
<!-- End Hero -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Homepage Banners</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->
			
			
			
			
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							
							<?php
							$section5_image1 = $section5_link1 = $section5_cat_id = '';
							$section5_cat1 = $section5_cat2 = $section5_cat3 = $section5_cat4 = $section5_cat5 = $section5_cat6 = $section5_cat7 = $section5_cat8 = $section5_cat9 = $section5_cat10 = $section5_cat11 = $section5_cat12 =  "Select";
							$query8 = $conn->query("SELECT hb.*,cat.cat_name FROM `homepage_banner` hb, category cat WHERE hb.cat_id=cat.cat_id AND hb.section = 'section5'");
							//sql for top banner
							$section5_type1 = 'sec5cat1';
							$section5_type2 = 'sec5cat2';
							$section5_type3 = 'sec5cat3';
							$section5_type4 = 'sec5cat4';
							$section5_type5 = 'sec5cat5';
							$section5_type6 = 'sec5cat6';
							$section5_type7 = 'sec5cat7';
							$section5_type8 = 'sec5cat8';
							$section5_type9 = 'sec5cat9';
							$section5_type10 = 'sec5cat10';
							$section5_type11 = 'sec5cat11';
							$section5_type12 = 'sec5cat12';
							if ($query8->num_rows > 0) {

								while ($rows8 = $query8->fetch_assoc()) {
									if ($rows8['type'] == 'sec5cat1') {
										$img_decode81 = json_decode($rows8['image']);
										$section5_image1 = MEDIAURL . $img_decode81->{'470-720'};
										$section5_link1 = $rows8['link'];
										$section5_catid1 = $rows8['cat_id'];
										$section5_cat1 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat2') {
										$img_decode82 = json_decode($rows8['image']);
										$section5_image2 = MEDIAURL . $img_decode82->{'470-720'};
										$section5_link2 = $rows8['link'];
										$section5_catid2 = $rows8['cat_id'];
										$section5_cat2 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat3') {
										$img_decode83 = json_decode($rows8['image']);
										$section5_image3 = MEDIAURL . $img_decode83->{'470-720'};
										$section5_link3 = $rows8['link'];
										$section5_catid3 = $rows8['cat_id'];
										$section5_cat3 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat4') {
										$img_decode84 = json_decode($rows8['image']);
										$section5_image4 = MEDIAURL . $img_decode84->{'470-720'};
										$section5_link4 = $rows8['link'];
										$section5_catid4 = $rows8['cat_id'];
										$section5_cat4 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat5') {
										$img_decode85 = json_decode($rows8['image']);
										$section5_image5 = MEDIAURL . $img_decode85->{'470-720'};
										$section5_link5 = $rows8['link'];
										$section5_catid5 = $rows8['cat_id'];
										$section5_cat5 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat6') {
										$img_decode86 = json_decode($rows8['image']);
										$section5_image6 = MEDIAURL . $img_decode86->{'470-720'};
										$section5_link6 = $rows8['link'];
										$section5_catid6 = $rows8['cat_id'];
										$section5_cat6 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat7') {
										$img_decode87 = json_decode($rows8['image']);
										$section5_image7 = MEDIAURL . $img_decode87->{'470-720'};
										$section5_link7 = $rows8['link'];
										$section5_catid7 = $rows8['cat_id'];
										$section5_cat7 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat8') {
										$img_decode88 = json_decode($rows8['image']);
										$section5_image8 = MEDIAURL . $img_decode88->{'470-720'};
										$section5_link8 = $rows8['link'];
										$section5_catid8 = $rows8['cat_id'];
										$section5_cat8 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat9') {
										$img_decode89 = json_decode($rows8['image']);
										$section5_image9 = MEDIAURL . $img_decode89->{'470-720'};
										$section5_link9 = $rows8['link'];
										$section5_catid9 = $rows8['cat_id'];
										$section5_cat9 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat10') {
										$img_decode810 = json_decode($rows8['image']);
										$section5_image10 = MEDIAURL . $img_decode810->{'470-720'};
										$section5_link10 = $rows8['link'];
										$section5_catid10 = $rows8['cat_id'];
										$section5_cat10 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat11') {
										$img_decode811 = json_decode($rows8['image']);
										$section5_image11 = MEDIAURL . $img_decode811->{'470-720'};
										$section5_link11 = $rows8['link'];
										$section5_catid11 = $rows8['cat_id'];
										$section5_cat11 = $rows8['cat_name'];
									}
									if ($rows8['type'] == 'sec5cat12') {
										$img_decode812 = json_decode($rows8['image']);
										$section5_image12 = MEDIAURL . $img_decode812->{'470-720'};
										$section5_link12 = $rows8['link'];
										$section5_catid12 = $rows8['cat_id'];
										$section5_cat12 = $rows8['cat_name'];
									}
								}
							}
							?>

							<section>
								<div class="container tabs catergories-tabs">
									<div class="row">
										<div class="col-md-12">
											<h3 style="text-align: center;"> Shop Our Top Categories</h3><br>
										</div>
										<div class="col-md-3">
											<ul class="tab-menu nav nav-tabs d-block" role="tablist">
												<div class="d-flex align-items-center justify-content-between w-100 h-100">
													<h4 class="catergory-title">Select Category </h4>
													<i class="fas fa-chevron-circle-down"></i>
												</div>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-1-tab" data-toggle="tab" href="#tabs-1" role="tab" aria-controls="tabs-1" aria-selected="true"><?= $section5_cat1; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-2-tab" data-toggle="tab" href="#tabs-2" role="tab" aria-controls="tabs-2" aria-selected="false"><?= $section5_cat2; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-3-tab" data-toggle="tab" href="#tabs-3" role="tab" aria-controls="tabs-3" aria-selected="false"><?= $section5_cat3; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-4-tab" data-toggle="tab" href="#tabs-4" role="tab" aria-controls="tabs-4" aria-selected="false"><?= $section5_cat4; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-5-tab" data-toggle="tab" href="#tabs-5" role="tab" aria-controls="tabs-5" aria-selected="false"><?= $section5_cat5; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-6-tab" data-toggle="tab" href="#tabs-6" role="tab" aria-controls="tabs-6" aria-selected="false"><?= $section5_cat6; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-7-tab" data-toggle="tab" href="#tabs-7" role="tab" aria-controls="tabs-7" aria-selected="false"><?= $section5_cat7; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-8-tab" data-toggle="tab" href="#tabs-8" role="tab" aria-controls="tabs-8" aria-selected="false"><?= $section5_cat8; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-9-tab" data-toggle="tab" href="#tabs-9" role="tab" aria-controls="tabs-9" aria-selected="false"><?= $section5_cat9; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-10-tab" data-toggle="tab" href="#tabs-10" role="tab" aria-controls="tabs-10" aria-selected="false"><?= $section5_cat10; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3">
													<a class="nav-link" id="tabs-11-tab" data-toggle="tab" href="#tabs-11" role="tab" aria-controls="tabs-11" aria-selected="false"><?= $section5_cat11; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
												<li class="nav-item p-3 mb-2">
													<a class="nav-link" id="tabs-12-tab" data-toggle="tab" href="#tabs-12" role="tab" aria-controls="tabs-12" aria-selected="false"><?= $section5_cat12; ?><i class="fas fa-chevron-circle-right"></i></a>
												</li>
											</ul>
										</div>
										<div class="col-md-9">
											<div class="tab-content">
												<div class="tab-pane fade show active" id="tabs-1" role="tabpanel">
													<div class="row m-0">
														<div class="col-md-6 p-0 text-center text-light">

															<div class="icon-prime" style="background-image: url('<?= $section5_image1; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link1; 
																																									?>', '<?= $section5_type1; ?>', '<?= $section5_catid1; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat1 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid1 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat1->num_rows > 0) {

																	while ($rowscat1 = $querycat1->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-2" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image2; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link2; 
																																									?>', '<?= $section5_type2; ?>', '<?= $section5_catid2; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat2 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid2 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat2->num_rows > 0) {

																	while ($rowscat1 = $querycat2->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-3" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image3; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link3; 
																																									?>', '<?= $section5_type3; ?>', '<?= $section5_catid3; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat3 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid3 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat3->num_rows > 0) {

																	while ($rowscat1 = $querycat3->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-4" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image4; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link4; 
																																									?>', '<?= $section5_type4; ?>', '<?= $section5_catid4; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat4 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid4 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat4->num_rows > 0) {

																	while ($rowscat1 = $querycat4->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-5" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image5; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link5; 
																																									?>', '<?= $section5_type5; ?>', '<?= $section5_catid5; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat5 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid5 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat5->num_rows > 0) {

																	while ($rowscat1 = $querycat5->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-6" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image6; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link6; 
																																									?>', '<?= $section5_type6; ?>', '<?= $section5_catid6; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat6 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid6 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat6->num_rows > 0) {

																	while ($rowscat1 = $querycat6->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-7" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image7; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link6; 
																																									?>', '<?= $section5_type7; ?>', '<?= $section5_catid7; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat7 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid7 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat7->num_rows > 0) {

																	while ($rowscat1 = $querycat7->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-8" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image8; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link6; 
																																									?>', '<?= $section5_type8; ?>', '<?= $section5_catid8; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat8 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid8 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat8->num_rows > 0) {

																	while ($rowscat1 = $querycat8->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-9" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image9; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link6; 
																																									?>', '<?= $section5_type9; ?>', '<?= $section5_catid9; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat9 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid9 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat9->num_rows > 0) {

																	while ($rowscat1 = $querycat9->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-10" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image10; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">
																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link6; 
																																									?>', '<?= $section5_type10; ?>', '<?= $section5_catid10; ?>');">Upload</button>
																<a href="#"></a>
															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row"> <?php $querycat10 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img											FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid10 . "' order by pd.created_at DESC limit 0,6");
																				if ($querycat10->num_rows > 0) {
																					while ($rowscat1 = $querycat10->fetch_assoc()) {
																						$imgarraycat = json_decode($rowscat1['featured_img'], true);
																						$imageurlcat = MEDIAURL . $imgarraycat['72-72']; 									?> <div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">
																				<div class="yello-img"> <img src="<?= $imageurlcat; ?>"> </div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div> <?php }
																				} ?> </div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-11" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image11; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link6; 
																																									?>', '<?= $section5_type11; ?>', '<?= $section5_catid11; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat11 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid11 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat11->num_rows > 0) {

																	while ($rowscat1 = $querycat11->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="tabs-12" role="tabpanel">
													<div class="row">
														<div class="col-md-6">
															<div class="icon-prime" style="background-image: url('<?= $section5_image12; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

																<h3></h3>
																<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section5( '<?php // echo  $section5_link6; 
																																									?>', '<?= $section5_type12; ?>', '<?= $section5_catid12; ?>');">Upload</button>
																<a href="#"></a>

															</div>
														</div>
														<div class="col-md-8" style="display:none;">
															<div class="row">
																<?php
																$querycat12 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,product_category pp WHERE pd.status IN(1) AND pp.prod_id= pd.product_unique_id  AND pp.cat_id = '" . $section5_catid12 . "' order by pd.created_at DESC limit 0,6");
																if ($querycat12->num_rows > 0) {

																	while ($rowscat1 = $querycat12->fetch_assoc()) {
																		$imgarraycat = json_decode($rowscat1['featured_img'], true);
																		$imageurlcat = MEDIAURL . $imgarraycat['72-72'];
																?>
																		<div class="col-md-6 m-0" id="popdiv9">
																			<div class="tabb-color">

																				<div class="yello-img">
																					<img src="<?= $imageurlcat; ?>">
																				</div>
																				<div class="yello-text">
																					<p><?= $rowscat1['prod_name']; ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																} ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						
						
							<section id="featured" class="featured homehero">
								<div class="container">
									<div class="row">

										<?php
										$section1_image1 = $section1_link1 =  $section1_image2 = $section1_link2 = $section1_type2 = $section1_image3 = $section1_link3 = $section1_type3 = '';
										//sql for top banner
										$query1 = $conn->query("SELECT * FROM `homepage_banner` WHERE section = 'section1'");
										$section1_type1 = 'top1';
										$section1_type2 = 'top2';
										$section1_type3 = 'top3';
										if ($query1->num_rows > 0) {


											while ($rows1 = $query1->fetch_assoc()) {
												if ($rows1['type'] == 'top1') {
													$img_decode1 = json_decode($rows1['image']);
													$section1_image1 = MEDIAURL . $img_decode1->{'1920-680'};
													$section1_link1 = $rows1['link'];
												}
												if ($rows1['type'] == 'top2') {
													$img_decode2 = json_decode($rows1['image']);
													$section1_image2 = MEDIAURL . $img_decode2->{'200-200'};
													$section1_link2 = $rows1['link'];
												}
												if ($rows1['type'] == 'top3') {
													$img_decode3 = json_decode($rows1['image']);
													$section1_image3 = MEDIAURL . $img_decode3->{'200-200'};
													$section1_link3 = $rows1['link'];
												}
											}
										}
										?>
										<div class="col-lg-4 mb-2">
											<div class="icon-box" style="height:300px; background-image: url('<?= $section1_image1; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<h3><b>Banner 1</b></h3>
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_full_width('<?php  //echo $section1_image1; 
																																						?>', '<?= $section1_link1; ?>', '<?= $section1_type1; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-lg-4 mb-2">
											<div class="icon-box" style="background: linear-gradient(#31AADE, #2825AD);height:300px; background-image: url('<?= $section1_image2; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<h3><b>Banner 2</b></h3>
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_full_width('<?php  //echo $section1_image2; 
																																						?>', '<?= $section1_link2; ?>', '<?= $section1_type2; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-lg-4 mb-2">
											<div class="icon-box" style="height:300px; background-image: url('<?= $section1_image3; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<h3><b>Banner 3</b></h3>
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_full_width('<?php  //echo $section1_image3; 
																																						?>', '<?= $section1_link3; ?>', '<?= $section1_type3; ?>');">Upload</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							
							
							<section>
								<div class="container">
									<div class="row">
										<div class="col-md-12">
											<h3 style="text-align:center;"> Product Section 1 </h3><br>
										</div>
										<?php
										//sql for top banner
										$query37 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,popular_product pp WHERE pd.status IN(1) AND pp.product_id= pd.product_unique_id  AND pp.type = 'prod_section_1'");


										?>
										<?php if ($query37->num_rows <= 8) { ?>
											<div class="col-md-12 ">
												<button type="button" class="btn btn-danger waves-effect waves-light mb-2" onclick="add_section_title('prod_section1_title');">Add Section Title</button></h4>
												<button type="button" class="btn btn-danger waves-effect waves-light mb-2" onclick="add_banner_section7('prod_section_1');">Add Products</button></h4>
											</div>
										<?php } ?>

										<?php
										if ($query37->num_rows > 0) {
											while ($rows3 = $query37->fetch_assoc()) {
												$imgarray = json_decode($rows3['featured_img'], true);
												$imageurl = MEDIAURL . $imgarray['72-72'];
										?>
												<div class="col-md-4 m-0" id="popdiv<?= $rows3['id']; ?>">
													<div class="tabb-color">
														<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?= $rows3['id']; ?>');"><i class="fa fa-trash"></i></a></span>
														<div class="yello-img">
															<img src="<?= $imageurl;  ?>">
														</div>
														<div class="yello-text">

															<p><b><?= $rows3['prod_name']; ?></b></p>


														</div>
													</div>
												</div>
										<?php }
										} ?>
									</div>
								</div>
							</section>
							
							
							<section id="featured" class="featured homehero">
								<div class="container">
									<div class="row">
										<div class="col-12">
											<h3 style="text-align: center;"> New Arrival</h3><br>
										</div>
										<?php
										$section1_image1 = $section1_link1 =  $section1_image2 = $section1_link2 = $section1_type2 = $section1_image3 = $section1_link3 = $section1_type3 = $section1_link4 = $section1_type4 = $section1_link5 = $section1_type5 = $section1_link6 = $section1_type6 =  $section1_link7 = $section1_type7 = $section1_link8 = $section1_type8 = '';
										//sql for top banner
										$query1 = $conn->query("SELECT * FROM `homepage_banner` WHERE section = 'section_four_banner'");
										$section1_type1 = 'section_four_banner1';
										$section1_type2 = 'section_four_banner2';
										$section1_type3 = 'section_four_banner3';
										$section1_type4 = 'section_four_banner4';
										$section1_type5 = 'section_four_banner5';
										$section1_type6 = 'section_four_banner6';
										$section1_type7 = 'section_four_banner7';
										$section1_type8 = 'section_four_banner8';
										if ($query1->num_rows > 0) {


											while ($rows1 = $query1->fetch_assoc()) {
												if ($rows1['type'] == 'section_four_banner1') {
													$img_decode1 = json_decode($rows1['image']);
													$section1_image1 = MEDIAURL . $img_decode1->{'1920-680'};
													$section1_link1 = $rows1['link'];
												}
												if ($rows1['type'] == 'section_four_banner2') {
													$img_decode2 = json_decode($rows1['image']);
													$section1_image2 = MEDIAURL . $img_decode2->{'200-200'};
													$section1_link2 = $rows1['link'];
												}
												if ($rows1['type'] == 'section_four_banner3') {
													$img_decode3 = json_decode($rows1['image']);
													$section1_image3 = MEDIAURL . $img_decode3->{'200-200'};
													$section1_link3 = $rows1['link'];
												}
												if ($rows1['type'] == 'section_four_banner4') {
													$img_decode4 = json_decode($rows1['image']);
													$section1_image4 = MEDIAURL . $img_decode4->{'200-200'};
													$section1_link4 = $rows1['link'];
												}
												if ($rows1['type'] == 'section_four_banner5') {
													$img_decode5 = json_decode($rows1['image']);
													$section1_image5 = MEDIAURL . $img_decode5->{'200-200'};
													$section1_link5 = $rows1['link'];
												}
												if ($rows1['type'] == 'section_four_banner6') {
													$img_decode6 = json_decode($rows1['image']);
													$section1_image6 = MEDIAURL . $img_decode6->{'200-200'};
													$section1_link6 = $rows1['link'];
												}
												if ($rows1['type'] == 'section_four_banner7') {
													$img_decode7 = json_decode($rows1['image']);
													$section1_image7 = MEDIAURL . $img_decode7->{'200-200'};
													$section1_link7 = $rows1['link'];
												}
												if ($rows1['type'] == 'section_four_banner8') {
													$img_decode8 = json_decode($rows1['image']);
													$section1_image8 = MEDIAURL . $img_decode8->{'200-200'};
													$section1_link8 = $rows1['link'];
												}
											}
										}
										?>
										<div class="col-6 col-md-3 mb-2">
											<div class="icon-box" style="height:150px; background-image: url('<?= $section1_image1; ?>');background-size: contain;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section_four_banner('<?= $section1_link1; ?>', '<?= $section1_type1; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-6 col-md-3 mb-2">
											<div class="icon-box" style="height:150px; background-image: url('<?= $section1_image2; ?>');background-size: contain;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section_four_banner('<?= $section1_link2; ?>', '<?= $section1_type2; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-6 col-md-3 mb-2">
											<div class="icon-box" style="height:150px; background-image: url('<?= $section1_image3; ?>');background-size: contain;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section_four_banner('<?= $section1_link3; ?>', '<?= $section1_type3; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-6 col-md-3 mb-2">
											<div class="icon-box" style="height:150px; background-image: url('<?= $section1_image4; ?>');background-size: contain;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section_four_banner('<?= $section1_link4; ?>', '<?= $section1_type4; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-6 col-md-3 mb-2">
											<div class="icon-box" style="height:150px; background-image: url('<?= $section1_image5; ?>');background-size: contain;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section_four_banner('<?= $section1_link5; ?>', '<?= $section1_type5; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-6 col-md-3 mb-2">
											<div class="icon-box" style="height:150px; background-image: url('<?= $section1_image6; ?>');background-size: contain;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section_four_banner('<?= $section1_link6; ?>', '<?= $section1_type6; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-6 col-md-3 mb-2">
											<div class="icon-box" style="height:150px; background-image: url('<?= $section1_image7; ?>');background-size: contain;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section_four_banner('<?= $section1_link7; ?>', '<?= $section1_type7; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-6 col-md-3 mb-2">
											<div class="icon-box" style="height:150px; background-image: url('<?= $section1_image8; ?>');background-size: contain;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section_four_banner('<?= $section1_link8; ?>', '<?= $section1_type8; ?>');">Upload</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							
							
							
							
							<?php
							$section8_image1 = $section8_link1 =  $section8_image2 = $section8_link2 = $section8_type2 = $section8_image3 = $section8_link3 = $section8_type3 =  $section8_link4 = $section8_type4 = '';
							//sql for top banner
							$query18 = $conn->query("SELECT * FROM `homepage_banner` WHERE section = 'section8'");

							$section8_type1 = 'bottom1';
							$section8_type2 = 'bottom2';
							$section8_type3 = 'bottom3';
							$section8_type4 = 'bottom4';
							if ($query18->num_rows > 0) {


								while ($rows1 = $query18->fetch_assoc()) {
									if ($rows1['type'] == 'bottom1') {
										$img_decode1 = json_decode($rows1['image']);
										$section8_image1 = MEDIAURL . $img_decode1->{'610-400'};
										$section8_link1 = $rows1['link'];
									}
									if ($rows1['type'] == 'bottom2') {
										$img_decode2 = json_decode($rows1['image']);
										$section8_image2 = MEDIAURL . $img_decode2->{'610-400'};
										$section8_link2 = $rows1['link'];
									}
									if ($rows1['type'] == 'bottom3') {
										$img_decode3 = json_decode($rows1['image']);
										$section8_image3 = MEDIAURL . $img_decode3->{'610-400'};
										$section8_link3 = $rows1['link'];
									}
									if ($rows1['type'] == 'bottom4') {
										$img_decode4 = json_decode($rows1['image']);
										$section8_image4 = MEDIAURL . $img_decode4->{'610-400'};
										$section8_link4 = $rows1['link'];
									}
								}
							}
							?>

							<section class="sector">
								<div class="container">
									<div class="row">
										<div class="col-md-12">
											<h3 style="text-align:center;"> 1*3 Banner</h3><br>
										</div>
										<div class="col-lg-6 text-light mb-2">
											<div class="icon-boxx" style="background-image: url('<?= $section8_image1; ?>');">
												<div class="icon-text">

													<h4><b>Banner 1</b></h4>
													<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section8('<?php  //echo $section1_image2; 
																																						?>', '<?= $section8_link1; ?>', '<?= $section8_type1; ?>');">Upload</button>
												</div>

											</div>

										</div>
										<div class="row col-lg-6 text-light mb-2">
											<div class="col-lg-12 text-light mb-2">
												<div class="icon-boxx" style="background-image: url('<?= $section8_image2; ?>');">
													<div class="icon-text">

														<h4><b>Banner 2</b></h4>
														<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section8('<?php  //echo $section1_image2; 
																																							?>', '<?= $section8_link2; ?>', '<?= $section8_type2; ?>');">Upload</button>
													</div>

												</div>

											</div>
												<div class="col-lg-6 text-light mb-2">
													<div class="icon-boxx" style="background-image: url('<?= $section8_image3; ?>');">
														<div class="icon-text">


															<h4><b>Banner 3</b></h4>
															<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section8('<?php  //echo $section1_image2; 
																																								?>', '<?= $section8_link3; ?>', '<?= $section8_type3; ?>');">Upload</button>
														</div>

													</div>

												</div>
												<div class="col-lg-6 text-light mb-2">
													<div class="icon-boxx" style="background-image: url('<?= $section8_image4; ?>');">
														<div class="icon-text">


															<h4><b>Banner 4</b></h4>
															<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section8('<?php  //echo $section1_image2; 
																																								?>', '<?= $section8_link4; ?>', '<?= $section8_type4; ?>');">Upload</button>
														</div>

													</div>

												</div>
										</div>
									</div>
								</div>
							</section>

							
							
							<section>
								<div class="container">
									<div class="row">
										<div class="col-md-12">
											<h3 style="text-align:center;"> Product Section 2 </h3><br>
										</div>
										<?php
										//sql for top banner
										$query37 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,popular_product pp WHERE pd.status IN(1) AND pp.product_id= pd.product_unique_id  AND pp.type = 'prod_section_2'");


										?>
										<?php if ($query37->num_rows <= 8) { ?>
											<div class="col-md-12 ">
												<button type="button" class="btn btn-danger waves-effect waves-light mb-2" onclick="add_section_title('prod_section2_title');">Add Section Title</button></h4>
												<button type="button" class="btn btn-danger waves-effect waves-light mb-2" onclick="add_banner_section7('prod_section_2');">Add Products</button></h4>
											</div>
										<?php } ?>

										<?php
										if ($query37->num_rows > 0) {
											while ($rows3 = $query37->fetch_assoc()) {
												$imgarray = json_decode($rows3['featured_img'], true);
												$imageurl = MEDIAURL . $imgarray['72-72'];
										?>
												<div class="col-md-4 m-0" id="popdiv<?= $rows3['id']; ?>">
													<div class="tabb-color">
														<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?= $rows3['id']; ?>');"><i class="fa fa-trash"></i></a></span>
														<div class="yello-img">
															<img src="<?= $imageurl;  ?>">
														</div>
														<div class="yello-text">

															<p><b><?= $rows3['prod_name']; ?></b></p>


														</div>
													</div>
												</div>
										<?php }
										} ?>
									</div>
								</div>
							</section>
							
							
							<?php
							/*
							
							$section6_image1 = $section6_link1 = '';
							//sql for top banner
							$query9 = $conn->query("SELECT * FROM `homepage_banner` WHERE section = 'section6'");
							$section6_type1 = 'sec6';
							if ($query9->num_rows > 0) {


								while ($rows9 = $query9->fetch_assoc()) {
									if ($rows9['type'] == 'sec6') {
										$img_decode9 = json_decode($rows9['image']);
										$section6_image1 = MEDIAURL . $img_decode9->{'1900-320'};
										$section6_link1 = $rows9['link'];
									}
								}
							}
							?>
							<section>
								<div class="container">
									<div class="col-lg-12">
										<div class="row">
											<div class="section-header">
												<img style="width:inherit;height :265px;" src="<?= $section6_image1; ?>" class="img-fluid" alt="">
												<br><br>
												<h3> 2nd Banner</h3>
												<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section6( '<?= $section6_link1; ?>', '<?= $section6_type1; ?>');">Upload</button>

											</div>


										</div>
									</div>
								</div>
							</section>


							


							<!-- ======= Featured Section ======= -->

							<?php
							/*
							$section2_image1 = $section2_link1 =  $section2_image2 = $section2_link2  =$section2_image3 = $section2_link3 = $section2_image4 = $section2_link4 =
							$section2_image5 = $section2_link5 = $section2_image6 = $section2_link6 = $section2_image7 = $section2_link7 = ''; 
							//sql for top banner
							$query2 = $conn->query("SELECT * FROM `homepage_banner` WHERE section = 'section2'");
							$section2_type1 = 'sec2cat1';
							$section2_type2 = 'sec2pd1';
							$section2_type3 = 'sec2pd2';
							$section2_type4 = 'sec2cat2';
							$section2_type5 = 'sec2pd3';
							$section2_type6 = 'sec2pd4';
							$section2_type7 = 'sec2ad';
							if($query2->num_rows > 0){
								
						
							while($rows2 = $query2->fetch_assoc()){
								if( $rows2['type'] =='sec2cat1'){
									$img_decode1 = json_decode($rows2['image']);
									//print_r($img_decode1 );
									$section2_image1 = MEDIAURL. $img_decode1->{'700-330'};
									$section2_link1 = $rows2['link'];
								}
								if( $rows2['type'] =='sec2pd1'){
									$img_decode2 = json_decode($rows2['image']);
									$section2_image2 = MEDIAURL. $img_decode2->{'200-200'};
									$section2_link2 = $rows2['link'];
								}
								if( $rows2['type'] =='sec2pd2'){
									$img_decode3 = json_decode($rows2['image']);
									$section2_image3 = MEDIAURL. $img_decode3->{'200-200'};
									$section2_link3 = $rows2['link'];
								}
								
								if( $rows2['type'] =='sec2cat2'){
									$img_decode4 = json_decode($rows2['image']);
									$section2_image4 = MEDIAURL. $img_decode4->{'700-330'};
									$section2_link4 = $rows2['link'];
								}
								if( $rows2['type'] =='sec2pd3'){
									$img_decode5 = json_decode($rows2['image']);
									$section2_image5 = MEDIAURL. $img_decode5->{'200-200'};
									$section2_link5 = $rows2['link'];
								}
								if( $rows2['type'] =='sec2pd4'){
									$img_decode6 = json_decode($rows2['image']);
									$section2_image6 = MEDIAURL. $img_decode6->{'200-200'};
									$section2_link6 = $rows2['link'];
								}
								if( $rows2['type'] =='sec2ad'){
									$img_decode7 = json_decode($rows2['image']);
									$section2_image7 = MEDIAURL. $img_decode7->{'430-680'};
									$section2_link7 = $rows2['link'];
								}
							}
							?>
							<section id="featured" class="featured">
								<div class="container">
									<div class="row">
										<div class="col-lg-9 col-md-6 col-xs-12">
											<div class="row">
												<div class="col-lg-6">
													<div class="icon-box" style=" background-image: url('<?php  echo $section2_image1; ?>');">
														<div class="icon-text">
															
															<h3><b>Category</b></h3>
															<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section2( '<?php  echo  $section2_link1; ?>', '<?php  echo  $section2_type1; ?>');">Upload</button>
														</div>
														<div class="icon-img">
															<img src="">
														</div>
													</div>
													
												</div>
												<div class="col-lg-3">
													<div class="icon-wire" style=" background-image: url('<?php  echo $section2_image2; ?>');">
														
														<h3><b>Product 1</b></h3>
														<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section2( '<?php  echo  $section2_link2; ?>', '<?php  echo  $section2_type2; ?>');">Upload</button>
														
													</div>
													
												</div>
												<div class="col-lg-3">
													<div class="icon-road" style=" background-image: url('<?php  echo $section2_image3; ?>');">
														
														<h3><b>Product 2</b></h3>
														<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section2( '<?php  echo  $section2_link3; ?>', '<?php  echo  $section2_type3; ?>');">Upload</button>
														
													</div>
													
												</div>
											</div>
											<div class="row">
												<div class="col-lg-3 mt-4">
													<div class="icon-road" style=" background-image: url('<?php  echo $section2_image5; ?>');">
														
														<h3><b>Product 3</b></h3>
														<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section2( '<?php  echo  $section2_link5; ?>', '<?php  echo  $section2_type5; ?>');">Upload</button>
														
													</div>
													
												</div>
												<div class="col-lg-3 mt-4">
													<div class="icon-wire" style=" background-image: url('<?php  echo $section2_image6; ?>');">
														
														
														<h3><b>Product 4</b></h3>
														<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section2( '<?php  echo  $section2_link6; ?>', '<?php  echo  $section2_type6; ?>');">Upload</button>
														
													</div>
													
												</div>
												<div class="col-lg-6 mt-4">
													<div class="icon-boxx"style=" background-image: url('<?php  echo $section2_image4; ?>');">
														<div class="icon-text" >
															
															
															<h3><b>Category</b></h3>
															<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section2( '<?php  echo  $section2_link4; ?>', '<?php  echo  $section2_type4; ?>');">Upload</button>
														</div>
														<div class="icon-img">
															<img src="">
														</div>
													</div>
													
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-xs-12 text-center text-light">
											
											<div class="icon-prime" style=" background-image: url('<?php  echo $section2_image7; ?>');">
												
												<h3><b>Prime Add</b></h3>
												<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section2( '<?php  echo  $section2_link7; ?>', '<?php  echo  $section2_type7; ?>');">Upload</button>
												
												<a href="#"></a>
												
											</div>
										</div>
									</div>
									
								</div>
							</section><!-- End Featured Section -->
							<!-- ======= Portfolio Section ======= -->
							<?php */ /* ?>
							<section id="portfolio" class="portfolio mt-2">
								<div class="container">
									<div class="row">
										<div class="col-lg-12">
											<ul id="portfolio-flters" class="text-center p-2 m-0 nav nav-tabs">
												<li data-filter="*" class="filter-active active"><a data-toggle="tab" href="#new_div">Today Deal</a></li>
												<li data-filter=".filter-app"><a data-toggle="tab" href="#popular_div">Top Selling</a></li>
												<li data-filter=".filter-card"><a data-toggle="tab" href="#recommended_div">Trending Products</a></li>
												<li data-filter=".filter-web"><a data-toggle="tab" href="#offers_div">You May Like</a></li>
												<li data-filter=".filter-web"><a data-toggle="tab" href="#most_div">You Most Populor</a></li>
												<li data-filter=".filter-web"><a data-toggle="tab" href="#custom_div">Custom Cloth</a></li>
											</ul>
											<div class="tab-content">
												<div id="new_div" class="tab-pane fade in active show">
													<?php
													//sql for top banner
													$query3 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,popular_product pp WHERE pd.status IN(1) AND pp.product_id= pd.product_unique_id  AND pp.type = 'New' order by pp.id asc");


													?>
													<?php if ($query3->num_rows <= 15) { ?>
														<div class="col-md-12 ">
															<button type="button" class="btn btn-danger waves-effect waves-light mb-2" onclick="add_banner_section3('New')">Add Today Deal Products</button>
														</div>
													<?php } ?>
													<div class="d-flex flex-wrap">
														<?php
														if ($query3->num_rows > 0) {
															while ($rows3 = $query3->fetch_assoc()) {
																$imgarray = json_decode($rows3['featured_img'], true);
																$imageurl = MEDIAURL . $imgarray['72-72'];
														?>
																<div class="col-md-4 m-0" id="popdiv<?= $rows3['id']; ?>">
																	<div class="tabb-color">
																		<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?= $rows3['id']; ?>');"><i class="fa fa-trash"></i></a></span>
																		<div class="yello-img">
																			<img src="<?= $imageurl;  ?>">
																		</div>
																		<div class="yello-text">

																			<p><b><?= $rows3['prod_name']; ?></b></p>


																		</div>
																	</div>
																</div>
														<?php }
														} ?>
													</div>

												</div>
												<div id="popular_div" class="tab-pane fade">
													<?php
													//sql for top banner
													$query4 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,popular_product pp WHERE pd.status IN(1) AND pp.product_id= pd.product_unique_id  AND pp.type = 'Popular' order by pp.id asc");


													?>
													<?php if ($query4->num_rows <= 15) { ?>
														<div class="col-md-12 ">
															<button type="button" class="btn btn-danger waves-effect waves-light mb-2" onclick="add_banner_section3('Popular');">Add Top Selling</button></h4>
														</div>
													<?php } ?>
													<div class="d-flex flex-wrap">
														<?php
														if ($query4->num_rows > 0) {
															while ($rows4 = $query4->fetch_assoc()) {
																$imgarray1 = json_decode($rows4['featured_img'], true);
																$imageurl1 = MEDIAURL . $imgarray1['72-72'];
														?>
																<div class="col-md-4 m-0" id="popdiv<?= $rows4['id']; ?>">
																	<div class="tabb-color">
																		<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?= $rows4['id']; ?>');"><i class="fa fa-trash"></i></a></span>

																		<div class="yello-img">
																			<img src="<?= $imageurl1;  ?>">
																		</div>
																		<div class="yello-text">
																			<p><b><?= $rows4['prod_name']; ?></b></p>
																			<p class="mb-1"></p>

																		</div>
																	</div>
																</div>
														<?php }
														} ?>
													</div>
												</div>
												<div id="recommended_div" class="tab-pane fade">
													<?php
													//sql for top banner
													$query5 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,popular_product pp WHERE pd.status IN(1) AND pp.product_id= pd.product_unique_id  AND pp.type = 'Recommended' order by pp.id asc");


													?>
													<?php if ($query5->num_rows <= 15) { ?>
														<div class="col-md-12 ">
															<button type="button" class="btn btn-danger waves-effect waves-light mb-2" onclick="add_banner_section3('Recommended');">Add Trending Products</button></h4>
														</div>
													<?php } ?>
													<div class="d-flex flex-wrap">
														<?php
														if ($query5->num_rows > 0) {
															while ($rows5 = $query5->fetch_assoc()) {
																$imgarray2 = json_decode($rows5['featured_img'], true);
																$imageurl2 = MEDIAURL . $imgarray2['72-72'];
														?>
																<div class="col-md-4 m-0" id="popdiv<?= $rows5['id']; ?>">
																	<div class="tabb-color">
																		<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?= $rows5['id']; ?>');"><i class="fa fa-trash"></i></a></span>

																		<div class="yello-img">
																			<img src="<?= $imageurl2;  ?>">
																		</div>
																		<div class="yello-text">
																			<p><b><?= $rows5['prod_name']; ?></b></p>
																			<p class="mb-1"></p>

																		</div>
																	</div>
																</div>
														<?php }
														} ?>
													</div>
												</div>
												<div id="offers_div" class="tab-pane fade">
													<?php
													//sql for top banner
													$query6 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,popular_product pp WHERE pd.status IN(1) AND pp.product_id= pd.product_unique_id  AND pp.type = 'Offers' order by pp.id asc");


													?>
													<?php if ($query6->num_rows <= 15) { ?>
														<div class="col-md-12 ">
															<button type="button" class="btn btn-danger waves-effect waves-light mb-2" onclick="add_banner_section3('Offers');">Add You May Like Products</button></h4>
														</div>
													<?php } ?>
													<div class="d-flex flex-wrap">
														<?php
														if ($query6->num_rows > 0) {
															while ($rows6 = $query6->fetch_assoc()) {
																$imgarray3 = json_decode($rows6['featured_img'], true);
																$imageurl3 = MEDIAURL . $imgarray3['72-72'];
														?>
																<div class="col-md-4 m-0" id="popdiv<?= $rows6['id']; ?>">
																	<div class="tabb-color">
																		<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?= $rows6['id']; ?>');"><i class="fa fa-trash"></i></a></span>

																		<div class="yello-img">
																			<img src="<?= $imageurl3;  ?>">
																		</div>
																		<div class="yello-text">
																			<p><b><?= $rows6['prod_name']; ?></b></p>
																			<p class="mb-1"></p>

																		</div>
																	</div>
																</div>
														<?php }
														} ?>
													</div>
												</div>
												<div id="most_div" class="tab-pane fade">
													<?php
													//sql for top banner
													$query7 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,popular_product pp WHERE pd.status IN(1) AND pp.product_id= pd.product_unique_id  AND pp.type = 'Most' order by pp.id asc");


													?>
													<?php if ($query7->num_rows <= 15) { ?>
														<div class="col-md-12 ">
															<button type="button" class="btn btn-danger waves-effect waves-light mb-2" onclick="add_banner_section3('Most');">Add Most Populor Products</button></h4>
														</div>
													<?php } ?>
													<div class="d-flex flex-wrap">
														<?php
														if ($query7->num_rows > 0) {
															while ($rows7 = $query7->fetch_assoc()) {
																$imgarray3 = json_decode($rows7['featured_img'], true);
																$imageurl3 = MEDIAURL . $imgarray3['72-72'];
														?>
																<div class="col-md-4 m-0" id="popdiv<?= $rows7['id']; ?>">
																	<div class="tabb-color">
																		<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?= $rows7['id']; ?>');"><i class="fa fa-trash"></i></a></span>

																		<div class="yello-img">
																			<img src="<?= $imageurl3;  ?>">
																		</div>
																		<div class="yello-text">
																			<p><b><?= $rows7['prod_name']; ?></b></p>
																			<p class="mb-1"></p>

																		</div>
																	</div>
																</div>
														<?php }
														} ?>
													</div>
												</div>
												<div id="custom_div" class="tab-pane fade">
													<?php
													//sql for top banner
													$query8 = $conn->query("SELECT pp.id, pd.prod_name, pd.featured_img FROM product_details pd,popular_product pp WHERE pd.status IN(1) AND pp.product_id= pd.product_unique_id  AND pp.type = 'Custom' order by pp.id asc");


													?>
													<?php if ($query8->num_rows <= 15) { ?>
														<div class="col-md-12 ">
															<button type="button" class="btn btn-danger waves-effect waves-light mb-2" onclick="add_banner_section3('Custom');">Add Your Custom Products</button></h4>
														</div>
													<?php } ?>
													<div class="d-flex flex-wrap">
														<?php
														if ($query8->num_rows > 0) {
															while ($rows8 = $query8->fetch_assoc()) {
																$imgarray3 = json_decode($rows8['featured_img'], true);
																$imageurl3 = MEDIAURL . $imgarray3['72-72'];
														?>
																<div class="col-md-4 m-0" id="popdiv<?= $rows8['id']; ?>">
																	<div class="tabb-color">
																		<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?= $rows8['id']; ?>');"><i class="fa fa-trash"></i></a></span>

																		<div class="yello-img">
																			<img src="<?= $imageurl3;  ?>">
																		</div>
																		<div class="yello-text">
																			<p><b><?= $rows8['prod_name']; ?></b></p>
																			<p class="mb-1"></p>

																		</div>
																	</div>
																</div>
														<?php }
														} ?>
													</div>
												</div>
											</div>
										</div>
									</div>

									<?php
									$section3_image1 = $section3_link1 = '';
									//sql for top banner
									$query7 = $conn->query("SELECT * FROM `homepage_banner` WHERE section = 'section4'");
									$section3_type1 = 'sec3';
									if ($query7->num_rows > 0) {


										while ($rows7 = $query7->fetch_assoc()) {
											if ($rows7['type'] == 'sec3') {
												$img_decode7 = json_decode($rows7['image']);
												$section3_image1 = MEDIAURL . $img_decode7->{'1930-150'};
												$section3_link1 = $rows7['link'];
											}
										}
									}
									?>
									<div class="row mt-5">
										<div class="col-md-12 portfolio-item filter-app">

										</div>
										<div class="col-md-12 portfolio-item filter-app">

										</div>
										<div class="col-md-12 portfolio-item filter-app">
											<div class="section-header portfolio-wrap p-2">
												<img style="width:inherit; object-fit:cover" src="<?= $section3_image1; ?>" class="img-fluid" alt="">
												<h3> Top Selling Banner</h3>
												<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section4( '<?= $section3_link1; ?>', '<?= $section3_type1; ?>');">Upload</button>

											</div>
										</div>
										<div class="col-md-12 portfolio-item filter-app">

										</div>
										<div class="col-md-12 portfolio-item filter-card">

										</div>

									</div>


								</div>
							</section><!-- End Portfolio Section -->

							<?php
							$section10_image1 = $section10_link1 = '';
							//sql for top banner
							$query10 = $conn->query("SELECT * FROM `homepage_banner` WHERE section = 'section10'");
							$section10_type1 = 'sec10';
							if ($query10->num_rows > 0) {


								while ($rows10 = $query10->fetch_assoc()) {
									if ($rows10['type'] == 'sec10') {
										$img_decode10 = json_decode($rows10['image']);
										$section10_image1 = MEDIAURL . $img_decode10->{'1900-320'};
										$section10_link1 = $rows10['link'];
									}
								}
							}
							?>
							<section>
								<div class="container">
									<div class="col-lg-12">
										<div class="row">
											<div class="section-header">
												<img style="width:inherit;height :265px;" src="<?= $section10_image1; ?>" class="img-fluid" alt="">
												<br><br>
												<h3> Trending Banner</h3>
												<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section10( '<?= $section10_link1; ?>', '<?= $section10_type1; ?>');">Upload</button>

											</div>


										</div>
									</div>
								</div>
							</section>

							<?php
							$section11_image1 = $section11_link1 = '';
							//sql for top banner
							$query11 = $conn->query("SELECT * FROM `homepage_banner` WHERE section = 'section11'");
							$section11_type1 = 'sec11';
							if ($query11->num_rows > 0) {


								while ($rows11 = $query11->fetch_assoc()) {
									if ($rows11['type'] == 'sec11') {
										$img_decode11 = json_decode($rows11['image']);
										$section11_image1 = MEDIAURL . $img_decode11->{'1900-320'};
										$section11_link1 = $rows11['link'];
									}
								}
							}
							?>
							<section>
								<div class="container">
									<div class="col-lg-12">
										<div class="row">
											<div class="section-header">
												<img style="width:inherit;height :265px;" src="<?= $section11_image1; ?>" class="img-fluid" alt="">
												<br><br>
												<h3> Most Populor Banner</h3>
												<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section11( '<?= $section11_link1; ?>', '<?= $section11_type1; ?>');">Upload</button>

											</div>


										</div>
									</div>
								</div>
							</section>


							<?php
							$section12_image1 = $section12_link1 = '';
							//sql for top banner
							$query12 = $conn->query("SELECT * FROM `homepage_banner` WHERE section = 'section12'");
							$section12_type1 = 'sec12';
							if ($query12->num_rows > 0) {


								while ($rows12 = $query12->fetch_assoc()) {
									if ($rows12['type'] == 'sec12') {
										$img_decode12 = json_decode($rows12['image']);
										$section12_image1 = MEDIAURL . $img_decode12->{'1900-320'};
										$section12_link1 = $rows12['link'];
									}
								}
							}
							?>
							<section>
								<div class="container">
									<div class="col-lg-12">
										<div class="row">
											<div class="section-header">
												<img style="width:inherit;height :265px;" src="<?= $section12_image1; ?>" class="img-fluid" alt="">
												<br><br>
												<h3> Customize Clothing Banner</h3>
												<button type="button" class="btn btn-dark waves-effect waves-light" onclick="add_banner_section12( '<?= $section12_link1; ?>', '<?= $section12_type1; ?>');">Upload</button>

											</div>


										</div>
									</div>
								</div>
							</section>


							

						</div>
					</div>
				</div>
				
				<?php */ ?>

				<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

				<!-- Modal -->
				<div class="modal fade" id="myModalsection1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog  modal-dialog-centered">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Banner</h5>
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<form class="form" id="add_brand_form" enctype="multipart/form-data">

									<div class="form-group">
										<label for="name">Banner Link (Category, Product or any landing page)</label>
										<input type="text" class="form-control" id="banner_link" placeholder="Banner Link">
									</div>
									<div class="form-group">
										<label for="image">Image</label>
										<input type="file" name="banner_image" id="banner_image" class="form-control-file" onchange="uploadFile1('banner_image')" required accept="image/png, image/jpeg,image/jpg,image/gif">
									</div>
									<input type="hidden" id="banner_type">
									<input type="hidden" id="banner_section">
									<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_banner_btn">Add</button>
								</form>
							</div>

						</div>

					</div>
				</div>

				<div class="modal fade" id="myModalcat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog  modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Banner</h5>
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<div id="new_cat_div">
									<div class="form-group" id="parent_cat_div">
										<label for="name">Select Category</label>
										<div class="dropdownss">
											<div id="treeSelect">
												<div class="pt-2 pl-2">
													<?php

													$query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND status ='1' ORDER BY cat_name ASC");

													if ($query->num_rows > 0) {
														while ($row = $query->fetch_assoc()) {
															$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1'");
															if ($query1->num_rows > 0) {
																echo '<span class="expand" ><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" id="cat' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
															<br />    
															<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';
																echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
																echo	'</ul>';
															} else {
																echo '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" id="cat' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
															<br />';
															}
														}
													}

													?>
												</div>
											</div>

										</div>

									</div>
								</div>
								<div class="form-group" style="display:none;">
									<label for="name">Banner Link (Category, Product or any landing page)</label>
									<input type="text" class="form-control" id="banner_linkcat" placeholder="Banner Link">
								</div>
								<div class="form-group">
									<label for="image">Image</label>
									<input type="file" name="banner_imagecat" id="banner_imagecat" class="form-control-file" onchange="uploadFile1('banner_imagecat')" required accept="image/png, image/jpeg,image/jpg,image/gif">
								</div>
								<input type="hidden" id="banner_typecat">
								<input type="hidden" id="banner_sectioncat">
								<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_catbanner_btn">Add</button>
							</div>
						</div>
					</div>
				</div>
				
				<div class="modal fade" id="myModaltitle" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog  modal-dialog-centered">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Section Title</h5>
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<form class="form" id="add_brand_form" enctype="multipart/form-data">
									<input type="hidden" id="bannersection_type">

									<label for="name">Add title</label>
									<div class="form-group d-flex" id="product_div">
										<div class="frmSearch">
											<input type="text" class="form-control" id="section_title" placeholder="Section Title" />
											
										</div>

										<button type="submit" class="ml-2 btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_title_btn">Add</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog  modal-dialog-centered">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Product</h5>
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<form class="form" id="add_brand_form" enctype="multipart/form-data">
									<input type="hidden" id="bannerprod_type">

									<label for="name">Select Product</label>
									<div class="form-group d-flex" id="product_div">
										<div class="frmSearch">
											<input type="text" class="form-control1" id="search-box" placeholder="Product Name" />
											<input type="hidden" id="product-id" />
											<div id="suggesstion-box"></div>
										</div>

										<button type="submit" class="ml-2 btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_product_btn">Add</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
function categoryTree($parent_id, $sub_mark = '')
{
	global $conn;
	$query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id AND status = '1' ORDER BY cat_name ASC");

	if ($query->num_rows > 0) {
		while ($row = $query->fetch_assoc()) {
			$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1'");
			if ($query1->num_rows > 0) {
				echo '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" id="cat' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
						<br />    
						<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';
				echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
				echo '</ul>';
			} else {
				echo '<li><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" id="cat' . $row['cat_id'] . '" class="check_category_limit"> ' . $row['cat_name'] . '</li>';
			}
		}
	}
}

?>
<?php include('footernew.php'); ?>
<script src="js/admin/newhomepage_web.js"></script>