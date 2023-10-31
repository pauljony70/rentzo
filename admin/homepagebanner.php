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
						<h4 class="page-title">All Banners</h4>
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
									<div class="col-6 mb-2">
										<button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal" style="width:157px;">Add Banners</button>
									</div>
									<div class="col-6 mb-2">
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
										<thead>
											<tr>
												<th>Sno</th>

												<th>Title</th>
												<th>Layout</th>
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
			url: 'get_homebanners_data.php',
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

				$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
				$(".page_div").html(parsedJSON["page_html"]);

				var data = parsedJSON.data;
				$(data).each(function() {

					var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.title + '</td><td > ' + this.layout + '</td><td > ' + this.orders + '</td>';
					html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="View" onclick="viewBanners(' + this.id + ');">View Banner</button>';
					html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deleteBanners(' + this.id + ');">DELETE</button>';
					html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editBanners("' + this.id + '","' + this.title + '","' + this.layout_id + '", "' + this.orders + '", "' + this.count_order + '");\'>EDIT</button>';

					html += '</td></tr>';
					$("#cat_list").append(html);

					count = count + 1;
				});



			}
		});
	}

	function editBanners(id, title, layout, order, count_order) {
		$("#banner_order_update").attr('max', (count_order - 1));
		$("#myModalupdate").modal('show');
		$("#banner_layoutupdate").val(layout);
		$("#banner_title_update").val(title);
		$("#banner_order_update").val(order);
		$("#banner_id_update").val(id);


	}

	$(document).ready(function() {
		getBanners(pageno, rowno);


		$("#add_banner_btn").click(function(event) {
			event.preventDefault();

			var banner_layout = $('#banner_layout').val();
			var banner_title = $('#banner_title').val();
			var banner_order = $('#banner_order').val();

			if (!banner_layout) {
				successmsg("Please select Banner layout");
			} else if (!banner_title) {
				successmsg("Please enter Banner title");
			} else if (!banner_order) {
				successmsg("Please enter Banner order");
			}

			if (banner_layout && banner_title) {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('banner_layout', banner_layout);
				form_data.append('banner_title', banner_title);
				form_data.append('banner_order', banner_order);
				form_data.append('code', code_ajax);

				$.ajax({
					method: 'POST',
					url: 'add_homebanner_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");
						$("#myModal").modal('hide');

						$('#banner_layout').val('');
						$('#banner_title').val('');
						$('#banner_order').val('');
						getBanners(1, 0)
						successmsg(response);

					}
				});
			}

		});

		$("#update_banner_btn").click(function(event) {
			event.preventDefault();

			var banner_layout = $('#banner_layoutupdate').val();
			var banner_title = $('#banner_title_update').val();
			var banner_order = $('#banner_order_update').val();
			var banner_id_update = $('#banner_id_update').val();

			if (!banner_layout) {
				successmsg("Please select Banner layout");
			} else if (!banner_title) {
				successmsg("Please enter Banner title");
			} else if (!banner_order) {
				successmsg("Please enter Banner order");
			}

			if (banner_layout && banner_title) {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('banner_layout', banner_layout);
				form_data.append('banner_title', banner_title);
				form_data.append('banner_order', banner_order);
				form_data.append('banner_id_update', banner_id_update);
				form_data.append('code', code_ajax);

				$.ajax({
					method: 'POST',
					url: 'edit_homebanner_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");
						$("#myModalupdate").modal('hide');

						getBanners(1, 0)
						successmsg(response);

					}
				});
			}

		});



	});

	// AJAX call for autocomplete 
	$(document).ready(function() {
		$("#search-box").keyup(function() {
			$.ajax({
				type: "POST",
				url: "add_banner_process.php",
				data: 'keyword=' + $(this).val(),
				beforeSend: function() {
					$("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
				},
				success: function(data) {
					$("#suggesstion-box").show();
					$("#suggesstion-box").html(data);
					$("#search-box").css("background", "#FFF");
				}
			});
		});
	});
	//To select product name
	function selectCountry(val, id) {
		$("#search-box").val(val);
		$("#product-id").val(id);
		$("#suggesstion-box").hide();
	}

	function banner_type1() {
		var banner_type = $("#banner_type").val();
		if (banner_type == 1) {
			$("#parent_cat_div").show();
			$("#product_div").hide();
			$("#search_div").hide();
			$("#product-id").val('');
			$("#search-box").val('');
		} else if (banner_type == 3) {
			$("#search_div").show();
			$("#parent_cat_div").hide();
			$("#product_div").hide();
			$("#product-id").val('');
			$("#search-box").val('');
		} else {
			$("#parent_cat_div").hide();
			$("#search_div").hide();
			$("#product_div").show();
			$("input:radio").attr("checked", false);
		}
	}


	function deleteBanners(id) {

		xdialog.confirm('Are you sure want to delete?', function() {
			$.busyLoadFull("show");
			$.ajax({
				method: 'POST',
				url: 'add_homebanner_process.php',
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
						successmsg("Banner Deleted Successfully.");
					} else {
						$("#myModalbrandassign").modal('show');
						$("#myModalbrandassigndivy").html(response);
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

	function viewBanners(id) {
		location.href = 'add_home_banners.php?id=' + id;
	}
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Banners</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="add_brand_form" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Layout Type</label>
						<select class="form-control" id="banner_layout">

							<option value="">Select</option>
							<option value="0">Horizontal big product</option>
							<option value="7">Horizontal small category</option>
							<option value="8">Horizontal with background</option>
							<option value="1">2x2 grid</option>
							<option value="2">3x1 grid</option>
							<option value="3">Vertical</option>
							<option value="4">Small Banner</option>
							<option value="5">Small Banner with background</option>
							<option value="6">Big Banner</option>

						</select>
					</div>

					<div class="form-group">
						<label for="name">Banner Title</label>
						<input class="form-control" type="text" id="banner_title" name="banner_title">
					</div>
					<div class="form-group">
						<label for="name">Banner Order</label>
						<input class="form-control" type="number" id="banner_order" name="banner_order">
					</div>

					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_banner_btn">Add</button>
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
				<h5 class="modal-title">Edit Banners</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="update_category_form">
					<div class="form-group">
						<label for="name">Layout Type</label>
						<select class="form-control" id="banner_layoutupdate">

							<option value="">Select</option>
							<option value="0">Horizontal big product</option>
							<option value="7">Horizontal small category</option>
							<option value="8">Horizontal with background</option>
							<option value="1">2x2 grid</option>
							<option value="2">3x1 grid</option>
							<option value="3">Vertical</option>
							<option value="4">Small Banner</option>
							<option value="5">Small Banner with background</option>
							<option value="6">Big Banner</option>


						</select>
					</div>

					<div class="form-group">
						<label for="name">Banner Title</label>
						<input class="form-control" type="text" id="banner_title_update" name="banner_title">
					</div>
					<div class="form-group">
						<label for="name">Banner Order</label>
						<input class="form-control" type="number" id="banner_order_update" name="banner_order">
					</div>
					<input class="form-control" type="hidden" id="banner_id_update">
					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_banner_btn">Update</button>
				</form>
			</div>

		</div>

	</div>
</div>