<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$attribute_set_id = $_POST['attribute_set_id'];
$product_id = $_POST['product_id'];

$code = stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);
$attribute_set_id =  stripslashes($attribute_set_id);
$product_id =  stripslashes($product_id);

$error = '';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token']) {

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
		if (empty($attribute_set_id) && empty($product_id)) {
			$stmt = $conn->prepare("SELECT id, attribute, attribute_ar, status FROM product_info_set ORDER BY created_at ASC LIMIT  " . $start . ", " . $limit . "");
			//$stmt->bind_param( s,  $inactive );
			$stmt->execute();
			$data = $stmt->bind_result($col1, $col2, $col3, $col4);
			$return = array();
			$i = 0;
			while ($stmt->fetch()) {

				$return[$i] =
					array(
						'id' => $col1,
						'attribute' => $col2,
						'attribute_ar' => $col3,
						'statuss' => $col4
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


			$stmt12 = $conn->prepare("SELECT count(id) FROM product_info_set ");

			$stmt12->execute();
			$stmt12->store_result();
			$stmt12->bind_result($col55);

			while ($stmt12->fetch()) {
				$totalrow = $col55;
			}

			$page_html =  $Common_Function->pagination('attribute_set_product', $page, $limit, $totalrow);
		} else if (!empty($attribute_set_id) && empty($product_id)) {
			$stmt = $conn->prepare("SELECT product_info_set_id, attribute, attribute_ar FROM attribute_set_product_info, product_info_set WHERE attribute_set_id = '" . $attribute_set_id . "' AND product_info_set.id = product_info_set_id ORDER By product_info_set.created_at ASC;");
			//$stmt->bind_param( s,  $inactive );
			$stmt->execute();
			$data = $stmt->bind_result($product_info_set_id, $attribute_name, $attribute_name_ar);
			$return = array();
			$i = 0;
			while ($stmt->fetch()) {

				$return[$i] =
					array(
						'product_info_set_id' => $product_info_set_id,
						'attribute' => $attribute_name,
						'attribute_ar' => $attribute_name_ar
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

			foreach ($return as $key => $value) {
				$stmt18 = $conn->prepare("SELECT id, product_info_set_value, product_info_set_value_ar FROM product_info_set_val WHERE product_info_set_id = '" . $value['product_info_set_id'] . "' ORDER By id ASC;");
				$stmt18->execute();
				$data = $stmt18->bind_result($product_info_set_value_id, $product_info_set_value, $product_info_set_value_ar);
				$product_info_set_val_data = array();
				$i = 0;
				while ($stmt18->fetch()) {

					$product_info_set_val_data[$i] =
						array(
							'product_info_set_value_id' => $product_info_set_value_id,
							'product_info_set_value' => $product_info_set_value,
							'product_info_set_value_ar' => $product_info_set_value_ar
						);
					$i++;
					// echo " array created".json_encode($return);
				}
				$return[$key]['product_info_set_val_data'] = $product_info_set_val_data;
			}

			$page_html = '';
		} else {
			$stmt = $conn->prepare("SELECT product_info_set_id, attribute, attribute_ar FROM attribute_set_product_info, product_info_set WHERE attribute_set_id = '" . $attribute_set_id . "' AND product_info_set.id = product_info_set_id ORDER By product_info_set.created_at ASC;");
			//$stmt->bind_param( s,  $inactive );
			$stmt->execute();
			$data = $stmt->bind_result($product_info_set_id, $attribute_name, $attribute_name_ar);
			$return = array();
			$i = 0;
			while ($stmt->fetch()) {

				$return[$i] =
					array(
						'product_info_set_id' => $product_info_set_id,
						'attribute' => $attribute_name,
						'attribute_ar' => $attribute_name_ar
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

			foreach ($return as $key => $value) {
				$stmt18 = $conn->prepare("SELECT id, product_info_set_value, product_info_set_value_ar FROM product_info_set_val WHERE product_info_set_id = '" . $value['product_info_set_id'] . "' ORDER By id ASC;");
				$stmt18->execute();
				$data = $stmt18->bind_result($product_info_set_value_id, $product_info_set_value, $product_info_set_value_ar);
				$product_info_set_val_data = array();
				$i = 0;
				while ($stmt18->fetch()) {

					$product_info_set_val_data[$i] =
						array(
							'product_info_set_value_id' => $product_info_set_value_id,
							'product_info_set_value' => $product_info_set_value,
							'product_info_set_value_ar' => $product_info_set_value_ar
						);
					$i++;
					// echo " array created".json_encode($return);
				}
				$return[$key]['product_info_set_val_data'] = $product_info_set_val_data;
			}

			foreach ($return as $key => $value) {
				$stmt19 = $conn->prepare("SELECT DISTINCT product_info_set_val_id FROM product_info WHERE product_info_set_id = '" . $value['product_info_set_id'] . "' AND prod_id = '" . $product_id . "' ORDER By id ASC;");
				$stmt19->execute();
				$data = $stmt19->bind_result($selected_product_info_set_val_id);
				$selected_product_info_set_val_data = array();
				$i = 0;
				while ($stmt19->fetch()) {

					$selected_product_info_set_val_data[$i] =
						array(
							'selected_product_info_set_val_id' => $selected_product_info_set_val_id,
						);
					$i++;
					// echo " array created".json_encode($return);
				}
				$return[$key]['selected_product_info_set_val_data'] = $selected_product_info_set_val_data;
			}



			$page_html = '';
		}

		echo json_encode(array("status" => 1, "page_html" => $page_html, "data" => $return, "totalrowvalue" => $totalrow));
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
