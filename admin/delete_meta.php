<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$ProductAttributes)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];

$code=  stripslashes($code);

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( $code == $_SESSION['_token'] && isset($_POST['deletearray'])){
    

    $deletearray = $_POST['deletearray'];
	$deletearray=   stripslashes($deletearray);

 
   
   if(isset($deletearray) &&!empty( $deletearray)  ) {
           
		$stmt = $conn->prepare("delete FROM  seometa  WHERE metaid=? ");
		$stmt->bind_param( "i",  $deletearray );
		$stmt->execute();	 
		//$return = array();
		$rows=$stmt->affected_rows;
		if($rows>0){
        			    
        			    echo "Delete Successful. ";
        			 //   inactiveProduct($deletearray, $conn);
        		}else{
        			    echo "Failed to Delete. ";
        		}
            	 
			 
       // $Common_Function->delete_return_policy($deletearray, $conn);
        die;
    }
} 
?>