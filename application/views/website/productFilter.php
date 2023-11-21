<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Home";
	include("include/headTag.php") ?>
	<!-- Plugin Css -->
	<link rel="stylesheet" href="<?= base_url('assets_web/libs/nouislider/dist/nouislider.min.css') ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/product-filter.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/product-card-2.css') ?>">
</head>

<body>
	<?php include("include/loader.php") ?>
	<?php include("include/topbar.php") ?>
	<?php include("include/navbar.php") ?>

	<input type="hidden" id="hidden_catid" value="<?php echo $cat_details->cat_id; ?>">
	<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">

	<div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel" style="width: 65%">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="rentOffcanvasLabel">Filters</h5>
			<button type="button" class="close-btn-offcanvas text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
				<i class="fa-solid fa-xmark"></i>
			</button>
		</div>
		<div class="offcanvas-body" id="filtersContainer">
			<div class="filter-card">
				<?php foreach ($product_filter as $p_weight) : ?>
					<div class="py-3">
						<h6 class="mb-3"><?= $p_weight['name'] ?></h6>
						<?php foreach ($p_weight['value'] as $key => $product_weight) : ?>
							<?= $key === 2 ? '<div class="multi-collapse collapse" id="' . $p_weight['name'] . '">' : '' ?>
							<?php if ($key < 2) : ?>
								<div class="form-check">
									<input type="hidden" name="attr_name" id="attr_name" value="<?= $p_weight['name']; ?>">
									<input type="hidden" name="attr_id" id="attr_id" value="<?= $p_weight['attr_id']; ?>">
									<input class="form-check-input" type="checkbox" value="<?= $product_weight; ?>" id="flexCheckChecked">
									<label <?= $p_weight['name'] == 'Color' ? 'style="background-color:' . $product_weight . '"' : '' ?> class="form-check-label <?= $p_weight['name'] ?>"><?= $p_weight['name'] != 'Color' ?  $product_weight : '' ?></label>
								</div>
							<?php else : ?>
								<!-- Collapsable -->
								<div class="form-check">
									<input type="hidden" name="attr_name" id="attr_name" value="<?= $p_weight['name']; ?>">
									<input type="hidden" name="attr_id" id="attr_id" value="<?= $p_weight['attr_id']; ?>">
									<input class="form-check-input" type="checkbox" value="<?= $product_weight; ?>" id="flexCheckChecked">
									<label <?= $p_weight['name'] == 'Color' ? 'style="background-color:' . $product_weight . '"' : '' ?> class="form-check-label <?= $p_weight['name'] ?>"><?= $p_weight['name'] != 'Color' ?  $product_weight : '' ?></label>
								</div>
								<?= $key + 1 === count($p_weight['value']) ? '</div>' : '' ?>
								<?php if ($key + 1 === count($p_weight['value'])) : ?>
									<a class="p-0 mb-0 mt-2 btn-more d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#<?= $p_weight['name'] ?>" role="button" aria-expanded="false" aria-controls="<?= $p_weight['name'] ?>" style="font-size: smaller;">
										<div class="text-uppercase"><?= $this->lang->line('see') ?></div>
										<div class="see-more text-uppercase <?= $default_language == 1 ? 'me-1' : 'ms-1' ?>"><?= $this->lang->line('more') ?></div>
										<div class="see-less text-uppercase <?= $default_language == 1 ? 'me-1' : 'ms-1' ?>"><?= $this->lang->line('less') ?></div>
										<i class="fa-solid fa-angle-down <?= $default_language == 1 ? 'me-2' : 'ms-2' ?>"></i>
									</a>
								<?php endif; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>

				<?php if (!empty($price_filter['min_price']) && !empty($price_filter['max_price'])) :  ?>
					<?php if ($price_filter['min_price'] != $price_filter['max_price']) :  ?>
						<!-- Prize Slider -->
						<div class="py-3">
							<div class="px-0">
								<h6 class="mb-3">Price Range</h6>
								<div>
									<div class="noui-wrapper">
										<div class="d-flex justify-content-between mb-3">
											<input type="text" class="form-control me-4 text-center" readonly>
											<input type="text" class="form-control me-1 text-center" readonly>
										</div>
										<div class="noui-slider-div">
											<div class="noui-slider-range mt-2" data-range-min='<?= $price_filter['min_price'] ?>' data-range-max='<?= $price_filter['max_price'] ?>' data-range-selected-min='<?= $price_filter['min_price'] ?>' data-range-selected-max='<?= $price_filter['max_price'] ?>'></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<div class="py-3">
					<h6 class="mb-3">Ratings</h6>
					<div class="mb-0 g-3">
						<div class="mb-2">
							<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c1" value="3">
							<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c1">
								<div class="ratings-filter">3+ <img class="mb-1" src="<?= base_url('assets_web/images/icons/star-yellow.svg') ?>" alt="Star"> & <?= $this->lang->line('above'); ?></div>
							</label>
						</div>
						<div class="mb-2">
							<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c2" value="3.5">
							<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c2">
								<div class="ratings-filter">3.5+ <img class="mb-1" src="<?= base_url('assets_web/images/icons/star-yellow.svg') ?>" alt="Star"> & <?= $this->lang->line('above'); ?></div>
							</label>
						</div>
						<div class="mb-2">
							<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c3" value="4">
							<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c3">
								<div class="ratings-filter">4+ <img class="mb-1" src="<?= base_url('assets_web/images/icons/star-yellow.svg') ?>" alt="Star"> & <?= $this->lang->line('above'); ?></div>
							</label>
						</div>
						<div class="mb-2">
							<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c4" value="4.5">
							<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c4">
								<div class="ratings-filter">4.5+ <img class="mb-1" src="<?= base_url('assets_web/images/icons/star-yellow.svg') ?>" alt="Star"> & <?= $this->lang->line('above'); ?></div>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<main>
		<section class="my-5">
			<div class="container">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<?php foreach ($cat_details->parent_cat_names as $parent_cat_name) : ?>
							<li class="breadcrumb-item"><?= $parent_cat_name->cat_name ?></li>
						<?php endforeach; ?>
						<li class="breadcrumb-item active" aria-current="page"><?= $cat_details->cat_name; ?></li>
					</ol>
				</nav>
				<div class="row align-items-center py-lg-1">
					<div class="filter-page-heading d-none d-lg-flex col-lg-3 justify-content-between">
						<div class="fw-bolder text-uppercase m-0">Filters</div>
						<a class="btn text-uppercase fw-bolder p-0 m-0" id="clear-all-filter">Clear All</a>
					</div>
					<div class="col-6 col-lg-9 p-4 p-lg-1 d-flex justify-content-lg-end">
						<select class="form-select" onchange="" id="sort_data_id" aria-label="Sort By option">
							<option value="">Sort By</option>
							<?php foreach ($product_short_by as $short_product) { ?>
								<option id="<?php echo $short_product['sort_id']; ?>" value="<?php echo $short_product['sort_id']; ?>"><?php echo $short_product['name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-6 col-lg-9 d-flex d-lg-none justify-content-end align-items-center p-4 p-lg-1">
						<a class="btn btn-lg btn-primary px-1 text-white fs-6 fw-bold text-decoration-none" id="applyFilterBtn" data-bs-toggle="offcanvas" href="#filterOffcanvas" role="button" aria-controls="filterOffcanvas" style="white-space: nowrap;">
							<div class="d-flex align-items-center">
								<i class="fa-solid fa-filter"></i>
								<div class="<?= $default_language == 1 ? 'me-1' : 'ms-1' ?>">Apply Filters</div>
							</div>
						</a>
					</div>
				</div>
				<hr class="my-0">
				<div class="row">
					<div class="col-lg-3 d-none d-lg-block">
						<aside id="filtersContainer" class="ps-2">
							<div class="filter-card">
								<?php foreach ($product_filter as $p_weight) : ?>
									<div class="py-3">
										<h6 class="mb-3"><?= $p_weight['name'] ?></h6>
										<?php foreach ($p_weight['value'] as $key => $product_weight) : ?>
											<?= $key === 2 ? '<div class="multi-collapse collapse" id="' . $p_weight['name'] . '">' : '' ?>
											<?php if ($key < 2) : ?>
												<div class="form-check">
													<input type="hidden" name="attr_name" id="attr_name" value="<?= $p_weight['name']; ?>">
													<input type="hidden" name="attr_id" id="attr_id" value="<?= $p_weight['attr_id']; ?>">
													<input class="form-check-input" type="checkbox" value="<?= $product_weight; ?>" id="flexCheckChecked">
													<label <?= $p_weight['name'] == 'Color' ? 'style="background-color:' . $product_weight . '"' : '' ?> class="form-check-label <?= $p_weight['name'] ?>"><?= $p_weight['name'] != 'Color' ?  $product_weight : '' ?></label>
												</div>
											<?php else : ?>
												<!-- Collapsable -->
												<div class="form-check">
													<input type="hidden" name="attr_name" id="attr_name" value="<?= $p_weight['name']; ?>">
													<input type="hidden" name="attr_id" id="attr_id" value="<?= $p_weight['attr_id']; ?>">
													<input class="form-check-input" type="checkbox" value="<?= $product_weight; ?>" id="flexCheckChecked">
													<label <?= $p_weight['name'] == 'Color' ? 'style="background-color:' . $product_weight . '"' : '' ?> class="form-check-label <?= $p_weight['name'] ?>"><?= $p_weight['name'] != 'Color' ?  $product_weight : '' ?></label>
												</div>
												<?= $key + 1 === count($p_weight['value']) ? '</div>' : '' ?>
												<?php if ($key + 1 === count($p_weight['value'])) : ?>
													<a class="p-0 mb-0 mt-2 btn-more d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#<?= $p_weight['name'] ?>" role="button" aria-expanded="false" aria-controls="<?= $p_weight['name'] ?>" style="font-size: smaller;">
														<div class="text-uppercase"><?= $this->lang->line('see') ?></div>
														<div class="see-more text-uppercase <?= $default_language == 1 ? 'me-1' : 'ms-1' ?>"><?= $this->lang->line('more') ?></div>
														<div class="see-less text-uppercase <?= $default_language == 1 ? 'me-1' : 'ms-1' ?>"><?= $this->lang->line('less') ?></div>
														<i class="fa-solid fa-angle-down <?= $default_language == 1 ? 'me-2' : 'ms-2' ?>"></i>
													</a>
												<?php endif; ?>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>

								<?php if (!empty($price_filter['min_price']) && !empty($price_filter['max_price'])) :  ?>
									<?php if ($price_filter['min_price'] != $price_filter['max_price']) :  ?>
										<!-- Prize Slider -->
										<div class="py-3">
											<div class="px-0">
												<h6 class="mb-3">Price Range</h6>
												<div>
													<div class="noui-wrapper">
														<div class="d-flex justify-content-between mb-3">
															<input type="text" class="form-control me-4 text-center" readonly>
															<input type="text" class="form-control me-1 text-center" readonly>
														</div>
														<div class="noui-slider-div">
															<div class="noui-slider-range mt-2" data-range-min='<?= $price_filter['min_price'] ?>' data-range-max='<?= $price_filter['max_price'] ?>' data-range-selected-min='<?= $price_filter['min_price'] ?>' data-range-selected-max='<?= $price_filter['max_price'] ?>'></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>
								<?php endif; ?>

								<div class="py-3">
									<h6 class="mb-3">Ratings</h6>
									<div class="mb-0 g-3">
										<div class="mb-2">
											<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c1" value="3">
											<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c1">
												<div class="ratings-filter">3+ <img class="mb-1" src="<?= base_url('assets_web/images/icons/star-yellow.svg') ?>" alt="Star"> & <?= $this->lang->line('above'); ?></div>
											</label>
										</div>
										<div class="mb-2">
											<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c2" value="3.5">
											<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c2">
												<div class="ratings-filter">3.5+ <img class="mb-1" src="<?= base_url('assets_web/images/icons/star-yellow.svg') ?>" alt="Star"> & <?= $this->lang->line('above'); ?></div>
											</label>
										</div>
										<div class="mb-2">
											<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c3" value="4">
											<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c3">
												<div class="ratings-filter">4+ <img class="mb-1" src="<?= base_url('assets_web/images/icons/star-yellow.svg') ?>" alt="Star"> & <?= $this->lang->line('above'); ?></div>
											</label>
										</div>
										<div class="mb-2">
											<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c4" value="4.5">
											<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c4">
												<div class="ratings-filter">4.5+ <img class="mb-1" src="<?= base_url('assets_web/images/icons/star-yellow.svg') ?>" alt="Star"> & <?= $this->lang->line('above'); ?></div>
											</label>
										</div>
									</div>
								</div>
							</div>
						</aside>
					</div>
					<article class="col-lg-9 px-1" id="filterProducts0">
						<div class="trending-section filter empty-product row mx-2 mt-3" id="category_product"></div>
						<div class="loading-container text-center m-5">
							<div class="spinner-border text-primary" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>
					</article>
				</div>
			</div>
		</section>
	</main>

	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>

	<!-- Plugin JS -->
	<script src="<?= base_url('assets_web/libs/nouislider/dist/nouislider.min.js') ?>"></script>
	<script src="<?= base_url('assets_web/js/app/product-filter.js') ?>"></script>

</body>

</html>