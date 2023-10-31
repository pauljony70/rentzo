<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Coupons";
    include("include/headTag.php") ?>
</head>

<body>

	<?php 
        include("include/topbar.php")
        ?>
        <?php
        include("include/navbar.php");
		//print_r($vendor_coupon);
        ?>
	
<main class="coupon-page notification-page my-order-page cart-page offers">
	
	<!--Start: Available Coupons Section -->
	<section>
		<div class="container" style="max-width:1344px;">
			<div class="row justify-content-center">
				<?php
				if (!empty($this->session->userdata("user_id"))) {
					include("include/sidebar.php");
				}
				?>
				<div class="col-lg-8">
					<div class="left-block box-shadow" id="MyProfile">
						<h5 class="title">All Offers <span class="d-lg-none">
						<?php if (!empty($this->session->userdata("user_id"))) { ?><a class="accordion-button collapsed" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">My Profile</a><?php } ?></span> 
						<!--<a href="javascript:void(0);" class="clear-all d-none d-lg-block">Clear All</a>--></h5>
						
						<?php
						if (!empty($this->session->userdata("user_id"))) {
							include("include/mobile_sidebar.php");
						}
						?>

						<div class="notifications">
							<!--<a href="javascript:void(0);" class="clear-all d-lg-none">Clear All</a>-->
							<hr/>
							<?php foreach($vendor_coupon as $vendor_coupon_data) { ?>
							<div class="row">
								<div class="col-md-9">
									<div class="details">
										<h6><?php echo  $vendor_coupon_data['name']; ?></h6>
										<p><?php echo  $vendor_coupon_data['coupandesc']; ?></p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="view-wrap">
										<p>Valid till <?php echo  date('d M Y',strtotime($vendor_coupon_data['coupon_todate'])); ?></p>
										<a href="<?php echo base_url(); ?>term_and_conditions">View T&C</a>
									</div>
								</div>
							</div>
							<hr/>
							<?php } ?>
							
						</div>

						<!--<div class="more"><a href="javascript:void(0);">View More</a></div>-->
						
					</div>
				</div>

			</div>
		</div>
	</section>
	<!--End: Available Coupons Section -->

</main>

 <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>
	
</body>
	
</html>
