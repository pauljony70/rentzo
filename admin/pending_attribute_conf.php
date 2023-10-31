<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<script>
	var code_ajax = $("#code_ajax").val();
	var parentvalue = 0;




	function deleteRecord(cat_id) {
		var rejectreason = $("#rejectreason" + cat_id).val();

		if (!rejectreason) {
			successmsg("Please select Reject Reason.");
		} else {
			xdialog.confirm('Are you sure want to reject Attributes?', function() {
				showloader();
				$.ajax({
					method: 'POST',
					url: 'verfiy_pending_attribute_conf.php',
					data: {
						code: code_ajax,
						record_id: cat_id,
						rejectreason: rejectreason
					},
					success: function(response) {
						hideloader();
						if (response == 'Failed to Delete.') {
							successmsg("Failed to Rejected.");
						} else if (response == 'Deleted') {
							$("#tr" + cat_id).remove();
							successmsg("Attributes Rejected Successfully.");

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

	function verifyRecord(cat_id) {

		xdialog.confirm('Are you sure want to approve Attributes?', function() {
			showloader();
			$.ajax({
				method: 'POST',
				url: 'verfiy_pending_attribute_conf.php',
				data: {
					code: code_ajax,
					verify_record_id: cat_id
				},
				success: function(response) {
					hideloader();
					if (response == 'Failed to approve.') {
						successmsg("Failed to approve.");
					} else if (response == 'approve') {
						$("#tr" + cat_id).remove();
						successmsg("Attributes approved successfully.");

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
<?php
// echo "class id is  ".$class_id;     
$inactive = "active";
$parentname = "";
$stmt = $conn->prepare("SELECT id , attribute,status FROM product_attributes_set  WHERE status IN(0) ORDER BY attribute ASC");

$stmt->execute();
$data = $stmt->bind_result($col1, $col2, $col3);
$return = array();
$i = 0;
$final_arr = array();

while ($stmt->fetch()) {



	$arr['id']	= $col1;
	$arr['name']	= $col2;

	$arr['status']	= $col3;

	$final_arr[] = $arr;
}


?>
<!-- main content start-->
<div id="page-wrapper">
	<div class="main-page">
		<div class="work-progres">
			<header class="widget-header">
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<div class="pull-right" style="float:left;">

				</div>
				<h4 class="widget-title">

					<b>All Attributes </b>

				</h4>
			</header>
			<hr class="widget-separator">


			<div class="table-responsive"><input type="hidden" id="last_cat" value="0">
				<table class="table table-hover" id="tblname">
					<thead>
						<tr>
							<th>Sno</th>
							<th>Attribute</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="cat_list">
						<?php
						foreach ($final_arr as $row) {

							$i++;

						?>
							<tr id="tr<?php echo $row['id']; ?>">
								<td><?php echo $i; ?> </td>

								<td><?php echo $row['name']; ?></td>
								<td>Pending</td>
								<td>
									<?php echo $Common_Function->select_reject_reason($conn, $row['id']); ?>
									<button style=" margin-left: 10px;" type="submit" class="btn btn-danger btn-sm pull-left" name="delete" onclick="deleteRecord('<?php echo $row['id']; ?>');">Reject</button>
									<button style=" margin-left: 10px;" type="submit" class="btn btn-success btn-sm pull-left" name="edit" onclick='verifyRecord("<?php echo $row['id']; ?>")' ;>Approve</button>
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
<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->