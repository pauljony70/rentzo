<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$DeliveryBoy)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

include('encryptfun.php');
    global $publickey_server;
    $code = $_POST['code'];
   
    $code =   stripslashes($code);
   
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else if( $code == $_SESSION['_token'] && isset( $_POST['verify_deliveryb_id'])   && !empty($_POST['verify_deliveryb_id'])  ) {
          $deliveryboy_id = $_POST['verify_deliveryb_id'];
		 $deliveryboy_id = stripslashes($deliveryboy_id);
       // get from db-connection 	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
       	$verify ="1"; 
		$verifydate=date('Y-m-d H:i:s');
        $status = 0;
   
   	    $stmt11 = $conn->prepare("UPDATE deliveryboy_bankdetails SET updateby =?, verifed=?, verified_date=? WHERE deliveryboy_id ='".$deliveryboy_id."' ");
		$stmt11->bind_param( "sis",   $datetime, $verify, $verifydate  );
		 $stmt11->execute();
    	 $stmt11->store_result();
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	        $status = 1;
                $msg = "Account Number Verified successfully";
             
    	 }else{
    	       $status = 0;
                $msg = "failed to add. Please try again";
            
    	 }
    	 
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg);
    	
    	 echo  json_encode($information);	 
    }else if( $code == $_SESSION['_token'] && isset( $_POST['deliveryboy_id'])   && !empty($_POST['passwords'])  ) {
		  $deliveryboy_id = $_POST['deliveryboy_id'];
		 $deliveryboy_id = stripslashes($deliveryboy_id);
		 
        $passwords = $_POST['passwords'];
		$encruptfun = new encryptfun();
		$passwords = $encruptfun->encrypt($publickey_server, $passwords);
      
   	    $stmt11 = $conn->prepare("UPDATE deliveryboy_login SET password =? WHERE deliveryboy_unique_id ='".$deliveryboy_id."' ");
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
