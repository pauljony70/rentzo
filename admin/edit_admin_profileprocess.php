<?php
include('session.php');

    $code = $_POST['code'];
    $sellername = $_POST['seller_namevalue'];
    $businessname = $_POST['company_namevalue'];
    $buss_address = $_POST['business_addressvalue'];
    $buss_desc = $_POST['business_detailsvalue'];
    $country = $_POST['countryvalue'];
    $state = $_POST['statevalue'];
    $city = $_POST['cityvalue']; 
    $pincode = $_POST['pincodevalue'];
    $phone = $_POST['phonevalue'];
    $email = $_POST['emailvalue'];
	$imagejson =  $_POST['prod_imgurl']; 
    $sellerid =$_POST['sellerid'];
   
    $code =    stripslashes($code);
    $sellername=  stripslashes($sellername);
    $businessname = stripslashes($businessname);
    $buss_address = stripslashes($buss_address);
    $buss_desc =  stripslashes($buss_desc);
    $country =  stripslashes($country);
    $state = stripslashes($state);    
    $city =  stripslashes($city);
    $pincode=  stripslashes($pincode);
    $phone =   stripslashes($phone);
    $email=   stripslashes($email);
    $sellerid =   stripslashes($sellerid);
     // $imagejson = "[sdfas]";
    
// echo "sdfsa ".$name.$short.$full.$mrp.$price.$qty.$cat.$brand.$imagejson ;
  
  //echo "seler is ".$sellerid."---".$sellerstatus."---".$phone;
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if($code == $_SESSION['_token'] && isset($sellername)  && isset($buss_address) && isset($phone)  && !empty($sellername) && !empty($buss_address)  && !empty($phone)  ) {
         
    	$status =0;
       // get from db-connection 	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
       /// status  = 0 -pending  1 accepted , 2 reject, 
	   
	    // first check phone, email already exist
        $alreadyexist = false;  
           $stmt = $conn->prepare("SELECT seller_id FROM admin_login WHERE (phone=? OR email=? ) AND seller_id != '".$sellerid."'");
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
			$seller_logo ='';
			if(strlen($_FILES['seller_logo']['name']) > 1){
				$Common_Function->img_dimension_arr = $img_dimension_arr;
				$featured_img1 = $Common_Function->file_upload('seller_logo',$media_path);
				$seller_logo = json_encode($featured_img1);
			}else{
				$seller_logo = $imagejson;
			}
			
			
			
			
			//code for upload images - END
		
        $stmt11 = $conn->prepare("UPDATE admin_login SET companyname=?, fullname=?, address=?, description=?, city=?, pincode=?, state=?, country=?, phone=?, email=?, logo=?
				  WHERE seller_id ='".$sellerid."'");
    	$stmt11->bind_param( "ssssisiisss", $businessname, $sellername, $buss_address, $buss_desc, $city, $pincode, $state, $country, $phone, $email, $seller_logo);
		$stmt11->execute();
	    $stmt11->store_result();
    
    //	 echo " insert ";
    	 $rows=$stmt11->affected_rows;
			$status =1;
    	    $msg =  "Update Sucessful";
          $img_decode = json_decode($seller_logo);	
			$prod_url = MEDIAURL.$img_decode->{$img_dimension_arr[0][0].'-'.$img_dimension_arr[0][1]};
    	  $information =array( 'status' => $status,
                                    'msg' => $msg,'img'=>$prod_url);
         echo  json_encode( $information);
		}
    }else{
        $status =0;
        $msg = "Invalid Parameters. Please fill all required fields.";
        	  $information =array( 'status' => $status,
                                    'msg' => $msg,'img'=>'');
         echo  json_encode( $information);
    }

    die;
    
?>
