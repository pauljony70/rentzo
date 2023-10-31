<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = $this->lang->line('buy-from-turkey');
    include("include/headTag.php") ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_web/style/css/shipping-price-calculator.css') ?>">
</head>

<body>

    <?php include("include/loader.php") ?>
    <?php include("include/topbar.php") ?>
    <?php include("include/navbar.php") ?>

    <main>
        <div class="container my-15 p-1">
            <div class="row row_height_content">
                <div class="col-md-6 mb-2">
                    <div class="card">
                        <div class="card border bg-transparent">
                            <div class="card-body p-0 child_height_set">
                                <div class="d-flex justify-content-sm-center" id="course-pills-tab-1" role="tablist">
                                    <div class="fs-5 fw-bolder text-dark text-uppercase">Shipping Price Calculator</div>
                                </div>
                                <hr style="margin: 0px;">
                                <div class="card p-0 py-2 p-sm-2 p-md-4 py-sm-2 py-md-4 calculator-card">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-12 col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label"><?= $this->lang->line('shipping-country-from') ?></label>
                                                    <select class="form-control" id="shipping-country-from">
                                                        <option value="">Select Country</option>
                                                        <option value="Oman">Oman</option>
                                                        <option value="Turkey">Turkey</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label"><?= $this->lang->line('shipping-country-to') ?></label>
                                                    <select class="form-control" id="shipping-country-to">
                                                        <option value="">Select Country</option>
                                                        <option value="Qatar">Qatar</option>
                                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                                        <option value="Turkey">Turkey</option>
                                                        <option value="Bahrain">Bahrain</option>
                                                        <option value="Kuwait">Kuwait</option>
                                                        <option value="Oman">Oman</option>
                                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label"><?= $this->lang->line('shipping-package-weight') ?></label>
                                                    <div class="input-group mb-2">
                                                        <input type="text" class="form-control" placeholder="Package Weight">
                                                        <div class="input-group-text">Kg</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-xl-6">
                                                <div class="form-group box-dimension">
                                                    <label class="form-label" for=""><?= $this->lang->line('shipping-box-size') ?></label>
                                                    <div class="d-flex justify-concent-between">
                                                        <div class="mx-2 <?= $default_language == 1 ? 'me-0' : 'ms-0' ?>">
                                                            <input type="text" class="form-control text-center">
                                                            <div class="d-flex justify-content-center">
                                                                <span class="text-muted"><?= $this->lang->line('shipping-length') ?></span>
                                                            </div>
                                                        </div>
                                                        <i class="fa-solid fa-xmark mt-3"></i>
                                                        <div class="mx-2">
                                                            <input type="text" class="form-control text-center">
                                                            <div class="d-flex justify-content-center">
                                                                <span class="text-muted"><?= $this->lang->line('shipping-breath') ?></span>
                                                            </div>
                                                        </div>
                                                        <i class="fa-solid fa-xmark mt-3"></i>
                                                        <div class="mx-2">
                                                            <input type="text" class="form-control text-center">
                                                            <div class="d-flex justify-content-center">
                                                                <span class="text-muted"><?= $this->lang->line('shipping-height') ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="mx-2 <?= $default_language == 1 ? 'ms-0' : 'me-0' ?>">
                                                            <input type="text" class="form-control text-center" value="m" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 px-3">
                                            <button class="btn btn-lg btn-block btn-default">
                                                <?= $this->lang->line('shipping-calculate-prize') ?>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 h-100">
                    <div class="card">
                        <div class="card border bg-transparent">
                            <div class="card-body p-0 child_height_set">
                                <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-center p-3" id="course-pills-tab" role="tablist">
                                    <li class="nav-item me-2 me-sm-5" role="presentation">
                                        <button class="nav-link mb-2 mb-md-0 active" id="tab-1" data-bs-toggle="pill" data-bs-target="#tabs-1" type="button" role="tab" aria-controls="tabs-1" aria-selected="true">Forward</button>
                                    </li>
                                    <li class="nav-item me-2 me-sm-5" role="presentation">
                                        <button class="nav-link mb-2 mb-md-0" id="tab-2" data-bs-toggle="pill" data-bs-target="#tabs-2" type="button" role="tab" aria-controls="tabs-2" aria-selected="false" tabindex="-1">RTO</button>
                                    </li>
                                    <li class="nav-item me-2 me-sm-5" role="presentation">
                                        <button class="nav-link mb-2 mb-md-0" id="tab-3" data-bs-toggle="pill" data-bs-target="#tabs-3" type="button" role="tab" aria-controls="tabs-3" aria-selected="false" tabindex="-1">Reverse</button>
                                    </li>
                                </ul>
                                <hr style="margin: 0px;">
                                <div class="tab-content p-4" id="course-pills-tabContent">
                                    <div class="tab-pane fade active show" id="tabs-1" role="tabpanel" aria-labelledby="tab-1">
                                        <div class="card border mb-4">
                                            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-2">
                                                        <h6>Surface</h6>
                                                        <span class="card-title mb-0"><strong class="fw-bolder" style="font-size:22px;">OMR 110</strong></span><span>/Deleivery in 4 days</span>
                                                    </div>
                                                </div>

                                                <div class="bg-light rounded-circle">
                                                    <i class="fa-solid fa-truck-fast fa-2xl"></i>
                                                </div>
                                            </div>
                                            <div class="card-header">
                                                <i class="fa-solid fa-circle-info <?= $default_language == 1 ? 'ms-2' : 'me-2' ?>"></i><span>Cost is increased</span>
                                            </div>
                                        </div>
                                        <div class="card border mb-4">
                                            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-2">
                                                        <h6>Express</h6>
                                                        <span class="card-title"><strong class="fw-bolder" style="font-size:22px;">OMR 710</strong>/Deleivery in 2 days</span>
                                                    </div>
                                                </div>

                                                <div class="bg-light rounded-circle">
                                                    <i class="fa-solid fa-plane fa-2xl"></i>
                                                </div>
                                            </div>
                                            <div class="card-header">
                                                <i class="fa-solid fa-circle-info <?= $default_language == 1 ? 'ms-2' : 'me-2' ?>"></i><span>Cost is increased</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="tab-1">
                                        <h1>TAB 2</h1>
                                    </div>
                                    <div class="tab-pane fade" id="tabs-3" role="tabpanel" aria-labelledby="tab-1">
                                        <h1>TAB 3</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php include("include/footer.php") ?>
    <?php include("include/script.php") ?>

    <script>
        /* window.addEventListener('DOMContentLoaded', function() {
            var parentDiv = document.querySelector('.row_height_content');
            var childDiv = document.querySelector('.child_height_set');

            childDiv.style.height = parentDiv.offsetHeight + 'px';
        }); */

        $(document).ready(function() {
            // Initially hide options in the 'shipping-country-to' select box
            $("#shipping-country-to option").hide();

            // Show options in the 'shipping-country-to' select box based on the selected option in 'shipping-country-from'
            $("#shipping-country-from").change(function() {
                // Reset all options to be visible
                $("#shipping-country-to option").show();

                // Get the selected value from 'shipping-country-from'
                var selectedCountryFrom = $(this).val();

                // Hide the corresponding option in 'shipping-country-to'
                $("#shipping-country-to option[value='" + selectedCountryFrom + "']").hide();

                // Check if the selected value is the same as the selected option in 'shipping-country-to'
                var selectedCountryTo = $("#shipping-country-to").val();
                if (selectedCountryTo === selectedCountryFrom) {
                    $(document).ready(function() {
                        Swal.fire({
                            title: '<?= $default_language == 1 ? 'خطأ' : 'Error' ?>',
                            text: "<?= $default_language == 1 ? 'لا يمكن تحديد نفس البلد في كل من "بلد الشحن من" و "بلد الشحن إلى".' : "Cannot select the same country in both 'Shipping Country From' and 'Shipping Country To'." ?>",
                            type: 'error',
                            confirmButtonColor: '#FF6600',
                            confirmButtonText: 'OK',
                            timer: 2500
                        });
                    });
                    $(this).val(""); // Reset the selection in 'shipping-country-from'
                }
            });

            // Check if the selected value is the same as the selected option in 'shipping-country-from'
            $("#shipping-country-to").change(function() {
                var selectedCountryTo = $(this).val();
                var selectedCountryFrom = $("#shipping-country-from").val();
                if (selectedCountryTo === selectedCountryFrom) {
                    // alert("Error: Cannot select the same country in both 'Shipping Country From' and 'Shipping Country To'.");
                    $(document).ready(function() {
                        Swal.fire({
                            title: '<?= $default_language == 1 ? 'خطأ' : 'Error' ?>',
                            text: "<?= $default_language == 1 ? 'لا يمكن تحديد نفس البلد في كل من "بلد الشحن من" و "بلد الشحن إلى".' : "Cannot select the same country in both 'Shipping Country From' and 'Shipping Country To'." ?>",
                            type: 'error',
                            confirmButtonColor: '#FF6600',
                            confirmButtonText: 'OK',
                            timer: 2500
                        });
                    });
                    $(this).val(""); // Reset the selection in 'shipping-country-to'
                }
            });
        });
    </script>
</body>

</html>