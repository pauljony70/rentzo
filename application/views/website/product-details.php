<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = $productdetails['name'];
	// echo "<pre>";
	// print_r($productdetails);
	include("include/headTag.php");
	$main_url_img = str_replace("-430-590", '', $productdetails['imgurl']);
	?>

	<?php if ($default_language == 1) 
	{ ?>
			<?php if ($productdetails['prod_meta_ar'] != '') { ?>
				<meta name="og_title" property="og:title" content="<?= $productdetails['prod_meta_ar']; ?>" />
			<?php } else { ?>
				<meta name="og_title" property="og:title" content="<?= $productdetails['name']; ?>" />
			<?php } ?>
			<meta name="og_site_name" property="og:site_name" content="Ebuy.om" />

			<?php if ($productdetails['prod_keyword_ar'] != '') { ?> 
				<meta property="og:keywords" content="<?= $productdetails['prod_keyword_ar']; ?>" />
			<?php } ?>

			<?php if ($productdetails['prod_meta_desc_ar'] != '') { ?>
				<meta property="og:description" content="<?= $productdetails['prod_meta_desc_ar']; ?>" />
			<?php } else { ?>
				<meta property="og:description" content="<?= strip_tags($productdetails['short_desc']); ?>" />
			<?php } ?>
			<meta name="og_image" property="og:image" content="<?= weburl . 'media/' . $main_url_img; ?>" />
	<?php }
	else
	{ ?>
			<?php if ($productdetails['meta_title'] != '') { ?>
				<meta name="og_title" property="og:title" content="<?= $productdetails['meta_title']; ?>" />
			<?php } else { ?>
				<meta name="og_title" property="og:title" content="<?= $productdetails['name']; ?>" />
			<?php } ?>
			<meta name="og_site_name" property="og:site_name" content="Ebuy.om" />

			<?php if ($productdetails['meta_key'] != '') { ?>
				<meta property="og:keywords" content="<?= $productdetails['meta_key']; ?>" />
			<?php } ?>

			<?php if ($productdetails['meta_value'] != '') { ?>
				<meta property="og:description" content="<?= $productdetails['meta_value']; ?>" />
			<?php } else { ?>
				<meta property="og:description" content="<?= strip_tags($productdetails['short_desc']); ?>" />
			<?php } ?>
			<meta name="og_image" property="og:image" content="<?= weburl . 'media/' . $main_url_img; ?>" />
	<?php }
	?>

	

	<link rel="stylesheet" type="text/css" href="https://punjablive1.com/dist/style/toastify.min.css">
	<!-- For Harabara Bold Font Style -->
	<link href="https://www.dafontfree.net/embed/aGFyYWJhcmEtYm9sZCZkYXRhLzI5L2gvMTUyMjg3L0hhcmFiYXJhLnR0Zg" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/product-details.css') ?>">

	<?php if ($default_language === '1') : ?>
		<style>
			.hover-card {
				left: 0 !important;
				right: auto;
			}

			.arrow {
				right: auto;
				left: 15px !important;
			}
		</style>
	<?php endif; ?>
</head>

<body class="prod_details">
	<?php
	include("include/loader.php")
	?>
	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php")
	?>
	<main class="product-details-page">
		<?php
		$shareUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


		$web_api_key = 'AIzaSyB9eFHfVk4fNStaBYAcLE_DzLZXWDJ4CMY';

		if ($productdetails['affiliate_commission'] > 0 && $this->session->userdata('user_id')) {
			// Construct the long URL with query parameters
			$affiliated_by = $this->session->userdata('user_id'); // Replace with the actual affiliated_by value
			$shareUrl = add_query_params($shareUrl, array('affiliated_by' => $affiliated_by));
		}

		// Firebase Dynamic Links API endpoint
		$api_url = "https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=" . $web_api_key;

		$data = array(
			'dynamicLinkInfo' => array(
				'domainUriPrefix' => 'ebuyoman.page.link',
				'link' => $shareUrl,
			),
		);

		$options = array(
			CURLOPT_URL => $api_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
			),
		);

		$ch = curl_init();
		curl_setopt_array($ch, $options);

		$response = curl_exec($ch);

		curl_close($ch);

		$response_data = json_decode($response, true);

		$actual_link = $response_data['shortLink'];

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
		<input type="text" value="<?= $share_url; ?>" name="myInput" id="myInput" style="display: none;">

		<!-- <input type="text" id="coupon_name" value="<?= $productdetails['coupon_name'] ?>"> -->

		<!-- Topbar for Mobile -->
		<div class="d-flex justify-content-between align-items-center h-100 responsive_nav d-block d-sm-none">
			<div class="nav_inner"></div>
			<svg class="fa-angle-left ms-3" onclick="history.back(-1)" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M15.5 19.5 8 12l7.5-7.5" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
			</svg>
			<svg class="fa-heart me-3" onclick="add_to_wishlist(event,'<?= $productdetails['id'] ?>','<?= $productdetails['sku'] ?>','<?= $productdetails['vendor_id'] ?>','<?= $this->session->userdata('user_id'); ?>',1,'',2)" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M12 20S3 14.91 3 8.727c0-1.093.375-2.152 1.06-2.997a4.672 4.672 0 0 1 2.702-1.638 4.639 4.639 0 0 1 3.118.463A4.71 4.71 0 0 1 12 6.909a4.71 4.71 0 0 1 2.12-2.354 4.639 4.639 0 0 1 3.118-.463 4.672 4.672 0 0 1 2.701 1.638A4.756 4.756 0 0 1 21 8.727C21 14.91 12 20 12 20z" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
			</svg>
		</div>

		<!-- All Hidden Fields to Perform POST Request -->
		<input type="hidden" name="sku" id="sku" value="<?= $_REQUEST['sku']; ?>">
		<input type="hidden" name="sid" id="sid" value="<?= $_REQUEST['sid']; ?>">
		<input type="hidden" name="pid" value="<?= $_REQUEST['pid']; ?>" id="pid">
		<input type="hidden" name="user_id" value="<?= $this->session->userdata("user_id"); ?>" id="user_id">
		<input type="hidden" name="qoute_id" value="<?= $this->session->userdata("qoute_id"); ?>" id="qoute_id">
		<input type="hidden" name="whats_btn" value="<?= $product_custom_cloth; ?>" id="whats_btn">
		<input type="hidden" name="whatsapp_number" value="<?= whatsapp_number; ?>" id="whatsapp_number">


		<!-- <div id="popupContainer">
			<div id="popupContent">
				Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam laudantium omnis eius, alias a cum id quam accusantium officiis mollitia eum atque nemo, itaque, debitis beatae error tempora facere iusto!
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo exercitationem tenetur eveniet consequuntur, repudiandae in quis veniam consequatur modi vero dicta pariatur facilis nesciunt, accusantium iste repellendus necessitatibus aliquam voluptas!
				<button id="closePopupButton">&times;</button>
			</div>
		</div>
		<div id="popup-overlay"></div> -->

		<!--Start: Slider Section -->
		<section class="product-slider">
			<div class="container px-0 px-md-1">
				<div class="row">
					<!-- For Image -->
					<div class="col-md-4 px-0 px-md-3">
						<div class="left-block">
							<div class="column small-11 small-centered">
								<?php if ($productdetails['stock_status'] == 'Out of Stock' || $productdetails['stock'] <= 0) { ?>
									<?php if ($default_language == 1) : ?>
										<img alt="" class="outof_stock" src="<?= weburl . 'assets/img/out-of-stock-ar.png'; ?>">
									<?php else : ?>
										<img alt="" class="outof_stock" src="<?= weburl . 'assets/img/out-of-stock-en.png'; ?>">
									<?php endif; ?>
								<?php } ?>
								<!-- <div dir="rtl" class="slider slider-single light-box" id="gallery_view">
									<?php if (!empty($productdetails['gallary_img_url'])) {
										foreach ($productdetails['gallary_img_url'] as $gallary) {
											$gal_url = str_replace("-430-590", '', $gallary['url']);
									?>
											<a class="spotlight zoom-img" id="gallarry_img" data-page="false" data-animation="fade" data-control="zoom,fullscreen,close" data-theme="white" data-autohide=false href="<?= weburl . 'media/' . $gal_url; ?>">
												<div>
													<img class="img-fluid" alt="" src="<?= weburl . 'media/' . $gal_url; ?>" onerror="this.src='<?= base_url('assets_web/images/placeholders/placeholder-image.png') ?>'">
												</div>
											</a>
										<?php }
									} else {
										$gal_url_img = str_replace("-430-590", '', $productdetails['imgurl']);
										?>
										<a class="spotlight zoom-img" id="gallarry_img" data-page="false" data-animation="fade" data-control="zoom,fullscreen,close" data-theme="white" data-autohide=false href="<?= weburl . 'media/' . $gal_url_img; ?>">
											<div class="image-container">
												<img class="img-fluid" alt="" src="<?= weburl . 'media/' . $gal_url_img; ?>" onerror="this.src='<?= base_url('assets_web/images/placeholders/placeholder-image.png') ?>'">
												<div class="print-button">
													<p onclick="add_to_wishlist(event,'<?= $productdetails['id'] ?>','<?= $productdetails['sku'] ?>','<?= $productdetails['vendor_id'] ?>','<?= $this->session->userdata('user_id'); ?>',1,'',2)">Add To Wishlist :&nbsp;&nbsp; <i class="fa-regular fa-heart"></i></p>
												</div>
											</div>
										</a>
									<?php } ?>
									<?php if ($productdetails['youtube_url'] != '') { ?>
										<div>
											<video style="height:inherit;width:inherit;" id="product-video">
												<source src="<?= weburl . 'media/' . $productdetails['youtube_url']; ?>" type="video/mp4">
											</video>
											<a id="custom-play-button" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><i class="fa-solid fa-play" style="font-size: 1.5rem; padding: 12px 16px; border-radius:50%; background-color: #ffffff8b"></i></a>
										</div>
									<?php } ?>
								</div>
								<div dir="rtl" class="slider slider-nav">
									<?php if (!empty($productdetails['gallary_img_url'])) {
										foreach ($productdetails['gallary_img_url'] as $gallary) { ?>
											<div><img class="img-fluid" alt="" src="<?= weburl . 'media/' . $gallary['url']; ?>" onerror="this.src='<?= base_url('assets_web/images/placeholders/placeholder-image.png') ?>'"></div>
										<?php }
									} else { ?>
										<div><img class="img-fluid" alt="" src="<?= weburl . 'media/' . $productdetails['imgurl']; ?>" onerror="this.src='<?= base_url('assets_web/images/placeholders/placeholder-image.png') ?>'"></div>
									<?php } ?>

									<?php if ($productdetails['youtube_url'] != '') { ?>
										<div class=" ">
											<video width="100" height="100">
												<source src="<?= weburl . 'media/' . $productdetails['youtube_url']; ?>" type="video/mp4">
											</video>
											<div class="position-absolute top-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="
												  width: 100px;
												  height: 100px;
												  opacity: 1;
												  display: flex;
												  align-items: center;
												  justify-content: center;
												  cursor: pointer;
												">
												<i class="bx bx-play-circle" style="font-size: 2.5rem; opacity: 1"></i>
											</div>
										</div>
									<?php } ?>
									<span id="product_small_config_img"></span>
								</div> -->
								<div <?= $default_language == 1 ? 'dir="rtl"' : '' ?> style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px;" class="swiper product-details-swiper">
									<div class="swiper-wrapper">
										<?php if (!empty($productdetails['gallary_img_url'])) {
											foreach ($productdetails['gallary_img_url'] as $gallary) { ?>
												<a class="swiper-slide my-auto spotlight zoom-img" data-page="false" data-animation="fade" data-control="zoom,fullscreen,close" data-theme="white" data-autohide=false href="<?= base_url('media/' . $gallary['url']) ?>">
													<img src="<?= base_url('media/' . $gallary['url']) ?>" />
												</a>
											<?php }
										} else { ?>
											<a class="swiper-slide my-auto spotlight zoom-img" data-page="false" data-animation="fade" data-control="zoom,fullscreen,close" data-theme="white" data-autohide=false href="<?= base_url('media/' . $productdetails['imgurl']) ?>">
												<img src="<?= base_url('media/' . $productdetails['imgurl']) ?>" />
											</a>
										<?php } ?>
										<?php if ($productdetails['youtube_url'] != '') { ?>
											<div class="swiper-slide my-auto">
												<video style="height:inherit;width:inherit;" id="product-video">
													<source src="<?= weburl . 'media/' . $productdetails['youtube_url']; ?>" type="video/mp4">
												</video>
												<a id="custom-play-button" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><i class="fa-solid fa-play" style="font-size: 1.5rem; padding: 12px 16px; border-radius:50%; background-color: #ffffff8b"></i></a>
												<a data-bs-toggle="modal" data-bs-target="#videoModal" class="fullscreen-button text-dark" style="position: absolute; top: 95%; right: -15px; transform: translate(-50%, -50%);"><i class="fas fa-expand" style="font-size: 1rem; padding: 12px 13px; border-radius:50%; background-color: #ffffff8b"></i></a>
											</div>
										<?php } ?>
									</div>
									<div class="swiper-button-next"></div>
									<div class="swiper-button-prev"></div>
									<div class="swiper-pagination"></div>
								</div>
								<div <?= $default_language == 1 ? 'dir="rtl"' : '' ?> thumbsSlider="" class="swiper product-details-swiper-sm">
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
					</div>

					<!-- For Description of Product -->
					<div class="col-md-8 product_detail_desc_div">
						<div class="row">
							<div class="col-lg-8">
								<div class="right-block mt-4">
									<!-- Name of Product -->
									<div class="d-flex justify-content-between align-items-center">
										<h1 class="product-name text-dark fw-bolder"><?= $productdetails['name']; ?></h1>
										<div class="toggle-btn">
											<span class="share-icon">
												<div class="d-flex align-items-center" id="share-btn">
													<i class="fa-solid fa-share"></i>
													<div class="share-text mx-1"><?= $this->lang->line('share') ?></div>
												</div>
												<div class="hover-card box-shadow">
													<div class="d-flex justify-content-between flex-wrap">
														<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= $actual_link ?>" title="Facebook Share" class="brand-icon facebook">
															<img src="<?= base_url('assets_web/images/brands/facebook.svg') ?>" alt="Facebook" srcset="">
														</a>
														<a target="_blank" href="whatsapp://send?text=<?= $actual_link ?>" class="brand-icon whatsapp">
															<img src="<?= base_url('assets_web/images/brands/whatsapp.svg') ?>" alt="Facebook" srcset="">
														</a>
														<a target="_blank" href="http://twitter.com/share?url=<?= $actual_link ?>&text=I ♥ this product on EBuy! <?= $productdetails['name']; ?>&via=Ebuy&hashtags=buyonebuy" class="brand-icon twitter">
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
													<i class="fa-solid fa-share"></i>
													<div class="share-text mx-1"><?= $this->lang->line('share') ?></div>
												</div>
											</span>
										</div>
									</div>

									<!-- Rating of Product -->
									<div class="d-flex my-2 ratings-tab align-items-center">
										<?php if ($product_review_total['total_rows'] > 0) : ?>
											<div class="d-flex">
												<?php
												$rating = round(($product_review_total['total_rating'] / $product_review_total['total_rows']) * 2) / 2;
												// Calculate the whole number and fractional part of the rating
												$wholeNumber = floor($rating);
												$fractionalPart = $rating - $wholeNumber;
												?>
												<div class="rating-count <?= $default_language == 2 ? 'me-2' : 'ms-2' ?>"><?= number_format($rating, 1); ?></div>
												<?php
												// Loop through the whole number part and display solid stars
												for ($i = 0; $i < $wholeNumber; $i++) {
													echo '<i class="fa-solid fa-star"></i>';
												}

												// Check the fractional part to display half or empty star
												if ($fractionalPart >= 0.5) {
													echo '<i class="fa-solid fa-star-half-stroke"></i>';
												} else {
													echo '<i class="fa-regular fa-star"></i>';
												}

												// Calculate the remaining empty stars
												$emptyStars = 5 - $wholeNumber - 1; // Subtract 1 for the half star

												// Display the remaining empty stars
												for ($i = 0; $i < $emptyStars; $i++) {
													echo '<i class="fa-regular fa-star"></i>';
												}
												?>
											</div>
											<div class="seperator"></div>
										<?php endif; ?>
										<div class="d-flex align-items-center">
											<a href="#review_of_product" class="rating-details text-muted"><span class="total-review-count"><?= $product_review_total['total_rows'] ?> </span><?= $this->lang->line('review') ?></a>
											<img class="camera-icon mx-1 mb-1" src="https://cdn.dsmcdn.com/mobile/reviewrating/kamera-emoji6x.png">
										</div>
									</div>
									<hr>

									<!-- Timer -->
									<?php if ($productdetails['offer']) : ?>
										<div class="timer_container_prod_details_tab_mob w-80 rounded shadow-sm">
											<h4 class="text-white fw-bolder text-center m-0 p-0">Sale ends in</h4>
											<div class="row">
												<div class="col-4">
													<hr class="">
												</div>
												<div class="col-4 d-flex-center p-0">
													<div class="text-white">Hurry Up</div>
												</div>
												<div class="col-4">
													<hr class="">
												</div>
											</div>
											<!-- <hr><span class="text-white">Hurry</span><hr> -->
											<div class="row p-0 mt-1 d-flex-center">
												<div class="col-3 p-1 d-flex-center border bg-white rounded">
													<div class="timer_text_tab_mob hour text- fw-bolder">48</div>
												</div>
												<div class="col-3 p-1 second_div d-flex-center border bg-white rounded">
													<div class="timer_text_tab_mob minute text- fw-bolder">29 </div>
												</div>
												<div class="col-3 p-1 d-flex-center border bg-white rounded">
													<div class="timer_text_tab_mob second text- fw-bolder">09 </div>
												</div>
											</div>
											<div class="row p-0 d-flex-center">
												<div class="col-3 p-1 d-flex-center text-right">
													<span class="text-white down_time_tab_mob">Hour</span>
												</div>
												<div class="col-3 p-1  d-flex-center text-center">
													<span class="text-white down_time_tab_mob">Min</span>
												</div>
												<div class="col-3 p-1 d-flex-center 1 text-left">
													<span class="text-white down_time_tab_mob">Sec</span>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<!-- Price of Product -->
									<div class="d-flex align-items-center h-100 my-4">
										<div id="product-price" class="product-price"><?= $productdetails['price']; ?></div>
										<div class="old-price mx-3"><?= $productdetails['mrp']; ?></div>
										<?php if ($productdetails['totaloff'] != 0) { ?>
											<div class="off-price text-success mx-3"><span><?= $productdetails['offpercent']; ?></span></div>
										<?php } ?>
									</div>

									<!-- Short Description of Product -->
									<div class="prod-short-des my-3 product_description_content">
										<?php echo $productdetails['short_desc']; ?>
									</div>

									<hr>

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
									<div class="btn-wrap align-items-center pBtns d-flex mb-5">
										<?php if ($productdetails['stock'] != '0' && $productdetails['stock_status'] != 'Out of Stock') { ?>
											<a href="#" onclick="add_to_cart_product_buynow(this, event,'<?php echo $productdetails['id'] ?>','<?php echo $productdetails['sku'] ?>','<?php echo $productdetails['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-lg btn-primary d-flex align-items-center justify-content-center">
												<div class="d-flex justify-content-center align-items-center h-100">
													<i class="fa-solid fa-bolt"></i>
													<div class="mx-2 mt-1 fw-bolder text-uppercase"><?= $this->lang->line('buy-now') ?></div>
												</div>
											</a>

											<a href="#" onclick="add_to_cart_products(this, event,'<?php echo $productdetails['id'] ?>','<?php echo $productdetails['sku'] ?>','<?php echo $productdetails['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-lg btn-secondary d-flex align-items-center justify-content-center mx-2">
												<div class="d-flex justify-content-center align-items-center h-100">
													<i class="fa-solid fa-cart-shopping"></i>
													<div class="mx-2 mt-1 fw-bolder text-uppercase"><?= $this->lang->line('add-to-cart') ?></div>
												</div>
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

									<div class="offcanvas <?= $default_language == 1 ? 'offcanvas-start' : 'offcanvas-end' ?>" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
										<div class="offcanvas-header">
											<h5 id="cartOffcanvasLabel" class="fw-bolder fs-4 mb-0 mt-1"><?= $this->lang->line('cart') ?></h5>
											<button type="button" class="text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
										</div>
										<div class="offcanvas-body">
											<div class="row"></div>
										</div>
										<div class="offcanvas-footer"></div>
										<div id="offcanvas-loader">
											<div class="spinner-border text-primary" role="status">
												<span class="visually-hidden">Loading...</span>
											</div>
										</div>
									</div>

									<!-- Product Info Table -->
									<?php if (!empty($productdetails['product_info'])) : ?>
										<div class="table-responsive mt-4">
											<label class="fw-bolder mb-2 product_detail_headings" for=""><?= $this->lang->line('product-specifications') ?></label>
											<table class="table table-hover table-centered product_description_content">
												<?php foreach ($productdetails['product_info'] as $product_info) : ?>
													<tr>
														<td style="background-color: #F8F8F8; min-width:80px"><?= $product_info['attribute'] ?></td>
														<td>
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
									
									<?php if (get_settings('offers') != '') { ?>
									<div class="available-offers mb-1 mb-lg-0">
										<h5><?php if ($default_language == 1) {
												echo 'العروض المتاحة';
											} else {
												echo 'Available Offers';
											} ?> </h5>
										<ul class="allOffers px-0">
											<?php echo get_settings('offers'); ?>

										</ul>
									</div>
								<?php } ?>

									<!-- Product Details and Reviews -->
									<div class="mt-4">
										<label class="fw-bolder mb-2 product_detail_headings" for=""><?= $this->lang->line('product-highlights') ?></label>
										<div class="product-full-desc product_description_content"><?= $productdetails['fulldetail']; ?></div>
										<?php if ($productdetails['return_policy_title'] != '') { ?>
											<div class="return-product mt-4">
												<h5><?= $this->lang->line('return-policy') ?></h5>
												<a style="text-decoration:none;" href="return-policy.html" data-bs-toggle="modal" data-bs-target="#policyModal">
													<?= $productdetails['return_policy_title']; ?>
												</a>
											</div>
										<?php } ?>
									</div>

									<!-- Review of Product -->
									<?php if (!empty($product_review) || $productdetails['order_count'] > 0) : ?>
										<div class="mt-5" id="review_of_product">
											<label class="fw-bolder mb-2 product_detail_headings" for=""><?= $this->lang->line('reviews-for-this-product') ?></label>
											<?php if ($productdetails['order_count'] > 0) : ?>
												<div class="add-reviews btn-wrap d-block">
													<a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#reviewsModal"><?= $this->lang->line('add_reviews') ?></a>
												</div>
											<?php endif; ?>
											<?php foreach ($product_review as $riview) : ?>
												<div class="review-details d-flex mt-3">
													<div class="d-flex pt-1">
														<?php
														$rating = round($riview->rating * 2) / 2;
														// Calculate the whole number and fractional part of the rating
														$wholeNumber = floor($rating);
														$fractionalPart = $rating - $wholeNumber;
														?>
														<?php
														// Loop through the whole number part and display solid stars
														for ($i = 0; $i < $wholeNumber; $i++) {
															echo '<i class="fa-solid fa-star"></i>';
														}

														// Check the fractional part to display half or empty star
														if ($fractionalPart >= 0.5) {
															echo '<i class="fa-solid fa-star-half-stroke"></i>';
														} else {
															echo '<i class="fa-regular fa-star"></i>';
														}

														// Calculate the remaining empty stars
														$emptyStars = 5 - $wholeNumber - 1; // Subtract 1 for the half star

														// Display the remaining empty stars
														for ($i = 0; $i < $emptyStars; $i++) {
															echo '<i class="fa-regular fa-star"></i>';
														}
														?>
													</div>
													<div class="d-flex flex-column mx-2">
														<div class="review-text">
															<b><?= $riview->review_title ?></b>, <?= $riview->review_comment ?>
														</div>
													</div>
												</div>
												<div class="d-flex mt-2">
													<span class="fw-bolder"><?= $riview->user_name; ?> | </span>
													<span class="mx-2"><?= date('d M Y', strtotime($riview->review_date)); ?></span>
												</div>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
							<!-- For Seller Details-->
							<div class="col-lg-4 px-0">
								<div class="row">
									<!-- Timer -->
									<?php if ($productdetails['offer']) : ?>
										<div class="col-md-12 col-xl-12 seller_details <?= $default_language == 1 ? 'ps-0' : 'pe-0' ?>">
											<div class="timer_container_prod_details mt-4 col-md-12 col-xl-12 w-100 rounded shadow-sm">
												<h4 class="text-white fw-bolder text-center m-0 p-0">Sale ends in</h4>
												<div class="row">
													<div class="col-4">
														<hr class="ruler">
													</div>
													<div class="col-4 d-flex-center p-0">
														<div class="text-white">Hurry Up</div>
													</div>
													<div class="col-4">
														<hr class="ruler">
													</div>
												</div>
												<!-- <hr><span class="text-white">Hurry</span><hr> -->
												<div class="row">
													<div class="col-4 mx-0 p-1 d-flex flex-column">
														<div class="timer_text_pd text-center hour fw-bolder border bg-white rounded">48</div>
														<span class="text-white down_time">Hour</span>
													</div>
													<div class="col-4 mx-0 p-1 second_div d-flex flex-column">
														<div class="timer_text_pd text-center minute fw-bolder border bg-white rounded">48</div>
														<span class="text-white down_time">Min</span>
													</div>
													<div class="col-4 mx-0 p-1 d-flex flex-column">
														<div class="timer_text_pd text-center second border bg-white rounded fw-bolder">48</div>
														<span class="text-white down_time">Sec</span>
													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>
									<!-- Seller Details -->
									<div class="col-md-12 col-xl-12 mt-4 seller_details <?= $default_language == 1 ? 'ps-0' : 'pe-0' ?>">
										<div class="card seller-details-card">
											<!-- Card body -->
											<div class="card-body p-3">
												<div class=" justify-content-between justify-content-sm-start">
													<div class="d-flex row align-items-center">
														<div class="col-4 d--center">
															<i class="fa-solid fa-shop fa-lg" style="color: #ff6600;"></i>
														</div>
														<div class="col-8 p-0">
															<div class="d-flex">
																<!-- <img src="<?php echo base_url() ?>/assets_web/images/verified.png" alt="verified User" width="100px" height="100px"> -->
																<div class="col-md-12 mt-3">
																	<h5 class="product_detail_headings"><?= $productdetails['seller_data']['fullname'] ?></h5>
																	<div class="p-0">
																		<span>Verified Seller</span>
																		<svg height="13px" width="13px" aria-hidden="true" class="Svg-sc-ytk21e-0 esyykA b0NcxAbHvRbqgs2S8QDg mx-0" viewBox="0 0 24 24" data-encore-id="icon" fill="#ff6600" style="margin-top:-10px;">
																			<path d="M10.814.5a1.658 1.658 0 0 1 2.372 0l2.512 2.572 3.595-.043a1.658 1.658 0 0 1 1.678 1.678l-.043 3.595 2.572 2.512c.667.65.667 1.722 0 2.372l-2.572 2.512.043 3.595a1.658 1.658 0 0 1-1.678 1.678l-3.595-.043-2.512 2.572a1.658 1.658 0 0 1-2.372 0l-2.512-2.572-3.595.043a1.658 1.658 0 0 1-1.678-1.678l.043-3.595L.5 13.186a1.658 1.658 0 0 1 0-2.372l2.572-2.512-.043-3.595a1.658 1.658 0 0 1 1.678-1.678l3.595.043L10.814.5zm6.584 9.12a1 1 0 0 0-1.414-1.413l-6.011 6.01-1.894-1.893a1 1 0 0 0-1.414 1.414l3.308 3.308 7.425-7.425z"></path>
																		</svg>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<hr style="margin: 5px 0px;">
												<div class="pt-2 pb-0 product_description_content" style="text-align: justify;">
													<?= $productdetails['seller_data']['description']; ?>
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
		<section class="trending-section container px-1 px-md-2">
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
		</section>
		<!--/*Trending Section -->

		<!--Trending Section -->
		<section class="trending-section container px-1 px-md-2">
			<?php if (!empty($related_product)) { ?>
				<h4 class="<?= $default_language == 1 ? 'me-3 me-lg-3' : 'ms-3 ms-lg-3' ?>"><?= $this->lang->line('related-items') ?></h4>
			<?php } ?>
			<div class="swiper slider-trending" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 18px;">
				<div class="swiper-wrapper" id="related_product"></div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</section>
		<!--/*Trending Section -->

		<!--Trending Section -->
		<section class="trending-section container px-1 px-md-2">
			<?php if (!empty($upsell_product)) { ?>
				<h4 class="<?= $default_language == 1 ? 'me-3 me-lg-3' : 'ms-3 ms-lg-3' ?>"><?= $this->lang->line('people-who-bought-this-also-bought') ?></h4>
			<?php } ?>
			<div class="swiper slider-trending1" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 18px;">
				<div class="swiper-wrapper" id="upsell_product"></div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</section>
		<!--/*Trending Section -->

		<!-- Slider Modal -->
		<div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="text-center">
							<!-- <iframe width="100%" height="500" src="https://www.youtube.com/embed/GhRNksWxUSk?autoplay=1&mute=1">
							</iframe> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/*Slider Modal -->

		<div class="btn-wrap btn-mb pBtns1 mt-3 <?= $product_custom_cloth == 10 ? 'justify-content-end' : '' ?>" id="btn-mb">
			<?php if ($productdetails['stock'] != '0' && $productdetails['stock_status'] != 'Out of Stock') { ?>
				<?php if ($product_custom_cloth != 10) { ?>
					<a href="#" onclick="add_to_cart_product_buynow(this, event,'<?php echo $productdetails['id'] ?>','<?php echo $productdetails['sku'] ?>','<?php echo $productdetails['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-lg btn-primary">
						<div class="d-flex justify-content-center align-items-center h-100">
							<i class="fa-solid fa-bolt"></i>
							<div class="mx-2 mt-1 fw-bolder text-uppercase"><?= $this->lang->line('buy-now') ?></div>
						</div>
					</a>
				<?php }
				if ($product_custom_cloth == 10) { ?>
					<a target="_blank" href="https://api.whatsapp.com/send?phone=<?= '%2B91' . whatsapp_number . '&text=hi';  ?>" class="btn btn-success text-light text-center">
						<div class="d-flex justify-content-center align-items-center">
							<i class="fa-brands fa-whatsapp me-2" style="font-size: 20px;"></i>
							<span style="vertical-align: middle;">WhatsApp</span>
						</div>
					</a>
				<?php } else { ?>

					<a href="#" onclick="add_to_cart_products(this, event,'<?php echo $productdetails['id'] ?>','<?php echo $productdetails['sku'] ?>','<?php echo $productdetails['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-lg btn-secondary d-flex align-items-center justify-content-center mx-2">
						<div class="d-flex justify-content-center align-items-center h-100">
							<i class="fa-solid fa-cart-shopping"></i>
							<div class="mx-2 mt-1 fw-bolder text-uppercase"><?= $this->lang->line('add-to-cart') ?></div>
						</div>
					</a>
				<?php } ?>
			<?php } else { ?>
				<button type="button" class="btn btn-lg btn-secondary d-flex align-items-center justify-content-center" style="width: fit-content;">
					<div class="d-flex justify-content-center align-items-center h-100">
						<div class="mx-2 mt-1 fw-bolder text-uppercase"><?= $this->lang->line('out-of-stock') ?></div>
					</div>
				</button>
			<?php } ?>
		</div>

	</main>

	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>
	<script type="text/javascript" src="<?= base_url('assets_web/js/index.js') ?>"></script>
	<script src="<?= base_url(); ?>assets_web/js/product_details.js"></script>

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

		var video = document.getElementById('product-video');
		var playButton = document.getElementById('custom-play-button');
		var fullscreenBtn = document.querySelector('.fullscreen-button ');

		if (playButton && video) {
			playButton.addEventListener('click', function() {
				video.play();
				playButton.style.display = 'none';
			});

			video.addEventListener('pause', function() {
				playButton.style.display = 'block';
			});

			video.addEventListener('click', function() {
				if (video.paused) {
					video.play();
					playButton.style.display = "none";
				} else {
					video.pause();
					playButton.style.display = "flex";
				}
			});

			fullscreenBtn.addEventListener('click', () => {
				if (!video.paused) {
					video.pause();
					playButton.style.display = "flex";
				}
			});
		}

		const createOfferTimer = () => {
			// Desktop Timer Container
			const timer_container_pd = document.querySelectorAll('.timer_container_prod_details');
			const hour = document.querySelectorAll('.timer_text_pd.hour');
			const minute = document.querySelectorAll('.timer_text_pd.minute');
			const second = document.querySelectorAll('.timer_text_pd.second');

			// Tab, Mobile Timer Container
			const timer_container_mob = document.querySelectorAll('.timer_container_prod_details_tab_mob');
			const hour_mob = document.querySelectorAll('.timer_text_tab_mob.hour');
			const minute_mob = document.querySelectorAll('.timer_text_tab_mob.minute');
			const second_mob = document.querySelectorAll('.timer_text_tab_mob.second');
			if (timer_container_pd && timer_container_mob) {
				const offer_start_date_str = '<?= $productdetails['offer_start_date'] ?>';
				const offer_end_date_str = '<?= $productdetails['offer_end_date'] ?>';

				// Convert offer start and end dates to JavaScript Date objects in Asia/Muscat time zone
				const offer_start_date = new Date(offer_start_date_str + " GMT+4");
				const offer_end_date = new Date(offer_end_date_str + " GMT+4");

				// Get the current date in user's time zone
				const current_date = new Date();

				// Check if the offer has started
				if (current_date >= offer_start_date && current_date <= offer_end_date) {
					// Calculate remaining time if the offer has started
					const time_difference = offer_end_date - current_date;
					const remaining_hours = Math.floor(time_difference / (1000 * 60 * 60));
					const remaining_minutes = Math.floor((time_difference % (1000 * 60 * 60)) / (1000 * 60));
					const remaining_seconds = Math.floor((time_difference % (1000 * 60)) / 1000);
					console.log(remaining_hours);
					hour.forEach(element => {
						element.innerText = remaining_hours
					});
					minute.forEach(element => {
						element.innerText = remaining_minutes
					});
					second.forEach(element => {
						element.innerText = remaining_seconds
					});

					hour_mob.forEach(element => {
						element.innerText = remaining_hours
					});
					minute_mob.forEach(element => {
						element.innerText = remaining_minutes
					});
					second_mob.forEach(element => {
						element.innerText = remaining_seconds
					});

					updateTimerElements(hour, minute, second, timer_container_pd);
					updateTimerElements(hour_mob, minute_mob, second_mob, timer_container_mob);
				} else {
					timer_container_pd.forEach(element => {
						element.remove();
					});
					timer_container_mob.forEach(element => {
						element.remove();
					});
				}
			}
		}

		createOfferTimer();
	</script>

	<script type="text/javascript" src="https://punjablive1.com/dist/js/toastify.js"></script>

</body>

</html>