<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else if(!isset($_GET['id']) || empty($_GET['id'])){
  header("Location: dashboard.php");
}

?>
<?php include("header.php"); ?>
<style>

#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<script>
var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getBanners(pagenov, rownov) {
	 showloader();
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_custombanners_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage,
            banner_for: '<?php echo trim($_GET["id"]); ?>'
        },
        success: function(response) {
            hideloader();
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td><img src="' + this.img + '" style="width: 72px; height: 72px;"></td><td > ' + this.type + '</td><td > ' +this.name + '</td>';
                html += '<td> <button type="submit" class= "btn btn-danger btn-sm pull-left" name="delete" onclick="deleteBanners(' + this.id + ');">DELETE</button>';

                html += '</td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

$(document).ready(function() {
    getBanners(pageno, rowno);
	
	
	$("#add_banner_btn").click(function(event){
		event.preventDefault();
		
		var banner_type = $('#banner_type').val();
		var banner_image = $('#banner_image').val();
		var product_name = $('#product_name').val();
		var banner_for = '<?php echo trim($_GET["id"]); ?>';
		
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
		var img ='yes';
		if(banner_type ==3){
			if(!banner_image){
				successmsg("Please select Banner Image");
				img ='no';
			}
		}
			
		if(banner_type && img =='yes'  && type=='yes'){				
			 showloader();
			var file_data = $('#banner_image').prop('files')[0];
			var form_data = new FormData();
			form_data.append('banner_image', file_data);
			form_data.append('banner_type', banner_type);
			form_data.append('product_id', product_id);
			form_data.append('cat_id', cat_id);
			form_data.append('product_name', product_name);
			form_data.append('code', code_ajax);
			form_data.append('banner_for', banner_for);
			
			$.ajax({
				method: 'POST',
				url: 'add_custombanner_process.php',
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
		url: "add_custombanner_process.php",
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


function deleteBanners(id) {

	 xdialog.confirm('Are you sure want to delete?', function() {
		showloader();
		$.ajax({
			method: 'POST',
			url: 'add_custombanner_process.php',
			data: { deletearray: id, code:code_ajax },
			success: function(response) {
				hideloader();
				if(response =='Failed to Delete.'){
					successmsg("Failed to Delete.");
				}else if(response =='Deleted'){
					$("#tr"+id).remove();
					successmsg("Banner Deleted Successfully.");
				}else{
					
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

function back_page(){
	location.href= 'homepagebanner.php';
}
	
</script>

<?php 
 $query = $conn->query("SELECT id,title,layout FROM homepage_banners WHERE id ='".trim($_GET['id'])."'");
 if($query->num_rows > 0){
	 $rows1 = $query->fetch_assoc();
	 $title = $rows1['title'];
 }else{
	  header("Location: dashboard.php");
 }
?>
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
            <h4 class="widget-title">
			<button type="button" class="btn btn-default" onclick="back_page();"><i class="fa fa-arrow-left"></i> Back</button>
			<b>All Banners (<?php echo $title; ?>)</b> <button type="button" class="btn btn-primary" id="" data-toggle="modal" data-target="#myModal">Add Banners</button>
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
			<input type="hidden"  id="banner_for" name="banner_for" value="<?php echo trim($_GET["id"]); ?>">
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

