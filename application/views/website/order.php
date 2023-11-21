<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = $this->lang->line('my-orders');
	include("include/headTag.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/order.css') ?>">
</head>

<body>
	<?php include("include/navbar-brand.php") ?>
	<main class="my-order-page">

		<!--Start: My Orders Section -->
		<section class="my-5">
			<div class="container px-1">
				<div class="orders-container">
					<?php if (!empty($order)) { ?>
						<div class="order-details">
							<?php foreach ($order as $key => $order_history) { ?>
								<div class="row mb-3">
									<div class="col-2">
										<div class="order-type-rent">
											<div class="text">Rent</div>
										</div>
									</div>
									<div class="col-10">
										<div class="d-flex justify-content-between p-3 pe-5">
											<div class="order-id">Order id #<?= $order_history['order_id']; ?></div>
											<div class="order-date"><?= date('d-m-Y', strtotime($order_history['create_date'])); ?></div>
										</div>
										<hr class="my-0">
									</div>
									<div class="col-3">
										<a href="<?php echo base_url; ?>orderDetails/<?php echo $order_history['order_id']; ?>/<?php echo $order_history['prod_id']; ?>">
											<img src="<?php echo weburl . 'media/' . $order_history['prod_img']; ?>" class="w-100 prod-img ps-3" />
										</a>
									</div>
									<div class="col-9">
										<div class="d-flex justify-content-between">
											<div>
												<div class="prod-name"><?= $order_history['prod_name']; ?></div>
											</div>
										</div>
									</div>
								</div>
								<?= $key !== count($order) - 1 ? '<hr class="my-0">' : '' ?>
							<?php } ?>
						</div>
					<?php } else { ?>
						<div class="cart-details card my-3 py-2">
							<div class="h-50 w-50 mx-auto">
								<img src="<?php base_url ?>assets_web/images/empty-cart.png" alt="">
								<h5 class="text-center"><?= $this->lang->line('filter-page-record'); ?></h5>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<!--End: My Orders Section -->

	</main>

	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>

	<script>
		function cancel_order(pid, order_id) {

			Swal.fire({
				position: "center",
				title: 'Are you Sure to Cancelled Order?',
				showConfirmButton: true,
				showCancelButton: true,
				confirmButtonText: 'Confirm',
				cancelButtonText: 'Cancel',
				confirmButtonColor: '#f42525'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						method: 'post',
						url: site_url + 'cancelOrder',
						data: {
							language: 1,
							pid: pid,
							order_id: order_id,
							[csrfName]: csrfHash
						},
						success: function(response) {

							location.reload();
						}
					});

				}
			})

		}
	</script>
</body>

</html>