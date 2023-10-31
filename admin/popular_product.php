<?php
   include('session.php');
   
   if(!isset($_SESSION['admin'])){
     header("Location: index.php");
   }
   if(isset($_POST['code'])){	   
		if($_POST['code'] == $_SESSION['_token'] && $_POST['product_id']  ) {
			$stmt = $conn->prepare("SELECT id FROM popular_product WHERE product_id=?");
			$stmt->bind_param("s",  $_POST['product_id']);
			$stmt->execute();
		
			$stmt->bind_result($img_url);
			
			$exist = '';
			while ($stmt->fetch()) {
				$exist = 'yes';
				
			}
			if($exist != 'yes'){
			
				$stmt11 = $conn->prepare("INSERT INTO `popular_product`( `product_id`)  VALUES (?)");
				$stmt11->bind_param( 's', $_POST['product_id'] );
					
				$stmt11->execute();
				$stmt11->store_result();
				$rows=$stmt11->affected_rows;
				if($rows>0){
					echo " Popular Product Added Successfully.";
					
				}else{
					echo "Failed to add Popular Product.";
				}
			}else{
				echo " Popular Product already exist.";
			}
			die();
		}
		
		if($_POST['code'] == $_SESSION['_token'] && $_POST['page']  ) {
			
		}
   }
    
   ?>
<?php include("header.php"); ?>
<style>

#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<!-- main content start-->
<div id="page-wrapper">
   <div class="main-page">
      <div  data-example-id="simple-form-inline">
         <div class="pull-right page_div" style="float:left;">  </div>
        
		 
		 <div class="perpage">
			
		</div>
         <div style=" display: inline-block;  vertical-align: middle">
         </div>
      </div>
      </br>	
      <div class="work-progres">
         <header class="widget-header">
            <div class="pull-right" style="float:left;">
               Total Row :	<a id="totalrowvalue" class="totalrowvalue"></a>
            </div>
            <h4 class="widget-title"><b>Popular Products</b>
			<button type="button" class="btn btn-primary" id="" data-toggle="modal" data-target="#myModal">Add Popular Products</button></h4>
         </header>
         <hr class="widget-separator">
         <div class="table-responsive">
            <table class="table table-hover"  id="tblname" >
               <thead>
                  <tr>
                     <th>Sno</th>
                     <th>Image</th>
                     <th>ProductID</th>
                     <th>Name</th>
                     <th>SKU</th>
                     <th>Brand</th>
                     <th>Category</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody id="tbodyPostid"> 
               </tbody>
            </table>
         </div>
      </div>
      <div class="clearfix"> </div>
   </div>
   <div class="clearfix"></div>
</div>
<div class="col_1">
   <div class="clearfix"> </div>
</div>
</div>
</div>
</div>
<?php include("footernew.php"); ?>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>
      <div class="modal-body"> 
		<form class="form" id="add_brand_form"  enctype="multipart/form-data">
			
			
			<div class="form-group" id="product_div" > 
				<label for="name">Select Product</label> 
				<div class="frmSearch">
					<input type="text" class="form-control1"  id="search-box" placeholder="Product Name" />
					<input type="hidden" id="product-id" />
					<div id="suggesstion-box"></div>
				</div>
			</div>
			
			
            <button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="add_banner_btn">Add</button> 
		</form> 
      </div>
      
    </div>

  </div>
</div>		
<script>
	var pageno = 1;
	var rowno = 0;
	var code_ajax = $("#code_ajax").val();
	// AJAX call for autocomplete 
	$(document).ready(function(){
		
		getBanners(pageno,rowno);
		
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
		
		
		$("#add_banner_btn").click(function(event){
			event.preventDefault();
			
			var product_id = $("#product-id").val();	
			
			if(!product_id){
				successmsg("Please select Product");
			}else{			
				showloader();
				var form_data = new FormData();
				form_data.append('product_id', product_id);
				form_data.append('code', code_ajax);
				
				$.ajax({
					method: 'POST',
					url: 'popular_product.php',
					data:form_data,
					contentType: false,
					processData: false,
					success: function(response){
						hideloader();
						$("#myModal").modal('hide');
						$("#product-id").val('');
						$("#search-box").val('');
						successmsg(response);	
						getBanners(pageno,rowno);
					}
				});
			}
				
		});
	});


//To select product name
function selectCountry(val,id) {
	$("#search-box").val(val);
	$("#product-id").val(id);
	$("#suggesstion-box").hide();
}


function getBanners(pagenov, rownov) {
	 showloader();
   
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_popular_product_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            type: 'popular_product',
            rowno: rownov
        },
        success: function(response) {
			hideloader();
            var data = $.parseJSON(response);
            if (data["status"] == "1") {
                $("#tbodyPostid").empty();
                $("#tbodyPostid").html(data["tbl_html"]);
                $("#totalrowvalue").html(data["totalrowvalue"]);
                $(".page_div").html(data["page_html"]);
            } else {
                successmsg("No product found. please try again!");
            }

        }
    });
}

function pagination_product(page) {
	showloader();
    
   
    $.ajax({
        method: 'POST',
        url: 'get_popular_product_data.php',
        data: {
            code: code_ajax,
            prod_name: search_namevalue,
            page: page,
            rowno: 0,
            type: 'popular_product'
        },
        success: function(response) {
			hideloader();
            var data = $.parseJSON(response);
            if (data["status"] == "1") {
                $("#tbodyPostid").empty();
                $("#tbodyPostid").html(data["tbl_html"]);
                $("#totalrowvalue").html(data["totalrowvalue"]);
                $(".page_div").html(data["page_html"]);
            } else {
                successmsg(" no product found. please try again");
            }
        }
    });

}

function delete_products(product_id) {
    xdialog.confirm('Are you sure want to delete?', function() {
		showloader();
        $.ajax({
            method: 'POST',
            url: 'get_popular_product_data.php',
            data: {
                code: code_ajax,
				type: 'delete_popular_product',
                product_id: product_id
            },
            success: function(response) {
				hideloader();
                if(response =='Failed to Delete.'){
					successmsg("Failed to Delete.");
				}else if(response =='Deleted'){
					$("#tr"+product_id).remove();
					successmsg("Popular Product Deleted Successfully.");
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
