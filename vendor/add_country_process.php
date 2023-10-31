<?php

include('session.php');
$code = $_POST['code'];
$country = $_POST['country'];
$country_code = $_POST['country_code'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$country =   stripslashes($country);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($country)   && !empty($country)  && !empty($country_code)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(id) FROM country where (name ='".$country."' OR countrycode ='".$country_code."')");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow>0){
			 echo "Country  Already Exist. ";
		}else{
				
			
			//code for insert record - START
			
			
			$status =0;
			$stmt11 = $conn->prepare("INSERT INTO country( name, countrycode, status)  VALUES (?,?,?)");
			$stmt11->bind_param( "ssi", $country ,$country_code,$status);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Country Added Successfully. Please wait untill Admin Approved. ";
				
			}else{
				echo "Failed to add country";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
