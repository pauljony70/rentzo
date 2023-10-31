<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

include("header.php");
$code = $_POST['code'];
$code = stripslashes($code);
$datetime = date('Y-m-d');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	//echo " dashboard redirect to index";
} else {
	if ($code == $_SESSION['_token'] && isset($_POST['product_id'])) {



		$selectattrset = trim(strip_tags($_POST['selectattrset']));
		$category = $_POST['category'];
		$prod_name = trim(strip_tags($_POST['prod_name']));
		$prod_name_ar = trim(strip_tags($_POST['prod_name_ar']));
		$prod_sku = trim(strip_tags($_POST['prod_sku']));
		$prod_url = trim(strip_tags($_POST['prod_url']));
		$prod_short = trim(strip_tags($_POST['prod_short']));
		$prod_short_ar = trim(strip_tags($_POST['prod_short_ar']));
		$prod_details = trim($_POST['prod_details']);
		$prod_details_ar = trim($_POST['prod_details_ar']);
		$selectvisibility = trim(strip_tags($_POST['selectvisibility']));
		$selectcountry = trim(strip_tags($_POST['selectcountry']));
		$prod_hsn = trim(strip_tags($_POST['prod_hsn']));
		$selectbrand = trim(strip_tags($_POST['selectbrand']));
		$return_policy = trim(strip_tags($_POST['return_policy']));
		$prod_youtubeid = trim(strip_tags($_POST['prod_youtubeid']));

		$prod_meta = trim(strip_tags($_POST['prod_meta']));
		$prod_keyword = trim(strip_tags($_POST['prod_keyword']));
		$prod_meta_desc = trim(strip_tags($_POST['prod_meta_desc']));



		$product_id = trim($_POST['product_id']);



		$selectattrset  =   addslashes($selectattrset);
		$prod_name		=   addslashes($prod_name);
		$prod_sku		=   addslashes($prod_sku);
		$prod_url		=   addslashes($prod_url);
		$prod_short		=   addslashes($prod_short);
		$prod_details		=   addslashes($prod_details);
		$selectvisibility		=   addslashes($selectvisibility);
		$selectcountry		=   addslashes($selectcountry);
		$prod_hsn		=   addslashes($prod_hsn);
		$selectbrand		=   addslashes($selectbrand);
		$return_policy		=   addslashes($return_policy);
		$prod_youtubeid		=   addslashes($prod_youtubeid);

		$prod_meta		=   addslashes($prod_meta);
		$prod_keyword		=   addslashes($prod_keyword);
		$prod_meta_desc		=   addslashes($prod_meta_desc);

		$price_type = '';

		if (isset($prod_name)  && isset($category)) {

			// code for check product exist - START
			$stmt_check = $conn->prepare("SELECT web_url,product_sku FROM product_details WHERE (LOWER(web_url) ='" . strtolower($prod_url) . "' OR LOWER(product_sku) ='" . strtolower($prod_sku) . "' )  AND  product_unique_id != '" . $product_id . "'
										UNION ALL 
										SELECT '' web_url,product_sku FROM product_attribute_value WHERE LOWER(product_sku) ='" . strtolower($prod_sku) . "' AND product_id  != '" . $product_id . "' ");
			//$stmt->bind_param( s,  $inactive );
			$stmt_check->execute();
			$check_exist = 0;
			while ($stmt_check->fetch()) {
				$check_exist = 1;
			}

			// code for check product exist - END
			$stmti = $conn->prepare("SELECT id, prod_img_url FROM product_details WHERE product_unique_id=?");
			$stmti->bind_param("s", $product_id);
			$stmti->execute();

			$stmti->bind_result($prodid, $prod_imgs_url);

			$prod_exist = 0;
			while ($stmti->fetch()) {
				$prod_exist = 1;
			}
			if ($check_exist == 0 && $prod_exist == 1) {
				// code for add product main - START

				//code for upload images - START
				if (strlen($_FILES['featured_img']['name']) > 1) {
					$Common_Function->img_dimension_arr = $img_dimension_arr;
					$featured_img1 = $Common_Function->file_upload('featured_img', $media_path);
					$featured_img = json_encode($featured_img1);
				} else {
					$featured_img = urldecode($_POST['featured_imgtxt']);
				}

				if (is_array($_FILES['product_image']['name'])) {
					$Common_Function->img_dimension_arr = $img_dimension_arr;
					$prod_img_url_arr = $Common_Function->file_upload('product_image', $media_path);
					$prod_img_en = json_encode($prod_img_url_arr);

					if ($prod_imgs_url) {
						$prod_img_url = json_encode(array_merge(json_decode($prod_imgs_url, true), json_decode($prod_img_en, true)));
					} else {
						$prod_img_url = $prod_img_en;
					}
				} else {
					$prod_img_url = urldecode($_POST['prod_img_urltxt']);
				}

				//code for upload images - END

				$prod_string = $Common_Function->makeurlnamebyname($_POST['prod_name']);

				if ($_POST['prod_url']) {
					$prod_url = $Common_Function->makeurlnamebyname($_POST['prod_url']);
				} else {
					$prod_url = $prod_string;
				}

				if ($_POST['prod_sku']) {
					$prod_sku = $Common_Function->makeSKUbyname($_POST['prod_sku']);
				} else {
					$prod_sku = $Common_Function->makeSKUbyname($_POST['prod_name']);
				}
				$prod_id = $product_id;

				$stmt11 = $conn->prepare("UPDATE `product_details` SET `prod_name`= ?, `prod_desc` =?, `prod_fulldetail` = ?, `prod_name_ar`= ?, `prod_desc_ar` =?, `prod_fulldetail_ar` = ?, `attr_set_id` =?, `brand_id` =?, `web_url` =?,  `product_sku` =?, `product_visibility` =?, `product_manuf_country` =?, `product_hsn_code` =?, `product_video_url` =?, `return_policy_id` =? 
							 WHERE product_unique_id ='" . $prod_id . "'");

				$stmt11->bind_param(
					"ssssssiisssissi",
					$prod_name,
					$prod_short,
					$prod_details,
					$prod_name_ar,
					$prod_short_ar,
					$prod_details_ar,
					$selectattrset,
					$selectbrand,
					$prod_url,
					$prod_sku,
					$selectvisibility,
					$selectcountry,
					$prod_hsn,
					$prod_youtubeid,
					$return_policy
				);

				$stmt11->execute();
				$stmt11->store_result();


				// code for add product category - START
				$stmtcs = $conn->prepare("SELECT cat_id	FROM product_category WHERE prod_id= '" . $prod_id . "'");
				$stmtcs->execute();
				$data = $stmtcs->bind_result($cat_id);

				$product_cat = array();
				while ($stmtcs->fetch()) {
					$product_cat[] = $cat_id;
				}


				$sql_cat = '';
				foreach ($category as $category_id) {
					if (in_array($category_id, $product_cat)) {
					} else {
						$sql_cat .= " ('" . $category_id . "', '" . $prod_id . "'),";
					}
				}
				if ($sql_cat) {
					$sql_cat .= ";";
					$sql_cat = str_replace(',;', ';', $sql_cat);
					$sql_cat1 = "INSERT INTO `product_category`( `cat_id`, `prod_id`) VALUES " . $sql_cat;
					$sql_cat_prep = $conn->prepare($sql_cat1);
					$sql_cat_prep->execute();
					$sql_cat_prep->store_result();
				}


				if ($prod_meta || $prod_keyword || $prod_meta_desc) {
					$stmtm = $conn->prepare("SELECT meta_title	FROM product_meta WHERE prod_id= '" . $prod_id . "'");
					$stmtm->execute();
					$data = $stmtm->bind_result($meta_title);
					$meta_exist = 'N';
					while ($stmtm->fetch()) {
						$meta_exist = 'Y';
					}

					if ($meta_exist == 'Y') {
						$sql_meta_prep = $conn->prepare("UPDATE `product_meta` SET `meta_title` =?,`meta_key` =?,`meta_value` =? WHERE `prod_id` ='" . $prod_id . "' ");

						$sql_meta_prep->bind_param("sss", $prod_meta, $prod_keyword, $prod_meta_desc);

						$sql_meta_prep->execute();
						$sql_meta_prep->store_result();
					} else {
						$sql_meta_prep = $conn->prepare("INSERT INTO `product_meta`(`prod_id`,`meta_title`,`meta_key`,`meta_value`) VALUES (?,?,?,?)");

						$sql_meta_prep->bind_param("ssss", $prod_id, $prod_meta, $prod_keyword, $prod_meta_desc);

						$sql_meta_prep->execute();
						$sql_meta_prep->store_result();
					}
				}



				$result_diff = array_diff($product_cat, $category);

				if (count($result_diff) > 0) {
					$sql_meta_prep = $conn->prepare("DELETE FROM product_category WHERE cat_id IN(" . implode(',', $result_diff) . ") AND `prod_id` ='" . $prod_id . "' ");

					$sql_meta_prep->execute();
					$sql_meta_prep->store_result();
				}
				// code for add product category - END


				$msg = "Product updated successfully.";
			} else {
				$msg = "Product Web URL and SKU already exist.";
			}
		} else {
			$msg = "Invalid Parameters. Please fill all required fields.";
		}
	} else if ($code == $_SESSION['_token'] && isset($_POST['prod_id']) && isset($_POST['status'])) {
		$prod_id = trim($_POST['prod_id']);
		$status = trim($_POST['status']);

		$stmt11 = $conn->prepare("UPDATE `product_details` SET `status` = ?	 WHERE product_unique_id ='" . $prod_id . "'");

		$stmt11->bind_param("i", $status);

		$stmt11->execute();
		$stmt11->store_result();
		echo 'done';
	} else {
		$msg = "Invalid Parameters. Please fill all required fields.";
	}
}
include("footernew.php");
echo '<script>successmsg1("' . $msg . '","pending_products.php"); </script> ';
die;
