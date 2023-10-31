var code_ajax = $("#code_ajax").val();

var pageno = $("#product_sel_page").val();
var rowno = 0;
var searchenable = false;



function getProducts(pagenov, rownov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
	var catidvalue = $('#selectcategory').children("option:selected").val();
    $.ajax({
        method: 'POST',
        url: 'get_product_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage,
			catid:catidvalue
        },
        success: function(response) {
			$.busyLoadFull("hide");
            var data = $.parseJSON(response);
            if (data["status"] == "1") {
                $("#tbodyPostid").empty();
                $("#tbodyPostid").html(data["tbl_html"]);
                $("#totalrowvalue").html(data["totalrowvalue"]);
                $(".page_div").html(data["page_html"]);
            } else {
                successmsg("No product found. please try again!");
            }

        }
    });
}





function pagination_product(page) {
	$.busyLoadFull("show");
    var search_namevalue = $('#search_name').val();
	var catidvalue = $('#selectcategory').children("option:selected").val();
    var perpage = $('#perpage').val();

    $.ajax({
        method: 'POST',
        url: 'get_product_data.php',
        data: {
            code: code_ajax,
            prod_name: search_namevalue,
            page: page,
            rowno: 0,
            perpage: perpage,
			catid:catidvalue
        },
        success: function(response) {
			$.busyLoadFull("hide");
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

function delete_products(product_id) {
    xdialog.confirm('Are you sure want to delete?', function() {
		$.busyLoadFull("show");
        $.ajax({
            method: 'POST',
            url: 'delete_product_data.php',
            data: {
                code: code_ajax,
                product_id: product_id
            },
            success: function(response) {
				$.busyLoadFull("hide");
                var data = $.parseJSON(response);
                if (data["status"] == "1") {
                    successmsg(data["message"]);
                    $("#tr"+product_id).remove();
                } else {
                    successmsg("No product found. please try again!");
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

function perpage_filter() {
	 $.busyLoadFull("show");
    var search_namevalue = $('#search_name').val();
	var catidvalue = $('#selectcategory').children("option:selected").val();
    var perpage = $('#perpage').val();

    $.ajax({
        method: 'POST',
        url: 'get_product_data.php',
        data: {
            code: code_ajax,
            prod_name: search_namevalue,
            page: 1,
            rowno: 0,
            perpage: perpage,
			catid:catidvalue
        },
        success: function(response) {
			$.busyLoadFull("hide");
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

function enable_disable_product(id, prod_id) {
	 $.busyLoadFull("show");
    if ($(".enable_prod" + id).prop('checked') == true) {
        var status = 1;
    } else {
        var status = 0;
    }
    $.ajax({
        method: 'POST',
        url: 'edit_product_process.php',
        data: {
            code: code_ajax,
            status: status,
            prod_id: prod_id
        },
        success: function(response) {
			 $.busyLoadFull("hide");
        }
    });
}

$(document).ready(function() {
    getProducts(pageno, rowno);
    
     $("#searchName").click(function(event) {
        event.preventDefault();
    var count = 1;
    var search_namevalue = $('#search_name').val();
	var catidvalue = $('#selectcategory').children("option:selected").val();
    var perpage = $('#perpage').val();

    // successmsg("search "+search_namevalue );
    if (search_namevalue == "" || search_namevalue == null) {
       
        successmsg("Please enter search text");
    } else {
         $.busyLoadFull("show");

        $.ajax({
            method: 'POST',
            url: 'get_product_data.php',
            data: {
                code: code_ajax,
                prod_name: search_namevalue,
                page: 1,
                rowno: 0,
                perpage: perpage,
				catid:catidvalue
            },
            success: function(response) {
				$.busyLoadFull("hide");
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

    } //else close

 });

});