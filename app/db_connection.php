<?php
//also change DB connection in cron folder 
define('HOST', 'localhost');
define('DB1', 'rentzo');
define('USER', 'root');
define('PASS', '');
// define('HOST', 'localhost');
// define('DB1', 'mydatabase');
// define('USER', 'mydatabase');
// define('PASS', 'AtX66WHjncxb8RDc');

$conn = new mysqli(HOST, USER, PASS, DB1);

error_reporting(0);

$defaultstatus = "inactive";

$publickey_server = "6543210987654321";

// define('BASEURL', "https://www.rentzo.co.in/");
define('BASEURL', "http://localhost/rentzo/");

$image_size = 500000;
$file_kb = ($image_size / 1000) . ' KB';
date_default_timezone_set("Asia/Kolkata");

$datetime = date('Y-m-d h:i:s');
$media_path = "../media/";

define('MEDIAURL', BASEURL . "media/");
$img_dimension_arr = array(array(72, 72), array(200, 200), array(280, 310), array(400, 200), array(430, 590), array(600, 810));
$img_dimension_arr_cat = array(array(72, 72), array(200, 200), array(400, 200));
// app product image     - 185x250,     (185x205 no use) product details main - 430x 590
// website product image - 280x 380    (280x310 no use) 
// refer website sareewave - 360x460

// 1920x 670 = 2.86% of 1920 
$admin_name = "ebuy";
$admin_website = BASEURL;
$admin_emailid = "admin@ebuy.om";
$admin_phone = "+962796621118";

define('DELIVER_ORDER_TEMP', 5);
define('CANCEL_ORDER_TEMP', 2);
define('sms_username', 'marurangecommerce');
define('sms_password', '79624227');
define('sms_headername', 'MRURNG');
define('sms_template_3', '1707167698436768081');
define('currency', 'OMR');

// require '../PHPMailer/src/PHPMailer.php';
// require '../PHPMailer/src/SMTP.php';
// require '../PHPMailer/src/Exception.php';
require '../PHPMailer/PHPMailerAutoload.php';
//require '/home3/a2zshcic/public_html/PHPMailer/PHPMailerAutoload.php';
