<div class="col-lg-4 d-none d-lg-block">
	<div class="sidebar">
		<div class="d-flex align-items-center sidebar-header">
			<div class="d-flex align-items-center justify-content-center profile-image">
				<img src="<?= base_url('assets_web/images/icons/user.svg') ?>" alt="">
			</div>
			<div class="d-flex flex-column username ms-4">
				<div>Hello</div>
				<div><?= $this->session->userdata("user_name") ?></div>
			</div>
		</div>
		<div class="sidebar-body">
			<a href="<?= base_url('order') ?>" class="d-flex align-items-center mb-4">
				<div class="icon">
					<img src="<?= base_url('assets_web/images/icons/cart-blue.svg') ?>" alt="Orders">
				</div>
				<div class="text">Order And Returns</div>
			</a>
			<a href="<?= base_url('myaddress') ?>" class="d-flex align-items-center mb-4">
				<div class="icon">
					<img src="<?= base_url('assets_web/images/icons/location-pin.svg') ?>" alt="Address">
				</div>
				<div class="text">Address</div>
			</a>
			<a href="<?= base_url('notification') ?>" class="d-flex align-items-center mb-4">
				<div class="icon">
					<img src="<?= base_url('assets_web/images/icons/notification-bell.png') ?>" alt="Notifications">
				</div>
				<div class="text">Notifications</div>
			</a>
			<a href="<?= base_url('wishlist') ?>" class="d-flex align-items-center mb-4">
				<div class="icon">
					<img src="<?= base_url('assets_web/images/icons/wishlist-blue.png') ?>" alt="Wishlist">
				</div>
				<div class="text">Wishlist</div>
			</a>
			<a href="<?= base_url('#') ?>" class="d-flex align-items-center mb-4">
				<div class="icon">
					<img src="<?= base_url('assets_web/images/icons/headphone.svg') ?>" alt="Support">
				</div>
				<div class="text">Support</div>
			</a>
			<a href="<?= base_url('logout') ?>" class="d-flex align-items-center">
				<div class="icon">
					<img src="<?= base_url('assets_web/images/icons/logout.svg') ?>" alt="Log Out">
				</div>
				<div class="text text-danger">Log Out</div>
			</a>
		</div>
	</div>
</div>