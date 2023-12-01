<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Thanks You";
	include("include/headTag.php") ?>
	<style>
		.thank-you-heading {
			color: #000;
			font-size: 26px;
			font-style: normal;
			font-weight: 600;
			line-height: 152.2%;
		}

		.thank-you-des {
			color: #000;
			font-size: 16px;
			font-style: normal;
			font-weight: 400;
			line-height: 24px;
			margin-bottom: 76px;
		}

		.shop-more-btn {
			padding: 16px 48px;
			border-radius: 40px;
			color: #FFF;
			font-size: 18px;
			font-style: normal;
			font-weight: 500;
			line-height: normal;
		}
	</style>
</head>

<body>
	<?php include("include/navbar-brand.php") ?>

	<main class="thanks-page">
		<input type="hidden" value="<?= $order_id; ?>" id="order_id">
		<section class="my-5">
			<div class="container text-center pb-5">
				<img src="<?= base_url('assets_web/images/icons/check-circle.svg') ?>" alt="Thank you" srcset="" class="mb-4">
				<div class="thank-you-heading">Thank you</div>
				<div class="thank-you-heading mb-2">Your Order has been received</div>
				<div class="thank-you-des">Your Order id <?= $order_id; ?></div>
				<a href="<?= base_url() ?>" class="btn btn-primary shop-more-btn">Shop more</a>
			</div>
		</section>
		<!--End: Thanks Section -->
	</main>

	<?php include("include/footer.php") ?>

	<?php include("include/script.php") ?>

	<script type="text/javascript">
		/* $(document).ready(function() {
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
		}); */
	</script>

</body>

</html>