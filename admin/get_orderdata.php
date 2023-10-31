<?php
include('session.php');
if(!$Common_Function->user_module_premission($_SESSION,$Order)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code  = $_POST['code'];
$type  = $_POST['typess'];
$start_date  = $_POST['start_date'];
$end_date  = $_POST['end_date'];

$add_data = '';
if($type == 1)
{
	$add_data .= 'WHERE DATE(create_date) > (NOW() - INTERVAL 7 DAY)';
}
else if($type == 2)
{
	$add_data .= 'WHERE MONTH(create_date) = MONTH(CURRENT_DATE())';
}
else if($type == 3)
{
	$add_data .= 'WHERE  YEAR(create_date)';
}
else
{
	$add_data .= 'where 1=1';
}

if($start_date != '' and $end_date != '')
{
	$add_data .= ' and DATE(create_date) between "'.$start_date.'"  AND "'.$end_date.'"';
}


$error = ''; // Variable To Store Error Message

$code = stripslashes($code);


    try{
    
        $Exist = false;
        $status =0;
        $information = array();
        $prodstatus = "active";
		
        $totalrow =0;
		
        
        $return = array();
        $i      = 0;
		$order_id_qry = ""; 
		
           //echo "SELECT count(*) as total,create_date FROM orders $add_data group by DATE(create_date)  ORDER BY sno DESC";
		  $stmt = $conn->prepare("SELECT count(*) as total,create_date FROM orders $add_data group by DATE(create_date)  ORDER BY sno DESC");
       
            
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1 , $col2);
           $return = array();
    	   $i =0;
       
          //echo " get col data ";
    	   while ($stmt->fetch()) {    
    	   	  	$Exist = true;
				$user_type = '';
				
				$return[$i] = 
        					array(	
        						'orderid' => $col1,
        						'Dates' => date('d-m-Y',strtotime($col2)),
        						 
								 );        /// status  = 0 -pending  1 accepted , 2 reject, 
              		  			 
              		   $i = $i+1;  			  
                //echo " array created".json_encode($return);
    	    }
		
			print json_encode($return);
			 
           
         
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

?>