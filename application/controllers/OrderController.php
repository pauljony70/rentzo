<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class OrderController extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Load the Order model
		$this->load->model('order_model');
		$this->load->model('product_model');
		$this->load->model('home_model');
		$this->load->model('chat_model');
	}
	public function index_get()
	{
		$this->responses(1, 'Server OK');
	}

	public function get_order_get()
	{
		$user_id = $this->session->userdata("user_id");
		$default_language = $this->session->userdata("default_language");
		$this->data['order'] = $this->order_model->get_order_list_detailsProd($default_language, $user_id, $_REQUEST['order_id']);
		$this->load->view('website/order.php', $this->data);  // ye view/website folder hai
	}

	public function insertMessage_post()
	{
		// Load the form validation library
		$this->load->library('form_validation');

		// Set validation rules
		$this->form_validation->set_rules('order_id', 'Order ID', 'required');
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('user_id', 'User ID', 'required');
		$this->form_validation->set_rules('seller_id', 'Seller ID', 'required');
		$this->form_validation->set_rules('send_by', 'Send By', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

		// Check if the form validation passes
		if ($this->form_validation->run() === FALSE) {
			// Form validation failed, handle the errors (you can redirect or show an error message)
			$errors = validation_errors();
			$response = array('status' => 0, 'message' => $errors);
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
			return;
		}

		// Form validation passed, proceed to insert the message
		$data = array(
			'order_id' => $this->input->post('order_id'),
			'product' => $this->input->post('product'),
			'user_id' => $this->input->post('user_id'),
			'seller_id' => $this->input->post('seller_id'),
			'send_by' => $this->input->post('send_by'),
			'message' => $this->input->post('message'),
		);

		if ($this->session->userdata("user_id") === $data['user_id']) {
			// Insert the message into the database
			$insert_id = $this->chat_model->insertMessage($data);

			// Send a success response
			$response = array('status' => 1, 'message' => 'Message inserted successfully', 'id' => $insert_id);
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		} else {
			$response = array('status' => 0, 'message' => 'Please login to continue chat');
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function getMessages_get()
	{
		$order_id = $this->input->get('order_id');
		$product = $this->input->get('product');
		$user_id = $this->input->get('user_id');
		$seller_id = $this->input->get('seller_id');
		$last_message_id = $this->input->get('lastMessageId');

		if ($this->session->userdata("user_id") === $user_id) {
			$messages = $this->chat_model->getMessages($order_id, $product, $user_id, $seller_id, $last_message_id);

			// Update the response to include messages
			$response = array('status' => 1, 'message' => 'Messages fetched successfully', 'data' => $messages);
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		} else {
			$response = array('status' => 0, 'message' => 'Your session is timed out. Please login to continue chat');
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function updateSeenStatus_post()
	{
		// Load the form validation library
		$this->load->library('form_validation');

		// Set validation rules
		$this->form_validation->set_rules('order_id', 'Order ID', 'required');
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('user_id', 'User ID', 'required');
		$this->form_validation->set_rules('seller_id', 'Seller ID', 'required');
		$this->form_validation->set_rules('lastMessageId', 'Last Message ID', 'required');

		// Check if the form validation passes
		if ($this->form_validation->run() === FALSE) {
			// Form validation failed, handle the errors (you can redirect or show an error message)
			$errors = validation_errors();
			$response = array('status' => 0, 'message' => $errors);
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
			return;
		}
		$order_id = $this->input->post('order_id');
		$product = $this->input->post('product');
		$user_id = $this->input->post('user_id');
		$seller_id = $this->input->post('seller_id');
		$lastMessageId = $this->input->post('lastMessageId');

		if ($this->session->userdata("user_id") === $user_id) {
			// Call the updateSeenStatus function from the model
			$result = $this->chat_model->updateSeenStatus($order_id, $product, $user_id, $seller_id, $lastMessageId);

			// Send a response back to the JavaScript
			$response = array('status' => 1, 'message' => 'Messages are updated succesfully');
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		} else {
			$response = array('status' => 0, 'message' => 'Your session is timed out. Please login to continue chat');
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function sendChatNotificationToSeller_post()
	{
		$order_id = $this->input->post('order_id');
		$product = $this->input->post('product');
		$seller_id = $this->input->post('seller_id');
		$user_unseen_message_count = $this->input->post('user_unseen_message_count');

		$seller_data = $this->db->get_where('sellerlogin', array('seller_unique_id' => $seller_id))->row_array();
		ob_start();
		$this->load->view('website/email_templates/message-notification.php', array(
			'seller_name' => $seller_data['fullname'],
			'unseen_message_count' => $user_unseen_message_count,
			'order_id' => $order_id,
			'product' => $product
		));
		$email_body = ob_get_clean();
		$subject = 'You have got ' . $user_unseen_message_count . ' message';

		send_email_smtp($seller_data['email'], $email_body, $subject);

		$header = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html\r\n";

		$response = array('status' => 1, 'message' => 'Notification send to selller successfully');
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function order_details_get($order_id, $prod_id)
	{
		$user_id = $this->session->userdata("user_id");
		$default_language = $this->session->userdata("default_language");
		$this->data['order_details'] = $this->order_model->get_order_track_details($default_language, $order_id, $prod_id);

		$this->load->view('website/orderdetails.php', $this->data);  // ye view/website folder hai
	}

	// function for get cart count
	public function getOrder_post()
	{
		$requiredparameters = array('language', 'user_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($user_id) {
				$order_detail = $this->order_model->get_order_list_details($user_id);

				if ($order_detail) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => array()

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	// function for get cart count
	public function getOrderDetails_post()
	{
		$requiredparameters = array('language', 'user_id', 'order_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$order_id = removeSpecialCharacters($this->post('order_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());

			if ($user_id && $order_id) {
				$order_detail = $this->order_model->get_order_full_details($user_id, $order_id);

				if (count($order_detail['product_details']) > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else if (!$user_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$order_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	// function for get cart count
	public function trackOrder_post()
	{
		$requiredparameters = array('language', 'order_id');

		$language_code = removeSpecialCharacters($this->post('language'));

		$order_id = removeSpecialCharacters($this->post('order_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());


			if ($order_id) {
				$order_detail = $this->order_model->get_order_track_details($order_id);

				if (count($order_detail['product_details']) > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	// function for get cart count
	public function cancelOrder_post()
	{
		$requiredparameters = array('language', 'order_id', 'pid');

		$language_code = removeSpecialCharacters($this->post('language'));

		$order_id = removeSpecialCharacters($this->post('order_id'));
		$pid = removeSpecialCharacters($this->post('pid'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());


			if ($order_id && $pid) {

				$cancel_detail = $this->order_model->change_order_status_details($order_id, $pid, 'Cancelled');
				if ($cancel_detail == 'done') {
					$order_detail = $this->order_model->get_order_track_details($language_code, $order_id, $pid);

					if (count($order_detail['product_details']) > 0) {

						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('order_cancelled', $language_code),
							$this->config->item('rest_data_field_name') => $order_detail

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
							$this->config->item('rest_data_field_name') => $order_detail

						], self::HTTP_OK);
					}
				} else if ($cancel_detail == 'not_exist') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('not_exist', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				} else if ($cancel_detail == 'already_cancelled') {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('already_cancelled', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				} else if ($cancel_detail == 'invalid') {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_request', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				}
			} else if (!$order_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$pid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}


	// function for get cart count
	public function returnOrder_post()
	{
		$requiredparameters = array('language', 'order_id', 'pid');

		$language_code = removeSpecialCharacters($this->post('language'));

		$order_id = removeSpecialCharacters($this->post('order_id'));
		$pid = removeSpecialCharacters($this->post('pid'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());


			if ($order_id && $pid) {

				$cancel_detail = $this->order_model->change_order_status_details_returned($order_id, $pid, 'Returned');
				if ($cancel_detail == 'done') {
					$order_detail = $this->order_model->get_order_track_details($order_id);

					if (count($order_detail['product_details']) > 0) {

						$this->response([
							$this->config->item('rest_status_field_name') => 1,
							$this->config->item('rest_message_field_name') => get_phrase('order_returned', $language_code),
							$this->config->item('rest_data_field_name') => $order_detail

						], self::HTTP_OK);
					} else {
						$this->response([
							$this->config->item('rest_status_field_name') => 0,
							$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
							$this->config->item('rest_data_field_name') => $order_detail

						], self::HTTP_OK);
					}
				} else if ($cancel_detail == 'not_exist') {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('not_exist', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				} else if ($cancel_detail == 'already_returned') {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('already_returned', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				} else if ($cancel_detail == 'invalid') {

					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('invalid_request', $language_code),
						$this->config->item('rest_data_field_name') => $fail_response

					], self::HTTP_OK);
				}
			} else if (!$order_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$pid) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('product_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	// kamal api 

	// function for get cart count
	public function getOrderProd_post()
	{
		$requiredparameters = array('language', 'user_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			if ($user_id) {
				$order_detail = $this->order_model->get_order_list_detailsProd($user_id);

				if ($order_detail) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => array()

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}

	// function for get cart count
	public function getOrderDetailsProd_post()
	{
		$requiredparameters = array('language', 'user_id', 'order_id');

		$language_code = removeSpecialCharacters($this->post('language'));
		$user_id = removeSpecialCharacters($this->post('user_id'));
		$order_id = removeSpecialCharacters($this->post('order_id'));



		$validation = $this->parameterValidation($requiredparameters, $this->post()); //$this->post() holds post values

		if ($validation == 'valid') {
			$order_summery = array('order_id' => '', 'status' => '', 'payment_mode' => '', 'create_date' => '', 'total_qty' => '', 'total_price' => '', 'discount' => '');
			$shipping_address = array('fullname' => '', 'mobile' => '', 'locality' => '', 'fulladdress' => '', 'city' => '', 'state' => '', 'pincode' => '', 'addresstype' => '', 'email' => '');
			$fail_response = array('order_summery' => $order_summery, 'shipping_address' => $shipping_address, 'product_details' => array());

			if ($user_id && $order_id) {
				$order_detail = $this->order_model->get_order_full_detailsProd($user_id, $order_id);

				if (count($order_detail['product_details']) > 0) {

					$this->response([
						$this->config->item('rest_status_field_name') => 1,
						$this->config->item('rest_message_field_name') => get_phrase('order_details', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				} else {
					$this->response([
						$this->config->item('rest_status_field_name') => 0,
						$this->config->item('rest_message_field_name') => get_phrase('order_empty', $language_code),
						$this->config->item('rest_data_field_name') => $order_detail

					], self::HTTP_OK);
				}
			} else if (!$user_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('user_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			} else if (!$order_id) {
				$this->response([
					$this->config->item('rest_status_field_name') => 0,
					$this->config->item('rest_message_field_name') => get_phrase('order_id_mandatory', $language_code),
					$this->config->item('rest_data_field_name') => $fail_response

				], self::HTTP_OK);
			}
		} else {
			echo $validation; //These are parameters are missing.
		}
	}
}
