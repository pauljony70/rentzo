<?php

include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");

}else{
    $prod_id = $_POST['prod_id'];
      $prod_id=   stripslashes( $prod_id);

   if( isset($prod_id) &&!empty( $prod_id)  ) {
           
           
	                $stmt = $conn->prepare("SELECT prod_img_url FROM productdetails WHERE prod_id=?");
                    $stmt->bind_param("s", $prod_id);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($col1);
                            
                while ($stmt->fetch()) {
              	 		//$rowProdJsonArray = $col1;
            	 		echo $col1;
                
                }
        	
        die;
    }else{
        			    echo "Failed to get image.";
    }
}    
?>
