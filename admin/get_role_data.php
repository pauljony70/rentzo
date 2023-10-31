<?php

include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Role)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code  = $_POST['code'];
$type  = $_POST['type'];



$search_string = $_POST['search_string'];
$error = ''; // Variable To Store Error Message

$code = stripslashes($code);


if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
} else if ($code == $_SESSION['_token'] && $type == 'get') {

	try {

		$Exist = false;
		$status = 0;
		$information = array();


		$return = array();

		$stmt = $conn->prepare("SELECT id,title,premission FROM user_roles order by title ASC");

		$stmt->execute();
		$data = $stmt->bind_result($col1, $col2, $col3);
		$return = array();
		$i = 0;

		//echo " get col data ";
		while ($stmt->fetch()) {
			$Exist = true;

			$return[$i] =
				array(
					'id' => $col1,
					'title' => $col2,
					'premission' => str_replace(',', ', ', $col3)
				);

			$i = $i + 1;
			//echo " array created".json_encode($return);
		}


		if ($Exist) {
			echo json_encode(array("status" => 1, "details" => $return));
		} else {
			echo json_encode(array("status" => 0, "details" => $return));
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
} else if ($code == $_SESSION['_token'] && $type == 'add') {
	try {
		$namevalue  = $_POST['namevalue'];
		$modules  = $_POST['modules'];


		$stmt = $conn->prepare("INSERT INTO user_roles (title,premission) VALUES(?,?)");
		$stmt->bind_param("ss", $namevalue, $modules);

		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->affected_rows;

		if ($rows > 0) {
			echo " Role Added Successfully.";
		} else {
			echo "Failed to add role.";
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
} else if ($code == $_SESSION['_token'] && $type == 'roles_edit') {

	try {
		$role_id = $_POST['role_id'];

		$stmt = $conn->prepare("SELECT id,title,premission FROM user_roles WHERE id ='" . $role_id . "'");

		$stmt->execute();
		$data = $stmt->bind_result($col1, $col2, $col3);

		//echo " get col data ";
		while ($stmt->fetch()) {
			$modules = explode(',', $col3);
?>
			<div class="form-group">
				<label for="name">Title</label>
				<input type="hidden" id="update_role_id" value="<?php echo $col1; ?>" required> </input>
				<input type="text" class="form-control" id="update_name" placeholder="Role Name" value="<?php echo $col2; ?>" required> </input>
			</div>
			<div class="form-group">
				<label for="image">Module Premission</label>
				<table class="table table-hover" id="tblname">
					<tbody id="">
						<tr>
							<td><input type="checkbox" name="premission[]" value="<?php echo $ManageSeller; ?>" <?php if (in_array($ManageSeller, $modules)) {
																													echo "checked";
																												} ?> class="premission1"> Manage Seller </td>
							<td><input type="checkbox" name="premission[]" value="<?php echo $Category; ?>" <?php if (in_array($Category, $modules)) {
																												echo "checked";
																											} ?> class="premission1"> Manage Category </td>
						</tr>
						<tr>
							<td><input type="checkbox" name="premission[]" value="<?php echo $Brand; ?>" <?php if (in_array($Brand, $modules)) {
																												echo "checked";
																											} ?> class="premission1"> Manage Brand </td>
							<td><input type="checkbox" name="premission[]" value="<?php echo $CouponCode; ?>" <?php if (in_array($CouponCode, $modules)) {
																													echo "checked";
																												} ?> class="premission1"> Manage Coupon Code </td>
						</tr>
						<tr>
							<td><input type="checkbox" name="premission[]" value="<?php echo $ProductAttributes; ?>" <?php if (in_array($ProductAttributes, $modules)) {
																															echo "checked";
																														} ?> class="premission1"> Manage Product Attributes </td>
							<td><input type="checkbox" name="premission[]" value="<?php echo $Product; ?>" <?php if (in_array($Product, $modules)) {
																												echo "checked";
																											} ?> class="premission1"> Manage Product</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="premission[]" value="<?php echo $HomepageSettings; ?>" <?php if (in_array($HomepageSettings, $modules)) {
																														echo "checked";
																													} ?> class="premission1"> Manage Homepage Settings </td>
							<td><input type="checkbox" name="premission[]" value="<?php echo $Orders; ?>" <?php if (in_array($Orders, $modules)) {
																												echo "checked";
																											} ?> class="premission1"> Manage Orders</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="premission[]" value="<?php echo $StoreSettings; ?>" <?php if (in_array($StoreSettings, $modules)) {
																														echo "checked";
																													} ?> class="premission1"> Manage Store Settings</td>
							<td><input type="checkbox" name="premission[]" value="<?php echo $AppUser; ?>" <?php if (in_array($AppUser, $modules)) {
																												echo "checked";
																											} ?> class="premission1"> Manage App User</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="premission[]" value="<?php echo $DeliveryBoy; ?>" <?php if (in_array($DeliveryBoy, $modules)) {
																													echo "checked";
																												} ?> class="premission1"> Manage Delivery Boy </td>
							<td><input type="checkbox" name="premission[]" value="<?php echo $ProductReview; ?>" <?php if (in_array($ProductReview, $modules)) {
																														echo "checked";
																													} ?> class="premission1"> Manage Product Review </td>
						</tr>
						<tr>
							<td><input type="checkbox" name="premission[]" value="<?php echo $Support; ?>" <?php if (in_array($Support, $modules)) {
																												echo "checked";
																											} ?> class="premission1"> Support Chat </td>
							<td>-</td>

						</tr>
					</tbody>
				</table>
			</div>
			<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_role_btn">Update</button>
			<script>
				$(document).ready(function() {
					$("#update_role_btn").click(function(event) {
						event.preventDefault();

						var namevalue = $('#update_name').val();
						var update_role_id = $('#update_role_id').val();

						if (!namevalue) {
							successmsg("Please enter Role title");
						} else if ($('.premission1:checkbox:checked').length == 0) {
							successmsg("Please select atleast one module");
						} else {
							showloader();

							var selected = new Array();

							$(".premission1:checkbox:checked").each(function() {
								selected.push($(this).val());
							});
							var form_data = new FormData();

							form_data.append('namevalue', namevalue);
							form_data.append('modules', selected);
							form_data.append('code', code_ajax);
							form_data.append('update_role_id', update_role_id);
							form_data.append('type', "update");

							$.ajax({
								method: 'POST',
								url: 'get_role_data.php',
								data: form_data,
								contentType: false,
								processData: false,
								success: function(response) {
									hideloader();
									successmsg(response);
									getroles();
									$("#myModalupdate").modal('hide');

								}
							});
						}
					});


				});
			</script>
<?php }
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
} else if ($code == $_SESSION['_token'] && $type == 'update') {
	try {
		$namevalue  = $_POST['namevalue'];
		$modules  = $_POST['modules'];
		$update_role_id  = $_POST['update_role_id'];


		$stmt = $conn->prepare("UPDATE user_roles SET title =?,premission=? WHERE id ='" . $update_role_id . "'");
		$stmt->bind_param("ss", $namevalue, $modules);

		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->affected_rows;

		if ($rows > 0) {
			echo " Role updated Successfully.";
		} else {
			echo "Failed to add role.";
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
} else if ($code == $_SESSION['_token'] && $type == 'delete') {
	try {

		$role_id  = $_POST['role_id'];


		$stmt = $conn->prepare("SELECT seller_id FROM admin_login WHERE role_id ='" . $role_id . "'");

		$stmt->execute();
		$data = $stmt->bind_result($col1);

		$role_count = "N";

		while ($stmt->fetch()) {
			$role_count = "Y";
		}

		if ($role_count == "Y") {

			$html = '<div>
			
			<div class="form-group"> 
			<h4 class="notess">The select Role already assign to some users. You can\'t delete the Role if it is assign to a user. Please assign the 
	  user to other Role by selecting the option from the below list. </h4>
				
				<label for="name">Select Role</label> 
					
				<div class="">
					<select class="form-control1" id="assign_role">';
			$stmt1 = $conn->prepare("SELECT id,title,premission FROM user_roles WHERE id !='" . $role_id . "' order by title ASC");

			$stmt1->execute();
			$data = $stmt1->bind_result($col1, $col2, $col3);
			$return = array();
			$i = 0;


			while ($stmt1->fetch()) {
				$html .= '<option value="' . $col1 . '">' . $col2 . '</option>';
			}

			$html .= '</select>					
				</div>
			</div>
			
			<input type="hidden" class="form-control" id="delete_role_id" value="' . $role_id . '"> 
            <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" onclick="assign_role_btn();">Assign Role </button> 
			</div> ';
			echo $html;
		} else {
			$Common_Function->delete_roles($role_id, $conn);
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
} else if ($code == $_SESSION['_token'] && $type == 'assign_role') {
	try {

		$role_id  = $_POST['delete_role_id'];
		$role_assign_id  = $_POST['role_assign_id'];


		$stmt = $conn->prepare("UPDATE  admin_login SET role_id = '" . $role_assign_id . "' WHERE role_id ='" . $role_id . "'");

		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->affected_rows;

		if ($rows > 0) {
			$Common_Function->delete_roles($role_id, $conn);
			echo "done";
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
?>