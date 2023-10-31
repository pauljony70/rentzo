<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$name = $_POST['namevalue'];
$update_label = $_POST['update_label'];

$attribute_id = $_POST['attribute_id'];
$statuss = $_POST['statuss'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$name =   stripslashes($name);
$img =   stripslashes($img);
$attribute_id =   stripslashes($attribute_id);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($name) && isset($statuss) ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(tax_id) FROM tax where percent ='".$name."' AND tax_id !='".$attribute_id."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow == 0){
		
			$stmt11 = $conn->prepare("UPDATE tax SET name =? ,percent = ?, status =? WHERE tax_id ='".$attribute_id."'");
			$stmt11->bind_param( "sii", $update_label, $name ,$statuss);
			
			
			//code for insert record - START
			
			
			$orderid =0;
			
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
		
				echo "Tax Class Updated Successfully. ";
			
			
			//code for insert record - END
		}else{
			echo "Tax Class already exist. ";
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
