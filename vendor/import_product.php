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
					<button type="submit" onclick="back_page('manage_product.php')" id="back_btn" class="btn  btn-default" style="margin-right:10px; margin-top:-4px;"><i class="fa fa-arrow-left"></i> Back</button>

					<span><b>Import New Product :</b></span>
				</h4>

				<div class="form-three widget-shadow">
					<form class="form-horizontal" id="myform" action="import_product_process.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="code" value="<?php echo $code_ajax; ?>" />
						<h4><b>How To Process</b></h4><br>
						<div style="color:#000;">
							<p><span style="color:red">Step 1 :</span> Download Category Excel Sheet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_category.php" class="btn btn-primary"><i class="dwn"></i><i class="fa fa-download"></i> Download Category</a></p><br>
							<p><span style="color:red">Step 2 :</span> Download Brand Excel Sheet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_brand.php" class="btn btn-success"><i class="dwn"></i><i class="fa fa-download"></i> Download Brand</a></p><br>
							<p><span style="color:red">Step 3 :</span> Download Attributes Excel Sheet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_attribute.php" class="btn btn-danger"><i class="dwn"></i><i class="fa fa-download"></i> Download Attributes</a></p><br>
							<p><span style="color:red">Step 4 :</span> Download Attribute Set Excel Sheet &nbsp;&nbsp;<a href="export_attribute_set.php" class="btn btn-warning"><i class="dwn"></i><i class="fa fa-download"></i> Download Attribute Set</a></p><br>
							<p><span style="color:red">Step 5 :</span> Download Product Type Excel Sheet &nbsp;&nbsp;<a href="export_product_type.php" class="btn btn-info"><i class="dwn"></i><i class="fa fa-download"></i> Download Product Type</a></p><br>
							<p><span style="color:red">Step 6 :</span> Download Tax Excel Sheet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_tax.php" class="btn btn-success"><i class="dwn"></i><i class="fa fa-download"></i> Download Tax Type</a></p><br>
							<p><span style="color:red">Step 7 :</span> Download Return Policy Excel Sheet &nbsp;&nbsp;<a href="export_product_return_policy.php" class="btn btn-primary"><i class="dwn"></i><i class="fa fa-download"></i> Download Return Policy</a></p><br>
							<p><span style="color:red">Step 8 :</span> Download Product Excel Sheet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-warning" href="javascript:void(0)" id="download_product"><i class="fa fa-download"></i> Download Sample File</button></p><br>
							<p style="font-size:12px;">"Now it's time to prepare product excel sheet to bulk upload products. Open product excel sheet which you downloaded in step 8 & remove dummy data. Now carefully fill new product details & other details like category name, brand name, etc. All names should be same & casesensitive for example category name, brand name . If you write incorrect names in excel sheet & upload it then system will show invalid records.Once you done with adding new product details in excel sheet, please upload it on <b>Step 9<b>."</p>
						</div> <br><br>


						<div class="form-group">


							<label for="exampleInputFile" class="col-sm-3"><span style="color:red">Step 9 :</span> Upload New Product File </label>

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
							<!-- <button type="submit" class="btn btn-warning" href="javascript:void(0)" id="download_product"><i class="fa fa-download"></i> Download Sample File</button>-->
						</div>


					</form>
				</div>

			</div>
		</div>


		<div class="clearfix"> </div>

	</div>


	<div class="col_1">
	
	
		<div class="clearfix"> </div>
	
	</div>

</div>


<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->