<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Home";
	include("include/headTag.php") ?>

</head>

<body>
	<?php
	include("include/loader.php")
	?>

	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php")
	?>
	<?php
	include("include/navForMobile.php")
	?>

	<main> 
		<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
		<input type="hidden" id="qoute_id" value="<?php echo $this->session->userdata('qoute_id'); ?>">
		<section id="homeTopCategoryMobile" class="d-md-none mt-2">
			<div class="container-fluid homeTopCategoryMobileContainer">
				<?php
				foreach ($home_section5 as $home_section5_data) {

					$img_decode1 = json_decode($home_section5_data->image);
					$img_url = MEDIA_URL . $img_decode1->{'470-720'};
				?>
					<div onclick="redirect_to_link('<?php echo base_url . $home_section5_data->cat_slug; ?>')" class="a-homeTopCategoryMobileCard me-2">
						<div class="card">
							<img src="<?php echo $img_url; ?>" alt="">
							<div class="card-body p-0">
								<p class="mb-0 mt-2 fs-small fw-semibold"><?php echo $home_section5_data->cat_name; ?></p>
							</div>
						</div>
					</div>

				<?php } ?>
				<!--<div class="a-homeTopCategoryMobileCard me-4">
                    <div class="card">
                        <img src="assets/images/placeholders/top-cats-2.jpg" alt="">
                        <p class="mb-0 mt-2 fs-small fw-semibold">Top selling</p>
                    </div>
                </div>-->

			</div>
		</section>

		<section id="heroHomeSlider" class="mt-2 mt-md-0">
			<?php foreach ($header_banner as $section1) { ?>
				<a href="<?php echo $section1->link; ?>">
					<div class="a-slider-hero" style="">
						<img src="<?php echo $section1->image; ?>" class="img-fluid" alt="" srcset="" style="object-fit: fill; width: 100%;">
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
				<div class="container-fluid">

					<div onclick="redirect_to_link('<?php echo $section6_link1; ?>')" class="a-homeOffers" style="">
						<img src="<?php echo $section6_image1; ?>" alt="" srcset="">
					</div>
				</div>
			</section>


		<?php } ?>

		<section id="homeTopCategory" class="d-none d-md-block mt-3">
			<div class="container-fluid">
				<div class="col-12">
					<h4>Shop Our Top Categories</h4>
				</div>

				<div class="row">
					<?php
					foreach ($home_section5 as $home_section5_data) {

						$img_decode1 = json_decode($home_section5_data->image);
						$img_url = MEDIA_URL . $img_decode1->{'470-720'};
					?>
						<div class="col-md-6 col-lg-3 mb-6">
							<a href="<?php echo base_url . $home_section5_data->cat_slug; ?>">
								<div class="card position-relative">
									<img src="<?php echo $img_url; ?>" alt="" class="img-fluid">
									<div class="card-overlay position-absolute top-0 start-0 p-4 p-4 py-lg-5 px-lg-5">
										<h5 class="fw-bold text-white"><?php echo $home_section5_data->cat_name; ?></h5>
										<p class="fw-bold text-primary mb-0"><?php echo $home_section5_data->sub_title; ?></p>
									</div>
								</div>
							</a>
						</div>
					<?php } ?>

				</div>
			</div>
		</section>

		<section class="trending-section mb-5">
			<div class="container-fluid">
				<h4>Today Deal</h4>
				<div class="slider slider-trending_New" id="New_products">
					<?php /* foreach ($new_product as $new_product_data) { ?>
						<div class="card">
							<div onclick="redirect_to_link('<?php echo base_url . $new_product_data['sku'] . '?pid=' . $new_product_data['id'] . '&sku=' . $new_product_data['sku'] . '&sid=' . $new_product_data['vendor_id']; ?>')" class="card-img zoom-img">
								<img src="<?php echo $new_product_data['imgurl']; ?>" class="card-img-top" alt="..." />
							</div>

							<div class="favorite"><a onclick="add_to_wishlist(event,'<?php echo $new_product_data['id'] ?>','<?php echo $new_product_data['sku'] ?>','<?php echo $new_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2)" href="javascript:void(0);"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke="" />
									</svg></a></div>
							<div class="card-body">
								<h6 class="pd-title" onclick="redirect_to_link('<?php echo base_url . $new_product_data['sku'] . '?pid=' . $new_product_data['id'] . '&sku=' . $new_product_data['sku'] . '&sid=' . $new_product_data['vendor_id']; ?>')"><?php echo $new_product_data['name']; ?></h6>
								<h6 class="price-off text-danger"><?php if ($new_product_data['totaloff'] != 0) {
																		echo $new_product_data['offpercent'];
																	} ?></h6>

								<div class="row">
									<div class="col-6">
										<?php if ($new_product_data['price'] != $new_product_data['mrp']) { ?> <h6 class="old-price"><?php echo $new_product_data['mrp']; ?></h6><?php } ?>
										<h5 class="new-price"><?php echo $new_product_data['price']; ?></h5>
									</div>
									<div class="col-6">
										<div class="btn-by-now text-end">
											<a href="#" onclick="add_to_cart_product_buy(event,'<?php echo $new_product_data['id'] ?>','<?php echo $new_product_data['sku'] ?>','<?php echo $new_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-default ">Buy Now</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php }  */?>
				</div>
			</div>
		</section>

		<?php

		$section4_image1 = $section4_link1 = '';


		foreach ($home_section4 as $section4) {


			$section4_image1 = $section4->image;

			$section4_link1 = $section4->link;
		}
		if ($section4_link1 != '') {
		?>

			<section id="homeOffers" class="mt-6">
				<div class="container-fluid">
					<!--<div class="row">
                    <div class="col-12">
                        <h4>Top Selling</h4>
                    </div>
                </div>-->
					<div onclick="redirect_to_link('<?php echo $section4_link1; ?>')" class="a-homeOffers" style="">
						<img src="<?php echo $section4_image1; ?>" class="img-fluid" alt="" srcset="" style="height: 265px; object-fit: fill; width: 100%; border-radius: 8px;">
					</div>
				</div>
			</section>
		<?php } ?>


		<section class="trending-section mb-5">
			<div class="container-fluid">
				<h4>Top Selling</h4>
				<div class="slider slider-trending_Popular" id="Popular_products">
					<?php /* foreach ($popular_product as $popular_product_data) { ?>
						<div class="card">
							<div onclick="redirect_to_link('<?php echo base_url . $popular_product_data['sku'] . '?pid=' . $popular_product_data['id'] . '&sku=' . $popular_product_data['sku'] . '&sid=' . $popular_product_data['vendor_id']; ?>')" class="card-img zoom-img">
								<img src="<?php echo $popular_product_data['imgurl']; ?>" class="card-img-top" alt="..." />

							</div>
							<div class="favorite"><a onclick="add_to_wishlist(event,'<?php echo $popular_product_data['id'] ?>','<?php echo $popular_product_data['sku'] ?>','<?php echo $popular_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2)" href="javascript:void(0);"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke="" />
									</svg></a></div>
							<div class="card-body">
								<h6 class="pd-title" onclick="redirect_to_link('<?php echo base_url . $popular_product_data['sku'] . '?pid=' . $popular_product_data['id'] . '&sku=' . $popular_product_data['sku'] . '&sid=' . $popular_product_data['vendor_id']; ?>')"><?php echo $popular_product_data['name']; ?></h6>
								<h6 class="price-off text-danger"><?php if ($popular_product_data['totaloff'] != 0) {
																		echo $popular_product_data['offpercent'];
																	} ?></h6>

								<div class="row">
									<div class="col-6">
										<?php if ($popular_product_data['price'] != $popular_product_data['mrp']) { ?> <h6 class="old-price"><?php echo $popular_product_data['mrp']; ?></h6><?php } ?>
										<h5 class="new-price"><?php echo $popular_product_data['price']; ?></h5>
									</div>
									<div class="col-6">
										<div class="btn-by-now text-end">
											<a href="#" onclick="add_to_cart_product_buy(event,'<?php echo $popular_product_data['id'] ?>','<?php echo $popular_product_data['sku'] ?>','<?php echo $popular_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-default">Buy Now</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } */ ?>
				</div>
			</div>
		</section>

		<?php

		$section4_image1 = $section4_link1 = '';


		foreach ($home_section4 as $section4) {


			$section4_image1 = $section4->image;

			$section4_link1 = $section4->link;
		}
		if ($section4_link1 != '') {
		?>

			<section id="homeOffers" class="mt-6">
				<div class="container-fluid">
					<!--<div class="row">
                    <div class="col-12">
                        <h4>Top Selling</h4>
                    </div>
                </div>-->
					<div onclick="redirect_to_link('<?php echo $section4_link1; ?>')" class="a-homeOffers" style="">
						<img src="<?php echo $section4_image1; ?>" class="img-fluid" alt="" srcset="" style="height: 265px; object-fit: fill; width: 100%; border-radius: 8px;">
					</div>
				</div>
			</section>
		<?php } ?>

		<section class="trending-section mb-5">
			<div class="container-fluid">
				<h4>Trending Products </h4>
				<div class="slider slider-trending_Recommended" id="Recommended_products">
					<?php /* foreach ($recommended_product as $recommended_product_data) { ?>
						<div class="card">
							<div onclick="redirect_to_link('<?php echo base_url . $recommended_product_data['sku'] . '?pid=' . $recommended_product_data['id'] . '&sku=' . $recommended_product_data['sku'] . '&sid=' . $recommended_product_data['vendor_id']; ?>')" class="card-img zoom-img">
								<img src="<?php echo $recommended_product_data['imgurl']; ?>" class="card-img-top" alt="..." />

							</div>
							<div class="favorite"><a onclick="add_to_wishlist(event,'<?php echo $recommended_product_data['id'] ?>','<?php echo $recommended_product_data['sku'] ?>','<?php echo $recommended_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2)" href="javascript:void(0);"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke="" />
									</svg></a></div>
							<div class="card-body">
								<h6 class="pd-title" onclick="redirect_to_link('<?php echo base_url . $recommended_product_data['sku'] . '?pid=' . $recommended_product_data['id'] . '&sku=' . $recommended_product_data['sku'] . '&sid=' . $recommended_product_data['vendor_id']; ?>')"><?php echo $recommended_product_data['name']; ?></h6>
								<h6 class="price-off text-danger"><?php if ($recommended_product_data['totaloff'] != 0) {
																		echo $recommended_product_data['offpercent'];
																	} ?></h6>

								<div class="row">
									<div class="col-6">
										<?php if ($recommended_product_data['price'] != $recommended_product_data['mrp']) { ?> <h6 class="old-price"><?php echo $recommended_product_data['mrp']; ?></h6><?php } ?>
										<h5 class="new-price"><?php echo $recommended_product_data['price']; ?></h5>
									</div>
									<div class="col-6">
										<div class="btn-by-now text-end">
											<a href="#" onclick="add_to_cart_product_buy(event,'<?php echo $recommended_product_data['id'] ?>','<?php echo $recommended_product_data['sku'] ?>','<?php echo $recommended_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-default">Buy Now</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } */ ?>
				</div>
			</div>
		</section>

		<section id="homeMasonry" class="mt-6">
			<div class="container-fluid">
				<div class="a-Masonry" id="home_bottom_banner">

			
					<?php /*<div onclick="redirect_to_link('<?php echo $home_bottom_banner[0]->link; ?>')" class="a-Masonry-1" style="background-image: url(<?php echo $home_bottom_banner[0]->image; ?>);"></div>
					<div onclick="redirect_to_link('<?php echo $home_bottom_banner[1]->link; ?>')" class="a-Masonry-2" style="background-image: url(<?php echo $home_bottom_banner[1]->image; ?>);"></div>
					<div onclick="redirect_to_link('<?php echo $home_bottom_banner[2]->link; ?>')" class="a-Masonry-3" style="background-image: url(<?php echo $home_bottom_banner[2]->image; ?>);"></div> */ ?>
				</div>
			</div>
		</section>



		<section class="trending-section may_like mb-5">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<h4>You May Like</h4>
					</div>
				</div>
				<div class="slider slider-trending_Offers" id="Offers_products">
					<?php /* foreach ($offers_product as $offers_product_data) { ?>
						<div class="card">
							<div onclick="redirect_to_link('<?php echo base_url . $offers_product_data['sku'] . '?pid=' . $offers_product_data['id'] . '&sku=' . $offers_product_data['sku'] . '&sid=' . $offers_product_data['vendor_id']; ?>')" class="card-img zoom-img">
								<img src="<?php echo $offers_product_data['imgurl']; ?>" class="card-img-top" alt="..." />

							</div>
							<div class="favorite"><a onclick="add_to_wishlist(event,'<?php echo $offers_product_data['id'] ?>','<?php echo $offers_product_data['sku'] ?>','<?php echo $offers_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2)" href="javascript:void(0);"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke="" />
									</svg></a></div>
							<div class="card-body">
								<h6 class="pd-title" onclick="redirect_to_link('<?php echo base_url . $offers_product_data['sku'] . '?pid=' . $offers_product_data['id'] . '&sku=' . $offers_product_data['sku'] . '&sid=' . $offers_product_data['vendor_id']; ?>')"><?php echo $offers_product_data['name']; ?></h6>
								<h6 class="price-off text-danger"><?php if ($offers_product_data['totaloff'] != 0) {
																		echo $offers_product_data['offpercent'];
																	} ?></h6>

								<div class="row">
									<div class="col-6">
										<?php if ($offers_product_data['price'] != $offers_product_data['mrp']) { ?> <h6 class="old-price"><?php echo $offers_product_data['mrp']; ?></h6><?php } ?>
										<h5 class="new-price"><?php echo $offers_product_data['price']; ?></h5>
									</div>
									<div class="col-6">
										<div class="btn-by-now text-end">
											<a href="#" onclick="add_to_cart_product_buy(event,'<?php echo $offers_product_data['id'] ?>','<?php echo $offers_product_data['sku'] ?>','<?php echo $offers_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-default">Buy Now</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } */ ?>
				</div>
			</div>
		</section>

<?php

		$section4_image1 = $section4_link1 = '';


		foreach ($home_section4 as $section4) {


			$section4_image1 = $section4->image;

			$section4_link1 = $section4->link;
		}
		if ($section4_link1 != '') {
		?>

			<section id="homeOffers" class="mt-6">
				<div class="container-fluid">
					<!--<div class="row">
                    <div class="col-12">
                        <h4>Top Selling</h4>
                    </div>
                </div>-->
					<div onclick="redirect_to_link('<?php echo $section4_link1; ?>')" class="a-homeOffers" style="">
						<img src="<?php echo $section4_image1; ?>" class="img-fluid" alt="" srcset="" style="height: 265px; object-fit: fill; width: 100%; border-radius: 8px;">
					</div>
				</div>
			</section>
		<?php } ?>


		<section class="trending-section may_like_mob mb-5">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<h4>You May Like</h4>
					</div>
				</div>
				<div class="slider may_you_like_mob">
					<?php $count = 0;
					foreach ($offers_product as $offers_product_data) {
						if ($count < 4) {
					?>
							<div class="card">
								<div onclick="redirect_to_link('<?php echo base_url . $offers_product_data['sku'] . '?pid=' . $offers_product_data['id'] . '&sku=' . $offers_product_data['sku'] . '&sid=' . $offers_product_data['vendor_id']; ?>')" class="card-img zoom-img">
									<img src="<?php echo $offers_product_data['imgurl']; ?>" class="card-img-top" alt="..." />

								</div>
								<div class="favorite"><a onclick="add_to_wishlist(event,'<?php echo $offers_product_data['id'] ?>','<?php echo $offers_product_data['sku'] ?>','<?php echo $offers_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2)" href="javascript:void(0);"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke="" />
										</svg></a></div>
								<div class="card-body">
									<h6 class="pd-title" onclick="redirect_to_link('<?php echo base_url . $offers_product_data['sku'] . '?pid=' . $offers_product_data['id'] . '&sku=' . $offers_product_data['sku'] . '&sid=' . $offers_product_data['vendor_id']; ?>')"><?php echo $offers_product_data['name']; ?></h6>
									<h6 class="price-off text-danger"><?php if ($offers_product_data['totaloff'] != 0) {
																			echo $offers_product_data['offpercent'];
																		} ?></h6>

									<div class="row">
										<div class="col-6">
											<?php if ($offers_product_data['price'] != $offers_product_data['mrp']) { ?> <h6 class="old-price"><?php echo $offers_product_data['mrp']; ?></h6><?php } ?>
											<h5 class="new-price"><?php echo $offers_product_data['price']; ?></h5>
										</div>
										<div class="col-6">
											<div class="btn-by-now text-end">
												<a href="#" onclick="add_to_cart_product_buy(event,'<?php echo $offers_product_data['id'] ?>','<?php echo $offers_product_data['sku'] ?>','<?php echo $offers_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-default">Buy Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php $count++;
						}
					} ?>
				</div>
			</div>
		</section>


		<section class="trending-section mb-5">
			<div class="container-fluid">
				<h4>Most Populor</h4>
				<div class="slider slider-trending_Most" id="Most_products">
					<?php /* foreach ($most_product as $most_product_data) {?>
						<div class="card">
							<div onclick="redirect_to_link('<?php echo base_url . $most_product_data['sku'] . '?pid=' . $most_product_data['id'] . '&sku=' . $most_product_data['sku'] . '&sid=' . $most_product_data['vendor_id']; ?>')" class="card-img zoom-img">
								<img src="<?php echo $most_product_data['imgurl']; ?>" class="card-img-top" alt="..." />

							</div>
							<div class="favorite"><a onclick="add_to_wishlist(event,'<?php echo $most_product_data['id'] ?>','<?php echo $most_product_data['sku'] ?>','<?php echo $most_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2)" href="javascript:void(0);"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke="" />
									</svg></a></div>
							<div class="card-body">
								<h6 class="pd-title" onclick="redirect_to_link('<?php echo base_url . $most_product_data['sku'] . '?pid=' . $most_product_data['id'] . '&sku=' . $most_product_data['sku'] . '&sid=' . $most_product_data['vendor_id']; ?>')"><?php echo $most_product_data['name']; ?></h6>
								<h6 class="price-off text-danger"><?php if ($most_product_data['totaloff'] != 0) {
																		echo $most_product_data['offpercent'];
																	} ?></h6>

								<div class="row">
									<div class="col-6">
										<?php if ($most_product_data['price'] != $most_product_data['mrp']) { ?> <h6 class="old-price"><?php echo $most_product_data['mrp']; ?></h6><?php } ?>
										<h5 class="new-price"><?php echo $most_product_data['price']; ?></h5>
									</div>
									<div class="col-6">
										<div class="btn-by-now text-end">
											<a href="#" onclick="add_to_cart_product_buy(event,'<?php echo $most_product_data['id'] ?>','<?php echo $most_product_data['sku'] ?>','<?php echo $most_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-default">Buy Now</a> 
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } */ ?>
				</div>
			</div>
		</section>


	</main>
	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>
	<script src="<?php echo base_url(); ?>assets_web/js/index.js"></script>
	
	<script type="text/javascript">
		$('.may_you_like').slick({
			slidesToShow: 17,
			slidesToScroll: 1,
			arrows: true,
			infinite: false,
			autoplay: false,
			responsive: [{
					breakpoint: 4499,
					settings: {
						slidesToShow: 12,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 2999,
					settings: {
						slidesToShow: 10,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 2499,
					settings: {
						slidesToShow: 8,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 2299,
					settings: {
						slidesToShow: 7,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 1999,
					settings: {
						slidesToShow: 6,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 1799,
					settings: {
						slidesToShow: 5,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 1499,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 1199,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 575,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			]
		});
	</script>

</body>

</html>