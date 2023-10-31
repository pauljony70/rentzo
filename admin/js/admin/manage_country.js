var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getCountry(pagenov, rownov) {
	$.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_country_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage,
            get_type: 'country'
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
						
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + this.countrycode + '</td>';
                html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="delete" onclick="view_state(' + this.id + ');">View State</button>';
                html += ' <button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="delete_records(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit_records("' + this.id + '","'+this.name+'","' + this.countrycode + '")\';>EDIT</button></td></tr>';
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
        url: 'get_country_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage,
			get_type: 'country'
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
						
                 var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + this.countrycode + '</td>';
                html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="delete" onclick="view_state(' + this.id + ');">View State</button>';
                html += ' <button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="delete_records(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit_records("' + this.id + '","'+this.name+'","' + this.countrycode + '")\';>EDIT</button></td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });
		}
    });
}


$(document).ready(function() {
    getCountry(pageno, rowno);
	
	
	$("#add_country_btn").click(function(event){
		event.preventDefault();
		
		var country = $('#country').val();
		var country_code = $('#country_code').val();
		
		if(!country){
			successmsg("Please enter country");
		}
		if(!country_code){
			successmsg("Please enter country code");
		}
		
		if(country_code && country){				
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('country', country);
			form_data.append('country_code', country_code);
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'add_country_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#name').val('');
					getCountry(1, 0)
					successmsg(response);
					$('#country').val('');
		             $('#country_code').val('');

				}
			});
		}
			
    });
	
	$("#update_country_btn").click(function(event){
		event.preventDefault();
		
		var update_country = $('#update_country').val();
		var namevalue = $('#update_country_code').val();
		var attribute_id = $('#attribute_id').val();
		
		if(!update_country){
			successmsg("Please enter Country");
		}
		if(!namevalue){
			successmsg("Please enter Country Code");
		}
					
		if(namevalue && update_country){				
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('update_country', update_country);
			form_data.append('country_code', namevalue);
			form_data.append('attribute_id', attribute_id);
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'edit_country_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_country').val('');
					$('#update_country_code').val('');
					$('#attribute_id').val('');
					var page = $(".pagination .active .current").text();
					getCountry(page, 0)
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
        url: 'get_country_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage,
			get_type: 'country'
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				 var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + this.countrycode + '</td>';
                 html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="delete" onclick="view_state(' + this.id + ');">View State</button>';
                html += ' <button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="delete_records(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit_records("' + this.id + '","'+this.name+'","' + this.countrycode + '")\';>EDIT</button></td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

function edit_records(id, name,update_country_code) {
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_country").val(name);
	$("#update_country_code").val(update_country_code);
}

function delete_records(id) {
	xdialog.confirm('Are you sure want to delete?', function() {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'delete_country.php',
			data: { deletearray: id, code:code_ajax },
			success: function(response) {
				$.busyLoadFull("hide");
				if(response =='Failed to Delete.'){
					successmsg("Failed to Delete.");
				}else if(response =='Deleted'){
					$("#tr"+id).remove();
					successmsg("Country Deleted Successfully.");
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

function view_state(id){
		window.open('manage_state.php?id='+id,
  '_blank' // <- This is what makes it open in a new window.
);
}

	
	
	
	
	