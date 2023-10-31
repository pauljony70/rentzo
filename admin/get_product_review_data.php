<?php
	include('session.php');
	
	if(!$Common_Function->user_module_premission($_SESSION,$ProductReview)){
		echo "<script>location.href='no-premission.php'</script>";die();
	}
	
	$code = $_POST['code'];	
	$type = $_POST['type'];
	
	$code =stripslashes($code);
	

$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && $type =='get'){
    
    try{
		$page  = $_POST['page'];
		$rowno = $_POST['rowno'];
		
		$page =  stripslashes($page);
		$rowno =  stripslashes($rowno);
	
		if($_POST['perpage']){
			$limit = $_POST['perpage']; 
		}else{
			$limit = 10; 
		}
	   
        $start = ($page - 1) * $limit; 
        $totalrow =0;
    
        $status = 0;
        $msg = "Unable to Get Data";
        $return = array();
        
            
           $stmt = $conn->prepare("SELECT pr.review_id, pr.rating, pr.title,pr.created_at,pr.status, pd.prod_name ,aul.fullname
			FROM product_review pr, product_details pd , appuser_login aul WHERE aul.user_unique_id =pr.user_id AND pd.product_unique_id = pr.product_id AND   pr.status ='0' ORDER BY pr.created_at DESC LIMIT  ".$start.", ".$limit."");
    	   
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $review_id, $rating, $title, $created_at,$status,$prod_name,$fullname);
           $return = array();
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	     
        	   	$return[$i] = 
        					array(	
        					    'id' => $review_id,
        						'rating' => $rating,
        						'title' => $title,
        						'created_at' => $created_at,
        						'prod_name' => $prod_name,
        						'fullname' => $fullname,
								'statuss' => $status);
              		   $i = $i+1;  	
              	$status = 1;
                $msg = "Details here";
               // echo " array created".json_encode($return);
    	    }
    
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg,
                              'data' => $return);
							  
							  
		$stmt12 = $conn->prepare("SELECT count(pr.review_id)
			FROM product_review pr, product_details pd , appuser_login aul WHERE aul.user_unique_id =pr.user_id AND pd.product_unique_id = pr.product_id AND   pr.status ='0'  ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
							  
		$page_html =  $Common_Function->pagination('product_review',$page,$limit,$totalrow); 
		
		echo json_encode(array("status"=>1,"page_html" =>$page_html,"data"=>$return,"totalrowvalue"=>$totalrow));
    	  	
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}else if($code == $_SESSION['_token'] && $type =='view'){
    
    try{
		$deletearray  = $_POST['deletearray'];
		
        $status = 0;
        $msg = "Unable to Get Data";
        $return = array();
        
           $stmt = $conn->prepare("SELECT pr.review_id, pr.rating, pr.title,pr.created_at,pr.status, pd.prod_name ,aul.fullname , pr.comment,pr.product_id
			FROM product_review pr, product_details pd , appuser_login aul WHERE aul.user_unique_id =pr.user_id AND pd.product_unique_id = pr.product_id AND pr.review_id ='".$deletearray."'");
    	   
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $review_id, $rating, $title, $created_at,$status,$prod_name,$fullname,$comment,$product_id);
           $return = array();
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	     
        	   	$return[$i] = 
        					array(	
        					    'id' => $review_id,
        						'rating' => $rating,
        						'title' => $title,
        						'created_at' => $created_at,
        						'prod_name' => $prod_name,
        						'fullname' => $fullname,
        						'comment' => $comment,
        						'product_id' => $product_id,
								'statuss' => $status);
              		   $i = $i+1;  	
              	$status = 1;
                $msg = "Details here";
               // echo " array created".json_encode($return);
    	    }
    
    	
		echo json_encode(array("status"=>1,"data"=>$return));
    	  	
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }

}else if($code == $_SESSION['_token'] && $type =='approve'){
	try{
		$deletearray  = $_POST['deletearray'];    
		$product_ids  = $_POST['product_ids'];    
        
		$query = $conn->query("UPDATE product_review SET status='1' WHERE review_id ='".$deletearray."'");   
        
        $stmt = $conn->query("SELECT COUNT(review_id) total_review, SUM(rating) total_rating FROM product_review  WHERE  product_id ='".$product_ids."'");
    	if($stmt->num_rows > 0){
			$rows = $stmt->fetch_assoc();
			$total_review = $rows['total_review'];
			$total_rating = ($rows['total_rating']/$total_review);
			$query = $conn->query("UPDATE product_details SET prod_rating='".$total_rating."', prod_rating_count ='".$total_review."' WHERE product_unique_id ='".$product_ids."'");   
		}
    	
    	  	
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}else if($code == $_SESSION['_token'] && $type =='delete'){
	try{
		$deletearray  = $_POST['deletearray'];    
		$product_ids  = $_POST['product_ids'];    
        
		$query = $conn->query("DELETE FROM product_review  WHERE review_id ='".$deletearray."'");   
        
       
    	  	
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}else if($code == $_SESSION['_token'] && $type =='get_approve'){
    
    try{
		$page  = $_POST['page'];
		$rowno = $_POST['rowno'];
		
		$page =  stripslashes($page);
		$rowno =  stripslashes($rowno);
	
		if($_POST['perpage']){
			$limit = $_POST['perpage']; 
		}else{
			$limit = 10; 
		}
	   
        $start = ($page - 1) * $limit; 
        $totalrow =0;
    
        $status = 0;
        $msg = "Unable to Get Data";
        $return = array();
        
            
           $stmt = $conn->prepare("SELECT pr.review_id, pr.rating, pr.title,pr.created_at,pr.status, pd.prod_name ,aul.fullname
			FROM product_review pr, product_details pd , appuser_login aul WHERE aul.user_unique_id =pr.user_id AND pd.product_unique_id = pr.product_id AND   pr.status ='1' ORDER BY pr.created_at DESC LIMIT  ".$start.", ".$limit."");
    	   
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $review_id, $rating, $title, $created_at,$status,$prod_name,$fullname);
           $return = array();
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	     
        	   	$return[$i] = 
        					array(	
        					    'id' => $review_id,
        						'rating' => $rating,
        						'title' => $title,
        						'created_at' => $created_at,
        						'prod_name' => $prod_name,
        						'fullname' => $fullname,
								'statuss' => $status);
              		   $i = $i+1;  	
              	$status = 1;
                $msg = "Details here";
               // echo " array created".json_encode($return);
    	    }
    
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg,
                              'data' => $return);
							  
							  
		$stmt12 = $conn->prepare("SELECT count(pr.review_id)
			FROM product_review pr, product_details pd , appuser_login aul WHERE aul.user_unique_id =pr.user_id AND pd.product_unique_id = pr.product_id AND   pr.status ='1'  ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
							  
		$page_html =  $Common_Function->pagination('product_review',$page,$limit,$totalrow); 
		
		echo json_encode(array("status"=>1,"page_html" =>$page_html,"data"=>$return,"totalrowvalue"=>$totalrow));
    	  	
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>