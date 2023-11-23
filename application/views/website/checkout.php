<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "CheckOut"; 
	include("include/headTag.php") ?>
	<style>
		.cart-page .left-block {
			min-height: auto !important;
		}

		.checkout-page .left-block .nav-pills .nav-link.active .form-check-input {
			background-image: none;
		}
		
		li 
		{	
			list-style-type:none;
		}

		.form-check-input:active,
		.form-check-input:checked {
			background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23FF6600'/%3e%3c/svg%3e") !important;
		}

		input#captcha_test {
			width: 270px;
		}

		@media (max-width: 380px) {
			input#captcha_test {
				width: 60vw;
			}
		}

		@media (max-width: 576px) {
			.row>* {
				padding: 4px;
			}
		}

		.right-block .total span.text-muted {
			font-size: 0.775rem;
		}

		#map {
			height: 300px;
			width: 100%;
		}

		#map-container {
			position: relative;
		}

		#search-container {
			position: absolute;
			top: 10px;
			left: 20px;
			background-color: #fff;
			border-radius: 3px;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
			padding: 2.5px;
			z-index: 2;
			width: 79%;
		}

		#search_address {
			width: 100%;
			padding: 0.5em 1em;
			border: none;
		}

		.custom-control {
			position: absolute;
			bottom: 25px;
			right: 60px;
			background-color: white;
			border-radius: 3px;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
			cursor: pointer;
			padding: 8px 14px;
		}

		.intl-tel-input,
		.iti--separate-dial-code {
			width: 100%;
		}

		.iti__country-list {
			/* width: 26.1rem; */
			border-radius: 3px;
		}

		.iti-mobile .iti--container {
			display: flex;
			align-items: center;
			justify-content: center;
		}
	</style>
	<link href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/css/intlTelInput.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/checkout.css') ?>" />
	<script src="https://maps.googleapis.com/maps/api/js?key=<?= $this->config->item('api_keys')['gmap-api-key']; ?>&libraries=places"></script>
</head>

<body class="checkout-body">

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

	if ($checkout['total_item'] == 0) {
		redirect('', 'refresh');
	}
	?>
	<main class="checkout-page mt-0">
		<!-- <?= print_r($data); ?> -->
		<!--Start: Check-Out Page -->

		<input type="hidden" value="<?= $checkout['total_price_value']; ?>" name="total_value" id="total_value">
		<input type="hidden" value="<?= $checkout['seller_pincode']; ?>" name="seller_pincode" id="seller_pincode">
		<input type="hidden" value="<?= $checkout['imgurl']; ?>" name="imgurl" id="imgurl">
		<div class="d-flex align-items-center h-100 responsive_nav d-block d-sm-none">
			<svg class="fa-angle-left ms-3" onclick="history.back(-1)" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M15.5 19.5 8 12l7.5-7.5" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
			</svg>
			<h4 class="text-dark ms-2 mb-0 fw-bold"><?= $this->lang->line('checkout'); ?></h4>
		</div>
		<section class="mt-5">
			<div class="container px-1">
				<div class="row">
					<div class="col-lg-8">
						<div class="left-block p-2 p-md-4 box-shadow-4">
							<h5 class="m-0"><?= $this->lang->line('delivery-add'); ?></h5>
							<div class="row">
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
							</div>


							<div class="container px-0" id="address_div" style="max-width:1344px;display:none">
								<div class="row">
									<div class="col-lg-12 px-0">
										<div class="left-block">
											<h5><?= $this->lang->line('add-new-add'); ?></h5>
											<form id="formoid" action="" class="form row g-3" method="post">
												<div class="col-md-12">
													<label class="form-label"><?= $this->lang->line('fullname'); ?></label>
													<input type="text" class="form-control" id="fullname_a" name="name" />
													<span id="error"></span>
												</div>
												<div class="col-md-6">
													<label class="form-label"><?= $this->lang->line('email'); ?></label>
													<input type="email" class="form-control" id="email" maxlength="30" name="email" />
													<span id="error"></span>
												</div>
												<div class="col-md-6">
													<label class="form-label"><?= $this->lang->line('phone-number'); ?></label>
													<input type="text" class="form-control intl-tel-input" id="mobile" maxlength="10" onkeypress="return AllowOnlyNumbers(event);" name="mobile" />
													<span id="error"></span>
												</div>
												<div class="col-md-12">
													<label class="form-label"><?= $this->lang->line('address'); ?></label>
													<input type="text" class="form-control" id="fulladdress" name="address" />
													<span id="error"></span>
												</div>
												<div class="col-md-6">
													<label class="form-label">State</label>
													<select class="form-control" id="state" name="state">

														<option value="">Select State</option>

													</select>
													<span id="state_error" style="color:red;"></span>
												</div>

												<div class="col-md-6">
													<label class="form-label">City</label>
													<select name="city" id="city" class="form-control">

														<option>Select City</option>

														<?php foreach ($get_city as $city_data) { ?>

															<option <?php if ($this->session->userdata('city_id') == $city_data['city_id']) {
																		echo 'selected';
																	} ?> value="<?php echo $city_data['city_id']; ?>"><?php echo $city_data['city_name']; ?></option>

														<?php } ?>

													</select>
													<span id="city_error" style="color:red;"></span>
												</div>
												
												<input type="hidden" value="<?= $this->session->userdata('user_id'); ?>" type="user_id" id="user_id" name="user_id">
											</form>
										</div>
									</div>

								</div>
							</div>

							<br><br>
							<div class="payment-option mx-2">
								<h5><?= $this->lang->line('payment-option'); ?></h5>
								<form name="paymentOptions">
									<div class="form-check p-0">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="netBanking" value="online" checked />
										<label for="netBanking" class="form-check-label"><?= $this->lang->line('cards'); ?> </label>
									</div>
									<div class="form-check p-0">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="cashOnDelivery" value="cod" />
										<label for="cashOnDelivery" class="form-check-label"><?= $this->lang->line('cod'); ?></label>
									</div>
								</form>
							</div>
							<div class="easy-return">
								<?php
								$min  = 1;
								$max  = 50;
								$num1 = rand($min, $max);
								$num2 = rand($min, $max);
								?>
								<div class="col-12 captcha_div" style="display:none">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<h6><label for="quiz" class="col-sm-3 col-form-label form-label">
														<?= $num1 . '+' . $num2 . ' = ?'; ?>
													</label></h6>
												<div class="col-sm-9">
													<input type="hidden" id="no1" value="<?= $num1 ?>">
													<input type="hidden" id="no2" value="<?= $num2 ?>">
													<input type="text" id="captcha_test" class="form-control" Placeholder="Captcha Required**" autocomplete="off" required>
													<span style="color:red;" id="captcha_error"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<br><br>
								<!--<p><?= $this->lang->line('checkout-footer'); ?></p>-->
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="right-block p-5 box-shadow-4">
							<div class="price-details">
								<h5 class="mb-3"><?= $this->lang->line('order-summary'); ?></h5>
								<hr>
								<ul class="price d-flex justify-content-between ps-0 my-4 mt-6">
									<li>
										<h6><?= $this->lang->line('cart-value'); ?> (<?= $checkout['total_item']; ?> <?= $this->lang->line('items'); ?>)</h6>
									</li>
									<li>
										<h6><span id="payable_value"><?= $checkout['total_mrp']; ?></span></h6>
									</li>
								</ul>
								<ul class="discount d-flex justify-content-between ps-0 my-4">
									<li>
										<h6><?= $this->lang->line('discount'); ?></h6>
									</li>
									<li>
										<h6>-<span id="discount_value"><?= $checkout['total_discount']; ?></span></h6>
									</li>
								</ul>
								<ul class="discount d-flex justify-content-between ps-0 my-4">
									<li>
										<h6><?= $this->lang->line('coupon-discount'); ?></h6>
									</li>
									<li>
										<h6>-<span id="coupo_discount_value"><?= $checkout['coupon_discount']; ?></span></h6>
									</li>
								</ul>
								<!--<ul class="tax d-flex justify-content-between ps-0 my-4">
									<li>
										<h6><?= $this->lang->line('tax-included'); ?></h6>
									</li>
									<li>
										<h6><span id="tex_value" class="text-dark"><?= $checkout['tax_payable']; ?></span></h6>
									</li>
								</ul>-->
								<ul class="discount d-flex justify-content-between ps-0 my-4">
									<li>
										<h6><?= $this->lang->line('shipping'); ?></h6>
									</li>
									<li>
										<h6><span id="shipping_fee" class="text-dark"><?= $checkout['shipping_fee'] == 0 ? $this->lang->line('free') : $checkout['shipping_fee'] ?></span></h6>
									</li>
								</ul>
								<form>
									<div class="input-group">
										<input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Discount Code" />
										<span onclick="get_checkout_data()" class="input-group-text btn btn-info"><?= $this->lang->line('apply'); ?></span>
									</div>
									<span id="coupon_message" style="color:#438F29;font-weight:600"></span>
								</form>
							</div>
							<ul class="total d-flex justify-content-between ps-0 my-5">
								<li>
									<h5><?= $this->lang->line('total-amount'); ?> <span class="text-muted"></span></h5>
								</li>
								<li>
									<h5><span id="total_val"><?= $checkout['total_price']; ?></span></h5>
								</li>
							</ul>

							<div class="continue paymentMethod0">
								<h6 class="text-center"><?= $this->lang->line('you-will-save'); ?> <?= $checkout['total_discount']; ?> <?= $this->lang->line('on-this-order'); ?></h6>
								<?php
								$str_result = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz';
								?>
								<form method="post" action="<?= base_url('CCAvenue/save') ?>" id="ccrevenue_checkout_form" onsubmit="return CCAvenueValidateForm()">
									<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
									<input type="hidden" name="tid" id="tid" value="" />
									<input type="hidden" name="merchant_id" value="2153910" readonly />
									<input type="hidden" name="order_id" id="order_id" value="<?= strtoupper('ODR' . substr(str_shuffle($str_result), 0, 6) . date("hi") . rand(1, 99)); ?>" />
									<input type="hidden" name="amount" id="amount" value="" />
									<input type="hidden" name="currency" id="currency" value="INR" />
									<input type="hidden" name="redirect_url" value="<?= base_url('CCAvenue/response') ?>" />
									<input type="hidden" name="cancel_url" value="<?= base_url('CCAvenue/response') ?>" />
									<input type="hidden" name="language" value="EN" />
									<input type="hidden" name="billing_name" value="" />
									<input type="hidden" name="billing_address" value="" />
									<input type="hidden" name="billing_city" value="" />
									<input type="hidden" name="billing_state" value="" />
									<input type="hidden" name="billing_zip" value="" />
									<input type="hidden" name="billing_country" value="India" />
									<input type="hidden" name="billing_tel" value="" />
									<input type="hidden" name="billing_email" value="" />
									<input type="hidden" name="delivery_name" id="delivery_name" value="" />
									<input type="hidden" name="delivery_address" id="delivery_address" value="" />
									<input type="hidden" name="delivery_city" id="delivery_city" value="" />
									<input type="hidden" name="delivery_state" id="delivery_state" value="" />
									<input type="hidden" name="delivery_zip" id="delivery_zip" value="" />
									<input type="hidden" name="delivery_country" id="delivery_country" value="India" />
									<input type="hidden" name="delivery_tel" id="delivery_tel" value="" />
									<div id="place-order-btn-div" class="text-center">
										<button type="button" onclick="place_order_data(event)" href="javascript:void(0);" class="btn btn-primary btn-block fw-bolder text-uppercase paymentMethodBtn" id="paymentMethodBtn"><?= $this->lang->line('place-order') ?></button>
									</div>
								</form>
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
	<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/intlTelInput.min.js"></script>
	<script src="<?= base_url('assets_web/js/app/gmap.js') ?>"></script>
	<script>
	
		$(function() {
			//window.onload = get_checkout_data();
			window.onload = getStatedata();
			window.onload = getCitydata(0);
		});

		$('#state').on('change', function() {
			getCitydata(this.value);
		});

		
		function getStatedata() {
			//   successmsg("prod id "+item );
			//alert('ddddd');
			$.ajax({
				method: 'POST',
				url: site_url + "get_state",
				data: {
					language: default_language,
					[csrfName]: csrfHash
				},
				success: function(response) {
					// successmsg(response); // display response from the PHP script, if any
					var data = $.parseJSON(response);
					$('#state').empty();
					$('#tcity').empty();
					var o = new Option("Select State", "");
					$("#state").append(o);
					if (data["status"] == "1") {
						$getcity = true;
						var stateid = '' // <?php $state; ?>;
						$firstitemid = '';
						$firstitemflag = true;
						//  successmsg('<?php echo "some info"; ?>');
						// successmsg("state "+ stateid );
						$(data["data"]).each(function() {
							//	successmsg(this.id +"--"+stateid+"--");
							if (stateid === this.id) {
								// successmsg("match==="+stateid);
								var o = new Option(this.name, this.id);
								$("#state").append(o);
								$('#state').val(this.id);
								$getcity = false;
								//getCitydata(this.id);
							} else {
								var o = new Option(this.name, this.id);
								$("#state").append(o);
							}

							if ($firstitemflag == true) {
								$firstitemflag = false;
								$firstitemid = this.id;
							}
						});

						if ($getcity == true) {
							$getcity = false;
							// getCitydata( $firstitemid );
						}

					} else {
						successmsg(data["msg"]);
					}
				}
			});
		}

		function getCitydata(stateid) {
			// successmsg("state id "+stateid );
			$.ajax({
				method: 'POST',
				url: site_url + "get_city",
				data: {
					stateid: stateid,
					[csrfName]: csrfHash
				},
				success: function(response) {
					// successmsg(response); // display response from the PHP script, if any
					var data = $.parseJSON(response);
					$('#city').empty();
					var o = new Option("Select", "");
					$("#city").append(o);
					if (data["status"] == "1") {
						var cityid = '';

						$(data["data"]).each(function() {
							//	successmsg(this.name+"---"+cityid);
							if (cityid === this.id) {
								// successmsg("match==="+stateid);
								var o = new Option(this.name, this.id);
								$("#city").append(o);
								$('#city').val(this.id);

							} else {
								var o = new Option(this.name, this.id);
								$("#city").append(o);
							}
							//	var o = new Option(this.name, this.id);
							//   $("#selectcity").append(o);
							// pass PHP variable declared above to JavaScript variable

						});

					} else {
						successmsg(data["msg"]);
					}
				}
			});
		}
	
	
		var timeout = null;
		$('#captcha_test').keyup(function() {
			clearTimeout(timeout);

			timeout = setTimeout(function() {
				var captcha_test = $('#captcha_test').val();
				var no1 = $('#no1').val();
				var no2 = $('#no2').val();
				var input_val = parseInt(no1) + parseInt(no2);
				if (captcha_test == input_val) {
					$("#online_place_order_btn").prop('disabled', false);
					$("#captcha_error").text("Captcha Validated.");
				} else {
					$("#captcha_error").text("Invalid Captcha.");
					$("#online_place_order_btn").prop('disabled', true);
				}


			}, 700);
		});

		$(document).ready(function() {

			$("#cashOnDelivery").click(function() {
				$("#online_place_order_btn").prop('disabled', true);
				$('.captcha_div').show();
			});

			$("#netBanking").click(function() {
				$('.captcha_div').hide();
			});
			$(".netBanking").click(function() {
				$('.captcha_div').hide();
			});
			$("#cardPayment").click(function() {
				$('.captcha_div').hide();
			});
			$("#netBanking0").click(function() {
				$('.captcha_div').hide();
			});

		});



		function convertToNumber(str) {
			// Remove all commas from the string
			const withoutCommas = str.replace(/,/g, '');

			// Extract the number from the string and convert it to a float
			const number = parseFloat(withoutCommas.slice(1));

			return number;
		}

		// Place order button visiblity
		const payment_options = document.paymentOptions.flexRadioDefault;
		const place_order_btn_div = document.getElementById('place-order-btn-div');
		var prev = null;

		function AllowOnlyNumbers(e) {
			e = (e) ? e : window.event;
			var clipboardData = e.clipboardData ? e.clipboardData : window.clipboardData;
			var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
			var str = (e.type && e.type == "paste") ? clipboardData.getData('Text') : String.fromCharCode(key);
			return (/^\d+$/.test(str));
		}


		var csrfName = $(".txt_csrfname").attr("name"); //
		var csrfHash = $(".txt_csrfname").val(); // CSRF hash
		var site_url = $(".site_url").val(); // CSRF hash

		function get_checkout_data(user_pincode) {
			//alert('ssss');
			$('#coupon_message').html('');
			var input_code = $('#coupon_code').val();
			var city = $("#city option:selected").val();
			$(".paymentMethodBtn").prop('disabled', true);
			$.ajax({
				method: "post",
				url: site_url + "checkout",
				data: {
					language: default_language,
					coupon_code: input_code,
					shipping_city: city,
					shipping_pincode: user_pincode,
					[csrfName]: csrfHash
				},
				success: function(response) {

					var parsedJSON = response.Information;
					var product_html = "";
					$(".paymentMethod").empty();
					$('#total_discount_data').text();
					if (response.status == 2) {
						$('#coupon_message').html(response.msg);
						/*Swal.fire({
							position: "center",
							//icon: "success",
							title: response.msg,
							showConfirmButton: false,
							confirmButtonColor: "#ff5400",
							timer: 3000,
						});*/
					}
					$(parsedJSON).each(function() {
						$('#payable_value').text(this.total_mrp);
						$('#discount_value').text(this.total_discount);
						$('#tex_value').text(this.tax_payable);
						$('#shipping_fee').text(this.shipping_fee === 0 ? '<?= $this->lang->line('free') ?>' : this.shipping_fee);
						$('#total_val').text(this.payable_amount);
						$('#coupon_message').html();
						//alert(this.shipping_fee);
						if (this.coupon_code != '') {
							$('#total_discount_data').text('Total Savings :' + this.coupon_discount_text);
							$('#coupo_discount_value').text(this.coupon_discount);
							$('#coupon_message').html('Coupon applied successfully.');
						}
						$(".paymentMethodBtn").prop('disabled', false);

						/*product_html += '<a onclick="place_order_data(event)" href="javascript:void(0);" class="btn btn-default paymentMethodBtn">Place Order</a>';
						$(".paymentMethod").html(product_html);
						alert(this.payable_amount);*/
					});
					//alert(response);
				}
			});
		}

		function get_shipping() {
			var pincode = $('#pincode').val();
			get_checkout_data(pincode);
		}
		
		function place_order_data(event) {
			var tab = 'true';


			var address_id = $('#defaultAdderess:checked').val();
			var user_id = $('#user_id').val();


			var fullname = $("#fullname_a").val();
			var mobile = $("#mobile").val();
			var state = $("#state").val();
			var pincode = $("#pincode").val();
			var city = $("#city").val();
			var email = $("#email").val();
			var user_id = $("#user_id").val();
			var fulladdress = $("#fulladdress").val();
			var city_id = $("#city option:selected").val();
			
			
			const validateAddressForm = () => {
			if ($('#fullname_a').val() !== '' && $('#fulladdress').val() !== '' && $('#city').val() !== '' && $('#state').val() !== '' && $('#pincode').val() !== '' && $('#mobile').val() !== '' && $('#email').val() !== '') {
				/*Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'saved',
					showConfirmButton: false,
					timer: 1500
				});*/
				return true;
			} else if ($('#fullname_a').val() !== '' || $('#fulladdress').val() !== '' || $('#city').val() !== '' || $('#city').val() !== 'Select' || $('#state').val() !== '' || $('#state').val() !== 'Select State' || $('#pincode').val() !== '' || $('#mobile').val() !== '' || $('#email').val() !== '') {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: "Please fill all the required field",
					showConfirmButton: false,
					timer: 1500
				});
				return true;
			} else {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: "Your address can't be blank",
					showConfirmButton: false,
					timer: 1500
				});
				return false;
			}
		}


			//if (user_id !== '') {
				/*if (validateAddressForm()) {

					$.ajax({
						method: "post",
						url: site_url + "getUserAddress",
						data: {
							language: default_language,
							user_id: user_id,
							[csrfName]: csrfHash
						},
						success: function(response) {

							var parsedJSON = response.Information.address_details;

							if (parsedJSON == '') {
								addUserAddress();
							} else {
								var isNewAddress = true;
								$(parsedJSON).each(function() {
									console.log('a');
									console.log(this)
									if (this.fullname === fullname && this.mobile === mobile && this.state === state && this.pincode === pincode && this.city_id === city && this.email === email && this.fulladdress === fulladdress) {
										console.log('b')
										isNewAddress = false;
										return false;
									}
								});
								if (isNewAddress) {
									addUserAddress();
								}
							}
						}
					}); */


					/* $.ajax({
						method: "post",
						url: site_url + "addUserAddress",
						data: {
							language: default_language,
							username: fullname,
							mobile: $("#mobile").val(),
							pincode: $("#pincode").val(),
							locality: "",
							fulladdress: $("#fulladdress").val(),
							state: $("#state").val(),
							city: $('#city').find(":selected").text(),
							addresstype: "home",
							email: $("#email").val(),
							city_id: $("#city option:selected").val(),
							[csrfName]: csrfHash,
						},
						success: function(response) {
							//hideloader();
							// location.reload();
						},
					}); 
				}*/
			//}

			if (fullname == '') {
				Swal.fire({
					position: "center",
					//icon: "success",
					title: 'Please Select Address',
					showConfirmButton: false,
					confirmButtonColor: "#ff5400",
					timer: 3000,
				});
			} else {


				//alert("active---"+tab+"---");

				if (fulladdress == "" || fulladdress == null && fullname == "" || fullname == null && state == "" || state == null && city == "" || city == null) {

					if (fullname == "" || fullname == null) {
						$("#fullname1_error").text("Please Add Name.");
					} else {
						$("#fullname1_error").text("");
					}
					if (mobile == "" || mobile == null) {
						$("#mobile_error").text("Please Add Mobile No.");
					} else {
						$("#mobile_error").text("");
					}
					if (state == "" || state == null) {
						$("#state_error").text("Please Select State.");
					} else {
						$("#state_error").text("");
					}
					//else if(pincode == "" || pincode == null)
					//{
					//alert('please Add Pincode.');
					//}
					if (city == "" || city == null) {
						$("#city_error").text("Please Select City.");
					} else {
						$("#city_error").text("");
					}

					if (email == "" || email == null) {
						$("#emails_error").text("Please Add Emails.");
					} else {
						$("#emails_error").text("");
					}

					if (fulladdress == "" || fulladdress == null) {
						$("#fulladdress_error").text("Please Add Full Address.");
					} else {
						$("#fulladdress_error").text("");
					}

					/*if( ){
					  /// write address filed validation code
					}else if(){ */

				} else {

					$("#fullname1_error").text("");
					$("#emails_error").text("");
					$("#mobile_error").text("");
					$("#state_error").text("");
					$("#city_error").text("");
					$("#fulladdress_error").text("");

					if (tab == 'true') {

						// alert("call true");

						var spinner = '<div class="spinner-border" role="status"><span class="se-only"></span></div> Please Wait..';
						$('.paymentMethodBtn').html(spinner);
						// $(".paymentMethodBtn").prop('disabled', true);
						$('.paymentMethodBtn').addClass('disabled-link');
						// alert(" place order req send ");
						var coupon_code = $('#coupon_code').val();
						var coupon_value = $('#coupo_discount_value').text();

						$.ajax({
							method: "post",
							url: site_url + "placeOrder",
							data: {
								language: default_language,
								fullname: fullname,
								mobile: mobile,
								locality: '',
								fulladdress: fulladdress,
								city: $('#city').find(":selected").text(),
								state: state,
								pincode: pincode,
								addresstype: 'Home',
								email: email,
								payment_id: 'Pay12345',
								payment_mode: 'COD',
								city_id: city_id,
								coupon_code: coupon_code,
								coupon_value: coupon_value,
								[csrfName]: csrfHash,
							},
							success: function(response) {
								// $(".paymentMethodBtn").prop('disabled', false);
								$('.paymentMethodBtn').removeClass('disabled-link');
								$('.paymentMethodBtn').text('Place Order');
								//hideloader();

								if (response.status == 1) {
									// alert(response.status);
									//location.href = site_url + "thankyou/" + order_id;

									var imgurl = $("#imgurl").val();

									var order_id = response.Information.order_id;
									var message = 'Dear *' + fullname + '* ,';
									message += ' Your Order has been placed Successfully.';
									$.ajax({
										method: 'get',
										url: site_url + 'send_whatsapp_msg',
										data: {
											number: '91'.concat(mobile),
											type: 'media',
											message: message.replace(/ /g, "%20"),
											media_url: site_url + 'media/' + imgurl,
											// filename: '',
											instance_id: '64258107A62A7',
											access_token: '14e3c33fbe98cd4ac95bb8f15c2d9023'
										},
										success: function(response) {
											// alert(JSON.stringify(JSON.parse(response), null, 2));
										}
									});


									setTimeout(function() {


										location.href = site_url + "thankyou/" + order_id;
									}, 100);

								} else {
									/*Swal.fire({
										position: "center",
										//icon: "success",
										title: response.Information.order_msg,
										showConfirmButton: false,
										confirmButtonColor: "#ff5400",
										timer: 3000,
									});*/
								}
								//alert(response.Information.order_msg);
								//var order_id = response.Information.order_id
								//location.href=site_url+'thankyou/'+ order_id;

								//var parsedJSON = JSON.parse(response);
								//$(parsedJSON.Information).each(function() {
								//	 alert(this.order_id);
								//});
								//location.href=site_url+'thankyou';
							},
						});


					} else {
						//alert ("call else ");
						///$('#payment-tab').
						$('#address-tab').attr('aria-selected', false);
						$("#address-tab").removeClass('active');
						$("#address").removeClass('active');
						$("#address").removeClass('show');

						$("#payment-tab").addClass('active');
						$("#payment").addClass('active');
						$("#payment").addClass('show');
						$('#payment-tab').attr('aria-selected', true);
					}

				}


				/*
				  event.preventDefault();
				  var fullname = $("#name").val();
				  var mobile = $("#mobile").val();
				  var state = $("#state").val();
				  var pincode = $("#pincode").val();
				  var city = $("#city").val();
				  var email = $("#email").val();
				  var user_id = $("#user_id").val();
				  var fulladdress = $("textarea#address").val();
				  
				  

				 */
			}
		}


		$(document).on('change', '.defaultAdderess', function() {
			var address_id = $('.defaultAdderess:checked').val();
			var user_id = $('#user_id').val();
			var total_value = $("#total_value").val();
			var seller_pincode = $('#seller_pincode').val();
			var user_pincode = '';
			$.ajax({
				method: "post",
				url: site_url + "getUserAddress",
				data: {
					language: default_language,
					user_id: user_id,
					[csrfName]: csrfHash
				},
				success: function(response) {
					var parsedJSON = response.Information.address_details;

					$(parsedJSON).each(function() {
						if (address_id == this.address_id) {
							console.log(this);
							$('#lat').val(this.lat);
							$('#lng').val(this.lng);
							initMap();
							$("#fullname_a").val(this.fullname);
							$("#email").val(this.email);
							iti.setNumber(`+${this.country_code}${this.mobile}`)
							$("#fulladdress").val(this.fulladdress);
							$("#country").val($("#country option:contains('" + this.country + "')").val());
							if (this.country_id == 1) {
								$('#region-div').html(
									`<label class="form-label"><?= $this->lang->line('region'); ?></label>
									<select name="region" id="region" class="form-select">
										<option value=""><?= $this->lang->line('select_region'); ?></option>
									</select>
									<span id="error"></span>`);
								$('#governorates-div').html(
									`<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
									<select name="governorates" id="governorates" class="form-select">
									<option value=""><?= $this->lang->line('select_governorate'); ?></option>
									</select>
									<span id="error"></span>`);
								$('#area-div').html(
									`<label class="form-label"><?= $this->lang->line('area'); ?></label>
									<select name="area" id="area" class="form-select">
										<option value=""><?= $this->lang->line('select_area'); ?></option>
									</select>
									<span id="error"></span>`);
								getRegiondata($("#country").val());
								setTimeout(() => {
									$("#region").val($("#region option:contains('" + this.region + "')").val());
									getGovernoratedata($("#region").val());
									setTimeout(() => {
										$("#governorates").val($("#governorates option:contains('" + this.governorate + "')").val());
										getAreadata($("#governorates").val());
										setTimeout(() => {
											$("#area").val($("#area option:contains('" + this.area + "')").val());
										}, 400);
									}, 400);
								}, 400);
							} else {
								$('#region-div').html(
									`<label class="form-label"><?= $this->lang->line('region'); ?></label>
									<input type="text" class="form-control" id="region" name="region" value="${this.region}" />
									<span id="error"></span>`);
								$('#governorates-div').html(
									`<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
									<input type="text" class="form-control" id="governorates" name="governorates" value="${this.governorate}" />
									<span id="error"></span>`);
								$('#area-div').html(
									`<label class="form-label"><?= $this->lang->line('area'); ?></label>
									<input type="text" class="form-control" id="area" name="area" value="${this.area}" />
									<span id="error"></span>`);
							}

							user_pincode = '743144';
						}
					});
					get_checkout_data(user_pincode);
				}
			});
		});

		function place_order_data_old(event) {
			var tab = 'true';

			var address_id = $('.defaultAdderess:checked').val();
			var user_id = $('#user_id').val()
			var fullname = $("#fullname_a").val();
			var email = $("#email").val();
			var mobile = $("#mobile").val();
			var area = $("#area").val();
			var fulladdress = $("#fulladdress").val();
			var lat = $('#lat').val();
			var lng = $('#lng').val();
			var country = $("#country option:selected").text();
			var region = $('#region').is('input') ? $('#region').val() : $('#region option:selected').text();
			var governorate = $('#governorates').is('input') ? $('#governorates').val() : $('#governorates option:selected').text();
			var area = $('#area').is('input') ? $('#area').val() : $('#area option:selected').text();

			if (user_id !== '') {
				if (validateAddressForm()) {

					addUserAddress();

					var spinner = '<div class="spinner-border" role="status"><span class="se-only"></span></div> Please Wait..';
					$('.paymentMethodBtn').html(spinner);
					$(".paymentMethodBtn").prop('disabled', true);
					// alert(" place order req send ");
					var coupon_code = $('#coupon_code').val();
					var coupon_value = $('#coupo_discount_value').text();

					$.ajax({
						method: "post",
						url: site_url + "placeOrder",
						data: {
							language: default_language,
							fullname: fullname,
							mobile: mobile,
							email: email,
							area: area,
							fulladdress: fulladdress,
							country: country,
							region: region,
							governorate: governorate,
							area: area,
							lat: lat,
							lng: lng,
							addresstype: 'Home',
							payment_id: 'Pay12345',
							payment_mode: 'COD',
							coupon_code: coupon_code,
							coupon_value: coupon_value,
							[csrfName]: csrfHash,
						},
						success: function(response) {
							$(".paymentMethodBtn").prop('disabled', true);
							$('.paymentMethodBtn').text('Place Order');
							//hideloader();

							if (response.status == 1) {
								// alert(response.status);
								//location.href = site_url + "thankyou/" + order_id;

								var imgurl = $("#imgurl").val();

								var order_id = response.Information.order_id;
								var message = 'Dear *' + fullname + '* ,';
								message += ' Your Order has been placed Successfully.';

								setTimeout(function() {
									location.href = site_url + "thankyou/" + order_id;
								}, 100);

							} else {
								Swal.fire({
									position: "center",
									//icon: "success",
									title: response.Information.order_msg,
									showConfirmButton: false,
									confirmButtonColor: "#ff5400",
									timer: 3000,
								});
							}

						},
					});
				}
			}

		}

		function apply_coupon(event) {
			var total_value = $("#total_value").val();
			var coupon_code = $("#coupon_code").val();
			event.preventDefault();

			$.ajax({
				method: "post",
				url: site_url + "apply_coupon",
				data: {
					language: 1,
					coupon_code: coupon_code,
					price: "1000",
					[csrfName]: csrfHash,
				},
				success: function(response) {
					//hideloader();
					Swal.fire({
						position: "center",
						//icon: "success",
						title: response.msg,
						showConfirmButton: false,
						confirmButtonColor: "#ff5400",
						timer: 3000,
					});
					//alert(response.msg);
					//location.reload();
				},
			});
		}

		/*const addUserAddress = () => {
			$.ajax({
				method: "post",
				url: site_url + "addUserAddress",
				data: {
					language: default_language,
					username: $('#fullname_a').val(),
					email: $('#email').val(),
					country_code: '1',
					mobile: $('#mobile').val(),
					fulladdress: $('#fulladdress').val(),
					lat: $('#lat').val(),
					lng: $('#lng').val(),
					country_id: $('#country').val(),
					country: $('#country option:selected').text(),
					region_id: $('#region').is('input') ? '' : $('#region').val(),
					region: $('#region').is('input') ? $('#region').val() : $('#region option:selected').text(),
					governorate_id: $('#governorates').is('input') ? '' : $('#governorates').val(),
					governorate: $('#governorates').is('input') ? $('#governorates').val() : $('#governorates option:selected').text(),
					area_id: $('#area').is('input') ? '' : $('#area').val(),
					area: $('#area').is('input') ? $('#area').val() : $('#area option:selected').text(),
					addresstype: "home",
					[csrfName]: csrfHash,
				},
				success: function(response) {
					console.log(response);
				},
				error: function(xhr, status, error) {
					submitButton.prop("disabled", false);
					var errorMessage = "An error occurred: " + xhr.responseText;
					console.log(errorMessage);
				}
			});
		};

		const getUserAddress = (user_id) => {

			var response = $.ajax({
				method: "post",
				url: site_url + "getUserAddress",

				data: {
					language: default_language,
					user_id: user_id,
					[csrfName]: csrfHash
				},
				success: function(response) {
					// alert(response);
				}
			});
			return response;

		}*/

		$(document).ready(function() {
			$("#address_div_id").click(function() {
				event.preventDefault();
				var user_id = $('#user_id').val();
				if (user_id == '') {
					$("#address_div").toggle();
					//  document.getElementById('formoid').querySelector('#address_save_btn').style.display = 'none';
				} else {
					// location.href = site_url + 'myaddress';
					$("#address_div").toggle();
				}
			});
		});
	</script>

</body>

</html>