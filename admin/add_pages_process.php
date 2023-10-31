<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Brand)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

$code = $_POST['code'];
$page_title = $_POST['page_title'];
$page_dsc = $_POST['page_dsc'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$page_title =   stripslashes($page_title);
$page_dsc =   stripslashes($page_dsc);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($page_title)   && !empty($page_title)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(pages_id) FROM pages where page_title ='".$page_title."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow>0){
			 echo "Page Title Already Exist. ";
		}else{
			
			$metaid =0;
			$stmt11 = $conn->prepare("INSERT INTO pages( page_title, page_dsc )  VALUES (?,?)");
			$stmt11->bind_param( "ss",  $page_title,$page_dsc);
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Pages Added Successfully. ";
				
			}else{
				echo "failed to add Pages";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
