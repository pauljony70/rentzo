<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Brand)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<!-- main content start-->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">All Wallet Withdrawal Requests</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div data-example-id="simple-form-inline">
                                <div class="row align-items-center">
                                    <div class="col-md-6 mb-2"></div>
                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="ml-md-auto">
                                                <div class="d-flex align-items-center">
                                                    <span>Show</span>
                                                    <select class="form-control mx-1" id="perpage" name="perpage" onchange="getWalletWithdrawRequests(1)" style="float:left;">

                                                        <option value="10">10</option>

                                                        <option value="25">25</option>

                                                        <option value="50">50</option>

                                                    </select>
                                                    <span class="pull-right per-pag">entries</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="work-progres">
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered" id="tblname">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Sno</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Transaction ID</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cat_list">
                                        </tbody>
                                    </table>
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

                            <div class="col_1">


                                <div class="clearfix"> </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<?php include("footernew.php"); ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="add_payment_form" enctype="multipart/form-data">
                    <b>Account holder name - <span id="account_holder_name" class="text-blue"></span></b><br>
                    <b>Account number - <span id="account_number" class="text-blue"></span></b><br>
                    <b>Bank name - <span id="bank_name" class="text-blue"></span></b><br>
                    <b>Bank Address - <span id="bank_address" class="text-blue"></span></b><br>
                    <div class="form-group">
                        <label for="name">Transaction ID</label>
                        <input type="text" class="form-control" id="transaction_id" placeholder="Transaction ID">
                    </div>

                    <div class="form-group">
                        <label for="image">Invoice Image</label>
                        <input type="file" name="invoice_proof" id="invoice_proof" class="form-control-file" onchange="uploadFile1('invoice_proof')" accept="image/png, image/jpeg,image/jpg,image/gif">
                    </div>
                    <input type="hidden" id="user_id">
                    <input type="hidden" id="payment_id">
                    <input type="hidden" id="wallet_transaction_id">
                    <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_payment_btn">Add</button>
                </form>
            </div>

        </div>

    </div>
</div>
<script src="js/admin/wallet-withdraw-requests.js"></script>