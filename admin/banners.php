<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

?>
<?php include("header.php"); ?>
<style>

#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<script src ="js/admin/banners.js"></script>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			
				<div  data-example-id="simple-form-inline">
        
		 
         <div style=" display: inline-block;  vertical-align: middle">
         </div>
      </div>
	   </br>	
		 <div class="work-progres">
             <header class="widget-header">
            <div class="pull-right" style="float:left;">
			
               Total Row :	<a id="totalrowvalue" class="totalrowvalue"></a>
            </div>
            <h4 class="widget-title"><b>All Banners </b> <button type="button" class="btn btn-primary" id="" data-toggle="modal" data-target="#myModal">Add Banners</button>
		</h4>
			
         </header>      
				<hr class="widget-separator">
		
		<div class="table-responsive">
            <table class="table table-hover"  id="tblname" >
               <thead>
                  <tr>
                     <th>Sno</th>                    
                     <th>Image</th>          
                     <th>Type</th>
                     <th>Category/Product</th>
                     
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
				
			</div>
		</div>
		</div>
	<!--footer-->
        <?php include("footernew.php"); ?>
    <!--//footer-->

	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Banners</h4>
      </div>
      <div class="modal-body"> 
		<form class="form" id="add_brand_form"  enctype="multipart/form-data">
			
			<div class="form-group"> 
				<label for="name">Banner Type</label> 
				<select class="form-control1" id="banner_type" onchange="banner_type1()">
					
					<option value="1">Category</option>
					<option value="2">Product</option>
					<option value="3">Custom Search</option>
					
				</select>
			</div>
			<div class="form-group" id="parent_cat_div"> 
				<label for="name">Select Category</label> 
				<div class="dropdownss">
					<div id="treeSelect"> 
						<?php
							
                            $query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND status='1' ORDER BY cat_name ASC");
                            
                            if($query->num_rows > 0){
                                while($row = $query->fetch_assoc()){
									$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' AND status='1' ");
									if($query1->num_rows > 0){
										echo '<span class="expand" ><input type="radio" name="parent_cat" value="'.$row['cat_id'].'" class="check_category_limit"></span><span class="mainList">'.$row['cat_name'].'</span>
											<br />    
											<ul id="'.$row['cat_name'].'" class="subList" style="display:block;">';
												echo categoryTree($row['cat_id'], $sub_mark."&nbsp;&nbsp;&nbsp;");
										echo	'</ul>';
									}else{
										echo '<span class="expand"><input type="radio" name="parent_cat" value="'.$row['cat_id'].'" class="check_category_limit"></span><span class="mainList"> '.$row['cat_name'].'</span>
											<br />';
									}
								}
							}
                                                                                                         
                            function categoryTree($parent_id, $sub_mark = ''){
                                global $conn;
                                $query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id AND status='1' ORDER BY cat_name ASC");
                                
                                if($query->num_rows > 0){
                                    while($row = $query->fetch_assoc()){
											
										$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '".$row['cat_id']."' AND status='1' ");
										if($query1->num_rows > 0){
											echo '<span class="expand"><input type="radio" name="parent_cat" value="'.$row['cat_id'].'" class="check_category_limit"></span><span class="mainList">'.$row['cat_name'].'</span>
												<br />    
												<ul id="'.$row['cat_name'].'" class="subList" style="display:block;">';
													echo categoryTree($row['cat_id'], $sub_mark."&nbsp;&nbsp;&nbsp;");
											echo '</ul>';
											
										}else{
											echo '<li><input type="radio" name="parent_cat" value="'.$row['cat_id'].'" class="check_category_limit"> '.$row['cat_name'].'</li>';	
										}
                                    }
                                }
                            }
						?>
                    </div> 
						
				</div>
				
			</div>
			
			<div class="form-group" id="product_div" style="display:none;"> 
				<label for="name">Select Product</label> 
				<div class="frmSearch">
					<input type="text" class="form-control1"  id="search-box" placeholder="Product Name" />
					<input type="hidden" id="product-id" />
					<div id="suggesstion-box"></div>
				</div>
			</div>
			
			<div class="form-group" id="search_div" style="display:none;"> 
				<label for="name">Product Name</label> 
				<div class="frmSearch">
					<input type="text" class="form-control1"  id="product_name" placeholder="Product Name" />
					
				</div>
			</div>
			
			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" name="banner_image" id="banner_image" class="form-control" onchange="uploadFile1('banner_image')"  required accept="image/png, image/jpeg,image/jpg,image/gif">
    		</div>           
            <button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="add_banner_btn">Add</button> 
		</form> 
      </div>
      
    </div>

  </div>
</div>		

