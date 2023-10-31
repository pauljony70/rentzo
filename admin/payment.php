<?php

include('session.php');





if (!$Common_Function->user_module_premission($_SESSION, $Orders)) {

	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {

	header("Location: index.php");
}
?>

<?php include("header.php"); ?>

<input type="hidden" name="seller_id" id="seller_id0" value="<?php echo $_REQUEST['id']; ?>">



<!-- main content start-->

<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">All Payments</h4>
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
									<div class="col-md-9 mb-2">
										<form class="form d-flex flex-wrap">

											<select class="form-control mr-1" id="orderstatus" name="orderstatus" style="width:150px;" required>

												<option value="">All Status</option>

												<option value="pending">Pending</option>

												<option value="completed">Completed</option>

											</select>

											<input type="date" class="form-control mr-1" name="from_date" style="width:130px;" id="from_date">

											<input type="date" class="form-control mr-1" name="to_date" style="width:130px;" id="to_date">

											<button type="submit" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" id="searchName"><i class="fa fa-search"></i></button>
										</form>
									</div>
									<div class="col-md-3 mb-2">
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

									<table class="table table-hover" id="tblname" style="overflow-x: auto;">

										<thead class="thead-light">

											<tr>

												<th>S.N.</th>
												<th>Seller</th>
												<th>Amount</th>
												<th>Dates</th>
												<th>Status</th>
												<th>Transection ID</th>
												<th>Action</th>


											</tr>

										</thead>

										<tbody id="tbodyPostid">



										</tbody>

									</table>

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

							<div class="clearfix"> </div>

						</div>
					</div>
				</div>
			</div>


		</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog  modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Payment</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="form" id="add_payment_form" enctype="multipart/form-data">

							<div class="form-group">
								<label for="name">Transection ID</label>
								<input type="text" class="form-control" id="transection_id" placeholder="Transection ID">
							</div>

							<div class="form-group">
								<label for="image">Invoice Image</label>
								<input type="file" name="invoice_proof" id="invoice_proof" class="form-control-file" onchange="uploadFile1('invoice_proof')" accept="image/png, image/jpeg,image/jpg,image/gif">
							</div>
							<input type="hidden" id="seller_id">
							<input type="hidden" id="paymant_id">
							<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_payment_btn">Add</button>
						</form>
					</div>

				</div>

			</div>
		</div>



		<div class="clearfix"></div>

	</div>

	<!-- //calendar -->

	<div class="col_1">

		<div class="clearfix"> </div>

	</div>



</div>


<!--footer-->

<?php include("footernew.php"); ?>
<script src="js/admin/payment.js"></script>
<!--//footer-->
<script>
	$(document).on("click", ".open-modal", function() {
		var id = $(this).data('id');
		var pay_id = $(this).data('pay_id');
		$('#seller_id').val(id);
		$('#paymant_id').val(pay_id);

	});
</script>