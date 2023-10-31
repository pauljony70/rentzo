<?php
include('session.php');


if(!$Common_Function->user_module_premission($_SESSION,$ManageSeller)){
	echo "<script>location.href='no-premission.php'</script>";die();
}


if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

 $sellerid = $_POST['sellerid'];

 
?>
<?php include("header.php"); ?>
<script>
var code_ajax = $("#code_ajax").val();	
    function getDetails(){
         showloader();
     var selleridvalue = $('#sellerid').val();
                 
        $.ajax({
              method: 'POST',
              url: 'get_seller_bank_data.php',
              data: {
                code: code_ajax,
                sellerid: selleridvalue
              },
              success: function(response){
                   hideloader();
                            var data = $.parseJSON(response);
                             if(data["status"]=="1"){
                                    
                                $(data["data"]).each(function() {
                                		//successmsg(this.bankname);
                                        $('#bankname').val(this.bankname);
                                        $('#accno').val(this.accno);
                                        $('#ifsc').val(this.ifsc);
                                        $('#address').val(this.address);
                        
                                });
                                // successmsg(data["data"].verify );
                                   if(data["data"].verify ==1){
                                         $('#bankname').prop("disabled", true);
                                         $('#accno').prop("disabled", true);
                                         $('#ifsc').prop("disabled", true);
                                         $('#address').prop("disabled", true);
                                          
                                      var x = document.getElementById("varifyedbank");
                                      x.style.display = "block";
                                     var y = document.getElementById("notvarifyedbank");
                                      y.style.display = "none";  
                                      
                                    var m = document.getElementById("savebtn");
                                      m.style.display = "none";
                                    var n = document.getElementById("updatebtn");
                                      n.style.display = "block";
                                     var o = document.getElementById("verifybtn");
                                      o.style.display = "none";    
                                      
                                  }else{
                                      var x = document.getElementById("varifyedbank");
                                      x.style.display = "none";
                                     var y = document.getElementById("notvarifyedbank");
                                      y.style.display = "block";
                                      
                                    var m = document.getElementById("savebtn");
                                      m.style.display = "none";
                                    var n = document.getElementById("updatebtn");
                                      n.style.display = "block";
                                    var o = document.getElementById("verifybtn");
                                      o.style.display = "block";  
                                  }
                                   
                             }else{
                                 successmsg(data["msg"]);
                                   var m = document.getElementById("savebtn");
                                      m.style.display = "block";
                                    var n = document.getElementById("updatebtn");
                                      n.style.display = "none";
                                    var o = document.getElementById("verifybtn");
                                      o.style.display = "none";  
                             }
                        }
            });
    }
    
</script>


<script>
        function save(){
            //successmsg( " -- " );
           var banknamevalue = $('#bankname').val();
           var accnovalue = $('#accno').val();
           var ifscvalue = $('#ifsc').val();
           var addressvalue = $('#address').val();
           var selleridvalue = $('#sellerid').val();
     
           if(banknamevalue =="" || banknamevalue == null){
               successmsg("Bank Name is empty"); 
           }else if(accnovalue=="" || accnovalue == null){
               successmsg("Account number is empty"); 
           }else if(ifscvalue =="" || ifscvalue == null){
               successmsg("IFSC code is empty"); 
           }else if(addressvalue=="" || addressvalue == null){
               successmsg("Addres is empty"); 
           }else{
              showloader();
               
            $.ajax({
              method: 'POST',
              url: 'add_seller_bank_process.php',
              data: {
                  code: code_ajax,
                    bankname: banknamevalue,
                    accno: accnovalue,
                    ifsc: ifscvalue,
                    address: addressvalue,
                    sellerid: selleridvalue
              },
              success: function(response){
                   hideloader();
                              var data = $.parseJSON(response);
                             if(data["status"]=="1"){
                                    	 successmsg(data["msg"]);
                                     var x = document.getElementById("varifyedbank");
                                      x.style.display = "none";
                                     var y = document.getElementById("notvarifyedbank");
                                      y.style.display = "block";
                                      
                                    var m = document.getElementById("savebtn");
                                      m.style.display = "none";
                                    var n = document.getElementById("updatebtn");
                                      n.style.display = "block";
                                    var o = document.getElementById("verifybtn");
                                      o.style.display = "block";  
                             }else{
                                 successmsg(data["msg"]);
                             }
                        }
            });
           }
        }
        

        function edit(){
            //successmsg( " -- " );
           var banknamevalue = $('#bankname').val();
           var accnovalue = $('#accno').val();
           var ifscvalue = $('#ifsc').val();
           var addressvalue = $('#address').val();
           var selleridvalue = $('#sellerid').val();
     
           if(banknamevalue =="" || banknamevalue == null){
               successmsg("Bank Name is empty"); 
           }else if(accnovalue=="" || accnovalue == null){
               successmsg("Account number is empty"); 
           }else if(ifscvalue =="" || ifscvalue == null){
               successmsg("IFSC code is empty"); 
           }else if(addressvalue=="" || addressvalue == null){
               successmsg("Addres is empty"); 
           }else{
              showloader();
               
            $.ajax({
              method: 'POST',
              url: 'edit_seller_bank_process.php',
              data: {
                  code: code_ajax,
                    bankname: banknamevalue,
                    accno: accnovalue,
                    ifsc: ifscvalue,
                    address: addressvalue,
                    sellerid: selleridvalue
              },
              success: function(response){
                    hideloader();         
                              var data = $.parseJSON(response);
                             if(data["status"]=="1"){
                                    	successmsg(data["msg"]);
                                     var x = document.getElementById("varifyedbank");
                                      x.style.display = "none";
                                     var y = document.getElementById("notvarifyedbank");
                                      y.style.display = "block";
                                      
                                    var m = document.getElementById("savebtn");
                                      m.style.display = "none";
                                    var n = document.getElementById("updatebtn");
                                      n.style.display = "block";
                                    var o = document.getElementById("verifybtn");
                                      o.style.display = "block";  
                             }else{
                                 successmsg(data["msg"]);
                             }
                        }
            });
           }
        }
        
		function verify(){
			 var selleridvalue = $('#sellerid').val();
			
           xdialog.confirm('Are you sure want to verify?', function() {
				 showloader();
              //  successmsg(" ready to store "+whatsappvalue );
               
            $.ajax({
              method: 'POST',
              url: 'verify_seller_bank_process.php',
              data: {
                  code: code_ajax,
                    verify_seller_id: selleridvalue
                    
              },
              success: function(response){
                    hideloader();         
                              var data = $.parseJSON(response);
                             if(data["status"]=="1"){
                                    	successmsg(data["msg"]);
                                     var x = document.getElementById("varifyedbank");
                                      x.style.display = "block";
                                     var y = document.getElementById("notvarifyedbank");
                                      y.style.display = "none";
                                      
                                    var m = document.getElementById("savebtn");
                                      m.style.display = "none";
                                    var n = document.getElementById("updatebtn");
                                      n.style.display = "block";
                                    var o = document.getElementById("verifybtn");
                                      o.style.display = "none";  
                             }else{
                                 successmsg(data["msg"]);
                             }
                        }
            });
        }, {
        style: 'width:420px;font-size:0.8rem;',
        buttons: {
            ok: 'yes ',
              cancel: 'no '
         },
        oncancel: function() {
             // console.warn('Cancelled!');
         }
 });
		}
	

	$(document).ready(function(){
	
        getDetails();
		$("#back_btn").click(function(event){
			event.preventDefault();
			   var sellerid = '<?php echo $sellerid; ?>';
         
             var mapForm = document.createElement("form");
            mapForm.target = "_self";
            mapForm.method = "POST"; // or "post" if appropriate
            mapForm.action = "edit_seller_profile.php";
        
            var mapInput = document.createElement("input");
            mapInput.type = "text";
            mapInput.name = "sellerid";
            mapInput.value = sellerid;
            mapForm.appendChild(mapInput);
        
            document.body.appendChild(mapForm);
        
            map = window.open("", "_self" );
        
            if (map) {
                mapForm.submit();
            } else {
                successmsg('You must allow popups for this map to work.');
            }
		 });
    	
    });
</script>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			<div class="bs-example widget-shadow" data-example-id="hoverable-table">
						<span id="varifyedbank" class ="pull-right" style=" color:green; display:none;margin-top: 20px;margin-right: 8px;"> &#x2705; Account Number Verified</span>
							<span id="notvarifyedbank"  class ="pull-right"  style="color:red; display:none;margin-top: 20px;margin-right: 8px;"> &#x274C; Account Number Not Verify</span>       
					
					<h4 style="padding: 15px; height: 4px">
					    <button type="submit" id ="back_btn" class="btn  btn-default"  style="margin-right:10px; margin-top:-4px;"><i class="fa fa-arrow-left"></i> Back</button>   
						
					    <span><b>Bank Details :</b></span>
						
					</h4>
								
			  	    		    <div class="form-three widget-shadow">
        					        
        					     	<input type="hidden" class="form-control1" id="sellerid" value=<?php echo $sellerid; ?> ></input>
        									       
        							<form class="form-horizontal" id="myform">
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-2 control-label">Bank Name</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="bankname" placeholder="Bank Name" required>
        									</div>
        									<div class="col-sm-2">
        										<p class="help-block"></p>
        									</div>
        								</div>
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-2 control-label">Account Number</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="accno" placeholder="Account Number" required >
        									</div>
        								</div>
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-2 control-label">IFSC Code</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="ifsc" placeholder="IFSC Code" required >
        									</div>
        								</div>
        								<div class="form-group">
        									<label for="focusedinput" class="col-sm-2 control-label">Address</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control1" id="address" placeholder="Address" required >
        									</div>
        								</div>
        							
        								</br>
        								 <div class="col-sm-offset-2">
        								         <button type="submit" id ="savebtn" class="btn  btn-success" onclick="save(); return false;" style="float:left; display: none; margin-right:20px;" >Save</button>
        								         
                                                 <button type="submit" id ="updatebtn" class="btn  btn-success" onclick="edit(); return false;" style="float:left; display: none; margin-right:20px;" >Update</button>
                                                 <button type="submit" id ="verifybtn" class="btn  btn-primary " onclick="verify(); return false;" style="float:left; display: none; margin-right:20px;" >Verify Now</button>
                                                </div>
                                        
                                        	</br></br>
        							</form>
        						</div>	
        				
			 
				
			<div class="clearfix"> </div>
			
			</div>
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
	
	