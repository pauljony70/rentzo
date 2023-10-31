var code_ajax = $("#code_ajax").val();

var pageno = 1;
var rowno = 0;
var searchenable = false;

function pagination_product(page) {
	showloader();
    var search_namevalue = $('#search_name').val();
    var perpage = $('#perpage').val();

    $.ajax({
        method: 'POST',
        url: 'get_search_product_data.php',
        data: {
            code: code_ajax,
            prod_name: search_namevalue,
            page: page,
            rowno: 0,
            perpage: perpage
        },
        success: function(response) {
			hideloader();
            var data = $.parseJSON(response);
            if (data["status"] == "1") {
                $("#tbodyPostid").empty();
                $("#tbodyPostid").html(data["tbl_html"]);
                $("#totalrowvalue").html(data["totalrowvalue"]);
                $(".page_div").html(data["page_html"]);
            } else {
                successmsg(" no product found. please try again");
            }
        }
    });

}


function perpage_filter() {
	 showloader();
    var search_namevalue = $('#search_name').val();
    var perpage = $('#perpage').val();

    $.ajax({
        method: 'POST',
        url: 'get_search_product_data.php',
        data: {
            code: code_ajax,
            prod_name: search_namevalue,
            page: 1,
            rowno: 0,
            perpage: perpage
        },
        success: function(response) {
			hideloader();
            var data = $.parseJSON(response);
            if (data["status"] == "1") {
                $("#tbodyPostid").empty();
                $("#tbodyPostid").html(data["tbl_html"]);
                $("#totalrowvalue").html(data["totalrowvalue"]);
                $(".page_div").html(data["page_html"]);
            } else {
                successmsg(" no product found. please try again");
            }
        }
    });
}

function addproduct(prod_id){
	window.open(
  'search_product.php?id='+prod_id,
  '_blank' // <- This is what makes it open in a new window.
);
}
$(document).ready(function() {

    
     $("#searchName").click(function(event) {
        event.preventDefault();
    var count = 1;
    var search_namevalue = $('#search_name').val();
    var perpage = $('#perpage').val();

    // successmsg("search "+search_namevalue );
    if (search_namevalue == "" || search_namevalue == null) {
       
        successmsg("Please enter search text");
    } else {
         showloader();

        $.ajax({
            method: 'POST',
            url: 'get_search_product_data.php',
            data: {
                code: code_ajax,
                prod_name: search_namevalue,
                page: 1,
                rowno: 0,
                perpage: perpage
            },
            success: function(response) {
				hideloader();
                var data = $.parseJSON(response);

                if (data["status"] == "1") {
                    $("#tblname").show();
                    $("#perpage_div").show();
                    $(".page_div").show();
                    $("#total_div").show();
                    $(".additional-links").hide();
                    $("#tbodyPostid").empty();
                    $("#tbodyPostid").html(data["tbl_html"]);
                    $("#totalrowvalue").html(data["totalrowvalue"]);
                    $(".page_div").html(data["page_html"]);
                } else {
                    successmsg(" no product found. please try again");
                }
            }
        });

    } //else close

 });

});