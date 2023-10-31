<?php

include('session.php');



if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){

	echo "<script>location.href='no-premission.php'</script>";die();

}

$code = $_POST['code'];



$code=  stripslashes($code);



//echo "admin is ".$_SESSION['admin'];

if(!isset($_SESSION['admin'])){

  header("Location: index.php");

 // echo " dashboard redirect to index";

}else if( $code == $_SESSION['_token'] && isset($_POST['deletearray'])){

    



    $deletearray = $_POST['deletearray'];
    $hsn_code = $_POST['hsn_code'];

	$deletearray=   stripslashes($deletearray);



 

   

   if(isset($deletearray) &&!empty( $deletearray)  ) {

           

		$stmt = $conn->prepare("SELECT product_hsn_code FROM product_details WHERE product_hsn_code=? ");

		$stmt->bind_param( "i",  $hsn_code );

		$stmt->execute();	 

		$return = array();

		

		$stmt->bind_result (  $col55);

        

		$exist = "N";		

        while($stmt->fetch() ){

            $totalrow = $col55;  

			$exist = "Y";			

        }

		

		if($exist == "Y"){

			echo "This HSN Code already assign to some products.You can't delete the HSN Code if it is assign to a product. Please delete product first";

		}else{

			$Common_Function->delete_hsncode($deletearray, $conn);

		}

        die;

    }

} 

?>

