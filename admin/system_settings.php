<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $StoreSettings)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

$sellerid = $_POST['sellerid'];


include("header.php");

?>

<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">System Settings</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="bs-example widget-shadow" data-example-id="hoverable-table">

								<div class="form-three widget-shadow">
									<div class="row">
										<div class="col-md-12">
											<a> ** required field</a>
										</div>
										<div class="col-md-7">
											<form class="form-horizontal" id="myform">
												<p> <b>System Settings</b></p>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Store Name **</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="system_name" placeholder="Website Name" value="<?= $Common_Function->get_system_settings($conn, 'system_name'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center d-none">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Application Title **</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="application_title" placeholder="Application Title" value="<?= $Common_Function->get_system_settings($conn, 'system_title'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label class="col-sm-2 control-label m-0">Address **</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="address" placeholder="Address" value="<?=  $Common_Function->get_system_settings($conn, 'system_address');; ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Phone**</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="phone" placeholder="Phone" value="<?= $Common_Function->get_system_settings($conn, 'system_phone'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Email **</label>
													<div class="col-sm-10">
														<input type="email" class="form-control" id="system_email" placeholder="Email" value="<?= $Common_Function->get_system_settings($conn, 'system_email'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Other Phone**</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="system_other_phone" placeholder="Phone" value="<?= $Common_Function->get_system_settings($conn, 'system_other_phone'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Other Email **</label>
													<div class="col-sm-10">
														<input type="email" class="form-control" id="system_other_email" placeholder="Email" value="<?= $Common_Function->get_system_settings($conn, 'system_other_email'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label class="col-sm-2 control-label m-0">Language **</label>
													<div class="col-sm-10">
														<select class="form-control" id="default_language" name="default_language" required>
															<option value="">Select Language</option>
															<?php
															$query = $conn->query("SELECT * FROM `language`");
															if ($query->num_rows > 0) {
																while ($row = $query->fetch_assoc()) { ?>
																	<option value="<?= $row['sno']; ?>" <?php if ($Common_Function->get_system_settings($conn, 'system_language') == $row['sno']) {
																													echo 'selected';
																												} ?>>
																		<?= $row['name']; ?>
																	</option>
															<?php	  }
															}

															?>
														</select>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label class="col-sm-2 control-label m-0">Default Currency **</label>
													<div class="col-sm-10">
														<select class="form-control" id="default_currency" name="default_currency" required>
															<option value="">Select Currency</option>
															<?php
															$queryc = $conn->query("SELECT * FROM `currency`");
															if ($queryc->num_rows > 0) {
																while ($rowc = $queryc->fetch_assoc()) { ?>
																	<option value="<?= $rowc['id'] . '-' . $rowc['symbol']; ?>" <?= $Common_Function->get_system_settings($conn, 'system_currency') == $rowc['id'] ? 'selected' : '' ?>>
																		<?= $rowc['name'] . ' ' . $rowc['symbol']; ?>
																	</option>
															<?php	  }
															}

															?>
														</select>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label class="col-2 control-label m-0" style="white-space:nowrap;">1 <?= $currency ?> =</label>
													<div class="col-8">
														<input class="form-control" type="text" name="coversion_rate" placeholder="2.60" id="coversion_rate" value="<?= $Common_Function->get_system_settings($conn, 'coversion_rate'); ?>">
													</div>
													<label class="col-2 control-label m-0 text-right">USD</label>
												</div>
												<div class="form-group row align-items-center">
													<label class="col-sm-2 control-label m-0">Default Timezone **</label>
													<div class="col-sm-10">
														<select class="form-control" id="system_timezone" name="system_timezone" required>
															<option value="">Select Timezone</option>
															<?php
															$timezone = $Common_Function->get_timezone_list();

															foreach ($timezone as $key => $val) { ?>
																<option value="<?= $val; ?>" <?php if ($Common_Function->get_system_settings($conn, 'system_timezone') == $val) {
																										echo 'selected';
																									} ?>>
																	<?= $key; ?>
																</option>
															<?php	  }


															?>
														</select>
													</div>
												</div>
												<div class="form-group row align-items-center d-none">
													<label for="focusedinput" class="col-sm-2 control-label m-0">GST/VAT Number</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="gst_vat" placeholder="Registered GST/VAT Number" value="<?= $Common_Function->get_system_settings($conn, 'system_gst'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Android App Link</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="android_app_link" placeholder="Android App Link" value="<?= $Common_Function->get_system_settings($conn, 'android_app_link'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">IOS App Link</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="ios_app_link" placeholder="IOS App Link" value="<?= $Common_Function->get_system_settings($conn, 'ios_app_link'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Available Offers</label>
													<div class="col-sm-10">
														<textarea class="form-control" id="offers" name="offers" required placeholder="Available Offers"><?= $Common_Function->get_system_settings($conn, 'offers'); ?></textarea>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Footer Text</label>
													<div class="col-sm-10">
														<textarea class="form-control" id="footer_text" name="footer_text" required placeholder="Footer Text"><?= $Common_Function->get_system_settings($conn, 'footer_text'); ?></textarea>
														
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Facebook Link</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="facebook_link" placeholder="Facebook Link" value="<?= $Common_Function->get_system_settings($conn, 'facebook_link'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Instagram Link</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="instagram_link" placeholder="Instagram Link" value="<?= $Common_Function->get_system_settings($conn, 'instagram_link'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Twitter Link</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="twitter_link" placeholder="Twitter Link" value="<?= $Common_Function->get_system_settings($conn, 'twitter_link'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Youtube Link</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="youtube_link" placeholder="Youtube Link" value="<?= $Common_Function->get_system_settings($conn, 'youtube_link'); ?>" required>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="focusedinput" class="col-sm-2 control-label m-0">Linkedin Link</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="linkedin_link" placeholder="Linkedin Link" value="<?= $Common_Function->get_system_settings($conn, 'linkedin_link'); ?>" required>
													</div>
												</div>
												</br>
												</br>
												<div class="col-sm-offset-2">
													<button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="update_setting">Update</button>
												</div>
											</form>
										</div>
										<div class="col-md-5">
											<form class="form-horizontal" id="myform">
												<a> </a>
												<p> <b>System Logo Settings</b></p>
												<br>
												<div class="form-group row align-items-center">
													<label for="exampleInputFile" class="col-sm-2 control-label m-0">Update Logo</label>
													<div class="col-sm-10">
														<div class="input-files">
															<div>
																<input type="file" name="logo" id="logo" class="form-control-file" onchange="uploadFile1('logo')" ;>
															</div>
														</div>
													</div>
												</div>
												<!-- icon-hover-effects -->
												<div class="form-group row align-items-center">
													<label for="exampleInputFile" class="col-sm-2 control-label m-0"></label>
													<?php
													?>
													<div class="col-sm-10">
														<div class="tables" style="background-color: #F6EAEA;">
															<div class="wrap">
																<div class="bg-effect">
																	<ul class="bt_list" id="bt_list">
																		<?php
																		$img_decode = json_decode($Common_Function->get_system_settings($conn, 'system_logo'));
																		
																		$prod_url = MEDIAURL . $img_decode->{$img_dimension_arr[0][0] . '-' . $img_dimension_arr[0][1]};
																		

																		if ($prod_url) {
																			echo '<img src=' . $prod_url . ' id="log_img" height="75" width="75" hspace="20" vspace="20"> ';
																		}
																		?> </ul>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="exampleInputFile" class="col-sm-2 control-label m-0">Update Loader</label>
													<div class="col-sm-10">
														<div class="input-files">
															<div>
																<input type="file" name="loader" id="loader" class="form-control-file" onchange="uploadFile1('loader')" ;>
															</div>
														</div>
													</div>
												</div>
												<!-- icon-hover-effects -->
												<div class="form-group row align-items-center">
													<label for="exampleInputFile" class="col-sm-2 control-label m-0"></label>
													<?php
													?>
													<div class="col-sm-10">
														<div class="tables" style="background-color: #F6EAEA;">
															<div class="wrap">
																<div class="bg-effect">
																	<ul class="bt_list" id="bt_list1">
																		<?php
																		$img_decode1 = json_decode($Common_Function->get_system_settings($conn, 'system_loader'));
																		$prod_url1 = MEDIAURL . $img_decode1->{$img_dimension_arr[0][0] . '-' . $img_dimension_arr[0][1]};


																		if ($prod_url1) {
																			echo '<img src=' . $prod_url1 . ' id="log_img1" height="75" width="75" hspace="20" vspace="20"> ';
																		}
																		?> </ul>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="exampleInputFile" class="col-sm-2 control-label m-0">Category Banner</label>
													<div class="col-sm-10">
														<div class="input-files">
															<div>
																<input type="file" name="category_banner" id="category_banner" class="form-control-file" onchange="uploadFile1('category_banner')" ;>
															</div>
														</div>
													</div>
												</div>
												<!-- icon-hover-effects -->
												<div class="form-group row align-items-center">
													<label for="exampleInputFile" class="col-sm-2 control-label m-0"></label>
													<?php
													?>
													<div class="col-sm-10">
														<div class="tables" style="background-color: #F6EAEA;">
															<div class="wrap">
																<div class="bg-effect">
																	<ul class="bt_list" id="bt_list2">
																		<?php
																		$img_decode1 = json_decode($Common_Function->get_system_settings($conn, 'category_banner'));
																		$prod_url1 = MEDIAURL . $img_decode1->{$img_dimension_arr[0][0] . '-' . $img_dimension_arr[0][1]};


																		if ($prod_url1) {
																			echo '<img src=' . $prod_url1 . ' id="log_img2" height="150" width="250" hspace="20" vspace="20"> ';
																		}
																		?> </ul>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group row align-items-center">
													<label for="exampleInputFile" class="col-sm-2 control-label m-0">Login Banner</label>
													<div class="col-sm-10">
														<div class="input-files">
															<div>
																<input type="file" name="login_banner" id="login_banner" class="form-control-file" onchange="uploadFile1('login_banner')" ;>
															</div>
														</div>
													</div>
												</div>
												<!-- icon-hover-effects -->
												<div class="form-group row align-items-center">
													<label for="exampleInputFile" class="col-sm-2 control-label m-0"></label>
													<?php
													?>
													<div class="col-sm-10">
														<div class="tables" style="background-color: #F6EAEA;">
															<div class="wrap">
																<div class="bg-effect">
																	<ul class="bt_list" id="bt_list3">
																		<?php
																		$img_decode1 = json_decode($Common_Function->get_system_settings($conn, 'login_banner'));
																		$prod_url1 = MEDIAURL . $img_decode1->{$img_dimension_arr[0][0] . '-' . $img_dimension_arr[0][1]};


																		if ($prod_url1) {
																			echo '<img src=' . $prod_url1 . ' id="log_img3" height="150" width="250" hspace="20" vspace="20"> ';
																		}
																		?> </ul>
																</div>
															</div>
														</div>
													</div>
												</div>
												</br>
												</br>
												<div class="col-sm-offset-2">
													<button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="update_logo">Update</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="col_1">
		<div class="clearfix"> </div>
	</div>
</div>

<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->
<script>
	var code_ajax = $("#code_ajax").val();
	$(document).ready(function() {
		$("#update_setting").click(function(event) {
			event.preventDefault();
			var system_name = $('#system_name').val();
			var application_title = $('#application_title').val();
			var business_addressvalue = $('#address').val();
			var phonevalue = $('#phone').val();
			var emailvalue = $('#system_email').val();
			var default_language = $('#default_language').val();
			var default_currency = $('#default_currency').val();
			var coversion_rate = $('#coversion_rate').val();
			var gst_vat = $('#gst_vat').val();
			var system_timezone = $('#system_timezone').val();
			var system_other_email = $('#system_other_email').val();
			var system_other_phone = $('#system_other_phone').val();
			var ios_app_link = $('#ios_app_link').val();
			var footer_text = $('#footer_text').val();
			var facebook_link = $('#facebook_link').val();
			var instagram_link = $('#instagram_link').val();
			var twitter_link = $('#twitter_link').val();
			var youtube_link = $('#youtube_link').val();
			var linkedin_link = $('#linkedin_link').val();
			var offers = $('textarea#offers').val();



			var android_app_link = $('#android_app_link').val();
			if (system_name == "" || system_name == null) {
				successmsg("Website name is empty");
			} else if (application_title == "" || application_title == null) {
				successmsg("Application Title is empty");
			} else if (!phonevalue) {
				successmsg("Phone is empty");
			} else if (business_addressvalue == "" || business_addressvalue == null) {
				successmsg("Business address is empty");
			} else if (emailvalue == "" || emailvalue == null) {
				successmsg("Email id is empty");
			} else if (validate_email(emailvalue) == 'invalid') {
				successmsg("Email id is invalid");
			} else if (!default_language) {
				successmsg("Please select Language");
			} else if (!default_currency) {
				successmsg("Please select Currency");
			} else if (!system_timezone) {
				successmsg("Please select timezone");
			} else {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('system_name', system_name);
				form_data.append('system_title', application_title);
				form_data.append('system_address', business_addressvalue);
				form_data.append('system_phone', phonevalue);
				form_data.append('system_email', emailvalue);
				form_data.append('system_language', default_language);
				form_data.append('system_currency', default_currency);
				form_data.append('coversion_rate', coversion_rate);
				form_data.append('system_gst', gst_vat);
				form_data.append('system_timezone', system_timezone);
				form_data.append('system_other_email', system_other_email);
				form_data.append('system_other_phone', system_other_phone);
				form_data.append('ios_app_link', ios_app_link);
				form_data.append('footer_text', footer_text);
				form_data.append('offers', offers);
				form_data.append('android_app_link', android_app_link);
				form_data.append('facebook_link', facebook_link);
				form_data.append('instagram_link', instagram_link);
				form_data.append('twitter_link', twitter_link);
				form_data.append('youtube_link', youtube_link);
				form_data.append('linkedin_link', linkedin_link);
				form_data.append('code', code_ajax);
				form_data.append('type', 'default_setting');
				
				
				$.ajax({
					method: 'POST',
					url: 'update_system_settings.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");
						var data = $.parseJSON(response);
						if (data["status"] == "1") {
							successmsg(data["msg"]);
						} else {
							successmsg(data["msg"]);
						}
					}
				});
			}
		});
		$("#update_logo").click(function(event) {
			event.preventDefault();
			var logo = $('#logo').prop('files')[0];
			var loader = $('#loader').prop('files')[0];
			var category_banner = $('#category_banner').prop('files')[0];
			var login_banner = $('#login_banner').prop('files')[0];
			if (!logo && !loader) {
				successmsg("Please select Logo & Loader");
			} else {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('system_logo', logo);
				form_data.append('system_loader', loader);
				form_data.append('category_banner', category_banner);
				form_data.append('login_banner', login_banner);
				form_data.append('code', code_ajax);
				form_data.append('type', 'default_logo');
				$.ajax({
					method: 'POST',
					url: 'update_system_settings.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");
						var data = $.parseJSON(response);
						if (data["status"] == "1") {
							successmsg(data["msg"]);
							if (data["system_logo"]) {
								$("#log_img").remove();
								$("#bt_list").html('<img src="' + data["system_logo"] + '" id="log_img" height="75" width="75" hspace="20" vspace="20">');
							}
							if (data["system_banner"]) {
								$("#log_img1").remove();
								$("#bt_list1").html('<img src="' + data["system_banner"] + '" id="log_img1" height="75" width="75" hspace="20" vspace="20">');
							}
							if (data["system_banner"]) {
								$("#log_img2").remove();
								$("#bt_list2").html('<img src="' + data["category_banner"] + '" id="log_img2" height="150" width="250" hspace="20" vspace="20">');
							}
							if (data["system_banner"]) {
								$("#log_img3").remove();
								$("#bt_list3").html('<img src="' + data["login_banner"] + '" id="log_img3" height="150" width="250" hspace="20" vspace="20">');
							}
						} else {
							successmsg(data["msg"]);
						}
					}
				});
			}
		});

		if ($("#offers0").length > 0) {
			tinymce.init({
				selector: "textarea#offers",
				theme: "modern",
				height: 300,
				plugins: [
					"advlist lists print",
					"wordcount code fullscreen",
					"save table directionality emoticons paste textcolor"
				],
				toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

			});
		}
	})
</script>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Update Password</h4>
			</div>
			<div class="modal-body">
				<form class="form" id="update_password_form" enctype="multipart/form-data">
					<div class="form-group row align-items-center">
						<label for="name">Password</label>
						<input type="password" class="form-control" id="password" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_password_btn">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>