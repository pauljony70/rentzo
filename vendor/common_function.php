<?php

use \Gumlet\ImageResize;

class Common_Function
{
	public function __construct()
	{

		$img_dimension_arr = array();
	}
	//function to rmove special char from product name and create url and SKU
	function makeurlnamebyname($str)
	{
		$inputstring = trim(strip_tags($str));
		$lowertext = strtolower($inputstring);
		//	$lowertext = preg_replace('/[^A-Za-z0-9\-]/', '', $lowertext);
		$lowertext = str_replace(" ", "-", $lowertext);
		$lowertext = str_replace("&", "and", $lowertext);
		$lowertext = str_replace("%", "percent", $lowertext);
		$lowertext = str_replace("--", "-", $lowertext);
		$lowertext = str_replace("---", "-", $lowertext);
		$lowertext = str_replace("  ", "-", $lowertext);
		$lowertext = str_replace("_", "-", $lowertext);
		$lowertext = str_replace("$", "", $lowertext);
		$lowertext = str_replace("@", "", $lowertext);
		$lowertext = str_replace("!", "", $lowertext);
		$lowertext = str_replace("#", "", $lowertext);
		$lowertext = str_replace("^", "", $lowertext);
		$lowertext = str_replace("`", "", $lowertext);
		$lowertext = str_replace("*", "", $lowertext);
		$lowertext = str_replace("(", "", $lowertext);
		$lowertext = str_replace(")", "", $lowertext);
		$lowertext = str_replace("+", "", $lowertext);
		$lowertext = str_replace("=", "", $lowertext);
		$lowertext = str_replace(":", "", $lowertext);
		$lowertext = str_replace(";", "", $lowertext);
		$lowertext = str_replace("<", "", $lowertext);
		$lowertext = str_replace("?", "", $lowertext);
		$lowertext = str_replace(">", "", $lowertext);
		$lowertext = str_replace("'", "", $lowertext);
		$lowertext = str_replace('"', "", $lowertext);
		$lowertext = str_replace(',', "", $lowertext);
		$lowertext = str_replace('.', "", $lowertext);
		$lowertext = str_replace('[', "", $lowertext);
		$lowertext = str_replace(']', "", $lowertext);
		$lowertext = str_replace('{', "", $lowertext);
		$lowertext = str_replace('}', "", $lowertext);
		$lowertext = str_replace('|', "", $lowertext);
		$lowertext = str_replace('/', "", $lowertext);
		return $lowertext;
	}

	//function to rmove special char from product name and and SKU
	function makeSKUbyname($str)
	{
		$lowertext = trim(strip_tags($str));
		//	$lowertext = preg_replace('/[^A-Za-z0-9\-]/', '', $lowertext);
		$lowertext = str_replace(" ", "-", $lowertext);
		$lowertext = str_replace("&", "and", $lowertext);
		$lowertext = str_replace("%", "percent", $lowertext);
		$lowertext = str_replace("--", "-", $lowertext);
		$lowertext = str_replace("---", "-", $lowertext);
		$lowertext = str_replace("  ", "-", $lowertext);
		$lowertext = str_replace("_", "-", $lowertext);
		$lowertext = str_replace("$", "", $lowertext);
		$lowertext = str_replace("@", "", $lowertext);
		$lowertext = str_replace("!", "", $lowertext);
		$lowertext = str_replace("#", "", $lowertext);
		$lowertext = str_replace("^", "", $lowertext);
		$lowertext = str_replace("`", "", $lowertext);
		$lowertext = str_replace("*", "", $lowertext);
		$lowertext = str_replace("(", "", $lowertext);
		$lowertext = str_replace(")", "", $lowertext);
		$lowertext = str_replace("+", "", $lowertext);
		$lowertext = str_replace("=", "", $lowertext);
		$lowertext = str_replace(":", "", $lowertext);
		$lowertext = str_replace(";", "", $lowertext);
		$lowertext = str_replace("<", "", $lowertext);
		$lowertext = str_replace("?", "", $lowertext);
		$lowertext = str_replace(">", "", $lowertext);
		$lowertext = str_replace("'", "", $lowertext);
		$lowertext = str_replace('"', "", $lowertext);
		$lowertext = str_replace(',', "", $lowertext);
		$lowertext = str_replace('.', "", $lowertext);
		$lowertext = str_replace('[', "", $lowertext);
		$lowertext = str_replace(']', "", $lowertext);
		$lowertext = str_replace('{', "", $lowertext);
		$lowertext = str_replace('}', "", $lowertext);
		$lowertext = str_replace('|', "", $lowertext);
		$lowertext = str_replace('/', "", $lowertext);
		return $lowertext;
	}

	//function to rmove special char from product name and create url and SKU
	function makeimagepath($str)
	{
		$inputstring = trim(strip_tags($str));
		$lowertext = strtolower($inputstring);
		//	$lowertext = preg_replace('/[^A-Za-z0-9\-]/', '', $lowertext);
		$lowertext = str_replace(" ", "-", $lowertext);
		$lowertext = str_replace("&", "", $lowertext);
		$lowertext = str_replace("%", "", $lowertext);
		$lowertext = str_replace("--", "-", $lowertext);
		$lowertext = str_replace("---", "-", $lowertext);
		$lowertext = str_replace("  ", "-", $lowertext);
		$lowertext = str_replace("_", "-", $lowertext);
		$lowertext = str_replace("$", "", $lowertext);
		$lowertext = str_replace("@", "", $lowertext);
		$lowertext = str_replace("!", "", $lowertext);
		$lowertext = str_replace("#", "", $lowertext);
		$lowertext = str_replace("^", "", $lowertext);
		$lowertext = str_replace("`", "", $lowertext);
		$lowertext = str_replace("*", "", $lowertext);
		$lowertext = str_replace("(", "", $lowertext);
		$lowertext = str_replace(")", "", $lowertext);
		$lowertext = str_replace("+", "", $lowertext);
		$lowertext = str_replace("=", "", $lowertext);
		$lowertext = str_replace(":", "", $lowertext);
		$lowertext = str_replace(";", "", $lowertext);
		$lowertext = str_replace("<", "", $lowertext);
		$lowertext = str_replace("?", "", $lowertext);
		$lowertext = str_replace(">", "", $lowertext);
		$lowertext = str_replace("'", "", $lowertext);
		$lowertext = str_replace('"', "", $lowertext);
		$lowertext = str_replace(',', "", $lowertext);
		$lowertext = str_replace('[', "", $lowertext);
		$lowertext = str_replace(']', "", $lowertext);
		$lowertext = str_replace('{', "", $lowertext);
		$lowertext = str_replace('}', "", $lowertext);
		$lowertext = str_replace('|', "", $lowertext);
		$lowertext = str_replace('/', "", $lowertext);
		return $lowertext;
	}

	// string of specified length 
	function random_strings($length_of_string)
	{

		// String of all alphanumeric character 
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		// Shufle the $str_result and returns substring 
		// of specified length 
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}

	//function for create and check media folder
	function create_media_folder($media_path)
	{
		$folder_name = $media_path . date("Y-m-d");
		if (is_dir($folder_name)) {
		} else {
			mkdir($folder_name);
		}
		return $folder_name;
	}


	//function for upload products image and resize image in multiple dimention
	function file_upload($file_name, $media_path)
	{
		include_once('libraries/php-image-resize-master/lib/ImageResize.php');

		$media_dir = $this->create_media_folder($media_path);
		$file_full_path = '';
		if (is_array($_FILES[$file_name]["name"])) {
			$count = count($_FILES[$file_name]["name"]);
			$file_full_path = array();
			for ($i = 0; $i < $count; $i++) {
				$path_info = '';
				if ($_FILES[$file_name]["name"][$i] != "") {
					// $path_info = pathinfo($_FILES[$file_name]["name"][$i]);

					// $extension = $path_info['extension'];
					// $filename = $this->makeimagepath($path_info['filename']);

					// $intFile = mt_rand();
					// $file_full_path1 = $media_dir . '/' . $filename . $intFile . '.' . $extension;
					// //$file_full_path1 = $media_dir.'/'.$intFile.$this->makeimagepath($_FILES[$file_name]["name"][$i]);
					// move_uploaded_file($_FILES[$file_name]["tmp_name"][$i], $file_full_path1);

					// $thumb = array();
					// foreach ($this->img_dimension_arr as $value) {
					// 	$height = $value[0];
					// 	$width = $value[1];
					// 	$destination_file = $media_dir . '/' . $filename . $intFile . '-' . $height . '-' . $width . '.' . $extension;

					// 	$image = new ImageResize($file_full_path1);
					// 	$image->resize($height, $width);
					// 	$image->save($destination_file);
					// 	$thumb[$height . '-' . $width] = str_replace($media_path, '', $destination_file);
					// }
					// //unlink($file_full_path1);
					// $file_full_path[] = $thumb;

					$newFileName = uniqid();
					// $destinationDir = '../media';
					$targetFileName = 'converted_image.webp';
					$targetFilePath = $targetFilePath = $media_dir . '/' . $newFileName . '.webp';
					$sourceFileName = $_FILES[$file_name]['name'][$i];
					$sourceFilePath = $_FILES[$file_name]['tmp_name'][$i];
					$sourceFileType = $_FILES[$file_name]['type'][$i];

					$sourceImage = imagecreatefromstring(file_get_contents($sourceFilePath));


					// 	// Convert the image to WebP format
					// imagewebp($sourceImage, $targetFilePath);

					// 	// Free up memory
					// imagedestroy($sourceImage);

					move_uploaded_file($sourceFilePath, $targetFilePath);

					$thumb = array();
					foreach ($this->img_dimension_arr as $value) {
						$height = $value[0];
						$width = $value[1];
						$thumb[$height . '-' . $width] = str_replace($media_path, '', $targetFilePath);
					}
					$file_full_path[] = $thumb;
				}
			}
		} else {
			if ($_FILES[$file_name]["name"] != "") {
				// $path_info = pathinfo($_FILES[$file_name]["name"]);

				// $extension = $path_info['extension'];
				// $filename = $this->makeimagepath($path_info['filename']);

				// $intFile = mt_rand();
				// $file_full_path1 = $media_dir . '/' . $filename . $intFile . '.' . $extension;
				// //$file_full_path1 = $media_dir.'/'.$intFile.$this->makeimagepath($_FILES[$file_name]["name"]);
				// move_uploaded_file($_FILES[$file_name]["tmp_name"], $file_full_path1);

				// $thumb = array();
				// foreach ($this->img_dimension_arr as $value) {
				// 	$height = $value[0];
				// 	$width = $value[1];
				// 	$destination_file = $media_dir . '/' . $filename . $intFile . '-' . $height . '-' . $width . '.' . $extension;

				// 	$image = new ImageResize($file_full_path1);
				// 	$image->resize($height, $width);
				// 	$image->save($destination_file);
				// 	$thumb[$height . '-' . $width] = str_replace($media_path, '', $destination_file);
				// }
				// //unlink($file_full_path1);
				// $file_full_path = $thumb;

				/* Image Upload By Conevrting to webp */
				$newFileName = uniqid();
				// $destinationDir = '../media';
				$targetFileName = 'converted_image.webp';
				$targetFilePath = $targetFilePath = $media_dir . '/' . $newFileName . '.webp';
				$sourceFileName = $_FILES[$file_name]['name'];
				$sourceFilePath = $_FILES[$file_name]['tmp_name'];
				$sourceFileType = $_FILES[$file_name]['type'];

				$sourceImage = imagecreatefromstring(file_get_contents($sourceFilePath));


				// 	// Convert the image to WebP format
				// imagewebp($sourceImage, $targetFilePath);

				// 	// Free up memory
				// imagedestroy($sourceImage);

				move_uploaded_file($sourceFilePath, $targetFilePath);

				$thumb = array();
				foreach ($this->img_dimension_arr as $value) {
					$height = $value[0];
					$width = $value[1];
					$thumb[$height . '-' . $width] = str_replace($media_path, '', $targetFilePath);
				}
				$file_full_path = $thumb;
			}
		}

		return $file_full_path;
	}

	function file_upload_video($file_name, $media_path)
	{
		include_once('libraries/php-image-resize-master/lib/ImageResize.php');
		$media_dir = $this->create_media_folder($media_path);
		$file_full_path_final = '';
		if ($_FILES[$file_name]["name"] != "") {
			$path_info = pathinfo($_FILES[$file_name]["name"]);
			$extension = $path_info['extension'];
			$filename = $this->makeimagepath($path_info['filename']);
			$intFile = mt_rand();
			$file_full_path1 = $media_dir . '/' . $filename . $intFile . '.' . $extension;
			move_uploaded_file($_FILES[$file_name]["tmp_name"], $file_full_path1);
			$destination_file = $media_dir . '/' . $filename . $intFile . '.' . $extension;
			$file_full_path = str_replace($media_path, '', $destination_file);
			$file_full_path_final = str_replace('"', '', $file_full_path);
		}
		return $file_full_path_final;
	}

	//function for upload products image and resize image in multiple dimention
	function doc_upload($file_name, $media_path)
	{

		$media_dir = $this->create_media_folder($media_path);
		$file_full_path = '';
		if (is_array($_FILES[$file_name]["name"])) {
			$count = count($_FILES[$file_name]["name"]);
			$file_full_path = array();
			for ($i = 0; $i < $count; $i++) {
				if ($_FILES[$file_name]["name"][$i] != "") {
					$intFile = mt_rand();
					$file_full_path1 = $media_dir . '/' . $intFile . $this->makeimagepath($_FILES[$file_name]["name"][$i]);
					move_uploaded_file($_FILES[$file_name]["tmp_name"][$i], $file_full_path1);
					$file_full_path[] = str_replace($media_path, '', $file_full_path1);
				}
			}
		} else {
			if ($_FILES[$file_name]["name"] != "") {

				$intFile = mt_rand();
				$file_full_path1 = $media_dir . '/' . $intFile . $this->makeimagepath($_FILES[$file_name]["name"]);
				move_uploaded_file($_FILES[$file_name]["tmp_name"], $file_full_path1);

				$file_full_path = str_replace($media_path, '', $file_full_path1);
			}
		}

		return $file_full_path;
	}

	//function for validate Product SKU'save

	function validate_product_sku($prod_sku, $conn, $prod_id = '')
	{

		// code for check product exist - START
		if ($prod_id) {
			$stmt_check = $conn->prepare("SELECT web_url,product_sku FROM product_details WHERE product_unique_id != '" . $prod_id . "' AND LOWER(product_sku) ='" . strtolower($prod_sku) . "'
									UNION ALL 
									SELECT '' web_url,product_sku FROM product_attribute_value WHERE product_id !=  '" . $prod_id . "' AND LOWER(product_sku) ='" . strtolower($prod_sku) . "'  ");
		} else {
			$stmt_check = $conn->prepare("SELECT web_url,product_sku FROM product_details WHERE LOWER(product_sku) ='" . strtolower($prod_sku) . "'
									UNION ALL 
									SELECT '' web_url,product_sku FROM product_attribute_value WHERE LOWER(product_sku) ='" . strtolower($prod_sku) . "'  ");
		}
		$stmt_check->execute();
		$check_exist = 0;
		while ($stmt_check->fetch()) {
			$check_exist = 1;
		}

		if ($check_exist == 1) {
			$sku = $prod_sku . rand(1, 999);
		} else {
			$sku = $prod_sku;
		}
		return $sku;
		// code for check product exist - END
	}

	//function for delete brands

	function delete_product_brand($brand_id, $conn, $media_path, $img_dimension_arr)
	{
		$stmt = $conn->prepare("SELECT brand_img FROM brand WHERE brand_id=?");
		$stmt->bind_param("i", $brand_id);
		$stmt->execute();

		$stmt->bind_result($brand_img);

		while ($stmt->fetch()) {
			$img_decode = json_decode($brand_img);

			if (count($img_decode) > 0) {
				foreach ($img_dimension_arr as $height_width) {
					unlink($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]});
				}
			}
		}
		$stmt2 = $conn->prepare("DELETE FROM brand WHERE brand_id = '" . $brand_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}


	//function for delete category

	function delete_product_category($cat_id, $conn, $media_path, $img_dimension_arr)
	{
		$stmt = $conn->prepare("SELECT cat_img FROM category WHERE cat_id=?");
		$stmt->bind_param("i", $cat_id);
		$stmt->execute();

		$stmt->bind_result($cat_img);

		while ($stmt->fetch()) {
			$img_decode = json_decode($cat_img);

			if (count($img_decode) > 0) {
				foreach ($img_dimension_arr as $height_width) {
					unlink($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]});
				}
			}
		}
		$stmt2 = $conn->prepare("DELETE FROM category WHERE cat_id = '" . $cat_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}

	//function for delete attribute set

	function delete_product_attribute_set($cat_id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM attribute_set WHERE sno = '" . $cat_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}

	//function for delete tax class

	function delete_product_tax_class($cat_id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM tax WHERE tax_id = '" . $cat_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}


	//function for delete country

	function delete_country($cat_id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM country WHERE id = '" . $cat_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}


	//function for delete return policy

	function delete_return_policy($cat_id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM product_return_policy WHERE id = '" . $cat_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}


	//function for delete attribute conf

	function delete_attribute_conf($cat_id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM product_attributes_set WHERE id = '" . $cat_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}


	//function for delete attribute conf val

	function delete_attribute_conf_val($cat_id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM product_attributes_conf WHERE id = '" . $cat_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}

	//function for download files
	function download($name)
	{
		$file = $name;

		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}
	}

	//function for create table import_request_variables

	function create_table($conn, $table_name)
	{
		$stmt = $conn->prepare('DROP TABLE IF EXISTS ' . $table_name);
		$stmt->execute();

		$sql = "CREATE TABLE `" . $table_name . "` (
			`id` int PRIMARY KEY AUTO_INCREMENT,
			`status` int NOT NULL,
			`fail_reason` text NOT NULL,
			`name_arabic` text NOT NULL,
			`name` text NOT NULL,
			`sku` text NOT NULL,
			`url_key` text NOT NULL,
			`attribute_set` text NOT NULL,
			`product_type` text NOT NULL,
			`categories` text NOT NULL,
			`short_description` text NOT NULL,
			`arabic_short_description` text NOT NULL,
			`description` text NOT NULL,
			`arabic_description` text NOT NULL,
			`mrp` text NOT NULL,
			`price` text NOT NULL,
			`tax_class` text NOT NULL,
			`qty` text NOT NULL,
			`stock_status` text NOT NULL,
			`visibility` text NOT NULL,
			`country_of_manufacture` text NOT NULL,
			`hsn_code` text NOT NULL,
			`product_purchase_limit` text NOT NULL,
			`brand` text NOT NULL,
			`return_policy` text NOT NULL,
			`configurable_variations` text NOT NULL,
			`remarks` text NOT NULL,
			`youtube_video_link` text NOT NULL,
			`related_skus` text NOT NULL,
			`upsell_skus` text NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

		$stmt2 = $conn->prepare($sql);
		$stmt2->execute();
	}

	//validate product sku

	function validate_import_product_sku($conn, $prod_sku)
	{
		// code for check product exist - START
		$stmt_check = $conn->query("SELECT web_url,product_sku FROM product_details WHERE  LOWER(product_sku) ='" . strtolower($prod_sku) . "' 
										UNION ALL 
										SELECT '' web_url,product_sku FROM product_attribute_value WHERE LOWER(product_sku) ='" . strtolower($prod_sku) . "'  ");
		$check_exist = 0;
		if ($stmt_check->num_rows > 0) {
			$check_exist = 1;
		}
		return $check_exist;
	}


	//validate product url key

	function validate_product_url_key($conn, $prod_url)
	{

		$stmt_check = $conn->query("SELECT web_url FROM product_details WHERE  web_url ='" . $prod_url . "'  ");
		$check_exist = 0;
		if ($stmt_check->num_rows > 0) {
			$check_exist = 1;
		}
		return $check_exist;
	}

	//validate product attribute set

	function validate_product_attribute_set($conn, $attribute_set)
	{

		$stmt_check = $conn->query("SELECT sno FROM attribute_set WHERE  LOWER(name) ='" . strtolower($attribute_set) . "' AND status = '1' ");
		$id = 0;
		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();

			$id = $rows['sno'];
		}
		return $id;
	}

	//validate product tax class

	function validate_product_tax_class($conn, $tax_class)
	{
		$stmt_check = $conn->query("SELECT tax_id FROM tax WHERE  LOWER(name) ='" . strtolower($tax_class) . "' AND status = '1' ");
		$id = 0;
		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();

			$id = $rows['tax_id'];
		}
		return $id;
	}

	//validate product categories

	function validate_product_categories($conn, $categories)
	{

		$stmt_check = $conn->query("SELECT cat_id FROM category WHERE  LOWER(cat_name) ='" . strtolower($categories) . "' AND status = '1' ");
		$id = 0;
		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();
			$id = $rows['cat_id'];
		}
		return $id;
	}

	//validate product visibility

	function validate_product_visibility($conn, $visibility)
	{

		$stmt_check = $conn->query("SELECT id FROM visibility WHERE  LOWER(name) ='" . strtolower($visibility) . "' AND status = '1' ");
		$id = 0;
		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();
			$id = $rows['id'];
		}
		return $id;
	}


	//validate product country

	function validate_product_country_of_manufacture($conn, $country_of_manufacture)
	{

		$stmt_check = $conn->query("SELECT id FROM country WHERE  LOWER(name) ='" . strtolower($country_of_manufacture) . "'");
		$id = 0;
		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();
			$id = $rows['id'];
		}
		return $id;
	}

	//validate product brand

	function validate_product_brand($conn, $brand)
	{

		$stmt_check = $conn->query("SELECT brand_id FROM brand WHERE  LOWER(brand_name) ='" . strtolower($brand) . "' AND status = '1' ");
		$id = 0;
		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();
			$id = $rows['brand_id'];
		}
		return $id;
	}


	//validate product return policy

	function validate_product_return_policy($conn, $return_policy)
	{

		$stmt_check = $conn->query("SELECT id FROM product_return_policy WHERE  LOWER(title) ='" . strtolower($return_policy) . "' AND status = '1' ");
		$id = 0;
		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();
			$id = $rows['id'];
		}
		return $id;
	}

	//validate product related sku

	function validate_product_related_sku($conn, $related_sku, $vendor_id)
	{
		$stmt_check = $conn->query("SELECT product_unique_id FROM product_details  pd INNER JOIN vendor_product vp ON vp.product_id = pd.product_unique_id 
			WHERE  LOWER(pd.product_sku) ='" . strtolower($related_sku) . "' AND pd.status = '1' AND vp.vendor_id = '" . $vendor_id . "'");
		$id = '';
		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();
			$id = $rows['product_unique_id'];
		}
		return $id;
	}


	//validate product configurable variations

	function validate_product_configurable_variations($conn, $explode_conf)
	{
		$stmt_check = $conn->query("SELECT id FROM product_attributes_set  WHERE  LOWER(attribute) ='" . strtolower($explode_conf) . "' AND status = '1'");

		$id = 0;

		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();
			$id = $rows['id'];
		}
		return $id;
	}

	//validate product configurable variations value

	function validate_product_configurable_variations1($conn, $explode_conf, $attribute_id)
	{
		$stmt_check = $conn->query("SELECT id FROM product_attributes_conf  WHERE  LOWER(attribute_value) ='" . strtolower($explode_conf) . "' AND attribute_id = '" . $attribute_id . "'");

		$id = 0;

		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();
			$id = $rows['id'];
		}
		return $id;
	}


	//update import product status

	function validate_product_update_status($conn, $status, $id, $fail_reason, $table_main)
	{
		$stmt11 = $conn->prepare("UPDATE " . $table_main . " SET status ='" . $status . "', fail_reason ='" . $fail_reason . "' WHERE id ='" . $id . "'");

		$stmt11->execute();
		$stmt11->store_result();
	}


	//insert valid records in second table

	function validate_product_insert_step2($conn, $rows, $table_name, $seller)
	{
		unset($rows['id']);
		unset($rows['status']);
		unset($rows['fail_reason']);
		$array_key = array_keys($rows);
		$array_values = array_values($rows);

		$stmt_check1 = $conn->query("SELECT id FROM " . $table_name . " WHERE  LOWER(sku) ='" . strtolower($rows['sku']) . "' AND product_type ='configurable' ");

		if ($stmt_check1->num_rows > 0) {
			$rows_check = $stmt_check1->fetch_assoc();
			$mrp = $rows['mrp'];
			$price = $rows['price'];
			$qty = $rows['qty'];
			$configurable_variations = $rows['configurable_variations'];

			$sql  = "UPDATE " . $table_name . "  SET mrp = CONCAT(`mrp`,'||','" . $mrp . "') ,price = CONCAT(`price`,'||','" . $price . "'), qty = CONCAT(`qty`,'||','" . $qty . "') ,
				configurable_variations = CONCAT(`configurable_variations`,'||','" . $configurable_variations . "') WHERE id = '" . $rows_check['id'] . "' ";

			$stmt11 = $conn->prepare($sql);
			$stmt11->execute();
			$stmt11->store_result();
		} else {
			$sql  = "INSERT INTO " . $table_name . " (" . implode(',', $array_key) . ") VALUES('" . implode("','", $array_values) . "')";
			$stmt11 = $conn->prepare($sql);
			$stmt11->execute();
			$stmt11->store_result();
		}
	}

	//function for insert product in main table

	function finish_import_bulk_product($conn, $rows, $seller, $datetime, $table_name)
	{
		// code for add product main - START

		$selectattrset = trim(strip_tags($rows['attribute_set']));
		$category = explode(',', $rows['categories']);
		$product_type = $rows['product_type'];
		$prod_name = trim(strip_tags($rows['name']));

		$prod_short = trim(strip_tags($rows['short_description']));
		$prod_details = trim($rows['description']);

		$prod_mrp = trim(strip_tags($rows['mrp']));
		$prod_price = trim(strip_tags($rows['price']));
		$selecttaxclass = trim(strip_tags($rows['tax_class']));
		$prod_qty = trim(strip_tags($rows['qty']));
		$selectstock = trim(strip_tags($rows['stock_status']));
		$selectvisibility = trim(strip_tags($rows['visibility']));
		$selectcountry = trim(strip_tags($rows['country_of_manufacture']));
		$prod_hsn = trim(strip_tags($rows['hsn_code']));
		$prod_purchase_lmt = trim(strip_tags($rows['product_purchase_limit']));
		$selectbrand = trim(strip_tags($rows['brand']));
		$selectseller = $seller;
		$return_policy = trim(strip_tags($rows['return_policy']));
		$prod_remark = trim(strip_tags($rows['remarks']));
		$prod_youtubeid = trim(strip_tags($rows['youtube_video_link']));

		$selectrelatedprod = $rows['related_skus'];

		$selectupsell = $rows['upsell_skus'];


		$price_type = '';
		$enableproduct	=  0;

		$selectattrset  =   addslashes($selectattrset);
		$prod_name		=   addslashes($prod_name);

		$prod_short		=   addslashes($prod_short);
		$prod_details		=   addslashes($prod_details);
		$prod_mrp		=   addslashes($prod_mrp);
		$prod_price		=   addslashes($prod_price);
		$selecttaxclass		=   addslashes($selecttaxclass);
		$prod_qty		=   addslashes($prod_qty);
		$selectstock		=   addslashes($selectstock);
		$selectvisibility		=   addslashes($selectvisibility);
		$selectcountry		=   addslashes($selectcountry);
		$prod_hsn		=   addslashes($prod_hsn);
		$prod_purchase_lmt		=   addslashes($prod_purchase_lmt);
		$selectbrand		=   addslashes($selectbrand);
		$selectsellers		=   addslashes($selectseller);
		$return_policy		=   addslashes($return_policy);
		$prod_remark		=   addslashes($prod_remark);
		$prod_youtubeid		=   addslashes($prod_youtubeid);


		$product_unique_id = 'P' . $this->random_strings(10);

		$prod_url = $this->makeurlnamebyname($rows['url_key']);
		$prod_sku = $this->makeSKUbyname($rows['sku']);

		if ($rows['product_type'] == 'simple') {
			$prod_type = 1;
		} else if ($rows['product_type'] == 'configurable') {
			$prod_type = 2;
		}
		$featured_img = '';
		$prod_img_url = '';


		$stmt_check1 = $conn->query("SELECT product_unique_id FROM product_details WHERE  LOWER(product_sku) ='" . strtolower($prod_sku) . "' 
				AND prod_type ='2' AND created_by ='" . $seller . "' ");

		if ($stmt_check1->num_rows > 0) {
		} else {

			$stmt11 = $conn->prepare("INSERT INTO `product_details`(`status`, `prod_name`, `prod_desc`, `prod_fulldetail`,
								`prod_img_url`, `attr_set_id`, `brand_id`, `prod_type`, `price_type`, `web_url`, `product_sku`, `product_visibility`,
								`product_manuf_country`, `product_hsn_code`, `product_video_url`, `return_policy_id`,`product_unique_id`,`featured_img`,created_at,created_by) 
								VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

			$stmt11->bind_param(
				"issssiiiisssississss",
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
				$seller
			);

			$stmt11->execute();
			$stmt11->store_result();


			$rowss = $stmt11->affected_rows;
			// code for add product main - START
			if ($rowss > 0) {
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


				// code for add product for VENDOR - START
				$vendor_prod_sql = $conn->prepare("INSERT INTO `vendor_product`( `product_id`, `vendor_id`, `product_mrp`, `product_sale_price`, `product_tax_class`, 
									`product_stock`, `stock_status`, `product_purchase_limit`, `product_remark`, `product_related_prod`, `product_upsell_prod`,`enable_status`,created_at) 
									VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,?)");

				$vendor_prod_sql->bind_param(
					"sssssisisssss",
					$prod_id,
					$selectseller,
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
					$datetime
				);

				$vendor_prod_sql->execute();
				$vendor_prod_sql->store_result();

				$vendor_prod_row = $vendor_prod_sql->affected_rows;
				$vendor_prod_id = $vendor_prod_sql->insert_id;
				// code for add product for VENDOR - END


				// code for add product for Attribute - START
				if ($rows['product_type'] == 'configurable') {
					$this->add_configurable_product_attributes($conn, $rows, $seller, $datetime, $table_name, $product_unique_id, $vendor_prod_id);
				}
				// code for add product for Attribute - END

			}
		}
	}

	function add_configurable_product_attributes($conn, $rowsattr, $seller, $datetime, $table_name, $prod_id, $vendor_prod_id)
	{

		$conf_sku = $attribute_id = $attribute_conf_value = array();
		$configurable_variations1 = explode('||', $rowsattr['configurable_variations']);
		$mrp = explode('||', $rowsattr['mrp']);
		$price = explode('||', $rowsattr['price']);
		$qty = explode('||', $rowsattr['qty']);

		foreach ($configurable_variations1 as $configurable_variations) {

			if ($configurable_variations) {
				$explode_conf = explode(',', $configurable_variations);
				$i = 0;

				foreach ($explode_conf as $prod_conf) {
					$explode_conf2 = explode('=', $prod_conf);
					if ($i == 0) {
						if ($explode_conf2[0] == 'sku') {
							$conf_sku[] = $explode_conf2[1];
						}
					} else {
						if ($explode_conf2[0]) {
							$attr_id = $this->validate_product_configurable_variations($conn, $explode_conf2[0]);
							if (!is_array($attribute_conf_value[$attr_id])) {
								$attribute_conf_value[$attr_id] = array();
							}

							if ($attr_id > 0) {
								$attribute_id[]  = $attr_id;
								$att_value = $this->get_configurable_variations1($conn, $explode_conf2[1], $attr_id);
								if (!in_array($att_value, $attribute_conf_value[$attr_id])) {
									$attribute_conf_value[$attr_id][] =  $att_value;
								}
							}
						}
					}
					$i++;
				}
			}
		}

		foreach ($attribute_conf_value as $key => $attributes) {
			$attr_id = $key;
			$attribute_val = json_encode($attributes, JSON_FORCE_OBJECT);

			$sql_attr_prep = $conn->prepare("INSERT INTO `product_attribute`(`prod_attr_id`,`prod_id`,`attr_value`,`vendor_id`) VALUES (?,?,?,?)");

			$sql_attr_prep->bind_param("isss", $attr_id, $prod_id, $attribute_val, $seller);

			$sql_attr_prep->execute();
			$sql_attr_prep->store_result();
		}

		$attribute_conf_value2 = array_values($attribute_conf_value);

		$count_varient_array  = $this->combos($attribute_conf_value2);


		$sql_attr = '';
		$atr = 0;
		foreach ($count_varient_array as $count_varient) {
			$varient_val = json_encode($count_varient, JSON_FORCE_OBJECT);
			$prod_skus = $conf_sku[$atr];
			$sale_price = $price[$atr];
			$mrp_price = $mrp[$atr];
			$stocks = $qty[$atr];

			$sql_attr .= " ('" . $prod_id . "','" . $vendor_prod_id . "', '" . $prod_skus . "', '" . $varient_val . "', '" . $sale_price . "', '" . $mrp_price . "', '" . $stocks . "','','" . $datetime . "'),";
			$atr++;
		}


		$sql_attr .= ";";
		$sql_attr = str_replace(',;', ';', $sql_attr);

		$sql_meta_prep = $conn->prepare("INSERT INTO `product_attribute_value`(`product_id`, `vendor_prod_id`, `product_sku`, `prod_attr_value`, 
										`price`, `mrp`, `stock`, `notify_on_stock_below`, `created_at`) 
				VALUES " . $sql_attr);

		$sql_meta_prep->execute();
		$sql_meta_prep->store_result();
	}


	//validate product configurable variations value

	function get_configurable_variations1($conn, $explode_conf, $attribute_id)
	{
		$stmt_check = $conn->query("SELECT attribute_value FROM product_attributes_conf  WHERE  LOWER(attribute_value) ='" . strtolower($explode_conf) . "' AND attribute_id = '" . $attribute_id . "'");

		$id = 0;

		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();
			$id = $rows['attribute_value'];
		}
		return $id;
	}

	function combos($data, &$all = array(), $group = array(), $val = null, $i = 0)
	{
		if (isset($val)) {
			array_push($group, $val);
		}
		if ($i >= count($data)) {
			array_push($all, $group);
		} else {
			foreach ($data[$i] as $v) {
				$this->combos($data, $all, $group, $v, $i + 1);
			}
		}
		return $all;
	}


	//validate product sku for update

	function validate_update_product_sku($conn, $prod_sku)
	{
		$rows = array();
		// code for check product exist - START
		$stmt_check = $conn->query("SELECT product_unique_id,product_sku,'' as vendor_prod_id , 'simple' as type  FROM product_details WHERE  LOWER(product_sku) ='" . strtolower($prod_sku) . "'  ");

		if ($stmt_check->num_rows > 0) {
			$rows = $stmt_check->fetch_assoc();
		} else {
			$stmt_check1 = $conn->query("SELECT product_id as product_unique_id,vendor_prod_id, product_sku , 'configurable' as type FROM product_attribute_value WHERE LOWER(product_sku) ='" . strtolower($prod_sku) . "'  ");
			if ($stmt_check1->num_rows > 0) {
				$rows = $stmt_check1->fetch_assoc();
			}
		}
		return $rows;
	}



	//function for get system settings

	function get_system_settings($conn, $type)
	{
		$response = '';
		$query = $conn->query("SELECT * FROM `settings` WHERE type ='" . $type . "'");
		if ($query->num_rows > 0) {
			$rows = $query->fetch_assoc();

			$response = $rows['description'];
		}
		return $response;
	}

	function price_formate($conn, $price)
	{
		$currency = $this->get_system_settings($conn, 'system_currency_symbol');
		return $currency . ' ' . number_format($price);
	}

	function get_cat($col1, $conn)
	{

		$stmt15 = $conn->prepare("SELECT c.cat_name	FROM category c,product_category pc 
						WHERE pc.cat_id  = c.cat_id AND pc.prod_id= '" . $col1 . "'");

		$stmt15->execute();
		$data1 = $stmt15->bind_result($col44);
		//  echo " get col data ";

		while ($stmt15->fetch()) {
			$cat_names[] = $col44;
		}
		return $cat_names;
	}

	//send email for seller

	function send_email_seller_new($conn, $sellername, $link, $type, $subject, $name)
	{

		//send to admin


		$messageadmin  = "<html><body>";

		$messageadmin .= "<table width='500px;' align='center' border='1' cellpadding='0' cellspacing='0' style='font-family: sans-serif;background: rgba(220, 220, 220, 0.17);font-size: 14px;'>";

		$messageadmin .= "<tbody>
						<tr>
							<td colspan='2'>New " . $type . ":" . $name . "</td>
							
						</tr>
						<tr>
							<td style='padding: 10px;' colspan='2'>" . $sellername . " has create a new " . $type . ". Please verify to <a href='" . $link . "'>click here</a></td>
							
						</tr>	
       
					</tbody>";

		$messageadmin .= "</table>";

		$messageadmin .= "</body></html>";

		$admin_email = $this->get_system_settings($conn, 'system_email');
		$this->smtp_email($conn, $admin_email, $subject, $messageadmin);
	}

	//send email for seller

	function send_email_forgot_password($conn, $to_email, $sellername, $checksum, $base_url, $subject)
	{

		$link = $base_url . "vendor/change_password.php?checksum=" . $checksum;
		$message  = "<html><body>";

		$message .= "<table width='500px;' align='center' border='1' cellpadding='0' cellspacing='0' style='font-family: sans-serif;background: rgba(220, 220, 220, 0.17);font-size: 14px;'>";

		$message .= "<tbody>
						<tr>
							<td colspan='2'>Dear " . $sellername . ", </td>
							
						</tr>
						
						<tr>
							<td style='padding: 10px;font-weight: 600;' colspan='2'>Please <a href='" . $link . "'>click here</a> to change your password.</td>
						</tr>
						
					</tbody>";

		$message .= "</table>";
		$message .= "</body></html>";

		$this->smtp_email($conn, $to_email, $subject, $message);
	}

	function send_delivered_email_invoice_user($conn, $order_id, $product_id, $vendor_id, $orderstatus = '')
	{
		$templ_sql = new stdClass();
		$templ_sql->num_rows = 0;
		if ($orderstatus == 'Delivered') {
			$templ_sql = $conn->query("SELECT email_title, email_subject, email_body FROM email_template WHERE id= " . DELIVER_ORDER_TEMP);
		} else if ($orderstatus == 'Cancelled') {
			$templ_sql = $conn->query("SELECT email_title, email_subject, email_body FROM email_template WHERE id= " . CANCEL_ORDER_TEMP);
		}

		if ($templ_sql->num_rows > 0) {
			$email_result = $templ_sql->fetch_assoc();
			$subject = $email_result['email_subject'];
			$email_body = $email_result['email_body'];

			//query for get order _details
			$order_detail = $conn->query("SELECT total_price, create_date, fullname,mobile,locality,fulladdress,city,state,pincode,addresstype,
							email FROM orders WHERE order_id = '" . $order_id . "'");



			if ($order_detail->num_rows > 0) {
				$order_result = $order_detail->fetch_assoc();

				$total_price = $this->price_formate($conn, $order_result['total_price']);
				$create_date = date("M d, Y", strtotime($order_result['create_date']));
				$fullname = $order_result['fullname'];
				$mobile = $order_result['mobile'];
				$toemail = $order_result['email'];
				$address = $order_result['fulladdress'] . '<br>' . $order_result['locality'] . '<br>' . $order_result['city'] . ',' . $order_result['state'] . ',' . $order_result['pincode'];

				$android_app_link = $this->get_system_settings($conn, 'android_app_link');
				$ios_app_link = $this->get_system_settings($conn, 'ios_app_link');
				$system_name = $this->get_system_settings($conn, 'system_name');
				$ios_app_link_img = MEDIAURL . 'ios_store.png';
				$and_app_img =  MEDIAURL . 'google_play.png';

				$email_body = str_replace(array('{AMOUNT_PAID}', 'AMOUNT_PAID'), $total_price, $email_body);
				$email_body = str_replace(array('{USER_NAME}', 'USER_NAME'), $fullname, $email_body);
				$email_body = str_replace(array('{ORDER_DATE}', 'ORDER_DATE'), $create_date, $email_body);
				$email_body = str_replace(array('{ORDER_ID}', 'ORDER_ID'), $order_id, $email_body);
				$email_body = str_replace(array('{USER_ADDRESS}', 'USER_ADDRESS'), $address, $email_body);
				$email_body = str_replace(array('{USER_PHONE}', 'USER_PHONE'), $mobile, $email_body);
				$email_body = str_replace(array('{STORE_NAME}', 'STORE_NAME'), $system_name, $email_body);
				$email_body = str_replace(array('{APP_LINK}', 'APP_LINK'), $android_app_link, $email_body);
				$email_body = str_replace(array('{IOS_APP}', 'IOS_APP'), $ios_app_link, $email_body);
				$email_body = str_replace(array('{AND_LINK_IMG}', 'AND_LINK_IMG'), $and_app_img, $email_body);
				$email_body = str_replace(array('{IOS_LINK_IMG}', 'IOS_LINK_IMG'), $ios_app_link_img, $email_body);

				//query for get order _details
				$query_order_prod = $conn->query("SELECT prod_name, prod_img, prod_attr,qty,prod_price,shipping,discount,delivery_date,companyname
							FROM order_product op ,sellerlogin sl WHERE order_id= '" . $order_id . "' AND op.prod_id ='" . $product_id . "' AND  sl.seller_unique_id = op.vendor_id");

				$html = '';
				if ($query_order_prod->num_rows > 0) {
					$prod_details = $query_order_prod->fetch_assoc();

					$prod_name = $prod_details['prod_name'];
					$prod_img = MEDIAURL . $prod_details['prod_img'];
					$prod_attr = $prod_details['prod_attr'];
					$qty = $prod_details['qty'];
					$prod_price = $this->price_formate($conn, $prod_details['prod_price']);
					$shipping = $this->price_formate($conn, $prod_details['shipping']);
					$discount = $this->price_formate($conn, $prod_details['discount']);
					$delivery_date = date("M d, Y", strtotime($prod_details['delivery_date']));
					$companyname = $prod_details['companyname'];

					$html .= '<tr>
								<td align="left">
									<table class="m_-4345841705994091849col" border="0" cellspacing="0" cellpadding="0" align="left">
										<tbody>
											<tr>
												<td class="m_-4345841705994091849link" style="padding-top: 20px;" align="center" valign="middle" width="120">
													<a style="color: #fff; text-decoration: none; outline: none; font-size: 13px;" href="" target="_blank" rel="noopener noreferrer">
														<img class="CToWUd" style="border: none; max-width: 125px; max-height: 125px;" src="' . $prod_img . '" alt="' . $prod_name . '" border="0" />
													</a>
												</td>
												<td style="padding-top: 20px; padding-left: 15px;" align="left" valign="top">
													<p class="m_-4345841705994091849link" style="margin-top: 0; margin-bottom: 7px;">
														<a style="font-family: Arial; font-size: 14px; font-weight: normal; font-style: normal; font-stretch: normal; line-height: 20px; color: #212121; text-decoration: none!important; word-spacing: 0.2em; max-width: 360px; display: inline-block; min-width: 352px; width: 352px;" href="" target="_blank" rel="noopener noreferrer">' . $prod_name . '</a>
														<span style="min-width: 100px; font-size: 12px; font-weight: bold; padding-right: 0px; line-height: 20px; text-align: right; display: inline-block; float: right;"> ' . $prod_price . '</span>
													</p>
													<p style="line-height: 18px; margin-top: 0px; margin-bottom: 2px; font-family: Arial; font-size: 12px; color: #212121;">Delivery 
														<span style="line-height: 18px; font-family: Arial; font-size: 12px; font-weight: bold; color: #139b3b;"> by ' . $delivery_date . '  </span>
													</p>
													<p style="line-height: 18px; margin-top: 0px; margin-bottom: 2px; font-family: Arial; font-size: 12px; color: #212121;">Seller: ' . $companyname . '
														<span style="float: right; font-size: 12px; padding-right: 5px;">
															<span style="color: #878787; text-align: right; margin-right: 5px;">Delivery charges</span>
															<span style="float: right; text-align: right;">' . $shipping . '</span>
														</span>
													</p>
													<p style="line-height: 18px; margin-top: 0px; margin-bottom: 0px; font-family: Arial; font-style: normal; font-size: 12px; font-stretch: normal; color: #212121;">Qty: ' . $qty . '</p>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>';
				}
				$email_body = str_replace(array('{PRODUCTS_DETAILS}', 'PRODUCTS_DETAILS'), $html, $email_body);

				$file_path = '';
				if ($orderstatus == 'Delivered') {
					$file_path = $this->generate_invoice($conn, $order_id, $product_id, '1');
				}

				$this->smtp_email($conn, $toemail, $subject, $email_body, $file_path);

				if (file_exists($file_path)) {
					unlink($file_path);
				}
			}
		} else {
			$subject = "Your Order Status Update is" . $orderstatus;
			$email_body = 'ajkjajak';

			//query for get order _details
			$order_detail = $conn->query("SELECT total_price, create_date, fullname,mobile,locality,fulladdress,city,state,pincode,addresstype,
							email FROM orders WHERE order_id = '" . $order_id . "'");



			if ($order_detail->num_rows > 0) {
				$order_result = $order_detail->fetch_assoc();

				$total_price = $this->price_formate($conn, $order_result['total_price']);
				$create_date = date("M d, Y", strtotime($order_result['create_date']));
				$fullname = $order_result['fullname'];
				$mobile = $order_result['mobile'];
				$toemail = $order_result['email'];
				$address = $order_result['fulladdress'] . '<br>' . $order_result['locality'] . '<br>' . $order_result['city'] . ',' . $order_result['state'] . ',' . $order_result['pincode'];

				$android_app_link = $this->get_system_settings($conn, 'android_app_link');
				$ios_app_link = $this->get_system_settings($conn, 'ios_app_link');
				$system_name = $this->get_system_settings($conn, 'system_name');
				$ios_app_link_img = MEDIAURL . 'ios_store.png';
				$and_app_img =  MEDIAURL . 'google_play.png';

				/*$email_body = str_replace(array('{AMOUNT_PAID}', 'AMOUNT_PAID'), $total_price, $email_body);
				$email_body = str_replace(array('{USER_NAME}', 'USER_NAME'), $fullname, $email_body);
				$email_body = str_replace(array('{ORDER_DATE}', 'ORDER_DATE'), $create_date, $email_body);
				$email_body = str_replace(array('{ORDER_ID}', 'ORDER_ID'), $order_id, $email_body);
				$email_body = str_replace(array('{USER_ADDRESS}', 'USER_ADDRESS'), $address, $email_body);
				$email_body = str_replace(array('{USER_PHONE}', 'USER_PHONE'), $mobile, $email_body);
				$email_body = str_replace(array('{STORE_NAME}', 'STORE_NAME'), $system_name, $email_body);
				$email_body = str_replace(array('{APP_LINK}', 'APP_LINK'), $android_app_link, $email_body);
				$email_body = str_replace(array('{IOS_APP}', 'IOS_APP'), $ios_app_link, $email_body);
				$email_body = str_replace(array('{AND_LINK_IMG}', 'AND_LINK_IMG'), $and_app_img, $email_body);
				$email_body = str_replace(array('{IOS_LINK_IMG}', 'IOS_LINK_IMG'), $ios_app_link_img, $email_body);*/

				//query for get order _details
				$query_order_prod = $conn->query("SELECT prod_name, prod_img, prod_attr,qty,prod_price,shipping,discount,delivery_date,companyname
							FROM order_product op ,sellerlogin sl WHERE order_id= '" . $order_id . "' AND op.prod_id ='" . $product_id . "' AND  sl.seller_unique_id = op.vendor_id");

				$html = '';
				if ($query_order_prod->num_rows > 0) {

					$prod_details = $query_order_prod->fetch_assoc();

					$prod_name = $prod_details['prod_name'];
					$prod_img = MEDIAURL . $prod_details['prod_img'];
					$prod_attr = $prod_details['prod_attr'];
					$qty = $prod_details['qty'];
					$prod_price = $this->price_formate($conn, $prod_details['prod_price']);
					$shipping = $this->price_formate($conn, $prod_details['shipping']);
					$discount = $this->price_formate($conn, $prod_details['discount']);
					$delivery_date = date("M d, Y", strtotime($prod_details['delivery_date']));
					$companyname = $prod_details['companyname'];


					/*$html .= '<tr>
								<td align="left">
									<table class="m_-4345841705994091849col" border="0" cellspacing="0" cellpadding="0" align="left">
										<tbody>
											<tr>
												<td class="m_-4345841705994091849link" style="padding-top: 20px;" align="center" valign="middle" width="120">
													<a style="color: #fff; text-decoration: none; outline: none; font-size: 13px;" href="" target="_blank" rel="noopener noreferrer">
														<img class="CToWUd" style="border: none; max-width: 125px; max-height: 125px;" src="' . $prod_img . '" alt="' . $prod_name . '" border="0" />
													</a>
												</td>
												<td style="padding-top: 20px; padding-left: 15px;" align="left" valign="top">
													<p class="m_-4345841705994091849link" style="margin-top: 0; margin-bottom: 7px;">
														<a style="font-family: Arial; font-size: 14px; font-weight: normal; font-style: normal; font-stretch: normal; line-height: 20px; color: #212121; text-decoration: none!important; word-spacing: 0.2em; max-width: 360px; display: inline-block; min-width: 352px; width: 352px;" href="" target="_blank" rel="noopener noreferrer">' . $prod_name . '</a>
														<span style="min-width: 100px; font-size: 12px; font-weight: bold; padding-right: 0px; line-height: 20px; text-align: right; display: inline-block; float: right;"> ' . $prod_price . '</span>
													</p>
													<p style="line-height: 18px; margin-top: 0px; margin-bottom: 2px; font-family: Arial; font-size: 12px; color: #212121;">Delivery 
														<span style="line-height: 18px; font-family: Arial; font-size: 12px; font-weight: bold; color: #139b3b;"> by ' . $delivery_date . '  </span>
													</p>
													<p style="line-height: 18px; margin-top: 0px; margin-bottom: 2px; font-family: Arial; font-size: 12px; color: #212121;">Seller: ' . $companyname . '
														<span style="float: right; font-size: 12px; padding-right: 5px;">
															<span style="color: #878787; text-align: right; margin-right: 5px;">Delivery charges</span>
															<span style="float: right; text-align: right;">' . $shipping . '</span>
														</span>
													</p>
													<p style="line-height: 18px; margin-top: 0px; margin-bottom: 0px; font-family: Arial; font-style: normal; font-size: 12px; font-stretch: normal; color: #212121;">Qty: ' . $qty . '</p>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>';*/
				}

				//$email_body = str_replace($html,$email_body);

				$file_path = '';
				/*if ($orderstatus == 'Delivered') {
					$file_path = $this->generate_invoice($conn, $order_id, $product_id, '1');
				}*/

				$this->smtp_email($conn, $toemail, $subject, $email_body, $file_path);

				if (file_exists($file_path)) {
					unlink($file_path);
				}
			}
		}
	}


	// send email 
	function smtp_email($conn, $to_email, $subject, $message, $attachment = '')
	{

		$smtp_host = $this->get_system_settings($conn, 'smtp_host');
		$smtp_port = $this->get_system_settings($conn, 'smtp_port');
		$smtp_user = $this->get_system_settings($conn, 'smtp_user');
		$smtp_password = $this->get_system_settings($conn, 'smtp_password');

		$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->Host = $smtp_host;
		$mail->Port = $smtp_port; // or the appropriate port number
		$mail->SMTPSecure = 'tls'; // or 'ssl' if required
		$mail->SMTPAuth = true;
		$mail->Username = $smtp_user;
		$mail->Password = $smtp_password;

		// Set the email message
		$mail->setFrom($smtp_user, 'no-reply');
		$mail->addAddress($to_email);
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $message;
		$mail->AltBody = $message;
		if ($attachment) {
			if (file_exists($attachment)) {
				$file_explode = explode('/', $attachment);
				$file_name = end($file_explode);
				$mail->addAttachment($attachment, $file_name);
			}
		}
		// Try to send the email
		if ($mail->send()) {
			// echo 'SMTP connection successful!';
		} else {
			// echo 'SMTP connection failed. Error: ' . $mail->ErrorInfo;
		}
	}


	function generate_invoice($conn, $ordersno, $product_id, $save_pdf)
	{
		require_once('../tcpdf/tcpdf.php');


		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$system_name = $this->get_system_settings($conn, 'system_name');
		$currency = $this->get_system_settings($conn, 'system_currency_symbol');
		$system_email = $this->get_system_settings($conn, 'system_email');

		// set document information
		$pdf->SetCreator($system_name);
		$pdf->SetAuthor($system_name);
		$pdf->SetTitle($system_name);
		$pdf->SetSubject($system_name);
		$pdf->SetKeywords($system_name);

		// set default header data

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetHeaderData('media/google_play.png', PDF_HEADER_LOGO_WIDTH, '', '', array(0, 0, 0), array(255, 255, 255));
		$pdf->SetTitle('Invoice - ' . $_REQUEST["orderid"]);
		$pdf->SetMargins(20, 0, 20, true);
		if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
			require_once(dirname(__FILE__) . '/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		$pdf->SetFont('helvetica', '', 11);
		$pdf->AddPage();



		$col1 = $col2 = $col3 = $col4 = $col5 = $col6 = $col7 = $col8 = $col9 = $col10 = $col11 = $col12 = $col13 = $col14 = $col15 = $col16 = $col17 = $col18 = $col19 = $col20  = '';
		$stmt = $conn->prepare("SELECT o.order_id,o.user_id,o.status, o.total_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,DATE(o.create_date),
							o.discount,o.total_qty, o.fullname, o.mobile, o.area, o.fulladdress,o.city,o.state, o.country, o.addresstype,o.email FROM orders o WHERE o.order_id = '" . $ordersno . "' ");


		$stmt->execute();
		$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15, $col16, $col17, $col18, $col19, $col20);

		while ($stmt->fetch()) {
			$orderid =  $col1;
			$user_id =  $col2;
			$order_status =  $col3;
			//$total_price =  $col4;
			$payment_orderid =  $col5;
			$payment_id =  $col6;
			$payment_mode =  $col7;
			$qoute_id =  $col8;
			$create_date =   date('d-m-Y', strtotime($col9));
			//	$discount =  $col10;
			$payment_status =   'Paid';
			//$total_qty =  $col11;	
			$fullname =  $col12;
			$mobile =  $col13;
			$area =  $col14;
			$fulladdress =  $col15;
			$city =  $col16;
			$state =  $col17;
			$country =  $col18;
			$addresstype =  $col19;
			$email =  $col20;
		}

		$stmt_country = $conn->prepare("SELECT name FROM  country WHERE id = '" . $country . "' ");

		$stmt_country->execute();
		$data1 = $stmt_country->bind_result($country_name);
		$country_name  = '';
		while ($stmt_country->fetch()) {
			$country_name = $country_name;
		}

		$address = $fulladdress . ',' . $city . ', ' . $state . ', ' . $country_name;



		$stmtp = $conn->prepare("SELECT op.prod_id,op.prod_sku,op.prod_name,op.prod_img,op.prod_attr,op.qty,op.prod_price,op.shipping,op.discount,op.status, sl.companyname, op.invoice_number,op.vendor_id,vp.product_tax_class,op.product_hsn_code,op.product_unique_code,op.taxable_amount,op.cgst,op.sgst,op.igst FROM `order_product` op
				,sellerlogin sl,vendor_product vp WHERE op.order_id = '" . $ordersno . "' AND op.prod_id = '" . $product_id . "' AND vp.product_id = '" . $product_id . "' AND sl.seller_unique_id = op.vendor_id ");

		$stmtp->execute();
		$datap = $stmtp->bind_result($prod_id, $prod_sku, $prod_name, $prod_img, $prod_attr, $qty, $prod_price, $shipping, $discount, $status, $seller, $invoice_number, $vendor_id, $product_tax_class, $product_hsn_code, $product_unique_code, $taxable_amount, $cgst, $sgst, $igst);
		$prod_id1 = $prod_sku1 = $prod_name1 = $prod_img1 = $prod_attr1 = $qty1 = $prod_price1 = $shipping1 = $discount = $status1 = $seller  = $invoice_number1 = $vendor_id = $product_tax_class = $product_hsn_code = $product_unique_code = $taxable_amount = $cgst = $sgst = $igst = '';
		while ($stmtp->fetch()) {
			$prod_attr1 = '';
			if ($prod_attr) {
				$attr = json_decode($prod_attr);
				$attribute = '';
				foreach ($attr as $prod_attr) {
					$attribute .= $prod_attr->attr_name . ': ' . $prod_attr->item . ', ';
				}

				$prod_attr1 = rtrim($attribute, ', ');
			}
		}

		$stmt_tax = $conn->prepare("SELECT  percent FROM tax WHERE tax_id=?");
		$stmt_tax->bind_param("s", $product_tax_class);
		$stmt_tax->execute();
		$data_tax = $stmt_tax->bind_result($tax_percent);

		while ($stmt_tax->fetch()) {
			$total_tax_percent = $tax_percent;
		}




		$cname = "";
		$address_seller = "";
		$tax = "";
		$pan_number = $cin_number = "";

		$stmt = $conn->prepare("SELECT  companyname, fullname, address, city, pincode, state, country, phone, email, logo,
			tax_number,pan_number,cin_number FROM sellerlogin WHERE seller_unique_id=?");
		$stmt->bind_param("s", $vendor_id);
		$stmt->execute();
		$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13);
		$return = array();

		//echo " get col data ";
		while ($stmt->fetch()) {
			$cname = $col1;
			$fname = $col2;
			$address_seller = $col3;
			$city = $col4;
			$pincode = $col5;
			$state = $col6;
			$country = $col7;
			$phone = $col8;
			$email = $col9;
			$logo = $col10;
			$tax = $col11;
			$pan_number = $col12;
			$cin_number = $col13;
		}

		$tax_value = ($prod_price * $qty) - $taxable_amount;
		$subtotal = $taxable_amount + $tax_value;

		// Specify the image file path
		$imagePath = BASEURL . 'assets_web/images/logo-appbar.png'; // Replace with the actual path to your image

		// Get the dimensions of the image
		/*list($imageWidth, $imageHeight) = getimagesize($imagePath);

		// Calculate the image dimensions and position to center it at the top
		$imageMaxWidth = $pdf->getPageWidth() - 185; // Adjust the margin as needed
		$imageMaxHeight = $pdf->getPageHeight() / 4; // You can adjust this value as needed
		$imageRatio = $imageWidth / $imageHeight;

		if ($imageWidth > $imageMaxWidth) {
			$imageWidth = $imageMaxWidth;
			$imageHeight = $imageWidth / $imageRatio;
		}

		$imageX = ($pdf->getPageWidth() - $imageWidth) / 2;
		$imageY = 10; // Adjust as needed to position it at the top

		// Add the image to the PDF
		$pdf->Image($imagePath, $imageX, $imageY, $imageWidth, $imageHeight, $imageType = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false);

		*/

		$html2 = '
		<html>
			<head></head>
			<body>
				<div style="text-align:center;">
					<h1 class="font-2" id="heading"><span style="color: rgb(4, 166, 157);  margin-top:0px;"></span><span style="color: #EB008B"></span></h1>
				</div>
				<div style="text-align: left;border-top:1px solid #000;"></div>
				<div style="text-align:center;">
					<b>Tax Invoice</b>
				</div>
				<table style="line-height: 1.5; margin-bottom:10px">
					<tr><td ><b style="font-size:10px;">Sold By: <span style="font-size:9px;">' . $cname . '</span></b> </td>
						<td style="text-align:right;"><b>Invoice Number:</b> #' . $invoice_number . '</td>
					</tr>
					<tr>
						<td colspan="2"><b style="font-size:10px;">Ship-from Address:</b> <span style="font-size:8px;">' . $address_seller . '</span></td>
					</tr>
					<tr>
						<td colspan="2" style="font-size:10px;"><b style="font-size:10px;">GSTIN: </b>' . $tax . '</td>
					</tr>				
				</table>
				<h1></h1>
				<div style="text-align: left;border-top:1px solid #000;"></div>
				<table style="line-height: 1.5;">
					<tr>
						<td width="35%"><b  style="font-size:9px;">Order ID:</b> <span style="font-size:8px;">' . $ordersno . ' </span></td>
						<td width="25%" style="text-align:left;font-size:9px;"><b>Bill To</b></td>
						<td width="25%" style="text-align:left;font-size:9px;"><b>Shipping To</b></td>
						<td width="15%"style="text-align:left;"></td>
					</tr>
					<tr>
						<td><b  style="font-size:9px;">Order Date:</b> <span style="font-size:8px;">' . $create_date . '</span></td>
						<td style="text-align:left;font-size:9px;"><b>' . $fullname . '</b></td>
						<td style="text-align:left;font-size:9px;"><b>' . $fullname . '</b></td>
						<td style="font-size:8px;text-align:left;" rowspan="5">*Keep this invoice and manufacturer box for warranty purposes.</td>
					</tr>
					<tr>
						<td><b  style="font-size:9px;">Invoice Date:</b> <span style="font-size:8px;"> ' . $create_date . '</span></td>
						<td style="text-align:left;"><span style="font-size:8px;">' . $address . '</span></td>
						<td style="text-align:left;"><span style="font-size:8px;">' . $address . '</span></td>
					</tr>
					<tr>
						<td><b  style="font-size:9px;">PAN:</b> <span style="font-size:8px;">' . $pan_number . '</span></td>
						<td style="text-align:left;"><b  style="font-size:9px;">Phone:</b> <span style="font-size:8px;"> ' . $mobile . '</span></td>
						<td style="text-align:left;"><b  style="font-size:9px;">Phone:</b> <span style="font-size:8px;"> ' . $mobile . '</span></td>
					</tr>
					<tr>
						<td><b  style="font-size:9px;">CIN:</b> <span style="font-size:8px;">' . $cin_number . '</span></td>
					</tr>
				</table>
				<div></div>
				<div style="border-bottom:1px solid #000;">
					<table style="line-height: 2; width:100%; font-size:10px;">
						<tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
							<td style="border:1px solid #cccccc;width:140px;">Item Description</td>
							<td style = "text-align:right;border:1px solid #cccccc;width:65px">Price (' . $currency . ')</td>
							<td style = "text-align:right;border:1px solid #cccccc;width:55px;">Discount</td>
							<td style = "text-align:right;border:1px solid #cccccc;width:35px;">Qty</td>
							<td style = "text-align:right;border:1px solid #cccccc;width:48px;">Gross Amount</td>
							<td style = "text-align:right;border:1px solid #cccccc;width:48px;">Taxable Amount</td>
							<td style = "text-align:right;border:1px solid #cccccc;width:38px;">GST</td>
							<td style = "text-align:right;border:1px solid #cccccc;width:66px;">Subtotal (' . $currency . ')</td>
						</tr>
						<tr>
							<td style="border:1px solid #cccccc;">' . $prod_name . '<br>' . $prod_attr1 . '</td>
							<td style = "text-align:right; border:1px solid #cccccc;">' . number_format($prod_price) . '</td>
							<td style = "text-align:right; border:1px solid #cccccc;">0</td>
							<td style = "text-align:right; border:1px solid #cccccc;">' . number_format($qty) . '</td>
							<td style = "text-align:right; border:1px solid #cccccc;">' . number_format(($prod_price * $qty)) . '</td>
							<td style = "text-align:right; border:1px solid #cccccc;">' . $taxable_amount . '</td>
							<td style = "text-align:right; border:1px solid #cccccc;">' . $igst . '</td>
							<td style = "text-align:right; border:1px solid #cccccc;">' . $subtotal . '</td>
						</tr>
						<tr style = "font-weight: bold;">
							<td colspan="2"></td>
							<td style = "text-align:right;" colspan="4">Shipping (' . $currency . ')</td>
							<td style = "text-align:right;" colspan="2">' . number_format($shipping) . '</td>
						</tr>
						<tr style = "font-weight: bold;">
							<td colspan="2"></td>
							<td style = "text-align:right;" colspan="4">Total (' . $currency . ')</td>
							<td style = "text-align:right;" colspan="2">' . number_format(($subtotal + $shipping)) . '</td>
						</tr>
						<tr><td colspan="10" style = "text-align:right;"><span style="font-size:10px;">' . $cname . '</span></td></tr>
						<tr><td></td></tr>
						<tr>
							<td style = "text-align:right;" colspan="10">Authorized Signatory</td>
						</tr>
					</table>
				</div>
				<p><i>Note: Please send a remittance advice by email to ' . $system_email . '</i></p>
			</body>
		</html>';




		$pdf->writeHTML($html2, true, false, true, false, '');
		// print_r($html2);
		// exit;
		$file_name = 'Invoice-' . $invoice_number . '.pdf';
		//Close and output PDF document
		if ($save_pdf) {
			$pdf_string = $pdf->Output($file_name, 'S');
			$file_path = '../media/invoice/' . $file_name;
			file_put_contents($file_path, $pdf_string);

			return $file_path;
		} else {
			$pdf_string = $pdf->Output($file_name, 'D');
		}
	}


	//function for pagination ajax
	function pagination($targetpage, $page, $limit, $total_pages)
	{
		$prev = $page - 1;
		$next = $page + 1;
		$lastpage = ceil($total_pages / $limit);
		$lpm1 = $lastpage - 1;
		$pagination = "";
		$adjacents = 3;

		if ($lastpage >= 1) {
			$pagination .= '<ul class="pagination pagination-sm m-0">';
			if ($page > 1)
				$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(" . $prev . ")'> <b>Previous</b></a></li>";
			else
				$pagination .= "<li><span class=\"disabled\" > <b>Previous</b></span></li>";

			if ($lastpage < 7 + ($adjacents * 2)) {
				for ($counter = 1; $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination .= "<li class='active'><span class=\"current\">$counter</span></li>";
					else
						$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(" . $counter . ")'>$counter</a></li>";
				}
			} elseif ($lastpage > 5 + ($adjacents * 2)) {

				if ($page < 1 + ($adjacents * 2)) {
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
						if ($counter == $page)
							$pagination .= "<li class='active'><span class=\"current\">$counter</span></li>";
						else
							$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(" . $counter . ")'>$counter</a></li>";
					}
					$pagination .= "<li><a>...</a></li>";
					$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(" . $lpm1 . ")'>$lpm1</a></li>";
					$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(" . $lastpage . ")'>$lastpage</a></li>";
				} elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(1)'>1</a></li>";
					$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(2)'>2</a></li>";
					$pagination .= "<li><a>...</a></li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						if ($counter == $page)
							$pagination .= "<li class='active'><span class=\"current\">$counter</span></li>";
						else
							$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(" . $counter . ")'>$counter</a></li>";
					}
					$pagination .= "<li><a>...</a></li>";
					$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(" . $lpm1 . ")'>$lpm1</a></li>";
					$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(" . $lastpage . ")'>$lastpage</a></li>";
				} else {
					$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "1)'>1</a></li>";
					$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(2)'>2</a></li>";
					$pagination .= "<li><a>...</a></li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
						if ($counter == $page)
							$pagination .= "<li class='active'><span class=\"current\">$counter</span></li>";
						else
							$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(" . $counter . ")'>$counter</a></li>";
					}
				}
			}

			if ($page < $counter - 1)
				$pagination .= "<li><a href='javascript:void(0)' onclick='" . $targetpage . "(" . $next . ")'><b>Next</b> </a></li>";
			else
				$pagination .= "<li><span class=\"disabled\"><b>Next</b> </span></li>";
			$pagination .= "</ul>\n";
		}
		return $pagination;
	}

	//function for pagination load
	function pagination2($targetpage, $page, $limit, $total_pages, $job_id, $string, $request)
	{
		$prev = $page - 1;
		$next = $page + 1;
		$lastpage = ceil($total_pages / $limit);
		$lpm1 = $lastpage - 1;
		$pagination = "";
		$adjacents = 3;
		if ($job_id && !$string) {
			$job_string = '&job_id=' . $job_id;
		} else if ($job_id && $string) {
			$job_string = '&job_id=' . $job_id . '&unsubscribe_email=' . $string;
		} else if ($string) {
			$job_string = '&unsubscribe_email=' . $string;
		} else if ($request) {
			$job_string = '&search_text=' . $request['search_text'] . '&status=' . $request['status'] . '&selected_user=' . $request['selected_user'];
		} else {
			$job_string = '';
		}
		$post_string = "per_page=" . $limit . $job_string;
		if ($lastpage >= 1) {
			$pagination .= '<ul class="pagination pagination-sm" style="margin-top:0px;">';
			if ($page > 1)
				$pagination .= "<li><a href=\"$targetpage?$post_string&page=$prev\"> <b>Previous</b></a></li>";
			else
				$pagination .= "<li class='active><span class=\"disabled\"> <b>Previous</b></span></li>";

			if ($lastpage < 7 + ($adjacents * 2)) {
				for ($counter = 1; $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination .= "<li class='active><span class=\"current\">$counter</span></li>";
					else
						$pagination .= "<li><a href=\"$targetpage?$post_string&page=$counter\">$counter</a></li>";
				}
			} elseif ($lastpage > 5 + ($adjacents * 2)) {

				if ($page < 1 + ($adjacents * 2)) {
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
						if ($counter == $page)
							$pagination .= "<li class='active><span class=\"current\">$counter</span></li>";
						else
							$pagination .= "<li><a href=\"$targetpage?$post_string&page=$counter\">$counter</a></li>";
					}
					$pagination .= "<li><a>...</a></li>";
					$pagination .= "<li><a href=\"$targetpage?$post_string&page=$lpm1\">$lpm1</a></li>";
					$pagination .= "<li><a href=\"$targetpage?$post_string&page=$lastpage\">$lastpage</a></li>";
				} elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					$pagination .= "<li><a href=\"$targetpage?$post_string&page=1\">1</a></li>";
					$pagination .= "<li><a href=\"$targetpage?$post_string&page=2\">2</a></li>";
					$pagination .= "<li><a>...</a></li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						if ($counter == $page)
							$pagination .= "<li class='active><span class=\"current\">$counter</span></li>";
						else
							$pagination .= "<li><a href=\"$targetpage?$post_string&page=$counter\">$counter</a></li>";
					}
					$pagination .= "<li><a>...</a></li>";
					$pagination .= "<li><a href=\"$targetpage?$post_string&page=$lpm1\">$lpm1</a></li>";
					$pagination .= "<li><a href=\"$targetpage?$post_string&page=$lastpage\">$lastpage</a></li>";
				} else {
					$pagination .= "<li><a href=\"$targetpage?$post_string&page=1\">1</a></li>";
					$pagination .= "<li><a href=\"$targetpage?$post_string&page=2\">2</a></li>";
					$pagination .= "<li><a>...</a></li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
						if ($counter == $page)
							$pagination .= "<li class='active><span class=\"current\">$counter</span></li>";
						else
							$pagination .= "<li><a href=\"$targetpage?$post_string&page=$counter\">$counter</a></li>";
					}
				}
			}

			if ($page < $counter - 1)
				$pagination .= "<li><a href=\"$targetpage?$post_string&page=$next\"><b>Next</b> </a></li>";
			else
				$pagination .= "<li class='active><span class=\"disabled\"><b>Next</b> </span></li>";
			$pagination .= "</ul>\n";
		}
		return $pagination;
	}
}
