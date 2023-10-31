<?php

include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else{
    

    $seller_id = $_POST['seller_id'];
    $seller_id =   stripslashes($seller_id);
   
   if(isset($seller_id) && !empty($seller_id)  ) {
	   
		$stmt = $conn->prepare("SELECT seller_unique_id FROM sellerlogin WHERE sellerid=? ");
		$stmt->bind_param( "i",  $seller_id );
		$stmt->execute();	 
		$data = $stmt->bind_result($sellers_id);
		$return = array();
		
		while ($stmt->fetch()) { 
		  $seller_unique_id = $sellers_id;
		  
		}

		$qry_vp = $conn->prepare("SELECT product_id FROM vendor_product WHERE vendor_id = '$seller_unique_id'");
	    $qry_vp->execute();
		$qry_vp->store_result();

		$data = $qry_vp->bind_result($product_id);
        if($qry_vp->num_rows > 0){
			while ($qry_vp->fetch()) { 
			
				$del_vp = $conn->prepare("DELETE FROM vendor_product WHERE vendor_id = '$seller_unique_id'");
				$del_vp->execute();
				
				$del_hcb = $conn->prepare("DELETE FROM home_custom_banner WHERE banner_id = '$product_id' and clicktype = '2'");
				$del_hcb->execute();
				
				$del_pp = $conn->prepare("DELETE FROM popular_product WHERE product_id = '$product_id'");
				$del_pp->execute();
				
				$del_pr = $conn->prepare("DELETE FROM product_review WHERE product_id = '$product_id'");
				$del_pr->execute();
				
			}
			$stmt2 = $conn->prepare("DELETE FROM sellerlogin WHERE sellerid = '$seller_id'");
			$stmt2->execute();
        		
			$rows=$stmt2->affected_rows;
        	if($rows>0)
			{
        			echo "Deleted";
			}
			else
			{
					echo "Failed to Delete 0. ";
			}
            	 
			die;
			
		}
		else
		{
		
			$stmt2 = $conn->prepare("DELETE FROM sellerlogin WHERE sellerid = '$seller_id'");
			$stmt2->execute();
        		
			$rows=$stmt2->affected_rows;
        	if($rows>0)
			{
        			echo "Deleted";
			}
			else
			{
					echo "Failed to Delete. ";
			}
            	 
			die;
			
		}
			/*die;
            $stmt2 = $conn->prepare("DELETE FROM sellerlogin WHERE sellerid = $seller_id");
			$stmt2->execute();
        		
			$rows=$stmt2->affected_rows;
        	if($rows>0)
			{
        			echo "Deleted";
			}
			else
			{
					echo "Failed to Delete. ";
			}
            	 
        die;*/
    }
	else
	{
			echo "Failed to Delete. ";
    }
}    
?>
