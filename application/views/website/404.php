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
	
	<section class="my-5">
				<div class="container">
					<div class="d-flex flex-column align-items-center empty-cart-image">
						<h1>Oops!</h1>
						<div class="des mb-4"><?= $this->lang->line('404-desc'); ?></div>
						<a href="<?= base_url() ?>" class="btn btn-primary"><?= $this->lang->line('filter-page-home-button'); ?></a>
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
