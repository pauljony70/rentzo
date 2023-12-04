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
        $order_id = $this->post('order_id');
        $product = $this->post('product');
        $user_id = $this->post('user_id');
        $seller_id = $this->post('seller_id');
        $message = $this->post('message');
        if ($order_id !== '' && $product !== '' && $user_id !== '' && $seller_id !== '' && $message !== '') {
            // Form validation passed, proceed to insert the message
            $data = array(
                'order_id' => $order_id,
                'product' => $product,
                'user_id' => $user_id,
                'seller_id' => $seller_id,
                'send_by' => 'user',
                'message' => $message,
            );


            // Insert the message into the database
            $insert_id = $this->chat_model->insertMessage($data);

            // Send a success response
            $this->responses(1, 'Message inserted successfully', array('id' => $insert_id));
        } else {
            $this->responses(0, 'Required field missing');
        }
    }

    public function getMessages_post()
    {
        $order_id = $this->post('order_id');
        $product = $this->post('product');
        $user_id = $this->post('user_id');
        $seller_id = $this->post('seller_id');
        $last_message_id = $this->post('last_message_id');
        if ($order_id !== '' && $product !== '' && $user_id !== '' && $seller_id !== '' && $last_message_id !== '') {
            $messages = $this->chat_model->getMessages($order_id, $product, $user_id, $seller_id, $last_message_id);

            // Update the response to include messages
            $this->responses(1, 'Messages fetched successfully', array('data' => $messages));
        } else {
            $this->responses(0, 'Required field missing');
        }
    }

    public function updateSeenStatus_post()
    {
        $order_id = $this->post('order_id');
        $product = $this->post('product');
        $user_id = $this->post('user_id');
        $seller_id = $this->post('seller_id');
        $lastMessageId = $this->post('last_message_id');
        if ($order_id !== '' && $product !== '' && $user_id !== '' && $seller_id !== '' && $last_message_id !== '') {
            // Call the updateSeenStatus function from the model
            $this->chat_model->updateSeenStatus($order_id, $product, $user_id, $seller_id, $lastMessageId);

            $this->responses(1, 'Messages are updated successfully');
        } else {
            $this->responses(0, 'Required field missing');
        }
    }
}
