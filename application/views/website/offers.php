<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Available Offers";
	include("include/headTag.php") ?>
</head>

<body>

	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php");
	//print_r($offers_product);
	?>

	<main class="search">
		<section>
			<div class="trending-section mt-0 container px-1">
				<div class="row mt-4">
					<div class="row mb-md-4">
						<div class="col-8">
							<h3 class=" fw-bold"><?= $this->lang->line('offers-for-you') ?></h3>
						</div>
					</div>

					<?php foreach ($offers_product as $new_product_data) { ?>
						<div class="col-lg-3 col-sm-4 col-6">
							<div class="card">
								<div onclick="redirect_to_link('<?php echo base_url . $new_product_data['sku'] . '?pid=' . $new_product_data['id'] . '&sku=' . $new_product_data['sku'] . '&sid=' . $new_product_data['vendor_id']; ?>')" class="card-img zoom-img">
									<img src="<?php echo $new_product_data['imgurl']; ?>" class="card-img-top" alt="..." />
								</div>
								<div class="favorite"><a onclick="add_to_wishlist(event,'<?php echo $new_product_data['id'] ?>','<?php echo $new_product_data['sku'] ?>','<?php echo $new_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2)" href="javascript:void(0);"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke="" />
										</svg></a></div>
								<div class="card-body">
									<h6 class="pd-title" onclick="redirect_to_link('<?php echo base_url . $new_product_data['sku'] . '?pid=' . $new_product_data['id'] . '&sku=' . $new_product_data['sku'] . '&sid=' . $new_product_data['vendor_id']; ?>')"><?php echo $new_product_data['name']; ?></h6>
									<h6 class="price-off text-danger"><?php if ($new_product_data['totaloff'] != 0) {
																			echo $new_product_data['offpercent'];
																		} ?></h6>

									<div class="row">
										<div class="col-6">
											<h6 class="old-price"><?php echo $new_product_data['mrp']; ?></h6>
											<h5 class="new-price"><?php echo $new_product_data['price']; ?>/-</h5>
										</div>
										<div class="col-6">
											<div class="btn-by-now">
												<a href="#" onclick="add_to_cart_product_buy(event,'<?php echo $new_product_data['id'] ?>','<?php echo $new_product_data['sku'] ?>','<?php echo $new_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" class="btn btn-default w-100">Buy Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
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

</body>

</html>