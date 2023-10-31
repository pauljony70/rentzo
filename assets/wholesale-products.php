<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = 'Wholesale Products';
    include("include/headTag.php") ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/product-filter.css">
    <style>
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
</head>

<body>
    <?php include("include/loader.php") ?>
    <?php include("include/topbar.php") ?>
    <?php include("include/navbar.php") ?>
    <main>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel" style="width: 65%">
            <div class="offcanvas-header bg-primary">
                <h5 class="offcanvas-title text-light mb-0" id="filterOffcanvasLabel"><?= $this->lang->line('filters') ?></h5>
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
                                        <input type="text" class="text-body input-with-range-max <?= $default_language == 1 ? '' : 'text-end' ?>" style="<?php if ($default_language == 1) echo "margin-left: -0.5rem;";
                                                                                                                                                            else echo "margin-right: -0.6rem;"; ?>">
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
                <div class="row container67">
                    <div class="col-md-3 col-lg-2 d-none d-md-block px-1">
                        <div id="filtersContainer___margin"></div>
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
                        <div class="trending-section filter empty-product row" id="wholesale_product"></div>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <?php include("include/footer.php") ?>
    <?php include("include/script.php") ?>
    <script>
        var filter_array = [];
        var sort_id = '';
        var qoute_id = $("#qoute_id").val();
        var user_id = $("#user_id").val();

        document.querySelector('#clear-all-filter').addEventListener('click', () => {
            sort_id = $("#sort_data_id").val();
            document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                checkbox.checked = false;
            });
            filter_array = [];
            get_wholesale_products(sort_id, 0);
        });

        function get_wholesale_products(sortby, pageno) {
            $.ajax({
                method: "post",
                url: site_url + "get-wholesale-products",
                data: {
                    sortby: sortby,
                    pageno: pageno,
                    [csrfName]: csrfHash,
                    language: default_language,
                    config_attr: JSON.stringify(filter_array),
                },
                success: function(response) {

                    var parsedJSON = response.Information;

                    var order = parsedJSON.length;
                    var product_html = "";
                    if (order != 0) {
                        $("#wholesale_product").empty();
                        for (let i = 0; i < 20; i++) {
                            $(parsedJSON).each(function() {
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
													<span class="new-price mx-1">${this.price}</span>
													<small class="old-price text-right mx-1">${this.mrp}</small>
												</div>
											</div>
											<div class="d-flex justify-content-between align-items-center pt-1">
                                                <div class="d-flex align-items-center">
													<i class="fa-solid fa-star fa-lg"></i>
													<span class="rating-number">4.8</span>
												</div>
												<button class="btn btn-primary text-center text-uppercase card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event, '${this.id}', '${this.sku}', '${this.vendor_id}', '${user_id}', '1', '0', '2', '${qoute_id}')"><?= $this->lang->line('buy') ?></button>
											</div>
										</div>
									</a>
								</div>`;
                            });
                        }
                    } else {
                        product_html = '<div class="wrap box-shadow-4"><img src="' + site_url + 'assets_web/images/empty-search-result.png" alt="" class="empty-cart-img"><h5>Sorry, no record found!</h5><a href="' + site_url + '" class="btn btn-default">GO TO HOMEPAGE</a></div>';
                    }
                    $("#wholesale_product").html(product_html);
                },
            });
        }

        $(document).on('change', '#flexCheckChecked', function() {
            sort_id = $("#sort_data_id").val();
            console.log(sort_id);
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
            get_wholesale_products(sort_id, 0);
        });

        $("#sort_data_id").change(function() {
            sort_id = $(this).val();
            get_wholesale_products(sort_id, 0);
        });

        get_wholesale_products('', 0);

        /* var filtersContainer = document.getElementById('filtersContainer');
        var filtersContainer___margin = document.getElementById('filtersContainer___margin');

        // Calculate the initial positions of the filtersContainer
        const calculateFilterContainerPositions = () => {
            var viewportHeight = window.innerHeight;
            var filtersContainerHeight = filtersContainer.offsetHeight;
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            var scrollBottom = document.documentElement.scrollHeight - (scrollTop + viewportHeight);
            var topPosition = '-' + (filtersContainerHeight - viewportHeight) + 'px';

            if (scrollTop > 0 && scrollBottom > 0) {
                filtersContainer.style.cssText = `top: ${topPosition};`;
            } else if (scrollTop === 0) {
                filtersContainer.style.cssText = `bottom: ${topPosition};`;
            }
        };

        // Call the calculation function initially and on window scroll
        window.addEventListener('scroll', calculateFilterContainerPositions);
        window.addEventListener('load', calculateFilterContainerPositions);
        window.addEventListener('resize', calculateFilterContainerPositions); */
    </script>
</body>

</html>