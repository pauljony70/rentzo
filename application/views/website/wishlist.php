<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Wishlist";
	include("include/headTag.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/wishlist.css') ?>">
</head>

<body>


	<?php include("include/loader.php"); ?>
	<?php include("include/topbar.php") ?>
	<?php include("include/navbar.php") ?>

	<main class="wishlist-page my-5">
		<?php // print_r($wishlist); 
		?>
		<!--Start: Wishlist Section -->
		<section>
			<div class="container">

				<div class="page-heading mb-4">My Wishlist (<?= $wishlist['total_item']; ?>)</div>

				<?php if (!empty($wishlist['cart_full'])) { ?>
					<div class="row">
						<?php foreach ($wishlist['cart_full'] as $wishlist_product) { ?>
							<div class="col-6 col-sm-4 col-lg-3 mb-3">
								<a href="<?= base_url($wishlist_product['web_url'] . '?pid=' . $wishlist_product['prodid'] . '&sku=' . $wishlist_product['sku'] . '&sid=' . $wishlist_product['vendor_id']) ?>" class="d-flex flex-column card wishlist-card rounded-1 h-100">
									<img src="<?= base_url('media/' . $wishlist_product['imgurl']) ?>" class="card-img-top product-card-img" alt="<?= $wishlist_product['name'] ?>">
									<button type="button" class="btn">
										<div class="d-flex align-items-center justify-content-center">
											<img src="<?= base_url('assets_web/images/icons/cart-white.svg') ?>" alt="Cart" srcset="">
											<span class="btn-text ms-2">Add to cart</span>
										</div>
									</button>
									<div class="card-body d-flex flex-column product-card-body">
										<h5 class="card-title product-title line-clamp-2 mb-2"><?= $wishlist_product['name'] ?></h5>
										<div class="card-text d-flex justify-content-between mt-auto py-1">
											<div class="rent-price text-primary"><?= $wishlist_product['day1_price'] ?>/day</div>
											<div class="buy-price">Price <?= $wishlist_product['price'] ?> </div>
										</div>
									</div>
								</a>
							</div>
						<?php } ?>
					</div>
				<?php } else { ?>
					<div class="cart-details card box-shadow-4 my-3 py-2">
						<img src="<?php base_url ?>assets_web/images/empty-cart.png" alt="">
					</div>
				<?php } ?>

			</div>
		</section>
		<!--End: Wishlist Section -->

	</main>

	<?php
	include("include/footer.php")
	?>

	<?php
	include("include/script.php")
	?>
	<script>
		var csrfName = $('.txt_csrfname').attr('name'); // 
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		var site_url = $('.site_url').val(); // CSRF hash


		function delete_wishlist(prod_id, user_id) {
			$.ajax({
				method: 'post',
				url: site_url + 'deleteProductWishlist',
				data: {
					language: 1,
					pid: prod_id,
					user_id: user_id,
					devicetype: 2,
					[csrfName]: csrfHash
				},
				success: function(response) {
					//hideloader();
					location.reload();
				}
			});
		}


		function add_to_cart_product(pid, sku, vendor_id, user_id, qty, referid, devicetype, qouteid) {
			event.preventDefault();
			$.ajax({
				method: 'post',
				url: site_url + 'addProductCart',
				data: {
					language: 1,
					pid: pid,
					sku: sku,
					sid: vendor_id,
					user_id: user_id,
					qty: qty,
					referid: referid,
					devicetype: 2,
					qouteid: qouteid,
					[csrfName]: csrfHash
				},
				success: function(response) {
					//alert(response.msg);Cart added
					Swal.fire({
						position: "center",
						icon: "success",
						title: response.msg,
						showConfirmButton: false,
						confirmButtonColor: '#ff5400',
						confirmButtonText: 'View Cart',
						timer: 3000
					});
					if (response.msg == 'Cart added') {
						addto_cart_count();
						delete_wishlist(pid, user_id);
					}


					//delete_wishlist(pid,user_id);


				}
			});
		}
	</script>

</body>

</html>