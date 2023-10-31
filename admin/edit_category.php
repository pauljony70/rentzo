<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Category)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

 $catid = $_POST['catid'];
 
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
          var idvalue = $('#cat_id').val();
         // var myJSON = JSON.stringify(imagejson);
        // alert( "kaka "+ imagejson);
        
         $.ajax({
              method: 'POST',
              url: 'edit_category_process.php',
              data: {
                catname: namevalue,
                catid: idvalue,
                catimg: imagejson
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
                
		           <h4>Edit Category</h4>
						
				<div class="form-two widget-shadow">
					
						<div class="form-body" data-example-id="simple-form-inline">
						    <input type="hidden" class="form-control1" id="cat_id" value=<?php echo $catid; ?> ></input>
							<form class="form-inline" id="myform">
							     <div class="form-group"> 
							     <?php
							        $catname ="";
    							      $stmt = $conn->prepare("SELECT cat_id, cat_name, cat_img, parent_id FROM category WHERE cat_id=?");
                                	   $stmt->bind_param( i,  $catid );
                                	   $stmt->execute();	 
                                 	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4);
                                       $return = array();
                                	   $i =0;
                                   	   while ($stmt->fetch()) { 
                                	       
                                    	   
                                          		 $catname = $col2;		  
                                           // echo " array created".json_encode($return);
                                	    }
							     ?>
							        <label for="name">Name</label> 
							        <input type="text" class="form-control" id="name" placeholder="Category Name" value="<?php echo $catname; ?>"> </input>
							     
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
	