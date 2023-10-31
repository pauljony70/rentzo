<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Brand)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

    $brandid = $_POST['brandid'];    
    $orderno = $_POST['ordernumber']; 
  
    $brandid=    stripslashes( $brandid);
    $orderno =   stripslashes( $orderno);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset( $brandid) && isset( $orderno)&& isset( $brandid) && isset( $orderno)  ) {

    try{
    
        //  echo "inside ".$catimg;
        $stmt11 = $conn->prepare("UPDATE brand SET brand_order =? WHERE brand_id=?");
    	$stmt11->bind_param( ii, $orderno,  $brandid );
		$stmt11->execute();
	    $stmt11->store_result();
    
       //  echo " insert done ";
        $rows=$stmt11->affected_rows;
        if($rows>0){
             echo "Update Successfully ";
             
         }else{
             echo "Failed to Update. Please try again";
         }	
        
    }//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    
}   


?>