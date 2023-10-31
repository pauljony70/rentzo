<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

$code = $_POST['code'];
$name = $_POST['namevalue'];
$product_info_set_id = [];
if (array_key_exists('product_info_set_id', $_POST)) {
	$product_info_set_id = explode(',', $_POST['product_info_set_id']);
}

// print_r($product_info_set_id);exit;

$error = '';  // Variable To Store Error Message
$code =   stripslashes($code);
$name =   stripslashes($name);


if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token'] && isset($name)   && !empty($name)) {
	//code for Check Brand Exist - START
	$stmt12 = $conn->prepare("SELECT count(sno) FROM attribute_set where name ='" . $name . "' ");

	$stmt12->execute();
	$stmt12->store_result();
	$stmt12->bind_result($col55);

	while ($stmt12->fetch()) {
		$totalrow = $col55;
	}

	//code for Check Brand Exist - END
	if ($totalrow > 0) {
		echo "Attribute Set Name Already Exist. ";
	} else {

		//code for insert record - START


		$orderid = 0;
		$stmt11 = $conn->prepare("INSERT INTO attribute_set( name,created_at,created_by )  VALUES (?,?,?)");
		$stmt11->bind_param("sss",  $name, $datetime, $_SESSION['admin']);

		$stmt11->execute();
		$stmt11->store_result();
		// echo " insert done ";
		$rows = $stmt11->affected_rows;
		if ($rows > 0) {
			$attribute_set_id = $stmt11->insert_id;

			if (!empty($product_info_set_id)) {
				foreach ($product_info_set_id as $product_info_set_id_val) {
					$stmt13 = $conn->prepare("INSERT INTO attribute_set_product_info (attribute_set_id,product_info_set_id)  VALUES (?,?)");
					$stmt13->bind_param("ii",  $attribute_set_id, $product_info_set_id_val);

					if ($stmt13->execute()) {
						// Query executed successfully
						$stmt13->store_result();
					} else {
						// Query execution failed
						$error = $stmt13->error;
						echo "Error: " . $error;
					}
				}
				echo "Attribute Set Added Successfully.";
			} else {
				echo "Attribute Set Added Successfully. ";
			}
		} else {
			echo "Failed to add Attribute";
		}

		//code for insert record - END
	}
} else {
	echo "Invalid values.";
}
die;
