<?php
include('session.php');
$code = $_POST['code'];

$vendor_id = $_POST['vendor_id'];
$type = $_POST['type'];


$code=  stripslashes($code);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else
if($code == $_SESSION['_token'] && $vendor_id && isset($_POST['message']) && $type == 'chat'){
    $message = $_POST['message'];
	$message=  stripslashes($message);
    try{
		
		$message_by = 'VENDOR';
		$status = 'N';
		$msg = '';
        $stmt = $conn->prepare("INSERT INTO vendor_admin_chat (user_id,message_by,message,created_at,status) VALUES(?,?,?,?,?)");
		$stmt->bind_param( 'sssss', $vendor_id,$message_by, $message, $datetime,$status );
    	
		$stmt->execute();	 
     	$stmt->store_result();
		
		$rows=$stmt->affected_rows;
    	$time = date('H:i A',strtotime($datetime));
		if($rows>0){
		  $msg = '<div class="container darker">
					<img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
					<p>'.$message.'</p>
					<span class="time-left">'.$time.'</span>
				</div>';
		}else{
			 $msg = 'error';
		}
       	 echo  $msg;
    	
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}else if($code == $_SESSION['_token'] && $vendor_id && $type == 'get_chat'){
    
    try{
    
		$query = $conn->query("SELECT * FROM vendor_admin_chat WHERE  user_id = '".$vendor_id."' AND message_by = 'ADMIN' AND status='N' ORDER BY created_at ASC");
									
		if($query->num_rows > 0){
			while($row = $query->fetch_assoc()){
				$time = date('H:i A',strtotime($row['created_at']));
				if($row['message_by'] =='ADMIN'){
					echo '<div class="container">
						<img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
						<p>'.$row['message'].'</p>
						<span class="time-right">'.$time.'</span>
					</div>';
				}
				$stmt = $conn->prepare("UPDATE vendor_admin_chat SET status='Y'  WHERE id='".$row['id']."'");
				
				$stmt->execute();	 
				$stmt->store_result();
				
			}
		
			
		}
    	
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>