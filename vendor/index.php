<?php
include('../app/db_connection.php');
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
include('common_function.php');
$Common_Function = new Common_Function();

if (isset($_POST['submit'])) {

   if (empty($_POST['email']) || empty($_POST['password'])) {
      $error = "Email or Password is invalid";
   } else {
      // Define $username and $password
      $email = $_POST['email'];
      $password = $_POST['password'];
      $checkbox = $_POST['checkbox'];

      $email = stripslashes($email);
      $password = stripslashes($password);
      $notExist  = true;

      include('encryptfun.php');
      global $publickey_server;
      $encruptfun = new encryptfun();
      $encryptedpassword = $encruptfun->encrypt($publickey_server, $password);

      $status = '99';
      // echo "email is ".$notExist;
      $stmt = $conn->prepare("SELECT seller_unique_id,companyname,fullname,email,phone,status,pincode FROM sellerlogin WHERE email=? AND password=?");
      $stmt->bind_param("ss", $email, $encryptedpassword);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);

      while ($stmt->fetch()) {
         $status = $col6;
      }

      if ($status == 0) {
         $error = "Your account request is pending. Please wait untill admin approve.";
      } else if ($status == 2) {
         $error = "Your account is rejected. Please contact administrator.";
      } else if ($status == 3) {
         $error = "Your account is deactiveted. Please contact administrator.";
      } else if ($status == 1) {
         $notExist = false;
         $_SESSION['admin'] = $col1;
         $_SESSION['seller_name'] = $col3;
         $_SESSION['seller_company'] = $col2;
         $_SESSION['seller_email'] = $col4;
         $_SESSION['seller_phone'] = $col5;
         $_SESSION['seller_pincode'] = $col7;
         $_SESSION['_token'] = md5(time());
         $_SESSION['type'] = 'seller';
         $session_id = session_id();

         $meta = array();

         $meta['user-agent'] = $_SERVER['HTTP_USER_AGENT'];
         $meta['id'] = $col1;
         $meta['ses_id'] = $session_id;

         $query = $conn->query("INSERT INTO ci_session (meta,id) VALUES('" . json_encode($meta) . "','" . $col1 . "')");
         if ($checkbox == '1') {
            setcookie('seller_email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie('seller_pass', $password, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie('checkbox', 1, time() + (86400 * 30), "/"); // 86400 = 1 day
         }

         $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '';

         $systemName = gethostname();

         $logContent = "User logged in - IP: " . $ipAddress . " - System Name: " . $systemName . " - Timestamp: " . date('Y-m-d H:i:s') . "\n";

         // Open log file in append mode
         $logFile = fopen("log.txt", "a");

         // Write log content to the log file
         fwrite($logFile, $logContent);

         // // Close the log file
         fclose($logFile);

         header("location: dashboard.php"); // Redirecting To Other Page

      } else {
         // $password = base64_decode ( $password );
         $error = "Email or Password is invalid";
         //  echo $error;
      }
      //  mysql_close($conn); // Closing Connection
   }
}

if (isset($_POST['emailvalue'])) {
   $email_id = trim($_POST['emailvalue']);

   $query = $conn->query("SELECT fullname,email,status FROM `sellerlogin` WHERE email ='" . $email_id . "'");
   if ($query->num_rows > 0) {
      $rows = $query->fetch_assoc();

      $adminname = $rows['fullname'];
      $admin_email = $rows['email'];
      $status = $rows['status'];

      if ($status == 0) {
         echo "pending";
      } else if ($status == 2) {
         echo "rejected";
      } else if ($status == 3) {
         echo "deactiveted";
      } else if ($status == 1) {
         $checksum = date('dym') . $Common_Function->random_strings(10) . date('his');

         $query = $conn->query("UPDATE `sellerlogin` SET checksum ='" . $checksum . "' WHERE email ='" . $email_id . "'");

         $Common_Function->send_email_forgot_password($conn, $admin_email, $adminname, $checksum, BASEURL, 'Forgot Password');
         echo "done";
      }
   } else {
      echo "not_exist";
   }
   die();
}
?>
<!--
Author: kamal bunkar
Author URL: https://www.blueappsoftware.com
-->
<!DOCTYPE HTML>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>Vendor Login</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="apple-touch-icon" sizes="180x180" href="images/favicon_io/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_io/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_io/favicon-16x16.png">
   <link rel="manifest" href="images/favicon_io/site.webmanifest">
   <!-- Bootstrap Core CSS -->
   <link href="<?php echo BASEURL; ?>assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
   <!-- font-awesome icons CSS-->
   <link href="<?php echo BASEURL; ?>assets/css/font-awesome.css" rel="stylesheet">
   <!-- //font-awesome icons CSS-->
   <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets/login/animate.css">
   <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets/login/main.css">
   <meta name="robots" content="noindex, follow">
</head>

<body>
   <div class="limiter">
      <div class="container-login100">
         <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt="" style="will-change: transform; transform: perspective(300px) rotateX(-1.61deg) rotateY(-4.28deg) scale3d(1.1, 1.1, 1.1);">
               <img src="<?php echo BASEURL; ?>assets/login/img-01.png" alt="IMG">
            </div>
            <form class="login100-form validate-form" method="post" id="login_form">
               <span class="login100-form-title">
                  Vendor Login
               </span>
               <span style="color:red;"><?php echo $error; ?></span>
               <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="email" id="user_name" name="email" placeholder="Enter Your Email" required="">
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                     <i class="fa fa-envelope" aria-hidden="true"></i>
                  </span>
               </div>
               <div class="wrap-input100 validate-input" data-validate="Password is required">
                  <input class="input100" type="password" name="password" id="password" placeholder="Password" required="">
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                     <i class="fa fa-lock" aria-hidden="true"></i>
                  </span>
               </div>
               <div class="forgot-grid">
                  <!-- <label class="checkbox"><input type="checkbox" name="checkbox" <?php if ($_COOKIE['checkbox'] == 1) {
                                                                                          echo "checked";
                                                                                       } ?> value="1" ><i></i>Remember me</label> -->
                  <div class="forgot">
                     <a href="#" data-toggle="modal" data-target="#myModal">forgot password?</a>
                  </div>
                  <div class="clearfix"> </div>
               </div>
               <div class="wrap-input100">

               </div>
               <div class="container-login100-form-btn">
                  <button class="login100-form-btn" id="login_btn" name="submit">
                     Login
                  </button>
               </div>

            </form>
         </div>
      </div>
   </div>
   <!-- Modal -->
   <div id="myModal" class="modal" role="dialog">
      <div class="modal-dialog" style="width:50%;">

         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Forgot password</h4>
            </div>
            <div class="modal-body">
               <form class="form" id="add_brand_form" enctype="multipart/form-data">

                  <div class="form-group">
                     <label for="name">User Email</label>
                     <input type="email" class="form-control" id="username" placeholder="User Email">
                  </div>

                  <button type="submit" class="btn btn-success" value="" href="javascript:void(0)" id="update_password">Update</button>
               </form>
            </div>

         </div>

      </div>
   </div>
   <!-- js-->
   <script src="<?php echo BASEURL; ?>assets/js/jquery-1.11.1.min.js"></script>

   <script src="<?php echo BASEURL; ?>assets/login/popper.js"></script>
   <script src="<?php echo BASEURL; ?>assets/js/bootstrap.js"> </script>

   <script src="<?php echo BASEURL; ?>assets/login/tilt.jquery.min.js"></script>
   <script>
      $('.js-tilt').tilt({
         scale: 1.1
      })
   </script>


   <script>
      $(document).ready(function() {


         $("#login_btn").click(function(event) {
            //event.preventDefault();			
            var emailvalue = $('#user_name').val();

            var passwords = $('#password').val();

            if (emailvalue == '') {
               successmsg("Please enter user name");
            } else if (validate_email(emailvalue) == 'invalid') {
               successmsg("User name Email id is invalid");
            } else if (passwords == "" || passwords == null) {
               successmsg("Password is empty");
            } else {
               $("#login_form").submit();
            }
         });


         $("#update_password").click(function(event) {
            event.preventDefault();
            var emailvalue = $('#username').val();

            var passwords = $('#password').val();

            if (emailvalue == '') {
               successmsg("Please enter user email");
            } else if (validate_email(emailvalue) == 'invalid') {
               successmsg("User name Email id is invalid");
            } else {
               $.ajax({
                  method: 'POST',
                  url: 'index.php',
                  data: {
                     emailvalue: emailvalue
                  },
                  success: function(response) {
                     if (response == 'not_exist') {
                        successmsg("This User Email not exist.");
                     } else if (response == 'done') {
                        successmsg("Please check your inbox to change password.");
                     } else if (response == 'pending') {
                        successmsg("Your account request is pending. Please wait untill admin approve.");
                     } else if (response == 'rejected') {
                        successmsg("Your account is rejected. Please contact administrator.");
                     } else if (response == 'deactiveted') {
                        successmsg("Your account is deactiveted. Please contact administrator.");
                     }

                  }
               });
            }
         });

      });

      function validate_email(email) {
         var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
         if (!pattern.test(email)) {
            return 'invalid';
         } else {
            return 'valid';
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
   </script>


   <link href="<?php echo BASEURL; ?>assets/css/xdialog.min.css" rel="stylesheet" />
   <script src="<?php echo BASEURL; ?>assets/js/xdialog.min.js"></script>


</body>

</html>