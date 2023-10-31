<?php
include('session.php');

$code = $_POST['code'];
$transaction_id = $_POST['transaction_id'];
$wallet_transaction_id = $_POST['wallet_transaction_id'];
$payment_id = $_POST['payment_id'];
$user_id = $_POST['user_id'];

$error = '';
$code = stripslashes($code);
$transaction_id = stripslashes($transaction_id);
$wallet_transaction_id = stripslashes($wallet_transaction_id);
$payment_id = stripslashes($payment_id);

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit(); // Terminate script after redirection
}

if ($code == $_SESSION['_token'] && isset($transaction_id) && !empty($transaction_id)) {

    // Start a database transaction
    $conn->begin_transaction();

    try {
        $invoice_proof = '';
        if ($_FILES['invoice_proof']['name']) {
            $Common_Function->img_dimension_arr = $img_dimension_arr;
            $invoice_proof1 = $Common_Function->file_upload('invoice_proof', $media_path);
            $invoice_proof = json_encode($invoice_proof1);
        }

        $datetime = date('Y-m-d H:i:s');
        $orderid = 0;
        $status = 1;

        // Use prepared statement to prevent SQL injection
        $stmt11 = $conn->prepare("UPDATE wallet_withdraw SET transaction_id=?, invoice_proof=?, payment_status=?, updated_at=? WHERE id = ?");
        $stmt11->bind_param("ssiss", $transaction_id, $invoice_proof, $status, $datetime, $payment_id);

        if ($stmt11->execute()) {

            // Run the second query
            $stmt12 = $conn->prepare("UPDATE `wallet_transaction_history` SET `status` = ? WHERE `transaction_id` = ?");
            $stmt12->bind_param("is", $status, $wallet_transaction_id);

            if ($stmt12->execute()) {

                // Commit the transaction if both queries succeed
                $conn->commit();

                echo "Payment status and wallet transaction history updated Successfully.";
            } else {
                // Rollback the transaction if the second query fails
                $conn->rollback();

                echo "Failed to update wallet transaction history.";
            }
        } else {
            // Rollback the transaction if the first query fails
            $conn->rollback();

            echo "Failed to update payment";
        }
    } catch (Exception $e) {
        // Rollback the transaction on any exception
        $conn->rollback();

        echo "An error occurred: " . $e->getMessage();
    }
} else {
    echo "Invalid values.";
}

// Close the database connection
$conn->close();
?>
