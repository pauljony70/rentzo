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
		
		$stmt12 = $conn->prepare("SELECT count(id) FROM homepage_banners ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		
		
        $return = array();
        
        $query = $conn->query("SELECT id,title,layout,orders FROM homepage_banners order by orders ASC");
		if($query->num_rows > 0){
		   $i=0; 
       	   while ($rows = $query->fetch_assoc()) { 
				if($rows['layout'] ==0){
					$layout = "Horizontal big product";
				}else if($rows['layout'] ==1){
					$layout = "2x2 grid";
				}else if($rows['layout'] ==2){
					$layout = "3x1 grid";
				}else if($rows['layout'] ==3){
					$layout = "Vertical";
				}else if($rows['layout'] ==4){
					$layout = "Small banner";
				}else if($rows['layout'] ==5){
					$layout = "Small banner with background";
				}else if($rows['layout'] ==6){
					$layout = "Big banner";
				}else if($rows['layout'] ==7){
					$layout = "Horizontal small category";
				}else if($rows['layout'] ==8){
					$layout = "Horizontal with background";
				}
				
				
        	   	$return[$i] = 
        					array(	
        					    'id' => $rows['id'],
        						'title' => $rows['title'],
        						'orders' => $rows['orders'],
        						'layout' => $layout,
        						'layout_id' => $rows['layout'],
        						'count_order' => $totalrow
        						
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
							  
						  
		
		echo json_encode(array("status"=>1,"page_html" =>'',"data"=>$return,"totalrowvalue"=>$totalrow));
    	  	
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>