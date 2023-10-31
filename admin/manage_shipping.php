<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Shipping)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}
$shipping_country = $Common_Function->get_system_settings($conn,'shipping_country');

if($_REQUEST['selectcountry']){
	$query = $conn->query("SELECT * FROM `settings` WHERE type ='shipping_country'");
	if($query->num_rows > 0){
		$query = $conn->query("UPDATE `settings` SET description = '".$_REQUEST['selectcountry']."' WHERE type ='shipping_country'");
	}else{
		$query = $conn->query("INSERT INTO `settings` (type, description) VALUES ('shipping_country', '".$_REQUEST['selectcountry']."')");
	}
			
}

?>
<?php include("header.php"); ?>

<script src ="js/admin/manage_shipping.js"></script>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			<input type="hidden" class="form-control" id="stateid" value="<?php echo $stateid; ?>" > 
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
            <h4 class="widget-title"><b>All Shipping</b>  <button type="button" class="btn btn-primary" id="" data-toggle="modal" data-target="#myModal">Add Shipping</button>
		</h4>
			
         </header>      
				
		<hr class="widget-separator">
		
		<div class="table-responsive">
            <table class="table table-hover"  id="tblname" >
               <thead>
                  <tr>
                     <th>Sno</th> 
                     <th>City</th>
                     <th>Light Item Shipping Fee</th>
                     <th>Heavy Item Shipping Fee</th>
                     <th>Min Amount</th>
                     <th>Estimated Delivery Time</th>
                     <th>Prime User Delivery Time</th>
                     <th>Status</th>
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
        <h4 class="modal-title">Add Shipping</h4>
      </div>
      <div class="modal-body"> 
		<form class="form" id="add_shipping_form"  enctype="multipart/form-data">
			<div class="form-group">
				<label  class=" control-label">Select State **</label>
				<select class="form-control1" id="selectstate" name="selectstate">
					<option value="">Select</option>
                </select> 
            </div>
			<div class="form-group">
				<label  class=" control-label">Select City **</label>
				<select class="form-control1" id="selectcity" name="selectcity">
					<option value="">Select</option>
                </select> 				
			</div>
			<div class="form-group"> 
				<label for="name">Light Item Shipping Fee</label> 
				<input type="number" class="form-control" id="basic_fee" min="0" placeholder="Shipping Fee"> 
			</div>
			<div class="form-group"> 
				<label for="name">Heavy Item Shipping Fee</label> 
				<input type="number" class="form-control" id="big_item_fee" min="0" placeholder="Shipping Fee"> 
			</div>
			<div class="form-group"> 
				<label for="name">Min Amount(Applicable Shipping Fee if Heavy Item amount < Min Amount)</label> 
				<input type="number" class="form-control" id="order_value" min="0" placeholder="Amount"> 
			</div>
			<div class="form-group"> 
				<label for="name">Estimated Delivery Time</label> 
				<select class="form-control1" id="estimated_delivery_time" name="estimated_delivery_time">
					<option value="">Select</option>
				<?php  foreach($estimated_delivery as $time_slot){ ?>
					<option value="<?php  echo $time_slot; ?>"><?php if($time_slot<1){ echo str_replace(array('0.','.'),'',$time_slot).' Hours'; }else{echo $time_slot.' Days';} ?></option>
				<?php  } ?>
                </select> 
			</div>
			<div class="form-group"> 
				<label for="name">Prime User Delivery Time</label> 
				<select class="form-control1" id="prime_delivery_time" name="prime_delivery_time">
					<option value="">Select</option>
				<?php  foreach($estimated_delivery as $time_slot){ ?>
					<option value="<?php  echo $time_slot; ?>"><?php if($time_slot<1){ echo str_replace(array('0.','.'),'',$time_slot).' Hours'; }else{echo $time_slot.' Days';} ?></option>
				<?php  } ?>
                </select> 
			</div>
			
            <button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="add_shipping_btn">Add</button> 
		</form> 
      </div>
      
    </div>

  </div>
</div>		


<!-- Modal -->
<div id="myModalupdate" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Shipping</h4>
      </div>
      <div class="modal-body"> 
		<form class="form" id="update_shipping_form"  enctype="multipart/form-data">
			<div class="form-group"> 
				<label for="name">City</label> 
				<input type="text" class="form-control" id="city_name" readonly placeholder="City"> 
			</div>
			<div class="form-group"> 
				<label for="name">Light Item Shipping Fee</label> 
				<input type="number" class="form-control" id="basic_fee_update" min="0" placeholder="Shipping Fee"> 
			</div>
			<div class="form-group"> 
				<label for="name">Heavy Item Shipping Fee</label> 
				<input type="number" class="form-control" id="big_item_fee_update" min="0" placeholder="Shipping Fee"> 
			</div>
			<div class="form-group"> 
				<label for="name">Min Amount(Applicable Shipping Fee if Heavy Item amount < Min Amount)</label> 
				<input type="number" class="form-control" id="order_value_update" min="0" placeholder="Amount"> 
			</div>
			<div class="form-group"> 
				<label for="name">Estimated Delivery Time</label> 
				<select class="form-control1" id="estimated_delivery_time_update" name="estimated_delivery_time">
					<option value="">Select</option>
				<?php  foreach($estimated_delivery as $time_slot){ ?>
					<option value="<?php  echo $time_slot; ?>"><?php if($time_slot<1){ echo str_replace(array('0.','.'),'',$time_slot).' Hours'; }else{echo $time_slot.' Days';} ?></option>
				<?php  } ?>
                </select> 
			</div>
			<div class="form-group"> 
				<label for="name">Prime User Delivery Time</label> 
				<select class="form-control1" id="prime_delivery_time_update" name="prime_delivery_time">
					<option value="">Select</option>
				<?php  foreach($estimated_delivery as $time_slot){ ?>
					<option value="<?php  echo $time_slot; ?>"><?php if($time_slot<1){ echo str_replace(array('0.','.'),'',$time_slot).' Hours'; }else{echo $time_slot.' Days';} ?></option>
				<?php  } ?>
                </select> 
			</div>
			<div class="form-group"> 
				<label for="name">Status</label> 
				<select class="form-control1" id="statuss" name="statuss">
					<option value="">Select</option>
					<option value="1">Active</option>
					<option value="0">Deactive</option>
				
                </select> 
			</div>
			
			<input type="hidden" class="form-control" id="shipping_id" > 
            <button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="update_shipping_btn">Update </button> 
		</form> 
      </div>
      
    </div>

  </div>
</div>		

<?php  if(!$shipping_country){?>
<div id="myModal" class="modal fade in" role="dialog" style="display: block; padding-left: 10px;">
  <div class="modal-dialog" style="width:50%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Shipping Country</h4>
      </div>
      <div class="modal-body"> 
		<form class="form" id="add_country_form" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label  class=" control-label">Select Country **</label>
				<select class="form-control1" id="selectcountry" name="selectcountry" required>
                    </select> 
            </div>        
            <button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="">Add</button> 
		</form> 
      </div>
      
    </div>

  </div>
</div>	
<script>
	$(document).ready(function(){
		getcountrydata();
	 });</script>
<?php } ?>
<script>
	$(document).ready(function(){
		getStatedata('<?php echo $shipping_country; ?>');
	 });</script>