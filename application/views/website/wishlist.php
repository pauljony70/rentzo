<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = "Wishlist";
	include("include/headTag.php") ?>
</head>
<style>
.my-order-page .right-block .wrap {
    border-radius: 3px;
    padding: 20px;
    margin-bottom: 15px;
}
.my-order-page .right-block .wrap .wrap-block {
    display: flex;
    flex-wrap: wrap;
    align-items: start;
}
.my-order-page .right-block .wrap .wrap-details {
    margin: 0px 20px;
}
.my-order-page .right-block .wrap h5 a, .my-order-page .right-block .wrap h6 a {
    color: #4f5362;
}
.my-order-page .left-block {
    padding: 20px;
    border-radius: 3px;
}
.my-order-page .left-block .title {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.wishlist-page .left-block .cart-details {
    align-items: unset;
}
.cart-page .left-block .card {
    border-radius: 3px;
}
.wishlist-page .cart-details {
    position: relative;
}
.cart-page .left-block .card img {
    display: block;
    margin: 0 auto;
    height: 160px;
    object-fit: contain;
}
.old-price {
		text-decoration: line-through;
		padding-bottom: 2px;
		color: #162b75;
	}
</style>
<body>


	<?php
	include("include/topbar.php")
	?>
	<?php
	include("include/navbar.php")
	?>

	<main class="wishlist-page my-order-page cart-page">
		<?php // print_r($wishlist); 
		?>
		<!--Start: Wishlist Section -->
		<section>
			<div class="container" style="max-width:1344px;">
				<div class="row mt-4">
					<?php
					include("include/sidebar.php");
					?>
					<div class="col-lg-8">
						<div class="left-block box-shadow" id="MyProfile">
							<h5 class="title"><?= $this->lang->line('my-wishlist'); ?> (<?php echo $wishlist['total_item']; ?>) <span class="d-lg-none"><a class="accordion-button collapsed" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1"><?= $this->lang->line('user-my-profile'); ?></a></span></h5>

							<?php
							include("include/mobile_sidebar.php");
							?>
							
							<?php if (!empty($wishlist['cart_full'])) { ?>
								<?php foreach ($wishlist['cart_full'] as $wishlist_product) { ?>
									<div class="cart-details card box-shadow-4 my-3 py-2">
										<div class="cart-body">
											<div class="row">
												<div class="col-4 col-md-4">
													<a href="<?php echo base_url . $wishlist_product['web_url'] . '?pid=' . $wishlist_product['prodid'] . '&sku=' . $wishlist_product['sku'] . '&sid=' . $wishlist_product['vendor_id']; ?>">
														<img width="200px" src="<?php echo weburl . 'media/' . $wishlist_product['imgurl']; ?>" class="product-thumb" />
													</a>
												</div>
												<div class="col-8 col-md-8">
													<h6 onclick="redirect_to_link('<?php echo base_url . $wishlist_product['web_url'] . '?pid=' . $wishlist_product['prodid'] . '&sku=' . $wishlist_product['sku'] . '&sid=' . $wishlist_product['vendor_id']; ?>')"><?php echo $wishlist_product['name']; ?></h6>
													<div class="col-md-12">
														<div class="wrap-details">
															<div class="rate">
																<h5 class="m-0"><?php echo $wishlist_product['price']; ?></h5>
																<div class="old-price my-1"><?php echo $wishlist_product['mrp']; ?></div>
																<div class="off-price"><?php if ($wishlist_product['totaloff'] != 0) {
																							echo $wishlist_product['offpercent'];
																						} ?></div>
																<div class="d-flex my-1">
																	<a class="d-flex border btn btn-primary p-1" onclick="add_to_cart_product('<?php echo $wishlist_product['prodid']; ?>','<?php echo $wishlist_product['sku']; ?>','<?php echo $wishlist_product['vendor_id']; ?>','<?php echo $this->session->userdata('user_id'); ?>',1,'',2,'<?php echo $this->session->userdata('qoute_id'); ?>')" href="javascript:void(0);">
																		<div class="d-flex justify-content-center align-items-center h-100">
																			<i class="fa-solid fa-cart-shopping"></i>
																			<div class="mx-2 mt-1 fw-bolder text-uppercase"><?= $this->lang->line('add-to-cart'); ?></div>
																		</div>
																	</a>
																	<a class="mx-2 p-2 border" onclick="delete_wishlist('<?php echo $wishlist_product['prodid']; ?>','<?php echo $this->session->userdata('user_id'); ?>',2)">
																		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="" class="bi bi-trash" viewBox="0 0 16 16">
																			<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
																			<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
																		</svg>
																	</a>
																</div>
															</div>
															<!-- <p>Stock : <?php echo $wishlist_product['available_stock']; ?></p> -->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							<?php } else { ?>
								<div class="cart-details card box-shadow-4 my-3 py-2">
									<img src="<?php base_url ?>assets_web/images/empty-cart.png" alt="">
								</div>
							<?php } ?>





						</div>
					</div>

				</div>
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