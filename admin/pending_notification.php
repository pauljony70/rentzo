<?php
include('session.php');
$code = $_REQUEST['code'];


$code=  stripslashes($code);


$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token']){
   
    try{
		$info = array();
		$html = '';
		$category_count=$brand_count=$attribute_set_count=$tax_count=$return_policy_count=$product_attributes_count=$product_details_count=0;
		if($Common_Function->user_module_premission($_SESSION,$Category)){
           $stmt = $conn->prepare("SELECT count(cat_id) FROM category where status NOT IN(1,3)");
    	   
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1);
          
			$category_count = 0;
       	   while ($stmt->fetch()) { 
				if($col1 >0){
					$category_count = $col1;
					$html .= '<li><p><a href="javascript:void(0)" onclick="page_redirect(\'pending_category.php\')">New Category ('.$col1.')</a></p></li>';
				}
    	    }
		}
			
		if($Common_Function->user_module_premission($_SESSION,$Brand)){
			//code for brand
			 $brand = $conn->prepare("SELECT count(brand_id) FROM brand where status NOT IN(1,3)");
    	   
    	   $brand->execute();	 
     	   $data = $brand->bind_result( $col2);
          
			$brand_count = 0;
       	   while ($brand->fetch()) { 
				if($col2 >0){
					$brand_count  =  $col2;
					$html .= '<li><p><a href="javascript:void(0)" onclick="page_redirect(\'pending_brand.php\')" >New Brand ('.$col2.')</a></p></li>';
				}
    	    }
		}
			//code for Attributes Set
		if($Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
			$attribute_set = $conn->prepare("SELECT count(sno) FROM attribute_set where status NOT IN(1,3)");
    	   
    	   $attribute_set->execute();	 
     	   $data = $attribute_set->bind_result( $col3);
          
			$attribute_set_count = 0;
       	   while ($attribute_set->fetch()) { 
				if($col3 >0){
					$attribute_set_count  = $col3;
					$html .= '<li><p><a href="javascript:void(0)" onclick="page_redirect(\'pending_attribute_set.php\')" >New Attributes Set ('.$col3.')</a></p></li>';
				}
    	    }
		
		
		}
			//code for Tax Class
		
		if($Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
			$tax = $conn->prepare("SELECT count(tax_id) FROM tax where status NOT IN(1,3)");
    	   
    	   $tax->execute();	 
     	   $data = $tax->bind_result( $col4);
          
			$tax_count = 0;
       	   while ($tax->fetch()) {
				if($col4 >0){
					$tax_count  = $col4;
					$html .= '<li><p><a href="javascript:void(0)" onclick="page_redirect(\'pending_tax.php\')" >New Tax Class ('.$col4.')</a></p></li>';
				}
    	    }
			
		}	
			//code for Return Policy
		if($Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
			$product_return_policy = $conn->prepare("SELECT count(id) FROM product_return_policy where status NOT IN(1,3)");
    	   
    	   $product_return_policy->execute();	 
     	   $data = $product_return_policy->bind_result( $col5);
          
			$return_policy_count = 0;
       	   while ($product_return_policy->fetch()) {
				if($col5 >0){
					$return_policy_count  = $col5;
					$html .= '<li><p><a href="javascript:void(0)" onclick="page_redirect(\'pending_return_policy.php\')" >New Return Policy ('.$col5.')</a></p></li>';
				}
    	    }
			
		}
			//code for Attributes 
		
		if($Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
			$product_attributes = $conn->prepare("SELECT count(id) FROM product_attributes_set where status NOT IN(1,3)");
    	   
    	   $product_attributes->execute();	 
     	   $data = $product_attributes->bind_result( $col6);
          
			$product_attributes_count = 0;
       	   while ($product_attributes->fetch()) { 
				if($col6 >0){
					$product_attributes_count  = $col6;
					$html .= '<li><p><a href="javascript:void(0)" onclick="page_redirect(\'pending_attribute_conf.php\')"  >New Configurations Attributes ('.$col6.')</a></p></li>';
				}
    	    }
		}
		
		if($Common_Function->user_module_premission($_SESSION,$Product)){
			//code for product 
			$product_details = $conn->prepare("SELECT count(id) FROM product_details where status NOT IN(1,3)");
    	   
    	   $product_details->execute();	 
     	   $data = $product_details->bind_result( $col7);
          
			$product_details_count = 0;
       	   while ($product_details->fetch()) { 
				if($col7 >0){
					$product_details_count  = $col7;
					$html .= '<li><p><a href="javascript:void(0)" onclick="page_redirect(\'pending_products.php\')" >New Products ('.$col7.')</a></p></li>';
				}
    	    }
		}
		$html2 = '';
		if($Common_Function->user_module_premission($_SESSION,$Support)){
			//code for chat 
			$chat_details = $conn->prepare("SELECT count(id) as total FROM vendor_admin_chat where  message_by = 'VENDOR' AND status = 'N'");
    	   
    	   $chat_details->execute();	 
     	   $data = $chat_details->bind_result( $tot_chat);
          
			$chat_count = 0;
       	   while ($chat_details->fetch()) { 
				$chat_count = $tot_chat;
    	    }
			
			$chat_details1 = $conn->prepare("SELECT sl.companyname,vac.user_id  FROM vendor_admin_chat vac,sellerlogin sl  WHERE vac.user_id = sl.seller_unique_id AND vac.message_by = 'VENDOR' AND vac.status='N' ORDER BY vac.created_at ASC");
    	   
    	   $chat_details1->execute();	 
     	   $data = $chat_details1->bind_result( $name,$user_id);
          
			
       	   while ($chat_details1->fetch()) { 
				$html2 .= '<li><p><a href="javascript:void(0)" onclick="page_redirect(\'support_chat.php?id='.$user_id.'\')" target="_blank">'.$name.'</a></p></li>';
    	    }
			
		}	
			
    	    $total_count = ($category_count+$brand_count+$attribute_set_count+$tax_count+$return_policy_count+$product_attributes_count+$product_details_count);
    	  
    	    $info = array('status'=>1,'count'=> $total_count, 'html_code' => $html,'chat_count'=>$chat_count ,'chat_html'=>$html2 );
    
    	  	 echo  json_encode($info);
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>