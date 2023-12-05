<?php

include('session.php');

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // Alternatively, you can echo an error message or handle it in another way
    exit();
}

// Check if the provided code matches the session token
$code = isset($_POST['code_ajax']) ? $_POST['code_ajax'] : '';
if ($code != $_SESSION['_token']) {
    // Handle the case where the codes do not match
    echo "Invalid token!";
    exit();
}

// Retrieve form values
$topbar_notification_title = isset($_POST['topbar_notification_title']) ? $_POST['topbar_notification_title'] : '';
$topbar_notification_link = !empty($_POST['topbar_notification_link']) ? $_POST['topbar_notification_link'] : '#';

// Check if data already exists
$query = "SELECT * FROM homepage_banner WHERE type='top_notification' AND section='top_notification'";
$result = $conn->query($query);

if ($row = $result->fetch_assoc()) {
    // Update existing data using prepared statement
    $update_query = "UPDATE homepage_banner SET image=?, link=?, type='top_notification', section='top_notification', cat_id=0 WHERE type='top_notification' AND section='top_notification'";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ss", $topbar_notification_title, $topbar_notification_link);
    $stmt->execute();
    $stmt->close();
} else {
    // Insert new data using prepared statement
    $insert_query = "INSERT INTO homepage_banner (type, image, link, section, cat_id) VALUES ('top_notification', ?, ?, 'top_notification', 0)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ss", $topbar_notification_title, $topbar_notification_link);
    $stmt->execute();
    $stmt->close();
}

// Close database connection
$conn->close();

echo "Form submitted successfully!";
?>