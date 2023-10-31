<?php

include('session.php');
$code = $_POST['code'];
$name = $_POST['namevalue'];
$tax_label = $_POST['tax_label'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$name =   stripslashes($name);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($name) ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(tax_id) FROM tax where name ='".$name."' ");
     
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
			
			
			$status =0;
			$stmt11 = $conn->prepare("INSERT INTO tax( name, percent,status,created_at,created_by)  VALUES (?,?,?,?,?)");
			$stmt11->bind_param( "siiss", $tax_label, $name ,$status,$datetime,$_SESSION['admin'] );
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Tax Class Added Successfully. Please wait untill Admin Approved. ";
				
				$link = BASEURL."admin/pending_tax.php";	
				$Common_Function->send_email_seller_new($conn,$_SESSION['seller_name'],$link,'Tax Class', "New Tax Class Request",$tax_label);
				
			}else{
				echo "Failed to add Tax Class";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
