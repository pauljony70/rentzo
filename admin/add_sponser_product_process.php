<?php
include('session.php');


 include("header.php");

$code = $_POST['code'];
$code= stripslashes($code);  

	if($code==$_SESSION['_token']){
		
		
		$category = $_POST['category'];
		$selectproduct = '';
		if(array_key_exists('selectproduct',$_POST)){
			$selectproduct = implode(',',$_POST['selectproduct']);
		}
		
		
		if(isset($category) ) {
						
			
				$all_product = explode(',',$selectproduct);
				foreach($all_product as $products)
				{
					$stmt11 = $conn->prepare("INSERT INTO `sponsor_product`(`cat_id`, `product_id`) 
							VALUES (?,?)");
				
				$stmt11->bind_param( "ss",$category,$products);
			
				$stmt11->execute();
				$stmt11->store_result();
				}
			
				$msg = "Product added successfully.";	
				
	}else{
		$msg = "Invalid Parameters. Please fill all required fields.";
	}
}

	echo '<script>successmsg1("'.$msg.'","manage_sponsor_product.php"); </script> ';
    die;
    
?>
