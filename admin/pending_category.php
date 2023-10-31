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

<?php
// echo "class id is  ".$class_id;     
$inactive = "active";
$parentname = "";
$stmt = $conn->prepare("SELECT cat_id, cat_name, cat_img, parent_id, cat_order,status,cat_name_ar FROM category  WHERE status IN(0) ORDER BY cat_order ASC");

$stmt->execute();
$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $cat_name_ar);
$return = array();
$i = 0;
$final_arr = array();
while ($stmt->fetch()) {

	if ($col3) {
		$img_dec = json_decode($col3);
		$img = MEDIAURL . $img_dec->{'72-72'};
	} else {
		$img = '';
	}

	$arr['id']	= $col1;
	$arr['name']	= $col2;
	$arr['img']	= $img;
	$arr['parentid']	= $col4;
	$arr['statuss']	= $col6;
	$arr['orderno']	= $col5;
	$arr['cat_name_ar']	= $cat_name_ar;

	$final_arr[] = $arr;
}
function categoryTree1($parent_id)
{
	global $conn;
	$query = $conn->query("SELECT cat_name, parent_id FROM category WHERE cat_id = $parent_id ");

	$cat = '';
	if ($query->num_rows > 0) {
		while ($row = $query->fetch_assoc()) {
			if ($row['parent_id'] > 0) {
				$cat .=  $row['cat_name'] . '>>';
				$cat .= categoryTree1($row['parent_id']);
			} else {
				$cat .=  $row['cat_name'] . '>>';
			}
		}
	}
	return $cat;
}

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
						<div class="page-title-right">
							<ol class="breadcrumb m-0" id="category_bradcumb">
								<li class="breadcrumb-item" id="li0" onclick="getCategory_bradcumb(0)"><a href="javascript: void(0);"><i class="fa fa-home"></i> Home</a></li>
								<!-- <li class="breadcrumb-item active">Datatables</li> -->
							</ol>
						</div>
						<h4 class="page-title">All Pending Category</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-md-12 mb-2">
									<button type="button" class="btn btn-danger waves-effect waves-light" id="manage_configurations_btn" data-toggle="modal" data-target="#myModal" style="width:157px;">View Category</button>
								</div>
							</div>
							<div class="work-progres">

								<div class="table-responsive"><input type="hidden" id="last_cat" value="0">
									<table class="table table-hover table-centered" id="tblname">
										<thead class="thead-light">
											<tr>
												<th>Sno</th>
												<th>Order</th>
												<th>Image</th>

												<th>Category</th>
												<th>Category Arabic</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="cat_list">
											<?php
											foreach ($final_arr as $arr1) {
												$i++;
												$cat = '';
												$query = $conn->query("SELECT cat_name, parent_id FROM category WHERE cat_id = '" . $arr1['id'] . "'");

												if ($query->num_rows > 0) {
													while ($row = $query->fetch_assoc()) {
														if ($row['parent_id'] > 0) {

															$cat .=  categoryTree1($row['parent_id']);
														}
													}
												}

												$cat_explode = array_filter(explode('>>', $cat));

												$a = array_reverse($cat_explode);
												$cat_new = '';
												if (count($a) > 0) {
													$cat_new = implode(" >> ", $a) . ' >> ';
												}
												$cat_new .=  $arr1['name'];
											?>
												<tr id="tr<?php echo $arr1['id']; ?>">
													<td><?php echo $i; ?> </td>
													<td><?php echo $arr1['orderno']; ?> </td>
													<td><img src="<?php echo $arr1['img']; ?>" style="width: 72px; height: 72px;"> </td>
													<td><?php echo $cat_new; ?></td>
													<td><?php echo $arr1['cat_name_ar']; ?></td>
													<td>Pending</td>
													<td>
														<div class="d-flex">
															<?php echo $Common_Function->select_reject_reason($conn, $arr1['id']); ?>
															<button type="submit" class="btn btn-danger waves-effect waves-light btn-sm pull-left ml-1" name=" delete" onclick="deleteCategory('<?php echo $arr1['id']; ?>');">Reject</button>
															<button type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left ml-1" name="edit" onclick='verifyCategory("<?php echo $arr1['id']; ?>")' ;>Approve</button>
														</div>
													</td>

												</tr>
											<?php
											}

											?>
										</tbody>
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
<!--//footer-->
<script>
	var code_ajax = $("#code_ajax").val();
	var parentvalue = 0;




	function deleteCategory(cat_id) {
		var rejectreason = $("#rejectreason" + cat_id).val();

		if (!rejectreason) {
			successmsg("Please select Reject Reason.");
		} else {
			xdialog.confirm('Are you sure want to reject category?', function() {
				$.busyLoadFull("show");
				$.ajax({
					method: 'POST',
					url: 'verfiy_category_pending.php',
					data: {
						code: code_ajax,
						cat_id: cat_id,
						rejectreason: rejectreason
					},
					success: function(response) {
						$.busyLoadFull("hide");
						if (response == 'Failed to Delete.') {
							successmsg("Failed to Rejected.");
						} else if (response == 'Deleted') {
							$("#tr" + cat_id).remove();
							successmsg("Category Rejected Successfully.");

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
	}

	function verifyCategory(cat_id) {

		xdialog.confirm('Are you sure want to approve category?', function() {
			$.busyLoadFull("show");
			$.ajax({
				method: 'POST',
				url: 'verfiy_category_pending.php',
				data: {
					code: code_ajax,
					verify_cat_id: cat_id
				},
				success: function(response) {
					$.busyLoadFull("hide");
					if (response == 'Failed to approve.') {
						successmsg("Failed to approve.");
					} else if (response == 'approve') {
						$("#tr" + cat_id).remove();
						successmsg("Category approved Successfully.");

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
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="add_category_form">

					<div class="form-group" id="parent_cat_div">

						<div class="dropdownss">
							<div id="treeSelect">
								<div class="pt-2 pl-2">
									<?php

									$query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND status='1' ORDER BY cat_name ASC");

									if ($query->num_rows > 0) {
										while ($row = $query->fetch_assoc()) {
											$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status='1' ");
											if ($query1->num_rows > 0) {
												echo '<span class="expand" ><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList">' . $row['cat_name'] . '</span>
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
													echo '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList">' . $row['cat_name'] . '</span>
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

				</form>
			</div>

		</div>

	</div>
</div>