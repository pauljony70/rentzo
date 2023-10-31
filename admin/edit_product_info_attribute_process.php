<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}

$code = $_POST['code'];
$namevalue = $_POST['namevalue'];
$namevalue_ar = $_POST['namevalue_ar'];
$attribute_id = $_POST['attribute_id'];
$statuss = $_POST['statuss'];

$error = '';  // Variable To Store Error Message
$code =   stripslashes($code);
$namevalue =   stripslashes($namevalue);
$namevalue_ar =   stripslashes($namevalue_ar);
$attribute_id =   stripslashes($attribute_id);

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token']  && !empty($namevalue) && !empty($attribute_id) && !empty($statuss)) {
    //code for Check Brand Exist - START
    $stmt12 = $conn->prepare("SELECT count(id) FROM product_info_set where attribute ='" . $namevalue . "'  AND id !='" . $attribute_id . "' ");

    $stmt12->execute();
    $stmt12->store_result();
    $stmt12->bind_result($col55);

    while ($stmt12->fetch()) {
        $totalrow = $col55;
    }

    //code for Check Brand Exist - END
    if ($totalrow == 0) {

        $stmt11 = $conn->prepare("UPDATE product_info_set SET attribute =?, attribute_ar =?, status =?  WHERE id ='" . $attribute_id . "'");
        $stmt11->bind_param("ssi",  $namevalue, $namevalue_ar, $statuss);


        //code for insert record - START


        $orderid = 0;

        $stmt11->execute();
        $stmt11->store_result();

        echo "Attribute Updated Successfully. ";


        //code for insert record - END
    } else {
        echo "Attribute already exist. ";
    }
} else {
    echo "Invalid values.";
}
die;
