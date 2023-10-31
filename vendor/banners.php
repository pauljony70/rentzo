<?php
include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<script>
        
    function deleteCategory(){
        
      // alert("delete call");
        var event_idarray = new Array();
        var deletestring ="";
        var count =0;
         
        $('input:checkbox[name=chkbox]:checked').each(function() 
        {
           //alert( $(this).val());
            event_idarray.push($(this).val());
            if(count==0){
                deletestring =  $(this).val();       
            }else{
                deletestring = deletestring +", "+ $(this).val();   
            }
            count = count+1;
         
        });
        
         // alert(deletestring );
         
            $.ajax({
                  method: 'POST',
                  url: 'delete_banner.php',
                  data: {
                    deletearray: deletestring
                  
                  },
                  success: function(response){
                                alert(response); // display response from the PHP script, if any
                               getBanner();
                           
                            }
                });
    }
    
</script>

<script type="text/javascript">
 var imagejson = "";
        function uploadImage(element) {
          
           //  alert( "input name---"+ element+"---" );
            var file_data = $('#'+element).prop('files')[0];  
            
            if(file_data =="" || file_data ==null){
                alert("Please Select Image");
            }else{
            
                
                var form_data = new FormData();                  
                form_data.append('file', file_data);
              //  alert("sdfsdf");                             
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
                                    addadsbanner(1);
                                }
                     });
            } 
            
        }
     	
        function addadsbanner(element) {
          
           var cat = document.getElementById("selectcategory");
           var catvalue = cat.options[cat.selectedIndex].value;
           var partss = catvalue.split(':', 2);
           var catidvalue = partss[0];
           var catnamevalue  = partss[1]; 
           
        // alert( "kaka");
           var bra = document.getElementById("selectprod");
           var prodvalue = bra.options[bra.selectedIndex].value;
           var parts = prodvalue.split(':', 2);
            var prodidvalue = parts[0];
            var prodnamevalue  = parts[1];  
          // alert("here"); 
         var ctype = 0;
         var isgood = 0;
         
          if(catidvalue == 0 && prodidvalue == 0 ){
              ctype =0;
        //      alert("both 0");
          }else  if(catidvalue != 0 && prodidvalue == 0 ){
          //  alert("cat");
              ctype =1;
          } else  if(catidvalue == 0 && prodidvalue != 0 ){
            //alert("priod");
              ctype =2;
          }else{
              isgood = 1;
          }  
           
          if(isgood ==1){
              alert("please select only one - category OR product")
              
          }else{
              
       // alert( catidvalue+"--"+catnamevalue +"--"+prodidvalue+"--"+prodnamevalue);
       
             $.ajax({
                  method: 'POST',
                  url: 'add_banner_process.php',
                  data: {
                    code: "123",
                    img: imagejson,
                    prodid: prodidvalue,
                    prodname: prodnamevalue,
                    catid: catidvalue,
                    catname: catnamevalue,
                    ctype :ctype
                  },
                  success: function(response){
                                alert(response); // display response from the PHP script, if any
                              //  window.open("events.php","_self");  
                               $(':input','#myform')
                                      .not(':button, :submit, :reset, :hidden')
                                      .val('');
                              getBanner();
                              imagejson ="";
                            }
                });
                
            
          }
        }
</script>
<script>
        function getBanner(){
          
           // alert( "sdfs" );
            var count =1;
            $.ajax({
              method: 'POST',
              url: 'get_banner_data.php',
              data: {
                code: "123"
              },
              success: function(response){
                          //  alert(response); // display response from the PHP script, if any
                            var data = $.parseJSON(response);
                              $("#cat_list").empty();
                            
                            $(data).each(function() {
                            		//alert(this.id);
                            		var optionsAsString = "";
                                    for(var i = 0; i < data.length; i++) {
                                        if(this.orderno == i){
                                             optionsAsString += "<option value='" + i + "' selected >" + i + "</option>";
                                            
                                        }else{
                                            optionsAsString += "<option value='" + i + "' >" + i + "</option>";
                                            
                                        }
                                    }
                            	
                            	//	$("#cat_list").append('<li><input type="checkbox" name="chkbox"  value="'+this.id+'"/><lable>'+this.name+'</label> </li>');
                               	    $("#cat_list").append('<li> <div class="checkbox-inline1"><input  type="checkbox"  class="chkboxx" name="chkbox" value="'+this.id+'"> <select name="catorderlist" class="catorderlist" style="margin-left:10px; margin-right:10px;">'+optionsAsString+'</select><label class = "cat-name"> '+this.prodname+'</label>  <br><br><img src='+this.img+' style="width: 300px; height: 150px; background-color:#F0ECEC;"></img></div></li>');
                          		 
                          		 
                               	count = count+1;	
                            });
                            
                             $('select[name="catorderlist"]').on('change', function(){   
                                         var $row = $(this).closest("li");    // Find the row
                                         var text = $row.find(".chkboxx").val(); 
                                      
                                       // alert(text+"---"+$(this).val());   
                                       editBannerOrder(text,$(this).val() );
                            });
                          
                    }
            }); 
        }
</script>
<script>
    
    function editBannerOrder(idvalue, orderno){
           $.ajax({
              method: 'POST',
              url: 'edit_banner_order.php',
              data: {
               
                bannerid: idvalue,
                ordernumber: orderno
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          //  window.open("events.php","_self");  
                         // getCategory();
                          //imagejson ="";
                        }
            });
    }
</script>
<script>
    $(document).ready(function(){
	
	getBanner();
    
});
</script>

		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			    <div class="panel-info widget-shadow">
                
		           <h4>Add New Banner Ads</h4>
						
				<div class="form-two widget-shadow">
					
						<div class="form-body" data-example-id="simple-form-inline">
						    
							<form class="form-inline" id="myform">
							    
							      <div class="form-group">
    							    
    							      <input type="file" name="1" id="1" required></input> 
    							 </div> 
    							 	<div class="col-sm-2">
								               <select class="form-control1" id="selectcategory" name="selectcategory">
                                                    <?php
                                                 
                                                           echo '<option value="0:none">Select Category </option>';                                                
                                                        function categoryTree($parent_id = 0, $sub_mark = ''){
                                                            global $conn;
                                                            $query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id ORDER BY cat_name ASC");
                                                           
                                                            if($query->num_rows > 0){
                                                                while($row = $query->fetch_assoc()){
                                                                    echo '<option value="'.$row['cat_id'].':'.$row['cat_name'].'">'.$sub_mark.$row['cat_name'].'</option>';
                                                                    categoryTree($row['cat_id'], $sub_mark.'---');
                                                                }
                                                            }
                                                        }
                                                        categoryTree();
                                               
                                                                        
                                                    ?>
                                                </select> 
                                   </div>
                              	<div class="col-sm-2">
								               <select class="form-control1" id="selectprod" name="selectprod">
                                                    <?php
                                                 
                                                           echo '<option value="0:none">Select Product </option>';
                                                       //      echo '<option value="Samsung"> Samsung </option>';
                                                         //      echo '<option value="Xiomi">Xiomi </option>';
                                                           
                                                           	$stmt = $conn->prepare("SELECT prod_id, prod_name FROM productdetails ORDER By prod_name ASC");
                                                        //	$stmt-> bind_param("i", $id);
                                                         	$stmt->execute();
                                                         	$stmt->store_result();
                                                         	$stmt->bind_result ( $col1, $col2 );
                                                         
                                                         	while($stmt->fetch() ){
                                                         	     echo '<option value="'.$col1.':'.$col2.'">'.$col2.'</option>';                     
                                                        
                                                         	}
                                               
                                                                         
                                                    ?>
                                                </select> 
                                </div>
							    
								<button type="submit" class="btn btn-default" value="Upload" href="javascript:void(0)" onclick="uploadImage('1'); return false;">Add</button> 
								 <label for="image" style="margin-left:20px;">Image Size -Width-500 px, Height- 250 px</label>
					        </form> 
						</div>
				

				</div>
				<div class="clearfix"> </div>
			</br>

				  <h2>Ads Banner List</h2>
                <button  style='margin-right:30px;' type="submit" class="label pull-left label-warning" value="delete" name="delete" href="javascript:void(0)" onclick="deleteCategory(this); return false;">DELETE</button>
               
              
                </br>
					<ul class="bt-list" id="cat_list">

								
					</ul>
			<div class="clearfix"> </div>
			
		</div>
			    
			
		
		<div class="col_1">
			
			
			<div class="clearfix"> </div>
			
		</div>
				
			</div>
		</div>
		</div>
		<!--footer-->
              <?php    include('footernew.html'); ?>
        <!--//footer-->
	