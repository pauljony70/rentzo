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


$default_sms = $Common_Function->get_system_settings($conn, 'active_sms_service');
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
						<h4 class="page-title">SMS Settings</h4>
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

										<div class="col-md-4 nav tabs-vertical">
											<!--<li class="active"><a href="#b-profile" data-toggle="tab" aria-expanded="true">Select A SMS Service</a></li>-->

											<li class="w-100">
												<div class="d-flex align-items-center justify-content-center h-100">
													<a class="py-2 px-4" href="#v-profile" data-toggle="tab" aria-expanded="false" style="background-color: #eee; border-radius: 8px;">
														<span class="text-dark">Soft SMS Settings </span> <?php if ($default_sms == 'soft') { ?><span class="badge badge-success">Active</span> <?php } ?>
													</a>
												</div>
											</li>

										</div>

										<div class="col-md-8 tab-content">

											<!---<div class="tab-pane " id="b-profile">

													<form  class="form-horizontal form-groups-bordered validate" target="_top" method="post" accept-charset="utf-8" novalidate="novalidate">

													<div class="form-group row align-items-center">
														<label class="col-sm-2 control-label">Select A Service</label>
														<div class="col-sm-9">
															<select name="active_sms_service" id="active_sms_service"  class="form-control">
															<option value="">Not Selected	</option>		                        		
																<option value="soft" <?php if ($default_sms == 'soft') {
																							echo 'selected';
																						} ?> >Soft.com</option>															
																<option value="disabled" <?php if ($default_sms == 'disabled') {
																								echo 'selected';
																							} ?>>Disabled</option>
														</select>
														</div>
													</div>
													<div class="form-group row align-items-center">
														<div class="col-sm-offset-3 col-sm-9">
															<button type="submit" id ="default_sms" class="btn btn-dark waves-effect waves-light">Save</button>
														</div>
													</div>
												</form>						
											</div>-->

											<div class="tab-pane active" id="v-profile">
												<form class="form-horizontal form-groups-bordered validate" id="sms_form" target="_top" method="post" accept-charset="utf-8" novalidate="novalidate">
													<div class="form-group row align-items-center">
														<label class="col-sm-2 control-label">URL</label>
														<div class="col-sm-9">
															<input type="text" class="form-control" name="soft_url" id="soft_url" value="<?php echo $Common_Function->get_system_settings($conn, 'soft_url'); ?>" required="required">
														</div>
													</div>
													<div class="form-group row align-items-center">
														<label class="col-sm-2 control-label">Sender</label>
														<div class="col-sm-9">
															<input type="text" class="form-control" name="soft_sender" id="soft_sender" value="<?php echo $Common_Function->get_system_settings($conn, 'soft_sender'); ?>" required="">
														</div>
													</div>
													<div class="form-group row align-items-center">
														<label class="col-sm-2 control-label">Username</label>
														<div class="col-sm-9">
															<input type="text" class="form-control" name="soft_user" id="soft_user" value="<?php echo $Common_Function->get_system_settings($conn, 'soft_user'); ?>" required="">
														</div>
													</div>
													<div class="form-group row align-items-center">
														<label class="col-sm-2 control-label">Password</label>
														<div class="col-sm-9">
															<input type="password" class="form-control" name="soft_password" id="soft_password" value="<?php echo $Common_Function->get_system_settings($conn, 'soft_password'); ?>" required="">
														</div>
													</div>
													<div class="form-group row align-items-center">
														<label class="col-sm-2 control-label"></label>
														<div class="col-sm-offset-3 col-sm-9">
															<button type="submit" id="default_sms" class="btn btn-dark waves-effect waves-light">Save</button>
														</div>
													</div>
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

	</div>
</div>
<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->
<script src="js/admin/sms_settings.js"> </script>