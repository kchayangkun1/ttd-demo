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
                            <form action="<?=base_url('contact/send');?>" method="post" role="form" class="contactForm">
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อ"
                                            data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                        <div class="validation"></div>
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" 
                                    value="<?=$this->security->get_csrf_hash();?>" >
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
  <!--========================== Footer ============================-->
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
