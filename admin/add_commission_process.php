<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Commission)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$price_range_from = stripslashes($_POST['price_range_from']);
$price_range_to = stripslashes($_POST['price_range_to']);
$commission_percentage = stripslashes($_POST['commission_percentage']);
$type = stripslashes($_POST['type']);

$error='';  // Variable To Store Error Message


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($price_range_from) && $type =='add_commission'  ) {
       //code for Check seller_commission Exist - START
	   $stmt12 = $conn->prepare("SELECT count(id) FROM seller_commission where price_from ='".$price_range_from."' AND price_to ='".$price_range_to."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check seller_commission Exist - END
		if($totalrow>0){
			 echo "Seller Commission Already Exist. ";
		}else{
						
			//code for insert record - START		
			
			$status =1;
			$stmt11 = $conn->prepare("INSERT INTO seller_commission( price_from, price_to,commission,status,created_at)  VALUES (?,?,?,?,?)");
			$stmt11->bind_param( "sssis",  $price_range_from, $price_range_to,$commission_percentage,$status,$datetime );
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Seller Commission Added Successfully. ";
				
			}else{
				echo "failed to add Seller Commission";
			}
			
			//code for insert record - END
		}
    	 
    }else if($code == $_SESSION['_token'] && isset($price_range_from) && $type =='update_commission'  ) {
		$commission_id = stripslashes($_POST['commission_id']);
		$statuss = stripslashes($_POST['statuss']);
       //code for Check seller_commission Exist - START
	   $stmt12 = $conn->prepare("SELECT count(id) FROM seller_commission where price_from ='".$price_range_from."' AND price_to ='".$price_range_to."' AND id !='".$commission_id."'");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check seller_commission Exist - END
		if($totalrow>0){
			 echo "Seller Commission Already Exist. ";
		}else{
						
			//code for insert record - START		
			
			$stmt11 = $conn->prepare("UPDATE seller_commission SET price_from =?, price_to=?,commission=?,status=?,update_at=? WHERE id=? ");
			$stmt11->bind_param( "sssisi",  $price_range_from, $price_range_to,$commission_percentage,$statuss,$datetime ,$commission_id);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			echo "Seller Commission updated Successfully. ";
			
			
			//code for insert record - END
		}
    	 
    }else if($code == $_SESSION['_token']  && $type =='delete_commission'  ) {
		$commission_id = stripslashes($_POST['deletearray']);
		
		$stmt2 = $conn->prepare("DELETE FROM seller_commission WHERE id = '".$commission_id."'");
		$stmt2->execute();
		
		$rows=$stmt2->affected_rows;
			
		if($rows>0){
			echo "Deleted";
		
		}else{
			echo "Failed to Delete.";
		}
	}else{
            echo "Invalid values.";
    }
    die;
?>
