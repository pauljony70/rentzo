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
		<div class="modal-dialog modal-lg  modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
					<button type="button" class="btn-close btn-radious" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pb-0">
					<form action="" class="form row" method="post" id="editAddressForm">
						<input type="hidden" name="address_id" id="address_id" value="">
						<div class="col-md-6">
							<div class="form-group">
								<label>Full name</label>
								<input type="text" name="edit-fullname" id="edit-fullname" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Email</label>
								<input type="text" name="edit-email" id="edit-email" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone no</label>
								<input type="text" name="edit-mobile" id="edit-mobile" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Pincode</label>
								<input type="text" name="edit-pincode" id="edit-pincode" class="form-control">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Address</label>
								<input type="text" name="edit-address" id="edit-address" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>State</label>
								<select class="form-control" id="edit-state" name="edit-state">
									<option value="">Select State</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>City</label>
								<select class="form-control" id="edit-city" name="edit-city">
									<option value="">Select City</option>
								</select>
							</div>
						</div>
						<div class="form-group my-3">
							<div class="text-end">
								<button type="submit" class="btn btn-primary btn-radious"><span class="text-light">Submit</span></button>
							</div>
						</div>
					</form>
				</div>
				<!-- <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div> -->
			</div>
		</div>
	</div>

	<main class="my-order-page checkout-page cart-page">

		<!--Start: Manage Address Section -->
		<section>
			<div class="container" style="max-width:1344px;">
				<div class="row">
					<?php
					include("include/sidebar.php");
					?>
					<div class="col-lg-8">
						<div class="left-block box-shadow0" id="MyProfile">
							<h5 class="title">Manage Addresses <span class="d-lg-none"><a class="accordion-button collapsed" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">My Profile</a></span></h5>

							<?php
							include("include/mobile_sidebar.php");
							?>

							<div class="align-items-start">
								<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

									<div class="row">

										<?php
										if(!empty($address['address_details'])) {
										$last_element = array_pop($address['address_details']);
										array_unshift($address['address_details'], $last_element);
										foreach ($address['address_details'] as $add_data) {
										?>
											<button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
												<div class="form-check address-details box-shadow">

													<label class="form-check-label w-100 ps-5">
														<div class="d-flex align-items-center justify-content-between">
															<?php if ($address['defaultaddress'] == $add_data['address_id']) { ?>
																<div class="badge btn-radious">Default</div>
															<?php } else { ?>
																<div class="badge0"> </div>
															<?php } ?>

														</div>
														<ul class="name m-0 d-flex justify-content-between mb-1">
															<li class="pe-2">
																<h6><?php echo $add_data['fullname']; ?>, </h6>
															</li>
															<div class="d-flex">
																<a data-bs-toggle="modal" data-bs-target="#editAddressModal" data-address-id="<?= $add_data['address_id'] ?>" data-full-name="<?= $add_data['fullname'] ?>" data-email="<?= $add_data['email'] ?>" data-mobile="<?= $add_data['mobile'] ?>" data-pincode="<?= $add_data['pincode'] ?>" data-fulladdress="<?= $add_data['fulladdress'] ?>" data-state-id="<?= $add_data['state'] ?>" data-city-id="<?= $add_data['city_id'] ?>" class="btn btn-sm btn-success edit-address-btn me-2 btn-radious"><span class="text-light"><i class="fa-regular fa-pen-to-square "></i> Edit</span></a>

																<a class="btn btn-sm btn-primary text-light btn-radious" onclick="delete_address(<?php echo $add_data['address_id']; ?>,'<?php echo $this->session->userdata("user_id"); ?>')"><span class="text-light"><i class="fa-regular fa-trash-can"></i> Delete</span></a>
															</div>
														</ul>

														<div class="address m-0">
															<h6 class="m-0"><?php echo $add_data['email'] . $add_data['mobile']; ?>, </h6>
															<h6 class="m-0"><?php echo $add_data['fulladdress'] ?></h6>
															<h6 class="m-0"><?= $add_data['state_name'] . ', ' . $add_data['city'] . ', ' . $add_data['pincode']; ?></h6>
														</div>
														<a href="javascript:void(0);" class="btn btn-default d-none">Deliver here</a>
													</label>
												</div>
											</button>
										<?php }  } ?>

									</div>






									<a id="address_div_id" class="btn btn-light">+ Add a New Address</a>

									<div class="col-lg-12">
										<div class="left-block box-shadow">
											<h5 class="mb-5">Add New Address</h5>
											<form id="formoid" action="" class="form row g-3" method="post">

												<div class="col-md-6">
													<label class="form-label">Full Name</label>
													<input type="text" class="form-control" id="fullname_a" name="name" placeholder="Full Name" />
													<span id="fullname1_error" style="color:red;"></span>

												</div>
												<div class="col-md-6">
													<label class="form-label">Email</label>
													<input type="email" class="form-control" id="email" maxlength="30" name="email" placeholder="Email" />
													<span id="emails_error" style="color:red;"></span>
												</div>
												<div class="col-md-6">
													<label class="form-label">Phone no</label>
													<input type="text" class="form-control" id="mobile" maxlength="10" onkeypress="return AllowOnlyNumbers(event);" name="mobile" placeholder="Phone no" />
													<span id="mobile_error" style="color:red;"></span>
												</div>
												<div class="col-md-6">
													<label class="form-label">Pin Code</label>
													<input type="text" class="form-control" id="pincode" name="pincode" maxlength="6" onkeypress="return AllowOnlyNumbers(event);" placeholder="Pin Code" />
												</div>


												<div class="col-md-12">
													<label class="form-label">Address</label>
													<input type="text" class="form-control" id="fulladdress" name="address" placeholder="Address 1" />
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
													<select name="city" id="city" onchange="get_checkout_data()" class="form-control">

														<option>Select City</option>

														<?php foreach ($get_city as $city_data) { ?>

															<option <?php if ($this->session->userdata('city_id') == $city_data['city_id']) {
																		echo 'selected';
																	} ?> value="<?php echo $city_data['city_id']; ?>"><?php echo $city_data['city_name']; ?></option>

														<?php } ?>

													</select>
												</div>
												<span id="city_error" style="color:red;"></span>
												<input type="hidden" value="<?php echo $this->session->userdata('user_id'); ?>" type="user_id" id="user_id" name="user_id">
												<?php if (!empty($this->session->userdata("user_id"))) { ?>
													<div class="col-md-12 text-center">
														<button type="submit" id="submit" name="submit" class="btn btn-primary btn-radious">SAVE</button>
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

			</div>
			</div>
		</section>
		<!--End: Manage Address Section -->

	</main>

	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?> 
	<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/intlTelInput.min.js"></script>
	<script>
		$("#address_div").toggle();
		$(document).ready(function() {
			$("#address_div_id").click(function() {
				event.preventDefault();
				$("#address_div").toggle();
			});
		});

		var csrfName = $(".txt_csrfname").attr("name"); //
		var csrfHash = $(".txt_csrfname").val(); // CSRF hash
		var site_url = $(".site_url").val(); // CSRF hash
		var selected_state = '';
		var selected_city = '';

		$(function() {
			window.onload = getStatedata(selected_state);
		});

		function delete_address(address_id, user_id) {

			Swal.fire({
				position: "center",
				title: 'Are you Sure to Delete Address?',
				showConfirmButton: true,
				showCancelButton: true,
				confirmButtonText: 'Confirm',
				cancelButtonText: 'Cancel',
				confirmButtonColor: '#f42525'
			}).then((result) => {
				if (result.isConfirmed) {
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

		$('#state').on('change', function() {
			getCitydata(this.value, selected_city);
		});

		$('#edit-state').on('change', function() {
			getCitydata(this.value, selected_city);
		});

		document.querySelectorAll('.edit-address-btn').forEach(function(button) {
			button.addEventListener('click', function() {
				console.log(this.dataset);
				$('#address_id').val(this.dataset.addressId);
				$("#edit-fullname").val(this.dataset.fullName);
				$("#edit-email").val(this.dataset.email);
				$("#edit-mobile").val(this.dataset.mobile);
				$("#edit-pincode").val(this.dataset.pincode);
				$("#edit-address").val(this.dataset.fulladdress);
				getStatedata(this.dataset.stateId);
				getCitydata(this.dataset.stateId, this.dataset.cityId);
			});
		});

		function getStatedata(selected_state) {
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
							} else {
								var o = new Option(this.name, this.id);
								$("#state").append(o);
								if (this.id === selected_state) {
									$("#edit-state").append(`<option value="${this.id}" selected>${this.name}</option>`)
								} else {
									$("#edit-state").append(`<option value="${this.id}">${this.name}</option>`)
								}
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

		function getCitydata(stateid, selected_city) {
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
					document.getElementById('edit-city').innerHTML = '<option value="">Select city</option>'
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
								$("#edit-city").append(`<option value="${this.id}">${this.name}</option>`);
							}
							//	var o = new Option(this.name, this.id);
							//   $("#selectcity").append(o);
							// pass PHP variable declared above to JavaScript variable

						});
						$('#edit-city').val(selected_city);

					} else {
						successmsg(data["msg"]);
					}
				}
			});
		}

		$("#formoid").submit(function(event) {
			event.preventDefault();

			var fullname = $("#fullname_a").val();
			var mobile = $("#mobile").val();
			var state = $("#state").val();
			var pincode = $("#pincode").val();
			var city = $("#city").val();
			var email = $("#email").val();
			var fulladdress = $("#fulladdress").val();
			var city_id = $("#city option:selected").val();

			if (fullname == "" || fullname == null) {
				$("#fullname1_error").text("Please Add Name.");
			} else if (mobile == "" || mobile == null) {
				$("#mobile_error").text("Please Add Mobile No.");
			} else if (state == "" || state == null) {
				$("#state_error").text("Please Select State.");
			} else if (pincode == "" || pincode == null) {
				alert('please Add Pincode.');
			} else if (city == "" || city == null) {
				$("#city_error").text("Please Select City.");
			} else if (email == "" || email == null) {
				$("#emails_error").text("Please Add CiEmailty.");
			} else if (fulladdress == "" || fulladdress == null) {
				$("#fulladdress_error").text("Please Add Full Address.");
			} else {

				$.ajax({
					method: "post",
					url: site_url + "addUserAddress",
					data: {
						language: default_language,
						username: fullname,
						mobile: mobile,
						pincode: pincode,
						locality: "",
						fulladdress: fulladdress,
						state: state,
						city: $('#city').find(":selected").text(),
						addresstype: "home",
						email: email,
						city_id: city_id,
						[csrfName]: csrfHash,
					},
					success: function(response) {
							location.reload();
					},
				});
			}
		});

		$("#editAddressForm").submit(function(event) {
			event.preventDefault();

			var address_id = $('#address_id').val();
			var fullname = $("#edit-fullname").val();
			var mobile = $("#edit-mobile").val();
			var state = $("#edit-state").val();
			var pincode = $("#edit-pincode").val();
			var city = $("#edit-city").val();
			var email = $("#edit-email").val();
			var fulladdress = $("#edit-address").val();
			var city_id = $("#edit-city option:selected").val();


			$.ajax({
				method: "post",
				url: site_url + "editUserAddress",
				data: {
					language: default_language,
					address_id: address_id,
					username: fullname,
					mobile: mobile,
					pincode: pincode,
					locality: "",
					fulladdress: fulladdress,
					state: state,
					city: $('#edit-city').find(":selected").text(),
					addresstype: "home",
					email: email,
					city_id: city_id,
					[csrfName]: csrfHash,
				},
				success: function(response) {
					// alert(response);
					location.reload();
				},
			});
		});
	</script>
</body>

</html>