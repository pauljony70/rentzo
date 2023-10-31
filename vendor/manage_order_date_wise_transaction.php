<?php

include('session.php');


if (!isset($_SESSION['admin'])) {

	header("Location: index.php");
}



?>

<?php include("header.php"); ?>


<input type="hidden" id="payment_id" value="<?php echo $_REQUEST['id']; ?>">

<!-- main content start-->

<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Manage Orders</h4>
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
									<div class="col-md-9">
										<div class="d-flex flex-wrap">

											<input type="text" placeholder="Search.." class="form-control mr-1" name="search" style="width:200px;" id="search_name">

											<select class="form-control mr-1" id="orderstatus" name="orderstatus" style="width:200px;" required>

												<option value="">Status</option>

												<option value="pending">Pending</option>

												<option value="Shipped">Ready To Ship</option>

												<option value="completed">Completed</option>

												<option value="cancelled">Cancelled</option>

												<option value="Return Request">Return Request</option>

												<option value="Returned Completed">Return Completed</option>

												<option value="RTO">RTO</option>

											</select>

											<button type="submit" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" id="searchName"><i class="fa fa-search"></i></button>

										</div>
									</div>

									<div class="col-md-3">

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

								<hr class="widget-separator">

								<div class="table-responsive">

									<table class="table" id="tblname" style="overflow-x: auto;">

										<thead class="thead-light">

											<tr>

												<th>OrderID</th>

												<th>Quantity</th>

												<th>Amount</th>

												<th>TDS</th>

												<th>TCS</th>

												<th>Gross Amount</th>

												<th>GST</th>

												<th>Net Amount</th>

												<th>Order Date</th>

												<th>Order Status</th>

											</tr>

										</thead>

										<tbody id="tbodyPostid">

										</tbody>

									</table>

								</div>

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
					</div>
				</div>
			</div>

		</div>

		<div class="clearfix"></div>

	</div>
</div>

<!-- //calendar -->





<div class="col_1">

	<div class="clearfix"> </div>

</div>


<!--footer-->

<?php include("footernew.php"); ?>

<!--//footer-->
<script src="js/admin/manage_order_date_wise_transaction.js"></script>