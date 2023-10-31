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
        
        $query = $conn->query("SELECT hc.id,hc.cat_id, cat.cat_name,hc.cat_order FROM home_category hc , category cat WHERE cat.cat_id = hc.cat_id order by hc.cat_order asc ");
		if($query->num_rows > 0){
		   $i=0; 
       	   while ($rows = $query->fetch_assoc()) { 
		   	   	$return[$i] = 
        					array(	
        					    'id' => $rows['id'],
        						'name' => $rows['cat_name'],
        						'cat_order' => $rows['cat_order']
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
							  
							  
		$stmt12 = $conn->prepare("SELECT count(hc.id) FROM home_category hc , category cat WHERE cat.cat_id = hc.cat_id  ");
     
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