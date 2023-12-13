<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$update_title = $_POST['update_title'];
$update_desc = $_POST['update_desc'];

$faq_id = $_POST['faq_id'];
$statuss = $_POST['statuss'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$update_title =   stripslashes($update_title);
$img =   stripslashes($img);
$faq_id =   stripslashes($faq_id);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($update_title) && isset($statuss) ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(id) FROM faq where title ='".$update_title."' AND id !='".$faq_id."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow == 0){
		
			$stmt11 = $conn->prepare("UPDATE faq SET title =? ,description = ?, status =? WHERE id ='".$faq_id."'");
			$stmt11->bind_param( "ssi", $update_title, $update_desc ,$statuss);
			
			
			//code for insert record - START
			
			
			$orderid =0;
			
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
		
				echo "FAQ Updated Successfully. ";
			
			
			//code for insert record - END
		}else{
			echo "FAQ already exist. ";
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
