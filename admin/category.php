<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Category)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<style>
	li {
		list-style-type: none;
	}
</style>

<!-- main content start-->
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
						<h4 class="page-title">All Category</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<!-- <header class="widget-header">
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				<div class="pull-right" style="float:left;"> </div>

				<h4 class="widget-title">
					<ul class="breadcrumb" style="margin-top:5px;" id="category_bradcumb">
						<li id="li0"><a href="javascript:void(0)"><span onclick="getCategory_bradcumb(0)"><i class="fa fa-home"></i> Home</span></a></li>
					</ul>


				</h4>
			</header> -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<button type="button" class="btn btn-danger waves-effect waves-light mb-2" id="add_categogy_btn">Add Category</button>
							<div class="table-responsive">
								<input type="hidden" id="last_cat" value="0">
								<table class="table table-hover table-centered" id="tblname">
									<thead>
										<tr>
											<th>Sno</th>
											<th>Order</th>
											<th>Image</th>
											<th>Web banner</th>
											<th>App banner</th>
											<th>Category</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="cat_list"> </tbody>
								</table>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col_1">
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->
<script src="js/admin/category.js"></script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="new_cat_div"> </div>
				<div class="form-group">
					<label for="name">Name (ENG)</label>
					<input type="text" class="form-control" id="name" placeholder="Category Name" required> </input>
				</div>
				<!--<div class="form-group">
					<label for="name">Name (Arabic)</label>
					<input type="text" class="form-control" id="name_ar" placeholder="Category Name" required> </input>
				</div>-->

				<div class="form-group">
					<label for="name">Sub Title</label>
					<input type="text" class="form-control" id="sub_title" placeholder="Sub Title" required> </input>
				</div>
				<!--<div class="form-group">
					<label for="name">Sub Title (Arabic)</label>
					<input type="text" class="form-control" id="sub_title_ar" placeholder="Sub Title" required> </input>
				</div>-->

				<div class="form-group">
					<label for="image">Image</label>
					<input type="file" name="cat_image" class="form-control-file" id="cat_image" required onchange="uploadFile1('cat_image')" accept="image/png, image/jpeg,image/jpg,image/gif">
				</div>
				<div class="catbanners" style="display:none;">
					<div class="form-group">
						<label for="image">Website banner</label>
						<input type="file" name="web_banner" class="form-control-file" id="web_banner" onchange="uploadFile1('web_banner')" accept="image/png, image/jpeg,image/jpg,image/gif">
					</div>
					<div class="form-group">
						<label for="image">App banner</label>
						<input type="file" name="app_banner" class="form-control-file" id="app_banner" onchange="uploadFile1('app_banner')" accept="image/png, image/jpeg,image/jpg,image/gif">
					</div>
				</div>
				<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_category_btn">Add</button>
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
				<h5 class="modal-title">Update Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="update_category_form">
					<div class="form-group">
						<label for="name">Category Order </label>
						<input type="number" class="form-control" id="cat_order">
						<input type="hidden" id="cat_id_update">
					</div>
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="update_name" placeholder="Category Name" required> </input>
					</div>
					<!--<div class="form-group">
						<label for="name">Name (Arabic)</label>
						<input type="text" class="form-control" id="update_name_ar" placeholder="Category Name" required> </input>
					</div>-->

					<div class="form-group">
						<label for="name">Sub Title (ENG)</label>
						<input type="text" class="form-control" id="update_sub_title" placeholder="Sub Title" required> </input>
					</div>
					<!--<div class="form-group">
						<label for="name">Sub Title (Arabic)</label>
						<input type="text" class="form-control" id="update_sub_title_ar" placeholder="Sub Title" required> </input>
					</div>-->
					<div class="form-group">
						<label for="name">Status</label>
						<select class="form-control" id="statuss" name="status">
							<option value="">Select</option>
							<option value="0">Pending</option>
							<option value="1">Active</option>
							<option value="3">Deactive</option>
						</select>
					</div>
					<div class="form-group">
						<label for="image">Image</label>
						<input type="file" name="cat_image_update" class="form-control-file" id="cat_image_update" onchange="uploadFile1('cat_image_update')" accept="image/png, image/jpeg,image/jpg,image/gif">
					</div>
					<div class="catbanners" style="display:none;">
						<div class="form-group">
							<label for="image">Website banner</label>
							<input type="file" name="web_banner_update" class="form-control-file" id="web_banner_update" onchange="uploadFile1('web_banner_update')" accept="image/png, image/jpeg,image/jpg,image/gif">
						</div>
						<div class="form-group">
							<label for="image">App banner</label>
							<input type="file" name="app_banner_update" class="form-control-file" id="app_banner_update" onchange="uploadFile1('app_banner_update')" accept="image/png, image/jpeg,image/jpg,image/gif">
						</div>
					</div>
					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_category_btn">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalbrandassign" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Assign Category</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body" id="myModalbrandassigndivy"> </div>
		</div>
	</div>
</div>