<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "My Wallet";
    include("include/headTag.php") ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/shipping-price-calculator.css') ?>">

    <style>
        .money_cards {
            width: 30px;
            height: 30px;
        }

        .money-btn {
            background-color: #FFFFFF;
            outline: none;
            border: 1px solid #ccc;
            color: #FF6600 !important;
            font-weight: 500 !important;
            transition: border 0.5s ease;
        }

        .money-btn:hover {
            border: 1px solid #FF6600;
        }

        .rounded-pill {
            width: 109px;
            margin-bottom: 10px;
        }

        .rounded-pill:nth-child(odd) {
            margin-right: 2px;
        }

        .user-wallet-headings {
            font-size: 20px;
        }

        .empty-cart-img {
            display: flex;
            height: 350px;
            margin: auto;
        }
    </style>

</head>

<body>
    <?php include("include/loader.php") ?>
    <?php include("include/topbar.php") ?>
    <?php include("include/navbar.php") ?>

    <main>
        <section class="container px-1">
            <div class="row">
                <div class="col-lg-6 p-2">
                    <div class="box-shadow-4 h-100 mt-3 rounded">
                        <div class="balance_box p-3 my-3 col-sm-12">
                            <div class="card box-shadow-4">
                                <div class="card-body">
                                    <div class="row p-0">
                                        <div class="col-6 p-0 <?php if ($default_language == 1) echo "text-end";
                                                                else echo ""; ?>">
                                            <h4 class="card-title user-wallet-headings"><?= $this->lang->line('wallet-balance') ?></h4>
                                        </div>
                                        <div class="col-6 p-0 <?= $default_language == 1 ? "text-start" : "text-end" ?>">
                                            <a class="btn money-btn px-3 py-1" href="<?= base_url ?>withdraw-money">
                                                <div class="d-flex justify-content-center align-items-center h-100">
                                                    <i class="fa-solid fa-circle-minus"></i>
                                                    <div class="mx-2 fw-bolder text-uppercase" style="margin-top: 0.15rem;"><?= $this->lang->line('wallet-withdraw-money') ?></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <h3 class="card-title mb-2 fw-bolder"><?= price_format($wallet['amount']) ?></h3>
                                    <p class="card-text"><?= $this->lang->line('wallet-desc') ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="add_money_box my-4 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title user-wallet-headings"><?= $this->lang->line('wallet-withdraw-money') ?></h4>
                                    <form action="">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('wallet-enter-money') ?></label>
                                            <input type="number" class="form-control" placeholder="50 OMR" id="moneyinputBox" step="0.01">
                                            <div id="error"></div>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <div class="">
                                                <button class="btn border rounded-pill" type="button" onclick="addMoneyToWalletField('5')">
                                                    <span class="fw-bolder" id="500">+5 OMR</span>
                                                </button>
                                            </div>
                                            <div class="">
                                                <button class="btn border rounded-pill" type="button" onclick="addMoneyToWalletField('10')">
                                                    <span class="fw-bolder" id="1000">+10 OMR</span>
                                                </button>
                                            </div>
                                            <div class="">
                                                <button class="btn border rounded-pill" type="button" onclick="addMoneyToWalletField('20')">
                                                    <span class="fw-bolder" id="2000">+20 OMR</span>
                                                </button>
                                            </div>
                                            <div class="">
                                                <button class="btn border rounded-pill" type="button" onclick="addMoneyToWalletField('50')">
                                                    <span class="fw-bolder" id="2000">+50 OMR</span>
                                                </button>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-lg text-uppercase w-100 my-5" id="add-money-btn">
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <?= $this->lang->line('wallet-transfer-money') ?>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-2">
                    <div class="mt-3 rounded box-shadow-4 h-100" id="right_bo">
                        <?php if (!empty($wallet_summery)) { ?>
                            <div class="card" id="">
                                <div class="card-body">
                                    <h4 class="user-wallet-headings"><?= $this->lang->line('wallet-previous-trans') ?></h4>
                                    <?php foreach ($wallet_summery as $wallet_summery_data) {
                                        if ($wallet_summery_data->transaction_type == 'cr') {
                                            $transaction_type = '+';
                                            $transaction_class = 'text-success';
                                            $transaction_img = '5';
                                        } else {
                                            $transaction_type = '-';
                                            $transaction_class = 'text-danger';
                                            $transaction_img = '6';
                                        }
                                        if ($wallet_summery_data->status != 1) {
                                            $transaction_class = 'text-warning';
                                        }
                                    ?>
                                        <div class="row d-flex">
                                            <div class="col-2">
                                                <img src="<?php echo base_url; ?>assets_web/images/<?= $transaction_img ?>.png" class="money_cards">
                                            </div>
                                            <div class="col-7 p-0">
                                                <span class="fw-bolder">
                                                    <?= $wallet_summery_data->remark ?>
                                                    <?= $wallet_summery_data->status != 1 ? '<span class="text-warning">(Pending)</span>' : '' ?>
                                                </span>
                                                <p class="text-muted"><?php echo date('d M Y h:i A', strtotime($wallet_summery_data->created_at)); ?></p>
                                            </div>
                                            <div class="col-3 <?= $default_language == 1 ? 'text-start' : 'text-end' ?>">
                                                <span class="fw-bolder <?php echo $transaction_class; ?>"><?php echo $transaction_type . ' ' . price_format($wallet_summery_data->amount); ?></span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="d-flex justify-content-end mx-3 mb-2">
                                        <a href="<?php echo base_url ?>user-wallet-transactions" class="nav-link" style="color:#ff6600;"><?= $this->lang->line('see-all') ?> <i class="fa-solid fa-arrow-right" style="color: #ff6600;"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="card">
                                <div class="card-body px-0">
                                    <img src="<?php echo base_url; ?>assets_web/images/no_transaction.jpg" alt="" class="empty-cart-img" />
                                    <h5 class="text-center"><?= $this->lang->line('wallet-no-trans'); ?></h5>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include("include/footer.php") ?>
    <?php include("include/script.php") ?>

    <script>
        const sel = document.getElementById('moneyinputBox');

        function addMoneyToWalletField(amount) {
            let curr_val = sel.value
            if (curr_val == "") {
                sel.value = amount;
            } else {
                let t_money = parseInt(curr_val) + parseInt(amount);
                sel.value = t_money;
            }
        }

        document.querySelector('#add-money-btn').addEventListener('click', (event) => {
            buttonLoader(document.querySelector('#add-money-btn').querySelector('.d-flex'));
            document.querySelector('#add-money-btn').disabled = true;
            if (sel.value > 0) {
                $.ajax({
                    method: "post",
                    url: site_url + "add-money",
                    data: {
                        language: default_language,
                        amount: sel.value,
                        [csrfName]: csrfHash,
                    },
                    success: function(response) {
                        document.querySelector('#add-money-btn').querySelector('.d-flex').innerHTML = '<?= $this->lang->line('wallet-transfer-money') ?>';
                        document.querySelector('#add-money-btn').disabled = false;
                        if (response.status) {
                            Swal.fire({
                                title: 'SUCCESS',
                                text: response.msg,
                                type: "success",
                                confirmButtonColor: '#ff6600',
                                showCloseButton: true
                            }).then((res) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'FAILED',
                                text: response.msg,
                                type: "error",
                                confirmButtonColor: '#ff6600',
                                showCloseButton: true
                            }).then((res) => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error("Error:", errorThrown);
                        document.querySelector('#add-money-btn').querySelector('.d-flex').innerHTML = '<?= $this->lang->line('wallet-transfer-money') ?>';
                        document.querySelector('#add-money-btn').disabled = false;
                    }
                });
            } else {
                document.querySelector('#add-money-btn').querySelector('.d-flex').innerHTML = '<?= $this->lang->line('wallet-transfer-money') ?>';
                document.querySelector('#add-money-btn').disabled = false;
                setErrorMsg(sel, '<i class="fa-solid fa-circle-xmark"></i> Enter a valid amount.');
            }
        })
    </script>

</body>

</html>