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
  <link rel="shortcut icon" href="<?=base_url('./assets/img/logo.png');?>">
  <link rel="apple-touch-icon" href="<?=base_url('./assets/img/logo.png');?>">

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
                <h3>สรุปรายการสินค้า</h3>
            </header>
        </div>
    </section>
    <!-- #intro -->
    <main id="main">
        <section id="payment" class="section-payment">
            <div class="container">
                <div class="row wow fadeInUp">
                    <!-- 1 -->
                    <div class="payment-p pay-pad">
                        <div class="row ">
                            <div class="col-md-7">
                                <p>ชื่อ-นามสกุล : <?=$orderies_list[0]['customer']; ?></p>
                                <p>เบอร์โทร : <?=$orderies_list[0]['order_tel']; ?></p>
                                <p>ที่อยู่ : <?=$orderies_list[0]['order_address']; ?></p>
                                <p>แขวง/ตำบล : <?=$orderies_list[0]['tambon_th']; ?></p>
                                <p>เขต/อำเภอ : <?=$orderies_list[0]['district_th']; ?></p>
                                <p>จังหวัด : <?=$orderies_list[0]['province_th']; ?></p>
                                <p>รห้สไปรษณีย์ : <?=$orderies_list[0]['order_pos']; ?></p>
                            </div>
                            <div class="col-md-5">
                                <p>เลขที่ออร์เดอร์ : <?=$orderies_list[0]['order_no']; ?></p>
                                <div class="data ">
                                    <div class="back-cart color-black ">
                                        <p>ราคาสินค้า&emsp;&emsp;&emsp;&emsp; 
                                            <span id="val"> <?=number_format($orderies_list[0]['order_total'],2); ?></span>
                                            <span class="float-right">บาท</span>
                                        </p>
                                        <p>ราคาค่าจัดส่ง&emsp;&emsp;&emsp; 
                                            <span id="val"> <?=number_format($orderies_list[0]['order_delivery'],2); ?> </span>
                                            <span class="float-right">บาท</span>
                                        </p>
                                        <p>ราคารวมทั้งหมด&emsp;&emsp; 
                                            <span id="val"> <?=number_format($orderies_list[0]['order_smprice'],2); ?> </span>
                                            <span class="float-right">บาท</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="payment-text">
                                <h2>ชำระสินค้า</h2>
                                <p>ชื่อบัญชี : สุชฏาร์ นะหีม</p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="cadit">
                                    <img src="<?=base_url('./assets/img/cradit/kbang.png');?>" alt="" class="icon-cadit">
                                    <p>เลขบัญชี : 014-1-574760</p>
                                </div>
                                <div class="cadit">
                                    <img src="<?=base_url('./assets/img/cradit/scb.png');?>" alt="" class="icon-cadit">
                                    <p>เลขบัญชี : 406-3-553004</p>
                                </div>
                                <div class="cadit">
                                    <img src="<?=base_url('./assets/img/cradit/kb.png');?>" alt="" class="icon-cadit">
                                    <p>เลขบัญชี : 868-0-118563</p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="<?=base_url('./assets/img/pay.jpg');?>" alt="" class="img-pay">
                            </div>
                        </div>
                    </div>
                    <div class="payment-p pay-pad ">
                        <div class="text-center">
                            <div class="payment-text">
                                <h2>แจ้งชำระเงิน</h2>
                            </div>
                        </div>
                        <form action="<?=base_url('payment/pay_add/');?>" method="post" enctype="multipart/form-data">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form">
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label>วันที่ชำระเงิน<span class="required">*</span></label>
                                                <input type="text" name="dates" class="form-control" id="dates"
                                                    placeholder="เช่น 30/12/2021" required />
                                                <div class="validation"></div>
                                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" 
                    value="<?=$this->security->get_csrf_hash();?>" >
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>เวลาชำระเงิน<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="times" id="times"
                                                    placeholder="เช่น 13:30" required />
                                                <div class="validation"></div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>จำนวนเงิน<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="summoney" id="summoney"
                                                    placeholder="" required />
                                                <div class="validation"></div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>หลักฐานการโอนเงิน<span class="required">*</span></label>
                                    <div class="file-upload">
                                        <button class="btn btn-secondary" type="button"
                                            onclick="$('.file-upload-input').trigger( 'click' )"><i
                                                class="fa fa-file-image-o" aria-hidden="true"></i>&ensp;
                                            อัพโหลดสลิปโอนเงินที่นี่</button>
                                        <input class="file-upload-input" type="file" id="slipImg" name="slipImg"
                                            required onchange="readURL(this);" accept="png jpg" />
                                        <div class="image-upload-wrap" style="display:none">
                                            <div class="image-title-wrap"><button type="button" onclick="removeUpload()"
                                                    class="remove-image">X</button></div>
                                            <img class="file-upload-image img-responsive" src="#" alt="your image" />
                                        </div>
                                    </div>
                                    <input type="hidden" name="order_id" value="<?=$orderies_list[0]['id']; ?>">
                                    <input type="hidden" name="timestamp" id="timestamp" value="<?=$orderies_list[0]['is_timestamp'];?>">
                                    <div class="text-center">
                                        <button type="submit" class="button-payment mar-t">ยืนยันการชำระเงิน</button>
                                    </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section><!-- #contact -->
    </main>
  <?php $this->load->view('footer'); // footer ?>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="<?=base_url('./assets/lib/jquery/jquery.min.js');?>"></script>
<!-- <script src="<?//=base_url('./assets/lib/jquery/jquery-migrate.min.js');?>"></script> -->
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
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

<!-- Template Main Javascript File -->
<script src="<?=base_url('./assets/js/main.js');?>"></script>
<script src="<?=base_url('./assets/js/script.js');?>"></script>
    <script>
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 150) {
                $('#signup').addClass('show')
            } else {
                $('#signup').removeClass('show')
            }
        });
    </script>

</body>

</html>