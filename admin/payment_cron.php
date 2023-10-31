<?php

include('session.php');

$to_date = date('Y-m-d');
$from_date = date('Y-m-d', strtotime('-4 days'));
$datetime = date('Y-m-d H:i:s');
$status = '';


			$stmt_seller = $conn->prepare("SELECT seller_unique_id FROM sellerlogin");

    	   $stmt_seller->execute();	 

     	   $data_seller = $stmt_seller->bind_result($seller_id);

			 $stmt_seller->store_result();


    	   while ($stmt_seller->fetch()) {    
				
					$total_amount = 0;
					$stmt_order = $conn->prepare("SELECT op.net_amount FROM orders o,order_product op WHERE op.order_id = o.order_id and op.vendor_id = '".$seller_id."' and  date(op.create_date) >=  '".$from_date."' and date(op.create_date) <= '".$to_date."'");

				   $stmt_order->execute();	


				   $data_order = $stmt_order->bind_result($net_amount);

					 $stmt_order->store_result();

					$rows=$stmt_order->affected_rows;

					if($rows>0){

					   while ($stmt_order->fetch()) {

							$total_amount += $net_amount;
						}

					}
					

					if($total_amount == 0)
					{
						$status = 'No Due';
					}
					else
					{
						$status = 'pending';
					}
					$transection_id = '';
					$invoice_proof = '';
					$update_date = '';
				
					$stmt11 = $conn->prepare("INSERT payment SET seller_id =?, amount =? , from_date =? ,to_date=? ,payment_status=? ,transection_id=? ,invoice_proof=? ,create_date=? ,update_date=?");

			$stmt11->bind_param( "sssssssss",  $seller_id, $total_amount, $from_date, $to_date, $status, $transection_id,$invoice_proof, $datetime,$update_date);

					/* $stmt11 = $conn->prepare("INSERT INTO `payment`(`seller_id`, `amount`, `from_date`, `to_date`, `payment_status`,`transection_id`, `invoice_proof`, `create_date`, `update_date`)  VALUES (?,?,?,?,?,?,?,?,?)");

					 $stmt11->bind_param( 'sssssssss',$seller_id, $total_amount, $from_date, $to_date, $status, $transection_id,$invoice_proof, $datetime,$update_date);*/

					 $stmt11->execute();	

					 $stmt11->store_result();

				
			} 


?>