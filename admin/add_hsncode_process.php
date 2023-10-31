<?php

include('session.php');



if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){

	echo "<script>location.href='no-premission.php'</script>";die();

}



$code = $_POST['code'];

$hsn_code = $_POST['hsn_code'];





$error='';  // Variable To Store Error Message

$code=   stripslashes($code);

$hsn_code =   stripslashes($hsn_code);





if(!isset($_SESSION['admin'])){

  header("Location: index.php");

 // echo " dashboard redirect to index";

}else

if($code == $_SESSION['_token'] && isset($hsn_code)   && !empty($hsn_code)  ) {

       //code for Check Brand Exist - START

	   $stmt12 = $conn->prepare("SELECT count(id) FROM product_hsn_code where hsn_code ='".$hsn_code."' ");

     

        $stmt12->execute();

        $stmt12->store_result();

        $stmt12->bind_result (  $col55);

                	 

        while($stmt12->fetch() ){

            $totalrow = $col55;         

        }

		

		//code for Check Brand Exist - END

		if($totalrow>0){

			 echo "HSN Code  Already Exist. ";

		}else{

				

			

			//code for insert record - START

			

			

			$orderid =0;

			$stmt11 = $conn->prepare("INSERT INTO product_hsn_code ( hsn_code)  VALUES (?)");

			$stmt11->bind_param( "s", $hsn_code );

		

			$stmt11->execute();

			$stmt11->store_result();

			// echo " insert done ";

			$rows=$stmt11->affected_rows;

			if($rows>0){

				echo "HSN Code Added Successfully. ";

				

			}else{

				echo "Failed to add HSN Code";

			}

			

			//code for insert record - END

		}

    	 

    }else{

            echo "Invalid values.";

    }

    die;

?>

