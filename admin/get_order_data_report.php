<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Order)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code  = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$perpage = $_POST['perpage'];

$order_id = $_POST['order_id'];
$seller_id = $_POST['seller_value'];
$export_data = $_POST['export_data'];
$export_data = $_POST['export_data'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];


$error = ''; // Variable To Store Error Message

$code = stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);
$perpage =  stripslashes($perpage);

$order_id =  stripslashes($order_id);
$seller_id =  stripslashes($seller_id);
$export_data =  stripslashes($export_data);
$from_date =  stripslashes($from_date);
$to_date =  stripslashes($to_date);

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
		if($order_id != ''){
			$order_id_qry .= " and o.order_id like '%".$order_id."%' OR o.payment_id like '%".$order_id."%' or sl.companyname like '%".$order_id."%'";
		}
		if($seller_id != ''){
			$order_id_qry .= " and op.vendor_id = '".$seller_id."'";
		}
		if($from_date != '' && $to_date){
			$order_id_qry .= ' and DATE(o.create_date) between "'.$from_date.'"  AND "'.$to_date.'"';
		}
		
		
		
     
           
          $stmt = $conn->prepare("SELECT o.order_id,o.user_id,o.status, o.total_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date,
							o.discount,o.total_qty,op.vendor_id,sl.companyname FROM orders o join order_product op join sellerlogin sl WHERE op.order_id = o.order_id and sl.seller_unique_id = op.vendor_id  ".$order_id_qry."  ORDER BY o.sno DESC LIMIT ?, ?");
       
	   $stmt ->bind_param("ii", $start, $limit);
            
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12 , $col13 );
           $return = array();
    	   $i =0;
       
          //echo " get col data ";
    	   while ($stmt->fetch()) {    
    	   	  	$Exist = true;
				$user_type = '';
				
				if($col2){
					$user_type = 'App User';
				}else{
					$user_type = 'Website';
				}
        	   	$return[$i] = 
        					array(	
        						'orderid' => $col1,
        						'vender_id' => $col13,
        						 'user_type' =>$user_type,
        						 'user_id' => $col2,
        						 'order_status' => $col3,
        						 'total_price' => $col4,
        						 'payment_orderid' => $col5,
              		  			 'payment_id' => $col6,
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
		
			 
            $stmt12 = $conn->prepare("SELECT count(sno) FROM orders o join order_product op WHERE op.order_id = o.order_id  ".$order_id_qry."");
            
         
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