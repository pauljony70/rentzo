<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Login";

    include("include/headTag.php");
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/css/intlTelInput.min.css" rel="stylesheet">
</head>

<body class="">
    <?php
    include("include/loader.php")
    ?>
    <?php
    include("include/topbar.php")
    ?>
    <?php
    include("include/navbar.php")
    ?>

    <?php if ($this->session->flashdata('login_method_error')) : ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: '<?= $default_language == 1 ? 'خطأ في تسجيل الدخول' : 'Login Error' ?>',
                    text: '<?= $this->session->flashdata('login_method_error') ?>',
                    type: 'error',
                    confirmButtonColor: '#FF6600',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    <?php endif; ?>

    <div class="container-fluid login-containter" id="login-containter">
        <div class="card my-auto mx-auto">
            <img src="<?= base_url('assets_web/images/svgs/login.svg') ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <div id="login-input-container" class="">
                    <h4 class="card-title mb-2"><?= $this->lang->line('login') ?></h4>
                    <form class="form">
                        <div class="form-group" id="log_mobileno-group">
                            <label for="phone" class="form-label"><?= $this->lang->line('mobile-or-email') ?> <span class="text-danger ml-2">&#42;</span></label>
                            <input type="text" id="log_mobileno" name="phone" class="form-control intl-tel-input" placeholder="<?= $this->lang->line('enter-your-mobile-or-email') ?>">
                            <span id="error"></span>
                        </div>
                        <div class="form-group">
                            <p class="text-muted mb-0" style="font-size: small;"><?= $this->lang->line('by-continue-i-agree-to') ?> <a href="<?= base_url('term_and_conditions') ?>" class="text-decoration-none"><?= $this->lang->line('ebuy-terms-of-use') ?></a> & <a href="<?= base_url('privacy') ?>" class="text-decoration-none"><?= $this->lang->line('privacy-policy') ?></a></p>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-block btn-lg btn-primary fw-bolder text-light text-uppercase" onclick="return false;" id="otp-with-change-addon"><?= $this->lang->line('continue') ?></button>
                        </div>
                    </form>
                    <div class="text-center text-muted mb-2" style="font-size: smaller;"><?= $this->lang->line('or') ?></div>
                    <div class="social-media-icons d-flex flex-column align-items-center justify-content-center mb-5">
                        <a class="btn-block text-center google-login-btn mb-3" href="<?php echo site_url('google-login'); ?>">
                            <img src="<?= base_url('assets_web/images/svgs/google.svg') ?>" alt="" srcset="">
                            <span class="text"><?= $this->lang->line('continue-with-google') ?></span>
                        </a>
                        <a class="btn-block text-center facebook-login-btn" href="<?php echo site_url('UserAuthController/login_with_facebook'); ?>">
                            <img src="<?= base_url('assets_web/images/svgs/facebook.svg') ?>" alt="" srcset="">
                            <span class="text"><?= $this->lang->line('continue-with-facebook') ?></span>
                        </a>
                    </div>
                    <div class="sign-up-div text-center">
                        <span class="text-muted"><?= $this->lang->line('new-to-ebuy') ?></sp><a href="<?= base_url('sign-up') ?>"> <?= $this->lang->line('create-an-account') ?> </a>
                    </div>
                </div>
                <div id="login-otp-container" class="d-none">
                    <h4 class="card-title"><?= $this->lang->line('verify-with-otp') ?></h4>
                    <div class="d-flex justify-content-between">
                        <div class="login-input text-muted mb-10"><?= $this->lang->line('sent-to') ?> <span id="login-input"></span></div>
                        <i class="fa-regular fa-pen-to-square text-muted"></i>
                    </div>
                    <form class="form">
                        <div class="form-group">
                            <div class="otp-field w-100 mt-2">
                                <input type="number" id="code1" />
                                <input type="number" id="code2" disabled />
                                <input type="number" id="code3" disabled />
                                <input type="number" id="code4" disabled />
                                <input type="number" id="code5" disabled />
                                <input type="number" id="code6" disabled />
                            </div>
                            <div id="error"></div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="fw-bolder" onclick="return false;" id="resendOtpBtn"><?= $this->lang->line('resend-otp') ?></button>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-block btn-lg btn-primary fw-bolder text-light text-uppercase" onclick="return false;" id="sendOtpLogInBtn"><?= $this->lang->line('continue') ?></button>
                        </div>
                    </form>
                </div>
                <div id="login-loader" class="d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include("include/script.php")
    ?>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/intlTelInput.min.js"></script>
    <script src="<?php echo base_url; ?>assets_web/js/app/auth.js"></script>
    <?php $this->session->unset_userdata('login_method_error'); ?>
</body>

</html>