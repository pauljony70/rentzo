<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "FAQ";
    include("include/headTag.php") ?>
	<style>
	
	.faq-heading{
		border-bottom: #777;
		padding: 20px 60px;
	}
	.faq-container{
		display: flex;
		justify-content: center;
		flex-direction: column;

	}
	.hr-line{
	  width: 100%;
	  margin: auto;
	  
	}
	.faq-page {
		/* background-color: #eee; */
		color: #444;
		cursor: pointer;
		padding: 10px;
		border: none;
		outline: none;
		transition: 0.4s;
		margin: auto;

	}
	.faq-body{
		margin: auto;
		/* text-align: center; */
	   width: 95%; 
	   padding: auto;
	   
	}


	/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
	.faq-container .active,
	.faq-page:hover {
		background-color: #F9F9F9;
	}

	/* Style the faq-page panel. Note: hidden by default */
	.faq-body {
		padding: 5px 18px;
		background-color: white;
		display: none;
		overflow: hidden;
	}

	.faq-page:after {
		content: '\02795';
		/* Unicode character for "plus" sign (+) */
		font-size: 13px;
		color: #777;
		float: right;
		margin-left: 5px;
		margin-top: 7px;
	}

	.faq-container .active:after {
		content: "\2796";
		/* Unicode character for "minus" sign (-) */
	}
	
	.form-container {
		background: #f1ecdf;
		border: #e2ddd2 1px solid;
		padding: 20px;
		border-radius: 2px;
	}

	.input-row {
		margin-bottom: 20px;
	}

	.input-row label {
		color: #75726c;
	}

	.input-field {
		width: 100%;
		border-radius: 2px;
		padding: 10px;
		border: #e0dfdf 1px solid;
		box-sizing: border-box;
		margin-top: 2px;
	}

	.span-field {
		font: Arial;
		font-size: small;
		text-decoration: none;
	}

	.btn-submit {
		padding: 10px 60px;
		background: #9e9a91;
		border: #8c8880 1px solid;
		color: #ffffff;
		font-size: 0.9em;
		border-radius: 2px;
		cursor: pointer;
	}

	.errorMessage {
		background-color: #e66262;
		border: #AA4502 1px solid;
		padding: 5px 10px;
		color: #FFFFFF;
		border-radius: 3px;
	}

	.successMessage {
		background-color: #9fd2a1;
		border: #91bf93 1px solid;
		padding: 5px 10px;
		color: #3d503d;
		border-radius: 3px;
		cursor: pointer;
		font-size: 0.9em;
	}

	.info {
		font-size: .8em;
		color: #e66262;
		letter-spacing: 2px;
		padding-left: 5px;
	}
	</style>
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
                <div class="row my-4">
                    <div class="col-8">
                        <h3 class="text-uppercase fw-bold"><?= $this->lang->line('faq') ?></h3>
                    </div>
                </div>

                <?php // echo html_entity_decode($page_content); ?>


            </div>

        </section>
		<section class="faq-container container">
			<?php foreach($faq_data as $faq) { ?>
		   <div class="faq-one">
                <!-- faq question -->
			<h5 class="faq-page"><?php echo $faq->title;?></h5>
                <!-- faq answer -->
                <div class="faq-body">
                    <p><?php echo $faq->description;?></p>
                </div>
            </div>
            <hr class="hr-line">
			<?php } ?>
            
			<p class="mt-5">For More Details Please <a href="<?= base_url('contact') ?>">Contact Us.</a></p>
			
			
		
        </section>
		

    </main>

    <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>
	<script>
		var faq = document.getElementsByClassName("faq-page");
		var i;

		for (i = 0; i < faq.length; i++) {
			faq[i].addEventListener("click", function () {
				/* Toggle between adding and removing the "active" class,
				to highlight the button that controls the panel */
				this.classList.toggle("active");

				/* Toggle between hiding and showing the active panel */
				var body = this.nextElementSibling;
				if (body.style.display === "block") {
					body.style.display = "none";
				} else {
					body.style.display = "block";
				}
			});
		}
		
		function validateContactForm() {
			var valid = true;

			$(".info").html("");
			$(".input-field").css('border', '#e0dfdf 1px solid');
			var userName = $("#userName").val();
			var userEmail = $("#userEmail").val();
			var subject = $("#subject").val();
			var content = $("#content").val();

			if (userName == "") {
				$("#userName-info").html("Required.");
				$("#userName").css('border', '#e66262 1px solid');
				valid = false;
			}
			if (userEmail == "") {
				$("#userEmail-info").html("Required.");
				$("#userEmail").css('border', '#e66262 1px solid');
				valid = false;
			}
			if (!userEmail.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
				$("#userEmail-info").html("Invalid Email Address.");
				$("#userEmail").css('border', '#e66262 1px solid');
				valid = false;
			}

			if (subject == "") {
				$("#subject-info").html("Required.");
				$("#subject").css('border', '#e66262 1px solid');
				valid = false;
			}
			if (content == "") {
				$("#userMessage-info").html("Required.");
				$("#content").css('border', '#e66262 1px solid');
				valid = false;
			}
			return valid;
		}
	</script>

</body>

</html>