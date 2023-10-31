<?php
	include('session.php');

	if(!$Common_Function->user_module_premission($_SESSION,$DeliveryBoy)){
		echo "<script>location.href='no-premission.php'</script>";die();
	}

	include('encryptfun.php');
    global $publickey_server;
	
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
    
   
    $code =    addslashes($code);
    $full_name=  addslashes($full_name);
   
    $country =  addslashes($country);
    $state = addslashes($state);    
    $city =  addslashes($city);
    $pincode=  addslashes($pincode);
    $phone =   addslashes($phone);
    $email=   addslashes($email);
    
    $encruptfun = new encryptfun();
    $passwords = $encruptfun->encrypt($publickey_server, $passwords);
	
    $vehicle_number=   addslashes($vehicle_number);
    $buss_address=   addslashes($buss_address);
	
	
  
 // echo "seler is ".$seller_id;
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && isset($full_name) && isset($phone)  && !empty($full_name) && !empty($phone)  ) {
       
        // first check phone, email already exist
        $alreadyexist = false;  
           $stmt = $conn->prepare("SELECT id FROM deliveryboy_login WHERE phone=? OR email=?");
    	   $stmt->bind_param( 'ss',  $phone, $email );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1);
           while ($stmt->fetch()) { 
    	       
            	$alreadyexist = true;
    	    }
       
		if($alreadyexist){           
			echo "Phone Number / Email Id already exist";
		}else{ 	
	   
	   $delivery_unique_id = 'D'.$Common_Function->random_strings(10);
	   //code for upload images - START
		$profile_pic ='';
		if($_FILES['profile_pic']['name']){
			 
			$profile_pic = $Common_Function->doc_upload('profile_pic',$media_path);
			
		}
		
		$id_proof ='';
		if($_FILES['id_proof']['name']){
			
			$id_proof = $Common_Function->doc_upload('id_proof',$media_path);
			
		}
		
		$address_proof ='';
		if($_FILES['address_proof']['name']){
			 
			$address_proof = $Common_Function->doc_upload('address_proof',$media_path);
			
		}
		
		$vehicle_rc ='';
		if($_FILES['vehicle_rc']['name']){
			 
			$vehicle_rc = $Common_Function->doc_upload('vehicle_rc',$media_path);
			
		}
	
		$vehicle_insurance ='';
		if($_FILES['vehicle_insurance']['name']){
			 
			$vehicle_insurance = $Common_Function->doc_upload('vehicle_insurance',$media_path);
			
		}
		
		//code for upload images - END
       // get from db-connection 	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
       	$region ="1"; $status =1; $flagid =0;
       /// status  = 0 -pending  1 accepted , 2 reject, 
       global $seller_req_accepted;
   
   	    $stmt11 = $conn->prepare("INSERT INTO `deliveryboy_login`(`deliveryboy_unique_id`, `fullname`, `address`, `city`, `pincode`,
				`state`, `country`, `region`, `phone`, `email`, `password`, `profile_pic`, `id_proof`, `address_proof`, `vehicle_number`,
				`vehicle_docs`, `insurance_docs`, `status`, `flagid`, `create_by`, `update_by`)  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt11->bind_param( 'sssisiiisssssssssiiss',$delivery_unique_id, $full_name, $buss_address, $city, $pincode, $state, $country, $region , $phone, $email, $passwords,
				$profile_pic,$id_proof,$address_proof,$vehicle_number,$vehicle_rc,$vehicle_insurance,$status, $flagid,$datetime, $datetime );
	 
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
