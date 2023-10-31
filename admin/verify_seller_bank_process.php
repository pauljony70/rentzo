<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ManageSeller)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

include('encryptfun.php');
    global $publickey_server;
    $code = $_POST['code'];
   
    $code =   stripslashes($code);
   
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else if( $code == $_SESSION['_token'] && isset( $_POST['verify_seller_id'])   && !empty($_POST['verify_seller_id'])  ) {
          $sellerid = $_POST['verify_seller_id'];
		 $sellerid = stripslashes($sellerid);
       // get from db-connection 	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
       	$verify ="1"; 
		$verifydate=date('Y-m-d H:i:s');
        $status = 0;
   
   	    $stmt11 = $conn->prepare("UPDATE seller_bankdetails SET updateby =?, verifed=?, verified_date=? WHERE seller_id ='".$sellerid."' ");
		$stmt11->bind_param( "sis",   $datetime, $verify, $verifydate  );
		 $stmt11->execute();
    	 $stmt11->store_result();
    	 $rows=$stmt11->affected_rows;
        $status = 1;
        $msg = "Account Number Verified successfully";
             
    	
    	 
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg);
    	
    	 echo  json_encode($information);	 
    }else if( $code == $_SESSION['_token'] && isset( $_POST['selleridvalue'])   && !empty($_POST['passwords'])  ) {
		  $sellerid = $_POST['selleridvalue'];
		 $sellerid = stripslashes($sellerid);
		 
        $passwords = $_POST['passwords'];
		 $encruptfun = new encryptfun();
		$passwords = $encruptfun->encrypt($publickey_server, $passwords);
      
   	    $stmt11 = $conn->prepare("UPDATE sellerlogin SET password =? WHERE seller_unique_id ='".$sellerid."' ");
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
