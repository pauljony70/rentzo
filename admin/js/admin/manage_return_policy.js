var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getreturn_policy(pagenov, rownov) {
	$.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_return_policy_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				var  btnactive ="";
                if(this.statuss == "0"){
                	    btnactive=	'<span class = "Pending">'+"Pending"+'</span>';
                }else if(this.statuss == "1"){
                	    btnactive= '<spanclass = "Active">'+"Active "+'</span>';
                }else if(this.statuss == "3"){
                	    btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
                } 	
				
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.title + '</td><td > ' + this.policy_validity + '</td><td > ' + this.policy_type + '</td><td > ' +btnactive+ '</td>';
                html += '<td><div class="d-flex"><button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="delete_records(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit_records("'+this.id +'","'+this.title+'","'+this.statuss+'","'+this.policy_validity+'","'+this.policy_type_refund+'","'+this.policy_type_replace+'","'+this.policy_type_exchange+'")\';>EDIT</button></dib><div class="policy' +this.id + '" style="display:none;">' +this.policy+ '</div></td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

function attribute_set_product(pagenov) {
	$.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_return_policy_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				var  btnactive ="";
                if(this.statuss == "0"){
                	    btnactive=	'<span class = "Pending">'+"Pending"+'</span>';
                }else if(this.statuss == "1"){
                	    btnactive= '<spanclass = "Active">'+"Active "+'</span>';
                }else if(this.statuss == "3"){
                	    btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
                } 	
				
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.title + '</td><td > ' + this.policy_validity + '</td><td > ' + this.policy_type + '</td><td > ' +btnactive+ '</td>';
                html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="delete_records(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit_records("'+this.id +'","'+this.title+'","'+this.statuss+'","'+this.policy_validity+'","'+this.policy_type_refund+'","'+this.policy_type_replace+'","'+this.policy_type_exchange+'")\';>EDIT</button><div class="policy' +this.id + '" style="display:none;">' +this.policy+ '</div></td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });
		}
    });
}


$(document).ready(function() {
    getreturn_policy(pageno, rowno);
	
	
	$("#add_policy_btn").click(function(event){
		event.preventDefault();
		
		var policy_title = $('#policy_title').val();
		var policy_validity = $('#policy_validity').val();
		
		var policy_type_refund = 0;
		if($("#policy_type_refund").is(':checked')){
			policy_type_refund = 1;
		}		
		
		var policy_type_replace = 0;
		if($("#policy_type_replace").is(':checked')){
			policy_type_replace = 1;
		}		
		
		var policy_type_exchange = 0;
		if($("#policy_type_exchange").is(':checked')){
			policy_type_exchange = 1;
		}
		
		
		var policy_content = tinyMCE.get('policy_content').getContent();
		
		if(!policy_title){
			successmsg("Please enter policy title.");
		}else if(!policy_validity){
			successmsg("Please enter validity days.");
		}else if($('.policy_type:checkbox:checked').length ==0 ){		
			successmsg("Please Select atleast one Type Accepted.");
		}else if(!policy_content){
			successmsg("Please enter policy details.");
		}else if(policy_content && policy_title && policy_validity){				
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('policy_title', policy_title);
			form_data.append('policy_content', policy_content);
			form_data.append('policy_validity', policy_validity);
			form_data.append('policy_type_refund', policy_type_refund);
			form_data.append('policy_type_replace', policy_type_replace);
			form_data.append('policy_type_exchange', policy_type_exchange);
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'add_policy_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#policy_title').val('');
					tinyMCE.activeEditor.setContent(policy_content);
					getreturn_policy(1, 0)
					successmsg(response);	

				}
			});
		}
			
    });
	
	$("#update_policy_btn").click(function(event){
		event.preventDefault();
		
		var update_title = $('#update_title').val();
		var update_policy_content = tinyMCE.get('update_policy_content').getContent();
		var attribute_id = $('#attribute_id').val();
		var statuss = $('#statuss').val();
		
		var policy_validity = $('#policy_validity_update').val();
		
		var policy_type_refund = 0;
		if($("#refund_update").is(':checked')){
			policy_type_refund = 1;
		}		
		
		var policy_type_replace = 0;
		if($("#replace_update").is(':checked')){
			policy_type_replace = 1;
		}		
		
		var policy_type_exchange = 0;
		if($("#exchange_update").is(':checked')){
			policy_type_exchange = 1;
		}
		
		if(!update_title){
			successmsg("Please enter Title");
		}else if(!policy_validity){
			successmsg("Please enter validity days.");
		}else if($('.policy_type_update:checkbox:checked').length ==0 ){		
			successmsg("Please Select atleast one Type Accepted.");
		}else if(!update_policy_content){
			successmsg("Please enter Policy");
		}else if(!statuss){
			successmsg("Please select status");
		}else if(update_policy_content && update_title && statuss && policy_validity){				
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('update_title', update_title);
			form_data.append('policy_content', update_policy_content);
			form_data.append('attribute_id', attribute_id);
			form_data.append('statuss', statuss);
			form_data.append('policy_validity', policy_validity);
			form_data.append('policy_type_refund', policy_type_refund);
			form_data.append('policy_type_replace', policy_type_replace);
			form_data.append('policy_type_exchange', policy_type_exchange);
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'edit_policy_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_country').val('');
					$('#update_policy_content').val('');
					$('#attribute_id').val('');
					var page = $(".pagination .active .current").text();
					getreturn_policy(page, 0)
					successmsg(response);	

				}
			});
		}
			
    });
	
	if ($("#policy_content").length > 0) {
        tinymce.init({
            selector: "textarea#policy_content",
            theme: "modern",
            height: 300,
            plugins: [
					"advlist lists print",
				//  "wordcount code fullscreen",
					"save table directionality emoticons paste textcolor"
				],
				toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }
	if ($("#update_policy_content").length > 0) {
        tinymce.init({
            selector: "textarea#update_policy_content",
            theme: "modern",
            height: 300,
             plugins: [
					"advlist lists print",
				//  "wordcount code fullscreen",
					"save table directionality emoticons paste textcolor"
				],
				toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

});



function perpage_filter() {
	$.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_return_policy_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage
        },
        success: function(response) {
           $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				var  btnactive ="";
                if(this.statuss == "0"){
                	    btnactive=	'<span class = "Pending">'+"Pending"+'</span>';
                }else if(this.statuss == "1"){
                	    btnactive= '<spanclass = "Active">'+"Active "+'</span>';
                }else if(this.statuss == "3"){
                	    btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
                } 	
				
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.title + '</td><td > ' + this.policy_validity + '</td><td > ' + this.policy_type + '</td><td > ' +btnactive+ '</td>';
                html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="delete_records(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit_records("'+this.id +'","'+this.title+'","'+this.statuss+'","'+this.policy_validity+'","'+this.policy_type_refund+'","'+this.policy_type_replace+'","'+this.policy_type_exchange+'")\';>EDIT</button><div class="policy' +this.id + '" style="display:none;">' +this.policy+ '</div></td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

function edit_records(id, name,statuss,policy_validity,refund,replace,exchange) {
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_title").val(name);
	$("#policy_validity_update").val(policy_validity);
	if(refund==1){
		$("#refund_update").prop( "checked", true );
	}
	if(replace==1){
		$("#replace_update").prop( "checked", true );
	}
	if(exchange==1){
		$("#exchange_update").prop( "checked", true );
	}
	
	$("#statuss").val(statuss);
	var htm = $(".policy"+id).html();
	
	tinyMCE.activeEditor.setContent(htm);
}

function delete_records(id) {
	xdialog.confirm('Are you sure want to delete?', function() {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'delete_policy.php',
			data: { deletearray: id, code:code_ajax },
			success: function(response) {
				$.busyLoadFull("hide");
				if(response =='Failed to Delete.'){
					successmsg("Failed to Delete.");
				}else if(response =='Deleted'){
					$("#tr"+id).remove();
					successmsg("Refund policy deteled successfully.");
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


	
	
	
	
	