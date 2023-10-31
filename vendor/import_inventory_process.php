<?php
include('session.php');

$code = $_POST['code'];
$code= stripslashes($code);  
$datetime = date('Y-m-d');
$msg =  '';
 if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else{
	if($code==$_SESSION['_token']){		
		
		$mand_headers = array('name','sku','mrp','price','quantity');
		
		// Allowed mime types
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
		// Validate whether selected file is a CSV file
		if(!empty($_FILES['product_file']['name']) && in_array($_FILES['product_file']['type'], $csvMimes)){
			
			// If the file is uploaded
			if(is_uploaded_file($_FILES['product_file']['tmp_name'])){
				
				// Open uploaded CSV file with read-only mode
				$csvFile = fopen($_FILES['product_file']['tmp_name'], 'r');
				
				// Skip the first line
				$header =  fgetcsv($csvFile);
				$header_diff = array_diff($mand_headers,$header);
				if(count($header_diff) >0 ){
					$msg = "CSV header not valid.";
				}
				$total_results_invalid =$total_results=$total_results_valid= 0;
				
				// Parse data from CSV file line by line
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$array_comb = array_combine($header,$line);		
					if($array_comb['sku'] && is_numeric($array_comb['mrp']) && is_numeric($array_comb['price']) && is_numeric($array_comb['quantity'])){
						$validate_sku = $Common_Function->validate_update_product_sku($conn,$array_comb['sku']);
						
						if(count($validate_sku) >0){
							$total_results_valid++;
							if($validate_sku['type'] =='simple'){
								$sql ="UPDATE `vendor_product` SET `product_mrp`= '".$array_comb['mrp']."',`product_sale_price`='".$array_comb['price']."',
									`product_stock`='".$array_comb['quantity']."'  WHERE product_id = '".$validate_sku['product_unique_id']."' AND vendor_id ='".$_SESSION['admin']."'";
							}else if($validate_sku['type'] =='configurable'){
								$sql = "UPDATE `product_attribute_value` SET `price`='".$array_comb['price']."',`mrp`='".$array_comb['mrp']."',
									`stock`='".$array_comb['quantity']."' WHERE product_id = '".$validate_sku['product_unique_id']."' AND vendor_prod_id = '".$validate_sku['vendor_prod_id']."' AND 
										product_sku ='".$validate_sku['product_sku']."' ";
							}
							
							$stmt_check = $conn->query($sql);
						}else{
							$total_results_invalid++;
						}
						
					}else{
						$total_results_invalid++;
					}
					
					$total_results++;
				}
				
				
				
				// Close opened CSV file
				fclose($csvFile);
				
				$qstring = '?status=succ';
			}else{
				$qstring = '?status=err';
			}
		}else{
			$qstring = '?status=invalid_file';
		}
		
	}else{
		$msg = "Invalid Parameters. Please fill all required fields.";
	}
}
echo $msg;
	//echo '<script>alert("'.$msg.'"); location.href="manage_product.php";</script>';

    
?>
<?php include("header.php"); ?>

	<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div>
			  	    <div class="bs-example widget-shadow" data-example-id="hoverable-table"> 
        			    <h4 style="padding: 15px; height: 4px">
        			        <span><b>Product Inventory Processing:</b></span>
						</h4>
						<div class="form-three widget-shadow">
        					<div class="col_1">
			<div class="col-md-2 ">
				<div class="">
					
					
				</div>
			</div>
			<div class="col-md-8 ">
				<div class="activity_box activity_box1">
					<h3>Inventory Product Status</h3>
					<div class="" id="style-3">
					<table class="table table-hover" id="tblname">
						<tbody>
							<tr><td style="width: 230px;"><b>Valid Products</b></td><td><?php echo $total_results_valid; ?></td></tr>
							<tr><td style="width: 230px;"><b>Invalid Products</b></td><td><?php echo $total_results_invalid; ?></td></tr>
							<tr><td style="width: 230px;"><b>Total Products</b></td><td><?php echo $total_results; ?></td></tr>
						</tbody>
					</table>
				
					</div>
				
					<button type="submit" class="btn btn-success" href="javascript:void(0)" id="finish_update">Finish Import</button>
				
				</div>
			</div>
			<div class="col-md-2 ">
				<div class=" ">
					
					
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
			
		</div>	
								
								
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
				
			</div>
		</div>
		<!--footer-->
              <?php    include('footernew.html'); ?>
        <!--//footer-->
	</div>
	<script>	
		$(document).ready(function(){
			$("#finish_update").click(function(event){
				event.preventDefault();
				
				location.href="manage_product.php";
			});
		});
	</script>		

	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->
	
</body>
</html>
