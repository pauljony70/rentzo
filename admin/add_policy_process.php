<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
$code = $_POST['code'];
$policy_title = $_POST['policy_title'];
$policy_content = $_POST['policy_content'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$policy_title =   stripslashes($policy_title);
$policy_validity =   stripslashes($_POST['policy_validity']);
$policy_type_refund =   stripslashes($_POST['policy_type_refund']);
$policy_type_replace =   stripslashes($_POST['policy_type_replace']);
$policy_type_exchange =   stripslashes($_POST['policy_type_exchange']);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($policy_title)   && !empty($policy_title)  && !empty($policy_content)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(id) FROM product_return_policy where title ='".$policy_title."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow>0){
			 echo "Policy title  Already Exist. ";
		}else{
				
			
			//code for insert record - START
			
			
			$orderid =0;
			$stmt11 = $conn->prepare("INSERT INTO product_return_policy( title, policy,created_at,created_by,policy_validity,policy_type_refund,policy_type_replace,policy_type_exchange)  
						VALUES (?,?,?,?,?,?,?,?)");
			$stmt11->bind_param( "ssssiiii", $policy_title ,$policy_content,$datetime,$_SESSION['admin'],$policy_validity,$policy_type_refund,$policy_type_replace,$policy_type_exchange);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Refund policy added successfully. ";
				
			}else{
				echo "Failed to add Policy";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
