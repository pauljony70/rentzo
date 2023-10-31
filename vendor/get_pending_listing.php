<?php
include('session.php');
$code = $_POST['code'];

$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token']){
    
    try{
    
        $cat = array();
        // echo "class id is  ".$class_id;     
           $inactive = "inactive";
           $stmt = $conn->prepare("SELECT ct.*, sl.fname, sl.lname FROM category ct, seller_login sl WHERE ct.seller_id= sl.seller_id AND ct.status=? ORDER BY ct.cat_name ASC");
    	   $stmt->bind_param( s,  $inactive );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4, $col5, $col6);
           
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	       
        	   	$cat[$i] = 
        					array(	
        					    'id' => $col1,
        						'name' => $col2,
        						'seller_id'=> $col4,
        						'seller_name'=> $col5." ".$col6);
              		   $i = $i+1;  			  
               // echo " array created".json_encode($return);
    	    }
            
            // get brand
           $brand = array();
           $inactive = "inactive";
           $stmt2 = $conn->prepare("SELECT bd.*, sl.fname, sl.lname FROM brand bd, seller_login sl WHERE bd.seller_id= sl.seller_id AND bd.status=? ORDER BY bd.brand_name ASC");
    	   $stmt2->bind_param( s,  $inactive );
    	   $stmt2->execute();	 
     	   $data = $stmt2->bind_result( $col21, $col22, $col23, $col24, $col25, $col26);
           
    	   $i =0;
       	   while ($stmt2->fetch()) { 
    	       
        	   	$brand[$i] = 
        					array(	
        					    'id' => $col21,
        						'name' => $col22,
        						'seller_id'=> $col24,
        						'seller_name'=> $col25." ".$col26);
              		   $i = $i+1;  			  
               // echo " array created".json_encode($return);
    	    }
            
           // get product
           $product = array();
          $inactive = "inactive";
           $stmt3 = $conn->prepare("SELECT pd.prod_id, pd.prod_name, pd.seller_id FROM product pd WHERE pd.status=? ORDER BY pd.prod_name ASC");
    	   $stmt3->bind_param( s,  $inactive );
    	   $stmt3->execute();	 
     	   $data = $stmt3->bind_result( $col31, $col32, $col33);
           
    	   $i =0;
       	   while ($stmt3->fetch()) { 
    	       
        	   	$product[$i] = 
        					array(	
        					    'id' => $col31,
        						'name' => $col32,
        						'seller_id'=> $col23,
        						'seller_name'=> " ");
              		   $i = $i+1;  			  
               // echo " array created".json_encode($return);
    	    }
    	  	
    	  	$finaljson= array(	
        					    'product' => $product,
        						'category' => $cat,
        						'brand' => $brand);
        						
    	  	echo  json_encode($finaljson);
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>