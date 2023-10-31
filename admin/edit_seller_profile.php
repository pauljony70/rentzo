<?php
include('session.php');
if (!$Common_Function->user_module_premission($_SESSION, $ManageSeller)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

$sellerid = $_POST['sellerid'];
?>
<?php include("header.php");

$cname = "";
$fname = "";
$address = "";
$desc = "";
$city = "";
$pincode = "";
$state = "";
$country = "";
$phone = "";
$email = "";
$logo = "";
$website = "";
$tax = "";
$grpid = "";
$status = "";
$flagid = "";
$createby = "";
$update_by = "";
$pan_card = "";
$aadhar_card = "";
$pan_number = $cin_number = $seller_banner = "";
$stmt = $conn->prepare("SELECT * FROM sellerlogin WHERE sellerid = ?");
$stmt->bind_param("s", $sellerid);
$stmt->execute();
// Store the first row in an associative array
$seller_data = $stmt->get_result()->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM country");
$stmt->execute();
// Store the first row in an associative array
$country_result = $stmt->get_result();
$country_data = array();
// Loop through the result set and fetch each row into the array
while ($row = $country_result->fetch_assoc()) {
	$country_data[] = $row;
}
$stmt->close();
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
						<h4 class="page-title">Edit Seller Profile</h4>
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
										<button type="submit" onclick="back_page('seller.php')" id="back_btn" class="btn  btn-dark waves-effect waves-light"><i class="fa fa-arrow-left"></i> Back</button>
									</div>
									<div class="col-md-6 mb-2">
										<div class="d-flex align-items-center">
											<div class="ml-md-auto">
												<button onclick="editSellerbankdetails()" type="button" class="btn btn-danger waves-effect waves-light pull-right">Bank Account Details</button>
												<button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-danger waves-effect waves-light pull-right ml-1">Update Password</button>
											</div>
										</div>
									</div>
								</div>

								<input type="hidden" class="form-control" id="sellerid" value=<?php echo $sellerid; ?>></input>
								<div class="form-three widget-shadow">
									<form class="form-horizontal" id="myform"> <a> ** required field</a>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0" style="color:orange;"> Status **</label>
											<div class="col-sm-8">
												<select class="form-control" id="sellerstatus" name="sellerstatus" onchange="statuschange()">
													<option value="0" <?= $seller_data['status'] == 0 ? 'selected' : '' ?>>Pending</option>
													<option value="1" <?= $seller_data['status'] == 1 ? 'selected' : '' ?>>Active</option>
													<option value="2" <?= $seller_data['status'] == 2 ? 'selected' : '' ?>>Rejected</option>
													<option value="3" <?= $seller_data['status'] == 3 ? 'selected' : '' ?>>Deactive</option>
												</select>
											</div>
										</div>
										<div class="form-group" id="divreject">
											<div class="form-group row align-items-center">
												<label class="col-sm-2 control-label m-0" style="color:orange;">Reject Reason</label>
												<div class="col-sm-8">
													<select class="form-control" id="rejectreason" name="rejectreason">
														<?php
														echo '<option value="0">' . "Select One Reason" . '</option>';

														$rejectreason = "";
														$stmt2 = $conn->prepare("SELECT sno, reason FROM seller_flag_reason");
														// $stmt2 ->bind_param(i, $flagid);
														$stmt2->execute();
														$data2 = $stmt2->bind_result($col41, $col42);
														//echo " get col data ";
														while ($stmt2->fetch()) {

															//  $rejectreason = $col42;
															if ($flagid == $col41) {
																echo '<option value="' . $col41 . '" selected>' . $col42 . '</option>';
															} else {
																echo '<option value="' . $col41 . '">' . $col42 . '</option>';
															}
														}

														?>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Seller Name **</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="seller_name" placeholder="Full Name" value="<?php echo $seller_data['fullname']; ?>" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Business Name **</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="business_name" placeholder="Business/ Company Name" value="<?php echo $seller_data['companyname']; ?>" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Seller Type **</label>
											<div class="col-sm-8">
												<select class="form-control" id="sellergroup" name="sellergroup"> </select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0"> Business Type **</label>
											<div class="col-sm-8">
												<select class="form-control" id="business_type" name="business_type" onchange="statuschange()">
													<option value="">Select business type</option>
													<option value="Individual" <?= $seller_data['business_type'] == 'Individual' ? 'selected' : '' ?>>Individual</option>
													<option value="Company" <?= $seller_data['business_type'] == 'Company' ? 'selected' : '' ?>>Company</option>
												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Business Address**</label>
											<div class="col-sm-8">
												<textarea rows="5" class="form-control" id="business_address" placeholder="Business Address" required><?php echo $seller_data['address']; ?></textarea>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Business Description **</label>
											<div class="col-sm-8">
												<textarea rows="6" class="form-control" id="business_details" name="business_details" form="usrform" required placeholder="About your Business / Company..."><?php echo $seller_data['description']; ?></textarea>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select Country **</label>
											<div class="col-sm-8">
												<select class="form-control" id="selectcountry" name="selectcountry">
													<option value="">Select country</option>
													<?php foreach ($country_data as $country) : ?>
														<option value="<?= $country['id'] ?>" <?= $seller_data['country_id'] == $country['id'] ? 'selected' : '' ?>><?= $country['name'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Region **</label>
											<div class="col-sm-8" id="region-div">
												<?php if ($seller_data['country_id'] == 1) : ?>
													<select class="form-control" id="selectregion" name="selectregion"> </select>
												<?php else : ?>
													<input type="text" class="form-control" id="selectregion" name="selectregion" value="<?= $seller_data['region'] ?>" />
												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Governorate **</label>
											<div class="col-sm-8" id="governorates-div">
												<?php if ($seller_data['country_id'] == 1) : ?>
													<select class="form-control" id="selectgovernorate" name="selectgovernorate"> </select>
												<?php else : ?>
													<input type="text" class="form-control" id="selectgovernorate" name="selectgovernorate" value="<?= $seller_data['governorate'] ?>" />
												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Area **</label>
											<div class="col-sm-8" id="area-div">
												<?php if ($seller_data['country_id'] == 1) : ?>
													<select class="form-control" id="selectarea" name="selectarea"> </select>
												<?php else : ?>
													<input type="text" class="form-control" id="selectarea" name="selectarea" value="<?= $seller_data['area'] ?>" />
												<?php endif; ?>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Phone **</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="phone" placeholder="** without country code" value="<?php echo $seller_data['phone']; ?>" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Email Id **</label>
											<div class="col-sm-8">
												<input type="email" class="form-control" id="email" placeholder="email id" value="<?php echo $seller_data['email']; ?>" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">VAT Registration No **</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="vat_registration_no" placeholder="VAT Registration No" value="<?php echo $seller_data['vat_registratoion_no']; ?>">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Update Logo 500x500 pixel</label>
											<div class="col-sm-8">
												<div class="input-files">
													<div>
														<input type="file" name="seller_logo" id="seller_logo" class="form-control-file" onchange="uploadFile1('seller_logo')" ;>
													</div>
												</div>
											</div>
										</div>
										<!-- icon-hover-effects -->
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0"></label>
											<?php
											?>
											<div class="col-sm-8">
												<div class="tables" style="background-color: #F6EAEA;">
													<div class="wrap">
														<div class="bg-effect">
															<ul class="bt_list" id="bt_list">
																<img src="<?= BASEURL . 'media/' . $seller_data['logo'] ?>" id="log_img" height="75" width="75" hspace="20" vspace="20">
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<input type="hidden" class="form-control" id="seller_logo1" value=<?php echo $seller_data['logo']; ?>></input>
										<input type="hidden" class="form-control" id="aadhar_card1" value=<?php echo $seller_data['aadhar_card']; ?>></input>
										<input type="hidden" class="form-control" id="commercial_registration1" value=<?php echo $seller_data['commercial_registration']; ?>></input>
										<input type="hidden" class="form-control" id="vat_certificate1" value=<?php echo $seller_data['vat_certificate']; ?>></input>
										<input type="hidden" class="form-control" id="license1" value=<?php echo $seller_data['license']; ?>></input>

										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Upload Id Proof (<?php echo $file_kb; ?>)</label>
											<div class="col-sm-8">
												<div class="input-files">
													<div>
														<input type="file" name="aadhar_card" id="aadhar_card" class="form-control-file" onchange="uploadFile2('aadhar_card','<?php echo $image_size; ?>')" ;>
													</div>
													<?php
													if ($seller_data['aadhar_card'] != '') {
														echo '<a href="download_new.php?file=' . urlencode($seller_data['aadhar_card']) . '">Download</a> ';
													}
													?> </br>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Upload Commetcial Registration (<?php echo $file_kb; ?>)</label>
											<div class="col-sm-8">
												<div class="input-files">
													<div>
														<input type="file" name="commercial_registration" id="commercial_registration" class="form-control-file" onchange="uploadFile2('commercial_registration','<?php echo $image_size; ?>')" ;>
													</div>
													<?php
													if ($seller_data['commercial_registration'] != '') {
														echo '<a href="download_new.php?file=' . urlencode($seller_data['commercial_registration']) . '">Download</a> ';
													}
													?> </br>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Upload License (<?php echo $file_kb; ?>)</label>
											<div class="col-sm-8">
												<div class="input-files">
													<div>
														<input type="file" name="license" id="license" class="form-control-file" onchange="uploadFile2('license','<?php echo $image_size; ?>')" ;>
													</div>
													<?php
													if ($seller_data['license'] != '') {
														echo '<a href="download_new.php?file=' . urlencode($seller_data['license']) . '">Download</a> ';
													}
													?> </br>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="exampleInputFile" class="col-sm-2 control-label m-0">Upload VAT Certificate (<?php echo $file_kb; ?>)</label>
											<div class="col-sm-8">
												<div class="input-files">
													<div>
														<input type="file" name="vat_certificate" id="vat_certificate" class="form-control-file" onchange="uploadFile2('vat_certificate','<?php echo $image_size; ?>')" ;>
													</div>
													<?php
													if ($seller_data['vat_certificate'] != '') {
														echo '<a href="download_new.php?file=' . urlencode($seller_data['vat_certificate']) . '">Download</a> ';
													}
													?> </br>
												</div>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Website URL</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="website" placeholder="https://www.blueappsoftware.com" value="<?php echo $seller_data['websiteurl']; ?>" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Facebook URL</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="facebook" placeholder="https://www.facebook.com" value="<?php echo $seller_data['facebook_link']; ?>" required>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label for="focusedinput" class="col-sm-2 control-label m-0">Instagram URL</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="instagram" placeholder="https://www.instagram.com" value="<?php echo $seller_data['instagram_link']; ?>" required>
											</div>
										</div>
										<div class="col-sm-offset-2">
											<button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="addProduct">Update</button>
										</div>
										</br>
										<div class="col-sm-offset-2" id="sendmail" style="display:none;">
											<button type="submit" class="btn btn-danger waves-effect waves-light" href="javascript:void(0)" onclick="sendemail(this); return false;">Send Email to Seller</button>
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
	<div class="col_1">
		<div class="clearfix"> </div>
	</div>
</div>
<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->
<script type="application/javascript">
	var code_ajax = $("#code_ajax").val();

	function editSellerbankdetails() {
		//successmsg(item);
		var sellerid = $('#sellerid').val();
		var mapForm = document.createElement("form");
		mapForm.target = "_self";
		mapForm.method = "POST"; // or "post" if appropriate
		mapForm.action = "edit-seller-bankdetails.php";
		var mapInput = document.createElement("input");
		mapInput.type = "text";
		mapInput.name = "sellerid";
		mapInput.value = sellerid;
		mapForm.appendChild(mapInput);
		document.body.appendChild(mapForm);
		map = window.open("", "_self");
		if (map) {
			mapForm.submit();
		} else {
			successmsg('You must allow popups for this map to work.');
		}
	}
</script>
<script>
	$(document).ready(function() {
		var id = 1;
		getSellerGroupdata();
		var country_id = <?= $seller_data['country_id'] ? $seller_data['country_id'] : 0 ?>;
		if (country_id == 1)
			getRegiondata(country_id);
		$('#selectcountry').on('change', function() {
			if (this.value == 1) {
				document.querySelector('#region-div').innerHTML =
					`<select class="form-control" id="selectregion" name="selectregion"> </select>`;
				document.querySelector('#governorates-div').innerHTML =
					`<select class="form-control" id="selectgovernorate" name="selectgovernorate"> </select>`;
				document.querySelector('#area-div').innerHTML =
					`<select class="form-control" id="selectarea" name="selectarea"> </select>`;
				getRegiondata(this.value);
			} else if (this.value > 1) {
				document.querySelector('#region-div').innerHTML =
					`<input type="text" class="form-control" id="selectregion" name="selectregion" />`;
				document.querySelector('#governorates-div').innerHTML =
					`<input type="text" class="form-control" id="selectgovernorate" name="selectgovernorate" />`;
				document.querySelector('#area-div').innerHTML =
					`<input type="text" class="form-control" id="selectarea" name="selectarea" />`;
			} else {
				document.querySelector('#region-div').innerHTML =
					`<input type="text" class="form-control" id="selectregion" name="selectregion" disabled/>`;
				document.querySelector('#governorates-div').innerHTML =
					`<input type="text" class="form-control" id="selectgovernorate" name="selectgovernorate" disabled/>`;
				document.querySelector('#area-div').innerHTML =
					`<input type="text" class="form-control" id="selectarea" name="selectarea" disabled/>`;
			}

		});
	});
</script>
<script>
	function getRegiondata(countryid) {
		//   successmsg("prod id "+item );
		$.ajax({
			method: 'POST',
			url: 'get_region.php',
			data: {
				code: code_ajax,
				countryid: countryid
			},
			success: function(response) {
				// successmsg(response); // display response from the PHP script, if any
				var data = $.parseJSON(response);
				$('#selectregion').empty();
				$('#selectgovernorate').empty();
				$('#selectarea').empty();

				if (data["status"] == "1") {
					$getgovernorate = true;
					var regionid = <?= $seller_data['region_id'] ? $seller_data['region_id'] : 0 ?>;
					$firstitemid = 0;
					$firstitemflag = true;
					//  successmsg('<?php echo "some info"; ?>');
					// successmsg("state "+ stateid );
					$(data["data"]).each(function() {
						//	successmsg(this.id +"--"+stateid+"--");
						if (regionid === this.id) {
							// successmsg("match==="+stateid);
							var o = new Option(this.name, this.id);
							$("#selectregion").append(o);
							$('#selectregion').val(this.id);
							$getgovernorate = false;
							getGovernoratedata(this.id);
						} else {
							var o = new Option(this.name, this.id);
							$("#selectregion").append(o);
						}
						if ($firstitemflag == true) {
							$firstitemflag = false;
							$firstitemid = this.id;
						}
					});
					if ($getgovernorate == true) {
						$getgovernorate = false;
						getGovernoratedata($firstitemid);
					}
				} else {
					//successmsg(data["msg"]);
				}
			}
		});
		$('#selectregion').on('change', function() {
			//successmsg("cahnge"+ this.value );
			getGovernoratedata(this.value);
		});
	}
</script>
<script>
	function getGovernoratedata(regionid) {
		// successmsg("state id "+stateid );
		$.ajax({
			method: 'POST',
			url: 'get_governorate.php',
			data: {
				code: code_ajax,
				regionid: regionid
			},
			success: function(response) {
				// successmsg(response); // display response from the PHP script, if any
				var data = $.parseJSON(response);
				$('#selectgovernorate').empty();
				$('#selectarea').empty();

				if (data["status"] == "1") {
					$getarea = true;
					var governorateid = <?= $seller_data['governorate_id'] ? $seller_data['governorate_id'] : 0 ?>;
					$firstitemid = 1;
					$firstitemflag = true;
					$(data["data"]).each(function() {
						//	successmsg(this.name+"---"+cityid);
						if (governorateid === this.id) {
							// successmsg("match==="+stateid);
							var o = new Option(this.name, this.id);
							$("#selectgovernorate").append(o);
							$('#selectgovernorate').val(this.id);
							$getarea = false;
							getAreadata(this.id);
						} else {
							var o = new Option(this.name, this.id);
							$("#selectgovernorate").append(o);
						}
						//	var o = new Option(this.name, this.id);
						//   $("#selectcity").append(o);
						// pass PHP variable declared above to JavaScript variable
					});
					if ($getarea == true) {
						$getarea = false;
						getAreadata($firstitemid);
					}
				} else {
					// successmsg(data["msg"]);
				}
			}
		});
		$('#selectgovernorate').on('change', function() {
			//successmsg("cahnge"+ this.value );
			getAreadata(this.value);
		});
	}
</script>
<script>
	function getAreadata(governorateid) {
		$.ajax({
			method: 'POST',
			url: 'get_area.php',
			data: {
				code: code_ajax,
				governorateid: governorateid
			},
			success: function(response) {
				// successmsg(response); // display response from the PHP script, if any
				var data = $.parseJSON(response);
				$('#selectarea').empty();
				//                      .append('<option selected="selected" value="blank">Select</option>') ;    
				if (data["status"] == "1") {
					var areaid = <?= $seller_data['area_id'] ? $seller_data['area_id'] : 0 ?>;
					$(data["data"]).each(function() {
						if (areaid === this.id) {
							var o = new Option(this.name, this.id);
							$("#selectarea").append(o);
							$('#selectarea').val(this.id);
						} else {
							var o = new Option(this.name, this.id);
							$("#selectarea").append(o);
						}
					});
				} else {
					// successmsg(data["msg"]);
				}
			}
		});
	}
</script>
<script>
	function getSellerGroupdata() {
		// successmsg("state id "+stateid );
		$.ajax({
			method: 'POST',
			url: 'get_sellergroup.php',
			data: {
				code: code_ajax
			},
			success: function(response) {
				// successmsg(response); // display response from the PHP script, if any
				var data = $.parseJSON(response);
				$('#sellergroup').empty();
				//                      .append('<option selected="selected" value="blank">Select</option>') ;    
				if (data["status"] == "1") {
					$(data["data"]).each(function() {
						//	successmsg(this.name);
						var o = new Option(this.name, this.id);
						$("#sellergroup").append(o);
					});
				} else {
					successmsg(data["msg"]);
				}
			}
		});
	}
</script>
<script>
	$(document).ready(function() {
		$("#addProduct").click(function(event) {
			event.preventDefault();
			var selleridvalue = $('#sellerid').val();
			var seller_namevalue = $('#seller_name').val();
			var company_namevalue = $('#business_name').val();
			var grp = document.getElementById("sellergroup");
			var sellergroupvalue = grp.options[grp.selectedIndex].value;
			var business_type = $('#business_type').val();
			var business_addressvalue = $('#business_address').val();
			var business_detailsvalue = $('#business_details').val();
			var country_id = $('#selectcountry').val();
			var country = $('#selectcountry option:selected').text();
			var region_id = $('#selectregion').is('input') ? '' : $('#selectregion').val();
			var region = $('#selectregion').is('input') ? $('#selectregion').val() : $('#selectregion option:selected').text();
			var governorate_id = $('#selectgovernorate').is('input') ? '' : $('#selectgovernorate').val();
			var governorate = $('#selectgovernorate').is('input') ? $('#selectgovernorate').val() : $('#selectgovernorate option:selected').text();
			var area_id = $('#selectarea').is('input') ? '' : $('#selectarea').val();
			var area = $('#selectarea').is('input') ? $('#selectarea').val() : $('#selectarea option:selected').text();
			var phonevalue = $('#phone').val();
			var emailvalue = $('#email').val();
			var vat_registration_no = $('#vat_registration_no').val();
			var websitevalue = $('#website').val();
			var facebook = $('#facebook').val();
			var instagram = $('#instagram').val();
			var std = document.getElementById("sellerstatus");
			var sellerstatus = std.options[std.selectedIndex].value;
			var rsn = document.getElementById("rejectreason");
			var reason = rsn.options[rsn.selectedIndex].value;

			//  successmsg( prod_shortvalue + " -- "+prod_detailsvalue );
			if (seller_namevalue == "" || seller_namevalue == null) {
				successmsg("Seller name is empty");
			} else if (country == "") {
				successmsg("Please select Country");
			} else if (region == "") {
				successmsg("region is empty");
			} else if (governorate == "") {
				successmsg("Governorate is empty");
			} else if (area == "") {
				successmsg("Area is empty");
			} else if (phonevalue == "" || phonevalue == null) {
				successmsg("Phone number is empty");
			} else if (emailvalue == "" || emailvalue == null) {
				successmsg("Email id is empty");
				/*} else if(validate_email(emailvalue) == 'invalid') {
					successmsg("Email id is invalid");*/
			} else {
				showloader();
				var seller_logo = $('#seller_logo').prop('files')[0];
				var aadhar_card = $('#aadhar_card').prop('files')[0];
				var commercial_registration = $('#commercial_registration').prop('files')[0];
				var license = $('#license').prop('files')[0];
				var vat_certificate = $('#vat_certificate').prop('files')[0];
				var seller_logo1 = $("#seller_logo1").val();
				var aadhar_card1 = $("#aadhar_card1").val();
				var commercial_registration1 = $("#commercial_registration1").val();
				var vat_certificate1 = $("#vat_certificate1").val();
				var license1 = $("#license1").val();

				var form_data = new FormData();
				form_data.append('sellerid', selleridvalue);
				form_data.append('seller_namevalue', seller_namevalue);
				form_data.append('company_namevalue', company_namevalue);
				form_data.append('sellergroupvalue', sellergroupvalue);
				form_data.append('business_type', business_type);
				form_data.append('business_addressvalue', business_addressvalue);
				form_data.append('business_detailsvalue', business_detailsvalue);
				form_data.append('country_id', country_id);
				form_data.append('country', country);
				form_data.append('region_id', region_id);
				form_data.append('region', region);
				form_data.append('governorate_id', governorate_id);
				form_data.append('governorate', governorate);
				form_data.append('area_id', area_id);
				form_data.append('area', area);
				form_data.append('phonevalue', phonevalue);
				form_data.append('emailvalue', emailvalue);
				form_data.append('websitevalue', websitevalue);
				form_data.append('facebook', facebook);
				form_data.append('instagram', instagram);
				form_data.append('sellerstatus', sellerstatus);
				form_data.append('reason', reason);
				form_data.append('seller_logo1', seller_logo1);
				form_data.append('aadhar_card1', aadhar_card1);
				form_data.append('commercial_registration1', commercial_registration1);
				form_data.append('vat_certificate1', vat_certificate1);
				form_data.append('license1', license1);
				form_data.append('seller_logo', seller_logo);
				form_data.append('aadhar_card', aadhar_card);
				form_data.append('commercial_registration', commercial_registration);
				form_data.append('license', license);
				form_data.append('vat_certificate', vat_certificate);
				form_data.append('code', code_ajax);

				$.ajax({
					method: 'POST',
					url: 'edit_seller_profileprocess.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						hideloader();
						var data = $.parseJSON(response);
						if (data["status"] == "1") {
							successmsg(data["msg"]);
							$("#log_img").remove();
							$("#banner_img").remove();
							$("#bt_list").html('<img src="<?= BASEURL . 'media/' ?>' + data["img"] + '" id="log_img" height="75" width="75" hspace="20" vspace="20">');
							$('#seller_logo1').val(data["img"])
							$('#aadhar_card1').val(data["aadhar_card"])
							$('#commercial_registration1').val(data["commercial_registration"])
							$('#vat_certificate1').val(data["license"])
							$('#license1').val(data["vat_certificate"])
							var x = document.getElementById("sendmail");
							x.style.display = "block";
						} else {
							successmsg(data["msg"]);
						}
					}
				});
			}
		});
		$("#update_password_btn").click(function(event) {
			event.preventDefault();
			var selleridvalue = $('#sellerid').val();
			var passwords = $('#password').val();
			if (passwords == "" || passwords == null) {
				successmsg("Password is empty");
			} else if (strong_check_password(passwords) == 'fail') {
				successmsg("Password Must contain 5 characters or more,lowercase and uppercase characters and contains digits.");
			} else if (selleridvalue && passwords) {
				showloader();
				var form_data = new FormData();
				form_data.append('selleridvalue', selleridvalue);
				form_data.append('passwords', passwords);
				form_data.append('code', code_ajax);
				$.ajax({
					method: 'POST',
					url: 'verify_seller_bank_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						hideloader();
						var data = $.parseJSON(response);
						if (data["status"] == "1") {
							successmsg(data["msg"]);
							$("#myModal").modal('hide');
							$('#password').val('');
						} else {
							successmsg(data["msg"]);
						}
					}
				});
			}
		});
		$("#back_btn").click(function(event) {
			event.preventDefault();
			location.href = "seller.php";
		});
		statuschange();
	})
</script>
<script>
	function statuschange() {
		var std = document.getElementById("sellerstatus");
		var statusvalue = std.options[std.selectedIndex].value;
		// successmsg("statusvalue "+statusvalue);
		var x = document.getElementById("divreject");
		if (statusvalue == 2) {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
</script>
<script>
	function sendemail() {
		var std = document.getElementById("sellerstatus");
		var statusvalue = std.options[std.selectedIndex].value;
		var statustext = std.options[std.selectedIndex].text;
		// successmsg( statusvalue +"--"+statustext);
		if (statusvalue == 2) {
			var seller_name = $('#seller_name').val();
			var phone = $('#phone').val();
			var email = $('#email').val();
			// var reason = $('#rejectreason').val();
			var std = document.getElementById("rejectreason");
			var reason = std.options[std.selectedIndex].text;
			var subject = "Seller application request has rejected";
			var bodymsg = "Dear " + seller_name + ",<br>" + "We have received your request to become a seller on our platform.<br> After review, we found that you are not eligible due to below given reason." + reason + "<br>";
			// successmsg("start--"+bodymsg );
			$.ajax({
				method: 'POST',
				url: 'send_mail.php',
				data: {
					code: code_ajax,
					subject: subject,
					message: bodymsg,
					email: email,
					phone: phone
				},
				success: function(response) {
					//  successmsg(response); // display response from the PHP script, if any
					var data = $.parseJSON(response);
					if (data["status"] == "1") {
						successmsg(data["msg"]);
					} else {
						successmsg(data["msg"]);
					}
				}
			});
		} else {
			successmsg("elese paer");
		}
	}
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
					<button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="update_password_btn">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>