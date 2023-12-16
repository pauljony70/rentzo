<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>
<!-- main content start-->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

			<div class="bs-example widget-shadow" data-example-id="hoverable-table">
				<h4 style="padding: 15px; height: 4px">
					<button type="submit" onclick="back_page('manage_product.php')" id="back_btn" class="btn  btn-info" style="margin-right:10px; margin-top:-4px;"><i class="fa fa-arrow-left"></i> Back</button>

					<span><b>Update Product Inventory:</b></span>
				</h4><br>
	
				<div class="form-three widget-shadow   card card-body">
					<form class="form-horizontal" id="myform" action="import_inventory_process.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="code" value="<?php echo $code_ajax; ?>" />
						<h4><b>How To Process</b></h4><br>
						<div style="color:#000;">
							<p><span style="color:red">Step 1 :</span> Download Product Excel Sheet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-warning" href="javascript:void(0)" id="download_product_inventory"><i class="fa fa-download"></i> Download Product</button></p><br>
							<p style="font-size:12px;">Please download product excel file. now you can update the product mrp, price & quantity. once excel sheet is ready please upload it on <b>Step 2</b>.</p><br>
						</div>


						<div class="form-group">

							<label for="exampleInputFile" class="col-sm-3"><span style="color:red">Step 2 :</span> Upload New Product File</label>

							<div class="col-sm-4">
								<div class="">
									<div>
										<input type="file" name="product_file" id="featured_img" onchange="uploadFile3('featured_img')" class="form-control1" required>
									</div>

								</div>
							</div>

						</div>



						</br></br>
						<div class="col-sm-offset-4">
							<button type="submit" class="btn btn-success" href="javascript:void(0)" id="addProduct_btn">Upload</button>

						</div>


					</form>
				</div>

			</div>
		</div>


		<div class="clearfix"> </div>

	</div>





	<div class="clearfix"> </div>

</div>

<div class="col_1">


	<div class="clearfix"> </div>

</div>

<!--footer-->
<?php include('footernew.php'); ?>
<!--//footer-->

<script>
	$(document).ready(function() {
		$("#download_product_inventory").click(function(event) {
			event.preventDefault();

			location.href = "download_inventory.php?code=<?php echo $_SESSION['_token']; ?>";
		});
	});
</script>