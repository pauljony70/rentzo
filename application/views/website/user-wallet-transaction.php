<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "My Wallet Transactions";
    include("include/headTag.php") ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        /* Datepicker CSS */
        .datepicker {
            top: 210px;
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0;
        }

        .datepicker {
            background-color: #fff;
            border: none;
            border-radius: 0 !important;
            box-shadow: 0px 2px 8px 0px;
        }

        .datepicker-dropdown {
            top: 0;
            left: 0;
        }

        .datepicker table tr td.today,
        span.focused {
            border-radius: 50% !important;
            background-image: linear-gradient(#FFF3E0, #FFE0B2);
        }

        .datepicker table tr td.today.range {
            background-image: linear-gradient(#ff6600, #ff6600) !important;
            border-radius: 0 !important;
        }

        thead tr:nth-child(3) th {
            font-weight: bold !important;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .dow,
        .old-day,
        .day,
        .new-day {
            width: 40px !important;
            height: 40px !important;
            border-radius: 0px !important;
            padding-top: 3px !important;
        }

        .old-day:hover,
        .day:hover,
        .new-day:hover,
        .month:hover,
        .year:hover,
        .decade:hover,
        .century:hover {
            border-radius: 50% !important;
            background-color: #eee;
        }

        .active {
            border-radius: 50% !important;
            background-image: linear-gradient(#90CAF9, #64B5F6) !important;
            color: #fff !important;
        }

        .range-start,
        .range-end {
            border-radius: 50% !important;
            background-image: linear-gradient(#ff6600, #ff6601) !important;
        }

        .prev,
        .next,
        .datepicker-switch {
            border-radius: 0 !important;
            padding: 10px 10px 10px 10px !important;
            text-transform: uppercase;
            font-size: 14px;
            opacity: 0.8;
        }

        .prev:hover,
        .next:hover,
        .datepicker-switch:hover {
            background-color: inherit !important;
            opacity: 1;
        }

        .btn-black {
            background-color: #37474F !important;
            color: #fff !important;
            width: 100%;
        }

        .btn-black:hover {
            color: #fff !important;
            background-color: #000 !important;
        }

        /* Page CSS */
        .money_cards {
            width: 40px;
            height: 40px;
        }

        /*  .fix_month_height {
            overflow-x: auto;
            white-space: nowrap;
        }

        .fix_month_height::-webkit-scrollbar-track {
            background-color: #f1f1f1;
            border-radius: 5px;
        }

        .fix_month_height::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 5px;
        }

        .fix_month_height::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        } */

        .search-container {
            display: flex;
            align-items: center;
            padding: 3.7px 3px;
            width: 100%;
            background-color: #f5f5f6;
            border-radius: 3px;
            border: 0.5px solid #cdcdcd;
        }

        .select_wallet_dropdown {
            padding: 7px 0px;
            color: #656869;
            background: #f3f3f3;
            border: 1px solid #cccccc;
            border-radius: 3px;
        }

        .select_wallet_dropdown:hover {
            padding: 7px 0px;
            color: #656869;
            background: #f3f3f3;
            border: 1px solid #cccccc;
        }

        .search-input {
            flex: 1;
            outline: none;
            padding: 5px;
            background-color: #f5f5f6;
            border: none;
        }

        .search-icon {
            fill: #888;
            width: 16px;
            height: 16px;
            margin-right: 5px;
        }

        .months {
            background-color: #ffb481;
            position: sticky;
            top: 0;
        }

        .months p {
            padding-top: 0.4rem !important;
        }

        .trans_list {
            height: calc(100vh - 216px);
            overflow-y: scroll;
        }

        @media screen and (max-width:992px) {

            .trans_list {
                height: calc(100vh - 165px);
            }
        }

        @media screen and (max-width:767px) {

            .trans_list {
                height: calc(100vh - 201px);
            }
        }

        .trans_list::-webkit-scrollbar {
            width: 0em;
        }

        .trans_list::-webkit-scrollbar-track {
            background: transparent;
        }

        .trans_list::-webkit-scrollbar-thumb {
            background-color: transparent;
            outline: 1px solid transparent;
        }

        .date_search_btn {
            padding: 8px 0px;
            border-radius: 2px;
            margin: 0px 1px
        }

        .date_search_trans {
            background-color: white;
            padding: 10px 0px;
            max-width: 1360px;
            margin: auto;
        }

        .data-div {
            margin-bottom: 20px;
        }

        /* ==================================================================== */
        .input-daterange input[readonly] {
            background-color: #fff !important;
        }

        #transactions-loader {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.6);
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>

<body>
    <?php include("include/loader.php") ?>
    <?php include("include/topbar.php") ?>
    <?php include("include/navbar.php") ?>

    <main>
        <section class="row px-0 position-relative mt-2">
            <div class="col-sm-12 col-md-12 p-0 trans_list">
                <div class="main_container mx-0 h-100">
                    <?php foreach ($wallet_summery as $month => $wallet_summary) : ?>
                        <div class="container data-div px-1">
                            <div class="months">
                                <p class="p-1 fs-5 mx-5 fw-bolder"><?= $month ?></p>
                            </div>
                            <div class="">
                                <?php
                                foreach ($wallet_summary as $key => $transactions) :
                                    if ($transactions['transaction_type'] == 'cr') {
                                        $transaction_type = '+';
                                        $transaction_class = 'text-success';
                                        $transaction_img = '5';
                                    } else {
                                        $transaction_type = '-';
                                        $transaction_class = 'text-danger';
                                        $transaction_img = '6';
                                    }
                                    if ($transactions['status'] != 1) {
                                        $transaction_class = 'text-warning';
                                    }
                                ?>
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="<?php echo base_url; ?>assets_web/images/<?= $transaction_img ?>.png" class="money_cards">
                                        </div>
                                        <div class="col-7 p-0">
                                            <span class="fw-bolder">
                                                <?= $transactions['remark'] ?>
                                                <?= $transactions['status'] != 1 ? '<span class="text-warning">(Pending)</span>' : '' ?>
                                            </span>
                                            <p class="text-muted"><?php echo date('d M Y h:i A', strtotime($transactions['created_at'])); ?></p>
                                        </div>
                                        <div class="col-3 <?= $default_language == 1 ? 'text-start' : 'text-end' ?>">
                                            <span class="fw-bolder <?php echo $transaction_class; ?>"><?php echo $transaction_type . ' ' . price_format($transactions['amount']); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div id="transactions-loader" class="d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

        </section>
    </main>


    <?php include("include/script.php") ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.input-daterange').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
            });

        });

        $('.transaction_search_btn').click(function(event) {
            event.preventDefault();
            $(this).prop('disabled', true);
            // Remove the d-none class to show the loader
            $('#transactions-loader').removeClass('d-none');
            var transaction_id = $("#transaction_id").val();
            var payment_type = $("#payment_type").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();

            if (transaction_id != '' || payment_type != '' || start_date != '' || end_date != '') {
                $.ajax({
                    method: "post",
                    url: site_url + "search-transaction-data",
                    data: {
                        language: default_language,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        start_date: start_date,
                        end_date: end_date,
                        [csrfName]: csrfHash,
                    },
                    success: function(response) {
                        setTimeout(() => {
                            var walletSummaryContainer = $('.main_container');
                            // Add the d-none class to hide the loader
                            $('#transactions-loader').addClass('d-none');
                            $('.transaction_search_btn').prop('disabled', false);
                            walletSummaryContainer.empty();
                            if (response.status) {
                                $.each(response.Information, function(month, walletSummary) {
                                    var monthDiv = $('<div class="container data-div px-1"></div>');
                                    var monthsDiv = $('<div class="months"></div>');
                                    var monthHeader = $('<p class="p-1 fs-5 mx-5 fw-bolder">' + month + '</p>');
                                    var transaction_type = '';
                                    var transaction_class = '';
                                    var transaction_img = '';

                                    monthsDiv.append(monthHeader);
                                    monthDiv.append(monthsDiv);

                                    $.each(walletSummary, function(key, transaction) {
                                        if (transaction.transaction_type == 'cr') {
                                            transaction_type = '+';
                                            transaction_class = 'text-success';
                                            transaction_img = '5';
                                        } else {
                                            transaction_type = '-';
                                            transaction_class = 'text-danger';
                                            transaction_img = '6';
                                        }
                                        if (transaction.status != 1) {
                                            transaction_class = 'text-warning';
                                        }

                                        var row = $('<div class="row"></div>');
                                        var col1 = $('<div class="col-2"></div>');
                                        var col2 = $('<div class="col-7 p-0"></div>');
                                        var col3 = $('<div class="col-3 text-end"></div>');

                                        col1.append('<img src="' + site_url + 'assets_web/images/' + transaction_img + '.png" class="money_cards">');
                                        col2.append('<span class="fw-bolder">' + (transaction.remark + (transaction.status != 1 ? '<span class="text-warning"> (Pending)</span>' : '')) + '</span>');

                                        col2.append('<p class="text-muted">' + transaction.created_at + '</p>');
                                        col3.append('<span class="fw-bolder ' + transaction_class + '">' + transaction_type + ' ' + transaction.amount + '</span>');


                                        row.append(col1, col2, col3);
                                        monthDiv.append(row);
                                    });

                                    walletSummaryContainer.append(monthDiv);
                                });
                            } else {
                                walletSummaryContainer.html(
                                    `<div class="container px-0 h-100">
                                        <div class="card h-100 p-2">
                                            <div class="box-shadow-4 d-flex align-items-center justify-content-center h-100">
                                                <img src="${site_url}assets_web/images/no_transaction.jpg" alt="" style="height: 30vh;"/>
                                            </div>
                                        </div>
                                    </div>`
                                );
                            }
                        }, 500);
                    },
                });
            }
        });
    </script>

</body>

</html>