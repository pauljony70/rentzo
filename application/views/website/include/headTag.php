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