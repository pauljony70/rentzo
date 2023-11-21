<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Brand";
    include("include/headTag.php") ?>
</head>
<style>
    .allBrand .card-body {
        align-items: center;
        display: flex;
        justify-content: center;
        padding: 0.4rem 0.5rem;
    }

    .allBrand .card-body h5 {
        margin-bottom: 0 !important;
        min-height: 0px;
    }

    .allBrand .card-body h5 {
        -webkit-box-orient: vertical;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        min-height: 0px;
        overflow: hidden;
    }

    .allBrand .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
        height: 100%;
    }

    .allBrand img.card-img-top {
        object-fit: contain;
        margin: 0 auto;
        aspect-ratio: 1;
        vertical-align: middle;
        padding: 15px;
    }
</style>

<body>

    <?php
    include("include/topbar.php")
    ?>
    <?php
    include("include/navbar.php");
    ?>

    <main class="search">
        <br>
        <section class="allBrand">
            <div class="mt-0 container pe-md-5">
                <div class="row">
                    <div class="row mb-md-4">
                        <div class="col-8">
                            <h3 class=" fw-bold">All Brands</h3>
                        </div>
                    </div>

                    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 pe-0 ps-4 pe-md-2 ps-md-3">
                        <?php foreach ($header_brand as $brand) {
                            $img_decode1 = json_decode($brand['brand_img']);
                            $img_url = MEDIA_URL . $img_decode1->{'72-72'};
                        ?>
                            <div class="col mb-4">
                                <a href="<?= base_url . 'shop/brand/' . $brand['brand_name'] ?>">
                                    <div class="card shadow position-relative">
                                        <div class=" d-flex justify-content-center align-items-center pt-1 pb-0 pt-md-2 pb-md-1 pt-xl-3 pb-xl-1">
                                            <img src="<?= $img_url; ?>" class="card-img-top " alt="">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title text-center fw-normal my-1 my-md-2 fs-5 text-capitalize"><?= $default_language == 1 ? $brand['brand_name_ar'] : $brand['brand_name'] ?></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
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

</body>

</html>