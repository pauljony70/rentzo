<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$state = $_POST['state'];
$country_id = $_POST['country_id'];
$ajax_type = $_POST['ajax_type'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$state =   stripslashes($state);
$ajax_type =   stripslashes($ajax_type);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");die();
 // echo " dashboard redirect to index";
}
if($code == $_SESSION['_token'] && isset($state)   && !empty($state)  && !empty($country_id) && $ajax_type =='add' ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(stateid) FROM state where name ='".$state."' AND countryid ='".$country_id."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow>0){
			 echo "State  Already Exist. ";
		}else{
				
			
			//code for insert record - START
			
			
			$orderid =0;
			$stmt11 = $conn->prepare("INSERT INTO state( name, countryid)  VALUES (?,?)");
			$stmt11->bind_param( "si", $state ,$country_id);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "State Added Successfully. ";
				
			}else{
				echo "Failed to add State";
			}
			
			//code for insert record - END
		}
    	 
}else if($code == $_SESSION['_token'] && isset($state)   && !empty($state)  && !empty($country_id) && $ajax_type =='update' ) {
	$attribute_id = trim($_POST['attribute_id']);
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(stateid) FROM state where stateid ='".$attribute_id."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow==0){
			 echo "State  not exist. ";
		}else{
				
			 $stmt12 = $conn->prepare("SELECT count(stateid) FROM state where name ='".$state."' AND stateid !='".$attribute_id."' ");
     
			$stmt12->execute();
			$stmt12->store_result();
			$stmt12->bind_result (  $col55);
						
			while($stmt12->fetch() ){
				$totalrow = $col55;         
			}
			
			if($totalrow>0){
				echo "State  already exist. ";
			}else{
				//code for insert record - START
				
				
				$orderid =0;
				$stmt11 = $conn->prepare("UPDATE state SET name =? WHERE stateid =?");
				$stmt11->bind_param( "si", $state ,$attribute_id);
			
				$stmt11->execute();
				$stmt11->store_result();
				// echo " insert done ";
				$rows=$stmt11->affected_rows;
				if($rows>0){
					echo "State Updated Successfully. ";
					
				}else{
					echo "Failed to add State";
				}
				
				//code for insert record - END
			}
		}
    	 
  }else if($code == $_SESSION['_token'] && $ajax_type =='delete' ) {
	$attribute_id = trim($_POST['deletearray']);
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("DELETE FROM state where stateid ='".$attribute_id."' ");
     
        $stmt12->execute();
       echo "Deleted";
				
    	 
  }else{
            echo "Invalid values.";
    }
    die;
?>
