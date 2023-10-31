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
  .toggle-btn {
    background-color: #fff;
    border: none;
    color: #fff;
    cursor: pointer;
    font-size: 16px;
    padding: 10px;
    position: relative;
    transition: background-color 0.2s ease-in-out;
  }

  .toggle-btn:hover {
    background-color: #fff;
  }

  .fa-info {
    color: #ccc;
    font-size: 10px;
    border: 1px solid #ccc;
    border-radius: 50%;
    padding: 2px 5px;
  }

  .info-icon {
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    color: #000000;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    height: 20px;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    cursor: pointer;
    position: relative;
  }

  .hover-card {
    background-color: #000;
    border: 1px solid #000;
    border-radius: 5px;
    color: #fff;
    display: none;
    font-size: 12px;
    padding: 10px;
    position: absolute;
    bottom: calc(100% + 10px);
    left: 50%;
    transform: translateX(-50%);
    width: 200px;
    z-index: 1;
  }

  .arrow {
    position: absolute;
    bottom: -10px;
    left: calc(50% - 10px);
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-top: 10px solid #000;
  }

  .info-icon:hover .hover-card {
    display: block;
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
            <h4 class="page-title">Brands</h4>
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
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal">Add Brand</button>
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
              </br>
              <div class="work-progres">
                <div class="table-responsive">
                  <table class="table table-hover table-centered" id="tblname">
                    <thead class="thead-light">
                      <tr>
                        <th>Sno</th>
                        <th>Image</th>
                        <th>Brand Name (ENG)</th>
                        <th>Brand Name (Arabic)</th>
                        <th>Brand Website Link</th>
                        <th>Status</th>
                        <th>Popularity Status</th>
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
<script src="js/admin/brand.js"></script>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="form" id="add_brand_form" enctype="multipart/form-data">

          <div class="form-group">
            <label for="name">Brand Name (ENG)</label>
            <input type="text" class="form-control" id="name" placeholder="Brand Name">
          </div>
          <div class="form-group">
            <label for="name">Brand Name (Arabic)</label>
            <input type="text" class="form-control" id="name_ar" placeholder="Brand Name">
          </div>
          <div class="form-group">
            <label for="website_link">
              Brand Website Link
              <a class="toggle-btn">
                <span class="info-icon">
                  <i class="fa fa-info" aria-hidden="true"></i>
                  <span class="hover-card">
                    <span class="arrow"></span>
                    If url is provided then this brand will be visible on Buy from Turkey page.
                  </span>
                </span>
              </a>
            </label>
            <input type="text" class="form-control" id="brand_site_url" placeholder="Website Link">
          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="popular_brand">
              <label class="custom-control-label" for="popular_brand">This is a popular brand</label>
            </div>
          </div>
          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="brand_image" id="brand_image" class="form-control-file" onchange="uploadFile1('brand_image')" required accept="image/png, image/jpeg,image/jpg,image/gif">
          </div>
          <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_brand_btn">Add</button>
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
        <h5 class="modal-title">Edit Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="form" id="update_brand_form" enctype="multipart/form-data">

          <div class="form-group">
            <label for="name">Brand Name (ENG)</label>
            <input type="text" class="form-control" id="update_name" placeholder="Brand Name">
          </div>
          <div class="form-group">
            <label for="name">Brand Name (Arabic)</label>
            <input type="text" class="form-control" id="update_name_ar" placeholder="Brand Name">
          </div>
          <div class="form-group">
            <label for="website_link">
              Brand Website Link
              <a class="toggle-btn">
                <span class="info-icon">
                  <i class="fa fa-info" aria-hidden="true"></i>
                  <span class="hover-card">
                    <span class="arrow"></span>
                    If url is provided then this brand will be visible on Buy from Turkey page.
                  </span>
                </span>
              </a>
            </label>
            <input type="text" class="form-control" id="update_brand_site_url" placeholder="Website Link">
          </div>
          <div class="form-group">
            <label for="name">Status</label>
            <select class="form-control" id="statuss" name="status">
              <option value="">Select</option>
              <option value="0">Pending</option>
              <option value="1">Active</option>
              <option value="3">Deactive</option>
            </select>
          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="update_popular_brand">
              <label class="custom-control-label" for="update_popular_brand">This is a popular brand</label>
            </div>
          </div>
          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="update_brand_image" class="form-control-file" id="update_brand_image" onchange="uploadFile1('update_brand_image')" accept="image/png, image/jpeg,image/jpg,image/gif">

          </div>
          <input type="hidden" class="form-control" id="brand_id">
          <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_brand_btn">Update </button>
        </form>
      </div>

    </div>

  </div>
</div>