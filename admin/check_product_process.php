<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Product)){
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
if($code==$_SESSION['_token'] && $_POST['prod_name']){
    
    try{
		$status = 0;
        $msg = "Unable to Get Data";
        $return = array();
        $prod_name = $Common_Function->makeurlnamebyname($_POST['prod_name']);
        
		if($_POST['prod_url']){
			$prod_url = $Common_Function->makeurlnamebyname($_POST['prod_url']);
		}else{
			$prod_url = $prod_name;
		}
		
		if($_POST['prod_sku']){
			$prod_sku = $Common_Function->makeSKUbyname($_POST['prod_sku']);
		}else{
			$prod_sku = $Common_Function->makeSKUbyname($_POST['prod_name']);
		}
		
		if(isset($_POST['product_id'])){
			$id = trim($_POST['product_id']);
			$stmt = $conn->prepare("SELECT web_url,product_sku FROM product_details WHERE (LOWER(web_url) ='".strtolower($prod_url)."' OR LOWER(product_sku) ='".strtolower($prod_sku)."'  ) AND  product_unique_id != '".$id."'
									UNION ALL 
									SELECT '' web_url,product_sku FROM product_attribute_value WHERE LOWER(product_sku) ='".strtolower($prod_sku)."' AND product_id  != '".$id."' ");
		}else{
			$stmt = $conn->prepare("SELECT web_url,product_sku FROM product_details WHERE (LOWER(web_url) ='".strtolower($prod_url)."' OR LOWER(product_sku) ='".strtolower($prod_sku)."'  )
									UNION ALL 
									SELECT '' web_url,product_sku FROM product_attribute_value WHERE LOWER(product_sku) ='".strtolower($prod_sku)."'  ");
    	}
    	$stmt->execute();	 
     	$data = $stmt->bind_result( $col1, $col2);
        $return = array();
    	$i =0;
		$return = array('status' => 'done',
        				'prod_url' => $prod_url,
        				'prod_sku' => $prod_sku,
        				'message' => $msg);
						
		while ($stmt->fetch()) { 
    	    if($col1 &&  $col2){
				$msg = "Product SKU / Url already exist. Please change SKU / URL manually.";
			}else if($col1 && !$col2){
				$msg = "product Url already exist. Please change URL manually";
			}else if(!$col1 && $col2){
			    $msg = "product SKU already exist. Please change SKU manually";
			}
           	$return = array(	
        				    'status' => 'exist',
        					'prod_url' => $prod_url,
        					'prod_sku' => $prod_sku,
        					'message' => $msg);
             		   $i = $i+1;  	
            $status = 1;
            $msg = "Details here";
              // echo " array created".json_encode($return);
    	}
    
    	$information =array( 'status' => 1,
                              'msg' =>   $msg,
                              'data' => $return);
    	echo  json_encode($information);
    	  	 
        //return json_encode($return);    
     }
    catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }

}
?>