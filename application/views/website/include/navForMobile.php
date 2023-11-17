<nav class="navbar-expand-lg d-md-none bg-light fixed-bottom shadow-lg a-mobileNav">
    <div class="container-fluid px-2">
        <div class="d-flex align-items-ceneter justify-content-around w-100 h-100">
           
            <a class="py-2 waves-effect waves-light" href="<?php echo base_url('cart'); ?>">
                <div class="w-100 d-flex justify-content-center">
                    <img src="<?= base_url() ?>assets_web/images/svgs/shopping-cart.svg" style="height: 20px;">
                </div>
                <div class="w-100 d-flex justify-content-center">
                    <p class="mb-0 fs-xs fw-semibold">Cart</p>
                </div>
                <div class="icon-count">
                    <div id="badge-cart-count">0</div>
                </div>
            </a>
            <?php if (!empty($this->session->userdata("user_id"))) { ?>
                <a class="py-2 waves-effect waves-light" href="<?php echo base_url(); ?>personal_info">
                    <div class="w-100 d-flex justify-content-center">
                        <img src="<?= base_url() ?>assets_web/images/svgs/user.svg" style="height: 20px;">
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        <p class="mb-0 fs-xs fw-semibold">Profile</p>
                    </div>
                </a>
            <?php } else { ?>
                <a class="py-2 waves-effect waves-light" href="<?= base_url('login'); ?>">
                    <div class="w-100 d-flex justify-content-center">
                        <img src="<?= base_url() ?>assets_web/images/svgs/user.svg" style="height: 20px;">
                    </div>
                    <div class="w-100 d-flex justify-content-center">
                        <p class="mb-0 fs-xs fw-semibold">Profile</p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</nav>