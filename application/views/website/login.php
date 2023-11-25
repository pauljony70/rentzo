<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Login";

    include("include/headTag.php");
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/login.css">
</head>

<body class="">
    <?php include("include/loader.php") ?>
    <?php include("include/topbar.php") ?>
    <?php include("include/navbar.php") ?>

    <div class="container login-containter my-4 my-md-5" id="login-containter">
        <div class="row" id="login-input-container">
            <div class="col-md-6 px-2 px-md-3 auth-image-container py-3">
                <div class="heading mb-2">"Shop Smart, Rent First."</div>
                <div class="des">Unlock Ownership through Renting</div>
                <div class="image text-center">
                    <img src="<?= base_url('assets_web/images/auth.png') ?>" alt="Image">
                </div>
            </div>
            <div class="col-md-6 form-container">
                <div class="d-flex flex-column justify-content-center h-100 ms-0 ms-md-5">
                    <div class="heading mb-3">Log in</div>
                    <div class="des mb-4 mb-md-5">Enter your details below</div>
                    <form class="form" action="#" id="login-input-form" method="post">
                        <div class="form-floating mb-4 mb-md-5" id="log_mobileno-group">
                            <input type="text" id="log_mobileno" name="phone" class="form-control" placeholder="Email or Phone Number" autocomplete="off">
                            <label class="ps-0" for="log_mobileno">Email or Phone Number</label>
                            <span id="error"></span>
                        </div>
                        <div class="mb-4 mb-md-5">
                            <button type="submit" class="btn btn-primary py-3" id="otp-with-change-addon">Continue</button>
                        </div>
                    </form>
                    <div class="next-page-div text-center">
                        <span>New to <?= get_settings('system_name') ?>?</span>
                        <a href="<?= base_url('sign-up') ?>" class="ms-2">Create an account</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-none" id="login-otp-container">
            <div class="col-md-6 p-3 auth-image-container py-3">
                <div class="image text-center">
                    <img src="<?= base_url('assets_web/images/otp-screen.png') ?>" alt="Image">
                </div>
            </div>
            <div class="col-md-6 form-container ps-md-5">
                <div class="d-flex flex-column justify-content-center h-100">
                    <div class="heading mb-3">Verification</div>
                    <div class="d-flex align-items-center mb-4 mb-md-5">
                        <div class="des">Enter OTP send to <span id="login-input"></span></div>
                        <i class="fa-regular fa-pen-to-square text-muted ms-3"></i>
                    </div>
                    <form class="form" action="#" id="login-otp-form" method="post">
                        <div class="form-floating mb-4 mb-md-5" id="log_mobileno-group">
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
                        <div class="mb-4 mb-md-5">
                            <button type="submit" class="btn btn-primary py-3" id="sendOtpLogInBtn">Verify</button>
                        </div>
                    </form>
                    <div class="next-page-div text-center">
                        <span>Didn’t receive a OTP ?</span>
                        <button type="button" class="ms-2" id="resendOtpBtn">Resend OTP</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="login-loader" class="d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>


    <?php
    include("include/script.php")
    ?>
    <script src="<?php echo base_url; ?>assets_web/js/app/auth.js"></script>
</body>

</html>