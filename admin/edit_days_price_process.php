<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$update_days = $_POST['update_days'];
$update_price = $_POST['update_price'];

$days_id = $_POST['days_id'];
$statuss = $_POST['statuss'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$update_days =   stripslashes($update_days);
$img =   stripslashes($img);
$days_id =   stripslashes($days_id);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($update_days) && isset($statuss) ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(days_id) FROM days_price where days ='".$update_days."' AND days_id !='".$days_id."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow == 0){
		
			$stmt11 = $conn->prepare("UPDATE days_price SET days =? ,price = ?, status =? WHERE days_id ='".$days_id."'");
			$stmt11->bind_param( "ssi", $update_days, $update_price ,$statuss);
			
			
			//code for insert record - START
			
			
			$orderid =0;
			
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
		
				echo "Days Price Updated Successfully. ";
			
			
			//code for insert record - END
		}else{
			echo "Tax Class already exist. ";
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
