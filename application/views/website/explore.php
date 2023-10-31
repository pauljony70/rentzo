<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Explore Page";
    include("include/headTag.php") ?>
</head>
<?php 
	$web_url = str_replace('-430-590','',$exolore_category[0]['web_banner']); 
?>
<style>
.top-banner {
	background-image : url('<?php echo MEDIA_URL.$web_url; ?>');
	background-size: contain;
    background-repeat: no-repeat;
    background-position: center center;
}
</style>
<body>

	<?php
        include("include/topbar.php")
        ?>
        <?php
        include("include/navbar.php")
        ?>
	
<main class="explore-page">
	
	<!--Start: Explore Page Section -->
	<?php  //print_r($exolore_category); ?>
	<section>
		<div class="top-banner">
			<!--<h5><span>SALE</span> GET UPTO 60% OFF*</h5>-->
		</div>
		<div class="container">
			<div class="header-wrap">
				<h4><?php echo $exolore_category[0]['cat_name']; ?></h4>
			</div>
			<div class="row">
				<?php  foreach ($exolore_category as $exolore_category_data) { ?>
				<?php  foreach ($exolore_category_data['subcat_1'] as $exolore_subcategory_data) {  ?>
				<div class="col-md-6">
					<div class="media">
						<div class="zoom-img rounded-0">
						<a href="<?php echo base_url.'explore_sub/'.$exolore_subcategory_data['cat_id'] ?>"><img src="<?php echo MEDIA_URL.$exolore_subcategory_data['imgurl'] ?>" class="explore-img" /></a>
						</div>
						<div class="media-body">
							<h6 onclick="redirect_to_link('<?php echo base_url.'explore_sub/'.$exolore_subcategory_data['cat_id'] ?>')"><?php echo $exolore_subcategory_data['cat_name'] ?></h6>
						</div>
					</div>
				</div>
				<?php }} ?>
				
			</div>
			
			<div class="trending-section">
				<div class="row">
					<?php foreach($exolore_category_product as $exolore_category_product_data) { ?>
					<div class="col-lg-3 col-md-4 col-6">
						<!--Block-->
						<div class="card">
							<div onclick="redirect_to_link('<?php echo base_url.$exolore_category_product_data['sku'].'?pid='.$exolore_category_product_data['id'].'&sku='.$exolore_category_product_data['sku'].'&sid='.$exolore_category_product_data['vendor_id']; ?>')" class="card-img zoom-img">
								<img src="<?php echo MEDIA_URL.$exolore_category_product_data['imgurl']; ?>" class="card-img-top" alt="..." />
							</div>
							<div class="favorite"><a href="javascript:void(0);" onclick="add_to_wishlist(event,'<?php echo $exolore_category_product_data['id'] ?>','<?php echo $exolore_category_product_data['sku'] ?>','<?php echo $exolore_category_product_data['vendor_id'] ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2)"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.08109 12.7492L10.4543 18.7362C10.6465 18.9167 10.7425 19.0069 10.852 19.0412C10.9492 19.0716 11.0534 19.0716 11.1507 19.0412C11.2601 19.0069 11.3561 18.9167 11.5483 18.7362L17.9215 12.7492C19.7147 11.0647 19.9324 8.29271 18.4243 6.34889L18.1407 5.98339C16.3366 3.65802 12.7151 4.048 11.4474 6.70417C11.2683 7.07937 10.7343 7.07937 10.5552 6.70417C9.28748 4.048 5.66605 3.65802 3.86189 5.98339L3.57831 6.34888C2.07017 8.29271 2.28793 11.0647 4.08109 12.7492Z" stroke=""/></svg></a></div>
						  <div class="card-body">
							<h6 class="pd-title" onclick="redirect_to_link('<?php echo base_url.$exolore_category_product_data['sku'].'?pid='.$exolore_category_product_data['id'].'&sku='.$exolore_category_product_data['sku'].'&sid='.$exolore_category_product_data['vendor_id']; ?>')"><?php echo $exolore_category_product_data['name']; ?></h6>
							<h6 class="price-off text-danger"><?php if($exolore_category_product_data['totaloff'] != 0) { echo $exolore_category_product_data['offpercent']; } ?></h6>
							
							<div class="row">
								<div class="col-6">
									<h6 class="old-price"><?php echo $exolore_category_product_data['mrp']; ?></h6>
									<h5 class="new-price"><?php echo $exolore_category_product_data['price']; ?></h5>
								</div>
								<div class="col-6">
									<div class="btn-by-now">
										<a href="https://api.whatsapp.com/send?phone=<?php echo '%2B91'.$exolore_category_product_data['seller_mobile'].'&text=hi';  ?>"  class="btn btn-success w-100">
											<svg viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2.6625 8.91875C3.35 9.33125 4.175 9.5375 5 9.5375C7.54375 9.5375 9.5375 7.475 9.5375 5.06875C9.5375 3.83125 9.12501 2.73125 8.23126 1.8375C7.33751 1.0125 6.2375 0.53125 5 0.53125C2.525 0.53125 0.462496 2.59375 0.462496 5.06875C0.462496 5.89375 0.668748 6.71875 1.15 7.475L1.2875 7.68125L0.806246 9.33125L2.525 8.85L2.6625 8.91875ZM6.51251 5.6875C6.65001 5.6875 7.33751 6.03125 7.475 6.1C7.49642 6.1107 7.51783 6.11974 7.53897 6.12867C7.65366 6.17708 7.76071 6.22227 7.81875 6.5125C7.8875 6.5125 7.8875 6.7875 7.75 7.13125C7.68125 7.40625 7.13126 7.75 6.85626 7.75C6.80966 7.75 6.76505 7.75394 6.71739 7.75816C6.48374 7.77883 6.17698 7.80597 5.20624 7.40625C4.00142 6.92432 3.1661 5.75619 2.93154 5.42817C2.8984 5.38183 2.87725 5.35226 2.86875 5.34375C2.85704 5.32034 2.83337 5.28298 2.80216 5.2337C2.65007 4.99355 2.31875 4.47044 2.31875 3.9C2.31875 3.2125 2.66249 2.86875 2.79999 2.73125C2.93749 2.59375 3.07499 2.59375 3.14374 2.59375H3.41876C3.48751 2.59375 3.625 2.59375 3.69375 2.8C3.83125 3.075 4.10626 3.7625 4.10626 3.83125C4.10626 3.85417 4.1139 3.87708 4.12153 3.9C4.13681 3.94583 4.15209 3.99167 4.10626 4.0375C4.07188 4.07187 4.05469 4.10625 4.0375 4.14062C4.02032 4.175 4.00313 4.20938 3.96875 4.24375L3.76251 4.45C3.69376 4.51875 3.625 4.5875 3.69375 4.725C3.7625 4.8625 4.03751 5.34375 4.45001 5.6875C4.91415 6.09362 5.28035 6.25494 5.46602 6.33673C5.50036 6.35186 5.52853 6.36427 5.54999 6.375C5.68749 6.375 5.75626 6.375 5.82501 6.30625C5.85939 6.2375 5.94532 6.13438 6.03125 6.03125C6.11718 5.92812 6.20311 5.825 6.23749 5.75625C6.30624 5.61875 6.37501 5.61875 6.51251 5.6875Z" fill="white"/></svg>
											<span>WhatsApp</span>
										</a>
									</div>
								</div>
							</div>
						  </div>
						</div>
						<!--/*Block-->
					</div>
					<?php } ?>
					
				</div>
			</div>
			
		</div>
	</section>
	<!--End: Explore Page Section -->

</main>

 <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>
	
</body>
	
</html>
