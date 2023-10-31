<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ManageSeller)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

    $code = $_POST['code'];
    $bankname = $_POST['bankname'];
    $accno = $_POST['accno'];
    $ifsc = $_POST['ifsc'];
    $address = $_POST['address'];
    $sellerid = $_POST['sellerid'];
    
    $code =   stripslashes($code);
    $bankname=  stripslashes($bankname);
    $accno = stripslashes($accno);
    $ifsc =  stripslashes($ifsc);
    $address =  stripslashes($address);
    $sellerid = stripslashes($sellerid);
     // $imagejson = "[sdfas]";
    
 // echo "seler is ".$seller_id;
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && isset( $sellerid)  && isset($bankname) && isset($accno) && isset( $ifsc) && isset( $address) && !empty($sellerid) && !empty($bankname) 
&& !empty($accno)  && !empty($ifsc)  && !empty($address)  ) {
         
      
       // get from db-connection 	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
       	$verify ="0"; $verifydate="0000-00-00 00:00:00";
        $status = 0;
   
   	    $stmt11 = $conn->prepare("UPDATE seller_bankdetails SET bank_name=?, acc_no=?, ifsccode=?, address=?, createby=?, updateby=?, verifed=?, verified_date=? WHERE seller_id=?");
		$stmt11->bind_param( "ssssssiss", $bankname, $accno, $ifsc, $address, $datetime, $datetime, $verify, $verifydate, $sellerid  );
		 $stmt11->execute();
    	 $stmt11->store_result();
    	 $rows=$stmt11->affected_rows;
    	   $status = 1;
                $msg = "Bank Detail Update successfully";
         
    	 
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg);
    	
    	 echo  json_encode($information);	 
    }else{
          $status = 1;
            $msg = "Invalid Parameters. Please fill all required fields.";
         $information =array( 'status' => $status,
                              'msg' =>   $msg);
    	
    	 echo  json_encode($information);
    }
    die;
    
?>
