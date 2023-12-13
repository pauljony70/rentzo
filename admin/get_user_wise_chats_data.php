<?php

include('session.php');



if(!$Common_Function->user_module_premission($_SESSION,$Order)){

	echo "<script>location.href='no-premission.php'</script>";die();

}



$order_id  = $_POST['order_id'];

			$stmt_update = $conn->prepare("UPDATE chat_messages SET admin_seen ='1' WHERE order_id ='".$order_id."'");

			$stmt_update->execute();
   
   
   $sql = "SELECT * FROM chat_messages 
            WHERE order_id = '$order_id' 
            ORDER BY created_at ASC";

        $result = $conn->query($sql);
		
		$html ='';
		while ($row = $result->fetch_assoc()) {
				
				
			if($row['send_by'] == 'seller') {
               $html .='<div class="d-flex justify-content-start seller-message mr-5 mb-3"><div class="message py-1 px-2">'.$row['message'].'</div></div>';
				} else if($row['send_by'] == 'user') {
				
				$html .='<div class="d-flex justify-content-end user-message ml-5 mb-3"><div class="message py-1 px-2">'.$row['message'].'</div></div>';
            }
		}
		echo $html;

?>