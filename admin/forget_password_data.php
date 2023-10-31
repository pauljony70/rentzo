<?php print_r('dddddddddddd'.$_REQUEST); ?>
<?php
include('session.php');

if(!$Common_Function->user_module_premission($_SESSION,$Staff)){
	echo "<script>location.href='no-premission.php'</script>";die();
}

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

if(isset($_GET['submit']))
{
	$email=$_GET['email'];
	$otp = rand(100000,999999);
	
		
		$to = $email;
		$subject = 'Fleekmart Admin Forget Password';
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$message = '<html><body>';
		$message .= '<h1 style="color:#f40;">Fleekmart Admin Forget Password</h1>';
		$message .= '<p>Your Otp is : '.$otp.'</p>';
		$message .= '</body></html>';
		 
		$msg = '';
		if(mail($to, $subject,$message,$headers)){
			$msg ='Check Your Email for OTP.';
		} else{
			$msg ='Unable to send email. Please try again.';
		}
		
}

			
?>
<?php include("header.php");
?>

<!--<script src ="js/admin/add-staff-user.js"></script>-->
	<!-- main content start-->
	<div id="page-wrapper">
		<div class="main-page">
			<div class="bs-example widget-shadow" data-example-id="hoverable-table"> 
        		<h4 style="padding: 15px; height: 4px">
        		    <button type="submit" onclick="back_page('manage-staff.php')" id ="back_btn" class="btn  btn-default"  style="margin-right:10px; margin-top:-4px;"><i class="fa fa-arrow-left"></i> Back</button>   
				        		    <span><b>Forget Password :</b></span>
				</h4>
        		<div class="form-three widget-shadow">
        			<form class="form-horizontal"  method="get" action="forget_password.php">
						<span style="color:green;"><?php echo $msg; ?><span>
        				<div class="form-group">
        					<label for="focusedinput" class="col-sm-3 control-label">Email Id **</label>
        					<div class="col-sm-8">
        						<input type="email" class="form-control1" name="email" id="email" placeholder="email id" required>
        					</div>
        				</div>
        				
						  
        				 <div class="col-sm-offset-2">
        				     <input type="submit" name="submit" value="Send" class="btn btn-success"/>
        				</div>
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
	