<?php

	include('session.php');

	if(!isset($_SESSION['admin'])){
		header("Location: index.php");
	}else{
		if(isset($_GET['id'])){
			$deliveryboy_id= $_GET['id'];
			$type= $_GET['type'];
			
			$stmt = $conn->prepare("SELECT `profile_pic`, `id_proof`, `address_proof`, `vehicle_docs`, `insurance_docs` FROM `deliveryboy_login` WHERE deliveryboy_unique_id=?");
			$stmt ->bind_param("s", $deliveryboy_id);
			$stmt->execute();	 
			$data = $stmt->bind_result( $col1,$col2, $col3, $col4, $col5);
			$return = array();
									
			//echo " get col data ";
			while ($stmt->fetch()) {    
				$profile_pic=$col1;  $id_proof=$col2;  $address_proof=$col3;  $vehicle_docs=$col4; 
				$insurance_docs=$col5; 
														
			}
			
			$name = $media_path.$$type;
			if(file_exists($name)){
				$Common_Function->download($name);
			}
    
		}else if (isset($_GET['ids'])){
			$deliveryboy_id= $_GET['ids'];
			$type= $_GET['type'];
			
			$stmt = $conn->prepare("SELECT `pan_card`, `aadhar_card`, `business_proof` FROM `sellerlogin` WHERE seller_unique_id=?");
			$stmt ->bind_param("s", $deliveryboy_id);
			$stmt->execute();	 
			$data = $stmt->bind_result( $col1,$col2, $col3);
			$return = array();
									
			//echo " get col data ";
			while ($stmt->fetch()) {    
				
				$pan_decode = json_decode($col1);	
				$pan_url = $pan_decode->{$img_dimension_arr[2][0].'-'.$img_dimension_arr[2][1]};
				
				$aadhar_decode = json_decode($col2);	
				$aadhar_url = $aadhar_decode->{$img_dimension_arr[2][0].'-'.$img_dimension_arr[2][1]};
				
				$business_decode = json_decode($col3);	
				$business_url = $business_decode->{$img_dimension_arr[2][0].'-'.$img_dimension_arr[2][1]};
			
				$pan_card=$pan_url;  $aadhar_card=$aadhar_url;  $business_proof=$business_url;  
														
			}
			
			echo $name = $media_path.$$type;
			if(file_exists($name)){
				$Common_Function->download($name);
			}
		}
    
}
?>