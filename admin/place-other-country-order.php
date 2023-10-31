<?php
include('session.php');


if (!$Common_Function->user_module_premission($_SESSION, $Product)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}

if (!isset($_GET['id'])) {
    header("Location: buy-from-turkey-orders.php");
}

$record_exist = 'N';


$str_result = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz';
$id = trim($_GET['id']);
$stmt15 = $conn->prepare("SELECT buy_from_another_country_requests.id, order_id, user_id, fullname, phone, email, product_link, product_quantity, product_size, product_color, product_des, product_img_1, product_img_2, buy_from_another_country_requests.country, buy_from_another_country_requests.status, remarks, created_at FROM buy_from_another_country_requests, appuser_login WHERE buy_from_another_country_requests.user_id = appuser_login.user_unique_id AND buy_from_another_country_requests.id=" . $id);

$stmt15->execute();
$data = $stmt15->bind_result(
    $id,
    $order_id,
    $user_id,
    $fullname,
    $phone,
    $email,
    $product_link,
    $product_quantity,
    $product_size,
    $product_color,
    $product_des,
    $product_img_1,
    $product_img_2,
    $country,
    $status,
    $remarks,
    $created_at
);


while ($stmt15->fetch()) {
    $record_exist = 'Y';
}


if ($record_exist == 'N' ||  $status !== 'requested') {
    header("Location: buy-from-turkey-orders.php");
}

//include header
include("header.php");
?>
<style>
    .bank-statement-panel {
        border: 1px solid #ced4da;
        border-radius: 5px;
        color: rgba(0, 0, 0, 1);
        margin-bottom: 0px !important;
    }

    .bank-statement-panel h6 {
        padding: 8px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    .bank-statement-panel td {
        font-size: 14px;
    }

    .bank-statement-panel tr td:nth-child(2) {
        text-align: right;
    }

    td {
        border: none;
        padding: 8px;
        text-align: left;
    }

    .dotted-border {
        border-top: 1px dashed #333;
    }

    #total-bank-settlement {
        font-size: 12px;
        font-weight: 600;
    }

    #customer-price-breakdown {
        border-radius: 0.5em;
        margin-bottom: 5px;
    }

    #customer-price-breakdown .panel-body {
        padding: 8px;
        margin-bottom: 0px;
    }
</style>
<!-- main content start-->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Product</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="bs-example widget-shadow" data-example-id="hoverable-table">
                                <div class="row align-items-center">
                                    <div class="col-md-6 mb-2">
                                        <button id="back_btn" type="submit" class="btn btn-dark waves-effect waves-light" onclick="back_page('buy-from-turkey-orders.php');"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                </div>
                                <div class="form-three widget-shadow">
                                    <form class="form-horizontal" id="myform" action="place-other-country-order-process.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="code" value="<?= $code_ajax; ?>" />
                                        <input type="hidden" name="request_id" value="<?= $id; ?>" />
                                        <input type="hidden" name="order_id" value="<?= $order_id; ?>" />
                                        <a> <span class="text-danger">&#42;&#42;</span> required field</a>

                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Buy From <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="country" name="country" value="<?= $country ?>" placeholder="Country" required readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Product Link <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="product_link" name="product_link" value="<?= $product_link; ?>" placeholder="Product Link" data-parsley-required-message="Product link is required." required readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Product Name <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="product_name" name="product_name" value="" placeholder="Product Name" data-parsley-required-message="Product name is required." required>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Product Quantity <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="product_quantity" name="product_quantity" value="<?= $product_quantity; ?>" placeholder="Product Quantity" data-parsley-required-message="Product quantity is required." required readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Product Size <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="product_size" name="product_size" value="<?= $product_size; ?>" placeholder="Product Size" data-parsley-required-message="Product size is required." required readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Product Colour <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="product_color" name="product_color" value="<?= $product_color; ?>" placeholder="Product Colour" data-parsley-required-message="Product colour is required." required readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Product Description <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="product_des" id="product_des" rows="5" placeholder="Product Description" readonly><?= $product_des ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Product Screenshots <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <div class="d-flex flex-wrap mt-1">
                                                    <div class="mr-1 mb-2">
                                                        <div class="d-flex flex-column" style="width: fit-content;">
                                                            <div class="image-container">
                                                                <img style="display: block; height: 75px; width: auto;" src="<?= MEDIAURL . $product_img_1 ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mr-1 mb-2">
                                                        <div class="d-flex flex-column" style="width: fit-content;">
                                                            <div class="image-container">
                                                                <img style="display: block; height: 75px; width: auto;" src="<?= MEDIAURL . $product_img_2 ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Product Image <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="file" name="prod_img" id="prod_img" class="form-control-file" data-parsley-required-message="Product image is required." required>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Customer Name <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $fullname; ?>" placeholder="Customer Name" data-parsley-required-message="Customer name is required." required readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Customer Phone </span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="phone" name="phone" value="<?= $phone; ?>" placeholder="Customer Phone">
                                                <div id="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Customer Email </span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="email" name="email" value="<?= $email; ?>" placeholder="Customer Email">
                                                <div id="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Total Price <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" value="" placeholder="Total Price" data-parsley-required-message="Total Price is required." required>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Service Charge <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="number" step="0.01" class="form-control" id="service_charge" name="service_charge" value="" placeholder="Service Charge" data-parsley-required-message="Service Charge is required." required>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Shipping Charge <span class="text-danger ml-2">&#42;&#42;</span></label>
                                            <div class="col-sm-8">
                                                <input type="number" step="0.01" class="form-control" id="shipping_charge" name="shipping_charge" value="" placeholder="Shipping Charge" data-parsley-required-message="Shipping Charge is required." required>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-2 control-label m-0">VAT </label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="selecttaxclass" name="selecttaxclass" data-parsley-required-message="VAT is required." required>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0"></label>
                                            <div class="col-sm-8">
                                                <div class="panel panel-default bank-statement-panel">
                                                    <div class="panel-body">
                                                        <h6><strong>Payable Amount Breakdown</strong></h6>
                                                        <table id="payable_amount_breakdown" style="border: none;">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Product Price</td>
                                                                    <td id="product_price"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Platform fee</td>
                                                                    <td id="commision_fee"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Shipping fee</td>
                                                                    <td id="shipping_fee"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="toggle-tabl" style="cursor: pointer;">
                                                                        VAT
                                                                    </td>
                                                                    <td id="total-tax"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="dotted-border"></div>
                                                        <table style="border: none;">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Payable Amount</td>
                                                                    <td id="total-payable-amount"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="text-muted px-1 pb-2" style="font-size: 10px;">
                                                            Bank settlement amount may vary slightly based on the quantity in the order, EBuy commission policy at the time of the order and the actual weight of the product as calculated by our third party delivery partner.
                                                            <br>
                                                            Customer price on app may vary based on the shipping address and the actual weight of the product as calculated by our third party delivery partner.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="focusedinput" class="col-sm-2 control-label m-0">Remarks </label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="remarks" id="remarks" rows="5" placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                        </br></br>
                                        <div class="col-sm-offset-2">
                                            <button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="place_order_btn">Place Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>
</div>
<div class="col_1">
    <div class="clearfix"> </div>
</div>
<?php include("footernew.php"); ?>
<script src="js/admin/place-other-country-order.js"></script>