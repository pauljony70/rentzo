<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$country_code = $_POST['country_code'];
$update_country = $_POST['update_country'];

$attribute_id = $_POST['attribute_id'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$update_country =   stripslashes($update_country);

$attribute_id =   stripslashes($attribute_id);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($update_country)   && !empty($country_code) && !empty($attribute_id)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(id) FROM country where (name ='".$update_country."' OR countrycode ='".$country_code."')  AND id !='".$attribute_id."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow == 0){
		
			$stmt11 = $conn->prepare("UPDATE country SET name =? ,countrycode = ? WHERE id ='".$attribute_id."'");
			$stmt11->bind_param( "ss", $update_country, $country_code );
			
			
			//code for insert record - START
			
			
			$orderid =0;
			
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Country Updated Successfully. ";
				
			}else{
				echo "failed to add brand";
			}
			
			//code for insert record - END
		}else{
			echo "Country already exist. ";
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
