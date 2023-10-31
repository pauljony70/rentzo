<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
   header("Location: index.php");
}

if (!isset($_GET['id'])) {
   header("Location: manage_product.php");
}
$record_exist = 'N';


$prod_unique_id = trim($_GET['id']);

$stmt15 = $conn->prepare("SELECT status, prod_name,prod_type,prod_desc,prod_fulldetail,prod_img_url,featured_img, attr_set_id,brand_id,web_url,
            product_sku,product_visibility,product_manuf_country,product_hsn_code,product_video_url,return_policy_id  
            FROM product_details pd  WHERE pd.product_unique_id='" . $prod_unique_id . "'	");

$stmt15->execute();
$data = $stmt15->bind_result(
   $status,
   $prod_name,
   $prod_type,
   $prod_desc,
   $prod_fulldetail,
   $prod_img_url,
   $featured_img,
   $attr_set_id,
   $brand_id,
   $web_url,
   $product_sku,
   $product_visibility,
   $product_manuf_country,
   $product_hsn_code,
   $product_video_url,
   $return_policy_id
);

while ($stmt15->fetch()) {
   $record_exist = 'Y';
}


if ($record_exist == 'N') {
   header("Location: manage_product.php");
}

//include header
include("header.php");
?>
<style>
   .subList {
      list-style-type: none;
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
                  <h4 class="page-title">View Product</h4>
               </div>
            </div>
         </div>
         <!-- end page title -->
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">
                     <div class="bs-example widget-shadow" data-example-id="hoverable-table">
                        <div class="row align-items-center">
                           <div class="col-md-6 mb-2">
                              <button id="back_btn" type="submit" class="btn btn-dark waves-effect waves-light" onclick="back_page('manage_product.php');"><i class="fa fa-arrow-left"></i> Back</button>
                           </div>
                        </div>


                        <div class="form-three widget-shadow">
                           <form class="form-horizontal" id="myform" action="edit_product_process.php" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="code" value="<?php echo $code_ajax; ?>" />

                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Attribute Set** </label>
                                 <div class="col-sm-8">
                                    <select class="form-control" disabled id="selectattrset" name="selectattrset">
                                       <?php
                                       $stmtas = $conn->prepare("SELECT sno, name FROM attribute_set WHERE status ='1' ORDER BY name ASC");
                                       $stmtas->execute();
                                       $data = $stmtas->bind_result($col1, $col2);

                                       while ($stmtas->fetch()) {
                                          if ($attr_set_id == $col1) {
                                             echo '<option value="' . $col1 . '" selected>' . $col2 . '</option>';
                                          } else {
                                             echo '<option value="' . $col1 . '">' . $col2 . '</option>';
                                          }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Category Set** </label>
                                 <div id="example1" class="col-sm-8">
                                    <div id="treeSelect">
                                       <div class="pt-2 pl-2">
                                          <?php
                                          $stmtcs = $conn->prepare("SELECT cat_id	FROM product_category WHERE prod_id= '" . $prod_unique_id . "'");
                                          $stmtcs->execute();
                                          $data = $stmtcs->bind_result($cat_id);

                                          $product_cat = array();
                                          while ($stmtcs->fetch()) {
                                             $product_cat[] = $cat_id;
                                          }

                                          $query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND status ='1' ORDER BY cat_name ASC");

                                          if ($query->num_rows > 0) {
                                             while ($row = $query->fetch_assoc()) {
                                                //echo "SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' ";
                                                $query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1'");
                                                //	print_r($query1);
                                                if ($query1->num_rows > 0) {
                                                   echo '<span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><span class="mainList">' . $row['cat_name'] . '</span>
                              						<br />    
                              						<ul id="ul' . $row['cat_id'] . '" class="subList"  style="display:block;">';
                                                   echo categoryTree($row['cat_id'], $product_cat);
                                                   echo   '</ul>';
                                                } else {
                                                   if (in_array($row['cat_id'], $product_cat)) {
                                                      echo '<span class="expand"><input type="checkbox" disabled checked name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><span class="mainList"> ' . $row['cat_name'] . '</span><br />';
                                                   } else {
                                                      echo '<span class="expand"><input type="checkbox" disabled name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><span class="mainList"> ' . $row['cat_name'] . '</span><br />';
                                                   }
                                                }
                                             }
                                          }

                                          function categoryTree($parent_id, $product_cat)
                                          {
                                             global $conn;
                                             $query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id  AND status ='1' ORDER BY cat_name ASC");

                                             if ($query->num_rows > 0) {
                                                while ($row = $query->fetch_assoc()) {

                                                   $query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1'");
                                                   //	print_r($query1);
                                                   if ($query1->num_rows > 0) {
                                                      echo '<span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><span class="mainList">' . $row['cat_name'] . '</span>
                              						<br />    
                              						<ul id="ul' . $row['cat_id'] . '" class="subList" style="display:block;">';
                                                      echo categoryTree($row['cat_id'], $product_cat);
                                                      echo '</ul>';
                                                   } else {
                                                      if (in_array($row['cat_id'], $product_cat)) {
                                                         echo '<li><input type="checkbox" disabled checked name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> ' . $row['cat_name'] . '</li>';
                                                      } else {
                                                         echo '<li><input type="checkbox" disabled name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> ' . $row['cat_name'] . '</li>';
                                                      }
                                                   }
                                                }
                                             }
                                          }
                                          ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Name **</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled id="prod_name" name="prod_name" value="<?php echo $prod_name; ?>" placeholder="Name" required>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Type</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled id="prod_type" name="prod_type" value="<?php if ($prod_type == 1) {
                                                                                                                                 echo 'Simple';
                                                                                                                              } else if ($prod_type == 2) {
                                                                                                                                 echo 'Configurable';
                                                                                                                              } ?>" placeholder="Name" required>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">SKU</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled id="prod_sku" name="prod_sku" value="<?php echo $product_sku; ?>" placeholder="SKU auto generate">
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">URL key</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled id="prod_url" name="prod_url" value="<?php echo $web_url; ?>">
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Short details **</label>
                                 <div class="col-sm-8">
                                    <textarea rows="6" cols="65" disabled id="prod_short" disabled placeholder="Miximum 300 letters"><?php echo $prod_desc; ?></textarea>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Full Details **</label>
                                 <div class="col-sm-8">
                                    <textarea rows="6" cols="65" disabled id="editor" name="prod_details" required placeholder="Miximum 1000 letters"><?php echo $prod_fulldetail; ?></textarea>
                                 </div>
                              </div>
                              <?php
                              $stmtr = $conn->prepare("SELECT vp.id, vp.product_mrp,vp.product_sale_price,vp.product_stock, sl.companyname,vp.stock_status,vp.product_tax_class, vp.product_remark ,vp.product_purchase_limit FROM vendor_product vp, sellerlogin sl WHERE vp.product_id ='" . $prod_unique_id . "' AND sl.seller_unique_id= '" . $_SESSION['admin'] . "' AND sl.seller_unique_id=vp.vendor_id ORDER BY sl.companyname ASC");

                              $stmtr->execute();
                              $data = $stmtr->bind_result($vp_id, $product_mrp, $product_sale_price, $product_stock, $companyname, $stock_status, $product_tax_class, $product_remark, $product_purchase_limit);

                              while ($stmtr->fetch()) {
                              }

                              ?>

                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">MRP **</label>
                                 <div class="col-sm-8">
                                    <input type="number" disabled class="form-control" id="prod_mrp" name="prod_mrp" value="<?php echo $product_mrp; ?>" required>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Sale Price **</label>
                                 <div class="col-sm-8">
                                    <input type="number" disabled class="form-control" id="prod_price" name="prod_price" value="<?php echo $product_sale_price; ?>" required>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">TAX Class </label>
                                 <div class="col-sm-8">
                                    <select class="form-control" disabled id="selecttaxclass" name="selecttaxclass">
                                       <?php
                                       $stmtt = $conn->prepare("SELECT tax_id, name,percent FROM tax WHERE status ='1' ORDER BY name ASC");
                                       $stmtt->execute();
                                       $data = $stmtt->bind_result($idt, $namet, $per);

                                       while ($stmtt->fetch()) {
                                          if ($product_tax_class == $idt) {
                                             echo '<option value="' . $idt . '" selected>' . $namet . '</option>';
                                          } else {
                                             echo '<option value="' . $idt . '">' . $namet . '</option>';
                                          }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Quantity</label>
                                 <div class="col-sm-8">
                                    <input type="number" disabled class="form-control" id="prod_qty" name="prod_qty" value="<?php echo $product_stock; ?>" <br><br>
                                    <!--<button type="submit" return false;" class="btn btn-sm btn-warning"  style="float:left; display: inline-block; margin-right:20px;" >Advanced Inventory</button>-->

                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Stock Status</label>
                                 <div class="col-sm-8">

                                    <select class="form-control" disabled id="selectstock" name="selectstock">
                                       <option value="In Stock" <?php if ($stock_status == 'In Stock') {
                                                                     echo 'selected';
                                                                  } ?>>In Stock</option>
                                       <option value="Out of Stock" <?php if ($stock_status == 'Out of Stock') {
                                                                        echo 'selected';
                                                                     } ?>>Out of Stock</option>

                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Visibility</label>
                                 <div class="col-sm-8">
                                    <select class="form-control" disabled id="selectvisibility" name="selectvisibility">
                                       <option value="">Select</option>
                                       <?php
                                       $stmtv = $conn->prepare("SELECT id, name FROM visibility ORDER BY id ASC");
                                       $stmtv->execute();
                                       $data = $stmtv->bind_result($idv, $namev);

                                       while ($stmtv->fetch()) {
                                          if ($product_visibility == $idv) {
                                             echo '<option value="' . $idv . '" selected>' . $namev . '</option>';
                                          } else {
                                             echo '<option value="' . $idv . '">' . $namev . '</option>';
                                          }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Country of Manufacture </label>
                                 <div class="col-sm-8">
                                    <select class="form-control" disabled id="selectcountry" name="selectcountry">
                                       <option value="">Select</option>
                                       <?php
                                       $stmtc = $conn->prepare("SELECT id, name, countrycode FROM country ORDER BY name ASC");
                                       $stmtc->execute();
                                       $data = $stmtc->bind_result($idc, $namec, $countrycode);
                                       $return = array();
                                       $i = 0;
                                       while ($stmtc->fetch()) {
                                          if ($product_manuf_country == $idc) {
                                             echo '<option value="' . $idc . '" selected>(' . $countrycode . ')' . $namec . '</option>';
                                          } else {
                                             echo '<option value="' . $idc . '">(' . $countrycode . ')' . $namec . '</option>';
                                          }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">HSN Code </label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" disabled id="prod_hsn" name="prod_hsn" value="<?php echo $product_hsn_code; ?>" placeholder="Product HSN code">
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Purchase Limit for Customer </label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control " disabled id="prod_hsn" name="prod_hsn" value="<?php echo $product_purchase_limit; ?>" placeholder="Product HSN code">
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Select Brand **</label>
                                 <div class="col-sm-8">
                                    <select class="form-control" disabled id="selectbrand" name="selectbrand">
                                       <?php
                                       $stmtb = $conn->prepare("SELECT brand_id, brand_name FROM brand WHERE status ='1' ORDER BY brand_order ASC");

                                       $stmtb->execute();
                                       $data = $stmtb->bind_result($brand_id1, $brand_name);

                                       while ($stmtb->fetch()) {
                                          if ($brand_id == $brand_id1) {
                                             echo '<option value="' . $brand_id1 . '" selected>' . $brand_name . '</option>';
                                          } else {
                                             echo '<option value="' . $brand_id1 . '">' . $brand_name . '</option>';
                                          }
                                       }

                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Select Return Policy</label>
                                 <div class="col-sm-8">
                                    <select class="form-control" disabled id="return_policy" name="return_policy">
                                       <option value="">Select</option>
                                       <?php
                                       $stmtr = $conn->prepare("SELECT id, title FROM product_return_policy WHERE status ='1' ORDER BY title ASC");

                                       $stmtr->execute();
                                       $data = $stmtr->bind_result($idr, $titler);

                                       while ($stmtr->fetch()) {
                                          if ($return_policy_id == $idr) {
                                             echo '<option value="' . $idr . '" selected>' . $titler . '</option>';
                                          } else {
                                             echo '<option value="' . $idr . '">' . $titler . '</option>';
                                          }
                                       }

                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <?php

                              $stmtcp = $conn->prepare("SELECT product_sku,price, mrp ,stock FROM product_attribute_value WHERE product_id = '" . $prod_unique_id . "' AND vendor_prod_id ='" . $vp_id . "'");

                              $stmtcp->execute();
                              $data = $stmtcp->bind_result($product_sku, $prices, $mrps, $stocks);

                              if ($product_sku) {

                              ?>
                                 <div class="form-group row align-items-center">
                                    <label for="focusedinput" class="col-sm-2 control-label m-0">Configurations</label>
                                    <div class="col-sm-8">
                                       <div id="configurations_div_html table-responsive">
                                          <table class="table table-hover table-bordered table-centered">
                                             <thead class="thead-light">
                                                <tr>
                                                   <th>Product Name</th>
                                                   <th>Product SKU</th>
                                                   <th>Sale Price</th>
                                                   <th>MRP </th>
                                                   <th>STOCK </th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php

                                                while ($stmtcp->fetch()) {


                                                ?>
                                                   <tr id="remove_attr_tr1">
                                                      <td><?php echo $product_sku; ?></td>
                                                      <td><input type="text" name="prod_skus[]" readonly="" value="<?php echo $product_sku; ?>"></td>
                                                      <td><input type="number" disabled name="sale_price[]" readonly="" class="sale_prices" value="<?php echo $prices; ?>" style="width: 100%;"></td>
                                                      <td><input type="number" disabled name="mrp_price[]" readonly="" class="mrp_price" value="<?php echo $mrps; ?>" style="width: 100%;"></td>
                                                      <td><input type="number" disabled name="stocks[]" readonly="" value="<?php echo $stocks; ?>" style="width: 100%;"></td>

                                                   </tr>

                                                <?php } ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              <?php } ?>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Remarks</label>
                                 <div class="col-sm-8">
                                    <input type="text" disabled class="form-control" id="prod_remark" name="prod_remark" value="<?php echo $product_remark; ?>">
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="exampleInputFile" class="col-sm-2 control-label m-0">Featured Images</label>
                                 <div class="col-sm-8">

                                    <div class="d-flex flex-wrap mt-1">
                                       <div class="thumbnail">
                                          <div class="image view view-first">
                                             <?php
                                             $featured_decod =  json_decode($featured_img);

                                             $img = MEDIAURL . $featured_decod->{$img_dimension_arr[2][0] . '-' . $img_dimension_arr[2][1]};
                                             ?>
                                             <img height="75" style="width: 100%; display: block;" src="<?php echo $img; ?>" onerror="this.src='images/placeholder-image.png';"/>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="exampleInputFile" class="col-sm-2 control-label m-0">Product Images</label>
                                 <div class="col-sm-8 input-files">

                                    <div class="d-flex flex-wrap mt-1">
                                       <?php
                                       $prod_img_decode =  json_decode($prod_img_url);

                                       if (is_array($prod_img_decode)) {
                                          $im = 0;
                                          foreach ($prod_img_decode as $prod_imgs) {
                                             $img1 = MEDIAURL . $prod_imgs->{$img_dimension_arr[2][0] . '-' . $img_dimension_arr[2][1]};
                                       ?>
                                             <div class="mr-1 mb-2" id="imgs_div<?php echo $im; ?>">
                                                <div class="thumbnail">
                                                   <div class="image view view-first">
                                                      <div class="mask">
                                                         <div class="tools tools-bottom">

                                                         </div>
                                                      </div>
                                                      <img height="75" style="width: 100%; display: block;" src="<?php echo $img1; ?>" onerror="this.src='images/placeholder-image.png';"/>

                                                   </div>
                                                </div>
                                             </div>
                                       <?php $im++;
                                          }
                                       } ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Youtube Video ID</label>
                                 <div class="col-sm-8">
                                    <input type="text" disabled class="form-control" id="prod_youtubeid" value="<?php echo $product_video_url; ?>" name="prod_youtubeid">
                                 </div>
                              </div>


                              </br></br>
                           </form>





                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php //} 
         ?>
         <div class="clearfix"> </div>
      </div>
      <div class="clearfix"> </div>
   </div>
</div>
<div class="col_1">
   <div class="clearfix"> </div>
</div>
<?php include("footernew.php"); ?>
<script src="<?php echo BASEURL; ?>assets/tinymce/tinymce.min.js"></script>

<script>
   $(document).ready(function() {
      if ($("#editor").length > 0) {
         tinymce.init({
            selector: "textarea#editor",
            theme: "modern",
            readonly: 1,
            height: 300,
            plugins: [
               "advlist lists print",
               //  "wordcount code fullscreen",
               "save table directionality emoticons paste textcolor"
            ],
            toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
         });
      }

      if ($("#prod_short").length > 0) {
         tinymce.init({
            selector: "textarea#prod_short",
            theme: "modern",
            readonly: 1,
            height: 300,
            plugins: [
               "advlist lists print",
               //  "wordcount code fullscreen",
               "save table directionality emoticons paste textcolor"
            ],
            toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

         });
      }
   });

   function deleteRecord(cat_id) {
      var rejectreason = $("#rejectreason" + cat_id).val();

      if (!rejectreason) {
         successmsg("Please select Reject Reason.");
      } else {
         xdialog.confirm('Are you sure want to reject Product?', function() {
            $.busyLoadFull("show");
            $.ajax({
               method: 'POST',
               url: 'verfiy_pending_products.php',
               data: {
                  code: '<?php echo $code_ajax; ?>',
                  record_id: cat_id,
                  rejectreason: rejectreason
               },
               success: function(response) {
                  $.busyLoadFull("hide");
                  if (response == 'Failed to Delete.') {
                     successmsg("Failed to Rejected.");
                  } else if (response == 'Deleted') {

                     successmsg("Product Rejected Successfully.");
                     location.href = "pending_products.php";
                  }
               }
            });
         }, {
            style: 'width:420px;font-size:0.8rem;',
            buttons: {
               ok: 'yes ',
               cancel: 'no '
            },
            oncancel: function() {
               // console.warn('Cancelled!');
            }
         });
      }
   }

   function verifyRecord(cat_id) {

      xdialog.confirm('Are you sure want to verify Product?', function() {
         $.busyLoadFull("show");
         $.ajax({
            method: 'POST',
            url: 'verfiy_pending_products.php',
            data: {
               code: '<?php echo $code_ajax; ?>',
               verify_record_id: cat_id
            },
            success: function(response) {
               $.busyLoadFull("hide");
               if (response == 'Failed to verfiy.') {
                  successmsg("Failed to verify.");
               } else if (response == 'Verify') {
                  successmsg("Product Verified Successfully.");
                  location.href = "pending_products.php";

               }
            }
         });
      }, {
         style: 'width:420px;font-size:0.8rem;',
         buttons: {
            ok: 'yes ',
            cancel: 'no '
         },
         oncancel: function() {
            // console.warn('Cancelled!');
         }
      });
   }
</script>