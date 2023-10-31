<!DOCTYPE html>
<html>

<head>
    <?php $title = "Brown ECA Brick Jelly";
    include("./includes/head.php"); ?>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> -->
    <!-- <link rel='stylesheet' href='https://cdn.jsdelivr.net/foundation/5.5.0/css/foundation.css'> -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css'>
    <link rel='stylesheet' href='https://kenwheeler.github.io/slick/slick/slick-theme.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" integrity="sha512-GPEZI1E6wle+Inl8CkTU3Ncgc9WefoWH4Jp8urbxZNbaISy0AhzIMXVzdK2GEf1+OVhA+MlcwPuNve3rL1F9yg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            position: relative;
            overflow-x: hidden;
            background-color: #aacccc;
        }

        .js .slider-single>div:nth-child(1n + 2) {
            display: none;
        }

        .js .slider-single.slick-initialized>div:nth-child(1n + 2) {
            display: block;
        }

        .slider.slider-single.light-box.slick-initialized.slick-slider {
            height: auto;
        }

        .f-row {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 0;
            margin-bottom: 0;
            /* max-width: 62.5rem; */
        }

        .column.small-centered:last-child,
        .columns.small-centered:last-child {
            float: none;
        }

        .column.small-centered,
        .columns.small-centered {
            margin-left: auto;
            margin-right: auto;
            float: none;
        }

        @media only screen and (min-width: 40.063em) {

            .column,
            .columns {
                position: relative;
                padding-left: 0.9375rem;
                padding-right: 0.9375rem;
                float: left;
            }
        }

        .small-11 {
            width: 91.66667%;
        }

        .column,
        .columns {
            padding-left: 2rem;
            padding-right: 2rem;
            width: 100%;
            float: left;
        }

        /* 
        img {
            max-width: 100%;
            height: auto;
        } */

        .slider {
            background-color: #fff;
        }

        .slider.slider-single {
            margin-left: -2rem !important;
            margin-right: -2rem !important;
            margin-bottom: 1rem;
        }

        .slider.slider-single div {
            margin: 0 auto;
            /* background: #fff; */
            /* height: 500px; */
            /* width: 400px; */
            width: 320px;
        }

        .slider.slider-nav {
            margin: auto;
            height: auto;
            background: transparent;
        }

        .slider.slider-nav img {
            height: 60px;
            width: 60px;
        }

        .slider-nav .slick-slide {
            cursor: pointer;
        }

        .slick-lightbox {
            position: absolute;
            bottom: 0;
            left: 0;
            /* right: 0; */
            /* top: 0; */
            width: 100%;
            /* height: 100vh; */
            /* transform: translate(0%, 0%); */
            /* padding: 42% 3rem; */
            margin: auto;
        }

        .slick-lightbox-slick.slick-caption-dynamic.slick-initialized.slick-slider {
            position: relative;
            transform: translate(0, 25%);
            /* height: 100%; */
            /* display: flex; */
            /* transform: translate(0, 32%); */
            /* align-items: center; */
            /* justify-content: center; */
        }

        .slick-lightbox-close {
            display: block;
            background-color: rebeccapurple;
            position: absolute;
            top: 0;
            right: 0;
            height: 40px;
            width: 40px;
            text-align: center;
        }

        .slick-lightbox-slick-item-inner {
            max-height: 80vh !important;
        }

        .slick-lightbox-slick-img {
            margin: auto;
            max-height: 80vh !important;
        }

        .slick-lightbox-slick-item.slick-slide {
            height: auto !important;
        }

        button.slick-lightbox-close::before {
            content: "X";
            border-radius: 50% !important;
        }

        .slick-lightbox {
            background-color: rgba(0, 0, 0, .9) !important;
        }

        /* .slick-slide {
	width: 110px !important;
} */
    </style>
</head>

<body>
    <?php include("./includes/topBar.php") ?>
    <div class="shadow-sm sticky-top">
        <?php //include("./includes/header.php") 
        ?>
    </div>

    <!-- product details starts -->
    <section id="product-details">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-4 mb-4 mb-lg-0 d-none">
                    <div class="showImg position-relative d-none" href="./images/products/1.png">
                        <img class="img-fluid" src="./images/products/1.png" id="show-img">
                        <div class="favourite shadow">
                            <i class="far fa-heart"></i>
                        </div>
                    </div>
                    <div class="small-img mx-auto d-none">
                        <i class="fas fa-arrow-alt-circle-left icon-left" id="prev-img"></i>
                        <div class="small-container">
                            <div id="small-img-roll">
                                <img src="./images/products/1.png" class="show-small-img" alt="">
                                <img src="./images/products/2.png" class="show-small-img" alt="">
                                <img src="./images/products/3.png" class="show-small-img" alt="">
                                <img src="./images/products/4.png" class="show-small-img" alt="">
                                <img src="./images/products/2.png" class="show-small-img" alt="">
                                <img src="./images/products/2.png" class="show-small-img" alt="">
                                <img src="./images/products/2.png" class="show-small-img" alt="">
                            </div>
                        </div>
                        <i class="fas fa-arrow-alt-circle-right icon-right" id="next-img"></i>
                    </div>
                    <div id="page">
                        <div class="f-row">
                            <div class="column small-11 small-centered">
                                <div class="slider slider-single light-box">
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                </div>
                                <div class="slider slider-nav">
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-lg-4 mb-4 mb-lg-0">
                    <div id="page">
                        <div class="f-row">
                            <div class="column small-11 small-centered">
                                <div class="slider slider-single light-box">
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                </div>
                                <div class="slider slider-nav">
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                    <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div id="page">
                    <div class="row">
                        <div class="column small-11 small-centered">
                            <div class="slider slider-single light-box">
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                            </div>
                            <div class="slider slider-nav">
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                                <div><img src="https://unsplash.com/photos/Lwuc40AQORI/download?ixid=MnwxMjA3fDB8MXxhbGx8NXx8fHx8fDJ8fDE2NTQ3NjM2ODI&force=true&w=640">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div id="page" class="col-lg-4 mb-4 mb-lg-0">
                    <div class="f-row">
                        <div class="column small-11 small-centered">
                            <div class="slider slider-single light-box">
                                <div><img class="img-fluid" src="./images/products/1.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/2.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/3.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/4.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/3.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/2.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/1.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/2.png">
                                </div>
                            </div>
                            <div class="slider slider-nav">
                                <div><img class="img-fluid" src="./images/products/1.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/2.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/3.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/4.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/3.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/2.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/1.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/2.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/1.png">
                                </div>
                                <div><img class="img-fluid" src="./images/products/1.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h1 class="fs-2 mb-3 mb-lg-4" id="product_name">
                        Brown ECA Brick Jelly, For Construction, Packaging Type: Bag
                    </h1>
                    <div class="review mb-4 mb-lg-5">
                        <div class="review-pill shadow">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="review-text">
                            <span>4.8 Stars</span>
                        </div>
                    </div>
                    <div class="pDetails">
                        <div class="product-color mb-4 mb-lg-4">
                            <span class="fw-bold">Color</span>
                            <div class="w-75 line mb-3"></div>
                            <div class="change-color">
                                <span class="white Active" name="white" picChange="url(./i)"></span>
                                <span class="black" name="black" picChange="url(./i)"></span>
                                <span class="blue" name="blue" picChange="url(./i)"></span>
                                <span class="red" name="red" picChange="url(./i)"></span>
                                <span class="green" name="green" picChange="url(./i)"></span>
                            </div>
                        </div>
                        <div class="product-size mb-4 mb-lg-4">
                            <span class="fw-bold">Size</span>
                            <div class="w-75 line mb-3"></div>
                            <div class="p-size">
                                <!-- <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="size-xs" value="size-xs" >
                                        <label class="form-check-label" for="size-xs">XS</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="size-s" value="size-s">
                                        <label class="form-check-label" for="size-s">S</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="size-m" value="size-m" checked>
                                        <label class="form-check-label" for="size-m">M</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="size-l" value="size-l" >
                                        <label class="form-check-label" for="size-l">L</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="size-xl" value="size-xl">
                                        <label class="form-check-label" for="size-xl">XL</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="size-xxl" value="size-xxl">
                                        <label class="form-check-label" for="inlineRadio1">XXL</label>
                                    </div> -->
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradio" id="size-s" value="size-s" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="size-s">S</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="size-m" value="size-m" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="size-m">M</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="size-l" value="size-l" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="size-l">L</label>
                                </div>
                            </div>

                        </div>
                        <div class="product-avail mb-3 mb-lg-4">
                            <span class="fw-bold">Delivery</span>
                            <div class="w-75 line mb-3"></div>
                            <form class="d-flex" id="avail">
                                <input class="form-control me-2" type="number" placeholder="PIN Code" aria-label="Search">
                                <button class="btn btn-primary" type="submit">CHECK</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pPriceDetails">
                    <div class="pPrice mb-1 mb-lg-0">
                        <h2>MRP : <span id="product-price">$100.00</span></h2>
                        <p class="">$120.00</p>
                    </div>
                    <div class="offerCoupon mb-1 mb-lg-0">
                        <p>Total Savings : $20.00 (5% Discount)</p>
                        <form class="d-flex" id="coupon">
                            <input class="form-control me-2" type="search" placeholder="Coupon Code" aria-label="Search">
                            <button class="btn btn-primary" type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="available-offers mb-1 mb-lg-0">
                        <h3>Available Offers </h3>
                        <ul class="allOffers">
                            <li>
                                <p>Bank Offer10% Instant Discount on Punjab National Bank Debit and Credit CardsT&C</p>
                            </li>
                            <li>
                                <p>Bank Offer5% Unlimited Cashback on Flipkart Axis Bank Credit CardT&C</p>
                            </li>
                            <li>
                                <p>Bank Offer20% off on 1st txn with Amex Network Cards issued by ICICI Bank,IndusInd Bank,SBI Cards and MobikwikT&C</p>
                            </li>
                            <li>
                                <p>Partner OfferBuy and Get Free 6 months Gaana Plus SubscriptionKnow More</p>
                            </li>
                            <li>
                                <p>Bank OfferFlat ₹75 off on first Flipkart Pay Later order of ₹500 and aboveT&C</p>
                            </li>
                        </ul>
                    </div>

                    <div class="pBtns">
                        <a class="btn-solid" href="">Buy Now</a>
                        <a class="btn-border" href="">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- product details ends -->

    <!-- product review and description starts -->
    <section id="pReview">
        <div class="container">
            <div class=" row d-flex justify-content-center align-items-center">
                <div class=" col-12 mx-auto col-sm-12">
                    <nav>
                        <div class="nav nav-tabs justify-content-center align-items-center mb-3" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Details</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Reviews</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class=" detailsProd">
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form action="">
                                <div class="reviewArea">
                                    <textarea name="ProductReview" id="ProductReview"></textarea>
                                    <!-- star input  -->
                                    <div class="starDiv">
                                        <span class="star-rating">
                                            <input type="radio" name="rating1" value="1"><i></i>
                                            <input type="radio" name="rating1" value="2"><i></i>
                                            <input type="radio" name="rating1" value="3"><i></i>
                                            <input type="radio" name="rating1" value="4"><i></i>
                                            <input type="radio" name="rating1" value="5"><i></i>
                                        </span>
                                    </div>
                                    <!-- star input  -->
                                </div>
                                <button class="btn btn-primary mt-3 px-4 py-2" type="submit">Add Review</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product review and description ends -->

    <!-- similar products  -->
    <!-- <section id="sameProd">
        <div class=" container-fluid">
            
        </div>
        <div class="top-content"> -->
    <!-- <div class="container-fluid">
        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner row w-100 mx-auto" role="listbox">
                <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                    <img src="./images/products/1.png" class="img-fluid mx-auto d-block" alt="img1">
                </div>
                <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                    <img src="./images/products/2.png" class="img-fluid mx-auto d-block" alt="img2">
                </div>
                <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                    <img src="./images/products/3.png" class="img-fluid mx-auto d-block" alt="img3">
                </div>
                <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                    <img src="./images/products/4.png" class="img-fluid mx-auto d-block" alt="img4">
                </div>
                <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                    <img src="./images/products/3.png" class="img-fluid mx-auto d-block" alt="img5">
                </div>
                <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                    <img src="./images/products/2.png" class="img-fluid mx-auto d-block" alt="img6">
                </div>
                <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                    <img src="./images/products/1.png" class="img-fluid mx-auto d-block" alt="img7">
                </div>
                <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                    <img src="./images/products/2.png" class="img-fluid mx-auto d-block" alt="img8">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div> -->
    <!-- </div>
    </section> -->
    <section id="sameProd">
        <div class=" section-title mb-4">
            <h2>Similar Products</h2>
            <!-- <div class="sline"></div> -->
        </div>
        <div class=" container-fluid bg-white">
            <div class="container py-3 py-xl-4 px-4 px-md-0">

                <div class="swiper SameProdmySwiper">
                    <div class="swiper-wrapper row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
                        <div class="swiper-slide col px-5">
                            <a href="">
                                <div class="card p-1">
                                    <img src="https://fleekmart.com/media/2022-03-02/cement-acc-1190821526-600-600.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 href="#" class="card-title">Special title treatment treatment treatment treatment treatment treatment</h5>
                                        <p class="card-text text-muted">Price</p>
                                        <div class="cardBelow ">
                                            <h6>$100.00</h6>
                                            <a href="#" class="btn btn-primary addToCart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide col">
                            <a href="">
                                <div class="card p-1">
                                    <img src="./images/products/4.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 href="#" class="card-title">Special title treatment</h5>
                                        <p class="card-text text-muted">Price</p>
                                        <div class="cardBelow ">
                                            <h6>$100.00</h6>
                                            <a href="#" class="btn btn-primary addToCart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide col">
                            <a href="">
                                <div class="card p-1">
                                    <img src="./images/products/4.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 href="#" class="card-title">Special title treatment</h5>
                                        <p class="card-text text-muted">Price</p>
                                        <div class="cardBelow ">
                                            <h6>$100.00</h6>
                                            <a href="#" class="btn btn-primary addToCart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide col">
                            <a href="">
                                <div class="card p-1">
                                    <img src="./images/products/4.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 href="#" class="card-title">Special title treatment</h5>
                                        <p class="card-text text-muted">Price</p>
                                        <div class="cardBelow ">
                                            <h6>$100.00</h6>
                                            <a href="#" class="btn btn-primary addToCart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide col">
                            <a href="">
                                <div class="card p-1">
                                    <img src="./images/products/4.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 href="#" class="card-title">Special title treatment</h5>
                                        <p class="card-text text-muted">Price</p>
                                        <div class="cardBelow ">
                                            <h6>$100.00</h6>
                                            <a href="#" class="btn btn-primary addToCart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide col">
                            <a href="">
                                <div class="card p-1">
                                    <img src="./images/products/4.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 href="#" class="card-title">Special title treatment</h5>
                                        <p class="card-text text-muted">Price</p>
                                        <div class="cardBelow ">
                                            <h6>$100.00</h6>
                                            <a href="#" class="btn btn-primary addToCart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide col">
                            <a href="">
                                <div class="card p-1">
                                    <img src="./images/products/4.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 href="#" class="card-title">Special title treatment</h5>
                                        <p class="card-text text-muted">Price</p>
                                        <div class="cardBelow ">
                                            <h6>$100.00</h6>
                                            <a href="#" class="btn btn-primary addToCart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide col">
                            <a href="">
                                <div class="card p-1">
                                    <img src="./images/products/4.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 href="#" class="card-title">Special title treatment</h5>
                                        <p class="card-text text-muted">Price</p>
                                        <div class="cardBelow ">
                                            <h6>$100.00</h6>
                                            <a href="#" class="btn btn-primary addToCart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide col">
                            <a href="">
                                <div class="card p-1">
                                    <img src="./images/products/4.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 href="#" class="card-title">Special title treatment</h5>
                                        <p class="card-text text-muted">Price</p>
                                        <div class="cardBelow ">
                                            <h6>$100.00</h6>
                                            <a href="#" class="btn btn-primary addToCart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide col">
                            <a href="">
                                <div class="card p-1">
                                    <img src="./images/products/4.png" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 href="#" class="card-title">Special title treatment</h5>
                                        <p class="card-text text-muted">Price</p>
                                        <div class="cardBelow ">
                                            <h6>$100.00</h6>
                                            <a href="#" class="btn btn-primary addToCart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
            </div>
        </div>

    </section>
    <!-- similar products  -->

    <!-- also bought product  -->
    <section id="alsoBought">
        <div class=" section-title mb-4">
            <h2>People Also Buy</h2>
            <!-- <div class="sline"></div> -->
        </div>
        <div class="white-bg">
            <div class=" container">
                <div class="row mx-auto row-cols-2 row-cols-md-3 row-cols-xl-6">
                    <div class=" col mb-4 mb-md-3 mb-xl-0 px-1">
                        <a href="">
                            <div class="card p-1 shadow">
                                <div class="d-flex justify-content-center">
                                    <img src="https://fleekmart.com/media/2022-03-02/cement-acc-1190821526-600-600.png" class="card-img-top" alt="">
                                </div>
                                <div class="card-body">
                                    <h5 href="#" class="card-title">Special title treatment</h5>
                                    <p class="card-text text-muted">Price</p>
                                    <div class="cardBelow ">
                                        <h6>$100.00</h6>
                                        <a href="#" class="btn btn-primary addToCart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class=" col mb-4 mb-md-3 mb-xl-0 px-1">
                        <a href="">
                            <div class="card p-1 shadow">
                                <img src="./images/products/4.png" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 href="#" class="card-title">Special title treatment</h5>
                                    <p class="card-text text-muted">Price</p>
                                    <div class="cardBelow ">
                                        <h6>$100.00</h6>
                                        <a href="#" class="btn btn-primary addToCart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class=" col mb-4 mb-md-3 mb-xl-0 px-1">
                        <a href="">
                            <div class="card p-1 shadow">
                                <img src="./images/products/4.png" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 href="#" class="card-title">Special title treatment</h5>
                                    <p class="card-text text-muted">Price</p>
                                    <div class="cardBelow ">
                                        <h6>$100.00</h6>
                                        <a href="#" class="btn btn-primary addToCart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class=" col mb-4 mb-md-3 mb-xl-0 px-1">
                        <a href="">
                            <div class="card p-1 shadow">
                                <img src="./images/products/4.png" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 href="#" class="card-title">Special title treatment</h5>
                                    <p class="card-text text-muted">Price</p>
                                    <div class="cardBelow ">
                                        <h6>$100.00</h6>
                                        <a href="#" class="btn btn-primary addToCart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class=" col mb-4 mb-md-3 mb-xl-0">
                        <a href="">
                            <div class="card p-1 shadow">
                                <img src="./images/products/4.png" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 href="#" class="card-title">Special title treatment</h5>
                                    <p class="card-text text-muted">Price</p>
                                    <div class="cardBelow ">
                                        <h6>$100.00</h6>
                                        <a href="#" class="btn btn-primary addToCart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class=" col mb-4 mb-md-3 mb-xl-0">
                        <a href="">
                            <div class="card p-1 shadow">
                                <img src="./images/products/4.png" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 href="#" class="card-title">Special title treatment</h5>
                                    <p class="card-text text-muted">Price</p>
                                    <div class="cardBelow ">
                                        <h6>$100.00</h6>
                                        <a href="#" class="btn btn-primary addToCart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- also bought product  -->

    <!-- on offer now -->
    <section id="indexOffer">
        <div class=" section-title mb-4">
            <h2>On Offer Now</h2>
            <p>Products which are under best deal offer today</p>
            <!-- <div class="sline"></div> -->
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 mb-3 mb-sm-0">
                    <div class="offerCard shadow">
                        <a href="">
                            <img class=" img-fluid" src="./images/samplebannerproducts/w_banner_1.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-3 mb-sm-0">
                    <div class="offerCard">
                        <a href="">
                            <img class=" img-fluid" src="./images/samplebannerproducts/w_banner_1.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-3 mb-sm-0">
                    <div class="offerCard">
                        <a href="">
                            <img class=" img-fluid" src="./images/samplebannerproducts/w_banner_1.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- on offer now -->

    <!-- product also visited  -->
    <section id="indexVisited" class="indexVisited">
        <div class=" section-title mb-4">
            <h2>Recently Seen</h2>
            <p>You have gone through these product list recently.</p>
            <!-- <div class="sline"></div> -->
        </div>
        <div class=" container">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="alsoVi">
                        <div class="Vi-image">
                            <img class=" img-fluid" src="./images/products/steelRod.png" alt="">
                        </div>
                        <div class="Vi-text">
                            <div class="Vi-pTitle">
                                <h1>Lusioc Yello Single Hand Roller Brush</h1>
                            </div>
                            <div class="Vi-price">
                                <div>
                                    <span class=" text-muted">Price</span>
                                    <h2>$100.00</h2>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary addToCart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="alsoVi">
                        <div class="Vi-image">
                            <img class=" img-fluid" src="./images/products/steelRod.png" alt="">
                        </div>
                        <div class="Vi-text">
                            <div class="Vi-pTitle">
                                <h1>Lusioc Yello Single Hand Roller Brush</h1>
                            </div>
                            <div class="Vi-price">
                                <div>
                                    <span class=" text-muted">Price</span>
                                    <h2>$100.00</h2>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary addToCart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="alsoVi">
                        <div class="Vi-image">
                            <img class=" img-fluid" src="./images/products/steelRod.png" alt="">
                        </div>
                        <div class="Vi-text">
                            <div class="Vi-pTitle">
                                <h1>Lusioc Yello Single Hand Roller Brush</h1>
                            </div>
                            <div class="Vi-price">
                                <div>
                                    <span class=" text-muted">Price</span>
                                    <h2>$100.00</h2>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary addToCart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="alsoVi">
                        <div class="Vi-image">
                            <img class=" img-fluid" src="./images/products/steelRod.png" alt="">
                        </div>
                        <div class="Vi-text">
                            <div class="Vi-pTitle">
                                <h1>Lusioc Yello Single Hand Roller Brush</h1>
                            </div>
                            <div class="Vi-price">
                                <div>
                                    <span class=" text-muted">Price</span>
                                    <h2>$100.00</h2>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary addToCart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="alsoVi">
                        <div class="Vi-image">
                            <img class=" img-fluid" src="./images/products/steelRod.png" alt="">
                        </div>
                        <div class="Vi-text">
                            <div class="Vi-pTitle">
                                <h1>Lusioc Yello Single Hand Roller Brush</h1>
                            </div>
                            <div class="Vi-price">
                                <div>
                                    <span class=" text-muted">Price</span>
                                    <h2>$100.00</h2>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary addToCart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="alsoVi">
                        <div class="Vi-image">
                            <img class=" img-fluid" src="./images/products/steelRod.png" alt="">
                        </div>
                        <div class="Vi-text">
                            <div class="Vi-pTitle">
                                <h1>Lusioc Yello Single Hand Roller Brush</h1>
                            </div>
                            <div class="Vi-price">
                                <div>
                                    <span class=" text-muted">Price</span>
                                    <h2>$100.00</h2>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary addToCart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="alsoVi">
                        <div class="Vi-image">
                            <img class=" img-fluid" src="./images/products/steelRod.png" alt="">
                        </div>
                        <div class="Vi-text">
                            <div class="Vi-pTitle">
                                <h1>Lusioc Yello Single Hand Roller Brush</h1>
                            </div>
                            <div class="Vi-price">
                                <div>
                                    <span class=" text-muted">Price</span>
                                    <h2>$100.00</h2>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary addToCart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="alsoVi">
                        <div class="Vi-image">
                            <img class=" img-fluid" src="./images/products/steelRod.png" alt="">
                        </div>
                        <div class="Vi-text">
                            <div class="Vi-pTitle">
                                <h1>Lusioc Yello Single Hand Roller Brush</h1>
                            </div>
                            <div class="Vi-price">
                                <div>
                                    <span class=" text-muted">Price</span>
                                    <h2>$100.00</h2>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary addToCart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product also visited  -->

    <!-- product review -->
    <section id="cpReview">
        <div class=" container">
            <div class="cReview">
                <h2>Customer Review</h2>
                <div class="bar"></div>
                <div class="starWrite">
                    <div class="reviewStar">
                        <i class="fas fa-star"></i>
                        <h3 id="star-point">4.8 <span>Out of 5</span> </h3>
                    </div>
                    <div class="writeReview" id="writeReview">
                        <a href="#nav-tabContent">WRITE A REVIEW</a>
                    </div>
                </div>
            </div>
            <div class=" pReview">
                <h3>Top Reviews</h3>
                <div class="row">
                    <div class="col-md-6 mb-3 mb-lg-4">
                        <div class="reviewCard">
                            <div class="rCardTop">
                                <div class="rCardUser">
                                    <img src="https://via.placeholder.com/150" alt="">
                                    <h4>User Name</h4>
                                </div>
                                <div class="rCardStar">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <h4>5/5 Stars</h4>
                                </div>
                            </div>
                            <div class="rCardMiddle">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                            </div>
                            <div class="rCardBottom">
                                <p class="text-muted mb-0">2 Weeks ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 mb-lg-4">
                        <div class="reviewCard">
                            <div class="rCardTop">
                                <div class="rCardUser">
                                    <img src="https://via.placeholder.com/150" alt="">
                                    <h4>User Name</h4>
                                </div>
                                <div class="rCardStar">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <h4>5/5 Stars</h4>
                                </div>
                            </div>
                            <div class="rCardMiddle">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                            </div>
                            <div class="rCardBottom">
                                <p class="text-muted mb-0">2 Weeks ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 mb-lg-4">
                        <div class="reviewCard">
                            <div class="rCardTop">
                                <div class="rCardUser">
                                    <img src="https://via.placeholder.com/150" alt="">
                                    <h4>User Name</h4>
                                </div>
                                <div class="rCardStar">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <h4>5/5 Stars</h4>
                                </div>
                            </div>
                            <div class="rCardMiddle">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                            </div>
                            <div class="rCardBottom">
                                <p class="text-muted mb-0">2 Weeks ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 mb-lg-4">
                        <div class="reviewCard">
                            <div class="rCardTop">
                                <div class="rCardUser">
                                    <img src="https://via.placeholder.com/150" alt="">
                                    <h4>User Name</h4>
                                </div>
                                <div class="rCardStar">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <h4>5/5 Stars</h4>
                                </div>
                            </div>
                            <div class="rCardMiddle">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                            </div>
                            <div class="rCardBottom">
                                <p class="text-muted mb-0">2 Weeks ago</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="readMore">
                    <a href="">
                        Read All Reviews
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- product review  -->

    <?php include("./includes/footer.php") ?>

    <?php include("./includes/script.php"); ?>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js'></script>
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.3.1/index.js'></script> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js'></script>

    <script>
        $(".slider-single").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            adaptiveHeight: true,
            infinite: true,
            useTransform: true,
            speed: 400,
            cssEase: "cubic-bezier(0.77, 0, 0.18, 1)",
        });

        $(".slider-nav")
            .on("init", function(event, slick) {
                $(".slider-nav .slick-slide.slick-current").addClass("is-active");
            })
            .slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                dots: false,
                focusOnSelect: true,
                infinite: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        },
                    },
                    {
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        },
                    },
                    {
                        breakpoint: 420,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        },
                    },
                ],
            });

        $(".slider-single").on("afterChange", function(event, slick, currentSlide) {
            $(".slider-nav").slick("slickGoTo", currentSlide);
            var currrentNavSlideElem =
                '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
            $(".slider-nav .slick-slide.is-active").removeClass("is-active");
            $(currrentNavSlideElem).addClass("is-active");
        });

        $(".slider-nav").on("click", ".slick-slide", function(event) {
            event.preventDefault();
            var goToSingleSlide = $(this).data("slick-index");

            $(".slider-single").slick("slickGoTo", goToSingleSlide);
        });

        $(document).ready(function() {
            $(".light-box").slickLightbox({
                src: "src",
                lazy: true,
                itemSelector: "div img",
            });
        });
    </script>

    <script>
        // document.onreadystatechange = function() {
        //     if (document.readyState !== "complete") {
        //         document.querySelector(
        //             "#page").style.visibility = "hidden";
        //         document.querySelector(
        //             "#loader").style.visibility = "visible";
        //     } else {
        //         document.querySelector(
        //             "#loader").style.display = "none";
        //         document.querySelector(
        //             "body").style.visibility = "visible";
        //     }
        // };
    </script>
</body>

</html>