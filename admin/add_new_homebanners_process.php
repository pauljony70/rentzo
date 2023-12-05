<?php

include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Brand)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

$code = $_POST['code'];
$banner_link = $_POST['banner_link'];
$banner_section = $_POST['banner_section'];
$banner_type = $_POST['banner_type'];


$error = '';  // Variable To Store Error Message
$code =   stripslashes($code);
$banner_link =   stripslashes($banner_link);
$banner_section =   stripslashes($banner_section);
$banner_type =   stripslashes($banner_type);

$parent_cat = 0;
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if ($code == $_SESSION['_token'] && isset($banner_link) && isset($banner_section) && isset($banner_type)) {
	//code for Check Brand Exist - START
	$query1 = $conn->query("SELECT * FROM `homepage_banner` WHERE type ='" . $banner_type . "'");
	$banner_image = '';

	if ($banner_section == 'section1' || $banner_section == 'section_four_banner') {
		$Common_Function->img_dimension_arr = array(array(200, 200), array(1920, 680));
	}
	if ($banner_section == 'section2') {
		if ($banner_type == 'sec2cat1' || $banner_type == 'sec2cat2') {
			$Common_Function->img_dimension_arr = array(array(200, 200), array(700, 330));
		}
		if ($banner_type == 'sec2pd1' || $banner_type == 'sec2pd2' || $banner_type == 'sec2pd3' || $banner_type == 'sec2pd4') {
			$Common_Function->img_dimension_arr = array(array(200, 200), array(320, 330));
		}
		if ($banner_type == 'sec2ad') {
			$Common_Function->img_dimension_arr = array(array(200, 200), array(430, 680));
		}
	}

	if ($banner_section == 'section4') {
		$Common_Function->img_dimension_arr = array(array(1930, 150));
	}
	if ($banner_section == 'section10') {
		$Common_Function->img_dimension_arr = array(array(1900, 320));
	}
	if ($banner_section == 'section11') {
		$Common_Function->img_dimension_arr = array(array(1900, 320));
	}
	if ($banner_section == 'section12') {
		$Common_Function->img_dimension_arr = array(array(1900, 320));
	}
	if ($banner_section == 'section5') {
		$Common_Function->img_dimension_arr = array(array(470, 720));

		$parent_cat = $_POST['parent_cat'];
	}
	if ($banner_section == 'section6') {
		$Common_Function->img_dimension_arr = array(array(1900, 320));
	}

	if ($banner_section == 'section8') {
		$Common_Function->img_dimension_arr = array(array(610, 400));
	}

	//code for upload images - START			
	if ($_FILES['banner_image']['name']) {
		$brand_image1 = $Common_Function->file_upload('banner_image', $media_path);
		$banner_image = json_encode($brand_image1);
	}

	if ($query1->num_rows > 0) {
		$rows1 = $query1->fetch_assoc();

		$img_decode = json_decode($rows1['image']);

		foreach ($Common_Function->img_dimension_arr as $dimension) {

			$image = $media_path . $img_decode->{$dimension[0] . '-' . $dimension[1]};
			if (file_exists($image)) {
				unlink($image);
			}
		}

		$query1 = $conn->query("UPDATE `homepage_banner`  SET link='" . $banner_link . "',image='" . $banner_image . "',cat_id='" . $parent_cat . "' WHERE type ='" . $banner_type . "'");
	} else {
		$query1 = $conn->query("INSERT INTO `homepage_banner`(type,image,link,section,cat_id) VALUES('" . $banner_type . "','" . $banner_image . "','" . $banner_link . "','" . $banner_section . "','" . $parent_cat . "') ");
	}
	echo "Banner Added Successfully. ";
} else {
	echo "Invalid values.";
}
die;
