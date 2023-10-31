var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getAttribute(pagenov, rownov) {
	$.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_reject_reason_data.php',
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
						
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td>';
                html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","'+this.name+'")\';>EDIT</button></td></tr>';
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
        url: 'get_reject_reason_data.php',
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
						
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td>';
                html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","'+this.name+'")\';>EDIT</button></td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}


$(document).ready(function() {
    getAttribute(pageno, rowno);
	
	
	$("#add_attribute_btn").click(function(event){
		event.preventDefault();
		
		var namevalue = $('#name').val();
		
		if(!namevalue){
			successmsg("Please enter Reject Reason");
		}
		
		if(namevalue){				
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('code', code_ajax);
			form_data.append('type', "add");
			
			$.ajax({
				method: 'POST',
				url: 'add_reject_reason_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#name').val('');
					getAttribute(1, 0)
					successmsg(response);	
                    $('#name').val('');
				}
			});
		}
			
    });
	
	$("#update_attribute_btn").click(function(event){
		event.preventDefault();
		
		var namevalue = $('#update_name').val();
		var attribute_id = $('#attribute_id').val();
		
		if(!namevalue){
			successmsg("Please enter Brand Name");
		}
		
					
		if(namevalue){				
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('attribute_id', attribute_id);
			form_data.append('code', code_ajax);
			form_data.append('type', "update");
			
			$.ajax({
				method: 'POST',
				url: 'add_reject_reason_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_name').val('');
					$('#attribute_id').val('');
					var page = $(".pagination .active .current").text();
					getAttribute(page, 0)
					successmsg(response);	

				}
			});
		}
			
    });
	


});



function perpage_filter() {
	$.busyLoadFull("show");
     var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_reject_reason_data.php',
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
						
                 var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td>';
                html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","'+this.name+'")\';>EDIT</button></td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

function editbrand(id, name,statuss) {
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_name").val(name);
	$("#status").val(statuss);
}

function deletebrand(id) {
	xdialog.confirm('Are you sure want to delete?', function() {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'add_reject_reason_process.php',
			data: { deletearray: id, code:code_ajax ,type:'delete'},
			success: function(response) {
				$.busyLoadFull("hide");
				if(response =='Failed to Delete.'){
					successmsg("Failed to Delete.");
				}else if(response =='Deleted'){
					$("#tr"+id).remove();
					successmsg("Reject Reason Deleted Successfully.");
				}else{
					$("#myModalbrandassign").modal('show');
					$("#myModalbrandassigndivy").html(response);
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

	
	
	
	
	