<?php

include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Brand)){
	echo "<script>location.href='no-premission.php'</script>";die();
}
$code = $_POST['code'];
$page_title = $_POST['page_title'];
$page_heading = $_POST['page_heading'];
$meta_tags = $_POST['meta_tags'];
$meta_dsc = $_POST['meta_dsc'];
$meta_keys = $_POST['meta_keys'];
$page_content = $_POST['page_content'];
$caninocial_url = $_POST['caninocial_url'];
$page_slug = $_POST['page_slug'];
$metaid = $_POST['metaid'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$page_title =   stripslashes($page_title);
$page_heading =   stripslashes($page_heading);
$meta_tags =   stripslashes($meta_tags);
$meta_dsc =   stripslashes($meta_dsc);
$meta_keys =   stripslashes($meta_keys);
$page_content =   stripslashes($page_content);
$caninocial_url =   stripslashes($caninocial_url);
$page_slug =   stripslashes($page_slug);

$metaid =   stripslashes($metaid);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($page_title)   && !empty($page_title) && !empty($metaid)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(metaid) FROM seometa where page_slug ='".$page_slug."' AND metaid !='".$metaid."' ");
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
		
		//code for Check Brand Exist - END
		if($totalrow == 0){
		
			//code for upload images - START
				$stmt11 = $conn->prepare("UPDATE seometa SET page_title =? ,page_heading =? ,meta_tags =? ,meta_desc =? ,meta_keys =? ,page_content =? ,caninocial_url =?,page_slug=? WHERE metaid ='".$metaid."'");
				$stmt11->bind_param( "ssssssss",  $page_title, $page_heading , $meta_tags, $meta_dsc, $meta_keys, $page_content, $caninocial_url,$page_slug  );
			
			
			$metaid =0;
			
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Meta Updated Successfully. ";
				
			}
			
			//code for insert record - END
		}else{
			echo "Page Name already exist. ";
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
