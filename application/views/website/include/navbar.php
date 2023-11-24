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
        right: -7px;
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

    @media (max-width: 768px) {
        .icon-count {
            font-size: 8px;
            line-height: 12px;
            height: 12px;
            width: 12px;
            top: 0px;
            right: -5px;
        }
    }

    @media (max-width: 425px) {
        .icon-count {
            font-size: 8px;
            line-height: 12px;
            height: 12px;
            width: 12px;
            top: 0px;
            right: -5px;
        }
    }
</style>

<!-- New Navbar -->
<div class="dropdown-overlay"></div>
<header class="navbar-light navbar-sticky" style="position: sticky; top: -1px; z-index: 999;">
    <!-- Part 1 Navbar (Logo, Search, Cart and User Details) -->
    <nav class="navbar menu-navbar navbar-expand-lg bg-body-tertiary py-0">
        <div class="d-flex justify-content-lg-between justify-content-center container">
            <a class="navbar-brand" href="<?= base_url('home') ?>">
                <img src="<?= base_url('assets_web/images/logo.svg') ?>" alt="<?= get_settings('system_name'); ?>" srcset="">
            </a>
            <div class="w-100 d-none d-lg-block mx-xl-5 mx-4">
                <ul class="navbar-nav justify-content-evenly mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#pincodeModal"><span id="address_data"><?= $this->session->userdata("address") != '' ? $this->session->userdata("address") : 'Location' ?></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('sign-up') ?>" class="nav-link" aria-disabled="true">Sign Up</a>
                    </li>
                </ul>
            </div>
            <div class="d-none d-lg-flex align-items-center">
                <form action="<?= base_url('search/s') ?>" class="d-flex" role="search">
                    <div class="position-relative">
                        <div class="input-group search-input-group">
                            <input type="text" class="form-control" autocomplete="off" id="search" name="search" value="<?= isset($_REQUEST['search']) ? $_REQUEST['search'] : '' ?>" placeholder="What are you looking for?" aria-label="Search" aria-describedby="button-addon2">
                            <button class="btn" type="submit" id="searchButton">
                                <img src="<?= base_url('assets_web/images/icons/magnify-glass.svg') ?>" alt="Icon">
                            </button>
                        </div>

                        <div class="dropdown position-absolute w-100 mt-2" style="left: 0; z-index: 1000;">
                            <ul class="dropdown-menu searchResults py-0 w-100" id="searchResults"></ul>
                        </div>
                    </div>

                </form>
                <a href="<?= base_url('wishlist') ?>" class="ms-3" title="Wishlist">
                    <img src="<?= base_url('assets_web/images/icons/wishlist.svg') ?>" alt="Wishlist" srcset="">
                </a>
                <a href="<?= base_url('cart') ?>" class="ms-3 position-relative" title="Cart">
                    <img src="<?= base_url('assets_web/images/icons/cart.svg') ?>" alt="Cart" srcset="">
                    <span class="icon-count">
                        <div id="badge-cart-count">0</div>
                    </span>
                </a>
                <?php if ($this->session->userdata('user_id') == '') : ?>
                    <a href="<?= base_url('login') ?>" class="ms-3" title="Profile">
                        <img src="<?= base_url('assets_web/images/icons/user.svg') ?>" alt="Profile" srcset="">
                    </a>
                <?php else : ?>
                    <a href="<?= base_url('personal_info') ?>" class="ms-3" title="<?= $this->session->userdata('user_name') ?>">
                        <img src="<?= base_url('assets_web/images/icons/user.svg') ?>" alt="Profile" srcset="">
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <nav class="navbar menu-navbar shadow-sm d-flex d-lg-none bg-white">
        <div class="container mobile-nav">
            <div class="mobile-nav-flex d-flex align-items-center justify-content-between w-100">
                <button type="button" class="hamburger-icon btn px-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                    <img src="<?= base_url('assets_web/images/icons/hamburger.svg') ?>" alt="">
                </button>
                <form action="<?= base_url('search/s') ?>" class="d-flex" role="search">
                    <div class="position-relative">
                        <div class="input-group search-input-group">
                            <input type="text" class="form-control" autocomplete="off" id="search" name="search" value="<?= isset($_REQUEST['search']) ? $_REQUEST['search'] : '' ?>" placeholder="What are you looking for?" aria-label="Search" aria-describedby="button-addon2">
                            <button class="btn ps-0" type="submit" id="searchButton">
                                <img src="<?= base_url('assets_web/images/icons/magnify-glass.svg') ?>" alt="Icon">
                            </button>
                        </div>
                    </div>
                </form>
                <div class="dropdown position-absolute w-100 mt-2" style="left: 0; z-index: 1000; top: 43px;">
                    <ul class="dropdown-menu container searchResults py-0 w-100" id="searchResults"></ul>
                </div>
                <div class="nav-icons-div d-flex align-items-center">
                    <a href="<?= base_url('wishlist') ?>" class="" title="Wishlist">
                        <img src="<?= base_url('assets_web/images/icons/wishlist.svg') ?>" alt="Wishlist" srcset="">
                    </a>
                    <a href="<?= base_url('cart') ?>" class="position-relative" title="Cart">
                        <img src="<?= base_url('assets_web/images/icons/cart.svg') ?>" alt="Cart" srcset="">
                        <span class="icon-count">
                            <div id="badge-cart-count">0</div>
                        </span>
                    </a>
                    <?php if ($this->session->userdata('user_id') == '') : ?>
                        <a href="<?= base_url('login') ?>" class="" title="Profile">
                            <img src="<?= base_url('assets_web/images/icons/user.svg') ?>" alt="Profile" srcset="">
                        </a>
                    <?php else : ?>
                        <a href="<?= base_url('personal_info') ?>" class="" title="<?= $this->session->userdata('user_name') ?>">
                            <img src="<?= base_url('assets_web/images/icons/user.svg') ?>" alt="Profile" srcset="">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Part 2 Navbar (Categories) -->
    <nav class="navbar-expand-lg navbar-light bg-light shadow-sm bg-white category-navbar">
        <div class="container position-relative">
            <div class="navbar-collapse w-100 collapse" id="navbarCollapse2">

                <ul class="menu-items mb-0 px-0 w-100 justify-content-around">
                    <?php
                    $maincats = array_slice($header_cat, 0, 7);
                    foreach ($maincats as $maincat) : ?>
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
                                            <div class="row g-2 justify-content-center mt-3 h-100">
                                                <div class="col-12 h-100 text-center">
                                                    <a href="#">
                                                        <img class="nav-img h-100 w-100" src="<?= base_url('media/' . $maincat['imgurl']) ?>" class="btn-transition" alt="google-store">
                                                    </a>
                                                </div>
                                                <br>
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
                                            <div class="row g-2 justify-content-center mt-3 h-100">
                                                <div class="col-12 h-100 text-center">
                                                    <a href="#">
                                                        <img class="nav-img h-100 w-100" src="<?= base_url('media/' . $maincat['imgurl']) ?>" class="btn-transition" alt="google-store">
                                                    </a>
                                                </div>
                                                <br>
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

</header>

<!-- New Mobile Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header align-items-center">
        <div class="user-location">
            <div class="container d-flex align-items-center">
                <img src="<?= base_url('assets_web/images/icons/location-pin.svg') ?>" alt="Location">
                <div class="location" data-bs-toggle="modal" data-bs-target="#pincodeModal" id="address_data2"><?= $this->session->userdata("address") != '' ? $this->session->userdata("address") : 'Location' ?></div>
            </div>
        </div>
        <button type="button" class="close-btn-offcanvas text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php foreach ($maincats as $header_cat_mobile_data) : ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="<?= count($header_cat_mobile_data['subcat_1']) > 0 ? '' : 'no-arrow' ?> accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $header_cat_mobile_data['cat_slug'] ?>" aria-expanded="false" aria-controls="<?= $header_cat_mobile_data['cat_slug'] ?>">
                            <?= $header_cat_mobile_data['cat_name'] ?>
                        </button>
                    </h2>
                    <?php if (count($header_cat_mobile_data['subcat_1']) > 0) : ?>
                        <div id="<?= $header_cat_mobile_data['cat_slug'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body py-0">
                                <?php foreach ($header_cat_mobile_data['subcat_1'] as $subcat_1_data) : ?>
                                    <div class="accordion accordion-flush" id="<?= $header_cat_mobile_data['cat_slug'] ?>Example">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="<?= count($subcat_1_data['subsubcat_2']) > 0 ? '' : 'no-arrow' ?> accordion-button pe-0 collapsed fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $subcat_1_data['cat_slug'] ?>" aria-expanded="false" aria-controls="<?= $subcat_1_data['cat_slug'] ?>">
                                                    <?= $subcat_1_data['cat_name'] ?>
                                                </button>
                                            </h2>
                                            <?php if (count($subcat_1_data['subsubcat_2']) > 0) : ?>
                                                <div id="<?= $subcat_1_data['cat_slug'] ?>" class="accordion-collapse collapse" data-bs-parent="#<?= $subcat_1_data['cat_slug'] ?>Example">
                                                    <div class="accordion-body py-0">
                                                        <?php foreach ($subcat_1_data['subsubcat_2'] as $subcat_2_data) : ?>
                                                            <div class="accordion accordion-flush" id="<?= $subcat_1_data['cat_slug'] ?>Example">
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header">
                                                                        <button class="no-arrow accordion-button pe-0 collapsed fw-light" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $subcat_2_data['cat_slug'] ?>" aria-expanded="false" aria-controls="<?= $subcat_2_data['cat_slug'] ?>">
                                                                            <?= $subcat_2_data['cat_name'] ?>
                                                                        </button>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <hr class="m-0">
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!--
    --------------------------------------------------- 
    Pincode modal 
    ---------------------------------------------------
-->
<div class="modal fade" id="pincodeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="pincodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="modal-heading mb-4">Please enter your pincode</div>
                <div class="d-flex justify-content-center">
                    <input name="address_pincode" id="address_pincode" type="text" class="form-control text-center pincode-input mb-1" maxlength="6" onkeypress="return AllowOnlyNumbers(event);">
                </div>
                <div id="pincode_error" class="mb-2" style="font-size:14px;color:red;"></div>
                <div class="description mb-4">Please enter your current Pincode to better serve you<br> with our services</div>
                <button type="submit" onclick="get_address(this)" class="btn">Continue</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
<input type="hidden" class="site_url" value="<?php echo site_url(); ?>">
<input type="hidden" name="website_name" value="<?php echo $website_name; ?>" id="website_name">