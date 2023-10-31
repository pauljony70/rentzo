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
            <h4 class="text-dark ms-2 mb-0 fw-bold">Checkout</h4>
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
                                            <span id="selected-item"><?= count($orders) ?></span> / <span id="total-item"><?= count($orders) ?></span> ITEMS SELECTED (<span id="selected-item-price"><?= price_format($total_cart_value) ?></span>)
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
                            <h5>Delivery Addresses</h5>
                            <div class="align-items-start">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <?php
                                    if (!empty($address['address_details'])) {
                                        $address_count = 0;
                                        $last_element = array_pop($address['address_details']);
                                        array_unshift($address['address_details'], $last_element);
                                        foreach ($address['address_details'] as $add_data) {
                                            if ($address_count >= 5) break;
                                            else {
                                                /*if ($address['defaultaddress'] == $add_data['address_id']) { */
                                    ?>
                                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                    <div class="form-check address-details box-shadow-4">
                                                        <input class="form-check-input" type="radio" name="DefaultAddress" id="defaultAdderess" value="<?php echo $add_data['address_id']; ?>">
                                                        <label class="form-check-label">
                                                            <span class="badge"><?php echo $add_data['addresstype']; ?></span><br>
                                                            <ul class="name m-0 mb-1">
                                                                <li class="pe-2">
                                                                    <h6><?php echo $add_data['fullname']; ?>, </h6>
                                                                </li>
                                                                <li class="pe-2">
                                                                    <h6><?= $add_data['email'] ?>, </h6>
                                                                </li>
                                                                <li class="pe-2">
                                                                    <h6><?php echo $add_data['mobile']; ?></h6>
                                                                </li>
                                                            </ul>
                                                            <div class="address m-0">
                                                                <h6 class="m-0"><?php echo $add_data['fulladdress'] ?></h6>
                                                                <h6 class="m-0"><?= $add_data['state_name'] . ', ' . $add_data['city'] . ', ' . $add_data['pincode']; ?></h6>
                                                            </div>
                                                            <a href="javascript:void(0);" class="btn btn-default d-none">Deliver here</a>
                                                        </label>
                                                    </div>
                                                </button>
                                    <?php
                                            }
                                            $address_count++;
                                        }
                                    }  ?>
                                    <a href="" class="btn btn-light my-4" id="address_div_id">Add new shipping address</a>
                                </div>
                            </div>


                            <div class="container px-0" id="address_div" style="max-width:1344px;display:none">
                                <div class="row">
                                    <div class="col-lg-12 px-0">
                                        <div class="left-block">
                                            <h5>Add New Address</h5>
                                            <form id="formoid" action="" class="form row g-3" method="post">
                                                <div class="col-md-6">
                                                    <label class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="fullname_a" name="name" placeholder="Full Name" />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" maxlength="30" name="email" placeholder="Email" />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Phone no</label>
                                                    <input type="text" class="form-control" id="mobile" maxlength="10" onkeypress="return AllowOnlyNumbers(event);" name="mobile" placeholder="Phone no" />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Area</label>
                                                    <input type="text" class="form-control" id="area" name="area" placeholder="Area" />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="fulladdress" name="address" placeholder="Address 1" />
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Country</label>
                                                    <select class="form-control" id="country" name="country">
                                                        <option value="">Select Country</option>
                                                    </select>
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Region</label>
                                                    <select name="region" id="region" class="form-control">
                                                        <option value="">Select Region</option>
                                                    </select>
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">City</label>
                                                    <select name="city" id="city" class="form-control">
                                                        <option value="">Select City</option>
                                                    </select>
                                                    <span id="error"></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Governorates</label>
                                                    <select name="governorates" id="governorates" class="form-control">
                                                        <option value="">Select Governorates</option>
                                                    </select>
                                                    <span id="error"></span>
                                                </div>
                                                <input type="hidden" value="<?php echo $this->session->userdata('user_id'); ?>" type="user_id" id="user_id" name="user_id">
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
                                <h5 class="mb-3">Order Summary</h5>
                                <hr>
                                <ul class="price d-flex justify-content-between ps-0 my-4 mt-6">
                                    <li>
                                        <h6>Total MRP:</h6>
                                    </li>
                                    <li>
                                        <h6><span id="payable_prod_price"><?= price_format($prod_price) ?></span></h6>
                                    </li>
                                </ul>
                                <ul class="price d-flex justify-content-between ps-0 my-4 mt-6">
                                    <li>
                                        <h6>Platform Fee:</h6>
                                    </li>
                                    <li>
                                        <h6><span id="payable_platform_fee"><?= price_format($admin_profit) ?></span></h6>
                                    </li>
                                </ul>
                                <ul class="price d-flex justify-content-between ps-0 my-4 mt-6">
                                    <li>
                                        <h6>VAT:</h6>
                                    </li>
                                    <li>
                                        <h6><span id="payable_vat"><?= price_format($igst) ?></span></h6>
                                    </li>
                                </ul>
                                <ul class="price d-flex justify-content-between ps-0 my-4 mt-6">
                                    <li>
                                        <h6>Vouchers:</h6>
                                    </li>
                                    <li>
                                        <h6><span id="voucher_discount"></span></h6>
                                    </li>
                                </ul>
                                <form class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Use <b>232 OMR</b> from your eligible gift voucher
                                        </label>
                                    </div>
                                </form>
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Discount Code" />
                                        <span onclick="get_checkout_data()" class="input-group-text btn btn-default">Apply</span>
                                    </div>
                                    <span id="coupon_message" style="color:#438F29;font-weight:600"></span>
                                </form>
                            </div>
                            <ul class="total d-flex justify-content-between ps-0 my-5">
                                <li>
                                    <h5>Total Amount</h5>
                                </li>
                                <li>
                                    <h5><span id="total_val"><?= price_format($total_cart_value) ?></span></h5>
                                </li>
                            </ul>
                            <button id="online_place_order_btn" class="btn btn-block btn-default fw-bolder text-uppercase">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End: Check-Out Page -->

    </main>

    <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>

    <script src="<?= base_url('assets_web/js/app/buy-from-turkey-checkout.js') ?>"></script>
</body>

</html>