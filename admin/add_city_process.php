<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$city = $_POST['city'];
$stateid = $_POST['stateid'];
$ajax_type = $_POST['ajax_type'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$city =   stripslashes($city);
$ajax_type =   stripslashes($ajax_type);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");die();
 // echo " dashboard redirect to index";
}
if($code == $_SESSION['_token'] && isset($city)   && !empty($city)  && !empty($stateid) && $ajax_type =='add' ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(city_id) FROM city where city_name ='".$city."' AND state_code ='".$stateid."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow>0){
			 echo "City  Already Exist. ";
		}else{
				
			
			//code for insert record - START
			
			
			$orderid =0;
			$stmt11 = $conn->prepare("INSERT INTO city( city_name, state_code)  VALUES (?,?)");
			$stmt11->bind_param( "si", $city ,$stateid);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "City Added Successfully. ";
				
			}else{
				echo "Failed to add city";
			}
			
			//code for insert record - END
		}
    	 
}else if($code == $_SESSION['_token'] && isset($city)   && !empty($city)  && !empty($stateid) && $ajax_type =='update' ) {
	$attribute_id = trim($_POST['attribute_id']);
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(city_id) FROM city where city_id ='".$attribute_id."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow==0){
			 echo "city  not exist. ";
		}else{
				
			 $stmt12 = $conn->prepare("SELECT count(city_id) FROM city where city_name ='".$city."' AND city_id !='".$attribute_id."' ");
     
			$stmt12->execute();
			$stmt12->store_result();
			$stmt12->bind_result (  $col55);
						
			while($stmt12->fetch() ){
				$totalrow = $col55;         
			}
			
			if($totalrow>0){
				echo "city  already exist. ";
			}else{
				//code for insert record - START
				
				
				$orderid =0;
				$stmt11 = $conn->prepare("UPDATE city SET city_name =? WHERE city_id =?");
				$stmt11->bind_param( "si", $city ,$attribute_id);
			
				$stmt11->execute();
				$stmt11->store_result();
				// echo " insert done ";
				$rows=$stmt11->affected_rows;
				if($rows>0){
					echo "City Updated Successfully. ";
					
				}else{
					echo "Failed to add city";
				}
				
				//code for insert record - END
			}
		}
    	 
  }else if($code == $_SESSION['_token'] && $ajax_type =='delete' ) {
	$attribute_id = trim($_POST['deletearray']);
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("DELETE FROM city where city_id ='".$attribute_id."' ");
     
        $stmt12->execute();
       echo "Deleted";
				
    	 
  }else{
            echo "Invalid values.";
    }
    die;
?>
