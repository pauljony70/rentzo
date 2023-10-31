<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
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
            <h4 class="page-title">All Country</h4>
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
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal">Add Country</button>
                  </div>
                  <div class="col-md-6 mb-2">
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
                </div>
              </div>

              <div class="work-progres">

                <div class="table-responsive">
                  <table class="table table-hover" id="tblname">
                    <thead class="thead-light">
                      <tr>
                        <th>Sno</th>
                        <th>Country</th>
                        <th>Country Code</th>
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
<script src="js/admin/manage_country.js"></script>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Country</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" id="add_country_form" enctype="multipart/form-data">

          <div class="form-group">
            <label for="name">Country</label>
            <input type="text" class="form-control" id="country" placeholder="Country">
          </div>
          <div class="form-group">
            <label for="name">Country Code</label>
            <input type="text" class="form-control" id="country_code" placeholder="Country Code">
          </div>

          <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_country_btn">Add</button>
        </form>
      </div>

    </div>

  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalupdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Country</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" id="update_country_form" enctype="multipart/form-data">

          <div class="form-group">
            <label for="name">Country</label>
            <input type="text" class="form-control" id="update_country" placeholder="Country">
          </div>
          <div class="form-group">
            <label for="name">Country Code</label>
            <input type="text" class="form-control" id="update_country_code" placeholder="Country Code">
          </div>

          <input type="hidden" class="form-control" id="attribute_id">
          <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_country_btn">Update </button>
        </form>
      </div>

    </div>

  </div>
</div>