<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $ProductAttributes)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}

$code = $_POST['code'];
$namevalue = $_POST['namevalue'];
$namevalue_ar = $_POST['namevalue_ar'];
$colour_code = $_POST['colour_code'];
$attribute_id = $_POST['attribute_id'];
$main_attribute_id = $_POST['main_attribute_id'];

$error = '';  // Variable To Store Error Message
$code =   stripslashes($code);
$attribute_id =   stripslashes($attribute_id);
$namevalue = stripslashes($namevalue);
$namevalue_ar = stripslashes($namevalue_ar);
$colour_code = stripslashes($colour_code) == '' ? null : stripslashes($colour_code);

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token']  && !empty($namevalue) && !empty($namevalue_ar) && !empty($attribute_id)) {
    //code for Check Brand Exist - START
    if (empty($colour_code)) {
        $stmt12 = $conn->prepare("SELECT count(id) FROM product_info_set_val where product_info_set_value ='" . $namevalue . "' and id !='" . $attribute_id . "'");
    } else {
        $stmt12 = $conn->prepare("SELECT count(id) FROM product_info_set_val where product_info_set_value ='" . $namevalue . "' and id !='" . $attribute_id . "' or colour_code = '" . $colour_code . "'");
    }

    $stmt12->execute();
    $stmt12->store_result();
    $stmt12->bind_result($col55);

    while ($stmt12->fetch()) {
        $totalrow = $col55;
    }

    //code for Check Brand Exist - END
    if ($totalrow == 0) {

        /* $stmt122 = $conn->prepare("SELECT product_info_set_value FROM product_info_set_val where id ='" . $attribute_id . "'");

        $stmt122->execute();
        $stmt122->store_result();
        $stmt122->bind_result($attribute_value);

        while ($stmt122->fetch()) {
            $attribute_value1 = $attribute_value;
        } */

        $stmt11 = $conn->prepare("UPDATE product_info_set_val SET product_info_set_value =?, product_info_set_value_ar =?, colour_code =?  WHERE id ='" . $attribute_id . "'");
        $stmt11->bind_param("sss",  $namevalue, $namevalue_ar, $colour_code);


        //code for insert record - START

        $stmt11->execute();
        $stmt11->store_result();



        //code for select product attr - START
        /* $stmt122 = $conn->prepare("SELECT id, attr_value FROM product_attribute where prod_attr_id ='" . $main_attribute_id . "'
							AND attr_value like '%\"" . $attribute_value1 . "\"%'");

        $stmt122->execute();
        $stmt122->store_result();
        $stmt122->bind_result($attr_id,  $attr_value);

        $attr_value1 = $attr_value_final = array();
        while ($stmt122->fetch()) {
            $attr_value1['attr_id'] = $attr_id;
            $attr_value1['attr_value'] = $attr_value;
            $attr_value_final[] = $attr_value1;
        }

        foreach ($attr_value_final as $attr_val) {
            $new_val  = str_replace($attribute_value1, $namevalue, $attr_val['attr_value']);

            $stmt111 = $conn->prepare("UPDATE product_attribute SET attr_value =?  WHERE id ='" . $attr_val['attr_id'] . "'");
            $stmt111->bind_param("s",  $new_val);

            $stmt111->execute();
            $stmt111->store_result();
        } */

        //code for select product attr - END


        echo "Attribute Updated Successfully. ";


        //code for insert record - END
    } else {
        echo "Attribute already exist. ";
    }
} else {
    echo "Invalid values.";
}
die;
