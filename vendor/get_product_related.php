<?php
include('session.php');
$code = $_POST['code'];
$code= stripslashes($code);

$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code==$_SESSION['_token'] && $_POST['selectseller']){    
    
    try{
		$status = 0;
        $msg = "Unable to Get Data";
        $return = array();
		global $publickey_server;
		$encruptfun = new encryptfun();
		$selectseller = $encruptfun->decrypt($publickey_server,trim($_POST['selectseller']));
		
		$cat_id_1 = str_replace('|',',',$_POST['cat_id']);
		$cat_id = rtrim($cat_id_1, ',');

         
        // echo "class id is  ".$class_id; 
           $stmt = $conn->prepare("SELECT pd.product_unique_id, pd.prod_name FROM product_details pd 
		   INNER JOIN vendor_product vp ON pd.product_unique_id = vp.product_id INNER JOIN product_category pc ON pc.prod_id = pd.product_unique_id WHERE vp.vendor_id ='".$selectseller."' and pc.cat_id IN($cat_id) ORDER BY pd.prod_name ASC");
    	   
		/*  echo  "SELECT pd.product_unique_id, pd.prod_name FROM product_details pd 
		   INNER JOIN vendor_product vp ON pd.product_unique_id = vp.product_id INNER JOIN product_category pc ON pc.prod_id = pd.product_unique_id WHERE vp.vendor_id ='".$selectseller."' and pc.cat_id IN('$cat_id') ORDER BY pd.prod_name ASC";*/
		   
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