<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "SHIPPING POLICY";
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
	
<main class="cart-page">

	
	<section id="privacy">

        <div class="container">
		
			<h2 class="title">SHIPPING POLICY</h2><br>
			
			<?php echo html_entity_decode($page_content); ?>

           
        </div>

    </section>

</main>

 <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>
	
</body>
	
</html>
