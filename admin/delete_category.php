<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Category)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code = $_POST['code'];

$code =  stripslashes($code);

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if ($code == $_SESSION['_token'] && isset($_POST['cat_id'])) {


	$deletearray = $_POST['cat_id'];
	$deletearray =   stripslashes($deletearray);



	if (isset($deletearray) && !empty($deletearray)) {

		$stmt = $conn->prepare("SELECT id FROM product_category WHERE cat_id=? ");
		$stmt->bind_param("i",  $deletearray);
		$stmt->execute();
		$data = $stmt->bind_result($prod_id);
		$return = array();

		$product_count = "N";

		while ($stmt->fetch()) {
			$product_count = "Y";
		}

		$stmt22 = $conn->prepare("SELECT cat_id FROM category WHERE parent_id=? ");
		$stmt22->bind_param("i",  $deletearray);
		$stmt22->execute();
		$data = $stmt22->bind_result($prod_id);
		$return = array();

		$subcat_count = "N";

		while ($stmt22->fetch()) {
			$subcat_count = "Y";
		}

		if ($product_count == "Y") {

			$html = '<div>
			
			<div class="form-group"> 
			<h6 class="text-muted notess">The select category already assign to some products. You can\'t delete the category if it is assign to a product. Please assign the 
	  product to other category by selecting the option from the below list. </h6>
				
				<label for="name">Select Category</label> 
					
				<div class="">
					<div id="treeSelect" class="pt-2 pl-2">';

			$query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND status ='1' ORDER BY cat_name ASC");

			if ($query->num_rows > 0) {
				while ($row = $query->fetch_assoc()) {
					if ($row['cat_id'] != $deletearray) {
						$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1' ");
						if ($query1->num_rows > 0) {
							$html .= '<span class="expand" ><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit_assign"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
												<br />    
												<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';
							$html .= categoryTree($row['cat_id'], $deletearray);
							$html .= '</ul>';
						} else {
							$html .= '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit_assign"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
												<br />';
						}
					}
				}
			}
			$html .= '</div> 						
				</div>
			</div>
			
			<input type="hidden" class="form-control" id="delete_cat_id" value="' . $deletearray . '"> 
            <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" onclick="assign_brand_btn();">Assign Category </button> 
			</div> ';
			echo $html;
		} else if ($subcat_count == "Y") {
			echo "Please delete Sub Category first.";
		} else {
			$Common_Function->delete_product_category($deletearray, $conn, $media_path, $img_dimension_arr);
		}


		die;
	} else {
	}
} else if ($code == $_SESSION['_token'] && isset($_POST['delete_cat_id']) && isset($_POST['cat_assign_id'])) {
	$stmt11 = $conn->prepare("UPDATE product_category SET cat_id =? WHERE cat_id = '" . trim($_POST['delete_cat_id']) . "'");
	$stmt11->bind_param("i", trim($_POST['cat_assign_id']));
	$stmt11->execute();
	$rows = $stmt11->affected_rows;
	$Common_Function->delete_product_category($_POST['delete_cat_id'], $conn, $media_path, $img_dimension_arr);
}


function categoryTree($parent_id, $deletearray)
{
	global $conn;
	$query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id  AND status ='1' ORDER BY cat_name ASC");

	if ($query->num_rows > 0) {
		while ($row = $query->fetch_assoc()) {
			if ($row['cat_id'] != $deletearray) {
				$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1' ");
				if ($query1->num_rows > 0) {
					$html .= '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit_assign"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
						<br />    
						<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';
					$html .= categoryTree($row['cat_id'], $deletearray);
					$html .= '</ul>';
				} else {
					$html .= '<li><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit_assign"> ' . $row['cat_name'] . '</li>';
				}
			}
		}
	}
	return $html;
}
