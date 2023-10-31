<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];

$code=  stripslashes($code);

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && isset($_POST['record_id']) && isset($_POST['rejectreason'])){
    

    $deletearray = $_POST['record_id'];
    $rejectreason = $_POST['rejectreason'];
	$deletearray=   stripslashes($deletearray);

 
   
   if(isset($deletearray) &&!empty( $deletearray)  ) {           
			
		$stmt22 = $conn->prepare("SELECT name, created_by FROM  attribute_set WHERE sno=? ");
		$stmt22->bind_param( "i",  $deletearray );
		$stmt22->execute();	 
		$data = $stmt22->bind_result( $name, $created_by);
		$return = array();
		
		while ($stmt22->fetch()) { 
		   $name1 = $name;
		   $seller_id = $created_by;
		  
		}	
		
		$message = "Your Attribute ".$name1." is rejected. ". $rejectreason;
		
		$Common_Function->notify_seller($conn,$seller_id,$message);
		$Common_Function->delete_product_attribute_set($deletearray, $conn);            	 
        
        die;
    }
} else if( $code == $_SESSION['_token'] && isset($_POST['verify_record_id']) ){
	
		$stmt22 = $conn->prepare("SELECT name, created_by FROM  attribute_set WHERE sno=? ");
		$stmt22->bind_param( "i",  $_POST['verify_record_id'] );
		$stmt22->execute();	 
		$data = $stmt22->bind_result( $name, $created_by);
		$return = array();
		
		while ($stmt22->fetch()) { 
		   $name1 = $name;
		   $seller_id = $created_by;
		  
		}	
		
		$message = "Your Attribute ".$name1." is verified.";
		$stmt11 = $conn->prepare("UPDATE  attribute_set SET status =1 WHERE sno = '".trim($_POST['verify_record_id'])."'");
  
		$stmt11->execute();
		$rows=$stmt11->affected_rows;
		$Common_Function->notify_seller($conn,$seller_id,$message);
		echo 'approve';
}

?>
