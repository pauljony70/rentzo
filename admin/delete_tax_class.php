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
           
		$stmt = $conn->prepare("UPDATE  vendor_product SET product_tax_class = '0' WHERE product_tax_class=? ");
		$stmt->bind_param( "i",  $deletearray );
		$stmt->execute();	 
		$return = array();
			 
        $Common_Function->delete_product_tax_class($deletearray, $conn);
        die;
    }
} 
?>
