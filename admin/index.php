<?php
include('../app/db_connection.php');
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
include('common_function.php');
$Common_Function = new Common_Function();
if (isset($_POST['submit'])) {

   if (empty($_POST['email']) || empty($_POST['password'])) {
      $error = "email or Password is invalid";
   } else {
      // Define $username and $password
      $email = $_POST['email'];
      $password = $_POST['password'];

      $email = stripslashes($email);
      $password = stripslashes($password);
      $notExist  = 1;

      include('encryptfun.php');
      global $publickey_server;
      $encruptfun = new encryptfun();
      $encryptedpassword = $encruptfun->encrypt($publickey_server, $password);

      // echo "email is ".$notExist;
      $stmt = $conn->prepare("SELECT seller_id,fullname,email,status,role_id FROM admin_login WHERE email=? AND password=?");
      $stmt->bind_param("ss", $email, $encryptedpassword);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($col1, $col2, $col3, $col4, $col5);

      while ($stmt->fetch()) {

         if ($col4 == 1) {

            $notExist = 0;
            if ($col5 > 0) {
               $stmt1 = $conn->prepare("SELECT id,title,premission FROM user_roles WHERE id=? ");
               $stmt1->bind_param("i", $col5);
               $stmt1->execute();
               $stmt1->store_result();
               $stmt1->bind_result($ids, $title, $premission);

               while ($stmt1->fetch()) {
                  $_SESSION['title_role'] = $title;
                  $_SESSION['premission_role'] = $premission;
               }
            } else if ($col5 == 0) {
               $_SESSION['title_role'] = 'admin';
               $_SESSION['premission_role'] = 'admin';
            }

            $_SESSION['admin'] = $col1;
            $_SESSION['admin_name'] = $col2;
            $_SESSION['admin_email'] = $col3;
            $_SESSION['_token'] = md5(time());
            $_SESSION['type'] = 'admin';
         } else {
            $notExist = 2;
         }
      }
      // echo " not wxsist is ".$notExist;
      if ($notExist == 0) {
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
         //  $error = " sucess valid";
         // echo " go to dashborad";
      } else if ($notExist == 2) {
         $error = "Your account is deactiveted. Please contact administrator.";
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

   $query = $conn->query("SELECT fullname,email FROM `admin_login` WHERE email ='" . $email_id . "'");
   if ($query->num_rows > 0) {
      $rows = $query->fetch_assoc();

      $adminname = $rows['fullname'];
      $admin_email = $rows['email'];

      $checksum = date('dym') . $Common_Function->random_strings(10) . date('his');

      $query = $conn->query("UPDATE `admin_login` SET checksum ='" . $checksum . "' WHERE email ='" . $email_id . "'");

      $Common_Function->send_email_forgot_password($conn, $admin_email, $adminname, $checksum, BASEURL, 'Forgot Password');
      echo "done";
   } else {
      echo "not_exist";
   }
   die();
}
?>
<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>Admin Login</title>
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
                  Admin Login
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
               <div class="wrap-input200">

               </div>
               <div class="container-login100-form-btn">
                  <button class="login100-form-btn" id="login_btn" name="submit">
                     Login
                  </button>
               </div>
               <br><a href="forget_password.php">Forgot Password</a>
            </form>
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