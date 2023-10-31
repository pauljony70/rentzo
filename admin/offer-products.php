<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Offer)) {
  echo "<script>location.href='no-premission.php'</script>";
  die();
}

if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<style>
  .product-image {
    width: 50px;
    height: 70px;
    margin-right: 10px;
    object-fit: contain;
  }

  .product-title {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
  }

  .select2-results__option[aria-selected=true] {
    display: none;
  }
</style>

<!-- main content start-->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">Offer Products</h4>
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
                  <div class="col-md-6 mb-2">
                    <div class="text-right">
                      <form>
                        <div class="form-group mb-0 d-flex">
                          <input type="text" placeholder="Name.." name="search" class="form-control" id="search_name" style="width: 220px;">
                          <button type="submit" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light ml-1" id="searchName"><i class="fa fa-search"></i></button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-6 mb-2">
                    <div class="d-flex align-items-center">
                      <div class="ml-md-auto">
                        <div class="d-flex align-items-center">
                          <span>Show</span>
                          <select class="form-control mx-1" id="perpage" name="perpage" onchange="getOfferProducts(1)" style="float:left;">

                            <option value="10">10</option>

                            <option value="25">25</option>

                            <option value="50">50</option>

                          </select>
                          <span class="pull-right per-pag">entries</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-2">
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal">Add Offer</button>
                  </div>
                </div>
              </div>

              <div class="work-progres">
                <button type="submit" class="btn btn-dark mb-2 delete-btn" name="button" disabled>Delete</button>
                <div class="table-responsive">
                  <table class="table table-hover table-centered" id="tblname">
                    <thead class="thead-light">
                      <tr>
                        <th>
                          <input type="checkbox" id="select-all" name="" value="">
                        </th>
                        <th>Sno</th>
                        <th>Image</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
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
<script src="js/admin/offer-products.js"></script>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Offer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" id="add_offer_form" enctype="multipart/form-data">

          <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="text" class="form-control" id="start_date" placeholder="Start Date">
          </div>
          <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="text" class="form-control" id="end_date" placeholder="End Date">
          </div>
          <div class="form-group">
            <label for="name">Search for products</label>
            <select id="select2-remote-data"></select>
          </div>
          <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_offer_btn">Add</button>
        </form>
      </div>

    </div>

  </div>
</div>