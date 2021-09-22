<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cart | Gloves PFS </title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  
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
    <main id="main">

        <section id="contact">
            <div class="container">
            <form action="<?=base_url('cart/shipping/');?>" method="post">
                <div class="row wow fadeInUp">
                    <div class="col-lg-8">
                        <div class="form">
                            <div id="sendmessage">Your message has been sent. Thank you!</div>
                            <div id="errormessage"></div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" 
                    value="<?=$this->security->get_csrf_hash();?>" >
                                        <label>ชื่อ-นามสกุล<span class="required">*</span></label>
                                        <input type="hidden" name="orderid" value="<?=$this->security->xss_clean($this->input->get('id', TRUE))?>">
                                        <input type="text" name="fname" class="form-control" id="fname" placeholder="" required />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>เบอร์โทร<span class="required">*</span></label>
                                        <input type="text" class="form-control ant-input" name="tel" id="phn-number" placeholder="XXX XXX-XXXX" data-inputmask-mask="(999) 999-9999" required />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>อีเมล<span class="required">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="" required />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>ที่อยู่<span class="required">*</span></label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" rows="5" placeholder=""></textarea>
                                            <div class="validation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>จังหวัด<span class="required">*</span></label>
                                        <select id="inputProvince" name="inputProvince" class="form-control" required>
                                            <option value="">กรุณาเลือกจังหวัด</option>
                                            <?php
                                                foreach($provinces as $val_pro) : ?>
                                                    <option name="inputProvince" value="<?=$val_pro['province_id']?>" ><?=$val_pro['province_th']?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <div class="validation"></div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>อำเภอ / เขต<span class="required">*</span></label>
                                        <select id="inputDistrict" name="inputDistrict" class="form-control" required>
                                            
                                        </select>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>ตำบล<span class="required">*</span></label>
                                        <select id="inputTumbon" name="inputTumbon" class="form-control" required>
                                            
                                        </select>
                                        <div class="validation"></div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>รหัสไปรษณีย์<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="pos" id="pos" placeholder="" required />
                                        <div class="validation"></div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="data ">
                            <?php foreach($price_list as $price_detail) : ?>
                            <div class="back-cart color-black ">
                                <p>ราคาสินค้า&emsp;&emsp;&emsp;&emsp; 
                                    <span id="val"> <?=number_format($price_detail['order_total'],2); ?> </span>
                                    <input type="hidden" value="<?=$price_detail['order_total']; ?>" id="psum" name="psum">
                                    <span class="float-right">บาท</span>
                                </p>
                                
                                <p>ราคาค่าจัดส่ง&emsp;&emsp;&emsp;
                                    <?php 
                                        $sumqty = $price_detail['qty'];
                                        $deli_type = $price_detail['delivery_type'];
                                        $del_order = $price_detail['order_total'];
                                        $bin = 30;
                                        $bina = 50;
                                        $binb = 100;
                                        $binc = 130;
                                        $bind = 160;
                                        $bine = 200;
                                        $dela = 12;
                                        $delb = 0.03;   
                                    ?>
                                    <?php if($deli_type == 0){ ?>
                                    <?php if($sumqty == 1){ ?> 
                                        <span id="val"><?=number_format('30',2)?> </span>
                                        <input type="hidden" value="<?=$bin;?>" id="shippingprice" name="shippingprice">
                                        <span span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 2) && ($sumqty <= 5)){ ?> 
                                        <span id="val"><?=number_format('50',2);?> </span>
                                        <input type="hidden" value="<?=$bina;?>" id="shippingprice" name="shippingprice">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 6) && ($sumqty <= 11)){ ?> 
                                        <span id="val"><?=number_format('100',2);?> </span>
                                        <input type="hidden" value="<?= $binb;?>" id="shippingprice" name="shippingprice">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 12) &&($sumqty <= 15)){ ?> 
                                        <span id="val"><?=number_format('130',2);?> </span>
                                        <input type="hidden" value="<?=$binc;?>" id="shippingprice" name="shippingprice">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 16) && ($sumqty <= 20)){ ?> 
                                        <span id="val"> <?=number_format('160',2);?> </span>
                                        <input type="hidden" value="<?=$bind;?>" id="shippingprice" name="shippingprice">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if($sumqty > 20){ ?> 
                                        <span id="val"> <?=number_format('200',2);?> </span>
                                        <input type="hidden" value="<?=$bine;?>" id="shippingprice" name="shippingprice">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>
                                    <?php }else{ ?>
                                        <?php if($del_order <= 400){ ?> 
                                            <span id="val"> <?=number_format('12',2);?> </span>
                                            <input type="hidden" value="<?=$dela;?>" id="shippingprice" name="shippingprice">
                                            <span span class="float-right">บาท</span>
                                        <?php } ?>

                                        <?php if($del_order > 400){ ?> 
                                            <span id="val"> <?=ceil($del_order * $delb); ?> </span>
                                            <input type="hidden" value="<?=ceil($del_order * $delb);?>" id="shippingprice" name="shippingprice">
                                            <span span class="float-right">บาท</span>
                                        <?php } ?>
                                    <?php } ?>    
                                </p>
                                
                                <p>ราคารวมทั้งหมด&emsp;&emsp; 
                                    <?php
                                        $sumqty = $price_detail['qty']; 
                                        $sumprice = $price_detail['order_total'];
                                        $del_order = $price_detail['order_total'];
                                        $bin = 30;
                                        $bina = 50;
                                        $binb = 100;
                                        $binc = 130;
                                        $bind = 160;
                                        $bine = 200;
                                        $dela = 12;
                                        $delb = 0.03;
                                        $sumpn = ceil($del_order * $delb);
                                        $sumsen = $sumpn + $del_order;
                                    ?>
                                    <?php if($deli_type == 0){ ?>
                                    <?php if($sumqty == 1){ ?> 
                                        <span id="val"> <?=number_format($sumprice + $bin,2); ?> </span>
                                        <input type="hidden" value="<?=$sumprice + $bin;?>" id="grandtotal" name="grandtotal">
                                        <span span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 2) && ($sumqty <= 5)){ ?> 
                                        <span id="val"> <?=number_format($sumprice + $bina,2); ?> </span>
                                        <input type="hidden" value="<?=$sumprice + $bina;?>" id="grandtotal" name="grandtotal">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 6) && ($sumqty <= 11)){ ?> 
                                        <span id="val"> <?=number_format($sumprice + $binb,2); ?> </span>
                                        <input type="hidden" value="<?=$sumprice + $binb;?>" id="grandtotal" name="grandtotal">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 12) &&($sumqty <= 15)){ ?> 
                                        <span id="val"> <?=number_format($sumprice + $binc,2); ?> </span>
                                        <input type="hidden" value="<?=$sumprice + $binc;?>" id="grandtotal" name="grandtotal">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 16) && ($sumqty <= 20)){ ?> 
                                        <span id="val"> <?=number_format($sumprice + $bind,2); ?> </span>
                                        <input type="hidden" value="<?=$sumprice + $bind;?>" id="grandtotal" name="grandtotal">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if($price_detail['qty'] > 20){ ?> 
                                        <span id="val"> <?=number_format($sumprice + $bine,2); ?> </span>
                                        <input type="hidden" value="<?=$sumprice + $bine;?>" id="grandtotal" name="grandtotal">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php }else{ ?>
                                        <?php if($del_order <= 400){ ?> 
                                            <span id="val"> <?=number_format($del_order + $dela,2); ?> </span>
                                            <input type="hidden" value="<?=$del_order + $dela;?>" id="grandtotal" name="grandtotal">
                                            <span span class="float-right">บาท</span>
                                        <?php } ?>

                                        <?php if($del_order > 400){ ?> 
                                            <span id="val"> <?=number_format($sumsen,2); ?> </span>
                                            <input type="hidden" value="<?=$sumsen;?>" id="grandtotal" name="grandtotal">
                                            <span span class="float-right">บาท</span>
                                        <?php } ?>
                                    <?php } ?> 
                                </p>
                            </div>
                            <?php endforeach ?>
                        </div>
                        <div class="text-center da-t">
                            <button type="submit" name="btn" id="btn" class="button-data">ชำระเงิน</button>
                        </div>
                    </div>
                </div>
            </form>
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
    <script>
    $(document).ready(function () {
        // inputProvince to print Aumphur
        $("#inputDistrict").html('<option value="">-- กรุณาเลือก เขต/อำเภอ --</option>');
        $("#inputProvince").on('change', function(){
            const proId = $("#inputProvince").val();
            $("#inputTumbon").html('<option value="">-- แขวง/ตำบล --</option>');
            $.ajax({
                type 	: 'POST',
                url 	: '<?=base_url("province/getAumphur"); ?>',
                data 	: {proid:proId, action:'changeProv', '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash(); ?>'},
                success: function(data) {
                    $("#inputDistrict").html(data);   	
                }
            });
        });

        // get val Aumphur val id to print Tumbon
        $("#inputTumbon").html('<option value="">-- แขวง/ตำบล --</option>');
        $("#inputDistrict").on('change', function(){
            const districtId = $("#inputDistrict").val();
            $.ajax({
                type 	: 'POST',
                url 	: '<?=base_url("province/getTumbon"); ?>',
                data 	: {aumphurId:districtId, action:'changeAumphur', '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash(); ?>'},
                success: function(data) {
                    $("#inputTumbon").html(data);   	
                }
            });
        });
        // 
       
        //  
    });
    jQuery( '#phn-number[data-inputmask-mask]' ).inputmask();

  </script>
</body>
</html>