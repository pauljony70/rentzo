<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>
<style>
	.switch {
		position: relative;
		display: block;
		vertical-align: top;
		width: 86px;
		height: 30px;
		padding: 3px;
		margin: 0 10px 10px 0;
		background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
		background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
		border-radius: 18px;
		box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
		cursor: pointer;
		box-sizing: content-box;
	}

	.switch-input {
		position: absolute;
		top: 0;
		left: 0;
		opacity: 0;
		box-sizing: content-box;
	}

	.switch-label {
		position: relative;
		display: block;
		height: inherit;
		font-size: 10px;
		text-transform: uppercase;
		background: #eceeef;
		border-radius: inherit;
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
		box-sizing: content-box;
	}

	.switch-label:before,
	.switch-label:after {
		position: absolute;
		top: 50%;
		margin-top: -.5em;
		line-height: 1;
		-webkit-transition: inherit;
		-moz-transition: inherit;
		-o-transition: inherit;
		transition: inherit;
		box-sizing: content-box;
	}

	.switch-label:before {
		content: attr(data-off);
		right: 11px;
		color: #aaaaaa;
		text-shadow: 0 1px rgba(255, 255, 255, 0.5);
	}

	.switch-label:after {
		content: attr(data-on);
		left: 11px;
		color: #FFFFFF;
		text-shadow: 0 1px rgba(0, 0, 0, 0.2);
		opacity: 0;
	}

	.switch-input:checked~.switch-label {
		background: #E1B42B;
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
	}

	.switch-input:checked~.switch-label:before {
		opacity: 0;
	}

	.switch-input:checked~.switch-label:after {
		opacity: 1;
	}

	.switch-handle {
		position: absolute;
		top: 4px;
		left: 4px;
		width: 28px;
		height: 28px;
		background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
		background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
		border-radius: 100%;
		box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
	}

	.switch-handle:before {
		content: "";
		position: absolute;
		top: 50%;
		left: 50%;
		margin: -6px 0 0 -6px;
		width: 12px;
		height: 12px;
		background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
		background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
		border-radius: 6px;
		box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
	}

	.switch-input:checked~.switch-handle {
		left: 33px;
		box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
	}

	/* Transition
========================== */
	.switch-label,
	.switch-handle {
		transition: All 0.3s ease;
		-webkit-transition: All 0.3s ease;
		-moz-transition: All 0.3s ease;
		-o-transition: All 0.3s ease;
	}
</style>
<input type="hidden" value="<?php if ($_SESSION['page_nov']) {
								echo $_SESSION['page_nov'];
							} else {
								echo '1';
							} ?>" id="product_sel_page">




<div class="content-page">
	<!-- Start content -->	
	<div class="content">
		<div class="container-fluid">
			<div data-example-id="simple-form-inline">
				<!--<div class="pull-right page_div" style="float:left;display:none;"> </div>
				<div class="perpage mt-2" id="perpage_div" style="display:none;">
					<div class="pull-right col-sm-2">
						<select class="form-control" id="perpage" name="perpage" onchange="perpage_filter()" style="float:left;">
							<option value="10">10</option>
							<option value="25">25</option>
							<option value="50">50</option>
						</select>
					</div><span class="pull-right per-pag">Per Page:</span>

				</div>-->
				<div style=" display: inline-block;  vertical-align: middle">
				</div>
			</div>
			</br>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							
							<div class="work-progres">
							
							
								
								
								<form class="example">
									<label for="search_name"> Find your products in catalog</label>
									<div class="row align-items-center">
									<div class="col-md-9 mb-2">
										<div class="form-group d-flex flex-wrap">

											<input type="text" class="form-control" id="search_name" aria-describedby="emailHelp" placeholder="Product name, SKU" style="width:50%">
											<button type="submit" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" id="searchName"><i class="fa fa-search"></i></button>

								
						
										</div>
									</div>
									<div class="col-md-3 mb-2" id="perpage_div" style="display:none;">
										<div class="d-flex align-items-center">
											<div class="ml-md-auto">
												<div class="d-flex align-items-center">
													<span>Show</span>
													<select class="form-control mx-1" id="perpage" name="perpage" onchange="perpage_filter()" style="float:left;">

														<option value="10">10</option>

														<option value="25">25</option>

														<option value="50">50</option>

													</select>
													<span class="pull-right per-pag">entries</span>
												</div>
											</div>
										</div>
									</div>
									</div>
									
									

								<div class="table-responsive"><input type="hidden" id="last_cat" value="0">
									<table class="table table-hover" id="tblname" style="display:none;">
										<thead class="thead-light">
											<tr>
												<th>Sno</th>
												<th>Image</th>
												<th>ProductID</th>
												<th>Name</th>
												<th>SKU</th>
												<th>Brand</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="tbodyPostid">
											
										</tbody>
									</table>
									
								</div>
								<div class="row align-items-center">
										<div class="col-md-6">
											<div class="pull-right" style="float:left;">
												Total Row : <a id="totalrowvalue" class="totalrowvalue"></a>
											</div>
										</div>
										<div class="col-md-6">
											<div class="pull-right page_div ml-auto" style="float:right;"> </div>
										</div>
									</div>
								
								<div class="additional-links"><br>
								<small id="emailHelp" class="form-text text-muted" style="border-left:1px solid #d3d3d3;border-right:1px solid #d3d3d3;padding:20px"><a class="create-new-redirect" href="add_product.php">I'm adding a product not sold</a></small>
								<small id="emailHelp" class="form-text text-muted" style="border-right:1px solid #d3d3d3;padding:20px"><a class="create-new-redirect" href="import_product.php">I'm uploading a file to add multiple products</a></small>
							</div>
							<div class="clearfix"> <br></div>
							<div class="clearfix"> <br></div>
							<div class="clearfix"> </div>
						</form>

								<div class="clearfix"> </div>

							</div>

							<div class="col_1">

								<div class="clearfix"> </div>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>



<!--footer-->
<?php include('footernew.php'); ?>
<script src="js/admin/search-product.js"></script>
<!--//footer-->