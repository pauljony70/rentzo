<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
  $code=   stripslashes($code);

$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token']){
    
    try{
    
        // echo "class id is  ".$class_id;     
        $inactive = "active";
           $stmt = $conn->prepare("SELECT sno, img_url, prod_name, banner_order, cat_name FROM banners ORDER BY banner_order ASC");
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4, $col5);
           $return = array();
    	   $i =0;
       	   while ($stmt->fetch()) { 
       	     
       	     $name = $col3.$col5;
       	      $name = str_replace("none", "",   $name);
        	   	$return[$i] = 
        					array(	
        					    'id' => $col1,
        						'img' =>"../media/". $col2,
        						'prodname' =>$name,
        						'orderno' => $col4);
              		   $i = $i+1;  			  
               // echo " array created".json_encode($return);
    	    }
    
    	  	 echo  json_encode($return);
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>