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
						<h4 class="page-title">Script Settings</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-md-9">
					<div class="card">
						<div class="card-body">
							<div class="bs-example widget-shadow" data-example-id="hoverable-table">

								<div class="form-three widget-shadow">


									<form class="form-horizontal form-groups-bordered validate" target="_top" method="post" accept-charset="utf-8" novalidate="novalidate">
										<div class="form-group row align-items-center">
											<label class="col-sm-3 control-label m-0">Google Script</label>
											<div class="col-sm-9">
												<textarea rows="8"  class="form-control" name="google_script" id="google_script"><?php echo $Common_Function->get_system_settings($conn, 'google_script'); ?></textarea>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-3 control-label m-0">Facebook Pixel</label>
											<div class="col-sm-9">
												<textarea rows="8" class="form-control" name="facebook_pixel" id="facebook_pixel"><?php echo $Common_Function->get_system_settings($conn, 'facebook_pixel'); ?></textarea>
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-3 control-label m-0">Tag Manager</label>
											<div class="col-sm-9">
												<textarea rows="8" class="form-control" name="tag_manager" id="tag_manager"><?php echo $Common_Function->get_system_settings($conn, 'tag_manager'); ?></textarea>
											</div>
										</div>
										
										<div class="form-group row align-items-center mb-0">
											<div class="col-sm-offset-3 col-sm-9 align-items-center">
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


			var google_script = $('#google_script').val();
			var facebook_pixel = $('#facebook_pixel').val();
			var tag_manager = $('#tag_manager').val();
			

			
				$.busyLoadFull("show");
				var form_data = new FormData();

				form_data.append('google_script', google_script);
				form_data.append('facebook_pixel', facebook_pixel);
				form_data.append('tag_manager', tag_manager);

				form_data.append('type', 'script_settings');
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
			
		});

	})
</script>
