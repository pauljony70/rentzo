<?php

include('session.php');



if (!isset($_SESSION['admin'])) {

    header("Location: index.php");
}



?>

<?php include("header.php"); ?>

<input type="hidden" name="seller_id" id="seller_id" value="<?php echo $_SESSION['admin']; ?>">

<!-- main content start-->

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Forward Sales Report</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div data-example-id="simple-form-inline">

                                <div class="row align-items-center">
                                    <div class="col-md-9 mb-2">
                                        <form class="form d-flex flex-wrap">

                                            <input type="text" placeholder="Search.." class="form-control mr-1" name="search" style="width:130px;" id="search_name">


                                            <select class="form-control mr-1" id="orderstatus" name="orderstatus" style="width:150px;" required>

                                                <option value="">All Status</option>

                                                <option value="cancelled">Cancelled</option>

                                                <option value="Return Request">Return Request</option>

                                                <option value="Returned Completed">Return Completed</option>

                                                <option value="RTO">RTO</option>

                                            </select>


                                            <input type="date" class="form-control mr-1" name="from_date" style="width:130px;" id="from_date">
                                            <input type="date" class="form-control mr-1" name="to_date" style="width:130px;" id="to_date">

                                            <select style="display:none;" class="form-control" id="export_data" name="export_data" style="width:90px;">

                                                <option value="">Export</option>

                                                <option value="1">Excel</option>

                                                <option value="2">Pdf</option>


                                            </select>


                                            <button type="submit" href="javascript:void(0)" class="btn btn-danger" id="searchName"><i class="fa fa-search"></i></button>&nbsp;



                                        </form>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="ml-md-auto">
                                                <div class="d-flex align-items-center">
                                                    <span>Show</span>
                                                    <select class="form-control mx-1" id="perpage" name="perpage" onchange="perpage_filter()" style="float:left;">

                                                        <option value="10">10</option>

                                                        <option value="25">25</option>

                                                        <option value="50">50</option>

                                                    </select>
                                                    <span class="pull-right per-pag">entries</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="float-md-right">
                                            <button id="excel_export" class="btn btn-success">Excel</button>
                                            <button id="pdf_export" class="btn btn-warning">PDF</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="work-progres">

                                <div class="table-responsive">

                                    <table class="table table-hover" id="tblname" style="overflow-x: auto;">

                                        <thead class="thead-light">

                                            <tr>

                                                <th>S.N.</th>
                                                <th>ORDER DATE</th>
                                                <th>ORDER ID</th>
                                                <th>BILL NO</th>
                                                <th>HSN CODE</th>
                                                <th>ORDER MONTH</th>
                                                <th>QUANTITY</th>
                                                <th>ORDER STATUS</th>
                                                <th>DELIVERY DATE</th>
                                                <th>SUPPLIER NAME</th>
                                                <th>STATE</th>
                                                <th>PIN CODE OF SUPPLIER</th>
                                                <th>END CONSUMER STATE</th>
                                                <th>END CONSUMER PIN</th>
                                                <th>TAXABLE AMOUNT</th>
                                                <th>GST AMOUNT</th>
                                                <th>GST RATE</th>
                                                <th>EBUY PRICE</th>
                                                <th>EBUY CHARGES</th>
                                                <th>TOTAL BILLING VALUE</th>
                                                <th>REVERSE SHIPPING CHARGES</th>
                                                <th>GST RATE</th>
                                                <th>GST ON REVERSE SHIPPING</th>
                                                <th>REVERSE SHIPPING CHARGES INCLUDE GST</th>


                                            </tr>

                                        </thead>

                                        <tbody id="tbodyPostid">



                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <div class="clearfix"> </div>

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="pull-right" style="float:left;">
                                        Total Row : <a id="totalrowvalue" class="totalrowvalue"></a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right page_div ml-auto" style="float:right;"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>





        <div class="clearfix"></div>

    </div>
</div>

<!-- //calendar -->





<div class="col_1">





    <div class="clearfix"> </div>



</div>



</div>

</div>

</div>


<!--footer-->

<?php include("footernew.php"); ?>

<!--//footer-->
<script>
    function exportData() {
        var csv = "";
        var header = document.querySelectorAll("#tblname thead tr");
        var rows = document.querySelectorAll("#tblname tbody tr");
        for (var i = 0; i < header.length; i++) {
            var cells = header[i].querySelectorAll("th");
            for (var j = 0; j < cells.length; j++) {
                csv += cells[j].innerText + ",";
            }
            csv += "\n";
        }
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].querySelectorAll("td");
            for (var j = 0; j < cells.length; j++) {
                csv += cells[j].innerText + ",";
            }
            csv += "\n";
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var downloadLink = document.createElement("a");
                downloadLink.href = window.URL.createObjectURL(new Blob([xhr.responseText]));
                downloadLink.download = "seller_transection.csv";
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }
        };
        xhr.open("POST", "export_seller_transection_data.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("csv=" + encodeURIComponent(csv));
    }


    document.querySelector("#excel_export").addEventListener("click", exportData);

    function exportpdfData() {
        var header = [];
        var rows = [];
        var headerCells = document.querySelectorAll("#tblname thead th");
        for (var i = 0; i < headerCells.length; i++) {
            header.push(headerCells[i].innerText);
        }
        var rowCells = document.querySelectorAll("#tblname tbody tr td");
        var rowCount = document.querySelectorAll("#tblname tbody tr").length;
        var colCount = header.length;
        for (var i = 0; i < rowCount; i++) {
            var row = [];
            for (var j = 0; j < colCount; j++) {
                row.push(rowCells[(i * colCount) + j].innerText);
            }
            rows.push(row);
        }

        var doc = new jsPDF();

        doc.setFontSize(18);
        doc.text("Table Export", 15, 15);

        var pdfTable = {
            headers: header,
            rows: rows
        };

        doc.autoTable(pdfTable);

        doc.save("table.pdf");
    }
    document.querySelector("#pdf_export").addEventListener("click", exportpdfData);
</script>

<script src="js/admin/manage_reverse_seller_transaction.js"></script>