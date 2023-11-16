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

	img.zoom-img.thumbnail-image {
		width: -webkit-fill-available;
		height: 220px;
	}

	.old-price {
		text-decoration: line-through;
		padding-bottom: 2px;
		color: #162b75;
	}

	.dress-name {
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		color: #162b75;
		font-size: 1rem;
		height: 42px;
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
	<?php include("include/loader.php") ?>
	<?php include("include/topbar.php") ?>
	<?php include("include/navbar.php") ?>
	<?php include("include/navForMobile.php"); ?>

	<main class="search my-5">
		<section class="container">
			<nav aria-label="breadcrumb" class="mb-4">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Search</li>
					<li class="breadcrumb-item active" aria-current="page"><?= $search_title ?></li>
				</ol>
			</nav>
			<div class="row">
				<!--
					--------------------------------------------------- 
					Sponsored product section
					---------------------------------------------------
				-->
				<!-- <?php foreach ($search_sponsor as $key => $search_sponsor_data) : ?>

					<?php endforeach; ?> -->

				<!--
					--------------------------------------------------- 
					Search product section
					---------------------------------------------------
				-->
				<?php foreach ($search as $new_product_data) : ?>
					<div class="col-xl-2 col-lg-3 col-sm-4 col-6 p-1 position-relative">
						<?php if ($new_product_data['stock_status'] == 'Out of Stock' || $new_product_data['stock'] <= 0) { ?>
							<img class="outof_stock" src="<?php echo weburl . '/assets/img/out_of_stock.png'; ?>">
						<?php } ?>
						<div class="trending-section mx-2 my-0">
							<a href="<?= base_url . $new_product_data['sku'] . '?pid=' . $new_product_data['id'] . '&sku=' . $new_product_data['sku'] . '&sid=' . $new_product_data['vendor_id'] ?>" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
								<!--<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
										<span class="discount text-uppercase"><?= $new_product_data['offpercent'] ?></span>
										<span class="wishlist"><i class="fa fa-heart-o"></i></span>
									</div>-->
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
		</section>
	</main>
	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>
</body>

</html>