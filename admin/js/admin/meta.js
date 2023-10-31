var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getBrand(pagenov, rownov) {
	 $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_meta_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage
        },
        success: function(response) {
           $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#meta_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				//var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td><img src="' + this.img + '" style="width: 72px; height: 72px;"></td><td > ' + this.name + '</td><td > ' +btnactive + '</td>';
				 var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' +this.page_title + '</td><td > ' + this.page_heading + '</td><td > ' + this.meta_tags + '</td>';
				html += '<td> <button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editmeta("' + this.id + '")\';>EDIT</button></td></tr>';
                $("#meta_list").append(html);

                count = count + 1;
            });


        }
    });
}


function brand_product(pagenov) {
	 $.busyLoadFull("show");
	 //alert('ddd');
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_meta_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#meta_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
						
               
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + page_title + '</td<td > ' + this.page_heading + '</td><td > ' + this.meta_tags + '</td>';
                html += '<td> <button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit("' + this.id + '")\';>EDIT</button></td></tr>';
                $("#meta_list").append(html);

                count = count + 1;
            });



        }
    });
}


$(document).ready(function() {
    getBrand(pageno, rowno);
	
	$("#update_meta_btn").click(function(event){
		event.preventDefault();
		
		var page_title = $('#update_page_title').val();
		var page_heading = $('#update_page_heading').val();
		var meta_tags = $('#update_meta_tags').val();
		var meta_dsc = $('#update_meta_dsc').val();
		var meta_keys = $('#update_meta_keys').val();
		var page_content = $('#update_page_content').val();
		var caninocial_url = $('#update_caninocial_url').val();
		var metaid = $('#metaid').val();
		var statuss = $('#status').val();
		
		if(!page_title){
			successmsg("Please enter Page Title");
		}
		if(!page_heading){
			successmsg("Please enter Page Heading");
		}
					
		if(page_title && page_heading){				
			 $.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('page_title', page_title);
			form_data.append('metaid', metaid);
			form_data.append('page_heading', page_heading);
			form_data.append('meta_tags', meta_tags);
			form_data.append('meta_dsc', meta_dsc);
			form_data.append('meta_keys', meta_keys);
			form_data.append('page_content', page_content);
			form_data.append('caninocial_url', caninocial_url);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'edit_meta_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_page_title').val('');
					$('#update_page_heading').val('');
					$('#update_meta_tags').val('');
					$('#update_meta_dsc').val('');
					$('#update_meta_keys').val('');
					$('#update_page_content').val('');
					$('#update_caninocial_url').val('');
					$('#metaid').val('');
					
					var page = $(".pagination .active .current").text();
					getBrand(page, 0)
					successmsg(response);	
                    //$('#update_brand_image').val('');
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
        url: 'get_brand_data.php',
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
                	    btnactive= '<span class = "Active">'+"Active "+'</span>';
                }else if(this.statuss == "3"){
                	    btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
                } 
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td><img src="' + this.img + '" style="width: 72px; height: 72px;"></td><td > ' + this.name + '</td><td > ' +btnactive + '</td>';
                html += '<td> <button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editmeta("' + this.id + '")\';>EDIT</button></td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });
		}
    });
}

function editmeta(id) {
	location.href='edit_custom_page.php?id='+id;
}
	
	
	