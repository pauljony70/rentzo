<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}

$code = $_POST['code'];
$code = stripslashes($code);
$datetime = date('Y-m-d H:i:s');

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else {
    if ($code == $_SESSION['_token']) {
        if (isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['product_ids'])) {
            $start_date = trim(strip_tags($_POST['start_date']));
            $end_date = trim(strip_tags($_POST['end_date']));
            $product_ids = explode(",", trim(strip_tags($_POST['product_ids'])));;
            
            $start_date          =   addslashes($start_date);
            $end_date            =   addslashes($end_date);
            
            if (isset($product_ids)) {
                $conn->begin_transaction();
                foreach ($product_ids as $product_id) {
                    $stmt11 = $conn->prepare("UPDATE vendor_product SET offer_start_date =?, offer_end_date =?  WHERE product_id ='" . $product_id . "'");
                    $stmt11->bind_param("ss",  $start_date, $end_date);
                    $stmt11->execute();
                    $stmt11->store_result();
                }
                $conn->commit();
                $status = 1;
                $msg = "Offer added succesfully.";
            } else {
                $conn->rollback();
                $status = 0;
                $msg = "Invalid Parameters. Please fill all required fields.";
            }
        } else if (!isset($_POST['start_date']) && !isset($_POST['end_date']) && isset($_POST['product_ids'])) {
            $product_ids = explode(",", trim(strip_tags($_POST['product_ids'])));;
            foreach ($product_ids as $product_id) {
                $stmt11 = $conn->prepare("UPDATE vendor_product SET offer_start_date = NULL, offer_end_date = NULL WHERE product_id = ?");
                $stmt11->bind_param("s", $product_id);
                $stmt11->execute();
                $stmt11->store_result();
            }
            $status = 1;
            $msg = "Offer deleted succesfully.";
        } else {
            $status = 0;
            $msg = "Invalid Parameters. Please fill all required fields.";
        }
    } else {
        $conn->rollback();
        $status = 0;
        $msg = "Invalid Parameters. Please fill all required fields.";
    }
}

echo json_encode(array("status" => $status, "message" => $msg));
die;
