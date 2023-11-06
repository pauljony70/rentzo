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
		$enableproduct = trim(strip_tags($_POST['enableproduct']));
		$selectattrset = trim(strip_tags($_POST['selectattrset']));
		$category = $_POST['category'];
		$prod_name = trim(strip_tags($_POST['prod_name']));
		$prod_sku = trim(strip_tags($_POST['prod_sku']));
		$prod_url = trim(strip_tags($_POST['prod_url']));
		$prod_short = trim(strip_tags($_POST['prod_short']));
		$prod_details = trim($_POST['prod_details']);
		$selectvisibility = trim(strip_tags($_POST['selectvisibility']));
		$selectcountry = trim(strip_tags($_POST['selectcountry']));
		$prod_hsn = trim(strip_tags($_POST['prod_hsn']));
		$prod_weight = trim(strip_tags($_POST['prod_weight']));
		$selectbrand = trim(strip_tags($_POST['selectbrand']));
		$return_policy = trim(strip_tags($_POST['return_policy']));
		$shipping = trim(strip_tags($_POST['shipping']));
		$prod_youtubeid = trim(strip_tags($_POST['prod_youtubeid']));
		$prod_meta = trim(strip_tags($_POST['prod_meta']));
		$prod_keyword = trim(strip_tags($_POST['prod_keyword']));
		$prod_meta_desc = trim(strip_tags($_POST['prod_meta_desc']));
		$prod_meta_ar = trim(strip_tags($_POST['prod_meta_ar']));
		$prod_keyword_ar = trim(strip_tags($_POST['prod_keyword_ar']));
		$prod_meta_desc_ar = trim(strip_tags($_POST['prod_meta_desc_ar']));
		$is_heavy = 0;
		$prod_name_ar = trim(strip_tags($_POST['prod_name_ar']));
		$prod_short_ar = trim(strip_tags($_POST['prod_short_ar']));
		$prod_details_ar = trim(strip_tags($_POST['prod_details_ar']));
		$product_info_set_id_arr = [];
		$product_info_set_val_id_arr = [];
		if (isset($_POST['product_info_set_id'])) {
			$product_info_set_ids = $_POST['product_info_set_id'];
			foreach ($product_info_set_ids as $key => $product_info_set_id) {
				$array = [];
				// Process each value here
				$product_info_set_id_arr[] = $product_info_set_id;
				if (isset($_POST['product_info_set_val_id_' . $product_info_set_id])) {
					$product_info_set_val_ids = $_POST['product_info_set_val_id_' . $product_info_set_id];
					foreach ($product_info_set_val_ids as $product_info_set_val_id) {
						// echo $product_info_set_val_id . "<br>";
						$array[] = $product_info_set_val_id;
					}
					$product_info_set_val_id_arr[$key] = $array;
				}
			}
		}

		$product_id = trim($_POST['product_id']);
		
		$usage_info = trim($_POST['usage_info']);
		$type = trim($_POST['type']);
		$day1_price = trim($_POST['day1_price']);
		$day3_price = trim($_POST['day3_price']);
		$day5_price = trim($_POST['day5_price']);
		$day7_price = trim($_POST['day7_price']);
		
		$usage_info	=   addslashes($usage_info);
		$type	=   addslashes($type);
		$day1_price	=   addslashes($day1_price);
		$day3_price	=   addslashes($day3_price);
		$day5_price	=   addslashes($day5_price);
		$day7_price	=   addslashes($day7_price);
		

		$enableproduct	=   addslashes($enableproduct);
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
		$shipping		=   addslashes($shipping);
		$prod_youtubeid		=   addslashes($prod_youtubeid);
		$prod_meta		=   addslashes($prod_meta);
		$prod_keyword		=   addslashes($prod_keyword);
		$prod_meta_desc		=   addslashes($prod_meta_desc);
		$prod_meta_ar		=   addslashes($prod_meta_ar);
		$prod_keyword_ar		=   addslashes($prod_keyword_ar);
		$prod_meta_desc_ar		=   addslashes($prod_meta_desc_ar);
		$prod_name_ar		=   addslashes($prod_name_ar);
		$prod_short_ar		=   addslashes($prod_short_ar);
		$prod_details_ar		=   addslashes($prod_details_ar);

		$price_type = '';

		if ($enableproduct != 1) {
			$enableproduct = 3;
		}

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


				if (strlen($_FILES['prod_youtubeid']['name']) > 1) {
					$Common_Function->img_dimension_arr = $img_dimension_arr;
					$prod_youtubeid_arr = $Common_Function->file_upload_video('prod_youtubeid', $media_path);
					$prod_youtubeid = str_replace('"', '', json_encode($prod_youtubeid_arr));
				} else {
					$prod_youtubeid = urldecode($_POST['prod_youtube_txt']);
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

 
				$stmt11 = $conn->prepare("UPDATE `product_details` SET `status` = ?, `prod_name`= ?, `prod_desc` =?, `prod_fulldetail` = ?,
							`prod_img_url` =?, `attr_set_id` =?, `brand_id` =?, `web_url` =?,  `product_sku` =?, `product_visibility` =?, `product_manuf_country` =?, `product_hsn_code` =?, `product_video_url` =?, `return_policy_id` =?,`featured_img` =?,`is_heavy`=?,
							`prod_name_ar` =?,`prod_desc_ar` =?,`prod_fulldetail_ar` =?,`shipping`=?,`prod_weight`=?,`usage_info` = ?,`type` = ?,`day1_price`=?,`day3_price`=?,`day5_price`=?,`day7_price`=?
							 WHERE product_unique_id ='" . $prod_id . "'");

				$stmt11->bind_param(
					"issssiisssissisisssssssssss",
					$enableproduct,
					$prod_name,
					$prod_short,
					$prod_details,
					$prod_img_url,
					$selectattrset,
					$selectbrand,
					$prod_url,
					$prod_sku,
					$selectvisibility,
					$selectcountry,
					$prod_hsn,
					$prod_youtubeid,
					$return_policy,
					$featured_img,
					$is_heavy,
					$prod_name_ar,
					$prod_short_ar,
					$prod_details_ar,
					$shipping,
					$prod_weight,
					$usage_info,
					$type,
					$day1_price,
					$day3_price,
					$day5_price,
					$day7_price
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

				$result_diff = array_diff($product_cat, $category);

				if (count($result_diff) > 0) {
					$sql_meta_prep = $conn->prepare("DELETE FROM product_category WHERE cat_id IN(" . implode(',', $result_diff) . ") AND `prod_id` ='" . $prod_id . "' ");

					$sql_meta_prep->execute();
					$sql_meta_prep->store_result();
				}
				// code for add product category - END

				// code for add product meta - START
				if($prod_meta || $prod_keyword || $prod_meta_desc){
					$stmtm = $conn->prepare("SELECT meta_title	FROM product_meta WHERE prod_id= '".$prod_id."'");
					$stmtm->execute();	 
					$data = $stmtm->bind_result( $meta_title);
					$meta_exist = 'N';
					while ($stmtm->fetch()) { 
						$meta_exist = 'Y';
					}
					
					if($meta_exist == 'Y'){
						$sql_meta_prep = $conn->prepare("UPDATE `product_meta` SET `meta_title` =?,`meta_key` =?,`meta_value` =?,`prod_meta_ar` =?,`prod_keyword_ar` =?,`prod_meta_desc_ar` =? WHERE `prod_id` ='".$prod_id."' ");
						
						$sql_meta_prep->bind_param( "ssssss",$prod_meta, $prod_keyword, $prod_meta_desc,$prod_meta_ar,$prod_keyword_ar,$prod_meta_desc_ar);
					
						$sql_meta_prep->execute();
						$sql_meta_prep->store_result();
					}else{
						$sql_meta_prep = $conn->prepare("INSERT INTO `product_meta`(`prod_id`,`meta_title`,`meta_key`,`meta_value`,`prod_meta_ar`,`prod_keyword_ar`,`prod_meta_desc_ar`) VALUES (?,?,?,?,?,?,?)");
						
						$sql_meta_prep->bind_param( "sssssss",$prod_id,$prod_meta, $prod_keyword, $prod_meta_desc,$prod_meta_ar,$prod_keyword_ar,$prod_meta_desc_ar);
				
						$sql_meta_prep->execute();
						$sql_meta_prep->store_result();
					}
				}
				// code for add product meta - END

				$stmt2 = $conn->prepare("DELETE FROM product_info WHERE prod_id = '" . $prod_id . "'");
				$stmt2->execute();

				foreach ($product_info_set_id_arr as $key => $product_info_set_id) {
					$product_info_set_val_id_set = isset($product_info_set_val_id_arr[$key]) ? $product_info_set_val_id_arr[$key] : [];
					if (count($product_info_set_val_id_set) > 0) {
						foreach ($product_info_set_val_id_set as $product_info_set_val_id) {
							$product_info_prep = $conn->prepare("INSERT INTO `product_info`(`prod_id`,`product_info_set_id`,`product_info_set_val_id`) VALUES (?,?,?)");
							$product_info_prep->bind_param("sii", $prod_id, $product_info_set_id, $product_info_set_val_id);
							
							$product_info_prep->execute();
							$product_info_prep->store_result();
						}
					}
				}

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
echo '<script>successmsg1("' . $msg . '","manage_product.php"); </script> ';
die;
