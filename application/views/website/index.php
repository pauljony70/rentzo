<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Home";
	include("include/headTag.php") ?>
	<!-- Plugin css -->
	<link rel="stylesheet" href="<?= base_url('assets_web/libs/swiper/swiper-bundle.min.css') ?>" />

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/index.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/product-card.css') ?>">
</head>

<body>
	<?php include("include/loader.php") ?>
	<?php include("include/topbar.php") ?>
	<?php include("include/navbar.php") ?>

	<main class="index-page">
		<input type="hidden" id="qoute_id" value="<?= $this->session->userdata('qoute_id'); ?>">
		<input type="hidden" name="whatsapp_number" value="<?= whatsapp_number; ?>" id="whatsapp_number">

		<!--
		  --------------------------------------------------- 
		  User location
		  ---------------------------------------------------
		-->
		<div class="user-location">
			<div class="container d-flex d-md-none align-items-center mt-2 mb-4">
				<img src="<?= base_url('assets_web/images/icons/location-pin.svg') ?>" alt="Location">
				<div class="location" data-bs-toggle="modal" data-bs-target="#pincodeModal"><span id="address_data1"><?= $this->session->userdata("address") != '' ? $this->session->userdata("address") : 'Location' ?></span></div>
			</div>
		</div>

		<!--
		  --------------------------------------------------- 
		  Desktop category section
		  ---------------------------------------------------
		-->
		<section class="desktop-category-section mb-4 mb-md-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-4 mb-md-5">
					<div class="section-heading pb-md-3">
						<span style="color: #666666;">Shop From </span>
						<span style="color: var(--bs-primary);"> Categories</span>
					</div>
					<div class="d-flex align-items-center">
						<a href="<?= base_url('all-category') ?>">
							<span class="view-all">View All</span>
							<i class="fa-solid fa-chevron-right ms-2"></i>
						</a>
					</div>
				</div>
				<div class="swiper section-5-category-div" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper">
						<?php foreach ($home_section5 as $home_category) : ?>
							<div class="swiper-slide">
								<a href="<?php echo base_url . $home_category->cat_name; ?>" class="d-flex align-items-center flex-column justify-content-center">
									<div class="d-flex justify-content-center">
										<img src="<?= MEDIA_URL . json_decode($home_category->image)->{'470-720'} ?>" alt="<?= $home_category->cat_name ?>">
									</div>
									<div class="text-center my-3">
										<?= $home_category->cat_name ?>
									</div>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
		</section>

		<!--
		  --------------------------------------------------- 
		  Top slider
		  ---------------------------------------------------
		-->
		<section id="heroHomeSlider" class="mb-4 mb-md-5">
			<div class="container">
				<div class="swiper top-slider">
					<div class="swiper-wrapper">
						<?php foreach ($header_banner as $section1) : ?>
							<a href="<?= $section1->link ?>" class="swiper-slide d-flex justify-content-center align-items-center">
								<img src="<?= $section1->image ?>" class="" alt="" srcset="">
							</a>
						<?php endforeach; ?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-pagination text-start"></div>
				</div>
			</div>
		</section>


		<!-- 
			---------------------------------------------------
			First product section
			---------------------------------------------------
		-->
		<section class="best-deal-section mb-4 mb-md-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-4 mb-md-5">
					<div class="section-heading pb-md-3">
						<span style="color: #666666;" id="prod_section1_title"></span>
						<!--<span style="color: var(--bs-primary);"> Camera’s</span>-->
					</div>
					<!--<div class="d-flex align-items-center">
						<span class="view-all">View All</span>
						<i class="fa-solid fa-chevron-right ms-2"></i>
					</div>-->
				</div>
				<div class="swiper product-swiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper" id="prod_section_1_products">
						<!-- <?php for ($i = 0; $i < 10; $i++) : ?>
							<div class="swiper-slide">
								<a href="<?= base_url('men-white-and-teal-blue-slim-fit-striped-casual-shirt?pid=P5YPCG1W4Sj&sku=Men-White-and-Teal-Blue-Slim-Fit-Striped-Casual-Shirt&sid=SVR6og303Vm') ?>" class="d-flex flex-column card product-card rounded-4">
									<img src="<?= base_url('assets_web/images/camera.png') ?>" class="card-img-top product-card-img" alt="">
									<div class="card-body d-flex flex-column product-card-body">
										<h5 class="card-title product-title line-clamp-2 mb-auto">Galaxy M33</h5>
										<div class="card-text d-flex justify-content-between py-1">
											<div class="rent-heading">Rent</div>
											<div class="rent-price">$2.25/day</div>
										</div>
										<div class="product-card-footer pt-1">
											<div class="text-success">Available Today</div>
										</div>
									</div>
								</a>
							</div>
						<?php endfor; ?> -->
					</div>
				</div>
		</section>

		<!-- 
			---------------------------------------------------
			Events secttion 
			---------------------------------------------------
		-->
		<section class="event-section mb-4 mb-md-5">
			<div class="container py-4">
				<div class="row">
					<div class="col-md-3">
						<div class="d-flex flex-column h-100">
							<div class="event-section-heading d-flex justify-content-between">
								<div>Search by events</div>
								<a href="#" class="d-flex d-md-none align-items-center">
									<span class="view-all">View All</span>
									<i class="fa-solid fa-chevron-right ms-2"></i>
								</a>
								</a>
							</div>
							<div class="event-section-des pb-2">Get the latest item that make your day ful of smile</div>
							<a href="#" class="d-none d-md-flex align-items-center mt-auto mb-md-5 pb-2">
								<span class="view-all">View All</span>
								<i class="fa-solid fa-chevron-right ms-2"></i>
							</a>
						</div>
					</div>
					<div class="col-md-9 d-none d-md-block">
						<div class="swiper event-swiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
							<div class="swiper-wrapper" id="home_events">
								<!-- <?php for ($i = 0; $i < 10; $i++) : ?>
									<div class="swiper-slide">
										<a href="#" class="card event-card">
											<img src="<?= base_url('assets_web/images/event.jpeg') ?>" class="card-img-top event-card-img" alt="">
											<div class="card-body event-card-body p-0">
												<h5 class="card-title event-title text-center line-clamp-1">Wedding</h5>
											</div>
										</a>
									</div>
								<?php endfor; ?> -->
							</div>
						</div>
					</div>
					<div class="col-md-9 d-block d-md-none">
						<div class="row" id="home_events_mobile">
							<!-- <?php for ($i = 0; $i < 10; $i++) : ?>
								<div class="col-6 col-sm-4 pb-3">
									<img src="<?= base_url('assets_web/images/event.jpeg') ?>" class="event-card-img" alt="">
									<div class="event-title text-center line-clamp-1">Wedding</div>
								</div>
							<?php endfor; ?> -->
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- 
			---------------------------------------------------
			Nearby Products
			---------------------------------------------------
		-->
		<?php if (count($nearby_products)) : ?>
			<section class="best-deal-section mb-4 mb-md-5">
				<div class="container">
					<div class="d-flex align-items-center justify-content-between mb-4 mb-md-5">
						<div class="section-heading pb-md-3">
							<span style="color: #666666;">Products available in </span>
							<span style="color: var(--bs-primary);"> <?= $this->session->userdata("address") ?></span>
						</div>
						<!--<div class="d-flex align-items-center">
						<span class="view-all">View All</span>
						<i class="fa-solid fa-chevron-right ms-2"></i>
					</div>-->
					</div>
					<div class="swiper product-swiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
						<div class="swiper-wrapper" id="near_products">
							<?php foreach ($nearby_products as $nearby_product) : ?>
								<div class="swiper-slide">
									<a href="<?= base_url($nearby_product['web_url'] . '?pid=' . $nearby_product['id'] . '&sku=' . $nearby_product['sku'] . '&sid=' . $nearby_product['vendor_id']) ?>" class="d-flex flex-column card product-card rounded-4">
										<img src="<?= $nearby_product['img'] ?>" class="card-img-top product-card-img rounded-4" alt="<?= $nearby_product['name'] ?>">
										<div class="card-body d-flex flex-column product-card-body">
											<h5 class="card-title product-title line-clamp-2 mb-auto"><?= $nearby_product['name'] ?></h5>
											<div class="card-text d-flex justify-content-between py-1">
												<div class="rent-heading">Rent</div>
												<div class="rent-price"><?= $nearby_product['day1_price'] ?>/day</div>
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
		<?php endif; ?>


		<!--
			--------------------------------------------------- 
			Top Brand 
			---------------------------------------------------
		-->
		<section class="top-brand-section mb-4 mb-md-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-4 mb-md-5">
					<div class="section-heading pb-md-3">
						<span style="color: #666666;">Top </span>
						<span style="color: var(--bs-primary);"> Brands</span>
					</div>
					<div class="d-flex align-items-center">
						<a href="<?= base_url() . 'brands'; ?>"><span class="view-all">View All</span>
							<i class="fa-solid fa-chevron-right ms-2"></i></a>
					</div>
				</div>
				<div class="swiper brand-swiper">
					<div class="swiper-wrapper">
						<?php
						foreach ($header_brand as $key => $brand) :
							if ($key > 9) break;
						?>
							<div class="swiper-slide">
								<a href="<?= base_url() . 'shop/brand/' . $brand['brand_name'] ?>">
									<img src="<?= MEDIA_URL . json_decode($brand['brand_img'])->{'280-310'}; ?>" alt="<?= $brand['brand_name']; ?>" class="brand-img">
								</a>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="swiper-pagination mt-4"></div>
				</div>
		</section>

		<!--
			--------------------------------------------------- 
			New Arrival 
			---------------------------------------------------
		-->
		<section class="top-brand-section mb-4 mb-md-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-4 mb-md-5">
					<div class="section-heading pb-md-3">
						<span style="color: #666666;">New </span>
						<span style="color: var(--bs-primary);"> Arrival</span>
					</div>
					<div class="d-flex align-items-center">
						<span class="view-all">View All</span>
						<i class="fa-solid fa-chevron-right ms-2"></i>
					</div>
				</div>
				<div class="swiper brand-swiper">
					<div class="swiper-wrapper" id="home_arrivel_banner">
						<!-- <?php for ($i = 0; $i < 10; $i++) : ?>
							<div class="swiper-slide">
								<a href="#">
									<img src="<?= base_url('assets_web/images/arrival.svg') ?>" alt="Brand" class="brand-img">
								</a>
							</div>
						<?php endfor; ?> -->
					</div>
					<div class="swiper-pagination mt-4"></div>
				</div>
		</section>

		<!--
		  --------------------------------------------------- 
		  Testimonials
		  ---------------------------------------------------
		-->
		<section class="testimonial-section mb-4 mb-md-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-3">
					<div class="section-heading">
						<span>What people are saying about us</span>
					</div>
				</div>
			</div>
			<div class="testimonial-section-container pt-5 pb-4">
				<div class="container">
					<div class="swiper testimonial-swiper">
						<div class="swiper-wrapper mb-4">
							<?php foreach ($review_data as $reviews) { ?>
								<div class="swiper-slide">
									<div class="card">
										<div class="card-body">
											<div class="d-flex align-items-center mb-3 customer-profile">
												<img class="customer-img" src="<?= $reviews['profile_pic']; ?>" alt="<?= $reviews['name']; ?>">
												<div class="d-flex flex-column ms-4">
													<div class="customer-name"><?= $reviews['name']; ?></div>
													<div class="customer-des"><?= $reviews['title']; ?></div>
													<div class="d-flex stars">
														<?php
														$rating = round($reviews['rating'] * 2) / 2;
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
											<div class="review mb-2 line-clamp-2">
												“<?= $reviews['comment']; ?>”
											</div>
											<div class="review-img text-center">
												<img src="<?= $reviews['imgurl']; ?>" alt="">
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="swiper-navigation d-flex justify-content-center align-items-center py-2">
							<div class="swiper-btn-prev">
								<img src="<?= base_url('assets_web/images/icons/arrow-left-black.svg') ?>" alt="Previous">
							</div>
							<div class="swiper-btn-next">
								<img src="<?= base_url('assets_web/images/icons/arrow-right-white.svg') ?>" alt="Next">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- 
			---------------------------------------------------
			Multi image banner
			---------------------------------------------------
		-->
		<section class="multibanner-section mb-4 mb-md-5">
			<div class="container">
				<div class="row pt-5" id="home_bottom_banner">
					<!-- <a href="#1" class="col-md-6 mb-2 mb-md-0">
						<img src="<?= base_url('assets_web/images/banner1.svg') ?>" alt="" class="banner1">
					</a>
					<div class="col-md-6 mt-2 mt-md-0">
						<div class="row">
							<a href="#2" class="col-12 mb-2">
								<img src="<?= base_url('assets_web/images/banner2.svg') ?>" alt="" class="banner2">
							</a>
							<div class="col-12 mt-2">
								<div class="row">
									<a href="#3" class="col-6">
										<img src="<?= base_url('assets_web/images/banner3.svg') ?>" alt="banner3">
									</a>
									<a href="#4" class="col-6">
										<img src="<?= base_url('assets_web/images/banner4.svg') ?>" alt="banner4">
									</a>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</section>


		<!-- 
			---------------------------------------------------
			Bottom product section
			---------------------------------------------------
		-->
		<section class="all-product-section mb-4 mb-md-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-4 mb-md-5">
					<div class="section-heading pb-md-3">
						<span style="color: #666666;" id="prod_section2_title"> </span>
						<!--<span style="color: var(--bs-primary);"> All Product</span>-->
					</div>
					<!--<div class="d-flex align-items-center">
						<span class="view-all">View All</span>
						<i class="fa-solid fa-chevron-right ms-2"></i>
					</div>-->
				</div>

				<div class="row all-products" id="prod_section_2_products">

					<!-- <?php for ($i = 0; $i < 10; $i++) : ?>
						<div class="col-4 col-sm-4 col-md-3 mb-3 px-2">
							<a href="<?= base_url('men-white-and-teal-blue-slim-fit-striped-casual-shirt?pid=P5YPCG1W4Sj&sku=Men-White-and-Teal-Blue-Slim-Fit-Striped-Casual-Shirt&sid=SVR6og303Vm') ?>" class="d-flex flex-column card product-card rounded-4 h-100">
								<img src="<?= base_url('assets_web/images/camera.png') ?>" class="card-img-top product-card-img" alt="">
								<div class="card-body d-flex flex-column product-card-body">
									<h5 class="card-title product-title line-clamp-2 mb-auto">Galaxy M33 (4GB | 64 GB )</h5>
									<div class="card-text d-flex justify-content-between py-1">
										<div class="rent-heading">Rent</div>
										<div class="rent-price">$2.25/day</div>
									</div>
									<div class="product-card-footer pt-1">
										<div class="text-success">Available Today</div>
									</div>
								</div>
							</a>
						</div>
					<?php endfor; ?> -->
				</div>
		</section>

	</main>
	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>

	<!-- Plugin JS -->
	<script src="<?= base_url('assets_web/libs/swiper/swiper-bundle.min.js') ?>"></script>

	<script src="<?= base_url(); ?>assets_web/js/app/index.js"></script>

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