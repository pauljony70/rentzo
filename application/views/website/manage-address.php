<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Manage Address";
	include("include/headTag.php") ?>
	<style>
		#map,
		#edit-map {
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

		#search_address,
		#search_address1 {
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

		.pac-container {
			z-index: 99999 !important;
		}

		<?php if ($default_language == 1) : ?>.pac-container .pac-item {
			direction: rtl;
			text-align: right;
		}

		<?php endif; ?>
	</style>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?= $this->config->item('api_keys')['gmap-api-key']; ?>&libraries=places"></script>
	<link href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/css/intlTelInput.min.css" rel="stylesheet">
</head>

<body>

	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php")
	?>

	<div class="modal fade" id="editAddressModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-scrollable">
			<div class="modal-content">
				<div class="d-flex p-2 align-items-center justify-content-between border-bottom">
					<h5 class="modal-title mt-1 px-2" id="buyFromTurkeyLabel">Edit Address</h5>
					<button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
				</div>
				<div class="modal-body p-0">
					<div id="map-container">
						<div id="edit-map"></div>
						<div id="edit-current-location-control" class="custom-control"></div>
						<div id="search-container" style="z-index: 999999;">
							<input type="text" class="" id="search_address1" placeholder="Search Address" autocomplete="off">
						</div>
					</div>
					<form action="" class="form row p-2" method="post" id="editAddressForm">
						<input type="hidden" name="address_id" id="address_id" value="">
						<input type="hidden" name="edit-lat" id="edit-lat" value="">
						<input type="hidden" name="edit-lng" id="edit-lng" value="">
						<div class="col-md-12">
							<div class="form-group">
								<label><?= $this->lang->line('fullname'); ?></label>
								<input type="text" name="edit-fullname" id="edit-fullname" class="form-control">
								<span id="error"></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><?= $this->lang->line('email'); ?></label>
								<input type="text" name="edit-email" id="edit-email" class="form-control">
								<span id="error"></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><?= $this->lang->line('phone-number'); ?></label>
								<input type="text" name="edit-mobile" id="edit-mobile" class="form-control intl-tel-input">
								<span id="error"></span>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label><?= $this->lang->line('address'); ?></label>
								<input type="text" name="edit-address" id="edit-address" class="form-control">
								<span id="error"></span>
							</div>
						</div>
						<div class="col-md-6">
							<label class="form-label"><?= $this->lang->line('country'); ?></label>
							<select class="form-select" id="edit-country" name="edit-country" disabled>
								<option value=""><?= $this->lang->line('select_country'); ?></option>
								<?php foreach ($get_country['data'] as $country) : ?>
									<option value="<?= $country['id'] ?>"><?= $default_language == 1 ? $country['name_ar'] : $country['name'] ?></option>
								<?php endforeach; ?>
							</select>
							<span id="error"></span>
						</div>
						<div class="col-md-6" id="edit-region-div">
							<label class="form-label"><?= $this->lang->line('region'); ?></label>
							<input type="text" class="form-control" id="edit-region" name="edit-region" disabled />
							<span id="error"></span>
						</div>
						<div class="col-md-6" id="edit-governorates-div">
							<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
							<input type="text" class="form-control" id="edit-governorates" name="edit-governorates" disabled />
							<span id="error"></span>
						</div>
						<div class="col-md-6" id="edit-area-div">
							<label class="form-label"><?= $this->lang->line('area'); ?></label>
							<input type="text" class="form-control" id="edit-area" name="edit-area" disabled />
							<span id="error"></span>
						</div>
						<div class="form-group justify-content-center my-3">
							<button type="submit" class="btn btn-lg btn-block btn-primary text-uppercase"><span class="text-light"><?= $this->lang->line('submit'); ?></span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<main class="my-order-page checkout-page cart-page">

		<!--Start: Manage Address Section -->
		<section>
			<div class="container px-1">
				<div class="row mt-4">
					<?php
					include("include/sidebar.php");
					?>
					<div class="col-lg-8 p-1">
						<div class="left-block box-shadow-4" id="MyProfile">
							<h5 class="title"><?= $this->lang->line('user-manage-address'); ?> <span class="d-lg-none"><a class="accordion-button collapsed" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1"><?= $this->lang->line('my-profile'); ?></a></span></h5>

							<?php
							include("include/mobile_sidebar.php");
							?>

							<div class="align-items-start">
								<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

									<div class="row">

										<?php
										if (!empty($address['address_details'])) {
											$last_element = array_pop($address['address_details']);
											array_unshift($address['address_details'], $last_element);
											foreach ($address['address_details'] as $add_data) {
										?>
												<button class="nav-link mb-4 active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
													<div class="form-check address-details box-shadow-4">

														<label class="w-100">
															<div class="d-flex align-items-centermb-1">
																<?php if ($address['defaultaddress'] == $add_data['address_id']) { ?>
																	<div class="badge">Default</div>
																<?php } else { ?>
																	<div class="badge0"> </div>
																<?php } ?>

															</div>
															<ul class="name m-0 d-flex align-items-center justify-content-between">
																<li class="pe-0">
																	<h6 class="mb-0"><?php echo $add_data['fullname']; ?> </h6>
																</li>
																<div class="d-flex">
																	<a data-bs-toggle="modal" data-bs-target="#editAddressModal" data-address-id="<?= $add_data['address_id'] ?>" data-full-name="<?= $add_data['fullname'] ?>" data-email="<?= $add_data['email'] ?>" data-country-code="<?= $add_data['country_code'] ?>" data-mobile="<?= $add_data['mobile'] ?>" data-fulladdress="<?= $add_data['fulladdress'] ?>" data-lat="<?= $add_data['lat'] ?>" data-lng="<?= $add_data['lng'] ?>" data-country-id="<?= $add_data['country_id'] ?>" data-country="<?= $add_data['country'] ?>" data-region-id="<?= $add_data['region_id'] ?>" data-region="<?= $add_data['region'] ?>" data-governorate-id="<?= $add_data['governorate_id'] ?>" data-governorate="<?= $add_data['governorate'] ?>" data-area-id="<?= $add_data['area_id'] ?>" data-area="<?= $add_data['area'] ?>" class="btn btn-sm btn-success edit-address-btn <?= $default_language == 1 ? 'ms-2' : 'me-2' ?>"><span class="text-light"><i class="fa-regular fa-pen-to-square"></i> Edit</span></a>

																	<a class="btn btn-sm btn-primary text-light" onclick="delete_address(<?php echo $add_data['address_id']; ?>,'<?php echo $this->session->userdata("user_id"); ?>')"><span class="text-light"><i class="fa-regular fa-trash-can"></i> Delete</span></a>
																</div>
															</ul>

															<div class="address m-0 <?= $default_language == 1 ? 'text-end' : 'text-start' ?>">
																<h6 class="m-0"><?php echo $add_data['email'] ?>, +<?= $add_data['country_code'] . ' ' . $add_data['mobile']; ?></h6>
																<h6 class="m-0"><?php echo $add_data['fulladdress'] ?></h6>
																<h6 class="m-0"><?= $add_data['area'] . ', ' . $add_data['governorate'] . ', ' . $add_data['region'] . ', ' . $add_data['country']; ?></h6>
															</div>
															<a href="javascript:void(0);" class="btn btn-default d-none"><?= $this->lang->line('deliver-here'); ?></a>
														</label>
													</div>
												</button>
										<?php }
										} ?>

									</div>

									<a id="address_div_id" class="btn btn-light mb-4">+ <?= $this->lang->line('add-new-address'); ?></a>

									<div class="col-lg-12">
										<div class="left-block box-shadow-4">
											<h5 class="mb-5"><?= $this->lang->line('add-new-address'); ?></h5>
											<form id="formoid" action="" class="form row g-3" method="post">
												<div class="form-group">
													<div class="col-12">
														<div id="map-container">
															<div id="map"></div>
															<div id="current-location-control" class="custom-control"></div>
															<div id="search-container">
																<input type="text" class="" id="search_address" placeholder="Search Address" autocomplete="off">
															</div>
														</div>
													</div>
												</div>
												<!-- Latitude Input -->
												<input type="hidden" value="23.607506019227948" id="lat" name="lat">
												<!-- Longitude Input -->
												<input type="hidden" value="58.51290997249288" id="lng" name="lng">
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
													<label class="form-label"><?= $this->lang->line('country'); ?></label>
													<select class="form-select" id="country" name="country" disabled>
														<option value=""><?= $this->lang->line('select_country'); ?></option>
														<?php foreach ($get_country['data'] as $country) : ?>
															<option value="<?= $country['id'] ?>"><?= $default_language == 1 ? $country['name_ar'] : $country['name'] ?></option>
														<?php endforeach; ?>
													</select>
													<span id="error"></span>
												</div>
												<div class="col-md-6" id="region-div">
													<label class="form-label"><?= $this->lang->line('region'); ?></label>
													<input type="text" class="form-control" id="region" name="region" disabled />
													<span id="error"></span>
												</div>
												<div class="col-md-6" id="governorates-div">
													<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
													<input type="text" class="form-control" id="governorates" name="governorates" disabled />
													<span id="error"></span>
												</div>
												<div class="col-md-6" id="area-div">
													<label class="form-label"><?= $this->lang->line('area'); ?></label>
													<input type="text" class="form-control" id="area" name="area" disabled />
													<span id="error"></span>
												</div>
												<input type="hidden" value="<?php echo $this->session->userdata('user_id'); ?>" type="user_id" id="user_id" name="user_id">
												<?php if (!empty($this->session->userdata("user_id"))) { ?>
													<div class="col-md-12 text-center">
														<button type="submit" id="submit" name="submit" class="btn btn-lg btn-block btn-default text-uppercase">
															<div class="pt-1">
																<?= $this->lang->line('save'); ?>
															</div>
														</button>
													</div>
												<?php } ?>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--End: Manage Address Section -->

	</main>

	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>
	<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/intlTelInput.min.js"></script>
	<script src="<?= base_url('assets_web/js/app/gmap.js') ?>"></script>
	<script>
		var csrfName = $(".txt_csrfname").attr("name"); //
		var csrfHash = $(".txt_csrfname").val(); // CSRF hash
		var site_url = $(".site_url").val(); // CSRF hash
		var selected_state = '';
		var selected_city = '';

		$("#address_div").toggle();

		$(document).ready(function() {
			$("#address_div_id").click(function() {
				event.preventDefault();
				$("#address_div").toggle();
			});
		});

		$("#formoid").submit(function(event) {
			event.preventDefault();
			var submitButton = $(this).find(":submit");
			submitButton.prop("disabled", true);
			if (validateAddressForm()) {
				var iti = window.intlTelInputGlobals.getInstance(document.getElementById('mobile'));
				var selectedCountryData = iti.getSelectedCountryData();
				var countryCode = selectedCountryData.dialCode;
				$.ajax({
					method: "post",
					url: site_url + "addUserAddress",
					data: {
						language: default_language,
						username: $('#fullname_a').val(),
						email: $('#email').val(),
						country_code: countryCode,
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
						if (response.status) {
							location.reload();
						} else {
							Swal.fire({
								title: 'FAILED',
								text: response.msg,
								type: "error",
								confirmButtonColor: '#ff6600',
								showCloseButton: true
							}).then((res) => {
								location.reload();
							});
						}
					},
					error: function(xhr, status, error) {
						submitButton.prop("disabled", false);
						var errorMessage = "An error occurred: " + xhr.responseText;
						console.log(errorMessage);
					}
				});
			} else {
				submitButton.prop("disabled", false);
			}
		});

		function delete_address(address_id, user_id) {

			Swal.fire({
				text: 'Are you Sure to Delete Address?',
				type: "warning",
				showCancelButton: true,
				showCloseButton: true,
				confirmButtonColor: '#f48120'
			}).then((res) => {
				if (res.value) {
					$.ajax({
						method: 'post',
						url: site_url + 'deleteUserAddress',
						data: {
							language: 1,
							address_id: address_id,
							user_id: user_id,
							[csrfName]: csrfHash
						},
						success: function(response) {
							location.reload();
						}
					});

				}
			})
		}

		document.querySelectorAll('.edit-address-btn').forEach(function(button) {
			button.addEventListener('click', function() {
				$('#edit-current-location-control').empty();
				initEditMap(this.dataset.lat, this.dataset.lng);
				var editMobile = document.querySelector("#edit-mobile");
				var iti2 = window.intlTelInputGlobals.getInstance(editMobile);
				if (iti2) {
					iti2.destroy();
				}
				iti2 = window.intlTelInput(editMobile, {
					onlyCountries: ["om", "bh", "kw", "qa", "sa", "ae"],
					separateDialCode: true,
					utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/utils.js"
				});
				iti2.setNumber(`+${this.dataset.countryCode}${this.dataset.mobile}`)
				$('#address_id').val(this.dataset.addressId);
				$('#edit-lat').val(this.dataset.lat);
				$('#edit-lng').val(this.dataset.lng);
				$("#edit-fullname").val(this.dataset.fullName);
				$("#edit-email").val(this.dataset.email);
				$("#edit-mobile").val(this.dataset.mobile);
				$("#edit-address").val(this.dataset.fulladdress);
				// $("#edit-country").val($("#edit-country option:contains('" + this.dataset.country + "')").val());
				$("#edit-country").val(this.dataset.countryId);
				if (this.dataset.countryId == 1) {
					$('#edit-region-div').html(
						`<label class="form-label"><?= $this->lang->line('region'); ?></label>
						<select name="edit-region" id="edit-region" class="form-select">
							<option value=""><?= $this->lang->line('select_region'); ?></option>
						</select>
						<span id="error"></span>`);
					$('#edit-governorates-div').html(
						`<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
						<select name="edit-governorates" id="edit-governorates" class="form-select">
							<option value=""><?= $this->lang->line('select_governorate'); ?></option>
						</select>
						<span id="error"></span>`);
					$('#edit-area-div').html(
						`<label class="form-label"><?= $this->lang->line('area'); ?></label>
						<select name="edit-area" id="edit-area" class="form-select">
							<option value=""><?= $this->lang->line('select_area'); ?></option>
						</select>
						<span id="error"></span>`);
					getEditRegiondata(this.dataset.countryId);
					getEditGovernoratedata(this.dataset.regionId);
					getEditAreadata(this.dataset.governorateId);
					$('#edit-region').on('change', function() {
						getEditGovernoratedata(this.value);
					});
					$('#edit-governorates').on('change', function() {
						getEditAreadata(this.value);
					});
					setTimeout(() => {
						$("#edit-region").val(this.dataset.regionId);
						$("#edit-governorates").val(this.dataset.governorateId);
						$("#edit-area").val(this.dataset.areaId);
					}, 1000);
				} else {
					$('#edit-region-div').html(
						`<label class="form-label"><?= $this->lang->line('region'); ?></label>
						<input type="text" class="form-control" id="edit-region" name="edit-region" value="${this.dataset.region}" />
						<span id="error"></span>`);
					$('#edit-governorates-div').html(
						`<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
						<input type="text" class="form-control" id="edit-governorates" name="edit-governorates" value="${this.dataset.governorate}" />
						<span id="error"></span>`);
					$('#edit-area-div').html(
						`<label class="form-label"><?= $this->lang->line('area'); ?></label>
						<input type="text" class="form-control" id="edit-area" name="edit-area" value="${this.dataset.area}" />
						<span id="error"></span>`);
				}
			});
		});

		$("#editAddressForm").submit(function(event) {
			event.preventDefault();
			var submitButton = $(this).find(":submit");
			submitButton.prop("disabled", true);
			if (validateEditAddressForm()) {
				var iti = window.intlTelInputGlobals.getInstance(document.getElementById('edit-mobile'));
				var selectedCountryData = iti.getSelectedCountryData();
				var countryCode = selectedCountryData.dialCode;
				var address_id = $('#address_id').val();
				var fullname = $("#edit-fullname").val();
				var email = $("#edit-email").val();
				var mobile = $("#edit-mobile").val();
				var fulladdress = $("#edit-address").val();
				var lat = $('#edit-lat').val();
				var lng = $('#edit-lng').val();
				var country_id = $('#edit-country').val();
				var country = $('#edit-country option:selected').text();
				var region_id = $('#edit-region').is('input') ? '' : $('#edit-region').val();
				var region = $('#edit-region').is('input') ? $('#edit-region').val() : $('#edit-region option:selected').text();
				var governorate_id = $('#edit-governorates').is('input') ? '' : $('#edit-governorates').val();
				var governorate = $('#edit-governorates').is('input') ? $('#edit-governorates').val() : $('#edit-governorates option:selected').text();
				var area_id = $('#edit-area').is('input') ? '' : $('#edit-area').val();
				var area = $('#edit-area').is('input') ? $('#edit-area').val() : $('#edit-area option:selected').text();

				$.ajax({
					method: "post",
					url: site_url + "editUserAddress",
					data: {
						language: default_language,
						address_id: address_id,
						username: fullname,
						email: email,
						country_code: countryCode,
						mobile: mobile,
						fulladdress: fulladdress,
						lat: lat,
						lng: lng,
						country_id: country_id,
						country: country,
						region_id: region_id,
						region: region,
						governorate_id: governorate_id,
						governorate: governorate,
						area_id: area_id,
						area: area,
						addresstype: "home",
						[csrfName]: csrfHash,
					},
					success: function(response) {
						// alert(response);
						location.reload();
					},
					error: function(xhr, status, error) {
						submitButton.prop("disabled", false);
						var errorMessage = "An error occurred: " + xhr.responseText;
						console.log(errorMessage);
					}
				});
			} else {
				submitButton.prop("disabled", false);
			}
		});

		var filtersContainer = document.querySelector('.right-block');
		// Initialize lastScrollTop variable to track previous scroll position
		var lastScrollTop = 0;
		// Calculate the initial positions of the filtersContainer
		const calculateFilterContainerPositions = () => {
			var viewportHeight = window.innerHeight;
			var filtersContainerHeight = filtersContainer.offsetHeight;
			var currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
			var scrollBottom = document.documentElement.scrollHeight - (currentScrollTop + viewportHeight);
			var topPosition = '-' + (filtersContainerHeight - viewportHeight) + 'px';

			if (currentScrollTop > lastScrollTop && scrollBottom > 0) {
				// Scrolling downwards
				filtersContainer.style.cssText = `top: ${topPosition};`;
			} else if (currentScrollTop < lastScrollTop || currentScrollTop === 0) {
				// Scrolling upwards or at the top
				filtersContainer.style.cssText = `bottom: ${topPosition};`;
			}

			lastScrollTop = currentScrollTop;
		};

		// Call the calculation function initially and on window scroll
		window.addEventListener('scroll', calculateFilterContainerPositions);
		window.addEventListener('load', calculateFilterContainerPositions);
		window.addEventListener('resize', calculateFilterContainerPositions);
	</script>
</body>

</html>