<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Personal Information";
	include("include/headTag.php") ?>
</head>

<body>

	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php")
	?>

	<main class="personal-info new-address my-order-page cart-page">

		<!--Start: Personal Information Section -->
		<section>
			<div class="container px-1" style="max-width:1344px;">
				<div class="row mt-4">
					<?php
						include("include/sidebar.php");
					?>
					<div class="col-lg-8 mt-1">
						<div class="left-block box-shadow-4" id="MyProfile">
							<h5 class="title">Personal Information
								<span class="d-lg-none">
									<a class="accordion-button collapsed" id="heading1" data-bs-toggle="collapse" 
									data-bs-target="#collapse1" aria-expanded="<?php if($_SERVER['REQUEST_URI'] == '/personal_info') echo"true"; else echo"false"; ?>" 
									aria-controls="collapse1">My Profile</a>
								</span>
							</h5>

							<?php
							include("include/mobile_sidebar.php");
							?>

							<form class="form row g-3">
								<div class="col-md-7">
									<label class="form-label"><?= $this->lang->line('fullname'); ?></label>
									<input type="text" class="form-control" placeholder="Name" value="<?php echo $this->session->userdata("user_name") ?>" disabled />
								</div>
								<div class="col-md-7">
									<label class="form-label"><?= $this->lang->line('email-address'); ?></label>
									<input type="email" class="form-control" placeholder="Email" value="<?php echo $this->session->userdata("user_email") ?>" disabled />
								</div>
								<div class="col-md-7">
									<label class="form-label"><?= $this->lang->line('phone-number'); ?></label>
									<input type="text" class="form-control" placeholder="Phone no" value="+91-<?php echo $this->session->userdata("user_phone") ?>" disabled />
								</div>
							</form>

						</div>
					</div>

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