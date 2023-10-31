<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$DeliveryBoy)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

 $deliveryboy_id = $_POST['deliveryboy_id'];

 
?>
<?php include("header.php"); 
		$fname= $address= $city=
        $pincode = $state= $country= $phone= $email= $password= $profile_pic= $id_proof= $address_proof= $vehicle_number=
		$vehicle_docs= $insurance_docs=$status= $flagid=$region=""; 
    $stmt = $conn->prepare("SELECT `fullname`, `address`, `city`, `pincode`, `state`, `country`, `region`, `phone`, `email`, `password`,
							`profile_pic`, `id_proof`, `address_proof`, `vehicle_number`, `vehicle_docs`, `insurance_docs`, `status`, `flagid` FROM `deliveryboy_login` WHERE deliveryboy_unique_id=?");
    $stmt ->bind_param("s", $deliveryboy_id);
	$stmt->execute();	 
	$data = $stmt->bind_result( $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15, $col16, $col17, $col18, $col19);
	$return = array();
                            	   
	//echo " get col data ";
	while ($stmt->fetch()) {    
        $fname=$col2; $address=$col3; $city=$col4;
        $pincode =$col5; $state=$col6; $country=$col7; $region = $col8; $phone=$col9; 
        $email=$col10; $password=$col11;  $profile_pic=$col12;  $id_proof=$col13;  $address_proof=$col14; $vehicle_number=$col15; $vehicle_docs=$col16; 
        $insurance_docs=$col17; $status=$col18;  $flagid=$col19; 
                              		  			 
	}
                               	
    ?>
    
<script type="application/javascript">
	var code_ajax = $("#code_ajax").val();	
	
        function editSellerbankdetails( ) {
            //successmsg(item);
              var deliveryboy_id = $('#deliveryboy_id').val();
         
             var mapForm = document.createElement("form");
            mapForm.target = "_self";
            mapForm.method = "POST"; // or "post" if appropriate
            mapForm.action = "edit-deliveryb-bankdetails.php";
        
            var mapInput = document.createElement("input");
            mapInput.type = "text";
            mapInput.name = "deliveryboy_id";
            mapInput.value = deliveryboy_id;
            mapForm.appendChild(mapInput);
        
            document.body.appendChild(mapForm);
        
            map = window.open("", "_self" );
        
            if (map) {
                mapForm.submit();
            } else {
                successmsg('You must allow popups for this map to work.');
            }
        }
        
</script>


<script>
    function getcountrydata(){
            //   successmsg("prod id "+item );
            $.ajax({
              method: 'POST',
              url: 'get_country.php',
              data: {
                code: code_ajax
              },
              success: function(response){
                           // successmsg(response); // display response from the PHP script, if any
                            var data = $.parseJSON(response);
                            $('#selectcountry') .empty();
                            $('#selectstate') .empty();
                            $('#selectcity') .empty(); 
                                //                    .append('<option selected="selected" value="whatever">text</option>') ;    
                               
                             if(data["status"]=="1"){
                                $getstate = true;    
                                $(data["data"]).each(function() {
                                	//	successmsg(this.name);
                                  var countryid = <?php Print($country); ?>;  
                                  $firstitemid =0;
                                  $firstitemflag = true;
                                    if(countryid === this.id){
                                	   // successmsg("match==="+countryid);
                                	     var o = new Option(this.name, this.id); 
                                        $("#selectcountry").append(o);
                                        $('#selectcountry').val(this.id);
                                         $getstate = false;
                                         getStatedata(this.id);
                                	}else{
                                	    var o = new Option(this.name, this.id);
                                       $("#selectcountry").append(o); 	    
                                	}
                               
                                    if($firstitemflag == true){
                                         $firstitemflag = false;
                                        $firstitemid  =this.id ;
                                    }
                              
                              
                                });
                                if($getstate  == true){
                                     $getstate  = false;
                                     getStatedata( $firstitemid );
                                }
                                    
                             }else{
                                 successmsg(data["msg"]);
                             }
                        }
            });
        
        $('#selectcountry').on('change', function() {
          //successmsg("cahnge"+ this.value );
          getStatedata(this.value);
        });   
    }
</script>

<script>
    function getStatedata(countryid){
            //   successmsg("prod id "+item );
            $.ajax({
              method: 'POST',
              url: 'get_state.php',
              data: {
                code: code_ajax,
                countryid: countryid
              },
              success: function(response){
                           // successmsg(response); // display response from the PHP script, if any
                            var data = $.parseJSON(response);
                             $('#selectstate') .empty();
                             $('#selectcity') .empty(); 
                              //                      .append('<option selected="selected" value="blank">Select</option>') ;    
                             
                             if(data["status"]=="1"){
                                  $getcity = true;  
                                  var stateid = <?php Print($state); ?>;  // <?php $state; ?>;
                                  $firstitemid =0;
                                  $firstitemflag = true;
                                //  successmsg('<?php echo "some info"; ?>');
                                 // successmsg("state "+ stateid );
                                $(data["data"]).each(function() {
                                	//	successmsg(this.id +"--"+stateid+"--");
                                	if(stateid === this.id){
                                	   // successmsg("match==="+stateid);
                                	     var o = new Option(this.name, this.id); 
                                        $("#selectstate").append(o);
                                        $('#selectstate').val(this.id);
                                         $getcity = false;
                                         getCitydata(this.id);
                                	}else{
                                	    var o = new Option(this.name, this.id);
                                       $("#selectstate").append(o); 	    
                                	}
                               
                                    if($firstitemflag == true){
                                         $firstitemflag = false;
                                        $firstitemid  =this.id ;
                                    }
                                });
                                
                                if($getcity  == true){
                                     $getcity  = false;
                                     getCitydata( $firstitemid );
                                }
                                    
                             }else{
                                 successmsg(data["msg"]);
                             }
                        }
            });
            
        
        $('#selectstate').on('change', function() {
          //successmsg("cahnge"+ this.value );
          getCitydata(this.value);
        });    
    }
</script>

<script>
    function getCitydata(stateid){
          // successmsg("state id "+stateid );
            $.ajax({
              method: 'POST',
              url: 'get_city.php',
              data: {
                code: code_ajax,
                stateid: stateid
              },
              success: function(response){
                           // successmsg(response); // display response from the PHP script, if any
                            var data = $.parseJSON(response);
                             $('#selectcity') .empty(); 
                              //                      .append('<option selected="selected" value="blank">Select</option>') ;    
                             
                             if(data["status"]=="1"){
                                  var cityid = <?php Print($city); ?>;  
                                    
                                $(data["data"]).each(function() {
                                	//	successmsg(this.name+"---"+cityid);
                                	if(cityid === this.id){
                                	   // successmsg("match==="+stateid);
                                	     var o = new Option(this.name, this.id); 
                                        $("#selectcity").append(o);
                                        $('#selectcity').val(this.id);
                                     
                                	}else{
                                	    var o = new Option(this.name, this.id);
                                       $("#selectcity").append(o); 	    
                                	}       	
                                    //	var o = new Option(this.name, this.id);
                                     //   $("#selectcity").append(o);
                                      // pass PHP variable declared above to JavaScript variable
                                              
                                });
                                    
                             }else{
                                 successmsg(data["msg"]);
                             }
                        }
            });
    }
</script>


<script>
        
	$(document).ready(function(){
		getcountrydata();
		
		$("#addProduct").click(function(event){
			event.preventDefault();
         
           var full_name = $('#full_name').val();
          
           var business_addressvalue = $('#address').val();
           var pincodevalue = $('#pincode').val();
           var phonevalue = $('#phone').val();
           var emailvalue = $('#email').val();          
           
           var vehicle_number = $('#vehicle_number').val();
           
           var ctr = document.getElementById("selectcountry");
           var countryvalue = ctr.options[ctr.selectedIndex].value;
        
           var stt = document.getElementById("selectstate");
           var statevalue = stt.options[stt.selectedIndex].value;
        
           var ct = document.getElementById("selectcity");
           var cityvalue = ct.options[ct.selectedIndex].value;
           
			var profile_pic = $('#profile_pic').prop('files')[0];
			var id_proof = $('#id_proof').prop('files')[0];
			var address_proof = $('#address_proof').prop('files')[0];
			var vehicle_rc = $('#vehicle_rc').prop('files')[0];
			var vehicle_insurance = $('#vehicle_insurance').prop('files')[0];
           
            var count =1;
          //  successmsg( prod_shortvalue + " -- "+prod_detailsvalue );
           if(full_name =="" || full_name == null){
               successmsg("Delivery Boy name is empty"); 
           }else if(business_addressvalue =="" || business_addressvalue == null){
               successmsg("Delivery Boy address is empty"); 
           }else if(countryvalue =="blank"){
               
               successmsg("Please select Country");
           }else if(statevalue =="blank"){
               
               successmsg("Please select state");
           }else if(cityvalue =="blank"){
               
               successmsg("Please select city");
           }else if(pincodevalue =="" || pincodevalue == null){
               
               successmsg("Pincode is empty"); 
           }else if(phonevalue =="" || phonevalue == null){
               
               successmsg("Phone number is empty"); 
           }else if(emailvalue =="" || emailvalue == null){
               
               successmsg("Email id is empty"); 
           }else if (validate_email(emailvalue) == 'invalid') {

				successmsg("Email id is invalid");
			}else if(vehicle_number =="" || vehicle_number == null){
               
               successmsg("Vehicle number is empty"); 
           }
		   else{
			   showloader();
				var prod_imgurl = $('#prod_imgurl').val();
				var prod_imgurl2 = $('#prod_imgurl2').val();
				var prod_imgurl3 = $('#prod_imgurl3').val();
				var prod_imgurl4 = $('#prod_imgurl4').val();
				var prod_imgurl5 = $('#prod_imgurl5').val();
				var deliveryboy_id = $('#deliveryboy_id').val();
				var sellerstatus = $('#sellerstatus').val();
				var rejectreason = $('#rejectreason').val();
				
				var form_data = new FormData();
				
				form_data.append('full_name', full_name);
				form_data.append('buss_address', business_addressvalue);
				
				form_data.append('countryvalue', countryvalue);
				form_data.append('statevalue', statevalue);
				form_data.append('cityvalue', cityvalue);
				form_data.append('pincodevalue', pincodevalue);
				form_data.append('phonevalue', phonevalue);
				form_data.append('emailvalue', emailvalue);
				 
				form_data.append('vehicle_number', vehicle_number);
				form_data.append('profile_pic', profile_pic);
				form_data.append('id_proof', id_proof);
				form_data.append('address_proof', address_proof);
				form_data.append('vehicle_rc', vehicle_rc);
				form_data.append('vehicle_insurance', vehicle_insurance);
				form_data.append('profile_file', prod_imgurl);
				form_data.append('id_file', prod_imgurl2);
				form_data.append('address_file', prod_imgurl3);
				form_data.append('vehicle_file', prod_imgurl4);
				form_data.append('insurance_file', prod_imgurl5);
				form_data.append('deliveryboy_id', deliveryboy_id);
				form_data.append('status', sellerstatus);
				form_data.append('rejectreason', rejectreason);
				
				form_data.append('code', code_ajax);
				$.ajax({
					method: 'POST',
					url: 'edit_delivery_profileprocess.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response){
						hideloader();
						if( response=='Added'){
							successmsg("Delivery Boy Updated Successfully.");
							location.href = "delivery-boy.php";
						}else{
							successmsg(response);
						}
					}
				});
            }
     });
	 
		$("#update_password_btn").click(function(event){
			event.preventDefault();         
			var deliveryboy_id = $('#deliveryboy_id').val();
			var passwords = $('#password').val();
			
			if(passwords =="" || passwords == null){
               
               successmsg("Password is empty"); 
           }else if(strong_check_password(passwords) == 'fail'){
				successmsg("Password Must contain 5 characters or more,lowercase and uppercase characters and contains digits.");
			}else if(deliveryboy_id && passwords){
				showloader();
				var form_data = new FormData();
				form_data.append('deliveryboy_id', deliveryboy_id);
				form_data.append('passwords', passwords);
			
				
				form_data.append('code', code_ajax);
            $.ajax({
              method: 'POST',
              url: 'verify_deliveryb_bank_process.php',
				data: form_data,
					contentType: false,
					processData: false,
					success: function(response){
                        hideloader();
                           var data = $.parseJSON(response);
                            if(data["status"]=="1"){
                                 $("#myModal").modal('hide');
                                $('#password').val('');
                                successmsg( data["msg"]);
                              
                                       
                            }else{
                                successmsg( data["msg"]);
                            }
                        
                        }
            });
			}
			
		});
		
	})
        
        
</script>
  <script>
         function statuschange(){
            var std = document.getElementById("sellerstatus");
            var statusvalue = std.options[std.selectedIndex].value;
                                             
              // successmsg("statusvalue "+statusvalue);
             var x = document.getElementById("divreject");
                                              
            if(statusvalue ==2){
                                                
                x.style.display = "block";
            }else{
                x.style.display = "none";
                                                
            }
        }
                                        
</script>

<script>
    function sendemail(){
        var std = document.getElementById("sellerstatus");
        var statusvalue = std.options[std.selectedIndex].value;
        var statustext = std.options[std.selectedIndex].text;
         
       // successmsg( statusvalue +"--"+statustext);
                                             
            if(statusvalue ==2){
                    var seller_name = $('#seller_name').val();
                    var phone = $('#phone').val();
                    var email = $('#email').val();
                   // var reason = $('#rejectreason').val();
                   var std = document.getElementById("rejectreason");
                   var reason = std.options[std.selectedIndex].text;
             
                   var subject ="Seller application request has rejected";
                   var bodymsg = "Dear "+seller_name+",<br>"+
                   "We have received your request to become a seller on our platform.<br> After review, we found that you are not eligible due to below given reason."+
                  reason+"<br>";
           // successmsg("start--"+bodymsg );
            
            $.ajax({
              method: 'POST',
              url: 'send_mail.php',
              data: {
                code: code_ajax, 
                subject: subject,
                message: bodymsg,
                email: email,
                phone: phone
              },
              success: function(response){
                          //  successmsg(response); // display response from the PHP script, if any
                           var data = $.parseJSON(response);
                            if(data["status"]=="1"){
                                successmsg( data["msg"]);
                              
                                       
                            }else{
                                successmsg( data["msg"]);
                            }
                              
                        }
            });
            
                
            }else{
                successmsg("elese paer");
                                                
            }
    }
</script>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			    	   
			  	    	     
        			    	<div class="bs-example widget-shadow" data-example-id="hoverable-table"> 
        			         	<button onclick="editSellerbankdetails()" type = "button" class = "btn btn-primary  pull-right" style="margin-right:10px; margin-top:10px;">Bank Account Details</button> 
        			         	<button data-toggle="modal" data-target="#myModal" type = "button" class = "btn btn-primary  pull-right" style="margin-right:10px; margin-top:10px;">Update Password</button> 
						
        						<h4 style="padding: 15px; height: 4px;">
        						    <button type="submit" onclick="back_page('delivery-boy.php')" id ="back_btn" class="btn  btn-default"  style="margin-right:10px; margin-top:-4px;"><i class="fa fa-arrow-left"></i> Back</button>   
						
        						    <b>Edit Delivery Boy Profile :</h4>
        						
        						<input type="hidden" class="form-control1" id="deliveryboy_id" value=<?php echo $deliveryboy_id; ?> ></input>
        								
        				 		
        					    <div class="form-three widget-shadow">
        							<form class="form-horizontal" id="myform">
        							    	    <a> ** required field</a>
        							
        								<div class="form-group">
								        		<label  class="col-sm-3 control-label"  style="color:orange;"> Status **</label>
								           	<div class="col-sm-8">
								               <select class="form-control1" id="sellerstatus" name="sellerstatus" style="background:yellow; color:black;"  onchange="statuschange()">
                                                  <?php
                                                 
                                                        if($status == 0){
                                                         	 echo '<option value="0" selected>'."Pending".'</option>';   
                                                         	 echo '<option value="1">'."Active".'</option>'; 
															 echo '<option value="3">'."Deactive".'</option>'; 
                                                         	 echo '<option value="2">'."Rejected".'</option>'; 
                                                        }else if($status == 1){
                                                         	 echo '<option value="0">'."Pending".'</option>';
                                                         	 echo '<option value="1" selected>'."Active".'</option>'; 
															  echo '<option value="3">'."Deactive".'</option>'; 
                                                         	 echo '<option value="2">'."Rejected".'</option>'; 
                                                        }else if($status == 2){
                                                         	 echo '<option value="0">'."Pending".'</option>';
                                                         	 echo '<option value="1">'."Active".'</option>'; 
															 echo '<option value="3">'."Deactive".'</option>'; 
                                                         	 echo '<option value="2" selected>'."Rejected".'</option>'; 
                                                        }else if($status == 3){
                                                         	 echo '<option value="0">'."Pending".'</option>';
                                                         	 echo '<option value="1">'."Active".'</option>'; 
                                                         	 echo '<option value="3" selected>'."Deactive".'</option>'; 
                                                         	 echo '<option value="2" >'."Rejected".'</option>'; 
                                                        }
                                                     ?>
                                             </select> 
                                          </div>
                                        </div>
                               
        								<div class="form-group" id="divreject" style="margin-left:5px; margin-right:5px;" >
        									
        								    <div class="form-group">
								        	<label  class="col-sm-3 control-label"  style="color:orange;">Reject Reason</label>
								           	<div class="col-sm-8">
								               <select class="form-control1" id="rejectreason" name="rejectreason" style="background:yellow; color:black;">
                                                  <?php
                                                  	 echo '<option value="0">'."Select One Reason".'</option>';   
                                            
                                                       $rejectreason = "";
                            						   $stmt2 = $conn->prepare("SELECT sno, reason FROM seller_flag_reason ");
                                                      // $stmt2 ->bind_param(i, $flagid);
                                                	   $stmt2->execute();	 
                                                 	   $data2 = $stmt2->bind_result( $col41 , $col42);
                                                      //echo " get col data ";
                                                	   while ($stmt2->fetch()) {    
                                                	    
                                                	       //  $rejectreason = $col42;
                                                	        if($flagid == $col41){
                                                             	 echo '<option value="'.$col41.'" selected>'.$col42.'</option>';
                                                            }else {
                                                             	 echo '<option value="'.$col41.'">'.$col42.'</option>';
                                                            }
                                                	   }
                                                     
                                                    ?>
                                             </select> 
                                          </div>
                                        </div>
        								
        							</div>
        								
        						  <?php   echo "<script> statuschange();</script>";  ?>
        						
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label">Delivery Boy Name **</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="full_name" value="<?php echo $fname; ?>" placeholder="Full Name" required>
        									</div>
        								</div>
        								
        							
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label"> Address**</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="address"  value="<?php echo $address; ?>" placeholder="Address" required>
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
        										<input type="text" class="form-control1" value="<?php echo $pincode; ?>" id="pincode" placeholder="462026" required>
        									</div>
        								</div>
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label">Phone **</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" value="<?php echo $phone; ?>" id="phone" placeholder="** without country code" required>
        									</div>
        								</div>
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label">Email Id **</label>
        									<div class="col-sm-8">
        										<input type="email" class="form-control1" value="<?php echo $email; ?>" id="email" placeholder="email id" required>
        									</div>
        								</div>
        							
										<div class="form-group">
        									<label for="focusedinput" class="col-sm-3 control-label">Vehicle Number **</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1"  value="<?php echo $vehicle_number; ?>" id="vehicle_number" placeholder="Vehicle Number" required>
        									</div>
        								</div>
                                         <div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">Profile Image </label> 
                                            
                                             <div class="col-sm-8"> 
        								               <div class="input-files">
                                                      
                                                         <div >
                                                           <input type="file" name="profile_pic" id="profile_pic" onchange="uploadFile1('profile_pic')"  class="form-control" accept="image/png, image/jpeg,image/jpg" required>
                                                            <input type="hidden" class="form-control1" id="prod_imgurl" value=<?php echo $profile_pic; ?> ></input>
        					     
                                                        </div>
                                                     </br>
                                                 </div>     
                                                   
        								      </div>
                                        </div>
										  <div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">&nbsp;</label> 
                                            
                                             <div class="col-sm-8"> 
                        					<div class="tables" style="background-color: #F6EAEA;">
                        						<div class="wrap">
                        				
                        							<div class="bg-effect">
                        								<ul class="bt_list" id="bt_list" >
                        								
															<?php
                        								     	$prod_url = MEDIAURL.$profile_pic;
																//  echo "image url ".$prod_url;
                                                        		echo '<img src='.$prod_url.'  height="75" width="75" hspace="20" vspace="20"> ';
                                                          		 
															?>
                        									
                        								</ul>
                        							</div>
                        						</div>
                        					</div>
                        					</div>
                        				 </br>
                            	</div>
										  <div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">ID Proof (<?php echo $file_kb; ?>)</label> 
                                            
                                             <div class="col-sm-8"> 
        								               <div class="input-files">
                                                      
                                                         <div>
                                                           <input type="file" name="id_proof" id="id_proof" onchange="uploadFile2('id_proof','<?php echo $image_size; ?>')"   class="form-control" accept=".pdf,image/png, image/jpeg,image/jpg" required>
                                                             <input type="hidden" class="form-control1" id="prod_imgurl2" value=<?php echo $id_proof; ?> ></input>
        					    
                                                        </div>
														<?php
                        								    $prod_url = MEDIAURL.$id_proof;
															echo '<a href="download.php?id='.$deliveryboy_id.'&type=id_proof">Download</a> ';
                                                        ?>
                                                     </br>
                                                 </div>     
                                                   
        								      </div>
                                        </div>
									  <div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">Address Proof (<?php echo $file_kb; ?>)</label> 
                                            
                                             <div class="col-sm-8"> 
        								               <div class="input-files">
                                                      
                                                         <div >
                                                           <input type="file" name="address_proof" id="address_proof" onchange="uploadFile2('address_proof','<?php echo $image_size; ?>')"  class="form-control" accept=".pdf,image/png, image/jpeg,image/jpg"  required>
                                                             <input type="hidden" class="form-control1" id="prod_imgurl3" value=<?php echo $address_proof; ?> ></input>
        					    
                                                        </div>
														<?php
                        								    $prod_url = MEDIAURL.$address_proof;
															echo '<a href="download.php?id='.$deliveryboy_id.'&type=address_proof">Download</a> ';
                                                        ?>
                                                     </br>
                                                 </div>     
                                                   
        								      </div>
                                        </div>
										 <div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">Vehicle Registration (<?php echo $file_kb; ?>)</label> 
                                            
                                             <div class="col-sm-8"> 
        								               <div class="input-files">
                                                      
                                                         <div >
                                                           <input type="file" name="vehicle_rc" id="vehicle_rc" onchange="uploadFile2('vehicle_rc','<?php echo $image_size; ?>')"   class="form-control" accept=".pdf,image/png, image/jpeg,image/jpg" required>
                                                            <input type="hidden" class="form-control1" id="prod_imgurl4" value=<?php echo $vehicle_docs; ?> ></input>
        					     
                                                        </div>
														<?php
                        								    $prod_url = MEDIAURL.$vehicle_docs;
															echo '<a href="download.php?id='.$deliveryboy_id.'&type=vehicle_docs">Download</a> ';
                                                        ?>
                                                     </br>
                                                 </div>     
                                                   
        								      </div>
                                        </div>
										<div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-3 control-label">Vehicle Insurance (<?php echo $file_kb; ?>) </label> 
                                            
                                             <div class="col-sm-8"> 
        								               <div class="input-files">
                                                      
                                                         <div >
                                                           <input type="file" name="vehicle_insurance" id="vehicle_insurance"  onchange="uploadFile2('vehicle_insurance','<?php echo $image_size; ?>')"   class="form-control" accept=".pdf,image/png, image/jpeg,image/jpg" required>
                                                            <input type="hidden" class="form-control1" id="prod_imgurl5" value=<?php echo $insurance_docs; ?> ></input>
        					     
                                                        </div>
														<?php
                        								    $prod_url = MEDIAURL.$insurance_docs;
															echo '<a href="download.php?id='.$deliveryboy_id.'&type=insurance_docs">Download</a> ';
                                                        ?>
                                                     </br>
                                                 </div>     
                                                   
        								      </div>
                                        </div>
                                        
                              
        							
        								</br></br>
        							 
            								 <div class="col-sm-offset-2">
            								          <button type="submit" class="btn btn-success" href="javascript:void(0)" id="addProduct">Update</button>
            								</div>
            							
        								</br></br>	
                                            <div class="col-sm-offset-2" id ="sendmail" style="display:none;">
            								          <button type="submit" class="btn btn-danger" href="javascript:void(0)" onclick="sendemail(this); return false;">Send Email to Seller</button>
            								</div>
        								
                                        
        							</form>
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
	
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Password</h4>
      </div>
      <div class="modal-body"> 
		<form class="form" id="update_password_form"  enctype="multipart/form-data">
			
			<div class="form-group"> 
				<label for="name">Password</label> 
				<input type="password" class="form-control" id="password" placeholder="Password"> 
			</div>
			          
            <button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="update_password_btn">Update</button> 
		</form> 
      </div>
      
    </div>

  </div>
</div>				
