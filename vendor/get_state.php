<?php
include('session.php');
$code = $_POST['code'];
$countryid = $_POST['countryid'];
$code=  stripslashes($code);
$countryid=   stripslashes($countryid);

$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && !empty($countryid)){
    
    try{
    
        $status = 0;
        $msg = "Unable to Get Data";
        $return = array();
       
        // echo "class id is  ".$class_id;     
           $stmt = $conn->prepare("SELECT stateid, name FROM state WHERE countryid=? ORDER BY name ASC");
    	   $stmt->bind_param( "i",  $countryid );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2);
           $return = array();
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	       
        	   	$return[$i] = 
        					array(	
        					    'id' => $col1,
        						'name' => $col2);
              		   $i = $i+1;  			  
                $status = 1;
                $msg = "Details here";
               // echo " array created".json_encode($return);
    	    }
    
    	 $information =array( 'status' => $status,
                              'msg' =>   $msg,
                              'data' => $return);
    	  	 echo  json_encode($information);
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>