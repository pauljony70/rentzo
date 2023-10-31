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
						<h4 class="page-title">All Phrase</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div data-example-id="simple-form-inline">
								<div class="row align-items-center">
									<div class="col-md-6 mb-2">
										<button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal" style="width:157px;">Add Phrase</button>
									</div>
									<div class="col-md-6 mb-2">
										<!-- <div class="d-flex align-items-center">
											<div class="ml-md-auto">
												<div class="d-flex align-items-center">
													<span>Show</span>
													<select class="form-control mx-1" id="perpage" name="perpage" onchange="perpage_filter()" style="float:left;">
														<option value="10">10</option>
														<option value="25">25</option>
														<option value="50">50</option>
													</select>
													<span class="pull-right per-pag">entries</span>
												</div>
											</div>
										</div> -->
									</div>
								</div>
							</div>
							<div class="work-progres">


								<!----PHRASE EDITING TAB STARTS-->
								<?php
								$stmt = $conn->prepare("SELECT id,language_id,phrase,message FROM language_phrase WHERE language_id='" . $_REQUEST['id'] . "' ");

								$stmt->execute();
								$data = $stmt->bind_result($col1, $col2, $col3, $col4);
								$return = array();
								$i = 0;

								?>
								<!-- <div class="tab-pane <?php if (isset($edit_profile)) echo 'active'; ?>" id="edit"> -->
								<div class="row" id="phrase_div">
									<?php while ($stmt->fetch()) {  ?>
										<div class="col-sm-12 col-md-3 col-lg-3">
											<div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
												<div class="card-header">
													<?php echo $col3; ?>
												</div>
												<div class="card-body">
													<div class="form-group">
														<input type="text" class="form-control" name="updated_phrase" value="<?php echo $col4; ?>" id="phrase-<?php echo $col3; ?>">
													</div>
													<button type="button" class="btn btn-dark waves-effect waves-light edit-success" style="float: right;margin-top:4px;" id="btn-<?php echo $col3; ?>" onclick="updatePhrase('<?php echo $col3; ?>')"><i class="fa fa-check"></i> </button>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
								<!-- </div> -->
								<?php ?>
								<!----PHRASE EDITING TAB ENDS-->

								<div class="clearfix"> </div>

							</div>

							<div class="col_1">


								<div class="clearfix"> </div>

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
<script>
	var code_ajax = $("#code_ajax").val();

	function getAttribute(key) {
		var html = ' <div class="col-sm-12 col-md-3 col-lg-3">';
		html += ' <div class="panel" style="border: 1px solid #efefef; box-shadow: 3px 4px 20px 5px rgb(245 245 245);">';
		html += ' <div class="panel-header" style=" padding: 8px; padding-left: 15px; border-bottom: 1px solid #efefef;">';
		html += key + '</div>';
		html += ' <div class="panel-body">';
		html += ' <p><input type="text" class="form-control" name="updated_phrase" value="" id = "phrase-' + key + '"></p>';
		html += ' <button type="button" class="btn btn-dark waves-effect waves-light edit-success" style="float: right;margin-top:4px;" id = "btn-' + key + '" onclick="updatePhrase(\'' + key + '\')"><i class = "fa fa-check"></i> </button>';
		html += ' </div> </div> </div>';

		$("#phrase_div").append(html);

	}


	$(document).ready(function() {

		$("#add_Phrase").click(function(event) {
			event.preventDefault();

			var namevalue = $('#name').val();

			if (!namevalue) {
				successmsg("Please enter language");
			} else {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('namevalue', namevalue);

				form_data.append('type', 'add_phrase');
				form_data.append('code', code_ajax);

				$.ajax({
					method: 'POST',
					url: 'add_language_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");

						var data = $.parseJSON(response);
						if (data["status"] == "1") {
							successmsg(data["msg"]);
						} else {
							successmsg(response);
						}
						$("#myModal").modal('hide');


						$('#name').val('');
					}
				});
				getAttribute(namevalue);
			}

		});

	});

	function updatePhrase(key) {

		$('#btn-' + key).attr('disabled', true);
		$('#phrase-' + key).attr('disabled', true);
		var updatedValue = $('#phrase-' + key).val();
		var currentEditingLanguage = '<?php echo $_REQUEST["id"]; ?>';

		if (!updatedValue) {
			successmsg("Please enter Phrase message.");
		} else {
			$.busyLoadFull("show");
			$.ajax({
				type: "POST",
				url: "add_language_process.php",
				data: {
					updatedValue: updatedValue,
					currentEditingLanguage: currentEditingLanguage,
					key: key,
					type: 'update_phrase',
					code: code_ajax
				},
				success: function(response) {
					$('#btn-' + key).attr('disabled', false);
					$('#phrase-' + key).attr('disabled', false);
					$.busyLoadFull("hide");

					var data = $.parseJSON(response);
					if (data["status"] == "1") {
						successmsg(data["msg"]);
					} else {
						successmsg(response);
					}
				}
			});
		}
	}
</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Phrase</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="add_attribute_form" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Phrase</label>
						<input type="text" class="form-control" id="name" placeholder="Phrase">
					</div>


					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_Phrase">Add</button>
				</form>
			</div>

		</div>

	</div>
</div>