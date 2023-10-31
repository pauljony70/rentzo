<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $CouponCode)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code = $_POST['code'];

$code = stripslashes($code);

$error = '';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token'] && $_POST['deletearray']) {

	try {

		$stmt12 = $conn->prepare("DELETE FROM coupancode WHERE sno = '" . trim($_POST['deletearray']) . "' ");

		$stmt12->execute();

		echo 'Deleted';
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
} else if ($code == $_SESSION['_token'] && $_POST['deactiveid'] && $_POST['status']) {

	try {

		$stmt12 = $conn->prepare("UPDATE coupancode SET activate ='" . trim($_POST['status']) . "' WHERE sno = '" . trim($_POST['deactiveid']) . "' ");

		$stmt12->execute();

		echo 'done';
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
} else if ($code == $_SESSION['_token']) {

	try {

		if ($_POST['perpage']) {
			$limit = $_POST['perpage'];
		} else {
			$limit = 10;
		}

		$start = ($page - 1) * $limit;
		$totalrow = 0;

		$status = 0;
		$parentname = "";
		$stmt = $conn->prepare("SELECT sno, name, value, fromdate, todate, activate, cap_value, min_order,user_apply FROM coupancode ORDER BY sno DESC");

		$stmt->execute();
		$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
		$return = array();
		$i = 0;
		while ($stmt->fetch()) {
			$status = 1;

			if ($col4 == '0000-00-00') {
				$col4 = '-';
			}
			if ($col5 == '0000-00-00') {
				$col5 = '-';
			}
			$return[$i] =
				array(
					'id' => $col1,
					'name' => $col2,
					'value' => $col3,
					'fromdate' => $col4,
					'todate' => $col5,
					'activate' => $col6,
					'cap_value' => $col7,
					'user_apply' => $col9,
					'minorder' => $col8
				);
			$i = $i + 1;
			// echo " array created".json_encode($return);
		}

		$stmt12 = $conn->prepare("SELECT count(sno) FROM coupancode ");

		$stmt12->execute();
		$stmt12->store_result();
		$stmt12->bind_result($col55);

		while ($stmt12->fetch()) {
			$totalrow = $col55;
		}

		$page_html =  $Common_Function->pagination('brand_product', $page, $limit, $totalrow);
		echo json_encode(array("status" => 1, "page_html" => $page_html, "data" => $return, "totalrowvalue" => $totalrow));
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
