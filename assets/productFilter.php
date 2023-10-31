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
				<h5 class="offcanvas-title text-light mb-0" id="filterOffcanvasLabel">Filters</h5>
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
											<label <?= $p_weight['name'] == 'Color' ? 'style="background-color:' . $product_weight . '"' : '' ?> class="form-check-label <?= $p_weight['name'] ?>" for="flexCheckChecked"><?= $p_weight['name'] != 'Color' ?  $product_weight : '' ?></label>
										</div>
									<?php else : ?>
										<!-- Collapsable -->
										<div class="form-check">
											<input type="hidden" name="attr_name" id="attr_name" value="<?= $p_weight['name']; ?>">
											<input type="hidden" name="attr_id" id="attr_id" value="<?= $p_weight['attr_id']; ?>">
											<input class="form-check-input" type="checkbox" value="<?= $product_weight; ?>" id="flexCheckChecked">
											<label <?= $p_weight['name'] == 'Color' ? 'style="background-color:' . $product_weight . '"' : '' ?> class="form-check-label <?= $p_weight['name'] ?>" for="flexCheckChecked"><?= $p_weight['name'] != 'Color' ?  $product_weight : '' ?></label>
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

					<!-- Prize Slider -->
					<div class="col-sm-9 card-body px-0">
						<div class="card-body px-0">
							<h6 class="form-label">Price Range</h6>
							<div class="w-90 <?php if ($default_language == 1) echo "me-4" ?>">
								<div class="noui-wrapper">
									<div class="d-flex justify-content-between">
										<input type="text" class="text-body input-with-range-min <?= $default_language == 1 ? 'text-start' : '' ?>">
										<input type="text" class="text-body input-with-range-max <?= $default_language == 1 ? '' : 'text-end' ?>" style="<?php if ($default_language == 1) echo "margin-left: -0.5rem;"; else echo "margin-right: -0.6rem;"; ?>">
									</div>
									<div class="noui-slider-range mt-2" data-range-min='500' data-range-max='2000' data-range-selected-min='500' data-range-selected-max='2000'></div>
								</div>
							</div>
						</div>
					</div>

					<hr class="my-0">
					<div class="card-body px-0">
						<h6 class="mb-2">Ratings</h6>
						<div class="mb-0 g-3">
							<div class="mb-2">
								<input type="checkbox" class="btn-check" id="btn-check-o1">
								<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-o1">
									<div class="ratings-filter">3+ <i class="fa-solid fa-star"></i> & above</div>
								</label>
							</div>
							<div class="mb-2">
								<input type="checkbox" class="btn-check" id="btn-check-o2">
								<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-o2">
									<div class="ratings-filter">3.5+ <i class="fa-solid fa-star"></i> & above</div>
								</label>
							</div>
							<div class="mb-2">
								<input type="checkbox" class="btn-check" id="btn-check-o3">
								<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-o3">
									<div class="ratings-filter">4+ <i class="fa-solid fa-star"></i> & above</div>
								</label>
							</div>
							<div class="mb-2">
								<input type="checkbox" class="btn-check" id="btn-check-o4">
								<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-o4">
									<div class="ratings-filter">4.5+ <i class="fa-solid fa-star"></i> & above</div>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<section>
			<div class="container px-0">
				<nav aria-label="breadcrumb" class="px-1">
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
									<div class="p-0">
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
																	<label <?= $p_weight['name'] == 'Color' ? 'style="background-color:' . $product_weight . '"' : '' ?> class="form-check-label <?= $p_weight['name'] ?>" for="flexCheckChecked"><?= $p_weight['name'] != 'Color' ?  $product_weight : '' ?></label>
																</div>
															<?php else : ?>
																<!-- Collapsable -->
																<div class="form-check">
																	<input type="hidden" name="attr_name" id="attr_name" value="<?= $p_weight['name']; ?>">
																	<input type="hidden" name="attr_id" id="attr_id" value="<?= $p_weight['attr_id']; ?>">
																	<input class="form-check-input" type="checkbox" value="<?= $product_weight; ?>" id="flexCheckChecked">
																	<label <?= $p_weight['name'] == 'Color' ? 'style="background-color:' . $product_weight . '"' : '' ?> class="form-check-label <?= $p_weight['name'] ?>" for="flexCheckChecked"><?= $p_weight['name'] != 'Color' ?  $product_weight : '' ?></label>
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

											<!-- Prize Slider -->
											<div class="">
												<div class="card-body px-0">
													<h6 class="mb-2">Price Range</h6>
													<div class="w-90 <?php if ($default_language == 1) echo "me-4" ?>">
														<div class="noui-wrapper">
															<div class="d-flex justify-content-between">
																<input type="text" class="text-body input-with-range-min <?= $default_language == 1 ? 'text-start' : '' ?>" style="<?php if ($default_language == 1) echo "margin-right: -0.9rem" ?>">
																<input type="text" class="text-body input-with-range-max <?= $default_language == 1 ? '' : 'text-end' ?>" style="<?php if ($default_language != 1) echo "margin-right: -0.9rem" ?>">
															</div>
															<div class="noui-slider-range mt-2" data-range-min='500' data-range-max='2000' data-range-selected-min='500' data-range-selected-max='2000'></div>
														</div>
													</div>
												</div>
											</div>

											<hr class="my-0">
											<div class="card-body px-0">
												<h6 class="mb-2">Ratings</h6>
												<div class="mb-0 g-3">
													<div class="mb-2">
														<input type="checkbox" class="btn-check" id="btn-check-c1">
														<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c1">
															<div class="ratings-filter">3+ <i class="fa-solid fa-star"></i> & above</div>
														</label>
													</div>
													<div class="mb-2">
														<input type="checkbox" class="btn-check" id="btn-check-c2">
														<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c2">
															<div class="ratings-filter">3.5+ <i class="fa-solid fa-star"></i> & above</div>
														</label>
													</div>
													<div class="mb-2">
														<input type="checkbox" class="btn-check" id="btn-check-c3">
														<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c3">
															<div class="ratings-filter">4+ <i class="fa-solid fa-star"></i> & above</div>
														</label>
													</div>
													<div class="mb-2">
														<input type="checkbox" class="btn-check" id="btn-check-c4">
														<label class="btn btn-sm btn-outline-primary btn-primary-soft-check" for="btn-check-c4">
															<div class="ratings-filter">4.5+ <i class="fa-solid fa-star"></i> & above</div>
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
						<div class="trending-section filter empty-product row" id="category_product"></div>
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

		var language = 1;
		var devicetype = 1;
		var selectVal = ""; //$("#sort_data_id option:selected").val();
		var hidden_catid = $("#hidden_catid").val();
		var filter_array = [];
		var sort_id = '';
		var pages = 0;

		$(function() {
			window.onload = get_category_product(hidden_catid, "", 0);
			window.onload = get_category_sponsor_product(hidden_catid, "", 0);
		});

		document.querySelector('#clear-all-filter').addEventListener('click', () => {
			sort_id = $("#sort_data_id").val();
			document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
				checkbox.checked = false;
			});
			filter_array = [];
			get_category_product(hidden_catid, sort_id, 0);
			get_category_sponsor_product(hidden_catid, sort_id, 0);
		});

		$(document).on('change', '#sort_data_id', function() {
			var selectVal = $("#sort_data_id option:selected").val();
			sort_id = $(this).children(":selected").attr("id");
			get_category_product(hidden_catid, sort_id, 0);
			get_category_sponsor_product(hidden_catid, sort_id, 0);
		});

		$(document).on('load', '#flexCheckChecked', function() {
			if (this.checked) {
				var check_val = $(this).val();
				var attr_id = $(this).closest('div').find('#attr_id').val();
				var attr_name = $(this).closest('div').find('#attr_name').val();
				filter_array.push({
					"attr_id": attr_id,
					"attr_name": attr_name,
					"attr_value": check_val
				});
				//alert(JSON.stringify(filter_array));

			} else {
				var check_val = $(this).val();
				var parsedJSON = filter_array;
				//  alert("before " +parsedJSON);                                        

				for (var i = 0; i < parsedJSON.length; i++) {
					var counter = parsedJSON[i];
					// var name = counter.url;
					if (counter.attr_value.includes(check_val)) {
						//alert("remove it " +parsedJSON[i]);
						//delete parsedJSON[i];
						parsedJSON.splice(i, 1);

					}

				}
				// alert(JSON.stringify(filter_array));
			}
			get_category_product(hidden_catid, sort_id, pages);
		});

		$(document).on('change', '#flexCheckChecked', function() {
			if (this.checked) {
				var check_val = $(this).val();
				var attr_id = $(this).closest('div').find('#attr_id').val();
				var attr_name = $(this).closest('div').find('#attr_name').val();
				filter_array.push({
					"attr_id": attr_id,
					"attr_name": attr_name,
					"attr_value": check_val
				});
				//alert(JSON.stringify(filter_array));

			} else {
				var check_val = $(this).val();
				var parsedJSON = filter_array;
				//  alert("before " +parsedJSON);                                        

				for (var i = 0; i < parsedJSON.length; i++) {
					var counter = parsedJSON[i];
					// var name = counter.url;
					if (counter.attr_value.includes(check_val)) {
						//alert("remove it " +parsedJSON[i]);
						//delete parsedJSON[i];
						parsedJSON.splice(i, 1);

					}

				}
				// alert(JSON.stringify(filter_array));
			}
			get_category_product(hidden_catid, sort_id, pages);
			get_category_sponsor_product(hidden_catid, sort_id, pages);
		});

		function get_category_product(catid, sortby, pageno) {
			$.ajax({
				method: "post",
				url: site_url + "getCategoryProduct",
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
						$("#category_product").empty();
						$(parsedJSON).each(function() {


							// product_html += '<div class="col-lg-4 col-md-6 col-sm-4 col-6 p-1">';
							// if (this.stock_status == 'Out of Stock' || this.stock <= '0') {
							// 	product_html += '<img class="outof_stock" src="' + site_url + 'assets/img/out_of_stock.png" >';
							// }
							// product_html += '<a href="' +
							// 	site_url +
							// 	this.web_url +
							// 	"?pid=" +
							// 	this.id +
							// 	"&sku=" +
							// 	this.sku +
							// 	"&sid=" +
							// 	this.vendor_id +
							// 	'" ><div class="card"><div class="card-img zoom-img"><img src="' + site_url + 'media/' +
							// 	this.imgurl +
							// 	'" class="card-img-top" alt="..." /><div class="favorite"><a onclick="add_to_wishlist(event,' +
							// 	"'" +
							// 	this.id +
							// 	"','" +
							// 	this.sku +
							// 	"','" +
							// 	this.vendor_id +
							// 	"','" +
							// 	user_id +
							// 	"','1','0','2'," +
							// 	"'" +
							// 	qoute_id +
							// 	"'" + ')" href="javascript:void(0);"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke=""/></svg></a></div>';
							// if (this.product_total_rating != '') {
							// 	product_html += '<a href="' +
							// 		site_url +
							// 		this.web_url +
							// 		"?pid=" +
							// 		this.id +
							// 		"&sku=" +
							// 		this.sku +
							// 		"&sid=" +
							// 		this.vendor_id +
							// 		'" ><div class="rating_label">' + this.product_total_rating + '&nbsp;<img src="' + site_url + 'assets_web/images/icons/star.png"></div></a>';
							// }
							// product_html += '</div><div class="card-body"><h6 class="pd-title">' +
							// 	this.name +
							// 	'</h6><div class="row"><div class="col-6"><h6 class="old-price">' + this.mrp + '</h6><h5 class="new-price">' + this.price + '/-</h5></div><div class="col-6"><div class="btn-by-now"><a href="#" onclick="add_to_cart_product_buy(event,' +
							// 	"'" +
							// 	this.id +
							// 	"','" +
							// 	this.sku +
							// 	"','" +
							// 	this.vendor_id +
							// 	"','" +
							// 	user_id +
							// 	"','1','0','2'," +
							// 	"'" +
							// 	qoute_id +
							// 	"'" +
							// 	')" class="btn btn-default w-100">Buy Now</a></div></div></div></div></div></a></div>';

							product_html +=
								`<div class="col-6 col-sm-4 col-lg-3 p-3">
									<a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
										<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
											<span class="discount text-uppercase">
												<div>${this.offpercent}</div>
											</span>
											<span class="wishlist"><i class="fa fa-heart-o"></i></span>
										</div>
										<div class="image-container zoom-img">
											<img src="${site_url}/media/${this.imgurl}" class="zoom-img thumbnail-image">
										</div>
										<div class="product-detail-container p-2 mb-1">
											<div class="justify-content-between align-items-center">
												<p class="dress-name fs-5 mb-0 fs-5">${this.name}</p>	
												<div class="d-flex justify-content-start flex-row mt-2" style="width: 100%;">
													<span class="new-price mx-1">${this.mrp}</span>
													<small class="old-price text-right mx-1">${this.price}</small>
												</div>
											</div>
											<div class="d-flex justify-content-between align-items-center pt-1">
												<div class="d-flex align-items-center">
													<i class="fa-solid fa-star fa-lg"></i>
													<div class="rating-number">4.8</div>
												</div>
												<button class="btn btn-primary text-center text-uppercase card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event, '${this.id}', '${this.sku}', '${this.vendor_id}', '${user_id}', '1', '0', '2', '${qoute_id}')"><?= $this->lang->line('buy') ?></button>
											</div>
										</div>
									</a>
								</div>`;


						});
						var result = Paging(
							response.pageno,
							32,
							response.productCount,
							"page-link shadow",
							"myDisableClass page-link shadow"
						);
						$(".pagingDiv").html(result);
					} else {
						/*product_html = "No Record Found.";*/
						product_html = '<div class="wrap box-shadow-4"><img src="' + site_url + 'assets_web/images/empty-search-result.png" alt="" class="empty-cart-img"><h5>Sorry, no record found!</h5><a href="' + site_url + '" class="btn btn-default">GO TO HOMEPAGE</a></div>';
					}
					$("#category_product").html(product_html);
				},
			});
		}

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
												<p class="dress-name fs-5 mb-0 fs-5">${this.name}</p>	
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
						var result = Paging(
							response.pageno,
							32,
							response.productCount,
							"page-link shadow",
							"myDisableClass page-link shadow"
						);
						$(".pagingDiv").html(result);
					}
					$("#category_sponsor_product").html(product_html);
				},
			});
		}

		$(document).ready(function() {
			$(".pagingDiv").on("click", "a", function() {
				pages = $(this).attr("pn") - 1;
				get_category_product(hidden_catid, sort_id, pages);
				get_category_sponsor_product(hidden_catid, sort_id, pages);
			});
		});

		function Paging(
			PageNumber,
			PageSize,
			TotalRecords,
			ClassName,
			DisableClassName
		) {
			var ReturnValue = "";

			var TotalPages = Math.ceil(TotalRecords / PageSize);
			if (+PageNumber > 1) {
				if (+PageNumber == 2)
					ReturnValue =
					ReturnValue +
					"<li class='page-item'><a pn='" +
					(+PageNumber - 1) +
					"' class='" +
					ClassName +
					"' aria-label='Previous'><i aria-hidden='true' class='fas fa-angle-left'></i></a> </li>  ";
				else {
					ReturnValue = ReturnValue + "<li class='page-item'><a pn='";
					ReturnValue =
						ReturnValue +
						(+PageNumber - 1) +
						"' class='" +
						ClassName +
						"' aria-label='Previous'><i aria-hidden='true' class='fas fa-angle-left'></i></a> </li>  ";
				}
			} else
				ReturnValue =
				ReturnValue +
				"<li class='page-item'><span class='" +
				DisableClassName +
				"' aria-label='Previous'><i aria-hidden='true' class='fas fa-angle-left'></i></span></a>   ";
			if (+PageNumber - 3 > 1)
				ReturnValue =
				ReturnValue +
				"<li class='page-item'><a pn='1' class='" +
				ClassName +
				"'>1</a></li> ...  ";
			for (var i = +PageNumber - 3; i <= +PageNumber; i++)
				if (i >= 1) {
					if (+PageNumber != i) {
						ReturnValue = ReturnValue + "<li class='page-item'><a pn='";
						ReturnValue =
							ReturnValue + i + "' class='" + ClassName + "'>" + i + "</a> </li> ";
					} else {
						ReturnValue =
							ReturnValue +
							"<li class='page-item active'><span class='" +
							DisableClassName +
							"'>" +
							i +
							"</span> </li>";
					}
				}
			for (var i = +PageNumber + 1; i <= +PageNumber + 3; i++)
				if (i <= TotalPages) {
					if (+PageNumber != i) {
						ReturnValue = ReturnValue + "<li class='page-item'><a pn='";
						ReturnValue =
							ReturnValue + i + "' class='" + ClassName + "'>" + i + "</a> </li> ";
					} else {
						ReturnValue =
							ReturnValue +
							"<li class='page-item active'><span class='" +
							DisableClassName +
							"'>" +
							i +
							"</span> </li>";
					}
				}
			if (+PageNumber + 3 < TotalPages) {
				ReturnValue = ReturnValue + "...<li class='page-item'> <a pn='";
				ReturnValue =
					ReturnValue +
					TotalPages +
					"' class='" +
					ClassName +
					"'>" +
					TotalPages +
					"</a> </li>";
			}
			if (+PageNumber < TotalPages) {
				ReturnValue = ReturnValue + "   <li class='page-item'><a pn='";
				ReturnValue =
					ReturnValue +
					(+PageNumber + 1) +
					"' class='" +
					ClassName +
					"' aria-label='Next'><i aria-hidden='true' class='fas fa-angle-right'></i></a> </li>";
			} else
				ReturnValue =
				ReturnValue +
				"   <span class='" +
				DisableClassName +
				"' aria-label='Next'><i aria-hidden='true' class='fas fa-angle-right'></i></span>";

			return ReturnValue;
		}
	</script>
</body>

</html>