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
    $user_unique_id = trim(strip_tags($_POST['user_unique_id']));
    $status = trim(strip_tags($_POST['sellerstatus']));
    
    /*$country = trim(strip_tags($_POST['countryvalue']));
    $state = trim(strip_tags($_POST['statevalue']));
    $city = trim(strip_tags($_POST['cityvalue']));
    $pincode = trim(strip_tags($_POST['pincodevalue']));*/
    $phone = trim(strip_tags($_POST['phonevalue']));
    $email = trim(strip_tags($_POST['emailvalue']));
    
    $passwords = trim(strip_tags($_POST['passwords']));
    $buss_address = trim(strip_tags($_POST['buss_address']));
    $prod_imgurl = trim(strip_tags($_POST['prod_imgurl']));
    
   
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
}else if( $code == $_SESSION['_token'] && isset($full_name) && isset($phone)  && !empty($full_name) && !empty($phone) && $selectrole  && $user_unique_id) {
       
        // first check phone, email already exist
        $alreadyexist = false;  
           $stmt = $conn->prepare("SELECT seller_id FROM admin_login WHERE ( phone=? OR email=?) AND seller_id !='".$user_unique_id."'");
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
		}else{
			$profile_pic = $prod_imgurl;
		}
		
		
       	$datetime = date('Y-m-d H:i:s');
       	
   
   	    $stmt11 = $conn->prepare("UPDATE `admin_login`SET  `fullname` =?, `address` =?, `phone`=?, `email`=?, `logo` =?, `status` =?,`role_id` =? WHERE seller_id='".$user_unique_id."'");
		$stmt11->bind_param( 'sssssii', $full_name, $buss_address,$phone, $email,$profile_pic,$status,$selectrole );
	   
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
