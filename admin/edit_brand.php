<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Brand)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

 $brandid = $_POST['brandid'];
 
?>
<?php include("header.php"); ?>

<script type="text/javascript">
 var imagejson = "";
        function uploadImage(element) {
          
           //  alert( "input name---"+ element+"---" );
            var file_data = $('#'+element).prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
           // alert("sdfsdf");                             
                $.ajax({
                            url: 'add_product_image.php', // point to server-side PHP script 
                            dataType: 'text',  // what to expect back from the PHP script, if anything
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,                         
                            type: 'post',
                            success: function(response){
                                 // alert(response); // display response from the PHP script, if any
                                  var thumname = response.replace("Upload successfully--", "");   
                            
                                    imagejson = thumname  ;
                                editcategory(1);
                            }
                 });
                 
            }
     	
        function editcategory(element) {
          
          var namevalue = $('#name').val();
          var idvalue = $('#brand_id').val();
         // var myJSON = JSON.stringify(imagejson);
        // alert( "kaka "+ imagejson);
        
         $.ajax({
              method: 'POST',
              url: 'edit_brand_process.php',
              data: {
                brandname: namevalue,
                brandid: idvalue,
                brandimg: imagejson
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          //  window.open("events.php","_self");  
                           $(':input','#myform')
                                  .not(':button, :submit, :reset, :hidden')
                                  .val('');
                          getCategory();
                          imagejson ="";
                        }
            });
        }
</script>
<script>
    $(document).ready(function(){
	
//	getCategory();
    
});
</script>

		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			    <div class="panel-info widget-shadow">
                
		           <h4>Edit Brand</h4>
						
				<div class="form-two widget-shadow">
					
						<div class="form-body" data-example-id="simple-form-inline">
						    <input type="hidden" class="form-control1" id="brand_id" value=<?php echo $brandid; ?> ></input>
							<form class="form-inline" id="myform">
							     <div class="form-group"> 
							     <?php
							        $brandname ="";
    							      $stmt = $conn->prepare("SELECT brand_id, brand_name, brand_img FROM brand WHERE brand_id=?");
                                	   $stmt->bind_param( i,  $brandid );
                                	   $stmt->execute();	 
                                 	   $data = $stmt->bind_result( $col1, $col2, $col3);
                                       $return = array();
                                	   $i =0;
                                   	   while ($stmt->fetch()) { 
                                	       
                                    	   
                                          		 $brandname = $col2;		  
                                           // echo " array created".json_encode($return);
                                	    }
							     ?>
							        <label for="name">Name</label> 
							        <input type="text" class="form-control" id="name" placeholder="Brand Name" value="<?php echo $brandname; ?>"> </input>
							     
							     </div>
							      <div class="form-group">
    							      <label for="image">Image</label>
    							      <input type="file" name="1" id="1" required></input> 
    							 </div>           
                            
							   
								<button type="submit" class="btn btn-default" value="Upload" href="javascript:void(0)" onclick="uploadImage('1'); return false;">Update</button> 
					        </form> 
						</div>
				

				</div>
				<div class="clearfix"> </div>
			</br>

				
			<div class="clearfix"> </div>
			
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
		
