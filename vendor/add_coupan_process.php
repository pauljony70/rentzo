<?php
include('session.php');

$code = $_POST['code'];
$coupancode = $_POST['coupancode'];
$coupandesc = $_POST['coupandesc'];
$cvalue = $_POST['cvalue'];
$capvalue = $_POST['capvalue'];
$minorder = $_POST['minorder'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$coupon_type = $_POST['coupon_type'];
$user_apply = $_POST['user_apply'];
$terms = $_POST['terms'];
$vendor_id = $_SESSION['admin'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$coupancode =   stripslashes($coupancode);
$coupandesc =   stripslashes($coupandesc);
$cvalue =   stripslashes($cvalue);
$capvalue =   stripslashes($capvalue);
$minorder =   stripslashes($minorder);
$fromdate =   stripslashes($fromdate);
$todate =   stripslashes($todate);
$coupon_type =   stripslashes($coupon_type);
$user_apply =   stripslashes($user_apply);
$terms =   stripslashes($terms);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code==$_SESSION['_token'] && isset($coupancode)   && !empty($coupancode)&& isset($cvalue)   && !empty($cvalue)  ) {
       
       $active ="active";
        $stmt11 = $conn->prepare("INSERT INTO coupancode_vendor( name, value, fromdate, todate, activate, cap_value, min_order,coupon_type,user_apply,vendor_id,coupandesc,terms )  VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt11->bind_param( 'sisssiiiisss',  $coupancode , $cvalue, $fromdate,$todate, $active, $capvalue, $minorder,$coupon_type,$user_apply,$vendor_id,$coupandesc,$terms);
	 
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
