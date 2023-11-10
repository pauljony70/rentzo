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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


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


<script src="<?= base_url('assets_web/js/jquery.min.js') ?>"></script>