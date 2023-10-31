<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$CouponCode)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
$code = $_POST['code'];
$coupancode = $_POST['coupancode'];
$cvalue = $_POST['cvalue'];
$capvalue = $_POST['capvalue'];
$minorder = $_POST['minorder'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$coupon_type = $_POST['coupon_type'];
$user_apply = $_POST['user_apply'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$coupancode =   stripslashes($coupancode);
$cvalue =   stripslashes($cvalue);
$capvalue =   stripslashes($capvalue);
$minorder =   stripslashes($minorder);
$fromdate =   stripslashes($fromdate);
$todate =   stripslashes($todate);
$coupon_type =   stripslashes($coupon_type);
$user_apply =   stripslashes($user_apply);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code==$_SESSION['_token'] && isset($coupancode)   && !empty($coupancode)&& isset($cvalue)   && !empty($cvalue)  ) {
       
       $active ="active";
        $stmt11 = $conn->prepare("INSERT INTO coupancode( name, value, fromdate, todate, activate, cap_value, min_order,coupon_type,user_apply )  VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt11->bind_param( 'sisssiiii',  $coupancode , $cvalue, $fromdate,$todate, $active, $capvalue, $minorder,$coupon_type,$user_apply);
	 
        $stmt11->execute();
        $stmt11->store_result();
    	// echo " insert done ";
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	     echo "Coupan Added Successfully. ";
    	     
    	 }else{
    	     echo "failed to add Coupan";
    	 }	
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
