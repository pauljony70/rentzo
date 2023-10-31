<?php
	include('session.php');
	
	if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
		echo "<script>location.href='no-premission.php'</script>";die();
	}

	$code = $_POST['code'];
	$page  = $_POST['page'];
	$rowno = $_POST['rowno'];
	
	$code =stripslashes($code);
	$page =  stripslashes($page);
	$rowno =  stripslashes($rowno);

$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token']){
    
    try{
		
        $msg = "Unable to Get Data";
        $return = array();
        
        $query = $conn->query("SELECT id,img_url, banner_id,banner_order,clicktype FROM banners order by banner_order ASC");
		if($query->num_rows > 0){
		   $i=0; 
       	   while ($rows = $query->fetch_assoc()) { 
		   $name = '';
    	       if( $rows['img_url']){
				   $img_dec = json_decode( $rows['img_url']);
				   $img = MEDIAURL. $img_dec->{'72-72'};
			   }else{
				    $img ='';
			   }
			   if($rows['clicktype'] == 1){
				   $type = 'Category';
				    $query_cat = $conn->query("SELECT cat_name FROM category WHERE cat_id ='".$rows['banner_id']."'");
					if($query_cat->num_rows > 0){
						$result_cat = $query_cat->fetch_assoc();						
						$name = $result_cat['cat_name'];
					}
				   
				   
			   }else  if($rows['clicktype'] == 3){
				   $type = 'Custom Search';
				   $name = $rows['banner_id'];
					
				   
				   
			   }else{
				   $type = 'Product';
				   
				    $query_prod = $conn->query("SELECT prod_name FROM product_details WHERE product_unique_id ='".$rows['banner_id']."'");
					if($query_prod->num_rows > 0){
						$result_prod = $query_prod->fetch_assoc();						
						$name = $result_prod['prod_name'];
					}
			   }
        	   	$return[$i] = 
        					array(	
        					    'id' => $rows['id'],
        						'name' => $name,
        						'img' => $img,
								'type' => $type
								);
              		   $i = $i+1;  	
              	$status = 1;
                $msg = "Details here";
               // echo " array created".json_encode($return);
    	    }
		}
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg,
                              'data' => $return);
							  
							  
		$stmt12 = $conn->prepare("SELECT count(id) FROM banners ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
							  
		
		echo json_encode(array("status"=>1,"page_html" =>'',"data"=>$return,"totalrowvalue"=>$totalrow));
    	  	
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>