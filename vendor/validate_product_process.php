<?php
include('session.php');
$code = $_REQUEST['code'];
$msg =  '';
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
} else if (isset($_REQUEST['type']) == 'undoimport' && $code == $_SESSION['_token']) {
	$table_main = 'import_product_' . strtolower($_SESSION['admin']);

	$table_name = 'import_product2_' . strtolower($_SESSION['admin']);

	$stmt = $conn->prepare('DROP TABLE IF EXISTS ' . $table_main);
	$stmt->execute();

	$stmt1 = $conn->prepare('DROP TABLE IF EXISTS ' . $table_name);
	$stmt1->execute();

	echo '<script>location.href="manage_product.php";</script>';
	die();
} else if (isset($_REQUEST['types']) == 'finishimport' && $code == $_SESSION['_token']) {
	$table_main = 'import_product_' . strtolower($_SESSION['admin']);
	$table_name = 'import_product2_' . strtolower($_SESSION['admin']);

	$stmt_check = $conn->query("SELECT * FROM  " . $table_name . " ");

	if ($stmt_check->num_rows > 0) {

		while ($rows = $stmt_check->fetch_assoc()) {
			$Common_Function->finish_import_bulk_product($conn, $rows, $_SESSION['admin'], $datetime, $table_name);
		}

		$link = BASEURL . "admin/pending_products.php";
		$Common_Function->send_email_seller_new($conn, $_SESSION['seller_name'], $link, 'Product', "New Product Request - Bulk Import", "");


		$stmt = $conn->prepare('DROP TABLE IF EXISTS ' . $table_main);
		$stmt->execute();

		$stmt1 = $conn->prepare('DROP TABLE IF EXISTS ' . $table_name);
		$stmt1->execute();
	}
	echo '<script>location.href="manage_product.php";</script>';
	die();
} else {
	$table_main = 'import_product_' . strtolower($_SESSION['admin']);

	$table_name = 'import_product2_' . strtolower($_SESSION['admin']);
	$finish = "no";

	// code for check product exist - START
	$stmt_check = $conn->query("SELECT * FROM  " . $table_main . " WHERE status ='0' limit 0,100 ");
	if ($stmt_check->num_rows > 0) {
		//echo "<pre>";
		while ($rows = $stmt_check->fetch_assoc()) {
			$status = 1;
			$fail_reason = '';

			if ($rows['sku']) {
				$validate_sku = $Common_Function->validate_import_product_sku($conn, $rows['sku']);
				if ($validate_sku == 1) {
					$status = 2;
					$fail_reason .= 'Product sku already exist.\n';
				}
			}

			if ($rows['url_key']) {
				$validate_url = $Common_Function->validate_product_url_key($conn, $rows['url_key']);
				if ($validate_url == 1) {
					$status = 2;
					$fail_reason .= 'Product url key already exist.\n';
				}
			}

			if ($rows['attribute_set']) {
				$validate_attr_set = $Common_Function->validate_product_attribute_set($conn, $rows['attribute_set']);
				if ($validate_attr_set == 0) {
					$status = 2;
					$fail_reason .= 'Product attribute Set not found.\n';
				} else {
					$rows['attribute_set'] = $validate_attr_set;
				}
			}

			if ($rows['categories']) {
				$catname = $cat_ids = array();
				$explode = explode(',', $rows['categories']);
				foreach ($explode as $cat_name) {
					$validate_categories = $Common_Function->validate_product_categories($conn, $cat_name);
					if ($validate_categories == 0) {
						$catname[] = $cat_name;
					} else {
						$cat_ids[] = $validate_categories;
					}
				}

				if (count($catname) > 0) {
					$status = 2;
					$fail_reason .= 'Product categories ' . implode(", ", $catname) . ' not found.\n';
				} else {
					$rows['categories'] = implode(',', $cat_ids);
				}
			}



			if ($rows['tax_class']) {
				$validate_tax_class = $Common_Function->validate_product_tax_class($conn, $rows['tax_class']);
				if ($validate_tax_class == 0) {
					$status = 2;
					$fail_reason .= 'Product tax class not found.\n';
				} else {
					$rows['tax_class'] = $validate_tax_class;
				}
			}


			if ($rows['stock_status']) {
				if (strtolower($rows['stock_status']) == 'in stock') {
					$rows['stock_status'] = 'In Stock';
				} else if (strtolower($rows['stock_status']) == 'out of stock') {
					$rows['stock_status'] = 'Out of Stock';
				} else {
					$status = 2;
					$fail_reason .= 'Product stock status not found.\n';
				}
			}

			if ($rows['visibility']) {
				$validate_visibility = $Common_Function->validate_product_visibility($conn, $rows['visibility']);
				if ($validate_visibility == 0) {
					$status = 2;
					$fail_reason .= 'Product visibility not found.\n';
				} else {
					$rows['visibility'] = $validate_visibility;
				}
			}

			if ($rows['country_of_manufacture']) {
				$validate_country_of_manufacture = $Common_Function->validate_product_country_of_manufacture($conn, $rows['country_of_manufacture']);
				if ($validate_country_of_manufacture == 0) {
					$status = 2;
					$fail_reason .= 'Product manufacture country not found.\n';
				} else {
					$rows['country_of_manufacture'] = $validate_country_of_manufacture;
				}
			}

			if ($rows['brand']) {
				$validate_brand = $Common_Function->validate_product_brand($conn, $rows['brand']);
				if ($validate_brand == 0) {
					$status = 2;
					$fail_reason .= 'Product brand not found.\n';
				} else {
					$rows['brand'] = $validate_brand;
				}
			}

			if ($rows['return_policy']) {
				$validate_return_policy = $Common_Function->validate_product_return_policy($conn, $rows['return_policy']);
				if ($validate_return_policy == 0) {
					$status = 2;
					$fail_reason .= 'Product return policy not found.\n';
				} else {
					$rows['return_policy'] = $validate_return_policy;
				}
			}

			if ($rows['product_type'] == 'configurable') {
				$configurable_variations = $rows['configurable_variations'];
				if ($configurable_variations) {
					$explode_conf = explode(',', $configurable_variations);
					$i = 0;
					foreach ($explode_conf as $prod_conf) {
						$explode_conf2 = explode('=', $prod_conf);
						if ($i == 0) {
							if ($explode_conf2[0] == 'sku') {
								if ($explode_conf2[1]) {
									$validate_sku1 = $Common_Function->validate_import_product_sku($conn, $explode_conf2[1]);
									if ($validate_sku1 == 1) {
										$status = 2;
										$fail_reason .= 'Product configurable variations sku already exist.\n';
									}
								} else {
									$status = 2;
									$fail_reason .= 'Product configurable variations sku should not blank.\n';
								}
							} else {
								$status = 2;
								$fail_reason .= 'Product configurable variations sku not found at first poisition.\n';
							}
						} else {
							if ($explode_conf2[0]) {
								$validate_configurable_variations = $Common_Function->validate_product_configurable_variations($conn, $explode_conf2[0]);
								if ($validate_configurable_variations == 0) {
									$status = 2;
									$fail_reason .= 'Product configurable variations ' . $explode_conf2[0] . ' attribute not found.\n';
								} else {
									$validate_configurable_variations1 = $Common_Function->validate_product_configurable_variations1($conn, $explode_conf2[1], $validate_configurable_variations);
									if ($validate_configurable_variations1 == 0) {
										$status = 2;
										$fail_reason .= 'Product configurable variations ' . $explode_conf2[0] . ' attribute ' . $explode_conf2[1] . ' value not found.\n';
									}
								}
							}
						}
						$i++;
					}
				} else {
					$status = 2;
					$fail_reason .= 'Product configurable variations should not blank.\n';
				}
			}

			if ($rows['related_skus']) {
				$related_skus = $related_ids = array();
				$explode1 = explode(',', $rows['related_skus']);
				foreach ($explode1 as $related_prod) {
					$validate_related_sku = $Common_Function->validate_product_related_sku($conn, $related_prod, $_SESSION['admin']);
					if (!$validate_related_sku) {
						$related_skus[] = $related_prod;
					} else {
						$related_ids[] = $validate_related_sku;
					}
				}

				if (count($related_skus) > 0) {
					$status = 2;
					$fail_reason .= 'Product related skus ' . implode(", ", $related_skus) . ' not found.\n';
				} else {
					$rows['related_skus'] = implode(',', $related_ids);
				}
			}

			if ($rows['upsell_skus']) {
				$upsell_skus = $upsell_ids = array();
				$explode12 = explode(',', $rows['upsell_skus']);
				foreach ($explode12 as $upsell_prod) {
					$validate_upsell_skus = $Common_Function->validate_product_related_sku($conn, $upsell_prod, $_SESSION['admin']);
					if (!$validate_upsell_skus) {
						$upsell_skus[] = $upsell_prod;
					} else {
						$upsell_ids[] = $validate_upsell_skus;
					}
				}

				if (count($upsell_skus) > 0) {
					$status = 2;
					$fail_reason .= 'Product upsell skus ' . implode(", ", $upsell_skus) . ' not found.\n';
				} else {
					$rows['upsell_skus'] = implode(',', $upsell_ids);
				}
			}

			$Common_Function->validate_product_update_status($conn, $status, $rows['id'], $fail_reason, $table_main);

			if ($status == 1) {
				$Common_Function->validate_product_insert_step2($conn, $rows, $table_name, $_SESSION['admin']);
			}
		}
		echo '<script>location.href="validate_product_process.php";</script>';
	} else {
		$finish = "yes";
	}
}

$total_results_valid = $total_results = $total_results_invalid = 0;
$stmt_check1 = $conn->query("SELECT status FROM  " . $table_main . " ");
if ($stmt_check1->num_rows > 0) {
	$total_results = $stmt_check1->num_rows;

	$stmt_check_valid = $conn->query("SELECT status FROM  " . $table_main . " WHERE status ='1' ");
	$total_results_valid = $stmt_check_valid->num_rows;

	$stmt_check_invalid = $conn->query("SELECT status FROM  " . $table_main . " WHERE status ='2' ");
	$total_results_invalid = $stmt_check_invalid->num_rows;
} else {
	echo '<script>location.href="import_product.php";</script>';
}

?>
<?php include("header.php"); ?>

<!-- main content start-->
<div id="page-wrapper">
	<div class="main-page">
		<div>
			<div class="bs-example widget-shadow" data-example-id="hoverable-table">
				<h4 style="padding: 15px; height: 4px">
					<span><b>Import Product Processing:</b></span>
				</h4>
				<div class="form-three widget-shadow">
					<div class="col_1">
						<div class="col-md-2 ">
							<div class="">


							</div>
						</div>
						<div class="col-md-8 ">
							<div class="activity_box activity_box1">
								<h3>Import Product Status</h3>
								<div class="" id="style-3">
									<table class="table table-hover" id="tblname">
										<tbody>
											<tr>
												<td style="width: 230px;"><b>Valid Products</b></td>
												<td><?php echo $total_results_valid; ?></td>
											</tr>
											<tr>
												<td style="width: 230px;"><b>Invalid Products</b></td>
												<td><?php echo $total_results_invalid; ?></td>
											</tr>
											<tr>
												<td style="width: 230px;"><b>Total Products</b></td>
												<td><?php echo $total_results; ?></td>
											</tr>
										</tbody>
									</table>

								</div>
								<?php
								if ($finish == "yes") { ?>
									<button type="submit" class="btn btn-warning" href="javascript:void(0)" onclick="download_last_import()">Download Last Import</button>
									<button type="submit" class="btn btn-danger" href="javascript:void(0)" onclick="undo_last_import()">Undo Last Import</button>
									<button type="submit" class="btn btn-success" href="javascript:void(0)" onclick="finsih_last_import()">Finish Import</button>
								<?php	}
								?>
							</div>
						</div>
						<div class="col-md-2 ">
							<div class=" ">


							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="clearfix"> </div>

					</div>


				</div>
			</div>
		</div>

		<div class="clearfix"> </div>
	</div>
	<div class="clearfix"> </div>

</div>



<div class="col_1">


	<div class="clearfix"> </div>

</div>

<?php include("footernew.php"); ?>