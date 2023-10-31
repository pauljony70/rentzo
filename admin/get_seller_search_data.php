<?php
 
include('session.php');
$code  = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$perpage = $_POST['perpage'];
$groupid = $_POST['groupid'];
$seller_name = $_POST['seller_name'];
$error = ''; // Variable To Store Error Message

$code = stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);
$perpage =  stripslashes($perpage);
$groupid =  stripslashes($groupid);
$seller_name =  stripslashes($seller_name);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}
else if($code == $_SESSION['_token']){
      try{
      
        $Exist = false;
        $status =0;
        $information = array();
        $prodstatus = "active";
        $limit = $perpage;
        $start = ($page - 1) * $limit; 
        $totalrow =0;
        $search = "%".$seller_name."%";
         if($groupid!= "blank"){
             $stmt12 = $conn->prepare("SELECT count(sellerid) FROM sellerlogin WHERE groupid =? AND fullname LIKE ?");
             $stmt12 ->bind_param(is, $groupid, $search);
            
         }else{
            $stmt12 = $conn->prepare("SELECT count(sellerid) FROM sellerlogin WHERE fullname LIKE ?");
             $stmt12 ->bind_param(s, $search);        
         }
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col21);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col21;
        }
        
         if($page ==99999){
            $start =   $totalrow -($totalrow % $limit); 
            $page = (int)(($totalrow / $limit) +1);
           // echo " stat ".$start." limi ".$limit." page ".$page;
            if($start == $totalrow){
                $start = $start -$limit;
                $page = (int)((($totalrow-$limit) / $limit) +1);
            }
         }
        
        $return = array();
        $i      = 0;
     
            if($groupid!= "blank"){
      
                 $stmt = $conn->prepare("SELECT sl.sellerid, sl.companyname, sl.fullname, sl.email, sl.phone, ct.city_name, sg.name, sl.create_by, sl.tax_number, sl.status FROM sellerlogin sl, seller_group sg, city ct
                    WHERE sl.groupid = sg.sno AND sl.city = ct.city_id AND sl.groupid=? AND sl.fullname LIKE ? ORDER BY sl.create_by DESC LIMIT ?, ?");
                   $stmt ->bind_param(isii,$groupid,$search, $start, $limit);
            	
            }else{
       
                $stmt = $conn->prepare("SELECT sl.sellerid, sl.companyname, sl.fullname, sl.email, sl.phone, ct.city_name, sg.name, sl.create_by, sl.tax_number, sl.status FROM sellerlogin sl, seller_group sg, city ct
                WHERE sl.groupid = sg.sno AND sl.city = ct.city_id AND sl.fullname LIKE ? ORDER BY sl.create_by DESC LIMIT ?, ?");
               $stmt ->bind_param(sii,$search, $start, $limit);
            }
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10 );
           $return = array();
    	   $i =0;
       
          //echo " get col data ";
    	   while ($stmt->fetch()) {    
    	   	  	$Exist = true;
          
        	   	$return[$i] = 
        					array(	
        						'sellerid' => $col1,
        						 'bussname' =>$col2,
        						 'fullname' => $col3,
        						 'email' => $col4,
        						 'phone' => $col5,
              		  			 'city' => $col6,
              		  			 'groupname' => $col7,
              		  			 'createby' =>  date("d-m-Y", strtotime($col8)),
              		  	         'taxno' => $col9,
              		  			 'sellerstatus' => $col10	  );        /// status  = 0 -pending  1 accepted , 2 reject, 
              		  			 
              		   $i = $i+1;  			  
                //echo " array created".json_encode($return);
    	    }
    
        if( $Exist){
                	    
              $status = 1;
              $information =array( 'status' => $status,
                                    'totalrow' => $totalrow,
                	                 'pageno' =>  $page,
                                    'details' => $return);
	                        
         }else{
             //echo "  page ".$page;
              
                	 
              $status = 0;
              $information =array( 'status' => $status,
                                    'totalrow' => $totalrow,
                	               'pageno' =>  $page,
                                'details' => $return);
         }
                
         echo  json_encode( $information);
     
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>