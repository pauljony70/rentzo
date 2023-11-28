<?php
// chat.php

// Establish a database connection
$servername = "localhost";
$username = "mydatabase";
$password = "AtX66WHjncxb8RDc";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
 
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch messages
function getMessages($senderId, $receiverId) {
    global $conn;
    $sql = "SELECT * FROM messages WHERE (sender_id = $senderId AND receiver_id = $receiverId) OR (sender_id = $receiverId AND receiver_id = $senderId) ORDER BY timestamp ASC";
    $result = $conn->query($sql);
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    return $messages;
}

// Function to send a message
function sendMessage($senderId, $receiverId, $message) {
    global $conn;
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ($senderId, $receiverId, '$message')";
    $conn->query($sql);
}

// Check if the request is AJAX
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'getMessages':
            $senderId = $_POST['senderId'];
            $receiverId = $_POST['receiverId'];
            $messages = getMessages($senderId, $receiverId);
            echo json_encode($messages);
            break;

        case 'sendMessage':
            $senderId = $_POST['senderId'];
            $receiverId = $_POST['receiverId'];
            $message = $_POST['message'];
            sendMessage($senderId, $receiverId, $message);
            break;

        default:
            break;
    }
}

// Close the database connection
$conn->close();
?>
