<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $HomepageSettings)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>
<style>
	#country-list {
		float: left;
		list-style: none;
		margin-top: -3px;
		padding: 0;
		width: 190px;
		position: absolute;
	}

	#country-list li {
		padding: 10px;
		background: #f0f0f0;
		border-bottom: #bbb9b9 1px solid;
	}

	#country-list li:hover {
		background: #ece3d2;
		cursor: pointer;
	}

	#search-box {
		padding: 10px;
		border: #a8d4b1 1px solid;
		border-radius: 4px;
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
						<h4 class="page-title">All Home Category</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div data-example-id="simple-form-inline">
								<div class="row align-items-center">
									<div class="col-md-8 mb-2">
										<button type="button" class="btn btn-danger waves-effect waves-light waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal">Add Home category</button>
									</div>
									<div class="col-md-4 mb-2">
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

												<th>Category</th>
												<th>Order</th>

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
<!--//footer-->
<script>
	var code_ajax = $("#code_ajax").val();
	var pageno = 1;
	var rowno = 0;


	function getBanners(pagenov, rownov) {
		$.busyLoadFull("show");
		var perpage = $('#perpage').val();
		// successmsg( "sdfs" );
		var count = 1;
		$.ajax({
			method: 'POST',
			url: 'get_homecat_data.php',
			data: {
				code: code_ajax,
				page: pagenov,
				rowno: rownov,
				perpage: perpage

			},
			success: function(response) {
				$.busyLoadFull("hide");
				var parsedJSON = $.parseJSON(response);
				$("#cat_list").empty();

				var total_records = parsedJSON["totalrowvalue"];
				$("#totalrowvalue").html(total_records);
				$("#cat_order").attr('max', (total_records - 1));
				var data = parsedJSON.data;
				$(data).each(function() {

					var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td id="edittd' + this.id + '"> ' + this.cat_order + '</td>';
					html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" id="editbtn' + this.id + '" name="edit" onclick="editBanners(' + this.id + ', ' + this.cat_order + ', ' + total_records + ');">EDIT</button>';
					html += '<button style=" margin-left: 10px;display:none" type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" id="savebtn' + this.id + '" name="edit" onclick="updateBanners(' + this.id + ', ' + this.cat_order + ', ' + total_records + ');">UPDTE</button>';
					html += '<button style=" margin-left: 10px;display:none" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" id="cancelbtn' + this.id + '" name="edit" onclick="cancel(' + this.id + ', ' + this.cat_order + ', ' + total_records + ');">CANCEL</button>';
					html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete"  id="deletebtn' + this.id + '" onclick="deleteBanners(' + this.id + ');">DELETE</button>';

					html += '</td></tr>';
					$("#cat_list").append(html);

					count = count + 1;
				});



			}
		});
	}

	$(document).ready(function() {
		getBanners(pageno, rowno);

		$("#add_banner_btn").click(function(event) {
			event.preventDefault();

			var banner_type = 1;
			var cat_order = $("#cat_order").val();
			var cat_id = $(".check_category_limit:radio:checked").val();
			var type = '';
			if (banner_type == 1) {
				if ($('.check_category_limit:radio:checked').length == 0) {
					successmsg("Please select atleast one Category");
				} else {
					type = 'yes';
				}
			}
			if (type == 'yes') {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('banner_type', banner_type);
				form_data.append('cat_id', cat_id);
				form_data.append('code', code_ajax);
				form_data.append('cat_order', cat_order);

				$.ajax({
					method: 'POST',
					url: 'add_homecat_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");
						$("#myModal").modal('hide');
						$("input:radio").attr("checked", false);
						getBanners(1, 0)
						successmsg(response);

					}
				});
			}

		});



	});

	function editBanners(id, order, total_records) {
		document.getElementById("editbtn" + id).style.display = "none";
		document.getElementById("deletebtn" + id).style.display = "none";
		document.getElementById("savebtn" + id).style.display = "block";
		document.getElementById("cancelbtn" + id).style.display = "block";

		document.getElementById("edittd" + id).innerHTML = "<input type='number' id='new_orders" + id + "' min='0' max='" + (total_records - 1) + "' value='" + order + "'>";

	}

	function cancel(id, order, total_records) {
		document.getElementById("editbtn" + id).style.display = "block";
		document.getElementById("deletebtn" + id).style.display = "block";
		document.getElementById("savebtn" + id).style.display = "none";
		document.getElementById("cancelbtn" + id).style.display = "none";

		document.getElementById("edittd" + id).innerHTML = order;

	}

	function updateBanners(id, order, total_records) {
		var new_orders = document.getElementById("new_orders" + id).value;

		if (!new_orders) {
			successmsg("Please enter Category Order");
		} else {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('id', id);
			form_data.append('code', code_ajax);
			form_data.append('new_orders', new_orders);

			$.ajax({
				method: 'POST',
				url: 'add_homecat_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function(response) {
					$.busyLoadFull("hide");
					document.getElementById("editbtn" + id).style.display = "block";
					document.getElementById("deletebtn" + id).style.display = "block";
					document.getElementById("savebtn" + id).style.display = "none";
					document.getElementById("cancelbtn" + id).style.display = "none";

					document.getElementById("edittd" + id).innerHTML = new_orders;
					successmsg(response);

				}
			});
		}


	}

	function deleteBanners(id) {

		xdialog.confirm('Are you sure want to delete?', function() {
			$.busyLoadFull("show");
			$.ajax({
				method: 'POST',
				url: 'add_homecat_process.php',
				data: {
					deletearray: id,
					code: code_ajax
				},
				success: function(response) {
					$.busyLoadFull("hide");
					if (response == 'Failed to Delete.') {
						successmsg("Failed to Delete.");
					} else if (response == 'Deleted') {
						$("#tr" + id).remove();
						successmsg("Home Category Deleted Successfully.");
					} else {

					}
				}
			});
		}, {
			style: 'width:420px;font-size:0.8rem;',
			buttons: {
				ok: 'yes ',
				cancel: 'no '
			},
			oncancel: function() {
				// console.warn('Cancelled!');
			}
		});
	}
</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Home Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="add_brand_form" enctype="multipart/form-data">


					<div class="form-group" id="parent_cat_div">
						<label for="name">Select Category</label>
						<div class="dropdownss">
							<div id="treeSelect">
								<div class="pt-2 pl-2">
									<?php

									$query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND status='1' ORDER BY cat_name ASC");

									if ($query->num_rows > 0) {
										while ($row = $query->fetch_assoc()) {
											$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status='1' ");
											if ($query1->num_rows > 0) {
												echo '<span class="expand" ><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
											<br />    
											<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';
												echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
												echo	'</ul>';
											} else {
												echo '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
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
													echo '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
												<br />    
												<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';
													echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
													echo '</ul>';
												} else {
													echo '<li><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit"> ' . $row['cat_name'] . '</li>';
												}
											}
										}
									}
									?>
								</div>
							</div>

						</div>

					</div>

					<div class="form-group">
						<label for="">Home Category Order</label>
						<input type="number" name="cat_order" id="cat_order" class="form-control" min="0" required>
					</div>
					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_banner_btn">Add</button>
				</form>
			</div>

		</div>

	</div>
</div>