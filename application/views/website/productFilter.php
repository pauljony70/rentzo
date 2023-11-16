<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Home";
	include("include/headTag.php") ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/product-filter.css">
</head>
<style>
	img.outof_stock {
		position: absolute;
		z-index: 1;
		margin-left: 10px;
		margin-top: 3px;
	}
	
	img.zoom-img.thumbnail-image {
		width: -webkit-fill-available;
		height : 250px;
	}
	
	.old-price {
		text-decoration: line-through;
		padding-bottom: 2px;
		color: #162b75;
	}

	@media (max-width: 767.98px) {
		img.outof_stock {
			width: 70px;
			margin-left: 4px;
			margin-top: -3px;
		}

		h5 {
			font-size: 13px;
		}
	}

	<?php if ($default_language == 1) : ?>#filtersContainer {
		border-left: 1px solid #e4e4e4;
	}

	.noUi-txt-dir-rtl.noUi-horizontal .noUi-origin {
		left: 0;
		right: 0;
	}

	.noUi-txt-dir-rtl.noUi-horizontal .noUi-handle {
		left: 15px;
		right: auto;
	}

	<?php else : ?>#filtersContainer {
		border-right: 1px solid #e4e4e4;
	}

	.noUi-txt-dir-rtl.noUi-horizontal .noUi-handle {
		left: -17px;
		right: auto;
	}
	
	

	<?php endif; ?>
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
	<input type="hidden" id="hidden_catid" value="<?php echo $cat_details->cat_id; ?>">
	<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
	<main>
		<div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel" style="width: 65%">
			<div class="offcanvas-header bg-primary">
				<h5 class="offcanvas-title text-light mb-0" id="filterOffcanvasLabel"><?= $this->lang->line('filter'); ?></h5>
				<button type="button" class="btn-close text-reset text-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<div class="card filter-card">
					<?php foreach ($product_filter as $p_weight) : ?>
						<div class="card-body px-0">
							<h6 class="mb-2"><?= $p_weight['name'] ?></h6>
							<div class="col-12">
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
						</div>
						<hr class="my-0">
					<?php endforeach; ?>

					<?php if (!empty($price_filter['min_price']) && !empty($price_filter['max_price'])) :  ?>
						<?php if ($price_filter['min_price'] != $price_filter['max_price']) :  ?>
							<!-- Prize Slider -->
							<div class="col-sm-9 card-body px-0">
								<div class="card-body px-0">
									<h6 class="form-label"><?= $this->lang->line('price-range'); ?></h6>
									<div class="w-80 <?php if ($default_language == 1) echo "me-4" ?>">
										<div class="noui-wrapper">
											<div class="d-flex justify-content-between">
												<input type="text" readonly class="text-body input-with-range-min <?= $default_language == 1 ? 'text-end' : '' ?>" style="<?= $default_language == 1 ? "margin-right: -0.9rem" : "margin-right: -0.9rem;"; ?> ">
												<input type="text" readonly class="text-body input-with-range-max <?= $default_language == 1 ? 'text-start' : 'text-start' ?>" style="<?= $default_language == 1 ? "margin-left: -0.3rem;" : "margin-right: -3.2rem;";  ?>">
											</div>
											<div class="noui-slider-range mt-2" data-range-min='<?= $price_filter['min_price'] ?>' data-range-max='<?= $price_filter['max_price'] ?>' data-range-selected-min='<?= $price_filter['min_price'] ?>' data-range-selected-max='<?= $price_filter['max_price'] ?>'></div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
					<hr class="my-0">
					<div class="card-body px-0">
						<h6 class="mb-2"><?= $this->lang->line('rating'); ?></h6>
						<div class="mb-0 g-3">
							<div class="mb-2">
								<input type="radio" name="rating-radio" class="btn-check" id="btn-check-o1" value="3">
								<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-o1">
									<div class="ratings-filter">3+ <i class="fa-solid fa-star"></i> & <?= $this->lang->line('above'); ?></div>
								</label>
							</div>
							<div class="mb-2">
								<input type="radio" name="rating-radio" class="btn-check" id="btn-check-o2" value="3.5">
								<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-o2">
									<div class="ratings-filter">3.5+ <i class="fa-solid fa-star"></i> & <?= $this->lang->line('above'); ?></div>
								</label>
							</div>
							<div class="mb-2">
								<input type="radio" name="rating-radio" class="btn-check" id="btn-check-o3" value="4">
								<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-o3">
									<div class="ratings-filter">4+ <i class="fa-solid fa-star"></i> & <?= $this->lang->line('above'); ?></div>
								</label>
							</div>
							<div class="mb-2">
								<input type="radio" name="rating-radio" class="btn-check" id="btn-check-o4" value="4.5">
								<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-o4">
									<div class="ratings-filter">4.5+ <i class="fa-solid fa-star"></i> & <?= $this->lang->line('above'); ?></div>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<section>
			<div class="container px-0">
				<nav aria-label="breadcrumb" class="px-4 px-md-1">
					<ol class="breadcrumb mt-2 mb-0">
						<?php foreach ($cat_details->parent_cat_names as $parent_cat_name) : ?>
							<li class="breadcrumb-item"><?= $parent_cat_name->cat_name ?></li>
						<?php endforeach; ?>
						<li class="breadcrumb-item active fw-bolder" aria-current="page"><?= $cat_details->cat_name; ?></li>
					</ol>
				</nav>
				<div class="d-flex align-items-center py-md-1">
					<div class="d-none d-md-flex col-sm-3 col-lg-2 justify-content-between py-1 px-2 px-xxl-1">
						<h6 class="fw-bolder text-uppercase mt-1 m-0"><?= $this->lang->line('filters') ?></h6>
						<a class="h6 btn text-uppercase fw-bolder p-0 m-0" id="clear-all-filter"><?= $this->lang->line('clear-all') ?></a>
					</div>
					<div class="p-4 p-md-1 d-flex justify-content-md-end w-100">
						<select class="form-select" onchange="" id="sort_data_id" aria-label="Sort By option">
							<option value=""><?php if ($default_language == 1) {
													echo 'ترتيب حسب';
												} else {
													echo 'Sort By';
												} ?></option>
							<?php
							foreach ($product_short_by as $short_product) {
							?>
								<option id="<?php echo $short_product['sort_id']; ?>" value="<?php echo $short_product['sort_id']; ?>"><?php echo $short_product['name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="d-flex d-md-none justify-content-end align-items-center p-4 p-md-1">
						<a class="btn btn-lg btn-primary px-1 text-white fs-6 fw-bold text-decoration-none" id="applyFilterBtn" data-bs-toggle="offcanvas" href="#filterOffcanvas" role="button" aria-controls="filterOffcanvas" style="white-space: nowrap;">
							<div class="d-flex align-items-center">
								<i class="fa-solid fa-filter"></i>
								<div class="<?= $default_language == 1 ? 'me-1' : 'ms-1' ?>"><?= $this->lang->line('apply-filters') ?></div>
							</div>
						</a>
					</div>
				</div>
				<hr class="my-0">
				<div class="row">
					<div class="col-md-3 col-lg-2 d-none d-md-block px-1">
						<aside id="filtersContainer">
							<div class="container-fluid px-1">
								<div class="row"> 
									<div class="p-3">
										<div class="card filter-card p-3">
											<?php foreach ($product_filter as $p_weight) : ?>
												<div class="card-body px-0">
													<h6 class="mb-2"><?= $p_weight['name'] ?></h6>
													<div class="col-12">
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
												</div>
												<hr class="my-0">
											<?php endforeach; ?>

											<?php /* if (!empty($price_filter['min_price']) && !empty($price_filter['max_price'])) :  ?>
												<?php if ($price_filter['min_price'] != $price_filter['max_price']) :  ?>
													<!-- Prize Slider -->
													<div class="my-0">
														<div class="card-body px-0">
															<h6 class="mb-2"><?= $this->lang->line('price-range'); ?></h6>
															<div class="w-80 <?php if ($default_language == 1) echo "me-5" ?>">
																<div class="noui-wrapper">
																	<div class="d-flex justify-content-between">
																		<input type="text" readonly class="text-body input-with-range-min <?= $default_language == 1 ? 'text-end' : 'text-start' ?>" style="<?= $default_language == 1 ? "margin-right: -0.9rem" : "margin-right: -1rem;"; ?> ">
																		<input type="text" readonly class="text-body input-with-range-max <?= $default_language == 1 ? 'text-start' : 'text-end' ?>" style="<?= $default_language == 1 ? "" : "margin-right: -1.1rem;" ?>">
																	</div>
																	<div class="noui-slider-range mt-2" data-range-min='<?= $price_filter['min_price'] ?>' data-range-max='<?= $price_filter['max_price'] ?>' data-range-selected-min='<?= $price_filter['min_price'] ?>' data-range-selected-max='<?= $price_filter['max_price'] ?>'></div>
																</div>
															</div>
														</div>
													</div>
												<?php endif; ?>
											<?php endif;*/ ?>
											<hr class="my-0">
											<div class="card-body px-0">
												<h6 class="mb-2"><?= $this->lang->line('rating'); ?></h6>
												<div class="mb-0 g-3">
													<div class="mb-2">
														<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c1" value="3">
														<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c1">
															<div class="ratings-filter">3+ <i class="fa-solid fa-star"></i> & <?= $this->lang->line('above'); ?></div>
														</label>
													</div>
													<div class="mb-2">
														<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c2" value="3.5">
														<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c2">
															<div class="ratings-filter">3.5+ <i class="fa-solid fa-star"></i> & <?= $this->lang->line('above'); ?></div>
														</label>
													</div>
													<div class="mb-2">
														<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c3" value="4">
														<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c3">
															<div class="ratings-filter">4+ <i class="fa-solid fa-star"></i> & <?= $this->lang->line('above'); ?></div>
														</label>
													</div>
													<div class="mb-2">
														<input type="radio" name="rating-radio" class="btn-check" id="btn-check-c4" value="4.5">
														<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c4">
															<div class="ratings-filter">4.5+ <i class="fa-solid fa-star"></i> & <?= $this->lang->line('above'); ?></div>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</aside>
					</div>
					<article class="col-md-9 col-lg-10 px-1" id="filterProducts0">
						<div class="container-fluid px-md-2 px-lg-4"></div>
						<div class="trending-section filter empty-cart row" id="category_sponsor_product"></div>
						<div class="trending-section filter empty-product row mx-2 mt-3" id="category_product"></div>
						<div class="loading-container text-center m-5" id="wholesale_product">
							<div class="spinner-border text-primary" role="status">
								<span class="visually-hidden">Loading...</span>
							</div> 
						</div>
					</article>
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
		var csrfName = $(".txt_csrfname").attr("name"); //
		var csrfHash = $(".txt_csrfname").val(); // CSRF hash
		var site_url = $(".site_url").val(); // CSRF hash
		var user_id = $("#user_id").val();

		var devicetype = 1;
		var filter_array = [];
		var price_object = {
			'min_price': '',
			'max_price': ''
		};
		var sort_id = '';
		var rating = '';
		var total_pages = 1;
		var pageNo = 0;
		let isFetching = false;
		var functionDelayTimeout;
		var pageLoadCount = 0;
		var hidden_catid = $("#hidden_catid").val();

		function get_category_product(catid, sortby, pageno, callback) {
			pageNo = pageno;
			$('.loading-container').removeClass('d-none');
			$.ajax({
				method: "post",
				url: site_url + "getCategoryProduct",
				data: {
					catid: catid,
					sortby: sortby,
					pageno: pageno,
					[csrfName]: csrfHash,
					language: default_language,
					min_price: price_object['min_price'],
					max_price: price_object['max_price'],
					rating: rating,
					devicetype: devicetype,
					config_attr: JSON.stringify(filter_array),
				},
				success: function(response) {
					var parsedJSON = response.Information;
					total_pages = response.total_pages;
					var qoute_id = <?php echo "'" . $this->session->userdata('qoute_id') . "'"; ?>;
					var order = parsedJSON.length;
					var product_html = "";
					if (pageno === 0)
						$("#category_product").empty();
					if (order != 0 && response.status == 1) {
						for (let i = 0; i < 1; i++) {
							$(parsedJSON).each(function() {
								var out_of_stock = "";
								if (this.stock_status == 'Out of Stock' || this.stock <= '0') {
									out_of_stock = '<img alt="' + website_name + '" class="outof_stock" src="' + site_url + 'assets/img/out-of-stock-en.png" >';
								}
								var ratingHTML = '';
								if (this.rating.total_rows > 0) {
									var ratingHTML =
										`<i class="fa-solid fa-star fa-lg"></i>
                                        <span class="rating-number">${(this.rating.total_rating/this.rating.total_rows).toFixed(1)}</span>`;
								}
								product_html +=
									`<div class="col-6 col-sm-4 col-lg-3 p-3">
									${out_of_stock}
									<a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
										<!--<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
											<span class="discount text-uppercase">
												<div>${this.offpercent}</div>
											</span>
											<span class="wishlist"><i class="fa fa-heart-o"></i></span>
										</div>-->
										<div class="image-container zoom-img">
											<img src="${site_url}/media/${this.imgurl}" class="zoom-img thumbnail-image">
										</div>
										<div class="product-detail-container p-2 mb-1">
											<div class="justify-content-between align-items-center">
												<p class="dress-name mb-0">${this.name}</p>	
												<div class="d-flex justify-content-start flex-row mt-2" style="width: 100%;">
													<span class="new-price mx-1">${this.price}</span>
													<small class="old-price text-right mx-1">${this.mrp}</small>
												</div>
											</div>
											<div class="d-flex justify-content-between align-items-center pt-1">
												<div class="d-flex align-items-center">
													${ratingHTML}
												</div>
												<button class="btn btn-primary text-center text-uppercase card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event, '${this.id}', '${this.sku}', '${this.vendor_id}', '${user_id}', '1', '0', '2', '${qoute_id}')"><?= $this->lang->line('buy') ?></button>
											</div>
										</div>
									</a>
								</div>`;

							});
						}
					} else {
						product_html = '<div class="wrap box-shadow-4"><img src="' + site_url + 'assets_web/images/empty-search-result.png" alt="" class="empty-cart-img"><h5><?= $this->lang->line('filter-page-record'); ?></h5><a href="' + site_url + '" class="btn btn-default"><?= $this->lang->line('filter-page-home-button'); ?></a></div>';
					}
					setTimeout(() => {
						$('.loading-container').addClass('d-none');
						$("#category_product").append(product_html);
						callback();
					}, 500);
				},
			});
		}

		$(document).on('change', '#sort_data_id', function() {
			sort_id = $("#sort_data_id").val();
			isFetching = true;
			get_category_product(hidden_catid, sort_id, 0, () => {
				isFetching = false;
			});
			get_category_sponsor_product(hidden_catid, sort_id, 0);
		});

		$(document).on('change', '#flexCheckChecked', function() {
			sort_id = $("#sort_data_id").val();
			if (this.checked) {
				var check_val = $(this).val();
				var attr_id = $(this).closest('div').find('#attr_id').val();
				var attr_name = $(this).closest('div').find('#attr_name').val();
				filter_array.push({
					"attr_id": attr_id,
					"attr_name": attr_name,
					"attr_value": check_val
				});
			} else {
				var check_val = $(this).val();
				var parsedJSON = filter_array;
				for (var i = 0; i < parsedJSON.length; i++) {
					var counter = parsedJSON[i];
					if (counter.attr_value.includes(check_val)) {
						parsedJSON.splice(i, 1);
					}
				}
			}
			isFetching = true;
			get_category_product(hidden_catid, sort_id, 0, () => {
				isFetching = false;
			});
			get_category_sponsor_product(hidden_catid, sort_id, 0);
		});

		var radioButtonGroup = document.getElementsByName('rating-radio');

		// Add change event listener to the radio button group
		radioButtonGroup.forEach(function(radioButton) {
			radioButton.addEventListener('change', function() {
				var selectedValue = this.value;
				rating = selectedValue;
				sort_id = $("#sort_data_id").val();
				isFetching = true;
				get_category_product(hidden_catid, sort_id, 0, () => {
					isFetching = false;
				});
			});
		});

		// Pagination
		window.addEventListener('scroll', () => {
			if (isFetching) return;
			const {
				scrollHeight,
				scrollTop,
				clientHeight
			} = document.documentElement;
			if (scrollTop + clientHeight >= scrollHeight - 100) {
				if (pageNo < total_pages - 1) {
					pageNo++;
					sort_id = $("#sort_data_id").val();
					isFetching = true;
					get_category_product(hidden_catid, sort_id, pageNo, () => {
						isFetching = false;
					});
				}
			}
		});

		function rangeSlider() {
			var rangeSlider = document.getElementsByClassName('noui-slider-range');
			if (rangeSlider.length > 0) {
				var rangeSliders = Array.from(rangeSlider);
				rangeSliders.forEach(slider => {
					var nouiMin = parseFloat(slider.getAttribute('data-range-min'));
					var nouiMax = parseFloat(slider.getAttribute('data-range-max'));
					var nouiSelectedMin = parseFloat(slider.getAttribute('data-range-selected-min'));
					var nouiSelectedMax = parseFloat(slider.getAttribute('data-range-selected-max'));
					var rangeText = slider.previousElementSibling;
					var imin = rangeText.firstElementChild;
					var imax = rangeText.lastElementChild;
					var inputs = [imin, imax];

					noUiSlider.create(slider, {
						start: [nouiSelectedMin, nouiSelectedMax],
						connect: true,
						// direction: 'rtl',
						direction: '<?= $default_language == 1 ? 'rtl' : 'ltr' ?>',
						step: 0.01,
						range: {
							min: [nouiMin],
							max: [nouiMax]
						}
					});

					slider.noUiSlider.on("update", function(values, handle) {
						inputs[handle].value = values[handle];
						if (pageLoadCount > 0) {
							clearTimeout(functionDelayTimeout);
							functionDelayTimeout = setTimeout(function() {
								price_object['min_price'] = values[0];
								price_object['max_price'] = values[1];
								sort_id = $("#sort_data_id").val();
								isFetching = true;
								get_category_product(hidden_catid, sort_id, 0, () => {
									isFetching = false;
								});
							}, 500);
						}
					});

					document.querySelector('#clear-all-filter').addEventListener('click', function() {
						slider.noUiSlider.set([nouiMin, nouiMax]);
						imin.value = nouiMin;
						imax.value = nouiMax;
						price_object['min_price'] = nouiMin;
						price_object['max_price'] = nouiMax;
						clearTimeout(functionDelayTimeout);
						functionDelayTimeout = setTimeout(function() {
							pageLoadCount = 0;
							sort_id = $("#sort_data_id").val();
							document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
								checkbox.checked = false;
							});
							document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
								radio.checked = false;
							});
							rating = '';
							filter_array = [];
							isFetching = true;
							get_category_product(hidden_catid, sort_id, 0, () => {
								isFetching = false;
							});
						}, 500);
					});
				});
			} else {
				document.querySelector('#clear-all-filter').addEventListener('click', function() {
					pageLoadCount = 0;
					sort_id = $("#sort_data_id").val();
					document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
						checkbox.checked = false;
					});
					document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
						radio.checked = false;
					});
					rating = '';
					filter_array = [];
					isFetching = true;
					get_category_product(hidden_catid, sort_id, 0, () => {
						isFetching = false;
					});
				});
			}
		}

		window.addEventListener('load', () => {
			//rangeSlider();

			isFetching = true;
			get_category_product(hidden_catid, '', 0, () => {
				isFetching = false;
			});
			get_category_sponsor_product(hidden_catid, "", 0);

			pageLoadCount++;
		});


		function get_category_sponsor_product(catid, sortby, pageno) {
			$.ajax({
				method: "post",
				url: site_url + "getCategorysponsorProduct",
				data: {
					catid: catid,
					sortby: sortby,
					pageno: pageno,
					[csrfName]: csrfHash,
					language: default_language,
					devicetype: devicetype,
					config_attr: JSON.stringify(filter_array),
				},
				success: function(response) {
					//hideloader();

					var parsedJSON = response.Information;

					var qoute_id = <?php echo "'" . $this->session->userdata('qoute_id') . "'"; ?>;

					var order = parsedJSON.length;
					var product_html = "";
					if (order != 0) {
						$("#category_sponsor_product").empty();
						$(parsedJSON).each(function() {
							product_html +=
								`<div class="mx-2 py-2" style="width:20rem;">
									<a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
										<div class="image-container mt-3 zoom-img">
											<div class="first">
												<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
													<span class="discount">-25%</span>
													<span class="wishlist"><i class="fa fa-heart-o"></i></span>
												</div>
											</div>
											<img src="${this.imgurl}" class="thumbnail-image">
										</div>
										<div class="product-detail-container p-2 mb-1">
											<div class="justify-content-between align-items-center">
												<p class="dress-name mb-0">${this.name}</p>	
												<div class="d-flex justify-content-start flex-row mt-2" style="width: 100%;">
													<span class="new-price mx-1">${this.mrp}</span>
													<small class="old-price text-right mx-1">${this.price}</small>
												</div>
											</div>
											<div class="d-flex justify-content-between align-items-center mt-3 pt-1">
												<div>
													<i class="fa-solid fa-star fa-lg" style="color: #ff6600;"></i>
													<span class="rating-number">4.8</span>
												</div>
												<button class="btn btn-primary text-center card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event, '${this.id}', '${this.sku}', '${this.vendor_id}', '${user_id}', '1', '0', '2', '${qoute_id}')">BUY</button>
											</div>
										</div>
									</a>
								</div>`

						});
					}
					$("#category_sponsor_product").html(product_html);
				},
			});
		}
	</script>
</body>

</html>