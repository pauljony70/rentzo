<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Track Order";
	include("include/headTag.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/order-details.css') ?>">
</head>
<style>

</style>

<body>
	<?php include("include/navbar-brand.php"); ?>

	<main class="order-details-page">
		<input type="hidden" name="seller_id" id="seller_id" value="<?= $order_details['product_details'][0]['vendor_id'] ?>">
		<input type="hidden" name="order_id" id="order_id" value="<?= $order_details['order_summery']['order_id'] ?>">
		<input type="hidden" name="prod_id" id="prod_id" value="<?= $order_details['product_details'][0]['prod_id'] ?>">

		<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#chatOffcanvas" aria-controls="chatOffcanvas">
			Button with data-bs-target
		</button>

		<div id="unseen-message-count"></div>

		<div class="offcanvas offcanvas-end p-4" tabindex="-1" id="chatOffcanvas" aria-labelledby="chatOffcanvasLabel">
			<div class="offcanvas-header">
				<div class="d-flex align-items-center">
					<div class="d-flex align-items-center justify-content-center profile-img">
						<img src="<?= base_url('assets_web/images/icons/user.svg') ?>" alt="Seller name" srcset="">
					</div>
					<div class="seller-name text-light ms-2 line-clamp-1">Seller Name</div>
				</div>
				<a href="#">
					<img src="<?= base_url('assets_web/images/icons/add-call.svg') ?>" alt="Call" srcset="">
				</a>
			</div>
			<div class="offcanvas-body px-0" id="messageContainer"></div>
			<div class="offcanvas-footer px-0 pb-0">
				<form action="#" method="post" id="send-message-form">
					<div class="input-group">
						<img src="<?= base_url('assets_web/images/icons/emoji-pen.svg') ?>" class="ps-2" alt="Pen">
						<input type="text" class="form-control" autocomplete="off" id="message" name="message" value="" placeholder="Enter Message">
						<button type="submit" class="btn pe-2" id="send-message-btn" disabled>
							<img src="<?= base_url('assets_web/images/icons/send-message.svg') ?>" class="pe-0" alt="Send">
						</button>
					</div>
				</form>
			</div>
		</div>
		<!--Start: Track Order Section -->
		<section>
			<div class="container px-1">
				<div class="row mt-4">

					<div class="col-lg-12">
						<div class="left-block box-shadow-4">
							<h5 class="title"><?= $this->lang->line('track-order') ?></h5>
							<div class="row">
								<div class="col-md-6">
									<div class="cart-details row">
										<div class="col-12 p-0">
											<div class="card">
												<div class="cart-body">
													<div class="row">
														<div class="col-3 p-0 product-thumb">
															<img onclick="redirect_to_link('<?= base_url . $order_details['product_details'][0]['prod_sku'] . '?pid=' . $order_details['product_details'][0]['prod_id'] . '&sku=' . $order_details['product_details'][0]['prod_sku'] . '&sid=' . $order_details['product_details'][0]['vendor_id']; ?>')" src="<?= weburl . 'media/' . $order_details['product_details'][0]['prod_img']; ?>" class="product-thumb" />
														</div>
														<div class="col-9">
															<div class="d-flex flex-column">
																<h6 onclick="redirect_to_link('<?= base_url . $order_details['product_details'][0]['prod_sku'] . '?pid=' . $order_details['product_details'][0]['prod_id'] . '&sku=' . $order_details['product_details'][0]['prod_sku'] . '&sid=' . $order_details['product_details'][0]['vendor_id']; ?>')"><?= $order_details['product_details'][0]['prod_name']; ?></h6>
																<?php if (!empty($order_details['order_summery']['prod_attr'])) : ?>
																	<p class="text-muted mb-1">
																		<?php foreach ($order_details['order_summery']['prod_attr'] as $conf_data) {
																			echo '<span class="me-1"><b>' . $conf_data->attr_name . ':</b></span><span class="ms-1" style="font-size:14px;">' . $conf_data->item . '</span>&nbsp;,&nbsp;';
																		} ?>
																	</p>
																<?php endif; ?>
																<div class="wrap-details">
																	<div class="rate mb-1">
																		<h5><?= $order_details['product_details'][0]['prod_price']; ?></h5>
																		<div class="old-price"><?= $order_details['product_details'][0]['prod_mrp']; ?></div>
																		<!--<div class="off-price">60% off</div>-->
																	</div>
																	<div class="qty"><?= $this->lang->line('quantity') ?> : <?= $order_details['product_details'][0]['qty']; ?></div>
																	<div class="order-id"><span><?= $this->lang->line('order-id') ?> : </span> <?= $order_details['order_summery']['order_id']; ?></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="order-progress mt-0">
										<ul class="step-progress">
											<li class="step-progress-item is-done">
												<h6>Order Confirmed</h6>
												<p><?= date('d-M-Y h:i:sa', strtotime($order_details['order_summery']['create_date'])); ?></p>
											</li>
											<li class="step-progress-item">
												<h6><?= $order_details['product_details'][0]['status']; ?></h6>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<h6><?= $this->lang->line('delivery-add') ?></h6>
									<div class="address-details box-shadow-4">
										<span class="badge"><?= $order_details['shipping_address']['addresstype']; ?></span>
										<ul class="name my-2">
											<li class="px-0">
												<h6 class="m-0"><?= $order_details['shipping_address']['fullname']; ?></h6>
											</li>
										</ul>
										<div class="address">
											<h6>
												<?= $order_details['shipping_address']['mobile']; ?><br>
												<?= $order_details['shipping_address']['email']; ?><br>
												<?= $order_details['shipping_address']['fulladdress']; ?><br>
												<?= $order_details['shipping_address']['area'] . ', ' . $order_details['shipping_address']['governorate'] . ', ' . $order_details['shipping_address']['region'] . ', ' . $order_details['shipping_address']['country']; ?>
											</h6>
										</div>
									</div>

									<?php if ($order_details['product_details'][0]['tracking_id'] != '') { ?>
										<div class="col-md-12"><br>
											<strong>Tracking Url: </strong><br>
											<a style="color:green;" target="_blank" href="<?= 'https://ship.nimbuspost.com/shipping/tracking/' . $order_details['product_details'][0]['tracking_id']; ?>"><span><?= 'https://ship.nimbuspost.com/shipping/tracking/' . $order_details['product_details'][0]['tracking_id']; ?></span></a>
										</div>
									<?php } ?>

									<?php if ($order_details['product_details'][0]['status'] == 'Delivered') { ?>
										<a class="btn btn-success mt-5 text-light pt-2" onclick="return_order('<?= $order_details['product_details'][0]['prod_id']; ?>','<?= $order_details['order_summery']['order_id']; ?>')">Return Order</a>
									<?php } else if ($order_details['product_details'][0]['status'] != 'Cancelled') { ?>
										<a class="btn btn-success mt-5 text-light pt-2" onclick="cancel_order('<?= $order_details['product_details'][0]['prod_id']; ?>','<?= $order_details['order_summery']['order_id']; ?>')"><?= $this->lang->line('cancel-order') ?></a>
									<?php } ?>
								</div>

								<div class="col-md-6">
									<h6><?= $this->lang->line('order-summary') ?></h6>
									<div class="address-details box-shadow-4">
										<ul class="px-0">
											<label for="" class="text-dark fw-bolder"><?= $this->lang->line('ordered-products') ?></label>
											<?php foreach ($order_details['order_summery']['ordered_products'] as $ordered_product) : ?>
												<li>
													<a class="dropdown-item" href="<?= base_url('orderDetails/' . $order_details['order_summery']['order_id'] . '/' . $ordered_product['prod_id']) ?>">
														<div class="card search-card">
															<div class="d-flex ">
																<div class="d-flex-center search-card_image" style="background-image: url(<?= base_url('media/' . $ordered_product['prod_img']) ?>); width: 60px; height: 60px;margin: 10px 0px; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 0.5rem; overflow: hidden;"></div>
																<div class="w-100">
																	<div class="card-body py-2 h-100 d-flex flex-column justify-content-evenly">
																		<div class="w-100 d-flex justify-content-between">
																			<h6 class="card-title mt-0" style="white-space: normal;"><?= $ordered_product['prod_name'] ?></h6>
																		</div>
																		<div class="d-flex">
																			<p class="card-text m-0"><small class="text-dark"><?= price_format($ordered_product['prod_price']) ?></small></p>
																			<p class="card-text mb-0 ms-3"><small class="text-muted text-decoration-line-through"><?= price_format($ordered_product['prod_price'] + $ordered_product['discount']) ?></small></p>
																		</div>
																		<p class="card-text m-0"><small class="text-muted">Qty: <?= $ordered_product['qty'] ?></small></p>
																	</div>
																</div>
															</div>
														</div>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
										<div class="price-details">
											<div class="price my-2 pt-0 d-flex justify-content-between">
												<div>
													<h6>Cart Value (<?= $order_details['order_summery']['total_qty']; ?> items)</h6>
												</div>
												<div>
													<h6><?= $order_details['order_summery']['total_mrp']; ?></h6>
												</div>
											</div>
											<div class="discount my-2 d-flex justify-content-between">
												<div>
													<h6>Discount</h6>
												</div>
												<div>
													<h6>-<?= $order_details['order_summery']['discount']; ?></h6>
												</div>
											</div>
											<?php if ($order_details['order_summery']['coupon_value'] != 0) { ?>
												<div class="discount d-flex justify-content-between">
													<div>
														<h6>Coupon Discount</h6>
													</div>
													<div>
														<h6>-<?= $order_details['order_summery']['coupon_value']; ?></h6>
													</div>
												</div>
											<?php } ?>
										</div>
										<hr>
										<div class="total d-flex justify-content-between">
											<div>
												<h5>Total Amount</h5>
											</div>
											<div>
												<h5><?= ($order_details['order_summery']['total_price']); ?></h5>
											</div>
										</div>
										<hr>
									</div>

								</div>
							</div>

						</div>
					</div>



				</div>
			</div>
		</section>
		<!--End: Track Order Section -->

	</main>

	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>
	<script src="<?= base_url('assets_web/js/app/order-details.js') ?>"></script>

	<script>
		var csrfName = $('.txt_csrfname').attr('name');
		var csrfHash = $('.txt_csrfname').val();
		var site_url = $('.site_url').val();


		function cancel_order(pid, order_id) {

			Swal.fire({
				position: "center",
				title: 'Are you sure you want to cancel this order?',
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

		function return_order(pid, order_id) {

			Swal.fire({
				position: "center",
				title: 'Are you Sure to Return Order?',
				showConfirmButton: true,
				showCancelButton: true,
				confirmButtonText: 'Confirm',
				cancelButtonText: 'Cancel',
				confirmButtonColor: '#f42525'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						method: 'post',
						url: site_url + 'returnOrder',
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