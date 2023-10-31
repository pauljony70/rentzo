<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Track Order";
	include("include/headTag.php") ?>
</head>

<body>

	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php");
	?>

	<main class="track-order-page my-order-page">

		<!--Start: Track Order Section -->
		<section>
			<div class="container px-1">
				<div class="row mt-4">

					<div class="col-lg-9">
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

					<div class="col-lg-3 mt-4 mt-lg-0">
						<div class="right-block p-0">
							<h5 class="mb-4"><?= $this->lang->line('home-you-may-like') ?></h5>
							<div class="row mt-0">
								<?php foreach ($offers_product as $offers_product_data) { ?>
									<div class="col-6 col-sm-4 col-md-3 col-lg-12 card p-1">
										<a href="<?= base_url . $offers_product_data['sku'] . '?pid=' . $offers_product_data['id'] . '&sku=' . $offers_product_data['sku'] . '&sid=' . $offers_product_data['vendor_id']; ?>" class="card h-100 d-flex flex-column justify-content-between product-link-card">
											<?php if ($offers_product_data['price'] !== $offers_product_data['mrp']) : ?>
												<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
													<span class="discount" style="direction: ltr;"><?= $offers_product_data['offpercent'] ?></span>
													<span class="wishlist"><i class="fa fa-heart-o"></i></span>
												</div>
											<?php endif; ?>
											<div class="image-container zoom-img">
												<img src="<?= $offers_product_data['imgurl']; ?>" class="zoom-img thumbnail-image">
											</div>
											<div class="product-detail-container p-2 mb-1">
												<div class="justify-content-between align-items-center" style="padding:5px;">
													<p class="dress-name mb-0"><?= $offers_product_data['name']; ?></p>
													<div class="d-flex align-items-center justify-content-start flex-row mt-2" style="width: 100%;">
														<span class="new-price"><?= $offers_product_data['price']; ?></span>
														<small class="old-price text-right mx-1"><?= $offers_product_data['price'] !== $offers_product_data['mrp'] ? $offers_product_data['mrp'] : '' ?></small>
													</div>
												</div>
												<div class="d-flex justify-content-between align-items-center mt-1" style="padding: 0 5px;">
													<div class="d-flex align-items-center">
														<?php if ($offers_product_data['rating']['total_rows'] > 0) : ?>
															<i class="fa-solid fa-star fa-lg" style="color: #FFD700;"></i>
															<div class="rating-number ms-2 mt-1"><?= $offers_product_data['rating']['total_rating'] / $offers_product_data['rating']['total_rows'] ?></div>
														<?php endif; ?>
													</div>
													<button class="btn btn-primary text-center card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event,'<?= $offers_product_data['id'] ?>','<?= $offers_product_data['sku'] ?>','<?= $offers_product_data['vendor_id'] ?>','<?= $this->session->userdata('user_id'); ?>',1,'',2,'<?= $this->session->userdata('qoute_id'); ?>')"><?= $this->lang->line('buy') ?></button>
												</div>
											</div>
										</a>
									</div>
								<?php } ?>

							</div>
						</div>
					</div>

				</div>
			</div>
		</section>
		<!--End: Track Order Section -->

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