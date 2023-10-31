<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Brand)){
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
           
		$stmt = $conn->prepare("SELECT id FROM product_details WHERE brand_id=? ");
		$stmt->bind_param( "i",  $deletearray );
		$stmt->execute();	 
		$data = $stmt->bind_result( $prod_id);
		$return = array();
		
		$product_count = "N";
		
		while ($stmt->fetch()) { 
		   $product_count = "Y";
		  
		}
		
		if($product_count == "Y"){
			
			 $html ='<div>
			
			<div class="form-group"> 
			 <h4 class="notess">The select brand already assign to some products. You can\'t delete the brand if it is assign to a product. Please assign the 
	  product to other brand by selecting the option from the below list. </h4>
				<label for="name">Select Brand</label> 
				<select class="form-control1" id="brand_assign_id" name="brand_assign_id"  required>
				<option value="">Select</option>';
				
					$stmt = $conn->prepare("SELECT brand_id, brand_name FROM brand WHERE brand_id != '".$deletearray."' AND status ='1' ORDER BY brand_name ASC ");
					
					$stmt->execute();	 
					$data = $stmt->bind_result( $col1, $col2);
					
					while ($stmt->fetch()) {
						$html .=' <option value="'.$col1.'">'.$col2.'</option>';
					}
			
			$html .='</select>
			</div>
			
			<input type="hidden" class="form-control" id="delete_brand_id" value="'.$deletearray.'"> 
            <button type="submit" class="btn btn-default" value="Upload" href="javascript:void(0)" onclick="assign_brand_btn();">Assign Brand </button> 
		</div> ';
		echo $html;
		}else{				
			$Common_Function->delete_product_brand($deletearray, $conn,$media_path,$img_dimension_arr);
		}
            	 
        
        die;
    }else{
       
    }
} else if( $code == $_SESSION['_token'] && isset($_POST['delete_brand_id']) && isset($_POST['brand_assign_id'])){
	$stmt11 = $conn->prepare("UPDATE product_details SET brand_id =? WHERE brand_id = '".trim($_POST['delete_brand_id'])."'");
    $stmt11->bind_param("i", trim($_POST['brand_assign_id']));
    $stmt11->execute();
    $rows=$stmt11->affected_rows;
	$Common_Function->delete_product_brand($_POST['delete_brand_id'], $conn,$media_path,$img_dimension_arr);
}
?>
