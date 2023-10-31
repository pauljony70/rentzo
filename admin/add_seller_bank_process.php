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
   
   	    $stmt11 = $conn->prepare("INSERT INTO seller_bankdetails(seller_id, bank_name, acc_no, ifsccode, address, createby, updateby, verifed, verified_date )  VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt11->bind_param( "sssssssis", $sellerid, $bankname, $accno, $ifsc, $address, $datetime, $datetime, $verify, $verifydate  );
		 $stmt11->execute();
    	 $stmt11->store_result();
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	        $status = 1;
                $msg = "Added successfully";
             
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
