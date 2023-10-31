<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Brand)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code = $_POST['code'];
$page  = $_POST['page'];
$user_id  = $_POST['user_id'];
$search_namevalue  = $_POST['search_namevalue'];
$payment_type  = $_POST['payment_type'];
$from_date  = $_POST['from_date'];
$to_date  = $_POST['to_date'];

$code = stripslashes($code);
$page =  stripslashes($page);
$user_id =  stripslashes($user_id);
$search_namevalue =  stripslashes($search_namevalue);
$payment_type =  stripslashes($payment_type);
$from_date =  stripslashes($from_date);
$to_date =  stripslashes($to_date);

$error = '';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if ($code == $_SESSION['_token']) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	try {
		if ($_POST['perpage']) {
			$limit = $_POST['perpage'];
		} else {
			$limit = 10;
		}

		$start = ($page - 1) * $limit;
		$totalrow = 0;

		$return = array();

		$query =
			"SELECT
			wallet_summery.user_id,
			appuser_login.fullname,
			appuser_login.phone,
			appuser_login.email,
			`payment_type`,
			`transaction_type`,
			`transaction_id`,
			wallet_transaction_history.created_at AS transaction_date,
			wallet_transaction_history.amount,
			wallet_transaction_history.remark,
			wallet_transaction_history.order_id,
			order_product.prod_id,
			order_product.prod_name,
			wallet_transaction_history.user_id AS order_by,
			appuser_login_order_by.fullname AS order_by_name
			FROM
				wallet_transaction_history
			INNER JOIN
				wallet_summery ON wallet_transaction_history.`wallet_id` = wallet_summery.wallet_id
			INNER JOIN
				appuser_login ON wallet_summery.user_id = appuser_login.user_unique_id
			LEFT JOIN
				order_product ON (wallet_transaction_history.order_id = order_product.order_id)
							AND (wallet_transaction_history.product_id = order_product.prod_id)
			LEFT JOIN
				appuser_login AS appuser_login_order_by ON wallet_transaction_history.user_id = appuser_login_order_by.user_unique_id";

		$whereConditions = [];

		if ($user_id != '') {
			$whereConditions[] = "wallet_summery.user_id = '$user_id'";
		}
		if ($search_namevalue != '') {
			$whereConditions[] = "wallet_transaction_history.transaction_id = '$search_namevalue'";
		}
		if ($payment_type != '') {
			$whereConditions[] = "wallet_transaction_history.payment_type = '$payment_type'";
		}
		if ($from_date != '') {
			$whereConditions[] = "wallet_transaction_history.created_at >= '$from_date 00:00:00'";
		}
		if ($to_date != '') {
			$whereConditions[] = "wallet_transaction_history.created_at <= '$to_date 23:59:59'";
		}

		if (!empty($whereConditions)) {
			$query .= " WHERE " . implode(" AND ", $whereConditions);
		}

		$query .= " LIMIT $start, $limit";

		$stmt = $conn->prepare($query);

		$stmt->execute();

		$result = $stmt->get_result();
		$resultArray = $result->fetch_all(MYSQLI_ASSOC);


		$query2 =
			"SELECT count(wallet_transaction_history.id) FROM wallet_transaction_history INNER JOIN wallet_summery ON wallet_transaction_history.`wallet_id` = wallet_summery.wallet_id";

		if (!empty($whereConditions)) {
			$query2 .= " WHERE " . implode(" AND ", $whereConditions);
		}

		$stmt12 = $conn->prepare($query2);

		$stmt12->execute();
		$stmt12->store_result();
		$stmt12->bind_result($col55);

		while ($stmt12->fetch()) {
			$totalrow = $col55;
		}

		$page_html =  $Common_Function->pagination('getTransactions', $page, $limit, $totalrow);

		echo json_encode(array("status" => 1, "page_html" => $page_html, "data" => $resultArray, "totalrowvalue" => $totalrow));
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
