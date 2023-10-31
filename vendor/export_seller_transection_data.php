<?php
if (isset($_POST["csv"])) {
   header("Content-Type: text/csv");
   header("Content-Disposition: attachment; filename=myTable.csv");

   echo $_POST["csv"];
}
exit;
?>

<?php

include('session.php');


$code  = $_POST['code'];

$selectstatus = $_POST['orderstatus'];

$from_date = $_POST['from_date'];

$to_date = $_POST['to_date'];

$seller_id = $_POST['seller_id'];

$export_data = $_POST['export_data'];



$order_id = $_POST['order_id'];

error_reporting(0);


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

			$order_status_qry = " AND  o.status ='Delivered' ";

		}else if($selectstatus=='pending'){

			$order_status_qry = " AND o.status ='Placed' ";

		}if($selectstatus=='cancelled'){

			$order_status_qry = " AND o.status ='Cancelled' ";

		}


			 $excet_qry = $conn->prepare("SELECT o.order_id,o.user_id,o.status, o.total_price, o.payment_orderid,o.payment_id,o.payment_mode,o.qoute_id,o.create_date,

							o.discount,o.total_qty,sum(op.seller_price),sum(op.admin_profit),sum(op.tds),sum(op.tcs),sum(op.gross_amount),sum(op.gst_input),sum(op.net_amount) FROM orders o,order_product op WHERE op.order_id = o.order_id  ".$order_id_qry." ".$order_status_qry." ".$order_date_qry." and op.vendor_id='".$seller_id."' group by op.order_id ORDER BY o.sno DESC");

       


    	   $excet_qry->execute();	 

     	   $excet_qry_data = $excet_qry->bind_result( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11 ,$seller_price,$admin_profit,$tds,$tcs,$gross_amount,$gst_input,$net_amount );
			 
			 
			 
			 $columnHeader = '';  
			$columnHeader = "Order ID" . "\t" . "Marurang Price" . "\t" . "TDS" . "\t". "TCS" . "\t". "Gross Amount" . "\t". "GST Input" . "\t". "Net Amount" . "\t". "Quantity" . "\t". "Payment Mode" . "\t". "Order Date" . "\t". "Payment Status" . "\t". "Order Status" . "\t";  
			$setData = '';  

			 
			 
			 $rowData = '';  
				 
			 while ($excet_qry->fetch()) {  
			 
			     
				 $rowData .= '"' . $col1 . '"' . "\t".'"' . $seller_price . '"' . "\t".'"' . round($tds,2) . '"' . "\t".'"' . round($tcs,2) . '"' . "\t".'"' . round($gross_amount,2) . '"' . "\t".'"' . round($gst_input,2) . '"' . "\t".'"' . round($net_amount,2) . '"' . "\t".'"' . $col11 . '"' . "\t".'"' . $col7 . '"' . "\t".'"' . date('d-m-Y',strtotime($col9)) . '"' . "\t".'"Paid"' . "\t".'"' . $col3 . '"' . "\t";  

			} 
			$setData .= trim($rowData) . "\n";
			
			header("Content-type: application/csv");  
			header("Content-Disposition: attachment; filename=User_Detail.csv");  
			header("Pragma: no-cache");  
			header("Expires: 0");  
			echo ucwords($columnHeader) . "\n" . $setData . "\n"; 
			 
		
