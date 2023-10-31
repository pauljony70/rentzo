<?php

include('session.php');





$code = $_POST['code'];

$transection_id = $_POST['transection_id'];

$paymant_id = $_POST['paymant_id'];
$seller_id = $_POST['seller_id'];





$error=''; 

$code=   stripslashes($code);

$transection_id =   stripslashes($transection_id);

$paymant_id =   stripslashes($paymant_id);





if(!isset($_SESSION['admin'])){

  header("Location: index.php");

 // echo " dashboard redirect to index";

}else

if($code == $_SESSION['_token'] && isset($transection_id)   && !empty($transection_id)  ) {



			$invoice_proof ='';

			if($_FILES['invoice_proof']['name']){

				$Common_Function->img_dimension_arr = $img_dimension_arr;

				$invoice_proof1 = $Common_Function->file_upload('invoice_proof',$media_path);

				$invoice_proof = json_encode($invoice_proof1);

			}
			
			$datetime = date('Y-m-d H:i:s');


			$orderid =0;

			$status = 'paid';

			
			$stmt11 = $conn->prepare("UPDATE payment SET transection_id =?, invoice_proof =? , payment_status =? ,update_date=?  WHERE id ='".$paymant_id."'");

			$stmt11->bind_param( "ssss",  $transection_id,$invoice_proof,$status,$datetime );


			
			$stmt11->execute();

			$stmt11->store_result();


			$rows=$stmt11->affected_rows;

			if($rows>0){

				echo "Added New Payment Successfully. ";

				

			}else{

				echo "failed to add brand";

			}

			


    	 

    }else{

            echo "Invalid values.";

    }

    die;

?>

