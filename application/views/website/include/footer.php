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
                    <a class="">
					The perfect one-stop shop for all your cravings. Rentzo 
                    has simplified the shopping experience for its value - conscious buyers. Shop now on our online store and 
                    and bring the world at your doorsteps.
                </a>
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