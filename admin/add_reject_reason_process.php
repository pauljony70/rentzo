<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$StoreSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$name = $_POST['namevalue'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$name =   stripslashes($name);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($name)   && !empty($name) && $_POST['type'] =='add' ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(sno) FROM seller_flag_reason where reason ='".$name."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow>0){
			 echo "Reject Reason Already Exist. ";
		}else{
			
			
			
			//code for insert record - START
			
			
			$orderid =0;
			$stmt11 = $conn->prepare("INSERT INTO seller_flag_reason( reason )  VALUES (?)");
			$stmt11->bind_param( "s",  $name);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Reject Reason Added Successfully. ";
				
			}else{
				echo "Failed to add Reject Reason";
			}
			
			//code for insert record - END
		}
    	 
    }else if($code == $_SESSION['_token'] && isset($name)   && !empty($name) && $_POST['type'] =='update' ) {
		$attribute_id = $_POST['attribute_id'];
      //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(sno) FROM seller_flag_reason where reason ='".$name."' AND sno !='".$attribute_id."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow == 0){
		
			$stmt11 = $conn->prepare("UPDATE seller_flag_reason SET reason =?  WHERE sno ='".$attribute_id."'");
			$stmt11->bind_param( "s",  $name );
			
			
			//code for insert record - START
			
			
			$orderid =0;
			
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
		
			echo "Reject Reason Updated Successfully. ";
				
			
			//code for insert record - END
		}else{
			echo "Reject Reason already exist. ";
		}
    	 
		
		
    	 
    }else if($code == $_SESSION['_token'] && $_POST['type'] =='delete' ) {
		$deletearray = $_POST['deletearray'];
		$deletearray=   stripslashes($deletearray);
		$Common_Function->delete_product_reject_reason($deletearray, $conn);
		
	}else{
            echo "Invalid values.";
    }
    die;
?>
