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

			$order_id_qry = " and o.order_id like '%".$order_id."%' OR o.payment_id like '%".$order_id."%' ";

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

		
          $stmt = $conn->prepare("SELECT pm.id,pm.seller_id,pm.amount,pm.from_date,pm.to_date,pm.payment_status,pm.transection_id,sl.companyname FROM payment pm,sellerlogin sl WHERE sl.seller_unique_id = pm.seller_id   ".$order_status_qry." ".$order_date_qry."ORDER BY pm.id ASC LIMIT ?, ?");

       

	   $stmt ->bind_param("ii", $start, $limit);

            

    	   $stmt->execute();	 

     	   $data = $stmt->bind_result( $id,$seller_id, $amount, $from_date, $to_date, $status, $transection_id,$companyname);

           $return = array();

    	   $i =0;
 
       

          //echo " get col data ";

    	   while ($stmt->fetch()) {    

    	   	  	$Exist = true;

				$user_type = '';

				$return[$i] = 

        					array(	

        						'id' => $id,
        						'seller_id' => $seller_id,

        						 'amount' =>$amount,

        						 'date_range' => date('d-m-Y',strtotime($from_date)).' TO '.date('d-m-Y',strtotime($to_date)),

        						 'payment_status' => $status,

        						 'companyname' => $companyname,

        						 'transection_id' => $transection_id

        						 


								 );      

              		  			 

              		   $i = $i+1;  			  


    	    }

		
            $stmt12 = $conn->prepare("SELECT count(*) FROM payment pm,sellerlogin sl WHERE sl.seller_unique_id = pm.seller_id  ".$order_status_qry." ".$order_date_qry." ");

            

         

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