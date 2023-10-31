<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

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
			
			
			$orderid =0;
			$stmt11 = $conn->prepare("INSERT INTO country( name, countrycode)  VALUES (?,?)");
			$stmt11->bind_param( "ss", $country ,$country_code);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Country Added Successfully. ";
				
			}else{
				echo "Failed to add Country";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
