<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sms_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function send_sms_new($message = '', $country_code = '', $reciever_phone = '')
	{
		if ($country_code == 968) {
			$message = urlencode($message);
			$url = "https://www.ismartsms.net/iBulkSMS/HttpWS/SMSDynamicAPI.aspx?UserId=ebuy_webs&Password=Rn3@9jwe73&MobileNo={$country_code}{$reciever_phone}&Message={$message}&Lang=0&FLashSMS=N";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'charset: utf-8',
			));

			$response = curl_exec($ch);

			if (curl_errno($ch)) {
				echo 'Error: ' . curl_error($ch);
			} else {
				if ($response == 1) {
					$sms_sent = "sent";
				} else {
					$sms_sent = "failed";
				}
			}
		} else {
			$sms_sent = 'disabled';
		}
		return $sms_sent;
	}


	//COMMON FUNCTION FOR SENDING SMS
	function send_sms($message = '', $reciever_phone = '')
	{
		$active_sms_service = $this->db->get_where('settings', array(
			'type' => 'active_sms_service'
		))->row()->description;

		if ($active_sms_service == '' || $active_sms_service == 'disabled') {
			return 'disabled';
		}


		if ($active_sms_service == 'soft') {
			return $this->send_sms_via_soft($message, $reciever_phone);
		} else if ($active_sms_service == 'twilio') {
			return $this->send_sms_via_twilio($message, $reciever_phone);
		}
	}

	function send_sms_via_soft($message, $reciever_phone)
	{
		$phone = "962" . $reciever_phone;
		$sms_url =  $this->db->get_where('settings', array('type' => 'soft_url'))->row()->description;
		$soft_sender =  $this->db->get_where('settings', array('type' => 'soft_sender'))->row()->description;
		$soft_user =  $this->db->get_where('settings', array('type' => 'soft_user'))->row()->description;
		$soft_password =  $this->db->get_where('settings', array('type' => 'soft_password'))->row()->description;
		$message = str_replace(' ', '+', $message);
		$url = $sms_url . "?Phonenumber=" . $phone . "&sender=" . $soft_sender . "&msg=" . $message . "&user=" . $soft_user . "&pass=" . $soft_password;

		$this->get_curl($url);
		return 'sent';
	}


	// SEND SMS VIA TWILIO API
	function send_sms_via_twilio($message = '', $reciever_phone = '')
	{

		// LOAD TWILIO LIBRARY
		/*  require_once(APPPATH . 'libraries/twilio_library/Twilio.php');


        $account_sid    = $this->db->get_where('settings', array('type' => 'twilio_account_sid'))->row()->description;
        $auth_token     = $this->db->get_where('settings', array('type' => 'twilio_auth_token'))->row()->description;
        $client         = new Services_Twilio($account_sid, $auth_token);

        $client->account->messages->create(array(
            'To'        => $reciever_phone,
            'From'      => $this->db->get_where('settings', array('type' => 'twilio_sender_phone_number'))->row()->description,
            'Body'      => $message
        ));*/
		return 'sent';
	}


	// Function to generate OTP 
	function generateNumericOTP($n)
	{

		// Take a generator string which consist of 
		// all numeric digits 
		$generator = "1357902468";

		// Iterate for n-times and pick a single character 
		// from generator and append it to $result 

		// Login for generating a random character from generator 
		//     ---generate a random number 
		//     ---take modulus of same with length of generator (say i) 
		//     ---append the character at place (i) from generator to result 

		$result = "";

		for ($i = 1; $i <= $n; $i++) {
			$result .= substr($generator, (rand() % (strlen($generator))), 1);
		}

		// Return result 
		return $result;
	}
	function get_curl($url)
	{
		$headers = array();

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);

		curl_close($ch);
		//print_r($result);
		//return $result;
	}
}
