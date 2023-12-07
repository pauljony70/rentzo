<!DOCTYPE html>
<html lang="en">

<head>
	<?php $title = $this->lang->line('my-orders');
	include("include/headTag.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets_web/style/css/order.css') ?>">
</head>

<body>
	<?php include("include/navbar-brand.php") ?>
	<main class="my-order-page">

		<!--Start: My Orders Section -->
		<section class="my-5">
			<div class="container px-1">
				<?php if (!empty($order)) { ?>
					<div class="orders-container">
						<div class="order-details">
							<?php foreach ($order as $key => $order_history) { ?>
								<a href="<?= base_url('orderDetails/' . $order_history['order_id'] . '/' . $order_history['prod_id']) ?>" class="row mb-3">
									<div class="col-2">
										<div class="order-type order-type-<?= $order_history['type'] === 'Rent' ? 'rent' : 'purchase' ?>">
											<div class="text"><?= !empty($order_history['type']) ? $order_history['type'] : 'Purchase' ?></div>
										</div>
									</div>
									<div class="col-10">
										<div class="d-flex justify-content-between p-3 pe-5">
											<div class="order-id">Order id #<?= $order_history['order_id']; ?></div>
											<div class="order-date"><?= date('d-m-Y', strtotime($order_history['create_date'])); ?></div>
										</div>
										<hr class="my-0">
									</div>
									<div class="col-3">
										<div>
											<img src=" <?= weburl . 'media/' . $order_history['prod_img']; ?>" class="w-100 prod-img ps-3" />
										</div>
									</div>
									<div class="col-9">
										<div class="row h-100 pe-4">
											<div class="col-md-5">
												<div class="d-flex flex-column h-100">
													<div class="prod-name line-clamp-2 mb-3"><?= $order_history['prod_name']; ?></div>
													<?php if (!empty($order_history['prod_attr'])) : ?>
														<table class="attributes mb-3">
															<tbody>
																<?php foreach (json_decode($order_history['prod_attr']) as $prod_attr) : ?>
																	<tr>
																		<td class="attr-name"><?= $prod_attr->attr_name ?></td>
																		<?php if ($prod_attr->attr_name == 'Color') :
																			$rgb = hexToRgb($prod_attr->item);
																			$dark_color = "rgb(" . $rgb['r'] * 0.8 . "," . $rgb['g'] * 0.8 . ',' . $rgb['b'] * 0.8 . ")";
																		endif; ?>
																		<td>
																			<div class="d-flex align-items-center">
																				<label for="" <?= $prod_attr->attr_name == 'Color' ? 'style="background-color:' . $prod_attr->item . '; border: 1px solid ' . $dark_color . '"' : '' ?> class="attr-des ms-3 ms-md-5" id="<?= $prod_attr->attr_name ?>">
																					<?= $prod_attr->attr_name != 'Color' ? $prod_attr->item : '' ?>
																				</label>
																			</div>
																		</td>
																	</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
													<?php endif; ?>
													<div class="mt-auto">
														<div class=" order-status-div mb-4">Status: <span class="ms-3"><?= $order_history['prod_status'] ?></span></div>
													</div>
												</div>
											</div>
											<div class="col-md-3 dates-div">
												<div class="text-end mt-4">
													<?php if ($order_history['type'] === 'Rent') : ?>
														<div class="text mb-2">Rent for <?= $order_history['duration_in_days'] ?> Days</div>
														<div class="text"><?= date('d M Y', strtotime($order_history['rent_from_date'])) . ' to ' . date('d M Y', strtotime($order_history['rent_to_date'])) ?></div>
													<?php else : ?>
														<div class="text">Ordered on <?= date('d M Y', strtotime($order_history['create_date'])) ?></div>
													<?php endif; ?>
												</div>
											</div>
											<div class="col-md-4 ps-md-5 review-div text-center">
												<div class="d-flex flex-column h-100">
													<div class="text ps-md-4 mb-3">Experience with the product</div>
													<div class="d-flex justify-content-center ps-md-4 stars">
														<?php for ($i = 0; $i < 5; $i++) : ?>
															<img src="<?= base_url('assets_web/images/icons/half-star-big.svg') ?>" alt="Star" srcset="">
														<?php endfor; ?>
													</div>
													<div class="mt-auto ps-md-4">
														<button type="button" href="#" class="btn review-btn">Write Review</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
								<?= $key !== count($order) - 1 ? '<hr class="my-0 underline">' : '' ?>
							<?php } ?>
						</div>
					</div>
				<?php } else { ?>
					<div class="d-flex flex-column align-items-center empty-order-image">
						<img src="<?= base_url('assets_web/images/empty-cart.png') ?>" class="mb-5" alt="Empty Order">
						<div class="heading mb-2">Your orders section is Empty</div>
						<div class="des mb-4">Looks like you haven’t ordered anything yet</div>
						<a href="<?= base_url() ?>" class="btn btn-primary">Go Shop</a>
					</div>
				<?php } ?>
			</div>
		</section>
		<!--End: My Orders Section -->

	</main>

	<?php include("include/footer.php") ?>
	<?php include("include/script.php") ?>

	<script>
		function cancel_order(pid, order_id) {

			Swal.fire({
				position: "center",
				title: 'Are you Sure to Cancelled Order?',
				showConfirmButton: true,
				showCancelButton: true,
				confirmButtonText: 'Confirm',
				cancelButtonText: 'Cancel',
				confirmButtonColor: '#f42525'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						method: 'post',
						url: site_url + 'cancelOrder',
						data: {
							language: 1,
							pid: pid,
							order_id: order_id,
							[csrfName]: csrfHash
						},
						success: function(response) {

							location.reload();
						}
					});

				}
			})

		}
	</script>
</body>

</html>