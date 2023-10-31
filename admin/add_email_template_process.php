<?php
include('session.php');


if(!$Common_Function->user_module_premission($_SESSION,$StoreSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$email_title = $_POST['email_title'];
$email_subject = $_POST['email_subject'];
$email_content = $_POST['email_content'];
$type = $_POST['type'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$email_title =   stripslashes($email_title);
$email_subject =   stripslashes($email_subject);
$email_content =   stripslashes($email_content);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($email_title) && isset($email_subject)   && isset($email_content)   && !empty($email_title) && $type =='add' ) {
     
	//code for insert record - START
	
	
	$stmt11 = $conn->prepare("INSERT INTO email_template( email_title, email_subject,email_body )  VALUES (?,?,?)");
	$stmt11->bind_param( "sss",  $email_title, $email_subject,$email_content );
	
	$stmt11->execute();
	$stmt11->store_result();
	// echo " insert done ";
	$rows=$stmt11->affected_rows;
	if($rows>0){
		echo "Email Template Added Successfully. ";
		
	}else{
		echo "failed to add template";
	}
	
	//code for insert record - END
		
    	 
}else if($code == $_SESSION['_token'] && isset($email_title) && isset($email_subject)   && isset($email_content)   && !empty($email_title) && $type =='update' ) {
     
	//code for insert record - START
	
	
	$stmt11 = $conn->prepare("UPDATE email_template SET  email_title =? , email_subject= ?,email_body =? WHERE id = '".$_POST["id"]."'");
	$stmt11->bind_param( "sss",  $email_title, $email_subject,$email_content );
	
	$stmt11->execute();
	$stmt11->store_result();
	// echo " insert done ";
	$rows=$stmt11->affected_rows;
	if($rows>0){
		echo "Email Template Updated Successfully. ";
		
	}else{
		echo "failed to update template";
	}
	
	//code for insert record - END
		
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
