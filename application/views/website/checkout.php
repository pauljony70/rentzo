<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "CheckOut";
	include("include/headTag.php") ?>

	<!-- Plugin Css -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/libs/nativetoast/native-toast.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets_web/libs/dropify/dist/css/dropify.min.css') ?>">

	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/checkout.css') ?>" />

</head>

<body class="checkout-body">

	<?php include("include/loader.php") ?>
	<?php include("include/navbar-brand.php") ?>

	<?php if ($checkout['total_item'] == 0) {
		redirect('', 'refresh');
	} ?>

	<main class="checkout-page mt-0">
		<input type="hidden" value="<?= $checkout['total_price_value']; ?>" name="total_value" id="total_value">
		<input type="hidden" value="<?= $checkout['seller_pincode']; ?>" name="seller_pincode" id="seller_pincode">
		<input type="hidden" value="<?= $checkout['imgurl']; ?>" name="imgurl" id="imgurl">

		<section class="my-5">
			<div class="container px-1">
				<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
					<ol class="breadcrumb mb-4">
						<li class="breadcrumb-item"><a class="text-dark" href="#">Address</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a class="text-secondary" href="#">KYC</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a class="text-secondary" href="#">Payment</a></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-lg-7">
						<div class="cart-items d-lg-none mb-4">
							<?php foreach ($cart_items['cart_full'] as $key => $cart) : ?>
								<div class="row ps-4">
									<div class="col-4">
										<img src="<?= base_url('media/' . $cart['imgurl']) ?>" alt="<?= $cart['name'] ?>" srcset="" class="w-100">
									</div>
									<div class="col-8">
										<div class="product-name pe-4 mt-5 mb-2 line-clamp-1"><?= $cart['name'] ?></div>
										<div class="prod-details">
											<table class="w-100">
												<tr>
													<td class="table-heading">Price</td>
													<td class="table-value"><?= $cart['price'] ?></td>
												</tr>
												<tr>
													<td class="table-heading">Quantity</td>
													<td class="table-value"><?= $cart['qty'] ?></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
								<?= $key !== count($cart_items['cart_full']) - 1 ? '<hr class="my-2">' : '' ?>
							<?php endforeach; ?>
						</div>
						<!-- <div class="row">
							<?php
							if (!empty($address['address_details'])) {
								$last_element = array_pop($address['address_details']);
								array_unshift($address['address_details'], $last_element);
								foreach ($address['address_details'] as $key => $add_data) {
							?>
									<label for="radio-card-<?= $key ?>" class="radio-card">
										<input type="radio" class="defaultAdderess" name="radio-card" id="radio-card-<?= $key ?>" value="<?= $add_data['address_id']; ?>" />
										<div class="card-content-wrapper">
											<span class="check-icon"></span>
											<div class="card-content <?= $default_language == 1 ? 'pe-3' : 'ps-3' ?>">
												<span class="badge mb-2"><?= $add_data['addresstype']; ?></span>
												<div class="name m-0 mb-1">
													<h6 class="mb-0"><?= $add_data['fullname']; ?>, </h6>
												</div>
												<div class="address m-0">
													<h6 class="mb-0"><?= $add_data['email'] ?>, +<?= $add_data['country_code'] . ' ' . $add_data['mobile'] ?></h6>
													<h6 class="m-0"><?= $add_data['fulladdress'] ?></h6>
													<h6 class="m-0"><?= $add_data['area'] . ', ' . $add_data['governorate'] . ', ' . $add_data['region'] . ', ' . $add_data['country'] ?></h6>
												</div>
											</div>
										</div>
									</label>
							<?php
								}
							}  ?>
							<a href="" class="btn btn-light my-4" id="address_div_id"><?= $this->lang->line('add-new-add'); ?></a>
						</div> -->

						<form id="formoid" action="#" class="form row mb-4 mb-md-5" method="post">
							<div class="col-md-12">
								<div class="mb-3">
									<label class="form-label">Full Name <span class="text-danger">&#42;</span></label>
									<input type="text" class="form-control" id="fullname_a" name="name" placeholder="Your Name" />
									<span id="error"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Email <span class="text-danger">&#42;</span></label>
									<input type="email" class="form-control" id="email" maxlength="30" name="email" placeholder="Your Email" />
									<span id="error"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Phone number <span class="text-danger">&#42;</span></label>
									<input type="number" class="form-control" id="mobile" oninput="enforceMaxLength(this)" maxlength="10" name="mobile" placeholder="Your Phone" />
									<span id="error"></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<label class="form-label">Address <span class="text-danger">&#42;</span></label>
									<input type="text" class="form-control" id="fulladdress" name="address" placeholder="House Number / Flat / Block No." />
									<span id="error"></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<label class="form-label">Landmark</label>
									<input type="text" class="form-control" id="landmark" name="landmark" placeholder="e.g. Near ABC School" />
								</div>
							</div>
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Pincode <span class="text-danger">&#42;</span></label>
									<input type="number" class="form-control" name="pincode" id="pincode" placeholder="Pincode" oninput="enforceMaxLength(this)" maxlength="6">
									<span id="error"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">State <span class="text-danger">&#42;</span></label>
									<select class="form-select" id="state" name="state">
										<option value="">Select State</option>
									</select>
									<span id="error"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">City <span class="text-danger">&#42;</span></label>
									<select name="city" id="city" class="form-select">
										<option>Select City</option>
										<?php foreach ($get_city as $city_data) { ?>
											<option <?= $this->session->userdata('city_id') == $city_data['city_id'] ? 'selected' : '' ?> value="<?= $city_data['city_id']; ?>"><?= $city_data['city_name']; ?></option>
										<?php } ?>
									</select>
									<span id="error"></span>
								</div>
							</div>

							<input type="hidden" value="<?= $this->session->userdata('user_id'); ?>" type="user_id" id="user_id" name="user_id">
						</form>

						<div class="price-details d-lg-none mb-4 mb-sm-5">
							<!-- <form>
								<div class="input-group mb-4">
									<div class="form-floating">
										<input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code">
										<label for="coupon_code">Coupon Code</label>
									</div>
									<img src="<?= base_url('assets_web/images/icons/coupon-icon.svg') ?>" alt="Icon" srcset="">
								</div>
								<span id="coupon_message"></span>
								<button type="button" class="btn btn-primary" onclick="get_checkout_data(this)">APPLY</button>
							</form> -->
							<div class="section-heading">Order Summary</div>
							<div class="d-flex justify-content-between mb-4">
								<div>
									<h6>Cart value (<?= $checkout['total_item']; ?> items)</h6>
								</div>
								<div>
									<h6><span id="total_mrp"><?= $checkout['total_mrp']; ?></span></h6>
								</div>
							</div>
							<div class="d-flex justify-content-between mb-4">
								<div>
									<h6>Discount</h6>
								</div>
								<div>
									<h6>-<span id="discount_value"><?= $checkout['total_discount']; ?></span></h6>
								</div>
							</div>
							<div class="d-flex justify-content-between mb-4">
								<div>
									<h6>GST(Included)</h6>
								</div>
								<div>
									<h6><span id="tex_value" class="text-dark"><?= $checkout['tax_payable']; ?></span></h6>
								</div>
							</div>
							<div class="d-flex justify-content-between mb-4">
								<div>
									<h6>Security deposit</h6>
								</div>
								<div>
									<h6><span id="security_deposit"><?= $checkout['security_deposit']; ?></span></h6>
								</div>
							</div>
							<div class="d-flex justify-content-between mb-4">
								<div>
									<h6>Shipping</h6>
								</div>
								<div>
									<h6><span id="shipping_fee" class="<?= $checkout['shipping_fee'] == 0 ? 'text-primary' : '' ?>"><?= $checkout['shipping_fee'] == 0 ? 'FREE' : $checkout['shipping_fee'] ?></span></h6>
								</div>
							</div>
							<!-- <div class="d-flex justify-content-between mb-4">
								<div>
									<h6>Coupon discount</h6>
								</div>
								<div>
									<h6>-<span id="coupo_discount_value"><?= $checkout['coupon_discount']; ?></span></h6>
								</div>
							</div> -->
							<hr class="my-4">
							<div class="d-flex justify-content-between">
								<div>
									<h6>TOTAL</h6>
								</div>
								<div>
									<h6 class="fw-semibold" id="total_val"><?= $checkout['payable_amount']; ?></h6>
								</div>
							</div>
						</div>

						<div class="kyc-div mb-5">
							<div class="heading">please Upload KYC Document <span class="text-danger">&#42;</span></div>
							<div class="des mb-4">Upload Aadhar card / Driving license / Passport / voter Id</div>
							<div class="mb-3">
								<select class="form-select" id="documentType" name="documentType">
									<option value="">-- Choose documen type --</option>
									<option value="aadhaar">Aadhar Card</option>
									<option value="drivingLicense">Driving License</option>
									<option value="passport">Passport</option>
									<option value="voterId">Voter ID</option>
								</select>
								<span id="error"></span>
							</div>
							<div class="mb-3">
								<input type="file" name="kyc-document" id="kyc-document" class="dropify" data-height="100" data-max-file-size="5m" data-allowed-file-extensions="jpg png" />
								<span id="error"></span>
							</div>
						</div>

						<div class="payment-types mx-2 mb-5">
							<div class="heading mb-3">Payment Type</div>
							<div class="form-check mb-2">
								<input class="form-check-input" type="radio" name="flexRadioDefault" id="netBanking" value="online" checked>
								<label class="form-check-label" for="netBanking">
									Net Banking / UPI / Credit card / Debit card
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="flexRadioDefault" id="cashOnDelivery" value="cod">
								<label class="form-check-label" for="cashOnDelivery">
									Cash On Delivery(COD)
								</label>
							</div>
						</div>

						<div class="continue paymentMethod">
							<div id="place-order-btn-div">
								<button type="button" href="javascript:void(0);" class="btn btn-primary w-100 place-order-btn" id="placeOrderBtn">Place Order</button>
							</div>
						</div>
					</div>
					<div class="col-lg-5 ps-xl-5 mt-5 mt-lg-0 d-none d-lg-block">
						<div class="ps-lg-5">
							<div class="cart-items mb-4">
								<?php foreach ($cart_items['cart_full'] as $key => $cart) : ?>
									<div class="row ps-4">
										<div class="col-4">
											<img src="<?= base_url('media/' . $cart['imgurl']) ?>" alt="<?= $cart['name'] ?>" srcset="" class="w-100">
										</div>
										<div class="col-8">
											<div class="product-name pe-4 mt-5 mb-2 line-clamp-1"><?= $cart['name'] ?></div>
											<div class="prod-details">
												<table class="w-100">
													<tr>
														<td class="table-heading">Price</td>
														<td class="table-value"><?= $cart['price'] ?></td>
													</tr>
													<tr>
														<td class="table-heading">Quantity</td>
														<td class="table-value"><?= $cart['qty'] ?></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<?= $key !== count($cart_items['cart_full']) - 1 ? '<hr class="my-2">' : '' ?>
								<?php endforeach; ?>
							</div>

							<div class="price-details">
								<!-- <form>
									<div class="input-group mb-4">
										<div class="form-floating">
											<input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code">
											<label for="coupon_code">Coupon Code</label>
										</div>
										<img src="<?= base_url('assets_web/images/icons/coupon-icon.svg') ?>" alt="Icon" srcset="">
									</div>
									<span id="coupon_message"></span>
									<button type="button" class="btn btn-primary" onclick="get_checkout_data(this)">APPLY</button>
								</form> -->
								<div class="section-heading">Order Summary</div>
								<div class="d-flex justify-content-between mb-4">
									<div>
										<h6>Cart value (<?= $checkout['total_item']; ?> items)</h6>
									</div>
									<div>
										<h6><span id="total_mrp1"><?= $checkout['total_mrp']; ?></span></h6>
									</div>
								</div>
								<div class="d-flex justify-content-between mb-4">
									<div>
										<h6>Discount</h6>
									</div>
									<div>
										<h6>-<span id="discount_value1"><?= $checkout['total_discount']; ?></span></h6>
									</div>
								</div>
								<div class="d-flex justify-content-between mb-4">
									<div>
										<h6>GST(Included)</h6>
									</div>
									<div>
										<h6><span id="tex_value1" class="text-dark"><?= $checkout['tax_payable']; ?></span></h6>
									</div>
								</div>
								<div class="d-flex justify-content-between mb-4">
									<div>
										<h6>Security deposit</h6>
									</div>
									<div>
										<h6><span id="security_deposit1"><?= $checkout['security_deposit']; ?></span></h6>
									</div>
								</div>
								<div class="d-flex justify-content-between mb-4">
									<div>
										<h6>Shipping</h6>
									</div>
									<div>
										<h6><span id="shipping_fee1" class="<?= $checkout['shipping_fee'] == 0 ? 'text-primary' : '' ?>"><?= $checkout['shipping_fee'] == 0 ? 'FREE' : $checkout['shipping_fee'] ?></span></h6>
									</div>
								</div>
								<!-- <div class="d-flex justify-content-between mb-4">
									<div>
										<h6>Coupon discount</h6>
									</div>
									<div>
										<h6>-<span id="coupo_discount_value1"><?= $checkout['coupon_discount']; ?></span></h6>
									</div>
								</div> -->
								<hr class="my-4">
								<div class="d-flex justify-content-between">
									<div>
										<h6>TOTAL</h6>
									</div>
									<div>
										<h6 class="fw-semibold" id="total_val1"><?= $checkout['payable_amount']; ?></h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br><br>
			</div>
		</section>
		<!--End: Check-Out Page -->
	</main>

	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>

	<!-- Plugin JS -->
	<script src="<?php echo base_url(); ?>assets_web/libs/dropify/dist/js/dropify.min.js"></script>
	<script src="<?= base_url('assets_web/libs/nativetoast/native-toast.js') ?>"></script>

	<script src="<?= base_url('assets_web/js/app/checkout.js') ?>"></script>

</body>

</html>