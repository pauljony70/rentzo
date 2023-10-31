<?php
include('session.php');

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
                  <h4 class="page-title">All Attributes</h4>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">
                     <div data-example-id="simple-form-inline">
                        <div class="row align-items-center">
                           <div class="col-md-6 mb-2">
                              <button type="button" class="btn btn-danger waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal">Add Attributes</button>
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
                                    <th>Attributes</th>

                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody id="cat_list">
                              </tbody>
                           </table>
                        </div>
                        <div class="clearfix"> </div>

                     </div>

                     <div class="col_1">

                        <div class="clearfix"> </div>

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
               </div>
            </div>
         </div>

      </div>
   </div>
</div>
<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->
<script src="js/admin/manage_attributes.js"></script>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="width:50%;">

      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Attributes</h4>
         </div>
         <div class="modal-body">
            <form class="form" id="add_attributes_form" enctype="multipart/form-data">

               <div class="form-group">
                  <label for="name">Attributes <span id="notess">(Create new product attributes like - Size, Color, Dimension etc. Note -To add values in
                        attribute click on view button (for example -> Size - S / M/ L/ XL).)</span></label>
                  <input type="text" class="form-control" id="attributes" placeholder="Attributes">
               </div>


               <button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="add_attributes_btn">Add</button>
            </form>
         </div>

      </div>

   </div>
</div>