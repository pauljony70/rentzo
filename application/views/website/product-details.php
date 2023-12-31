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
	<meta name="og_image" property="og:image" content="<?= MEDIA_URL . $main_url_img; ?>" />

	<!-- Plugin Css -->
	<!-- <link rel="stylesheet" type="text/css" href="https://punjablive1.com/dist/style/toastify.min.css"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
	<link rel="stylesheet" href="<?= base_url('assets_web/libs/nouislider/dist/nouislider.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/libs/nativetoast/native-toast.css') ?>">

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

		<!-- Share URL -->
		<input type="text" value="<?= $actual_link; ?>" name="myInput" id="myInput" style="display: none;">

		<!-- All Hidden Fields to Perform POST Request -->
		<input type="hidden" name="sku" id="sku" value="<?= $_REQUEST['sku']; ?>">
		<input type="hidden" name="sid" id="sid" value="<?= $_REQUEST['sid']; ?>">
		<input type="hidden" name="pid" value="<?= $_REQUEST['pid']; ?>" id="pid">
		<input type="hidden" name="user_id" value="<?= $this->session->userdata("user_id"); ?>" id="user_id">
		<input type="hidden" name="qoute_id" value="<?= $this->session->userdata("qoute_id"); ?>" id="qoute_id">
		<input type="hidden" name="whats_btn" value="<?= $product_custom_cloth; ?>" id="whats_btn">
		<input type="hidden" name="whatsapp_number" value="<?= whatsapp_number; ?>" id="whatsapp_number">
		<input type="hidden" name="product-price" value="<?= $productdetails['price']; ?>" id="product-price">
		<input type="hidden" name="purchase_limit" value="<?= $productdetails['purchase_limit']; ?>" id="purchase_limit">

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
											<a class="swiper-slide aaaaa" data-fancybox="group" href="<?= MEDIA_URL . $gallary['url'] ?>">
												<img src="<?= MEDIA_URL . $gallary['url'] ?>" />
											</a>
										<?php }
									} else { ?>
										<a class="swiper-slide" data-fancybox="group" href="<?= MEDIA_URL . $productdetails['imgurl'] ?>">
											<img src="<?= MEDIA_URL . $productdetails['imgurl'] ?>" />
										</a>
									<?php } ?>
									<?php if ($productdetails['youtube_url'] != '') { ?>
										<a class="swiper-slide my-auto" data-fancybox="group" href="<?= MEDIA_URL . $productdetails['youtube_url']; ?>">
											<video style="height:inherit;width:inherit;" id="product-video">
												<source src="<?= MEDIA_URL . $productdetails['youtube_url']; ?>" type="video/mp4">
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
												<img src="<?= MEDIA_URL . $gallary['url'] ?>" />
											</div>
										<?php }
									} else { ?>
										<div class="swiper-slide my-auto">
											<img src="<?= MEDIA_URL . $productdetails['imgurl'] ?>" />
										</div>
									<?php } ?>
									<?php if ($productdetails['youtube_url'] != '') { ?>
										<div class="swiper-slide my-auto">
											<video style="height:inherit;width:inherit;">
												<source src="<?= MEDIA_URL . $productdetails['youtube_url']; ?>" type="video/mp4">
											</video>
											<a style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><i class="fa-solid fa-play" style="font-size: 1.0rem; padding: 8px 12px; border-radius:50%; background-color: #ffffff8b"></i></a>
										</div>
									<?php } ?>
								</div>
								<div class="swiper-button-next"></div>
								<div class="swiper-button-prev"></div>
							</div>
						</div>
					</div>

					<!--
						--------------------------------------------------- 
						Description of Product
						---------------------------------------------------
					-->
					<div class="col-md-7 product_detail_desc_div ps-lg-5">
						<div class="right-block ps-lg-5">
							<!-- Name of Product -->
							<div class="d-flex justify-content-between align-items-center">
								<h1 class="product-name line-clamp-2 mb-2 mb-md-4"><?= $productdetails['name']; ?></h1>
							</div>

							<!-- Rating of Product -->
							<?php if (!empty($prod_city['data'])) : ?>
								<div class="product-location mb-2">
									<?php if (in_array($this->session->userdata("address"), array_column($prod_city['data'], 'name'))) : ?>
										<div class="d-flex location text-success">
											<img src="<?= base_url('assets_web/images/icons/location-pin-grey.svg') ?>" alt="Location">
											<div class="ms-2">Available in <?= $this->session->userdata("address") ?> </div>
										</div>
									<?php else : ?>
										<div class="d-flex align-items-start">
											<img src="<?= base_url('assets_web/images/icons/location-pin-grey.svg') ?>" class="mt-1" alt="Location">
											<div>
												<div class="d-flex">
													<div class="location ms-2">
														<?php
														$city_values = array_column($prod_city['data'], 'name');
														$first_five_cities = array_slice($city_values, 0, 5);
														echo implode(', ', $first_five_cities);
														?>
													</div>
													<?php if (count($prod_city['data']) > 5) : ?>
														<a class="btn see-more-btn py-0" data-bs-toggle="collapse" href="#collapseLocation" role="button" aria-expanded="false" aria-controls="collapseExample">
															See all <i class="fa-solid fa-chevron-down"></i>
														</a>
													<?php endif; ?>
												</div>
												<?php if (count($prod_city['data']) > 5) : ?>
													<div class="collapse location ms-2" id="collapseLocation">
														<?php
														$remaining_cities = array_slice($city_values, 5);
														echo implode(', ', $remaining_cities);
														?>
													</div>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>

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
											$emptyStars = 0;

											// Loop through the whole number part and display solid stars
											for ($i = 0; $i < $wholeNumber; $i++) {
												echo '<img src="' . base_url('assets_web/images/icons/star-yellow.svg') . '" alt="Star">';
											}

											// Check the fractional part to display half or empty star
											if ($fractionalPart >= 0.5) {
												// Calculate the remaining empty stars
												$emptyStars = 5 - $wholeNumber - 1; // Subtract 1 for the half star
												echo '<img src="' . base_url('assets_web/images/icons/half-star.svg') . '" alt="Star">';
											} else {
												// Calculate the remaining empty stars
												$emptyStars = 5 - $wholeNumber;
											}

											// Display the remaining empty stars
											if ($emptyStars > 0) {
												for ($i = 0; $i < $emptyStars; $i++) {
													echo '<img src="' . base_url('assets_web/images/icons/star-grey.svg') . '" alt="Star">';
												}
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
												<a target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?= $actual_link ?>&media=<?= urlencode(MEDIA_URL . $main_url_img) ?>&description=<?= urlencode($productdetails['name'] . ' - ' . strip_tags($productdetails['short_desc'])) ?>" class="brand-icon pinterest">
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
								<span id="day1_price"><?= price_format($productdetails['day1_price']); ?></span>/day
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
													<a class="swiper-slide spotlight zoom-img" data-fancybox="mobile-group" href="<?= MEDIA_URL . $gallary['url'] ?>">
														<img src="<?= MEDIA_URL . $gallary['url'] ?>" />
													</a>
												<?php }
											} else { ?>
												<a class="swiper-slide spotlight zoom-img" data-fancybox="mobile-group" href="<?= MEDIA_URL . $productdetails['imgurl'] ?>">
													<img src="<?= MEDIA_URL . $productdetails['imgurl'] ?>" />
												</a>
											<?php } ?>
											<?php if ($productdetails['youtube_url'] != '') { ?>
												<a href="<?= MEDIA_URL . $productdetails['youtube_url']; ?>" data-fancybox="mobile-group" class="swiper-slide">
													<video style="height:inherit;width:inherit;" id="product-video">
														<source src="<?= MEDIA_URL . $productdetails['youtube_url']; ?>" type="video/mp4">
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
														<img src="<?= MEDIA_URL . $gallary['url'] ?>" />
													</div>
												<?php }
											} else { ?>
												<div class="swiper-slide">
													<img src="<?= MEDIA_URL . $productdetails['imgurl'] ?>" />
												</div>
											<?php } ?>
											<?php if ($productdetails['youtube_url'] != '') { ?>
												<div class="swiper-slide">
													<video style="height:inherit;width:inherit;">
														<source src="<?= MEDIA_URL . $productdetails['youtube_url']; ?>" type="video/mp4">
													</video>
													<a style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><i class="fa-solid fa-play" style="font-size: 1.0rem; padding: 8px 12px; border-radius:50%; background-color: #ffffff8b"></i></a>
												</div>
											<?php } ?>
										</div>
										<div class="swiper-button-next"></div>
										<div class="swiper-button-prev"></div>
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
										<?php if ($productdetails['day3_price'] != '') { ?><th class="px-4 py-3">Rent for 3 days</th> <?php } ?>
										<?php if ($productdetails['day5_price'] != '') { ?><th class="px-4 py-3">Rent for 5 days</th> <?php } ?>
										<?php if ($productdetails['day7_price'] != '') { ?><th class="px-4 py-3">Rent for 7 days</th> <?php } ?>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php if ($productdetails['day3_price'] != '') { ?><td class="py-4"><?= price_format($productdetails['day3_price']); ?></td><?php } ?>
										<?php if ($productdetails['day5_price'] != '') { ?><td class="py-4"><?= price_format($productdetails['day5_price']); ?></td><?php } ?>
										<?php if ($productdetails['day7_price'] != '') { ?><td class="py-4"><?= price_format($productdetails['day7_price']); ?></td><?php } ?>
									</tr>
								</tbody>
							</table>

							<?php if (!empty($prod_city['data']) && in_array($this->session->userdata("address"), array_column($prod_city['data'], 'name'))) : ?>
							<?php else : ?>
								<div class="text-danger mb-4">
									Not available in your city
								</div>
							<?php endif; ?>


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

							<!-- Add to Cart and By now and Whatsapp Buttons -->
							<div class="btn-wrap align-items-center pBtns bg-white d-flex mb-4 py-2 py-md-0">
								<?php if ($productdetails['stock'] != '0' && $productdetails['stock_status'] != 'Out of Stock') { ?>
									<?php if (!empty($prod_city['data']) && in_array($this->session->userdata("address"), array_column($prod_city['data'], 'name'))) : ?>
										<a class="btn btn-warning" data-bs-toggle="offcanvas" href="#rentOffcanvas" role="button" aria-controls="rentOffcanvas">For Rent</a>
									<?php endif; ?>
									<?php if ($productdetails['is_buy']) : ?>
										<a data-bs-toggle="offcanvas" href="#cartOffcanvas" role="button" aria-controls="cartOffcanvas" class="btn btn-primary">
											Buy Now
										</a>
									<?php endif; ?>
								<?php } else { ?>
									<button type="button" class="btn btn-lg btn-secondary d-flex align-items-center justify-content-center" style="width: fit-content;">
										<div class="d-flex justify-content-center align-items-center h-100">
											<div class="mx-2 mt-1 fw-bolder text-uppercase"><?= $this->lang->line('out-of-stock') ?></div>
										</div>
									</button>
								<?php } ?>

								<a class="btn btn-light wishlist-btn heart-container" onclick="add_to_wishlist(event,'<?= $productdetails['id'] ?>','<?= $productdetails['sku'] ?>','<?= $productdetails['vendor_id'] ?>','<?= $this->session->userdata('user_id'); ?>',1,'',2)">
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
										<div class="day-wise-rent-price" id="day1_price"><?= price_format($productdetails['day1_price']) ?></div>
										<div class="day-wise-rent-price" id="day3_price"><?= price_format($productdetails['day3_price']) ?></div>
										<div class="day-wise-rent-price" id="day5_price"><?= price_format($productdetails['day5_price']) ?></div>
										<div class="day-wise-rent-price" id="day7_price"><?= price_format($productdetails['day7_price']) ?></div>
									</div>
									<div class="day-slider-div px-2">
										<div id="day-slider"></div>
									</div>
									<div id="calendar-div" class="mb-3">
										<div id="calendar"></div>
									</div>
									<div class="dates-div">
										<div class="d-flex align-items-center">
											<div class="heading">From Date</div>
											<div class="d-flex align-items-center date ms-5">
												<div class="image">
													<img src="<?= base_url('assets_web/images/icons/calender.svg') ?>" alt="Date">
												</div>
												<div class="ms-2" id="arrival-date">-/-/-</div>
											</div>
										</div>
										<hr class="my-2">
										<div class="d-flex align-items-center">
											<div class="heading">To Date</div>
											<div class="d-flex align-items-center date ms-5">
												<div class="image">
													<img src="<?= base_url('assets_web/images/icons/calender.svg') ?>" alt="Date">
												</div>
												<div class="ms-2" id="return-date">-/-/-</div>
											</div>
										</div>
									</div>
									<div class="availability-status mt-2 text-success">
										<!-- Available on this date -->
									</div>
									<hr>
									<div class="security-deposit d-flex justify-content-between">
										<div>Security deposit</div>
										<div><?= price_format($productdetails['security_deposit']) ?></div>
									</div>
									<div class="security-deposit-des text-danger mt-2">Security deposit is refundable **</div>
								</div>
								<div class="offcanvas-footer d-flex flex-column justify-content-center align-items-center">
									<div class="d-flex justify-content-between w-100 mb-3">
										<div class="heading">Total Rent</div>
										<div id="selected-day">1 Days</div>
										<div id="total-rent"><?= price_format($productdetails['day1_price']) ?></div>
									</div>
									<div class="btn btn-primary w-100" onclick="addto_cart_rent(this, event,'<?= $productdetails['id'] ?>','<?= $productdetails['sku'] ?>','<?= $productdetails['vendor_id'] ?>','<?= $this->session->userdata('user_id'); ?>',1,'',2,'<?= $this->session->userdata('qoute_id'); ?>')">Continue</div>
								</div>
							</div>

							<!-- 
								---------------------------------------------------
								Cart Offcanvas 
								---------------------------------------------------
							-->
							<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
								<div class="offcanvas-header">
									<h5 id="cartOffcanvasLabel" class="fw-bolder fs-4 mb-0 mt-1">Product Purchase Detail</h5>
									<button type="button" class="close-btn-offcanvas text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
										<i class="fa-solid fa-xmark"></i>
									</button>
								</div>
								<div class="offcanvas-body">
									<div class="row mx-0">
										<div class="col-12 mb-3 px-0">
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-3">
															<img class="w-100 object-fit-cover" src="<?= MEDIA_URL . $productdetails['imgurl'] ?>" alt="<?= $productdetails['name'] ?>">
														</div>
														<div class="col-9">
															<div class="d-flex flex-column">
																<div class="d-flex align-items-center justify-content-between">
																	<div class="cart-prod-title mb-2"><?= $productdetails['name'] ?></div>
																</div>
																<div class="rate mb-2">
																	<h5><?= $productdetails['price'] ?></h5>
																	<div class="old-price mb-1"><?= $productdetails['mrp'] ?></div>
																	<div class="off-price text-success"><span><?= $productdetails['offpercent'] ?></span></div>
																</div>
																<div class="quantity mb-2">
																	<div class="input-group">
																		<button type="button" class="btn btn-primary p-0 text-center" type="button" id="" onclick="decrementQuantity()"><i class="fa-solid fa-minus mt-1"></i></button>
																		<input type="number" class="form-control p-0 py-1 text-center" placeholder="" value="1" id="item-qty" readonly>
																		<button type="button" class="btn btn-primary p-0 text-center" type="button" id="" onclick="incrementQuantity()"><i class="fa-solid fa-plus mt-1"></i></button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="offcanvas-footer d-flex flex-column justify-content-center align-items-center">
									<div class="d-flex justify-content-between w-100 mb-3">
										<div class="heading">Quantity: <span id="item-total-qty">1</span></div>
										<div id="total-cart-price"><?= $productdetails['price'] ?></div>
									</div>
									<div class="btn btn-primary add-to-cart-btn w-100" onclick="add_to_cart_products(this, event,'<?= $productdetails['id'] ?>','<?= $productdetails['sku'] ?>','<?= $productdetails['vendor_id'] ?>','<?= $this->session->userdata('user_id'); ?>',1,'',2,'<?= $this->session->userdata('qoute_id'); ?>')">Continue</div>
								</div>
							</div>

							<!-- 
								---------------------------------------------------
								Badges 
								---------------------------------------------------
							-->
							<div class="badges mb-4">
								<div class="d-flex flex-wrap">
									<?php if($productdetails['seller_badge'] != '') { ?><img src="<?= MEDIA_URL . $productdetails['seller_badge'] ?>" alt="Badge 1"><?php } ?>
									<?php if($productdetails['seller_badge1'] != '') { ?><img src="<?= MEDIA_URL . $productdetails['seller_badge1'] ?>" alt="Badge 2"><?php } ?>
									<?php if($productdetails['seller_badge2'] != '') { ?><img src="<?= MEDIA_URL . $productdetails['seller_badge2'] ?>" alt="Badge 3"><?php } ?>
									
								</div>
							</div>

							<!-- 
								---------------------------------------------------
								Return Policy & Instructions
								---------------------------------------------------
							-->
							<div class="d-flex return-policy-div">
								<?php if ($productdetails['return_policy_title'] != '') { ?>
									<div class="return-product mb-4">
										<button type="button" data-bs-toggle="modal" data-bs-target="#policyModal">RETURN POLICY</button>
									</div>
								<?php } ?>
								<?php if ($productdetails['usage_info'] != '') { ?>
									<div class="return-product mb-4">
										<button class="text-primary" type="button" data-bs-toggle="modal" data-bs-target="#usageInfoModal">USAGE INSTRUCTION</button>
									</div>
								<?php } ?>
							</div>


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
							<!-- <?php if ($productdetails['order_count'] > 0) : ?>
								<div class="add-reviews btn-wrap d-block ms-4">
									<a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#reviewsModal">Add Review</a>
								</div>
							<?php endif; ?> -->
						</div>
						<?php foreach ($product_review as $review) : ?>
							<div class="col-md-9 d-flex mb-3">
								<img src="<?= base_url('assets_web/images/icons/profile-lg.svg') ?>" alt="<?= $review->user_name; ?>" class="user-image p-1 d-none d-md-block">
								<div class="ms-0 w-100 ms-md-3">
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
													// Calculate the remaining empty stars
													$emptyStars = 5 - $wholeNumber - 1; // Subtract 1 for the half star
													echo '<img src="' . base_url('assets_web/images/icons/half-star.svg') . '" alt="Star">';
												} else {
													// Calculate the remaining empty stars
													$emptyStars = 5 - $wholeNumber;
												}

												// Display the remaining empty stars
												if ($emptyStars > 0) {
													for ($i = 0; $i < $emptyStars; $i++) {
														echo '<img src="' . base_url('assets_web/images/icons/star-grey.svg') . '" alt="Star">';
													}
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
					<?php if (count($product_review)) : ?>
						<div class="mb-4-mb-md-5 text-center">
							<a href="#" class="show-all-review">Show All &nbsp;&nbsp;<i class="fa-solid fa-chevron-down"></i></a>
						</div>
					<?php endif; ?>
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

		<!-- Slider Usage Information Modal -->
		<div class="modal fade" id="usageInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body pt-0 return-policy faq">
						<!--Start: Return Policy Section -->
						<div class="container">
							<div class="header-wrap m-0">
								<h5><span>Usage Information</span></h5>
								<!--<p>(15 days product return policy)</p>-->
							</div>
							<br>

							<div class="wrap">
								<?= $productdetails['usage_info']; ?>
							</div>
						</div>
						<!--End: Return Policy Section -->
					</div>
				</div>
			</div>
		</div>
		<!--/*Slider Usage Information Modal -->

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
								<?= $productdetails['coupon_terms'];  ?>
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
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Rate this product</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="review_form" class="form">
							<div class="mb-3">
								<label class="form-label"><?= $this->lang->line('title') ?> </label>
								<input type="text" class="form-control" name="reviewtitle" id="reviewtitle" placeholder="<?= $this->lang->line('title') ?>" />
							</div>
							<div class="mb-3">
								<label class="form-label"><?= $this->lang->line('comment') ?></label>
								<textarea class="form-control" name="ProductReview" id="ProductReview" rows="5" placeholder="<?= $this->lang->line('comments-here') ?> ..."></textarea>
							</div>

							<div class="mb-4 d-flex">
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
							<button class="btn btn-primary" type="submit"><?= $this->lang->line('add_reviews') ?></button>
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

		<!-- 
			---------------------------------------------------
			Related Products
			---------------------------------------------------
		-->
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

		<!-- 
			---------------------------------------------------
			Upsell Products
			---------------------------------------------------
		-->
		<section class="trending-section container mb-3 mb-md-5">
			<?php if (!empty($upsell_product)) { ?>
				<div class="d-flex align-items-center mb-3 mb-md-5">
					<div class="heading-border"></div>
					<div class="heading ms-3">People who bought this also bought</div>
				</div>
			<?php } ?>
			<div class="swiper slider-trending" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
				<div class="swiper-wrapper" id="upsell_product"></div>
			</div>
		</section>

		<!--Trending Section -->
		<section class="trending-section container mb-3 mb-md-5">
			<?php if (!empty($recently_viewed_product_details)) { ?>
				<div class="d-flex align-items-center mb-3 mb-md-5">
					<div class="heading-border"></div>
					<div class="heading ms-3">Rencently viewed products</div>
				</div>
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
						<div class="swiper-slide position-realative">
							<a href="<?= base_url($recently_viewed_product_detail['web_url']) . '?' . http_build_query($params) ?>" class="d-flex flex-column card product-card rounded-4">
								<div class="product-card-img zoom-img rounded-4">
									<img src="<?= MEDIA_URL . $recently_viewed_product_detail['imgurl'] ?>" class="card-img-top rounded-4" alt="<?= $recently_viewed_product_detail['name'] ?>">
								</div>
								<div class="card-body d-flex flex-column product-card-body">
									<h5 class="card-title product-title line-clamp-2 mb-auto"><?= $recently_viewed_product_detail['name'] ?></h5>
									<div class="card-text d-flex justify-content-between py-1">
										<div class="rent-heading">Rent</div>
										<div class="rent-price"><?= $recently_viewed_product_detail['day1_price'] ?>/day</div>
									</div>
									<div class="product-card-footer pt-1">
										<div class="text-success">Available Today</div>
									</div>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	</main>

	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>

	<!-- Plugin JS -->
	<script src="<?= base_url('assets_web/libs/swiper/swiper-bundle.min.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script src="<?= base_url('assets_web/libs/nouislider/dist/nouislider.min.js') ?>"></script>
	<script src='<?= base_url('assets_web/libs/fullcalendar-6.1.9/dist/index.global.min.js') ?>'></script>
	<script src="<?= base_url('assets_web/libs/moment/min/moment.min.js') ?>"></script>
	<script src="<?= base_url('assets_web/libs/nativetoast/native-toast.js') ?>"></script>
	<script src="<?= base_url('assets_web/libs/js-image-zoom-master/package/js-image-zoom.js') ?>"></script>

	<!-- Custom JS -->
	<script src="<?= base_url(); ?>assets_web/js/app/product_details.js"></script>

	<script>
		if (document.querySelector('#address_data')) {
			if (document.querySelector('#address_data').textContent === 'Location') {
				var pincodeModal = new bootstrap.Modal(document.getElementById('pincodeModal'));
				pincodeModal.show();
			}
		}
	</script>
</body>

</html>