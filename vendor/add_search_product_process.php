<?php
include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

 include("header.php");


$encruptfun = new encryptfun();

$code = $_POST['code'];
$code= stripslashes($code);  
$datetime = date('Y-m-d');

 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else{
	if($code==$_SESSION['_token']){	
		
		$prod_mrp = trim(strip_tags($_POST['prod_mrp']));
		$prod_price = trim(strip_tags($_POST['prod_price']));
		$selecttaxclass = trim(strip_tags($_POST['selecttaxclass']));
		$prod_qty = trim(strip_tags($_POST['prod_qty']));
		$selectstock = trim(strip_tags($_POST['selectstock']));
		$prod_purchase_lmt = trim(strip_tags($_POST['prod_purchase_lmt']));
		$prod_remark = trim(strip_tags($_POST['prod_remark'])); 
		
		$product_id = trim(strip_tags($_POST['product_id']));
		
		$selectrelatedprod = '';
		if(array_key_exists('selectrelatedprod',$_POST)){
			$selectrelatedprod = implode(',',$_POST['selectrelatedprod']);
		}
		$selectupsell = '';
		if(array_key_exists('selectupsell',$_POST)){
			$selectupsell = implode(',',$_POST['selectupsell']);
		}		
		
		$enableproduct	=  1;
		
		$prod_mrp		=   addslashes($prod_mrp);
		$prod_price		=   addslashes($prod_price);
		$selecttaxclass		=   addslashes($selecttaxclass);
		$prod_qty		=   addslashes($prod_qty);
		$selectstock		=   addslashes($selectstock);
		$prod_purchase_lmt		=   addslashes($prod_purchase_lmt);
		$prod_remark		=   addslashes($prod_remark);
		$prod_youtubeid		=   addslashes($prod_youtubeid);
		$prod_id		=   addslashes($product_id);
		
		
		$selectseller  = $_SESSION['admin'];
   
		if(isset($prod_id)  && isset($prod_price) ) {
						
			// code for check product exist - START
			$stmt_check = $conn->prepare("SELECT web_url FROM product_details WHERE product_unique_id ='".$prod_id."' ");
			//$stmt->bind_param( s,  $inactive );
			$stmt_check->execute();
			$check_exist = 0;
			while ($stmt_check->fetch()) { 
				$check_exist = 1;
			}
			// code for check product exist - END
			
			if($check_exist ==1){					
										
					// code for add product for VENDOR - START
					$vendor_prod_sql = $conn->prepare("INSERT INTO `vendor_product`( `product_id`, `vendor_id`, `product_mrp`, `product_sale_price`, `product_tax_class`, 
										`product_stock`, `stock_status`, `product_purchase_limit`, `product_remark`, `product_related_prod`, `product_upsell_prod`,`enable_status`,created_at) 
										VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,?)");
					
					$vendor_prod_sql->bind_param( "sssssisisssss",$prod_id,$selectseller,$prod_mrp,$prod_price,$selecttaxclass,$prod_qty,$selectstock,
							$prod_purchase_lmt,$prod_remark,$selectrelatedprod,$selectupsell,$enableproduct,$datetime);
			
					$vendor_prod_sql->execute();
					$vendor_prod_sql->store_result();
				
					$vendor_prod_row = $vendor_prod_sql->affected_rows;
					$vendor_prod_id = $vendor_prod_sql->insert_id;
					// code for add product for VENDOR - END
					
					
					// code for add product for Attribute - START
					
					if(array_key_exists('selected_attr',$_POST) && array_key_exists('attr_combination',$_POST)){
						if(count($_POST['selected_attr']) >0  && count($_POST['attr_combination']) >0){
							foreach($_POST['selected_attr'] as $attr_json){
								$attr_json_decod = json_decode($attr_json);
								$attr_id = $attr_json_decod->attribute_id;
								$attribute_val = json_encode($attr_json_decod->attribute_val,JSON_FORCE_OBJECT);
								
								$sql_attr_prep = $conn->prepare("INSERT INTO `product_attribute`(`prod_attr_id`,`prod_id`,`attr_value`,`vendor_id`) VALUES (?,?,?,?)");
							
								$sql_attr_prep->bind_param( "isss",$attr_id,$prod_id,$attribute_val, $selectseller);
						
								$sql_attr_prep->execute();
								$sql_attr_prep->store_result();
							}
							
							$sql_attr ='';
							$count_varient = count($_POST['attr_combination']);
							for($v=0;$v<$count_varient;$v++){
								$varient_val = json_encode($_POST['attr_combination'][$v],JSON_FORCE_OBJECT);
								$prod_skus = $Common_Function->validate_product_sku($_POST['prod_skus'][$v],$conn);
								$sale_price = $_POST['sale_price'][$v];
								$mrp_price = $_POST['mrp_price'][$v];
								$stocks = $_POST['stocks'][$v];
								
								$sql_attr .= " ('".$prod_id."','".$vendor_prod_id."', '".$prod_skus."', ".$varient_val.", '".$sale_price."', '".$mrp_price."', '".$stocks."','','".$datetime."'),";
							}
							$sql_attr .=";";
							$sql_attr = str_replace(',;',';', $sql_attr);
							
							$sql_meta_prep = $conn->prepare("INSERT INTO `product_attribute_value`(`product_id`, `vendor_prod_id`, `product_sku`, `prod_attr_value`, `price`, `mrp`, `stock`, `notify_on_stock_below`, `created_at`) 
									VALUES ".$sql_attr);
							
							$sql_meta_prep->execute();
							$sql_meta_prep->store_result();
						}
					}
					
					// code for add product for Attribute - END
					$msg = "Product added successfully.  ";
				
			}else{
				$msg = "Product not exist.";
			}
			
		}else{
			$msg = "Invalid Parameters. Please fill all required fields.";
		}
	}else{
		$msg = "Invalid Parameters. Please fill all required fields.";
	}
}
//echo $msg;
	
	echo '<script>successmsg1("'.$msg.'","manage_product.php"); </script> ';
    die;
    
?>
