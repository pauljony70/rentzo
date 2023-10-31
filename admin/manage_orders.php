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

<style>
	/* Style the tab */
	.tab {
		overflow: hidden;
		border: 1px solid #FFAA66;
		background-color: #FFF5E5; /* #FFE6BF #FFEDD1 #FFF5E5 */
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
		/* display: none; */
		padding: 6px 12px;
		border: 1px solid #ccc;
		border-top: none;
	}
</style>


<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">


			<br>
			<div class="tab">
				<button class="tablinks active" id="defaultOpen" data-type="all" onclick="opendata(event, 'all')">All</button>
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
										<div class="col-md-9 mb-2">
											<div class="d-flex flex-wrap" style="display: none;">
												<input type="text" placeholder="Search Order ID.." class="form-control mr-1" name="search" style="width:180px;" id="search_name">
												<!-- <select class="form-control mr-1" id="orderstatus" name="orderstatus" style="width:180px;" required>
													<option value="all">Status</option>
													<option value="completed">Completed</option>
													<option value="pending">Pending</option>
													<option value="cancelled">Cancelled</option>
												</select> -->
												<button type="submit" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" id="searchName"><i class="fa fa-search"></i></button>
											</div>
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
										<table class="table" id="tblname" style="overflow-x: auto;">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Product Name</th>
													<th>OrderID</th>
													<th>User Type</th>
													<th>PaymentID</th>
													<th>Amount</th>
													<th>Quantity</th>
													<th>Payment Mode</th>
													<th>Order Date</th>
													<th>Payment Status</th>
													<th>Order Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="tbodyPostid"></tbody>
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
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
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
<script src="js/admin/manage_orders.js"></script>
<script>
	function singlequote(text) {
		return `"${text}"`;
	}


	document.getElementById("defaultOpen").click();
</script>


<!--//footer-->