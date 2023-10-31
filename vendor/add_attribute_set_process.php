<?php

include('session.php');
$code = $_POST['code'];
$name = $_POST['namevalue'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$name =   stripslashes($name);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($name)   && !empty($name)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(sno) FROM attribute_set where name ='".$name."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow>0){
			 echo "Attribute Set Name Already Exist. ";
		}else{
			
			
			
			//code for insert record - START
			
			
			$status =0;
			$stmt11 = $conn->prepare("INSERT INTO attribute_set( name,status ,created_at,created_by )  VALUES (?,?,?,?)");
			$stmt11->bind_param( "siss", $name , $status,$datetime,$_SESSION['admin'] );
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Attribute Set Added Successfully. Please wailt untill Admin Apporved.";
				
				$link = BASEURL."admin/pending_attribute_set.php";	
				$Common_Function->send_email_seller_new($conn,$_SESSION['seller_name'],$link,'Attribute Set', "New Attribute Set Request",$name);
				
			}else{
				echo "Failed to add Attribute";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
