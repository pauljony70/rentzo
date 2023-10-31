<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Home";
	include("include/headTag.php") ?>
	<!-- Plugin css -->
	<link rel="stylesheet" href="<?= base_url('assets_web/libs/swiper/swiper-bundle.min.css') ?>" />

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/index.css') ?>">
</head>

<body>
	<?php include("include/loader.php") ?>
	<?php include("include/topbar.php") ?>
	<?php include("include/navbar.php") ?>

	<main class="index-page">
		<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
		<input type="hidden" id="qoute_id" value="<?php echo $this->session->userdata('qoute_id'); ?>">
		<input type="hidden" name="whatsapp_number" value="<?php echo whatsapp_number; ?>" id="whatsapp_number">

		<!-- Desktop category section -->
		<section class="desktop-category-section mb-5">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mb-5">
					<div class="desktop-category-section-heading pb-3">
						<span style="color: #666666;">Shop From </span>
						<span style="color: #008ECC;"> Categories</span>
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
								<a href="<?= $home_category->link ?>" class="d-flex aligm-items-center flex-column justify-content-center">
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
		<?php foreach ($header_banner as $section1) { ?>
			<?php // echo $section1->link; 
			?>
			<?php //echo $section1->image; 
			?>
		<?php } ?>
		<section id="heroHomeSlider" class="mt-2 mt-md-0">
			<div class="container">
				<div class="swiper top-slider" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper">
						<a href="#" class="swiper-slide">
							<img src="<?= base_url('assets_web/images/banner.svg') ?>" class=" w-100" alt="" srcset="">
						</a>
						<a href="#" class="swiper-slide">
							<img src="<?= base_url('assets_web/images/banner.svg') ?>" class=" w-100" alt="" srcset="">
						</a>
						<a href="#" class="swiper-slide">
							<img src="<?= base_url('assets_web/images/banner.svg') ?>" class=" w-100" alt="" srcset="">
						</a>
						<a href="#" class="swiper-slide">
							<img src="<?= base_url('assets_web/images/banner.svg') ?>" class=" w-100" alt="" srcset="">
						</a>
						<a href="#" class="swiper-slide">
							<img src="<?= base_url('assets_web/images/banner.svg') ?>" class=" w-100" alt="" srcset="">
						</a>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</section>

		<section id="homeTopCategoryMobile" class="d-md-none mt-2">
			<div class="container-fluid homeTopCategoryMobileContainer">
				<?php

				foreach ($header_cat as $maincat_top) {

					/*foreach ($home_section5 as $home_section5_data) {

					$img_decode1 = json_decode($home_section5_data->image);
					$img_url = MEDIA_URL . $img_decode1->{'470-720'};*/
				?>
					<div onclick="redirect_to_link('<?php echo base_url . 'shop/' . $maincat_top['cat_slug']; ?>')" class="a-homeTopCategoryMobileCard me-2">
						<div class="card">
							<img src="<?php echo 'media/' . $maincat_top['imgurl']; ?>" alt="">
							<div class="card-body p-0">
								<p class="mb-0 mt-2 fs-small fw-semibold"><?php echo $maincat_top['cat_name']; ?></p>
							</div>
						</div>
					</div>

				<?php } ?>


			</div>
		</section>

		<section id="heroHomeSlider" class="mt-2 mt-md-0">
			<?php foreach ($header_banner as $section1) { ?>
				<a href="<?php echo $section1->link; ?>">
					<div class="a-slider-hero">
						<img src="<?php echo $section1->image; ?>" class="img-fluid" alt="" srcset="" style="object-fit: cover; width: 100%;">
					</div>
				</a>
			<?php } ?>

		</section>

		<?php

		$section6_image1 = $section6_link1 = '';


		foreach ($home_section6 as $section6) {


			$section6_image1 = $section6->image;

			$section6_link1 = $section6->link;
		}
		if ($section6_link1 != '') {
		?>

			<section id="homeOffers" class="mt-3">
				<div class="container px-1">

					<div onclick="redirect_to_link('<?php echo $section6_link1; ?>')" class="a-homeOffers" style="">
						<img src="<?php echo $section6_image1; ?>" alt="" srcset="">
					</div>
				</div>
			</section>


		<?php } ?>

		<!-- App Download Section -->
		<section id="homeOffers" class="mt-3 ">
			<div class="container px-1">
				<div class="p-4 p-sm-5 rounded-3" style="background-color: #ff914c;">
					<div class="row align-items-center">
						<div class="col-md-6 text-center">
							<h3 class="text-light fw-bolder" style="font-size: 20px"> <?= $this->lang->line('download-app-heading'); ?></h3>
							<p class="text-light mb-3 mb-lg-0" style="font-size: 14px;"><?= $this->lang->line('download-app-content'); ?></p>
						</div>
						<div class="col-md-6 d-flex justify-content-center justify-content-md-end">
							<a href="#">
								<img src="<?php echo base_url . 'assets_web/images/svgs/google-play.svg' ?>" alt="Play Store" style="width: 150px;">
							</a>
							<a href="#" class="<?= $default_language == 1 ? 'me-2' : 'ms-2' ?>">
								<img src="<?php echo base_url . 'assets_web/images/svgs/app-store.svg' ?>" alt="App Store" style="width: 150px;">
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Photo Grid Box -->
		<section class="my-5 mx-1">
			<div class="container photo_grid rounded p-0">
				<h4 class="pt-2 m-0 fw-bolder px-3" style="font-size: 16px;"> <?= $this->lang->line('special-deals-on-ebuy'); ?></h4>
				<div class="swiper mySwiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper align-items-center">
						<?php foreach ($deals_banners as $deals_banner) : ?>
							<a href="<?= $deals_banner->link ?>" class="swiper-slide">
								<div class="p-sm-2 p-md-2 p-lg-2 p-1">
									<img src="<?= $deals_banner->image ?>" alt="" class="w-100 photo_grid_img rounded ">
								</div>
							</a>
						<?php endforeach; ?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</section>



		<section id="homeTopCategory" class="trending-section d-none d-md-block mt-3">
			<div class="container px-1">
				<h4 class="mb-1 <?= $default_language == 1 ? 'me-3' : 'ms-3' ?>"><?= $this->lang->line('home-shop-our-top-categories') ?></h4>

				<div class="swiper top-categories" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper">
						<?php
						foreach ($home_section5 as $home_section5_data) :
							$img_decode1 = json_decode($home_section5_data->image);
							$img_url = MEDIA_URL . $img_decode1->{'470-720'};
						?>
							<div class="swiper-slide">
								<div class="d-flex aligm-items-center flex-column justify-content-center">
									<a class="category-img" href="<?php echo base_url . 'shop/' . $home_section5_data->cat_slug; ?>">
										<img src="<?php echo $img_url; ?>" alt="">
									</a>
									<h5 class="fw-bolder text-center text-dark my-2">
										<?= $this->session->userdata('default_language') == 1 ? $home_section5_data->cat_name_ar : $home_section5_data->cat_name; ?>
									</h5>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-scrollbar"></div>
				</div>
			</div>
		</section>

		<section class="trending-section mb-5">
			<div class="container px-1">
				<h4 class="mb-1 <?= $default_language == 1 ? 'me-3' : 'ms-3' ?>"><?= $this->lang->line('home-today-deal') ?></h4>
				<section id="homeOffers" class="mt-4">
					<div class="container mt-3 px-1">
						<div class="swiper slider-trending_New" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 18px;">
							<div class="swiper-wrapper" id="New_products"></div>
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
						</div>
					</div>
				</section>
			</div>
		</section>

		<section id="homeTopCategory" class="trending-section mt-3">
			<div class="container px-1">
				<div class="d-flex justify-content-between mb-1 <?= $default_language == 1 ? 'me-3' : 'ms-3' ?>">
					<h4 class="mb-0"><?= $this->lang->line('home-shop-our-top-brands') ?></h4>
					<a href="<?= base_url('brands') ?>" class="text-uppercase" role="button" style="font-size: smaller;"><?= $this->lang->line('see-all') ?> <i class="fa-solid fa-chevron-<?= $default_language == 1 ? 'left' : 'right' ?>"></i></a>
				</div>
				<div class="swiper top-categories" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper">
						<?php
						foreach ($brands as $brand) :
							$img_decode1 = json_decode($brand['brand_img']);
							$img_url = MEDIA_URL . $img_decode1->{'72-72'};
						?>
							<div class="swiper-slide">
								<div class="d-flex aligm-items-center flex-column justify-content-center">
									<a class="brand-img" href="<?php echo base_url . 'shop/brand/' . rawurlencode($brand['brand_name']); ?>">
										<img src="<?php echo $img_url; ?>" alt="">
									</a>
									<h5 class="fw-bolder text-center text-dark my-2">
										<?= $default_language == 1 ?  $brand['brand_name_ar'] : $brand['brand_name'] ?>
									</h5>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-scrollbar"></div>
				</div>
			</div>
		</section>

		<section class="trending-section mb-5">
			<div class="container px-1">
				<h4 class="mb-1 <?= $default_language == 1 ? 'me-3' : 'ms-3' ?>"><?= $this->lang->line('home-top-selling') ?></h4>
				<section id="homeOffers" class="mt-4">
					<div class="container mt-3 px-1" style="padding: 0 !important;" id="section4_banner">

					</div>
				</section>
				<div class="swiper slider-trending_Popular" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 18px;">
					<div class="swiper-wrapper" id="Popular_products"></div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</section>



		<section class="trending-section mb-5">
			<div class="container px-1">
				<h4 class="mb-1 <?= $default_language == 1 ? 'me-3' : 'ms-3' ?>"><?= $this->lang->line('home-trending-products') ?></h4>
				<section id="homeOffers" class="mt-4">
					<div class="container mt-3 px-1" style="padding: 0 !important;" id="section10_banner">

					</div>
				</section>
				<div class="swiper slider-trending_Recommended" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 18px;">
					<div class="swiper-wrapper" id="Recommended_products"></div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</section>

		<section id="homeMasonry" class="mt-6">
			<div class="container px-3">
				<div class="a-Masonry" id="home_bottom_banner"></div>
			</div>
		</section>



		<section class="trending-section may_like mt-5 mb-5">
			<div class="container px-1">
				<h4 class="mb-1 <?= $default_language == 1 ? 'me-3' : 'ms-3' ?>"><?= $this->lang->line('home-you-may-like') ?></h4>
				<div class="swiper slider-trending_Offers" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 18px;">
					<div class="swiper-wrapper" id="Offers_products"></div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</section>

		<section class="trending-section may_like_mob pt-5 mb-5">
			<div class="container px-1">
				<h4 class="mb-1 <?= $default_language == 1 ? 'me-3' : 'ms-3' ?>"><?= $this->lang->line('home-you-may-like') ?></h4>
				<section id="homeOffers" class="mt-4">
					<div class="container px-0">
						<div class="row mx-0 may_you_like_mob">
							<?php
							foreach ($offers_product as $key => $offers_product_data) {
								if ($key < 4) {
							?>
									<div class="col-6 py-2">
										<a href="<?php echo base_url . $offers_product_data['sku'] . '?pid=' . $offers_product_data['id'] . '&sku=' . $offers_product_data['sku'] . '&sid=' . $offers_product_data['vendor_id']; ?>" class="card h-100 d-flex flex-column justify-content-between product-link-card">
											<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
												<span class="discount" style="direction: ltr;">-25%</span>
												<span class="wishlist"><i class="fa fa-heart-o"></i></span>
											</div>
											<div class="image-container mt-3 zoom-img">
												<img src="<?php echo $offers_product_data['imgurl']; ?>" class="zoom-img thumbnail-image">
											</div>
											<div class="product-detail-container pt-2 mb-1">
												<div class="justify-content-between align-items-center" style="padding:5px;">
													<p class="dress-name mb-0"><?php echo $offers_product_data['name']; ?></p>
													<div class="d-flex align-items-center justify-content-start flex-row mt-2" style="width: 100%;">
														<span class="new-price"><?php echo $offers_product_data['price']; ?></span>
														<small class="old-price text-right mx-1"><?php echo $offers_product_data['mrp']; ?></small>
													</div>
												</div>
												<div class="d-flex justify-content-between align-items-center mt-1" style="padding: 0 5px;">
													<div class="d-flex align-items-center">
														<i class="fa-solid fa-star fa-lg" style="color: #FFD700;"></i>
														<div class="rating-number ms-2 mt-1">4.8</div>
													</div>
													<button class="btn btn-primary text-center card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event,'<?php echo $offers_product_data['id'] ?>','<?php echo $offers_product_data['sku'] ?>','<?php echo $offers_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')">BUY</button>
												</div>
											</div>
										</a>
									</div>
							<?php
								}
							} ?>
						</div>
					</div>
				</section>
			</div>
		</section>


		<section class="trending-section mb-5">
			<div class="container px-1">
				<h4 class="mb-1 <?= $default_language == 1 ? 'me-3' : 'ms-3' ?>"><?= $this->lang->line('home-most-popular') ?></h4>
				<section id="homeOffers" class="mt-4">
					<div class="container mt-3 px-1" style="padding: 0 !important;" id="section11_banner">

					</div>
				</section>
				<div class="swiper slider-trending_Most" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 18px;">
					<div class="swiper-wrapper" id="Most_products"></div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</section>

		<section class="trending-section mb-5">
			<div class="container px-1">
				<h4 class="mb-1 <?= $default_language == 1 ? 'me-3' : 'ms-3' ?>"><?= $this->lang->line('home-customize-your-clothing') ?></h4>
				<section id="homeOffers" class="mt-4">
					<div class="container mt-3 px-1" style="padding: 0 !important;" id="section12_banner">

					</div>
				</section>
				<div class="swiper slider-trending_Custom" style="--swiper-navigation-color: #fff; --swiper-navigation-size: 18px;">
					<div class="swiper-wrapper" id="Custom_products"></div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</section>


	</main>
	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>

	<!-- Plugin JS -->
	<script src="<?= base_url('assets_web/libs/swiper/swiper-bundle.min.js') ?>"></script>

	<script src="<?php echo base_url(); ?>assets_web/js/app/index.js"></script>

	<script>
		var swiper = new Swiper('.mySwiper', {
			slidesPerView: 2.5,
			freeMode: true,
			grabCursor: true,
			mousewheel: {
				forceToAxis: true,
			},
			forceToAxis: false,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			breakpoints: {
				576: {
					slidesPerView: 3.5
				},
				768: {
					slidesPerView: 4
				},
				1024: {
					slidesPerView: 4
				},
				1200: {
					slidesPerView: 4
				},
			},
		});
	</script>
</body>

</html>