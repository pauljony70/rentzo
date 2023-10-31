<?php

 

include('session.php');



if(!$Common_Function->user_module_premission($_SESSION,$ManageSeller)){

	echo "<script>location.href='no-premission.php'</script>";die();

}



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

		if($_POST['perpage']){

			$limit = $_POST['perpage']; 

		}else{

			$limit = 10; 

		}

	   

        $start = ($page - 1) * $limit; 

        $totalrow =0;

				
        

        $return = array();

        $i      = 0;

		$seller_name_qry = "";

		if($seller_name){

			$seller_name_qry = " AND (sl.seller_unique_id like '%".$seller_name."%' OR sl.companyname like '%".$seller_name."%' OR sl.fullname like '%".$seller_name."%' OR  sl.phone like '%".$seller_name."%' OR  sl.email like '%".$seller_name."%' )  ";

		}

     

            if($groupid!= "blank"){

      

                 $stmt = $conn->prepare("SELECT sl.seller_unique_id, sl.companyname,sl.fullname, sl.email, sl.phone, sl.fullname,sum(prod_price) as total_price,sum(admin_profit) as total_admin_profit FROM sellerlogin sl, seller_group sg, city ct,order_product op

                    WHERE sl.groupid = sg.sno AND sl.city = ct.city_id and op.vendor_id = sl.seller_unique_id AND sl.groupid=? ".$seller_name_qry." GROUP by sl.seller_unique_id ORDER BY sl.create_by DESC LIMIT ?, ?");

                   $stmt ->bind_param("iii",$groupid, $start, $limit);
 
            	

            }else{

        

                $stmt = $conn->prepare("SELECT sl.seller_unique_id, sl.companyname,sl.fullname, sl.email, sl.phone, sl.fullname,sum(prod_price) as total_price,sum(admin_profit) as total_admin_profit FROM sellerlogin sl, seller_group sg, city ct,order_product op

                WHERE sl.groupid = sg.sno AND sl.city = ct.city_id  and op.vendor_id = sl.seller_unique_id ".$seller_name_qry." GROUP by sl.seller_unique_id ORDER BY sl.create_by DESC LIMIT ?, ?");

               $stmt ->bind_param("ii", $start, $limit);

            }

    	   $stmt->execute();	 

     	   $data = $stmt->bind_result( $sellerid, $col2, $col3,$col4,$col5,$col6,$total_price,$total_admin_profit );

           $return = array();

    	   $i =0;
		   
		   
       

          //echo " get col data ";

    	   while ($stmt->fetch()) {    

    	   	  	$Exist = true;
			


			

        	   	$return[$i] = 

        					array(	

        						'sellerid' => $sellerid,

        						 'bussname' =>$col2,

        						 'fullname' => $col3,
								 
								 'email' => $col4,

        						 'phone' => $col5,

              		  			 'city' => $col6,

        						 'total_price' => $total_price,

        						 'total_profit' => $total_admin_profit);   

              		  			 

              		   $i = $i+1;  			  

                //echo " array created".json_encode($return);

    	    }

			

		if($groupid!= "blank"){

             $stmt12 = $conn->prepare("SELECT count(sellerid) FROM sellerlogin sl WHERE sl.groupid =?  ".$seller_name_qry." ");

             $stmt12 ->bind_param('i', $groupid);

            

         }else{

			 

            $stmt12 = $conn->prepare("SELECT count(sellerid) FROM sellerlogin sl WHERE 1=1 ".$seller_name_qry."");

            

         }

        $stmt12->execute();

        $stmt12->store_result();

        $stmt12->bind_result (  $col21);

                	 

        while($stmt12->fetch() ){

            $totalrow = $col21;

        }

    

        if( $Exist){

                

			$page_html =  $Common_Function->pagination('seller_product',$page,$limit,$totalrow); 

		

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