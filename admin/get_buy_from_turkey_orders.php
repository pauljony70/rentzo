<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Brand)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code = $_POST['code'];
$page  = $_POST['page'];

$code = stripslashes($code);
$page =  stripslashes($page);

$error = '';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
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

		$start = ($page - 1) * $limit;
		$totalrow = 0;

		$status = 0;
		$msg = "Unable to Get Data";
		$return = array();

		// echo "class id is  ".$class_id;     
		$inactive = "active";
		$stmt = $conn->prepare("SELECT buy_from_another_country_requests.id, order_id, user_id, fullname, phone, email, product_link, product_quantity, product_size, product_color, product_des, product_img_1, product_img_2, buy_from_another_country_requests.status, remarks, created_at FROM buy_from_another_country_requests, appuser_login WHERE buy_from_another_country_requests.user_id = appuser_login.user_unique_id ORDER BY created_at DESC LIMIT  " . $start . ", " . $limit . "");
		$stmt->execute();
		$data = $stmt->bind_result($id, $order_id, $user_id, $fullname, $phone, $email, $product_link, $product_quantity, $product_size, $product_color, $product_des, $product_img_1, $product_img_2, $status, $remarks, $created_at);
		$return = array();
		$i = 0;
		while ($stmt->fetch()) {
			$return[$i] =
				array(
					'id'           		=> $id,
					'order_id'          => $order_id,
					'user_id'           => $user_id,
					'fullname'          => $fullname,
					'phone'           	=> $phone,
					'email'           	=> $email,
					'product_link'      => $product_link,
					'product_quantity'  => $product_quantity,
					'product_size'      => $product_size,
					'product_color'     => $product_color,
					'product_des'       => $product_des,
					'product_img_1'     => MEDIAURL . $product_img_1,
					'product_img_2'     => MEDIAURL . $product_img_2,
					'status'            => $status,
					'remarks'           => $remarks,
					'created_at'        => date('d M, Y h:i A', strtotime($created_at))
				);
			$i = $i + 1;
			$status = 1;
			$msg = "Details here";
			// echo " array created".json_encode($return);
		}

		$information = array(
			'status' => $status,
			'msg' =>   $msg,
			'data' => $return
		);


		$stmt12 = $conn->prepare("SELECT count(id) FROM buy_from_another_country_requests");

		$stmt12->execute();
		$stmt12->store_result();
		$stmt12->bind_result($col55);

		while ($stmt12->fetch()) {
			$totalrow = $col55;
		}

		$page_html =  $Common_Function->pagination('getBuyFromTurkeyOrders', $page, $limit, $totalrow);

		echo json_encode(array("status" => 1, "page_html" => $page_html, "data" => $return, "totalrowvalue" => $totalrow));
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
