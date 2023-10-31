<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Category)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}


$code = $_POST['code'];
$catid = $_POST['cat_id_update'];
$catname = $_POST['namevalue'];
$statuss = $_POST['statuss'];
$cat_order = $_POST['cat_order'];
$update_name_ar = $_POST['update_name_ar'];
$sub_title = $_POST['sub_title'];
$sub_title_ar = $_POST['sub_title_ar'];

$catid =    stripslashes($catid);
$catname =   stripslashes($catname);
$statuss =   stripslashes($statuss);
$update_name_ar =   stripslashes($update_name_ar);
$sub_title =   stripslashes($sub_title);
$sub_title_ar =   stripslashes($sub_title_ar);

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if ($code == $_SESSION['_token'] && isset($catid) && isset($catname) && isset($catid) && isset($catname)) {

	try {

		$file = '';
		if (strlen($_FILES['file']['name'])) {
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$profile_pic1 = $Common_Function->file_upload('file', $media_path);
			$file = json_encode($profile_pic1);
		}

		$web_banner = '';
		if ($_FILES['web_banner']['name']) {
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$web_banner1 = $Common_Function->file_upload('web_banner', $media_path);
			$web_banner = " , web_banner ='" . json_encode($web_banner1) . "'";
		}


		$app_banner = '';
		if ($_FILES['app_banner']['name']) {
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$app_banner1 = $Common_Function->file_upload('app_banner', $media_path);
			$app_banner = " , app_banner ='" . json_encode($app_banner1) . "'";
		}

		$cat_slug = $Common_Function->makeurlnamebyname($catname);

		if ($file) {
			$stmt11 = $conn->prepare("UPDATE category SET cat_name =?,cat_slug =?, cat_img =?, status =? , cat_order =?,cat_name_ar=?,sub_title=?, sub_title_ar=?  $web_banner $app_banner WHERE cat_id='" . $catid . "'");
			$stmt11->bind_param("sssiisss",  $catname, $cat_slug, $file, $statuss, $cat_order, $update_name_ar, $sub_title, $sub_title_ar);
		} else {
			$stmt11 = $conn->prepare("UPDATE category SET cat_name =?, cat_slug =?, status =?  , cat_order =?,cat_name_ar=?, sub_title=?, sub_title_ar=?   $web_banner $app_banner WHERE cat_id='" . $catid . "'");
			$stmt11->bind_param("ssiisss",  $catname, $cat_slug, $statuss, $cat_order, $update_name_ar, $sub_title, $sub_title_ar);
		}
		$stmt11->execute();
		$stmt11->store_result();

		//  echo " insert done ";
		$rows = $stmt11->affected_rows;
		echo " Category updated Successfully.";
	} //catch exception
	catch (Exception $e) {
		echo 'Message: ' . $e->getMessage();
	}
}
