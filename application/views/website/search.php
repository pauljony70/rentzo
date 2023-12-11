<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Home";
	include("include/headTag.php") ?>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/product-card-2.css') ?>">
</head>

<body>
	<?php include("include/loader.php") ?>
	<?php include("include/topbar.php") ?>
	<?php include("include/navbar.php") ?>

	<main class="search my-5">
		<section class="container">
			<nav aria-label="breadcrumb" class="mb-4 mb-md-5">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Search</li>
					<li class="breadcrumb-item active" aria-current="page"><?= $search_title ?></li>
				</ol>
			</nav>
			<!--
				--------------------------------------------------- 
				Search product section
				---------------------------------------------------
			-->
			<div class="row">
				<?php foreach ($search as $new_product_data) : ?>
					<div class="col-lg-3 col-md-4 col-6 mb-4 position-relative">
						<?php if ($new_product_data['stock_status'] == 'Out of Stock' || $new_product_data['stock'] <= 0) { ?>
							<img class="outof_stock" src="<?php echo weburl . '/assets/img/out_of_stock.png'; ?>">
						<?php } ?>
						<a href="<?= base_url . $new_product_data['sku'] . '?pid=' . $new_product_data['id'] . '&sku=' . $new_product_data['sku'] . '&sid=' . $new_product_data['vendor_id'] ?>" class="d-flex flex-column card product-card rounded-4">
							<img src="<?= base_url('media/' . $new_product_data['imgurl']) ?>" class="card-img-top product-card-img rounded-4" alt="<?= $new_product_data['name'] ?>">
							<div class="card-body d-flex flex-column product-card-body">
								<h5 class="card-title product-title line-clamp-2 mb-auto"><?= $new_product_data['name'] ?></h5>
								<div class="d-flex stars py-1">
									<?php
									if ($new_product_data['rating']['total_rows'] > 0) :
										$rating = round(($new_product_data['rating']['total_rating'] / $new_product_data['rating']['total_rows']) * 2) / 2;
										echo '<div class="rating-number mt-1">' . $rating . '</div>';

										// Calculate the whole number and fractional part of the rating
										$wholeNumber = floor($rating);
										$fractionalPart = $rating - $wholeNumber;

										// Loop through the whole number part and display solid stars
										for ($i = 0; $i < $wholeNumber; $i++) {
											echo '<img src="' . base_url('assets_web/images/icons/star-yellow.svg') . '" alt="Star">';
										}

										// Check the fractional part to display half or empty star
										if ($fractionalPart >= 0.5) {
											// Calculate the remaining empty stars
											$emptyStars = 5 - $wholeNumber - 1; // Subtract 1 for the half star
											echo '<img src="' . base_url('assets_web/images/icons/half-star.svg') . '" alt="Star">';
										} else {
											// Calculate the remaining empty stars
											$emptyStars = 5 - $wholeNumber;
										}

										// Display the remaining empty stars
										if ($emptyStars > 0) {
											for ($i = 0; $i < $emptyStars; $i++) {
												echo '<img src="' . base_url('assets_web/images/icons/star-grey.svg') . '" alt="Star">';
											}
										}
									?>
									<?php endif; ?>
								</div>
								<div class="rent-price py-1"><?= $new_product_data['day1_price'] ?> / Day</div>
								<div class="product-location line-clamp-1 py-1">
									Subhas Nagar, Dheradun
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	</main>
	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>
</body>

</html>