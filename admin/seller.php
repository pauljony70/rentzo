<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ManageSeller)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}

//echo "admin is ".$_SESSION['admin'];
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
                        <h4 class="page-title">All Seller</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div data-example-id="simple-form-inline">
                                <div class="row align-items-center">
                                    <div class="col-6 mb-2">
                                        <div class="text-right">
                                            <form>
                                                <div class="form-group mb-0 d-flex">
                                                    <input type="text" placeholder="Search.." name="search" class="form-control" id="search_name" style="width: 220px;">
                                                    <button type="submit" href="javascript:void(0)" class="btn btn-danger ml-1" id="searchName"><i class="fa fa-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
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
                                    <div class="col-6 mb-2">
                                        <form>
                                            <div class="form-group mb-0 d-flex">
                                                <select class="form-control " id="selectgroup" name="selectgroup" onchange="groupfilter()" style="width: 270px;">
                                                    <?php
                                                    echo '<option value="blank">All Group </option>';

                                                    function categoryTree($parent_id = 0, $sub_mark = '')
                                                    {
                                                        global $conn;
                                                        $query = $conn->query("SELECT * FROM seller_group where status ='1' ORDER BY name ASC");

                                                        if ($query->num_rows > 0) {
                                                            while ($row = $query->fetch_assoc()) {
                                                                echo '<option value="' . $row['sno'] . '">' . $sub_mark . $row['name'] . '</option>';
                                                                // categoryTree($row['cat_id'], $sub_mark.'---');
                                                            }
                                                        }
                                                    }
                                                    categoryTree();


                                                    ?>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>

                            <div class="work-progres">

                                <div class="table-responsive">
                                    <table class="table table-hover" id="tblname" style="overflow-x: auto;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>SellerID</th>
                                                <th>Name</th>
                                                <th>CompanyName</th>
                                                <th>email</th>
                                                <th>Phone</th>
                                                <th>Country</th>
                                                <th>Group</th>
                                                <th>Seller Since</th>

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
    <!-- //calendar -->


    <div class="col_1">


        <div class="clearfix"> </div>

    </div>

</div>
<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->
<script src="js/admin/manage_seller.js"></script>