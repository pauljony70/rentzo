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
$datetime = date('Y-m-d H:i:s');

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
		$page_html = '';

		$return = array();
		$i = 0;

		$order_by = "ORDER BY pd.prod_name ASC";

		if (isset($_POST['prod_name']) && $_POST['prod_name'] != "" && $_POST['offer'] == 0) {
			$search_text = trim(strip_tags($_POST['prod_name']));
			$query = "SELECT pd.product_unique_id, pd.prod_name, pd.featured_img, offer_start_date, offer_end_date  FROM product_details pd INNER JOIN vendor_product vp ON vp.product_id = pd.product_unique_id WHERE (offer_end_date IS NULL OR vp.offer_end_date < '" . $datetime . "') AND (pd.prod_name LIKE '%" . $search_text . "%' OR pd.product_sku LIKE '%" . $search_text . "%') AND pd.status = '1'" . $order_by . " LIMIT ?, ?";
		} else if (!isset($_POST['prod_name']) && !$_POST['prod_name'] != "" && $_POST['offer'] == 1) {
			$query = "SELECT pd.product_unique_id, pd.prod_name, pd.featured_img, offer_start_date, offer_end_date  FROM product_details pd INNER JOIN vendor_product vp ON vp.product_id = pd.product_unique_id WHERE offer_start_date IS NOT NULL AND offer_end_date IS NOT NULL AND pd.status = '1'" . $order_by . " LIMIT ?, ?";
			$stmt12 = $conn->prepare("SELECT count(pd.id)  FROM product_details pd INNER JOIN vendor_product vp ON vp.product_id = pd.product_unique_id WHERE offer_start_date IS NOT NULL AND offer_end_date IS NOT NULL AND pd.status = '1'");
			$stmt12->execute();
			$stmt12->store_result();
			$stmt12->bind_result($col55);
			while ($stmt12->fetch()) {
				$totalrow = $col55;
			}
			$page_html =  $Common_Function->pagination('getOfferProducts', $page, $limit, $totalrow);
		} else if (isset($_POST['prod_name']) && $_POST['prod_name'] != "" && $_POST['offer'] == 1) {
			$search_text = trim(strip_tags($_POST['prod_name']));
			$query = "SELECT pd.product_unique_id, pd.prod_name, pd.featured_img, offer_start_date, offer_end_date  FROM product_details pd INNER JOIN vendor_product vp ON vp.product_id = pd.product_unique_id WHERE (offer_start_date IS NOT NULL AND offer_end_date IS NOT NULL) AND (pd.prod_name LIKE '%" . $search_text . "%' OR pd.product_sku LIKE '%" . $search_text . "%') AND pd.status = '1'" . $order_by . " LIMIT ?, ?";
			$stmt12 = $conn->prepare("SELECT count(pd.id)  FROM product_details pd INNER JOIN vendor_product vp ON vp.product_id = pd.product_unique_id WHERE (offer_start_date IS NOT NULL AND offer_end_date IS NOT NULL) AND (pd.prod_name LIKE '%" . $search_text . "%' OR pd.product_sku LIKE '%" . $search_text . "%') AND pd.status = '1'");
			$stmt12->execute();
			$stmt12->store_result();
			$stmt12->bind_result($col55);
			while ($stmt12->fetch()) {
				$totalrow = $col55;
			}
			$page_html =  $Common_Function->pagination('getOfferProducts', $page, $limit, $totalrow);
		}

		$stmt = $conn->prepare($query);

		$stmt->bind_param("ii", $start, $limit);
		$stmt->execute();
		$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5);

		$tbl_html =  '';


		$product_arr = array();
		$product_arr_final = array();
		while ($stmt->fetch()) {
			$product_arr['product_unique_id'] = $col1;
			$product_arr['prod_name'] = $col2;
			$product_arr['featured_img'] = $col3;
			$product_arr['offer_start_date'] = date("d M, Y H:i A", strtotime($col4));
			$product_arr['offer_end_date'] = date("d M, Y H:i A", strtotime($col5));
			if ($datetime >= $col4 && $datetime <= $col5) {
				$product_arr['offer_status'] = 'Active';
			} elseif ($datetime < $col4) {
				$product_arr['offer_status'] = 'Not Started';
			} else {
				$product_arr['offer_status'] = 'Inactive';
			}
			$product_arr_final[] = $product_arr;
		}

		$i = 1;
		foreach ($product_arr_final as $key => $products) {

			$imgarray = json_decode($products['featured_img'], true);

			$product_arr_final[$key]['featured_img'] = MEDIAURL . $imgarray['72-72'];
		}

		echo json_encode(array("status" => 1, "tbl_html" => $product_arr_final, "page_html" => $page_html, "totalrowvalue" => $totalrow));
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
