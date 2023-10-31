var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;

$(document).ready(function () {
    getWalletWithdrawRequests(pageno);

    $("#add_payment_btn").click(function (event) {
        event.preventDefault();

        var transaction_id = $('#transaction_id').val();
        var wallet_transaction_id = $('#wallet_transaction_id').val();
        var user_id = $('#user_id').val();
        var payment_id = $('#payment_id').val();
        var invoice_proof = $('#invoice_proof').val();

        if (!transaction_id) {
            successmsg("Please enter transaction Idz");
        } else if (!invoice_proof) {
            successmsg("Please choose invoice proof");
        } else if (transaction_id && invoice_proof && wallet_transaction_id && user_id && payment_id) {
            $.busyLoadFull("show");
            var file_data = $('#invoice_proof').prop('files')[0];
            var form_data = new FormData();
            form_data.append('invoice_proof', file_data);
            form_data.append('transaction_id', transaction_id);
            form_data.append('wallet_transaction_id', wallet_transaction_id);
            form_data.append('user_id', user_id);
            form_data.append('payment_id', payment_id);
            form_data.append('code', code_ajax);

            $.ajax({
                method: 'POST',
                url: 'send_amount_wallet_to_bank.php',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    $.busyLoadFull("hide");
                    $("#myModal").modal('hide');
                    $('#transaction_id').val('');
                    $('#invoice_proof').val('');
                    successmsg1(response, "wallet-withdraw-requests.php");
                }
            });
        } else {
            successmsg("Required feild missing");
        }

    });

    $(document).on("click", ".open-modal", function () {
        $('#account_holder_name').html($(this).data('accountHolderName'));
        $('#account_number').html($(this).data('accountNumber'));
        $('#bank_name').html($(this).data('bankName'));
        $('#bank_address').html($(this).data('bankAddress'));
        $('#user_id').val($(this).data('userId'));
        $('#payment_id').val($(this).data('payId'));
        $('#wallet_transaction_id').val($(this).data('walletTransactionId'));
    });
});


function getWalletWithdrawRequests(pagenov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    $.ajax({
        method: 'POST',
        url: 'get-wallet-withdraw-requests.php',
        data: {
            code: code_ajax,
            page: pagenov,
            perpage: perpage
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);

            var data = parsedJSON.data;
            $(data).each(function (index) {
                var btnactive = "";

                var html =
                    `<tr id="tr${this.id}">
                        <td>${((pagenov - 1) * perpage) + index + 1}</td>
                        <td>${this.fullname}</td>
                        <td>${this.amount}</td>
                        <td>${this.created_at}</td>
                        <td>${this.payment_status == 0 ? 'Pending' : 'Paid'}</td>
                        <td>${this.transaction_id}</td>
                        <td>${this.payment_status == 0 ? `<button type="submit" class="btn btn-danger waves-effect waves-light btn-sm pull-left open-modal" target="_blank" data-wallet-transaction-id="${this.wallet_transaction_id}" data-account-holder-name="${this.account_holder_name}" data-account-number="${this.account_number}" data-bank-name="${this.bank_name}" data-bank-address="${this.bank_address}" data-pay-id="${this.id}" data-user-id="${this.user_id}" data-toggle="modal" data-target="#myModal">Pay</button>` : ''}</td>
                    </tr>`;


                $("#cat_list").append(html);
            });



        }
    });
}