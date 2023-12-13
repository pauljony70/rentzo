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

$from_date = $_POST['from_date'];

$to_date = $_POST['to_date'];

$seller_id = $_POST['seller_id'];

$export_data = $_POST['export_data'];



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

			$order_id_qry = " and order_id ='".$order_id."'";

		}

		$order_date_qry = '';

		if($from_date != '' && $to_date != '')
		{
			
			$order_date_qry = " and  date(pm.from_date) >=  '".$from_date."' and date(pm.to_date) <= '".$to_date."' ";
			
		}
		
	 

		$order_status_qry='';

		if($selectstatus=='completed'){

			$order_status_qry = " AND  pm.payment_status ='completed' ";

		}else if($selectstatus=='pending'){

			$order_status_qry = " AND pm.payment_status ='pending' ";

		}
		
		
		if($export_data == 1)
		{
			 
			
			 
		}
		

		//echo "SELECT o.order_id,o.user_id,o.status, o.total_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date,

							//o.discount,o.total_qty FROM orders o WHERE 1=1  ".$order_id_qry." ".$order_status_qry." ORDER BY o.sno DESC LIMIT 1,10";

							//die;

		
          $stmt = $conn->query("SELECT message_id,order_id,product,count(*) as total_msg,created_at FROM `chat_messages` WHERE 1=1  ".$order_id_qry." GROUP by order_id LIMIT $start,$limit");
            
           $return = array();

    	   $i =0;
 
       

          //echo " get col data ";

		  while ($row = $stmt->fetch_assoc()) {
			
				
			$stmt_seen = $conn->query("SELECT admin_seen FROM `chat_messages` where order_id='".$row['order_id']."'");
            
			$seen_count = 0;
			while ($row_seen = $stmt_seen->fetch_assoc()) {
				if($row_seen['admin_seen'] == 0)
				{
					$seen_count++;
				}
				$total_unseen = $seen_count;
			}	
			
				
				

		   

    	   	  	$Exist = true;

				$user_type = '';

				$return[$i] = 

        					array(	

        						'id' => $row['message_id'],
								
        						'order_id' => $row['order_id'],

        						 'product_id' =>$row['product'],

        						 'total_msg' => $total_unseen,


        						 'add_date' => $row['created_at']

        						 


								 );      

              		  			 

              		   $i = $i+1;  			  


    	    }

		
            $stmt12 = $conn->prepare("SELECT count(*) FROM chat_messages WHERE 1=1  ".$order_id_qry." GROUP by order_id");

            

         

        $stmt12->execute();

        $stmt12->store_result();

        $stmt12->bind_result (  $col21);

         $row_count = 1;       	 

        while($stmt12->fetch() ){

            $totalrow = $row_count;
			$row_count++;

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