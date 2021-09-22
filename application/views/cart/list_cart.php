<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cart | Gloves PFS </title>
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
                <h3>ตระกร้าสินค้า</h3>
            </header>
        </div>
    </section>
    <main id="main">
        <section id="cart-page" class="section-product">
            <div class="container">

                <div class="mar-t">
                    <h2>สินค้าในตระกร้าของคุณ <?php //if(@$_SESSION["cart"]['num'] > 0){ echo '1';}else{ echo '0';} ?></h2>
                </div>
                <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="table-responsive">
                            <table class="table table-bordered table-black">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">รายการ</th>
                                        <th class="text-center" scope="col">ราคา</th>
                                        <th class="text-center" scope="col">จำนวน</th>
                                        <th class="text-center" scope="col">ไซส์</th>
                                        <th class="text-center" scope="col">ราคารวม</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <?php if(isset($_SESSION["cart"]['num']) and $_SESSION["cart"]['num'] > 0) : ?>
                                <tbody>
                                <?php 
                                    $total = 0;
                                    foreach ($_SESSION["cart"]['id'] as $value) : 
                                        $subtotal 	= $_SESSION["cart"]['qty'][$value] * $_SESSION["cart"]['price'][$value];
                                        $total 		+= $subtotal;
								?>
                                    <tr>
                                        <td class="text-center">
                                            <img class="img-cart" src="<?=base_url('./assets/images/product/cover/'.$_SESSION['cart']['id'][$value].'/'.$_SESSION['cart']['img'][$value]);?>">
                                        </td>
                                        <td class="td-text"><?php echo $_SESSION["cart"]['name'][$value]; ?></td>
                                        <td class="text-center"><?php echo $_SESSION["cart"]['price'][$value]; ?>.-</td>
                                        <td class="text-center"><?php echo $_SESSION["cart"]['qty'][$value]; ?></td>
                                        <td class="text-center"><?php echo $_SESSION["cart"]['size'][$value]; ?></td>
                                        <td class="text-center"><?php echo number_format( $subtotal ); ?>.-</td>
                                        <td class="text-center">
                                            <a type="button" onclick="delCart(<?php echo $_SESSION['cart']['id'][$value]; ?>)" class="tdA" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <?php else : ?>
                                    <tbody>
                                        <tr>
                                            <td colspan="6" align="center">ไม่พบสินค้า</td>
                                        </tr>
                                    </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                        <hr class="height-hr">
                    </div>
                    
                    <div class="col-md-12">
                        <div class="row">
                            <?php if(isset($_SESSION["cart"]['num']) and $_SESSION["cart"]['num'] > 0) : ?>
                                <div class="col-md-9">    
                                    <div class="sand">
                                        <h2>เลือกวิธีการขนส่ง</h2>
                                        <select name="dela" id="dela">
                                            <option value="">--กรุณาเลือกการจัดส่ง--</option>
                                            <option value="0">J&T express</option>
                                        </select>
                                    </div>
                                    <div class=" float-life buttom-text"></div>
                                </div>
                                <div class="col-md-3 text-center ">
                                    <div class="back-cart color-black">
                                        <p>ราคารวม &emsp;&emsp;<span id="val"> <?=number_format(@$total,2);?> </span> &emsp; บาท</p>
                                    </div>
                                    <button type="button" onclick="checkOut();" name="btn" class="button-buy">ชำระเงิน</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                </form>
        </section>
    </main>
    <div class="modal fade" id="myDelCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ยืนยันลบสินค้า</h4>
                </div>
                <div class="modal-body delcart">
                    <form class="form-box delcart-form" method="post">
                        <div class="buttons-box clearfix">
                            <input type="hidden" id="dpid" name="dpid" value="">
                            <button type="button" onclick="delItem()" class="btn btn-danger">ลบสินค้า</button>
                            <button class="btn btn-default" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
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
    <script type="text/javascript">
        
        function delCart(id) {
            $('#dpid').val(id);
            $('#myDelCart').modal('show');
        }

        function delItem() {
            const cart_pid = $('#dpid').val();
                $.ajax({
                type 	: 'POST',
                url     : '<?=base_url("Cart/delCart/"); ?>',
                data 	: {dpid:cart_pid, action:'delcartItem', '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash(); ?>'},
                success : function(response) {
                    var obj = JSON.parse(response);
                    if (obj.result) {
                        location.reload();
                    }
                }
            });
        }

        function checkOut() {
            var dela = $('#dela').val();
            if(dela == ''){
                alert('กรุณาเลือกการจัดส่ง');
            }else{
                $.ajax({
                    type: 'POST',
                    url     : '<?=base_url("Cart/checkOut/"); ?>',
                    data: {dela: dela, action: 'checkOut', '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash(); ?>'},
                    success: function (response) {
                        var obj = JSON.parse(response);
                        if (obj.result) {
                            window.location.href = '<?=base_url('Cart/details/?id=');?>' + obj.order_id;
                        }
                    }
                });
            }
		}
    </script>
</body>

</html>