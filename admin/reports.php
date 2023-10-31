<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
}

include("header.php"); ?>
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<style>
	.select2.select2-container {
		width: 200px !important;
	}
</style>

<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="content">

			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Total Orders</h4>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="activity_box">
										<header class="widget-header">

											<div class="dropdown" style="float: right;margin-top:4px;">
												<button class="btn btn-dark waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" id="revenue_btn" value="current_month"><span id="btn_text">All Orders</span>
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu dropdown-menu-right" id="revenue_ul">
													<li data-value="all" class="dropdown-item"><a href="#" class="text-dark">All Orders</a></li>
													<li data-value="last_week" class="dayLink dropdown-item" id="1"><a class="text-dark" href="#" id="current">Last 7 Days</a></li>
													<li data-value="current_month" class="dayLink dropdown-item" id="2"><a class="text-dark" href="#" id="current">Current Month</a></li>
													<li data-value="monthly" class="dayLink dropdown-item" id="3"><a class="text-dark" href="#">Year</a></li>
													<li data-value="custom" class="dayLink dropdown-item" id="4"><a class="text-dark" href="#">Custom</a></li>
													<li class="divider dropdown-item"></li>

												</ul>
											</div>

											<div class="custom_div" style="display:none;float: right;margin-top:-8px;">
												<div style="float: right; margin-top: 12px;">
													<input class="btn btn-dark waves-effect waves-light custom_range mr-1" type="button" name="send" value="go" />
												</div>
												<div style="float: right;margin-top:-9px;" class="mr-1">
													<span>To</span>
													<input class="form-control" type="date" name="end_date" id="end_date">
												</div>
												<div style="float: right;margin-top:-9px;" class="mr-1">
													<span>From</span>
													<input class="form-control" type="date" name="start_date" id="start_date">
												</div>
											</div>
										</header>
										<!--<div>
											<div id="chartdiv1" style="height:400px;"></div>
										</div>	-->
										<div class="chart-container">
											<canvas id="mycanvas"></canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>


							<div data-example-id="simple-form-inline">

								<div class="row align-items-center">
									<div class="col-md-10 mb-2">
										<form class="form d-flex flex-wrap">

											<input type="text" placeholder="Search.." class="form-control mr-1" name="search" style="width:200px;" id="search_name">
											<!--<select class="form-control" id="export" name="export"> 
												<option value="">Get Data</option>
												<option value="1">Export Data</option>
												</select>-->
											<select class="form-control select_data mr-1" id="seller" name="seller"> </select>
											<input type="date" name="from_date" class="form-control mr-1" id="from_date" style="width:170px;">
											<input type="date" name="to_date" class="form-control mr-1" id="to_date" style="width:170px;">
											<button type="submit" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" id="searchName"><i class="fa fa-search"></i></button>
										</form>
									</div>
									<div class="col-md-2 mb-2">
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
									<div class="col-md-6 mb-2">
										<h4 class="m-0">All Orders</h4>
									</div>
									<div class="col-md-6 mb-2">
										<div class="float-md-right">
											<form action="export_excel.php" method="post">
												<input type="hidden" name="search_name_exp" id="search_name_exp">
												<input type="hidden" name="seller_exp" id="seller_exp">
												<input type="hidden" name="from_date_exp" id="from_date_exp">
												<input type="hidden" name="to_date_exp" id="to_date_exp">
												<button class="btn btn-success waves-effect waves-light" type="submit">Export</button>
											</form>
										</div>
									</div>
									</form>

								</div>


							</div>

							<div class="work-progres">
								<div class="table-responsive">
									<table class="table table-hover" id="tblname" style="overflow-x: auto;">
										<thead class="thead-light">
											<tr>
												<th>OrderID</th>
												<th>Business Name</th>
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


							<!--<div class="col_1">
								<div class="col-md-12">
									<div class="activity_box">					
										<header class="widget-header">			
											<h2>New Seller
												<div class="dropdown" style="float: right;">
												<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" id="new_seller_btn" value="current_month"><span id="new_seller_btn_text">Current Month</span>
													<span class="caret"></span></button>
													<ul class="dropdown-menu" id="new_seller_ul">									
														<li data-value="current_month"><a href="#">Current Month</a></li>
														<li data-value="monthly"><a href="#">Monthly</a></li>									
														<li class="divider"></li>									
														<li data-value="custom"><a href="#">Custom</a></li>
													</ul>
												</div>
											</h2>						
										</header>					
										<div>
											<div id="chartdiv_new_seller" style="height:400px;"></div>
										</div>				
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
							</br>
		
							<div class="col_1">
								<div class="col-md-4 span_8">
									<div class="activity_box">
										<h2>Pending New Products</h2>
										<div class="scrollbar" id="style-2">
										
										</div>
									<button type="button" class="btn btn-primary pull-right" style="margin: 11px;" onclick="redirect_page('pending_products.php')">View All</button>
										
									</div>
								</div>
								<div class="col-md-4 span_8">
									<div class="activity_box activity_box1">
										<h3>Pending New Brand</h3>
										<div class="scrollbar" id="style-3">
										
										</div>
									<button type="button" class="btn btn-primary pull-right" style="margin: 11px;" onclick="redirect_page('pending_brand.php')">View All</button>
									
									</div>
								</div>
								<div class="col-md-4 span_8">
									<div class="activity_box activity_box2">
										<h3>Pending New Category</h3>
										<div class="scrollbar" id="style-1">
											
										</div>
									<button type="button" class="btn btn-primary pull-right" style="margin: 11px;" onclick="redirect_page('pending_category.php')">View All</button>
									
									
									</div>
									<div class="clearfix"> </div>
								</div>
								
							</div> -->

						</div>
					</div>
				</div>
			</div>

		</div>

	</div>
	<div class="clearfix"> </div></br>
	<!--footer-->


</div>
<?php include("footernew.php"); ?>
<script>
	$(document).ready(function() {
		$(".select_data").select2();
		document.getElementsByClassName('select2-container--default')[0].classList.add('mr-1');
	});
</script>
<!--//footer-->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> -->
<script src="<?php echo BASEURL; ?>assets/amchart/core.js"></script>
<script src="<?php echo BASEURL; ?>assets/amchart/charts.js"></script>
<script src="<?php echo BASEURL; ?>assets/amchart/animated.js"></script>
<script src="js/admin/report.js"></script>
<script src="js/admin/Chart.min.js"></script>
<script src="js/admin/manage_all_order_data.js"></script>