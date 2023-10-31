<?php
include('session.php');
include('encryptfun.php');
    global $publickey_server;
    $code = $_POST['code'];
   
    $code =   stripslashes($code);
   
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else  if( $code == $_SESSION['_token'] && isset( $_POST['selleridvalue'])   && !empty($_POST['passwords'])  ) {
		  $sellerid = $_POST['selleridvalue'];
		 $sellerid = stripslashes($sellerid);
		 
        $passwords = $_POST['passwords'];
		 $encruptfun = new encryptfun();
		$passwords = $encruptfun->encrypt($publickey_server, $passwords);
      
   	    $stmt11 = $conn->prepare("UPDATE admin_login SET password =? WHERE seller_id ='".$sellerid."' ");
		$stmt11->bind_param( "s",   $passwords  );
		 $stmt11->execute();
    	 $stmt11->store_result();
    	 $rows=$stmt11->affected_rows;
    	   $status = 1;
          $msg = "Password Updated successfully";
         
    	 
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg);
    	
    	 echo  json_encode($information);
	
	}else{
        echo "Invalid Parameters. Please fill all required fields.";
    }
    die;
    
?>
