<?php
	include('session.php');

	if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
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
        
        // echo "class id is  ".$class_id;     
        $inactive = "active";
           $stmt = $conn->prepare("SELECT days_id,days, price, status FROM days_price WHERE status IN(1,3)  ORDER BY days ASC LIMIT  ".$start.", ".$limit."");
    	   //$stmt->bind_param( s,  $inactive );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4);
           $return = array();
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	      
        	   	$return[$i] = 
        					array(	
        					    'id' => $col1,
        						'days' => $col2,
        						'price' => $col3,
        						'statuss' => $col4);
              		   $i = $i+1;  	
              	$status = 1;
                $msg = "Details here";
               // echo " array created".json_encode($return);
    	    }
    
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg,
                              'data' => $return);
							  
							  
		$stmt12 = $conn->prepare("SELECT count(days_id) FROM days_price WHERE status IN(1,3)  ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
							  
		$page_html =  $Common_Function->pagination('attribute_set_product',$page,$limit,$totalrow); 
		
		echo json_encode(array("status"=>1,"page_html" =>$page_html,"data"=>$return,"totalrowvalue"=>$totalrow));
    	  	
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>