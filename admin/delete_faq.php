<?php

include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else{
    

    $id = $_POST['id'];
    $id =   stripslashes($id);
   
   if(isset($id) && !empty($id)  ) {
	   
		
			$stmt2 = $conn->prepare("DELETE FROM faq WHERE id = '$id'");
			$stmt2->execute();
        		
			$rows=$stmt2->affected_rows;
        	if($rows>0)
			{
        			echo "Deleted";
			}
			else
			{
					echo "Failed to Delete. ";
			}
            	 
			die;
			
		
    }
	else
	{
			echo "Failed to Delete. ";
    }
}    
?>
