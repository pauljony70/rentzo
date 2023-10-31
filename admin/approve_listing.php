<?php
include('session.php');
$code = $_POST['code'];
$typecode = $_POST['typecode'];
$id =  $_POST['id'];
      
$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if($code == $_SESSION['_token']){
    
    try{
     $inactive ="active";
     
       // approve product
        function addProduct($id, $conns){
            
             $status = "active";
            $stmt11 = $conns->prepare("UPDATE product SET status =? WHERE prod_id=?");
    		$stmt11->bind_param( si, $status, $id );
        	 $stmt11->execute();
        	// echo " insert done ";
        	 $rows=$stmt11->affected_rows;
        	 if($rows>0){
        	     echo " New Product Added Successfully";
        	     
        	 }else{
        	     echo "failed to add";
        	 }
        }
        // delete  product
        function deleteProduct($id, $conns){
            //DELETE FROM `table1`, `table2` WHERE `orderId` = 500
            //echo "sdf".$id;
             $stmt11 = $conns->prepare("DELETE FROM product WHERE prod_id=?");
    		 $stmt11->bind_param( i, $id );
        	 $stmt11->execute();
        	 $rows=$stmt11->affected_rows;
        	 if($rows>0){
        	    // echo " Product has deleted Successfully";
        	     
        	 }else{
        	     echo "failed to delete";
        	 }
        	 
        	// echo "delete dd";
        	 $stmt11 = $conns->prepare("DELETE FROM productdetails WHERE prod_id=?");
    		 $stmt11->bind_param( i, $id );
        	 $stmt11->execute();
        	 $rows=$stmt11->affected_rows;
        	 if($rows>0){
        	     echo " Product has deleted Successfully";
        	     
        	 }else{
        	     echo "failed to delete";
        	 }
        	 
        }
        // approve brand
        function addBrand($id, $conns){
              
          // echo " active ".$inactive." id ".$id;
           $status = "active";
           
            $stmt11 = $conns->prepare("UPDATE brand SET status=? WHERE brand_id=?");
    		$stmt11->bind_param( si, $status, $id );
        	 $stmt11->execute();
        	 //echo " insert done ";
        	 $rows=$stmt11->affected_rows;
        	 if($rows>0){
        	     echo " New Brand Name Added Successfully";
        	     
        	 }else{
        	     echo "failed to add";
        	 }
          
        
        }
        // delete brand
        function deleteBrand($id, $conns){
            
            $stmt11 = $conns->prepare("DELETE FROM brand WHERE brand_id=?");
    		 $stmt11->bind_param( i, $id );
        	 $stmt11->execute();
        	 $rows=$stmt11->affected_rows;
        	 if($rows>0){
        	     echo " Delete Brand Name Successful";
        	     
        	 }else{
        	     echo "failed to delete";
        	 }
        	 
        }
        // approve category
        function addCat($id, $conns){
            
             $status = "active";
            $stmt11 = $conns->prepare("UPDATE category SET status =? WHERE cat_id=?");
    		$stmt11->bind_param( si, $status, $id );
        	 $stmt11->execute();
        	// echo " insert done ";
        	 $rows=$stmt11->affected_rows;
        	 if($rows>0){
        	     echo " New Category Added Successfully";
        	     
        	 }else{
        	     echo "failed to add";
        	 }
        }
        // delete category
        function deleteCat($id, $conns){
             
             $stmt11 = $conns->prepare("DELETE FROM category WHERE cat_id=?");
    		 $stmt11->bind_param( i, $id );
        	 $stmt11->execute();
        	 $rows=$stmt11->affected_rows;
        	 if($rows>0){
        	     echo " Delete Category Successful";
        	     
        	 }else{
        	     echo "failed to delete";
        	 }
        }
        
        if($typecode ==="prod-add"){
            addProduct($id, $conn);
            
        }else if($typecode ==="prod-remove"){
            deleteProduct($id, $conn);
            
        }else if($typecode ==="brand-add"){
            
            addBrand($id, $conn);
            
        }else if($typecode ==="brand-remove"){
            deleteBrand($id, $conn);
            
        }else if($typecode ==="cat-add"){
            addCat($id, $conn);
            
        }else if($typecode ==="cat-remove"){
            deleteCat($id, $conn);
            
        }
        
       
        						    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>