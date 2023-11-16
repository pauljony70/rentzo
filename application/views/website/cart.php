<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Cart";
	include("include/headTag.php") ?>
	<style>
		label#Color {
			height: 24px;
			width: 24px;
			border-radius: 50%;
		}

		.offer_div {
			box-shadow: 0 0 6px rgb(47 171 115);
			animation: rotateBoth 3s infinite linear;
		}
		.old-price
		{
			text-decoration : line-through;
		}
		li 
		{	
			list-style-type:none;
		}

		@keyframes rotateBoth {

			0%,
			100% {
				transform: rotate(0deg);
			}

			25% {
				transform: rotate(0.6deg);
			}

			75% {
				transform: rotate(-0.6deg);
			}
		}
	</style>
</head>


<body class="cart-body">

	<?php
	include("include/loader.php")
	?>
	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php")
	?>

	<?php if (empty($cart['cart_full'])) { ?>
		<main class="empty-cart mt-0">
			<div class="d-flex align-items-center h-100 responsive_nav d-block d-sm-none">
				<svg class="fa-angle-left ms-3" onclick="history.back(-1)" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15.5 19.5 8 12l7.5-7.5" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				<h4 class="text-dark ms-2 mb-0 fw-bold"><?= $this->lang->line('shopping-cart'); ?></h4>
			</div>

			<!--Start: Empty Cart Section -->
			<section class="mt-5">
				<div class="container">
					<div class="wrap box-shadow-4">
						<img src="<?php echo base_url; ?>assets_web/images/empty-cart.png" alt="" class="empty-cart-img" />
						<h5><?= $this->lang->line('cart-empty'); ?></h5>
						<p><?= $this->lang->line('add-items'); ?></p>
						<a href="<?php echo base_url; ?>" class="btn btn-default"><?= $this->lang->line('shop-now'); ?></a>
					</div>
				</div>
			</section>
			<!--End: Empty Cart Section -->

		</main>
	<?php } else { ?>
		<main class="cart-page mt-0">

			<?php // print_r($cart); 
			?>
			<div class="d-flex align-items-center h-100 responsive_nav d-block d-sm-none">
				<svg class="fa-angle-left ms-3" onclick="history.back(-1)" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15.5 19.5 8 12l7.5-7.5" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				<h4 class="text-dark ms-2 mb-0 fw-bold"><?= $this->lang->line('shopping-cart'); ?></h4>
			</div>

			<!--Start: Cart Section -->
			<section class="mt-5">
				<div class="container px-0">

					<div class="row">
						<div class="col-lg-8 px-0">
							<div class="left-block row">
								<h5 class="title"><?= $this->lang->line('your-cart-is-ready') ?> (<?php echo $cart['total_item']; ?>)</h5>

								<?php foreach ($cart['cart_full'] as $key => $cart_product) { ?>
									<!-- <div class="cart-details d-flex align-items-center py-4 mb-2 mb-lg-0"> -->
									<!-- <a href="<?php echo base_url . $cart_product['web_url'] . '?pid=' . $cart_product['prodid'] . '&sku=' . str_replace('#', '%23', $cart_product['sku']) . '&sid=' . $cart_product['vendor_id']; ?>">
											<img src="<?php echo weburl . 'media/' . $cart_product['imgurl']; ?>" class="product-thumb" />
										</a>
										<div class="cart-body <?= $default_language == 1 ? 'me-3' : 'ms-3' ?>">
											<a onclick="delete_cart('<?php echo $cart_product['prodid']; ?>','','<?php echo $cart['qoute_id']; ?>')" class="remove d-sm-none0 mt-3" style="position:inherit;top:-16px;right:-10px;">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="" class="bi bi-trash" viewBox="0 0 16 16">
													<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
													<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
												</svg>
											</a>
											<h6 onclick="redirect_to_link('<?php echo base_url . $cart_product['web_url'] . '?pid=' . $cart_product['prodid'] . '&sku=' . str_replace('#', '%23', $cart_product['sku']) . '&sid=' . $cart_product['vendor_id']; ?>')"><?php echo $cart_product['name']; ?></h6>
											<p class="text-muted mt-2">
												<?php foreach ($cart_product['configure_attr'] as $conf_data) {

													echo '<span class="me-1"><b>' . $conf_data['attr_name'] . ':</b></span><label';
													if ($conf_data['attr_name'] == 'Color') {
														echo ' style="background-color:' . $conf_data['item'] . '"';
													}
													echo ' class="ms-1 " id="' . $conf_data['attr_name'] . '" >';
													if ($conf_data['attr_name'] != 'Color') {
														echo $conf_data['item'];
													}
													echo '</label>&nbsp;,&nbsp;';
												} ?>
											</p>
											<div class="wrap">
												<div class="rate" style="margin-top:20px;">
													<h5><?php echo $cart_product['price']; ?></h5>
													<div class="old-price my-1"><?php if ($cart_product['price'] != $cart_product['mrp']) {
																					echo $cart_product['mrp'];
																				} ?></div>
													<div class="off-price"><?php if ($cart_product['totaloff'] != 0) {
																				echo $cart_product['offpercent'];
																			} ?></div>
												</div>
												<div class="quantity-delete">
													<div class="quantity">
														<a onclick="add_product_qty('<?php echo $cart_product['prodid']; ?>','<?php echo $cart_product['sku']; ?>','<?php echo $cart_product['vendor_id']; ?>','<?php echo $this->session->userdata('user_id'); ?>',<?php echo $cart_product['qty']; ?>-1,'',2,'<?php echo $cart['qoute_id']; ?>')" class="minus">
															<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path fill-rule="evenodd" clip-rule="evenodd" d="M9 18C13.9706 18 18 13.9706 18 9C18 4.02944 13.9706 0 9 0C4.02944 0 0 4.02944 0 9C0 13.9706 4.02944 18 9 18ZM4 8C3.44772 8 3 8.44771 3 9C3 9.55229 3.44772 10 4 10H14C14.5523 10 15 9.55229 15 9C15 8.44771 14.5523 8 14 8H4Z" fill="" />
															</svg>
														</a>
														<span><input type="text" class="form-control mx-2 rounded-circle border" value="<?php echo $cart_product['qty']; ?>" /></span>
														<a onclick="add_product_qty('<?php echo $cart_product['prodid']; ?>','<?php echo $cart_product['sku']; ?>','<?php echo $cart_product['vendor_id']; ?>','<?php echo $this->session->userdata('user_id'); ?>',<?php echo $cart_product['qty'] + 1; ?>,'',2,'<?php echo $cart['qoute_id']; ?>')" class="plus">
															<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path fill-rule="evenodd" clip-rule="evenodd" d="M18 9C18 13.9706 13.9706 18 9 18C4.02944 18 0 13.9706 0 9C0 4.02944 4.02944 0 9 0C13.9706 0 18 4.02944 18 9ZM9 15C8.44771 15 8 14.5523 8 14V10H4C3.44772 10 3 9.55229 3 9C3 8.44771 3.44772 8 4 8H8V4C8 3.44772 8.44771 3 9 3C9.55228 3 10 3.44772 10 4V8H14C14.5523 8 15 8.44771 15 9C15 9.55229 14.5523 10 14 10H10V14C10 14.5523 9.55229 15 9 15Z" fill="" />
															</svg>
														</a>
													</div>
												</div>
											</div>
										</div> -->
									<div class="col-12 <?= $key == 0 ? '' : 'mt-3' ?>">
										<div class="card box-shadow-4">
											<div class="card-body">
												<div class="row">
													<div class="col-3">
														<a href="<?php echo base_url . $cart_product['web_url'] . '?pid=' . $cart_product['prodid'] . '&sku=' . str_replace('#', '%23', $cart_product['sku']) . '&sid=' . $cart_product['vendor_id']; ?>" target="_blank" rel="noopener noreferrer">
															<img width="150px" src="<?php echo weburl . 'media/' . $cart_product['imgurl']; ?>" alt="">
														</a>
													</div>
													<div class="col-9">
														<div class="d-flex flex-column">
															<div class="d-flex align-items-center justify-content-between">
																<a href="<?php echo base_url . $cart_product['web_url'] . '?pid=' . $cart_product['prodid'] . '&sku=' . str_replace('#', '%23', $cart_product['sku']) . '&sid=' . $cart_product['vendor_id']; ?>" target="_blank" class="cart-prod-title text-dark mb-2"><?= $cart_product['name']; ?></a>
																<i class="fa-regular fa-trash-can ms-2" onclick="delete_cart('<?= $cart_product['prodid']; ?>','<?= $this->session->userdata('user_id') ?>','<?= $cart['qoute_id']; ?>')" style="position: absolute; top: 17px;<?php if($default_language == 1 ) echo "left: 10px;"; else echo"right: 10px;"; ?>"></i>
															</div>
															<div class="d-flex flex-wrap">
																<?php foreach ($cart_product['configure_attr'] as $conf_data) : ?>
																	<div class="d-flex align-items-center text-muted mb-2 <?= $default_language == 1 ? 'ms-2' : 'me-2' ?>">
																		<div class="mt-1 <?= $default_language == 1 ? 'ms-1' : 'me-1' ?>"><b><?= $conf_data['attr_name'] ?>:</b></div>
																		<?php if ($conf_data['attr_name'] == 'Color') :
																			$rgb = hexToRgb($conf_data['item']);
																			$dark_color = "rgb(" . $rgb['r'] * 0.8 . "," . $rgb['g'] * 0.8 . ',' . $rgb['b'] * 0.8 . ")";
																		endif; ?>
																		<label <?= $conf_data['attr_name'] == 'Color' ? 'style="background-color:' . $conf_data['item'] . '; border: 1px solid ' . $dark_color . '"' : '' ?> class="<?= $conf_data['attr_name'] !== 'Color' ? 'mt-1' : '' ?> ms-1" id="<?= $conf_data['attr_name'] ?>">
																			<?= $conf_data['attr_name'] != 'Color' ? $conf_data['item'] : '' ?>
																		</label>
																	</div>
																<?php endforeach; ?>
															</div>
															<div class="rate mb-2">
																<span class="product_price_cart"><?= $cart_product['price']; ?></span>
																<small class="old-price"><?= $cart_product['price'] != $cart_product['mrp'] ? $cart_product['mrp'] : '' ?></small>
															</div>
															<div class="quantity mb-2">
																<div class="input-group">
																	<button type="button" class="btn btn-primary minus" type="button" id="" onclick="add_product_qty('<?= $cart_product['prodid']; ?>','<?= $cart_product['sku']; ?>','<?= $cart_product['vendor_id']; ?>','<?= $this->session->userdata('user_id'); ?>',<?= $cart_product['qty']; ?>-1,'',2,'<?= $cart['qoute_id']; ?>')"><i class="fa-solid fa-minus"></i></button>
																	<input type="number" style="width:50px" class="form-control1 text-center" placeholder="" value="<?= $cart_product['qty'] ?>" readonly>
																	<button type="button" class="btn btn-primary plus" type="button" id="" onclick="add_product_qty('<?= $cart_product['prodid']; ?>','<?= $cart_product['sku']; ?>','<?= $cart_product['vendor_id']; ?>','<?= $this->session->userdata('user_id'); ?>',<?= $cart_product['qty'] + 1; ?>,'',2,'<?= $cart['qoute_id']; ?>')"><i class="fa-solid fa-plus"></i></button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- </div> -->
								<?php } ?>
							</div>
						</div>
						<div class="col-lg-4 mt-3">
							<div class="d-flex-center offer_div bg-success p-2 mb-2">
								<!-- <img src="<?php base_url ?>assets_web/images/svgs/info-circle.svg" alt="" style="height: 20px;"> -->
								<h6 class="m-0 mt-1 text-white fw-normal"><?= $this->lang->line('you-will-save') ?> <?php echo $cart['total_discount']; ?> <?= $this->lang->line('on-this-order') ?></h6>
							</div>
							<?php if (empty($cart['cart_full'])) { ?>
								<h4 class="fs-5 text-center mb-0"><?= $this->lang->line('cart-is-empty') ?></h4>
							<?php } else { ?>
								<div class="right-block p-4 box-shadow-4">

									<div class="price-details">
										<h5><?= $this->lang->line('order-summary') ?></h5>
										<p class="text-muted mb-10"><?= $this->lang->line('order-summary-des') ?></p>
										<ul class="price d-flex justify-content-between ps-0 mb-0">
											<li>
												<h6 class="mt-0"><?= $this->lang->line('cart-value') ?> (<?php echo $cart['total_item']; ?> <?= $this->lang->line('items') ?>)</h6>
											</li>
											<li>
												<h6><?php echo $cart['total_mrp']; ?></h6>
											</li>
										</ul>
										<ul class="discount d-flex justify-content-between mb-0 p-0">
											<li>
												<h6 class="mt-0"><?= $this->lang->line('discount') ?></h6>
											</li>
											<li>
												<h6>-<?php echo $cart['total_discount']; ?></h6>
											</li>
										</ul>
									</div>
									<hr>
									<ul class="total d-flex justify-content-between ps-0">
										<li>
											<h5><?= $this->lang->line('total-amount') ?></h5>
										</li>
										<li>
											<h5><?php echo $cart['payable_amount']; ?></h5>
										</li>
									</ul>
									<a href="<?php echo base_url; ?>checkout" id="cart-continue-btn" class="btn btn-block btn-primary text-uppercase w-100" style="bottom:10px;"><?= $this->lang->line('continue') ?></a>
									<!-- <div class="continue text-center mt-3">
										<h6><?= $this->lang->line('you-will-save') ?> <?php echo $cart['total_discount']; ?> <?= $this->lang->line('on-this-order') ?></h6>
									</div> -->
								</div>
							<?php } ?>
						</div>
					</div>
					<br><br>
				</div>
			</section>
			<!--End: Cart Section -->

		</main>
	<?php } ?>

	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>
	<script>
		var csrfName = $(".txt_csrfname").attr("name"); //
		var csrfHash = $(".txt_csrfname").val(); // CSRF hash
		var site_url = $(".site_url").val(); // CSRF hash

		function delete_cart(prod_id, user_id, qouteid) {
			$.ajax({
				method: "post",
				url: site_url + "deleteProductCart",
				data: {
					language: default_language,
					pid: prod_id,
					devicetype: 2,
					user_id: user_id,
					qouteid: qouteid,
					[csrfName]: csrfHash,
				},
				success: function(response) {
					location.reload();
				},
			});
		}

		function add_product_qty(
			prod_id,
			sku,
			vendor_id,
			user_id,
			qty,
			referid,
			devicetype,
			qouteid
		) {
			$.ajax({
				method: "post",
				url: site_url + "addProductCart",
				data: {
					language: default_language,
					pid: prod_id,
					sku: sku,
					sid: vendor_id,
					user_id: user_id,
					qty: qty,
					referid: referid,
					devicetype: 2,
					qouteid: qouteid,
					[csrfName]: csrfHash,
				},
				success: function(response) {
					//hideloader();
					//$(".table").load(location.href + " .table");
					//alert(response.msg);
					// alert(response.status);
					//location.reload();
					if (response.status == 1) {
						location.reload();
						/*Swal.fire({
							position: "center",
							title: response.msg,
							showConfirmButton: false,
							confirmButtonColor: '#ff5400',
							timer: 3000
						})
						setTimeout(function() {
							location.reload();
						}, 2000);*/
					} else {
						if (response.msg !== 'Cart invalid request') {
							Swal.fire({
								title: response.msg,
								type: 'error',
								confirmButtonColor: '#FF6600',
								confirmButtonText: 'OK',
								timer: 1000
							});
						}
					}

				},
			});
		}
	</script>

</body>

</html>