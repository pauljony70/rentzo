<?php

header('Cache-Control: no cache');

?>
<!-- Author: Jony Paul -->

<!DOCTYPE HTML>
<html>

<head>
  <title><?php echo $Common_Function->get_system_settings($conn, 'system_name'); ?> - Vendor panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

  <style media="screen">
    .ui-widget-content {
      z-index: 99999;
    }

    .form-control:disabled,
    .form-control[readonly] {
      background-color: #f3f3f3;
    }

    .notificationLink,
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

  <!-- font-awesome icons CSS -->
  <!-- <link href="<?php echo BASEURL; ?>assets/css/font-awesome.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- //font-awesome icons CSS-->

  <!-- <link href="<?php echo BASEURL; ?>assets/css/custom.css" rel="stylesheet"> -->

  <!--webfonts-->
  <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
  <!--//webfonts-->

  <!-- old css & js -->
  <!-- <script type="application/x-javascript">
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script> -->
  <!-- <script src="<?php echo BASEURL; ?>assets/js/jquery-1.11.1.min.js"></script> -->
  <!-- <script src="<?php echo BASEURL; ?>assets/js/modernizr.custom.js"></script> -->
  <link href="css/style.css" rel='stylesheet' type='text/css' />
  <!-- <link href="<?php echo BASEURL; ?>assets/css/custom.css" rel="stylesheet"> -->
  <!-- Metis Menu -->
  <!-- <script src="<?php echo BASEURL; ?>assets/js/metisMenu.min.js"></script> -->
  <!--//Metis Menu -->

  <!-- <style>
    #chartdiv {
      width: 100%;
      height: 295px;
    }

    .fa {
      font-size: 15px;
    }

    .checked {
      color: orange;
    }

    .txt-center {
      text-align: center;
    }

    .hide {
      display: none;
    }

    .clear {
      float: none;
      clear: both;
    }

    .rating {
      width: 90px;
      unicode-bidi: bidi-override;
      direction: rtl;
      text-align: center;
      position: relative;
    }

    .rating>label {
      float: right;
      display: inline;
      padding: 0;
      margin: 0;
      position: relative;
      width: 1.1em;
      cursor: pointer;
      color: #000;
    }

    .rating>label:hover,
    .rating>label:hover~label,
    .rating>input.radio-btn:checked~label {
      color: transparent;
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before,
    .rating>input.radio-btn:checked~label:before,
    .rating>input.radio-btn:checked~label:before {
      content: "\2605";
      position: absolute;
      left: 0;
      color: #FFD700;
    }
  </style>
  <style type="text/css" media="print">
    @media print {
      @page {
        margin-top: 0;
        margin-bottom: 0;
      }

      body {
        padding-top: 72px;
        padding-bottom: 72px;
      }
    }

    .dontprint {
      display: none;
    }
  </style>
  <style>
    select {
      -webkit-appearance: none;
      -moz-appearance: none;

      /* Some browsers will not display the caret when using calc, so we put the fallback first */
      background: url("http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") white no-repeat 98.5% !important;
      /* !important used for overriding all other customisations */
      background: url("http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") white no-repeat calc(100% - 10px) !important;
      /* Better placement regardless of input width */
    }

    /*For IE*/
    select::-ms-expand {
      display: none;
    }

    @media only screen and (max-width: 767px) {
      #app-logo {
        width: 75px;
      }
    }
  </style> -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

  <script src="https://rawgit.com/someatoms/jsPDF-AutoTable/master/dist/jspdf.plugin.autotable.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>
  <script src="assets/js/vendor.min.js"></script>
    <script src="js/admin/common.js"></script>

  <!--   multi select github link is working correctly  https://github.com/nobleclem/jQuery-MultiSelect -->
  <link href="<?php echo BASEURL; ?>assets/css/jquery.multiselect.css" rel="stylesheet" />

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
          <!-- <li class="dropdown notification-list">
            <a id="notf_conv" class="dropdown-toggle-1" href="javascript:;">
              <i class="fa fa-envelope"></i>
              <span id="conv-notf-count">0</span>
            </a>
            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
              <i class="fe-settings noti-icon"></i>
            </a>
            <div class="dropdown-menu1">
              <div class="dropdownmenu-wrapper" data-href="https://www.webinovers.com/ecom/admin/conv/notf/show" id="conv-notf-show">
              </div>
            </div>
          </li> -->
          <li class="dropdown notification-list">
            <a id="notf_conv" href="javascript:void(0);" class="dropdown-togg notificationLink nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              <i class="fa-regular fa-bell"></i>
              <span id="new_noti_count">0</span>
            </a>
            <div id="notificationContainer" class="dropdown-menu dropdown-menu-right profile-dropdown ">

              <!-- item-->
              <div id="notificationTitle">Notifications <a href="javascript:void(0);" onclick="remove_notification();" style="float: right;">Remove All</a></div>
              <div id="notificationsBody" class="notifications">
                <ul id="new_noti_html"></ul>
              </div>
              <div id="notificationFooter"><a href="#"></a></div>
            </div>
          </li>


          <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              <span class="pro-user-name ml-1">
                <?= $_SESSION['seller_name']; ?> <i class="fa-solid fa-angle-down"></i>
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

          <!-- <li class="dropdown notification-list">
            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
              <i class="fe-settings noti-icon"></i>
            </a>
          </li> -->

        </ul>

        <!-- LOGO -->
        <!-- <div class="logo-box">

          <a href="" class="logo logo-light text-center">
            <span class="logo-sm">
              <img src="images/logo-appbar.png" alt="" height="18">
            </span>
            <span class="logo-lg">
              <img src="images/logo-appbar.png" alt="" height="40">
            </span>
          </a>


        </div> -->

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
    <!-- end Topbar -->


    <!-- ========== Left Sidebar Start ========== -->
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

        <!--- Sidemenu -->
        <div id="sidebar-menu">

          <ul id="side-menu">

            <li class="menu-title">Navigation</li>

            <li class="<?= strpos($_SERVER['PHP_SELF'], 'dashboard.php') !== false ? "active" : "" ?>">
              <a href="dashboard.php">
                <i class="fas fa-tachometer-alt"></i>
                <span> Dashboard </span>
              </a>
            </li>
            <li <?= strpos($_SERVER['PHP_SELF'], 'manage_orders.php') !== false  ? "active" : "" ?>>
              <a href="manage_orders.php">
                <i class="fas fa-cog"></i>
                <span>Manage Orders </span>
              </a>

            </li>
            <li class="<?= strpos($_SERVER['PHP_SELF'], 'payment.php') !== false ? "active" : "" ?>">
              <a href="payment.php">
                <i class="fa-solid fa-money-check-dollar"></i>
                <span> Payment </span>
              </a>
            </li>
            <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_seller_wise_transaction.php') !== false ? "active" : "" ?>">
              <a href="manage_seller_wise_transaction.php">
                <i class="fa-solid fa-file-invoice"></i>
                <span> Sales Report </span>
              </a>
            </li>
            <!-- <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_reverse_seller_transaction.php') !== false ? "active" : "" ?>">
              <a href="manage_reverse_seller_transaction.php">
                <i class="fa-solid fa-file-invoice"></i>
                <span> Reverse Sales Report </span>
              </a>
            </li> -->
            <li class="<?= strpos($_SERVER['PHP_SELF'], 'reports.php') !== false ? "active" : "" ?>">
              <a href="reports.php">
                <i class="fas fa-tachometer-alt"></i>
                <span> Sale Account </span>
              </a>
            </li>
            <!-- <li <?= strpos($_SERVER['PHP_SELF'], 'manage_attribute_set.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_tax_class.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_return_policy.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_conf_attributes.php') !== false ? "active" : "" ?>>
              <a href="#product-attributes" data-toggle="collapse">
                <i class="fas fa-cog"></i>
                <span> Products Details </span>
                <span class="menu-arrow"></span>
              </a>
              <div class="collapse" id="product-attributes">
                <ul class="nav-second-level">
                  <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_attribute_set.php') !== false ? "active" : "" ?>">
                    <a href="manage_attribute_set.php"> Manage Attribute Set</a>
                  </li>

                  <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_tax_class.php') !== false ? "active" : "" ?>">
                    <a href="manage_tax_class.php">Manage TAX Class</a>
                  </li>

                  <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_return_policy.php') !== false ? "active" : "" ?>">
                    <a href="manage_return_policy.php">Manage Return Policy</a>
                  </li>

                  <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_reverse_seller_transaction.php') !== false ? "active" : "" ?>">
                    <a href="manage_conf_attributes.php">Manage Configurations Attributes</a>
                  </li>

                </ul>
              </div>
            </li> -->
            <li <?= strpos($_SERVER['PHP_SELF'], 'import_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'inventory.php') !== false || strpos($_SERVER['PHP_SELF'], 'add_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'add_search_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'manage_product.php') !== false || strpos($_SERVER['PHP_SELF'], 'pending_products.php') !== false ? "active" : "" ?>>
              <a href="#products" data-toggle="collapse">
                <i class="fas fa-cog"></i>
                <span> Products </span>
                <span class="menu-arrow"></span>
              </a>
              <div class="collapse" id="products">
                <ul class="nav-second-level">
                  <li class="<?= strpos($_SERVER['PHP_SELF'], 'import_product.php') !== false ? "active" : "" ?>">
                    <a href="import_product.php"> Import Product </a>
                  </li>

                  <li class="<?= strpos($_SERVER['PHP_SELF'], 'inventory.php') !== false ? "active" : "" ?>">
                    <a href="inventory.php"> Update Inventory</a>
                  </li>

                  <li class="<?= strpos($_SERVER['PHP_SELF'], 'add_product.php') !== false ? "active" : "" ?>">
                    <a href="add_product.php"> Add Product</a>
                  </li>

                  <li class="<?= strpos($_SERVER['PHP_SELF'], 'add_search_product.php') !== false ? "active" : "" ?>">
                    <a href="add_search_product.php"> Add Existing Product</a>
                  </li>

                  <li class="<?= strpos($_SERVER['PHP_SELF'], 'manage_product.php') !== false ? "active" : "" ?>">
                    <a href="manage_product.php"> Manage Product</a>
                  </li>
                  <li class="<?php if (strpos($_SERVER['PHP_SELF'], 'pending_products.php') !== false) {
                                echo " active ";
                              } ?>"><a href="pending_products.php"> Pending Product</a></li>

                </ul>
              </div>
            </li>

            <li class="<?= strpos($_SERVER['PHP_SELF'], 'category.php') !== false ? "active" : "" ?>">
              <a href="category.php">
                <i class="fa-solid fa-network-wired"></i>
                <span> Category </span>
              </a>
            </li>
            <li class="<?= strpos($_SERVER['PHP_SELF'], 'brand.php') !== false ? "active" : "" ?>">
              <a href="brand.php">
                <i class="fas fa-tachometer-alt"></i>
                <span> Brand </span>
              </a>
            </li>
            <!-- <li class="<?= strpos($_SERVER['PHP_SELF'], 'coupancode.php') !== false ? "active" : "" ?>">
              <a href="coupancode.php">
                <i class="fas fa-tachometer-alt"></i>
                <span> Coupan Code </span>
              </a>
            </li> -->

            <li class="<?= strpos($_SERVER['PHP_SELF'], 'review.php') !== false ? "active" : "" ?>">
              <a href="manage_review.php">
                <i class="fas fa-tachometer-alt"></i>
                <span> User Reviews </span>
              </a>
            </li>
            <li class="<?= strpos($_SERVER['PHP_SELF'], 'support_chat.php') !== false ? "active" : "" ?>">
              <a href="support_chat.php">
                <i class="fas fa-tachometer-alt"></i>
                <span> Chat with Admin <i class="fa fa-bell" aria-hidden="true"></i> <span id="support_noti_count">0</span></span>
              </a>
            </li>
          </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

      </div>
      <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->


    <!-- header-starts -->

    <!-- //header-ends -->
    <div class="loading" style="display:none;">Loading&#8230;</div>
    <input type="hidden" name="code_ajax" id="code_ajax" value="<?php echo $_SESSION['_token']; ?>">
    <?php
    global $publickey_server;
    $encruptfun = new encryptfun();
    $encryptedpassword = $encruptfun->encrypt($publickey_server, $_SESSION['admin']);
    ?>
    <input type="hidden" id="selleer_id" value="<?php echo $encryptedpassword; ?>">
    <link href="<?php echo BASEURL; ?>assets/css/xdialog.min.css" rel="stylesheet" />
    <script src="<?php echo BASEURL; ?>assets/js/xdialog.min.js"></script>