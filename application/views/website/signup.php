<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Sign Up";

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

    <!-- <a href="<?php echo site_url('google-login'); ?>">
        Google Login
    </a>

    <a href="<?= base_url('UserAuthController/login_with_facebook') ?>">Login with Facebook</a> -->


    <!-- Register Box -->
    <!-- <div id="registe" class="px-2">
        <h1>Create Account</h1>
        <form action="" class="my-3 me-3 ms-2">
            <input class="form-control border rounded ms-2 me-6" type="text" id="fullname" placeholder="Enter Full Name" aria-label="Enter Full Name" required>
            <span id="fullname_error" style="color:red;"></span>
            
            <input class="form-control border rounded mt-2 w-100 ms-2 me-2" onkeypress="return AllowOnlyNumbers(event);" maxlength="10" type="text" id="mobileno" placeholder="Enter Mobile Number" aria-label="Enter Phone Number">
            <span id="phonev_error" style="color:red;text-align:left"></span>

            <input type="text" class="form-control border-top-0 border-end-0 border-start-0 border-bottom rounded ms-2" id="otp" placeholder="Enter OTP Sent to Mobile" aria-label="OTP Sent to Mobile" aria-describedby="otp-with-change-addon">
            <span style="color:red" id="error_msg_reg"></span>

            <a class="input-group-text text-primary text-decoration-none bg-transparent border-0" onclick="call_register(); return false;" id="otp-with-change-addon">Get OTP ?</a>
            <input type="text" class="form-control" id="email" placeholder="Email">

            <input type="text" class="form-control" id="email-otp" placeholder="Email OTP">
            <a onclick="sendEmailOtp(); return false;" id="email-tp-btn">Get OTP ?</a>

            <p class="text-muted mt-lg-2 mb-0">By continue, you agree to <a href="" class="text-decoration-none">Ebuy Terms of Use</a> and <a href="" class="text-decoration-none">Privacy Policy</a>.</p>
            
            <button onclick="verify_otp(); return false;" class="btn btn-primary ms-2 mt-2 mt-lg-1 w-100 fw-bold text-light rounded" id="sendOtpSignUpBtn">Continue</button>
        </form>
    </div> -->

    <div class="container-fluid login-containter" id="signup-containter">
        <div class="card my-auto mx-auto">
            <img src="<?= base_url('assets_web/images/svgs/login.svg') ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <div id="signup-input-container" class="">
                    <h4 class="card-title mb-2"><?= $this->lang->line('sign-up') ?></h4>
                    <form class="form">
                        <div class="form-group">
                            <label class="form-label" for="fullname"><?= $this->lang->line('fullname') ?> <span class="text-danger ml-2">&#42;</span></label>
                            <input class="form-control" type="text" id="fullname" placeholder="<?= $this->lang->line('enter-full-name') ?>" aria-label="Full name">
                            <span id="error"></span>
                        </div>
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
                        <span class="text-muted"><?= $this->lang->line('already-have-an-account') ?></sp><a href="<?= base_url('login') ?>"> <?= $this->lang->line('log-in') ?> </a>
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
    <?php include("include/script.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/intlTelInput.min.js"></script>
    <script src="<?php echo base_url; ?>assets_web/js/app/auth.js"></script>
</body>

</html>