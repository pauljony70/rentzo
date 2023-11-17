<!DOCTYPE html>
<meta name="google" content="notranslate" />
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
    <?= $title ?> | <?= get_settings('system_name'); ?>
</title>

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url; ?>assets_web/images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url; ?>assets_web/images/favicon/android-chrome-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url; ?>assets_web/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url; ?>assets_web/images/favicon/favicon-16x16.png">
<link rel="manifest" href="<?php echo base_url; ?>assets_web/images/favicon/site.webmanifest">

<?php echo htmlspecialchars_decode(get_settings('google_script'), ENT_QUOTES); ?>
<?php echo htmlspecialchars_decode(get_settings('facebook_pixel'), ENT_QUOTES); ?>
<?php echo htmlspecialchars_decode(get_settings('tag_manager'), ENT_QUOTES); ?>

<!-- Plugins css -->
<link rel="stylesheet" href="<?= base_url('assets_web/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets_web/libs/fontawesome/css/all.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets_web/libs/sweetalert2/sweetalert2.min.css'); ?>" />


<!-- Custom css -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/style.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/topbar.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/navbar.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/footer.css') ?>">



<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"> -->


<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/common.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/style.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/responsive.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/product-card.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/nouislider.css"> -->

<!-- Slick Slider  -->
<!-- <link rel="stylesheet" href="<?php echo base_url; ?>assets_web/style/css/slick.css"> -->
<!-- <link rel="stylesheet" href="<?php echo base_url; ?>assets_web/libs/dropify/dist/css/dropify.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/native-toast.css"> -->

<!-- Global CSS with bootstrap 5.2 -->
<!-- <link rel="stylesheet" href="<?php echo base_url; ?>assets_web/style/css/global.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/slick-theme.css" /> -->
<!-- <link rel="stylesheet" href="<?= base_url('assets_web/libs/swiper/swiper-bundle.min.css') ?>" /> -->
<!-- <link href="<?= base_url('assets_web/libs/select2/css/select2.min.css') ?>" rel="stylesheet" /> -->
<!-- <style>
  .dropify-wrapper .file-icon {
    font-size: medium;
    color: #999;
  }

  .dropify-wrapper {
    border: 1px solid #ced4da;
    border-radius: 5px;
  }

  .file-icon p {
    font-size: medium;
    color: #999;
  }

  .disabled-link {
    pointer-events: none;
    cursor: not-allowed;
    text-decoration: none;
  }

  .select2-results__option img {
    display: inline-block;
    vertical-align: middle;
  }
</style> -->
<!-- For language -->
<style>
    .my-order-page .right-block .wrap {
        border-radius: 3px;
        padding: 20px;
        margin-bottom: 15px;
    }

    .my-order-page .right-block .wrap .wrap-block {
        display: flex;
        flex-wrap: wrap;
        align-items: start;
    }

    .my-order-page .right-block .wrap .wrap-details {
        margin: 0px 20px;
    }

    .my-order-page .right-block .wrap h5 a,
    .my-order-page .right-block .wrap h6 a {
        color: #4f5362;
    }

    .my-order-page .left-block {
        padding: 20px;
        border-radius: 3px;
    }

    .my-order-page .left-block .title {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .wishlist-page .left-block .cart-details {
        align-items: unset;
    }

    .wishlist-page .cart-details {
        position: relative;
    }

    .my-order-page .left-block .product-thumb img {
        display: block;
        margin: 0 auto;
        height: 140px;
        object-fit: contain;
        border: none;
    }

    .my-order-page .left-block .product-thumb {
        border: 0.5px solid #ededed;
        border-radius: 3px;
        height: 141px;
    }

    .address-details {
        border-radius: 3px;
        margin-bottom: 10px !important;
        padding: 20px;
    }

    .track-order-page .left-block .order-progress .step-progress-item:not(:last-child) {
        padding-bottom: 48px;
    }

    .track-order-page .left-block .order-progress .step-progress-item {
        position: relative;
        counter-increment: list;
        padding-left: 24px;
    }

    .track-order-page .left-block .order-progress .step-progress::before {
        display: inline-block;
        content: "";
        position: absolute;
        top: 0;
        left: -24px;
        width: 10px;
        height: calc(100% - 40px);
        border-left: 5px solid #888888;
    }

    .track-order-page .left-block .order-progress .step-progress {
        position: relative;
        list-style: none;
        padding-left: 0;
    }

    .track-order-page .left-block .order-progress .step-progress-item.is-done::before {
        border-left: 5px solid #2BBA1F;
    }

    .track-order-page .left-block .order-progress .step-progress-item::before {
        display: inline-block;
        content: "";
        position: absolute;
        left: -24px;
        height: 100%;
        width: 10px;
    }

    .track-order-page .left-block .cart-details {
        justify-content: center;
        border-bottom: 0;
    }

    .track-order-page .left-block .order-progress .step-progress-item::after {
        content: url(/assets_web/images/icons/check.png);
        display: inline-block;
        position: absolute;
        top: 0;
        left: -39px;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #888888;
    }


    .notification-page .notifications .wrap {
        display: flex;
        align-items: center;
    }

    .notification-page .notifications .img-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .notification-page .notifications .details {
        margin: 0px 20px;
    }

    .notification-page .notifications .details h6 {
        margin-bottom: 10px;
    }

    .checkout-page .left-block .nav-pills .nav-link.active,
    .checkout-page .left-block .nav-pills .show>.nav-link {
        background-color: transparent;
        color: #000;
    }

    .checkout-page .left-block .nav-pills .nav-link {
        text-align: left;
        padding: 0;
    }

    .address-details .badge {
        font-weight: 600;
        font-size: 12px;
        line-height: 15px;
        color: #606060;
        background: #DDDDDD;
        border-radius: 5px;
    }

    .address-details .name {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        margin: 8px 0 19px;
        padding-left: 0;
    }
</style>

<script src="<?= base_url('assets_web/js/jquery.min.js') ?>"></script>