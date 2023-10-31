var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getAttribute(pagenov, rownov) {
	showloader();
    var perpage = $('#perpage').val();
    var main_attribute_id = $('#main_attribute_id').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_attribute_conf_val_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage,
            main_attribute_id: main_attribute_id
        },
        success: function(response) {
           hideloader();
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
						
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.main_attr + '</td><td > ' + this.attribute_value + '</td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}


function attribute_set_product(pagenov) {
	showloader();
    var perpage = $('#perpage').val();
    var main_attribute_id = $('#main_attribute_id').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_attribute_conf_val_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage,
            main_attribute_id: main_attribute_id
        },
        success: function(response) {
            hideloader();
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {						
               			
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.main_attr + '</td><td > ' + this.attribute_value + '</td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}


$(document).ready(function() {
    getAttribute(pageno, rowno);
	
	
	$("#add_attributes_btn").click(function(event){
		event.preventDefault();
		
		var namevalue = $('#attributes').val();
		
		if(!namevalue){
			successmsg("Please enter Attributes Name");
		}
		var main_attribute_id = $('#main_attribute_id').val();
		
		if(namevalue){				
			showloader();
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('main_attribute_id', main_attribute_id);
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'add_attribute_conf_val_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					hideloader();
					$("#myModal").modal('hide');
					$('#attributes').val('');
					getAttribute(1, 0)
					successmsg(response);	

				}
			});
		}
			
    });
	

});



function perpage_filter() {
	showloader();
    var perpage = $('#perpage').val();
	var main_attribute_id = $('#main_attribute_id').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_attribute_conf_val_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage,
			main_attribute_id:main_attribute_id
        },
        success: function(response) {
			hideloader();
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {						
                			
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.main_attr + '</td><td > ' + this.attribute_value + '</td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

function back_page(id){
	location.href="manage_conf_attributes.php";
}
	
	
	