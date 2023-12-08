<footer class="desktop-footer position-relative">
    <div class="top-right-circle-border-outside">
        <div class="top-right-circle-border-inside">
            <div class="top-right-circle"></div>
        </div>
    </div>

    <div class="bottom-left-circle-border-outside">
        <div class="bottom-left-circle-border-inside">
            <div class="bottom-left-circle"></div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-2 footer-brand mb-5">
                <img src="<?= base_url('assets_web/images/logo.svg') ?>" alt="Logo">
            </div>
            <div class="col-md-10 d-flex justify-content-center mb-5">
                <a href="#" target="_blank" rel="noopener noreferrer" class="social-media-links mx-2 d-flex align-items-center justify-content-center rounded-circle">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="#" target="_blank" rel="noopener noreferrer" class="social-media-links mx-2 d-flex align-items-center justify-content-center rounded-circle">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#" target="_blank" rel="noopener noreferrer" class="social-media-links mx-2 d-flex align-items-center justify-content-center rounded-circle">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <a href="#" target="_blank" rel="noopener noreferrer" class="social-media-links mx-2 d-flex align-items-center justify-content-center rounded-circle">
                    <i class="fa-brands fa-snapchat"></i>
                </a>
                <a href="#" target="_blank" rel="noopener noreferrer" class="social-media-links mx-2 d-flex align-items-center justify-content-center rounded-circle">
                    <i class="fa-brands fa-pinterest"></i>
                </a>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-4 footer-link-row">
            <div class="col mb-5">
                <div class="col-heading mb-4">Our Details</div>
                <div class="footer-links mb-3">
                    <p class="">
					The perfect one-stop shop for all your cravings. Rentzo 
                    has simplified the shopping experience for its value - conscious buyers. Shop now on our online store and 
                    and bring the world at your doorsteps.
                </p>
                </div>
            </div>
            <div class="col mb-5">
                <div class="col-heading mb-4">Top Category</div>
				<?php  $count=0; foreach ($header_cat as $maincat_top) { if ( $count++ >= 5 ) { break;  }else{ ?>
                <div class="footer-links mb-3">
                    <a href="<?php echo base_url . 'shop/' . $maincat_top['cat_slug']; ?>"><?php echo $maincat_top['cat_name']; ?></a>
                </div>
                <?php } } ?>
            </div>
            <div class="col mb-5">
                <div class="col-heading mb-4">Our Policy</div>
                <div class="footer-links mb-3">
                    <a href="<?= base_url('refund') ?>">Returns Policy</a>
                </div>
                <div class="footer-links mb-3">
                    <a href="<?= base_url('privacy') ?>">Privacy Policy</a>
                </div>
				<div class="footer-links mb-3">
                    <a href="<?= base_url('shipping_policy') ?>">Shipping Policy</a>
                </div>
				<div class="footer-links mb-3">
                    <a href="<?= base_url('term_and_conditions') ?>">Terms & Condition</a>
                </div>
                
            </div>
            <div class="col mb-5">
                <div class="col-heading mb-4">About Us</div>
                <div class="footer-links mb-3">
                    <a href="<?= base_url('faq') ?>">FAQ</a>
                </div>
                <div class="footer-links mb-3">
                    <a href="<?= base_url('feedback') ?>">Feedback</a>
                </div>
                <div class="footer-links mb-3">
                    <a href="<?= base_url('contact') ?>">Contact Us</a>
                </div>
                <div class="footer-links mb-3">
                    <a href="<?= base_url('help') ?>">Help & Support</a>
                </div>
            </div>
        </div>
        <div class="row download-app-div pb-2">
            <div class="col-lg-7"></div>
            <div class="col-lg-5 d-flex flex-column align-items-center">
                <div class="mb-3">Download App</div>
                <div class="d-flex">
                    <img src="<?= base_url('assets_web/images/brands/app-store.svg') ?>" alt="App Store">
                    <img src="<?= base_url('assets_web/images/brands/play-store.svg') ?>" alt="Play Store" class="ms-4">
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Mobile Footer -->

<!-- <div class="mobile-footer d-md-none" style="z-index: 999; background-color: white; padding: 5px 0px;">
    <div class="px-4 mb-4">
        <a href="#" class="btn btn-lg btn-primary w-100 text-light rounded-0" id="download-app-btn" style="display:none;">
            <span class="text-uppercase text-light" style="letter-spacing: 3px;"><?= $this->lang->line('download-the-app'); ?></span>
        </a>
    </div>
    <div class="px-0">
        <button class="btn w-100 text-dark" id="toggle-btn">
            <span class="button-text"><?= $this->lang->line('more-about-ebuy'); ?></span>
            <i class="fa-solid fa-angle-down icon"></i>
        </button>
    </div>
    <div class="mobile-footer-content" id="toggle-footer" style="height:0px;">
        <div class="container-fluid">
            <hr style="border-color: #fff; opacity:1">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 my-4 footer justify-content-around">
                <div class="col">
                    <p class="fw-semibold fs-xl-6 mb-3">
                        <?php echo get_settings('footer_text'); ?>
                    </p>
                    <h4 class="fw-bold text-light mb-3">
                        <?= $this->lang->line('footer-payment'); ?>
                    </h4>
                    <div>
                        <div class="footer_payment_logo">
                            <img src="<?php echo base_url; ?>assets_web/images/svgs/mastercard.svg" class="mb-2 mb-xl-0" alt="Mastercard">
                            <img src="<?php echo base_url; ?>assets_web/images/svgs/visa.svg" class="mb-2 mb-xl-0" alt="Visa">
                            <img src="<?php echo base_url; ?>assets_web/images/svgs/gpay.svg" class="mb-2 mb-xl-0" alt="Google Pay">
                        </div>
                    </div>
                </div>
                <div class="col mt-4 mt-md-4 mt-lg-4">
                    <?php if (get_settings('facebook_link') != '' || get_settings('instagram_link') != '' || get_settings('twitter_link') != '' || get_settings('youtube_link') != '' || get_settings('linkedin_link') != '') { ?>
                        <h3 class="fw-bold text-light text-xl-center "><?= $this->lang->line('connect-with-us'); ?></h3>
                        <div class="d-flex flex-wrap">
                            <?php if (get_settings('facebook_link') != '') { ?>
                                <a href="<?php echo get_settings('facebook_link'); ?>" target="_blank" rel="noopener noreferrer" style="font-size: 32px; color: #3b5998;" class="me-2"><i class="fa-brands fa-square-facebook"></i></a>
                            <?php } ?>
                            <?php if (get_settings('instagram_link') != '') { ?>
                                <a href="<?php echo get_settings('instagram_link'); ?>" target="_blank" rel="noopener noreferrer" style="font-size: 32px; color: #d62976;" class="me-2"><i class="fa-brands fa-square-instagram"></i></a>
                            <?php } ?>
                            <?php if (get_settings('twitter_link') != '') { ?>
                                <a href="<?php echo get_settings('twitter_link'); ?>" target="_blank" rel="noopener noreferrer" style="font-size: 32px; color: #00acee;" class="me-2"><i class="fa-brands fa-square-twitter"></i></a>
                            <?php } ?>
                            <?php if (get_settings('youtube_link') != '') { ?>
                                <a href="<?php echo get_settings('youtube_link'); ?>" target="_blank" rel="noopener noreferrer" style="font-size: 32px; color: #CD201F;" class="me-2"><i class="fa-brands fa-square-youtube"></i></a>
                            <?php } ?>
                            <?php if (get_settings('linkedin_link') != '') { ?>
                                <a href="<?php echo get_settings('linkedin_link'); ?>" target="_blank" rel="noopener noreferrer" style="font-size: 32px; color: #CD201F;" class="me-2"><i class="fa-brands fa-linkedin"></i></a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col mt-4 mt-md-4 mt-lg-4">
                    <h3 class="fw-bold text-light text-xl-center "><?= $this->lang->line('footer-about-us'); ?></h3>
                    <ul class="list-unstyled mb-0">
                        <li><a href="<?php echo base_url ?>faq" class="text-decoration-none text-light fw-semibold d-xl-block text-center"><?= $this->lang->line('footer-faq'); ?></a></li>
                        <li><a href="<?php echo base_url ?>feedback" class="text-decoration-none text-light fw-semibold d-xl-block text-center"><?= $this->lang->line('footer-feedback'); ?></a></li>
                        <li><a href="<?php echo base_url ?>contact" class="text-decoration-none text-light fw-semibold d-xl-block text-center"><?= $this->lang->line('footer-contact-us'); ?></a></li>
                        <li><a href="<?php echo base_url ?>help" class="text-decoration-none text-light fw-semibold d-xl-block text-center"><?= $this->lang->line('footer-help-support'); ?></a></li>
                    </ul>
                </div>
                <div class="col mt-4 mt-md-4 mt-lg-4">
                    <h3 class="fw-bold text-light text-xl-center "><?= $this->lang->line('footer-services'); ?></h3>
                    <ul class="list-unstyled mb-0">
                        <li><a href="<?php echo base_url ?>offers" class="text-decoration-none text-light fw-semibold d-xl-block text-center"><?= $this->lang->line('footer-offers-for-you'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>become_seller" class="text-decoration-none text-light fw-semibold d-xl-block text-center"><?= $this->lang->line('footer-become-a-seller'); ?></a></li>
                    </ul>
                </div>
                <div class="col mt-4 mt-md-4 mt-lg-4">
                    <h3 class="fw-bold text-light text-xl-center "><?= $this->lang->line('footer-our-policy'); ?></h3>
                    <ul class="list-unstyled mb-0">
                        <li><a href="<?php echo base_url ?>refund" class="text-decoration-none text-light fw-semibold d-xl-block text-center"><?= $this->lang->line('footer-return-policy'); ?></a></li>
                        <li><a href="<?php echo base_url ?>privacy" class="text-decoration-none text-light fw-semibold d-xl-block text-center"><?= $this->lang->line('footer-privacy-policy'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>shipping_policy" class="text-decoration-none text-light fw-semibold d-xl-block text-center"><?= $this->lang->line('footer-shipping-policy'); ?></a></li>
                        <li><a href="<?php echo base_url ?>term_and_conditions" class="text-decoration-none text-light fw-semibold d-xl-block text-center"><?= $this->lang->line('footer-terms-and-condition'); ?></a></li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: #fff; opacity:1">
            <p class="mb-0 pb-4 fw-semibold text-center">&copy; <?php echo Date("Y") ?> - Copyright <?php echo get_settings('system_name'); ?> All Right Reserved</p>
        </div>
    </div>
</div> -->

<!-- <script>
    var toggleBtn = document.getElementById('toggle-btn');
    var toggleFooter = document.getElementById('toggle-footer');
    var faIcon = document.querySelector('.fa-angle-down');

    toggleBtn.addEventListener('click', function() {
        var footerHeight = toggleFooter.scrollHeight;

        if (toggleFooter.style.height === '0px') {
            toggleFooter.style.height = footerHeight + 'px';
            toggleFooter.scrollIntoView({
                behavior: 'smooth'
            });
            faIcon.style.transform = "rotate(-180deg)";
            setTimeout(() => {
                window.scrollTo({
                    top: document.documentElement.scrollHeight,
                    behavior: 'smooth'
                });
            }, 300)
        } else {
            toggleFooter.style.height = '0';
            faIcon.style.transform = "rotate(0deg)";
        }
    });

    function scrollToBottom() {
        var currentPosition = window.pageYOffset;
        var targetPosition = document.body.scrollHeight;
        var distance = targetPosition - currentPosition;
        var step = Math.ceil(distance / 40); // Adjust the value for desired scrolling speed

        function scrollStep() {
            currentPosition += step;
            window.scrollTo(0, currentPosition);

            if (currentPosition < targetPosition) {
                requestAnimationFrame(scrollStep);
            }
        }

        if (currentPosition < targetPosition) {
            window.scrollTo(0, targetPosition);
            requestAnimationFrame(scrollStep);
        } else {
            scrollStep();
        }
    }

    var currentURL = window.location.href;
    var button = document.getElementById('download-app-btn');
    var mobileFooter = document.querySelector('.mobile-footer');

    if (currentURL === '<?= base_url ?>') {
        button.style.display = 'block';
        mobileFooter.style.cssText = 'margin-bottom:3.3rem;';
    } else {
        button.style.display = 'none';
        mobileFooter.style.cssText = '';
    }
</script> -->