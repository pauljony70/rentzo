<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>CCAVENUE - </title>

	<style>
		.loader-container {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		.loader {
			border: 16px solid #f3f3f3;
			border-top: 16px solid #3498db;
			border-radius: 50%;
			width: 120px;
			height: 120px;
			animation: spin 2s linear infinite;
		}

		@keyframes spin {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}
	</style>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">

		<?php if (!empty($data['order_id'])) : ?>
			<div class="loader-container">
				<div class="loader"></div>
			</div>
		<?php endif; ?>

		<div class="row" style="height:0px !important; min-height:0px !important; width:0; padding:0">
			<div class="col-md-12" style="height:0px !important; min-height:0px !important; width:0; padding:0">
				<form method="post" name="ccavenue_checkout" action="https://www.marurang.in/API/index.php/app/ccavenue/save" style="height:0px !important; width:0; padding:0">

					<table width="40%" height="100" align="center" class="table" style="border:1px solid blue; height:0px !important; width:0;">

						<input type="hidden" name="tid" id="tid" value="<?= rand(10000000000, 99999999999); ?>" />
						<input type="hidden" name="merchant_id" value="2153910" readonly />
						<input type="hidden" name="order_id" id="order_id" value="<?= $data['order_id'] ?>" />
						<input type="hidden" name="amount" id="amount" value="<?= $data['amount'] ?>" />
						<input type="hidden" name="currency" id="currency" value="INR" />
						<input type="hidden" name="redirect_url" value="https://www.marurang.in/API/index.php/app/ccavenue/redirect" />
						<input type="hidden" name="cancel_url" value="https://www.marurang.in/API/index.php/app/ccavenue/cancel" />
						<input type="hidden" name="language" value="EN" />
						<input type="hidden" name="billing_name" value="<?= $data['billing_name'] ?>" />
						<input type="hidden" name="billing_address" value="<?= $data['billing_address'] ?>" />
						<input type="hidden" name="billing_city" value="<?= $data['billing_city'] ?>" />
						<input type="hidden" name="billing_state" value="<?= $data['billing_state'] ?>" />
						<input type="hidden" name="billing_zip" value="<?= $data['billing_zip'] ?>" />
						<input type="hidden" name="billing_country" value="India" />
						<input type="hidden" name="billing_tel" value="<?= $data['billing_tel'] ?>" />
						<input type="hidden" name="billing_email" value="<?= $data['billing_email'] ?>" />
						<input type="hidden" name="delivery_name" id="delivery_name" value="<?= $data['delivery_name'] ?>" />
						<input type="hidden" name="delivery_address" id="delivery_address" value="<?= $data['delivery_address'] ?>" />
						<input type="hidden" name="delivery_city" id="delivery_city" value="<?= $data['delivery_city'] ?>" />
						<input type="hidden" name="delivery_state" id="delivery_state" value="<?= $data['delivery_state'] ?>" />
						<input type="hidden" name="delivery_zip" id="delivery_zip" value="<?= $data['delivery_zip'] ?>" />
						<input type="hidden" name="delivery_country" id="delivery_country" value="India" />
						<input type="hidden" name="delivery_tel" id="delivery_tel" value="<?= $data['delivery_tel'] ?>" />
						<input TYPE="submit" id="proceed_to_payment" value="Proceed to payment" style="visibility:hidden;height:0px !important; padding:0; width:0; margin:0; border:0">

					</table>
				</form>
			</div>
		</div>
	</div>
</body>
<script>
	window.onload = function() {
		if (document.getElementById('order_id').value !== '') {
			setTimeout(function() {
				document.forms['ccavenue_checkout'].submit();
			}, 1500);
		}
	}
</script>

</html>