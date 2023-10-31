<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Category)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}
$code = $_POST['code'];
$parentid = $_POST['parentid'];

$code =  stripslashes($code);
$parentid =   stripslashes($parentid);

$error = '';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else
	if ($code == $_SESSION['_token'] && isset($_POST['get_category']) == 'yes') {
?>
	<form class="form" id="add_category_form">
		<div class="form-group d-flex align-items-center">
			<label for="name" class="mb-0 mr-2">Make Parent Category</label>
			<input type="checkbox" id="make_parent_cat" onclick="make_parent_cat1();">
		</div>
		<div class="form-group" id="parent_cat_div">
			<label for="name">Parent Category</label>
			<div class="dropdownss">
				<div id="treeSelect">
					<div class="p-2">
						<?php

						$query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND status ='1' ORDER BY cat_name ASC");

						if ($query->num_rows > 0) {
							while ($row = $query->fetch_assoc()) {
								$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1'");
								if ($query1->num_rows > 0) {
									echo '<span class="expand" ><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
											<br />    
											<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';
									echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
									echo	'</ul>';
								} else {
									echo '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
											<br />';
								}
							}
						}

						?>
					</div>
				</div>

			</div>

		</div>

	</form>
	<script>
		function make_parent_cat1() {
			if ($("#make_parent_cat").prop('checked') == true) {
				$("#parent_cat_div").hide();
				$(".catbanners").show();
			} else {
				$("#parent_cat_div").show();
				$(".catbanners").hide();
				$('#web_banner').val('');
				$('#app_banner').val('');
			}
		}
	</script>
<?php
} else if ($code == $_SESSION['_token']) {

	try {

		$stmt1 = $conn->prepare("SELECT count(cat_id) as counts FROM category where parent_id = ? AND status IN(1,3)");
		$stmt1->bind_param("i",  $parentid);
		$stmt1->execute();
		$data1 = $stmt1->bind_result($counts);
		$count_order  = 0;
		while ($stmt1->fetch()) {
			$count_order = $counts;
		}

		// echo "class id is  ".$class_id;     
		$inactive = "active";
		$parentname = "";
		$stmt = $conn->prepare("SELECT cat_id, cat_name, cat_img, parent_id, cat_order,status, (SELECT count(cat_id) FROM category where parent_id = c.cat_id  AND status IN(1,3) ),commission_fees,web_banner,app_banner,cat_name_ar,sub_title, sub_title_ar FROM category c WHERE parent_id=? AND status IN(1,3) ORDER BY cat_order ASC");
		$stmt->bind_param("i",  $parentid);
		$stmt->execute();
		$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $web_banner, $app_banner, $cat_name_ar, $sub_title, $sub_title_ar);
		$return = array();
		$i = 0;
		while ($stmt->fetch()) {

			if ($col3) {
				$img_dec = json_decode($col3);
				$img = MEDIAURL . $img_dec->{'72-72'};
			} else {
				$img = '';
			}

			if ($web_banner) {
				$web_banner_dec = json_decode($web_banner);
				$web_banner1 = MEDIAURL . $web_banner_dec->{'72-72'};
			} else {
				$web_banner1 = '';
			}

			if ($app_banner) {
				$app_banner_dec = json_decode($app_banner);
				$app_banner1 = MEDIAURL . $app_banner_dec->{'72-72'};
			} else {
				$app_banner1 = '';
			}
			$return[$i] =
				array(
					'id' => $col1,
					'name' => $col2,
					'img' => $img,
					'parentid' => $col4,
					'statuss' => $col6,
					'orderno' => $col5,
					'parent_count' => $col7,
					'web_banner' => $web_banner1,
					'app_banner' => $app_banner1,
					'count_order' => $count_order,
					'cat_name_ar' => $cat_name_ar,
					'sub_title' => $sub_title,
					'sub_title_ar' => $sub_title_ar
				);
			$i = $i + 1;
			// echo " array created".json_encode($return);
		}


		$stmt2 = $conn->prepare("SELECT cat_name FROM category WHERE cat_id='" . $parentid . "'");

		$stmt2->execute();
		$data = $stmt2->bind_result($col55);

		while ($stmt2->fetch()) {

			$parentname = $col55;

			// echo " array created".json_encode($return);
		}
		$info = array(
			'parentv' => $parentname,
			'subcat' => $return
		);

		echo  json_encode($info);
		//return json_encode($return);    
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}

function categoryTree($parent_id, $sub_mark = '')
{
	global $conn;
	$query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id AND status = '1' ORDER BY cat_name ASC");

	if ($query->num_rows > 0) {
		while ($row = $query->fetch_assoc()) {
			$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1'");
			if ($query1->num_rows > 0) {
				echo '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList">' . $row['cat_name'] . '</span>
						<br />    
						<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';
				echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
				echo '</ul>';
			} else {
				echo '<li><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" class="check_category_limit"> ' . $row['cat_name'] . '</li>';
			}
		}
	}
}
?>