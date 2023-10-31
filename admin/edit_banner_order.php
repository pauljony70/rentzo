<?php
include('session.php');
    $bannerid = $_POST['bannerid'];    
    $orderno = $_POST['ordernumber']; 
  
    $bannerid=    stripslashes( $bannerid);
    $orderno =   stripslashes( $orderno);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset( $bannerid) && isset( $orderno)&& isset($bannerid) && isset( $orderno)  ) {

    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
        //  echo "inside ".$catimg;
        $stmt11 = $conn->prepare("UPDATE banners SET banner_order =? WHERE sno=?");
    	$stmt11->bind_param( ii, $orderno,  $bannerid );
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