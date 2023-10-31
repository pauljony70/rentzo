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

	$deletearray=   stripslashes($deletearray);



 

   

   if(isset($deletearray) &&!empty( $deletearray)  ) {

           

		$stmt = $conn->prepare("SELECT id FROM firebase_notification WHERE id=? ");

		$stmt->bind_param( "i",  $deletearray );

		$stmt->execute();	 

		$data = $stmt->bind_result( $id);

		$return = array();

		

		$product_count = "N";

		

		while ($stmt->fetch()) { 

		   $product_count = "Y";

		  

		}

		

				

			$Common_Function->delete_notification_set($deletearray, $conn);

		    	 

        

        die;

    }else{

       

    }

} else if( $code == $_SESSION['_token'] && isset($_POST['delete_attribute_id']) && isset($_POST['attribute_assign_id'])){

	$stmt11 = $conn->prepare("UPDATE product_details SET attr_set_id =? WHERE attr_set_id = '".trim($_POST['delete_attribute_id'])."'");

    $stmt11->bind_param( "i", trim($_POST['attribute_assign_id']));

    $stmt11->execute();

    $rows=$stmt11->affected_rows;

	$Common_Function->delete_product_attribute_set($_POST['delete_attribute_id'], $conn);

}

?>

