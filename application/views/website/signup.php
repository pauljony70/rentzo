<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Sign Up";

    include("include/headTag.php");
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets_web/style/css/login.css">
</head>

<body class="">
    <?php include("include/loader.php") ?>
    <?php include("include/topbar.php") ?>
    <?php include("include/navbar.php") ?>

    <div class="container login-containter my-4 my-md-5" id="signup-containter">
        <div class="row" id="signup-input-container">
            <div class="col-md-6 px-2 px-md-3 auth-image-container py-3">
                <div class="heading mb-2">"Shop Smart, Rent First."</div>
                <div class="des">Unlock Ownership through Renting</div>
                <div class="image text-center">
                    <img src="<?= base_url('assets_web/images/auth.png') ?>" alt="Image">
                </div>
            </div>
            <div class="col-md-6 form-container">
                <div class="d-flex flex-column justify-content-center h-100 ms-0 ms-md-5">
                    <div class="heading mb-3">Create an account</div>
                    <div class="des mb-4 mb-md-5">Enter your details below</div>
                    <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="error-alert-div">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div class="ms-2" id="error-alert"></div>
                    </div>
                    <form class="form" action="#" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Name" autocomplete="off">
                            <label class="ps-0" for="fullname">Name</label>
                            <span id="error"></span>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" id="email" name="email" class="form-control" placeholder="Email" autocomplete="off">
                            <label class="ps-0" for="email">Email</label>
                            <span id="error"></span>
                        </div>
                        <div class="form-floating mb-4 mb-md-5">
                            <input type="number" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" autocomplete="off" oninput="enforceMaxLength(this)" maxlength="10">
                            <label class="ps-0" for="phone_number">Phone Number</label>
                            <span id="error"></span>
                        </div>
                        <div class="mb-4 mb-md-5">
                            <button type="submit" class="btn btn-primary py-3" id="otp-with-change-addon">Continue</button>
                        </div>
                    </form>
                    <div class="next-page-div text-center">
                        <span>Already have account?</span>
                        <a href="<?= base_url('login') ?>" class="ms-2">Log in</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-none" id="signup-otp-container">
            <div class="col-md-6 p-3 auth-image-container py-3">
                <div class="image text-center">
                    <img src="<?= base_url('assets_web/images/otp-screen.png') ?>" alt="Image">
                </div>
            </div>
            <div class="col-md-6 form-container ps-md-5">
                <div class="d-flex flex-column justify-content-center h-100">
                    <div class="heading mb-4 mb-md-5">Verification</div>
                    <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="otp-error-alert-div">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div class="ms-2" id="otp-error-alert"></div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mb-md-4">
                        <div class="des">Enter OTP send to <span id="signup-input-phone"></span></div>
                        <i class="fa-regular fa-pen-to-square text-muted ms-3"></i>
                    </div>
                    <form class="form" action="#" method="post">
                        <div class="form-floating mb-3 mb-md-4" id="log_mobileno-group">
                            <div class="phone-otp-field w-100 mt-2">
                                <input type="number" id="code1" />
                                <input type="number" id="code2" disabled />
                                <input type="number" id="code3" disabled />
                                <input type="number" id="code4" disabled />
                                <input type="number" id="code5" disabled />
                                <input type="number" id="code6" disabled />
                            </div>
                            <div id="error"></div>
                        </div>
                        <div class="d-flex align-items-center mb-3 mb-md-4">
                            <div class="des">Enter OTP send to <span id="signup-input-email"></span></div>
                            <i class="fa-regular fa-pen-to-square text-muted ms-3"></i>
                        </div>
                        <div class="form-floating mb-4 mb-md-5" id="log_mobileno-group">
                            <div class="email-otp-field w-100 mt-2">
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
                        <button type="button" class="ms-2" onclick="return false;" id="resendOtpBtn">Resend OTP</button>
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