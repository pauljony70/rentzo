<?php
 
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Staff)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code  = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$perpage = $_POST['perpage'];

$search_string = $_POST['search_string'];
$error = ''; // Variable To Store Error Message

$code = stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);
$perpage =  stripslashes($perpage);
$groupid =  stripslashes($groupid);
$search_string =  stripslashes($search_string);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}
else if($code == $_SESSION['_token']){
    
    try{
    
        $Exist = false;
        $status =0;
        $information = array();
        $prodstatus = "active";
		if($_POST['perpage']){
			$limit = $_POST['perpage']; 
		}else{
			$limit = 10; 
		}
	   
        $start = ($page - 1) * $limit; 
        $totalrow =0;
		
        
        $return = array();
        $i      = 0;
		$search_string_qry = "";
		if($search_string){
			$search_string_qry = " AND ( sl.fullname like '%".$search_string."%' OR  sl.phone like '%".$search_string."%' OR  sl.email like '%".$search_string."%' )  ";
		}
		
		$stmt = $conn->prepare("SELECT sl.seller_id, sl.fullname, sl.email, sl.phone, ct.title, sl.create_by,  sl.status FROM admin_login sl, user_roles ct
                WHERE   sl.role_id = ct.id ".$search_string_qry." ORDER BY sl.create_by DESC LIMIT ?, ?");
               $stmt ->bind_param("ii", $start, $limit);
            
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col3, $col4, $col5, $col6, $col7, $col8 );
           $return = array();
    	   $i =0;
       
          //echo " get col data ";
    	   while ($stmt->fetch()) {    
    	   	  	$Exist = true;
          
        	   	$return[$i] = 
        					array(	
        						'user_unique_id' => $col1,        						 
        						 'fullname' => $col3,
								 
        						 'email' => $col4,
        						 'phone' => $col5,
              		  			 'role' => $col6,
              		  			 
              		  			 'createby' =>  date("d-m-Y", strtotime($col7)),
              		  	        
              		  			 'statuss' => $col8	  );        /// status  = 0 -pending  1 accepted , 2 reject, 
              		  			 
              		   $i = $i+1;  			  
                //echo " array created".json_encode($return);
    	    }
		
            $stmt12 = $conn->prepare("SELECT count(seller_id) FROM admin_login sl, user_roles ct WHERE sl.role_id = ct.id  ".$search_string_qry."");
            
         
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col21);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col21;
        }
    
        if( $Exist){
                
			$page_html =  $Common_Function->pagination('appuser_page',$page,$limit,$totalrow); 
		
		echo json_encode(array("status"=>1,"page_html" =>$page_html,"details"=>$return,"totalrowvalue"=>$totalrow));
	                        
         }else{
             //echo "  page ".$page;
         
             echo json_encode(array("status"=>0,"page_html" =>'',"details"=>$return,"totalrowvalue"=>$totalrow));
         }
         
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>