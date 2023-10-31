<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Shipping)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$city = $_POST['city'];
$basic_fee = $_POST['basic_fee'];
$big_item_fee = $_POST['big_item_fee'];
$order_value = $_POST['order_value'];
$estimated_delivery_time = $_POST['estimated_delivery_time'];
$prime_delivery_time = $_POST['prime_delivery_time'];
$ajax_type = $_POST['ajax_type'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$city =   stripslashes($city);
$ajax_type =   stripslashes($ajax_type);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");die();
 // echo " dashboard redirect to index";
}
if($code == $_SESSION['_token'] && isset($city)   && !empty($city)  && !empty($basic_fee) && $ajax_type =='add' ) {
       //code for Check Shipping Exist - START
	   $stmt12 = $conn->prepare("SELECT count(id) FROM shipping_fees where city_id ='".$city."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Shipping Exist - END
		if($totalrow>0){
			 echo "City Shipping  Already Exist. ";
		}else{			
			
			//code for insert record - START
			
			
			$status =1;
			$stmt11 = $conn->prepare("INSERT INTO `shipping_fees` (`city_id`, `basic_fee`, `order_value`, `big_item_fee`, `estimated_delivery_time`, `prime_delivery_time`,`status`)
					VALUES (?, ?, ?, ?, ?, ?,?)");
			$stmt11->bind_param( "issssss", $city ,$basic_fee,$order_value,$big_item_fee,$estimated_delivery_time,$prime_delivery_time,$status);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "City Shipping Added Successfully. ";
				
			}else{
				echo "Failed to add Shipping";
			}
			
			//code for insert record - END
		}
    	 
}else if($code == $_SESSION['_token'] && $ajax_type =='update' ) {
	$attribute_id = trim($_POST['attribute_id']);
	$statuss = trim($_POST['statuss']);
      
	$orderid =0;
	$stmt11 = $conn->prepare("UPDATE shipping_fees SET `basic_fee` =?, `order_value` =?, `big_item_fee` =?, `estimated_delivery_time` =?, `prime_delivery_time` =?,`status` =? WHERE id =?");
	$stmt11->bind_param( "ssssssi", $basic_fee ,$order_value,$big_item_fee,$estimated_delivery_time,$prime_delivery_time,$statuss ,$attribute_id);
	
	$stmt11->execute();
	$stmt11->store_result();
	// echo " insert done ";
	$rows=$stmt11->affected_rows;
	echo "Shipping Updated Successfully. ";
	
				
				//code for insert record - END
}else if($code == $_SESSION['_token'] && $ajax_type =='delete' ) {
	$attribute_id = trim($_POST['deletearray']);
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("DELETE FROM shipping_fees where id ='".$attribute_id."' ");
     
        $stmt12->execute();
       echo "Deleted";
				
    	 
  }else{
       echo "Invalid values.";
    }
    die;
?>
