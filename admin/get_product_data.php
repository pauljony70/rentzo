<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

$code  = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$catid = $_POST['catid'];
$error = ''; // Variable To Store Error Message

$code = stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);
$catid =  stripslashes($catid);

//echo " value ".$page."---".$rowno."---".$sortcat;
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if ($code == $_SESSION['_token']) {
	try {
		if ($_POST['perpage']) {
			$limit = $_POST['perpage'];
		} else {
			$limit = 10;
		}

		$_SESSION['prod_per_pagea'] = $_POST['perpage'];
		$_SESSION['page_noa'] = $_POST['page'];

		$start = ($page - 1) * $limit;
		$totalrow = 0;


		$return = array();
		$i = 0;

		$cat_data = '';
		if (isset($_POST['catid']) && $_POST['catid'] != "blank") {
			$cat_data = " and product_category.cat_id ='" . $catid . "'";
		}


		$order_by = "ORDER BY pd.prod_name ASC";

		if (isset($_POST['prod_name']) && $_POST['prod_name'] != "") {
			$search_text = trim(strip_tags($_POST['prod_name']));

			$query = "SELECT pd.product_unique_id, pd.prod_name, pd.featured_img,  pd.status ,brand.brand_name,pd.product_sku  FROM product_details pd,brand,product_category WHERE brand.brand_id  = pd.brand_id and product_category.prod_id = pd.product_unique_id AND (pd.product_unique_id like '%" . $search_text . "%'  OR pd.prod_name like '%" . $search_text . "%'  OR pd.product_sku like '%" . $search_text . "%'  )
				AND pd.status IN(1,3) " . $cat_data . " group by pd.product_unique_id  " . $order_by . " LIMIT ?, ?";

			$query_total = "SELECT count(pd.product_unique_id) FROM product_details pd,brand,product_category WHERE brand.brand_id  = pd.brand_id and product_category.prod_id = pd.product_unique_id AND (pd.product_unique_id like '%" . $search_text . "%'  OR pd.prod_name like '%" . $search_text . "%'  OR pd.product_sku like '%" . $search_text . "%'  ) AND pd.status IN(1,3) " . $cat_data . " group by pd.product_unique_id   ";
		} else {
			$query = "SELECT pd.product_unique_id, pd.prod_name, pd.featured_img,  pd.status ,brand.brand_name,pd.product_sku FROM product_details pd,brand,product_category WHERE brand.brand_id  = pd.brand_id and product_category.prod_id = pd.product_unique_id AND pd.status IN(1,3) " . $cat_data . " group by pd.product_unique_id  " . $order_by . " LIMIT ?, ?";

			$query_total = "SELECT count(pd.product_unique_id) FROM product_details pd,brand,product_category WHERE brand.brand_id  = pd.brand_id and product_category.prod_id = pd.product_unique_id AND pd.status IN(1,3) " . $cat_data . " group by pd.product_unique_id ";
		}

		//print_r($query);
		$stmt = $conn->prepare($query);

		$stmt->bind_param("ii", $start, $limit);
		$stmt->execute();
		$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
		//  echo " get col data ";
		$tbl_html =  '';


		$product_arr = array();
		$product_arr_final = array();
		while ($stmt->fetch()) {
			$product_arr['product_unique_id'] = $col1;
			$product_arr['prod_name'] = $col2;
			$product_arr['featured_img'] = $col3;
			$product_arr['status'] = $col4;
			$product_arr['brand_name'] = $col5;
			$product_arr['product_sku'] = $col6;
			$product_arr_final[] = $product_arr;
		}

		$i = 1;
		foreach ($product_arr_final as $products) {
			$cat_names = array();
			//get_cat($col1,$conn);

			$checked =  '';
			if ($products['status'] == 1) {
				$checked =  'checked';
			}

			$imgarray = json_decode($products['featured_img'], true);
			$sr = ($page - 1) * $limit + $i;
			$imageurl = MEDIAURL . $imgarray['72-72'];
			$tbl_html .=  '<tr id="tr' . $products['product_unique_id'] . '"><td>' . $sr . '</td>';
			$tbl_html .=  '<td><img height="72px" src="' . $imageurl . '"></td>';
			$tbl_html .=  '<td>' . $products['product_unique_id'] . '</td>';
			$tbl_html .=  '<td>' . $products['prod_name'] . '</td>';
			$tbl_html .=  '<td>' . $products['product_sku'] . '</td>';
			$tbl_html .=  '<td>' . $products['brand_name'] . '</td>';
			$tbl_html .=  '<td>' . implode(', ', $Common_Function->get_cat($products['product_unique_id'], $conn)) . '</td>';
			$tbl_html .=  '<td>
                        <label class="switch">
                        <input class="switch-input enable_prod' . $sr . '" type="checkbox" id="togglebtn" onclick="enable_disable_product(\'' . $sr . '\',\'' . $products['product_unique_id'] . '\');" name="enableproduct" ' . $checked . ' value="1"/>
                        <span class="switch-label" data-on="On" data-off="Off"></span> 
                        <span class="switch-handle"></span> 
                        </label> 	    
                     	</td>';
			$tbl_html .=  '<td>
								<div class="dropdown">
									<button class="btn btn-dark waves-effect waves-light dropdown-toggle w-100" type="button" data-toggle="dropdown">Select<span class="caret"></span></button>
									<div class="dropdown-menu dropdown-menu-right" style="width:104px;">
										<a class="dropdown-item" href="view_product.php?id=' . $products['product_unique_id'] . '"><i class="fa fa-eye"></i> View</a>
										<a class="dropdown-item" href="edit_product.php?id=' . $products['product_unique_id'] . '"><i class="fa fa-edit"></i> Edit</a>
										<a class="dropdown-item" href="javascript:void(0)" onclick=delete_products("' . $products['product_unique_id'] . '")><i class="fa fa-trash"></i> Delete</a>
									</ul>
								</div>
							</td></tr>';
			$i++;
		}

		$stmt12 = $conn->prepare($query_total);

		$stmt12->execute();
		$stmt12->store_result();
		$stmt12->bind_result($col55);
		
		$totalrow = number_format($stmt12->num_rows);

		/*while ($stmt12->fetch()) {
			$totalrow = $col55;
		}*/

		$page_html =  $Common_Function->pagination('pagination_product', $page, $limit, $totalrow);
		echo json_encode(array("status" => 1, "page_html" => $page_html, "tbl_html" => $tbl_html, "totalrowvalue" => $totalrow));
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
