<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

$code = $_POST['code'];
$name = $_POST['namevalue'];
$name_ar = $_POST['namevalue_ar'];


$error = '';  // Variable To Store Error Message
$code =   stripslashes($code);
$name =   stripslashes($name);
$name_ar =   stripslashes($name_ar);


if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token'] && isset($name) && isset($name_ar) && !empty($name)) {
	//code for Check Brand Exist - START
	$stmt12 = $conn->prepare("SELECT count(id) FROM product_attributes_set where attribute ='" . $name . "' ");

	$stmt12->execute();
	$stmt12->store_result();
	$stmt12->bind_result($col55);

	while ($stmt12->fetch()) {
		$totalrow = $col55;
	}

	//code for Check Brand Exist - END
	if ($totalrow > 0) {
		echo "Attribute  Already Exist. ";
	} else {


		//code for insert record - START
		$orderid = 0;
		$stmt11 = $conn->prepare("INSERT INTO product_attributes_set (attribute, attribute_ar)  VALUES (?,?)");
		$stmt11->bind_param("ss", $name, $name_ar);

		$stmt11->execute();
		$stmt11->store_result();
		// echo " insert done ";
		$rows = $stmt11->affected_rows;
		if ($rows > 0) {
			echo "Attribute Added Successfully. ";
		} else {
			echo "Failed to add Attribute";
		}

		//code for insert record - END
	}
} else {
	echo "Invalid values.";
}
die;
