<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = [
			'order_id' => $_GET['order_id'],
			'amount' => $_GET['amount'],
			'currency' => $_GET['currency'],
			'billing_name' => $_GET['billing_name'],
			'billing_address' => $_GET['billing_address'],
			'billing_city' => $_GET['billing_city'],
			'billing_state' => $_GET['billing_state'],
			'billing_zip' => $_GET['billing_zip'],
			'billing_tel' => $_GET['billing_tel'],
			'billing_email' => $_GET['billing_email'],
			'delivery_name' => $_GET['delivery_name'],
			'delivery_address' => $_GET['delivery_address'],
			'delivery_city' => $_GET['delivery_city'],
			'delivery_state' => $_GET['delivery_state'],
			'delivery_zip' => $_GET['delivery_zip'],
			'delivery_tel' => $_GET['delivery_tel']
		];
		// print_r($data);exit;
		$this->load->view('payment', ['data' => $data]);
	}

	public function save()
	{

		$data = $this->input->post(array(
			'tid' => 'tid',
			'merchant_id' => 'merchant_id',
			'order_id' => 'order_id',
			'amount' => 'amount',
			'currency' => 'currency',
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

		//var_dump($data);




		$merchant_data = '';
		$working_key = '66C0AD305B73E91679EC5A31A0249158'; //Shared by CCAVENUES
		$access_code = 'AVMW43KC08CE92WMEC'; //Shared by CCAVENUES

		foreach ($data as $key => $value) {
			$merchant_data .= $key . '=' . urlencode($value) . '&';
		}

		//$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
		$this->load->library('someclass');

		$encrypted_data = $this->someclass->encrypt($merchant_data, $working_key);

		// var_dump($encrypted_data);

?>
		<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
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
	function errors()
	{
		echo "done";
	}

	public function cancel()
	{
		$this->load->library('someclass');
		//$this->someclass->some_method();  // Object instances will always be lower case
		$workingKey = '66C0AD305B73E91679EC5A31A0249158';		//Working Key should be provided here.
		$encResponse = $_POST["encResp"];			//This is the response sent by the CCAvenue Server
		$rcvdString = $this->someclass->decrypt($encResponse, $workingKey);		//Crypto Decryption used as per the specified working key.
		$order_status = "";
		$decryptValues = explode('&', $rcvdString);
		$dataSize = sizeof($decryptValues);
		for ($i = 0; $i < $dataSize; $i++) {
			$information = explode('=', $decryptValues[$i]);
			if ($i == 3)	$order_status = $information[1];
		}
		if (!empty($order_status)) {
			echo "<center>";

			if ($order_status === "Success") {
				echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
			} else if ($order_status === "Aborted") {
				echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
			} else if ($order_status === "Failure") {
				echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
			} else {
				echo "<br>Security Error. Illegal access detected";
			}

			echo "<br><br>";

			echo "<table cellspacing=4 cellpadding=4>";
			for ($i = 0; $i < $dataSize; $i++) {
				$information = explode('=', $decryptValues[$i]);
				echo '<tr><td>' . $information[0] . '</td><td>' . $information[1] . '</td></tr>';
			}

			echo "</table><br>";
			echo "</center>";





			// var_dump($encrypted_data);
		}
	}

	public function redirect()
	{
		$this->load->library('someclass');
		//$this->someclass->some_method();  // Object instances will always be lower case
		$workingKey = '66C0AD305B73E91679EC5A31A0249158';		//Working Key should be provided here.
		$encResponse = $_POST["encResp"];			//This is the response sent by the CCAvenue Server
		$rcvdString = $this->someclass->decrypt($encResponse, $workingKey);		//Crypto Decryption used as per the specified working key.
		$order_status = "";
		$decryptValues = explode('&', $rcvdString);
		$dataSize = sizeof($decryptValues);
		for ($i = 0; $i < $dataSize; $i++) {
			$information = explode('=', $decryptValues[$i]);
			if ($i == 3)	$order_status = $information[1];
		}
		$payment_response = array();
		for ($i = 0; $i < $dataSize; $i++) {
			$information = explode('=', $decryptValues[$i]);
			$payment_response[$information[0]] = $information[1];
		}
		if (!empty($order_status)) {
			echo "<center>";

			if ($order_status === "Success") {
				echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		?>
				<form method="post" name="redirect" action="https://www.marurang.in/API/index.php/app/ccavenue/success/<?= $payment_response['tracking_id'] ?>">

				</form>
				<script language='javascript'>
					document.redirect.submit();
				</script>
			<?php
			} else if ($order_status === "Aborted") {
				echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
			} else if ($order_status === "Failure") {
				echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
			?>
				<form method="post" name="redirect" action="https://www.marurang.in/API/index.php/app/ccavenue/fail">

				</form>
				<script language='javascript'>
					document.redirect.submit();
				</script>
<?php
			} else {
				echo "<br>Security Error. Illegal access detected";
			}

			echo "<br><br>";

			echo "<table cellspacing=4 cellpadding=4>";


			echo "</table><br>";
			echo "</center>";





			// var_dump($encrypted_data);
		}
	}

	public function success($tracking_id)
	{
		echo "Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.<br>Your tracking id is " . $tracking_id;
	}

	public function fail()
	{
		echo "Thank you for shopping with us.However,the transaction has been declined.";
	}
}
