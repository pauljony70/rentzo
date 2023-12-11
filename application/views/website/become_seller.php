<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Become a Seller";
	include("include/headTag.php") ?>
	<link href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/css/intlTelInput.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/become-seller.css') ?>">
	<style>
		<?php if ($default_language == 1) : ?>#error {
			float: right;
			text-align: right;
		}

		.form-label {
			float: right !important;
		}

		#send-phone-otp-btn,
		#send-email-otp-btn {
			border-top-left-radius: 3px;
			border-bottom-left-radius: 3px;
		}

		<?php else : ?>#error {
			float: left;
			text-align: left;
		}

		#send-phone-otp-btn,
		#send-email-otp-btn {
			border-top-right-radius: 3px;
			border-bottom-right-radius: 3px;
		}

		<?php endif; ?>.intl-tel-input,
		.iti--separate-dial-code {
			width: 100%;
		}

		.iti__country-list {
			border-radius: 3px;
		}

		.iti-mobile .iti--container {
			display: flex;
			align-items: center;
			justify-content: center;
		}
	</style>
</head>

<body>

	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php")
	?>

	<main class="become-seller-page">

		<!--Start: Become a Seller Section -->
		<section class="become-seller box-shadow-4 p-0 py-5 p-sm-5">
			<div class="container px-1">

				<?php if (!empty($this->session->flashdata("seller_form_msg"))) : ?>
					<div class="alert alert-success alert-dismissible fade show text-start" role="alert">
						<?= $this->session->flashdata("seller_form_msg");  ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>
				<div class="row">
					<div class="wrap">
						<h4><?= $this->lang->line('become-a-seller'); ?></h4>
						<p><?= $this->lang->line('sub_heading'); ?></p>
					</div>


					<form class="form" action="add_seller" id="add_seller" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

						<!-- progressbar -->
						<ul id="progressbar" class="d-none d-lg-block">
							<li class="active" id="email"><?= $this->lang->line('list_item_1'); ?></li>
							<li id="account"><?= $this->lang->line('list_item_2'); ?></li>
							<li id="personal"><?= $this->lang->line('list_item_3'); ?></li>
							<li id="document"><?= $this->lang->line('list_item_4'); ?></li>
							<li id="confirm"><?= $this->lang->line('list_item_5'); ?></li>
						</ul>
						<div class="progress d-lg-none">
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<!-- fieldsets -->
						<fieldset>
							<div class="row g-3" id="seller_form">
								<div class="col-7">
									<h6 class="<?= $default_language == 1 ? 'text-end' : 'text-start' ?>"><?= $this->lang->line('list_item_1'); ?>:</h6>
								</div>
								<div class="col-5">
									<h6 class="<?= $default_language == 1 ? 'text-start' : 'text-end' ?>"><?= $this->lang->line('step'); ?> 1 - 5</h6>
								</div>

								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('business_type'); ?> :</label>
									<select class="form-select" id="business_type" name="business_type" aria-label="Default select example">
										<option value="">-- <?= $this->lang->line('select-business-type'); ?> --</option>
										<option value="Individual"><?= $this->lang->line('individual'); ?></option>
										<option value="Company"><?= $this->lang->line('company'); ?></option>
									</select>
									<span id="error"></span>
								</div>
								<div class="col-md-12 mt-0 d-none">
									<label class="form-label mt-4"><?= $this->lang->line('vat_register'); ?> :</label>
									<select class="form-select" id="vat_registered" name="vat_registered" aria-label="Default select example" style="padding-top: 0.77rem;">
										<option value="">-- <?= $this->lang->line('select'); ?> --</option>
										<option value="1"><?= $this->lang->line('yes'); ?></option>
										<option value="0"><?= $this->lang->line('no'); ?></option>
									</select>
									<span id="error"></span>
								</div>
								<div class="col-md-12 mt-0 d-none">
									<label class="form-label mt-4">VAT Registration No :</label>
									<input type="text" class="form-control" id="vat_registratoion_no" name="vat_registratoion_no" disabled required />
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('seller_name'); ?> :</label>
									<input type="text" class="form-control" id="seller_name" name="seller_name" required />
									<span id="error"></span>
								</div>
								<div class="col-md-12 d-none">
									<label class="form-label"><?= $this->lang->line('shop_name'); ?> :</label>
									<input type="text" class="form-control" id="business_name" name="business_name" required />
									<span id="error"></span>
								</div>
								<div class="col-md-12 d-none">
									<label class="form-label"><?= $this->lang->line('shop_address'); ?> :</label>
									<textarea class="form-control" rows="5" id="business_address" name="business_address" required></textarea>
									<span id="error"></span>
								</div>
								<div class="col-md-12 d-none">
									<label class="form-label"><?= $this->lang->line('shop_details'); ?> :</label>
									<textarea class="form-control" rows="5" id="business_details" name="business_details" required></textarea>
									<span id="error"></span>
								</div>

							</div>
							<button type="button" class="seller_form btn btn-default"><?= $this->lang->line('next'); ?></button>
						</fieldset>
						<fieldset>
							<div class="row g-3" id="seller_desc">
								<div class="col-7">
									<h6 class="<?= $default_language == 1 ? 'text-end' : 'text-start' ?>"><?= $this->lang->line('list_item_2'); ?></h6>
								</div>
								<div class="col-5">
									<h6 class="<?= $default_language == 1 ? 'text-start' : 'text-end' ?>"><?= $this->lang->line('step'); ?> 2 - 5</h6>
								</div>

								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('select_country'); ?></label>
									<select class="form-select" id="country" name="country">
										<option value=""><?= $this->lang->line('select_country'); ?></option>
										<?php foreach ($get_country['data'] as $country) : ?>
											<option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
										<?php endforeach; ?>
									</select>
									<span id="error"></span>
								</div>
								<div class="col-md-12" id="region-div">
									<label class="form-label"><?= $this->lang->line('region'); ?></label>
									<input type="text" class="form-control" id="region" name="region" readonly />
									<span id="error"></span>
								</div>
								<div class="col-md-12" id="governorates-div">
									<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
									<input type="text" class="form-control" id="governorates" name="governorates" readonly />
									<span id="error"></span>
								</div>
								<div class="col-md-12" id="area-div">
									<label class="form-label"><?= $this->lang->line('area'); ?></label>
									<input type="text" class="form-control" id="area" name="area" readonly />
									<span id="error"></span>
								</div>
							</div>
							<button type="button" class="previous btn btn-secondary"><?= $this->lang->line('previous'); ?></button>
							<button type="button" class="seller_desc btn btn-default"><?= $this->lang->line('next'); ?></button>
						</fieldset>
						<fieldset>
							<div class="row g-3" id="seller_info">
								<div class="col-7">
									<h6 class="<?= $default_language == 1 ? 'text-end' : 'text-start' ?>"><?= $this->lang->line('list_item_3'); ?>:</h6>
								</div>
								<div class="col-5">
									<h6 class="<?= $default_language == 1 ? 'text-start' : 'text-end' ?>"><?= $this->lang->line('step'); ?> 3 - 5</h6>
								</div>

								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('enter_phone_number'); ?>:</label>
									<input type="text" class="form-control intl-tel-input" id="seller_phone" maxlength="10" required onkeypress="return AllowOnlyNumbers(event);" name="seller_phone" />
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('enter_phone_number_otp'); ?>:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="phone_otp" maxlength="6" required onkeypress="return AllowOnlyNumbers(event);" name="phone_otp" />
										<button class="btn btn-outline-secondary mt-0" type="button" id="send-phone-otp-btn"><?= $this->lang->line('get_otp'); ?></button>
										<span id="error"></span>
									</div>
								</div>
								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('enter_email'); ?>:</label>
									<input type="text" class="form-control" id="seller_email" maxlength="30" required name="seller_email" />
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('enter_email_otp'); ?>:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="email_otp" maxlength="6" required onkeypress="return AllowOnlyNumbers(event);" name="email_otp" />
										<button class="btn btn-outline-secondary mt-0" type="button" id="send-email-otp-btn"><?= $this->lang->line('get_otp'); ?></button>
										<span id="error"></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-check text-start">
										<input class="form-check-input" type="checkbox" value="" id="social_media_handle">
										<label class="form-check-label" for="social_media_handle">
											<?= $this->lang->line('social-website'); ?>
										</label>
									</div>
								</div>

								<div class="col-md-12 social-media-handle d-none">
									<label class="form-label"><?= $this->lang->line('website-link'); ?></label>
									<input type="text" class="form-control" id="website_link" name="website_link" />
									<span id="error"></span>
								</div>
								<div class="col-md-12 social-media-handle d-none">
									<label class="form-label"><?= $this->lang->line('facebook-link'); ?></label>
									<input type="text" class="form-control" id="facebook_link" name="facebook_link" />
									<span id="error"></span>
								</div>
								<div class="col-md-12 social-media-handle d-none">
									<label class="form-label"><?= $this->lang->line('instagram-link'); ?></label>
									<input type="text" class="form-control" id="instagram_link" name="instagram_link" />
									<span id="error"></span>
								</div>

								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('enter_password'); ?>:</label>
									<input type="password" id="password" maxlength="30" name="password" required class="form-control" />
									<span id="error"></span>
								</div>

							</div>
							<button type="button" class="previous btn btn-secondary"><?= $this->lang->line('previous'); ?></button>
							<button type="button" class="seller_info btn btn-default"><?= $this->lang->line('next'); ?></button>
						</fieldset>
						<fieldset>
							<div class="row g-3" id="seller_doc">
								<div class="col-7">
									<h6 class="<?= $default_language == 1 ? 'text-end' : 'text-start' ?>"><?= $this->lang->line('list_item_4'); ?>:</h6>
								</div>
								<div class="col-5">
									<h6 class="<?= $default_language == 1 ? 'text-start' : 'text-end' ?>"><?= $this->lang->line('step'); ?> 4 - 5</h6>
								</div>

								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('upload_business_logo'); ?>:</label>
									<input type="file" name="business_logo" id="business_logo" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png pdf" />
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('upload_id_proof'); ?>:</label>
									<input type="file" name="aadhar_card" id="aadhar_card" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png pdf" />
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('commercial-registration'); ?></label>
									<input type="file" name="commercial_registration" id="commercial_registration" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png pdf" />
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('vat-certification'); ?></label>
									<input type="file" name="vat_certificate" id="vat_certificate" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png pdf" />
									<span id="error"></span>
								</div>
								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('license'); ?></label>
									<input type="file" name="license" id="license" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png pdf" />
									<span id="error"></span>
								</div>
							</div>
							<button type="button" href="#" class="previous btn btn-secondary"><?= $this->lang->line('previous'); ?></button>
							<button class="btn btn-default submit" name="submit" type="button"><?= $this->lang->line('submit'); ?></button>

						</fieldset>
						<fieldset>
							<div class="row g-3">
								<div class="col-7">
									<h6 class="text-start"><?= $this->lang->line('finish'); ?>:</h6>
								</div>
								<div class="col-5">
									<h6 class="text-end"><?= $this->lang->line('step'); ?> 5 - 5</h6>
								</div>
								<img src="<?php echo base_url; ?>/assets_web/images/icons/thanks-icon.png" class="success-img" />
								<h4><?= $this->lang->line('success'); ?> !</h4>
								<h6><?= $this->lang->line('success_msg'); ?>.</h6>
								<h6><?= $this->lang->line('thanks'); ?>.</h6>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</section>
		<!--End: Become a Seller Section -->

	</main>

	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>

	<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/intlTelInput.min.js"></script>
	<script src="<?php echo base_url; ?>assets_web/js/app/become-seller.js"></script>
</body>

</html>