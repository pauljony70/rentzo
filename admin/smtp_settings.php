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
						<h4 class="page-title">SMTP Settings</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="bs-example widget-shadow" data-example-id="hoverable-table">

								<div class="form-three widget-shadow">


									<form class="form-horizontal form-groups-bordered validate" target="_top" method="post" accept-charset="utf-8" novalidate="novalidate">
										<div class="form-group row align-items-center">
											<label class="col-sm-3 control-label m-0">Protocol</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="smtp_protocol" id="smtp_protocol" value="<?php echo $Common_Function->get_system_settings($conn, 'smtp_protocol'); ?>" required="">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-3 control-label m-0">SMTP Host</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="smtp_host" id="smtp_host" value="<?php echo $Common_Function->get_system_settings($conn, 'smtp_host'); ?>" required="">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-3 control-label m-0">SMTP Port</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="smtp_port" id="smtp_port" value="<?php echo $Common_Function->get_system_settings($conn, 'smtp_port'); ?>" required="">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-3 control-label m-0">SMTP Username</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="smtp_user" id="smtp_user" value="<?php echo $Common_Function->get_system_settings($conn, 'smtp_user'); ?>" required="">
											</div>
										</div>

										<div class="form-group row align-items-center">
											<label class="col-sm-3 control-label m-0">SMTP Password</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="smtp_password" id="smtp_password" value="<?php echo $Common_Function->get_system_settings($conn, 'smtp_password'); ?>" required="">
											</div>
										</div>
										<div class="form-group row align-items-center mb-0">
											<div class="col-sm-offset-3 col-sm-9">
												<button type="submit" class="btn btn-dark waves-effect waves-light" id="smtp_btn">Update</button>
											</div>
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

<script>
	var code_ajax = $("#code_ajax").val();


	$(document).ready(function() {
		$("#smtp_btn").click(function(event) {
			event.preventDefault();


			var smtp_protocol = $('#smtp_protocol').val();
			var smtp_host = $('#smtp_host').val();
			var smtp_port = $('#smtp_port').val();
			var smtp_user = $('#smtp_user').val();
			var smtp_password = $('#smtp_password').val();


			if (!smtp_protocol) {
				successmsg("Please enter SMTP Protocol");

			} else if (!smtp_host) {
				successmsg("Please enter SMTP Host");

			} else if (!smtp_port) {
				successmsg("Please enter SMTP Port");

			} else if (!smtp_user) {
				successmsg("Please enter SMTP Username");

			} else if (!smtp_password) {
				successmsg("Please enter SMTP Password");

			} else {
				$.busyLoadFull("show");
				var form_data = new FormData();

				form_data.append('smtp_protocol', smtp_protocol);
				form_data.append('smtp_host', smtp_host);
				form_data.append('smtp_port', smtp_port);
				form_data.append('smtp_user', smtp_user);
				form_data.append('smtp_password', smtp_password);


				form_data.append('type', 'smtp_settings');
				form_data.append('code', code_ajax);
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

	})
</script>
<!-- Modal -->
<!-- <div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
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
</div> -->