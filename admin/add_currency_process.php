<?php
	include('session.php');
	
	if(!$Common_Function->user_module_premission($_SESSION,$StoreSettings)){
		echo "<script>location.href='no-premission.php'</script>";die();
	}
    $code = $_POST['code'];
    $type = $_POST['type'];
   
  
 // echo "seler is ".$seller_id;
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && $type =='add_currency') {
    $namevalue = $_POST['namevalue'];
	$symbol = $_POST['symbol'];
		  
	$query = $conn->query("SELECT * FROM `currency` WHERE name ='".$key."'");
	if($query->num_rows > 0){
		$message = 'Currency Already Exist.';
	}else{
		$query = $conn->query("INSERT INTO `currency` (name, symbol) VALUES ('".$namevalue."', '".$symbol."')");
		$message = 'Currency Added Successfully.';
	}
    	echo json_encode(array('status'=>1,'msg' =>$message));
       
        	 
}else if( $code == $_SESSION['_token'] && $type =='update_currency') {
    $namevalue = $_POST['namevalue'];
	$symbol = $_POST['update_symbol'];
	$attribute_id = $_POST['attribute_id'];
		  
	$query = $conn->query("SELECT * FROM `currency` WHERE name ='".$key."' AND id !='".$attribute_id."' ");
	if($query->num_rows > 0){
		$message = 'Currency Already Exist.';
	}else{
		$query = $conn->query("UPDATE `currency`  SET name ='".$namevalue."', symbol ='".$symbol."' WHERE id ='".$attribute_id."'  ");
		$message = 'Currency Updated Successfully.';
	}
    	echo json_encode(array('status'=>1,'msg' =>$message));
       
        	 
}else if( $code == $_SESSION['_token'] && $type =='delete_currency') {
    
	$attribute_id = $_POST['deletearray'];
		  
	$query = $conn->query("DELETE FROM `currency` WHERE  id ='".$attribute_id."' ");
	
	$message = 'Currency Deleted Successfully.';
	
    echo json_encode(array('status'=>1,'msg' =>$message));
       
        	 
}else{
    echo "Invalid Parameters. Please fill all required fields.";
}
    die;
    
?>
