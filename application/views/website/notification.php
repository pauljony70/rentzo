<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Notifications";
    include("include/headTag.php") ?>
</head>

<body>

	<?php
        include("include/topbar.php")
        ?>
        <?php
        include("include/navbar.php")
        ?>
	
<main class="notification-page my-order-page cart-page">
	
	<!--Start: Notifications Section -->
	<section>
		<div class="container" style="max-width:1344px;">
			<div class="row mt-4">
				<?php
				include("include/sidebar.php");
				?>
				
				<div class="col-lg-8">
					<div class="left-block box-shadow-4 mt-1" id="MyProfile">
						<h5 class="title"><?= $this->lang->line('user-notification'); ?> <span class="d-lg-none"><a class="accordion-button collapsed" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">My Profile</a></span> </h5>
						
						<?php
						include("include/mobile_sidebar.php");
						?>
						

						<div class="notifications">
							<hr/>
							<?php 
							foreach($firebase_notification as $firebase_notification_data) { 
							
							if($firebase_notification_data['clicktype'] == '1')
							{
								$links = base_url . $firebase_notification_data['sku'] . '?pid=' . $firebase_notification_data['pid'] . '&sku=' . $firebase_notification_data['sku'] . '&sid=' . $firebase_notification_data['sid'];
							}
							else if($firebase_notification_data['clicktype'] == '2')
							{
								$links = base_url() . $firebase_notification_data['cat_slug'];
							}
							else if($firebase_notification_data['clicktype'] == '3')
							{
								$links = base_url() .'search/s?search='. $firebase_notification_data['search'];
							}
							else if($firebase_notification_data['clicktype'] == '4')
							{
								$links = base_url;
							}
							?>
							<div class="wrap">
								<div class="img-wrap">
									<?php if($firebase_notification_data['imgurl'] != '') { ?>
									<img onclick="redirect_to_link('<?php echo $links; ?>')" style="width:70px;height:70px;object-fit:contain" src="<?php echo base_url.'media/'.$firebase_notification_data['imgurl'];?>" />
									<?php } else { ?>
									<img onclick="redirect_to_link('<?php echo $links; ?>')" style="width:70px;height:70px;object-fit:contain" src="<?php echo base_url;?>/assets_web/images/icons/notification-icon.png" />
									<?php } ?>
									<!--<span>70%</span>-->
								</div>
								<div class="details">
									<h6 onclick="redirect_to_link('<?php echo $links; ?>')"><?php echo $firebase_notification_data['title']; ?></h6>
									<p><?php echo $firebase_notification_data['noti_body']; ?></p>
									<p><?php echo date('d M Y',strtotime($firebase_notification_data['date'])); ?></p>
								</div>
							</div>
							<hr/>
							<?php } ?>
							
						</div>

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
