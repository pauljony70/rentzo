<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];

$banner_layout = $_POST['banner_layout'];
$banner_title = $_POST['banner_title'];
$banner_order = $_POST['banner_order'];
$banner_id_update = $_POST['banner_id_update'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$banner_layout =   stripslashes($banner_layout);
$banner_title =   stripslashes($banner_title);
$banner_order =   stripslashes($banner_order);
$banner_id_update =   stripslashes($banner_id_update);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if($code == $_SESSION['_token'] && $banner_title && $banner_id_update) {
		
	$stmt11 = $conn->prepare("UPDATE `homepage_banners` SET  `title` =?, `layout` =?,`orders` =? WHERE id = '".$banner_id_update."'");
    $stmt11->bind_param( 'ssi', $banner_title, $banner_layout,$banner_order );
        
    $stmt11->execute();
    $stmt11->store_result();
    $rows=$stmt11->affected_rows;
    if($rows>0){
        echo " Banner updated Successfully.";
        
    }else{
        echo "failed to add banner.";
    }    
    	      
    	  
        	
    	 
}else{
     echo "Invalid Request.";
}
    die;
?>
