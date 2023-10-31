<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Buy From Turkey Orders";
    include("include/headTag.php")
    ?>
</head>

<body>

    <?php include("include/topbar.php") ?>
    <?php include("include/navbar.php") ?>
    <main class="my-order-page">

        <!--Start: My Orders Section -->
        <section style="min-height:700px;">
            <div class="container px-1">
                <div class="row mt-4">
                    <?php
                    if (!empty($this->session->userdata("user_id"))) {
                        include("include/sidebar.php");
                    }
                    ?>
                    <div class="col-lg-8 p-1 pb-5">
                        <div class="left-block box-shadow-4 px-1 px-md-4" id="MyProfile">
                            <div class="d-none d-lg-flex justify-content-between align-itmes center mb-3">
                                <h5 class="title mb-0"><?= $this->lang->line('user-buy-from-turkey-orders'); ?></h5>
                                <?php if ($processed_order_count > 0) : ?>
                                    <a href="<?= base_url('buy-from-turkey-checkout') ?>" class="btn btn-sm btn-default text-uppercase fw-bolder">
                                        <div><?= $this->lang->line('proceed-to-checkout'); ?></div>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex d-lg-none justify-content-between align-itmes center mb-3">
                                <h5 class="title mb-0"><?= $this->lang->line('user-buy-from-turkey-orders'); ?></h5>
                                <h5 class="title mb-0">
                                    <span>
                                        <?php if (!empty($this->session->userdata("user_id"))) { ?>
                                            <a class="accordion-button box-shadow-4 collapsed" id="heading1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">My Profile</a>
                                        <?php } ?>
                                    </span>
                                </h5>
                            </div>
                            <?php
                            if (!empty($this->session->userdata("user_id"))) {
                                include("include/mobile_sidebar.php");
                            }
                            ?>
                            <?php foreach ($order as $order_history) : ?>
                                <div class="cart-details row">
                                    <div class="col-12 p-0">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="row">
                                                    <div class="col-3 p-0 product-thumb">
                                                        <img src="<?= base_url('media/' . $order_history['product_img_1']) ?>" />
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="d-flex flex-column">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="cart-prod-title text-dark text-decoration-underline fw-bold mb-0"><?= $order_history['product_link']; ?></h6>
                                                                <a href="<?= $order_history['product_link']; ?>" target="_blank" class="<?= $default_language == 1 ? 'me-2' : 'ms-2' ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6 px-0">
                                                                    <!-- <div class="rate">
                                                                        <h5 class="mb-2">120 OMR</h5>
                                                                    </div> -->
                                                                    <div class="d-flex qty"><span>Qty:</span>&nbsp;<?= $order_history['product_quantity']; ?></div>
                                                                    <div class="d-flex qty"><span>Size:</span>&nbsp;<?= $order_history['product_size']; ?></div>
                                                                    <div class="d-flex qty"><span>Colour:</span>&nbsp;<?= $order_history['product_color']; ?></div>
                                                                    <?php if (isset($order_history['order_id'])) : ?>
                                                                        <div class="d-flex order-id"><span>Order ID:</span>&nbsp;<?= $order_history['order_id']; ?></div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-sm-6 px-0">
                                                                    <div class="d-flex order-id">
                                                                        <span>Order Date:</span>&nbsp;<span><?= date('d-m-Y', strtotime($order_history['created_at']));  ?></span>
                                                                    </div>
                                                                    <div class="order-id text-capitalize">
                                                                        <span>Order Status:</span>
                                                                        <?php if ($order_history['status'] == 'rejected' || $order_history['status'] == 'cancelled') : ?>
                                                                            <span class="badge badge-soft-danger badge-pill fw-bolder"><?= $order_history['status']; ?></span>
                                                                        <?php elseif ($order_history['status'] == 'requested') : ?>
                                                                            <span class="badge badge-soft-warning badge-pill fw-bolder"><?= $order_history['status']; ?></span>
                                                                        <?php elseif ($order_history['status'] == 'processed') : ?>
                                                                            <span class="badge badge-soft-info badge-pill fw-bolder"><?= $order_history['status']; ?></span>
                                                                        <?php elseif ($order_history['status'] == 'ordered') : ?>
                                                                            <span class="badge badge-soft-success badge-pill fw-bolder"><?= $order_history['status']; ?></span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <?php if ($order_history['status'] == 'processed') : ?>
                                                                        <h6 class="my-2">
                                                                            <a href="<?= base_url('buy-from-turkey-checkout?order_id=' . $order_history['order_id']) ?>" class="fw-bolder text-uppercase">
                                                                                Proceed to Checkout
                                                                            </a>
                                                                        </h6>
                                                                    <?php endif; ?>
                                                                    <?php if ($order_history['status'] !== 'ordered' && $order_history['status'] !== 'rejected' && $order_history['status'] !== 'cancelled') : ?>
                                                                        <a href="javascript:void(0);" class="cancel-order track-order text-uppercase my-2" data-order-id="<?= $order_history['order_id']; ?>">
                                                                            <h6>Cancel Order</h6>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                    <?php if ($order_history['status'] == 'ordered') : ?>
                                                                        <h6 class="my-2">
                                                                            <a href="<?= base_url('buy-from-turkey-checkout?order_id=' . $order_history['order_id']) ?>" class="fw-bolder text-uppercase">
                                                                                TRACK ORDER
                                                                            </a>
                                                                        </h6>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; ?>


                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--End: My Orders Section -->

    </main>

    <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>

    <script>
        var filtersContainer = document.querySelector('.right-block');

        // Calculate the initial positions of the filtersContainer
        const calculateFilterContainerPositions = () => {
            var viewportHeight = window.innerHeight;
            var filtersContainerHeight = filtersContainer.offsetHeight;
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            var scrollBottom = document.documentElement.scrollHeight - (scrollTop + viewportHeight);
            var topPosition = '-' + (filtersContainerHeight - viewportHeight) + 'px';

            if (scrollTop > 0 && scrollBottom > 0) {
                filtersContainer.style.cssText = `top: ${topPosition};`;
            } else if (scrollTop === 0) {
                filtersContainer.style.cssText = `bottom: ${topPosition};`;
            }
        };

        // Call the calculation function initially and on window scroll
        window.addEventListener('scroll', calculateFilterContainerPositions);
        window.addEventListener('load', calculateFilterContainerPositions);
        window.addEventListener('resize', calculateFilterContainerPositions);

        document.querySelector('.cancel-order').addEventListener('click', function() {
            var order_id = this.dataset.orderId;
            Swal.fire({
                text: 'Are you sure to cancel order#' + order_id,
                type: "warning",
                confirmButtonColor: '#FF6600',
                showCancelButton: true,
                showCloseButton: true,
            }).then(function(res) {
                if (res.value) {
                    $.ajax({
                        method: "post",
                        url: site_url + "cancel-other-country-order",
                        data: {
                            language: default_language,
                            order_id: order_id,
                            [csrfName]: csrfHash
                        },
                        success: function(response) {
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
                        error: function(xhr, status, error) {
                            // Handle error here
                            Swal.fire({
                                title: 'FAILED',
                                text: error,
                                type: "error",
                                confirmButtonColor: '#ff6600',
                                showCloseButton: true
                            }).then((res) => {
                                location.reload();
                            });;
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>