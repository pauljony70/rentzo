<?php
include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

?>
<?php include("header.php"); ?>
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
<script src="js/admin/add_sponser_product.js"></script>





	<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">

			  	    	<div>
			  	    	     
        			    	<div class="bs-example widget-shadow" data-example-id="hoverable-table"> 
        			    		<h4 style="padding: 15px; height: 4px">
        			    		    
        			    		    <span><b>Price Calculator :</b></span></h4>
       
        					    <div class="form-three widget-shadow">
        							<form class="form-horizontal" id="myform" action ="price_calculator.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="code" value="<?php echo $code_ajax; ?>" /> 
        							  
									  
									  
									  <div class="form-group">
								        		<label  class="col-sm-2 control-label">Purchase Price</label>
								          	<div class="col-sm-8">
												<input type="number" name="p_price" class="form-control1" id="p_price">
								               
                                          </div>
                                        </div>
									   
        							    
                                        <div class="form-group">
								        		<label  class="col-sm-2 control-label">Sell Price</label>
								          	<div class="col-sm-8">
												<input type="number" name="s_price" class="form-control1" id="s_price">
								               
                                          </div>
                                        </div>
										
										
										
        								
        							   <div class="form-group">
								        		<label  class="col-sm-2 control-label">Shipping</label>
								          	<div id="example2"  class="col-sm-8">
								          	   <select class="form-control1" id="shipping" name="shipping" >
													<option value="">Select Shipping Method</option>
													<option value="1">Ship using Nimuspost</option>
													 <option value="2">Ship By Self</option>
											   </select> 
                                              
								               <br>
                                          </div>
                                        </div>
										
										<div id="custom_shiping" style="display: none">
											<div class="form-group">
													<label  class="col-sm-2 control-label">Shipping Price</label>
												<div class="col-sm-8">
													<input type="number" name="shiping_price" class="form-control1" id="shiping_price">
												   
											  </div>
											</div>
										</div>
										
										<div id="shiping_nimbus" style="display: none">
											<div class="form-group">
													<label  class="col-sm-2 control-label">Weight(GM)</label>
												<div class="col-sm-8">
													<input type="number" name="weight" class="form-control1" id="weight">
												   
											  </div>
											</div>
											<div class="form-group">
													<label  class="col-sm-2 control-label">Shipping State</label>
												<div id="example2"  class="col-sm-8">
												   <!--<select class="form-control1 " id="shipping_type" name="shipping_type" >
														 <option value="1">Local</option>
														 <option value="2">Regional</option>
														 <option selected="" value="3">National</option>
												   </select>-->
												   <select id="state" name="state" class="form-control1">
														<option value="0">Select State</option>
															<option value="744101">Andaman and Nicobar Islands</option>
															<option value="507130">Andhra Pradesh</option>
															<option value="790001">Arunachal Pradesh</option>
															<option value="781001">Assam</option>
															<option value="800001">Bihar</option>
															<option value="140119">Chandigarh</option>
															<option value="490001">Chhattisgarh</option>
															<option value="396193">Dadra and Nagar Haveli</option>
															<option value="362520">Daman and Diu</option>
															<option value="110001">Delhi</option>
															<option value="403001">Goa</option>
															<option value="360001">Gujarat</option>
															<option value="121001">Haryana</option>
															<option value="171001">Himachal Pradesh</option>
															<option value="180001">Jammu and Kashmir</option>
															<option value="813208">Jharkhand</option>
															<option value="560001">Karnataka</option>
															<option value="670001">Kerala</option>
															<option value="194101">Ladakh</option>
															<option value="682551">Lakshadweep</option>
															<option value="450001">Madhya Pradesh</option>
															<option value="400001">Maharashtra</option>
															<option value="795001">Manipur</option>
															<option value="783123">Meghalaya</option>
															<option value="796001">Mizoram</option>
															<option value="797001">Nagaland</option>
															<option value="751001">Odisha</option>
															<option value="533464">Puducherry</option>
															<option value="140001">Punjab</option>
															<option value="301001">Rajasthan</option>
															<option value="737101">Sikkim</option>
															<option value="600001">Tamil Nadu</option>
															<option value="500001">Telangana</option>
															<option value="799001">Tripura</option>
															<option value="201001">Uttar Pradesh</option>
															<option value="244712">Uttarakhand</option>
															<option value="700001">West Bengal</option>
														</select>
												  
												   <br>
											  </div>
											</div>
										</div>
										
                                         
        								</br></br>
        								 <div class="col-sm-offset-2">
        								          <button type="submit" class="btn btn-success" name="submit" value="submit" href="javascript:void(0)" id="add_cal_btn">Calculate</button>
        								</div>
										</br></br>
										
										
										<?php
												if($_REQUEST['submit'] != '')
												{
													$p_price = $_REQUEST['p_price'];
													$s_price = $_REQUEST['s_price'];
													$shipping = $_REQUEST['shipping'];
													$shiping_price = $_REQUEST['shiping_price'];
													$weight = $_REQUEST['weight'];
													$shipping_type = $_REQUEST['shipping_type'];
													$state = $_REQUEST['state'];
													$gst_shipping = 0;
													$platform_commission = 0;
													
													$query = $conn->query("SELECT * FROM seller_commission WHERE status='1' and price_from <= $s_price and price_to >= $s_price   ORDER BY id ASC");

													if($query->num_rows > 0){

														while($row = $query->fetch_assoc()){
															
															$platform_commission = $row['commission'];
															
														}
													}
													
													
													if($platform_commission != '')
													{
														$platform_commission = $s_price*$platform_commission/100;
													}
													
													if($shiping_price != '')
													{	
														$gst_shipping = $shiping_price*18/100;
													}
													if($weight != '')
													{
														
														$curl1 = curl_init();

													curl_setopt_array($curl1, array(
													  CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
													  CURLOPT_RETURNTRANSFER => true,
													  CURLOPT_ENCODING => '',
													  CURLOPT_MAXREDIRS => 10,
													  CURLOPT_TIMEOUT => 0,
													  CURLOPT_FOLLOWLOCATION => true,
													  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
													  CURLOPT_CUSTOMREQUEST => 'POST',
													  CURLOPT_POSTFIELDS =>'{
														"email" : "marurangecommerce@gmail.com",
														"password" : "Borawar@739"
													}',
													  CURLOPT_HTTPHEADER => array(
														'content-type: application/json'
													  ),
													));

													$response1 = curl_exec($curl1);

													curl_close($curl1);
													$token_data = json_decode($response1);
													$token = $token_data->data;
													
													
													$curl = curl_init();

													curl_setopt_array($curl, array(
													  CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
													  CURLOPT_RETURNTRANSFER => true,
													  CURLOPT_ENCODING => '',
													  CURLOPT_MAXREDIRS => 10,
													  CURLOPT_TIMEOUT => 0,
													  CURLOPT_FOLLOWLOCATION => true,
													  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
													  CURLOPT_CUSTOMREQUEST => 'POST',
													  CURLOPT_POSTFIELDS =>'{
														"origin" : '.$_SESSION['seller_pincode'].',
														"destination" : '.$state.',
														"payment_type" : "cod",
														"order_amount" : "999",
														"weight" : '.$weight.',
														"length" : "10",
														"breadth" : "10",
														"height" : "10"
													}',
													
													  CURLOPT_HTTPHEADER => array(
														'Content-Type: application/json',
														'Authorization: token '.$token.''

													  ),
													));

													$response_rate = curl_exec($curl);

													curl_close($curl);
													
													$response_rate = json_decode($response_rate);
													/*$courier_name = $response_rate->data[2]->name;
													$courier_freight_charges = $response_rate->data[2]->freight_charges;
													print_r($response_rate->data);*/
													foreach($response_rate->data as $ship_data)
													{
														if($ship_data->id == 5)
														{
															$courier_freight_charges = $ship_data->freight_charges;
														}
														
													}
													$shiping_price = $courier_freight_charges;
													$gst_shipping = $shiping_price*18/100; 
														
													
														
													}
													$total = $s_price - $platform_commission - $shiping_price - $gst_shipping - $p_price;
													
												
												?>
                                        
                                        <div class="form-group">
										<div class="col-sm-10" >
											<table class="table" border="1px">
				
												<tbody>
												
												 <tr>
													<th>Purchase Price</th> 
													<td>Rs.<b id="tclf"><?php echo $p_price; ?></b></td>
												</tr>
												<tr>
													<th>Sell Price</th> 
													<td>Rs.<b id="tclf"><?php echo $s_price; ?></b></td>
												</tr>
												<tr>
													<th>Platform Commission Price</th> 
													<td>Rs.<b id="tclf"><?php echo $platform_commission; ?></b></td>
												</tr>
												<tr>
													<th>Shipping Price</th> 
													<td>Rs.<b id="tclf"><?php echo $shiping_price; ?></b></td>
												</tr>
												<tr>
													<th>GST on Shipping Price</th> 
													<td>Rs.<b id="tclf"><?php echo $gst_shipping; ?></b></td>
												</tr>
												<tr>
													<th>Total Profit</th> 
													<td>Rs.<b id="tclf"><?php echo $total; ?></b></td>
												</tr>
												
												</tbody>
											</table>	 			
										</div>
										</div>
										<?php } ?>
										
										<div class="form-group" id="show_results" style="display:none">
										<div class="col-sm-10" >
											<table class="table" border="1px">
				
												<tbody>
												
												 <tr>
													<th>Purchase Price</th> 
													<td>Rs.<b id="tclf"><span id="p_price_1"></span></b></td>
												</tr>
												<tr>
													<th>Sell Price</th> 
													<td>Rs.<b id="tclf"><span id="s_price_1"></span></b></td>
												</tr>
												<tr>
													<th>Platform Commission Price</th> 
													<td>Rs.<b id="tclf"><span id="platform_commission"></span></b></td>
												</tr>
												<tr>
													<th>Shipping Price</th> 
													<td>Rs.<b id="tclf"><span id="shiping_price_1"></span></b></td>
												</tr>
												<tr>
													<th>GST on Shipping Price</th> 
													<td>Rs.<b id="tclf"><span id="gst_shipping"></span></b></td>
												</tr>
												<tr>
													<th>Total Profit</th> 
													<td>Rs.<b id="tclf"><span id="total"></span></b></td>
												</tr>
												
												</tbody>
											</table>	 			
										</div>
										</div>
										
										
        							</form>
									
										
									<br><br>		
        						</div>
								
        					</div>
    					</div>
			
					
				
			<div class="clearfix"> </div>
			
		</div>
	
                
             
            
                
			<div class="clearfix"> </div>
			
		</div>
			    
		<!-- Modal -->

  	
		<div class="col_1">
			
			
			<div class="clearfix"> </div>
			
		</div>
				
			</div>
		</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>      

<script>
$(document).ready(function(){
    $('#shipping').on('change', function(){
    	var shipping = $(this).val(); 
		if(shipping == 1)
		{
			$("#custom_shiping").hide();
			$("#shiping_nimbus").show();
			
		}
		else if(shipping == 2)
		{
			$("#shiping_nimbus").hide();
			$("#custom_shiping").show();
			
		}
        
    });
	 $("#add_cal_btn").click(function(event){

		event.preventDefault();
		
		var p_price = $('#p_price').val();

		var s_price = $('#s_price').val();
		
		var shipping = $('#shipping').val();
		var shiping_price = $('#shiping_price').val();
		var weight = $('#weight').val();
		var shipping_type = $('#shipping_type').val();
		var state = $('#state').val();

		

		if(!p_price){

			successmsg("Please Add Purchase Price");

			}else if(!s_price){

				successmsg("Please Add Sell Price");
			}else if(!shipping){

				successmsg("Please Select Shipping");

		}else

		
			

		if(p_price && s_price && shipping){				

			 showloader();


			var form_data = new FormData();


			form_data.append('p_price', p_price);

			form_data.append('s_price', s_price);
			
			form_data.append('s_price', s_price);
			form_data.append('shipping', shipping);
			form_data.append('shiping_price', shiping_price);
			form_data.append('weight', weight);
			form_data.append('shipping_type', shipping_type);
			form_data.append('state', state);
			
			

			

			$.ajax({

				method: 'POST',

				url: 'add_price_calculator_process.php',

				data:form_data,

				contentType: false,

				processData: false,

				success: function(response){

					hideloader();
					
					var parsedJSON = $.parseJSON(response);
					
					var data = parsedJSON.data;
					
					$('#show_results').show();

					$(data).each(function() {
						
					var p_price = this.p_price;
					var s_price = this.s_price;
					var platform_commission = this.platform_commission;
					var shiping_price = this.shiping_price;
					var gst_shipping = this.gst_shipping;
					var total = this.total;
					
					
					$('#p_price_1').html(p_price);
					$('#s_price_1').html(s_price);
					$('#platform_commission').html(platform_commission);
					$('#shiping_price_1').html(shiping_price);
					$('#gst_shipping').html(gst_shipping);
					$('#total').html(total.toFixed(2));
					
					
					/*$('#weight').val('');
					$('#shiping_price').val('');*/
					
					
					});


					/*successmsg(response);	*/


				}

			});

		}

			

    });
});
</script> 

	<?php include("footernew.php"); ?>