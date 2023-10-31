var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function get_shipping_fee(pagenov, rownov) {
	showloader();
    var perpage = $('#perpage').val();
    
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_shipping_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage
        },
        success: function(response) {
            hideloader();
            var parsedJSON = $.parseJSON(response);
           $("#cat_list").html('');
            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				var btnactive='';
				if(this.statuss == "1"){
                    btnactive= '<span  class = "Active">'+"Active "+'</span>';
                }else if(this.statuss == "0"){
					btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
                } 	
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.city_name + '</td><td > ' + this.basic_fee + '</td><td > ' + this.order_value + '</td><td > ' + this.big_item_fee + '</td><td > ' + this.estimated_delivery_time + '</td><td > ' + this.prime_delivery_time + '</td><td > ' + btnactive + '</td>';
                html += '<td> <button style=" margin-left: 10px;" type="submit" class= "btn btn-danger btn-sm pull-left" name="delete" onclick="delete_records(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-warning btn-sm pull-left" name="edit" onclick=\'edit_records("' + this.id + '","' + this.city_name + '","' + this.basic_fee + '","' + this.order_value + '","' + this.big_item_fee + '","' + this.estimated_delivery + '","' + this.prime_delivery+ '","' + this.statuss + '")\';>EDIT</button></td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

function shipping_pagination(pagenov) {
	get_shipping_fee(pagenov, 0)
}


$(document).ready(function() {
    get_shipping_fee(pageno, rowno);
	
	
	$("#add_shipping_btn").click(function(event){
		event.preventDefault();
		
		var city = $('#selectcity').val();
		var basic_fee = $('#basic_fee').val();
		var big_item_fee = $('#big_item_fee').val();
		var order_value = $('#order_value').val();
		var estimated_delivery_time = $('#estimated_delivery_time').val();
		var prime_delivery_time = $('#prime_delivery_time').val();
		
		if(!city){
			successmsg("Please select city");
		}else if(!basic_fee){
			successmsg("Please enter Light Item Shipping Fee");
		}else if(!big_item_fee){
			successmsg("Please enter Heavy Item Shipping Fee");
		}else if(!order_value){
			successmsg("Please enter Min Amount");
		}else if(!estimated_delivery_time){
			successmsg("Please select Estimated Delivery Time");
		}else if(!prime_delivery_time){
			successmsg("Please select Prime User Delivery Time");
		}else if(basic_fee && city && big_item_fee && order_value && estimated_delivery_time && prime_delivery_time){				
			showloader();
			var form_data = new FormData();
			form_data.append('city', city);
			form_data.append('basic_fee', basic_fee);
			form_data.append('big_item_fee', big_item_fee);
			form_data.append('order_value', order_value);
			form_data.append('estimated_delivery_time', estimated_delivery_time);
			form_data.append('prime_delivery_time', prime_delivery_time);
			form_data.append('ajax_type', 'add');
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'add_shipping_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					hideloader();
					$("#myModal").modal('hide');
					$('#add_shipping_form')[0].reset();
					get_shipping_fee(1, 0)
					successmsg(response);
					
				}
			});
		}
			
    });
	
	$("#update_shipping_btn").click(function(event){
		event.preventDefault();
		
		var attribute_id = $('#shipping_id').val();
		var basic_fee = $('#basic_fee_update').val();
		var big_item_fee = $('#big_item_fee_update').val();
		var order_value = $('#order_value_update').val();
		var estimated_delivery_time = $('#estimated_delivery_time_update').val();
		var prime_delivery_time = $('#prime_delivery_time_update').val();
		var statuss = $('#statuss').val();
		
		if(!basic_fee){
			successmsg("Please enter Light Item Shipping Fee");
		}else if(!big_item_fee){
			successmsg("Please enter Heavy Item Shipping Fee");
		}else if(!order_value){
			successmsg("Please enter Min Amount");
		}else if(!estimated_delivery_time){
			successmsg("Please select Estimated Delivery Time");
		}else if(!prime_delivery_time){
			successmsg("Please select Prime User Delivery Time");
		}else if(basic_fee && attribute_id && big_item_fee && order_value && estimated_delivery_time && prime_delivery_time && statuss){				
			showloader();
			var form_data = new FormData();
			form_data.append('attribute_id', attribute_id);
			form_data.append('basic_fee', basic_fee);
			form_data.append('big_item_fee', big_item_fee);
			form_data.append('order_value', order_value);
			form_data.append('estimated_delivery_time', estimated_delivery_time);
			form_data.append('prime_delivery_time', prime_delivery_time);
			form_data.append('statuss', statuss);
			form_data.append('ajax_type', 'update');
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'add_shipping_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					hideloader();
					$("#myModalupdate").modal('hide');
					$('#update_shipping_form')[0].reset();
					get_shipping_fee(1, 0)
					successmsg(response);
					
				}
			});
		}
			
    });
	


});




function perpage_filter() {
	get_shipping_fee(1, 0)
}

function edit_records(id, city_name,basic_fee,order_value,big_item_fee,estimated_delivery,prime_delivery,statuss) {
	$("#myModalupdate").modal('show');
	$("#shipping_id").val(id);
	$("#city_name").val(city_name);
	$("#basic_fee_update").val(basic_fee);
	$("#order_value_update").val(order_value);
	$("#big_item_fee_update").val(big_item_fee);
	$("#estimated_delivery_time_update").val(estimated_delivery);
	$("#prime_delivery_time_update").val(prime_delivery);
	$("#statuss").val(statuss);
}

function delete_records(id) {
	xdialog.confirm('Are you sure want to delete?', function() {
		showloader();
		$.ajax({
			method: 'POST',
			url: 'add_shipping_process.php',
			data: { deletearray: id,ajax_type:'delete', code:code_ajax },
			success: function(response) {
				hideloader();
				if(response =='Failed to Delete.'){
					successmsg("Failed to Delete.");
				}else if(response =='Deleted'){
					$("#tr"+id).remove();
					successmsg("Shipping Deleted Successfully.");
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
                               var o = new Option( "Select", "");
                                $("#selectstate").append(o);
                             if(data["status"]=="1"){
                                  $getcity = true;  
                                  var stateid =''  // <?php $state; ?>;
                                  $firstitemid ='';
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
                                         //getCitydata(this.id);
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
                                    // getCitydata( $firstitemid );
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
                              var o = new Option( "Select", "");
                                $("#selectcity").append(o);
                             if(data["status"]=="1"){
                                  var cityid = '';  
                                    
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
                               var o = new Option( "Select", "");
                                $("#selectcountry").append(o);
                             if(data["status"]=="1"){
                                 
                                $(data["data"]).each(function() {
                                	//	successmsg(this.name);
                                  var countryid = '';  
                                  $firstitemid =0;
                                  $firstitemflag = true;
                                    if(countryid === this.id){
                                	   // successmsg("match==="+countryid);
                                	     var o = new Option(this.name, this.id); 
                                        $("#selectcountry").append(o);
                                        $('#selectcountry').val(this.id);
                                         $getstate = false;
                                         
                                	}else{
                                	    var o = new Option(this.name, this.id);
                                       $("#selectcountry").append(o); 	    
                                	}
                               
                                    if($firstitemflag == true){
                                         $firstitemflag = false;
                                        $firstitemid  =this.id ;
                                    }
                              
                              
                                });
                               
                                    
                             }else{
                                
                             }
                        }
            });
          
    }

	
	
	