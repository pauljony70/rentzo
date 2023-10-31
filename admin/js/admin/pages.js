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
        url: 'get_pages_data.php',
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
				 var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' +this.page_title + '</td><td > ' + this.page_dsc + '</td>';
				html += '<td> <button type="submit" class= "btn btn-danger btn-sm pull-left" name="delete" onclick="deletemeta(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editmeta("' + this.id + '","'+this.page_title+'","'+this.page_dsc+'")\';>EDIT</button></td></tr>';
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
                html += '<td> <button type="submit" class= "btn btn-danger btn-sm pull-left" name="delete" onclick="deletemeta(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit("' + this.id + '","'+this.page_title+'"")\';>EDIT</button></td></tr>';
                $("#meta_list").append(html);

                count = count + 1;
            });



        }
    });
}


$(document).ready(function() {
    getBrand(pageno, rowno);
	
	
	$("#add_pages_btn").click(function(event){
		event.preventDefault();
		var page_title = $('#page_title').val();
		var page_dsc = $('#page_dsc').val();
		if(!page_dsc){
			successmsg("Please enter Page Title");
		}
		if(!page_dsc){
			successmsg("Please enter Page Description");
		}
			
		if(page_title && page_dsc){				
			 $.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('page_title', page_title);
			form_data.append('page_dsc', page_dsc);
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'add_pages_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#page_title').val('');
					$('#page_dsc').val('');
					getBrand(1, 0)
					successmsg(response);	
                    $('#page_title').val('');
                    $('#page_dsc').val('');
				}
			});
		}
			
    });
	
	if ($("#page_dsc").length > 0) {
            tinymce.init({
                selector: "textarea#editor",
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
	
	$("#update_pages_btn").click(function(event){
		event.preventDefault();
		
		var page_title = $('#update_page_title').val();
		var page_dsc = $('#update_page_dsc').val();
		var pages_id = $('#pages_id').val();
		var statuss = $('#status').val();
		
		if(!page_title){
			successmsg("Please enter Page Title");
		}
		if(!page_dsc){
			successmsg("Please enter Page Description");
		}
					
		if(page_title && page_dsc){				
			 $.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('page_title', page_title);
			form_data.append('pages_id', pages_id);
			form_data.append('page_dsc', page_dsc);
			
			$.ajax({
				method: 'POST',
				url: 'edit_pages_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_page_title').val('');
					$('#update_page_dsc').val('');
					$('#pages_id').val('');
					
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
                html += '<td> <button type="submit" class= "btn btn-danger btn-sm pull-left" name="delete" onclick="deletemeta(' + this.id + ');">DELETE</button>';

               html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editmeta("' + this.id + '","'+this.page_title+'","'+this.page_heading+'","'+this.meta_tags+'","'+this.meta_desc+'","'+this.meta_keys+'","'+this.page_content+'","'+this.caninocial_url+'")\';>EDIT</button></td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });
		}
    });
}

function editmeta(id, name,page_dsc) {
	$("#myModalupdate").modal('show');
	$("#pages_id").val(id);
	$("#update_page_title").val(name);
	$("#update_page_dsc").val(page_dsc);
}

function deletemeta(id) {

	 xdialog.confirm('Are you sure want to delete?', function() {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'delete_pages.php',
			data: { deletearray: id, code:code_ajax },
			success: function(response) {
				$.busyLoadFull("hide");
				if(response =='Failed to Delete.'){
					successmsg("Failed to Delete.");
				}else if(response !=''){
					//$("#tr"+id).remove();
					successmsg("Meta Deleted Successfully.");
					location.reload();
				}else{
					//$("#myModalbrandassign").modal('show');
					//$("#myModalbrandassigndivy").html(response);
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

function assign_brand_btn(){
	var delete_brand_id = $('#delete_brand_id').val();
	var brand_assign_id = $('#brand_assign_id').val();
			
	if(delete_brand_id && brand_assign_id){				
	
		var form_data = new FormData();
		form_data.append('delete_brand_id', delete_brand_id);
		form_data.append('brand_assign_id', brand_assign_id);
		form_data.append('code', code_ajax);
		
		$.ajax({
			method: 'POST',
			url: 'delete_brand.php',
			data:form_data,
			contentType: false,
			processData: false,
			success: function(response){
				$("#tr"+delete_brand_id).remove();
				successmsg("Brand Deleted Successfully.");
				$("#myModalbrandassign").modal('hide');
			}
		});
	}else{
		successmsg("Invalid Request!");
	}
			
}
	
	
	
	
	