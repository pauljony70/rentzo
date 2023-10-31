<?php

include('session.php');





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

			$order_id_qry = " and o.order_id like '%".$order_id."%' OR o.payment_id like '%".$order_id."%' ";

		}

		$order_date_qry = '';

		if($from_date != '' && $to_date != '')
		{
			
			$order_date_qry = " and  date(o.create_date) >=  '".$from_date."' and date(o.create_date) <= '".$to_date."' ";
			
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
		
		$data_qyery = " and op.status != 'Delivered' and op.status != 'Placed' and op.status != 'Shipped' ";
		
		if($export_data == 1)
		{
			 
			
			 
		}
		

		//echo "SELECT o.order_id,o.user_id,o.status, o.total_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date,

							//o.discount,o.total_qty FROM orders o WHERE 1=1  ".$order_id_qry." ".$order_status_qry." ORDER BY o.sno DESC LIMIT 1,10";

							//die;

           

          $stmt = $conn->prepare("SELECT o.order_id,o.user_id,op.status, o.total_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date,

							o.discount,o.total_qty,op.seller_price,op.admin_profit,op.tds,op.tcs,op.gross_amount,op.gst_input,op.net_amount,op.product_hsn_code,sl.fullname,st.name,sl.pincode,op.taxable_amount,tx.percent,op.prod_price,o.pincode,op.cgst,op.sgst,op.igst,op.reverse_shipping FROM orders o,order_product op,sellerlogin sl,state st,vendor_product vp,tax tx WHERE op.order_id = o.order_id and sl.seller_unique_id = op.vendor_id and st.stateid = sl.state and vp.product_id = op.prod_id and tx.tax_id = vp.product_tax_class ".$order_id_qry." ".$order_status_qry." ".$data_qyery." ".$order_date_qry." and op.vendor_id='".$seller_id."' group by op.prod_id ORDER BY o.sno DESC LIMIT ?, ?");

       

	   $stmt ->bind_param("ii", $start, $limit);

            

    	   $stmt->execute();	 

     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11 ,$seller_price,$admin_profit,$tds,$tcs,$gross_amount,$gst_input,$net_amount,$product_hsn_code,$seller_name,$seller_state,$seller_pincode,$taxable_amount,$tax_rate,$prod_price,$customer_pincode,$cgst,$sgst,$igst,$reverse_shipping);

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
				if($cgst == 0)
				{	
					$gst_amount = $igst;
				}
				else
				{
					$gst_amount = $sgst+$cgst;
				}
				
				 $total_amount = round($net_amount,2);
				$gst_rete_reverse = '';
				$gst_on_reverse_shipping = '';
				if($col3 == 'Returned Completed')
				{
					$reverse_shipping = $reverse_shipping;
					$gst_on_reverse_shipping = $reverse_shipping *18/100;
					$gst_rete_reverse = '18%';
					
					$total_amount = round($reverse_shipping + $gst_on_reverse_shipping,2);
				}
				if($col3 == 'Cancelled' || $col3 == 'RTO')
				{
					$total_amount =  '0';
				}

        	   	$return[$i] = 

        					array(	

        						'orderid' => $col1,

        						 'user_type' =>$user_type,

        						 'user_id' => $col2,

        						 'order_status' => $col3,

        						 'total_price' => $seller_price,

        						 'payment_orderid' => $col5,

              		  			 'payment_id' => $col6,

              		  			 'payment_mode' => $col7,

              		  			 'qoute_id' => $col8,

              		  			 'create_date' =>  date('d-m-Y',strtotime($col9)),
              		  			 'create_month' =>  date('M-Y',strtotime($col9)),

              		  	         'discount' => $col10,

              		  			 'payment_status' => 'Paid',	

              		  			 'total_qty' => $col11	,
              		  			 'reverse_shipping' => $reverse_shipping	,
              		  			 'gst_on_reverse_shipping' => $gst_on_reverse_shipping	,
              		  			 'gst_rete_reverse' => $gst_rete_reverse	,
              		  			 'product_hsn_code' => $product_hsn_code	,
              		  			 'seller_name' => $seller_name	,
              		  			 'seller_state' => $seller_state	,
              		  			 'seller_pincode' => $seller_pincode	,
              		  			 'taxable_amount' => $taxable_amount	,
              		  			 'gst_input' => round($gst_input,2)	,
              		  			 'prod_price' => $prod_price	,
              		  			 'customer_pincode' => $customer_pincode	,
              		  			 'gst_amount' => $gst_amount	,
              		  			 'total_amount' => $total_amount	,
              		  			 'tax_rate' => $tax_rate.'%'	,
								 
              		  			 'admin_profit' => round($admin_profit,2) ,
              		  			 'tds' => round($tds,2) ,
              		  			 'tcs' => round($tcs,2) ,
              		  			 'gross_amount' => round($gross_amount,2) ,
              		  			 'net_amount' => round($net_amount,2),
              		  			 'total_billing_value' => $seller_price + round($admin_profit,2)






								 );        /// status  = 0 -pending  1 accepted , 2 reject, 

              		  			 

              		   $i = $i+1;  			  

                //echo " array created".json_encode($return);

    	    }

		
            $stmt12 = $conn->prepare("SELECT count(*) FROM orders o,order_product op WHERE op.order_id = o.order_id  ".$order_id_qry." ".$data_qyery." ".$order_status_qry." ".$order_date_qry." and op.vendor_id='".$seller_id."' group by op.prod_id");

            

         

        $stmt12->execute();

        $stmt12->store_result();

        $stmt12->bind_result (  $col21);

                	 

        while($stmt12->fetch() ){

            $totalrow += $col21;

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