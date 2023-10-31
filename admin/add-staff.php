<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Staff)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<!-- main content start-->
<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Add Staff</h4>
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
										<button id="back_btn" type="submit" class="btn btn-dark waves-effect waves-light" onclick="back_page('manage-staff.php');"><i class="fa fa-arrow-left"></i> Back</button>
									</div>
								</div>
								<div class="form-three widget-shadow">
									<form class="form-horizontal" id="myform">
										<a> ** required field</a>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select Role **</label>
											<div class="col-sm-8">
												<select class="form-control" id="selectrole" name="selectrole">
													<option value="">Select</option>
													<?php
													$stmt = $conn->prepare("SELECT id,title,premission FROM user_roles order by title ASC");

													$stmt->execute();
													$data = $stmt->bind_result($col1, $col2, $col3);

													while ($stmt->fetch()) {
														echo '<option value="' . $col1 . '">' . $col2 . '</option>';
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Full Name **</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="full_name" placeholder="Full Name" required>
											</div>
										</div>


										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0"> Address**</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="address" placeholder="Address" required>
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
												<input type="text" class="form-control" id="pincode" placeholder="462026" required>
											</div>
										</div>-->
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Phone **</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="phone" placeholder="** without country code" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Email Id **</label>
											<div class="col-sm-8">
												<input type="email" class="form-control" id="email" placeholder="email id" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Password **</label>
											<div class="col-sm-8">
												<input type="password" class="form-control" id="password" placeholder="Password" required>
											</div>
										</div>

										<div class="form-group row align-items-center">

											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Profile Image</label>

											<div class="col-sm-8">

												<input type="file" name="profile_pic" id="profile_pic" onchange="uploadFile1('profile_pic')" class="form-control-file" accept="image/png, image/jpeg,image/jpg" required>


											</div>
										</div>

										<div class="col-sm-offset-2">
											<button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="add_btn">SAVE</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>

	</div>

	<div class="clearfix"> </div>

</div>


<div class="col_1">

	<div class="clearfix"> </div>

</div>

<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->
<script src="js/admin/add-staff-user.js"></script>