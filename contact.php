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
                                <li><a href="product?id=<?php echo $catsub_detail->sub_id; ?>"><?php echo $catsub_detail->subcate_name; ?></a></li>
                                <?php endforeach ?>
                                </ul>
                            
                            </li>
                            <?php endforeach ?> 
                        </ul>
                    </li>
                    <li><a href="review">รีวิวสินค้า</a></li>
                    <li><a href="method">วิธีการสั่งซื้อสินค้า</a></li>
                    <li><a class="active" href="contact">ติดต่อเรา</a></li>

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
                <h3>ติดต่อเรา</h3>
            </header>

        </div>
    </section>
    <!-- #intro -->

    <main id="main">

        <section id="contact">
            <div class="container">
                <div class="row wow fadeInUp">

                    <div class="col-lg-6">
                        <div class="section-header">
                            <h3>ที่อยู่</h3>
                            <p>สำนักงานใหญ่ เลขที่ 500/12 หมู่บ้านวงศ์ทอง<br>
                                หมู่ที่ 1 ถนนฐานุตดมอนุสรณ์ ตำบลควนลัง<br>
                                อำเภอหาดใหญ่ จังหวัดสงขลา 90110</p>
                        </div>
                        <div class="section-header contact-tel">
                            <h3>ติดต่อสอบถามเพิ่มเติม </h3>
                            <p>โทร. <a target=”_blank” href="tel:0864884291">086-4884291</a> คุณฎาร์</p>
                            <p>โทร. <a target=”_blank” href="tel:0864884292">086-4884292</a> คุณอาร์ม</p>
                            <p>โทร. <a target=”_blank” href="tel:0980842491">098-0842491</a> คุณแนน</p>


                        </div>
                        <div class="map mb-4 mb-lg-0">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.3641878761564!2d100.42632581525137!3d6.966292819788777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304cd81000000001%3A0x51ab40928aa2db69!2z4Lir4LiI4LiBLiDguYLguJvguKPguYDguJ_guKog4LiL4Lix4Lie4Lie4Lil4Liy4Lii!5e0!3m2!1sth!2sth!4v1610775488651!5m2!1sth!2sth"
                                width="100%" height="260" frameborder="0" style="border:0;" allowfullscreen=""
                                aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="section-header">
                            <h3>ส่งข้อความ</h3>
                        </div>


                        <div class="form">
                            <div id="sendmessage">Your message has been sent. Thank you!</div>
                            <div id="errormessage"></div>
                            <form action="" method="post" role="form" class="contactForm">
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อ"
                                            data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="อีเมล" data-rule="email"
                                            data-msg="Please enter a valid email" />
                                        <div class="validation"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" id="subject"
                                        placeholder="เบอร์โทร" data-rule="minlen:4"
                                        data-msg="Please enter at least 8 chars of subject" />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="5" data-rule="required"
                                        data-msg="Please write something for us" placeholder="ข้อความ"></textarea>
                                    <div class="validation"></div>
                                </div>
                                <div class=""><button type="submit" title="Send Message">ส่งข้อความ</button></div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- #contact -->



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