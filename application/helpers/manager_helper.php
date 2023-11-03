<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('manager')) {
	function manager($total_rows, $per_page_item)
	{
		$config['per_page']        = $per_page_item;
		$config['num_links']       = 2;
		$config['total_rows']      = $total_rows;
		$config['full_tag_open']   = '<ul class="pagination justify-content-end">';
		$config['full_tag_close']  = '</ul>';
		$config['prev_link']       = '<span class="page-link">Previous</span>';
		$config['prev_tag_open']   = '<li class="page-item">';
		$config['prev_tag_close']  = '</li>';
		$config['next_link']       = '<span class="page-link">Next</span>';
		$config['next_tag_open']   = '<li class="page-item">';
		$config['next_tag_close']  = '</li>';
		$config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']   = '<span class="sr-only">(current)</span></span></li>';
		$config['num_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']   = '</span></li>';
		// $config['first_tag_open']  = '<span class="page-link">';
		// $config['first_tag_close'] = '</span>';
		// $config['last_tag_open']   = '<span class="page-link">';
		// $config['last_tag_close']  = '</span>';
		// $config['first_link']      = 'First';
		// $config['last_link']       = 'Last';
		$config['first_link'] = false;
		$config['last_link'] = false;
		return $config;
	}
}
if (!function_exists('get_settings')) {

	function get_settings($type)
	{

		$CI = get_instance();
		$CI->load->database();
		$des = $CI->db->get_where('settings', array('type' => $type))->row('description');

		return $des;
	}
}

if (!function_exists('price_format')) {

	function price_format($price)
	{
		$new_price = 0;

		$currency = get_settings('system_currency_symbol');
		if ($price > 0) {
			if (strpos($price, '.') !== false) {
				$new_price = $currency . ' ' . number_format($price, 2);
			} else {
				$new_price = $currency . ' ' . number_format($price, 2);
			}
		}
		return $new_price;
	}
}

if (!function_exists('price_format_usd')) {

	function price_format_usd($price)
	{
		$new_price = 0;

		$currency = get_settings('system_currency_symbol');
		$coversion_rate = get_settings('coversion_rate');
		if ($price > 0) {
			if (strpos($price, '.') !== false) {
				$new_price = '$' . number_format(($price * $coversion_rate), 2);
			} else {
				$new_price = '$' . number_format(($price * $coversion_rate), 2);
			}
		}
		return $new_price;
	}
}

if (!function_exists('send_email_smtp')) {

	function send_email_smtp($toemail, $htmlMessage, $subject)
	{
		$smtp_host = get_settings('smtp_host');
		$smtp_port = get_settings('smtp_port');
		$smtp_user = get_settings('smtp_user');
		$smtp_password = get_settings('smtp_password');
		$system_name = get_settings('system_name');

		$config['protocol'] = "smtp";
		$config['smtp_host'] = $smtp_host;
		$config['smtp_port'] = $smtp_port;
		$config['smtp_user'] = $smtp_user;
		$config['smtp_pass'] = $smtp_password;
		$config['smtp_crypto'] = 'tls';
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";

		$CI = &get_instance();
		$CI->load->library('session');

		$CI->email->initialize($config);
		$CI->email->set_newline("\r\n");
		$CI->email->from($smtp_user, $system_name);
		$list = array($toemail);
		$CI->email->to($list);

		$CI->email->subject($subject);
		$CI->email->message($htmlMessage);



		if ($CI->email->send()) {
			//echo 'Your email was sent, thanks chamil.';
		} else {
			//show_error($CI->email->print_debugger());
		}
	}
}

if (!function_exists('checkInputType')) {
	function checkInputType($input)
	{
		// Check if the input matches the email format
		if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
			return 'Email';
		}

		// Check if the input matches the phone number format
		$phonePattern = '/^\+?\d{1,3}[-.\s]?\(?\d{1,3}\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}$/';
		if (preg_match($phonePattern, $input)) {
			return 'Phone';
		}

		// If the input doesn't match any format, return 'Nothing'
		return 'Nothing';
	}
}

if (!function_exists('removeSpecialCharacters')) {

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
		return trim($value);
	}
}

if (!function_exists('is_JSON')) {

	function is_JSON()
	{
		call_user_func_array("json_decode", func_get_args());
		return (json_last_error() === JSON_ERROR_NONE);
	}
}

if (!function_exists("get_curl")) {
	function get_curl($url)
	{
		$user_agent = 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3B48b Safari/419.3';

		$headers = array(
			'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
			'Accept-Language: en-US,fr;q=0.8;q=0.6,en;q=0.4,ar;q=0.2',
			'Accept-Encoding: gzip,deflate',
			'Accept-Charset: utf-8;q=0.7,*;q=0.7',
			'cookie:datr=; locale=en_US; sb=; pl=n; lu=gA; c_user=; xs=; act=; presence='
		);

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_REFERER, base_url());

		$result = curl_exec($ch);

		curl_close($ch);

		return $result;
	}
}

if (!function_exists('file_upload')) {

	function file_upload($file_name, $media_path)
	{
		$media_dir = create_media_folder($media_path);
		$file_full_path = '';
		if (is_array($_FILES[$file_name]["name"])) {
			$count = count($_FILES[$file_name]["name"]);
			$file_full_path = array();
			for ($i = 0; $i < $count; $i++) {
				$path_info = '';
				if ($_FILES[$file_name]["name"][$i] != "") {
					$newFileName = uniqid();

					$targetFileName = 'converted_image.webp';
					$targetFilePath = $targetFilePath = $media_dir . '/' . $newFileName . '.webp';
					$sourceFileName = $_FILES[$file_name]['name'][$i];
					$sourceFilePath = $_FILES[$file_name]['tmp_name'][$i];
					$sourceFileType = $_FILES[$file_name]['type'][$i];

					$sourceImage = imagecreatefromstring(file_get_contents($sourceFilePath));

					move_uploaded_file($sourceFilePath, $targetFilePath);

					$file_full_path[] = str_replace($media_path, '', $targetFilePath);
				}
			}
		} else {
			if ($_FILES[$file_name]["name"] != "") {

				$newFileName = uniqid();

				$targetFileName = 'converted_image.webp';
				$targetFilePath = $targetFilePath = $media_dir . '/' . $newFileName . '.webp';
				$sourceFileName = $_FILES[$file_name]['name'];
				$sourceFilePath = $_FILES[$file_name]['tmp_name'];
				$sourceFileType = $_FILES[$file_name]['type'];

				$sourceImage = imagecreatefromstring(file_get_contents($sourceFilePath));

				move_uploaded_file($sourceFilePath, $targetFilePath);

				$file_full_path = str_replace($media_path, '', $targetFilePath);
			}
		}

		return $file_full_path;
	}
}

if (!function_exists('remFile')) {
	function remFile($path)
	{
		if (is_file($path)) {
			unlink($path);
		}
	}
}

function create_media_folder($media_path)
{
	$folder_name = $media_path . date("Y-m-d");
	if (!is_dir($folder_name)) {
		mkdir($folder_name);

		$content = "<!DOCTYPE html>
					<html>
					<head>
						<title>403 Forbidden</title>
					</head>
					<body>
					
					<p>Directory access is forbidden.</p>
					
					</body>
					</html>";
		$fp = fopen($folder_name . "/index.html", "wb");
		fwrite($fp, $content);
		fclose($fp);
	}
	return $folder_name;
}

function replace_occurrences($mainString, $status, $replacement)
{
	$search = "#efefef";
	$pos = strpos($mainString, $search);
	$count = 0;
	while ($pos !== false && $status != 0) {
		$mainString = substr_replace($mainString, $replacement, $pos, strlen($search));
		$pos = strpos($mainString, $search, $pos + strlen($replacement));
		$status--;
		$count++;
	}
	return $mainString;
}

function replace_occurrences2($mainString, $status, $replacement)
{
	$search = "circle.png";
	$pos = strpos($mainString, $search);
	$count = 0;
	while ($pos !== false && $status != 0) {
		$mainString = substr_replace($mainString, $replacement, $pos, strlen($search));
		$pos = strpos($mainString, $search, $pos + strlen($replacement));
		$status--;
		$count++;
	}
	return $mainString;
}

function hexToRgb($hex)
{
	// Remove the "#" symbol
	$hex = str_replace("#", "", $hex);
	// Convert to RGB
	$r = hexdec(substr($hex, 0, 2));
	$g = hexdec(substr($hex, 2, 2));
	$b = hexdec(substr($hex, 4, 2));

	return array("r" => $r, "g" => $g, "b" => $b);
}

function generateUniqueWalletID()
{
	$prefix = 'WALLET';
	$random_suffix = substr(md5(uniqid(mt_rand(), true)), 0, 6); // Generate a random suffix
	$timestamp = date('YmdHis'); // Add timestamp for further uniqueness
	$wallet_id = $prefix . $timestamp . $random_suffix;

	return $wallet_id;
}

function generateTransactionID($prefix = 'TX')
{
	$timestamp = time();
	$randomNumber = mt_rand(1000, 9999); // You can adjust the range as needed

	$transactionID = $prefix . $timestamp . $randomNumber;
	return $transactionID;
}

function add_query_params($url, $params)
{
	$url_parts = parse_url($url);
	$query = array();

	if (isset($url_parts['query'])) {
		parse_str($url_parts['query'], $query);
	}

	$query = array_merge($query, $params);
	$url_parts['query'] = http_build_query($query);

	return build_url($url_parts);
}

function build_url($parts)
{
	return (isset($parts['scheme']) ? "{$parts['scheme']}:" : '') .
		((isset($parts['user']) || isset($parts['host'])) ? '//' : '') .
		(isset($parts['user']) ? "{$parts['user']}" : '') .
		(isset($parts['pass']) ? ":{$parts['pass']}" : '') .
		(isset($parts['user']) ? '@' : '') .
		(isset($parts['host']) ? "{$parts['host']}" : '') .
		(isset($parts['port']) ? ":{$parts['port']}" : '') .
		(isset($parts['path']) ? "{$parts['path']}" : '') .
		(isset($parts['query']) ? "?{$parts['query']}" : '') .
		(isset($parts['fragment']) ? "#{$parts['fragment']}" : '');
}
