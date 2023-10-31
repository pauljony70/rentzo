<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$AppUser)){
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
    
    $buss_address = trim(strip_tags($_POST['buss_address']));
    $user_unique_id = trim(strip_tags($_POST['user_unique_id']));
    $prod_imgurl = trim(strip_tags($_POST['prod_imgurl']));
    
   
    $code =    addslashes($code);
    $full_name=  addslashes($full_name);
   
    $country =  addslashes($country);
    $state = addslashes($state);    
    $city =  addslashes($city);
    $pincode=  addslashes($pincode);
    $phone =   addslashes($phone);
    $email=   addslashes($email);
    
    $buss_address=   addslashes($buss_address);
	
	
  
 // echo "seler is ".$seller_id;
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && isset($full_name) && isset($phone)  && !empty($full_name) && !empty($phone)  ) {
       
        // first check phone, email already exist
        $alreadyexist = false;  
           $stmt = $conn->prepare("SELECT id FROM appuser_login WHERE (phone=? OR email=?) AND user_unique_id != '".$user_unique_id."'");
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
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$profile_pic1 = $Common_Function->file_upload('profile_pic',$media_path);			
			$profile_pic = json_encode($profile_pic1);			
		}else{
			$profile_pic = $prod_imgurl;
		}
		
		
       	$datetime = date('Y-m-d H:i:s');
       	$region ="1"; $status =1; $flagid =0;
       /// status  = 0 -pending  1 accepted , 2 reject, 
       
   
   	    $stmt11 = $conn->prepare("UPDATE `appuser_login` SET  `fullname`= ?, `address` = ?, `city` = ?, `pincode` = ?,
				`state` = ?, `country` = ?, `region` = ?, `phone` = ?, `email` = ?, `profile_pic` = ?, `status` = ?,  `update_by` =? WHERE user_unique_id != '".$user_unique_id."'");
		$stmt11->bind_param( 'ssisiiisssss', $full_name, $buss_address, $city, $pincode, $state, $country, $region , $phone, $email,
				$profile_pic,$status, $datetime );
	 
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
