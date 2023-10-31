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
						<h4 class="page-title">All Language</h4>
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
										<button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal" style="width:157px;">Add Language</button>
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
												<th>Language</th>
												<th>Phrase</th>
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

<script>
	var code_ajax = $("#code_ajax").val();
	var pageno = 1;
	var rowno = 0;


	function getAttribute(pagenov, rownov) {
		$.busyLoadFull("show");
		var perpage = $('#perpage').val();
		// successmsg( "sdfs" );
		var count = 1;
		$.ajax({
			method: 'POST',
			url: 'get_language_data.php',
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

					var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="" onclick="get_phrase(' + this.id + ');">Edit Phrase</button></td>';
					html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

					html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.name + '")\';>EDIT</button></td></tr>';
					$("#cat_list").append(html);

					count = count + 1;
				});



			}
		});
	}


	$(document).ready(function() {
		getAttribute(pageno, rowno);


		$("#add_language").click(function(event) {
			event.preventDefault();

			var namevalue = $('#name').val();

			if (!namevalue) {
				successmsg("Please enter language");
			} else {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('namevalue', namevalue);

				form_data.append('type', 'add_language');
				form_data.append('code', code_ajax);

				$.ajax({
					method: 'POST',
					url: 'add_language_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");

						var data = $.parseJSON(response);
						if (data["status"] == "1") {
							successmsg(data["msg"]);
						} else {
							successmsg(response);
						}
						$("#myModal").modal('hide');

						getAttribute(1, 0)
						$('#name').val('');
					}
				});
			}

		});

		$("#update_language").click(function(event) {
			event.preventDefault();

			var namevalue = $('#update_name').val();
			var attribute_id = $('#attribute_id').val();

			if (!namevalue) {
				successmsg("Please enter language");
			} else {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('namevalue', namevalue);
				form_data.append('attribute_id', attribute_id);
				form_data.append('type', 'update_language');
				form_data.append('code', code_ajax);

				$.ajax({
					method: 'POST',
					url: 'add_language_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");
						var data = $.parseJSON(response);
						if (data["status"] == "1") {
							successmsg(data["msg"]);
						} else {
							successmsg(response);
						}
						$("#myModalupdate").modal('hide');
						$('#update_name').val('');
						$('#attribute_id').val('');
						getAttribute(1, 0);

					}
				});
			}

		});



	});

	function editbrand(id, name) {
		$("#myModalupdate").modal('show');
		$("#attribute_id").val(id);
		$("#update_name").val(name);
	}

	function deletebrand(id) {
		xdialog.confirm('Are you sure want to delete?', function() {
			$.busyLoadFull("show");
			$.ajax({
				method: 'POST',
				url: 'add_language_process.php',
				data: {
					deletearray: id,
					code: code_ajax,
					type: 'delete_language'
				},
				success: function(response) {
					$.busyLoadFull("hide");
					var data = $.parseJSON(response);
					if (data["status"] == "1") {
						successmsg(data["msg"]);
					} else {
						successmsg(response);
					}
					getAttribute(1, 0);
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


	function get_phrase(id) {
		location.href = 'language_phrase.php?id=' + id;
	}
</script>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Language</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="add_attribute_form" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Language</label>
						<input type="text" class="form-control" id="name" placeholder="Language">
					</div>


					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_language">Add</button>
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
				<h5 class="modal-title">Edit Language</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="update_brand_form" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Language</label>
						<input type="text" class="form-control" id="update_name" placeholder="Language">
					</div>


					<input type="hidden" class="form-control" id="attribute_id">
					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_language">Update </button>
				</form>
			</div>

		</div>

	</div>
</div>