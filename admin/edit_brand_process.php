<?php

include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Brand)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code = $_POST['code'];
$name = $_POST['namevalue'];
$statuss = $_POST['statuss'];
$update_name_ar = $_POST['update_name_ar'];
$update_brand_site_url = $_POST['update_brand_site_url'];
$popular_brand = $_POST['popular_brand'];

$brand_id = $_POST['brand_id'];

$error = '';  // Variable To Store Error Message
$code =   stripslashes($code);
$name =   stripslashes($name);

$brand_id =   stripslashes($brand_id);
$update_name_ar =   stripslashes($update_name_ar);
$update_brand_site_url =   stripslashes($update_brand_site_url);
$popular_brand =   stripslashes($popular_brand);

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token'] && isset($name)  && !empty($brand_id)) {
	//code for Check Brand Exist - START
	$stmt12 = $conn->prepare("SELECT count(brand_id) FROM brand where brand_name ='" . $name . "' AND brand_id !='" . $brand_id . "' ");

	$stmt12->execute();
	$stmt12->store_result();
	$stmt12->bind_result($col55);

	while ($stmt12->fetch()) {
		$totalrow = $col55;
	}

	$stmt13 = $conn->prepare("SELECT brand_img  FROM brand where brand_id ='" . $brand_id . "' ");

	$stmt13->execute();
	$stmt13->store_result();
	$stmt13->bind_result($col56);

	while ($stmt13->fetch()) {
		$fetched_brand_img = json_decode($col56)->{'72-72'};
	}

	//code for Check Brand Exist - END
	if ($totalrow == 0) {

		//code for upload images - START
		$brand_image = '';
		if ($_FILES['brand_image']['name']) {
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$brand_image1 = $Common_Function->file_upload('brand_image', $media_path);
			$brand_image = json_encode($brand_image1);

			$Common_Function->remFile('../media/' . $fetched_brand_img);

			$stmt11 = $conn->prepare("UPDATE brand SET brand_name =? , brand_img =?,status =?,brand_name_ar=?, brand_site_url=?, popular_brand=? WHERE brand_id ='" . $brand_id . "'");
			$stmt11->bind_param("ssissi",  $name, $brand_image, $statuss, $update_name_ar, $update_brand_site_url, $popular_brand);
		} else {
			$stmt11 = $conn->prepare("UPDATE brand SET brand_name =? ,status =?,brand_name_ar=?, brand_site_url=?, popular_brand=? WHERE brand_id ='" . $brand_id . "'");
			$stmt11->bind_param("sissi",  $name, $statuss, $update_name_ar, $update_brand_site_url, $popular_brand);
		}

		//code for upload images - END

		//code for insert record - START

		$orderid = 0;

		$stmt11->execute();
		$stmt11->store_result();
		// echo " insert done ";
		$rows = $stmt11->affected_rows;
		if ($rows > 0) {
			echo "Brand Name Updated Successfully. ";
		} else {
			echo "failed to add brand";
		}

		//code for insert record - END
	} else {
		echo "Brand Name already exist. ";
	}
} else {
	echo "Invalid values.";
}
die;
