<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chat_model extends CI_Model
{
    public function insertMessage($data)
    {
        $this->db->insert('chat_messages', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }


    public function getMessages($order_id, $product, $user_id, $seller_id, $last_message_id)
    {
        $this->db->where('order_id', $order_id);
        $this->db->where('product', $product);
        $this->db->where('message_id >', $last_message_id);
        $this->db->order_by('created_at', 'asc');
        $query = $this->db->get('chat_messages');
        $messages =  $query->result_array();
        $unseen_message_count = $this->db->where([
            'order_id' => $order_id,
            'product' => $product,
            'send_by' => 'seller',
            'seen' => false
            ])->count_all_results('chat_messages');
        return array('messages' => $messages, 'unseen_message_count' => $unseen_message_count);
    }

    public function updateSeenStatus($order_id, $product, $user_id, $seller_id, $lastMessageId)
    {
        $this->db->where('order_id', $order_id);
        $this->db->where('product', $product);
        $this->db->where('send_by', 'seller');
        $this->db->where('seen', false);
        $this->db->where('message_id <=', $lastMessageId);

        // Update the 'seen' column to true
        $this->db->update('chat_messages', array('seen' => true, 'updated_at' => date('Y-m-d H:i:s')));

        // You can return a response if needed
        return $this->db->affected_rows() > 0;
    }
}
