<?php
	include('session.php');
	include('encryptfun.php');
    global $publickey_server;

if(!$Common_Function->user_module_premission($_SESSION,$ManageSeller)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
	
    $code = $_POST['code'];
    $sellername = trim(strip_tags($_POST['seller_namevalue']));
    $businessname = trim(strip_tags($_POST['company_namevalue']));
    $groupid = trim(strip_tags($_POST['sellergroupvalue']));
    $buss_address = trim(strip_tags($_POST['business_addressvalue']));
    $buss_desc = trim(strip_tags($_POST['business_detailsvalue']));
    $country = trim(strip_tags($_POST['countryvalue']));
    $state = trim(strip_tags($_POST['statevalue']));
    $city = trim(strip_tags($_POST['cityvalue']));
    $pincode = trim(strip_tags($_POST['pincodevalue']));
    $phone = trim(strip_tags($_POST['phonevalue']));
    $email = trim(strip_tags($_POST['emailvalue']));
    $website = trim(strip_tags($_POST['websitevalue']));
    //$gst = trim(strip_tags($_POST['gstvalue']));
    $passwords = trim(strip_tags($_POST['passwords']));
    //$pan_number =$_POST['pan_number'];
    //$cin_number =$_POST['cin_number'];
   
    $code =    addslashes($code);
    $sellername=  addslashes($sellername);
    $businessname = addslashes($businessname);
    $groupid =  addslashes($groupid);
    $buss_address = addslashes($buss_address);
    $buss_desc =  addslashes($buss_desc);
    $country =  addslashes($country);
    $state = addslashes($state);    
    $city =  addslashes($city);
    $pincode=  addslashes($pincode);
    $phone =   addslashes($phone);
    $email=   addslashes($email);
    $website= addslashes($website);
    //$gst=   addslashes($gst);
	
	$encruptfun = new encryptfun();
    $passwords = $encruptfun->encrypt($publickey_server, $passwords);
	//$pan_number =   stripslashes($pan_number);
    //$cin_number =   stripslashes($cin_number);
	
  
 // echo "seler is ".$seller_id;
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && isset($sellername) && isset($groupid) && isset($buss_address) && isset($phone)  && !empty($sellername) && !empty($groupid)   && !empty($buss_address)  && !empty($phone)  ) {
       
        // first check phone, email already exist
        $alreadyexist = false;  
           $stmt = $conn->prepare("SELECT sellerid FROM sellerlogin WHERE phone=? OR email=?");
    	   $stmt->bind_param( 'ss',  $phone, $email );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1);
           while ($stmt->fetch()) { 
    	       
            	$alreadyexist = true;
    	    }
       
		if($alreadyexist){           
			echo "Phone Number / Email Id already exist";
		}else{ 	
	   
	   $checksum = date('dym').$Common_Function->random_strings(10).date('his');
	   $seller_unique_id = 'S'.$Common_Function->random_strings(10);
	   //code for upload images - START
		$seller_logo ='';
		if($_FILES['seller_logo']['name']){
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$featured_img1 = $Common_Function->file_upload('seller_logo',$media_path);
			$seller_logo = json_encode($featured_img1);
		}
		$aadhar_card ='';
		if(strlen($_FILES['aadhar_card']['name']) >1){			
			$Common_Function->img_dimension_arr = $img_dimension_arr;			$aadhar_card1 = $Common_Function->file_upload('aadhar_card',$media_path);			$aadhar_card = json_encode($aadhar_card1);		
		}
		
		$pan_card ='';
		if(strlen($_FILES['pan_card']['name']) >1){			
			$Common_Function->img_dimension_arr = $img_dimension_arr;				$pan_card1 = $Common_Function->file_upload('pan_card',$media_path);				$pan_card = json_encode($pan_card1);			
		}
		
		$business_proof ='';
		if(strlen($_FILES['business_proof']['name']) >1){			
			$Common_Function->img_dimension_arr = $img_dimension_arr;				$business_proof1 = $Common_Function->file_upload('business_proof',$media_path);				$business_proof = json_encode($business_proof1);	
		}
		
		
		//code for upload images - END
       // get from db-connection 	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
       	$region ="1"; $bankid =0; $flagid =0;
       /// status  = 0 -pending  1 accepted , 2 reject, 
		global $seller_req_accepted;
   
   	    $stmt11 = $conn->prepare("INSERT INTO sellerlogin(seller_unique_id, companyname, fullname, address, description, city, pincode, state, country,region, phone, email, logo, websiteurl, groupid, password, status, flagid, create_by, update_by,pan_card, aadhar_card, business_proof ,checksum )  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt11->bind_param( 'sssssisiiissssisiissssss',$seller_unique_id, $businessname, $sellername, $buss_address, $buss_desc, $city, $pincode, $state, $country, $region , $phone, $email, $seller_logo, $website, $groupid, $passwords, $seller_req_accepted, $flagid,$datetime, $datetime,$pan_card,$aadhar_card,$business_proof,$checksum );
	 
    	 $stmt11->execute();
    	 $stmt11->store_result();
    //	 echo " insert ";
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	     echo "Added";
			 $Common_Function->send_email_seller_regs($conn,$email,$sellername,$phone,$checksum,BASEURL);
             
    	 }else{
    	     echo "failed to add. Please try again";
    	 }
       }// alreadyexist else close	 
    	 
    	 
    }else{
        echo "Invalid Parameters. Please fill all required fields.";
    }
    die;
    
?>
