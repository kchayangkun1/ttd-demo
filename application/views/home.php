  <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Gloves PFS </title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords" content="glovepfs.com">
  <meta content="" name="description" content="glovepfs.com">

  <link href="<?=base_url('./assets/img/logo.png');?>" rel="icon">
  <link href="<?=base_url('./assets/img/logo.png');?>" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700"
    rel="stylesheet">
  <link href="<?=base_url('./assets/css/bootstrap.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('./assets/css/font-awesome.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('./assets/css/animate.css');?>" rel="stylesheet">
  <link href="<?=base_url('./assets/lib/ionicons/css/ionicons.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('./assets/lib/owlcarousel/assets/owl.carousel.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('./assets/lib/lightbox/css/lightbox.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('./assets/css/style.css');?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5ZL2NTSB96"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-5ZL2NTSB96');
</script>
</head>
<body>
  <?php 
    $this->load->model('Cart_model');
?>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="img-responsive" src="<?=base_url('./assets/img/banner.png');?>" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="img-responsive" src="<?=base_url('./assets/img/banner.png');?>" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="img-responsive" src="<?=base_url('./assets/img/banner.png');?>" alt="Third slide">
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
    <section id="about">
      <div class="container">

        <div class="row about-extra">
          <div class="col-lg-6 wow fadeInUp">
            <img src="<?=base_url('./assets/img/about.jpg');?>" class="img-responsive about-img" alt="">
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
            <a href="<?=base_url('about/')?>" class="button-about">Read More >></a>
          </div>

          <div class="col-md-12">
            <div class="row">
              <div class=" col-sm-3 col-md-3">
                <div class="icon">
                  <img src="<?=base_url('./assets/img/icon/a1.png');?>" alt="" class="img-responsive">
                </div>
              </div>
              <div class="col-sm-3 col-md-3">
                <div class="icon">
                  <img src="<?=base_url('./assets/img/icon/a2.png');?>" alt="" class="img-responsive">
                </div>
              </div>
              <div class="col-sm-3 col-md-3">
                <div class="icon">
                  <img src="<?=base_url('./assets/img/icon/a3.png');?>" alt="" class="img-responsive">
                </div>
              </div>
              <div class="col-sm-3 col-md-3">
                <div class="icon">
                  <img src="<?=base_url('./assets/img/icon/a4.png');?>" alt="" class="img-responsive">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="product" class="section-product">
      <div class="container">
        <header class="section-header">
          <h3>สินค้าใหม่</h3>
        </header>
        <div class="row">
          <?php foreach($products_sele_list as $products_sele_detail) : ?>
          <div class="col-md-3 mar-b">
            <div class="card">
              <a href="<?=base_url('product/detail/'.$products_sele_detail['id']);?>">
                <div class="product-text">
                  <img src="<?=base_url('./assets/images/product/cover/'.$products_sele_detail['id'].'/'.$products_sele_detail['img_cover']);?>" alt="" class="img-responsive">
                  <h2><?=$products_sele_detail['name']; ?></h2>
                  <h1><?=$products_sele_detail['price']; ?>.-</h1>
                </div>
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
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
                  <img src="<?=base_url('./assets/images/review/'.$reviewies_detail['id'].'/'.$reviewies_detail['img_cover']);?>" class="img-responsive review-img">
                </div>
                <div class="col-md-6 ">
                  <div class="review-text">
                    <h3><?=$reviewies_detail['name']; ?></h3>
                    <p>รีวิว : <?=$reviewies_detail['dsc']; ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="text-center">
          <a href="<?=base_url('review/page/');?>" class="button-review">View All</a>
        </div>
      </div>
    </section>
  </main>

  <?php $this->load->view('footer'); ?>
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <script src="<?=base_url('./assets/lib/jquery/jquery.min.js');?>"></script>
  <script src="<?=base_url('./assets/lib/jquery/jquery-migrate.min.js');?>"></script>
  <script src="<?=base_url('./assets/lib/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
  <script src="<?=base_url('./assets/lib/easing/easing.min.js');?>"></script>
  <script src="<?=base_url('./assets/lib/mobile-nav/mobile-nav.js');?>"></script>
  <script src="<?=base_url('./assets/lib/wow/wow.min.js');?>"></script>
  <script src="<?=base_url('./assets/lib/waypoints/waypoints.min.js');?>"></script>
  <script src="<?=base_url('./assets/lib/counterup/counterup.min.js');?>"></script>
  <script src="<?=base_url('./assets/lib/owlcarousel/owl.carousel.min.js');?>"></script>
  <script src="<?=base_url('./assets/lib/isotope/isotope.pkgd.min.js');?>"></script>
  <script src="<?=base_url('./assets/lib/lightbox/js/lightbox.min.js');?>"></script>
  <script src="<?=base_url('./assets/contactform/contactform.js');?>"></script>
  <script src="<?=base_url('./assets/js/main.js');?>"></script>
</body>
</html>