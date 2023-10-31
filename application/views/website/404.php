<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "404";
    include("include/headTag.php") ?>
</head>

<body>

	<?php
        include("include/topbar.php")
        ?>
        <?php
        include("include/navbar.php")
        ?>
	
<main class="empty-cart">
	
	<!--Start: 404-error Section -->
	<section>
		<div class="container">
			<div class="wrap box-shadow">
				<img src="<?php echo base_url;?>/assets_web/images/error-img.png" alt=""  class="empty-cart-img" />
				<h5><?= $this->lang->line('404-desc'); ?></h5>
				<a href="<?php echo base_url;?>" class="btn btn-default"><?= $this->lang->line('filter-page-home-button'); ?></a>
			</div>
		</div>
	</section>
	<!--End: 404-error Section -->


</main>

 <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>
	
</body>
	
</html>
