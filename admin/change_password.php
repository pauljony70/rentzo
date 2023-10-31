<?php


include('../app/db_connection.php');
include('encryptfun.php');
 global $publickey_server;

if(isset($_POST['selleridvalue']) && isset($_POST['passwords']) ){
	$passwords = $_POST['passwords'];
	$encruptfun = new encryptfun();
	$passwords = $encruptfun->encrypt($publickey_server, $passwords);
      
   	$stmt11 = $conn->prepare("UPDATE admin_login SET password =? ,checksum ='' WHERE checksum ='".trim($_POST['selleridvalue'])."' ");
	$stmt11->bind_param( "s",   $passwords  );
	$stmt11->execute();
    $stmt11->store_result();
    $rows=$stmt11->affected_rows;
    echo 'done'; die();
}


if (!isset($_GET['checksum']) || empty($_GET['checksum'])) {
	 header("Location: index.php");
}else{
	$checksum = trim($_GET['checksum']);
	 $stmt = $conn->prepare("SELECT fullname,email,phone,status FROM admin_login WHERE checksum=?");
        $stmt->bind_param("s", $checksum);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($col2,$col3,$col4,$col5 );
        
		$status ='99';
        while ($stmt->fetch()) {
			$status = $col5;
		}
		
		$valid = "no";
		if ($status == 1) {
			$valid = "yes";
			
          
        } else {
          // $password = base64_decode ( $password );
            $error = "Checksum is invalid";
          //  echo $error;
        }
}


?>
<!DOCTYPE HTML>
<html>
<head>
<title>Dashboard, Admin panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Multi Vendor eCommerce app Admin panel, www.blueappsoftware.com" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="<?php echo BASEURL; ?>assets/css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="<?php echo BASEURL; ?>assets/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

 <!-- js-->
<script src="<?php echo BASEURL; ?>assets/js/jquery-1.11.1.min.js"></script>

 
<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts--> 


<!--   multi select github link close-->
<script>
$(document).ready(function(){
	$("#update_password_btn").click(function(event){
		event.preventDefault();         
		var selleridvalue = "<?php echo $_GET['checksum']; ?>";
		var passwords = $('#password').val();
		var confirm_password = $('#confirm_password').val();
		
		
		if (passwords == "" || passwords == null) {
			successmsg("Password is empty");
		}else if (confirm_password == "" || confirm_password == null) {
			successmsg("Confirm Password is empty");
		}else if(strong_check_password(passwords) == 'fail'){
			successmsg("Password Must contain 5 characters or more,lowercase and uppercase characters and contains digits.");
		}else if(passwords != confirm_password){
			successmsg("Password and Confirm Password not same.");
		}else if(selleridvalue && passwords){
			showloader();
			var form_data = new FormData();
			form_data.append('selleridvalue', selleridvalue);
			form_data.append('passwords', passwords);
		
			
			$.ajax({
				method: 'POST',
				url: 'change_password.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function(response){
					hideloader();
					successmsg( "Password Updated Successfully.");
						$('#password').val('');
						$('#confirm_password').val('');
						window.setTimeout(function(){
							window.location.href = "index.php";
						}, 4000);
				}
			});
		}
		
	});
});

function strong_check_password(passwords) {
    var strength = 1;

    /*length 5 characters or more*/
    if (passwords.length >= 5) {
        strength++;
    }

    /*contains lowercase characters*/
    if (passwords.match(/[a-z]+/)) {
        strength++;
    }

    /*contains digits*/
    if (passwords.match(/[0-9]+/)) {
        strength++;
    }

    /*contains uppercase characters*/
    if (passwords.match(/[A-Z]+/)) {
        strength++;
    }
    if (strength >= 5) {
        return 'yes';
    } else {
        return 'fail';
    }

}

function successmsg(msg) {
    xdialog.confirm(msg, function() {
        // do work here if ok/yes selected...
            
    }, {
        style: 'width:420px;font-size:0.8rem;',
        buttons: {
             ok: 'OK'
         },
        oncancel: function() {
             // console.warn('Cancelled!');
         }
 });
}

function showloader() {
    $(".loading").show();
}

function hideloader() {
    $(".loading").hide();
}
</script>

</head> 
<body class="cbp-spmenu-push">
<div class="main-content"  style="background-color:#F1F1F1">

<div class="loading" style="display:none;">Loading&#8230;</div>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page ">
				<h2 class="title1">Change Password</h2>
				<div class="widget-shadow">
					<div class="login-body">
						<form method="post">
						    <span style="color:red;"><?php echo $error; ?></span>
							<?php if($valid == "yes"){ ?>
							<input type="password" name="password" id="password" class="lock" placeholder="Password" required="" >
							<input type="password" name="confirm_password" id="confirm_password" class="lock" placeholder="Confirm Password" required="">
							<div class="forgot-grid">
								<div class="forgot">
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="submit" href="javascript:void(0)" id="update_password_btn" value="Submit">
							<?php } ?>
						</form>

					</div>
				</div>
				
			</div>
		</div>
		<div class="clearfix"> </div>
		<div class="clearfix"> </div>
		<!--footer-->
            <?php include("footernew.php"); ?>
<!--//footer-->


<link href="<?php echo BASEURL; ?>assets/css/xdialog.min.css" rel="stylesheet" />
			<script src="<?php echo BASEURL; ?>assets/js/xdialog.min.js"></script>
