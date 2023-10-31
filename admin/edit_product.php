<?php
include('session.php');


if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
   echo "<script>location.href='no-premission.php'</script>";
   die();
}

if (!isset($_SESSION['admin'])) {
   header("Location: index.php");
}

if (!isset($_GET['id'])) {
   header("Location: manage_product.php");
}
$record_exist = 'N';


$prod_unique_id = trim($_GET['id']);

$stmt15 = $conn->prepare("SELECT status, prod_name,prod_desc,prod_fulldetail,prod_img_url,featured_img, attr_set_id,brand_id,web_url,
   		product_sku,product_visibility,product_manuf_country,product_hsn_code,product_video_url,return_policy_id ,meta_title,meta_key,meta_value,is_heavy ,
		prod_name_ar,prod_desc_ar,prod_fulldetail_ar,shipping,prod_weight,pm.prod_meta_ar,pm.prod_keyword_ar,pm.prod_meta_desc_ar
   		FROM product_details pd LEFT JOIN product_meta pm ON pd.product_unique_id = pm.prod_id WHERE pd.product_unique_id='" . $prod_unique_id . "'	");

$stmt15->execute();
$data = $stmt15->bind_result(
   $status,
   $prod_name,
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
   $return_policy_id,
   $meta_title,
   $meta_key,
   $meta_value,
   $is_heavy,
   $prod_name_ar,
   $prod_desc_ar,
   $prod_fulldetail_ar,
   $shipping,
   $prod_weight,$prod_meta_ar,$prod_keyword_ar,$prod_meta_desc_ar
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
   .ms-options-wrap>.ms-options {
      width: 96.5% !important;
      border: 1px solid #ced4da !important;
      border-radius: .2rem !important;
   }

   .ms-options-wrap>.ms-options .ms-selectall:hover {
      text-decoration: none !important;
   }

   .switch {
      position: relative;
      display: block;
      vertical-align: top;
      width: 66.5px;
      height: 30px;
      padding: 3px;
      margin: 0 10px 10px 0;
      background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
      background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
      border-radius: 18px;
      box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
      cursor: pointer;
      box-sizing: content-box;
   }

   .switch-input {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      box-sizing: content-box;
   }

   .switch-label {
      position: relative;
      display: block;
      height: inherit;
      font-size: 10px;
      text-transform: uppercase;
      background: #eceeef;
      border-radius: inherit;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
      box-sizing: content-box;
   }

   .switch-label:before,
   .switch-label:after {
      position: absolute;
      top: 50%;
      margin-top: -.5em;
      line-height: 1;
      -webkit-transition: inherit;
      -moz-transition: inherit;
      -o-transition: inherit;
      transition: inherit;
      box-sizing: content-box;
   }

   .switch-label:before {
      content: attr(data-off);
      right: 11px;
      color: #aaaaaa;
      text-shadow: 0 1px rgba(255, 255, 255, 0.5);
   }

   .switch-label:after {
      content: attr(data-on);
      left: 11px;
      color: #FFFFFF;
      text-shadow: 0 1px rgba(0, 0, 0, 0.2);
      opacity: 0;
   }

   .switch-input:checked~.switch-label {
      background: #FF6600;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
   }

   .switch-input:checked~.switch-label:before {
      opacity: 0;
   }

   .switch-input:checked~.switch-label:after {
      opacity: 1;
   }

   .switch-handle {
      position: absolute;
      top: 4px;
      left: 4px;
      width: 28px;
      height: 28px;
      background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
      background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
      border-radius: 100%;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
   }

   .switch-handle:before {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      margin: -6px 0 0 -6px;
      width: 12px;
      height: 12px;
      background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
      background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
      border-radius: 6px;
      box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
   }

   .switch-input:checked~.switch-handle {
      left: 40px;
      box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
   }

   .switch-label,
   .switch-handle {
      transition: All 0.3s ease;
      -webkit-transition: All 0.3s ease;
      -moz-transition: All 0.3s ease;
      -o-transition: All 0.3s ease;
   }

   li {
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
                  <h4 class="page-title">Edit Product</h4>
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
                              <a> <span class="text-danger ml-2">&#42;&#42;</span> required field</a>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Enable Product</label>
                                 <div class="col-sm-8">
                                    <label class="switch">
                                       <input class="switch-input" type="checkbox" id="togglebtn" name="enableproduct" <?php if ($status == 1) {
                                                                                                                           echo 'checked';
                                                                                                                        } ?> value="1" />
                                       <span class="switch-label" data-on="On" data-off="Off"></span>
                                       <span class="switch-handle"></span>
                                    </label>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Attribute Set<span class="text-danger ml-2">&#42;&#42;</span> </label>
                                 <div class="col-sm-8">
                                    <select class="form-control" id="selectattrset" name="selectattrset">
                                       <option value="">Select</option>
                                       <?php
                                       $stmtas = $conn->prepare("SELECT sno, name FROM attribute_set where status ='1' ORDER BY name ASC");
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
                              <?php
                              // $stmtas = $conn->prepare("SELECT sno, name FROM attribute_set where status ='1' ORDER BY name ASC");
                              // $stmtas->execute();
                              // $data = $stmtas->bind_result($col1, $col2);
                              ?>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Category Set<span class="text-danger ml-2">&#42;&#42;</span> </label>
                                 <div id="example1" class="col-sm-8">
                                    <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

                                    <div id="treeSelect">
                                       <ul id="myUL" class="pt-2">
                                          <?php
                                          $stmtcs = $conn->prepare("SELECT cat_id	FROM product_category WHERE prod_id= '" . $prod_unique_id . "'");
                                          $stmtcs->execute();
                                          $data = $stmtcs->bind_result($cat_id);

                                          $product_cat = array();
                                          while ($stmtcs->fetch()) {
                                             $product_cat[] = $cat_id;
                                          }

                                          $query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND  status ='1' ORDER BY cat_name ASC");

                                          if ($query->num_rows > 0) {
                                             while ($row = $query->fetch_assoc()) {
                                                $query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND  status ='1' ");

                                                if ($query1->num_rows > 0) {
                                                   echo '<li><span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><label class="mainList ml-1">' . $row['cat_name'] . '</label></li>
                              						    
                              						<ul id="ul' . $row['cat_id'] . '" class="subList"  style="display:block;">';
                                                   echo categoryTree($row['cat_id'], $product_cat);
                                                   echo   '</ul>';
                                                } else {
                                                   if (in_array($row['cat_id'], $product_cat)) {
                                                      echo '<li><span class="expand"><input type="checkbox" checked name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><label class="mainList ml-1"> ' . $row['cat_name'] . '</label></li>';
                                                   } else {
                                                      echo '<li><span class="expand"><input type="checkbox" name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"></span><label class="mainList ml-1"> ' . $row['cat_name'] . '</label></li>';
                                                   }
                                                }
                                             }
                                          }

                                          function categoryTree($parent_id, $product_cat)
                                          {
                                             global $conn;
                                             $query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id AND  status ='1'  ORDER BY cat_name ASC");

                                             if ($query->num_rows > 0) {
                                                while ($row = $query->fetch_assoc()) {

                                                   $query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND  status ='1'  ");
                                                   //	print_r($query1);
                                                   if ($query1->num_rows > 0) {
                                                      echo '<li><span class="expand" onClick=\'expand("' . $row['cat_id'] . '",this)\'>[-]</span><label class="mainList ml-1">' . $row['cat_name'] . '</label></li>
                              						
                              						<ul id="ul' . $row['cat_id'] . '" class="subList" style="display:block;">';
                                                      echo categoryTree($row['cat_id'], $product_cat);
                                                      echo '</ul>';
                                                   } else {
                                                      if (in_array($row['cat_id'], $product_cat)) {
                                                         echo '<li><input type="checkbox" checked name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"> <label class="mainList ml-1"> ' . $row['cat_name'] . '</label></li>';
                                                      } else {
                                                         echo '<li><input type="checkbox" name="category[]" value="' . $row['cat_id'] . '" class="check_category_limit" onclick="check_category_limit(this);"><label class="mainList ml-1"> ' . $row['cat_name'] . '</label></li>';
                                                      }
                                                   }
                                                }
                                             }
                                          }
                                          ?>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              <input type="hidden" id="product_id" name="product_id" value="<?php echo $prod_unique_id; ?>">
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Name <span class="text-danger ml-2">&#42;&#42;</span></label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" id="prod_name" name="prod_name" value="<?php echo $prod_name; ?>" placeholder="Name" required>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Arabic Name <span class="text-danger">&#42;&#42;</span></label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" id="prod_name_ar" name="prod_name_ar" value="<?php echo $prod_name_ar; ?>" placeholder="Name" required>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">SKU</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" id="prod_sku" name="prod_sku" value="<?php echo $product_sku; ?>" placeholder="SKU auto generate">
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">URL key</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" id="prod_url" name="prod_url" value="<?php echo $web_url; ?>" placeholder="URL auto generate">
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Short details (ENG) <span class="text-danger ml-2">&#42;&#42;</span></label>
                                 <div class="col-sm-8">
                                    <textarea rows="6" cols="65" id="prod_short" name="prod_short" placeholder="Short description 300 letter" required maxlength="50"><?php echo $prod_desc; ?></textarea>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Full Details (ENG) <span class="text-danger ml-2">&#42;&#42;</span></label>
                                 <div class="col-sm-8">
                                    <textarea rows="6" cols="65" id="editor" name="prod_details" required placeholder="Miximum 1000 letters"><?php echo $prod_fulldetail; ?></textarea>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Short details (Arabic) <span class="text-danger ml-2">&#42;&#42;</span></label>
                                 <div class="col-sm-8">
                                    <textarea rows="6" cols="65" id="prod_short_ar" name="prod_short_ar" placeholder="Short description 300 letter" required maxlength="50"><?php echo $prod_desc_ar; ?></textarea>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Product Full Details (Arabic) <span class="text-danger ml-2">&#42;&#42;</span></label>
                                 <div class="col-sm-8">
                                    <textarea rows="6" cols="65" id="editor_ar" name="prod_details_ar" required placeholder="Miximum 1000 letters"><?php echo $prod_fulldetail_ar; ?></textarea>
                                 </div>
                              </div>
                              <div id="product_info"></div>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">HSN Code</label>
                                 <div class="col-sm-8">
                                    <select class="form-control" id="prod_hsn" name="prod_hsn">
                                       <option value="">Select HSN Code</option>
                                       <?php
                                       $stmtb = $conn->prepare("SELECT id, hsn_code FROM product_hsn_code where status ='1' ORDER BY id ASC");

                                       $stmtb->execute();
                                       $data = $stmtb->bind_result($id, $hsn_code);

                                       while ($stmtb->fetch()) {
                                          if ($product_hsn_code == $hsn_code) {
                                             echo '<option value="' . $hsn_code . '" selected>' . $hsn_code . '</option>';
                                          } else {
                                             echo '<option value="' . $hsn_code . '">' . $hsn_code . '</option>';
                                          }
                                       }

                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <!--<div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">HSN Code </label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" id="prod_hsn" name="prod_hsn" value="<?php // echo $product_hsn_code; 
                                                                                                                  ?>" placeholder="Product HSN code">
                                 </div>
                              </div>-->
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Weight(gm) </label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" id="prod_weight" name="prod_weight" value="<?php echo $prod_weight; ?>" placeholder="Product Weight">
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Select Brand <span class="text-danger ml-2">&#42;&#42;</span></label>
                                 <div class="col-sm-8">
                                    <select class="form-control" id="selectbrand" name="selectbrand">
                                       <option value="">Select</option>
                                       <?php
                                       $stmtb = $conn->prepare("SELECT brand_id, brand_name FROM brand where status ='1' ORDER BY brand_order ASC");

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
                                    <select class="form-control" id="return_policy" name="return_policy">
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
                              <div class="form-group row align-items-center">
                                 <label class="col-sm-2 control-label m-0">Visibility</label>
                                 <div class="col-sm-8">
                                    <select class="form-control" id="selectvisibility" name="selectvisibility">
                                       <option value="">Select</option>
                                       <?php
                                       $stmtv = $conn->prepare("SELECT id, name FROM visibility where status ='1' ORDER BY id ASC");
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
                                    <select class="form-control" id="selectcountry" name="selectcountry">
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
                              <div class="form-group" style="display:none;">
                                 <label class="col-sm-2 control-label m-0">Heavy Product</label>
                                 <div class="col-sm-8">
                                    <input type="checkbox" id="is_heavy" value='1' <?php if ($is_heavy == 1) {
                                                                                       echo "checked";
                                                                                    } ?> name="is_heavy">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="exampleInputFile" class="col-sm-2 control-label mt-1">Featured Images</label>
                                 <div class="col-sm-8">
                                    <div class="">
                                       <div>
                                          <input type="file" name="featured_img" id="featured_img" class="form-control-file" style="float:left; display: inline-block; margin-right:20px;" onchange="uploadFile1('featured_img')" required>
                                          <input type="hidden" name="featured_imgtxt" value="<?php echo urlencode($featured_img); ?>">
                                          <input type="hidden" name="prod_img_urltxt" id="prod_img_urltxt" value="<?php echo urlencode($prod_img_url); ?>">
                                       </div>
                                       </br>
                                    </div>
                                    <?php if ($featured_img) { ?>
                                       <div class="d-flex flex-wrap mt-3">
                                          <div class="thumbnail">
                                             <div class="image view view-first">
                                                <?php
                                                $featured_decod =  json_decode($featured_img);

                                                $img = MEDIAURL . $featured_decod->{$img_dimension_arr[2][0] . '-' . $img_dimension_arr[2][1]};
                                                ?>
                                                <img height="75;" style="width: 100%; display: block;" src="<?php echo $img; ?>" alt="" />
                                             </div>
                                          </div>
                                       </div>
                                    <?php } ?>
                                 </div>

                              </div>
                              <div class="form-group row">
                                 <label for="exampleInputFile" class="col-sm-2 control-label mt-2">Product Images</label>
                                 <div class="col-sm-8 input-files">
                                    <button type="button" class="btn btn-hover btn-dark waves-effect waves-light" id="moreImg"><i class="fa-solid fa-circle-plus"></i> Add More Image</button>
                                    <div class="d-flex flex-wrap mt-1">
                                       <?php
                                       $prod_img_decode =  json_decode($prod_img_url);

                                       if ($prod_img_decode) {
                                          $im = 0;
                                          foreach ($prod_img_decode as $prod_imgs) {
                                             //print_r($img_dimension_arr);
                                             //$img1 = MEDIAURL.$prod_imgs->{$img_dimension_arr[0][0].'-'.$img_dimension_arr[0][1]};
                                             $img1 = MEDIAURL . $prod_imgs->{$img_dimension_arr[3][0] . '-' . $img_dimension_arr[3][1]};
                                       ?>
                                             <div class="mr-1 mb-1" id="imgs_div<?php echo $im; ?>">
                                                <div class="d-flex flex-column" style="width: fit-content;">
                                                   <a class="text-right text-dark" href="javascript:void(0);" onclick="delete_images('<?php echo $prod_unique_id; ?>','<?php echo $im; ?>');" title="Delete">
                                                      <i class="fa-solid fa-circle-xmark"></i>
                                                   </a>
                                                   <div class="image-container">
                                                      <img style="display: block; height: 75px; width: auto;" src="<?php echo $img1; ?>" />
                                                   </div>
                                                </div>
                                             </div>
                                       <?php $im++;
                                          }
                                       } ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group" style="display:none">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Shipping Fees</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" id="shipping" value="<?php echo $shipping; ?>" name="shipping">
                                 </div>
                              </div>

                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Upload Video</label>
                                 <div class="col-sm-8">
                                    <input type="file" name="prod_youtubeid" id="prod_youtubeid" class="form-control-file">
                                    <input type="hidden" name="prod_youtube_txt" value="<?php echo urlencode($product_video_url); ?>">
                                 </div>
                              </div>

                              <!--<div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Youtube Video ID</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" id="prod_youtubeid" value="<?php //echo $product_video_url; 
                                                                                                         ?>" name="prod_youtubeid">
                                 </div>
                              </div>-->
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0"> Meta Title</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" id="prod_meta" name="prod_meta" value="<?php echo $meta_title; ?>" placeholder="60 Letters">
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Meta Keywords</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" id="prod_keyword" name="prod_keyword" value="<?php echo $meta_key; ?>" placeholder="250 letters">
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <label for="focusedinput" class="col-sm-2 control-label m-0">Meta Description</label>
                                 <div class="col-sm-8">
                                    <textarea class="form-control" rows="7" id="prod_meta_desc" name="prod_meta_desc" placeholder="150 letters"><?php echo $meta_value; ?></textarea>
                                 </div>
                              </div>
							  <div class="form-group row align-items-center">
								 <label for="focusedinput" class="col-sm-2 control-label">Arabic Meta Title</label>
								 <div class="col-sm-8">
									<input type="text" class="form-control" id="prod_meta_ar" name="prod_meta_ar" value="<?php echo $prod_meta_ar; ?>"  placeholder="60 Letters">
								 </div>
							  </div>
							  <div class="form-group row align-items-center">
								 <label for="focusedinput" class="col-sm-2 control-label">Arabic Meta Keywords</label>
								 <div class="col-sm-8">
									<input type="text" class="form-control" id="prod_keyword_ar" name="prod_keyword_ar"  value="<?php echo $prod_keyword_ar; ?>" placeholder="250 letters">
								 </div>
							  </div>
							  <div class="form-group row align-items-center">
								 <label for="focusedinput" class="col-sm-2 control-label">Arabic Meta Description</label>
								 <div class="col-sm-8">
									<textarea  class="form-control" rows="7" id="prod_meta_desc_ar" name="prod_meta_desc_ar" placeholder="150 letters"><?php echo $prod_meta_desc_ar; ?></textarea>
								 </div>
							  </div>
                              </br></br>
                              <div class="col-sm-offset-2">
                                 <button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="editProduct_btn">Update</button>
                              </div>
                           </form>
                        </div>
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
<div class="col_1">
   <div class="clearfix"> </div>
</div>
<?php include("footernew.php"); ?>
<script src="js/admin/edit-product.js"></script>