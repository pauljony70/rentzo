<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $Brand)) {
    echo "<script>location.href='no-premission.php'</script>";
    die();
}

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}

?>
<?php include("header.php"); ?>
<link href="assets/css/custom-style.css" rel="stylesheet">
<style>
    .toggle-btn {
        background-color: #fff;
        border: none;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        padding: 10px;
        position: relative;
        transition: background-color 0.2s ease-in-out;
    }

    .toggle-btn:hover {
        background-color: #fff;
    }

    .fa-info {
        color: #ccc;
        font-size: 10px;
        border: 1px solid #ccc;
        border-radius: 50%;
        padding: 2px 5px;
    }

    .info-icon {
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        color: #000000;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        height: 20px;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        cursor: pointer;
        position: relative;
    }

    .hover-card {
        background-color: #000;
        border: 1px solid #000;
        border-radius: 5px;
        color: #fff;
        display: none;
        font-size: 12px;
        padding: 10px;
        position: absolute;
        bottom: calc(100% + 10px);
        left: 50%;
        transform: translateX(-50%);
        width: 200px;
        z-index: 1;
    }

    .arrow {
        position: absolute;
        bottom: -10px;
        left: calc(50% - 10px);
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid #000;
    }

    .info-icon:hover .hover-card {
        display: block;
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
                        <h4 class="page-title">Home Notofications</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <section id="topbar-offer" class="">
                                <div class="container">
                                    <div class="row">
                                        <?php
                                        //sql for top offer
                                        $result = $conn->query("SELECT * FROM `top_offers` LIMIT 3");
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <div class="col-lg-4">
                                                <div class="card">
                                                    <div class="card-header bg-light">
                                                        <i class="fa-regular fa-pen-to-square float-right" id="top-offer-edit-btn" style="cursor: pointer;"></i>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form" id="form_<?= $row['id'] ?>">
                                                            <input type="hidden" name="offer_id" id="offer_id" value="<?= $row['id'] ?>">
                                                            <div class="form-group">
                                                                <label for="heading" class="form-label">Heading (ENG) <span class="text-danger">&#42;</span></label>
                                                                <input type="text" class="form-control" name="heading" id="heading" value="<?= $row['heading'] ?>" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="heading_ar" class="form-label">Heading (Arabic) <span class="text-danger">&#42;</span></label>
                                                                <input type="text" class="form-control" name="heading_ar" id="heading_ar" value="<?= $row['heading_ar'] ?>" dir="rtl" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description" class="form-label">Description (ENG) <span class="text-danger">&#42;</span></label>
                                                                <textarea class="form-control" name="description" id="description" rows="3" disabled><?= $row['description'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description_ar" class="form-label">Description (Arabic) <span class="text-danger">&#42;</span></label>
                                                                <textarea class="form-control" name="description_ar" id="description_ar" rows="3" dir="rtl" disabled><?= $row['description_ar'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="offer_page_title" class="form-label">Link Title (ENG) <span class="text-danger">&#42;</span></label>
                                                                <input type="text" class="form-control" name="offer_page_title" id="offer_page_title" value="<?= $row['offer_page_title'] ?>" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="offer_page_title_ar" class="form-label">Link Title (Arabic) <span class="text-danger">&#42;</span></label>
                                                                <input type="text" class="form-control" name="offer_page_title_ar" id="offer_page_title_ar" value="<?= $row['offer_page_title_ar'] ?>" dir="rtl" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="offer_page_link" class="form-label">Link <span class="text-danger">&#42;</span></label>
                                                                <input type="text" class="form-control" name="offer_page_link" id="offer_page_link" value="<?= $row['offer_page_link'] ?>" disabled>
                                                            </div>
                                                            <div class="text-right">
                                                                <button type="button" class="btn btn-dark waves-effect waves-light" disabled onclick="updateTopOffer('form_<?= $row['id'] ?>'); return false;">UPDATE</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<?php include("footernew.php"); ?>
<script src="js/admin/home-notifications.js"></script>