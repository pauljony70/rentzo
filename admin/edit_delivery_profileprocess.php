<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$DeliveryBoy)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
    $code = $_POST['code'];
    $full_name = trim(strip_tags($_POST['full_name']));
    
    $country = trim(strip_tags($_POST['countryvalue']));
    $state = trim(strip_tags($_POST['statevalue']));
    $city = trim(strip_tags($_POST['cityvalue']));
    $pincode = trim(strip_tags($_POST['pincodevalue']));
    $phone = trim(strip_tags($_POST['phonevalue']));
    $email = trim(strip_tags($_POST['emailvalue']));
    
    $passwords = trim(strip_tags($_POST['passwords']));
    $vehicle_number = trim(strip_tags($_POST['vehicle_number']));
    $buss_address = trim(strip_tags($_POST['buss_address']));
    $profile_file = trim(strip_tags($_POST['profile_file']));
    $id_file = trim(strip_tags($_POST['id_file']));
    $address_file = trim(strip_tags($_POST['address_file']));
    $vehicle_file = trim(strip_tags($_POST['vehicle_file']));
    $insurance_file = trim(strip_tags($_POST['insurance_file']));
    $deliveryboy_id = trim(strip_tags($_POST['deliveryboy_id']));
    $status = trim(strip_tags($_POST['status']));
    $flagid = trim(strip_tags($_POST['rejectreason']));
    
   
    $code =    addslashes($code);
    $full_name=  addslashes($full_name);
   
    $country =  addslashes($country);
    $state = addslashes($state);    
    $city =  addslashes($city);
    $pincode=  addslashes($pincode);
    $phone =   addslashes($phone);
    $email=   addslashes($email);
    
    $passwords=   md5(addslashes($passwords));
    $vehicle_number=   addslashes($vehicle_number);
    $buss_address=   addslashes($buss_address);
    $profile_file=   addslashes($profile_file);
    $id_file=   addslashes($id_file);
    $address_file=   addslashes($address_file);
    $vehicle_file=   addslashes($vehicle_file);
    $insurance_file=   addslashes($insurance_file);
    $deliveryboy_id=   addslashes($deliveryboy_id);
	
	
  
 // echo "seler is ".$seller_id;
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && isset($deliveryboy_id) && isset($full_name) && isset($phone)  && !empty($full_name) && !empty($phone)  ) {
       
        // first check phone, email already exist
        $alreadyexist = false;  
           $stmt = $conn->prepare("SELECT id FROM deliveryboy_login WHERE (phone=? OR email=?) AND deliveryboy_unique_id !='".$deliveryboy_id."'");
    	   $stmt->bind_param( 'ss',  $phone, $email );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1);
           while ($stmt->fetch()) { 
    	       
            	$alreadyexist = true;
    	    }
       
		if($alreadyexist){           
			echo "Phone Number / Email Id already exist";
		}else{ 	
	   
	  
	   //code for upload images - START
		$profile_pic ='';
		if(strlen($_FILES['profile_pic']['name']) >1){
			$profile_pic = $Common_Function->doc_upload('profile_pic',$media_path);
		}else{
			$profile_pic = $profile_file;
		}
		
		$id_proof ='';
		if(strlen($_FILES['id_proof']['name']) >1){			
			$id_proof = $Common_Function->doc_upload('id_proof',$media_path);			
		}else{
			$id_proof = $id_file;
		}
		
		$address_proof ='';
		if(strlen($_FILES['address_proof']['name']) >1){			 
			$address_proof = $Common_Function->doc_upload('address_proof',$media_path);			
		}else{
			$address_proof = $address_file;
		}
		
		$vehicle_rc ='';
		if(strlen($_FILES['vehicle_rc']['name']) >1){			 
			$vehicle_rc = $Common_Function->doc_upload('vehicle_rc',$media_path);			
		}else{
			$vehicle_rc = $vehicle_file;
		}
	
		$vehicle_insurance ='';
		if(strlen($_FILES['vehicle_insurance']['name']) >1){			 
			$vehicle_insurance = $Common_Function->doc_upload('vehicle_insurance',$media_path);			
		}else{
			$vehicle_insurance = $insurance_file;
		}
		
		//code for upload images - END
       // get from db-connection 	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
       	$region ="1"; 
       /// status  = 0 -pending  1 accepted , 2 reject, 
      
   	    $stmt11 = $conn->prepare("UPDATE `deliveryboy_login` SET `fullname` = ?, `address` = ?, `city` = ?, `pincode` = ?,
				`state` = ?, `country` = ?, `region` = ?, `phone` = ?, `email` = ?,  `profile_pic` = ?, `id_proof` = ?, `address_proof` = ?, `vehicle_number` = ?,
				`vehicle_docs` = ?, `insurance_docs` = ?, `status` = ?, `flagid` = ?, `update_by` =? WHERE deliveryboy_unique_id = '".$deliveryboy_id."'");
		$stmt11->bind_param( 'ssisiiissssssssiis', $full_name, $buss_address, $city, $pincode, $state, $country, $region , $phone, $email,
				$profile_pic,$id_proof,$address_proof,$vehicle_number,$vehicle_rc,$vehicle_insurance,$status, $flagid,$datetime, );
	 
    	 $stmt11->execute();	
    	 $stmt11->store_result();
    //	 echo " insert ";
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	     echo "Added";
             
    	 }else{
    	     echo "failed to add. Please try again";
    	 }
       }// alreadyexist else close	 
    	 
    	 
    }else{
        echo "Invalid Parameters. Please fill all required fields.";
    }
    die;
    
?>
