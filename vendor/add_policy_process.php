<?php

include('session.php');
$code = $_POST['code'];
$policy_title = $_POST['policy_title'];
$policy_content = $_POST['policy_content'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$policy_title =   stripslashes($policy_title);


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
			 echo "Refund policy  Already Exist. ";
		}else{
				
			
			//code for insert record - START
			
			
			$status =0;
			$stmt11 = $conn->prepare("INSERT INTO product_return_policy( title, policy,status,created_at,created_by)  VALUES (?,?,?,?,?)");
			$stmt11->bind_param( "ssiss", $policy_title ,$policy_content,$status,$datetime,$_SESSION['admin']);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Refund policy Added Successfully. Please wait untill Admin Approved ";
				
				$link = BASEURL."admin/pending_return_policy.php";	
				$Common_Function->send_email_seller_new($conn,$_SESSION['seller_name'],$link,'Return policy', "New Return policy Request",$name);
				
			}else{
				echo "Failed to add Refund policy";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
