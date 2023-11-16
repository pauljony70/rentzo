<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = $productdetails['name'];
	include("include/headTag.php");
	$main_url_img = str_replace("-430-590", '', $productdetails['imgurl']);
	?>

	<!-- Plugin css -->
	<link rel="stylesheet" href="<?= base_url('assets_web/libs/swiper/swiper-bundle.min.css') ?>" />

	<?php if ($productdetails['meta_title'] != '') { ?>
		<meta name="og_title" property="og:title" content="<?= $productdetails['meta_title']; ?>" />
	<?php } else { ?>
		<meta name="og_title" property="og:title" content="<?= $productdetails['name']; ?>" />
	<?php } ?>
	<meta name="og_site_name" property="og:site_name" content="Rentzo.om" />

	<?php if ($productdetails['meta_key'] != '') { ?>
		<meta property="og:keywords" content="<?= $productdetails['meta_key']; ?>" />
	<?php } ?>

	<?php if ($productdetails['meta_value'] != '') { ?>
		<meta property="og:description" content="<?= $productdetails['meta_value']; ?>" />
	<?php } else { ?>
		<meta property="og:description" content="<?= strip_tags($productdetails['short_desc']); ?>" />
	<?php } ?>
	<meta name="og_image" property="og:image" content="<?= weburl . 'media/' . $main_url_img; ?>" />

	<!-- Plugin Css -->
	<!-- <link rel="stylesheet" type="text/css" href="https://punjablive1.com/dist/style/toastify.min.css"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
	<link rel="stylesheet" href="<?= base_url('assets_web/libs/nouislider/dist/nouislider.min.css') ?>">
	<script src="<?= base_url('assets_web/libs/js-image-zoom-master/package/js-image-zoom.js') ?>"></script>

	<!-- Custom Css -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/product-details.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/product-card.css') ?>">


</head>

<body class="prod_details">
	<?php include("include/loader.php") ?>
	<?php include("include/topbar.php") ?>
	<?php include("include/navbar.php") ?>

	<main class="product-details-page">
		<?php
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		?>

		<!-- Video Modal -->
		<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg d-flex align-items-center h-100 justify-content-center m-0 mx-auto">
				<div class="modal-content">
					<!-- <div class="modal-header" style="border: 0;">
						<button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
					</div> -->
					<div class="modal-body p-0">
						<video controls class="w-100">
							<source src="<?= weburl . 'media/' . $productdetails['youtube_url']; ?>" type="video/mp4">
						</video>
					</div>
				</div>
			</div>
		</div>

		<!-- Share URL -->
		<input type="text" value="<?= $actual_link; ?>" name="myInput" id="myInput" style="display: none;">

		<!-- Topbar for Mobile -->
		<!-- <div class="d-flex justify-content-between align-items-center h-100 responsive_nav d-block d-sm-none">
			<div class="nav_inner"></div>
			<svg class="fa-angle-left ms-3" onclick="history.back(-1)" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M15.5 19.5 8 12l7.5-7.5" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
			</svg>
			<svg class="fa-heart me-3" onclick="add_to_wishlist(event,'<?= $productdetails['id'] ?>','<?= $productdetails['sku'] ?>','<?= $productdetails['vendor_id'] ?>','<?= $this->session->userdata('user_id'); ?>',1,'',2)" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M12 20S3 14.91 3 8.727c0-1.093.375-2.152 1.06-2.997a4.672 4.672 0 0 1 2.702-1.638 4.639 4.639 0 0 1 3.118.463A4.71 4.71 0 0 1 12 6.909a4.71 4.71 0 0 1 2.12-2.354 4.639 4.639 0 0 1 3.118-.463 4.672 4.672 0 0 1 2.701 1.638A4.756 4.756 0 0 1 21 8.727C21 14.91 12 20 12 20z" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
			</svg>
		</div> -->

		<!-- All Hidden Fields to Perform POST Request -->
		<input type="hidden" name="sku" id="sku" value="<?= $_REQUEST['sku']; ?>">
		<input type="hidden" name="sid" id="sid" value="<?= $_REQUEST['sid']; ?>">
		<input type="hidden" name="pid" value="<?= $_REQUEST['pid']; ?>" id="pid">
		<input type="hidden" name="user_id" value="<?= $this->session->userdata("user_id"); ?>" id="user_id">
		<input type="hidden" name="qoute_id" value="<?= $this->session->userdata("qoute_id"); ?>" id="qoute_id">
		<input type="hidden" name="whats_btn" value="<?= $product_custom_cloth; ?>" id="whats_btn">
		<input type="hidden" name="whatsapp_number" value="<?= whatsapp_number; ?>" id="whatsapp_number">

		<!--Start: Slider Section -->
		<section class="product-slider my-2 my-md-5">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-4">
								<a href="#" class="breadcrumb-item">Home</a>
								<a href="#" class="breadcrumb-item">Library</a>
								<li class="breadcrumb-item active" aria-current="page"><?= $productdetails['name']; ?></li>
							</ol>
						</nav>
					</div>
				</div>
				<div class="row mb-5">
					<!--
						--------------------------------------------------- 
						Desktop image gallery
						---------------------------------------------------
					-->
					<div class="col-md-5 product-gallery d-none d-md-block">
						<div class="left-block">
							<?php if ($productdetails['stock_status'] == 'Out of Stock' || $productdetails['stock'] <= 0) { ?>
								<?php if ($default_language == 1) : ?>
									<img alt="" class="outof_stock" src="<?= weburl . 'assets/img/out-of-stock-ar.png'; ?>">
								<?php else : ?>
									<img alt="" class="outof_stock" src="<?= weburl . 'assets/img/out-of-stock-en.png'; ?>">
								<?php endif; ?>
							<?php } ?>
							<div class="app-figure" id="zoom-fig">

							</div>
							<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px;" class="swiper product-details-swiper">
								<div class="swiper-wrapper">
									<?php if (!empty($productdetails['gallary_img_url'])) {
										foreach ($productdetails['gallary_img_url'] as $gallary) { ?>
											<a class="swiper-slide aaaaa" data-fancybox="group" href="<?= base_url('media/' . $gallary['url']) ?>">
												<img src="<?= base_url('media/' . $gallary['url']) ?>" />
											</a>
										<?php }
									} else { ?>
										<a class="swiper-slide" data-fancybox="group" href="<?= base_url('media/' . $productdetails['imgurl']) ?>">
											<img src="<?= base_url('media/' . $productdetails['imgurl']) ?>" />
										</a>
									<?php } ?>
									<?php if ($productdetails['youtube_url'] != '') { ?>
										<a class="swiper-slide my-auto" data-fancybox="group" href="<?= weburl . 'media/' . $productdetails['youtube_url']; ?>">
											<video style="height:inherit;width:inherit;" id="product-video">
												<source src="<?= weburl . 'media/' . $productdetails['youtube_url']; ?>" type="video/mp4">
											</video>
											<div id="custom-play-button" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><i class="fa-solid fa-play" style="font-size: 1.5rem; padding: 12px 16px; border-radius:50%; background-color: #ffffff8b; color: #333"></i></div>
										</a>
									<?php } ?>
								</div>
							</div>
							<div thumbsSlider="" class="swiper product-details-swiper-sm d-none d-md-block">
								<div class="swiper-wrapper">
									<?php if (!empty($productdetails['gallary_img_url'])) {
										foreach ($productdetails['gallary_img_url'] as $gallary) { ?>
											<div class="swiper-slide my-auto">
												<img src="<?= base_url('media/' . $gallary['url']) ?>" />
											</div>
										<?php }
									} else { ?>
										<div class="swiper-slide my-auto">
											<img src="<?= base_url('media/' . $productdetails['imgurl']) ?>" />
										</div>
									<?php } ?>
									<?php if ($productdetails['youtube_url'] != '') { ?>
										<div class="swiper-slide my-auto">
											<video style="height:inherit;width:inherit;">
												<source src="<?= weburl . 'media/' . $productdetails['youtube_url']; ?>" type="video/mp4">
											</video>
											<a style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><i class="fa-solid fa-play" style="font-size: 1.0rem; padding: 8px 12px; border-radius:50%; background-color: #ffffff8b"></i></a>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

					<!-- For Description of Product -->
					<div class="col-md-7 product_detail_desc_div">
						<div class="right-block">
							<!-- Name of Product -->
							<div class="d-flex justify-content-between align-items-center">
								<h1 class="product-name line-clamp-2 mb-2 mb-md-4"><?= $productdetails['name']; ?></h1>
							</div>

							<!-- Rating of Product -->
							<div class="product-location mb-2">
								<div class="d-flex">
									<img src="<?= base_url('assets_web/images/icons/location-pin-grey.svg') ?>" alt="Location">
									<div class="location ms-2">Location Name city, state</div>
								</div>
							</div>

							<!-- 
								---------------------------------------------------
								Rating of Product 
								---------------------------------------------------
							-->
							<div class="d-flex mb-4 ratings-tab align-items-center justify-content-between">
								<div class="d-flex flex-wrap align-items-center">
									<?php if ($product_review_total['total_rows'] > 0) : ?>
										<div class="d-flex stars me-2">
											<?php
											$rating = round(($product_review_total['total_rating'] / $product_review_total['total_rows']) * 2) / 2;
											// Calculate the whole number and fractional part of the rating
											$wholeNumber = floor($rating);
											$fractionalPart = $rating - $wholeNumber;

											// Loop through the whole number part and display solid stars
											for ($i = 0; $i < $wholeNumber; $i++) {
												echo '<img src="' . base_url('assets_web/images/icons/star-yellow.svg') . '" alt="Star">';
											}

											// Check the fractional part to display half or empty star
											if ($fractionalPart >= 0.5) {
												echo '<img src="' . base_url('assets_web/images/icons/half-star.svg') . '" alt="Star">';
											} else {
												echo '<img src="' . base_url('assets_web/images/icons/star-grey.svg') . '" alt="Star">';
											}

											// Calculate the remaining empty stars
											$emptyStars = 5 - $wholeNumber - 1; // Subtract 1 for the half star

											// Display the remaining empty stars
											for ($i = 0; $i < $emptyStars; $i++) {
												echo '<img src="' . base_url('assets_web/images/icons/star-grey.svg') . '" alt="Star">';
											}
											?>
										</div>
									<?php endif; ?>
									<a href="#review_of_product" class="rating-details">(<?= $product_review_total['total_rows'] ?> Reviews)</a>
									<div class="seperator mx-3">|</div>
									<div class="d-flex align-items-center stock-status">
										In Stock
									</div>
								</div>
								<div class="toggle-btn d-flex">
									<span class="share-icon">
										<div class="d-flex align-items-center" id="share-btn">
											<img src="<?= base_url('assets_web/images/icons/share.svg') ?>" alt="Share">
										</div>
										<div class="hover-card box-shadow">
											<div class="d-flex justify-content-between flex-wrap">
												<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= $actual_link ?>" title="Facebook Share" class="brand-icon facebook">
													<img src="<?= base_url('assets_web/images/brands/facebook.svg') ?>" alt="Facebook" srcset="">
												</a>
												<a target="_blank" href="whatsapp://send?text=<?= $actual_link ?>" class="brand-icon whatsapp">
													<img src="<?= base_url('assets_web/images/brands/whatsapp.svg') ?>" alt="Facebook" srcset="">
												</a>
												<a target="_blank" href="http://twitter.com/share?url=<?= $actual_link ?>&text=I ♥ this product on Rentzo! <?= $productdetails['name']; ?>&via=Rentzo&hashtags=buyonRentzo" class="brand-icon twitter">
													<img src="<?= base_url('assets_web/images/brands/twitter.svg') ?>" alt="Twitter" srcset="">
												</a>
												<a target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?= $actual_link ?>&media=<?= urlencode(weburl . 'media/' . $main_url_img) ?>&description=<?= urlencode($productdetails['name'] . ' - ' . strip_tags($productdetails['short_desc'])) ?>" class="brand-icon pinterest">
													<img src="<?= base_url('assets_web/images/brands/pinterest.svg') ?>" alt="Pinterest" srcset="">
												</a>
											</div>
											<span class="arrow"></span>
										</div>
									</span>
									<span class="mobile-share-icon" onclick="mobileShareLink('<?= $actual_link ?>')">
										<div class="d-flex align-items-center" id="share-btn">
											<img src="<?= base_url('assets_web/images/icons/share.svg') ?>" alt="Share">
										</div>
									</span>
								</div>
							</div>

							<!-- 
								---------------------------------------------------
								Price of Product 
								---------------------------------------------------
							-->
							<div class="rent-price">
								<?= $productdetails['price']; ?>/ day
							</div>

							<hr class="d-none d-md-block">

							<!--
								--------------------------------------------------- 
								Mobile image gallery
								---------------------------------------------------
							-->
							<div class="row image-gallery-mob my-3 d-flex d-md-none">
								<div class="col-9 h-100 pe-1">
									<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px;" class="swiper product-details-swiper-mob">
										<div class="swiper-wrapper">
											<?php if (!empty($productdetails['gallary_img_url'])) {
												foreach ($productdetails['gallary_img_url'] as $gallary) { ?>
													<a class="swiper-slide spotlight zoom-img" data-fancybox="mobile-group" href="<?= base_url('media/' . $gallary['url']) ?>">
														<img src="<?= base_url('media/' . $gallary['url']) ?>" />
													</a>
												<?php }
											} else { ?>
												<a class="swiper-slide spotlight zoom-img" data-fancybox="mobile-group" href="<?= base_url('media/' . $productdetails['imgurl']) ?>">
													<img src="<?= base_url('media/' . $productdetails['imgurl']) ?>" />
												</a>
											<?php } ?>
											<?php if ($productdetails['youtube_url'] != '') { ?>
												<a href="<?= weburl . 'media/' . $productdetails['youtube_url']; ?>" data-fancybox="mobile-group" class="swiper-slide">
													<video style="height:inherit;width:inherit;" id="product-video">
														<source src="<?= weburl . 'media/' . $productdetails['youtube_url']; ?>" type="video/mp4">
													</video>
													<div id="custom-play-button" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><i class="fa-solid fa-play" style="font-size: 1.5rem; padding: 12px 16px; border-radius:50%; background-color: #ffffff8b; color: #333"></i></div>
												</a>
											<?php } ?>
										</div>
									</div>
								</div>

								<div class="col-3 h-100 ps-1">
									<div thumbsSlider="" class="swiper product-details-swiper-sm-mob py-0">
										<div class="swiper-wrapper">
											<?php if (!empty($productdetails['gallary_img_url'])) {
												foreach ($productdetails['gallary_img_url'] as $gallary) { ?>
													<div class="swiper-slide">
														<img src="<?= base_url('media/' . $gallary['url']) ?>" />
													</div>
												<?php }
											} else { ?>
												<div class="swiper-slide">
													<img src="<?= base_url('media/' . $productdetails['imgurl']) ?>" />
												</div>
											<?php } ?>
											<?php if ($productdetails['youtube_url'] != '') { ?>
												<div class="swiper-slide">
													<video style="height:inherit;width:inherit;">
														<source src="<?= weburl . 'media/' . $productdetails['youtube_url']; ?>" type="video/mp4">
													</video>
													<a style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><i class="fa-solid fa-play" style="font-size: 1.0rem; padding: 8px 12px; border-radius:50%; background-color: #ffffff8b"></i></a>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>

							<!--
								--------------------------------------------------- 
								Rent Details of Product
								---------------------------------------------------
							-->
							<table class="rent-details-table text-center mb-4">
								<thead>
									<tr>
										<th class="px-4 py-3">Rent for 3 days</th>
										<th class="px-4 py-3">Rent for 5 days</th>
										<th class="px-4 py-3">Rent for 7 days</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="py-4">$6.00</td>
										<td class="py-4">$10.00</td>
										<td class="py-4">$12.00</td>
									</tr>
								</tbody>
							</table>


							<!-- Description of product that is color and size -->
							<div class="pDetails">
								<div class="product-size mb-4 mb-lg-4">
									<input type="hidden" name="attribute_data" value="<?= json_encode($productdetails['configure_attr']); ?>">
									<?php
									foreach ($productdetails['configure_attr'] as $p_weight) {

										if (!empty($p_weight['item'])) { ?>
											<span class="fw-bold"><?= $p_weight['attr_name']; ?></span>
										<?php  } ?>
										<?php $symbols = array(' ', ',', '.', '!', '@', '#', '$', '%', '&', '*', '+', '-', '/'); ?>
										<div class="p-size">
											<input type="hidden" name="<?= str_replace([' ', ',', '.', '!', '@', '#', '$', '%', '^', '&', '+', '/', '*', '(', ')'], '_', $p_weight['attr_name']); ?>_attr_name" id="<?= str_replace([' ', ',', '.', '!', '@', '#', '$', '%', '^', '&', '+', '/', '*', '(', ')'], '_', $p_weight['attr_name']); ?>_attr_name" value="<?= $p_weight['attr_name']; ?>">
											<input type="checkbox" style="display:none" name="<?= str_replace([' ', ',', '.', '!', '@', '#', '$', '%', '^', '&', '+', '/', '*', '(', ')'], '_', $p_weight['attr_name']); ?>_attr_id" id="<?= str_replace([' ', ',', '.', '!', '@', '#', '$', '%', '^', '&', '+', '/', '*', '(', ')'], '_', $p_weight['attr_name']); ?>_attr_id" class="product_attributes" value="<?= $p_weight['attr_id']; ?>">
											<?php
											//foreach ($productdetails['configure_attr'] as $p_weight) {
											if (empty($p_weight['item'])) {
											} else {
												foreach ($p_weight['item'] as $product_weight) {
											?>
													<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
														<input type="radio" onclick="get_product_attributes('<?= $p_weight['attr_name']; ?>')" class="btn-check attribute-values" attribute-label="<?= str_replace([' ', ',', '.', '!', '@', '#', '$', '%', '^', '&', '+', '/', '*', '(', ')'], '_', $p_weight['attr_name']); ?>" name="btnradio_<?= $p_weight['attr_name']; ?>" id="<?= $product_weight['itemvalue']; ?>" value="<?= $product_weight['itemvalue']; ?>" autocomplete="off">
														<label <?php if ($p_weight['attr_name'] == 'Color') {
																	$rgb = hexToRgb($product_weight['itemvalue']);
																	$dark_color = "rgb(" . $rgb['r'] * 0.8 . "," . $rgb['g'] * 0.8 . ',' . $rgb['b'] * 0.8 . ")";
																	echo 'style="background-color:' . $product_weight['itemvalue'] . '; border: 1px solid ' . $dark_color . '"';
																} ?> class="<?= $p_weight['attr_name']; ?> btn btn-outline-primary " for="<?= $product_weight['itemvalue']; ?>">
															<?php if ($p_weight['attr_name'] != 'Color') {
																echo $product_weight['itemvalue'];
															} ?></label>
													</div>
											<?php }
											} ?>
										</div>
									<?php

									}  ?>
								</div>
							</div>

							<div id="cart_btns" class="mb-5"></div>

							<!-- Add to Cart and By now and Whatsapp Buttons -->
							<div class="btn-wrap align-items-center pBtns bg-white d-flex mb-4 py-2 py-md-0">
								<?php if ($productdetails['stock'] != '0' && $productdetails['stock_status'] != 'Out of Stock') { ?>
									<a class="btn btn-warning" data-bs-toggle="offcanvas" href="#rentOffcanvas" role="button" aria-controls="rentOffcanvas">For Rent</a>

									<a href="#" onclick="add_to_cart_products(this, event,'<?php echo $productdetails['id'] ?>','<?php echo $productdetails['sku'] ?>','<?php echo $productdetails['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-primary">
										Buy Now
									</a>
								<?php } else { ?>
									<button type="button" class="btn btn-lg btn-secondary d-flex align-items-center justify-content-center" style="width: fit-content;">
										<div class="d-flex justify-content-center align-items-center h-100">
											<div class="mx-2 mt-1 fw-bolder text-uppercase"><?= $this->lang->line('out-of-stock') ?></div>
										</div>
									</button>
								<?php } ?>

								<a class="btn btn-light wishlist-btn heart-container mx-2" onclick="add_to_wishlist(event,'<?= $productdetails['id'] ?>','<?= $productdetails['sku'] ?>','<?= $productdetails['vendor_id'] ?>','<?= $this->session->userdata('user_id'); ?>',1,'',2)">
									<div class="d-flex justify-content-center align-items-center h-100">
										<i class="fa-<?= $productdetails['wishlist_count'] > 0 ? 'solid' : 'regular' ?> fa-heart add-to-wishlist"></i>
									</div>
								</a>
							</div>

							<!-- 
								---------------------------------------------------
								Rent Offcanvas 
								---------------------------------------------------
							-->
							<div class="offcanvas offcanvas-end" tabindex="-1" id="rentOffcanvas" aria-labelledby="rentOffcanvasLabel">
								<div class="offcanvas-header">
									<h5 class="offcanvas-title" id="rentOffcanvasLabel">How many days for rent</h5>
									<button type="button" class="close-btn-offcanvas text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
										<i class="fa-solid fa-xmark"></i>
									</button>
								</div>
								<div class="offcanvas-body">
									<div class="d-flex justify-content-between mb-2">
										<div class="day-wise-rent-price"><?= price_format(10) ?></div>
										<div class="day-wise-rent-price"><?= price_format(10) ?></div>
										<div class="day-wise-rent-price"><?= price_format(10) ?></div>
										<div class="day-wise-rent-price"><?= price_format(10) ?></div>
									</div>
									<div class="day-slider-div px-2 mb-5">
										<div id="day-slider"></div>
									</div>
									<div class="calender"></div>
									<div class="dates-div">
										<div class="d-flex align-items-center">
											<div class="heading">Arrival Date</div>
											<div class="d-flex align-items-center date ms-5">
												<div class="image">
													<img src="<?= base_url('assets_web/images/icons/calender.svg') ?>" alt="Date">
												</div>
												<div class="ms-2">15/11/2023</div>
											</div>
										</div>
										<hr>
										<div class="d-flex align-items-center">
											<div class="heading">Arrival Date</div>
											<div class="d-flex align-items-center date ms-5">
												<div class="image">
													<img src="<?= base_url('assets_web/images/icons/calender.svg') ?>" alt="Date">
												</div>
												<div class="ms-2">15/11/2023</div>
											</div>
										</div>
									</div>
									<div class="availability-status mt-3 text-success">
										Available on this date
									</div>
									<hr>
									<div class="security-deposit d-flex justify-content-between">
										<div>Security deposit</div>
										<div><?= price_format(100) ?></div>
									</div>
									<div class="security-deposit-des text-danger mt-3">Security deposit is refundable **</div>
								</div>
								<div class="offcanvas-footer d-flex flex-column justify-content-center align-items-center">
									<div class="d-flex justify-content-between w-100 mb-4">
										<div class="heading">Total Rent</div>
										<div id="selected-day">5 Days</div>
										<div id="total-rent"><?= price_format(11.25) ?></div>
									</div>
									<div class="btn btn-primary w-100">Continue</div>
								</div>
							</div>

							<!-- 
								---------------------------------------------------
								Cart Offcanvas 
								---------------------------------------------------
							-->
							<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
								<div class="offcanvas-header">
									<h5 id="cartOffcanvasLabel" class="fw-bolder fs-4 mb-0 mt-1">Cart</h5>
									<button type="button" class="close-btn-offcanvas text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
										<i class="fa-solid fa-xmark"></i>
									</button>
								</div>
								<div class="offcanvas-body">
									<div class="row"></div>
								</div>
								<div class="offcanvas-footer py-0"></div>
								<div id="offcanvas-loader">
									<div class="spinner-border text-primary" role="status">
										<span class="visually-hidden">Loading...</span>
									</div>
								</div>
							</div>

							<!-- 
								---------------------------------------------------
								Badges 
								---------------------------------------------------
							-->
							<div class="badges mb-4">
								<div class="d-flex flex-wrap">
									<img src="<?= base_url('assets_web/images/badges/badge1.png') ?>" alt="Badge">
									<img src="<?= base_url('assets_web/images/badges/badge2.png') ?>" alt="Badge">
									<img src="<?= base_url('assets_web/images/badges/badge3.png') ?>" alt="Badge">
								</div>
							</div>

							<!-- 
								---------------------------------------------------
								Return Policy 
								---------------------------------------------------
							-->
							<?php if ($productdetails['return_policy_title'] != '') { ?>
								<div class="return-product mb-4">
									<button type="button" data-bs-toggle="modal" data-bs-target="#policyModal">RETURN POILICY</button>
								</div>
							<?php } ?>


							<!-- 
								---------------------------------------------------
								Product Info Table 
								---------------------------------------------------
							-->
							<?php if (!empty($productdetails['product_info'])) : ?>
								<div class="table-responsive mb-4">
									<label class="mb-3 product_detail_headings" for="">Product Specification</label>
									<table class="table table-hover table-centered product-info-table">
										<?php foreach ($productdetails['product_info'] as $product_info) : ?>
											<tr>
												<td class="heading py-3"><?= $product_info['attribute'] ?></td>
												<td class="body py-3">
													<?php
													$values = array_column($product_info['info'], 'product_info_set_value');
													echo implode(', ', $values);
													?>
												</td>
											</tr>
										<?php endforeach; ?>
									</table>
								</div>
							<?php endif; ?>

							<!-- 
								---------------------------------------------------
								Product Details 
								---------------------------------------------------
							-->
							<div class="product-details mb-4">
								<label class="mb-3 product_detail_headings" for="">About This Product</label>
								<div class="product-full-desc product_description_content"><?= $productdetails['fulldetail']; ?></div>
							</div>

						</div>
					</div>
				</div>
				<!-- 
					---------------------------------------------------
					Review of Product 
					---------------------------------------------------
				-->
				<?php if (!empty($product_review) || $productdetails['order_count'] > 0) : ?>
					<div class="row reviews-row mb-5" id="review_of_product">
						<div class="d-flex align-items-center mb-3 mb-md-4">
							<label class="product_detail_headings" for="">Reviews</label>
							<div class="review-count ms-2"><?= $product_review_total['total_rows'] ?></div>
						</div>
						<?php if ($productdetails['order_count'] > 0) : ?>
							<div class="add-reviews btn-wrap d-block">
								<a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#reviewsModal">Add Review</a>
							</div>
						<?php endif; ?>
						<?php foreach ($product_review as $review) : ?>
							<div class="d-flex mb-3">
								<img src="<?= base_url('assets_web/images/icons/profile-lg.svg') ?>" alt="<?= $review->user_name; ?>" class="user-image p-1 d-none d-md-block">
								<div class="ms-0 ms-md-3">
									<div class="d-flex justify-content-between mb-2">
										<div class="d-flex align-items-center">
											<img src="<?= base_url('assets_web/images/icons/profile-lg.svg') ?>" alt="<?= $review->user_name; ?>" class="user-image p-1 d-block d-md-none">
											<div class="user-profile d-flex align-items-center ms-2 ms-md-0">
												<div class="user-name"><?= $review->user_name; ?></div>
											</div>
										</div>
										<div class="d-flex flex-column">
											<div class="review-date text-end"><?= date('d M Y', strtotime($review->review_date)); ?></div>
											<div class="d-flex stars text-end mt-auto">
												<?php
												$rating = round($review->rating * 2) / 2;
												// Calculate the whole number and fractional part of the rating
												$wholeNumber = floor($rating);
												$fractionalPart = $rating - $wholeNumber;

												// Loop through the whole number part and display solid stars
												for ($i = 0; $i < $wholeNumber; $i++) {
													echo '<img src="' . base_url('assets_web/images/icons/star-yellow.svg') . '" alt="Star">';
												}

												// Check the fractional part to display half or empty star
												if ($fractionalPart >= 0.5) {
													echo '<img src="' . base_url('assets_web/images/icons/half-star.svg') . '" alt="Star">';
												} else {
													echo '<img src="' . base_url('assets_web/images/icons/star-grey.svg') . '" alt="Star">';
												}

												// Calculate the remaining empty stars
												$emptyStars = 5 - $wholeNumber - 1; // Subtract 1 for the half star

												// Display the remaining empty stars
												for ($i = 0; $i < $emptyStars; $i++) {
													echo '<img src="' . base_url('assets_web/images/icons/star-grey.svg') . '" alt="Star">';
												}
												?>
											</div>
										</div>
									</div>
									<div class="review-title">
										<?= $review->review_title ?>
									</div>
									<div class="review-text mb-4">
										<?= $review->review_comment ?>
									</div>
									<div class="review-images d-flex flex-wrap">
										<img src="<?= base_url('assets_web/images/product2.svg') ?>" alt="Review">
										<img src="<?= base_url('assets_web/images/product2.svg') ?>" alt="Review">
										<img src="<?= base_url('assets_web/images/product2.svg') ?>" alt="Review">
										<img src="<?= base_url('assets_web/images/product2.svg') ?>" alt="Review">
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="mb-4-mb-md-5 text-center">
						<a href="#" class="show-all-review">Show All &nbsp;&nbsp;<i class="fa-solid fa-chevron-down"></i></a>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<!--End: Slider Section -->

		<!-- Slider Return Policy Modal -->
		<div class="modal fade" id="policyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body pt-0 return-policy faq">
						<!--Start: Return Policy Section -->
						<div class="container">
							<div class="header-wrap m-0">
								<h5><span>Return Policy</span></h5>
								<!--<p>(15 days product return policy)</p>-->
							</div>
							<br>

							<div class="wrap">
								<?= $productdetails['return_policy_description']; ?>
							</div>
						</div>
						<!--End: Return Policy Section -->
					</div>
				</div>
			</div>
		</div>
		<!--/*Slider Return Policy Modal -->

		<!-- Vendor Coupon Terms & Conditions -->
		<div class="modal fade" id="couponpolicyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body pt-0 return-policy faq">
						<!--Start: Return Policy Section -->
						<div class="container">
							<div class="header-wrap m-0">
								<h5><span>Terms & Conditions</span></h5>
								<!--<p>(15 days product return policy)</p>-->
							</div>
							<br>

							<div class="wrap">
								<?php echo $productdetails['coupon_terms'];  ?>
							</div>
						</div>
						<!--End: Return Policy Section -->
					</div>
				</div>
			</div>
		</div>
		<!--/*Vendor Coupon Terms & Conditions -->

		<!-- Slider Add Reviews Modal -->
		<div class="modal fade" id="reviewsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewsModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
				<div class="modal-content">
					<div class="d-flex p-2 align-items-center justify-content-between border-bottom">
						<h5 class="modal-title mt-1 px-2" id="reviewsModalLabel"><?= $this->lang->line('share-your-experience') ?></h5>
						<button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
					</div>
					<div class="modal-body">
						<form id="review_form" class="form">
							<div class="form-group mb-1">
								<label class="form-label mb-0"><?= $this->lang->line('rate-this-product') ?></label>
							</div>
							<div class="form-group">
								<label class="form-label"><?= $this->lang->line('title') ?> </label>
								<input type="text" class="form-control" name="reviewtitle" id="reviewtitle" placeholder="<?= $this->lang->line('title') ?>" />
							</div>
							<div class="form-group">
								<label class="form-label"><?= $this->lang->line('comment') ?></label>
								<textarea class="form-control" name="ProductReview" id="ProductReview" rows="5" placeholder="<?= $this->lang->line('comments-here') ?> ..."></textarea>
							</div>

							<div class="form-group d-flex">
								<div class="rating_star">
									<input value="5" name="star-radio" id="star-1" type="radio">
									<label for="star-1">
										<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
											<path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
										</svg>
									</label>
									<input value="4" name="star-radio" id="star-2" type="radio">
									<label for="star-2">
										<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
											<path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
										</svg>
									</label>
									<input value="3" name="star-radio" id="star-3" type="radio">
									<label for="star-3">
										<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
											<path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
										</svg>
									</label>
									<input value="2" name="star-radio" id="star-4" type="radio">
									<label for="star-4">
										<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
											<path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
										</svg>
									</label>
									<input value="1" name="star-radio" id="star-5" type="radio">
									<label for="star-5">
										<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
											<path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
										</svg>
									</label>
								</div>
							</div>
							<button class="btn" type="submit" style="background-color: #ff6600; color:white"><?= $this->lang->line('add_reviews') ?></button>
						</form>
					</div>
					<div id="modal-loader" class="d-none">
						<div class="spinner-border text-primary" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/*Slider Add Reviews Modal -->

		<!--Trending Section -->
		<!-- <section class="trending-section container px-1 px-md-2">
			<?php if (!empty($recently_viewed_product_details)) { ?>
				<h4 class="<?= $default_language == 1 ? 'me-3 me-lg-3' : 'ms-3 ms-lg-3' ?>"><?= $this->lang->line('recently-viewed-products') ?></h4>
			<?php } ?>
			<div class="swiper slider-trending2" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 18px;">
				<div class="swiper-wrapper" id="recently_viewed_products">
					<?php
					foreach ($recently_viewed_product_details as $recently_viewed_product_detail) :
						$params = array(
							'pid' => $recently_viewed_product_detail['id'],
							'sku' => $recently_viewed_product_detail['sku'],
							'sid' => $recently_viewed_product_detail['vendor_id']
						);
					?>
						<div class="swiper-slide product-card-swiper px-2 py-1">
							<a href="<?= base_url($recently_viewed_product_detail['web_url']) . '?' . http_build_query($params) ?>" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
								<?php if ($recently_viewed_product_detail['price'] !== $recently_viewed_product_detail['mrp']) : ?>
									<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
										<span class="discount text-uppercase">
											<div><?= $recently_viewed_product_detail['offpercent'] ?></div>
										</span>
										<span class="wishlist"><i class="fa fa-heart-o"></i></span>
									</div>
								<?php endif; ?>
								<div class="image-container zoom-img">
									<img src="<?= base_url('media/' . $recently_viewed_product_detail['imgurl']) ?>" class="zoom-img thumbnail-image">
								</div>
								<div class="product-detail-container p-2 mb-1">
									<div class="justify-content-between align-items-center" style="padding:5px;">
										<p class="dress-name mb-0"><?= $recently_viewed_product_detail['name'] ?></p>
										<div class="d-flex align-items-center justify-content-start flex-row mt-2" style="width: 100%;">
											<span class="new-price"><?= $recently_viewed_product_detail['price'] ?></span>
											<small class="old-price text-right mx-1"><?= $recently_viewed_product_detail['price'] !== $recently_viewed_product_detail['mrp'] ? $recently_viewed_product_detail['mrp'] : '' ?></small>
										</div>
									</div>
									<div class="d-flex justify-content-between align-items-center mt-1" style="padding: 0 5px;">
										<div class="d-flex align-items-center">
											<?php if ($recently_viewed_product_detail['rating']['total_rows'] > 0) : ?>
												<i class="fa-solid fa-star"></i>
												<div class="rating-number"><?= $recently_viewed_product_detail['rating']['total_rating'] / $recently_viewed_product_detail['rating']['total_rows'] ?></div>
											<?php endif; ?>
										</div>
										<button class="btn btn-primary text-center text-uppercase card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event, '<?= $recently_viewed_product_detail['id'] ?>', '<?= $recently_viewed_product_detail['sku'] ?>', '<?= $recently_viewed_product_detail['vendor_id'] ?>', '<?= $this->session->userdata('user_id') ?>', '1', '0', '2', '<?= $this->session->userdata('quote_id') ?>')"><?= $this->lang->line('buy') ?></button>
									</div>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</section> -->
		<!--/*Trending Section -->

		<!--Trending Section -->
		<section class="trending-section container mb-3 mb-md-5">
			<?php if (!empty($related_product)) { ?>
				<div class="d-flex align-items-center mb-3 mb-md-5">
					<div class="heading-border"></div>
					<div class="heading ms-3">Related Items</div>
				</div>
			<?php } ?>
			<div class="swiper slider-trending" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
				<div class="swiper-wrapper" id="related_product"></div>
			</div>
		</section>
		<!--/*Trending Section -->

		<!--Trending Section -->
		<!-- <section class="trending-section container px-1 px-md-2">
			<?php if (!empty($upsell_product)) { ?>
				<h4 class="<?= $default_language == 1 ? 'me-3 me-lg-3' : 'ms-3 ms-lg-3' ?>"><?= $this->lang->line('people-who-bought-this-also-bought') ?></h4>
			<?php } ?>
			<div class="swiper slider-trending1" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 18px;">
				<div class="swiper-wrapper" id="upsell_product"></div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</section> -->
		<!--/*Trending Section -->
	</main>

	<?php include("include/footer.php") ?>

	<?php include("include/script.php") ?>

	<!-- Plugin JS -->
	<script src="<?= base_url('assets_web/libs/swiper/swiper-bundle.min.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script src="<?= base_url('assets_web/libs/nouislider/dist/nouislider.min.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>


	<!-- Custom JS -->
	<script src="<?= base_url(); ?>assets_web/js/app/product_details.js"></script>

	<script>
		// function to convert hex color to RGB
		function hexToRgb(hex) {
			// remove the "#" symbol
			hex = hex.replace("#", "");

			// convert to RGB
			const r = parseInt(hex.substring(0, 2), 16);
			const g = parseInt(hex.substring(2, 4), 16);
			const b = parseInt(hex.substring(4, 6), 16);

			return {
				r,
				g,
				b
			};
		}
	</script>

</body>

</html>