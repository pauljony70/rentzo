<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class CCAvenue extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Load the Checkout model
		$this->load->model('checkout_model');
	}

	public function response_post()
	{
		$workingKey = 'CCE86567FD4D81008A422EFB8DF00021';
		$encResponse = $_POST["encResp"];
		$rcvdString = $this->decrypt($encResponse, $workingKey);
		$order_status = "";
		$payment_response = array();
		$decryptValues = explode('&', $rcvdString);
		$dataSize = sizeof($decryptValues);
		for ($i = 0; $i < $dataSize; $i++) {
			$information = explode('=', $decryptValues[$i]);
			if ($i == 3)	$order_status = $information[1];
		}
		for ($i = 0; $i < $dataSize; $i++) {
			$information = explode('=', $decryptValues[$i]);
			$payment_response[$information[0]] = $information[1];
		}
		if (!empty($order_status)) {

			if ($order_status === "Success") {
				$user_id = removeSpecialCharacters($this->session->userdata('user_id'));
				$qouteid = removeSpecialCharacters($this->session->userdata('qoute_id'));
				$order_id = removeSpecialCharacters($payment_response['order_id']);
				$tracking_id = removeSpecialCharacters($payment_response['tracking_id']);
				$fullname = removeSpecialCharacters($payment_response['delivery_name']);
				$mobile = removeSpecialCharacters($payment_response['delivery_tel']);
				$locality = '';
				$fulladdress = removeSpecialCharacters($payment_response['delivery_address']);
				$city = removeSpecialCharacters($payment_response['delivery_city']);
				$state = removeSpecialCharacters($payment_response['delivery_state']);
				$pincode = removeSpecialCharacters($payment_response['delivery_zip']);
				$addresstype = 'Home';
				$email = removeSpecialCharacters($payment_response['billing_email']);
				$payment_id = removeSpecialCharacters($payment_response['tracking_id']);
				$payment_mode = removeSpecialCharacters($payment_response['payment_mode']);
				$coupon_code = removeSpecialCharacters($this->session->userdata('coupon_code'));
				$order_id_parts = explode("-", $order_id);
				$new_order_id = $order_id_parts[0];
				$city_id = $order_id_parts[1];
				$state = $order_id_parts[2];

				$order_detail = $this->checkout_model->online_place_order_details($user_id, $qouteid, $new_order_id, $fullname, $mobile, $locality, $fulladdress, $city, $state, $pincode, $addresstype, $email, $payment_id, $payment_mode, $coupon_code, $city_id);

				if ($order_detail['status'] == 'update') {

					$this->checkout_model->empty_cart($user_id, $qouteid);

					return redirect('thankyou/' . $new_order_id);
				} else {
					return redirect('cart');
				}
			} else if ($order_status === "Aborted") {
				echo "<br>Aborted";
			} else if ($order_status === "Failure") {
				echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
			} else {
				echo "<br>Security Error. Illegal access detected";
			}
		}
	}



	public function save_post()
	{

		$data = $this->input->post(array(
			'tid' => 'tid',
			'merchant_id' => 'merchant_id',
			'order_id' => 'order_id',
			'amount' => 'amount',
			'currency' => 'currency', // Fix the key here
			'redirect_url' => 'redirect_url',
			'cancel_url' => 'cancel_url',
			'language' => 'language',
			'billing_name' => 'billing_name',
			'billing_address' => 'billing_address',
			'billing_city' => 'billing_city',
			'billing_state' => 'billing_state',
			'billing_zip' => 'billing_zip',
			'billing_country' => 'billing_country',
			'billing_tel' => 'billing_tel',
			'billing_email' => 'billing_email',
			'delivery_name' => 'delivery_name',
			'delivery_address' => 'delivery_address',
			'delivery_city' => 'delivery_city',
			'delivery_state' => 'delivery_state',
			'delivery_zip' => 'delivery_zip',
			'delivery_country' => 'delivery_country',
			'delivery_tel' => 'delivery_tel'
		));
		
		$merchant_data = '';
		$working_key = 'CCE86567FD4D81008A422EFB8DF00021'; // Shared by CCAVENUES
		$access_code = 'AVWO39KL45AV85OWVA'; // Shared by CCAVENUES
		
		foreach ($data as $key => $value) {
			$merchant_data .= $key . '=' . $value . '&';
		}
		
		//$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

		$encrypted_data = $this->encrypt($merchant_data, $working_key);

		// var_dump($encrypted_data);

?>
		<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
			<?php
			echo "<input type=hidden name=encRequest value=$encrypted_data>";
			echo "<input type=hidden name=access_code value=$access_code>";
			?>
		</form>
		</center>
		<script language='javascript'>
			document.redirect.submit();
		</script>


<?php
		echo "Payment Works";
	}

	public function some_method()
	{
		echo "Works";
	}


	// error_reporting(0);

	public function encrypt($plainText, $key)
	{
		$key = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		$encryptedText = bin2hex($openMode);
		return $encryptedText;
	}

	public function decrypt($encryptedText, $key)
	{
		$key = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText = $this->hextobin($encryptedText);
		$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		return $decryptedText;
	}
	//*********** Padding Function *********************

	public function pkcs5_pad($plainText, $blockSize)
	{
		$pad = $blockSize - (strlen($plainText) % $blockSize);
		return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	function hextobin($hexString)
	{
		$length = strlen($hexString);
		$binString = "";
		$count = 0;
		while ($count < $length) {
			$subString = substr($hexString, $count, 2);
			$packedString = pack("H*", $subString);
			if ($count == 0) {
				$binString = $packedString;
			} else {
				$binString .= $packedString;
			}

			$count += 2;
		}
		return $binString;
	}
}
