<?php

include('session.php');
$code = $_POST['code'];
//$name = $_POST['name'];
$image = $_POST['img'];
$prodid = $_POST['prodid'];
$prodname = $_POST['prodname'];
$catid = $_POST['catid'];
$catname = $_POST['catname'];
$ctype = $_POST['ctype'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$prodid =   stripslashes($prodid);
$prodname =   stripslashes($prodname);
$catid =   stripslashes($catid);
$catname =   stripslashes($catname);
$ctype =   stripslashes($ctype);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($image)   && !empty($image)  ) {
          
             //	$prodid =1;  
                $stmt11 = $conn->prepare("INSERT INTO banners( img_url, prod_id, prod_name, cat_id, cat_name, clicktype )  VALUES (?,?,?,?,?,?)");
        		$stmt11->bind_param( sisisi, $image, $prodid, $prodname, $catid, $catname, $ctype );
        	 
                $stmt11->execute();
                $stmt11->store_result();
            	// echo " insert done ";
            	 $rows=$stmt11->affected_rows;
            	 if($rows>0){
            	     echo " Banner Added Successfully.";
            	     
            	 }else{
            	     echo "failed to add banner.";
            	 }    
    	      
    	  
        	
    	 
    }else{
            echo "failed to add banner.";
    }
    die;
?>
