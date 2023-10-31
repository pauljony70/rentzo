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

$payment_id = $_POST['payment_id'];



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
		
		$order_date_qry = '';
		 $stmt_pay = $conn->prepare("SELECT seller_id,from_date,to_date FROM payment WHERE id = ".$payment_id."");

    	   $stmt_pay->execute();	 

     	   $data_pay = $stmt_pay->bind_result($seller_id,$from_date, $to_date);


    	   while ($stmt_pay->fetch()) {    


			
			$order_date_qry = " and  date(op.create_date) >=  '".$from_date."' and date(op.create_date) <= '".$to_date."' ";
			
				
			} 
		



        

        $return = array();

        $i      = 0;

		$order_id_qry = "";

		if($order_id){

			$order_id_qry = " and o.order_id like '%".$order_id."%' OR o.payment_id like '%".$order_id."%' ";

		}

     

		$order_status_qry='';

		if($selectstatus=='completed'){

			$order_status_qry = " AND  op.status ='Delivered' ";

		}else if($selectstatus=='pending'){

			$order_status_qry = " AND op.status ='Placed' ";

		}else if($selectstatus=='cancelled'){

			$order_status_qry = " AND op.status ='Cancelled' ";

		} else if($selectstatus=='Shipped'){

			$order_status_qry = " AND op.status ='Shipped' ";
 
		} else if($selectstatus=='Return Request'){

			$order_status_qry = " AND op.status ='Return Request' ";

		}else if($selectstatus=='Returned Completed'){

			$order_status_qry = " AND op.status ='Returned Completed' ";

		} else if($selectstatus=='RTO'){

			$order_status_qry = " AND op.status ='RTO' ";

		}

		//echo "SELECT o.order_id,o.user_id,o.status, o.total_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date,

							//o.discount,o.total_qty FROM orders o WHERE 1=1  ".$order_id_qry." ".$order_status_qry." ORDER BY o.sno DESC LIMIT 1,10";

							//die;

           
		
          $stmt = $conn->prepare("SELECT o.order_id,o.user_id,op.status, o.total_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date,

							o.discount,op.qty,op.tds,op.tcs,op.gross_amount,op.gst_input,op.net_amount,op.prod_id FROM orders o,order_product op WHERE op.order_id =o.order_id ".$order_date_qry."  ".$order_id_qry." ".$order_status_qry." and op.vendor_id = '".$seller_id."'  ORDER BY o.sno DESC LIMIT ?, ?");

       

	   $stmt ->bind_param("ii", $start, $limit);

            

    	   $stmt->execute();	  

     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11,$tds,$tcs,$gross_amount,$gst_input,$net_amount,$prod_id );

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

              		  			 'payment_id' => $col6,

              		  			 'payment_mode' => $col7,

              		  			 'qoute_id' => $col8,

              		  			 'prod_id' => $prod_id,

              		  			 'create_date' =>  date('d-m-Y',strtotime($col9)),

              		  	         'discount' => $col10,

              		  			 'payment_status' => 'Paid',	

              		  			 'tds' => $tds	,
              		  			 'tcs' => $tcs	,
              		  			 'gross_amount' => $gross_amount	,
              		  			 'gst_input' => $gst_input	,
              		  			 'net_amount' => $net_amount	,
              		  			 'total_qty' => $col11	



								 );        /// status  = 0 -pending  1 accepted , 2 reject, 

              		  			 

              		   $i = $i+1;  			  

                //echo " array created".json_encode($return);

    	    }

		

			 

            $stmt12 = $conn->prepare("SELECT count(sno) FROM orders o,order_product op WHERE op.order_id =o.order_id  ".$order_date_qry."  ".$order_id_qry." ".$order_status_qry."");

            

         

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