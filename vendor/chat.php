<?php
include('session.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'insertMessage') {
        insertMessage($conn, $_POST);
    } elseif ($_POST['action'] === 'getMessages') {
        getMessages($conn, $_POST['order_id'], $_POST['product'], $_POST['user_id'], $_POST['seller_id'], $_POST['lastMessageId']);
    } elseif ($_POST['action'] === 'updateSeenStatus') {
        updateSeenStatus($conn, $_POST['order_id'], $_POST['product'], $_POST['user_id'], $_POST['seller_id'], $_POST['lastMessageId']);
    } elseif ($_POST['action'] === 'sendChatNotification') {
        sendChatNotification($conn, $Common_Function, $_POST['order_id'], $_POST['product'], $_POST['user_id'], $_POST['seller_id'], $_POST['seller_unseen_message_count']);
    }
}

function insertMessage($conn, $data)
{
    if (stripslashes($_POST['code']) == $_SESSION['_token'] && $data['seller_id'] == $_SESSION['admin']) {
        $order_id = mysqli_real_escape_string($conn, $data['order_id']);
        $product = mysqli_real_escape_string($conn, $data['product']);
        $user_id = mysqli_real_escape_string($conn, $data['user_id']);
        $seller_id = mysqli_real_escape_string($conn, $data['seller_id']);
        $send_by = mysqli_real_escape_string($conn, $data['send_by']);
        $message = mysqli_real_escape_string($conn, $data['message']);

        // Perform the database insert
        $sql = "INSERT INTO chat_messages (order_id, product, user_id, seller_id, send_by, message) 
            VALUES ('$order_id', '$product', '$user_id', '$seller_id', '$send_by', '$message')";

        if ($conn->query($sql) === TRUE) {
            // Get the inserted ID
            $inserted_id = $conn->insert_id;

            // Send a success response with the inserted ID
            $response = array('status' => 1, 'message' => 'Message inserted successfully', 'id' => $inserted_id);
            echo json_encode($response);
        } else {
            // Handle the case where the insert fails
            $response = array('status' => 0, 'message' => 'Error inserting message: ' . $conn->error);
            echo json_encode($response);
        }

        // Close the database connection
        $conn->close();
    } else {
        // Handle the case where the insert fails
        $response = array('status' => 0, 'message' => 'Please login to continue chat');
        echo json_encode($response);
    }
}

function getMessages($conn, $order_id, $product, $user_id, $seller_id, $lastMessageId)
{
    if (stripslashes($_POST['code']) == $_SESSION['_token'] && $seller_id == $_SESSION['admin']) {
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $product = mysqli_real_escape_string($conn, $product);
        $user_id = mysqli_real_escape_string($conn, $user_id);
        $seller_id = mysqli_real_escape_string($conn, $seller_id);
        // Construct the SQL query
        $sql = "SELECT * FROM chat_messages 
            WHERE order_id = '$order_id' 
            AND product = '$product'
            AND message_id > $lastMessageId
            ORDER BY created_at ASC";

        // Execute the query
        $result = $conn->query($sql);

        // Check for errors
        if (!$result) {
            // Handle the case where the query fails
            $response = array('status' => 0, 'message' => 'Error retrieving messages: ' . $conn->error);
            echo json_encode($response);
        } else {
            // Fetch the result rows as an associative array
            $messages = array();
            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }

            // Free the result set
            $result->free_result();

            $user_unseen_message_count = '';
            $send_by = 'user';
            $sql = "SELECT COUNT(*) as count FROM chat_messages WHERE order_id = ? AND product = ? AND send_by = ? AND seen = false";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $order_id, $product, $send_by);
            $stmt->execute();
            $stmt->bind_result($user_unseen_message_count);
            $stmt->fetch();
            $stmt->close();

            $seller_unseen_message_count = '';
            $send_by = 'seller';
            $sql = "SELECT COUNT(*) as count FROM chat_messages WHERE order_id = ? AND product = ? AND send_by = ? AND seen = false";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $order_id, $product, $send_by);
            $stmt->execute();
            $stmt->bind_result($seller_unseen_message_count);
            $stmt->fetch();
            $stmt->close();

            // Send a success response with the fetched messages
            $response = array('status' => 1, 'data' => array('messages' => $messages, 'user_unseen_message_count' => $user_unseen_message_count, 'seller_unseen_message_count' => $seller_unseen_message_count));
            echo json_encode($response);
        }
    } else {
        // Handle the case where the insert fails
        $response = array('status' => 0, 'message' => 'Please login to continue chat');
        echo json_encode($response);
    }
}

function updateSeenStatus($conn, $order_id, $product, $user_id, $seller_id, $lastMessageId)
{
    if (stripslashes($_POST['code']) == $_SESSION['_token'] && $seller_id == $_SESSION['admin']) {
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $product = mysqli_real_escape_string($conn, $product);
        $user_id = mysqli_real_escape_string($conn, $user_id);
        $seller_id = mysqli_real_escape_string($conn, $seller_id);

        // Perform the database insert
        $sql = "UPDATE chat_messages SET seen = true, updated_at = ? 
            WHERE order_id = ? AND product = ? AND send_by = 'user' AND seen = false AND message_id <= ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', date('Y-m-d H:i:s'), $order_id, $product, $lastMessageId);
        $stmt->execute();

        // You can return a response if needed
        $success = $stmt->affected_rows > 0;

        // Close statement and connection
        $stmt->close();
        $conn->close();

        return $success;
    } else {
        // Handle the case where the insert fails
        $response = array('status' => 0, 'message' => 'Please login to continue chat');
        echo json_encode($response);
    }
}

function sendChatNotification($conn, $Common_Function, $order_id, $product, $user_id, $seller_id, $seller_unseen_message_count)
{
    if (stripslashes($_POST['code']) == $_SESSION['_token'] && $seller_id == $_SESSION['admin']) {
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $product = mysqli_real_escape_string($conn, $product);
        $user_id = mysqli_real_escape_string($conn, $user_id);
        $seller_id = mysqli_real_escape_string($conn, $seller_id);

        $sql = "SELECT * FROM appuser_login WHERE user_unique_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_data = $result->fetch_assoc();
        $stmt->close();

        // Load the email template
        ob_start();
        include('email_templates/message-notification.php');
        $emailTemplate = ob_get_clean();
        // $templatePath = 'email_templates/message-notification.php';
        // $emailTemplate = file_get_contents($templatePath);

        $emailTemplate = str_replace('{USER_NAME}',  $user_data['fullname'], $emailTemplate);
        $emailTemplate = str_replace('{ORDER_ID}',  $order_id, $emailTemplate);
        $emailTemplate = str_replace('{PRODUCT_ID}',  $product, $emailTemplate);
        $emailTemplate = str_replace('{UNSEEN_MESSAGE_COUNT}',  $seller_unseen_message_count, $emailTemplate);
        
        $subject = 'You have got ' . $seller_unseen_message_count . ' message';
        $Common_Function->smtp_email($conn, $user_data['email'], $subject, $emailTemplate);
        
        echo $emailTemplate;
        $conn->close();
    } else {
        // Handle the case where the insert fails
        $response = array('status' => 0, 'message' => 'Please login to continue chat');
        echo json_encode($response);
    }
}
