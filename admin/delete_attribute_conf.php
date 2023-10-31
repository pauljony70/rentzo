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
           
		$stmt = $conn->prepare("SELECT id FROM product_attribute WHERE prod_attr_id=? ");
		$stmt->bind_param( "i",  $deletearray );
		$stmt->execute();	 
		$return = array();
		
		$stmt->bind_result (  $col55);
        
		$exist = "N";		
        while($stmt->fetch() ){
            $totalrow = $col55;  
			$exist = "Y";			
        }
		
		if($exist == "Y"){
			echo "This Attribute already assign to some products.You can't delete the brand if it is assign to a product. Please delete product first";
		}else{
			$Common_Function->delete_attribute_conf($deletearray, $conn);
		}
        die;
    }
} 
?>
