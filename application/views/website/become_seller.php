<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Become a Seller";
	include("include/headTag.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets_web/libs/dropify/dist/css/dropify.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/become-seller.css') ?>">
</head>

<body>

	<?php include("include/navbar-brand.php") ?>

	<main class="become-seller-page container">

		<!--Start: Become a Seller Section -->
		<section class="become-seller box-shadow-4 p-0 py-5 p-sm-5">
			<div class="container">

				<?php if (!empty($this->session->flashdata("seller_form_msg"))) : ?>
					<div class="alert alert-success alert-dismissible fade show text-start" role="alert">
						<?= $this->session->flashdata("seller_form_msg");  ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>
				<div class="row">
					<div class="wrap">
						<h4>Become a Seller</h4>
						<p>Fill all form field to go to next step</p>
					</div>


					<form class="form" action="add_seller" id="add_seller" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

						<!-- progressbar -->
						<ul id="progressbar" class="d-none d-lg-block">
							<li class="active" id="email">Seller Information</li>
							<li id="account">Shop Description</li>
							<li id="personal">Personal Info.</li>
							<li id="document">Documents Upload</li>
							<li id="confirm">Finish</li>
						</ul>
						<div class="progress d-lg-none">
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<!-- fieldsets -->
						<fieldset>
							<div class="row g-3" id="seller_form">
								<div class="col-7">
									<h6 class="text-start">Seller Information:</h6>
								</div>
								<div class="col-5">
									<h6 class="text-end">Step 1 - 5</h6>
								</div>

								<div class="col-md-12">
									<label class="form-label">Business Type :</label>
									<select class="form-select" id="business_type" name="business_type" aria-label="Default select example">
										<option value="">-- Select business type --</option>
										<option value="Individual">Individual</option>
										<option value="Company">Company</option>
									</select>
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label">Seller Name :</label>
									<input type="text" class="form-control" id="seller_name" name="seller_name" required />
									<span id="error"></span>
								</div>
								<div class="col-md-12 d-none">
									<label class="form-label">Shop Name :</label>
									<input type="text" class="form-control" id="business_name" name="business_name" required />
									<span id="error"></span>
								</div>
								<div class="col-md-12 d-none">
									<label class="form-label">Shop Address :</label>
									<textarea class="form-control" rows="5" id="business_address" name="business_address" required></textarea>
									<span id="error"></span>
								</div>
								<div class="col-md-12 d-none">
									<label class="form-label">Shop Details :</label>
									<textarea class="form-control" rows="5" id="business_details" name="business_details" required></textarea>
									<span id="error"></span>
								</div>

							</div>
							<button type="button" class="seller_form btn btn-primary">Next</button>
						</fieldset>
						<fieldset>
							<div class="row g-3" id="seller_desc">
								<div class="col-7">
									<h6 class="text-start">Personal Info.</h6>
								</div>
								<div class="col-5">
									<h6 class="text-end">Step 2 - 5</h6>
								</div>

								<div class="col-md-12">
									<label class="form-label">Select State:</label>
									<select name="state" id="state" required class="form-select">
										<option value="">Select State</option>
									</select>
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label">Select City:</label>
									<select name="city" id="city" required class="form-select">
										<option value="">Select City</option>
									</select>
									<span id="error"></span>
								</div>
								<div class="col-md-12" id="pincode-div">
									<label class="form-label">Pincode</label>
									<input type="number" class="form-control" id="pincode" name="pincode" oninput="enforceMaxLength(this)" maxlength="6" />
									<span id="error"></span>
								</div>
							</div>
							<button type="button" class="previous btn btn-secondary">Previous</button>
							<button type="button" class="seller_desc btn btn-primary">Next</button>
						</fieldset>
						<fieldset>
							<div class="row g-3" id="seller_info">
								<div class="col-7">
									<h6 class="text-start">Personal Info. :</h6>
								</div>
								<div class="col-5">
									<h6 class="text-end">Step 3 - 5</h6>
								</div>

								<div class="col-md-12">
									<label class="form-label">Phone Number:</label>
									<input type="number" class="form-control" id="seller_phone" maxlength="10" required oninput="enforceMaxLength(this)"" name=" seller_phone" />
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label">Phone OTP:</label>
									<div class="input-group">
										<input type="number" class="form-control" id="phone_otp" maxlength="6" required oninput="enforceMaxLength(this)"" name=" phone_otp" />
										<button class="btn btn-outline-secondary mt-0" type="button" id="send-phone-otp-btn">Get OTP</button>
										<span id="error"></span>
									</div>
								</div>
								<div class="col-md-12">
									<label class="form-label">Email:</label>
									<input type="text" class="form-control" id="seller_email" maxlength="30" required name="seller_email" />
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label">Email OTP:</label>
									<div class="input-group">
										<input type="mumber" class="form-control" id="email_otp" maxlength="6" required oninput="enforceMaxLength(this)"" name=" email_otp" />
										<button class="btn btn-outline-secondary mt-0" type="button" id="send-email-otp-btn">Get OTP</button>
										<span id="error"></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-check text-start">
										<input class="form-check-input" type="checkbox" value="" id="social_media_handle">
										<label class="form-check-label" for="social_media_handle">
											Do you have social media handles or website?
										</label>
									</div>
								</div>

								<div class="col-md-12 social-media-handle d-none">
									<label class="form-label">Website link:</label>
									<input type="text" class="form-control" id="website_link" name="website_link" />
									<span id="error"></span>
								</div>
								<div class="col-md-12 social-media-handle d-none">
									<label class="form-label">Facebook link:</label>
									<input type="text" class="form-control" id="facebook_link" name="facebook_link" />
									<span id="error"></span>
								</div>
								<div class="col-md-12 social-media-handle d-none">
									<label class="form-label">Instagram link:</label>
									<input type="text" class="form-control" id="instagram_link" name="instagram_link" />
									<span id="error"></span>
								</div>

								<div class="col-md-12">
									<label class="form-label">Password:</label>
									<input type="password" id="password" maxlength="30" name="password" required class="form-control" />
									<span id="error"></span>
								</div>

							</div>
							<button type="button" class="previous btn btn-secondary">Previous</button>
							<button type="button" class="seller_info btn btn-primary">Next</button>
						</fieldset>
						<fieldset>
							<div class="row g-3" id="seller_doc">
								<div class="col-7">
									<h6 class="text-start">Personal Info. :</h6>
								</div>
								<div class="col-5">
									<h6 class="text-end">Step 4 - 5</h6>
								</div>

								<div class="col-md-12">
									<label class="form-label">Upload Business Logo:</label>
									<input type="file" name="business_logo" id="business_logo" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png pdf" />
									<div id="error" class="text-start"></div>
								</div>
								<div class="col-md-12">
									<label class="form-label">Upload Aadhaar Card:</label>
									<input type="file" name="aadhar_card" id="aadhar_card" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png pdf" />
									<div id="error" class="text-start"></div>
								</div>
								<div class="col-md-12">
									<label class="form-label">Upload Pan Card:</label>
									<input type="file" name="pan_card" id="pan_card" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png pdf" />
									<div id="error" class="text-start"></div>
								</div>
								<div class="col-md-12">
									<label class="form-label">GST Certificate:</label>
									<input type="file" name="gst_certificate" id="gst_certificate" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png pdf" />
									<div id="error" class="text-start"></div>
								</div>
							</div>
							<button type="button" href="#" class="previous btn btn-secondary">Previous</button>
							<button class="btn btn-primary submit" name="submit" type="button">Submit</button>

						</fieldset>
						<fieldset>
							<div class="row g-3">
								<div class="col-7">
									<h6 class="text-start">Finish:</h6>
								</div>
								<div class="col-5">
									<h6 class="text-end">Step 5 - 5</h6>
								</div>
								<img src="<?php echo base_url() ?>/assets_web/images/icons/thanks-icon.png" class="success-img" />
								<h4>SUCCESS !</h4>
								<h6>Thank you, your application is in process. Our team will contact you shortly.</h6>
								<h6>Thanks.</h6>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</section>
		<!--End: Become a Seller Section -->

	</main>

	<?php include("include/footer.php") ?>

	<?php include("include/script.php") ?>

	<!-- Plugin JS -->
	<script src="<?php echo base_url(); ?>assets_web/libs/dropify/dist/js/dropify.min.js"></script>

	<script src="<?php echo base_url() ?>assets_web/js/app/become-seller.js"></script>
</body>

</html>