<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Category)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];

$code=  stripslashes($code);

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && isset($_POST['cat_id']) && isset($_POST['rejectreason'])){
    

    $deletearray = $_POST['cat_id'];
    $rejectreason = $_POST['rejectreason'];
	$deletearray=   stripslashes($deletearray);

 
   
   if(isset($deletearray) &&!empty( $deletearray)  ) {           
			
		$stmt22 = $conn->prepare("SELECT cat_name, created_by FROM category WHERE cat_id=? ");
		$stmt22->bind_param( "i",  $deletearray );
		$stmt22->execute();	 
		$data = $stmt22->bind_result( $cat_name, $created_by);
		$return = array();
		
		while ($stmt22->fetch()) { 
		   $cat_name1 = $cat_name;
		   $seller_id = $created_by;
		  
		}	
		
		$message = "Your Category ".$cat_name1." is rejected. ". $rejectreason;
		
		$Common_Function->notify_seller($conn,$seller_id,$message);
		$Common_Function->delete_product_category($deletearray, $conn,$media_path,$img_dimension_arr);            	 
        
        die;
    }
} else if( $code == $_SESSION['_token'] && isset($_POST['verify_cat_id']) ){
	
		$stmt22 = $conn->prepare("SELECT cat_name, created_by FROM category WHERE cat_id=? ");
		$stmt22->bind_param( "i",  $_POST['verify_cat_id'] );
		$stmt22->execute();	 
		$data = $stmt22->bind_result( $cat_name, $created_by);
		$return = array();
		
		while ($stmt22->fetch()) { 
		   $cat_name1 = $cat_name;
		   $seller_id = $created_by;
		  
		}	
		
		$message = "Your Category ".$cat_name1." is verified.";
		$stmt11 = $conn->prepare("UPDATE category SET status =1 WHERE cat_id = '".trim($_POST['verify_cat_id'])."'");
  
		$stmt11->execute();
		$rows=$stmt11->affected_rows;
		$Common_Function->notify_seller($conn,$seller_id,$message);
		echo 'approve';
}

?>
