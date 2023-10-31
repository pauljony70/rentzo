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
<style>
  .select2.select2-container {
    width: 200px !important;
  }
</style>
<?php
$stmt = $conn->prepare(
  "SELECT
  user_unique_id,
  fullname
  FROM
    appuser_login"
);

$stmt->execute();

$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
?>
<!-- main content start-->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">All Wallet Transactions</h4>
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
                  <div class="col-md-10">
                    <form class="form d-flex flex-wrap">
                      <input type="text" placeholder="Transaction Id" class="form-control mr-1 mb-2" name="search" style="width:200px;" id="search_name">
                      <select class="form-control mr-1 mb-2" id="payment_type" name="payment_type"  style="width:200px;">
                        <option value="">Select payment type ...</option>
                        <option value="0">Affiliate commission</option>
                        <option value="1">Add money</option>
                      </select>
                      <select class="form-control select_data mr-1 mb-2" id="user_id" name="user_id" style="width:200px;">
                        <option value="">Select user</option>
                        <?php foreach ($users as $user) : ?>
                          <option value="<?= $user['user_unique_id'] ?>"><?= $user['fullname'] ?> (<?= $user['user_unique_id'] ?>)</option>
                        <?php endforeach; ?>
                      </select>
                      <input type="date" name="from_date" class="form-control mr-1 mb-2" id="from_date" style="width:170px;">
                      <input type="date" name="to_date" class="form-control mr-1 mb-2" id="to_date" style="width:170px;">
                      <button type="submit" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light mb-2" id="searchName"><i class="fa fa-search"></i></button>
                    </form>
                  </div>
                  <div class="col-md-2 mb-2">
                    <div class="d-flex align-items-center">
                      <div class="ml-md-auto">
                        <div class="d-flex align-items-center">
                          <span>Show</span>
                          <select class="form-control mx-1" id="perpage" name="perpage" onchange="getTransactions(1)" style="float:left;">

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
                        <th>User Details</th>
                        <th>Order Details</th>
                        <th>Transaction details</th>
                        <th>Amount</th>
                        <th>Remark</th>
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
<script src="js/admin/wallet-transactions.js"></script>