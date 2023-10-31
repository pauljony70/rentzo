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
        url: 'get_brand_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);

            var data = parsedJSON.data;
            $(data).each(function () {
                var btnactive = "";
                if (this.statuss == "0") {
                    btnactive = '<span class = "Pending">' + "Pending" + '</span>';
                } else if (this.statuss == "1") {
                    btnactive = '<span class = "Active">' + "Active " + '</span>';
                } else if (this.statuss == "3") {
                    btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                }
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td><img src="' + this.img + '" style="width: 72px; height: 72px;"></td><td > ' + this.name + '</td><td > ' + btnactive + '</td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}


function brand_product(pagenov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_brand_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);

            var data = parsedJSON.data;
            $(data).each(function () {

                var btnactive = "";
                if (this.statuss == "0") {
                    btnactive = '<span class = "Pending">' + "Pending" + '</span>';
                } else if (this.statuss == "1") {
                    btnactive = '<span class = "Active">' + "Active " + '</span>';
                } else if (this.statuss == "3") {
                    btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                }
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td><img src="' + this.img + '" style="width: 72px; height: 72px;"></td><td > ' + this.name + '</td><td > ' + btnactive + '</td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}


$(document).ready(function () {
    getBrand(pageno, rowno);


    $("#add_brand_btn").click(function (event) {
        event.preventDefault();

        var namevalue = $('#name').val();
        var brand_image = $('#brand_image').val();
        var name_ar = $('#name').val();

        if (!namevalue) {
            successmsg("Please enter Brand Name");
        } else
            if (!brand_image) {
                successmsg("Please select Brand Image");
            } else

                if (namevalue && brand_image && name_ar) {
                    $.busyLoadFull("show");
                    var file_data = $('#brand_image').prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('brand_image', file_data);
                    form_data.append('namevalue', namevalue);
                    form_data.append('code', code_ajax);
                    form_data.append('name_ar', name_ar);

                    $.ajax({
                        method: 'POST',
                        url: 'add_brand_process.php',
                        data: form_data,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            $.busyLoadFull("hide");
                            $("#myModal").modal('hide');
                            $('#name').val('');
                            $('#brand_image').val('');
                            getBrand(1, 0)
                            successmsg(response);
                            $('#name_ar').val('');
                            $('#brand_image').val('');
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
        success: function (response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();


            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);

            var data = parsedJSON.data;
            $(data).each(function () {
                var btnactive = "";
                if (this.statuss == "0") {
                    btnactive = '<span class = "Pending">' + "Pending" + '</span>';
                } else if (this.statuss == "1") {
                    btnactive = '<span class = "Active">' + "Active " + '</span>';
                } else if (this.statuss == "3") {
                    btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                }
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td><img src="' + this.img + '" style="width: 72px; height: 72px;"></td><td > ' + this.name + '</td><td > ' + btnactive + '</td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });
        }
    });
}



