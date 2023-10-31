<?php

include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Brand)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}

$code = $_POST['code'];
$top_offer_id = $_POST['top_offer_id'];
$heading = $_POST['heading'];
$heading_ar = $_POST['heading_ar'];
$description = $_POST['description'];
$description_ar = $_POST['description_ar'];
$offer_page_title = $_POST['offer_page_title'];
$offer_page_title_ar = $_POST['offer_page_title_ar'];
$offer_page_link    = $_POST['offer_page_link'];


$error = '';  // Variable To Store Error Message
$code =   stripslashes($code);
$top_offer_id =   stripslashes($top_offer_id);
$heading =   stripslashes($heading);
$heading_ar =   stripslashes($heading_ar);
$description =   stripslashes($description);
$description_ar =   stripslashes($description_ar);
$offer_page_title =   stripslashes($offer_page_title);
$offer_page_title_ar =   stripslashes($offer_page_title_ar);
$offer_page_link =   stripslashes($offer_page_link);

$parent_cat = 0;
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token'] && isset($top_offer_id) && isset($heading) && isset($heading_ar) && isset($description) && isset($description_ar) && isset($offer_page_title) && isset($offer_page_title_ar) && isset($offer_page_link)) {
    //code for Check Brand Exist - START
    $sql = "UPDATE top_offers SET heading = '$heading', heading_ar = '$heading_ar', description = '$description', description_ar = '$description_ar', offer_page_title = '$offer_page_title', offer_page_title_ar = '$offer_page_title_ar', offer_page_link = '$offer_page_link' WHERE id = $top_offer_id";
    if ($conn->query($sql) === TRUE) {
        echo "Offer updated successfully. ";
    } else {
        echo "Error updating offer";
    }
} else {
    echo "Invalid values.";
}
die;
