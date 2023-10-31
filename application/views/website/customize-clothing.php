<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Customize Clothing";
	include("include/headTag.php") ?>
</head>
<?php
$web_url = str_replace('-430-590', '', $exolore_category[0]['web_banner']);
?>
<style>
	.top-banner {
		background-image: url('<?php echo MEDIA_URL . $web_url; ?>');
		background-size: contain;
		background-repeat: no-repeat;
		background-position: center center;
	}

	img.outof_stock {
		position: absolute;
		z-index: 1;
		margin-left: -6px;
		margin-top: 2px;
	}

	@media (max-width: 767.98px) {
		img.outof_stock {
			width: 70px;
			margin-left: 4px;
			margin-top: -3px;
		}
	}
</style>


<body>

	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php")
	?>

	<main class="customize-clothing explore-page">

		<!--Start: Customize Clothing Section -->
		<?php //  print_r($exolore_category_product); 
		?>
		<section>
			<div class="top-banner">
				<!--<h5><span>SALE</span> GET UPTO 60% OFF*</h5>-->
			</div>
			<div class="container ps-4 pe-4">

				<div class="row align-items-center h-100">
					<div class="col-xl-3 col-lg-3 col-sm-3 col-3 text-end mb-4">
						<p style="height: 24px;font-size: 20px;font-weight: 900;">━━━━</p>
					</div>
					<div class="header-wrap col-xl-6 col-lg-6 col-sm-6 col-6 mb-4">
						<?php foreach ($exolore_category as $exolore_category_data) { ?>
							<h4><?php echo $exolore_category_data['cat_name'] ?></h4>

						<?php } ?>
					</div>
					<div class="col-xl-3 col-lg-3 col-sm-3 col-3 text-start mb-4">
						<p style="height: 24px;font-size: 20px;font-weight: 900;">━━━━</p>
					</div>

					<?php foreach ($exolore_category as $exolore_category_data) { ?>
						<?php foreach ($exolore_category_data['subcat_1'] as $exolore_subcategory_data) {  ?>
							<div class="col-xl-2 col-lg-3 col-sm-4 col-6">
								<div class="wrap zoom-img rounded-0">
									<img onclick="redirect_to_link('<?php echo base_url . 'explore_sub/' . $exolore_subcategory_data['cat_id'] ?>')" src="<?php echo MEDIA_URL . $exolore_subcategory_data['imgurl'] ?>" class="customize-img" />
									<h6 onclick="redirect_to_link('<?php echo base_url . 'explore_sub/' . $exolore_subcategory_data['cat_id'] ?>')"><?php echo $exolore_subcategory_data['cat_name'] ?></h6>
								</div>
							</div>
					<?php }
					} ?>

				</div>

				<div class="trending-section">
					<div class="row">
						<?php foreach ($exolore_category_product as $exolore_category_product_data) { ?>
							<div class="col-lg-3 col-md-4 col-6 p-1">
								<?php if ($exolore_category_product_data['stock_status'] == 'Out of Stock' || $exolore_category_product_data['stock'] <= 0) { ?>
									<img class="outof_stock" src="<?php echo weburl . '/assets/img/out_of_stock.png'; ?>">
								<?php } ?>
								<!--Block-->
								<div class="card">
									<div onclick="redirect_to_link('<?php echo base_url . $exolore_category_product_data['sku'] . '?pid=' . $exolore_category_product_data['id'] . '&sku=' . $exolore_category_product_data['sku'] . '&sid=' . $exolore_category_product_data['vendor_id']; ?>')" class="card-img zoom-img">
										<img src="<?php echo MEDIA_URL . $exolore_category_product_data['imgurl']; ?>" class="card-img-top" alt="..." />
									</div>
									<div class="favorite"><a href="javascript:void(0);" onclick="add_to_wishlist(event,'<?php echo $exolore_category_product_data['id'] ?>','<?php echo $exolore_category_product_data['sku'] ?>','<?php echo $exolore_category_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2)"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke="" />
											</svg></a></div>
									<div class="card-body">
										<h6 class="pd-title" onclick="redirect_to_link('<?php echo base_url . $exolore_category_product_data['sku'] . '?pid=' . $exolore_category_product_data['id'] . '&sku=' . $exolore_category_product_data['sku'] . '&sid=' . $exolore_category_product_data['vendor_id']; ?>')"><?php echo $exolore_category_product_data['name']; ?></h6>


										<div class="d-flex justify-content-between align-items-center">
											<div class="">
												<h6 class="old-price"><?php echo $exolore_category_product_data['mrp']; ?></h6>
												<h5 class="new-price"><?php echo $exolore_category_product_data['price']; ?></h5>
											</div>
											<div class="d-flex">
												<div class="me-0">
													<?php /*<a href="#"  onclick="add_to_cart_product_buy(event,'<?php echo $exolore_category_product_data['id'] ?>','<?php echo $exolore_category_product_data['sku'] ?>','<?php echo $exolore_category_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-default w-100">Buy Now</a> */ ?>
													<h6 class="price-off text-danger"><?php if ($exolore_category_product_data['totaloff'] != 0) {
																							echo $exolore_category_product_data['offpercent'];
																						} ?></h6>
													<a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo '%2B91' . whatsapp_number . '&text=hi';  ?>" class="btn btn-success w-100 wp-btn py-0">
														<div class="d-flex flex-row align-items-center h-100">
															<i class="fa-brands fa-whatsapp"></i>
															<span>&nbsp;Whatsapp</span>
														</div>
													</a>
												</div>


											</div>

										</div>
									</div>
								</div>
								<!--/*Block-->
							</div>
						<?php } ?>

					</div>
				</div>

			</div>
		</section>
		<!--End: Customize Clothing Section -->

	</main>

	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>

</body>

</html>