<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Aboutus | Gloves PFS </title>
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
  <section id="intro" class="clearfix">
    <div class="container">
      <header class="section-header">
        <h3>วิธีการสั่งซื้อสินค้า</h3>
      </header>
    </div>
  </section>
  <main id="main">
    <section id="contact">
      <div class="container">
        <div class="row wow fadeInUp">
          <img src="<?=base_url('./assets/img/pfs.jpg');?>" alt="" class="img-responsive">
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