<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $StoreSettings)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code = $_POST['code'];
$type = $_POST['type'];


// echo "seler is ".$seller_id;
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if ($code == $_SESSION['_token'] && $type == 'add_language') {
	$namevalue = $_POST['namevalue'];

	$query = $conn->query("SELECT * FROM `language` WHERE name ='" . $namevalue . "'");
	if ($query->num_rows > 0) {
		$message = 'Language Already Exist.';
	} else {
		$queryi = $conn->query("INSERT INTO `language` (name) VALUES ('" . $namevalue . "')");

		$last_id = $conn->insert_id;

		/* $default_language = $Common_Function->get_system_settings($conn,'system_language');
		
		$query1 = $conn->query("SELECT * FROM `language_phrase` WHERE language_id ='".$default_language."'");
		if($query1->num_rows > 0){
			while($rows = $query1->fetch_assoc()){
				$query1 = $conn->query(" INSERT  INTO `language_phrase` (language_id,phrase,message) VALUES('".$last_id."','".$rows['phrase']."', '".$rows['message']."')");
			}
		} */

		$message = 'Language Added Successfully.';
	}
	echo json_encode(array('status' => 1, 'msg' => $message));
} else if ($code == $_SESSION['_token'] && $type == 'update_language') {
	$namevalue = $_POST['namevalue'];
	$attribute_id = $_POST['attribute_id'];

	$query = $conn->query("SELECT * FROM `language` WHERE name ='" . $key . "' AND sno !='" . $attribute_id . "' ");
	if ($query->num_rows > 0) {
		$message = 'Language Already Exist.';
	} else {
		$query = $conn->query("UPDATE `language`  SET name ='" . $namevalue . "' WHERE sno ='" . $attribute_id . "'  ");
		$message = 'Language Updated Successfully.';
	}
	echo json_encode(array('status' => 1, 'msg' => $message));
} else if ($code == $_SESSION['_token'] && $type == 'delete_language') {

	$attribute_id = $_POST['deletearray'];

	$query = $conn->query("DELETE FROM `language` WHERE  sno ='" . $attribute_id . "' ");

	$query2 = $conn->query("DELETE FROM `language_phrase` WHERE  language_id ='" . $attribute_id . "' ");

	$message = 'Language Deleted Successfully.';

	echo json_encode(array('status' => 1, 'msg' => $message));
} else if ($code == $_SESSION['_token'] && $type == 'add_phrase') {
	$namevalue = $_POST['namevalue'];

	$query = $conn->query("SELECT * FROM `language_phrase` WHERE phrase ='" . $namevalue . "'");
	if ($query->num_rows > 0) {
		$message = 'Language Phrase Already Exist.';
	} else {

		$query1 = $conn->query("SELECT * FROM `language`");

		if ($query1->num_rows > 0) {
			while ($rows = $query1->fetch_assoc()) {
				$query12 = $conn->query("INSERT  INTO `language_phrase` (language_id,phrase) VALUES('" . $rows['sno'] . "','" . $namevalue . "')");
			}
		}

		$message = 'Language Phrase Added Successfully.';
	}
	echo json_encode(array('status' => 1, 'msg' => $message));
} else if ($code == $_SESSION['_token'] && $type == 'update_phrase') {

	$updatedValue = $_POST['updatedValue'];
	$currentEditingLanguage = $_POST['currentEditingLanguage'];
	$key = $_POST['key'];

	$query2 = $conn->query("UPDATE `language_phrase` SET message ='" . $updatedValue . "' WHERE  phrase ='" . $key . "' AND language_id ='" . $currentEditingLanguage . "' ");

	$message = 'Language Phrase Updated Successfully.';

	echo json_encode(array('status' => 1, 'msg' => $message));
} else {
	echo "Invalid Parameters. Please fill all required fields.";
}
die;
