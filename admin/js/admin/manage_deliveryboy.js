var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


 function getDeliveryboydata(pagenov, rownov){
	 showloader();
     var perpage = $('#perpage').val();
            
            var search_string = $('#search_name').val(); 
            $.ajax({
              method: 'POST',
              url: 'get_deliveryboy_data.php',
              data: {
                 code: code_ajax,
                page: pagenov,
                rowno: rownov,
                perpage: perpage,
				search_string: search_string
              },
              success: function(response){
                  hideloader();
                    var count =1; 
                       var data = $.parseJSON(response);
					    $("#tbodyPostid").empty();
					     $("#totalrowvalue").html(data["totalrowvalue"]);
						$(".page_div").html(data["page_html"]);
                        if(data["status"]=="1"){
                            
                           
                            searchenable = false;
                          
                            $(data["details"]).each(function() {
                            	//	successmsg(this.statuss);
                            		var  btnactive ="";
											if(this.statuss == "0"){
													btnactive=	'<span class = "Pending">'+"Pending"+'</span>';
											}else if(this.statuss == "1"){
													btnactive= '<span class = "Active">'+"Active "+'</span>';
											}else if(this.statuss == "3"){
													btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
											}else if(this.statuss == "2"){
													btnactive=	'<span class = "Reject">'+"Reject"+'</span>';
											}
                                
                            		$("#tbodyPostid").append('<tr> <td class="nr">'+this.deliveryboy_id+'</td><td>'+this.fullname+'</td><td>'+this.vehicle_number+'</td> <td>'+this.email+'</td> <td class="stk" > '+this.phone+'</td><td>'+this.city+'</td><td> '+this.createby+'</td><td>'+btnactive+'</td><td>	<button type = "button" class = "btn-warning" onclick = \'editRecord("'+this.deliveryboy_id+'");\'>'+"Edit"+'</button></td></tr> ');
                               			
                               	count = count+1;	
                            });
                            
                           
                    }else{
                            successmsg("No record found. please try again!");
                    }   
                  
              }
            });
        }

function deliveryboy_page(pagenov) {
	showloader();
    var perpage = $('#perpage').val();
     
       var search_string = $('#search_name').val();      
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_deliveryboy_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage,
			search_string: search_string
			
        },
        success: function(response){
            hideloader();
                    var count =1; 
                       var data = $.parseJSON(response);
					   $("#tbodyPostid").empty();
					     $("#totalrowvalue").html(data["totalrowvalue"]);
						$(".page_div").html(data["page_html"]);
                        if(data["status"]=="1"){
                            
                            
                            searchenable = false;
                          
                            $(data["details"]).each(function() {
                            	//	successmsg(this.statuss);
                            		var  btnactive ="";
											if(this.statuss == "0"){
													btnactive=	'<span class = "Pending">'+"Pending"+'</span>';
											}else if(this.statuss == "1"){
													btnactive= '<span class = "Active">'+"Active "+'</span>';
											}else if(this.statuss == "3"){
													btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
											}else if(this.statuss == "2"){
													btnactive=	'<span class = "Reject">'+"Reject"+'</span>';
											}
                                
                            		$("#tbodyPostid").append('<tr> <td class="nr">'+this.deliveryboy_id+'</td><td>'+this.fullname+'</td><td>'+this.vehicle_number+'</td> <td>'+this.email+'</td> <td class="stk" > '+this.phone+'</td><td>'+this.city+'</td><td> '+this.createby+'</td><td>'+btnactive+'</td><td>	<button type = "button" class = "btn-warning" onclick = \'editRecord("'+this.deliveryboy_id+'");\'>'+"Edit"+'</button></td></tr> ');
                               			
                               	count = count+1;	
                            });
                            
                           
                    }else{
                            successmsg("No record found. please try again!");
                    }   
                  
              }
    });
}


function perpage_filter() {
	showloader();
     var perpage = $('#perpage').val();
      
        var search_string = $('#search_name').val();     
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_deliveryboy_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage,
			search_string: search_string
        },
        success: function(response){
            hideloader();
                    var count =1; 
                       var data = $.parseJSON(response);
					   
					     $("#totalrowvalue").html(data["totalrowvalue"]);
						$(".page_div").html(data["page_html"]);
						 $("#tbodyPostid").empty();
                        if(data["status"]=="1"){
                            
                           
                            searchenable = false;
                          
                            $(data["details"]).each(function() {
                            	//	successmsg(this.statuss);
                            		var  btnactive ="";
											if(this.statuss == "0"){
													btnactive=	'<span class = "Pending">'+"Pending"+'</span>';
											}else if(this.statuss == "1"){
													btnactive= '<span class = "Active">'+"Active "+'</span>';
											}else if(this.statuss == "3"){
													btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
											}else if(this.statuss == "2"){
													btnactive=	'<span class = "Reject">'+"Reject"+'</span>';
											}
                                
                            		$("#tbodyPostid").append('<tr> <td class="nr">'+this.deliveryboy_id+'</td><td>'+this.fullname+'</td><td>'+this.vehicle_number+'</td> <td>'+this.email+'</td> <td class="stk" > '+this.phone+'</td><td>'+this.city+'</td><td> '+this.createby+'</td><td>'+btnactive+'</td><td>	<button type = "button" class = "btn-warning" onclick = \'editRecord("'+this.deliveryboy_id+'");\'>'+"Edit"+'</button></td></tr> ');
                               			
                               	count = count+1;	
                            });
                            
                           
                    }else{
                            successmsg("No record found. please try again!");
                    }   
                  
              }
    });
}


     function editRecord(deliveryboy_id ) {
            //successmsg(item);
            
             var mapForm = document.createElement("form");
            mapForm.target = "_self";
            mapForm.method = "POST"; // or "post" if appropriate
            mapForm.action = "edit_deliveryboy_profile.php";
        
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
		
		
$(document).ready(function() {
    getDeliveryboydata(pageno, rowno);
	
	
	
	
	$("#searchName").click(function(event){
		event.preventDefault();
		
		var perpage = $('#perpage').val();
     
        var search_string = $('#search_string').val();     
		if(!search_string){
			successmsg("Please enter Search String.");
		}else{
			showloader();
			$.ajax({
				method: 'POST',
				url: 'get_deliveryboy_data.php',
				data: {
					code: code_ajax,
					page: 1,
					rowno: 0,
					perpage: perpage,
					search_string: search_string
				},
				success: function(response){
					hideloader();
							var count =1; 
							var data = $.parseJSON(response);
							$("#tbodyPostid").empty();
								$("#totalrowvalue").html(data["totalrowvalue"]);
								$(".page_div").html(data["page_html"]);
								if(data["status"]=="1"){
									
									
									searchenable = false;
								
									$(data["details"]).each(function() {
										//	successmsg(this.statuss);
											var  btnactive ="";
											if(this.statuss == "0"){
													btnactive=	'<span class = "Pending">'+"Pending"+'</span>';
											}else if(this.statuss == "1"){
													btnactive= '<span class = "Active">'+"Active "+'</span>';
											}else if(this.statuss == "3"){
													btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
											}else if(this.statuss == "2"){
													btnactive=	'<span class = "Reject">'+"Reject"+'</span>';
											}
										
											$("#tbodyPostid").append('<tr> <td class="nr">'+this.deliveryboy_id+'</td><td>'+this.fullname+'</td><td>'+this.vehicle_number+'</td> <td>'+this.email+'</td> <td class="stk" > '+this.phone+'</td><td>'+this.city+'</td><td> '+this.createby+'</td><td>'+btnactive+'</td><td>	<button type = "button" class = "btn-warning" onclick = \'editRecord("'+this.deliveryboy_id+'");\'>'+"Edit"+'</button></td></tr> ');
												
										count = count+1;	
									});
									
								
							}else{
									successmsg("No record found. please try again!");
							}   
						
					}
			});
		}
		
	});
	
	


});
