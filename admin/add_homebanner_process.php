<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];

$banner_layout = $_POST['banner_layout'];
$banner_title = $_POST['banner_title'];
$banner_order = $_POST['banner_order'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$banner_layout =   stripslashes($banner_layout);
$banner_title =   stripslashes($banner_title);
$banner_order =   stripslashes($banner_order);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if($code == $_SESSION['_token'] && $banner_title) {
		
	$stmt11 = $conn->prepare("INSERT INTO `homepage_banners`( `title`, `layout`,`orders`)  VALUES (?,?,?)");
    $stmt11->bind_param( 'ssi', $banner_title, $banner_layout,$banner_order );
        
    $stmt11->execute();
    $stmt11->store_result();
    $rows=$stmt11->affected_rows;
    if($rows>0){
        echo " Banner Added Successfully.";
        
    }else{
        echo "failed to add banner.";
    }    
    	      
    	  
        	
    	 
}else if($_POST['deletearray']){
	
    $deletearray = $_POST['deletearray'];
	$deletearray=   stripslashes($deletearray);
	$Common_Function->delete_home_banners_custom($deletearray, $conn,$media_path,$img_dimension_arr);
}else{
     echo "Invalid Request.";
}
    die;
?>
