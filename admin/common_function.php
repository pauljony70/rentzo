<?php

use \Gumlet\ImageResize;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

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
		$lowertext = str_replace('.', "", $lowertext);
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
		$lowertext = str_replace('.', "", $lowertext);
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
		if (!is_dir($folder_name)) {
			mkdir($folder_name);

			$content = "<!DOCTYPE html>
					<html>
					<head>
						<title>403 Forbidden</title>
					</head>
					<body>
					
					<p>Directory access is forbidden.</p>
					
					</body>
					</html>";
			$fp = fopen($folder_name . "/index.html", "wb");
			fwrite($fp, $content);
			fclose($fp);
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
					/* $path_info = pathinfo($_FILES[$file_name]["name"][$i]);

					$extension = $path_info['extension'];
					$filename = $this->makeimagepath($path_info['filename']);

					$intFile = mt_rand();
					$file_full_path1 = $media_dir . '/' . $filename . $intFile . '.' . $extension;
					//$file_full_path1 = $media_dir.'/'.$intFile.$this->makeimagepath($_FILES[$file_name]["name"][$i]);
					move_uploaded_file($_FILES[$file_name]["tmp_name"][$i], $file_full_path1);

					$thumb = array();
					foreach ($this->img_dimension_arr as $value) {
						$height = $value[0];
						$width = $value[1];
						$destination_file = $media_dir . '/' . $filename . $intFile . '-' . $height . '-' . $width . '.' . $extension;

						$image = new ImageResize($file_full_path1);
						$image->resizeToBestFit($height, $width);
						//$image->resize($height, $width);
						$image->save($destination_file);
						$thumb[$height . '-' . $width] = str_replace($media_path, '', $destination_file);
					}
					//unlink($file_full_path1);
					$file_full_path[] = $thumb; */
					$newFileName = uniqid();
					// $destinationDir = '../media';
					$targetFileName = 'converted_image.webp';
					$targetFilePath = $targetFilePath = $media_dir . '/' . $newFileName . '.webp';
					$sourceFileName = $_FILES[$file_name]['name'][$i];
					$sourceFilePath = $_FILES[$file_name]['tmp_name'][$i];
					$sourceFileType = $_FILES[$file_name]['type'][$i];

					$sourceImage = imagecreatefromstring(file_get_contents($sourceFilePath));


					// 	Convert the image to WebP format
					// imagewebp($sourceImage, $targetFilePath);

					// 	Free up memory
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
				/* $path_info = pathinfo($_FILES[$file_name]["name"]);

				$extension = $path_info['extension'];
				$filename = $this->makeimagepath($path_info['filename']);

				$intFile = mt_rand();
				$file_full_path1 = $media_dir . '/' . $filename . $intFile . '.' . $extension;
				//$file_full_path1 = $media_dir.'/'.$intFile.$this->makeimagepath($_FILES[$file_name]["name"]);
				move_uploaded_file($_FILES[$file_name]["tmp_name"], $file_full_path1);

				$thumb = array();
				foreach ($this->img_dimension_arr as $value) {
					$height = $value[0];
					$width = $value[1];
					$destination_file = $media_dir . '/' . $filename . $intFile . '-' . $height . '-' . $width . '.' . $extension;

					$image = new ImageResize($file_full_path1);
					$image->resizeToBestFit($height, $width);
					//$image->resize($height, $width);
					$image->save($destination_file);
					$thumb[$height . '-' . $width] = str_replace($media_path, '', $destination_file);
				}
				//unlink($file_full_path1);
				$file_full_path = $thumb; */

				/* Image Upload By Conevrting to webp */
				/* if (extension_loaded('gd')) {
					echo "GD extension is enabled";
				} else {
					echo "GD extension is not enabled";
				} */
				$newFileName = uniqid();
				// $destinationDir = '../media';
				$targetFileName = 'converted_image.webp';
				$targetFilePath = $targetFilePath = $media_dir . '/' . $newFileName . '.webp';
				$sourceFileName = $_FILES[$file_name]['name'];
				$sourceFilePath = $_FILES[$file_name]['tmp_name'];
				$sourceFileType = $_FILES[$file_name]['type'];

				$sourceImage = imagecreatefromstring(file_get_contents($sourceFilePath));


				// Convert the image to WebP format
				// imagewebp($sourceImage, $targetFilePath);

				// Free up memory
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
			//$file_full_path1 = $media_dir.'/'.$intFile.$this->makeimagepath($_FILES[$file_name]["name"]);
			move_uploaded_file($_FILES[$file_name]["tmp_name"], $file_full_path1);

			$destination_file = $media_dir . '/' . $filename . $intFile . '.' . $extension;

			$file_full_path = str_replace($media_path, '', $destination_file);
			$file_full_path_final = str_replace('"', '', $file_full_path);
		}
		return $file_full_path_final;
	}

	// function for remove file
	function remFile($file_path)
	{
		if (file_exists($file_path)) {
			unlink($file_path);
		}
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

			if ($img_decode) {
				foreach ($img_dimension_arr as $height_width) {
					if ($img_decode->{$height_width[0] . '-' . $height_width[1]} && file_exists($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]})) {
						unlink($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]});
					}
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

	//function for delete staff

	function delete_staff_user($user_id, $conn, $media_path, $img_dimension_arr)
	{
		$stmt = $conn->prepare("SELECT logo FROM admin_login WHERE seller_id=?");
		$stmt->bind_param("i", $user_id);
		$stmt->execute();

		$stmt->bind_result($brand_img);

		while ($stmt->fetch()) {
			$img_decode = json_decode($brand_img);

			if ($img_decode) {
				foreach ($img_dimension_arr as $height_width) {
					if ($img_decode->{$height_width[0] . '-' . $height_width[1]} && file_exists($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]})) {
						unlink($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]});
					}
				}
			}
		}
		$stmt2 = $conn->prepare("DELETE FROM admin_login WHERE seller_id = '" . $user_id . "'");
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
		$stmt = $conn->prepare("SELECT cat_img,web_banner,app_banner FROM category WHERE cat_id=?");
		$stmt->bind_param("i", $cat_id);
		$stmt->execute();

		$stmt->bind_result($cat_img, $web_banner, $app_banner);

		while ($stmt->fetch()) {
			$img_decode = json_decode($cat_img);
			$web_banner_decode = json_decode($web_banner);
			$app_banner_decode = json_decode($app_banner);

			if ($img_decode) {
				foreach ($img_dimension_arr as $height_width) {
					if ($img_decode->{$height_width[0] . '-' . $height_width[1]} && file_exists($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]})) {
						unlink($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]});
					}
				}
			}

			if ($web_banner_decode) {
				foreach ($img_dimension_arr as $height_width) {
					if ($web_banner_decode->{$height_width[0] . '-' . $height_width[1]} && file_exists($media_path . $web_banner_decode->{$height_width[0] . '-' . $height_width[1]})) {
						unlink($media_path . $web_banner_decode->{$height_width[0] . '-' . $height_width[1]});
					}
				}
			}
			if ($app_banner_decode) {
				foreach ($img_dimension_arr as $height_width) {
					if ($app_banner_decode->{$height_width[0] . '-' . $height_width[1]} && file_exists($media_path . $app_banner_decode->{$height_width[0] . '-' . $height_width[1]})) {
						unlink($media_path . $app_banner_decode->{$height_width[0] . '-' . $height_width[1]});
					}
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

		$stmt3 = $conn->prepare("DELETE FROM attribute_set_product_info WHERE attribute_set_id = '" . $cat_id . "'");
		$stmt3->execute();

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

	function delete_product_info_attribute($cat_id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM product_info_set WHERE id = '" . $cat_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}

	function delete_hsncode($id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM product_hsn_code WHERE id = '" . $id . "'");
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

	function delete_product_info_val($cat_id, $conn)
	{
		$stmt2 = $conn->prepare("DELETE FROM product_info_set_val WHERE id = '" . $cat_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}

	//function for delete product

	function delete_products($product_id, $conn, $img_dimension_arr)
	{



		$stmt = $conn->prepare("SELECT prod_img_url,featured_img FROM product_details WHERE product_unique_id=?");
		$stmt->bind_param("s", $product_id);
		$stmt->execute();

		$stmt->bind_result($prod_img_url, $featured_img);

		while ($stmt->fetch()) {
			$img_decode = json_decode($prod_img_url);
			$feat_img_decode = json_decode($featured_img);
			if (is_array($img_decode)) {
				foreach ($img_decode as $img_path) {
					foreach ($img_dimension_arr as $height_width) {
						if ($img_path->{$height_width[0] . '-' . $height_width[1]} && file_exists($media_path . $img_path->{$height_width[0] . '-' . $height_width[1]})) {
							unlink($media_path . $img_path->{$height_width[0] . '-' . $height_width[1]});
						}
					}
				}
			}
			foreach ($img_dimension_arr as $height_width) {
				if ($feat_img_decode->{$height_width[0] . '-' . $height_width[1]} && file_exists($media_path . $feat_img_decode->{$height_width[0] . '-' . $height_width[1]})) {
					unlink($media_path . $feat_img_decode->{$height_width[0] . '-' . $height_width[1]});
				}
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

		echo "Deleted";
	}

	//function for reject reason

	function select_reject_reason($conn, $id, $type = "")
	{

		if ($type == 'product') {
			$reason = '<div class="">';
		} else {
			$reason = '<div class="col-sm-8 p-0">';
		}

		$reason .= 	'<select class="form-control" id="rejectreason' . $id . '" name="rejectreason">
                    <option value="">Select Reject Reason</option>';

		$stmt2 = $conn->prepare("SELECT sno, reason FROM seller_flag_reason ");

		$stmt2->execute();
		$data2 = $stmt2->bind_result($col41, $col42);

		while ($stmt2->fetch()) {
			$reason .= '<option value="' . $col42 . '">' . $col42 . '</option>';
		}

		$reason .= ' </select> </div>';

		return $reason;
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

	//function for add notification to seller

	function notify_seller($conn, $seller_id, $message)
	{

		$stmt11 = $conn->prepare("INSERT INTO seller_notification (seller_id,message) VALUES(?,?)");
		$stmt11->bind_param("ss", $seller_id, $message);
		$stmt11->execute();
		$rows = $stmt11->affected_rows;

		$query = $conn->query("SELECT fullname,email FROM `sellerlogin` WHERE seller_unique_id ='" . $seller_id . "'");
		if ($query->num_rows > 0) {
			$rows = $query->fetch_assoc();

			$sellername = $rows['fullname'];
			$seller_email = $rows['email'];
			$this->send_email_seller_new($conn, $sellername, "Admin Action", $message, $seller_email);
		}
	}

	//function for delete attribute set

	function delete_product_reject_reason($cat_id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM seller_flag_reason WHERE sno = '" . $cat_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
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
		return $currency . '' . number_format($price);
	}

	//function for delete banners

	function delete_home_banners($banners_id, $conn, $media_path, $img_dimension_arr)
	{
		$stmt = $conn->prepare("SELECT img_url FROM banners WHERE id=?");
		$stmt->bind_param("i", $banners_id);
		$stmt->execute();

		$stmt->bind_result($img_url);

		while ($stmt->fetch()) {
			$img_decode = json_decode($img_url);

			if ($img_decode) {
				foreach ($img_dimension_arr as $height_width) {
					unlink($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]});
				}
			}
		}

		$stmt2 = $conn->prepare("DELETE FROM banners WHERE id = '" . $banners_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}


	function file_upload_app($file_name, $media_path)
	{
		include_once('libraries/php-image-resize-master/lib/ImageResize.php');
		$img_dimension_arr = array(array(72, 72), array(200, 200), array(280, 310), array(400, 200), array(430, 590), array(600, 810));

		$media_dir = $this->create_media_folder($media_path);
		$file_full_path = '';
		if (is_array($_FILES[$file_name]["name"])) {
			$count = count($_FILES[$file_name]["name"]);
			$file_full_path = array();
			for ($i = 0; $i < $count; $i++) {
				$path_info = '';
				if ($_FILES[$file_name]["name"][$i] != "") {
					/* $path_info = pathinfo($_FILES[$file_name]["name"][$i]);

					$extension = $path_info['extension'];
					$filename = $this->makeimagepath($path_info['filename']);

					$intFile = mt_rand();
					$file_full_path1 = $media_dir . '/' . $filename . $intFile . '.' . $extension;
					//$file_full_path1 = $media_dir.'/'.$intFile.$this->makeimagepath($_FILES[$file_name]["name"][$i]);
					move_uploaded_file($_FILES[$file_name]["tmp_name"][$i], $file_full_path1);

					$thumb = array();
					foreach ($img_dimension_arr as $value) {
						$height = $value[0];
						$width = $value[1];
						$destination_file = $media_dir . '/' . $filename . $intFile . '-' . $height . '-' . $width . '.' . $extension;

						$image = new ImageResize($file_full_path1);
						$image->resizeToBestFit($height, $width);
						$image->save($destination_file);
						$thumb[$height . '-' . $width] = str_replace($media_path, '', $destination_file);
					}
					//unlink($file_full_path1);
					$file_full_path[] = $thumb; */
					$newFileName = uniqid();
					// $destinationDir = '../media';
					$targetFileName = 'converted_image.webp';
					$targetFilePath = $targetFilePath = $media_dir . '/' . $newFileName . '.webp';
					$sourceFileName = $_FILES[$file_name]['name'][$i];
					$sourceFilePath = $_FILES[$file_name]['tmp_name'][$i];
					$sourceFileType = $_FILES[$file_name]['type'][$i];

					$sourceImage = imagecreatefromstring(file_get_contents($sourceFilePath));


					// 	// Convert the image to WebP format
					imagewebp($sourceImage, $targetFilePath);

					// 	// Free up memory
					imagedestroy($sourceImage);

					$thumb = array();
					foreach ($img_dimension_arr as $value) {
						$height = $value[0];
						$width = $value[1];
						$thumb[$height . '-' . $width] = str_replace($media_path, '', $targetFilePath);
					}
					$file_full_path[] = $thumb;
				}
			}
		} else {
			if ($_FILES[$file_name]["name"] != "") {
				/* $path_info = pathinfo($_FILES[$file_name]["name"]);

				$extension = $path_info['extension'];
				$filename = $this->makeimagepath($path_info['filename']);

				$intFile = mt_rand();
				$file_full_path1 = $media_dir . '/' . $filename . $intFile . '.' . $extension;
				//$file_full_path1 = $media_dir.'/'.$intFile.$this->makeimagepath($_FILES[$file_name]["name"]);
				move_uploaded_file($_FILES[$file_name]["tmp_name"], $file_full_path1);

				$thumb = array();
				foreach ($img_dimension_arr as $value) {
					$height = $value[0];
					$width = $value[1];
					$destination_file = $media_dir . '/' . $filename . $intFile . '-' . $height . '-' . $width . '.' . $extension;

					$image = new ImageResize($file_full_path1);
					$image->resizeToBestFit($height, $width);
					$image->save($destination_file);
					$thumb[$height . '-' . $width] = str_replace($media_path, '', $destination_file);
				}
				//unlink($file_full_path1);
				$file_full_path = $thumb; */

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
				imagewebp($sourceImage, $targetFilePath);

				// 	// Free up memory
				imagedestroy($sourceImage);

				$thumb = array();
				foreach ($img_dimension_arr as $value) {
					$height = $value[0];
					$width = $value[1];
					$thumb[$height . '-' . $width] = str_replace($media_path, '', $targetFilePath);
				}
				$file_full_path = $thumb;
			}
		}

		return $file_full_path;
	}

	//function for delete banners

	function delete_custom_home_banners($banners_id, $conn, $media_path, $img_dimension_arr)
	{
		$stmt = $conn->prepare("SELECT img_url FROM home_custom_banner WHERE id=?");
		$stmt->bind_param("i", $banners_id);
		$stmt->execute();

		$stmt->bind_result($img_url);

		while ($stmt->fetch()) {
			$img_decode = json_decode($img_url);

			if ($img_decode) {
				foreach ($img_dimension_arr as $height_width) {
					unlink($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]});
				}
			}
		}

		$stmt2 = $conn->prepare("DELETE FROM home_custom_banner WHERE id = '" . $banners_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}

	//function for delete banners

	function delete_home_banners_custom($banners_id, $conn, $media_path, $img_dimension_arr)
	{
		$stmt = $conn->prepare("SELECT img_url FROM home_custom_banner WHERE banner_for=?");
		$stmt->bind_param("i", $banners_id);
		$stmt->execute();

		$stmt->bind_result($img_url);

		while ($stmt->fetch()) {
			$img_decode = json_decode($img_url);

			if ($img_decode) {
				foreach ($img_dimension_arr as $height_width) {
					unlink($media_path . $img_decode->{$height_width[0] . '-' . $height_width[1]});
				}
			}
		}
		$stmt3 = $conn->prepare("DELETE FROM home_custom_banner WHERE banner_for = '" . $banners_id . "'");
		$stmt3->execute();

		$stmt2 = $conn->prepare("DELETE FROM homepage_banners WHERE id = '" . $banners_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}

	//function for delete popular product

	function delete_popular_product($deletearray, $conn, $table)
	{
		$stmt = $conn->prepare("SELECT id FROM " . $table . " WHERE id=?");
		$stmt->bind_param("s", $deletearray);
		$stmt->execute();

		$stmt->bind_result($img_url);

		$exist = '';
		while ($stmt->fetch()) {
			$exist = 'yes';
		}
		if ($exist == 'yes') {
			$stmt2 = $conn->prepare("DELETE FROM " . $table . " WHERE id = '" . $deletearray . "'");
			$stmt2->execute();

			$rows = $stmt2->affected_rows;

			if ($rows > 0) {
				echo "Deleted";
			} else {
				echo "Failed to Delete.";
			}
		} else {
			echo "Failed to Delete.";
		}
	}

	//send email for seller

	function send_email_seller_regs($conn, $to_email, $sellername, $phone, $checksum, $base_url)
	{

		$link = $base_url . "vendor/change_password.php?checksum=" . $checksum;
		$message  = "<html><body>";

		$message .= "<table width='500px;' align='center' border='1' cellpadding='0' cellspacing='0' style='font-family: sans-serif;background: rgba(220, 220, 220, 0.17);font-size: 14px;'>";

		$message .= "<tbody>
						<tr>
							<td colspan='2'>Dear " . $sellername . ", Your Registration is successfuly.</td>
							
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Name</td>
							<td style='padding: 10px;'>" . $sellername . " </td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Email</td>
							<td style='padding: 10px;'>" . $to_email . "</td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Phone</td>
							<td style='padding: 10px;'>" . $phone . "</td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;' colspan='2'>Please <a href='" . $link . "'>click here</a> to change your password.</td>
						</tr>
						
					</tbody>";

		$message .= "</table>";
		$message .= "</body></html>";

		$this->smtp_email($conn, $to_email, $subject, $message);


		//send to admin

		$messageadmin  = "<html><body>";

		$messageadmin .= "<table width='500px;' align='center' border='1' cellpadding='0' cellspacing='0' style='font-family: sans-serif;background: rgba(220, 220, 220, 0.17);font-size: 14px;'>";

		$messageadmin .= "<tbody>
						<tr>
							<td colspan='2'>New Seller Details:</td>
							
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Name</td>
							<td style='padding: 10px;'>" . $sellername . " </td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Email</td>
							<td style='padding: 10px;'>" . $to_email . "</td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Phone</td>
							<td style='padding: 10px;'>" . $phone . "</td>
						</tr>
       
						
					</tbody>";

		$messageadmin .= "</table>";

		$messageadmin .= "</body></html>";

		$admin_email = $this->get_system_settings($conn, 'system_email');
		$this->smtp_email($conn, $admin_email, 'Seller Registration', $messageadmin);
	}
	
	
	function send_ticket_replay_email($conn,$ticket_id,$title,$desc,$email)
	{

		$link = BASEURL . "ticket/" . $ticket_id;
		$system_name = $this->get_system_settings($conn, 'system_name');
		
		$messageadmin  = "<html><body>";

		$messageadmin .= "<table width='500px;' align='center' border='1' cellpadding='0' cellspacing='0' style='font-family: sans-serif;background: rgba(220, 220, 220, 0.17);font-size: 14px;'>";

		$messageadmin .= "<tbody>
						<tr>
							<td colspan='2'>User Inquiry Replay From ".$system_name."</td>
							
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Title</td>
							<td style='padding: 10px;'>" . $title . " </td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;'>Description</td>
							<td style='padding: 10px;'>" . $desc . "</td>
						</tr>
						<tr>
							<td style='padding: 10px;font-weight: 600;' colspan='2'>Please <a href='" . $link . "'>click here</a> to Your Replays.</td>
						</tr>
       
						
					</tbody>";

		$messageadmin .= "</table>";

		$messageadmin .= "</body></html>";

		$this->smtp_email($conn, $email, 'User Inquiry Replay From'.$system_name, $messageadmin);
	}


	function default_send_email($conn, $to_email, $name, $subject, $body)
	{
		$system_name = $this->get_system_settings($conn, 'system_name');

		$message =
			'<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
				<div style="margin:50px auto;width:70%;padding:20px 0; margin-top: 0px;">
					<div style="border-bottom:1px solid #eee">
						<a href="' . BASEURL . '" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600"><img src="' . BASEURL . 'assets_web/images/logo-appbar.png' . '" alt="logo" width="70">
					</div>
					<p style="font-size:1.1em">Hi ' . $name . ',</p>
			 		<div>' . html_entity_decode($body) . '</div>
					<p style="font-size:0.9em; margin-bottom: 0px">Regards,<br />' . $system_name . '</p>
					<a style="font-size:0.9em;" href="' . BASEURL . '">' . BASEURL . '</a><br>
					<img style="margin-top: 5px;" src="' . BASEURL . 'assets_web/images/logo-appbar.png' . '" alt="logo" width="70">
					<hr style="border:none;border-top:1px solid #eee" />
					<div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
						<p>' . $system_name . ' Inc</p>
					</div>
				</div>
			</div>';

		// Set email headers
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$this->smtp_email($conn, $to_email, $subject, $message);
	}

	//send email for seller

	function send_email_forgot_password($conn, $to_email, $sellername, $checksum, $base_url, $subject)
	{

		$link = $base_url . "admin/change_password.php?checksum=" . $checksum;
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


	//send email for seller

	function send_email_seller_new($conn, $sellername, $subject, $msg, $seller_email)
	{

		//send to admin


		$messageadmin  = "<html><body>";

		$messageadmin .= "<table width='500px;' align='center' border='1' cellpadding='0' cellspacing='0' style='font-family: sans-serif;background: rgba(220, 220, 220, 0.17);font-size: 14px;'>";

		$messageadmin .= "<tbody>
						<tr>
							<td colspan='2'>Hi " . $sellername . "</td>
							
						</tr>
						<tr>
							<td style='padding: 10px;' colspan='2'>" . $msg . " </td>
							
						</tr>	
       
					</tbody>";

		$messageadmin .= "</table>";

		$messageadmin .= "</body></html>";

		$this->smtp_email($conn, $seller_email, $subject, $messageadmin);
	}


	// send email 
	function smtp_email($conn, $to_email, $subject, $message)
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

		// Try to send the email
		if ($mail->send()) {
			// echo 'SMTP connection successful!';
		} else {
			// echo 'SMTP connection failed. Error: ' . $mail->ErrorInfo;
		}
	}


	function price_format($price, $conn)
	{
		$new_price = 0;
		$currency = $this->get_system_settings($conn, 'system_currency_symbol');
		if ($price > 0) {
			$new_price = $currency.' ' .number_format($price, 2) ;
		}
		return $new_price;
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


	//function for delete banners

	function delete_home_category($banners_id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM home_category WHERE id = '" . $banners_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}

	//function for delete banners

	function delete_roles($role_id, $conn)
	{

		$stmt2 = $conn->prepare("DELETE FROM user_roles WHERE id = '" . $role_id . "'");
		$stmt2->execute();

		$rows = $stmt2->affected_rows;

		if ($rows > 0) {
			echo "Deleted";
		} else {
			echo "Failed to Delete.";
		}
	}

	//function for check module premission 

	function user_module_premission($user_data, $module)
	{
		$access = false;
		if ($user_data['premission_role'] == 'admin') {
			$access = true;
		} else {
			$premssion = explode(',', $user_data['premission_role']);
			if (in_array($module, $premssion)) {
				$access = true;
			} else {
				$access = false;
			}
		}
		return $access;
	}

	//function for timezone list

	function get_timezone_list()
	{
		return array(
			'(UTC-11:00) Midway Island' => 'Pacific/Midway',
			'(UTC-11:00) Samoa' => 'Pacific/Samoa',
			'(UTC-10:00) Hawaii' => 'Pacific/Honolulu',
			'(UTC-09:00) Alaska' => 'US/Alaska',
			'(UTC-08:00) Pacific Time (US &amp; Canada)' => 'America/Los_Angeles',
			'(UTC-08:00) Tijuana' => 'America/Tijuana',
			'(UTC-07:00) Arizona' => 'US/Arizona',
			'(UTC-07:00) Chihuahua' => 'America/Chihuahua',
			'(UTC-07:00) Mazatlan' => 'America/Mazatlan',
			'(UTC-07:00) Mountain Time (US &amp; Canada)' => 'US/Mountain',
			'(UTC-06:00) Central America' => 'America/Managua',
			'(UTC-06:00) Central Time (US &amp; Canada)' => 'US/Central',
			'(UTC-06:00) Mexico City' => 'America/Mexico_City',
			'(UTC-06:00) Monterrey' => 'America/Monterrey',
			'(UTC-06:00) Saskatchewan' => 'Canada/Saskatchewan',
			'(UTC-05:00) Bogota' => 'America/Bogota',
			'(UTC-05:00) Eastern Time (US &amp; Canada)' => 'US/Eastern',
			'(UTC-05:00) Indiana (East)' => 'US/East-Indiana',
			'(UTC-05:00) Lima' => 'America/Lima',
			'(UTC-05:00) Quito' => 'America/Bogota',
			'(UTC-04:00) Atlantic Time (Canada)' => 'Canada/Atlantic',
			'(UTC-04:30) Caracas' => 'America/Caracas',
			'(UTC-04:00) La Paz' => 'America/La_Paz',
			'(UTC-04:00) Santiago' => 'America/Santiago',
			'(UTC-03:30) Newfoundland' => 'Canada/Newfoundland',
			'(UTC-03:00) Brasilia' => 'America/Sao_Paulo',
			'(UTC-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
			'(UTC-03:00) Greenland' => 'America/Godthab',
			'(UTC-02:00) Mid-Atlantic' => 'America/Noronha',
			'(UTC-01:00) Azores' => 'Atlantic/Azores',
			'(UTC-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
			'(UTC+00:00) Casablanca' => 'Africa/Casablanca',
			'(UTC+00:00) Edinburgh' => 'Europe/London',
			'(UTC+00:00) Greenwich Mean Time : Dublin' => 'Etc/Greenwich',
			'(UTC+00:00) Lisbon' => 'Europe/Lisbon',
			'(UTC+00:00) London' => 'Europe/London',
			'(UTC+00:00) Monrovia' => 'Africa/Monrovia',
			'(UTC+00:00) UTC' => 'UTC',
			'(UTC+01:00) Amsterdam' => 'Europe/Amsterdam',
			'(UTC+01:00) Belgrade' => 'Europe/Belgrade',
			'(UTC+01:00) Berlin' => 'Europe/Berlin',
			'(UTC+01:00) Bratislava' => 'Europe/Bratislava',
			'(UTC+01:00) Brussels' => 'Europe/Brussels',
			'(UTC+01:00) Budapest' => 'Europe/Budapest',
			'(UTC+01:00) Copenhagen' => 'Europe/Copenhagen',
			'(UTC+01:00) Ljubljana' => 'Europe/Ljubljana',
			'(UTC+01:00) Madrid' => 'Europe/Madrid',
			'(UTC+01:00) Paris' => 'Europe/Paris',
			'(UTC+01:00) Prague' => 'Europe/Prague',
			'(UTC+01:00) Rome' => 'Europe/Rome',
			'(UTC+01:00) Sarajevo' => 'Europe/Sarajevo',
			'(UTC+01:00) Skopje' => 'Europe/Skopje',
			'(UTC+01:00) Stockholm' => 'Europe/Stockholm',
			'(UTC+01:00) Vienna' => 'Europe/Vienna',
			'(UTC+01:00) Warsaw' => 'Europe/Warsaw',
			'(UTC+01:00) West Central Africa' => 'Africa/Lagos',
			'(UTC+01:00) Zagreb' => 'Europe/Zagreb',
			'(UTC+02:00) Athens' => 'Europe/Athens',
			'(UTC+02:00) Bucharest' => 'Europe/Bucharest',
			'(UTC+02:00) Cairo' => 'Africa/Cairo',
			'(UTC+02:00) Harare' => 'Africa/Harare',
			'(UTC+02:00) Helsinki' => 'Europe/Helsinki',
			'(UTC+02:00) Istanbul' => 'Europe/Istanbul',
			'(UTC+02:00) Jerusalem' => 'Asia/Jerusalem',
			'(UTC+02:00) Pretoria' => 'Africa/Johannesburg',
			'(UTC+02:00) Riga' => 'Europe/Riga',
			'(UTC+02:00) Sofia' => 'Europe/Sofia',
			'(UTC+02:00) Tallinn' => 'Europe/Tallinn',
			'(UTC+02:00) Vilnius' => 'Europe/Vilnius',
			'(UTC+03:00) Baghdad' => 'Asia/Baghdad',
			'(UTC+03:00) Kuwait' => 'Asia/Kuwait',
			'(UTC+03:00) Minsk' => 'Europe/Minsk',
			'(UTC+03:00) Nairobi' => 'Africa/Nairobi',
			'(UTC+03:00) Riyadh' => 'Asia/Riyadh',
			'(UTC+03:00) Volgograd' => 'Europe/Volgograd',
			'(UTC+03:30) Tehran' => 'Asia/Tehran',
			'(UTC+04:00) Abu Dhabi' => 'Asia/Muscat',
			'(UTC+04:00) Baku' => 'Asia/Baku',
			'(UTC+04:00) Moscow' => 'Europe/Moscow',
			'(UTC+04:00) Tbilisi' => 'Asia/Tbilisi',
			'(UTC+04:00) Yerevan' => 'Asia/Yerevan',
			'(UTC+04:30) Kabul' => 'Asia/Kabul',
			'(UTC+05:00) Karachi' => 'Asia/Karachi',
			'(UTC+05:00) Tashkent' => 'Asia/Tashkent',
			'(UTC+05:30) Kolkata' => 'Asia/Kolkata',
			'(UTC+05:45) Kathmandu' => 'Asia/Katmandu',
			'(UTC+06:00) Almaty' => 'Asia/Almaty',
			'(UTC+06:00) Dhaka' => 'Asia/Dhaka',
			'(UTC+06:00) Ekaterinburg' => 'Asia/Yekaterinburg',
			'(UTC+06:30) Rangoon' => 'Asia/Rangoon',
			'(UTC+07:00) Bangkok' => 'Asia/Bangkok',
			'(UTC+07:00) Jakarta' => 'Asia/Jakarta',
			'(UTC+07:00) Novosibirsk' => 'Asia/Novosibirsk',
			'(UTC+08:00) Chongqing' => 'Asia/Chongqing',
			'(UTC+08:00) Hong Kong' => 'Asia/Hong_Kong',
			'(UTC+08:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
			'(UTC+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',
			'(UTC+08:00) Perth' => 'Australia/Perth',
			'(UTC+08:00) Singapore' => 'Asia/Singapore',
			'(UTC+08:00) Taipei' => 'Asia/Taipei',
			'(UTC+08:00) Ulaan Bataar' => 'Asia/Ulan_Bator',
			'(UTC+08:00) Urumqi' => 'Asia/Urumqi',
			'(UTC+09:00) Irkutsk' => 'Asia/Irkutsk',
			'(UTC+09:00) Seoul' => 'Asia/Seoul',
			'(UTC+09:00) Tokyo' => 'Asia/Tokyo',
			'(UTC+09:30) Adelaide' => 'Australia/Adelaide',
			'(UTC+09:30) Darwin' => 'Australia/Darwin',
			'(UTC+10:00) Brisbane' => 'Australia/Brisbane',
			'(UTC+10:00) Canberra' => 'Australia/Canberra',
			'(UTC+10:00) Guam' => 'Pacific/Guam',
			'(UTC+10:00) Hobart' => 'Australia/Hobart',
			'(UTC+10:00) Melbourne' => 'Australia/Melbourne',
			'(UTC+10:00) Port Moresby' => 'Pacific/Port_Moresby',
			'(UTC+10:00) Sydney' => 'Australia/Sydney',
			'(UTC+10:00) Yakutsk' => 'Asia/Yakutsk',
			'(UTC+11:00) Vladivostok' => 'Asia/Vladivostok',
			'(UTC+12:00) Auckland' => 'Pacific/Auckland',
			'(UTC+12:00) Fiji' => 'Pacific/Fiji',
			'(UTC+12:00) International Date Line West' => 'Pacific/Kwajalein',
			'(UTC+12:00) Kamchatka' => 'Asia/Kamchatka',
			'(UTC+12:00) Magadan' => 'Asia/Magadan',
			'(UTC+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
		);
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

		$address = $fulladdress . ', ' . $city . ', ' . $state . ', ' . $country_name;
		
		


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
		$pdf->Image($imagePath, $imageX, $imageY, $imageWidth, $imageHeight, $imageType = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false);*/

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
			$pagination .= '<ul class="pagination pagination-sm" style="margin-top:0px;">';
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
