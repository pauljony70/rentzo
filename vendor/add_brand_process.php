<?php

include('session.php');
$code = $_POST['code'];
$name = $_POST['namevalue'];
$name_ar = $_POST['name_ar'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$name =   stripslashes($name);
$name_ar =   stripslashes($name_ar);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($name)   && !empty($name)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(brand_id) FROM brand where brand_name ='".$name."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow>0){
			 echo "Brand Name Already Exist. ";
		}else{
			//code for upload images - START
			$brand_image ='';
			if($_FILES['brand_image']['name']){
				$Common_Function->img_dimension_arr = $img_dimension_arr;
				$brand_image1 = $Common_Function->file_upload('brand_image',$media_path);
				$brand_image = json_encode($brand_image1);
			}
			
			//code for upload images - END
			
			
			//code for insert record - START
			
			
			$status = 0;
			$stmt11 = $conn->prepare("INSERT INTO brand( brand_name, brand_img ,status,created_at,created_by,brand_name_ar)  VALUES (?,?,?,?,?,?)");
			$stmt11->bind_param( "ssisss",  $name, $brand_image ,$status,$datetime,$_SESSION['admin'],$name_ar);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Brand Name Added Successfully.Please wait untill admin Approved. ";
				$link = BASEURL."admin/pending_brand.php";	
				$Common_Function->send_email_seller_new($conn,$_SESSION['seller_name'],$link,'Brand', "New Brand Request",$name);
				
			}else{
				echo "Failed to add brand";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
