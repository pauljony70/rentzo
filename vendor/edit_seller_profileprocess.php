<?php
include('session.php');

    $code = $_POST['code'];
    $sellername = $_POST['seller_namevalue'];
    $businessname = $_POST['company_namevalue'];
    $groupid = $_POST['sellergroupvalue'];
    $buss_address = $_POST['business_addressvalue'];
    $buss_desc = $_POST['business_detailsvalue'];
    $country = $_POST['countryvalue'];
    $state = $_POST['statevalue'];
    $city = $_POST['cityvalue']; 
    $pincode = $_POST['pincodevalue'];
    $phone = $_POST['phonevalue'];
    $email = $_POST['emailvalue'];
    $website = $_POST['websitevalue'];
    $gst = $_POST['gstvalue'];
    $imagejson =  $_POST['prod_imgurl']; 
    $sellerid =$_POST['sellerid'];
    $pan_card1 =$_POST['pan_card1'];
    $aadhar_card1 =$_POST['aadhar_card1'];
    $business_proof1 =$_POST['business_proof1'];
    $pan_number =$_POST['pan_number'];
    $cin_number =$_POST['cin_number'];
    $seller_banner1 =$_POST['seller_banner1'];
  
    $code =    stripslashes($code);
    $sellername=  stripslashes($sellername);
    $businessname = stripslashes($businessname);
    $groupid =  stripslashes($groupid);
    $buss_address = stripslashes($buss_address);
    $buss_desc =  stripslashes($buss_desc);
    $country =  stripslashes($country);
    $state = stripslashes($state);    
    $city =  stripslashes($city);
    $pincode=  stripslashes($pincode);
    $phone =   stripslashes($phone);
    $email=   stripslashes($email);
    $website= stripslashes($website);
    $gst=   stripslashes($gst);
    $sellerid =   stripslashes($sellerid);
    $pan_number =   stripslashes($pan_number);
    $cin_number =   stripslashes($cin_number);
    $seller_banner1 =   stripslashes($seller_banner1);
     // $imagejson = "[sdfas]";
    
// echo "sdfsa ".$name.$short.$full.$mrp.$price.$qty.$cat.$brand.$imagejson ;
  
  //echo "seler is ".$sellerid."---".$sellerstatus."---".$phone;
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if($code == $_SESSION['_token'] && isset($sellername)  &&  isset($gst)  && isset($cin_number)  &&  isset($pan_number)  && isset($groupid) && isset($buss_address) && isset($phone)  && !empty($sellername) && !empty($groupid)   && !empty($buss_address)  && !empty($phone)  ) {
         
    	$status =0;
       // get from db-connection 	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
       /// status  = 0 -pending  1 accepted , 2 reject, 
	   
	    // first check phone, email already exist
        $alreadyexist = false;  
           $stmt = $conn->prepare("SELECT sellerid FROM sellerlogin WHERE (phone=? OR email=? ) AND seller_unique_id != '".$sellerid."'");
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
			
			$seller_banner ='';
			if(strlen($_FILES['seller_banner']['name']) > 1){
				$Common_Function->img_dimension_arr = $img_dimension_arr;
				$featured_img1 = $Common_Function->file_upload('seller_banner',$media_path);
				$seller_banner = json_encode($featured_img1);
			}else{
				$seller_banner = $seller_banner1;
			}
			
			$aadhar_card ='';
			if(strlen($_FILES['aadhar_card']['name']) >1){			
				$aadhar_card = $Common_Function->doc_upload('aadhar_card',$media_path);			
			}else{
				$aadhar_card = $aadhar_card1;
			}
			
			$pan_card ='';
			if(strlen($_FILES['pan_card']['name']) >1){			
				$pan_card = $Common_Function->doc_upload('pan_card',$media_path);			
			}else{
				$pan_card = $pan_card1;
			}
			
			$business_proof ='';
			if(strlen($_FILES['business_proof']['name']) >1){			
				$business_proof = $Common_Function->doc_upload('business_proof',$media_path);			
			}else{
				$business_proof = $business_proof1;
			}
			
			
			//code for upload images - END
		
        $stmt11 = $conn->prepare("UPDATE sellerlogin SET companyname=?, fullname=?, address=?, description=?, city=?, pincode=?, state=?, country=?, phone=?, email=?, logo=?, websiteurl=?, tax_number=?, groupid=?,
				 update_by=?, pan_card=?, aadhar_card=?, business_proof=?,pan_number=?, cin_number=?,seller_banner=? WHERE seller_unique_id=?");
    	$stmt11->bind_param( "ssssisiisssssiisssssss", $businessname, $sellername, $buss_address, $buss_desc, $city, $pincode, $state, $country, $phone, $email, $seller_logo, $website, $gst, $groupid,
				$datetime,$pan_card,$aadhar_card,$business_proof, $pan_number,$cin_number,$seller_banner, $sellerid );
		$stmt11->execute();
	    $stmt11->store_result();
    
    //	 echo " insert ";
    	 $rows=$stmt11->affected_rows;
			$status =1;
    	    $msg =  "Update Sucessful";
			$img_decode = json_decode($seller_logo);	
			$prod_url = MEDIAURL.$img_decode->{$img_dimension_arr[0][0].'-'.$img_dimension_arr[0][1]};

			$banner_decode = json_decode($seller_banner);	
			$banner_url = MEDIAURL.$banner_decode->{$img_dimension_arr[0][0].'-'.$img_dimension_arr[0][1]};
			
    	  $information =array( 'status' => $status,
                                    'msg' => $msg,
									'img'=>$prod_url,
									'seller_banner'=>$banner_url
									);
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
