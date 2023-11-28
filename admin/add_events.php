<?php
include('session.php');


if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>
<style>
	.switch {
		position: relative;
		display: block;
		vertical-align: top;
		width: 66.5px;
		height: 30px;
		padding: 3px;
		margin: 0 10px 10px 0;
		background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
		background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
		border-radius: 18px;
		box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
		cursor: pointer;
		box-sizing: content-box;
	}

	.switch-input {
		position: absolute;
		top: 0;
		left: 0;
		opacity: 0;
		box-sizing: content-box;
	}

	.switch-label {
		position: relative;
		display: block;
		height: inherit;
		font-size: 10px;
		text-transform: uppercase;
		background: #eceeef;
		border-radius: inherit;
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
		box-sizing: content-box;
	}

	.switch-label:before,
	.switch-label:after {
		position: absolute;
		top: 50%;
		margin-top: -.5em;
		line-height: 1;
		-webkit-transition: inherit;
		-moz-transition: inherit;
		-o-transition: inherit;
		transition: inherit;
		box-sizing: content-box;
	}

	.switch-label:before {
		content: attr(data-off);
		right: 11px;
		color: #aaaaaa;
		text-shadow: 0 1px rgba(255, 255, 255, 0.5);
	}

	.switch-label:after {
		content: attr(data-on);
		left: 11px;
		color: #FFFFFF;
		text-shadow: 0 1px rgba(0, 0, 0, 0.2);
		opacity: 0;
	}

	.switch-input:checked~.switch-label {
		background: #FF6600;
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
	}

	.switch-input:checked~.switch-label:before {
		opacity: 0;
	}

	.switch-input:checked~.switch-label:after {
		opacity: 1;
	}

	.switch-handle {
		position: absolute;
		top: 4px;
		left: 4px;
		width: 28px;
		height: 28px;
		background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
		background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
		border-radius: 100%;
		box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
	}

	.switch-handle:before {
		content: "";
		position: absolute;
		top: 50%;
		left: 50%;
		margin: -6px 0 0 -6px;
		width: 12px;
		height: 12px;
		background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
		background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
		border-radius: 6px;
		box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
	}

	.switch-input:checked~.switch-handle {
		left: 40px;
		box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
	}

	.switch-label,
	.switch-handle {
		transition: All 0.3s ease;
		-webkit-transition: All 0.3s ease;
		-moz-transition: All 0.3s ease;
		-o-transition: All 0.3s ease;
	}

	li {
		list-style-type: none;
	}
</style>



<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">

			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Add New Events</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="bs-example widget-shadow" data-example-id="hoverable-table">


								<div class="form-three widget-shadow">
									<form class="form-horizontal" id="add_brand_form" enctype="multipart/form-data">
										<input type="hidden" name="code" value="<?php echo $code_ajax; ?>" />

										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label mt-1" for="name">Event Name </label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="name" id="name" placeholder="Event Name">
											</div>
										</div>
										
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label mt-1" for="name">Image </label>
											<div class="col-sm-8">
												<input type="file" name="brand_image" id="event_image" class="form-control-file" onchange="uploadFile1('event_image')" accept="image/png, image/jpeg,image/jpg,image/gif">
											</div>
										</div>
										


										
										<!--<div class="form-group row">

											<label class="col-sm-2 control-label mt-1">Select Category **</label>


											<div class="dropdownss col-sm-8">

												<div id="treeSelect">
													<div class="p-2">
														<?php /*

														$query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND status='1' ORDER BY cat_name ASC");

														if ($query->num_rows > 0) {

															while ($row = $query->fetch_assoc()) {

																$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status='1' ");

																if ($query1->num_rows > 0) {

																	echo '<span class="expand" ><input type="radio" id="category" name="category" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>

																	<br />    

																	<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';

																	echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");

																	echo	'</ul>';
																} else {

																	echo '<span class="expand"><input type="radio" name="category" id="category" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>

																	<br />';
																}
															}
														}


 
														function categoryTree($parent_id, $sub_mark = '')
														{

															global $conn;

															$query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id AND status='1' ORDER BY cat_name ASC");



															if ($query->num_rows > 0) {

																while ($row = $query->fetch_assoc()) {



																	$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status='1' ");

																	if ($query1->num_rows > 0) {

																		echo '<span class="expand"><input type="radio" name="category" id="category" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>

																		<br />    

																		<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';

																		echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");

																		echo '</ul>';
																	} else {

																		echo '<li><input type="radio" name="category" id="category" value="' . $row['cat_id'] . '" class="check_category_limit"> ' . $row['cat_name'] . '</li>';
																	}
																}
															}
														}

														*/ ?>
													</div>
												</div>



											</div>



										</div>-->
										
										
										<div class="form-group row align-items-center">
											<label class="col-sm-2 control-label m-0">Category Set <span class="text-danger">&#42;&#42;</span> </label>
											<div id="example1" class="col-sm-8">
												<input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

												<div id="treeSelect">
													<ul id="myUL" class="pt-2">
														<?php

														$query = $conn->query("SELECT * FROM category WHERE parent_id = '0'  AND status ='1' ORDER BY cat_name ASC");

														if ($query->num_rows > 0) {
															while ($row = $query->fetch_assoc()) {
																//echo "SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' ";
																$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "'  AND status ='1'");
																//	print_r($query1);
																if ($query1->num_rows > 0) {
																	echo '<li><span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><label style="font-weight:bold" class="mainList ml-1">' . $row['cat_name'] . '</label></li>
																			 
																			<ul id="ul' . $row['cat_id'] . '" class="subList" style="display:block;">';
																	echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
																	echo	'</ul>';
																} else {
																	echo '<li><span class="expand"><input type="checkbox" name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><label class="mainList ml-1"> ' . $row['cat_name'] . '</label></li>
																			';
																}
															}
														}

														function categoryTree($parent_id, $sub_mark = '')
														{
															global $conn;
															$query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id  AND status ='1' ORDER BY cat_name ASC");

															if ($query->num_rows > 0) {
																while ($row = $query->fetch_assoc()) {

																	$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "'  AND status ='1'");
																	//	print_r($query1);
																	if ($query1->num_rows > 0) {
																		echo '<li><span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><label style="font-weight:bold" class="mainList">' . $row['cat_name'] . '</label></li>
																			 
																			<ul id="ul' . $row['cat_id'] . '" class="subList" style="display:block;">';
																		echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
																		echo '</ul>';
																	} else {
																		echo '<li><input type="checkbox" name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> <label class="mainList"> ' . $row['cat_name'] . '</label></li>';
																	}
																}
															}
														}

														?>
													</ul>
												</div>
											</div>
										</div>
										
										



										<div class="col-sm-offset-2">
											<button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="add_brand_btn">Save</button>
										</div>


									</form>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="clearfix"> </div>

	</div>





	<div class="clearfix"> </div>

</div>

<!-- Modal -->
<!-- <div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:100%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Configurations</h4>
			</div>
			<div class="modal-body">
				<div class="col-sm-8" id="add_more_attr_btndiv">
					<a class="fa fa-plus fa-4 btn btn-primary" aria-hidden="true" onclick="add_more_attrs();">Add More Attributes</a>
				</div><br><br>
				<form class="form-horizontal" id="myform_attr">
					<div class="form-group row align-items-center" id="selectattrs_div">
						<label for="focusedinput" class="col-sm-2 control-label">Select Attributes</label>
						<div class="col-sm-9">
							<div class="input-files">
								<div style="vertical-align: middle; margin-top:5px;">
									<select class="form-control" id="selectattrs" name="selectattrs[]" onchange="select_attr_val('selectattrs');" required style="float:left; display: inline-block; margin-right:20px;width:150px;">
									</select>
									<div id="cselectattrs"></div>
								</div><br>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark waves-effect waves-light" id="manage_configurations_btn" onclick=" return manage_configurations();">Add Configurations</button>
			</div>
		</div>

	</div>
</div> -->

<div class="col_1">


	<div class="clearfix"> </div>

</div>
<?php include("footernew.php"); ?>
<script src="js/admin/add_events.js"></script>
<script>

</script>