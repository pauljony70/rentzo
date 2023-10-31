<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Help";
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
    <?php
    // include("include/navForMobile.php")
    ?>

    <main class="cart-page">


        <section id="privacy">

            <div class="container">

                <div class="row my-4">
                    <div class="col-8">
                        <h3 class="text-uppercase fw-bold"><?= $this->lang->line('help-and-support') ?></h3>
                    </div>
                </div>

                <?php echo html_entity_decode($page_content); ?>


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