<?php
include('session.php');
$code  = $_GET['code'];
$msg =  '';
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 
}else if($code == $_SESSION['_token']){
    $moduleName = "Inventory".date('Y_m_d');
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="'.$moduleName.'.csv"');

	$mand_headers = array('name','sku','mrp','price','quantity');
		
	$fp = fopen('php://output', 'wb');

    
    fputcsv($fp, $mand_headers);


	
	
	// code for check product exist - START
	$query = "SELECT pd.product_unique_id, vp.id as vendor_prod_id, pd.prod_name ,pd.product_sku,pd.prod_type,vp.product_mrp, vp.product_sale_price,vp.product_stock
				FROM product_details pd,vendor_product vp WHERE vp.product_id =pd.product_unique_id AND vp.vendor_id ='".$_SESSION['admin']."' AND vp.enable_status IN(1)";
			
	$stmt_check = $conn->query($query);
	if($stmt_check->num_rows > 0){
		
		while ($rows = $stmt_check->fetch_assoc()) { 
		
			if($rows['prod_type'] == 2){
				$query1 = "SELECT product_sku, mrp,price, stock FROM product_attribute_value WHERE product_id = '".$rows['product_unique_id']."'  
							AND vendor_prod_id ='".$rows['vendor_prod_id']."'";
			
				$stmt_check1 = $conn->query($query1);
				if($stmt_check1->num_rows > 0){
					while ($rows12= $stmt_check1->fetch_assoc()) { 
						$rows1 = array_merge(array('prod_name'=>$rows['prod_name']),$rows12);
						
						$line = implode("\",\"",$rows1);
						$line = "\"" .$line;
						$line .= "\"\r\n";
					//	echo $line;
					   fputcsv($fp, $rows1);
					}
				}
				
			}else {
				unset($rows['product_unique_id']);
				unset($rows['vendor_prod_id']);
				unset($rows['prod_type']);
				$line = implode("\",\"",$rows);
				$line = "\"" .$line;
				$line .= "\"\r\n";
				//echo $line;
				fputcsv($fp, $rows);
			}
			
  

			
			
		}
		
		/** Send the output header and invoke function for contents output */		
		
	}
	fclose($fp);die();
	
	
}
 
?>
