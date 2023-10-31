<?php
include('session.php');

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<style>
	/* Style the tab */
	.tab {
		overflow: hidden;
		border: 0.5px solid #FFAA66;
		background-color: #FFCC99;
	}

	/* Style the buttons inside the tab */
	.tab button {
		background-color: inherit;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 14px 16px;
		transition: 0.3s;
		font-size: 17px;
	}

	/* Change background color of buttons on hover */
	.tab button:hover {
		background-color: #FF6600;
		color: #fff;
	}

	/* Create an active/current tablink class */
	.tab button.active {
		background-color: #FF6600;
		color: #fff;
	}

	/* Style the tab content */
	.tabcontent {
		display: none;
		padding: 6px 12px;
		border: 1px solid #ccc;
		border-top: none;
	}
</style>

<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="content">
			<br>
			<div class="tab">
				<button class="tablinks" id="defaultOpen" data-type="all" onclick="opendata(event, 'all')">All</button>
				<button class="tablinks" data-type="pending" onclick="opendata(event, 'pending')">Pending</button>
				<button class="tablinks" data-type="accept" onclick="opendata(event, 'accept')">Pending To Shipping</button>
				<button class="tablinks" data-type="ready_to_ship" onclick="opendata(event, 'ready_to_ship')">Ready To Ship</button>
				<button class="tablinks" data-type="completed" onclick="opendata(event, 'completed')">Completed</button>
				<button class="tablinks" data-type="cancelled" onclick="opendata(event, 'cancelled')">Cancelled</button>
			</div>

			<div id="all" class="tabcontent">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">




								<div data-example-id="simple-form-inline">

									<div class="row align-items-center">
										<div class="col-md-9">

											<div class="d-flex flex-wrap" style="display:none !important">

												<input type="text" placeholder="Search.." class="form-control mr-1" name="search" style="width:180px;" id="search_name">

												<select class="form-control mr-1" id="orderstatus" name="orderstatus" style="width:180px;" required>
													<option value="">Status</option>
													<option value="completed">Completed</option>
													<option value="pending">Pending</option>
													<option value="cancelled">Cancelled</option>
												</select>

												<button type="submit" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" id="searchName"><i class="fa fa-search"></i></button>

											</div>
										</div>
										<div class="col-md-3">

											<div class="d-flex align-items-center">
												<div class="ml-md-auto">
													<div class="d-flex align-items-center">
														<span>Show</span>
														<select class="form-control mx-1" id="perpage_all" name="perpage" onchange="perpage_filter()" style="float:left;">
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
								</br>
								<div class="work-progres">

									<div class="table-responsive">
										<table class="table table-hover" id="tblname" style="overflow-x: auto;">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Product Name</th>
													<th>Order ID</th>
													<th>ProductID</th>
													<th>Attributes</th>
													<th>Quantity</th>
													<th>Total Price</th>
													<th>Shipping</th>
													<th>Order Status</th>
													<th>Date</th>
													<th>Action</th>

												</tr>
											</thead>
											<tbody id="tbodyPostid_all">

											</tbody>
										</table>
									</div>
								</div>

								<div class="clearfix"> </div>

								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="pull-right" style="float:left;">
											Total Row : <a id="totalrowvalue_all" class="totalrowvalue"></a>
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

			<div id="pending" class="tabcontent">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">




								<div data-example-id="simple-form-inline">

									<div class="row align-items-center">
										<div class="col-md-9">


										</div>
										<div class="col-md-3">

											<div class="d-flex align-items-center">
												<div class="ml-md-auto">
													<div class="d-flex align-items-center">
														<span>Show</span>
														<select class="form-control mx-1" id="perpage_pending" name="perpage" onchange="perpage_filter()" style="float:left;">
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
								</br>
								<div class="work-progres">

									<div class="table-responsive">
										<table class="table table-hover" id="tblname" style="overflow-x: auto;">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Product Name</th>
													<th>Order ID</th>
													<th>ProductID</th>
													<th>Attributes</th>
													<th>Quantity</th>
													<th>Total Price</th>
													<th>Shipping</th>
													<th>Order Status</th>
													<th>Date</th>
													<th>Action</th>

												</tr>
											</thead>
											<tbody id="tbodyPostid_pending">

											</tbody>
										</table>
									</div>
								</div>

								<div class="clearfix"> </div>

								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="pull-right" style="float:left;">
											Total Row : <a id="totalrowvalue_pending" class="totalrowvalue"></a>
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

			<div id="accept" class="tabcontent">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">




								<div data-example-id="simple-form-inline">

									<div class="row align-items-center">
										<div class="col-md-9">


										</div>
										<div class="col-md-3">

											<div class="d-flex align-items-center">
												<div class="ml-md-auto">
													<div class="d-flex align-items-center">
														<span>Show</span>
														<select class="form-control mx-1" id="perpage_accept" name="perpage" onchange="perpage_filter()" style="float:left;">
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
								</br>
								<div class="work-progres">

									<div class="table-responsive">
										<table class="table table-hover" id="tblname" style="overflow-x: auto;">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Product Name</th>
													<th>Order ID</th>
													<th>ProductID</th>
													<th>Attributes</th>
													<th>Quantity</th>
													<th>Total Price</th>
													<th>Shipping</th>
													<th>Order Status</th>
													<th>Date</th>
													<th>Action</th>

												</tr>
											</thead>
											<tbody id="tbodyPostid_accept">

											</tbody>
										</table>
									</div>
								</div>

								<div class="clearfix"> </div>

								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="pull-right" style="float:left;">
											Total Row : <a id="totalrowvalue_accept" class="totalrowvalue"></a>
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

			<div id="ready_to_ship" class="tabcontent">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">




								<div data-example-id="simple-form-inline">

									<div class="row align-items-center">
										<div class="col-md-9">


										</div>
										<div class="col-md-3">

											<div class="d-flex align-items-center">
												<div class="ml-md-auto">
													<div class="d-flex align-items-center">
														<span>Show</span>
														<select class="form-control mx-1" id="perpage_ready_to_ship" name="perpage" onchange="perpage_filter()" style="float:left;">
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
								</br>
								<div class="work-progres">

									<div class="table-responsive">
										<table class="table table-hover" id="tblname" style="overflow-x: auto;">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Product Name</th>
													<th>Order ID</th>
													<th>ProductID</th>
													<th>Attributes</th>
													<th>Quantity</th>
													<th>Total Price</th>
													<th>Shipping</th>
													<th>Order Status</th>
													<th>Date</th>
													<th>Action</th>

												</tr>
											</thead>
											<tbody id="tbodyPostid_ready_to_ship">

											</tbody>
										</table>
									</div>
								</div>

								<div class="clearfix"> </div>

								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="pull-right" style="float:left;">
											Total Row : <a id="totalrowvalue_ready_to_ship" class="totalrowvalue"></a>
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

			<div id="completed" class="tabcontent">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">




								<div data-example-id="simple-form-inline">

									<div class="row align-items-center">
										<div class="col-md-9">


										</div>
										<div class="col-md-3">

											<div class="d-flex align-items-center">
												<div class="ml-md-auto">
													<div class="d-flex align-items-center">
														<span>Show</span>
														<select class="form-control mx-1" id="perpage_completed" name="perpage" onchange="perpage_filter()" style="float:left;">
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
								</br>
								<div class="work-progres">

									<div class="table-responsive">
										<table class="table table-hover" id="tblname" style="overflow-x: auto;">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Product Name</th>
													<th>Order ID</th>
													<th>ProductID</th>
													<th>Attributes</th>
													<th>Quantity</th>
													<th>Total Price</th>
													<th>Shipping</th>
													<th>Order Status</th>
													<th>Date</th>
													<th>Action</th>

												</tr>
											</thead>
											<tbody id="tbodyPostid_completed">

											</tbody>
										</table>
									</div>
								</div>

								<div class="clearfix"> </div>

								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="pull-right" style="float:left;">
											Total Row : <a id="totalrowvalue_completed" class="totalrowvalue"></a>
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

			<div id="cancelled" class="tabcontent">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">




								<div data-example-id="simple-form-inline">

									<div class="row align-items-center">
										<div class="col-md-9">


										</div>
										<div class="col-md-3">

											<div class="d-flex align-items-center">
												<div class="ml-md-auto">
													<div class="d-flex align-items-center">
														<span>Show</span>
														<select class="form-control mx-1" id="perpage_cancelled" name="perpage" onchange="perpage_filter()" style="float:left;">
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
								</br>
								<div class="work-progres">

									<div class="table-responsive">
										<table class="table table-hover" id="tblname" style="overflow-x: auto;">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Product Name</th>
													<th>Order ID</th>
													<th>ProductID</th>
													<th>Attributes</th>
													<th>Quantity</th>
													<th>Total Price</th>
													<th>Shipping</th>
													<th>Order Status</th>
													<th>Date</th>
													<th>Action</th>

												</tr>
											</thead>
											<tbody id="tbodyPostid_cancelled">

											</tbody>
										</table>
									</div>
								</div>

								<div class="clearfix"> </div>

								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="pull-right" style="float:left;">
											Total Row : <a id="totalrowvalue_cancelled" class="totalrowvalue"></a>
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


		<div class="clearfix"></div>
	</div>
	<!-- //calendar -->

</div>
<div class="col_1">


	<div class="clearfix"> </div>

</div>

<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->
<script src="js/admin/manage_orders.js"></script>
<script>
	document.getElementById("defaultOpen").click();
</script>