<?php
include('session.php');


if(!$Common_Function->user_module_premission($_SESSION,$DeliveryBoy)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}
 
?>
<?php include("header.php"); ?>
<script src ="js/admin/manage_deliveryboy.js"></script>


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
          					     <form class="form-inline" style="float:left;">
							         
							        <div class="form-group" style="margin-right:20px;">
							            <input type="text" placeholder="Search.." name="search" class="form-control"  style="width:200px;"  id="search_string">
                                          <button type="submit" href="javascript:void(0)" class="btn btn-default"  id="searchName"><i class="fa fa-search"></i></button>
                                    </div> 
							      </form>
							      
                               <a>&nbsp;&nbsp;</a>
                               
							   
				</div>			     
					</br>	
		           <div class="work-progres">
                                        <header class="widget-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
                                         <div class="pull-right" style="float:left;">
                                        	        Total Row :	<a id="totalrowvalue" class="totalrowvalue"></a>
                                            </div>
                                            <h4 class="widget-title"><b>All Delivery Boy</b></h4>
                                        </header>
							<hr class="widget-separator">
                            <div class="table-responsive">
                        	<table class="table table-hover"  id="tblname" style="overflow-x: auto;"> 
            			          <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th >Name</th>
                                      <th >Vehicle No.</th>
                                      <th>email</th>                     
                                      <th>Phone</th>
                                      <th>City</th>                                     
                                      <th>Since</th>                                      
                                      <th>Status</th>
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
		<!-- //calendar -->	
	

		
		<div class="col_1">
			
			
			<div class="clearfix"> </div>
			
		</div>
				
			</div>
		</div>
		</div>
	<!--footer-->
        <?php include("footernew.php"); ?>
    <!--//footer-->
	