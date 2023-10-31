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
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">All Currency</h4>
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
										<button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal" style="width:157px;">Add Currency</button>
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

								<div class="table-responsive">
									<table class="table table-hover" id="tblname">
										<thead class="thead-light">
											<tr>
												<th>Sno</th>
												<th>Currency</th>
												<th>Symbol</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="cat_list">
											<?php
											$stmt = $conn->prepare("SELECT id, name, symbol FROM currency ");
											//$stmt->bind_param( s,  $inactive );
											$stmt->execute();
											$data = $stmt->bind_result($col1, $col2, $col3);
											$return = array();
											$i = 0;
											while ($stmt->fetch()) {
												$i++;
												//echo html($col3);
											?>
												<tr>
													<td><?= $i; ?></td>
													<td><?= $col2; ?></td>
													<td><?= $col3; ?></td>
													<td>
														<button type="submit" class="btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand('<?= $col1; ?>');">DELETE</button>
														<button style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick='editbrand("<?= $col1; ?>","<?= $col2; ?>","<?= $col3; ?>")' ;>EDIT</button>
													</td>
												</tr>

											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="clearfix"> </div>
								<div class="row align-items-center">
									<?php
									$stmt1 = $conn->prepare("SELECT count(id) as counts FROM currency ");
									$stmt1->execute();
									$data1 = $stmt1->bind_result($col4);

									while ($stmt1->fetch()) {
										$total = $col4;
									}
									?>
									<div class="col-md-6">
										<div class="pull-right" style="float:left;">
											Total Row : <a id="totalrowvalue" class="totalrowvalue"><?= $total ?></a>
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
<script src="js/admin/manage_currency.js"></script>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Currency</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="add_attribute_form" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Currency</label>
						<input type="text" class="form-control" id="name" placeholder="Currency">
					</div>
					<div class="form-group">
						<label for="name">Symbol</label>
						<input type="text" class="form-control" id="symbol" placeholder="Symbol">
					</div>

					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_Currency">Add</button>
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
				<h5 class="modal-title">Edit Currency</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="update_brand_form" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Currency</label>
						<input type="text" class="form-control" id="update_name" placeholder="Currency">
					</div>
					<div class="form-group">
						<label for="name">Symbol</label>
						<input type="text" class="form-control" id="update_symbol" placeholder="Symbol">
					</div>

					<input type="hidden" class="form-control" id="attribute_id">
					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_currency">Update </button>
				</form>
			</div>

		</div>

	</div>
</div>