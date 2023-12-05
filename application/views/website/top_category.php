<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Top Category";
    include("include/headTag.php") ?>
    <link rel="stylesheet" href="<?= base_url('assets_web/style/css/category.css') ?>">
</head>

<body>
    <?php include("include/loader.php") ?>
    <?php include("include/topbar.php") ?>
    <?php include("include/navbar.php") ?>

    <main>

        <!-- Top Category section starts here  -->
        <section class="my-5 category">
            <div class="container">

                <h5 class="mb-4 page-heading">All Categories</h5>

                <div class="top-banner mb-3 mb-md-5">
                    <img src="<?php echo MEDIA_URL . json_decode(get_settings('category_banner'))->{'280-310'}; ?>" class="w-100" alt="Top Banner">
                </div>
                <div class="row category-cards">
                    <?php foreach ($header_cat as $maincat1) : ?>
                        <div class="col-4 col-sm-4 col-lg-3 mb-3 mb-md-5">
                            <a href=" <?php echo base_url() . 'shop/' . $maincat1['cat_slug']; ?>" class="card position-relative">
                                <img src="<?php echo MEDIA_URL . $maincat1['web_banner']; ?>" alt="<?= $maincat1['cat_name']; ?>" class="img-fluid">
                                <div class="card-overlay position-absolute top-0 start-0 p-4 p-4 py-lg-5 px-lg-5"></div>
                            </a>
                            <div class="category-title text-center mt-2"><?php echo $maincat1['cat_name']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Top Category section ends here  -->

    </main>

    <?php include("include/footer.php") ?>
    <?php include("include/script.php") ?>
</body>

</html>