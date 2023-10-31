<?php

include('session.php');
$code = $_POST['code'];
$name = $_POST['namevalue'];
$main_attribute_id = $_POST['main_attribute_id'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$name =   stripslashes($name);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($name)   && !empty($name)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(id) FROM product_attributes_conf where attribute_value ='".$name."' and attribute_id  ='".$main_attribute_id."'");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow>0){
			 echo "Attribute  Already Exist. ";
		}else{
				
			
			//code for insert record - START
			
			
			$orderid =0;
			$stmt11 = $conn->prepare("INSERT INTO product_attributes_conf ( attribute_id, attribute_value)  VALUES (?,?)");
			$stmt11->bind_param( "is", $main_attribute_id, $name );
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Attribute Added Successfully. ";
				
			}else{
				echo "Failed to add Attribute";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
