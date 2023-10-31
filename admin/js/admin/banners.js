var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getBanners(pagenov, rownov) {
	 showloader();
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_banners_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage
        },
        success: function(response) {
            hideloader();
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td><img src="' + this.img + '" style="width: 72px; height: 72px;"></td><td > ' + this.type + '</td><td > ' +this.name + '</td>';
                html += '<td> <button type="submit" class= "btn btn-danger btn-sm pull-left" name="delete" onclick="deleteBanners(' + this.id + ');">DELETE</button>';

                html += '</td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

$(document).ready(function() {
    getBanners(pageno, rowno);
	
	
	$("#add_banner_btn").click(function(event){
		event.preventDefault();
		
		var banner_type = $('#banner_type').val();
		var banner_image = $('#banner_image').val();
		var product_name = $('#product_name').val();
		
		var product_id = $("#product-id").val();

		var cat_id = $(".check_category_limit:radio:checked").val();
		var type = '';
		if(banner_type ==1){
			if($('.check_category_limit:radio:checked').length ==0 ){
				successmsg("Please select atleast one Category");					
			}else{
				type = 'yes';
			}
		}else if(banner_type ==3){
			if(!product_name){
				successmsg("Please enter Product Name");
			}else{
				type = 'yes';
			}
	
		}else{
			if(!product_id){
				successmsg("Please select Product");
			}else{
				type = 'yes';
			}
		}
		
		if(!banner_image){
			successmsg("Please select Banner Image");
		}
			
		if(banner_type && banner_image && type=='yes'){				
			 showloader();
			var file_data = $('#banner_image').prop('files')[0];
			var form_data = new FormData();
			form_data.append('banner_image', file_data);
			form_data.append('banner_type', banner_type);
			form_data.append('product_id', product_id);
			form_data.append('cat_id', cat_id);
			form_data.append('product_name', product_name);
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'add_banner_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					hideloader();
					$("#myModal").modal('hide');
					$("#product-id").val('');
					$("#search-box").val('');
					$('#banner_image').val('');
					$('#product_name').val('');
					$("input:radio").attr("checked", false);
					getBanners(1, 0)
					successmsg(response);	
                    
				}
			});
		}
			
    });
	
	

});

// AJAX call for autocomplete 
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "add_banner_process.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});
//To select product name
function selectCountry(val,id) {
	$("#search-box").val(val);
	$("#product-id").val(id);
	$("#suggesstion-box").hide();
}
function banner_type1(){
	var banner_type = $("#banner_type").val();
	if(banner_type ==1){
		$("#parent_cat_div").show();
		$("#product_div").hide();
		$("#search_div").hide();
		$("#product-id").val('');
		$("#search-box").val('');
	}else if(banner_type ==3){
		$("#search_div").show();
		$("#parent_cat_div").hide();
		$("#product_div").hide();
		$("#product-id").val('');
		$("#search-box").val('');
	}else{
		$("#parent_cat_div").hide();
		$("#search_div").hide();
		$("#product_div").show();
		$("input:radio").attr("checked", false);
	}
}


function deleteBanners(id) {

	 xdialog.confirm('Are you sure want to delete?', function() {
		showloader();
		$.ajax({
			method: 'POST',
			url: 'delete_banners.php',
			data: { deletearray: id, code:code_ajax },
			success: function(response) {
				hideloader();
				if(response =='Failed to Delete.'){
					successmsg("Failed to Delete.");
				}else if(response =='Deleted'){
					$("#tr"+id).remove();
					successmsg("Banner Deleted Successfully.");
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


	