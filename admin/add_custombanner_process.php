<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$image = $_POST['banner_image'];
$prodid = $_POST['product_id'];
$catid = $_POST['cat_id'];
$ctype = $_POST['banner_type'];
$product_name = $_POST['product_name'];
$banner_for = $_POST['banner_for'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$prodid =   stripslashes($prodid);
$catid =   stripslashes($catid);
$ctype =   stripslashes($ctype);
$product_name =   stripslashes($product_name);
$banner_for =   stripslashes($banner_for);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if($code == $_SESSION['_token'] && $ctype  ) {
	//code for upload images - START
	$banner_image ='';
	if($_FILES['banner_image']['name']){
		$Common_Function->img_dimension_arr = $img_dimension_arr;
		$brand_image1 = $Common_Function->file_upload('banner_image',$media_path);
		$banner_image = json_encode($brand_image1);
	}
		
	//code for upload images - END
	
	if($ctype ==1){
		$banner_id = $catid;
	}elseif($ctype ==3){ 
		$banner_id = $product_name;
	} else{
		$banner_id = $prodid;
	}
			
	$stmt11 = $conn->prepare("INSERT INTO `home_custom_banner`( `img_url`, `banner_id`, `clicktype`,`banner_for`)  VALUES (?,?,?,?)");
    $stmt11->bind_param( 'ssii', $banner_image, $banner_id, $ctype, $banner_for);
        
    $stmt11->execute();
    $stmt11->store_result();
    $rows=$stmt11->affected_rows;
    if($rows>0){
        echo " Banner Added Successfully.";
        
    }else{
        echo "failed to add banner.";
    }    
    	      
    	  
        	
    	 
}else if($_POST['keyword']){
	  $query = $conn->query("SELECT product_unique_id,prod_name FROM product_details WHERE  status='1' AND prod_name like '%".trim($_POST['keyword'])."%' ORDER BY prod_name ASC");
                            
     if($query->num_rows > 0){
		 echo '<ul id="country-list">';
        while($row = $query->fetch_assoc()){
				
			echo '<li onClick="selectCountry(\''.$row['prod_name'].'\',\''.$row['product_unique_id'].'\');">'.$row['prod_name'].'</li>';
			}
		}
         echo '</ul>';                       
}else if($_POST['deletearray']){
	
    $deletearray = $_POST['deletearray'];
	$deletearray=   stripslashes($deletearray);
	$Common_Function->delete_custom_home_banners($deletearray, $conn,$media_path,$img_dimension_arr);
}else{
     echo "Invalid Request.";
}
    die;
?>
