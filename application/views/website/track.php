<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Track Order";
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
		<div class="container px-1">
			<div class="row justify-content-center mt-4">
				<?php
				if (!empty($this->session->userdata("user_id"))) {
					include("include/sidebar.php");
				}
				?>
				<div class="col-lg-8 p-1">
					<div class="left-block box-shadow-4" id="MyProfile">
						<h5 class="title"><?= $this->lang->line('track-order'); ?> <span class="d-lg-none">
						<?php if (!empty($this->session->userdata("user_id"))) { ?><a class="accordion-button collapsed" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">My Profile</a><?php } ?></span></h5>
						<p><?= $this->lang->line('track-order-content'); ?></p>
						
						<?php
						if (!empty($this->session->userdata("user_id"))) {
							include("include/mobile_sidebar.php");
						}
						?>

						<div class="mt-5">
							<form class="form row g-3">
								<div class="col-md-12">
									<label class="form-label"><?= $this->lang->line('track-id'); ?></label>
									<input type="text" name="order_id" id="order_id" class="form-control"/>
								</div>
								<div class="col-md-12 text-center">
									<a onclick="track_order()" class="btn btn-default"><?= $this->lang->line('track'); ?> </a>
								</div>
							</form>
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
	<script>
	var site_url = $(".site_url").val();

	function track_order() 
	{
		var order_id = $("#order_id").val();
		if(order_id != '')
		{
			location.href = site_url + "order?order_id=" + order_id;
		}
		
	}	
	</script>
</body>
	
</html>
