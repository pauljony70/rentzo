<?php
include('session.php');
$code = $_POST['code'];
$type = $_POST['type'];


$code=  stripslashes($code);
$type=   stripslashes($type);

$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if($code == $_SESSION['_token'] && $type =='revenue' ){
	
    try{
		$filter = $_POST['filter'];
		
		if($filter =='current_month'){
			$stmt = $conn->prepare("SELECT SUM((prod_price*qty)+shipping) total_revenue, DATE(create_date) as order_date FROM `order_product` WHERE status ='Delivered' AND MONTH(create_date) ='".date('m')."' group by DATE(create_date)");
        
		}else if($filter =='monthly'){
			$stmt = $conn->prepare("SELECT SUM((prod_price*qty)+shipping) total_revenue, DATE(create_date) as order_date FROM `order_product` WHERE status ='Delivered' AND YEAR(create_date) ='".date('Y')."' group by MONTH(create_date)");
        }
		$stmt->execute();
        $data = $stmt->bind_result( $total_revenue,$order_date);
		$total_revenue=$order_date='';
		$info = array();
        while ($stmt->fetch()) { 
			$revenue = $total_revenue;
			$date = $order_date;
			$info[] = array('date'=> $date,
    	                  'price' => $total_revenue);
		}
    	
		echo  json_encode($info);
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}else if($code == $_SESSION['_token'] && $type =='new_seller' ){
	
    try{
		$filter = $_POST['filter'];
		
		if($filter =='current_month'){
			$stmt = $conn->prepare("SELECT count(sellerid) total_seller, DATE(create_by) as order_date FROM `sellerlogin` WHERE status ='1' AND MONTH(create_by) ='".date('m')."' group by DATE(create_by)");
        
		}else if($filter =='monthly'){
			$stmt = $conn->prepare("SELECT  count(sellerid) total_seller, DATE(create_by) as order_date FROM `sellerlogin` WHERE status ='1' AND YEAR(create_by) ='".date('Y')."' group by MONTH(create_by)");
        }
		$stmt->execute();
        $data = $stmt->bind_result( $total_seller,$order_date);
		$total_seller=$order_date='';
		$info = array();
        while ($stmt->fetch()) { 
			
			$date = $order_date;
			$info[] = array('date'=> $date,
    	                  'seller' => $total_seller);
		}
    	
		echo  json_encode($info);
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}

 
?>