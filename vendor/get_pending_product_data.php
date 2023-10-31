<?php

include('session.php');




$code  = $_POST['code'];

$page  = $_POST['page'];

$rowno = $_POST['rowno'];

$error = ''; // Variable To Store Error Message



$code = stripslashes($code);

$page =  stripslashes($page);

$rowno =  stripslashes($rowno);

if ($code == $_SESSION['_token']) {

	try {

		if ($_POST['perpage']) {

			$limit = $_POST['perpage'];
		} else {

			$limit = 10;
		}



		$start = ($page - 1) * $limit;

		$totalrow = 0;





		$return = array();

		$i = 0;


		$selectseller = $_SESSION['admin'];

		$order_by = "ORDER BY pd.created_at DESC";


		if (isset($_POST['prod_name'])) {

			$search_text = trim(strip_tags($_POST['prod_name']));



			$query = "SELECT pd.product_unique_id, pd.prod_name, pd.featured_img,  pd.status ,brand.brand_name,pd.product_sku  FROM product_details pd,brand,vendor_product vp WHERE brand.brand_id  = pd.brand_id AND vp.product_id =pd.product_unique_id AND vp.vendor_id ='" . $selectseller . "' and  (pd.product_unique_id like '%" . $search_text . "%'  OR pd.prod_name like '%" . $search_text . "%'  OR pd.product_sku like '%" . $search_text . "%'  )

				AND pd.status NOT IN(1,3)  " . $order_by . " LIMIT ?, ?";



			$query_total = "SELECT count(pd.product_unique_id) FROM product_details pd,brand,vendor_product vp WHERE brand.brand_id  = pd.brand_id AND vp.product_id =pd.product_unique_id AND vp.vendor_id ='" . $selectseller . "' AND (pd.product_unique_id like '%" . $search_text . "%'  OR pd.prod_name like '%" . $search_text . "%'  OR pd.product_sku like '%" . $search_text . "%'  ) AND pd.status NOT IN(1,3) ";
		} else {

			$query = "SELECT pd.product_unique_id, pd.prod_name, pd.featured_img,  pd.status ,brand.brand_name,pd.product_sku

				FROM product_details pd,brand,vendor_product vp WHERE brand.brand_id  = pd.brand_id AND vp.product_id =pd.product_unique_id AND vp.vendor_id ='" . $selectseller . "' AND pd.status NOT IN(1,3)   " . $order_by . " LIMIT ?, ?";



			$query_total = "SELECT count(pd.product_unique_id) FROM product_details pd,brand,vendor_product vp WHERE brand.brand_id  = pd.brand_id AND vp.product_id =pd.product_unique_id AND vp.vendor_id ='" . $selectseller . "' AND pd.status NOT IN(1,3)  ";
		}



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

			$tbl_html .=  '<td><img height="72" src="' . $imageurl . '"></td>';

			$tbl_html .=  '<td>' . $products['product_unique_id'] . '</td>';

			$tbl_html .=  '<td>' . $products['prod_name'] . '</td>';

			$tbl_html .=  '<td>' . $products['product_sku'] . '</td>';

			$tbl_html .=  '<td>' . $products['brand_name'] . '</td>';

			$tbl_html .=  '<td>' . implode(', ', $Common_Function->get_cat($products['product_unique_id'], $conn)) . '</td>';

			$tbl_html .=  '<td>Pending</td></tr>';



			$i++;
		}

		$stmt12 = $conn->prepare($query_total);

		$stmt12->execute();

		$stmt12->store_result();

		$stmt12->bind_result($col55);



		while ($stmt12->fetch()) {

			$totalrow = $col55;
		}



		$page_html =  $Common_Function->pagination('pagination_product', $page, $limit, $totalrow);

		echo json_encode(array("status" => 1, "page_html" => $page_html, "tbl_html" => $tbl_html, "totalrowvalue" => $totalrow));
	} catch (PDOException $e) {

		echo "Error: " . $e->getMessage();
	}
}
