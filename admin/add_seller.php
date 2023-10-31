<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ManageSeller)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">

			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Add New Seller</h4>
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
									<form class="form-horizontal" id="myform"> <a> <span class="text-danger">&#42;&#42;</span> required field</a>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Seller Name <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="seller_name" placeholder="Full Name" required>
											</div>
										</div>
										<br>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Business Name <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="business_name" placeholder="Business/ Company Name" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Seller Type <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<select class="form-control" id="sellergroup" name="sellergroup"> </select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Business Address<span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<textarea rows="5" class="form-control" id="business_address" placeholder="Business Address" required></textarea>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Business Description <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<textarea rows="6" class="form-control" id="business_details" name="business_details" form="usrform" required placeholder="About your Business / Company..."></textarea>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select Country</label>
											<div class="col-sm-8">
												<select class="form-control" id="selectcountry" name="selectcountry"> </select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select State</label>
											<div class="col-sm-8">
												<select class="form-control" id="selectstate" name="selectstate"> </select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select City</label>
											<div class="col-sm-8">
												<select class="form-control" id="selectcity" name="selectcity">
													<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Pincode</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="pincode" placeholder="462026" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Phone <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="phone" placeholder="** without country code" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Email Id <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<input type="email" class="form-control" id="email" placeholder="email id" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Password <span class="text-danger">&#42;&#42;</span></label>
											<div class="col-sm-8">
												<input type="password" class="form-control" id="password" placeholder="Password" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Logo /Images 500x500 pixel </label>
											<div class="col-sm-8">
												<div class="input-files">
													<div>
														<input type="file" name="seller_logo" id="seller_logo" class="form-control-file" onchange="uploadFile1('seller_logo')" ;>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Upload Pan card (
												<?php echo $file_kb; ?> </label>
											<div class="col-sm-8">
												<div class="input-files">
													<div>
														<input type="file" name="pan_card" id="pan_card" class="form-control-file" onchange="uploadFile2('pan_card','<?php echo $image_size; ?>')" ;>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Upload Id Proof (
												<?php echo $file_kb; ?>) </label>
											<div class="col-sm-8">
												<div class="input-files">
													<div>
														<input type="file" name="aadhar_card" id="aadhar_card" class="form-control-file" onchange="uploadFile2('aadhar_card','<?php echo $image_size; ?>')" ;>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Upload Business Proof (
												<?php echo $file_kb; ?>) </label>
											<div class="col-sm-8">
												<div class="input-files">
													<div>
														<input type="file" name="business_proof" id="business_proof" class="form-control-file" onchange="uploadFile2('business_proof','<?php echo $image_size; ?>')" ;>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Website URL</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="website" placeholder="https://www.example.com" required>
											</div>
										</div>
										<!--<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">GST/VAT Number</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="gst" placeholder="Registered GST/VAT Number" required> </div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">PAN Number</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="pan_number" placeholder="PAN Number" value="" required> </div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">CIN Number</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="cin_number" placeholder="CIN Number" value="" required> </div>
										</div>-->
										<div class="col-sm-offset-2">
											<button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="add_seller_btn">SAVE</button>
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
<script src="js/admin/add-seller.js"></script>