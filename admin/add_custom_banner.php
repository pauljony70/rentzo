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

<script>
var code_ajax = $("#code_ajax").val();


$(document).ready(function() {
  
	$("#add_banner_btn").click(function(event){
		event.preventDefault();
		
		var banner_type = $('#banner_type').val();
		var banner_image = $('#banner_image').val();
		var product_name = $('#product_name').val();
		
		var product_id = $("#product-id").val();

		var cat_id = $(".check_category_limit:radio:checked").val();
		var type = '';
		if(banner_type ==1){
			if($('.check_category_limit:radio:checked').length ==0 ){
				successmsg("Please select atleast one Category");					
			}else{
				type = 'yes';
			}
		}else if(banner_type ==3){
			if(!product_name){
				successmsg("Please enter Product Name");
			}else{
				type = 'yes';
			}
	
		}else{
			if(!product_id){
				successmsg("Please select Product");
			}else{
				type = 'yes';
			}
		}
		
		if(!banner_image){
			successmsg("Please select Banner Image");
		}
			
		if(banner_type && banner_image && type=='yes'){				
			 showloader();
			var file_data = $('#banner_image').prop('files')[0];
			var form_data = new FormData();
			form_data.append('banner_image', file_data);
			form_data.append('banner_type', banner_type);
			form_data.append('product_id', product_id);
			form_data.append('cat_id', cat_id);
			form_data.append('product_name', product_name);
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'add_banner_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					hideloader();
					$("#myModal").modal('hide');
					$("#product-id").val('');
					$("#search-box").val('');
					$('#banner_image').val('');
					$('#product_name').val('');
					$("input:radio").attr("checked", false);
					getBanners(1, 0)
					successmsg(response);	
                    
				}
			});
		}
			
    });
	
	

});

// AJAX call for autocomplete 
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "add_banner_process.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});
//To select product name
function selectCountry(val,id) {
	$("#search-box").val(val);
	$("#product-id").val(id);
	$("#suggesstion-box").hide();
}
function banner_type1(){
	var banner_type = $("#banner_type").val();
	if(banner_type ==1){
		$("#parent_cat_div").show();
		$("#product_div").hide();
		$("#search_div").hide();
		$("#product-id").val('');
		$("#search-box").val('');
	}else if(banner_type ==3){
		$("#search_div").show();
		$("#parent_cat_div").hide();
		$("#product_div").hide();
		$("#product-id").val('');
		$("#search-box").val('');
	}else{
		$("#parent_cat_div").hide();
		$("#search_div").hide();
		$("#product_div").show();
		$("input:radio").attr("checked", false);
	}
}


	
</script>

		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			    	   
			  	    	<div >
			  	    	     
        			    	<div class="bs-example widget-shadow" data-example-id="hoverable-table"> 
        			    
        						<h4 style="padding: 15px; height: 4px"><span><b>Add Custom Banner :</b></span></h4>
        				
        					    <div class="form-three widget-shadow">
        							<form class="form" id="add_brand_form"  enctype="multipart/form-data">
			
			<div class="form-group"> 
				<label for="name">Layout Type</label> 
				<select class="form-control1" id="banner_type">
					
					<option value="0">Horizontal</option>
					<option value="1">2x2 grid</option>
					<option value="2">3x1 grid</option>
					<option value="3">Vertical</option>
					
				</select>
			</div>
			<div class="form-group"> 
				<label for="name">Banner Title</label> 
				<input class="form-control1" type="text" id="banner_title" name="banner_title">
					
			</div>
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
			
				
			<div class="clearfix"> </div>
			
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
	