<?php
include('session.php');
$code = $_POST['code'];
$code=  stripslashes($code);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else
if($code == $_SESSION['_token']){
    
    try{
    
        $status = 0;
        $msg = "Unable to Get Data";
        $return = array();
        $i =0;
           $stmt = $conn->prepare("SELECT tax_id, name FROM tax where status = '1' ORDER BY tax_id ASC");
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2);
           $return = array();
    	  
       	   while ($stmt->fetch()) { 
       	     
       	       	$return[$i] = 
        					array(	
        					    'id' => $col1,
        						'name' =>$col2 );
              		   $i = $i+1;  
               $status = 1;
                $msg = "Details here";		   
               // echo " array created".json_encode($return);
    	    }
    	    
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg,
                              'data' => $return);
    	  echo  json_encode($information);
    	  	   
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>