<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Brand)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}
$code = $_POST['code'];
$order_id  = $_POST['order_id'];
$name  = $_POST['name'];
$phone  = $_POST['phone'];
$email  = $_POST['email'];
$message  = $_POST['message'];

$code = stripslashes($code);
$order_id =  stripslashes($order_id);
$phone =  stripslashes($phone);
$email =  stripslashes($email);

$error = '';  // Variable To Store Error Message

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");;
} else if ($code == $_SESSION['_token']) {
    try {
        $inactive = "active";
        $stmt = $conn->prepare("SELECT user_id, status FROM buy_from_another_country_requests WHERE id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $stmt->store_result();
        $row_count = $stmt->num_rows;
        $stmt->bind_result($user_id, $status);
        $stmt->fetch();
        $stmt->close();
        if (!empty($status)) {
            if ($status == 'requested') {
                $stmt = $conn->prepare("UPDATE buy_from_another_country_requests SET status = 'rejected' WHERE id = ?");
                $stmt->bind_param("i", $order_id);
                $stmt->execute();
                $row_count = $stmt->affected_rows;
                $stmt->close();
                if ($row_count == 1) {
                    if ($phone) {
                        //Do Something
                    }
                    if ($email) {
                        $Common_Function->default_send_email($conn, $email, $name, 'Order Rejected', $message);
                    }
                    echo json_encode(array("status" => 1, "message" => 'Order has been rejected succesfully'));
                } else {
                    echo json_encode(array("status" => 0, "message" => 'Failed to reject order'));
                }
            } else {
                echo json_encode(array("status" => 0, "message" => 'This order cannot be rejected.'));
            }
        } else {
            echo json_encode(array("status" => 0, "message" => 'Failed to reject order'));
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
