var code_ajax = $("#code_ajax").val();

var pageno = 1;
var rowno = 0;
var searchenable = false;



function getProducts(pagenov, rownov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    $.ajax({
        method: 'POST',
        url: 'get_pending_product_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage
        },
        success: function (response) {
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
    var perpage = $('#perpage').val();

    $.ajax({
        method: 'POST',
        url: 'get_pending_product_data.php',
        data: {
            code: code_ajax,
            prod_name: search_namevalue,
            page: page,
            rowno: 0,
            perpage: perpage
        },
        success: function (response) {
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

function viewRecord(id) {
    location.href = "view_pending_product.php?id=" + id;
}


function perpage_filter() {
    $.busyLoadFull("show");
    var search_namevalue = $('#search_name').val();
    var perpage = $('#perpage').val();

    $.ajax({
        method: 'POST',
        url: 'get_pending_product_data.php',
        data: {
            code: code_ajax,
            prod_name: search_namevalue,
            page: 1,
            rowno: 0,
            perpage: perpage
        },
        success: function (response) {
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


$(document).ready(function () {
    getProducts(pageno, rowno);

    $("#searchName").click(function (event) {
        event.preventDefault();
        var count = 1;
        var search_namevalue = $('#search_name').val();
        var perpage = $('#perpage').val();

        // successmsg("search "+search_namevalue );
        if (search_namevalue == "" || search_namevalue == null) {

            successmsg("Please enter search text");
        } else {
            $.busyLoadFull("show");

            $.ajax({
                method: 'POST',
                url: 'get_pending_product_data.php',
                data: {
                    code: code_ajax,
                    prod_name: search_namevalue,
                    page: 1,
                    rowno: 0,
                    perpage: perpage
                },
                success: function (response) {
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