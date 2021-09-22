<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Gloves PFS </title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <!--  -->
  <link href="<?=base_url('./assets/img/logo.png');?>" rel="icon">
  <link href="<?=base_url('./assets/img/logo.png');?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700"
    rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <!--  -->
  <link href="<?=base_url('./assets/css/bootstrap.min.css');?>" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?=base_url('./assets/css/font-awesome.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('./assets/css/animate.css');?>" rel="stylesheet">
  <link href="<?=base_url('./assets/lib/ionicons/css/ionicons.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('./assets/lib/owlcarousel/assets/owl.carousel.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('./assets/lib/lightbox/css/lightbox.min.css');?>" rel="stylesheet">

  <!-- Main Stylesheet File -->
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
                                <img src="<?=base_url('assets/images/review/'.$review_detail['id'].'/'.$review_detail['img_cover']);?>" class="img-responsive ">
                                </div>
                                <div class="col-md-6 ">
                                    <div class="reviewp-text">
                                        <h3><?=$review_detail['name']; ?></h3>
                                        <p>รีวิว : <?=$review_detail['dsc']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div><!-- row -->
            <!-- pagination -->
            <div class="row mt-4 mb-4">
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="container">
                        <?=$pagination;?>
                    </div>
                </div>
            </div>
            <!-- end -->
            </div><!-- container -->
        </section><!-- #review -->


    </main>

  <?php $this->load->view('footer'); // footer ?>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<!-- Uncomment below i you want to use a preloader -->
<!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
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
<!-- Contact Form JavaScript File -->
<script src="<?=base_url('./assets/contactform/contactform.js');?>"></script>

<!-- Template Main Javascript File -->
<script src="<?=base_url('./assets/js/main.js');?>"></script>

</body>

</html>