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
		<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
		<input type="hidden" id="qoute_id" value="<?php echo $this->session->userdata('qoute_id'); ?>">
		<input type="hidden" name="whatsapp_number" value="<?php echo whatsapp_number; ?>" id="whatsapp_number">

		<!--
		  --------------------------------------------------- 
		  Desktop category section
		  ---------------------------------------------------
		-->
		<section class="desktop-category-section mb-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-5">
					<div class="section-heading pb-md-3">
						<span style="color: #666666;">Shop From </span>
						<span style="color: var(--bs-primary);"> Categories</span>
					</div>
					<div class="d-flex align-items-center">
						<span class="view-all">View All</span>
						<i class="fa-solid fa-chevron-right ms-2"></i>
					</div>
				</div>
				<div class="swiper section-5-category-div" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper">
						<?php foreach ($home_section5 as $home_category) : ?>
							<div class="swiper-slide">
								<a href="<?= $home_category->link ?>" class="d-flex align-items-center flex-column justify-content-center">
									<div class="d-flex justify-content-center">
										<img src="<?= base_url('media/' . json_decode($home_category->image)->{'470-720'}) ?>" alt="<?= $home_category->cat_name ?>">
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
		<section id="heroHomeSlider" class="mb-5">
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
			Best deal
			---------------------------------------------------
		-->
		<section class="best-deal-section mb-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-5">
					<div class="section-heading pb-md-3">
						<span style="color: #666666;">Grab the best deal on </span>
						<span style="color: var(--bs-primary);"> Camera’s</span>
					</div>
					<div class="d-flex align-items-center">
						<span class="view-all">View All</span>
						<i class="fa-solid fa-chevron-right ms-2"></i>
					</div>
				</div>
				<div class="swiper product-swiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper">
						<?php for ($i = 0; $i < 10; $i++) : ?>
							<div class="swiper-slide">
								<a href="#" class="d-flex flex-column card product-card rounded-4">
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
							<div class="swiper-slide">
								<a href="#" class="d-flex align-items-center flex-column justify-content-center card product-card rounded-4">
									<img src="<?= base_url('assets_web/images/camera.png') ?>" class="card-img-top product-card-img" alt="">
									<div class="card-body d-flex flex-column product-card-body">
										<h5 class="card-title product-title line-clamp-2 mb-auto">Galaxy M33 (4GB | 64 GB ) Galaxy M33 (4GB | 64 GB )</h5>
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
						<?php endfor; ?>
					</div>
				</div>
		</section>

		<!-- 
			---------------------------------------------------
			Events secttion 
			---------------------------------------------------
		-->
		<section class="event-section mb-5">
			<div class="container py-4">
				<div class="row">
					<div class="col-md-3">
						<div class="d-flex flex-column h-100">
							<div class="event-section-heading">Search by events</div>
							<div class="event-section-des pb-2">Get the latest item that make your day ful of smile</div>
							<a href="#" class="d-flex align-items-center mt-auto mb-md-5 pb-2">
								<span class="view-all">View All</span>
								<i class="fa-solid fa-chevron-right ms-2"></i>
							</a>
						</div>
					</div>
					<div class="col-md-9 d-none d-md-block">
						<div class="swiper event-swiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
							<div class="swiper-wrapper">
								<?php for ($i = 0; $i < 10; $i++) : ?>
									<div class="swiper-slide">
										<a href="#" class="card event-card">
											<img src="<?= base_url('assets_web/images/event.jpeg') ?>" class="card-img-top event-card-img" alt="">
											<div class="card-body event-card-body p-0">
												<h5 class="card-title event-title text-center line-clamp-1">Wedding</h5>
											</div>
										</a>
									</div>
								<?php endfor; ?>
							</div>
						</div>
					</div>
					<div class="col-md-9 d-block d-md-none">
						<div class="row">
							<?php for ($i = 0; $i < 10; $i++) : ?>
								<div class="col-6 col-sm-4 pb-3">
									<img src="<?= base_url('assets_web/images/event.jpeg') ?>" class="event-card-img" alt="">
									<div class="event-title text-center line-clamp-1">Wedding</div>
								</div>
							<?php endfor; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!--
			--------------------------------------------------- 
			Top Brand 
			---------------------------------------------------
		-->
		<section class="top-brand-section mb-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-5">
					<div class="section-heading pb-md-3">
						<span style="color: #666666;">Top </span>
						<span style="color: var(--bs-primary);"> Brands</span>
					</div>
					<div class="d-flex align-items-center">
						<span class="view-all">View All</span>
						<i class="fa-solid fa-chevron-right ms-2"></i>
					</div>
				</div>
				<div class="swiper brand-swiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper">
						<?php for ($i = 0; $i < 10; $i++) : ?>
							<div class="swiper-slide">
								<a href="#">
									<img src="<?= base_url('assets_web/images/brand1.png') ?>" alt="Brand" class="brand-img">
								</a>
							</div>
							<div class="swiper-slide">
								<a href="#">
									<img src="<?= base_url('assets_web/images/brand2.png') ?>" alt="Brand" class="brand-img">
								</a>
							</div>
						<?php endfor; ?>
					</div>
				</div>
		</section>

		<!--
			--------------------------------------------------- 
			New Arrival 
			---------------------------------------------------
		-->
		<section class="top-brand-section mb-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-5">
					<div class="section-heading pb-md-3">
						<span style="color: #666666;">Top </span>
						<span style="color: var(--bs-primary);"> Brands</span>
					</div>
					<div class="d-flex align-items-center">
						<span class="view-all">View All</span>
						<i class="fa-solid fa-chevron-right ms-2"></i>
					</div>
				</div>
				<div class="swiper brand-swiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper">
						<?php for ($i = 0; $i < 10; $i++) : ?>
							<div class="swiper-slide">
								<a href="#">
									<img src="<?= base_url('assets_web/images/arrival.svg') ?>" alt="Brand" class="brand-img">
								</a>
							</div>
						<?php endfor; ?>
					</div>
				</div>
		</section>

		<!--
		  --------------------------------------------------- 
		  Testimonials
		  ---------------------------------------------------
		-->
		<section class="testimonial-section mb-5">
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
							<?php for ($i = 0; $i < 10; $i++) : ?>
								<div class="swiper-slide">
									<div class="card">
										<div class="card-body">
											<div class="d-flex align-items-center mb-3 customer-profile">
												<img class="customer-img" src="<?= base_url('assets_web/images/user.svg') ?>" alt="User Name">
												<div class="d-flex flex-column ms-4">
													<div class="customer-name">Josh Smith</div>
													<div class="customer-des">Manager of The New York Times</div>
												</div>
											</div>
											<div class="review mb-2">
												“They are have a perfect touch for make something so professional ,interest and useful for a lot of people .”
											</div>
											<div class="review-img">
												<img src="<?= base_url('assets_web/images/product.svg') ?>" alt="">
											</div>
										</div>
									</div>
								</div>
							<?php endfor; ?>
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
			Multi banner 
			---------------------------------------------------
		-->
		<section class="multibanner-section mb-5">
			<div class="container">
				<div class="row pt-5">
					<a href="#1" class="col-md-6 mb-2 mb-md-0">
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
					</div>
				</div>
			</div>
		</section>


		<!-- 
			---------------------------------------------------
			All product
			---------------------------------------------------
		-->
		<section class="all-product-section mb-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-5">
					<div class="section-heading pb-md-3">
						<span style="color: #666666;">Explore </span>
						<span style="color: var(--bs-primary);"> All Product</span>
					</div>
					<div class="d-flex align-items-center">
						<span class="view-all">View All</span>
						<i class="fa-solid fa-chevron-right ms-2"></i>
					</div>
				</div>

				<div class="row all-products">
					<?php for ($i = 0; $i < 10; $i++) : ?>
						<div class="col-6 col-sm-4 col-md-3 mb-3">
							<a href="#" class="d-flex flex-column card product-card rounded-4 h-100">
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
						<div class="col-6 col-sm-4 col-md-3 mb-3">
							<a href="#" class="d-flex flex-column card product-card rounded-4 h-100">
								<img src="<?= base_url('assets_web/images/camera.png') ?>" class="card-img-top product-card-img" alt="">
								<div class="card-body d-flex flex-column product-card-body">
									<h5 class="card-title product-title line-clamp-2 mb-auto">Galaxy M33 (4GB | 64 GB ) Galaxy M33 (4GB | 64 GB )</h5>
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
					<?php endfor; ?>
				</div>
		</section>

	</main>
	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>

	<!-- Plugin JS -->
	<script src="<?= base_url('assets_web/libs/swiper/swiper-bundle.min.js') ?>"></script>

	<script src="<?php echo base_url(); ?>assets_web/js/app/index.js"></script>
</body>

</html>