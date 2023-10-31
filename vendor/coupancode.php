<?php
include('session.php');


if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">All Coupan Code</h4>
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
										<button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal">Add Coupan Code</button>
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
												<th>ID</th>
												<th>Coupan Code</th>
												<th>Description</th>
												<th>Value(%)</th>
												<th>Cap Value(<?php echo $currency; ?>)</th>
												<th>Min. Order(<?php echo $currency; ?>)</th>
												<th>From Date</th>
												<th>To Date</th>
												<th>Apply Times</th>
												<th>Status</th>
												<th>Action</th>

											</tr>
										</thead>
										<tbody id="cat_list">

										</tbody>
									</table>
								</div>
							</div>


							<div class="col_1">


								<div class="clearfix"> </div>

							</div>

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
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$(function() {
		$("#fromdate").datepicker({
			dateFormat: "yy-mm-dd"
		});
		$("#todate").datepicker({
			dateFormat: "yy-mm-dd"
		});
	});


	function counapm_type1() {
		var counapm_type = $("#counapm_type").val();

		if (counapm_type == 1) {
			$("#cvaluelbl").text('Value(%)');
			$("#cvalue").attr('placeholder', 'Coupan Value in %');
		} else if (counapm_type == 2) {
			$("#cvaluelbl").text('Value(<?php echo $currency; ?>)');
			$("#cvalue").attr('placeholder', 'Coupan Value in <?php echo $currency; ?>');
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
				<h4 class="modal-title">Add Coupan Code</h4>
			</div>
			<div class="modal-body">
				<form class="form" id="add_brand_form" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Coupan Code</label>
						<input type="text" class="form-control" id="cname" placeholder="Coupan Code">
					</div>

					<div class="form-group">

						<label for="name">Coupan Description</label>

						<input type="text" class="form-control" id="cdesc" placeholder="Coupan Description">

					</div>

					<div class="form-group">
						<label for="name">Coupan Type</label>
						<select class="form-control1" id="counapm_type" onchange="counapm_type1()">

							<option value="1">Percentage</option>
							<option value="2"><?php echo $currency; ?></option>

						</select>
					</div>
					<div class="form-group">
						<label for="name" id="cvaluelbl">Value(%)</label>
						<input type="number" class="form-control" id="cvalue" min="0" placeholder="Coupan Value in %">
					</div>

					<div class="form-group">
						<label for="name">Cap Value(<?php echo $currency; ?>)</label>
						<input type="number" class="form-control" id="capvalue" min="0" placeholder="Max Discount value in <?php echo $currency; ?>">
					</div>

					<div class="form-group">
						<label for="name">Min Order(<?php echo $currency; ?>)</label>
						<input type="number" class="form-control" id="minorder" min="0" placeholder="Min Order value in <?php echo $currency; ?>">
					</div>
					<div class="form-group">
						<label for="name">No. of times user apply</label>
						<input type="number" class="form-control" id="user_apply" min="0" placeholder="No. of times single user can apply the same coupon">
					</div>

					<div class="form-group">
						<label for="name">Start Date</label>
						<input type="text" class="form-control" id="fromdate" readonly placeholder="YYYY-MM-DD">
					</div>
					<div class="form-group">
						<label for="name">End Date</label>
						<input type="text" class="form-control" id="todate" readonly placeholder="YYYY-MM-DD">
					</div>
					<div class="form-group">

						<label for="name">Terms & Conditions</label>
						<input type="text" class="form-control" id="terms" placeholder="Terms & Conditions">

					</div>
					<button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="addCoupan">Add</button>

				</form>
			</div>

		</div>

	</div>
</div>

<script src="js/admin/coupan-code.js"></script>