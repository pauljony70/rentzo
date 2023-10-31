<!-- Author: Jony Paul -->
<!DOCTYPE HTML>
<html>

<head>
    <title><?php echo $Common_Function->get_system_settings($conn, 'system_name'); ?> - Admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="keywords" content="Multi Vendor eCommerce app Admin panel" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="images/favicon_io/favicon.ico"> -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="images/favicon_io/site.webmanifest">

    <!-- <link rel="icon" type="image/png" href="../media/favicon.png"> -->

    <!-- Plugins css -->
    <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/busyload/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/auto-complete/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= BASEURL; ?>assets/css/jquery.multiselect.css" rel="stylesheet" />

    <!-- third party css -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
    <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled />

    <!-- icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />

    <style media="screen">
        .ui-widget-content {
            z-index: 99999;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #f3f3f3;
        }

        .nav-link,
        .pro-user-name {
            color: #38414a !important;
        }

        .zoomable-img {
            transition: all .2s linear;
        }

        .zoomable-img:hover {
            transform: scale(4);
        }

        .table {
            color: #000 !important;
        }

        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 24px;
            background-color: #FF6600;
            color: #fff;
            box-sizing: border-box;
            z-index: 1001;
        }

        .new-logo-box {
            height: 70px;
            width: 100%;
            float: left;
            transition: all .1s ease-out;
        }

        .new-logo-box .logo {
            line-height: 70px;
        }

        @media (max-width: 576px) {
            .support-mail {
                margin-top: 0.25rem;
            }
        }

        #loading-animation {
            position: fixed;
            top: 0px;
            left: 0px;
            background: rgba(0, 0, 0, 0.21);
            color: rgb(255, 255, 255);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            z-index: 9999
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://rawgit.com/someatoms/jsPDF-AutoTable/master/dist/jspdf.plugin.autotable.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>
    <script src="assets/js/vendor.min.js"></script>
    <script src="js/admin/common.js"></script>

</head>

<body data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <div id="loading-animation">
        <div class="busy-load-container-item" style="background: none; display: flex; justify-content: center; align-items: center; flex-direction: row-reverse;">
            <div class="spinner-pump busy-load-spinner-css busy-load-spinner" style="max-height: 50px; max-width: 50px; min-height: 20px; min-width: 20px;">
                <div class="double-bounce1" style="background-color: rgb(255, 255, 255); margin-right: 0.9rem;"></div>
                <div class="double-bounce2" style="background-color: rgb(255, 255, 255); margin-right: 0.9rem;"></div>
            </div>
        </div>
    </div>
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="top-bar">
            <div class="d-flex justify-content-between align-items-center h-100">
                <div class="d-flex align-items-center ml-2 h-100">
                    <i class="fa-regular fa-envelope"></i>
                    <div class="ml-1 h-100 support-mail"><?php echo $Common_Function->get_system_settings($conn, 'system_email'); ?></div>
                </div>
                <div class="d-flex mr-2">
                    ENG
                </div>
            </div>
        </div>
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <li class="dropdown notification-list">
                        <a id="notf_conv" class="nav-link nav-user mr-0 waves-effect" target="_blank" href="<?php echo BASEURL; ?>"> <i class="fa fa-globe"></i> </a>
                    </li>

                    <li class="dropdown notification-list">
                        <a id="notf_conv" href="javascript:void(0);" class="dropdown-togg notificationLink1 nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span id="support_noti_count">0</span>
                        </a>
                        <div id="notificationContainer1" class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <div id="notificationTitle">Chat</div>
                            <div id="notificationsBody" class="notifications">
                                <ul id="conv-notf-show"> </ul>
                            </div>
                            <div id="notificationFooter">

                            </div>
                        </div>
                    </li>


                    <li class="dropdown notification-list">
                        <a id="notf_conv" href="javascript:void(0);" class="dropdown-togg notificationLink nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fa-regular fa-bell"></i>
                            <span id="new_noti_count">0</span>
                        </a>
                        <div id="notificationContainer" class="dropdown-menu dropdown-menu-right profile-dropdown ">

                            <!-- item-->
                            <div id="notificationTitle">Notifications
                                <!-- <a href="javascript:void(0);" onclick="remove_notification();" style="float: right;">Remove All</a> -->
                            </div>
                            <div id="notificationsBody" class="notifications">
                                <ul id="new_noti_html"></ul>
                            </div>
                            <div id="notificationFooter"><a href="#"></a></div>
                        </div>
                    </li>


                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="pro-user-name ml-1">
                                <?= $_SESSION['admin_name']; ?> <i class="fa-solid fa-angle-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="profile.php" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>Profile</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a class="dropdown-item notify-item" href="logout.php"><i class="fe-log-out"></i>
                                Logout
                            </a>

                        </div>
                    </li>

                </ul>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                            <div class="lines">
                                <span>
                                    <div class="logo-box">
                                        <a href="" class="logo logo-light text-center">
                                            <span class="logo-large">
                                                <img src="<?php echo MEDIAURL .json_decode($Common_Function->get_system_settings($conn, 'system_logo'))->{'200-200'}; ?>" class="mb-1" alt="" height="40">
                                            </span>
                                        </a>
                                    </div>
                                </span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>
                    <!-- z -->
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="left-side-menu">
            <div class="h-100" data-simplebar>
                <div class="user-box text-center">
                    <img src="" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
                    <div class="dropdown">
                        <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown">Admin</a>
                        <div class="dropdown-menu user-pro-dropdown">

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user mr-1"></i>
                                <span>My Account</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings mr-1"></i>
                                <span>Settings</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-lock mr-1"></i>
                                <span>Lock Screen</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-log-out mr-1"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </div>
                    <p class="text-muted">Admin Head</p>
                </div>
                <!--left-fixed -navigation-->
                <div id="sidebar-menu">

                    <ul id="side-menu">

                        <li class="menu-title">Navigation</li>

                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'dashboard.php') !== false ? "menuitem-active" : "" ?>">
                            <a href="dashboard.php">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'category.php') !== false || strpos($_SERVER['PHP_SELF'], 'brand.php') !== false || strpos($_SERVER['PHP_SELF'], 'pages.php') !== false || strpos($_SERVER['PHP_SELF'], 'meta.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_custom_page.php') !== false || strpos($_SERVER['PHP_SELF'], 'coupancode.php') !== false || strpos($_SERVER['PHP_SELF'], 'notification.php') !== false ? "menuitem-active" : ''; ?>">
                            <a href="#basic" data-toggle="collapse">
                                <i class="fa fa-gear"></i>
                                <span> Basic </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse <?= strpos($_SERVER['PHP_SELF'], 'edit_custom_page.php') !== false ? 'show' : '' ?>" id="basic">
                                <ul class="nav-second-level">
                                    <?php if ($Common_Function->user_module_premission($_SESSION, $Category)) { ?>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'category.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="category.php"> Category</a>
                                        </li>
                                    <?php  } ?>
                                    <?php if ($Common_Function->user_module_premission($_SESSION, $Brand)) { ?>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'brand.php') !== false ? 'menuitem-active' : '' ?>">
                                            <a href="brand.php"> Brand</a>
                                        </li>
                                    <?php  } ?>
                                    <?php if ($Common_Function->user_module_premission($_SESSION, $CouponCode)) { ?>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'coupancode.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="coupancode.php"> Coupon Code</a>
                                        </li>

                                    <?php  } ?>
                                    <?php if ($Common_Function->user_module_premission($_SESSION, $Pages)) { ?>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'pages.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="pages.php"> <span>Pages</span> </a>
                                        </li>
                                    <?php  } ?>
                                    <?php if ($Common_Function->user_module_premission($_SESSION, $Meta)) { ?>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'meta.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_custom_page.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="meta.php" class="<?= strpos($_SERVER['PHP_SELF'], 'edit_custom_page.php') !== false ? 'active' : '' ?>"> <span>Custom Page</span> </a>
                                        </li>
                                    <?php  } ?>
                                    <?php if ($Common_Function->user_module_premission($_SESSION, $FirebaseNoti)) { ?>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'notification.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="notification.php"> <span><?php echo $FirebaseNoti; ?></span> </a>
                                        </li>

                                    <?php  } ?>

                                </ul>
                            </div>
                        </li>

                        <?php if ($Common_Function->user_module_premission($_SESSION, $ProductAttributes)) { ?>

                            <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_attribute_set.php') !== false || strpos($_SERVER['PHP_SELF'], 'pending_attribute_set.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_tax_class.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_country.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_return_policy.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_conf_attributes.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_conf_attributes_val.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_state.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_city.php') !== false ? "menuitem-active" : "" ?>">
                                <a href="#product-attributes" data-toggle="collapse">
                                    <i class="fa fa-list"></i>
                                    <span> Products Details </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse <?= strpos($_SERVER['PHP_SELF'], 'manage_state.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_city.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_conf_attributes_val.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_product_info_attributes_val.php') !== false || strpos($_SERVER['PHP_SELF'], 'pending_attribute_set.php') !== false ? 'show' : '' ?>" id="product-attributes">
                                    <ul class="nav-second-level">
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_product_info_attributes.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_product_info_attributes_val.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage_product_info_attributes.php">Product Info Attributes</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_attribute_set.php') !== false || strpos($_SERVER['PHP_SELF'], 'pending_attribute_set.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage_attribute_set.php"> Manage Attribute Set</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_conf_attributes.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_conf_attributes_val.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage_conf_attributes.php">Configurations Attributes</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_hsncode.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage_hsncode.php"> Manage HSN Code</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_tax_class.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage_tax_class.php"> Manage TAX Class</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_country.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_state.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_city.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage_country.php"> Manage Country of Manufacture</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_return_policy.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage_return_policy.php"> Manage Return Policy</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        <?php  } ?>

                        <?php if ($Common_Function->user_module_premission($_SESSION, $Product)) { ?>


                            <li class=" <?= strpos($_SERVER['PHP_SELF'], 'add_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'product_review.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_review.php') !== false || strpos($_SERVER['PHP_SELF'], 'pending_products.php') !== false || strpos($_SERVER['PHP_SELF'], 'view_pending_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'add_product_review.php') !== false || strpos($_SERVER['PHP_SELF'], 'add_sponser_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'view_product.php') !== false ? "menuitem-active" : "" ?>">
                                <a href="#products" data-toggle="collapse">
                                    <i class="fa fa-th-large"></i>
                                    <span> Products </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse <?= strpos($_SERVER['PHP_SELF'], 'edit_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'add_product_review.php') !== false || strpos($_SERVER['PHP_SELF'], 'view_pending_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'add_sponser_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'view_product.php') !== false ? 'show' : '' ?>" id="products">
                                    <ul class="nav-second-level">
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'add_product.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="add_product.php"> Add Product</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_sponsor_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'add_sponser_product.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage_sponsor_product.php"> Add Sponsor Product</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'offer-products.php') !== false || strpos($_SERVER['PHP_SELF'], 'offer-products.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="offer-products.php"> Add Offer Product</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'view_product.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage_product.php"> Manage Product</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'pending_products.php') !== false || strpos($_SERVER['PHP_SELF'], 'view_pending_product.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="pending_products.php"> Pending Product</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], '/product_review.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="product_review.php"> Pending Reviews</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_review.php') !== false || strpos($_SERVER['PHP_SELF'], 'add_product_review.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage_review.php"> Manage Reviews</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        <?php  } ?>

                        <?php if ($Common_Function->user_module_premission($_SESSION, $Orders)) { ?>
                            <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_orders.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_order.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_shipped_order.php') !== false ? "menuitem-active" : "" ?>">
                                <a href="manage_orders.php">
                                    <i class="fa fa-cube"></i>
                                    <span> Manage Orders </span>
                                </a>
                            </li>

                        <?php  } ?>

                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'buy-from-turkey-orders.php') !== false ? "menuitem-active" : "" ?>">
                            <a href="buy-from-turkey-orders.php">
                                <i class="fa fa-cube"></i>
                                <span> Buy From Turkey Orders </span>
                            </a>
                        </li>

                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'wallet-transactions') !== false || strpos($_SERVER['PHP_SELF'], 'wallet-withdraw-requests') !== false ? "menuitem-active" : ''; ?>">
                            <a href="#wallet" data-toggle="collapse">
                                <i class="fa fa-gear"></i>
                                <span> Wallet </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="wallet">
                                <ul class="nav-second-level">
                                    <li class="<?= strpos($_SERVER['PHP_SELF'], 'wallet-transactions.php') !== false ? "menuitem-active" : "" ?>">
                                        <a href="wallet-transactions.php">Wallet Transactions</a>
                                    </li>
                                    <li class="<?= strpos($_SERVER['PHP_SELF'], 'wallet-withdraw-requests.php') !== false ? "menuitem-active" : "" ?>">
                                        <a href="wallet-withdraw-requests.php"> Withdrawal Requests</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <?php if ($Common_Function->user_module_premission($_SESSION, $ManageSeller)) { ?>
                            <li class="<?= strpos($_SERVER['PHP_SELF'], '/seller.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_seller_profile.php') !== false || strpos($_SERVER['PHP_SELF'], 'seller_transaction.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_seller_wise_transaction.php') !== false || strpos($_SERVER['PHP_SELF'], 'add_seller.php') !== false || strpos($_SERVER['PHP_SELF'], 'commission.php') !== false ? "menuitem-active" : "" ?>">
                                <a href="#sellers" data-toggle="collapse">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <span>Sellers</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse <?= strpos($_SERVER['PHP_SELF'], 'edit_seller_profile.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_seller_wise_transaction.php') !== false ? 'show' : '' ?>" id="sellers">
                                    <ul class="nav-second-level">
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], '/seller.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_seller_profile.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="seller.php"> All Sellers</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'add_seller.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="add_seller.php"> Add New</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'seller_transaction.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_seller_wise_transaction.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="seller_transaction.php"> Seller Transaction</a>
                                        </li>
                                        <?php if ($Common_Function->user_module_premission($_SESSION, $Commission)) { ?>
                                            <li class="<?= strpos($_SERVER['PHP_SELF'], 'commission.php') !== false ? "menuitem-active" : "" ?>">
                                                <a href="commission.php"> <span><?php echo $Commission; ?></span> </a>
                                            </li>
                                        <?php  } ?>

                                    </ul>
                                </div>
                            </li>
                        <?php  } ?>

                        <li class=" <?= strpos($_SERVER['PHP_SELF'], 'payment.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_order_date_wise_transaction.php') !== false || strpos($_SERVER['PHP_SELF'], 'reports.php') !== false ? "menuitem-active" : "" ?>">
                            <a href="#reports" data-toggle="collapse">
                                <i class="fa-solid fa-file-lines"></i>
                                <span> Reports </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse <?= strpos($_SERVER['PHP_SELF'], 'manage_order_date_wise_transaction.php') !== false ? 'show' : '' ?>" id="reports">
                                <ul class="nav-second-level">
                                    <?php if ($Common_Function->user_module_premission($_SESSION, $payment)) { ?>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'payment.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_order_date_wise_transaction.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="payment.php"> <span>Payment</span> </a>
                                        </li>
                                    <?php  } ?>
                                    <li class="<?= strpos($_SERVER['PHP_SELF'], 'reports.php') !== false ? "menuitem-active" : "" ?>">
                                        <a href="reports.php"> <span>Sale Account</span> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!--<li class="<?php // if (strpos($_SERVER['PHP_SELF'], 'price_calculator.php') !== false) { echo " active "; } 
                                        ?>">
                            <a href="price_calculator.php"> <i class="fa fa-dashboard"></i> <span>Price Calculator</span> </a>
                        </li>-->

                        <?php if ($Common_Function->user_module_premission($_SESSION, $HomepageSettings)) { ?>

                            <!-- <li class=" <?= strpos($_SERVER['PHP_SELF'], 'homepagecategory.php') !== false || strpos($_SERVER['PHP_SELF'], 'homepagebanner.php') !== false || strpos($_SERVER['PHP_SELF'], 'homepagebanner-website.php') !== false ? "menuitem-active" : "" ?>">
                                <a href="#homepage-settigs" data-toggle="collapse">
                                    <i class="fa fa-laptop"></i>
                                    <span> Homepage Settings </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="homepage-settigs">
                                    <ul class="nav-second-level">
                                        <li class="<?php if (strpos($_SERVER['PHP_SELF'], 'popular_product.php') !== false) {
                                                        echo "menuitem-active";
                                                    } ?>"><a href="popular_product.php"> Popular Product</a></li>=
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'homepagecategory.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="homepagecategory.php">HomePage Category</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'homepagebanner.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="homepagebanner.php">HomePage Banner</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'homepagebanner-website.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="homepagebanner-website.php">HomePage Website Banner</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> -->

                            <li class=" <?= strpos($_SERVER['PHP_SELF'], 'homepagebanner-website.php') !== false ? "menuitem-active" : "" ?>">
                                <a href="homepagebanner-website.php">
                                    <i class="fa fa-laptop"></i>
                                    <span> Home Banner </span>
                                </a>
                            </li>

                        <?php  } ?>
                        <li class=" <?= strpos($_SERVER['PHP_SELF'], 'home-notifications.php') !== false ? "menuitem-active" : "" ?>">
                            <a href="home-notifications.php">
                                <i class="fa fa-laptop"></i>
                                <span> Home Notifications </span>
                            </a>
                        </li>
                        <?php
                        /* if ($Common_Function->user_module_premission($_SESSION, $Shipping)) { ?>
                            <li class="<?php if (strpos($_SERVER['PHP_SELF'], 'manage_shipping.php') !== false) {
                                                    echo "menuitem-active";
                                                } ?>">
                                <a href="manage_shipping.php"> <i class="fa fa-dashboard"></i> <span>Manage Shipping</span> </a>
                            </li>
                        <?php  } */
                        ?>

                        <?php if ($Common_Function->user_module_premission($_SESSION, $StoreSettings)) { ?>

                            <li class="<?= strpos($_SERVER['PHP_SELF'], 'currency_settings.php') !== false || strpos($_SERVER['PHP_SELF'], 'script_settings.php') !== false || strpos($_SERVER['PHP_SELF'], 'smtp_settings.php') !== false || strpos($_SERVER['PHP_SELF'], 'language_settings.php') !== false || strpos($_SERVER['PHP_SELF'], 'language_phrase.php') !== false || strpos($_SERVER['PHP_SELF'], 'reject-reason.php') !== false || strpos($_SERVER['PHP_SELF'], 'system_settings.php') !== false || strpos($_SERVER['PHP_SELF'], 'sms_settings.php') !== false || strpos($_SERVER['PHP_SELF'], 'email_template.php') !== false ? "menuitem-active" : "" ?>">
                                <a href="#store-settings" data-toggle="collapse">
                                    <i class="fa fa-wrench"></i>
                                    <span>Store Setting</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse <?= strpos($_SERVER['PHP_SELF'], 'language_phrase.php') !== false || strpos($_SERVER['PHP_SELF'], 'email_template.php') !== false ? 'show' : '' ?>" id="store-settings">
                                    <ul class="nav-second-level">
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'reject-reason.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="reject-reason.php"> Manage Reject Reason</a>
                                        </li>

                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'system_settings.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="system_settings.php"> General Settings</a>
                                        </li>

                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'sms_settings.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="sms_settings.php"> SMS Settings</a>
                                        </li>

                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'language_settings.php') !== false || strpos($_SERVER['PHP_SELF'], 'language_phrase.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="language_settings.php"> Language Settings</a>
                                        </li>

                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'script_settings.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="script_settings.php"> Script Settings</a>
                                        </li> 
										
										<li class="<?= strpos($_SERVER['PHP_SELF'], 'smtp_settings.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="smtp_settings.php"> SMTP Settings</a>
                                        </li>

                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'currency_settings.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="currency_settings.php"> Currency Settings</a>
                                        </li>

                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'email_template.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="email_template.php"> Email Template</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        <?php  } ?>

                        <?php if ($Common_Function->user_module_premission($_SESSION, $AppUser)) { ?>

                            <li class="<?= strpos($_SERVER['PHP_SELF'], 'app-user.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_user_profile.php') !== false ? "menuitem-active" : "" ?>">
                                <a href="#app-user" data-toggle="collapse">
                                    <i class="fa fa-user"></i>
                                    <span> App User </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse <?= strpos($_SERVER['PHP_SELF'], 'edit_user_profile.php') !== false ? 'show' : '' ?>" id="app-user">
                                    <ul class="nav-second-level">
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'app-user.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_user_profile.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="app-user.php"> Manage App User</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php  } ?>

                        <!-- <?php
                                if ($Common_Function->user_module_premission($_SESSION, $DeliveryBoy)) { ?>

                            <li class="<?php if (strpos($_SERVER['PHP_SELF'], 'add-delivery-boy.php') !== false || strpos($_SERVER['PHP_SELF'], 'delivery-boy.php') !== false) {
                                            echo " active ";
                                        } ?>">
                                <a href="#"> <i class="fa fa-dashboard"></i> <span>Delivery Boy</span> <i class="fa fa-angle-left pull-right"></i> </a>
                                <ul class="treeview-menu">
                                    <li class="<?php if (strpos($_SERVER['PHP_SELF'], 'add-delivery-boy.php') !== false) {
                                                    echo " active ";
                                                } ?>"><a href="add-delivery-boy.php"> Add Delivery Boy</a></li>
                                    <li class="<?php if (strpos($_SERVER['PHP_SELF'], 'delivery-boy.php') !== false) {
                                                    echo " active ";
                                                } ?>"><a href="delivery-boy.php"> Manage Delivery Boy</a></li>
                                </ul>
                            </li>
                        <?php }
                        ?> -->

                        <?php if ($Common_Function->user_module_premission($_SESSION, '')) { ?>

                            <li class="<?= strpos($_SERVER['PHP_SELF'], 'add-staff.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage-staff.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_staff_user_data.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit-staff.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage-role.php') !== false ? "menuitem-active" : "" ?>">
                                <a href="#manage-stuff" data-toggle="collapse">
                                    <i class="fa fa-users"></i>
                                    <span> Manage Staff </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse <?= strpos($_SERVER['PHP_SELF'], 'edit_staff_user_data.php') !== false ? 'show' : '' ?>" id="manage-stuff">
                                    <ul class="nav-second-level">
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'add-staff.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="add-staff.php"> Add Staff</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage-staff.php') !== false || strpos($_SERVER['PHP_SELF'], 'edit_staff_user_data.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage-staff.php"> Staff User</a>
                                        </li>
                                        <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage-role.php') !== false ? "menuitem-active" : "" ?>">
                                            <a href="manage-role.php"> Manage Role</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php  } ?>
                        <li>&nbsp;</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="loading" style="display:none;">Loading&#8230;</div>
        <input type="hidden" name="code_ajax" id="code_ajax" value="<?php echo $_SESSION['_token']; ?>">
        <link href="<?php echo BASEURL; ?>assets/css/xdialog.min.css" rel="stylesheet" />
        <script src="<?php echo BASEURL; ?>assets/js/xdialog.min.js"></script>