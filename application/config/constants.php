<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('whatsapp_number')      OR define('whatsapp_number', 8000345924);
defined('LIMIT_CAT')      OR define('LIMIT_CAT', 32); // Result category limit
defined('LIMIT')      OR define('LIMIT', 35); // Result all limit
defined('MOBILE')      OR define('MOBILE', '430-590'); // image size for mobile
defined('DESKTOP')      OR define('DESKTOP', '430-590'); // image size for desktop
defined('PROD_DETAILS')      OR define('PROD_DETAILS', '6000-810'); // image size for desktop
defined('ORDER_UPDATE_TEMP')      OR define('ORDER_UPDATE_TEMP', 1); // place order email template id
defined('ORDER_RECEIVED_NOTIFICATION_TEMP')      OR define('ORDER_RECEIVED_NOTIFICATION_TEMP', 6); // place order email template id
defined('CANCEL_ORDER_TEMP')      OR define('CANCEL_ORDER_TEMP', 2); // place order email template id
defined('DELIVERED_TEMP')      OR define('DELIVERED_TEMP', 5); // delivered order email template id
defined('PLACE_ORDER_TEMP')      OR define('PLACE_ORDER_TEMP', 3); // place order email template id
defined('SITE_URL')      OR define('SITE_URL', 'https://www.rentzo.co.in/'); // 
defined('MEDIA_URL')      OR define('MEDIA_URL', 'https://www.rentzo.co.in/media/'); // 

// defined('SITE_URL')      OR define('SITE_URL', 'http://localhost/ebuy/'); // 
// defined('MEDIA_URL')      OR define('MEDIA_URL', 'http://localhost/ebuy/media/'); // 

defined('SUREPASS_AUTH_TOKEN') || define('SUREPASS_AUTH_TOKEN', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTcwMDg5NzY3MywianRpIjoiZmRlYTZiMTItNWNlNC00N2YzLTgwMDEtMzlkNjUyNjFjZTVkIiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmNvbnNvbGVfMnllc2tiaXc5ZXp4aXg4YWJqcGl1Mmx6ajF3QHN1cmVwYXNzLmlvIiwibmJmIjoxNzAwODk3NjczLCJleHAiOjIwMTYyNTc2NzMsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJ3YWxsZXQiXX19.UKz36dsJEh2R6rmswDBeOFi4IOCX6K8JyuwsxRljHv0');
defined('SUREPASS_PRODUCTION_URL') || define('SUREPASS_PRODUCTION_URL', 'https://kyc-api.aadhaarkyc.io/');
