<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Thanks You";
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
	// include("include/navForMobile.php")
	?>

	<main class="thanks-page">
		<input type="hidden" value="<?php echo $order_id; ?>" id="order_id">
		<!--Start: Thanks Section -->
		<section>
			<div class="container">
				<div class="block d-md-none">
					<img src="<?php echo base_url; ?>assets_web/images/icons/thanks-icon.png" alt="" class="thanks-img" />
					<h5>Your Order has been placed Successfully.</h5>
				</div>
				<div class="wrap box-shadow">
					<div class="block d-none d-md-block">
						<img src="<?php echo base_url; ?>assets_web/images/icons/thanks-icon.png" alt="" class="thanks-img" />
						<h5>Your Order has been placed Successfully.</h5>
					</div>
					<h6>Thank you for Purchasing.</h6>
					<h6>Your Order is confirmed.</h6>
					<h4>YOUR ORDER ID IS <?php echo $order_id; ?></h4>
					<p>You will get update about your order, on your registered email and phone number.</p>
					<a href="<?php echo base_url; ?>" class="btn btn-default d-none d-md-block">CONTINUE SHOPPING</a>
				</div>
				<div class="btn-wrap"><a href="<?php echo base_url; ?>" class="btn btn-default d-md-none">CONTINUE SHOPPING</a></div>
			</div>
		</section>
		<!--End: Thanks Section -->

		<!--Trending Section -->
		<section class="trending-section">
			<div class="container px-1">
				<h4>Featured Items</h4>
				<div class="swiper mySwiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #ff6600; --swiper-navigation-size: 18px; --swiper-scrollbar-sides-offset: 50%">
					<div class="swiper-wrapper align-items-center">
						<!--Block-->
						<?php foreach ($recommended_product as $recommended_product_data) { ?>
							<div class="swiper-slide product-card-swiper px-2 py-1">
								<a href="<?php echo base_url . $recommended_product_data['web_url'] . '?pid=' . $recommended_product_data['id'] . '&sku=' . $recommended_product_data['sku'] . '&sid=' . $recommended_product_data['vendor_id']; ?>" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
									<?php if ($recommended_product_data['price'] !== $recommended_product_data['mrp']) : ?>
										<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
											<span class="discount text-uppercase">
												<div><?= $recommended_product_data['offpercent'] ?></div>
											</span>
											<span class="wishlist"><i class="fa fa-heart-o"></i></span>
										</div>
									<?php endif; ?>
									<div class="image-container zoom-img">
										<img src="<?= $recommended_product_data['imgurl'] ?>" class="zoom-img thumbnail-image">
									</div>
									<div class="product-detail-container p-2 mb-1">
										<div class="justify-content-between align-items-center" style="padding:5px;">
											<p class="dress-name mb-0"><?= $recommended_product_data['name'] ?></p>
											<div class="d-flex align-items-center justify-content-start flex-row mt-2" style="width: 100%;">
												<span class="new-price"><?= $recommended_product_data['price'] ?></span>
												<small class="old-price text-right mx-1"><?= $recommended_product_data['price'] === $recommended_product_data['mrp'] ? '' : $recommended_product_data['mrp'] ?></small>
											</div>
										</div>
										<div class="d-flex justify-content-between align-items-center mt-1" style="padding: 0 5px;">
											<div class="d-flex align-items-center">
												<?php if ($recommended_product_data['rating']['total_rows'] > 0) : ?>
													<i class="fa-solid fa-star"></i>
													<div class="rating-number"><?= $recommended_product_data['rating']['total_rating'] / $recommended_product_data['rating']['total_rows'] ?></div>
												<?php endif; ?>
											</div>
											<button class="btn btn-primary text-center text-uppercase card_buy_btn px-4 py-1 pt-2" onclick="add_to_cart_product_buy(event, '<?= $recommended_product_data['id'] ?>', '<?= $recommended_product_data['sku'] ?>', '<?= $recommended_product_data['vendor_id'] ?>', '<?= $this->session->userdata('user_id') ?>', '1', '0', '2', '<?= $recommended_product_data['qoute_id'] ?>')"><?= $this->lang->line('buy') ?></button>
										</div>
									</div>
								</a>
							</div>
						<?php } ?>
						<!--/*Block-->
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</section>
		<!--/*Trending Section -->

	</main>

	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>

	<script type="text/javascript">
		var swiper = new Swiper('.mySwiper', {
			slidesPerView: 2,
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
					slidesPerView: 3
				},
				768: {
					slidesPerView: 4
				},
				1024: {
					slidesPerView: 5
				},
				1200: {
					slidesPerView: 6
				},
			}
		});

		$(document).ready(function() {
			var order_id = $('#order_id').val();
			$.ajax({
				method: 'get',
				url: site_url + "send-order-notification",
				data: {
					language: default_language,
					order_id: order_id,
					[csrfName]: csrfHash
				},
				success: function(response) {

				}
			});
		});
	</script>

</body>

</html>