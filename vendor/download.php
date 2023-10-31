<?php

	include('session.php');

	if(!isset($_SESSION['admin'])){
		header("Location: index.php");
	}else{

    $deliveryboy_id= $_GET['ids'];
    $type= $_GET['type'];
  
	$stmt = $conn->prepare("SELECT `pan_card`, `aadhar_card`, `business_proof` FROM `sellerlogin` WHERE seller_unique_id='".$deliveryboy_id."'");
	
	$stmt->execute();	 
	$data = $stmt->bind_result( $col1,$col2, $col3);
	$return = array();
     
	while ($stmt->fetch()) {    
      $pan_card=$col1;  $aadhar_card=$col2;  $business_proof=$col3;  
                              		  			 
	}

	$name = $media_path.$$type;
	if(file_exists($name)){
		$Common_Function->download($name);
	}
    

    
}
?>