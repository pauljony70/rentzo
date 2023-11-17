
<header class="navbar-light navbar-sticky" style="position: sticky; top: -1px; z-index: 999;">
    <!-- Part 1 Navbar (Logo, Search, Cart and User Details) -->
    <nav class="navbar menu-navbar navbar-expand-lg bg-body-tertiary py-0">
        <div class="d-flex justify-content-center container">
            <a class="navbar-brand" href="<?= base_url('home') ?>">
                <img src="<?= base_url('assets_web/images/logo.svg') ?>" alt="<?= get_settings('system_name'); ?>" srcset="">
            </a>
        </div>
    </nav>
</header>

<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
<input type="hidden" class="site_url" value="<?php echo site_url(); ?>">
<input type="hidden" name="website_name" value="<?php echo $website_name; ?>" id="website_name">