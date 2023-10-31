<style>
    .icon-count {
        white-space: nowrap;
        text-align: center;
        line-height: 17px;
        height: 16px;
        width: 16px;
        background: rgba(219, 68, 68, 0.9);
        color: #FAFAFA;
        position: absolute;
        border-radius: 50%;
        font-size: 12px;
        top: -7px;
        left: 15px;
        font-weight: 700;
    }

    .custom-accordion-button {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
        padding: var(--mr-accordion-btn-padding-y) var(--mr-accordion-btn-padding-x);
        font-size: 0.875rem;
        color: var(--mr-accordion-btn-color);
        text-align: left;
        background-color: var(--mr-accordion-btn-bg);
        border: 0;
        border-radius: 0;
        overflow-anchor: none;
        transition: var(--mr-accordion-transition);
    }

    /*  @media (max-width: 767px) {
        .icon-count {
            line-height: 18px;
            height: 16px;
            width: 16px;
            top: 0px;
            right: 6px;
        }
    }

    @media (max-width: 576px) {
        .icon-count {
            top: 0;
            right: 4px;
        }
    }

    @media (max-width: 992px) and (min-width: 768px) {
        .icon-count {
            top: -7.5px;
            right: 12px;
        }
    } */
</style>

<!-- For Mobile Sidebar -->
<style>
    @media (max-width: 991px) {
        #navbar_for_desktop {
            display: none;
        }

        #navbar_for_mobile {
            display: flex;
            height: 45px;
        }

        /* .mobile_view_main_div {
            background-color: #f4f5f9;
        } */

        .down_link_pages {
            font-size: 15px;
            color: black;
            font-weight: 400;
        }

        .sub_category_item {
            /* border: 1px solid black; */
            padding: 6px;
            /* background-color: aliceblue; */
            /* border-radius: 3px; */
            margin: 4px 0px;
        }

        .sub_category_item_nested {
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            border-radius: 4px;
            padding: 0px;
        }

        .first_level_category {
            font-weight: 700;
            font-size: 15px;
        }

        .second_level_category {
            font-weight: 500;
            font-size: 14px;
            color: #181818;
        }

        .third_level_category {
            font-weight: 500;
            font-size: 13px;
            color: #373737;
        }

        .last_level_category {
            font-weight: 400;
            font-size: 12px;
            color: #585858;
        }

        .categories {
            padding: 0;
        }

        .ruler {
            margin: 0;
        }

        .username_btn_mobile {
            padding: 2px 12px;
        }

        .accordion {
            --mr-accordion-btn-icon-width: 0.90rem;
        }

        <?php if ($default_language == 1) : ?>.accordion-button::after {
            margin-right: auto;
            margin-left: 0;
        }

        <?php endif; ?>
    }

    #close_btn_offcanvas {
        border: 1px solid #ff6600;
        color: #FF6600 !important;
        background-color: #FFFFFF;
        padding: 7px 13px 5px 13px;
    }
</style>

<!-- New Navbar -->
<?php $theme_color = "#ff6600"; ?>
<div class="dropdown-overlay"></div>
<header class="navbar-light navbar-sticky" style="position: sticky; top: -1px; z-index: 999;">
    <!-- Part 1 Navbar (Logo, Search, Cart and User Details) -->
    <nav class="navbar menu-navbar navbar-expand-lg bg-body-tertiary py-0">
        <div class="d-flex justify-content-between container">
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('assets_web/images/logo.svg') ?>" alt="<?= get_settings('system_name'); ?>" srcset="">
            </a>
            <div class="w-100 d-none d-lg-block mx-5">
                <ul class="navbar-nav justify-content-evenly mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ichapur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true">Sign Up</a>
                    </li>
                </ul>
            </div>
            <div class="d-none d-lg-flex align-items-center">
                <form action="<?php echo base_url ?>search/s" class="d-flex" role="search">
                    <div class="position-relative">
                        <div class="input-group search-input-group">
                            <input type="text" class="form-control" autocomplete="off" id="search" placeholder="Enter text here" aria-label="Search" aria-describedby="button-addon2">
                            <button class="btn" type="button" id="searchButton">
                                <img src="<?= base_url('assets_web/images/icons/magnify-glass.svg') ?>" alt="Icon">
                            </button>
                        </div>

                        <div class="dropdown position-absolute w-100 mt-2" style="left: 0; z-index: 1000;">
                            <ul class="dropdown-menu py-0 w-100" id="searchResults"></ul>
                        </div>
                    </div>

                </form>
                <a href="#" class="ms-3" title="Wishlist">
                    <img src="<?= base_url('assets_web/images/icons/wishlist.svg') ?>" alt="Wishlist" srcset="">
                </a>
                <a href="#" class="ms-3 position-relative" title="Cart">
                    <img src="<?= base_url('assets_web/images/icons/cart.svg') ?>" alt="Cart" srcset="">
                    <span class="icon-count">
                        <div id="badge-cart-count">2</div>
                    </span>
                </a>
                <a href="#" class="ms-3" title="Profile">
                    <img src="<?= base_url('assets_web/images/icons/user.svg') ?>" alt="Profile" srcset="">
                </a>
            </div>
        </div>
    </nav>

    <!-- Part 2 Navbar (Categories) -->
    <nav class="navbar-expand-lg navbar-light bg-light shadow-sm bg-white category-navbar">
        <div class="container position-relative">
            <div class="navbar-collapse w-100 collapse" id="navbarCollapse2">

                <ul class="menu-items mb-0 px-0 w-100 justify-content-around">
                    <?php foreach ($header_cat as $maincat) : ?>
                        <li class="menu-li">
                            <a href="<?= base_url('shop/' . $maincat['cat_slug']) ?>" class="menu-item py-3"><?= $maincat['cat_name'] ?></a>
                            <?php if (count($maincat['subcat_1']) > 0) : ?>
                                <div class="mega-menu">
                                    <div class="content box-shadow-0">
                                        <?php for ($i = 0; $i < 4; $i++) : ?>
                                            <div class="col px-2 py-4">
                                                <section>
                                                    <?php if (!empty($maincat['subcat_1'][($i * 2)])) : ?>
                                                        <a href="<?= base_url($maincat['subcat_1'][($i * 2)]['cat_slug']) ?>" class="item-heading"><?= $maincat['subcat_1'][($i * 2)]['cat_name'] ?></a>
                                                        <?php if (count($maincat['subcat_1'][($i * 2)]['subsubcat_2']) > 0) : ?>
                                                            <ul class="mega-links px-0">
                                                                <?php foreach ($maincat['subcat_1'][($i * 2)]['subsubcat_2'] as $key => $subsubcat_2) : ?>
                                                                    <?php
                                                                    if ($key > 4) :
                                                                        break;
                                                                    endif;
                                                                    ?>
                                                                    <li><a href="<?= base_url($subsubcat_2['cat_slug']) ?>"><?= $subsubcat_2['cat_name'] ?></a></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <a class="view-all" href="<?= base_url('shop/' . $maincat['subcat_1'][($i * 2)]['cat_slug']) ?>" href="">view all <i class="fa-solid fa-arrow-right"></i></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if (!empty($maincat['subcat_1'][($i * 2) + 1])) : ?>
                                                        <div class="mb-3"></div>
                                                        <a href="<?= base_url($maincat['subcat_1'][($i * 2) + 1]['cat_slug']) ?>" class="item-heading"><?= $maincat['subcat_1'][($i * 2) + 1]['cat_name'] ?></a>
                                                        <?php if (count($maincat['subcat_1'][($i * 2) + 1]['subsubcat_2']) > 0) : ?>
                                                            <ul class="mega-links px-0">
                                                                <?php foreach ($maincat['subcat_1'][($i * 2) + 1]['subsubcat_2'] as $key => $subsubcat_2) : ?>
                                                                    <?php
                                                                    if ($key > 2) :
                                                                        break;
                                                                    endif;
                                                                    ?>
                                                                    <li><a href="<?= base_url($subsubcat_2['cat_slug']) ?>"><?= $subsubcat_2['cat_name'] ?></a></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <a class="view-all" href="<?= base_url('shop/' . $maincat['subcat_1'][($i * 2) + 1]['cat_slug']) ?>" href="#">view all <i class="fa-solid fa-arrow-right"></i></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </section>
                                            </div>
                                        <?php endfor; ?>
                                        <div class="col col-image px-2 pb-5">
                                            <div class="row g-2 justify-content-center mt-3">
                                                <div class="col-12">
                                                    <a href="#">
                                                        <img class="nav-img" src="<?= base_url('media/' . $maincat['imgurl']) ?>" class="btn-transition" alt="google-store">
                                                    </a>
                                                </div>
                                                <br>
                                                <div class="col-12">
                                                    <a href="#">
                                                        <img class="nav-img" src="<?= base_url('media/' . $maincat['web_banner']) ?>" class="btn-transition" alt="app-store">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="mega-menu">
                                    <div class="content box-shadow-0">
                                        <?php for ($i = 0; $i < 4; $i++) : ?>
                                            <div class="col px-2 pb-4">
                                            </div>
                                        <?php endfor; ?>
                                        <div class="col col-image px-2 pb-5">
                                            <div class="row g-2 justify-content-center mt-3">
                                                <div class="col-12">
                                                    <a href="#">
                                                        <img class="nav-img" src="<?= base_url('media/' . $maincat['imgurl']) ?>" class="btn-transition" alt="google-store">
                                                    </a>
                                                </div>
                                                <br>
                                                <div class="col-12">
                                                    <a href="#">
                                                        <img class="nav-img" src="<?= base_url('media/' . $maincat['web_banner']) ?>" class="btn-transition" alt="app-store">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>


    <!-- User Transaction Page Search Bar -->
    <!-- Open only on page with route user transaction -->
    <?php if (strpos($_SERVER['REQUEST_URI'], 'user-wallet-transactions') !== false) { ?>
        <div class="mt-1">
            <div class="col-sm-12 col-md-12 date_search_trans">
                <div class="row">
                    <div class="col-md-3 col-6 px-1 mb-2">
                        <input type="text" class="form-control" id="transaction_id" placeholder="<?= $this->lang->line('wallet-search-trans-id'); ?>">
                    </div>
                    <div class="col-md-3 col-6 px-1 mb-2">
                        <select name="trans_type" id="payment_type" class="form-select" aria-placeholder="--select transaction type--">
                            <option selected disabled>-- <?= $this->lang->line('wallet-select-trans-type'); ?> --</option>
                            <option value="0"><?= $this->lang->line('wallet-affiliate-comm'); ?></option>
                            <option value="1"><?= $this->lang->line('wallet-add-money'); ?></option>
                        </select>
                    </div>
                    <div class="col-md-4 col-8 px-1">
                        <div class="flex-sm-row flex-column d-flex">
                            <div class="row w-100 mx-0">
                                <div class="col-sm-12 px-0">
                                    <div class="input-group input-daterange">
                                        <input type="text" class="form-control" id="start_date" placeholder="<?= $this->lang->line('wallet-start-date'); ?>" readonly>
                                        <input type="text" class="form-control" id="end_date" placeholder="<?= $this->lang->line('wallet-end-date'); ?>" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-4 px-1">
                        <button class="btn btn-primary w-100 transaction_search_btn" id="name" name="submit" style="font-size: 1.0939rem;"><?= $this->lang->line('search-text'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


</header>

<!-- New Mobile SIdebar -->
<div class="offcanvas offcanvas-<?php if ($default_language == 1) echo "end";
                                else echo "start"; ?> w-100" tabindex="-1" id="offcanvasMarurang" aria-labelledby="offcanvasExampleLabel" style="overflow: scroll;">
    <div class="offcanvas-header">
        <?php if (!empty($this->session->userdata("user_id"))) { ?>
            <a class="border btn rounded-0 username_btn_mobile">
                <h6 class="fw-bold text-center d-inline-flex align-items-center mb-0 w-100 justify-content-center">
                    <img src="<?= base_url() ?>assets_web/images/svgs/user.svg" style="height: 20px;">
                    <span class="mt-2"><?php echo substr($this->session->userdata("user_name"), 0, 12) ?></span>
                </h6>
            </a>
        <?php } else { ?>
            <a href="<?= base_url('login') ?>" class="btn btn-outline-primary text-uppercase <?= $default_language == 1 ? 'ms-1' : 'me-1' ?>" style="border-radius: 0px;"><?= $this->lang->line('login/signup'); ?></a>
        <?php } ?>
        <button type="button" id="close_btn_offcanvas" class="text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="mobile_view_main_div">
        <div class="container px-1">
            <div class="row">
                <div class="col-12">
                    <!-- Accordian Start -->
                    <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                        <?php $i = 1; /* for ($i = 1; $i <= 1; $i++) { */
                        foreach ($header_cat as $header_cat_mobile_data) {
                        ?>
                            <!-- Item -->
                            <div class="accordion-item">
                                <h6 class="accordion-header font-base" id="heading-">
                                    <button class="<?= count($header_cat_mobile_data['subcat_1']) > 0 ? 'accordion-button' : 'custom-accordion-button' ?> fw-bold rounded collapsed mt-1 px-0 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $i ?>" aria-expanded="false" aria-controls="collapse-<?= $i ?>">
                                        <span class="first_level_category"><?= $header_cat_mobile_data['cat_name'] ?></span>
                                    </button>
                                </h6>
                                <!-- Body -->
                                <?php if (count($header_cat_mobile_data['subcat_1']) > 0) : ?>
                                    <div id="collapse-<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#accordionExample2">
                                        <div class="py-0">
                                            <ul class="<?= $default_language == 1 ? 'pe-3 ps-0' : 'ps-3 pe-0' ?> mb-1">
                                                <!-- Nested Accordian -->
                                                <?php $j = 1;
                                                foreach ($header_cat_mobile_data['subcat_1'] as $subcat_1_data) { ?>
                                                    <li class="sub_category_item px-0">
                                                        <div class="accordion accordion-icon accordion-bg-light" id="accordionExamplesub_subcategory-<?= $j ?>">
                                                            <div class="accordion-item">
                                                                <p class="accordion-header font-base" id="heading-1">
                                                                    <a class="sub_category_item_nested w-100 <?= count($subcat_1_data['subsubcat_2']) > 0 ? 'accordion-button' : '' ?> collapsed" data-bs-toggle="collapse" data-bs-target="#collapse_sub-subcate-<?= $j ?>" aria-expanded="true" aria-controls="collapse_sub-subcate-<?= $j ?>">
                                                                        <span class="second_level_category <?= $default_language == 1 ? 'text-end' : '' ?>" style="margin-right: 10px;"><?= $subcat_1_data['cat_name'] ?></span>
                                                                    </a>
                                                                </p>
                                                                <!-- Body -->
                                                                <?php if (count($subcat_1_data['subsubcat_2']) > 0) : ?>
                                                                    <div id="collapse_sub-subcate-<?= $j ?>" class="accordion-collapse collapse " aria-labelledby="heading-1" data-bs-parent="#accordionExamplesub_subcategory-<?= $j ?>">
                                                                        <div class="py-0">
                                                                            <ul class="<?= $default_language == 1 ? 'pe-3 ps-0' : 'ps-3 pe-0' ?>">
                                                                                <!-- Sub Sub-subcategory 4 layer -->
                                                                                <!-- Double Nested Accordian -->
                                                                                <?php
                                                                                foreach ($subcat_1_data['subsubcat_2'] as $subcat_2_data) { ?>
                                                                                    <li class="sub_category_item">
                                                                                        <a href="<?= base_url($subcat_2_data['cat_slug']) ?>" class="sub_category_item_nested w-100">
                                                                                            <span class="third_level_category" style="margin-right: 10px;">
                                                                                                <?php echo $subcat_2_data['cat_name']; ?>
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php
                                                                                } ?>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php $j++;
                                                } ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <hr class="ruler">
                        <?php $i++;
                        } ?>
                    </div>
                    <!-- Accordian END -->

                    <ul class="category_one categories mb-0">
                        <li class="nav-item mt-5 py-1">
                            <a class="down_link_pages" href="<?php echo base_url ?>order">
                                <img src="<?= base_url() ?>assets_web/images/svgs/order.svg" style="height: 20px;">
                                <?= $this->lang->line('my-orders'); ?>
                            </a>
                        </li>
                        <li style="display:none" class="nav-item py-1">
                            <a class="down_link_pages" href="<?php echo base_url ?>buy-from-turkey-orders">
                                <img src="<?= base_url() ?>assets_web/images/svgs/order.svg" style="height: 20px;">
                                <?= $this->lang->line('user-buy-from-turkey-orders'); ?>
                            </a>
                        </li>
                        <li class="nav-item py-1">
                            <a class="down_link_pages" href="<?php echo base_url ?>my-wallet">
                                <img src="<?= base_url() ?>assets_web/images/svgs/wallet.svg" style="height: 20px;">
                                <?= $this->lang->line('my-wallet'); ?>
                            </a>
                        </li>
                        <li style="display:none" class="nav-item py-1">
                            <a class="down_link_pages" href="<?php echo base_url ?>wholesale-products">
                                <img src="<?= base_url() ?>assets_web/images/svgs/wholesale.svg" style="height: 20px;">
                                <?= $this->lang->line('wholesale'); ?>
                            </a>
                        </li>
                        <li style="display:none" class="nav-item py-1">
                            <a class="down_link_pages" href="<?php echo base_url ?>buy-from-turkey">
                                <img src="<?= base_url() ?>assets_web/images/turkey.svg" style="height: 20px;">
                                <?= $this->lang->line('buy-from-turkey'); ?>
                            </a>
                        </li>
                    </ul>
                    <hr class="mb-0">
                    <ul style="display:none" class="category_two categories mb-0">
                        <li class="nav-item py-1">
                            <div class="accordion" id="languageaccordion">
                                <div class="accordion-item">
                                    <h6 class="accordion-header font-base" id="headingOne">
                                        <button class="accordion-button fw-bold rounded collapsed mt-1 px-0 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLanguage" aria-expanded="false" aria-controls="collapseLanguage">
                                            <span class="down_link_pages"><?= $this->lang->line('change-language'); ?></span>
                                            <?php if ($default_language == 1) { ?>
                                                <span class="fw-bolder" style="position:absolute; left: 20px;">En</span>
                                            <?php } else { ?>
                                                <span class="fw-bolder" style="position:absolute; right: 20px;">أر</span>
                                            <?php } ?>
                                        </button>
                                    </h6>
                                    <div id="collapseLanguage" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#languageaccordion">
                                        <div class="accordion-body p-0">
                                            <ul class="<?= $default_language == 1 ? 'pe-3 ps-0' : 'ps-3 pe-0' ?> mb-1">
                                                <li class="sub_category_item px-0 m-0">
                                                    <img src="<?= base_url('assets_web/images/country/oman-flag.svg') ?>" style="height: 20px;">
                                                    <button type="button" class="btn p-0 m-0 ms-3 down_link_pages" style="border: none;" onclick="get_language_nav('1')">Arabic</button>
                                                </li>
                                                <li class="sub_category_item px-0 m-0">
                                                    <img src="<?= base_url('assets_web/images/country/uk-flag.svg') ?>" style="height: 20px;">
                                                    <button type="button" class="btn p-0 m-0 ms-3 down_link_pages" style="border: none;" onclick="get_language_nav('2')">English</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <hr class="mt-0">
                    <ul class="category_two categories mb-0">
                        <li class="nav-item py-1">
                            <a class="down_link_pages" href="<?php echo base_url ?>become_seller"><?= $this->lang->line('footer-become-a-seller'); ?></a>
                        </li>
                        <li class="nav-item py-1">
                            <a class="down_link_pages" href="<?php echo base_url ?>about"><?= $this->lang->line('footer-about-us'); ?></a>
                        </li>
                        <li class="nav-item py-1">
                            <a class="down_link_pages" href="<?php echo base_url ?>contact"><?= $this->lang->line('footer-contact-us'); ?></a>
                        </li>
                        <li class="nav-item py-1">
                            <a class="down_link_pages" href="<?php echo base_url ?>privacy"><?= $this->lang->line('footer-privacy-policy'); ?></a>
                        </li>
                        <li class="nav-item py-1">
                            <a class="down_link_pages" href="<?php echo base_url ?>tearm"><?= $this->lang->line('terms-and-condition'); ?></a>
                        </li>
                    </ul>
                    <?php if (!empty($this->session->userdata("user_id"))) { ?>
                        <hr class="mt-0">
                        <ul class="category_two categories mb-0">
                            <li class="nav-item py-1">
                                <a href="<?php echo base_url; ?>logout" class="btn btn-primary w-100 text-center pt-2">
                                    <span class="text-center">Logout</span>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Search Modal  -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="searchModalLabel"></h5>
                <button type="button" class="btn-close bg-light rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body w-100 h-100 d-flex align-items-center justify-content-center">
                <div class=" container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-6 mx-auto">
                            <form action="<?php echo base_url ?>search/s" class="d-flex" role="search">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <button class="btn btn-primary" type="submit">
                                                <?= $this->lang->line("search-text") ?>
                                            </button>
                                        </div>
                                    </div>
                                    <input class="form-control me-2" autocomplete="off" id="search" type="search" name="search" value="<?php if (isset($_REQUEST['search'])) {
                                                                                                                                            echo $_REQUEST['search'];
                                                                                                                                        } ?>" type="search" placeholder="Search" aria-label="Search">
                                </div>
                                <!-- <button class="btn btn-primary d-flex text-light d-flex-center" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
<input type="hidden" class="site_url" value="<?php echo site_url(); ?>">
<input type="hidden" name="website_name" value="<?php echo $website_name; ?>" id="website_name">