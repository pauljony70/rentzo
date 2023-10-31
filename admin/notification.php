<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $FirebaseNoti)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

include("header.php");


?>

<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Send Notification Page</h4>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="bs-example widget-shadow" data-example-id="hoverable-table">

								<div class="form-three widget-shadow">

									<form class="form" id="add_notifications_form" method="post" enctype="multipart/form-data">


										<div class="form-group">
											<label for="name">Enter Notification Title</label>
											<input type="text" class="form-control" name="title" id="title" placeholder="Enter Title">
										</div>
										<div class="form-group">
											<label for="">Enter Notification Body</label>
											<input id="body" name="body" type="text" class="form-control" placeholder="Enter Body" required>
											<input id="link" name="action" value="sendNotification" type="hidden" class="form-control" placeholder="send notification" required>
										</div>
										<div class="form-group">
											<label class="text-normal" for="">Image Link</label>
											<input type="file" class="form-control-file" name="notification_image" id="notification_image" onchange="uploadFile1('notification_image')" placeholder="Enter Team Image Link">
										</div>
										<div class="form-group">
											<label for="">Select Click Type</label>
											<select onchange="type_data_change(event)" data-placeholder="Select Type" name="type" id="type" class="form-control">
												<option value="">Select Type</option>
												<option value="1">Product</option>
												<option value="2">Category</option>
												<option value="3">Search</option>
												<option value="4">Home</option>
											</select>
										</div>
										<div style="display:none;" id="div_search" class="form-group">
											<label for="name">Enter Search Name</label>
											<input type="text" class="form-control" name="search" id="search" placeholder="Enter Search Name">
										</div>
										<div style="display:none;" id="div_product">
											<div class="form-group">
												<label>Select Seller</label>
												<select class="form-control" id="selectseller" name="selectseller" onchange="get_seller_related_product()">
												</select>
											</div>
											<div class="form-group">
												<label>Products</label>
												<select class="form-control related_prod" id="selectupsell" name="selectupsell">
												</select>
											</div>
										</div>
										<div style="display:none;" id="div_category" class="form-group">
											<label>Category Set</label>

											<input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

											<div id="treeSelect">
												<ul id="myUL">
													<?php

													$query = $conn->query("SELECT * FROM category WHERE parent_id = '0'  AND status ='1' ORDER BY cat_name ASC");

													if ($query->num_rows > 0) {
														while ($row = $query->fetch_assoc()) {
															//echo "SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' ";
															$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "'  AND status ='1'");
															//	print_r($query1);
															if ($query1->num_rows > 0) {
																echo '<li><span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><label class="mainList">' . $row['cat_name'] . '</label></li>
													 
																<ul id="ul' . $row['cat_id'] . '" class="subList" style="display:block;">';
																echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
																echo	'</ul>';
															} else {
																echo '<li><span class="expand"><input type="checkbox" name="category" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><label class="mainList"> ' . $row['cat_name'] . '</label></li>
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
																	echo '<li><span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><label class="mainList">' . $row['cat_name'] . '</label></li>
													 
																	<ul id="ul' . $row['cat_id'] . '" class="subList" style="display:block;">';
																	echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
																	echo '</ul>';
																} else {
																	echo '<li><input type="checkbox" name="cid" id="cid" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> <label class="mainList"> ' . $row['cat_name'] . '</label></li>';
																}
															}
														}
													}

													?>
												</ul>
											</div>
										</div>

										<button type="submit" class="btn btn-dark waves-effect waves-light">Send </button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="clearfix"> </div>

		</div>

	</div>

</div>
<!--footer-->
<?php include("footernew.php"); ?>
<script>
	function type_data_change(event) {
		var selectElement = event.target;
		var value = selectElement.value;
		//alert(value);
		if (value == 3) {
			$("#div_search").show();
		} else {
			$("#div_search").hide();
		}
		if (value == 1) {
			$("#div_search").hide();
			$("#div_product").show();
		} else {
			$("#div_product").hide();
		}
		if (value == 2) {
			$("#div_search").hide();
			$("#div_product").hide();
			$("#div_category").show();
		} else {
			$("#div_category").hide();
		}


		//$("#price").html(this.price);
		//alert(value);
	}
</script>

<script>
	var code_ajax = $("#code_ajax").val();

	//$(document).ready(function(){
	$(document).on('submit', '#add_notifications_form', function(event) {
		//$("#update_meta_btn").click(function(event){
		event.preventDefault();
		//alert('dddd');

		var file_data = $('#notification_image').prop('files')[0];
		var form_data = new FormData();
		form_data.append('notification_image', file_data);


		$.ajax({

			url: 'add_notification_process.php',

			type: "POST",

			dataType: "json",

			data: new FormData(this),

			processData: false,

			contentType: false,

			beforeSend: function() {



			},

			success: function(response) {
				successmsg("Send Notification Successfully.");
				$('#title').val('');
				$('#body').val('');
				$('#notification_image').val('');
				$('#type').val('');
				$('#selectupsell').val('');
				$('#selectseller').val('');
				$('#myInput').val('');
				$('#search').val('');
				$('#cid').val('');
			},

			error: function(error) {

				hideloader();

				console.log(error);

			}

		});


	});
	//});
</script>
<!--//footer-->
<script src="js/admin/add-product.js"></script>