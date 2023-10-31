<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
$code = $_POST['code'];
$update_title = $_POST['update_title'];
$policy_content = trim($_POST['policy_content']);

$attribute_id = $_POST['attribute_id'];
$statuss = $_POST['statuss'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$policy_content =   addslashes($policy_content);

$attribute_id =   stripslashes($attribute_id);

$policy_validity =   stripslashes($_POST['policy_validity']);
$policy_type_refund =   stripslashes($_POST['policy_type_refund']);
$policy_type_replace =   stripslashes($_POST['policy_type_replace']);
$policy_type_exchange =   stripslashes($_POST['policy_type_exchange']);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($policy_content) && isset($statuss)   && !empty($update_title) && !empty($attribute_id)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(id) FROM product_return_policy where title ='".$update_title."'  AND id !='".$attribute_id."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow == 0){
			$stmt11 = $conn->prepare("UPDATE product_return_policy SET title ='".$update_title."' ,policy = '".$policy_content."',status = '".$statuss."',
					policy_validity ='".$policy_validity."' ,policy_type_refund ='".$policy_type_refund."' ,policy_type_replace ='".$policy_type_replace."' ,policy_type_exchange ='".$policy_type_exchange."'  WHERE id ='".$attribute_id."'");
		//	$stmt11->bind_param( "ss", $update_title , $policy_content );
			
			
			//code for insert record - START
			
			
			$orderid =0;
			
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			echo "Refund policy updated successfully";
			
			
			//code for insert record - END
		}else{
			echo "Refund policy already exist. ";
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
