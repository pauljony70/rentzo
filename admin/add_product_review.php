<?php
include('session.php');


if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
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
						<h4 class="page-title">Add Product Review</h4>
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
									<form class="form-horizontal" id="myform" action="add_product_review_process.php" method="post" enctype="multipart/form-data">
										<input type="hidden" name="code" value="<?php echo $code_ajax; ?>" />






										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select User **</label>
											<div class="col-sm-8">
												<select class="form-control" id="selectuser" required name="selectuser">
												</select>
											</div>
										</div>


										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Select Product</label>
											<div id="example2" class="col-sm-8">
												<select class="form-control related_prod" id="selectproduct" required name="selectproduct[]" multiple>
												</select>

												<br>
											</div>
										</div>


										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Review Title</label>
											<div id="example2" class="col-sm-8">
												<input type="text" class="form-control" name="title" required id="title" placeholder="Review Title" />
											</div>
										</div>



										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Review Rating **</label>
											<div class="col-sm-8">
												<select class="form-control" id="rating" required name="rating">
													<option value="">Select Rating</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
											</div>
										</div>

										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Review Comment</label>
											<div id="example2" class="col-sm-8">
												<textarea class="form-control" name="comment" required id="comment" placeholder="Review Comment"></textarea>
											</div>
										</div>

										<div class="col-sm-offset-2">
											<button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="addProduct_btn">Save</button>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Configurations</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-sm-8" id="add_more_attr_btndiv">
					<a class="fa fa-plus fa-4 btn btn-primary" aria-hidden="true" onclick="add_more_attrs();">Add More Attributes</a>
				</div><br><br>
				<form class="form-horizontal" id="myform_attr">
					<div class="form-group" id="selectattrs_div">
						<label for="focusedinput" class="col-sm-2 control-label m-0">Select Attributes</label>
						<div class="col-sm-9">
							<div class="input-files">
								<div style="vertical-align: middle; margin-top:5px;">
									<select class="form-control" id="selectattrs" name="selectattrs[]" onchange="select_attr_val('selectattrs');" required style="float:left; display: inline-block; margin-right:20px;width:150px;">
									</select>
									<div id="cselectattrs"></div>
								</div><br>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark waves-effect waves-light" id="manage_configurations_btn" onclick=" return manage_configurations();">Add Configurations</button>
			</div>
		</div>

	</div>
</div>

<div class="col_1">


	<div class="clearfix"> </div>

</div>
<?php include("footernew.php"); ?>
<script src="js/admin/add_product_review.js"></script>