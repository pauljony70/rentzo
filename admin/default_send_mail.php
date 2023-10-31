<?php

require '../PHPMailer_new/src/PHPMailer.php';
require '../PHPMailer_new/src/SMTP.php';
require '../PHPMailer_new/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$code =    stripslashes($code);

$subject =  stripslashes($subject);

$seller_name = stripslashes(($seller_name));

$email =  stripslashes($email);

$message =  stripslashes($message);

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = '	smtpout.secureserver.net';  // Specify SMTP server
$mail->SMTPAuth = true;             // Enable SMTP authentication
$mail->Username = 'info@ebuy.om';  // SMTP username
$mail->Password = 'Mjrb@46dKLShyf';  // SMTP password
$mail->SMTPSecure = 'tls';          // Enable TLS encryption, 'ssl' also accepted
$mail->Port = 587;                  // TCP port to connect to

$mail->setFrom('info@ebuy.om', 'no-reply');
$mail->addAddress($email, $seller_name);

$mail->isHTML(true);  // Set the email message as HTML

$mail->Subject = $subject;

$mail->Body =$message;

if ($mail->send()) {
    echo 'Email sent successfully.';
} else {
    echo 'Error sending email: ' . $mail->ErrorInfo;
}
