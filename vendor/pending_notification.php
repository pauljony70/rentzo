<?php
include('session.php');
$code = $_REQUEST['code'];
$type = $_REQUEST['type'];


$code=  stripslashes($code);


$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && $type == 'get_noti'){
   
    try{
		$info = array();
		$html = '';
       
           $stmt = $conn->prepare("SELECT id, message FROM seller_notification where seller_id ='".$_SESSION['admin']."' AND read_status ='N' order by created_at desc");
    	   
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2);
          
			$category_count = 0;
       	   while ($stmt->fetch()) { 
				if($col1 >0){
					$category_count++;
					$html .= '<li><p><a href ="pending_category.php">'.$col2.'</a></p></li>';
				}
    	    }
			
			
		
			
			
    	    $total_count = $category_count;
			
			
			//code for chat 
			$chat_details = $conn->prepare("SELECT count(id) as total FROM vendor_admin_chat where  message_by = 'ADMIN' AND status = 'N'");
    	   
    	   $chat_details->execute();	 
     	   $data = $chat_details->bind_result( $tot_chat);
          
			$chat_count = 0;
       	   while ($chat_details->fetch()) { 
				$chat_count = $tot_chat;
    	    }
			
		
    	  
    	    $info = array('status'=>1,'count'=> $total_count,
    	                  'html_code' => $html,'chat_count'=>$chat_count);
    
    	  	 echo  json_encode($info);
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}else if($code == $_SESSION['_token'] && $type == 'remove_noti'){
	 $stmt = $conn->prepare("DELETE  FROM seller_notification where seller_id ='".$_SESSION['admin']."'");
    
    $stmt->execute();	 
    
	
    $info = array('status'=>1,'count'=> 0,
    	                  'html_code' => '');
     echo  json_encode($info);
          
}
?>