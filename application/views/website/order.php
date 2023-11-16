<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = $this->lang->line('my-orders');
	include("include/headTag.php") ?>
</head>

<body>

	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php")
	?>
	<?php // print_r($order); 
	?>
	<main class="my-order-page">

		<!--Start: My Orders Section -->
		<section style="min-height:700px;">
			<div class="container px-1">
				<div class="row mt-4">
					<?php
					if (!empty($this->session->userdata("user_id"))) {
						include("include/sidebar.php");
					}
					?>
					<div class="<?= !empty($this->session->userdata("user_id")) ? 'col-lg-8': 'col-lg-12' ?> p-1">
						<div class="left-block box-shadow-4 px-1 px-md-4" id="MyProfile">
							<h5 class="title"><?= $title ?>
								<span class="d-lg-none">
									<?php if (!empty($this->session->userdata("user_id"))) { ?>
										<a class="accordion-button collapsed" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1"><?= $this->lang->line('user-my-profile'); ?></a>
									<?php } ?>
								</span>
							</h5>
							<?php
							if (!empty($this->session->userdata("user_id"))) {
								include("include/mobile_sidebar.php");
							}
							?>

							<?php if (!empty($order)) { ?>
								<?php foreach ($order as $order_history) { ?>
									<div class="cart-details row">
										<div class="col-12 p-0">
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-3 p-0 product-thumb">
															<a href="<?php echo base_url; ?>orderDetails/<?php echo $order_history['order_id']; ?>/<?php echo $order_history['prod_id']; ?>">
																<img height="160px" src="<?php echo weburl . 'media/' . $order_history['prod_img']; ?>" class="product-thumb" />
															</a>
														</div>
														<div class="col-9">
															<div class="d-flex flex-column">
																<a class="cart-prod-title text-dark fw-bolder mb-2 fs-5" onclick="redirect_to_link('<?php echo base_url; ?>orderDetails/<?php echo $order_history['order_id']; ?>/<?php echo $order_history['prod_id']; ?>')"><?php echo $order_history['prod_name']; ?></a>
																<div class="row">
																	<div class="col-md-7 col-sm-6 px-0">
																		<div class="wrap-details">
																			<div class="rate">
																				<h5 class="mb-2"><?php echo $order_history['prod_price']; ?></h5>
																			</div>
																			<div class="d-flex qty"><?= $this->lang->line('quantity') ?> : <?php echo $order_history['prod_qty']; ?></div>
																			<div class="order-id"><span><?= $this->lang->line('order-id') ?> : #</span> <?php echo $order_history['order_id']; ?></div>
																		</div>
																	</div>
																	<div class="col-md-5 col-sm-6 px-0">
																		<div class="d-flex order-id"><span><?= $this->lang->line('order-date') ?> : </span> <?php echo date('d-m-Y', strtotime($order_history['create_date']));  ?></div>
																		<div class="order-id text-capitalize"><span><?= $this->lang->line('order-status') ?> : </span> <?php echo $order_history['prod_status']; ?></div>
																		<a href="<?php echo base_url; ?>orderDetails/<?php echo $order_history['order_id']; ?>/<?php echo $order_history['prod_id']; ?>" class="track-order order-id fw-bolder text-uppercase"><?= $this->lang->line('track-order') ?></a>
																		<br>
																		<a onclick="cancel_order('<?php echo $order_history['prod_id']; ?>','<?php echo $order_history['order_id']; ?>')" class="track-order order-id fw-bolder text-uppercase"><?= $this->lang->line('cancel-order') ?></a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<hr>
								<?php } ?>
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

				</div>
			</div>
		</section>
		<!--End: My Orders Section -->

	</main>

	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>
	<script>
		var csrfName = $('.txt_csrfname').attr('name');
		var csrfHash = $('.txt_csrfname').val();
		var site_url = $('.site_url').val();


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

		var filtersContainer = document.querySelector('.right-block');

		// Calculate the initial positions of the filtersContainer
		const calculateFilterContainerPositions = () => {
			var viewportHeight = window.innerHeight;
			var filtersContainerHeight = filtersContainer.offsetHeight;
			var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
			var scrollBottom = document.documentElement.scrollHeight - (scrollTop + viewportHeight);
			var topPosition = '-' + (filtersContainerHeight - viewportHeight) + 'px';

			if (scrollTop > 0 && scrollBottom > 0) {
				filtersContainer.style.cssText = `top: ${topPosition};`;
			} else if (scrollTop === 0) {
				filtersContainer.style.cssText = `bottom: ${topPosition};`;
			}
		};

		// Call the calculation function initially and on window scroll
		window.addEventListener('scroll', calculateFilterContainerPositions);
		window.addEventListener('load', calculateFilterContainerPositions);
		window.addEventListener('resize', calculateFilterContainerPositions);
	</script>
</body>

</html>