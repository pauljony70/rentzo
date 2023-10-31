<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
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
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">All Return Policy</h4>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">

							<div data-example-id="simple-form-inline">
								<div class="row align-items-center">
									<div class="col-md-6 mb-2">
										<button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal">Add Return Policy</button>
									</div>
									<div class="col-md-6 mb-2">
										<div class="d-flex align-items-center">
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
										</div>
									</div>
								</div>
							</div>

							<div class="work-progres">

								<div class="table-responsive">
									<table class="table table-hover" id="tblname">
										<thead class="thead-light">
											<tr>
												<th>Sno</th>
												<th>Return Policy</th>
												<th>Validity(Days)</th>
												<th>Type Accepted</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="cat_list">
										</tbody>
									</table>
								</div>
								<div class="clearfix"> </div>
								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="pull-right" style="float:left;">
											Total Row : <a id="totalrowvalue" class="totalrowvalue"></a>
										</div>
									</div>
									<div class="col-md-6">
										<div class="pull-right page_div ml-auto" style="float:right;"> </div>
									</div>
								</div>
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
<script src="js/admin/manage_return_policy.js"></script>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Return Policy</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="add_policy_form" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Return Policy Title</label>
						<input type="text" class="form-control" id="policy_title" placeholder="Policy title">
					</div>
					<div class="form-group">
						<label for="name">Validity(Days)</label>
						<input type="text" class="form-control" id="policy_validity" placeholder="Validity(Days)">
					</div>
					<div class="form-group">
						<label>Type Accepted</label><br>
						<div class="form-check form-check-inline">
							<input type="checkbox" class="form-check-input policy_type" id="policy_type_refund" value="1">
							<label class="form-check-label" for="policy_type_refund">Refund</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="checkbox" class="form-check-input policy_type" id="policy_type_replace" value="1">
							<label class="form-check-label" for="policy_type_replace">Replacement</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="checkbox" class="form-check-input policy_type" id="policy_type_exchange" value="1">
							<label class="form-check-label" for="policy_type_exchange">Exchange</label>
						</div>
					</div>
					<div class="form-group">
						<label for="name">Return Policy</label>
						<textarea class="form-control" id="policy_content"></textarea>
					</div>


					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_policy_btn">Add</button>
				</form>
			</div>

		</div>

	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalupdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Return Policy</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="update_country_form" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Return Policy Title</label>
						<input type="text" class="form-control" id="update_title" placeholder="Return Policy">
					</div>

					<div class="form-group">
						<label for="name">Validity(Days)</label>
						<input type="text" class="form-control" id="policy_validity_update" placeholder="Validity(Days)">
					</div>
					<div class="form-group">
						<label for="name">Type Accepted</label>
						<div class="form-check form-check-inline">
							<input type="checkbox" class="form-check-input policy_type_update" id="refund_update" value="1">
							<label class="form-check-label" for="refund_update">Refund</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="checkbox" class="form-check-input policy_type_update" id="replace_update" value="1">
							<label class="form-check-label" for="replace_update">Replacement</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="checkbox" class="form-check-input policy_type_update" id="exchange_update" value="1">
							<label class="form-check-label" for="exchange_update">Exchange</label>
						</div>
					</div>
					<div class="form-group">
						<label for="name">Status</label>
						<select class="form-control" id="statuss" name="status">
							<option value="">Select</option>
							<option value="0">Pending</option>
							<option value="1">Active</option>
							<option value="3">Deactive</option>
						</select>
					</div>
					<div class="form-group">
						<label for="name">Return Policy</label>
						<textarea class="form-control" id="update_policy_content"></textarea>
					</div>
					<input type="hidden" class="form-control" id="attribute_id">
					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_policy_btn">Update </button>
				</form>
			</div>

		</div>

	</div>
</div>