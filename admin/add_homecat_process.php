<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
$code = $_POST['code'];
$catid = $_POST['cat_id'];
$ctype = $_POST['banner_type'];
$cat_order = $_POST['cat_order'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$catid =   stripslashes($catid);
$ctype =   stripslashes($ctype);
$cat_order =   stripslashes($cat_order);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if($code == $_SESSION['_token'] && $ctype  ) {
	
	if($ctype ==1){
		$banner_id = $catid;
	}
			
	$stmt11 = $conn->prepare("INSERT INTO `home_category`( `cat_id`, `clicktype`,`cat_order`)  VALUES (?,?,?)");
    $stmt11->bind_param( 'iii',  $banner_id, $ctype, $cat_order);
        
    $stmt11->execute();
    $stmt11->store_result();
    $rows=$stmt11->affected_rows;
    if($rows>0){
        echo " Home Category Added Successfully.";
        
    }else{
        echo "failed to add banner.";
    }    
    	      
    	  
        	
    	 
}else  if($code == $_SESSION['_token'] && $_POST['new_orders'] && $_POST['id']  ) {
	
			
	$stmt11 = $conn->prepare("UPDATE `home_category` SET `cat_order` =? WHERE id =? ");
    $stmt11->bind_param( 'ii',  $_POST['new_orders'], $_POST['id']);
        
    $stmt11->execute();
    $stmt11->store_result();
    $rows=$stmt11->affected_rows;
    if($rows>0){
        echo " Home Category Updated Successfully.";
        
    }else{
        echo "failed to update.";
    }    
    	      
    	  
        	
    	 
}else if($_POST['deletearray']){
	
    $deletearray = $_POST['deletearray'];
	$deletearray=   stripslashes($deletearray);
	$Common_Function->delete_home_category($deletearray, $conn);
}else{
     echo "Invalid Request.";
}
    die;
?>
