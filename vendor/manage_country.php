<?php
include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<script src ="js/admin/manage_country.js"></script>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			
				<div  data-example-id="simple-form-inline">
         <div class="pull-right page_div" style="float:left;">  </div>
        
		 
		 <div class="perpage">
			<div class="pull-right col-sm-2"> 
				<select class="form-control" id="perpage" name="perpage" onchange="perpage_filter()" style="float:left;">
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
				</select> 
			</div><span class="pull-right per-pag">Per Page:</span>
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
            <h4 class="widget-title"><b>All Country</b>  <button type="button" class="btn btn-primary" id="" data-toggle="modal" data-target="#myModal">Add Country</button>
		</h4>
			
         </header>      
				
		<hr class="widget-separator">
		
		<div class="table-responsive">
            <table class="table table-hover"  id="tblname" >
               <thead>
                  <tr>
                     <th>Sno</th> 
                     <th>Country</th>
                     <th>Country Code</th>
                    
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
        <h4 class="modal-title">Add Country</h4>
      </div>
      <div class="modal-body"> 
		<form class="form" id="add_country_form"  enctype="multipart/form-data">
			
			<div class="form-group"> 
				<label for="name">Country</label> 
				<input type="text" class="form-control" id="country" placeholder="Country"> 
			</div>
			<div class="form-group"> 
				<label for="name">Country Code</label> 
				<input type="text" class="form-control" id="country_code" placeholder="Country Code"> 
			</div>
			          
            <button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="add_country_btn">Add</button> 
		</form> 
      </div>
      
    </div>

  </div>
</div>		
