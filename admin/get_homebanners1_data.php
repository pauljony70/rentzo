<?php
	include('session.php');
	
	if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
		echo "<script>location.href='no-premission.php'</script>";die();
	}

	

$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
{
    
    try{
		
        $msg = "Unable to Get Data";
		
		
		
		
		
        $return = array();
        
        $query = $conn->query("SELECT id,title,layout,orders FROM homepage_banners order by orders ASC");
		if($query->num_rows > 0){
		   $i=0; 
       	   while ($rows = $query->fetch_assoc()) { 
				if($rows['layout'] ==0){
					$layout = "Horizontal";
				}else if($rows['layout'] ==1){
					$layout = "2x2 grid";
				}else if($rows['layout'] ==2){
					$layout = "3x1 grid";
				}else if($rows['layout'] ==3){
					$layout = "Vertical";
				}else if($rows['layout'] ==4){
					$layout = "small banner";
				}else if($rows['layout'] ==5){
					$layout = "big banner";
				}else if($rows['layout'] ==6){
					$layout = "small category";
				}
				
				
        	   	$return[$i] = 
        					array(	
        					    'id' => $rows['id'],
        						'title' => $rows['title'],
        						'orders' => $rows['orders'],
        						'layout' => $layout,
        						'layout_id' => $rows['layout'],
        						
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
							  
						  
		
		echo json_encode(array("status"=>1,"page_html" =>'',"data"=>$return));
    	  	
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>