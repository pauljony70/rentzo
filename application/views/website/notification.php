<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Notifications";
	include("include/headTag.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/profile.css') ?>">
</head>

<body>
	<?php include("include/topbar.php") ?>
	<?php include("include/navbar.php") ?>

	<main class="notification-page">

		<!--Start: Notifications Section -->
		<section class="my-5">
			<div class="container">
				<nav aria-label="breadcrumb" class="mb-4 mb-md-5">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">Home</li>
						<li class="breadcrumb-item active" aria-current="page">Notification</li>
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
						<div class="notifications">
							<?php
							foreach ($firebase_notification as $key => $firebase_notification_data) {
								if ($firebase_notification_data['clicktype'] == '1') {
									$links = base_url . $firebase_notification_data['sku'] . '?pid=' . $firebase_notification_data['pid'] . '&sku=' . $firebase_notification_data['sku'] . '&sid=' . $firebase_notification_data['sid'];
								} else if ($firebase_notification_data['clicktype'] == '2') {
									$links = base_url() . $firebase_notification_data['cat_slug'];
								} else if ($firebase_notification_data['clicktype'] == '3') {
									$links = base_url() . 'search/s?search=' . $firebase_notification_data['search'];
								} else if ($firebase_notification_data['clicktype'] == '4') {
									$links = base_url;
								}
							?>
								<div class="wrap">
									<div class="img-wrap">
										<?php if ($firebase_notification_data['imgurl'] != '') { ?>
											<img onclick="redirect_to_link('<?php echo $links; ?>')" style="width:70px;height:70px;object-fit:contain" src="<?php echo base_url . 'media/' . $firebase_notification_data['imgurl']; ?>" />
										<?php } else { ?>
											<img onclick="redirect_to_link('<?php echo $links; ?>')" style="width:70px;height:70px;object-fit:contain" src="<?php echo base_url; ?>/assets_web/images/icons/notification-icon.png" />
										<?php } ?>
										<!--<span>70%</span>-->
									</div>
									<div class="details">
										<h6 onclick="redirect_to_link('<?php echo $links; ?>')"><?php echo $firebase_notification_data['title']; ?></h6>
										<p><?php echo $firebase_notification_data['noti_body']; ?></p>
										<p><?php echo date('d M Y', strtotime($firebase_notification_data['date'])); ?></p>
									</div>
								</div>
								<?= $key !== count($firebase_notification) - 1 ? '<hr>' : '' ?>
							<?php } ?>

						</div>
					</div>

				</div>
			</div>
		</section>
		<!--End: Notifications Section -->

	</main>

	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>

</body>

</html>