<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter

include('../app/db_connection.php');
global $conn;
include('common_function.php');
$Common_Function = new Common_Function();

session_start(); // Starting Session
// Storing Session
$user_check = $_SESSION['admin'];
//echo " login sesson fail ";
date_default_timezone_set('Asia/Muscat');
if (!isset($user_check) || $_SESSION['type'] != 'admin') {
	//  echo " login sesson not set ";
	header('Location: index.php'); // Redirecting To Home Page
	//	mysql_close($conn); // Closing Connection

}

$code_ajax = $_SESSION['_token'];



// product status code
$prod_status_enable = 1;
$prod_status_disable = 0;

// seller status    0 -pending  1 accepted , 2 reject,
$seller_req_pending = 0;
$seller_req_accepted = 1;
$seller_req_reject = 2;

$currency = $Common_Function->get_system_settings($conn, 'system_currency_symbol');


//Replace special character(&,",',\,<,>) to blank from request
$_REQUEST = array_map("removeSpecialCharacters", $_REQUEST);
$_POST = array_map("removeSpecialCharacters", $_POST);
$_GET = array_map("removeSpecialCharacters", $_GET);

/* Purpose of this function is to remove special character(&,",',\,<,>) to blank from string and not json */
function removeSpecialCharacters($value)
{
	if (is_string($value)) {
		if (!is_JSON($value)) {

			$value = str_replace('"', '&quot;', $value);
			$value = str_replace("'", '&#039;', $value);
			$value = str_replace("\\", '', $value);
			$value = str_replace("<", '&lt;', $value);
			$value = str_replace(">", '&gt;', $value);
		} else {
			$value = str_replace("<", '&lt;', $value);
			$value = str_replace(">", '&gt;', $value);
		}
	}
	return $value;
}

/* Purpose of this function is to check provide string is json or not */
function is_JSON()
{
	call_user_func_array("json_decode", func_get_args());
	return (json_last_error() === JSON_ERROR_NONE);
}

/* Code Ending for preventing XSS attack */

//modules

$ManageSeller = 'Manage Seller';
$Category = 'Category';
$Brand = 'Brand';
$CouponCode = 'Coupon Code';
$ProductAttributes = 'Product Attributes';
$Product = 'Product';
$HomepageSettings = 'Homepage Settings';
$Orders = 'Orders';
$StoreSettings = 'Store Settings';
$AppUser = 'App User';
$DeliveryBoy = 'Delivery Boy';
$Role = 'Role';
$Staff = 'Staff';
$ProductReview = 'Product Review';
$Support = 'Support Chat';
$FirebaseNoti = 'Firebase Notification';
$Commission = 'Seller Commission';
$Shipping = 'Shipping';

//Estimated Delivery Time

$estimated_delivery = array(0.24, 2, 3, 4, 5, 6, 7, 10);
