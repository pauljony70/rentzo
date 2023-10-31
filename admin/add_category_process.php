<?php

include('session.php');


if (!$Common_Function->user_module_premission($_SESSION, $Category)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

$code = $_POST['code'];
$name = $_POST['namevalue'];
$name_ar = $_POST['name_ar'];
$sub_title = $_POST['sub_title'];
$sub_title_ar = $_POST['sub_title_ar'];
$make_parent = $_POST['make_parent'];

$parentid1 = $_POST['parent_cat'];
$error = '';  // Variable To Store Error Message

$code =   stripslashes($code);
$name =   stripslashes($name);
$parentid1 =   stripslashes($parentid1);
$name_ar =   stripslashes($name_ar);
$sub_title =   stripslashes($sub_title);
$sub_title_ar =   stripslashes($sub_title_ar);

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if ($code == $_SESSION['_token'] && isset($name)   && !empty($name)) {

	$exist = false;
	$stmt = $conn->prepare("SELECT cat_id FROM category WHERE cat_name=?");
	$stmt->bind_param("s",   $name);
	$stmt->execute();
	$data = $stmt->bind_result($col1);
	$return = array();

	while ($stmt->fetch()) {
		$exist = true;
	}

	if ($exist) {
		echo "Category name already exist. Please choose another name.";
	} else {
		//code for upload images - START
		$file = '';
		if ($_FILES['file']['name']) {
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$profile_pic1 = $Common_Function->file_upload('file', $media_path);
			$file = json_encode($profile_pic1);
		}

		$web_banner = '';
		if ($_FILES['web_banner']['name']) {
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$web_banner1 = $Common_Function->file_upload('web_banner', $media_path);
			$web_banner = json_encode($web_banner1);
		}


		$app_banner = '';
		if ($_FILES['app_banner']['name']) {
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$app_banner1 = $Common_Function->file_upload('app_banner', $media_path);
			$app_banner = json_encode($app_banner1);
		}

		if ($make_parent == 'yes') {
			$parentid = 0;
		} else {
			$parentid = $parentid1;
		}
		$cat_slug = $Common_Function->makeurlnamebyname($name);

		$stmt11 = $conn->prepare("INSERT INTO category( cat_name, cat_img, parent_id,created_at,created_by ,cat_slug,web_banner,app_banner,cat_name_ar,sub_title,sub_title_ar)  VALUES (?,?,?,?,?,?,?,?,?,?,?)");
		$stmt11->bind_param("ssissssssss",  $name, $file, $parentid, $datetime, $_SESSION['admin'], $cat_slug, $web_banner, $app_banner, $name_ar, $sub_title, $sub_title_ar);

		$stmt11->execute();
		$stmt11->store_result();
		// echo " insert done ";

		$rows = $stmt11->affected_rows;
		if ($rows > 0) {
			echo "Category Added Successfully.";
		} else {
			echo "Failed to add category";
		}
	}
} else {
	echo "failed to add category.";
}
die;
