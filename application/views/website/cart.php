<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Cart";
	include("include/headTag.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/cart.css') ?>">
</head>


<body class="cart-body">

	<?php include("include/loader.php") ?>
	<?php include("include/navbar-brand.php") ?>

	<?php if (empty($cart['cart_full'])) { ?>
		<main class="empty-cart mt-0">
			<section class="my-5">
				<div class="container">
					<div class="d-flex flex-column align-items-center empty-cart-image">
						<img src="<?= base_url('assets_web/images/empty-cart.png') ?>" class="mb-5" alt="Empty Cart">
						<div class="heading mb-2">Your Cart is Empty</div>
						<div class="des mb-4">Looks like you haven’t added anything to your cart yet</div>
						<a href="<?= base_url() ?>" class="btn btn-primary">Go Shop</a>
					</div>
				</div>
			</section>
		</main>
	<?php } else { ?>
		<main class="cart-page mt-0">
			<section class="mt-5">
				<div class="container">
					<div class="d-flex mb-4">
						<div class="page-title">Cart</div>
						<span class="cart-count ms-5"><?= $cart['total_item']; ?> ITEMS</span>
					</div>
					<div class="row cart-details-row pb-5">
						<div class="col-lg-8 ps-0">
							<?php foreach ($cart['cart_full'] as $key => $cart_product) { ?>
								<div class="card">
									<div class="card-body p-0">
										<div class="row">
											<div class="col-3">
												<div class="cart-type-<?= $cart_product['cart_type'] == 'Rent' ? 'rent' : 'purchase'; ?>">
													<div class="text"><?= $cart_product['cart_type']; ?></div>
												</div>
												<a href="<?= base_url . $cart_product['web_url'] . '?pid=' . $cart_product['prodid'] . '&sku=' . str_replace('#', '%23', $cart_product['sku']) . '&sid=' . $cart_product['vendor_id']; ?>" target="_blank" rel="noopener noreferrer">
													<img class="w-100 prod-img ps-3" src="<?= weburl . 'media/' . $cart_product['imgurl']; ?>" alt="">
												</a>
											</div>
											<div class="col-9">
												<div class="d-flex justify-content-end">
													<div class="delete-cart d-flex align-items-center justify-content-center" onclick="delete_cart('<?= $cart_product['prodid']; ?>','<?= $this->session->userdata('user_id') ?>','<?= $cart['qoute_id']; ?>')">
														<i class="fa-solid fa-xmark"></i>
													</div>
												</div>
												<div class="mt-4">
													<a class="cart-prod-title" href="<?= base_url . $cart_product['web_url'] . '?pid=' . $cart_product['prodid'] . '&sku=' . str_replace('#', '%23', $cart_product['sku']) . '&sid=' . $cart_product['vendor_id']; ?>" target="_blank" rel="noopener noreferrer"><?= $cart_product['name']; ?></a>
												</div>
												<div class="d-flex justify-content-between my-3">
													<table class="attributes">
														<tbody>
															<?php foreach ($cart_product['configure_attr'] as $conf_data) : ?>
																<tr>
																	<td class="attr-name"><?= $conf_data['attr_name'] ?></td>
																	<?php if ($conf_data['attr_name'] == 'Color') :
																		$rgb = hexToRgb($conf_data['item']);
																		$dark_color = "rgb(" . $rgb['r'] * 0.8 . "," . $rgb['g'] * 0.8 . ',' . $rgb['b'] * 0.8 . ")";
																	endif; ?>
																	<td>
																		<div class="d-flex alifn-items-center">
																			<label for="" <?= $conf_data['attr_name'] == 'Color' ? 'style="background-color:' . $conf_data['item'] . '; border: 1px solid ' . $dark_color . '"' : '' ?> class="attr-des ms-3 ms-md-5" id="<?= $conf_data['attr_name'] ?>">
																				<?= $conf_data['attr_name'] != 'Color' ? $conf_data['item'] : '' ?>
																			</label>
																		</div>
																	</td>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
													<div class="rent-date-range">
														<?php if ($cart_product['rent_from_date'] != '' &&  $cart_product['rent_to_date'] != '') {
															echo date('d M Y', strtotime($cart_product['rent_from_date'])) . ' to ' . date('d M Y', strtotime($cart_product['rent_to_date']));
														} ?>
													</div>
												</div>
												<div class="d-flex justify-content-between mb-2">
													<div class="quantity mb-4">
														<div class="input-group mb-3">
															<button type="button" class="btn minus" type="button" id="" onclick="add_product_qty('<?= $cart_product['prodid']; ?>','<?= $cart_product['sku']; ?>','<?= $cart_product['vendor_id']; ?>','<?= $this->session->userdata('user_id'); ?>',<?= $cart_product['qty']; ?>-1,'',2,'<?= $cart['qoute_id']; ?>')">
																<i class="fa-solid fa-minus"></i>
															</button>
															<input type="text" class="form-control text-center" id="floatingInputGroup1" placeholder="" value="<?= $cart_product['qty'] ?>" readonly>
															<button type="button" class="btn plus" type="button" id="" onclick="add_product_qty('<?= $cart_product['prodid']; ?>','<?= $cart_product['sku']; ?>','<?= $cart_product['vendor_id']; ?>','<?= $this->session->userdata('user_id'); ?>',<?= $cart_product['qty'] + 1; ?>,'',2,'<?= $cart['qoute_id']; ?>')">
																<i class="fa-solid fa-plus"></i>
															</button>
														</div>
													</div>
													<div class="d-flex flex-column align-items-end justify-content-end">
														<?php if ($cart_product['cart_type'] == 'Rent') : ?>
															<div class="d-flex security-deposit mb-3">
																<div class="heading me-3 me-md-5"><?= $cart_product['security_deposit'] != '' ? 'Security Deposit' : '' ?></div>
																<div class="amount"><?= $cart_product['security_deposit'] != '' ? price_format($cart_product['security_deposit']) : '' ?></div>
															</div>
														<?php endif; ?>
														<div class="d-flex">
															<div class="date-range-count me-3 me-md-5"><?= $cart_product['total_days'] != '' ? '3 Days' : '' ?></div>
															<div class="product_price_cart"><?= $cart_product['rent_price'] != '' ? price_format($cart_product['rent_price']) : $cart_product['price'] ?></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?= $key !== count($cart['cart_full']) - 1 ? '<hr class="mb-0">' : '' ?>
							<?php } ?>
						</div>
						<div class="col-lg-4 mt-5 mt-md-3">
							<div class="price-details-col p-4">
								<div class="top-heading">Order Summary</div>
								<div class="cart-sammary">
									<div class="d-flex justify-content-between mb-4">
										<div class="heading">Price</div>
										<div class="price text-end"><?= $cart['total_mrp']; ?></div>
									</div>
									<div class="d-flex justify-content-between">
										<div class="heading">Discount</div>
										<div class="price text-end"><?= $cart['total_discount']; ?></div>
									</div>
								</div>
								<hr>
								<div class="cart-sammary cart-total">
									<div class="d-flex justify-content-between mb-4">
										<div class="heading">TOTAL</div>
										<div class="price text-end fw-bolder"><?= $cart['payable_amount']; ?></div>
									</div>
								</div>
								<a href="<?= base_url('checkout') ?>" id="cart-continue-btn" class="btn btn-primary w-100">Proceed to Checkout</a>
							</div>
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