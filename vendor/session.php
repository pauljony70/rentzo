<?php
include('../app/db_connection.php');
global $conn;
include('common_function.php');
$Common_Function = new Common_Function();

session_start(); // Starting Session
// Storing Session
$user_check = $_SESSION['admin'];
//echo " login sesson fail ";

if (!isset($user_check) || $_SESSION['type'] != 'seller') {
	header('Location: index.php'); // Redirecting To Home Page

}

$code_ajax = $_SESSION['_token'];


// product status code
$prod_status_enable = 1;
$prod_status_disable = 0;

// seller status    0 -pending  1 accepted , 2 reject,
$seller_req_pending = 0;
$seller_req_accepted = 1;
$seller_req_reject = 2;

$currency = $Common_Function->get_system_settings($conn,'system_currency_symbol');

include('encryptfun.php');


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
