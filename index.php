<?php 
    session_start();
?>
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
  $reviewies_list = reviewies_list();
  $products_sele_list = products_sele_list();
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
            <a class="active" href="index">หน้าแรก</a>
          </li>
          <li><a href="about">เกี่ยวกับเรา</a></li>
          <li class="drop-down pro-nav"><a>สินค้า</a>
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
          <li><a href="review">รีวิวสินค้า</a></li>
          <li><a href="method">วิธีการสั่งซื้อสินค้า</a></li>
          <li><a href="contact">ติดต่อเรา</a></li>


          <li>
            <a class="size-50" href="cart">
              <i class="fa fa-shopping-cart " aria-hidden="true"></i>
              <?php echo ( isset($_SESSION["cart"]['num']) and $_SESSION["cart"]['num'] > 0 ) ?  $_SESSION["cart"]['num'] : '';?>
            </a>
          </li>
        </ul>
      </nav>

    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="img-responsive" src="img/banner.png" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="img-responsive" src="img/banner.png" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="img-responsive" src="img/banner.png" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>




  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <div class="row about-extra">
          <div class="col-lg-6 wow fadeInUp">
            <img src="img/about.png" class="img-responsive about-img" alt="">
          </div>
          <div class="col-lg-6 wow fadeInUp pt-5 pt-lg-0">
            <h4>เกี่ยวกับเรา</h4>
            <p>
              &nbsp;&nbsp;ห้างหุ้นส่วนจำกัด โปรเฟส ซัพพลาย ก่อตั้งกิจการขึ้นเมื่อปี พ.ศ. 2554
              โดยดำเนินธุรกิจมาเป็นเวลากว่า 7 ปี
              ซึ่งทางห้างหุ้นส่วนจำกัดให้บริการรับผลิต และจัดจำหน่ายถุงมือ
              ภายใต้แบรนด์ลิขสิทธิ์ Glove PFS เพื่อรองรับความต้องการของลูกค้าที่มีมา-
              อย่างต่อเนื่อง โดยมีตั้งแต่ถุงมือไนไตร (Nitrile) ถุงมือยางธรรมชาติ (Latex)
              ชนิดมีแป้งและไม่มีแป้ง

            </p>
            <p>
              &nbsp;&nbsp;ถุงมือทุกชนิดภายใต้แบรนด์ลิขสิทธิ์ Glove PFS เป็นสินค้าที่มีคุณภาพ
              ผลิตตรงจากโรงงานและมีมาตรฐานส่งออกทั้งในและนอกประเทศ
              ผ่านกระบวนการตรวจเทสลมรั่วทุกชิ้นก่อนบรรจุลงกล่องหรือถุง เราเน้นถุงมือที่มีคุณภาพในการสวมใส่ ทนทาน
              ใช้งานเบาสบายมือ เพื่อตอบโจทย์ความคุ้มค่าที่มีคุณภาพและราคาที่ย่อมเยาว์
            </p>

            <a href="" class="button-about">Read More >></a>
            <!-- <button type="submit" title="Send Message">Read More >></button> -->

          </div>

          <div class="col-md-12">
            <div class="row">
              <div class=" col-sm-3 col-md-3">
                <div class="icon">
                  <img src="img/icon/a1.png" alt="" class="img-responsive">
                </div>
              </div>
              <div class="col-sm-3 col-md-3">
                <div class="icon">
                  <img src="img/icon/a2.png" alt="" class="img-responsive">
                </div>
              </div>
              <div class="col-sm-3 col-md-3">
                <div class="icon">
                  <img src="img/icon/a3.png" alt="" class="img-responsive">
                </div>
              </div>
              <div class="col-sm-3 col-md-3">
                <div class="icon">
                  <img src="img/icon/a4.png" alt="" class="img-responsive">
                </div>
              </div>
            </div>
          </div>
        </div>



      </div>
    </section><!-- #about -->

    <!--==========================
      Services product
    ============================-->
    <section id="product" class="section-product">
      <div class="container">

        <header class="section-header">
          <h3>สินค้าใหม่</h3>

        </header>

        <div class="row">
          <?php foreach($products_sele_list as $products_sele_detail) : ?>
          <div class="col-md-3 mar-b">
            <div class="card">
              <a href="product-detail">
                <div class="product-text">
                  <img src="assets/images/product/cover/<?php echo $products_sele_detail->id; ?>/<?php echo $products_sele_detail->img_cover; ?>" alt="" class="img-responsive">

                  <h2><?php echo $products_sele_detail->name; ?></h2>
                  <!-- <p>Size S M L</p> -->
                  <h1><?php echo $products_sele_detail->price; ?>.-</h1>
                </div>
              </a>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </section><!-- #product -->

    <!--==========================
      review Section
    ============================-->
    <section id="review" class="wow fadeIn">
      <div class="container-fluid">
        <header class="section-header">
          <h3>รีวิวสินค้า</h3>

        </header>
        <div class="row">
          <?php foreach($reviewies_list as $reviewies_detail) : ?>
          <div class="col-md-4">
            <div class="bg-w">
              <div class="row">
                <div class="col-md-6 ">
                  <img
                    src="assets/images/review/<?php echo $reviewies_detail->id; ?>/<?php echo $reviewies_detail->img_cover; ?>"
                    alt="" class="img-responsive review-img">
                </div>
                <div class="col-md-6 ">
                  <div class="review-text">
                    <h3><?php echo $reviewies_detail->name; ?></h3>
                    <p>รีวิว : <?php echo $reviewies_detail->dsc; ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>

        <div class="text-center">
          <a href="review" class="button-review">View All</a>
        </div>

      </div>
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