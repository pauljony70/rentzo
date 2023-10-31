	var code_ajax = $("#code_ajax").val();	
	
	
	var categorylistvisible = false;
	$(document).ready(function(){
		var id = 1;
	    getcountrydata();
	});

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
                                	var o = new Option(this.name, this.id);
                                    $("#selectcountry").append(o);
                                    if($getstate == true){
                                         $getstate = false;
                                         getStatedata(this.id);
                                    }
                                });
                                    
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
                                $(data["data"]).each(function() {
                                	//	successmsg(this.name);
                                	var o = new Option(this.name, this.id);
                                    $("#selectstate").append(o);
                                    if($getcity == true){
                                         $getcity = false;
                                         getCitydata(this.id);
                                    }
                                });
                                    
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
                                    
                                $(data["data"]).each(function() {
                                	//	successmsg(this.name);
                                	var o = new Option(this.name, this.id);
                                    $("#selectcity").append(o);
                                });
                                    
                             }else{
                                 successmsg(data["msg"]);
                             }
                        }
            });
    }
	
	 

	$(document).ready(function(){
		$("#add_btn").click(function(event){
			event.preventDefault();
			
			
           var full_name = $('#full_name').val();
          
           var business_addressvalue = $('#address').val();
           var pincodevalue = $('#pincode').val();
           var phonevalue = $('#phone').val();
           var emailvalue = $('#email').val();
          
           var passwords = $('#password').val();
           
           var ctr = document.getElementById("selectcountry");
           var countryvalue = ctr.options[ctr.selectedIndex].value;
        
           var stt = document.getElementById("selectstate");
           var statevalue = stt.options[stt.selectedIndex].value;
        
           var ct = document.getElementById("selectcity");
           var cityvalue = ct.options[ct.selectedIndex].value;
           
			var profile_pic = $('#profile_pic').prop('files')[0];
			
            var count =1;
          //  successmsg( prod_shortvalue + " -- "+prod_detailsvalue );
           if(full_name =="" || full_name == null){
               successmsg("User full name is empty"); 
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
			}else if(passwords =="" || passwords == null){
               
               successmsg("Password is empty"); 
           }else if(strong_check_password(passwords) == 'fail'){
				successmsg("Password Must contain 5 characters or more,lowercase and uppercase characters and contains digits.");
			}else if(profile_pic =="" || profile_pic == null){
               
               successmsg("Profile Image is empty"); 
           } else{
				showloader();
				var form_data = new FormData();
				
				form_data.append('full_name', full_name);
				form_data.append('buss_address', business_addressvalue);
				
				form_data.append('countryvalue', countryvalue);
				form_data.append('statevalue', statevalue);
				form_data.append('cityvalue', cityvalue);
				form_data.append('pincodevalue', pincodevalue);
				form_data.append('phonevalue', phonevalue);
				form_data.append('emailvalue', emailvalue);
				 
				form_data.append('passwords', passwords);
				form_data.append('profile_pic', profile_pic);
				
				
				form_data.append('code', code_ajax);
				$.ajax({
					method: 'POST',
					url: 'add_appuser_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response){
						hideloader();
						if( response=='Added'){
							successmsg("User Added Successfully.");
							location.href = "app-user.php";
						}else{
							successmsg(response);
						}
					}
				});
            }
		});
		
	})
		
	