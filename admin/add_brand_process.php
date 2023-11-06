<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Brand)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$name = $_POST['namevalue'];
$name_ar = $_POST['name_ar'];
$brand_site_url = $_POST['brand_site_url'];
$popular_brand = $_POST['popular_brand'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$name =   stripslashes($name);
$name_ar =   stripslashes($name_ar);
$brand_site_url =   stripslashes($brand_site_url);
$popular_brand =   stripslashes($popular_brand);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($name) ) {
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
			
			
			$orderid =0;
			$stmt11 = $conn->prepare("INSERT INTO brand( brand_name, brand_img,created_at,created_by,brand_name_ar,brand_site_url,popular_brand )  VALUES (?,?,?,?,?,?,?)");
			$stmt11->bind_param( "ssssssi",  $name, $brand_image,$datetime,$_SESSION['admin'],$name_ar,$brand_site_url,$popular_brand );
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Brand Name Added Successfully. ";
				
			}else{
				echo "failed to add brand";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
