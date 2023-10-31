<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Thanks You";
    include("include/headTag.php") ?>
</head>

<body>
	 <?php
    include("include/loader.php")
    ?>

	<?php
        include("include/topbar.php") 
        ?>
        <?php
        include("include/navbar.php")
        ?>
		<?php
   // include("include/navForMobile.php")
    ?>
	
<main class="thanks-page product-details-page">
	
	<!--Start: Thanks Section -->
	<section>
		<div class="container">
			<div class="block d-md-none">
				<img src="<?php echo base_url; ?>assets_web/images/icons/thanks-icon.png" alt="" class="thanks-img" />
				<h4 class="mt-5">Thank You,</h4>
				<h6>We have received your details. Our team will contact you within 24 hours.</h6>
			</div>
			<div class="wrap box-shadow">
				<div class="block d-none d-md-block">
					<img src="<?php echo base_url; ?>assets_web/images/icons/thanks-icon.png" alt=""  class="thanks-img" />
					<h4 class="mt-5">Thank You,</h4>
					<h6>We have received your details. Our team will contact you within 24 hours.</h6>
				</div>
				
			</div>
		</div>
	</section>
	<!--End: Thanks Section -->

</main>

 <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>
	
</body>
	
</html>
