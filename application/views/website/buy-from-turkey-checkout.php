<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "CheckOut";
    include("include/headTag.php") ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/buy-from-turkey-checkout.css') ?>">
    <style>
        .checkout-page .left-block .nav-pills .nav-link.active .form-check-input {
            background-image: none;
        }

        .form-check-input:active,
        .form-check-input:checked {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23FF6600'/%3e%3c/svg%3e");
        }

        .form-check-input[type=checkbox]:indeterminate {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e");
        }

        #map {
            height: 300px;
            width: 100%;
        }

        #map-container {
            position: relative;
        }

        #search-container {
            position: absolute;
            top: 10px;
            left: 20px;
            background-color: #fff;
            border-radius: 3px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 2.5px;
            z-index: 2;
            width: 79%;
        }

        #search_address {
            width: 100%;
            padding: 0.5em 1em;
            border: none;
        }

        .custom-control {
            position: absolute;
            bottom: 25px;
            right: 60px;
            background-color: white;
            border-radius: 3px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            padding: 8px 14px;
        }

        .intl-tel-input,
        .iti--separate-dial-code {
            width: 100%;
        }

        .iti__country-list {
            /* width: 26.1rem; */
            border-radius: 3px;
        }

        .iti-mobile .iti--container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <?php if ($default_language === '1') : ?>
        <style>
            .hover-card {
                left: -33px !important;
                right: auto;
            }

            .arrow {
                right: auto;
                left: 15px !important;
            }

            .hover-card table tr td:nth-child(1) {
                text-align: right !important;
            }

            .hover-card table tr td:nth-child(2) {
                text-align: left !important;
            }

            .text-start.text-sm-end {
                text-align: right !important;
            }

            @media (min-width: 576px) {
                .text-start.text-sm-end {
                    text-align: left !important;
                }
            }
        </style>
    <?php endif; ?>
    <link href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/css/intlTelInput.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets_web/style/css/checkout.css') ?>" />
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= $this->config->item('api_keys')['gmap-api-key']; ?>&libraries=places"></script>
</head>

<body class="checkout-body">

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

    if (count($orders) <= 0) {
        redirect(base_url('buy-from-turkey'));
    }

    ?>
    <main class="checkout-page mt-0">
        <div class="d-flex align-items-center h-100 responsive_nav d-block d-sm-none">
            <svg class="fa-angle-left ms-3" onclick="history.back(-1)" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.5 19.5 8 12l7.5-7.5" stroke="#303030" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <h4 class="text-dark ms-2 mb-0 fw-bold"><?= $this->lang->line('checkout'); ?></h4>
        </div>
        <section class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 px-0 px-md-3">
                        <div class="left-block box-shadow-4 mb-3">
                            <div class="card">
                                <div class="card-header ps-5">
                                    <div class="form-check px-0 py-3">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                        <label class="form-check-label ps-2" for="flexCheckChecked">
                                            <span id="selected-item"><?= count($orders) ?></span> / <span id="total-item"><?= count($orders) ?></span> <?= $this->lang->line('items-selected'); ?> (<span id="selected-item-price"><?= price_format($total_cart_value) ?></span>)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="p-5">
                                <?php foreach ($orders as $key => $order) : ?>
                                    <div class="row">
                                        <div class="col-3 col-md-2 px-0 mb-2">
                                            <div class="checkbox">
                                                <label class="checkbox-wrapper">
                                                    <input type="checkbox" class="checkbox-input" checked />
                                                    <span class="checkbox-tile">
                                                        <span class="checkbox-icon">
                                                            <img src="<?= base_url('media/' . $order['prod_img']) ?>" alt="<?= $order['prod_name'] ?>" class="product-image">
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-9 col-md-10 mb-2">
                                            <div class="row justify-content-between">
                                                <div class="col-sm-8">
                                                    <div class="fw-bolder prod-name fs-5"><?= $order['prod_name'] ?></div>
                                                    <div class="order-id"><span class="text-muted">ID: </span><span id="order-id"><?= $order['order_id'] ?></span></div>
                                                    <div class="order-date"><span class="text-muted">Order date: </span><?= date('M d, Y', strtotime($order['create_date'])) ?></div>
                                                    <div class="prod-details"><?= $order['product_color'] ?> | <?= $order['product_size'] ?></div>
                                                    <div class="screenshot-containter">
                                                        <img src="<?= base_url('media/' . $order['product_img_1']) ?>" alt="">
                                                        <img src="<?= base_url('media/' . $order['product_img_2']) ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 mt-3 mt-sm-0">
                                                    <div class="fw-bolder position-relative fs-5">
                                                        <div class="text-start text-sm-end">
                                                            <?= price_format(floatval($order['prod_price']) + floatval($order['shipping']) + floatval($order['admin_profit']) + floatval($order['igst'])) ?>
                                                            <a class="toggle-btn">
                                                                <span class="info-icon">
                                                                    <div class="d-flex align-items-center position-relative" id="share-btn">
                                                                        <i class="fa fa-info position-absolute" aria-hidden="true"></i>
                                                                    </div>
                                                                    <span class="hover-card box-shadow-4">
                                                                        <table class="w-100">
                                                                            <tr>
                                                                                <td class="text-start"><b>Product MRP</b></td>
                                                                                <td class="text-end" id="prod_price"><?= price_format(floatval($order['prod_price'])) ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-start"><b>Shipping</b></td>
                                                                                <td class="text-end" id="shipping"><?= price_format(floatval($order['shipping'])) ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-start"><b>Platform Fee</b></td>
                                                                                <td class="text-end" id="admin-profit"><?= price_format(floatval($order['admin_profit'])) ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-start"><b>VAT</b></td>
                                                                                <td class="text-end" id="igst"><?= price_format(floatval($order['igst'])) ?></td>
                                                                            </tr>
                                                                        </table>
                                                                        <span class="arrow"></span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="text-muted text-start text-sm-end">Qty: <?= $order['qty'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?= count($orders) - 1 !== $key ? '<hr>' : '' ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="left-block p-5 box-shadow-4 mb-3 mb-lg-0">
                            <h5><?= $this->lang->line('delivery-addresses'); ?></h5>
                            <div class="row">
                                <?php
                                if (!empty($address['address_details'])) {
                                    $last_element = array_pop($address['address_details']);
                                    array_unshift($address['address_details'], $last_element);
                                    foreach ($address['address_details'] as $key => $add_data) {
                                ?>
                                        <label for="radio-card-<?= $key ?>" class="radio-card">
                                            <input type="radio" class="defaultAdderess" name="radio-card" id="radio-card-<?= $key ?>" value="<?= $add_data['address_id']; ?>" />
                                            <div class="card-content-wrapper">
                                                <span class="check-icon"></span>
                                                <div class="card-content <?= $default_language == 1 ? 'pe-3' : 'ps-3' ?>">
                                                    <span class="badge mb-2"><?= $add_data['addresstype']; ?></span>
                                                    <div class="name m-0 mb-1">
                                                        <h6 class="mb-0"><?= $add_data['fullname']; ?>, </h6>
                                                    </div>
                                                    <div class="address m-0">
                                                        <h6 class="mb-0"><?= $add_data['email'] ?>, +<?= $add_data['country_code'] . ' ' . $add_data['mobile'] ?></h6>
                                                        <h6 class="m-0"><?= $add_data['fulladdress'] ?></h6>
                                                        <h6 class="m-0"><?= $add_data['area'] . ', ' . $add_data['governorate'] . ', ' . $add_data['region'] . ', ' . $add_data['country'] ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                <?php
                                    }
                                }  ?>
                                <a href="" class="btn btn-light my-4" id="address_div_id"><?= $this->lang->line('add-new-add'); ?></a>
                            </div>


                            <div class="container px-0" id="address_div" style="max-width:1344px;display:none">
                                <div class="row">
                                    <div class="col-lg-12 px-0">
                                        <div class="left-block">
                                            <h5><?= $this->lang->line('add-new-add'); ?></h5>
                                            <form id="formoid" action="" class="form row g-3" method="post">
                                                <div class="form-group">
                                                    <div class="col-12">
                                                        <div id="map-container">
                                                            <div id="map"></div>
                                                            <div id="current-location-control" class="custom-control"></div>
                                                            <div id="search-container">
                                                                <input type="text" class="" id="search_address" placeholder="Search Address" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Latitude Input -->
                                                <input type="hidden" value="23.607506019227948" id="lat" name="lat">
                                                <!-- Longitude Input -->
                                                <input type="hidden" value="58.51290997249288" id="lng" name="lng">
                                                <div class="col-md-12">
                                                    <label class="form-label"><?= $this->lang->line('fullname'); ?></label>
                                                    <input type="text" class="form-control" id="fullname_a" name="name" />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label"><?= $this->lang->line('email'); ?></label>
                                                    <input type="email" class="form-control" id="email" maxlength="30" name="email" />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label"><?= $this->lang->line('phone-number'); ?></label>
                                                    <input type="text" class="form-control intl-tel-input" id="mobile" maxlength="10" onkeypress="return AllowOnlyNumbers(event);" name="mobile" />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label"><?= $this->lang->line('address'); ?></label>
                                                    <input type="text" class="form-control" id="fulladdress" name="address" />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label"><?= $this->lang->line('country'); ?></label>
                                                    <select class="form-select" id="country" name="country" disabled>
                                                        <option value=""><?= $this->lang->line('select_country'); ?></option>
                                                        <?php foreach ($get_country['data'] as $country) : ?>
                                                            <option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6" id="region-div">
                                                    <label class="form-label"><?= $this->lang->line('region'); ?></label>
                                                    <input type="text" class="form-control" id="region" name="region" disabled />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6" id="governorates-div">
                                                    <label class="form-label"><?= $this->lang->line('governorate'); ?></label>
                                                    <input type="text" class="form-control" id="governorates" name="governorates" disabled />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6" id="area-div">
                                                    <label class="form-label"><?= $this->lang->line('area'); ?></label>
                                                    <input type="text" class="form-control" id="area" name="area" disabled />
                                                    <span id="error"></span>
                                                </div>
                                                <input type="hidden" value="<?= $this->session->userdata('user_id'); ?>" type="user_id" id="user_id" name="user_id">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 px-0 px-md-3">
                        <div class="right-block p-5 box-shadow-4">
                            <div class="price-details">
                                <h5 class="mb-3"><?= $this->lang->line('order-summary'); ?></h5>
                                <hr>
                                <ul class="price d-flex justify-content-between ps-0 my-4 mt-6">
                                    <li>
                                        <h6><?= $this->lang->line('total-mrp'); ?>:</h6>
                                    </li>
                                    <li>
                                        <h6><span id="payable_prod_price"><?= price_format($prod_price) ?></span></h6>
                                    </li>
                                </ul>
                                <ul class="price d-flex justify-content-between ps-0 my-4 mt-6">
                                    <li>
                                        <h6><?= $this->lang->line('platform-fee'); ?>:</h6>
                                    </li>
                                    <li>
                                        <h6><span id="payable_platform_fee"><?= price_format($admin_profit) ?></span></h6>
                                    </li>
                                </ul>
                                <ul class="price d-flex justify-content-between ps-0 my-4 mt-6">
                                    <li>
                                        <h6><?= $this->lang->line('shipping-charges'); ?>:</h6>
                                    </li>
                                    <li>
                                        <h6><span id="payable_shipping"><?= price_format($shipping) ?></span></h6>
                                    </li>
                                </ul>
                                <ul class="price d-flex justify-content-between ps-0 my-4 mt-6">
                                    <li>
                                        <h6><?= $this->lang->line('vat'); ?>:</h6>
                                    </li>
                                    <li>
                                        <h6><span id="payable_vat"><?= price_format($igst) ?></span></h6>
                                    </li>
                                </ul>
                                <ul class="price d-flex justify-content-between ps-0 my-4 mt-6">
                                    <li>
                                        <h6><?= $this->lang->line('vouchers'); ?>:</h6>
                                    </li>
                                    <li>
                                        <h6><span id="voucher_discount"></span></h6>
                                    </li>
                                </ul>
                                <form class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?= $this->lang->line('use'); ?> <b>232 OMR</b> <?= $this->lang->line('use_desc'); ?>
                                        </label>
                                    </div>
                                </form>
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="<?= $this->lang->line('discount'); ?>" />
                                        <span onclick="get_checkout_data()" class="input-group-text btn btn-default"><?= $this->lang->line('apply'); ?></span>
                                    </div>
                                    <span id="coupon_message" style="color:#438F29;font-weight:600"></span>
                                </form>
                            </div>
                            <ul class="total d-flex justify-content-between ps-0 my-5">
                                <li>
                                    <h5><?= $this->lang->line('total-amount'); ?></h5>
                                </li>
                                <li>
                                    <h5><span id="total_val"><?= price_format($total_cart_value) ?></span></h5>
                                </li>
                            </ul>
                            <button id="online_place_order_btn" class="btn btn-block btn-default fw-bolder text-uppercase"><?= $this->lang->line('place-order') ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End: Check-Out Page -->

    </main>

    <?php include("include/footer.php") ?>
    <?php include("include/script.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/intlTelInput.min.js"></script>
    <script src="<?= base_url('assets_web/js/app/gmap.js') ?>"></script>
    <script src="<?= base_url('assets_web/js/app/buy-from-turkey-checkout.js') ?>"></script>
    <script>
        $(document).on('change', '.defaultAdderess', function() {
            var address_id = $('.defaultAdderess:checked').val();
            var user_id = $('#user_id').val();
            var total_value = $("#total_value").val();
            var seller_pincode = $('#seller_pincode').val();
            var user_pincode = '';
            $.ajax({
                method: "post",
                url: site_url + "getUserAddress",
                data: {
                    language: default_language,
                    user_id: user_id,
                    [csrfName]: csrfHash
                },
                success: function(response) {
                    var parsedJSON = response.Information.address_details;

                    $(parsedJSON).each(function() {
                        if (address_id == this.address_id) {
                            console.log(this);
                            $('#lat').val(this.lat);
                            $('#lng').val(this.lng);
                            initMap();
                            $("#fullname_a").val(this.fullname);
                            $("#email").val(this.email);
                            iti.setNumber(`+${this.country_code}${this.mobile}`)
                            $("#fulladdress").val(this.fulladdress);
                            $("#country").val($("#country option:contains('" + this.country + "')").val());
                            if (this.country_id == 1) {
                                $('#region-div').html(
                                    `<label class="form-label"><?= $this->lang->line('region'); ?></label>
									<select name="region" id="region" class="form-select">
										<option value=""><?= $this->lang->line('select_region'); ?></option>
									</select>
									<span id="error"></span>`);
                                $('#governorates-div').html(
                                    `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
									<select name="governorates" id="governorates" class="form-select">
									<option value=""><?= $this->lang->line('select_governorate'); ?></option>
									</select>
									<span id="error"></span>`);
                                $('#area-div').html(
                                    `<label class="form-label"><?= $this->lang->line('area'); ?></label>
									<select name="area" id="area" class="form-select">
										<option value=""><?= $this->lang->line('select_area'); ?></option>
									</select>
									<span id="error"></span>`);
                                getRegiondata($("#country").val());
                                setTimeout(() => {
                                    $("#region").val($("#region option:contains('" + this.region + "')").val());
                                    getGovernoratedata($("#region").val());
                                    setTimeout(() => {
                                        $("#governorates").val($("#governorates option:contains('" + this.governorate + "')").val());
                                        getAreadata($("#governorates").val());
                                        setTimeout(() => {
                                            $("#area").val($("#area option:contains('" + this.area + "')").val());
                                        }, 400);
                                    }, 400);
                                }, 400);
                            } else {
                                $('#region-div').html(
                                    `<label class="form-label"><?= $this->lang->line('region'); ?></label>
									<input type="text" class="form-control" id="region" name="region" value="${this.region}" />
									<span id="error"></span>`);
                                $('#governorates-div').html(
                                    `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
									<input type="text" class="form-control" id="governorates" name="governorates" value="${this.governorate}" />
									<span id="error"></span>`);
                                $('#area-div').html(
                                    `<label class="form-label"><?= $this->lang->line('area'); ?></label>
									<input type="text" class="form-control" id="area" name="area" value="${this.area}" />
									<span id="error"></span>`);
                            }

                            user_pincode = '743144';
                        }
                    });
                    get_checkout_data(user_pincode);
                }
            });
        });
    </script>
</body>

</html>