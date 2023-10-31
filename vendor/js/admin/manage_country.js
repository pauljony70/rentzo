var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getCountry(pagenov, rownov) {
	showloader();
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
						
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + this.countrycode + '</td>';
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
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_tax_class_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
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
						
                 var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + this.countrycode + '</td>';
                html += '</tr>';
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
			successmsg("Please enter Tax Class");
		}
		
		if(country_code && country){				
			showloader();
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
					hideloader();
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
	

});



function perpage_filter() {
	showloader();
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
				 var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + this.countrycode + '</td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

	
	