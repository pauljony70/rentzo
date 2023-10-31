<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code = $_POST['code'];
$name = $_POST['namevalue'];
$statuss = $_POST['statuss'];

$attribute_id = $_POST['attribute_id'];
if (array_key_exists('product_info_set_id', $_POST)) {
	$product_info_set_ids = explode(',', $_POST['product_info_set_id']);
}

$error = '';  // Variable To Store Error Message
$code =   stripslashes($code);
$name =   stripslashes($name);
$img =   stripslashes($img);
$attribute_id =   stripslashes($attribute_id);

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token'] && isset($name) && isset($statuss)   && !empty($name) && !empty($attribute_id)) {
	//code for Check Brand Exist - START
	$stmt12 = $conn->prepare("SELECT count(sno) FROM attribute_set where name ='" . $name . "' AND sno !='" . $attribute_id . "' ");

	$stmt12->execute();
	$stmt12->store_result();
	$stmt12->bind_result($col55);

	while ($stmt12->fetch()) {
		$totalrow = $col55;
	}

	//code for Check Brand Exist - END
	if ($totalrow == 0) {
		$stmt10 = $conn->prepare("SELECT product_info_set_id FROM attribute_set_product_info WHERE attribute_set_id = '" . $attribute_id . "' ORDER By created_at ASC;");

		$stmt10->execute();
		$stmt10->bind_result($product_info_set_id);
		$return = [];
		while ($stmt10->fetch()) {
			$return[] = $product_info_set_id;
		}

		// print_r($product_info_set_ids);
		// print_r($return);
		// exit;
		$missingValues = array_diff($return, $product_info_set_ids); // missingValues
		$newValues = array_diff($product_info_set_ids, $return); // newValues

		if (empty($missingValues) && empty($newValues)) {
			$stmt11 = $conn->prepare("UPDATE attribute_set SET name =? , status =?  WHERE sno ='" . $attribute_id . "'");
			$stmt11->bind_param("si",  $name, $statuss);

			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows = $stmt11->affected_rows;
		} else {
			foreach ($newValues as $product_info_set_id_val) {
				$stmt13 = $conn->prepare("INSERT INTO attribute_set_product_info (attribute_set_id,product_info_set_id)  VALUES (?,?)");
				$stmt13->bind_param("ii",  $attribute_id, $product_info_set_id_val);

				if ($stmt13->execute()) {
					// Query executed successfully
					$stmt13->store_result();
				} else {
					// Query execution failed
					$error = $stmt13->error;
					// echo "Error: " . $error;
				}
			}
			foreach ($missingValues as $product_info_set_id_val) {
				$stmt2 = $conn->prepare("DELETE FROM attribute_set_product_info WHERE attribute_set_id = '" . $attribute_id . "' AND product_info_set_id = '" . $product_info_set_id_val . "'");
				$stmt2->execute();

				$rows = $stmt2->affected_rows;
			}
		}

		echo "Attribute set Updated Successfully. ";


		//code for insert record - END
	} else {
		echo "Attribute set already exist. ";
	}
} else {
	echo "Invalid values.";
}
die;
