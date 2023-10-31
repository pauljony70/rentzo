<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Order)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code  = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$perpage = $_POST['perpage'];
$selectstatus = $_POST['orderstatus'];

$order_id = $_POST['order_id'];
$error = ''; // Variable To Store Error Message

$code = stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);
$perpage =  stripslashes($perpage);

$order_id =  stripslashes($order_id);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}
else if($code == $_SESSION['_token']){
    
    try{
    
        $Exist = false;
        $status =0;
        $information = array();
        $prodstatus = "active";
		if($_POST['perpage']){
			$limit = $_POST['perpage']; 
		}else{
			$limit = 10; 
		}
	   
        $start = ($page - 1) * $limit; 
        $totalrow =0;
		
        
        $return = array();
        $i      = 0;
		$order_id_qry = "";
		if($order_id){
			$order_id_qry = " and o.order_id like '%".$order_id."%' OR o.payment_id like '%".$order_id."%' ";
		}
     
		$order_status_qry='';
		if($selectstatus=='completed'){
			$order_status_qry = " AND  o.status ='Delivered' ";
		}else if($selectstatus=='pending'){
			$order_status_qry = " AND o.status ='Placed' ";
		}if($selectstatus=='cancelled'){
			$order_status_qry = " AND o.status ='Cancelled' ";
		}
		//echo "SELECT o.order_id,o.user_id,o.status, o.total_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date,
							//o.discount,o.total_qty FROM orders o WHERE 1=1  ".$order_id_qry." ".$order_status_qry." ORDER BY o.sno DESC LIMIT 1,10";
							//die;
           
          $stmt = $conn->prepare("SELECT o.order_id,o.user_id,o.status, o.total_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date,
							o.discount,o.total_qty,db.delivery_boy,dl.fullname FROM orders o  RIGHT join order_product op on op.order_id  = o.order_id join delivery_boy_orders db on db.order_id = o.order_id join deliveryboy_login dl on dl.deliveryboy_unique_id = db.delivery_boy  WHERE 1=1  ".$order_id_qry." ".$order_status_qry." ORDER BY o.sno DESC LIMIT ?, ?");
       
	   $stmt ->bind_param("ii", $start, $limit);
            
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11,$col12,$col13 );
           $return = array();
    	   $i =0;
       
          //echo " get col data ";
    	   while ($stmt->fetch()) {    
    	   	  	$Exist = true;
				$user_type = '';
				
				
				
				if($col2){
					$user_type = 'App User';
				}else{
					$user_type = 'Guest';
				}
        	   	$return[$i] = 
        					array(	
        						'orderid' => $col1,
        						 'user_type' =>$user_type,
        						 'user_id' => $col2,
        						 'order_status' => $col3,
        						 'total_price' => $col4,
        						 'payment_orderid' => $col5,
              		  			 'payment_id' => $col13,
              		  			 'payment_mode' => $col7,
              		  			 'qoute_id' => $col8,
              		  			 'create_date' =>  $col9,
              		  	         'discount' => $col10,
              		  			 'payment_status' => 'Paid',	
              		  			 'total_qty' => $col11	

								 );        /// status  = 0 -pending  1 accepted , 2 reject, 
              		  			 
              		   $i = $i+1;  			  
                //echo " array created".json_encode($return);
    	    }
		
			 
            $stmt12 = $conn->prepare("SELECT count(sno) FROM orders o  WHERE 1=1  ".$order_id_qry." ".$order_status_qry."");
            
         
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col21);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col21;
        }
    
        if( $Exist){
            $page_html =  $Common_Function->pagination('order_product',$page,$limit,$totalrow); 
			echo json_encode(array("status"=>1,"page_html" =>$page_html,"details"=>$return,"totalrowvalue"=>$totalrow));
	                        
         }else{
             echo json_encode(array("status"=>0,"page_html" =>'',"details"=>$return,"totalrowvalue"=>$totalrow));
         }
         
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>