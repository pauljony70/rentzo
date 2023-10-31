<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}

$code = $_POST['code'];
$name = $_POST['namevalue'];
$name_ar = $_POST['namevalue_ar'];
$colour_code = $_POST['colour_code'];
$main_attribute_id = $_POST['main_attribute_id'];


$error       = '';  // Variable To Store Error Message
$code        =   stripslashes($code);
$name        =   stripslashes($name);
$name_ar     =   stripslashes($name_ar);
$colour_code =   stripslashes($colour_code) === '' ? null : stripslashes($colour_code);


if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token'] && isset($name)   && !empty($name)) {
    //code for Check Brand Exist - START
    $stmt12 = $conn->prepare("SELECT count(id) FROM product_info_set_val where product_info_set_value ='" . $name . "' and product_info_set_id  ='" . $main_attribute_id . "'");

    $stmt12->execute();
    $stmt12->store_result();
    $stmt12->bind_result($col55);

    while ($stmt12->fetch()) {
        $totalrow = $col55;
    }

    //code for Check Brand Exist - END
    if ($totalrow > 0) {
        echo "Attribute  Already Exist. ";
    } else {


        //code for insert record - START
        $orderid = 0;
        $stmt11 = $conn->prepare("INSERT INTO product_info_set_val (product_info_set_id, product_info_set_value, product_info_set_value_ar, colour_code)  VALUES (?,?,?,?)");
        $stmt11->bind_param("isss", $main_attribute_id, $name, $name_ar, $colour_code);

        $stmt11->execute();
        $stmt11->store_result();
        // echo " insert done ";
        $rows = $stmt11->affected_rows;
        if ($rows > 0) {
            echo "Attribute Added Successfully. ";
        } else {
            echo "Failed to add Attribute";
        }
        //code for insert record - END
    }
} else {
    echo "Invalid values.";
}
die;
