<?php

	include('session.php');


	$code = $_POST['code'];

	

	

	$code =stripslashes($code);

	

$error='';  // Variable To Store Error Message



//echo "admin is ".$_SESSION['admin'];

if(!isset($_SESSION['admin'])){

  header("Location: index.php");

 // echo " dashboard redirect to index";

}else

if($code == $_SESSION['_token']){

    

    try{

		

        $status = 0;

        $msg = "Unable to Get Data";

        $return = array();

        

        // echo "class id is  ".$class_id;     

        $inactive = "active";

           $stmt = $conn->prepare("SELECT id, hsn_code, status FROM product_hsn_code where status ='1' ORDER BY id ASC ");

    	   //$stmt->bind_param( s,  $inactive );

    	   $stmt->execute();	 

     	   $data = $stmt->bind_result( $col1, $col2, $col3);

           $return = array();

    	   $i =0;

       	   while ($stmt->fetch()) { 

    	     

        	   	$return[$i] = 

        					array(	

        					    'id' => $col1,

        						'hsn_code' => $col2);

              		   $i = $i+1;  	

              	$status = 1;

                $msg = "Details here";

               // echo " array created".json_encode($return);

    	    }

    

    	 $information =array( 'status' => $status,

                              'msg' =>   $msg,

                              'data' => $return);

							  

			

		echo json_encode($information);

    	  	

     }

    catch(PDOException $e)

        {

        echo "Error: " . $e->getMessage();

        }



}

?>