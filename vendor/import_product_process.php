<?php
include('session.php');

$code = $_POST['code'];
$code= stripslashes($code);  
$datetime = date('Y-m-d');
$default_charset = 'UTF-8';
$msg =  '';
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else{
	if($code==$_SESSION['_token']){
		$table_name = 'import_product_'.strtolower($_SESSION['admin']);
		$Common_Function->create_table($conn,$table_name);
		
		$table_name2 = 'import_product2_'.strtolower($_SESSION['admin']);
	
		$Common_Function->create_table($conn,$table_name2);
		
		$mand_headers = array('name_arabic','name','sku','url_key','attribute_set','product_type','categories','short_description','arabic_short_description','description','arabic_description','mrp','price','tax_class','qty','stock_status','visibility','country_of_manufacture','hsn_code','product_purchase_limit','brand','return_policy','configurable_variations','remarks','youtube_video_link','related_skus','upsell_skus');
		
		// Allowed mime types
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
		// Validate whether selected file is a CSV file
		if(!empty($_FILES['product_file']['name']) && in_array($_FILES['product_file']['type'], $csvMimes)){
			
			// If the file is uploaded
			if(is_uploaded_file($_FILES['product_file']['tmp_name'])){
				
				// Open uploaded CSV file with read-only mode
				$csvFile = fopen($_FILES['product_file']['tmp_name'], 'r');
				
				// Skip the first line
				$header =  fgetcsv($csvFile);
				$header_diff = array_diff($mand_headers,$header);
				if(count($header_diff) >0 ){
					$msg = "CSV header not valid.";
				}
				
				
				// Parse data from CSV file line by line
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$array_comb = array_combine($header,$line);		
					$status = 0;
					$fail_reason = '';
					/*if(!$array_comb['name_arabic']){
						$status = 2;
						$fail_reason .= 'Product Arabic Name shoud not blank.\n';
					}*/
					if(!$array_comb['name']){
						$status = 2;
						$fail_reason .= 'Product Name shoud not blank.\n';
					}
					
					
					if(!$array_comb['sku']){
						$status = 2;
						$fail_reason .= 'Product SKU shoud not blank.\n';
					}
					
					if(!$array_comb['url_key']){
						$status = 2;
						$fail_reason .= 'Product URL Key shoud not blank.\n';
					}
					
				
					if(!$array_comb['attribute_set']){
						$status = 2;
						$fail_reason .= 'Product Attribute Set shoud not blank.\n';
					}
					
					/*if($array_comb['product_type'] !='simple' && $array_comb['product_type'] !='configurable'){
						$status = 2;
						$fail_reason .= 'Product Type not found.\n';
					}else if (!$array_comb['product_type']){
						$status = 2;
						$fail_reason .= 'Product Type shoud not blank.\n';
					}*/
					
					if(!$array_comb['categories']){
						$status = 2;
						$fail_reason .= 'Product Categories shoud not blank.\n';
					}
					
					if(!$array_comb['short_description']){
						$status = 2;
						$fail_reason .= 'Product short description shoud not blank.\n';
					}
					/*if(!$array_comb['arabic_short_description']){
						$status = 2;
						$fail_reason .= 'Product Arabic short description shoud not blank.\n';
					}*/
					
					if(!$array_comb['description']){
						$status = 2;
						$fail_reason .= 'Product description shoud not blank.\n';
					}
					
					/*if(!$array_comb['arabic_description']){
						$status = 2;
						$fail_reason .= 'Product Arabic description shoud not blank.\n';
					}*/
					
					if(!is_numeric($array_comb['mrp'])){
						$status = 2;
						$fail_reason .= 'Product mrp shoud be Numeric.\n';
					}
										
					if(!is_numeric($array_comb['price'])){
						$status = 2;
						$fail_reason .= 'Product price shoud be Numeric.\n';
					}
					
					if($array_comb['qty'] && !is_numeric($array_comb['qty'])){
						$status = 2;
						$fail_reason .= 'Product quantity shoud be Numeric.\n';
					}
					
					
					if(!$array_comb['brand']){
						$status = 2;
						$fail_reason .= 'Product brand shoud not blank.\n';
					}
					
					if($array_comb['product_type'] == 'configurable'){
						$configurable_variations = $array_comb['configurable_variations'];
						if(!$configurable_variations){
							$status = 2;
							$fail_reason .= 'Product configurable variations should not blank.\n';
						}
					}
					
					$stmt11 = $conn->prepare("INSERT INTO `".$table_name."`(`status`,`fail_reason`,`name_arabic`,`name`, `sku`, `url_key`, `attribute_set`, `product_type`, `categories`, `short_description`,  `arabic_short_description`, 
						`description`,`arabic_description`, `mrp`, `price`, `tax_class`, `qty`, `stock_status`, `visibility`, `country_of_manufacture`, `hsn_code`, `product_purchase_limit`, 
						`brand`, `return_policy`, `configurable_variations`, `remarks`, `youtube_video_link`, `related_skus`, `upsell_skus`)
							VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				
					$stmt11->bind_param( "sssssssssssssssssssssssssssss",$status,$fail_reason,convertCharacterEncoding($array_comb['name_arabic'],$default_charset,$default_charset),$array_comb['name'],$array_comb['sku'],$array_comb['url_key'],$array_comb['attribute_set'],$array_comb['product_type'],$array_comb['categories'],
									$array_comb['short_description'],$array_comb['arabic_short_description'],$array_comb['description'],$array_comb['arabic_description'],$array_comb['mrp'],$array_comb['price'],$array_comb['tax_class'],$array_comb['qty'],
									$array_comb['stock_status'],$array_comb['visibility'],$array_comb['country_of_manufacture'],$array_comb['hsn_code'],$array_comb['product_purchase_limit'],$array_comb['brand'],
									$array_comb['return_policy'],$array_comb['configurable_variations'],$array_comb['remarks'],$array_comb['youtube_video_link'],$array_comb['related_skus'],$array_comb['upsell_skus']);
		
					$stmt11->execute();
					$stmt11->store_result();
				
					$rows = $stmt11->affected_rows;
					// code for add product main - START
					if($rows>0){
					}
				}
				echo '<script>location.href="validate_product_process.php";</script>';
				
				// Close opened CSV file
				fclose($csvFile);
				
				$qstring = '?status=succ';
			}else{
				$qstring = '?status=err';
			}
		}else{
			$qstring = '?status=invalid_file';
		}
		
	}else{
		$msg = "Invalid Parameters. Please fill all required fields.";
	}
}

	echo '<script>alert("'.$msg.'"); location.href="manage_product.php";</script>';
    die;
     function convertCharacterEncoding($value, $fromCharset, $toCharset) {
		if (function_exists("mb_convert_encoding")) {
			$value = mb_convert_encoding($value, $toCharset, $fromCharset);
		} else {
			$value = iconv($toCharset, $fromCharset, $value);
		}
		return $value;
	}
?>
