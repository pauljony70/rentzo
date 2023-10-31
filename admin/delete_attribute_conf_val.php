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
    $name = $_POST['name'];
    $main_attribute_id = $_POST['main_attribute_id'];
	$deletearray=   stripslashes($deletearray);
	$name =  stripslashes($name);

 
   
   if(isset($deletearray) && !empty( $deletearray) && !empty( $name)  ) {
          
		$stmt = $conn->prepare("SELECT count(id)FROM product_attribute where prod_attr_id ='".$main_attribute_id."'
							AND attr_value like '%\"".$name."\"%'");
		
		$stmt->execute();	 
		$return = array();
		
		$stmt->bind_result (  $col55);
        
		$exist = "N";		
        while($stmt->fetch() ){
            $totalrow = $col55;  
					
        }
		
		if($totalrow >0){
			echo "Attribute in Product. Please delete product first";
		}else{
			$Common_Function->delete_attribute_conf_val($deletearray, $conn);
		}
        die;
    }
} 
?>
