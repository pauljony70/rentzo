<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$AppUser)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

include('encryptfun.php');
    global $publickey_server;
    $code = $_POST['code'];
   
    $code =   stripslashes($code);
   
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else if( $code == $_SESSION['_token'] && isset( $_POST['user_unique_id'])   && !empty($_POST['passwords'])  ) {
		 $user_unique_id = $_POST['user_unique_id'];
		 $user_unique_id = stripslashes($user_unique_id);
		 
        $passwords = $_POST['passwords'];
		 $encruptfun = new encryptfun();
		$passwords = $encruptfun->encrypt($publickey_server, $passwords);
      
   	    $stmt11 = $conn->prepare("UPDATE appuser_login SET password =? WHERE user_unique_id ='".$user_unique_id."' ");
		$stmt11->bind_param( "s",   $passwords  );
		 $stmt11->execute();
    	 $stmt11->store_result();
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	        $status = 1;
                $msg = "Password Updated successfully";
             
    	 }else{
    	       $status = 0;
                $msg = "failed to add. Please try again";
            
    	 }
    	 
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg);
    	
    	 echo  json_encode($information);
	
	}else{
        echo "Invalid Parameters. Please fill all required fields.";
    }
    die;
    
?>
