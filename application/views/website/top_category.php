<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Top Category";
    include("include/headTag.php") ?>
</head>

<body>
    <?php
    include("include/loader.php")
    ?>
    <?php
    include("include/topbar.php")
    ?>
    <?php
    include("include/navbar.php")
    ?>

    <main>

        <!-- Top Category section starts here  -->
        <section class="pt-md-2 pt-2 top-category">
            <div class="container-fluid">
                <div class="col-12">
                    <h5 class="mb-md-4" style="font-size:13px;">All Categories</h5>
                </div>
                <div class="row">
                    <?php foreach ($header_cat as $maincat1) { ?>
                        <div class="col-md-6 col-lg-3 mb-2 px-1">
                            <?php if ($maincat1['cat_id'] == 10) { ?>
                                <a href="<?php echo base_url() . 'explore_sub/' . $maincat1['cat_id']; ?>">
                                <?php } else { ?>
                                    <a href="<?php echo base_url() . 'shop/' . $maincat1['cat_slug']; ?>">
                                    <?php } ?>
                                    <div class="card position-relative" style="border: 0.5px solid #ccc;">
                                        <img src="<?php echo MEDIA_URL . $maincat1['web_banner']; ?>" alt="" class="img-fluid">
                                        <div class="card-overlay position-absolute top-0 start-0 p-4 p-4 py-lg-5 px-lg-5">
                                            <!--<p class="fw-bold text-primary mb-0">Min. 40% Off</p>-->
                                        </div>
                                    </div>
                                    </a>
                                    <h5 class="fw-bolder text-center text-dark mt-2"><?php echo $maincat1['cat_name']; ?></h5>
                        </div>
                    <?php } ?>

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