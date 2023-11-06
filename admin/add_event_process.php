<?php
include('session.php');


 //include("header.php");

$code = $_POST['code'];
$code= stripslashes($code);  

	if($code==$_SESSION['_token']){
		
		
		$category = $_POST['category'];
		$name = $_POST['name'];
		
		
		$event_image ='';
		if($_FILES['event_image']['name']){
			$Common_Function->img_dimension_arr = $img_dimension_arr;
			$event_image1 = $Common_Function->file_upload('event_image',$media_path);
			$event_image = json_encode($event_image1);
		}
		if(isset($category) ) {
						
				
				$stmt11 = $conn->prepare("INSERT INTO `events`(`name`, `event_image`, `cat_id`) 
							VALUES (?,?,?)");
				
				$stmt11->bind_param( "sss",$name,$event_image,$category);
				
				
				$stmt11->execute();
				$stmt11->store_result();
			
				$msg = "Event added successfully.";	
				
	}else{
		$msg = "Invalid Parameters. Please fill all required fields.";
	}
}

	//echo '<script>successmsg1("'.$msg.'","manage_sponsor_product.php"); </script> ';
	echo 'Event added successfully.';
    die;
    
?>
