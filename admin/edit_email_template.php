<?php
include('session.php');


if (!$Common_Function->user_module_premission($_SESSION, $StoreSettings)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}


if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php");

$stmt = $conn->prepare("SELECT id,email_title,email_subject,email_body FROM email_template WHERE id = " . $_GET['id'] . "");
$stmt->execute();
$data = $stmt->bind_result($col1, $col2, $col3, $col4);
$return = array();
$i = 0;
while ($stmt->fetch()) {
	$id = $col1;
	$email_title = $col2;
	$email_subject = $col3;
	$email_body = $col4;
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
						<h4 class="page-title">Edit Email Template</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<div class="bs-example widget-shadow" data-example-id="hoverable-table">
								<div class="row align-items-center">
									<div class="col-md-6 mb-2">
										<button id="back_btn" type="submit" class="btn btn-dark waves-effect waves-light" onclick="back_page('email_template.php');"><i class="fa fa-arrow-left"></i> Back</button>
									</div>
								</div>
								<div class="form-three widget-shadow">
									<div class="row">
										<div class="col-md-12">
											<form class="form-horizontal" id="myform"> 
												<!-- <a> ** required field</a> -->
												<div class="form-group">
													<label for="name">Email Title</label>
													<input type="text" class="form-control" id="email_title" value="<?php echo $email_title; ?>" placeholder="Email title">
												</div>
												<div class="form-group">
													<label for="name">Email Subject</label>
													<input type="text" class="form-control" id="email_subject" value="<?php echo $email_subject; ?>" placeholder="Email title">
												</div>
												<div class="form-group">
													<label for="name">Email Body</label><span> (Note: Please Don't Change Variables.)</span>
													<textarea class="form-control" id="email_content">
														<?php echo $email_body; ?>
													</textarea>
												</div>

												<div>
													<button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="add_template_btn">SAVE</button>
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
		<div class="clearfix"> </div>
	</div>
	<div class="clearfix"> </div>

	<div class="col_1">
		<div class="clearfix"> </div>
	</div>
</div>

<!--footer-->
<?php include("footernew.php"); ?>
<script>
	var code_ajax = $("#code_ajax").val();
	$(document).ready(function() {
		$("#add_template_btn").click(function(event) {
			event.preventDefault();
			var email_title = $('#email_title').val();
			var email_subject = $('#email_subject').val();
			var email_content = tinyMCE.get('email_content').getContent();
			if (!email_title) {
				successmsg("Please enter template title.");
			} else if (!email_subject) {
				successmsg("Please enter template title.");
			} else if (!email_content) {
				successmsg("Please enter template details.");
			} else if (email_content && email_title && email_subject) {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('email_title', email_title);
				form_data.append('email_subject', email_subject);
				form_data.append('email_content', email_content);
				form_data.append('type', 'update');
				form_data.append('code', code_ajax);
				form_data.append('id', '<?php echo $_GET["id"]; ?>');
				$.ajax({
					method: 'POST',
					url: 'add_email_template_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");
						successmsg(response);
					}
				});
			}
		});
		if ($("#email_content").length > 0) {
			tinymce.init({
				selector: "textarea#email_content",
				theme: "modern",
				height: 300,
				plugins: ["advlist lists print", "wordcount code fullscreen", "save table directionality emoticons paste textcolor"],
				toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
			});
		}
	});
</script>
<!--//footer-->