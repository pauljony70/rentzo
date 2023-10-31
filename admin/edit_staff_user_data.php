<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Staff)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

$user_unique_id = $_POST['user_unique_id'];


?>
<?php include("header.php");
$fname = $address = $city = $pincode = $state = $country = $phone = $email = $password = $profile_pic = $status = $role_id = "";
$stmt = $conn->prepare("SELECT `fullname`, `address`,  `phone`, `email`, `password`,
							`logo`, `status`,role_id FROM `admin_login` WHERE seller_id=?");
$stmt->bind_param("i", $user_unique_id);
$stmt->execute();
$data = $stmt->bind_result($col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
$return = array();

//echo " get col data ";
while ($stmt->fetch()) {
	$fname = $col2;
	$address = $col3;
	$phone = $col4;
	$email = $col5;
	$status = $col8;
	$role_id = $col9;
	$profile_pic = $col7;
}

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
						<h4 class="page-title">Edit Staff Profile</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="bs-example widget-shadow" data-example-id="hoverable-table">

								<div class="row align-items-center">
									<div class="col-md-6 mb-2">
										<button type="submit" onclick="back_page('manage-staff.php')" id="back_btn" class="btn  btn-dark waves-effect waves-light"><i class="fa fa-arrow-left"></i> Back</button>
									</div>
									<div class="col-md-6 mb-2">
										<div class="d-flex align-items-center">
											<div class="ml-md-auto">
												<button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-danger waves-effect waves-light pull-right ml-1">Update Password</button>
											</div>
										</div>
									</div>
								</div>

								<input type="hidden" class="form-control" id="user_unique_id" value=<?php echo $user_unique_id; ?>></input>


								<div class="form-three widget-shadow">
									<form class="form-horizontal" id="myform">
										<a> ** required field</a>

										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0" style="color:orange;"> Status **</label>
											<div class="col-sm-8">
												<select class="form-control" id="sellerstatus" name="sellerstatus">
													<?php

													if ($status == 1) {

														echo '<option value="1" selected>' . "Active" . '</option>';
														echo '<option value="3">' . "Deactive" . '</option>';
													} else if ($status == 3) {

														echo '<option value="1">' . "Active" . '</option>';
														echo '<option value="3" selected>' . "Deactive" . '</option>';
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select Role **</label>
											<div class="col-sm-8">
												<select class="form-control" id="selectrole" name="selectrole">
													<option value="">Select</option>
													<?php
													$stmt1 = $conn->prepare("SELECT id,title,premission FROM user_roles order by title ASC");

													$stmt1->execute();
													$data = $stmt1->bind_result($colr1, $colr2, $colr3);

													while ($stmt1->fetch()) {
														$selected =	'';
														if ($role_id == $colr1) {
															$selected = 'selected';
														}
														echo '<option value="' . $colr1 . '" ' . $selected . '>' . $colr2 . '</option>';
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">User Full Name **</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="full_name" value="<?php echo $fname; ?>" placeholder="Full Name" required>
											</div>
										</div>


										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0"> Address**</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="address" value="<?php echo $address; ?>" placeholder="Address" required>
											</div>
										</div>

										<!--<div class="form-group row align-items-center">
								        		<label  class="col-sm-2 control-label m-0">Select Country **</label>
								           	<div class="col-sm-8">
								               <select class="form-control" id="selectcountry" name="selectcountry">
                                                
                                                </select> 
                                          </div>
                                        </div>
        								<div class="form-group row align-items-center">
								        		<label  class="col-sm-2 control-label m-0">Select State **</label>
								           	<div class="col-sm-8">
								               <select class="form-control" id="selectstate" name="selectstate">
                                                
                                                </select> 
                                          </div>
                                        </div>
        								<div class="form-group row align-items-center">
								        		<label  class="col-sm-2 control-label m-0">Select City **</label>
								           	<div class="col-sm-8">
								               <select class="form-control" id="selectcity" name="selectcity">
                                                
                                                </select> 
                                          </div>
                                        </div>
        								
        								
        								<div class="form-group row align-items-center">
        									<label for="focusedinput" class="col-sm-2 control-label m-0">Pincode **</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control" value="<?php echo $pincode; ?>" id="pincode" placeholder="462026" required>
        									</div>
        								</div>-->
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Phone **</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" value="<?php echo $phone; ?>" id="phone" placeholder="** without country code" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Email Id **</label>
											<div class="col-sm-8">
												<input type="email" class="form-control" value="<?php echo $email; ?>" id="email" placeholder="email id" required>
											</div>
										</div>

										<div class="form-group row align-items-center">

											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Profile Image </label>

											<div class="col-sm-8">
												<div class="input-files">
													<input type="file" name="profile_pic" id="profile_pic" onchange="uploadFile1('profile_pic')" class="form-control-file" accept="image/png, image/jpeg,image/jpg">
													<input type="hidden" class="form-control" id="prod_imgurl" value=<?php echo $profile_pic; ?>></input>
												</div>

											</div>
										</div>
										<div class="form-group row align-items-center">

											<label for="exampleInputFile" class="col-sm-2 control-label m-0"> </label>

											<div class="col-sm-8">
												<div class="tables" style="background-color: #F6EAEA;">
													<div class="wrap">

														<div class="bg-effect">
															<ul class="bt_list" id="bt_list">

																<?php
																$featured_decod =  json_decode($profile_pic);
																$prod_url = MEDIAURL . $featured_decod->{$img_dimension_arr[0][0] . '-' . $img_dimension_arr[0][1]};
																//  echo "image url ".$prod_url;
																echo '<img src=' . $prod_url . '  height="75" width="75" hspace="20" vspace="20"> ';

																?>

															</ul>
														</div>
													</div>
												</div>
											</div>
											</br>
										</div>
										</br>

										<div class="col-sm-offset-2">
											<button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="add_btn">Update</button>
										</div>
									</form>
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


</div>
<!--footer-->
<?php include("footernew.php"); ?>
<script>
	var code_ajax = $("#code_ajax").val();


	$(document).ready(function() {

		$("#add_btn").click(function(event) {
			event.preventDefault();


			var full_name = $('#full_name').val();

			var business_addressvalue = $('#address').val();

			var phonevalue = $('#phone').val();
			var emailvalue = $('#email').val();

			var selectrole = $('#selectrole').val();
			var sellerstatus = $('#sellerstatus').val();



			var profile_pic = $('#profile_pic').prop('files')[0];

			var count = 1;
			//  successmsg( prod_shortvalue + " -- "+prod_detailsvalue );
			if (selectrole == "" || selectrole == null) {
				successmsg("Please select user role");
			} else if (full_name == "" || full_name == null) {
				successmsg("USer full name is empty");
			} else if (business_addressvalue == "" || business_addressvalue == null) {
				successmsg("User address is empty");
			} else if (phonevalue == "" || phonevalue == null) {

				successmsg("Phone number is empty");
			} else if (emailvalue == "" || emailvalue == null) {

				successmsg("Email id is empty");
			} else if (validate_email(emailvalue) == 'invalid') {

				successmsg("Email id is invalid");
			} else {
				$.busyLoadFull("show");
				var user_unique_id = $('#user_unique_id').val();
				var prod_imgurl = $('#prod_imgurl').val();
				var form_data = new FormData();

				form_data.append('full_name', full_name);
				form_data.append('buss_address', business_addressvalue);
				form_data.append('selectrole', selectrole);


				form_data.append('phonevalue', phonevalue);
				form_data.append('emailvalue', emailvalue);

				form_data.append('profile_pic', profile_pic);
				form_data.append('user_unique_id', user_unique_id);
				form_data.append('prod_imgurl', prod_imgurl);
				form_data.append('sellerstatus', sellerstatus);


				form_data.append('code', code_ajax);
				$.ajax({
					method: 'POST',
					url: 'edit_staffuser_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");
						if (response == 'Added') {
							successmsg("User updated Successfully.");
							location.href = "manage-staff.php";
						} else {
							successmsg(response);
						}
					}
				});
			}
		});

		$("#update_password_btn").click(function(event) {
			event.preventDefault();
			var user_unique_id = $('#user_unique_id').val();
			var passwords = $('#password').val();

			if (passwords == "" || passwords == null) {

				successmsg("Password is empty");
			} else if (strong_check_password(passwords) == 'fail') {
				successmsg("Password Must contain 5 characters or more,lowercase and uppercase characters and contains digits.");
			} else if (user_unique_id && passwords) {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('user_id', user_unique_id);
				form_data.append('passwords', passwords);
				form_data.append('type', "password_update");


				form_data.append('code', code_ajax);
				$.ajax({
					method: 'POST',
					url: 'delete_staff_data.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");
						var data = $.parseJSON(response);
						if (data["status"] == "1") {
							$('#password').val('');
							successmsg(data["msg"]);
							$("#myModal").modal('hide');

						} else {
							successmsg(data["msg"]);
						}

					}
				});
			}

		});


	})
</script>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Update Password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
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