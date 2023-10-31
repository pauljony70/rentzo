<?php
include('session.php');


 include("header.php");

$code = $_POST['code'];
$code= stripslashes($code);  

	if($code==$_SESSION['_token']){
		
		$datetime = date('Y-m-d H:i:s');
		$selectuser = $_POST['selectuser'];
		$title = $_POST['title'];
		$rating = $_POST['rating'];
		$comment = $_POST['comment'];
		$status = 1;
		$selectproduct = '';
		if(array_key_exists('selectproduct',$_POST)){
			$selectproduct = implode(',',$_POST['selectproduct']);
		}
		
		
		if(isset($selectuser) ) {
						
			
				$all_product = explode(',',$selectproduct);
				foreach($all_product as $products)
				{
					$stmt11 = $conn->prepare("INSERT INTO `product_review`(`user_id`,`rating`,`title`,`comment`,`created_at`,`product_id`,`status`) 
							VALUES (?,?,?,?,?,?,?)");
				
				$stmt11->bind_param( "sssssss",$selectuser,$rating,$title,$comment,$datetime,$products,$status);
			
				$stmt11->execute();
				$stmt11->store_result();
				}
			
				$msg = "Product Review added successfully.";	
				
	}else{
		$msg = "Invalid Parameters. Please fill all required fields.";
	}
}

	echo '<script>successmsg1("'.$msg.'","manage_review.php"); </script> ';
    die;
    
?>
