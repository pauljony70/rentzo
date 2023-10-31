<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code = $_POST['code'];

$code =  stripslashes($code);

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if ($code == $_SESSION['_token'] && isset($_POST['deletearray'])) {


	$deletearray = $_POST['deletearray'];
	$deletearray =   stripslashes($deletearray);



	if (isset($deletearray) && !empty($deletearray)) {

		$stmt = $conn->prepare("SELECT id FROM product_details WHERE attr_set_id=? ");
		$stmt->bind_param("i",  $deletearray);
		$stmt->execute();
		$data = $stmt->bind_result($prod_id);
		$return = array();

		$product_count = "N";

		while ($stmt->fetch()) {
			$product_count = "Y";
		}

		if ($product_count == "Y") {

			$html =
				'<div>
					
					<div class="form-group"> 
						<h6 class="notess">The select Attribute Set already assign to some products. You can\'t delete the Attribute Set if it is assign to a product. Please assign the product to other Attribute Set by selecting the option from the below list. </h6>
						<label for="name">Select Attribute Set</label> 
						<select class="form-control" id="attribute_assign_id" name="attribute_assign_id"  required>
						<option value="">Select</option>';

			$stmt = $conn->prepare("SELECT sno, name FROM attribute_set WHERE sno != '" . $deletearray . "' AND status ='1' ORDER BY name ASC ");

			$stmt->execute();
			$data = $stmt->bind_result($col1, $col2);

			while ($stmt->fetch()) {
				$html .= ' <option value="' . $col1 . '">' . $col2 . '</option>';
			}

			$html .= '</select>
			</div>
			
			<input type="hidden" class="form-control" id="delete_attribute_id" value="' . $deletearray . '"> 
            <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" onclick="assign_attribute_btn();">Assign Attribute Set </button> 
		</div> ';
			echo $html;
		} else {
			$Common_Function->delete_product_attribute_set($deletearray, $conn);
		}


		die;
	} else {
	}
} else if ($code == $_SESSION['_token'] && isset($_POST['delete_attribute_id']) && isset($_POST['attribute_assign_id'])) {
	$stmt11 = $conn->prepare("UPDATE product_details SET attr_set_id =? WHERE attr_set_id = '" . trim($_POST['delete_attribute_id']) . "'");
	$stmt11->bind_param("i", trim($_POST['attribute_assign_id']));
	$stmt11->execute();
	$rows = $stmt11->affected_rows;
	$Common_Function->delete_product_attribute_set($_POST['delete_attribute_id'], $conn);
}
