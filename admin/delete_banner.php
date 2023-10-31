<?php

include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else{
    

    $deletearray = $_POST['deletearray'];
    $deletearray =   stripslashes($deletearray);
   // echo " delete array ".$deletearray ;

   
   if(isset($deletearray) &&!empty( $deletearray)  ) {
           
            //	 $all =implode(',',$deletearray);
            //	echo " -- ".$all;
            
         	     $stmt2 = $conn->prepare("DELETE FROM banners WHERE sno IN( $deletearray )");
        		// $stmt2->bind_param( 's',   $deletearray );
        		 $stmt2->execute();
        		
        		 $rows=$stmt2->affected_rows;
        			
        		if($rows>0){
        			    
        			    echo "Delete Successful. ";
        			 //   inactiveProduct($deletearray, $conn);
        		}else{
        			    echo "Failed to Delete. ";
        		}
            	 
        
        die;
    }else{
        			    echo "Failed to Delete. ";
    }
}    
?>
