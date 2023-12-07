<!DOCTYPE html>
<html lang="en">
<?php
// echo "<pre>";
// print_r($order_details);
// exit;
?>

<head>
	<?php $title = "Track Order";
	include("include/headTag.php") ?>
	<!-- Plugin Css -->
	<link rel="stylesheet" href="<?= base_url('assets_web/libs/dropify/dist/css/dropify.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/order-details.css') ?>">
</head>
<style>

</style>

<body>
	<?php include("include/loader.php"); ?>
	<?php include("include/navbar-brand.php"); ?>

	<main class="order-details-page">
		<input type="hidden" name="seller_id" id="seller_id" value="<?= $order_details['product_details'][0]['vendor_id'] ?>">
		<input type="hidden" name="order_id" id="order_id" value="<?= $order_details['order_summery']['order_id'] ?>">
		<input type="hidden" name="prod_id" id="prod_id" value="<?= $order_details['product_details'][0]['prod_id'] ?>">

		<div class="offcanvas offcanvas-end p-4" tabindex="-1" id="chatOffcanvas" aria-labelledby="chatOffcanvasLabel">
			<div class="offcanvas-header">
				<div class="d-flex align-items-center">
					<div class="d-flex align-items-center justify-content-center profile-img">
						<img src="<?= base_url('assets_web/images/icons/user.svg') ?>" alt="Seller name" srcset="">
					</div>
					<div class="seller-name text-light ms-2 line-clamp-1">Seller Name</div>
				</div>



				<a target="_blank" onclick="video_call('<?= $order_details['shipping_address']['email']; ?>')" href="<?= base_url(); ?>video?appid=2c35bc66b7364b47aefe72415b2f8cd3&channel=rentzo&token=">
					<img src="<?= base_url('assets_web/images/icons/add-call.svg') ?>" alt="Call" srcset="">
				</a>
			</div>
			<div class="offcanvas-body px-0" id="messageContainer"></div>
			<div class="offcanvas-footer px-0 pb-0">
				<form action="#" method="post" id="send-message-form">
					<div class="input-group">
						<img src="<?= base_url('assets_web/images/icons/emoji-pen.svg') ?>" class="ps-2" alt="Pen">
						<input type="text" class="form-control" autocomplete="off" id="message" name="message" value="" placeholder="Enter Message">
						<button type="submit" class="btn pe-2" id="send-message-btn" disabled>
							<img src="<?= base_url('assets_web/images/icons/send-message.svg') ?>" class="pe-0" alt="Send">
						</button>
					</div>
				</form>
			</div>
		</div>
		<!--Start: Track Order Section -->
		<section class="my-5">
			<div class="container">
				<div class="page-heading mb-3 mb-md-4">Order history</div>
				<div class="order-heading mb-4">
					<div class="d-flex justify-content-between">
						<div class="order-id">Order id 34256748</div>
						<div class="order-status">Status : on the way</div>
						<div class="order-date">order date 5-10-2023</div>
					</div>
				</div>
				<div class="row order-details mb-4">
					<div class="col-md-7 mb-4">
						<div class="row">
							<div class="col-3 position-relative">
								<img src="<?= weburl . 'media/' . $order_details['product_details'][0]['prod_img']; ?>" class="product-thumb w-100" alt="<?= $order_details['product_details'][0]['prod_name']; ?>" />
								<div class="order-type order-type-rent position-absolute top-0">
									<div class="text">Rent</div>
								</div>
							</div>
							<div class="col-9">
								<div class="product-name mb-3 mb-md-4"><?= $order_details['product_details'][0]['prod_name']; ?></div>
								<table class="price-details">
									<tbody>
										<tr>
											<td class="text-start">Rent Price</td>
											<td class="text-end"><?= price_format(500) ?></td>
										</tr>
										<tr>
											<td class="text-start">Quantity</td>
											<td class="text-end">1</td>
										</tr>
										<tr>
											<td class="text-start">Total days</td>
											<td class="text-end">3</td>
										</tr>
									</tbody>
								</table>
								<table class="order-tracking-details">
									<tbody>
										<tr>
											<td class="text-start">Order Delivered</td>
											<td class="text-end">18-10-2023</td>
										</tr>
										<tr>
											<td class="text-start">Order Returned</td>
											<td class="text-end">21-10-2023</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="shipping-address mb-4">
							<div class="div-heading mb-3">Shipping to this Address</div>
							<div class="user-name mb-3"><?= $order_details['shipping_address']['fullname']; ?></div>
							<div class="location mb-1"><?= $order_details['shipping_address']['fulladdress']; ?></div>
							<div class="location"><?= $order_details['shipping_address']['city']; ?>, <?= $order_details['shipping_address']['state']; ?>, India, <?= $order_details['shipping_address']['pincode']; ?></div>
							<div class="contact d-flex">
								<div class="heading">Email -&nbsp;</div>
								<div class="des"><?= $order_details['shipping_address']['email']; ?></div>
							</div>
							<div class="contact d-flex">
								<div class="heading">Mobile -&nbsp;</div>
								<div class="des"><?= $order_details['shipping_address']['mobile']; ?></div>
							</div>
						</div>
						<div class="seller-address">
							<div class="heading mb-3">Seller Address</div>
							<div class="d-flex align-items-center justify-content-between">
								<div class="address"><?= $order_details['product_details'][0]['seller_address'] ?>, <?= $order_details['product_details'][0]['seller_city'] ?>, <?= $order_details['product_details'][0]['seller_state'] ?>, India, <?= $order_details['product_details'][0]['seller_pincode'] ?></div>
								<div class="seller-chat position-relative">
									<button class="btn text-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#chatOffcanvas" aria-controls="chatOffcanvas">
										Talk to seller
									</button>
									<div id="unseen-message-count"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="payment-details mb-3 mb-md-4">
					<div class="heading">Payment Details</div>
					<div class="payment-details-div">
						<div class="d-flex justify-content-between w-100 mb-3">
							<div>Price</div>
							<div>For 3 Days</div>
							<div><?= price_format(1500) ?></div>
						</div>
						<div class="d-flex justify-content-between w-100 mb-3">
							<div>Security Deposited <span class="text-primary">(Refundable)</span></div>
							<div class="text-primary"><?= price_format(1500) ?></div>
						</div>
						<div class="d-flex justify-content-between w-100 mb-3">
							<div>Total</div>
							<div class="fw-semibold"><?= price_format(1500) ?></div>
						</div>
						<div class="d-flex justify-content-between w-100">
							<div>Payment Mode</div>
							<div class="fw-semibold">UPI</div>
						</div>
					</div>
				</div>
				<div class="action-btns mb-4 mb-md-5">
					<div class="d-flex justify-content-between">
						<a href="#review-section" class="btn" data-bs-toggle="collapse" data-bs-target="#review-section" aria-expanded="false" aria-controls="review-section">Write Review</a>
						<button type="button" class="btn" onclick="cancel_order('<?= $order_details['product_details'][0]['prod_id']; ?>','<?= $order_details['order_summery']['order_id']; ?>')">Cancel Order</button>
					</div>
				</div>
				<section id="review-section" class="collapse">
					<div class="row">
						<div class="col-lg-9">
							<form id="review_form" class="form">
								<div class="mb-3">
									<div class="form-floating">
										<input type="text" class="form-control" name="reviewtitle" id="reviewtitle" placeholder="Review title" />
										<label for="log_mobileno">Review title</label>
										<span id="error"></span>
									</div>
								</div>
								<div class="mb-3">
									<div class="form-floating">
										<textarea class="form-control" name="ProductReview" id="ProductReview" rows="10" placeholder="Please write your Review"></textarea>
										<label class="form-label">Please write your Review</label>
										<span id="error"></span>
									</div>
								</div>
								<div class="row">
									<div class="col-6 col-md-3">
										<div class="mb-3">
											<input type="file" name="review-image" id="review-image" class="dropify" data-height="102" data-max-file-size="5m" data-allowed-file-extensions="jpg png" />
											<span id="error"></span>
										</div>
									</div>
									<div class="col-6 col-md-3">
										<div class="mb-3">
											<input type="file" name="review-image" id="review-image" class="dropify" data-height="102" data-max-file-size="5m" data-allowed-file-extensions="jpg png" />
											<span id="error"></span>
										</div>
									</div>
									<div class="col-6 col-md-3">
										<div class="mb-3">
											<input type="file" name="review-image" id="review-image" class="dropify" data-height="102" data-max-file-size="5m" data-allowed-file-extensions="jpg png" />
											<span id="error"></span>
										</div>
									</div>
									<div class="col-6 col-md-3">
										<div class="mb-3">
											<input type="file" name="review-image" id="review-image" class="dropify" data-height="102" data-max-file-size="5m" data-allowed-file-extensions="jpg png" />
											<span id="error"></span>
										</div>
									</div>
								</div>
								<div class="mb-4 d-flex">
									<div class="rating_star">
										<input value="5" name="star-radio" id="star-1" type="radio">
										<label for="star-1">
											<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
											</svg>
										</label>
										<input value="4" name="star-radio" id="star-2" type="radio">
										<label for="star-2">
											<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
											</svg>
										</label>
										<input value="3" name="star-radio" id="star-3" type="radio">
										<label for="star-3">
											<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
											</svg>
										</label>
										<input value="2" name="star-radio" id="star-4" type="radio">
										<label for="star-4">
											<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
											</svg>
										</label>
										<input value="1" name="star-radio" id="star-5" type="radio">
										<label for="star-5">
											<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" pathLength="360"></path>
											</svg>
										</label>
									</div>
								</div>
								<button class="btn btn-primary" type="submit">SUBMIT</button>
							</form>
						</div>
					</div>
				</section>
			</div>
		</section>
		<!--End: Track Order Section -->

	</main>

	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>
	<!-- Plugin JS -->
	<script src="<?php echo base_url(); ?>assets_web/libs/dropify/dist/js/dropify.min.js"></script>

	<script src="<?= base_url('assets_web/js/app/order-details.js') ?>"></script>

</body>

</html>