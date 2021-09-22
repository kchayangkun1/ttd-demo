<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gloves PFS </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/logo.png" rel="icon">
    <link href="img/logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">

    <!-- =======================================================
    Theme Name: NewBiz
    Theme URL: https://bootstrapmade.com/newbiz-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>
    <?php 
  include "config/init.php";
  $cats_list = cat_list();
  $review_list = review_list();
?>
    <!--==========================
  Header
  ============================-->
    <header id="header" class="fixed-top">
        <div class="container">

            <div class="logo float-left">
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
                <a href="#intro" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a>
            </div>
            <nav class="main-nav float-right d-none d-lg-block">
                <ul>
                    <li>
                        <a href="index">หน้าแรก</a>
                    </li>
                    <li><a href="about">เกี่ยวกับเรา</a></li>
                    <li class=" drop-down pro-nav"><a>สินค้า</a>
                        <ul>
                            <?php 
                        foreach($cats_list as $cats_detail) : 
                            $catsub_list = cats_list($cats_detail->c_name);
                        ?>
                            <li class="drop-down ">
                                <a><?php echo $cats_detail->c_name; ?></a>
                                <ul>
                                    <?php foreach($catsub_list as $catsub_detail) : ?>
                                    <li><a
                                            href="product?id=<?php echo $catsub_detail->sub_id; ?>"><?php echo $catsub_detail->subcate_name; ?></a>
                                    </li>
                                    <?php endforeach ?>
                                </ul>

                            </li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                    <li><a class="active" href="review">รีวิวสินค้า</a></li>
                    <li><a href="method">วิธีการสั่งซื้อสินค้า</a></li>
                    <li><a href="contact">ติดต่อเรา</a></li>

                    <li>
                        <a class="size-50" href="cart">
                        <i class="fa fa-shopping-cart " aria-hidden="true"></i> 
                        <?php echo ( isset($_SESSION["cart"]['num']) and $_SESSION["cart"]['num'] > 0 ) ?  $_SESSION["cart"]['num'] : '';?>
                        </a>
                    </li>

                </ul>
            </nav><!-- .main-nav -->

        </div>
    </header><!-- #header -->

    <!--==========================
    Intro Section
  ============================-->
    <section id="intro" class="clearfix">
        <div class="container">

            <header class="section-header">
                <h3>รีวิวสินค้า</h3>
            </header>

        </div>
    </section>
    <!-- #intro -->


    <main id="main">

        <!--==========================
      review Section
    ============================-->
        <section id="" class="wow fadeIn">
            <div class="container">
                <div class="row">
                    <?php foreach($review_list as $review_detail) : ?>
                    <div class="col-md-6">
                        <div class="bg-g">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <img src="assets/images/review/<?php echo $review_detail->id; ?>/<?php echo $review_detail->img_cover; ?>"
                                        alt="" class="img-responsive ">
                                </div>
                                <div class="col-md-6 ">
                                    <div class="reviewp-text">
                                        <h3><?php echo $review_detail->name; ?></h3>
                                        <p>รีวิว : <?php echo $review_detail->dsc; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div><!-- row -->

                <?php 
                    $total = review_counter();
                    $pagination = pagination( $total[0]->counter, 8);
                ?>
                <div class="text-center reviewp-tb">
                    <div class="page-about">
                        <!-- <div class="page-about"> -->
                        <?php if ( $pagination['total'] > 0 ) : ?>
                            <?php if ( $pagination['prev'] ) : ?>
                                <a href="review?page=<?php echo $pagination['prev']; ?>">&laquo;</a>
                            <?php endif; ?>
                        <?php for ( $i = 1; $i <= $pagination['total']; $i++ ) : ?>
                            <?php 
                                $page1 = $pagination['page'] - 2;
                                $page2 = $pagination['page'] + 2;

                                if ( ( $i == 1 ) or ( $i == $pagination['total'] ) or ( $i >= $page1 and $i <= $page2 ) ) :
                            ?>
                            <a href="review?page=<?php echo $i; ?>"
                            class="<?php echo ($i == $pagination['page']) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                        <?php elseif ( ( ( $i > 1 ) and ( $i == ( $page1 - 1 ) ) ) or ( ( $i < $pagination['total'] ) and ( $i == ( $page2 + 1 ) ) ) ) : ?>
                        <a href="#" class="inactive">...</a>
                        <?php endif ?>
                        <?php endfor ?>

                        <?php if ( $pagination['total'] != $pagination['page'] ) : ?>
                        <a href="review?page=<?php echo $pagination['next']; ?>">&raquo;</a>
                        <?php endif ?>

                        <?php endif ?>

                        <!-- </div> -->
                    </div>
                </div>
            </div><!-- container -->
        </section><!-- #review -->


    </main>

    <!--==========================
    Footer
  ============================-->
    <?php include 'footer.php';?>



    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- Uncomment below i you want to use a preloader -->
    <!-- <div id="preloader"></div> -->

    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/mobile-nav/mobile-nav.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>

</body>

</html>