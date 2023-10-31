<?php
include('session.php');
if(!$Common_Function->user_module_premission($_SESSION,$Staff)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
include('encryptfun.php');
global $publickey_server;
	
$code = $_POST['code'];
$type = $_POST['type'];

$code=  stripslashes($code);

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && isset($_POST['user_id']) && $type =='delete'){
    

    $deletearray = $_POST['user_id'];
	$deletearray=   stripslashes($deletearray);

    $Common_Function->delete_staff_user($_POST['user_id'], $conn,$media_path,$img_dimension_arr);
} else if( $code == $_SESSION['_token'] && isset( $_POST['user_id'])   && !empty($_POST['passwords']) && $type =='password_update' ) {
		 $user_unique_id = $_POST['user_id'];
		 $user_unique_id = stripslashes($user_unique_id);
		 
        $passwords = $_POST['passwords'];
		 $encruptfun = new encryptfun();
		$passwords = $encruptfun->encrypt($publickey_server, $passwords);
     
		$stmt11 = $conn->prepare("UPDATE admin_login SET password =? WHERE seller_id ='".$user_unique_id."' ");
		$stmt11->bind_param( "s",   $passwords  );
		 $stmt11->execute();
    	 $stmt11->store_result();
    	 $rows=$stmt11->affected_rows;
    	    $status = 1;
                $msg = "Password Updated successfully";
         
    	 
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg);
    	
    	 echo  json_encode($information);
	
	}
?>
