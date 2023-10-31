<?php 

	include('session.php');
	$code = $_POST['code'];
	$name = $_POST['namevalue'];
	$make_parent = $_POST['make_parent'];
	$name_ar = $_POST['name_ar'];
	$parentid1 = $_POST['parent_cat'];
	$error='';  // Variable To Store Error Message
	
	$code=   stripslashes($code);
	$name =   stripslashes($name);
	$parentid1 =   stripslashes($parentid1);
	
	if(!isset($_SESSION['admin'])){
		header("Location: index.php");
		// echo " dashboard redirect to index";
	}else if($code == $_SESSION['_token'] && isset($name)   && !empty($name)  ) {
       
        $exist = false;
        $stmt = $conn->prepare("SELECT cat_id FROM category WHERE cat_name=?");
    	$stmt->bind_param( "s",   $name );
    	$stmt->execute();	 
     	$data = $stmt->bind_result( $col1);
        $return = array();

		while ($stmt->fetch()) { 
			$exist = true;
        }
    	    
    	if( $exist){
			echo "Category name already exist. Please choose another name.";
    	      
    	}  else{
			//code for upload images - START
			$file ='';
			if($_FILES['file']['name']){	
				$Common_Function->img_dimension_arr = $img_dimension_arr;
				$profile_pic1 = $Common_Function->file_upload('file',$media_path);			
				$file = json_encode($profile_pic1);			
			}
            	  
			if($make_parent == 'yes'){
				$parentid = 0;
			}else{
				$parentid = $parentid1;
			}
			
			$status = 0;
			
			$cat_slug = $Common_Function->makeurlnamebyname($name);
                
			$stmt11 = $conn->prepare("INSERT INTO category( cat_name, cat_img, parent_id,status,created_at,created_by,cat_slug ,cat_name_ar)  VALUES (?,?,?,?,?,?,?,?)");
        	$stmt11->bind_param( "ssiissss",  $name, $file, $parentid ,$status,$datetime ,$_SESSION['admin'],$cat_slug,$name_ar);
        	 
            $stmt11->execute();
            $stmt11->store_result();
            $rows=$stmt11->affected_rows;
            if($rows>0){
                echo "Category Added Successfully.Please wait untill admin Approved.";
				
				$link = BASEURL."admin/pending_category.php";	
				$Common_Function->send_email_seller_new($conn,$_SESSION['seller_name'],$link,'Category', "New Category Request",$name);
                
            }else{
                echo "failed to add category";
            }    
    	      
    	  }
        	
    	 
    }else{
            echo "failed to add category.";
    }
    die;
?>
