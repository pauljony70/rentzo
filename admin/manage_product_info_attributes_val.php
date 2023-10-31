<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
} else if (!isset($_REQUEST['attribute_id'])) {
	header("Location: manage_product_info_attributes.php");
}
$stmt1 = $conn->prepare("SELECT attribute FROM product_info_set WHERE id ='" . $_REQUEST['attribute_id'] . "'");
$stmt1->execute();
$data = $stmt1->bind_result($col11);
while ($stmt1->fetch()) {
	$main_attr = $col11;
}

if ($stmt1->num_rows == 0) {
	header("Location: manage_product_info_attributes.php");
}

?>
<?php include("header.php"); ?>

<style>
	#style1,
	#style2 {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		background-color: transparent;
		width: 44px;
		height: 45px;
		border: none;
		cursor: pointer;
	}

	#style1::-webkit-color-swatch,
	#style2::-webkit-color-swatch {
		border-radius: 20px;
		border: 1px solid #ced4da;
	}

	#style1::-moz-color-swatch,
	#style2::-moz-color-swatch {
		border-radius: 20px;
		border: 1px solid #ced4da;
	}
</style>


<input type="hidden" class="form-control" id="main_attribute_id" value="<?php echo $_REQUEST['attribute_id']; ?>">
<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">All Attribute Value</h4>
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
										<button type="button" class="btn btn-dark waves-effect waves-light" onclick="back_page();"><i class="fa fa-arrow-left"></i> Back</button>
										<button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal">Add Attribute Value</button>
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
												<th>Sno</th>
												<th>Main Attributes</th>
												<th>Attributes (ENG)</th>
												<th>Attributes (Arabic)</th>
												<th>Color</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="cat_list">
										</tbody>
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
<script src="js/admin/manage_product_info_attributes_val.js"></script>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Attributes</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="add_attributes_form" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name">Attributes (ENG)</label>
						<input type="text" class="form-control" id="attributes" placeholder="Attributes">
					</div>
					<div class="form-group">
						<label for="name">Attributes (Arabic)</label>
						<input type="text" class="form-control" id="attributes_ar" placeholder="Attributes">
					</div>
					<div class="form-group">
						<label for="choose-colour">Choose Colour Code</label>
						<div class="d-flex align-items-center" style="height: 45px;">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="color-check-box" style="margin-top: -5px;">
							</div>
							<input type="color" id="style1" style="display: none;" />
						</div>
					</div>
					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_attributes_btn">Add</button>
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
				<h5 class="modal-title">Edit Attributes</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="update_attributes_form" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name">Attributes</label>
						<input type="text" class="form-control" id="update_attributes" placeholder="Attributes">
					</div>
					<div class="form-group">
						<label for="name">Attributes (Arabic)</label>
						<input type="text" class="form-control" id="update_attributes_ar" placeholder="Attributes">
					</div>
					<div class="form-group">
						<label for="choose-colour">Choose Colour Code</label>
						<div class="d-flex align-items-center" style="height: 45px;">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="update-color-check-box" style="margin-top: -5px;">
							</div>
							<input type="color" id="style2" style="display: none;" />
						</div>
					</div>
					<input type="hidden" class="form-control" id="attribute_id">
					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_attributes_btn">Update </button>
				</form>
			</div>

		</div>

	</div>
</div>

<script>
	const color_check_box = document.getElementById('color-check-box');
	const update_color_check_box = document.getElementById('update-color-check-box');
	const color_input1 = document.getElementById('style1');
	const color_input2 = document.getElementById('style2');
	color_check_box.addEventListener('change', () => {
		if (color_check_box.checked) {
			color_input1.style.cssText = 'display: block;';
		} else {
			color_input1.style.cssText = 'display: none;';
		}
	});
	update_color_check_box.addEventListener('change', () => {
		if (update_color_check_box.checked) {
			color_input2.style.cssText = 'display: block;';
		} else {
			color_input2.style.cssText = 'display: none;';
		}
	});
</script>