<?php

include('session.php');
include('encryptfun.php');
global $publickey_server;

$code = $_POST['code'];
$page  = $_POST['page'];

$code = stripslashes($code);
$page =  stripslashes($page);

$error = '';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
} else

if ($code == $_SESSION['_token']) {

	try {
		$encruptfun = new encryptfun();
		if ($_POST['perpage']) {
			$limit = $_POST['perpage'];
		} else {
			$limit = 10;
		}

		$start = ($page - 1) * $limit;
		$totalrow = 0;

		$status = 0;
		$msg = "Unable to Get Data";
		$data = array();

		$sql = "SELECT ww.id, ww.amount, al.fullname, ww.created_at, ww.payment_status, ww.transaction_id, wallet_transaction_id, ww.user_id, bd.account_holder_name, bd.account_number, bd.bank_name, bd.bank_address 
        FROM wallet_withdraw ww
        JOIN appuser_login al ON al.user_unique_id = ww.user_id
        JOIN bank_details bd ON bd.user_id = ww.user_id
        ORDER BY ww.id DESC
        LIMIT ?, ?";

		$stmt = $conn->prepare($sql);

		// Check if the statement preparation was successful
		if ($stmt) {
			$stmt->bind_param("ii", $start, $limit);
			$stmt->execute();
			$stmt->bind_result($id, $amount, $name, $created_at, $payment_status, $transaction_id, $wallet_transaction_id, $user_id, $account_holder_name, $account_number, $bank_name, $bank_address);

			// Fetch and process the results
			while ($stmt->fetch()) {
				$row = array(
					'id' => $id,
					'amount' => $amount,
					'fullname' => $name,
					'created_at' => $created_at,
					'payment_status' => $payment_status,
					'transaction_id' => $transaction_id == null ? '' : $transaction_id,
					'wallet_transaction_id' => $wallet_transaction_id,
					'user_id' => $user_id,
					'account_holder_name' => $account_holder_name,
					'account_number' => $encruptfun->decrypt($publickey_server, $account_number),
					'bank_name' => $bank_name,
					'bank_address' => $bank_address
				);
				$data[] = $row;
				$status = 1;

				$msg = "Details here";
			}

			// Close the statement
			$stmt->close();
		}

		$information = array(
			'status' => $status,
			'msg' =>   $msg,
			'data' => $data
		);





		$stmt12 = $conn->prepare("SELECT count(ww.id) FROM wallet_withdraw ww,appuser_login al WHERE  al.user_unique_id = ww.user_id ");

		$stmt12->execute();
		$stmt12->store_result();
		$stmt12->bind_result($col55);


		while ($stmt12->fetch()) {

			$totalrow = $col55;
		}



		$page_html =  $Common_Function->pagination('getWalletWithdrawRequests', $page, $limit, $totalrow);



		echo json_encode(array("status" => 1, "page_html" => $page_html, "data" => $data, "totalrowvalue" => $totalrow));
	} catch (PDOException $e) {

		echo "Error: " . $e->getMessage();
	}
}
