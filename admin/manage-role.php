<?php
include('session.php');
if (!$Common_Function->user_module_premission($_SESSION, $Role)) {
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
						<h4 class="page-title">All Role</h4>
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
										<button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal" style="width:157px;">Add Role</button>
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
									<input type="hidden" id="last_cat" value="0">
									<table class="table table-hover" id="tblname">
										<thead>
											<tr>
												<th>Sno</th>
												<th>Title</th>
												<th style="width: 60%;">Modules Premission</th>

												<th>Action</th>
											</tr>
										</thead>
										<tbody id="cat_list"> </tbody>
									</table>
								</div>
								<div class="clearfix"> </div>
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
<script src="js/admin/role.js"></script>
<!--//footer-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="form-group">
					<label for="name">Title</label>
					<input type="text" class="form-control" id="name" placeholder="Role Name" required> </input>
				</div>
				<div class="form-group">
					<label for="image">Module Premission</label>
					<table class="table table-hover" id="tblname">
						<tbody id="">
							<tr>
								<td><input type="checkbox" name="premission[]" value="<?php echo $ManageSeller; ?>" class="premission"> Manage Seller </td>
								<td><input type="checkbox" name="premission[]" value="<?php echo $Category; ?>" class="premission"> Manage Category </td>
							</tr>
							<tr>
								<td><input type="checkbox" name="premission[]" value="<?php echo $Brand; ?>" class="premission"> Manage Brand </td>
								<td><input type="checkbox" name="premission[]" value="<?php echo $CouponCode; ?>" class="premission"> Manage Coupon Code </td>
							</tr>
							<tr>
								<td><input type="checkbox" name="premission[]" value="<?php echo $ProductAttributes; ?>" class="premission"> Manage Product Attributes </td>
								<td><input type="checkbox" name="premission[]" value="<?php echo $Product; ?>" class="premission"> Manage Product</td>
							</tr>
							<tr>
								<td><input type="checkbox" name="premission[]" value="<?php echo $HomepageSettings; ?>" class="premission"> Manage Homepage Settings </td>
								<td><input type="checkbox" name="premission[]" value="<?php echo $Orders; ?>" class="premission"> Manage Orders</td>
							</tr>
							<tr>
								<td><input type="checkbox" name="premission[]" value="<?php echo $StoreSettings; ?>" class="premission"> Manage Store Settings</td>
								<td><input type="checkbox" name="premission[]" value="<?php echo $AppUser; ?>" class="premission"> Manage App User</td>
							</tr>
							<tr>
								<td><input type="checkbox" name="premission[]" value="<?php echo $DeliveryBoy; ?>" class="premission"> Manage Delivery Boy </td>
								<td><input type="checkbox" name="premission[]" value="<?php echo $ProductReview; ?>" class="premission"> Manage Product Review </td>

							</tr>
							<tr>
								<td><input type="checkbox" name="premission[]" value="<?php echo $Support; ?>" class="premission"> Support Chat </td>
								<td>-</td>

							</tr>
						</tbody>
					</table>
				</div>
				<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_role_btn">Add</button>
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
				<h5 class="modal-title">Update Role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="update_category_form">

			</div>

		</div>

	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModalbrandassign" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Assign Role</h4>
			</div>
			<div class="modal-body" id="myModalbrandassigndivy">

			</div>

		</div>

	</div>
</div>