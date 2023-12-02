<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class ChatMessagesController extends REST_Controller
{
    protected $request_method = 'post';

    public function __construct()
    {
        parent::__construct();

        // Load the user model
        $this->load->model('chat_model');
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
        $this->form_validation->set_rules('message', 'Message', 'required');

        // Check if the form validation passes
        if ($this->form_validation->run() === FALSE) {
            // Form validation failed, handle the errors (you can redirect or show an error message)
            $errors =  $this->form_validation->error_array();
            $this->responses(0, 'Required field missing', $errors);
        }

        // Form validation passed, proceed to insert the message
        $data = array(
            'order_id' => $this->input->post('order_id'),
            'product' => $this->input->post('product'),
            'user_id' => $this->input->post('user_id'),
            'seller_id' => $this->input->post('seller_id'),
            'send_by' => 'user',
            'message' => $this->input->post('message'),
        );


        // Insert the message into the database
        $insert_id = $this->chat_model->insertMessage($data);

        // Send a success response
        $this->responses(1, 'Message inserted successfully', array('id' => $insert_id));
    }

    public function getMessages_post()
    {
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('order_id', 'Order ID', 'required');
        $this->form_validation->set_rules('product', 'Product', 'required');
        $this->form_validation->set_rules('user_id', 'User ID', 'required');
        $this->form_validation->set_rules('seller_id', 'Seller ID', 'required');
        $this->form_validation->set_rules('last_message_id', 'Last Message Id', 'numeric|required');

        // Check if the form validation passes
        if ($this->form_validation->run() === FALSE) {
            // Form validation failed, handle the errors (you can redirect or show an error message)
            $errors =  $this->form_validation->error_array();
            $this->responses(0, 'Required field missing', $errors);
        }

        $order_id = $this->input->post('order_id');
        $product = $this->input->post('product');
        $user_id = $this->input->post('user_id');
        $seller_id = $this->input->post('seller_id');
        $last_message_id = $this->input->post('last_message_id');

        $messages = $this->chat_model->getMessages($order_id, $product, $user_id, $seller_id, $last_message_id);

        // Update the response to include messages
        $this->responses(1, 'Messages fetched successfully', array('data' => $messages));
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
        $this->form_validation->set_rules('last_message_id', 'Last Message ID', 'numeric|required');

        // Check if the form validation passes
        if ($this->form_validation->run() === FALSE) {
            // Form validation failed, handle the errors (you can redirect or show an error message)
            $errors =  $this->form_validation->error_array();
            $this->responses(0, 'Required field missing', $errors);
        }

        $order_id = $this->input->post('order_id');
        $product = $this->input->post('product');
        $user_id = $this->input->post('user_id');
        $seller_id = $this->input->post('seller_id');
        $lastMessageId = $this->input->post('last_message_id');

        // Call the updateSeenStatus function from the model
        $this->chat_model->updateSeenStatus($order_id, $product, $user_id, $seller_id, $lastMessageId);

        $this->responses(1, 'Messages are updated successfully');
    }
}
