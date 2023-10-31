<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductReview)) {
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
						<h4 class="page-title">All Pending Reviews</h4>
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
									<div class="col-12 mb-2">
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
												<th>User Name</th>
												<th>Producte</th>
												<th>Title</th>
												<th>Rating</th>
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
<script src="js/admin/product_review.js"></script>
<!--//footer-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Review</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="name">User</label>
					<input type="text" class="form-control" readonly id="user_name">
				</div>
				<div class="form-group">
					<label for="name">Product</label>
					<input type="text" class="form-control" readonly id="product_name">
				</div>
				<div class="form-group">
					<label for="name">Review Title</label>
					<input type="text" class="form-control" readonly id="review_title">
				</div>
				<div class="form-group">
					<label for="name">Review Rating</label>
					<input type="text" class="form-control" readonly id="review_rating">
				</div>
				<div class="form-group">
					<label for="name">Review Comment</label>
					<textarea class="form-control" id="review_comment" readonly> </textarea>
				</div>

				<input type="hidden" id="review_ids">
				<input type="hidden" id="product_ids">
				<button type="submit" class="btn btn-dark waves-effect waves-light" value="pprove" href="javascript:void(0)" onclick="approve_review();">Approve</button>
				<button type="submit" class="btn btn-danger waves-effect waves-light" value="Delete" href="javascript:void(0)" onclick="reject_review()">Delete</button>

			</div>

		</div>

	</div>
</div>