<?php

   include('session.php');
   
   if(!isset($_SESSION['admin'])){
     header("Location: index.php");
   }
   
   if(!isset($_GET['id'])){
     header("Location: manage_product.php");
   }
   	$record_exist = 'N';
   	
   
   	$prod_unique_id = trim($_GET['id']);
   	$seller_unique_id = trim($_SESSION['admin']);
   
   	$stmt15 = $conn->prepare("SELECT  prod_name,prod_desc,prod_fulldetail,prod_img_url,featured_img, attr_set_id,brand_id,web_url,
   		product_sku,product_visibility,product_manuf_country,product_hsn_code,product_video_url,return_policy_id 
		FROM product_details pd 
		
		WHERE pd.product_unique_id ='".$prod_unique_id."' ");
              
   	$stmt15->execute();
   	$data = $stmt15->bind_result( $prod_name, $prod_desc, $prod_fulldetail, $prod_img_url, $featured_img,$attr_set_id,$brand_id,$web_url,
   		$product_sku,$product_visibility,$product_manuf_country,$product_hsn_code,$product_video_url,$return_policy_id);
   	
   	while ($stmt15->fetch()) {
   		$record_exist = 'Y';
   	}
   	
   	
   	if($record_exist != 'Y'){
   		 header("Location: manage_product.php");
   	}

//include header
include("header.php");
    ?>
	
<style>
    
    .switch {
	position: relative;
	display: block;
	vertical-align: top;
	width: 74px;
	height: 30px;
	padding: 3px;
	margin: 0 10px 10px 0;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
	border-radius: 18px;
	box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
	cursor: pointer;
	box-sizing:content-box;
}
.switch-input {
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
	box-sizing:content-box;
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
	box-sizing:content-box;
}
.switch-label:before, .switch-label:after {
	position: absolute;
	top: 50%;
	margin-top: -.5em;
	line-height: 1;
	-webkit-transition: inherit;
	-moz-transition: inherit;
	-o-transition: inherit;
	transition: inherit;
	box-sizing:content-box;
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
.switch-input:checked ~ .switch-label {
	background: #E1B42B;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
	opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
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
.switch-input:checked ~ .switch-handle {
	left: 48px;
	box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
 
/* Transition
========================== */
.switch-label, .switch-handle {
	transition: All 0.3s ease;
	-webkit-transition: All 0.3s ease;
	-moz-transition: All 0.3s ease;
	-o-transition: All 0.3s ease;
}
</style>	
<script src="<?php echo BASEURL; ?>assets/tinymce/tinymce.min.js"></script>
<script src="js/admin/add-search-product.js"></script>

<!-- main content start-->
<div id="page-wrapper">
   <div class="main-page">
      <div >
         <div class="bs-example widget-shadow" data-example-id="hoverable-table">
             <h4 style="padding: 15px; height: 4px">
                 <button type="submit" onclick="back_page('manage_product.php')" id ="back_btn" class="btn  btn-default"  style="margin-right:10px; margin-top:-4px;"><i class="fa fa-arrow-left"></i> Back</button>   
						
                 <span><b>Add Product :</b></span></h4>
            <div class="form-three widget-shadow">
               <form class="form-horizontal" id="myform" action ="add_search_product_process.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="code" value="<?php echo $code_ajax; ?>" /> 
                  <a> ** required field</a>
                 
                  <div class="form-group">
                     <label  class="col-sm-2 control-label">Attribute Set** </label>
                     <div class="col-sm-8">
                        <select class="form-control1 disabled" disabled >
						<option value="">Select</option>
                        <?php 
                           $stmtas = $conn->prepare("SELECT sno, name FROM attribute_set where status ='1' ORDER BY name ASC");
                           $stmtas->execute();	 
                           $data = $stmtas->bind_result( $col1, $col2);
                           
                           while ($stmtas->fetch()) { 
                           	if($attr_set_id == $col1){
                           		echo '<option value="'.$col1.'" selected>'.$col2.'</option>';
                           	}else{
                           		echo '<option value="'.$col1.'">'.$col2.'</option>';
                           	}
                           }
                            ?>
                        </select> 
                     </div>
                  </div>
                  <div class="form-group">
                     <label  class="col-sm-2 control-label">Category Set** </label>
                     <div id="example1"  class="col-sm-8">
                        <div id="treeSelect"> 
                           <?php
                              $stmtcs = $conn->prepare("SELECT cat_id	FROM product_category WHERE prod_id= '".$prod_unique_id."'");
                              $stmtcs->execute();	 
                              $data = $stmtcs->bind_result( $cat_id);
                              
                              $product_cat = array();
                              while ($stmtcs->fetch()) { 
                              	$product_cat[] = $cat_id;
                              }
                              
                                $query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND  status ='1' ORDER BY cat_name ASC");
                                                                   
                                if($query->num_rows > 0){
                                    while($row = $query->fetch_assoc()){
                              		//echo "SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' ";
                              		$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' AND  status ='1' ");
                              			//	print_r($query1);
                              				if($query1->num_rows > 0){
                              					echo '<span class="expand" onClick=\'expand("'.$row['cat_id'].'",this)\'>[-]</span><span class="mainList">'.$row['cat_name'].'</span>
                              						<br />    
                              						<ul id="ul'.$row['cat_id'].'" class="subList"  style="display:block;">';
                              							echo categoryTree($row['cat_id'],$product_cat);
                              					echo	'</ul>';
                              				}else{
                              					if(in_array($row['cat_id'],$product_cat)){
                              						echo '<span class="expand"><input type="checkbox" disabled checked  value="'.$row['cat_id'].'" class="check_category_limit" onclick="check_category_limit(this);"></span><span class="mainList"> '.$row['cat_name'].'</span><br />';
                              					}else{
                              						echo '<span class="expand"><input type="checkbox" disabled  value="'.$row['cat_id'].'" class="check_category_limit" onclick="check_category_limit(this);"></span><span class="mainList"> '.$row['cat_name'].'</span><br />';
                              					}
                              						
                              				}
                              	}
                              }
                                                                                                                                
                                            function categoryTree($parent_id, $product_cat){
                                                global $conn;
                                                $query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id AND  status ='1'  ORDER BY cat_name ASC");
                                               
                                                if($query->num_rows > 0){
                                                    while($row = $query->fetch_assoc()){
                              				
                              				$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' AND  status ='1'  ");
                              			//	print_r($query1);
                              				if($query1->num_rows > 0){
                              					echo '<span class="expand" onClick=\'expand("'.$row['cat_id'].'",this)\'>[-]</span><span class="mainList">'.$row['cat_name'].'</span>
                              						<br />    
                              						<ul id="ul'.$row['cat_id'].'" class="subList" style="display:block;">';
                              							echo categoryTree($row['cat_id'], $product_cat);
                              					echo '</ul>';
                              					
                              				}else{
                              					if(in_array($row['cat_id'],$product_cat)){
                              						echo '<li><input type="checkbox" checked  disabled value="'.$row['cat_id'].'" class="check_category_limit" onclick="check_category_limit(this);"> '.$row['cat_name'].'</li>';	
                              					}else{
                              						echo '<li><input type="checkbox"  disabled value="'.$row['cat_id'].'" class="check_category_limit" onclick="check_category_limit(this);"> '.$row['cat_name'].'</li>';	
                              					}
                              					
                              				}
                                        }
                                    }
                                }
                            ?>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" name="product_id" value="<?php echo $prod_unique_id; ?>">
                  <div class="form-group">
                     <label for="focusedinput" class="col-sm-2 control-label">Product Name **</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control1 disabled" id="prod_name" disabled value="<?php echo $prod_name; ?>" placeholder="Name" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="focusedinput" class="col-sm-2 control-label">SKU</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control1 disabled" disabled value="<?php echo $product_sku; ?>" placeholder="SKU auto generate" >
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="focusedinput" class="col-sm-2 control-label">URL key</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control1 disabled" disabled value="<?php echo $web_url; ?>" placeholder="URL auto generate">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="focusedinput" class="col-sm-2 control-label">Product Short details **</label>
                     <div class="col-sm-8">
						 <textarea rows="6" cols="65" id="prod_short" disabled placeholder="Miximum 300 letters"><?php echo $prod_desc; ?></textarea> 
                       
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="focusedinput" class="col-sm-2 control-label">Product Full Details **</label>
                     <div class="col-sm-8">
                        <textarea rows="6" cols="65" id="editor" disabled placeholder="Miximum 1000 letters"><?php echo $prod_fulldetail; ?></textarea> 
                     </div>
                  </div>
				  
				  <div class="form-group">
						<label for="focusedinput" class="col-sm-2 control-label">MRP **</label>
						<div class="col-sm-8">
							<input type="number" class="form-control1" id="prod_mrp" name="prod_mrp"  maxlength="7" placeholder="MRP ex. 214" required>
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-2 control-label">Sale Price **</label>
						<div class="col-sm-8">
							<input type="number" class="form-control1" id="prod_price"  name="prod_price"   maxlength="7" placeholder="Sale Price ex. 208" required>
						</div>
					</div>
						<div class="form-group">
								<label  class="col-sm-2 control-label">TAX Class </label>
								<div class="col-sm-8">
									<select class="form-control1" id="selecttaxclass" name="selecttaxclass">
										  <?php 
												$stmtat = $conn->prepare("SELECT tax_id, name FROM tax where status = '1' ORDER BY tax_id ASC");
												$stmtat->execute();	 
												$data = $stmtat->bind_result( $col1t, $col2t);
												
												while ($stmtat->fetch()) { 
													if($product_tax_class == $col1t){
														echo '<option value="'.$col1t.'" selected>'.$col2t.'</option>';
													}else{
														echo '<option value="'.$col1t.'">'.$col2t.'</option>';
													}
												}
												?>
									</select> 
										</div>
									</div>
								<div class="form-group">
						<label for="focusedinput" class="col-sm-2 control-label">Quantity</label>
						<div class="col-sm-8">
							<input type="number" class="form-control1" id="prod_qty"  name="prod_qty" placeholder="stock quantity">
							<br><br>
								
						</div>
					</div>
					<div class="form-group">
								<label  class="col-sm-2 control-label">Stock Status</label>
								<div class="col-sm-8">
								
								<select class="form-control1" id="selectstock" name="selectstock">
									<option value="">Select</option>
									<option value="In Stock" >In Stock</option>
									<option value="Out of Stock" >Out of Stock</option>
								</select> 
										</div>
									</div>
				  
                  <div class="form-group">
                     <label  class="col-sm-2 control-label">Visibility</label>
                     <div class="col-sm-8">
                        <select class="form-control1 disabled" disabled>
                           <option value="">Select</option>
                           <?php 
                              $stmtv = $conn->prepare("SELECT id, name FROM visibility where status ='1' ORDER BY id ASC");
                              $stmtv->execute();	 
                              $data = $stmtv->bind_result( $idv, $namev);
                              												
                              while ($stmtv->fetch()) { 
                              	if($product_visibility == $idv){
                              		echo '<option value="'.$idv.'" selected>'.$namev.'</option>';
                              	}else{
                              		echo '<option value="'.$idv.'">'.$namev.'</option>';
                              	}
                              }
                                ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label  class="col-sm-2 control-label">Country of Manufacture </label>
                     <div class="col-sm-8">
                        <select class="form-control1 disabled" disabled>
                           <option value="">Select</option>
                           <?php 
                              $stmtc = $conn->prepare("SELECT id, name, countrycode FROM country ORDER BY name ASC");
                              $stmtc->execute();	 
                              $data = $stmtc->bind_result( $idc, $namec, $countrycode);
                              $return = array();
                              $i =0;
                              while ($stmtc->fetch()) { 
                              	if($product_manuf_country == $idc){
                              		echo '<option value="'.$idc.'" selected>('.$countrycode.')'.$namec.'</option>';
                              	}else{
                              		echo '<option value="'.$idc.'">('.$countrycode.')'.$namec.'</option>';
                              	}
                              }
                               ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="focusedinput" class="col-sm-2 control-label">HSN Code </label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control1 disabled" disabled value="<?php echo $product_hsn_code; ?>" placeholder="Product HSN code">
                     </div>
                  </div>
				  
				  <div class="form-group">
        			<label for="focusedinput" class="col-sm-2 control-label">Product Purchase Limit for Customer</label>
        		
        			<div class="col-sm-8">
        				<input type="number" class="form-control1" id="prod_purchase_lmt" name="prod_purchase_lmt" maxlength="3">
        				
        			</div>
        		</div>
                  <div class="form-group">
                     <label  class="col-sm-2 control-label">Select Brand **</label>
                     <div class="col-sm-8">
                        <select class="form-control1 disabled" disabled>
							<option value="">Select</option>
                        <?php 
                           $stmtb = $conn->prepare("SELECT brand_id, brand_name FROM brand where status ='1' ORDER BY brand_order ASC");
                           
                           $stmtb->execute();	 
                           $data = $stmtb->bind_result( $brand_id1, $brand_name);
                           
                           while ($stmtb->fetch()) { 
                           	if($brand_id == $brand_id1){
                           		echo '<option value="'.$brand_id1.'" selected>'.$brand_name.'</option>';
                           	}else{
                           		echo '<option value="'.$brand_id1.'">'.$brand_name.'</option>';
                           	}
                           }
                             
                             ?>
                        </select> 
                     </div>
                  </div>
                  <div class="form-group">
                     <label  class="col-sm-2 control-label">Select Return Policy</label>
                     <div class="col-sm-8">
                        <select class="form-control1 disabled" disabled>
                           <option value="">Select</option>
                           <?php
                              $stmtr = $conn->prepare("SELECT id, title FROM product_return_policy WHERE status ='1' ORDER BY title ASC");
                              
                              $stmtr->execute();	 
                              $data = $stmtr->bind_result( $idr, $titler);
                              
                              while ($stmtr->fetch()) { 
                              	if($return_policy_id == $idr){
                              		echo '<option value="'.$idr.'" selected>'.$titler.'</option>';
                              	}else{
                              		echo '<option value="'.$idr.'">'.$titler.'</option>';
                              	}
                              }
                                
                                ?>
                        </select>
                     </div>
                  </div>
				  <div class="form-group">
        			<label for="focusedinput" class="col-sm-2 control-label">Configurations </label>
        			<div class="col-sm-8">
        		        	<button type="button" onclick="check_product();" class="btn btn-hover btn-primary btn-primary">Create Configuration</button>
				      	    <br><br>
        		
        			    <a>Configurable products allow customers to choose options (Ex: shirt color). You need to create a simple product for each configuration (Ex: a product for each color).</a>
        			 
        			</div>
        		</div>
				<div class="form-group">
				
				    <div class="col-sm-10"  style="background-color: #dad9d9;">
					<div id="skip_pric" style="display:none;"><input type="checkbox" name ="skip_sale_price" id ="skip_sale_price" value="1"><span>Apply single price to all SKUs</span></div>
        			<div id="configurations_div_html">
						
        		     
        			</div>
        			</div>
        		</div>
				  <div class="form-group">
        			<label for="focusedinput" class="col-sm-2 control-label">Remarks</label>
        			<div class="col-sm-8">
        				<input type="text" class="form-control1" id="prod_remark"   value="<?php echo $product_remark; ?>" name="prod_remark" placeholder="200 sold in 3 hours">
        			</div>
        		</div> 
                  <div class="form-group">
                     <label for="exampleInputFile" class="col-sm-2 control-label">Featured Images</label> 
                     <div class="col-sm-8">
                        <br><br>
						<?php if($featured_img){ ?> 
                     <div  >
							<div class="col-md-2">
								<div class="thumbnail">
									<div class="image view view-first">
										<?php
											$featured_decod =  json_decode($featured_img); 
											
											$img = MEDIAURL.$featured_decod->{$img_dimension_arr[0][0].'-'.$img_dimension_arr[0][1]};
										?>
										<img style="width: 100%; display: block;" src="<?php echo $img; ?>" alt="" />
									</div>
								</div>
							</div>
							
						</div>
						<?php } ?>
                     </div>
                     
                      </div>
                  <div class="form-group">
                     <label for="exampleInputFile" class="col-sm-2 control-label">Product Images</label> 
                     <div class="col-sm-8 input-files">
                        <br> <br> 
					<div class="row">
						<?php
							$prod_img_decode =  json_decode($prod_img_url); 
							
							if($prod_img_decode){
								$im = 0;
								foreach($prod_img_decode as $prod_imgs ){							
									$img1 = MEDIAURL.$prod_imgs->{$img_dimension_arr[0][0].'-'.$img_dimension_arr[0][1]};
						?>
							<div class="col-md-3" id="imgs_div<?php echo $im; ?>">
								<div class="thumbnail">
									<div class="image view view-first">
										<div class="mask">
											<div class="tools tools-bottom">
												</div>
										</div>
										<img style="width: 100%; display: block;" src="<?php echo $img1; ?>" />
										
									</div>
								</div>
							</div>
							<?php $im++; }  } ?>
					  </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="focusedinput" class="col-sm-2 control-label">Youtube Video ID</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control1 disabled" disabled value="<?php echo $product_video_url; ?>">
                     </div>
                  </div>
				  <?php 
				  
						
					 $stmt = $conn->prepare("SELECT pd.product_unique_id, pd.prod_name FROM product_details pd 
					INNER JOIN vendor_product vp ON pd.product_unique_id = vp.product_id WHERE vp.vendor_id ='".$seller_unique_id."' AND  pd.product_unique_id !='".$prod_unique_id."' ORDER BY pd.prod_name ASC");
					
					$stmt->execute();	 
					$data = $stmt->bind_result( $col1, $col2);
					$return = array();
					$i =0;
					while ($stmt->fetch()) {
							$return[$i] = 
        					array(	
        					    'id' => $col1,
        						'name' => $col2);
              		   $i = $i+1;  		
					}
					
				  ?>
				  
				  <div class="form-group">
					<label  class="col-sm-2 control-label">Related Product multi select</label>
					 <div id="example2"  class="col-sm-8">
					    <select class="form-control1 related_prod" id="selectrelatedprod" name="selectrelatedprod[]"  multiple>
                              <?php
								foreach($return as $related){
									echo '<option value="'.$related['id'].'">'.$related['name'].'</option>'; 
									
								}
								?>							  
								   </select> 
                                 
                                <a>Related products are shown to customers in addition to the item the customer is looking at.</a>
					     <br>
                             </div>
                           </div>
                             
                              <div class="form-group">
						<label  class="col-sm-2 control-label">Up-Sell Products</label>
						 <div  id="example1"  class="col-sm-8">
						    <select class="form-control1 related_prod" id="selectupsell" name="selectupsell[]" multiple>
								<?php
								foreach($return as $related){
									echo '<option value="'.$related['id'].'">'.$related['name'].'</option>'; 
									
								}
								?>                                   
								   </select> 
                               
                                  <a>An up-sell item is offered to the customer as a pricier or higher-quality alternative to the product the customer is looking at.</a>
						      <br> 
                              </div>
                            </div>
                                        
           
                  </br></br>
                  <div class="col-sm-offset-2">
                     <button type="submit" class="btn btn-success" href="javascript:void(0)" id="editProduct_btn">Add</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <?php //} ?>			
      <div class="clearfix"> </div>
   </div>
   <div class="clearfix"> </div>
</div>
	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:100%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Configurations</h4>
      </div>
      <div class="modal-body"> 
        <div class="col-sm-8" id="add_more_attr_btndiv">
            <a class="fa fa-plus fa-4 btn btn-primary" aria-hidden="true"  onclick="add_more_attrs();">Add More Attributes</a>
        </div><br><br>
        <form class="form-horizontal" id="myform_attr">
		<input type="hidden" name="configurations_prod_id" id="configurations_prod_id" value="<?php echo $prod_unique_id; ?>">
        <div class="form-group" id="selectattrs_div">
        	<label for="focusedinput" class="col-sm-2 control-label">Select Attributes</label>
        <div class="col-sm-9"> 
	<div class="input-files">
        <div style="vertical-align: middle; margin-top:5px;">
            <select class="form-control1" id="selectattrs" name="selectattrs[]" onchange="select_attr_val('selectattrs');" required style="float:left; display: inline-block; margin-right:20px;width:150px;">
        	</select> 
           <div id="cselectattrs"></div>
        </div><br>
    </div>     
</div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="manage_configurations_btn" onclick=" return manage_configurations();" >Add Configurations</button>
      </div>
    </div>

  </div>
</div>
  	
<div class="col_1">
   <div class="clearfix"> </div>
</div>
</div>
</div>
<?php include("footernew.php"); ?>