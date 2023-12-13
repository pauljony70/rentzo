<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Manage Address";
	include("include/headTag.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/manage-address.css') ?>">
</head>

<body>

	<?php include("include/topbar.php") ?>
	<?php include("include/navbar.php") ?>

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
		<section class="my-5">
			<div class="container">
				<div class="d-flex mb-4 mb-md-5">
					<div class="page-heading">Address</div>
					<img src="<?= base_url('assets_web/images/icons/chevron-right.svg') ?>" alt="chevron-right" srcset="" class="ms-4">
				</div>

				<?php
				if (!empty($address['address_details'])) :
					foreach ($address['address_details'] as $add_data) :
				?>
						<div class="adresss-div d-flex justify-content-between">
							<!-- <ul class="name m-0 d-flex justify-content-between mb-1">
								<li class="pe-2">
									<h6><?= $add_data['fullname']; ?>, </h6>
								</li>
								<div class="d-flex">
									<a data-bs-toggle="modal" data-bs-target="#editAddressModal" data-address-id="<?= $add_data['address_id'] ?>" data-full-name="<?= $add_data['fullname'] ?>" data-email="<?= $add_data['email'] ?>" data-mobile="<?= $add_data['mobile'] ?>" data-pincode="<?= $add_data['pincode'] ?>" data-fulladdress="<?= $add_data['fulladdress'] ?>" data-state-id="<?= $add_data['state'] ?>" data-city-id="<?= $add_data['city_id'] ?>" class="btn btn-sm btn-success edit-address-btn me-2 btn-radious"><span class="text-light"><i class="fa-regular fa-pen-to-square "></i> Edit</span></a>

									
								</div>
							</ul> -->

							<div class="address">
								<div class="name"><?= $add_data['fullname']; ?></div>
								<div class="fulladdress"><?= $add_data['fulladdress'] ?></div>
								<div class="fulladdress"><?= $add_data['city'] ?>, <?= $add_data['state'] ?>, India, <?= $add_data['pincode'] ?></div>
								<div class="email d-flex">
									<div class="heading">Email - &nbsp;</div>
									<div class="des"><?= $add_data['email'] ?></div>
								</div>
								<div class="mobile d-flex">
									<div class="heading">Mobile - &nbsp;</div>
									<div class="des"><?= $add_data['mobile'] ?></div>
								</div>
							</div>
							<div class="action-button d-flex flex-column">
								<a class="btn delete-address-btn mb-4 ms-auto" onclick="delete_address(<?= $add_data['address_id']; ?>,'<?= $this->session->userdata('user_id'); ?>')">DELETE</a>
								<a data-bs-toggle="modal" data-bs-target="#editAddressModal" data-address-id="<?= $add_data['address_id'] ?>" data-full-name="<?= $add_data['fullname'] ?>" data-email="<?= $add_data['email'] ?>" data-mobile="<?= $add_data['mobile'] ?>" data-pincode="<?= $add_data['pincode'] ?>" data-fulladdress="<?= $add_data['fulladdress'] ?>" data-state-id="<?= $add_data['state_id'] ?>" data-city-id="<?= $add_data['city_id'] ?>" class="btn edit-address-btn ms-auto">EDIT</a>
							</div>
						</div>
						<hr class="my-4">
				<?php endforeach;
				endif; ?>

				<a id="address_div_id" class="btn ps-0 my-5" data-bs-toggle="collapse" href="#address-form" role="button" aria-expanded="false" aria-controls="address-form"><i class="fa-solid fa-plus"></i> <span class="ms-3">Add a New Address</span></a>

				<div class="address-form collapse" id="address-form">
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
									<option value="">Select City</option>
									<?php foreach ($get_city as $city_data) { ?>
										<option <?= $this->session->userdata('city_id') == $city_data['city_id'] ? 'selected' : '' ?> value="<?= $city_data['city_id']; ?>"><?= $city_data['city_name']; ?></option>
									<?php } ?>
								</select>
								<span id="error"></span>
							</div>
						</div>

						<input type="hidden" value="<?= $this->session->userdata('user_id'); ?>" type="user_id" id="user_id" name="user_id">

						<div class="col-md-12">
							<?php if (!empty($this->session->userdata("user_id"))) { ?>
								<button type="submit" id="submit" name="submit" class="btn btn-primary mt-3">SAVE</button>
							<?php } ?>
						</div>
					</form>
				</div>
			</div>
		</section>
		<!--End: Manage Address Section -->

	</main>

	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>
	<script>
		// $(document).ready(function() {
		// 	$("#address_div_id").click(function() {
		// 		event.preventDefault();
		// 		$("#address_div").toggle();
		// 	});
		// });

		var selected_state = '';
		var selected_city = '';

		$(function() {
			window.onload = getStatedata(selected_state);
		});

		function delete_address(address_id, user_id) {

			Swal.fire({
				text: 'Are you Sure to Delete Address? Once deleted can not be reversed.',
				type: "warning",
				showCancelButton: true,
				showCloseButton: true,
			}).then(function(res) {
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
			});
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
						//  successmsg('<?= "some info"; ?>');
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
					var o = new Option("Select City", "");
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

		$("#formoid").submit(async function(event) {
			event.preventDefault();
			var submitBtn = document.getElementById('formoid').querySelector("button[type='submit']");
			submitBtn.disabled = true;
			buttonLoader(submitBtn);
			try {
				await validateAddressForm();

				setTimeout(() => {
					$.ajax({
						method: "post",
						url: site_url + "addUserAddress",
						data: {
							language: default_language,
							username: $("#fullname_a").val(),
							mobile: $("#mobile").val(),
							pincode: $("#pincode").val(),
							locality: "",
							fulladdress: $("#fulladdress").val(),
							state: $('#state').find(":selected").text(),
							city: $('#city').find(":selected").text(),
							addresstype: "home",
							email: $("#email").val(),
							city_id: $("#city").val(),
							state_id: $("#state").val(),
							[csrfName]: csrfHash,
						},
						success: function(response) {
							location.reload();
						},
					});
				}, 1000);
			} catch (error) {
				// At least one of the functions failed
				// console.error('Error:', error);
				setTimeout(() => {
					submitBtn.disabled = false;
					submitBtn.innerHTML = "SAVE"
				}, 500);
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
			var state_id = $("#edit-state option:selected").val();


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
					state: $('#edit-state').find(":selected").text(),
					city: $('#edit-city').find(":selected").text(),
					addresstype: "home",
					email: email,
					city_id: city_id,
					state_id: state_id,
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