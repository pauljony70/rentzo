<?php
	include('session.php');
	
	
	if(!$Common_Function->user_module_premission($_SESSION,$Staff)){
		echo "<script>location.href='no-premission.php'</script>";die();
	}

	
	include('encryptfun.php');
    global $publickey_server;
		
		
    $code = $_POST['code'];
    $full_name = trim(strip_tags($_POST['full_name']));
    $selectrole = trim(strip_tags($_POST['selectrole']));
    
    /*$country = trim(strip_tags($_POST['countryvalue']));
    $state = trim(strip_tags($_POST['statevalue']));
    $city = trim(strip_tags($_POST['cityvalue']));
    $pincode = trim(strip_tags($_POST['pincodevalue']));*/
    $phone = trim(strip_tags($_POST['phonevalue']));
    $email = trim(strip_tags($_POST['emailvalue']));
    
    $passwords = trim(strip_tags($_POST['passwords']));
    $buss_address = trim(strip_tags($_POST['buss_address']));
    
   
    $code =    addslashes($code);
    $full_name=  addslashes($full_name);
   
   /* $country =  addslashes($country);
    $state = addslashes($state);    
    $city =  addslashes($city);
    $pincode=  addslashes($pincode);*/
    $phone =   addslashes($phone);
    $email=   addslashes($email);
    
    
    $buss_address=   addslashes($buss_address);
	
	$encruptfun = new encryptfun();
    $passwords = $encruptfun->encrypt($publickey_server, $passwords);
	
  
 // echo "seler is ".$seller_id;
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && isset($full_name) && isset($phone)  && !empty($full_name) && !empty($phone) && $selectrole  ) {
       
        // first check phone, email already exist
        $alreadyexist = false;  
           $stmt = $conn->prepare("SELECT seller_id FROM admin_login WHERE phone=? OR email=?");
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
		if($_FILES['profile_pic']['name']){	
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$profile_pic1 = $Common_Function->file_upload('profile_pic',$media_path);			
			$profile_pic = json_encode($profile_pic1);			
		}
		
		
       	$datetime = date('Y-m-d H:i:s');
       	$region ="1"; $status =1; $flagid =0;
       /// status  = 0 -pending  1 accepted , 2 reject, 
       
   
   	    $stmt11 = $conn->prepare("INSERT INTO `admin_login`( `fullname`, `address`, `phone`, `email`, `password`, `logo`, `status`, `create_by`, `update_by`,`role_id`)  VALUES (?,?,?,?,?,?,?,?,?,?)");
		$stmt11->bind_param( 'ssssssissi', $full_name, $buss_address,   $phone, $email, $passwords,	$profile_pic,$status,$datetime, $datetime,$selectrole );
	   
    	 $stmt11->execute();	
    	 $stmt11->store_result();
 
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
