<?php
include('session.php');
			
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}

 
?>
<?php include("header.php"); ?>

		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			<div class="col_3">
			   
			
								
		<div class="work-progres">
			
			<hr class="widget-separator">
            <div class="table-responsive">
            <table class="table table-hover" id="tblname"> 
                  <thead >
					<tr>
						<th colspan ="4" style="text-align:center">No Premission to execute this module</th>
						
					</tr>
					<tr>
						<th colspan ="4" style="text-align:center"><a href="dashboard.php">Go to Homepage </a></th>
						
					</tr>
				</thead>
				
              </table>
			</div>
        </div>
		
	<div class="clearfix"> </div>
</br>
		
				
		</div>			
	
			<div class="col_1">
			
			
			<div class="clearfix"> </div>
			
		</div>
				
			</div>
		</div>
	<!--footer-->
        <?php include("footernew.php"); ?>
    <!--//footer-->
	</div>
		
