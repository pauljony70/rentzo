<?php
include('session.php');

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
						<div class="page-title-right">
							<ol class="breadcrumb m-0" id="category_bradcumb">
								<li class="breadcrumb-item" id="li0" onclick="getCategory_bradcumb(0)"><a href="javascript: void(0);"><i class="fa fa-home"></i> Home</a></li>
								<!-- <li class="breadcrumb-item active">Datatables</li> -->
							</ol>
						</div>
						<h4 class="page-title">Category</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<button type="button" class="btn btn-danger waves-effect waves-light mb-2" id="add_categogy_btn">Add Category</button>

							<div class="table-responsive"><input type="hidden" id="last_cat" value="0">
								<table class="table table-hover" id="tblname">
									<thead class="thead-light">
										<tr>
											<th>Sno</th>
											<th>Order</th>
											<th>Image</th>

											<th>Category</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="cat_list">
									</tbody>
								</table>
							</div>

							<div class="clearfix"> </div>

						</div>
					</div>
				</div>
			</div>



			<div class="col_1">


				<div class="clearfix"> </div>

			</div>

		</div>
	</div>
</div>
<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="add_category_form">
					<div id="new_cat_div"> </div>
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" placeholder="Category Name" required> </input>
					</div>
					<div class="form-group">
						<label for="image">Image</label>
						<input type="file" name="cat_image" class="form-control-file" id="cat_image" required onchange="uploadFile1('cat_image')" accept="image/png, image/jpeg,image/jpg,image/gif">
					</div>
					<button type="submit" class="btn btn-danger" value="Upload" href="javascript:void(0)" id="add_category_btn">Add</button>

				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="js/admin/category.js"></script>