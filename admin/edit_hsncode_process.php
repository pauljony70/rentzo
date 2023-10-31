<?php

include('session.php');



if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){

	echo "<script>location.href='no-premission.php'</script>";die();

}



$code = $_POST['code'];

$hsn_code = $_POST['hsn_code'];

$hsn_id = $_POST['hsn_id'];

$statuss = $_POST['statuss'];



$error='';  // Variable To Store Error Message

$code=   stripslashes($code);

$hsn_code =   stripslashes($hsn_code);



$hsn_id =   stripslashes($hsn_id);



if(!isset($_SESSION['admin'])){

  header("Location: index.php");

 // echo " dashboard redirect to index";

}else

if($code == $_SESSION['_token']  && !empty($hsn_code) && !empty($hsn_id) && !empty($statuss)  ) {

       //code for Check Brand Exist - START

	   $stmt12 = $conn->prepare("SELECT count(id) FROM product_hsn_code where hsn_code ='".$hsn_code."'  AND id !='".$hsn_id."' ");

     

        $stmt12->execute();

        $stmt12->store_result();

        $stmt12->bind_result (  $col55);

                	 

        while($stmt12->fetch() ){

            $totalrow = $col55;         

        }

		

		//code for Check Brand Exist - END

		if($totalrow == 0){

		

			$stmt11 = $conn->prepare("UPDATE product_hsn_code SET hsn_code =?  , status =?  WHERE id ='".$hsn_id."'");

			$stmt11->bind_param( "si",  $hsn_code,$statuss );

			

			

			//code for insert record - START

			

			

			$orderid =0;

			

		

			$stmt11->execute();

			$stmt11->store_result();

			

			echo "HSN Code Updated Successfully. ";

			

			

			//code for insert record - END

		}else{

			echo "Hsn Code already exist. ";

		}

    	 

    }else{

            echo "Invalid values.";

    }

    die;

?>

