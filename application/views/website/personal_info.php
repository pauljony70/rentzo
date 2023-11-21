<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Personal Information";
	include("include/headTag.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/profile.css') ?>">
</head>

<body>
	<?php include("include/topbar.php") ?>
	<?php include("include/navbar.php") ?>

	<main class="profile-page">
		<section class="my-5">
			<div class="container">
				<nav aria-label="breadcrumb" class="mb-4 mb-md-5">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">Home</li>
						<li class="breadcrumb-item active" aria-current="page">My profile</li>
					</ol>
				</nav>
				<div class="sidebar mb-4 d-block d-lg-none">
					<div class="d-flex align-items-center sidebar-header">
						<div class="d-flex align-items-center justify-content-center profile-image">
							<img src="<?= base_url('assets_web/images/icons/user.svg') ?>" alt="">
						</div>
						<div class="d-flex flex-column username ms-4">
							<div>Hello</div>
							<div><?= $this->session->userdata("user_name") ?></div>
						</div>
					</div>
				</div>
				<div class="row mb-5 mb-lg-0">
					<?php include("include/sidebar.php"); ?>
					<div class="col-lg-8">
						<div class="personal-info" id="MyProfile">
							<div class="d-flex justify-content-between mb-5">
								<div class="title">Personal Information</div>
								<button type="button" class="edit-button">Edit</button>
							</div>

							<form class="form row mb-5">
								<div class="col-md-8 mb-4">
									<label class="form-label">Full name</label>
									<input type="text" class="form-control" placeholder="Name" value="<?php echo $this->session->userdata("user_name") ?>" disabled />
								</div>
								<div class="col-md-8 mb-4">
									<label class="form-label">Email address</label>
									<input type="email" class="form-control" placeholder="Email" value="<?php echo $this->session->userdata("user_email") ?>" disabled />
								</div>
								<div class="col-md-8 mb-4">
									<label class="form-label">Mobile number</label>
									<input type="text" class="form-control" placeholder="Phone no" value="+91 <?php echo $this->session->userdata("user_phone") ?>" disabled />
								</div>
							</form>

						</div>
					</div>
				</div>
				<div class="sidebar-page-links d-block d-lg-none">
					<a href="<?= base_url('order') ?>" class="d-flex align-items-center">
						<div class="icon">
							<img src="<?= base_url('assets_web/images/icons/cart-blue.svg') ?>" alt="Orders">
						</div>
						<div class="text">Order And Returns</div>
					</a>
					<hr>
					<a href="<?= base_url('myaddress') ?>" class="d-flex align-items-center">
						<div class="icon">
							<img src="<?= base_url('assets_web/images/icons/location-pin.svg') ?>" alt="Address">
						</div>
						<div class="text">Address</div>
					</a>
					<hr>
					<hr>
					<a href="<?= base_url('notification') ?>" class="d-flex align-items-center">
						<div class="icon">
							<img src="<?= base_url('assets_web/images/icons/notification-bell.png') ?>" alt="Notifications">
						</div>
						<div class="text">Notifications</div>
					</a>
					<hr>
					<a href="<?= base_url('wishlist') ?>" class="d-flex align-items-center">
						<div class="icon">
							<img src="<?= base_url('assets_web/images/icons/wishlist-blue.png') ?>" alt="Wishlist">
						</div>
						<div class="text">Wishlist</div>
					</a>
					<hr>
					<a href="<?= base_url('#') ?>" class="d-flex align-items-center">
						<div class="icon">
							<img src="<?= base_url('assets_web/images/icons/headphone.svg') ?>" alt="Support">
						</div>
						<div class="text">Support</div>
					</a>
					<hr>
					<a href="<?= base_url('logout') ?>" class="d-flex align-items-center">
						<div class="icon">
							<img src="<?= base_url('assets_web/images/icons/logout.svg') ?>" alt="Log Out">
						</div>
						<div class="text text-danger">Log Out</div>
					</a>
				</div>
			</div>
		</section>
		<!--End: Personal Information Section -->

	</main>

	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>

</body>

</html>