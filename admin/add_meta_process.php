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


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$page_title =   stripslashes($page_title);
$page_heading =   stripslashes($page_heading);
$meta_tags =   stripslashes($meta_tags);
$meta_dsc =   stripslashes($meta_dsc);
$meta_keys =   stripslashes($meta_keys);
$page_content =   stripslashes($page_content);
$caninocial_url =   stripslashes($caninocial_url);


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code == $_SESSION['_token'] && isset($page_title)   && !empty($page_title)  ) {
       //code for Check Brand Exist - START
	   $stmt12 = $conn->prepare("SELECT count(metaid) FROM seometa where page_title ='".$page_title."' ");
     
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
			$stmt11 = $conn->prepare("INSERT INTO seometa( page_title, page_heading, meta_tags, meta_desc, meta_keys, page_content, caninocial_url )  VALUES (?,?,?,?,?,?,?)");
			$stmt11->bind_param( "sssssss",  $page_title,$page_heading,$meta_tags,$meta_dsc,$meta_keys,$page_content,$caninocial_url );
		
			$stmt11->execute();
			$stmt11->store_result();
			// echo " insert done ";
			$rows=$stmt11->affected_rows;
			if($rows>0){
				echo "Meta Added Successfully. ";
				
			}else{
				echo "failed to add Meta";
			}
			
			//code for insert record - END
		}
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
