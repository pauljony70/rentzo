<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

$code  = $_POST['code'];
$code = stripslashes($code);

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
} else if ($code == $_SESSION['_token'] && isset($_POST['product_id'])) {
	$product_id = stripslashes($_POST['product_id']);
	$stmt = $conn->prepare("SELECT prod_img_url,featured_img FROM product_details WHERE product_unique_id=?");
	$stmt->bind_param("s", $product_id);
	$stmt->execute();

	$stmt->bind_result($prod_img_url, $featured_img);

	while ($stmt->fetch()) {
		$img_decode = json_decode($prod_img_url);
		$feat_img_decode = json_decode($featured_img);

		if (!empty($img_decode)) {
			foreach ($img_decode as $img_path) {
				foreach ($img_dimension_arr as $height_width) {
					unlink($media_path . $img_path->{$height_width[0] . '-' . $height_width[1]});
				}
			}
		}
		foreach ($img_dimension_arr as $height_width) {
			unlink($media_path . $feat_img_decode->{$height_width[0] . '-' . $height_width[1]});
		}
	}
	$stmtd = $conn->prepare("DELETE FROM product_details WHERE product_unique_id=?");
	$stmtd->bind_param("s", $product_id);
	$stmtd->execute();

	//delete form category
	$stmtc = $conn->prepare("DELETE FROM product_category WHERE prod_id=?");
	$stmtc->bind_param("s", $product_id);
	$stmtc->execute();

	//delete form meta
	$stmtm = $conn->prepare("DELETE FROM product_meta WHERE prod_id=?");
	$stmtm->bind_param("s", $product_id);
	$stmtm->execute();


	//delete form attr value
	$stmtav = $conn->prepare("DELETE FROM product_attribute_value WHERE product_id  = '" . $product_id . "'");

	$stmtav->execute();

	//delete form vendor product
	$stmtvpd = $conn->prepare("DELETE FROM vendor_product WHERE product_id=?");
	$stmtvpd->bind_param("s", $product_id);
	$stmtvpd->execute();

	//delete form product_attribute
	$stmtpa = $conn->prepare("DELETE FROM product_attribute WHERE prod_id=?");
	$stmtpa->bind_param("s", $product_id);
	$stmtpa->execute();

	$stmtcb = $conn->prepare("DELETE FROM home_custom_banner WHERE clicktype = '2' and banner_id=?");
	$stmtcb->bind_param("s", $product_id);
	$stmtcb->execute();

	$stmtpp = $conn->prepare("DELETE FROM popular_product WHERE product_id=?");
	$stmtpp->bind_param("s", $product_id);
	$stmtpp->execute();

	$stmtpr = $conn->prepare("DELETE FROM product_review WHERE product_id=?");
	$stmtpr->bind_param("s", $product_id);
	$stmtpr->execute();

	$stmtpk = $conn->prepare("DELETE FROM product_info WHERE prod_id=?");
	$stmtpk->bind_param("s", $product_id);
	$stmtpk->execute();


	echo json_encode(array("status" => 1, "message" => "Product Deleted Successfully."));
} else if ($code == $_SESSION['_token'] && isset($_POST['img_prod_id']) && isset($_POST['image_index'])) {
	$product_id = trim($_POST['img_prod_id']);
	$image_index = trim($_POST['image_index']);

	$stmt = $conn->prepare("SELECT prod_img_url FROM product_details WHERE product_unique_id=?");
	$stmt->bind_param("s", $product_id);
	$stmt->execute();

	$stmt->bind_result($prod_img_url);

	while ($stmt->fetch()) {
	}
	$img_decode = json_decode($prod_img_url);
	unset($img_decode[$image_index]);

	$img_decode1 = array_values($img_decode);
	$prod_image =  json_encode($img_decode1);

	$sql_meta_prep = $conn->prepare("UPDATE `product_details` SET `prod_img_url` =? WHERE `product_unique_id` ='" . $product_id . "' ");

	$sql_meta_prep->bind_param("s", $prod_image);

	$sql_meta_prep->execute();
	$sql_meta_prep->store_result();
	echo json_encode(array("status" => 1, "message" => "Product Deleted Successfully.", "prod_image" => urlencode($prod_image)));
} else {
	echo "Failed to Delete..";
}
