<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}
?>
<?php include("header.php"); ?>
<style>
	.col-md-4.col-xl-3 {
		cursor: pointer;
	}

	.widget-rounded-circle .fa-solid {
		display: flex;
	}

	.card-box .col-4 {
		transition: transform .5s ease;
	}

	.col-md-4.col-xl-3:hover .card-box .col-4 {
		transform: scale(1.1);
	}
</style>
<!-- main content start-->
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Dashboard</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<a class="col-md-4 col-xl-3" onclick="redirect_page('reports.php')">
					<div class="widget-rounded-circle card-box">
						<div class="row align-items-center">
							<div class="col-4">
								<div class="avatar-md rounded-circle bg-soft-light border-dark border">
									<i class="fa-solid fa-dollar-sign font-22 avatar-title text-dark"></i>
								</div>
							</div>
							<div class="col-8">
								<div class="text-right">
									<h3 class="mt-1">
										<span><?php echo $Common_Function->get_system_settings($conn, 'system_currency_symbol'); ?> </span>
										<span data-plugin="counterup">
											<?php

											$stmt = $conn->prepare("SELECT SUM(prod_price*qty) FROM `order_product` WHERE status ='Delivered'");
											$stmt->execute();
											$data = $stmt->bind_result($col1);
											$revenue = 0;
											while ($stmt->fetch()) {
												$revenue = $col1;
											}
											echo  $revenue;

											?>
										</span>
									</h3>
									<p class="text-muted mb-1 text-truncate">Revenue</p>
								</div>
							</div>
						</div>
					</div>
				</a>
				<a class="col-md-4 col-xl-3" onclick="redirect_page('manage_orders.php')">
					<div class="widget-rounded-circle card-box">
						<div class="row align-items-center">
							<div class="col-4">
								<div class="avatar-md rounded-circle bg-soft-light border-dark border">
									<i class="fa-solid fa-cart-shopping font-22 avatar-title text-dark"></i>
								</div>
							</div>
							<div class="col-8">
								<div class="text-right">
									<h3 class="mt-1">
										<span data-plugin="counterup">
											<?php

											$stmt = $conn->prepare("SELECT id FROM `order_product`");
											$stmt->execute();
											$stmt->store_result();
											echo $stmt->num_rows;

											?>
										</span>
									</h3>
									<p class="text-muted mb-1 text-truncate">Total Orders</p>
								</div>
							</div>
						</div>
					</div>
				</a>
				<a class="col-md-4 col-xl-3" onclick="redirect_page('manage_orders.php')">
					<div class="widget-rounded-circle card-box">
						<div class="row align-items-center">
							<div class="col-4">
								<div class="avatar-md rounded-circle bg-soft-light border-dark border">
									<i class="fa-solid fa-cart-shopping font-22 avatar-title text-dark"></i>
								</div>
							</div>
							<div class="col-8">
								<div class="text-right">
									<h3 class="mt-1">
										<span data-plugin="counterup">
											<?php

											$stmt = $conn->prepare("SELECT id FROM `order_product` WHERE status ='Placed'");
											$stmt->execute();
											$stmt->store_result();
											echo $stmt->num_rows;

											?>
										</span>
									</h3>
									<p class="text-muted mb-1 text-truncate">Pending Order</p>
								</div>
							</div>
						</div>
					</div>
				</a>
				<a class="col-md-4 col-xl-3" onclick="redirect_page('manage_orders.php')">
					<div class="widget-rounded-circle card-box">
						<div class="row align-items-center">
							<div class="col-4">
								<div class="avatar-md rounded-circle bg-soft-light border-dark border">
									<i class="fa-solid fa-cart-shopping font-22 avatar-title text-dark"></i>
								</div>
							</div>
							<div class="col-8">
								<div class="text-right">
									<h3 class="mt-1">
										<span data-plugin="counterup">
											<?php

											$stmt = $conn->prepare("SELECT id FROM `order_product` WHERE status ='Cancelled'");
											$stmt->execute();
											$stmt->store_result();
											echo $stmt->num_rows;

											?>
										</span>
									</h3>
									<p class="text-muted mb-1 text-truncate">Cancelled Order</p>
								</div>
							</div>
						</div>
					</div>
				</a>
				<a class="col-md-4 col-xl-3" onclick="redirect_page('manage_orders.php')">
					<div class="widget-rounded-circle card-box">
						<div class="row align-items-center">
							<div class="col-4">
								<div class="avatar-md rounded-circle bg-soft-light border-dark border">
									<i class="fa-solid fa-cart-shopping font-22 avatar-title text-dark"></i>
								</div>
							</div>
							<div class="col-8">
								<div class="text-right">
									<h3 class="mt-1">
										<span data-plugin="counterup">
											<?php

											$stmt = $conn->prepare("SELECT id FROM `order_product` WHERE status ='Delivered'");
											$stmt->execute();
											$stmt->store_result();
											echo number_format($stmt->num_rows);

											?>
										</span>
									</h3>
									<p class="text-muted mb-1 text-truncate">Complete Order</p>
								</div>
							</div>
						</div>
					</div>
				</a>
				<a class="col-md-4 col-xl-3" onclick="redirect_page('seller.php')">
					<div class="widget-rounded-circle card-box">
						<div class="row align-items-center">
							<div class="col-4">
								<div class="avatar-md rounded-circle bg-soft-light border-dark border">
									<i class="fa-solid fa-users font-22 avatar-title text-dark"></i>
								</div>
							</div>
							<div class="col-8">
								<div class="text-right">
									<h3 class="mt-1">
										<span data-plugin="counterup">
											<?php

											$stmt = $conn->prepare("SELECT sellerid FROM `sellerlogin`");
											$stmt->execute();
											$stmt->store_result();
											echo $stmt->num_rows;

											$stmt_p = $conn->prepare("SELECT sellerid FROM `sellerlogin` where status='0'");
											$stmt_p->execute();
											$stmt_p->store_result();
											$pending_seller = $stmt_p->num_rows;

											?>
										</span>
									</h3>
									<p class="text-muted mb-1 text-truncate">Seller (Pending <?= $pending_seller; ?>)</p>
								</div>
							</div>
						</div>
					</div>
				</a>
				<a class="col-md-4 col-xl-3" onclick="redirect_page('manage_product.php')">
					<div class="widget-rounded-circle card-box">
						<div class="row align-items-center">
							<div class="col-4">
								<div class="avatar-md rounded-circle bg-soft-light border-dark border">
									<i class="fa-solid fa-chart-pie font-22 avatar-title text-dark"></i>
								</div>
							</div>
							<div class="col-8">
								<div class="text-right">
									<h3 class="mt-1">
										<span data-plugin="counterup">
											<?php

											$query_total = $conn->prepare("SELECT pd.product_unique_id FROM product_details pd,brand WHERE brand.brand_id  = pd.brand_id AND pd.status IN(1,3) ");
											$query_total->execute();
											$query_total->store_result();
											echo $query_total->num_rows;

											?>
										</span>
									</h3>
									<p class="text-muted mb-1 text-truncate">Total Product</p>
								</div>
							</div>
						</div>
					</div>
				</a>
				<a class="col-md-4 col-xl-3" onclick="redirect_page('pending_products.php')">
					<div class="widget-rounded-circle card-box">
						<div class="row align-items-center">
							<div class="col-4">
								<div class="avatar-md rounded-circle bg-soft-light border-dark border">
									<i class="fa-solid fa-chart-pie font-22 avatar-title text-dark"></i>
								</div>
							</div>
							<div class="col-8">
								<div class="text-right">
									<h3 class="mt-1">
										<span data-plugin="counterup">
											<?php

											$query_total = $conn->prepare("SELECT pd.product_unique_id FROM product_details pd,brand WHERE brand.brand_id  = pd.brand_id AND pd.status IN(0) ");
											$query_total->execute();
											$query_total->store_result();
											echo $query_total->num_rows;

											?>
										</span>
									</h3>
									<p class="text-muted mb-1 text-truncate">Pending Product</p>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="row">
				<?php if ($Common_Function->user_module_premission($_SESSION, $Product)) { ?>
					<div class="col-md-6">
						<div class="card-box">
							<h4 class="header-title mb-3">Pending New Products</h4>

							<div class="table-responsive mb-3">
								<table class="table table-nowrap table-hover table-centered m-0">

									<thead class="thead-light">
										<tr>
											<th>Product ID</th>
											<th>Name</th>
											<th>Category</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$pending_products = $conn->query("SELECT pd.product_unique_id, pd.prod_name, pd.featured_img,  pd.status ,brand.brand_name,pd.product_sku FROM product_details pd,brand WHERE brand.brand_id  = pd.brand_id AND pd.status NOT IN(1,3) ORDER BY pd.created_at DESC LIMIT 10");
										if ($pending_products->num_rows > 0) {
											while ($rows_product = $pending_products->fetch_assoc()) {
										?>
												<tr>
													<td><?= $rows_product['product_unique_id']; ?></td>
													<td><?= $rows_product['prod_name']; ?></td>
													<td><?= $Common_Function->get_cat($rows_product['product_unique_id'], $conn); ?></td>
												</tr>


											<?php }
										} else { ?>
											<tr>
												<td colspan="3" class="text-center">No Record Found</td>
											</tr>
										<?php } ?>

									</tbody>
								</table>
							</div>
							<div class="text-right"><button type="button" class="btn btn-danger waves-effect waves-light" onclick="redirect_page('pending_products.php')">View All</button></div>
						</div>
					</div>
				<?php } ?>

				<!-- <?php if ($Common_Function->user_module_premission($_SESSION, $Brand)) { ?>
					<div class="col-md-6">
						<div class="card-box">
							<h4 class="header-title mb-3">Pending New Brand</h4>

							<div class="table-responsive mb-3">
								<table class="table table-nowrap table-hover table-centered m-0">

									<thead class="thead-light">
										<tr>
											<th>#</th>
											<th>Name</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$pending_brand = $conn->query("SELECT brand_name, brand_img FROM brand  WHERE status NOT IN(1,3)   ORDER BY brand_name ASC LIMIT 10");
										if ($pending_brand->num_rows > 0) {
											while ($rows_brand = $pending_brand->fetch_assoc()) {
												if ($rows_brand['brand_img']) {
													$img_dec = json_decode($rows_brand['brand_img']);
													$img = MEDIAURL . $img_dec->{'72-72'};
												} else {
													$img = '';
												}
										?>
												<tr>
													<td><img src="<?= $img; ?>" style="width: 40px;"></td>
													<td><?= $rows_brand['brand_name']; ?></td>
												</tr>
											<?php }
										} else { ?>
											<tr>
												<td colspan="2" class="text-center">No Record Found</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="text-right"><button type="button" class="btn btn-danger waves-effect waves-light" onclick="redirect_page('pending_brand.php')">View All</button></div>
						</div>
					</div>
				<?php } ?> -->

				<?php if ($Common_Function->user_module_premission($_SESSION, $Category)) { ?>
					<div class="col-md-6">
						<div class="card-box">
							<h4 class="header-title mb-3">Pending New Category</h4>

							<div class="table-responsive mb-3">
								<table class="table table-nowrap table-hover table-centered m-0">

									<thead class="thead-light">
										<tr>
											<th>#</th>
											<th>Name</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$pending_cat = $conn->query("SELECT cat_id, cat_name, cat_img, parent_id, cat_order,status FROM category  WHERE status IN(0) ORDER BY cat_order ASC LIMIT 10");
										if ($pending_cat->num_rows > 0) {
											while ($rows_cat = $pending_cat->fetch_assoc()) {
												if ($rows_cat['cat_img']) {
													$img_dec = json_decode($rows_cat['cat_img']);
													$img = MEDIAURL . $img_dec->{'72-72'};
												} else {
													$img = '';
												}
										?>
												<tr>
													<td><img src="<?= $img; ?>" style="width: 40px;"></td>
													<td><?= $rows_cat['cat_name']; ?></td>

												</tr>


											<?php }
										} else { ?>
											<tr>
												<td colspan="2" class="text-center">No Record Found</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="text-right"><button type="button" class="btn btn-danger waves-effect waves-light" onclick="redirect_page('pending_category.php')">View All</button></div>
						</div>
					</div>
				<?php } ?>

			</div>

			<div class="clearfix"> </div>

			<div class="clearfix"> </div>
			
			<?php if ($Common_Function->user_module_premission($_SESSION, $Orders)) { ?>

				<div class="card">
					<div class="card-body">
						<div class="work-progres">
							<header class="widget-header d-flex alogn-items-center justify-content-between">

								<h4 class="widget-title">Recent Orders</h4>
								<button type="button" class="btn btn-danger waves-effect waves-light pull-right" onclick="redirect_page('shipped_orders.php')">View All</button>
							</header>
							<hr class="widget-separator">
							<div class="table-responsive">
								<table class="table table-hover table-centered" id="tblname">
									<thead class="thead-light">
										<tr>
											<th>Sno</th>
											<th>#</th>
											<th>Order ID</th>
											<th>Product Name</th>
											<th>Amount</th>
											<th>Quantity</th>
											<th>Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="tbodyPostid">
										<?php
										// WHERE status ='Shipped'
										$get_neworder = $conn->query("SELECT op.prod_id,op.order_id,op.prod_name,op.prod_img,op.prod_attr,op.qty,op.prod_price,op.shipping,op.discount,op.status,op.order_id ,op.create_date FROM  `order_product` op  ORDER BY op.id DESC LIMIT 20 ");

										if ($get_neworder->num_rows > 0) {

											while ($rows_order = $get_neworder->fetch_assoc()) {
												$i++;

										?>

												<tr>
													<th scope="row"><?= $i; ?></th>
													<td><img style="height:72px" src="<?php echo MEDIAURL.str_replace('-430-590','',$rows_order['prod_img']); ?>" ></td>
													<td><?= $rows_order['order_id']; ?></td>
													<td><?= $rows_order['prod_name']; ?></td>
													<td><?= $rows_order['prod_price']; ?></td>
													<td><?= number_format($rows_order['qty']); ?></td>
													<td><?= date('d-m-Y H:i:s', strtotime($rows_order['create_date'])); ?></td>

													<td><?= $rows_order['status']; ?></td>
													<td> <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="edit_orders('<?= $rows_order['order_id']; ?>', '<?= $rows_order['prod_id']; ?>')">Edit</button></td>
												</tr>
											<?php }
										} else { ?>

											<tr>
												<td colspan="8" class="text-center">No Record Found</td>
											</tr>

										<?php	} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

			<div class="clearfix"> </div>

		</div>

		<div class="col_1">

			<div class="clearfix"> </div>

		</div>

	</div>
</div>
<!--footer-->
<?php include("footernew.php"); ?>
