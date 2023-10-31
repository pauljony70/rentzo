<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Home";
	include("include/headTag.php") ?>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/index.css') ?>">
</head>
<style>
	img.outof_stock {
		position: absolute;
		z-index: 1;
		margin-left: -6px;
		margin-top: -5px;
		left: 12px;
	}

	@media (max-width: 767.98px) {
		img.outof_stock {
			width: 70px;
			margin-left: -5px;
			margin-top: -5px;
			left: 12px;
		}
	}
</style>

<body>
	<?php
	include("include/loader.php")
	?>

	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php")
	?>
	<?php
	include("include/navForMobile.php");

	?>

	<main class="search">
		<br>
		<section>
			<div class="trending-section mt-0 container-fluid px-1 px-md-4">
				<div class="row">
					<div class="col-12 mb-md-4">
						<h3 class=" fw-bold">Search : <?php echo $search_title; ?></h3>
					</div>

					<!--Block-->

					<?php foreach ($search_sponsor as $key => $search_sponsor_data) : ?>
						<!--<div class="col-lg-3 col-sm-4 col-6 p-1">
							<div class="card mb-0">
								<div onclick="redirect_to_link('<?php echo base_url . $search_sponsor_data['sku'] . '?pid=' . $search_sponsor_data['id'] . '&sku=' . $search_sponsor_data['sku'] . '&sid=' . $search_sponsor_data['vendor_id']; ?>')" class="card-img zoom-img">
									<img src="<?php echo MEDIA_URL . $search_sponsor_data['imgurl']; ?>" class="card-img-top" alt="..." />
								</div>
								<div class="favorite"><a onclick="add_to_wishlist(event,'<?php echo $search_sponsor_data['id'] ?>','<?php echo $search_sponsor_data['sku'] ?>','<?php echo $search_sponsor_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2)" href="javascript:void(0);"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke="" />
										</svg></a></div>
								<div class="sponsor_label">Sponsor Product</div>
								<div class="card-body">
									<h6 class="pd-title" onclick="redirect_to_link('<?php echo base_url . $search_sponsor_data['sku'] . '?pid=' . $search_sponsor_data['id'] . '&sku=' . $search_sponsor_data['sku'] . '&sid=' . $search_sponsor_data['vendor_id']; ?>')"><?php echo $search_sponsor_data['name']; ?></h6>
									<h6 class="price-off text-danger"><?php if ($search_sponsor_data['totaloff'] != 0) {
																			echo $search_sponsor_data['offpercent'];
																		} ?></h6>

									<div class="row">
										<div class="col-6">
											<h6 class="old-price"><?php echo $search_sponsor_data['mrp']; ?></h6>
											<h5 class="new-price"><?php echo $search_sponsor_data['price']; ?>/-</h5>
										</div>
										<div class="col-6">
											<div class="btn-by-now">
												<a href="#" onclick="add_to_cart_product_buy(event,'<?php echo $search_sponsor_data['id'] ?>','<?php echo $search_sponsor_data['sku'] ?>','<?php echo $search_sponsor_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-default w-100">Buy Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>-->
						<div class="col-xl-2 col-lg-3 col-sm-4 col-6 p-1 position-relative">
							<?php if ($search_sponsor_data['stock_status'] == 'Out of Stock' || $search_sponsor_data['stock'] <= 0) { ?>
								<img class="outof_stock" src="<?php echo weburl . '/assets/img/out_of_stock.png'; ?>">
							<?php } ?>
							<div class="trending-section mx-2 my-0">
								<a href="<?php echo base_url . $search_sponsor_data['sku'] . '?pid=' . $search_sponsor_data['id'] . '&sku=' . $search_sponsor_data['sku'] . '&sid=' . $search_sponsor_data['vendor_id']; ?>" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
									<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
										<span class="discount text-uppercase"><?= $search_sponsor_data['offpercent'] ?></span>
										<span class="wishlist"><i class="fa fa-heart-o"></i></span>
									</div>
									<div class="image-container zoom-img">
										<img src="<?php echo MEDIA_URL . $search_sponsor_data['imgurl']; ?>" class="zoom-img thumbnail-image">
									</div>
									<div class="product-detail-container p-2 mb-1">
										<div class="justify-content-between align-items-center">
											<p class="dress-name mb-0"><?php echo $search_sponsor_data['name']; ?></p>
											<div class="d-flex align-items-center justify-content-start mt-2" style="width: 100%;">
												<span class="new-price mx-1"><?php echo $search_sponsor_data['price']; ?></span>
												<small class="old-price text-right mx-1"><?php echo $search_sponsor_data['mrp']; ?></small>
											</div>
										</div>
										<div class="d-flex justify-content-between align-items-center pt-1">
											<div class="d-flex align-items-center">
												<?php if ($search_sponsor_data['rating']['total_rows'] > 0) : ?>
													<i class="fa-solid fa-star"></i>
													<div class="rating-number"><?= $search_sponsor_data['rating']['total_rating'] / $search_sponsor_data['rating']['total_rows'] ?></div>
												<?php endif; ?>
											</div>
											<button class="btn btn-primary text-center text-uppercase card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event,'<?php echo $search_sponsor_data['id'] ?>','<?php echo $search_sponsor_data['sku'] ?>','<?php echo $search_sponsor_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')"><?= $this->lang->line('buy') ?></button>
										</div>
									</div>
								</a>
							</div>
						</div>
					<?php endforeach; ?>

					<?php foreach ($search as $new_product_data) : ?>
						<div class="col-xl-2 col-lg-3 col-sm-4 col-6 p-1 position-relative">
							<?php if ($new_product_data['stock_status'] == 'Out of Stock' || $new_product_data['stock'] <= 0) { ?>
								<img class="outof_stock" src="<?php echo weburl . '/assets/img/out_of_stock.png'; ?>">
							<?php } ?>
							<div class="trending-section mx-2 my-0">
								<a href="<?= base_url . $new_product_data['sku'] . '?pid=' . $new_product_data['id'] . '&sku=' . $new_product_data['sku'] . '&sid=' . $new_product_data['vendor_id'] ?>" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
									<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
										<span class="discount text-uppercase"><?= $new_product_data['offpercent'] ?></span>
										<span class="wishlist"><i class="fa fa-heart-o"></i></span>
									</div>
									<div class="image-container zoom-img">
										<img src="<?php echo MEDIA_URL . $new_product_data['imgurl']; ?>" class="zoom-img thumbnail-image">
									</div>
									<div class="product-detail-container p-2 mb-1">
										<div class="justify-content-between align-items-center">
											<p class="dress-name mb-0"><?php echo $new_product_data['name']; ?></p>
											<div class="d-flex align-items-center justify-content-start mt-2" style="width: 100%;">
												<span class="new-price mx-1"><?php echo $new_product_data['price']; ?></span>
												<small class="old-price text-right mx-1"><?php echo $new_product_data['mrp']; ?></small>
											</div>
										</div>
										<div class="d-flex justify-content-between align-items-center pt-1">
											<div class="d-flex align-items-center">
												<?php if ($new_product_data['rating']['total_rows'] > 0) : ?>
													<i class="fa-solid fa-star"></i>
													<div class="rating-number"><?= $new_product_data['rating']['total_rating'] / $new_product_data['rating']['total_rows'] ?></div>
												<?php endif; ?>
											</div>
											<button class="btn btn-primary text-center text-uppercase card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event, '<?php echo $new_product_data['id'] ?>','<?php echo $new_product_data['sku'] ?>','<?php echo $new_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')"><?= $this->lang->line('buy') ?></button>
										</div>
									</div>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>



	</main>
	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>
	<script>
		function redirect_to_link(link) {
			location.href = link;
		}
	</script>
</body>

</html>