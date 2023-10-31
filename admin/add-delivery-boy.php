<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$DeliveryBoy)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<script src ="js/admin/add-delivery-boy.js"></script>


		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			    	   
			  	    	<div >
			  	    	     
        			    	<div class="bs-example widget-shadow" data-example-id="hoverable-table"> 
        			    
        						<h4 style="padding: 15px; height: 4px;">
        						    <button type="submit" onclick="back_page('delivery-boy.php')" id ="back_btn" class="btn  btn-default"  style="margin-right:10px; margin-top:-4px;"><i class="fa fa-arrow-left"></i> Back</button>   
						
        						    <b>Add New Delivery Boy :</b></h4>
        				
        					    <div class="form-three widget-shadow">
        							<form class="form-horizontal" id="myform">
        							    	    <a> ** required field</a>
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label">Delivery Boy Name **</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="full_name" placeholder="Full Name" required>
        									</div>
        								</div>
        								
        							
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label"> Address**</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="address" placeholder="Address" required>
        									</div>
        								</div>
        							
        								<div class="form-group">
								        		<label  class="col-sm-3 control-label">Select Country **</label>
								           	<div class="col-sm-8">
								               <select class="form-control1" id="selectcountry" name="selectcountry">
                                                
                                                </select> 
                                          </div>
                                        </div>
        								<div class="form-group">
								        		<label  class="col-sm-3 control-label">Select State **</label>
								           	<div class="col-sm-8">
								               <select class="form-control1" id="selectstate" name="selectstate">
                                                
                                                </select> 
                                          </div>
                                        </div>
        								<div class="form-group">
								        		<label  class="col-sm-3 control-label">Select City **</label>
								           	<div class="col-sm-8">
								               <select class="form-control1" id="selectcity" name="selectcity">
                                                
                                                </select> 
                                          </div>
                                        </div>
        								
        								
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label">Pincode **</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="pincode" placeholder="462026" required>
        									</div>
        								</div>
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label">Phone **</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="phone" placeholder="** without country code" required>
        									</div>
        								</div>
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label">Email Id **</label>
        									<div class="col-sm-8">
        										<input type="email" class="form-control1" id="email" placeholder="email id" required>
        									</div>
        								</div>
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label">Password **</label>
        									<div class="col-sm-8">
        										<input type="password" class="form-control1" id="password" placeholder="Password" required>
        									</div>
        								</div>
										<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label">Vehicle Number **</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="vehicle_number" placeholder="Vehicle Number" required>
        									</div>
        								</div>
                                         <div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">Profile Image **</label> 
                                            
                                             <div class="col-sm-8"> 
        								               <div class="input-files">
                                                      
                                                         <div >
                                                           <input type="file" name="profile_pic" id="profile_pic" onchange="uploadFile1('profile_pic')"  class="form-control" accept="image/png, image/jpeg,image/jpg" required>
                                                                
                                                        </div>
                                                     </br>
                                                 </div>     
                                                   
        								      </div>
                                        </div>
										  <div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">ID Proof (<?php echo $file_kb; ?>) **</label> 
                                            
                                             <div class="col-sm-8"> 
        								               <div class="input-files">
                                                      
                                                         <div >
                                                           <input type="file" name="id_proof" id="id_proof" onchange="uploadFile2('id_proof','<?php echo $image_size; ?>')"  class="form-control" accept=".pdf,image/png, image/jpeg,image/jpg" required>
                                                                
                                                        </div>
                                                     </br>
                                                 </div>     
                                                   
        								      </div>
                                        </div>
									  <div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">Address Proof (<?php echo $file_kb; ?>) **</label> 
                                            
                                             <div class="col-sm-8"> 
        								               <div class="input-files">
                                                      
                                                         <div>
                                                           <input type="file" name="address_proof" id="address_proof" onchange="uploadFile2('address_proof','<?php echo $image_size; ?>')"  class="form-control" accept=".pdf,image/png, image/jpeg,image/jpg"  required>
                                                                
                                                        </div>
                                                     </br>
                                                 </div>     
                                                   
        								      </div>
                                        </div>
										 <div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">Vehicle Registration (<?php echo $file_kb; ?>)**</label> 
                                            
                                             <div class="col-sm-8"> 
        								               <div class="input-files">
                                                      
                                                         <div >
                                                           <input type="file" name="vehicle_rc" id="vehicle_rc" onchange="uploadFile2('vehicle_rc','<?php echo $image_size; ?>')"   class="form-control" accept=".pdf,image/png, image/jpeg,image/jpg" required>
                                                                
                                                        </div>
                                                     </br>
                                                 </div>     
                                                   
        								      </div>
                                        </div>
										<div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">Vehicle Insurance (<?php echo $file_kb; ?>) **</label> 
                                            
                                             <div class="col-sm-8"> 
        								               <div class="input-files">
                                                      
                                                         <div>
                                                           <input type="file" name="vehicle_insurance" id="vehicle_insurance"  onchange="uploadFile2('vehicle_insurance','<?php echo $image_size; ?>')"  class="form-control" accept=".pdf,image/png, image/jpeg,image/jpg" required>
                                                                
                                                        </div>
                                                     </br>
                                                 </div>     
                                                   
        								      </div>
                                        </div>
        								</br></br>
        								 <div class="col-sm-offset-2">
        								     <button type="submit" class="btn btn-success" href="javascript:void(0)" id="add_btn">SAVE</button>
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
				
			</div>
		</div>
		</div>
	<!--footer-->
        <?php include("footernew.php"); ?>
    <!--//footer-->
	