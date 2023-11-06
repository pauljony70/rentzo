<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
$code = $_POST['code'];
$days = $_POST['days'];
$price = $_POST['price'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$days =   stripslashes($days);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($days)  && !empty($price)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(days_id) FROM days_price where days ='".$days."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow>0){
			 echo "Tax Class  Already Exist. ";
		}else{
				
			
			//code for insert record - START
			
			
			$orderid =0;
			$stmt11 = $conn->prepare("INSERT INTO days_price( days, price,created_at,created_by )  VALUES (?,?,?,?)");
			$stmt11->bind_param( "ssss", $days, $price,$datetime,$_SESSION['admin'] );
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Days Price Added Successfully. ";
				
			}else{
				echo "Failed to add Days Price";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
