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
$datetime = date('Y-m-d H:i:s');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else {
	if ($code == $_SESSION['_token']) {
		$enableproduct = trim(strip_tags($_POST['enableproduct']));
		$affiliate_commission = trim(strip_tags($_POST['affiliate_commission'])) === '' ? 0 : trim(strip_tags($_POST['affiliate_commission']));
		$selectattrset = trim(strip_tags($_POST['selectattrset']));
		$category = $_POST['category'];
		$prod_name = trim(strip_tags($_POST['prod_name']));
		$prod_sku = trim(strip_tags($_POST['prod_sku']));
		$prod_url = trim(strip_tags($_POST['prod_url']));
		$prod_short = trim(strip_tags($_POST['prod_short']));
		$prod_details = trim($_POST['prod_details']);

		$is_usd_price = isset($_POST['is_usd_price']) ? 1 : 0;
		$wholesale_product = isset($_POST['wholesale_product']) ? 1 : 0;
		$prod_mrp = trim(strip_tags($_POST['prod_mrp']));
		$prod_price = trim(strip_tags($_POST['prod_price']));
		$seller_price = trim(strip_tags($_POST['seller_price']));
		$selecttaxclass = trim(strip_tags($_POST['selecttaxclass']));
		$prod_qty = trim(strip_tags($_POST['prod_qty']));
		$selectstock = trim(strip_tags($_POST['selectstock']));
		$selectvisibility = trim(strip_tags($_POST['selectvisibility']));
		$selectcountry = trim(strip_tags($_POST['selectcountry']));
		$prod_hsn = trim(strip_tags($_POST['prod_hsn']));
		$prod_weight = trim(strip_tags($_POST['prod_weight']));
		$prod_purchase_lmt = trim(strip_tags($_POST['prod_purchase_lmt']));
		$selectbrand = trim(strip_tags($_POST['selectbrand']));
		$selectseller = trim(strip_tags($_POST['selectseller']));
		$return_policy = trim(strip_tags($_POST['return_policy']));
		$prod_remark = trim(strip_tags($_POST['prod_remark']));
		$shipping = trim(strip_tags($_POST['shipping']));
		$prod_youtubeid = trim(strip_tags($_POST['prod_youtubeid']));
		$prod_meta = trim(strip_tags($_POST['prod_meta']));
		$prod_keyword = trim(strip_tags($_POST['prod_keyword']));
		$prod_meta_desc = trim(strip_tags($_POST['prod_meta_desc']));
		$prod_meta_ar = trim(strip_tags($_POST['prod_meta_ar']));
		$prod_keyword_ar = trim(strip_tags($_POST['prod_keyword_ar']));
		$prod_meta_desc_ar = trim(strip_tags($_POST['prod_meta_desc_ar']));
		$is_heavy = trim(strip_tags($_POST['is_heavy']));
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

		$selectrelatedprod = '';
		if (array_key_exists('selectrelatedprod', $_POST)) {
			$selectrelatedprod = implode(',', $_POST['selectrelatedprod']);
		}
		$selectupsell = '';
		if (array_key_exists('selectupsell', $_POST)) {
			$selectupsell = implode(',', $_POST['selectupsell']);
		}
		$is_heavy = 0;


		$enableproduct		=   addslashes($enableproduct);

		$selectattrset  	=   addslashes($selectattrset);
		$prod_name			=   addslashes($prod_name);
		$prod_sku			=   addslashes($prod_sku);
		$prod_url			=   addslashes($prod_url);
		$prod_short			=   addslashes($prod_short);
		$prod_details		=   addslashes($prod_details);
		$is_usd_price		=   addslashes($is_usd_price);
		$wholesale_product	=   addslashes($wholesale_product);
		$prod_mrp			=   addslashes($prod_mrp);
		$prod_price			=   addslashes($prod_price);
		$seller_price		=   addslashes($seller_price);
		$selecttaxclass		=   addslashes($selecttaxclass);
		$prod_qty			=   addslashes($prod_qty);
		$selectstock		=   addslashes($selectstock);
		$selectvisibility	=   addslashes($selectvisibility);
		$selectcountry		=   addslashes($selectcountry);
		$prod_hsn			=   addslashes($prod_hsn);
		$prod_weight		=   addslashes($prod_weight);
		$prod_purchase_lmt	=   addslashes($prod_purchase_lmt);
		if ($prod_purchase_lmt == '') {
			$prod_purchase_lmt = '1000';
		}
		$selectbrand		=   addslashes($selectbrand);
		$selectseller		=   addslashes($selectseller);
		$return_policy		=   addslashes($return_policy);
		$prod_remark		=   addslashes($prod_remark);
		$prod_youtubeid		=   addslashes($prod_youtubeid);
		$shipping			=   addslashes($shipping);
		$prod_meta			=   addslashes($prod_meta);
		$prod_keyword		=   addslashes($prod_keyword);
		$prod_meta_desc		=   addslashes($prod_meta_desc);
		$prod_meta_ar		=   addslashes($prod_meta_ar);
		$prod_keyword_ar		=   addslashes($prod_keyword_ar);
		$prod_meta_desc_ar		=   addslashes($prod_meta_desc_ar);
		$prod_name_ar		=   addslashes($prod_name_ar);
		$prod_short_ar		=   addslashes($prod_short_ar);
		$prod_details_ar	=   addslashes($prod_details_ar);

		$price_type = '';

		if ($enableproduct != 1) {
			$enableproduct = 3;
		}

		$name_sub = substr($prod_name, 0, 2);
		$name_text = strtoupper($name_sub);
		$random_string = random_int(100000, 999999);

		$product_unique_code = $name_text . $random_string;

		if (isset($prod_name)  && isset($category)) {

			// code for check product exist - START
			$stmt_check = $conn->prepare("SELECT web_url,product_sku FROM product_details WHERE (LOWER(web_url) ='" . strtolower($prod_url) . "' OR LOWER(product_sku) ='" . strtolower($prod_sku) . "'  )
			UNION ALL 
			SELECT '' web_url,product_sku FROM product_attribute_value WHERE LOWER(product_sku) ='" . strtolower($prod_sku) . "'  ");
			//$stmt->bind_param( s,  $inactive );
			$stmt_check->execute();
			$check_exist = 0;
			while ($stmt_check->fetch()) {
				$check_exist = 1;
			}
			// code for check product exist - END

			if ($check_exist == 0) {
				// code for add product main - START
				$product_unique_id = 'P' . $Common_Function->random_strings(10);

				//code for upload images - START
				$featured_img = '';
				if ($_FILES['featured_img']['name']) {
					$Common_Function->img_dimension_arr = $img_dimension_arr;
					$featured_img1 = $Common_Function->file_upload('featured_img', $media_path);
					$featured_img = json_encode($featured_img1);
				}
				$prod_img_url = '';
				if (is_array($_FILES['product_image']['name'])) {
					$Common_Function->img_dimension_arr = $img_dimension_arr;
					$prod_img_url_arr = $Common_Function->file_upload('product_image', $media_path);
					$prod_img_url = json_encode($prod_img_url_arr);
				}

				$prod_youtubeid = '';
				if ($_FILES['prod_youtubeid']['name']) {
					$Common_Function->img_dimension_arr = $img_dimension_arr;
					$prod_youtubeid_arr = $Common_Function->file_upload_video('prod_youtubeid', $media_path);
					$prod_youtubeid = str_replace('"', '', json_encode($prod_youtubeid_arr));
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

				$prod_type = '1'; //simple ,2 - digital;

				if (array_key_exists('selected_attr', $_POST) && array_key_exists('attr_combination', $_POST)) {
					if (count($_POST['selected_attr']) > 0  && count($_POST['attr_combination']) > 0) {
						$prod_type = '2';
					}
				}

				$stmt11 = $conn->prepare("INSERT INTO `product_details`(`status`, `prod_name`, `prod_desc`, `prod_fulldetail`,
							`prod_img_url`, `attr_set_id`, `brand_id`, `prod_type`, `price_type`, `web_url`, `product_sku`, `product_visibility`, `product_manuf_country`, `product_hsn_code`, `product_video_url`, `return_policy_id`,`product_unique_id`,`featured_img`,created_at,created_by,is_heavy,
							prod_name_ar,prod_desc_ar,prod_fulldetail_ar,shipping,prod_weight,product_unique_code) 
							VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

				$stmt11->bind_param(
					"issssiiiisssississssissssss",
					$enableproduct,
					$prod_name,
					$prod_short,
					$prod_details,
					$prod_img_url,
					$selectattrset,
					$selectbrand,
					$prod_type,
					$price_type,
					$prod_url,
					$prod_sku,
					$selectvisibility,
					$selectcountry,
					$prod_hsn,
					$prod_youtubeid,
					$return_policy,
					$product_unique_id,
					$featured_img,
					$datetime,
					$_SESSION['admin'],
					$is_heavy,
					$prod_name_ar,
					$prod_short_ar,
					$prod_details_ar,
					$shipping,
					$prod_weight,
					$product_unique_code
				);

				$stmt11->execute();

				$stmt11->store_result();

				$rows = $stmt11->affected_rows;
				// code for add product main - START

				if ($rows > 0) {
					$prod_id = $product_unique_id;

					// code for add product category - START
					$sql_cat = '';
					foreach ($category as $category_id) {
						$sql_cat .= " ('" . $category_id . "', '" . $prod_id . "', '" . $datetime . "'),";
					}
					$sql_cat .= ";";
					$sql_cat = str_replace(',;', ';', $sql_cat);
					$sql_cat1 = "INSERT INTO `product_category`( `cat_id`, `prod_id`,created_at) VALUES " . $sql_cat;
					$sql_cat_prep = $conn->prepare($sql_cat1);
					$sql_cat_prep->execute();
					$sql_cat_prep->store_result();
					// code for add product category - END

					// code for add product meta - START
					if($prod_meta || $prod_keyword || $prod_meta_desc){
						$sql_meta_prep = $conn->prepare("INSERT INTO `product_meta`(`prod_id`,`meta_title`,`meta_key`,`meta_value`,`prod_meta_ar`,`prod_keyword_ar`,`prod_meta_desc_ar`) VALUES (?,?,?,?,?,?,?)");
						
						$sql_meta_prep->bind_param( "sssssss",$prod_id,$prod_meta, $prod_keyword, $prod_meta_desc,$prod_meta_ar,$prod_keyword_ar,$prod_meta_desc_ar);
				
						$sql_meta_prep->execute();
						$sql_meta_prep->store_result();
					}
					// code for add product meta - END


					// code for add product for VENDOR - START
					$vendor_prod_sql = $conn->prepare("INSERT INTO `vendor_product`( `product_id`, `vendor_id`, `is_usd_price`, `wholesale_product`, `affiliate_commission`, `product_mrp`, `product_sale_price`, `product_tax_class`, `product_stock`, `stock_status`, `product_purchase_limit`, `product_remark`, `product_related_prod`, `product_upsell_prod`,`enable_status`,`created_at`,`seller_price`) VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

					$vendor_prod_sql->bind_param(
						"ssiidsssisissssss",
						$prod_id,
						$selectseller,
						$is_usd_price,
						$wholesale_product,
						$affiliate_commission,
						$prod_mrp,
						$prod_price,
						$selecttaxclass,
						$prod_qty,
						$selectstock,
						$prod_purchase_lmt,
						$prod_remark,
						$selectrelatedprod,
						$selectupsell,
						$enableproduct,
						$datetime,
						$seller_price
					);

					$vendor_prod_sql->execute();
					$vendor_prod_sql->store_result();

					$vendor_prod_row = $vendor_prod_sql->affected_rows;
					$vendor_prod_id = $vendor_prod_sql->insert_id;
					// code for add product for VENDOR - END


					// code for add product for Attribute - START

					if (array_key_exists('selected_attr', $_POST) && array_key_exists('attr_combination', $_POST)) {
						if (count($_POST['selected_attr']) > 0  && count($_POST['attr_combination']) > 0) {
							foreach ($_POST['selected_attr'] as $attr_json) {
								$attr_json_decod = json_decode($attr_json);
								$attr_id = $attr_json_decod->attribute_id;
								$attribute_val = json_encode($attr_json_decod->attribute_val, JSON_FORCE_OBJECT);

								$sql_attr_prep = $conn->prepare("INSERT INTO `product_attribute`(`prod_attr_id`,`prod_id`,`attr_value`,`vendor_id`) VALUES (?,?,?,?)");

								$sql_attr_prep->bind_param("isss", $attr_id, $prod_id, $attribute_val, $selectseller);

								$sql_attr_prep->execute();
								$sql_attr_prep->store_result();
							}

							$sql_attr = '';
							$conf_image = '';
							$count_varient = count($_POST['attr_combination']);
							for ($v = 0; $v < $count_varient; $v++) {
								$varient_val = json_encode($_POST['attr_combination'][$v], JSON_FORCE_OBJECT);
								$prod_skus = $Common_Function->validate_product_sku($_POST['prod_skus'][$v], $conn);
								$sale_price = $_POST['sale_price'][$v];
								$mrp_price = $_POST['mrp_price'][$v];
								$stocks = $_POST['stocks'][$v];

								if ($_FILES['conf_image' . $v]['name']) {
									$Common_Function->img_dimension_arr = $img_dimension_arr;
									$conf_image1 = $Common_Function->file_upload('conf_image' . $v, $media_path);
									$conf_image = json_encode($conf_image1);
								}


								$sql_attr .= " ('" . $prod_id . "','" . $vendor_prod_id . "', '" . $prod_skus . "', " . $varient_val . ", '" . $sale_price . "', '" . $mrp_price . "', '" . $stocks . "','" . $conf_image . "',1,'" . $datetime . "'),";
							}
							$sql_attr .= ";";
							$sql_attr = str_replace(',;', ';', $sql_attr);

							$sql_meta_prep = $conn->prepare("INSERT INTO `product_attribute_value`(`product_id`, `vendor_prod_id`, `product_sku`, `prod_attr_value`, `price`, `mrp`, `stock`,`conf_image`, `notify_on_stock_below`, `created_at`) 
									VALUES " . $sql_attr);

							$sql_meta_prep->execute();
							$sql_meta_prep->store_result();
						}
					}

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

					// code for add product for Attribute - END
					$msg = "Product added successfully.";
				} else {
					$msg = "failed to add. Please try again";
				}
			} else {
				$msg = "Product Web URL and SKU already exist.";
			}
		} else {
			$msg = "Invalid Parameters. Please fill all required fields.";
		}
	} else {
		$msg = "Invalid Parameters. Please fill all required fields.";
	}
}

include("footernew.php");
echo '<script>successmsg1("' . $msg . '","manage_product.php"); </script> ';
die;
