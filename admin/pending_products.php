<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
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
                  <h4 class="page-title">Pending Products</h4>
               </div>
            </div>
         </div>
         <!-- end page title -->
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">

                     <div class="row align-items-center">
                        <div class="col-md-6 mb-2">

                           <form>
                              <div class="form-group mb-0 d-flex">
                                 <input type="text" placeholder="Name.." name="search" class="form-control" id="search_name" style="width: 220px;">
                                 <button type="submit" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light ml-1" id="searchName"><i class="fa fa-search"></i></button>
                              </div>
                           </form>
                        </div>
                        <div class="col-md-6 mb-2">

                           <div class="d-flex align-items-center">
                              <div class="ml-md-auto">
                                 <div class="d-flex align-items-center">
                                    <span>Show</span>
                                    <select class="form-control mx-1" id="perpage_all" name="perpage" onchange="perpage_filter()" style="float:left;">
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

                     <div class="work-progres">
                        <div class="table-responsive">
                           <table class="table table-hover" id="tblname">
                              <thead class="thead-light">
                                 <tr>
                                    <th>Sno</th>
                                    <th>Image</th>
                                    <th>ProductID</th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody id="tbodyPostid">
                              </tbody>
                           </table>
                        </div>
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
                     <div class="clearfix"> </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="col_1">
      <div class="clearfix"> </div>
   </div>
</div>
<?php include("footernew.php"); ?>
<script src="js/admin/pending-manage-product.js"></script>