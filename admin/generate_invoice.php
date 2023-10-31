<?php

if(!$_REQUEST['orderid'] || !$_REQUEST['product_id']){
	 header("Location: manage_orders.php");
}else{
	require_once('session.php');

	$ordersno = $_REQUEST['orderid'];
	$product_id = $_REQUEST['product_id'];
	
	$Common_Function->generate_invoice($conn,$ordersno,$product_id,'');
}