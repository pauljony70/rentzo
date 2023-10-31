<?php
	include('session.php');
	
	if(!$Common_Function->user_module_premission($_SESSION,$Shipping)){
		echo "<script>location.href='no-premission.php'</script>";die();
	}

	$code = $_POST['code'];
	$page  = $_POST['page'];
	$rowno = $_POST['rowno'];
	
	$code =stripslashes($code);
	$page =  stripslashes($page);
	$rowno =  stripslashes($rowno);
	
$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");die();
 // echo " dashboard redirect to index";
}
if($code == $_SESSION['_token']){
    
    try{
		if($_POST['perpage']){
			$limit = $_POST['perpage']; 
		}else{
			$limit = 10; 
		}
	   
        $start = ($page - 1) * $limit; 
        $totalrow =0;
    
        $status = 0;
        $msg = "Unable to Get Data";
        $return = array();
        
        // echo "class id is  ".$class_id;     
        $inactive = "active";
           $stmt = $conn->prepare("SELECT id,sf.city_id,basic_fee,order_value,big_item_fee,estimated_delivery_time,prime_delivery_time,status,ci.city_name
		   FROM shipping_fees sf INNER JOIN city ci ON sf.city_id = ci.city_id ORDER BY id ASC LIMIT  ".$start.", ".$limit."");
    	   
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
           $return = array();
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	      if($col6<1){$estimated_delivery_time = str_replace(array('0.','.'),'',$col6).' Hours';}else{$estimated_delivery_time =$col6.' Days';}
    	      if($col7<1){$prime_delivery_time = str_replace(array('0.','.'),'',$col7).' Hours';}else{$prime_delivery_time =$col7.' Days';}
        	  
			  $return[$i] = 
        					array(	
        					    'id' => $col1,
        						'city_id' => $col2,
        						'basic_fee' => $col3,
        						'order_value' => $col4,
        						'big_item_fee' => $col5,
        						'estimated_delivery_time' => $estimated_delivery_time,
        						'prime_delivery_time' => $prime_delivery_time,
        						'estimated_delivery' => $col6,
        						'prime_delivery' => $col7,
        						'statuss' => $col8,
        						'city_name' => $col9
								
								);
              		   $i = $i+1;  	
              	$status = 1;
                $msg = "Details here";
               // echo " array created".json_encode($return);
    	    }
    
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg,
                              'data' => $return);
							  
							  
		$stmt12 = $conn->prepare("SELECT count(id) FROM shipping_fees ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
							  
		$page_html =  $Common_Function->pagination('shipping_pagination',$page,$limit,$totalrow); 
		
		echo json_encode(array("status"=>1,"page_html" =>$page_html,"data"=>$return,"totalrowvalue"=>$totalrow));
    	  	
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>