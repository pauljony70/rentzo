<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Top Category";
    include("include/headTag.php") ?>
    <link rel="stylesheet" href="<?= base_url('assets_web/style/css/category.css') ?>">
</head>

<body>
    <?php
    include("include/loader.php")
    ?>
    <?php
    include("include/topbar.php")
    ?>
    <?php
    include("include/navbar.php");
    ?>

    <main>

        <!-- Top Category section starts here  -->
        <section class="category my-5">
            <div class="container">
                <nav aria-label="breadcrumb" class="px-1">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">Category</li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $sub_cat[0]['cat_name']; ?></li>
                    </ol>
                </nav>
                <div class="row category-cards">
                    <?php foreach ($sub_cat as $maincat) {  ?>
                        <?php if (!empty($maincat['subcat_1'])) {
                            foreach ($maincat['subcat_1'] as $subcat_1) { ?>
                                <div class="col-6 col-sm-4 col-lg-3 mb-3 mb-md-5">
                                    <a href="<?= base_url() . 'shop/' . $subcat_1['cat_slug']; ?>" class="card position-relative">
                                        <img src="<?= MEDIA_URL . $subcat_1['imgurl']; ?>" alt="<?= $subcat_1['cat_name']; ?>" class="img-fluid">
                                        <div class="card-overlay position-absolute top-0 start-0 p-4 p-4 py-lg-5 px-lg-5"></div>
                                    </a>
                                    <div class="category-title text-center mt-2"><?= $subcat_1['cat_name']; ?></div>
                                </div>
                    <?php   }
                        } else {
                            redirect(base_url . $maincat['cat_slug']);
                        }
                    } ?>


                </div>
            </div>
        </section>
        <!-- Top Category section ends here  -->

        <!-- Trending Category section starts here  -->
        <!-- <section class="trending-category">
            <div class="container-fluid">
                <div class="col-12">
                    <h3 class="mb-md-4 fw-bold">Trending</h3>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mb-4 mb-lg-6 mb-xxl-8">
                        <a href="/">
                            <div class="card position-relative">
                                <img src="<?php // echo base_url;
                                            ?>/assets_web/images/placeholders/top-cats-2.jpg" alt="" class="img-fluid">
                                <div class="card-overlay position-absolute top-0 start-0 p-4 py-lg-5 px-lg-5">
                                    <h5 class="fw-bold text-white">WINTER COLLECTION</h5>
                                    <p class="fw-bold text-primary mb-0">Min. 40% Off</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-6 mb-xxl-8">
                        <a href="/">
                            <div class="card position-relative">
                                <img src="<?php // echo base_url;
                                            ?>/assets_web/images/placeholders/top-cats-1.jpg" alt="" class="img-fluid">
                                <div class="card-overlay position-absolute top-0 start-0 p-4 py-lg-5 px-lg-5">
                                    <h5 class="fw-bold text-white">GYM COLLECTION</h5>
                                    <p class="fw-bold text-primary mb-0">Min. 15% Off</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Trending Category section ends here  -->

    </main>

    <?php
    include("include/footer.php")
    ?>

    <?php
    include("include/script.php")
    ?>
</body>

</html>