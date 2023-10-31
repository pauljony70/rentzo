<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Bank Details";
    include("include/headTag.php") ?>
    <style>
        .edit-bank-details{
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php include("include/topbar.php") ?>
    <?php include("include/navbar.php") ?>

    <main class="personal-info new-address my-order-page cart-page">
        <section>
            <div class="container px-1" style="max-width:1344px;">
                <div class="row mt-4">
                    <?php
                    include("include/sidebar.php");
                    ?>
                    <div class="col-lg-8 mt-1 pb-1">
                        <div class="left-block box-shadow-4" id="MyProfile">
                            <h5 class="title"><?= $this->lang->line('bank-details') ?><span class="d-lg-none"><a class="accordion-button collapsed" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">My Profile</a></span></h5>

                            <div class="px-0">
                                <?php include("include/mobile_sidebar.php"); ?>
                            </div>

                            <?php if (!empty($bank_details)) : ?>
                                <div class="box-shadow-4 rounded-1">
                                    <div class="p-2">
                                        <div id="user-bank-details" data-account-holder-name="<?= $bank_details['account_holder_name'] ?>" data-account-number="<?= $bank_details['account_number'] ?>" data-bank-name="<?= $bank_details['bank_name'] ?>" data-bank-address="<?= $bank_details['bank_address'] ?>"></div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <label class="fw-bolder"><?= $this->lang->line('account-holder-name') ?> : </label> <?= $bank_details['account_holder_name'] ?><br>
                                            </div>
                                            <i class="fa-regular fa-pen-to-square edit-bank-details px-5"></i>
                                        </div>
                                        <label class="fw-bolder"><?= $this->lang->line('account-number') ?> : </label> XXXXXXXX<?= substr($bank_details['account_number'], -4) ?><br>
                                        <label class="fw-bolder"><?= $this->lang->line('bank-name') ?> : </label> <?= $bank_details['bank_name'] ?><br>
                                        <label class="fw-bolder"><?= $this->lang->line('bank-address') ?> : </label> <?= $bank_details['bank_address'] ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($validation_errors) && !empty($validation_errors)) : ?>
                                <div class="alert alert-danger">
                                    <?= $validation_errors; ?>
                                </div>
                            <?php endif; ?>

                            <form class="mt-5" action="<?= base_url('add-bank-details') ?>" method="POST" autocomplete="off">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <div class="form-group my-4">
                                    <label><?= $this->lang->line('account-holder-name') ?></label>
                                    <input type="text" name="account_holder_name" id="account_holder_name" class="form-control my-1" value="">
                                </div>
                                <div class="form-group my-4">
                                    <label><?= $this->lang->line('account-number') ?></label>
                                    <input type="password" name="account_number" id="account_number" class="form-control my-1" value="">
                                </div>
                                <div class="form-group my-4">
                                    <label><?= $this->lang->line('confirm-account-number') ?></label>
                                    <input type="text" name="confirm_account_number" id="confirm_account_number" value="" class="form-control my-1">
                                    <span id="msg_data" style="color:red;"></span>
                                </div>
                                <div class="form-group my-4">
                                    <label for="bank_name"><?= $this->lang->line('bank-name') ?></label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control my-1" value="" required>
                                </div>
                                <div class="form-group my-4">
                                    <label for="bank_address"><?= $this->lang->line('bank-address') ?></label>
                                    <input type="text" name="bank_address" id="bank_address" class="form-control my-1" value="" required>
                                </div>

                                <div class="form-group d-flex-center">
                                    <button class="btn btn-primary btn-block btn-lg" id="save" type="submit">Save</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>



    </main>

    <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>
    <script>
        var timeout = null;
        var ac_number = document.getElementById('account_number');
        var conifrm_ac_number = document.getElementById('confirm_account_number');

        conifrm_ac_number.addEventListener('input', () => {
            check_password();
        });

        const check_password = () => {

            if (conifrm_ac_number.value != ac_number.value) {
                $('#msg_data').html('Password and Confirm password Not match.');
                $('#save').prop('disabled', true);
            } else {
                $('#msg_data').html('');
                $('#save').prop('disabled', false);

            }
        };

        document.querySelector('.edit-bank-details').addEventListener('click', () => {
            var bank_detail = document.querySelector('#user-bank-details').dataset;
            document.querySelector('#account_holder_name').value = bank_detail.accountHolderName;
            document.querySelector('#account_number').value = bank_detail.accountNumber;
            document.querySelector('#confirm_account_number').value = bank_detail.accountNumber;
            document.querySelector('#bank_name').value = bank_detail.bankName;
            document.querySelector('#bank_address').value = bank_detail.bankAddress;
            console.log(bank_detail);
        })
    </script>

</body>

</html>