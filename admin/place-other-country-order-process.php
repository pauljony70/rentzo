<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}

include("header.php");

// Sample email template
function replace_occurrences($mainString, $status, $replacement)
{
    $search = "#efefef";
    $pos = strpos($mainString, $search);
    $count = 0;
    while ($pos !== false && $status != 0) {
        $mainString = substr_replace($mainString, $replacement, $pos, strlen($search));
        $pos = strpos($mainString, $search, $pos + strlen($replacement));
        $status--;
        $count++;
    }
    return $mainString;
}

function replace_occurrences2($mainString, $status, $replacement)
{
    $search = "circle.png";
    $pos = strpos($mainString, $search);
    $count = 0;
    while ($pos !== false && $status != 0) {
        $mainString = substr_replace($mainString, $replacement, $pos, strlen($search));
        $pos = strpos($mainString, $search, $pos + strlen($replacement));
        $status--;
        $count++;
    }
    return $mainString;
}

$code = $_POST['code'];
$code = stripslashes($code);
$datetime = date('Y-m-d H:i:s');

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else {
    if ($code == $_SESSION['_token']) {
        $system_name = $Common_Function->get_system_settings($conn, 'system_name');
        $order_place_status = 0;
        $request_id = trim(strip_tags($_POST['request_id']));
        $order_id = trim(strip_tags($_POST['order_id']));
        $country = trim(strip_tags($_POST['country']));
        $product_link = trim(strip_tags($_POST['product_link']));
        $product_name = trim(strip_tags($_POST['product_name']));
        $product_quantity = trim(strip_tags($_POST['product_quantity']));
        $product_size = trim(strip_tags($_POST['product_size']));
        $product_color = trim(strip_tags($_POST['product_color']));
        $product_des = trim(strip_tags($_POST['product_des']));
        $fullname = trim($_POST['fullname']);
        $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        $total_price = trim(strip_tags($_POST['total_price']));
        $service_charge = trim(strip_tags($_POST['service_charge']));
        $shipping_charge = trim(strip_tags($_POST['shipping_charge']));
        $selecttaxclass = trim(strip_tags($_POST['selecttaxclass']));
        $remarks = trim(strip_tags($_POST['remarks']));

        $request_id = addslashes($request_id);
        $order_id = addslashes($order_id);
        $country = addslashes($country);
        $product_link = addslashes($product_link);
        $product_name = addslashes($product_name);
        $product_quantity = addslashes($product_quantity);
        $product_size = addslashes($product_size);
        $product_color = addslashes($product_color);
        $product_des = addslashes($product_des);
        $fullname = addslashes($fullname);
        $phone = addslashes($phone);
        $email = addslashes($email);
        $total_price = addslashes($total_price);
        $service_charge = addslashes($service_charge);
        $shipping_charge = addslashes($shipping_charge);
        $selecttaxclass = addslashes($selecttaxclass);
        $remarks = addslashes($remarks);
        $prod_weight = addslashes($prod_weight);

        if (isset($request_id)) {
            $conn->begin_transaction();
            $stmt15 = $conn->query("SELECT user_id, status, created_at FROM buy_from_another_country_requests WHERE id=" . $request_id);

            while ($rows_data = $stmt15->fetch_assoc()) {
                $user_id = $rows_data['user_id'];
                $order_date = $rows_data['created_at'];
                if ($rows_data['status'] == 'requested') {

                    $product_unique_id = 'P' . $Common_Function->random_strings(10);

                    $prod_img = '';
                    if ($_FILES['prod_img']['name']) {
                        $Common_Function->img_dimension_arr = $img_dimension_arr;
                        $prod_img1 = $Common_Function->file_upload('prod_img', $media_path);
                        $prod_img = $prod_img1['72-72'];
                    }

                    $prod_sku = $Common_Function->makeSKUbyname($_POST['prod_name']);

                    $status = 'pending'; // Set the status value here

                    $stmt11 = $conn->prepare("INSERT INTO `orders`(`order_id`, `user_id`, `status`, `total_price`, `fullname`, `mobile`, `email`, `total_qty`, `buy_from`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt11->bind_param(
                        "sssdsssis",
                        $order_id,
                        $user_id,
                        $status,
                        $total_price,
                        $fullname,
                        $phone,
                        $email,
                        $product_quantity,
                        $country
                    );

                    $stmt11->execute();
                    $stmt11->store_result();

                    $rows = $stmt11->affected_rows;

                    if ($rows > 0) {


                        $stml69 = $conn->prepare("INSERT INTO `order_product`( `order_id`, `prod_id`, `prod_sku`, `prod_name`, `prod_name_ar`, `prod_img`, `qty`, `prod_price`, `shipping`, `status`, `status_date`, `product_unique_code`, `admin_profit`, `igst`) VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

                        $stml69->bind_param(
                            "ssssssiddsssdd",
                            $order_id,
                            $product_unique_id,
                            $prod_sku,
                            $product_name,
                            $product_name,
                            $prod_img,
                            $product_quantity,
                            $total_price,
                            $shipping_charge,
                            $status,
                            $datetime,
                            $product_unique_id,
                            $service_charge,
                            round($total_price * $selecttaxclass / 100, 2)
                        );

                        $stml69->execute();
                        $stml69->store_result();

                        $order_product = $stml69->affected_rows;

                        if ($order_product > 0) {
                            $sql = "UPDATE `buy_from_another_country_requests` SET `order_id` = ?, `status` = ?, `remarks` = ? WHERE `id` = ?";
                            $status = 'processed';
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param(
                                "sssi",
                                $order_id,
                                $status,
                                $remarks,
                                $request_id
                            );
                            if ($stmt->execute()) {
                                if ($stmt->affected_rows > 0) {
                                    if (!empty($email)) {
                                        // Send Mail
                                        $subject = 'Order Processed';
                                        $seller_name = $fullname;
                                        $email = $email;
                                        $templatePath = 'email_template.html';
                                        $message = file_get_contents($templatePath);
                                        $message = str_replace('{BASE_URL}', BASEURL, $message);
                                        $message = str_replace('{ORDER_STATUS}', 'Order: Processed', $message);
                                        $message = str_replace('{USER_NAME}', $fullname, $message);
                                        $message = str_replace('{ORDER_MESSAGE}', 'We are delighted to inform you that your order has been successfully processed and is now on its way to being fulfilled.<br>Please ensure that you complete the payment at your earliest convenience to avoid any delays in the shipping of your order.', $message);
                                        $message = str_replace('{BUTTON_TEXT}', 'Proceed To Payment', $message);
                                        $message = str_replace('{BUTTON_LINK}', BASEURL . 'buy-from-turkey-checkout?order_id=' . $order_id, $message);
                                        $message = str_replace('{ORDER_ID}', $order_id, $message);
                                        $message = str_replace('{ORDER_DATE}', $order_date, $message);
                                        $message = str_replace('{SHIPPING_ADDRESS}', '', $message);
                                        $message = replace_occurrences($message, 4, "#f6e6cb");
                                        $message = replace_occurrences2($message, 2, "tick-circle.png");
                                        $message = str_replace('{FIRST_STATUS}', 'Ordered', $message);
                                        $message = str_replace('{FIRST_STATUS_VAL}', date('d M, Y', strtotime($order_date)), $message);
                                        $message = str_replace('{SECOND_STATUS}', 'Processed', $message);
                                        $message = str_replace('{SECOND_STATUS_VAL}', date('d M, Y', strtotime($datetime)), $message);
                                        $message = str_replace('{THIRD_STATUS}', 'Payment Received', $message);
                                        $message = str_replace('{THIRD_STATUS_VAL}', '<br>', $message);
                                        $message = str_replace('{FOURTH_STATUS}', 'Delivered', $message);
                                        $message = str_replace('{FOURTH_STATUS_VAL}', '<br>', $message);
                                        $product_details =
                                            '<tr>
                                                <td class="esdev-adapt-off" align="left"
                                                style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                                <table cellpadding="0" cellspacing="0" class="esdev-mso-table"
                                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px">
                                                    <tr>
                                                    <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr>
                                                            <td align="left" style="padding:0;Margin:0;width:125px">
                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tr>
                                                                <td align="center" style="padding:0;Margin:0;font-size:0px"><a target="_blank"
                                                                    href="' . BASEURL . '"
                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:12px"><img
                                                                        class="adapt-img p_image"
                                                                        src="' . MEDIAURL . $prod_img . '"
                                                                        alt="' . $product_name . '"
                                                                        style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                        width="125" title="' . $product_name . '" height="125"></a></td>
                                                                </tr>
                                                            </table>
                                                            </td>
                                                        </tr>
                                                        </table>
                                                    </td>
                                                    <td style="padding:0;Margin:0;width:20px"></td>
                                                    <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr>
                                                            <td align="left" style="padding:0;Margin:0;width:125px">
                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tr>
                                                                <td align="left" class="es-m-p0t es-m-p0b es-m-txt-l"
                                                                    style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px">
                                                                    <h3
                                                                    style="Margin:0;line-height:19px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;font-style:normal;font-weight:bold;color:#333333">
                                                                    <strong class="p_name">' . $product_name . '</strong>
                                                                    </h3>
                                                                </td>
                                                                </tr>
                                                            </table>
                                                            </td>
                                                        </tr>
                                                        </table>
                                                    </td>
                                                    <td style="padding:0;Margin:0;width:20px"></td>
                                                    <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tr>
                                                            <td align="left" style="padding:0;Margin:0;width:176px">
                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tr>
                                                                <td align="right" class="es-m-p0t es-m-p0b"
                                                                    style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px">
                                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px"
                                                                    class="p_description">x' . $product_quantity . '</p>
                                                                </td>
                                                                </tr>
                                                            </table>
                                                            </td>
                                                        </tr>
                                                        </table>
                                                    </td>
                                                    <td style="padding:0;Margin:0;width:20px"></td>
                                                    <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right"
                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                        <tr>
                                                            <td align="left" style="padding:0;Margin:0;width:74px">
                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
                                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tr>
                                                                <td align="right" class="es-m-p0t es-m-p0b"
                                                                    style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px">
                                                                    <p class="p_price"
                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:18px;color:#666666;font-size:12px">' . $Common_Function->price_format($total_price, $conn) . '</p>
                                                                </td>
                                                                </tr>
                                                            </table>
                                                            </td>
                                                        </tr>
                                                        </table>
                                                    </td>
                                                    </tr>
                                                </table>
                                                </td>
                                            </tr>';
                                        $message = str_replace('{PRODUCTS_DETAILS}', $product_details, $message);
                                        $message = str_replace('{ITEM_COUNT}', '1', $message);
                                        $message = str_replace('{SUB_TOTAL}', $Common_Function->price_format($total_price, $conn), $message);
                                        $message = str_replace('{PLATFORM_FEE}', $Common_Function->price_format($service_charge, $conn), $message);
                                        $message = str_replace('{SHIPPING}',  $Common_Function->price_format($shipping_charge, $conn), $message);
                                        $message = str_replace('{VAT}',  $Common_Function->price_format(round($total_price * $selecttaxclass / 100, 2), $conn), $message);
                                        $message = str_replace('{PAYABLE_AMOUNT}', $Common_Function->price_format(round($total_price + $service_charge + $shipping_charge + ($total_price * $selecttaxclass / 100), 2), $conn), $message);
                                        require 'default_send_mail.php';
                                        // End Send Mail
                                    } else if (!empty($phone)) {
                                        // Do Something
                                    }
                                    $conn->commit();
                                    $msg = "Order Placed successfully.";
                                } else {
                                    $conn->rollback();
                                    $msg = "failed to add. Please try again";
                                }
                            } else {
                                $conn->rollback();
                                $msg = "failed to add. Please try again";
                            }
                        } else {
                            $conn->rollback();
                            $msg = "failed to add. Please try again";
                        }
                    } else {
                        $conn->rollback();
                        $msg = "failed to add. Please try again";
                    }
                } else if ($status == 'rejected') {
                    $msg = "Rejected order can't be placed";
                } else if ($status == 'placed') {
                    $msg = "Placed order can't be placed again";
                }
            }
        } else {
            $msg = "Invalid Parameters. Please fill all required fields.";
        }
    } else {
        $msg = "Invalid Parameters. Please fill all required fields.";
    }
}

include("footernew.php");
echo '<script>
    successmsg1("' . $msg . '", "buy-from-turkey-orders.php");
</script> ';
die;
