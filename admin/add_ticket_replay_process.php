<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
$code = $_POST['code'];
$title = $_POST['title'];
$desc = $_POST['desc'];
$ticket_id = $_POST['ticket_id'];


$error=''; 
$code=   stripslashes($code);
$title =   stripslashes($title);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($title)  && !empty($desc)  ) {
	
	$stmt12 = $conn->prepare("SELECT user_email FROM faq_form where ticket_id = '".$ticket_id."'  ");
     
	$stmt12->execute();
	$stmt12->store_result();
	$stmt12->bind_result (  $user_email);
				 
	while($stmt12->fetch() ){
		$email = $user_email;         
	}
	
     		
			
			$orderid =0;
			$type = 'admin';
			$stmt11 = $conn->prepare("INSERT INTO ticket_history( ticket_id, subject,content,type,create_at)  VALUES (?,?,?,?,?)");
			$stmt11->bind_param( "sssss", $ticket_id,$title, $desc,$type,$datetime);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				$Common_Function->send_ticket_replay_email($conn,$ticket_id,$title,$desc,$email);
				echo "Ticket Replay Added Successfully. ";
				
			}else{
				echo "Failed to add Ticket Replay";
			}
			
	
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
