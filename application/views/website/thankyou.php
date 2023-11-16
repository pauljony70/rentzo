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
		<br><br>
		<section>
			<div class="container">
				<div class="block d-md-none">
					<img src="<?php echo base_url; ?>assets_web/images/icons/thanks-icon.png" alt="" class="thanks-img" />
					<h5>Your Order has been placed Successfully.</h5>
				</div>
				<div class="wrap box-shadow text-center">
					<div class="block d-none d-md-block">
						<img src="<?php echo base_url; ?>assets_web/images/icons/thanks-icon.png" alt="" class="thanks-img" />
						<h5>Your Order has been placed Successfully.</h5>
					</div>
					<h6>Thank you for Purchasing.</h6>
					<h6>Your Order is confirmed.</h6>
					<h4>YOUR ORDER ID IS <?php echo $order_id; ?></h4>
					<p>You will get update about your order, on your registered email and phone number.</p>
					<br>
				<!--	<a style="width:200px;float:none" href="<?php echo base_url; ?>" class="btn btn-info d-none d-md-block text-center">CONTINUE SHOPPING</a>-->
				</div>
				<!--<div class="btn-wrap text-center"><a href="<?php echo base_url; ?>" class="btn btn-info d-md-none">CONTINUE SHOPPING</a></div>-->
			</div>
		</section>
		<!--End: Thanks Section -->
		<br><br>
		
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