<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = $this->lang->line('buy-from-turkey');
    include("include/headTag.php") ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/buy-from-turkey.css') ?>">
    <style>
        .shimmer-effect {
            color: grey;
            display: inline-block;
            /* adding gradients */
            -webkit-mask: linear-gradient(120deg, #000 25%, #0005, #000 75%) right/250% 100%;
            /* shimmer effect animation */
            animation: shimmer 2.5s infinite;
            background-repeat: no-repeat;
            /* width: 100px; */
        }

        @keyframes shimmer {
            100% {
                /* setting up mask position at left side */
                -webkit-mask-position: left
            }
        }
    </style>
</head>

<body>
    <input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
    <input type="hidden" id="qoute_id" value="<?php echo $this->session->userdata('qoute_id'); ?>">

    <?php include("include/loader.php") ?>
    <?php include("include/topbar.php") ?>
    <?php include("include/navbar.php") ?>


    <div class="modal fade" id="buyFromTurkey" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="buyFromTurkeyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="d-flex p-2 align-items-center justify-content-between border-bottom">
                    <h5 class="modal-title mt-1 px-2" id="buyFromTurkeyLabel"><?= $this->lang->line('add-product-description') ?></h5>
                    <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form class="form" id="buy-from-turkey-form">
                        <div class="form-group">
                            <label class="form-label" for="product-link" class="form-label"><?= $this->lang->line('product-link') ?></label>
                            <input class="form-control" type="text" name="product-link" id="modal-product-link" readonly value="">
                            <span id="error"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="product-qty" class="form-label"><?= $this->lang->line('quantity') ?></label>
                            <input class="form-control" type="number" name="product-qty" id="product-qty" value="">
                            <span id="error"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="product-size" class="form-label"><?= $this->lang->line('size') ?></label>
                            <input class="form-control" type="text" name="product-size" id="product-size" value="">
                            <span id="error"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="product-color" class="form-label"><?= $this->lang->line('colour') ?></label>
                            <input class="form-control" type="text" name="product-color" id="product-color" value="">
                            <span id="error"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="product-des" class="form-label"><?= $this->lang->line('description') ?></label>
                            <textarea class="form-control" name="product-des" id="product-des" rows="4"></textarea>
                            <span id="error"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="product-img-1" class="form-label"><?= $this->lang->line('add-item-screenshot-1') ?></label>
                            <input type="file" name="pan_card" id="product-img-1" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png" />
                            <span class="fw-bolder" id="screenshot-1-error"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="product-img-2" class="form-label"><?= $this->lang->line('add-item-screenshot-2') ?></label>
                            <input type="file" name="pan_card" id="product-img-2" class="dropify" data-height="100" data-max-file-size="1m" data-allowed-file-extensions="jpg png" />
                            <span class="fw-bolder" id="screenshot-2-error"></span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-lg btn-block btn-primary text-uppercase" id="buy-from-turkey-sumbit"><?= $this->lang->line('send-shopping-request') ?></button>
                        </div>
                    </form>
                </div>
                <div id="modal-loader" class="d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card box-shadow-4 mt-5 h-100">
                    <div class="card-body">
                        <h1 class="text-center"><?= $this->lang->line('buy-from-turkey') ?></h1>
                        <p class="d-flex text-center mx-10"><?= $this->lang->line('buy-from-turkey-description') ?></p>
                        <div class="row d-flex justify-content-center">
                            <div class="form mt-5 col-md-6" id="product-link-form">
                                <div class="form-group m-0 py-5">
                                    <label class="form-label" for="product-link"><?= $this->lang->line('copy-paste-search-box') ?></label>
                                    <input class="form-control" type="text" class="form-control mt-3 rounded" id="product-link" aria-describedby="ProductLink" placeholder="<?= $this->lang->line('product-link') ?>">
                                    <span id="error"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-lg btn-primary" id="shop-now-btn"><?= $this->lang->line('shop-now') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-5 my-lg-0">
                <div class="card box-shadow-4 mt-5 h-100" style="background:#f9cbad;">
                    <div class="card-body my-8 mx-10">
                        <h1><?= $this->lang->line('calculate-shipping-price') ?></h1>
                        <p><?= $this->lang->line('calculate-shipping-price-description') ?></p>
                        <div class="d-flex justify-content-center">
                            <a href="<?= base_url('shipping-price-calculator') ?>" type="submit" class="btn btn-lg btn-primary text-uppercase" id="shop-now-btn"><?= $this->lang->line('calculate') ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-10 px-0">
                <h5 class="fw-bold text-dark fs-4 mb-0 <?= $default_language == 1 ? 'pe-3' : 'ps-3' ?>"><?= $this->lang->line('famous-turkish-stores') ?></h5>
                <div class="row" id="turkish-brand-row">
                    <div style="height: 45vh;">
                        <div class="d-flex h-100 align-items-center justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("include/footer.php") ?>
    <?php include("include/script.php") ?>

    <script src="<?= base_url('assets_web/js/app/buy-from-turkey.js') ?>"></script>

</body>

</html>