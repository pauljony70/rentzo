<?php
 
include('session.php');
$code  = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$perpage = $_POST['perpage'];
$selectstatus = $_POST['selectstatus'];

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
        $i = 0;
		$order_id_qry = $order_id_qry1 ="";
		if($order_id){
			$order_id_qry = " AND op.order_id like '%".$order_id."%'";
		
		}
		
		$order_status_qry='';
		if($selectstatus=='completed'){
			$order_status_qry = " AND  op.status ='Delivered' ";
		}else if($selectstatus=='pending'){
			$order_status_qry = " AND op.status ='Placed' ";
		}if($selectstatus=='cancelled'){
			$order_status_qry = " AND op.status ='Cancelled' ";
		}
     
           
          $stmt = $conn->prepare("SELECT op.prod_id,op.prod_sku,op.prod_name,op.prod_img,op.prod_attr,op.qty,op.prod_price,op.shipping,op.discount,op.status,op.order_id ,op.create_date
            FROM  `order_product` op  WHERE op.status ='Packed' ".$order_id_qry." ".$order_status_qry." ORDER BY op.id DESC LIMIT ?, ?");
       
	   $stmt ->bind_param("ii", $start, $limit);
            
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10 , $col11 , $col12 );
           $return = array();
    	   $i =0;
       
          //echo " get col data ";
    	   while ($stmt->fetch()) {    
    	   	  	$Exist = true;
				
				$prod_attr= '';
				if($col5){
					$attr = json_decode($col5);
					$attribute = '';
					foreach($attr as $prod_attr){
						$attribute .= $prod_attr->attr_name.': '.$prod_attr->item.', ';
					}
					
					$prod_attr = rtrim($attribute,', ');
				}
				if($col10 =='Delivered'){$order_status='Completed';}else{ $order_status=$col10;}
        	   	$return[$i] = 
        					array(	
        						'prod_id' => $col1,
        						 'prod_sku' => $col2,
        						 'prod_name' => $col3,
        						 'prod_img' => MEDIAURL.$col4,
        						 'prod_attr' => $prod_attr,
              		  			 'qty' => $col6,
              		  			 'prod_price' => $col7,
              		  			 'shipping' => $col8,
              		  			 'discount' =>  $col9,
              		  	         'order_status' =>$order_status,
              		  	         'prod_mrp' => ($col7+$col9),
              		  	         'orderid' => $col11,
              		  	         'create_date' => $col12
              		  			

								 );        /// status  = 0 -pending  1 accepted , 2 reject, 
              		  			 
              		   $i = $i+1;  			  
                //echo " array created".json_encode($return);
    	    }
		
			 
            $stmt12 = $conn->prepare("SELECT count(id) FROM order_product op WHERE  op.status ='Packed'  ".$order_id_qry." ".$order_status_qry."");
            
         
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