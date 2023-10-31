<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$DeliveryBoy)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
$code = $_POST['code'];
$deliveryboy_id = $_POST['deliveryboy_id'];

$code=  stripslashes($code);
$deliveryboy_id=  stripslashes($deliveryboy_id);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if($code == $_SESSION['_token'] && isset($deliveryboy_id)  && !empty($deliveryboy_id) ){
    
   
    include('encryptfun.php');
    global $publickey_server;
    $encruptfun = new encryptfun();
    
    try{
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
        $status = 0;
        $msg = "Bank details not available.";
        $notExist  = true; 
        $bankarray = array();
        
    //    $decript2 = $encruptfun->decrypt($publickey_server, $encrypted1);
        $stmt = $conn->prepare("SELECT bank_name, acc_no, ifsccode, address, createby, 	updateby, verifed, verified_date FROM deliveryboy_bankdetails WHERE deliveryboy_id=?");
        $stmt->bind_param("s", $deliveryboy_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8 );
        while ($stmt->fetch()) {
            
            $notExist         = false;
            
        }
       // echo " not wxsist is ".$notExist;
        if ($notExist != 1) {
                 $status = 1;
                $msg = "Seller Bank details";
            	$bankarray =array( 'bankname' => $col1, 'accno' =>   $col2,  'ifsc' => $col3,
                                        'address' => $col4, 'createby' => $col5, 'updateby' => $col6,
                                         'verify' => $col7,  'verifydate' => $col8);
        } else {
            $msg = "Bank details not available.";
        }
    
    
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg,
                              'data' => $bankarray);
    	
    	 echo  json_encode($information);
     
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>