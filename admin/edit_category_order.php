<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Category)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

    $catid = $_POST['catid'];    
    $orderno = $_POST['ordernumber']; 
  
    $catid=    stripslashes( $catid);
    $orderno =   stripslashes( $orderno);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset( $catid) && isset( $orderno)&& isset( $catid) && isset( $orderno)  ) {

    try{
    
        //  echo "inside ".$catimg;
        $stmt11 = $conn->prepare("UPDATE category SET cat_order =? WHERE cat_id=?");
    	$stmt11->bind_param( ii, $orderno,  $catid );
		$stmt11->execute();
	    $stmt11->store_result();
    
       //  echo " insert done ";
        $rows=$stmt11->affected_rows;
        if($rows>0){
             echo " Category has update Successfully ";
             
         }else{
             echo "Failed to Update Category. Please try again";
         }	
        
    }//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    
}   


?>