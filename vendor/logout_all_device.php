<?php
include('../app/db_connection.php');

	$query = $conn->query("SELECT * FROM `ci_session` WHERE id ='".$_POST['user_id']."'");
	if($query->num_rows > 0){
		while($rows = $query->fetch_assoc()){
			$meta = json_decode($rows['meta']);
			
			
			$session_id_to_destroy = $meta->ses_id;

			$browser = $rows['browser'];
			//if($_SERVER['HTTP_USER_AGENT'] !=$browser){
				session_id($session_id_to_destroy);
				session_start();
				session_destroy();
				session_commit();
			//}
		}
	}
	$query1 = $conn->query("DELETE FROM `ci_session` WHERE id ='".$_POST['user_id']."'");

?>