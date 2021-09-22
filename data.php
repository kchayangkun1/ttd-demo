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
    $price_list = price_list($_GET['id']);

    if(empty($_GET['id'])){
        header( "location: index" );
        exit(0);	
    }

    if(!empty($_POST))
    {		
        if(payment_add())
        {
			$uid = $_GET['id'];
		    echo '<script>
				window.location.href = "payment?id=' . $uid . '"' . '
                </script>';
            exit;
        }
	}
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

                    <li><a class="size-50" href="cart"><i class="fa fa-shopping-cart " aria-hidden="true"></i> <?php echo ( isset($_SESSION["cart"]['num']) and $_SESSION["cart"]['num'] > 0 ) ? '(' . $_SESSION["cart"]['num'] . ')' : '';?>
                    </a></li>

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
                <h3>สรุปรายการสินค้า</h3>
            </header>

        </div>
    </section>
    <!-- #intro -->

    <main id="main">

        <section id="contact">
            <div class="container">
            <form method="post">
                <div class="row wow fadeInUp">
                    <div class="col-lg-8">
                        <div class="form">
                            <div id="sendmessage">Your message has been sent. Thank you!</div>
                            <div id="errormessage"></div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <label>ชื่อ-นามสกุล<span class="required">*</span></label>
                                        <input type="text" name="fname" class="form-control" id="fname" placeholder="" required />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>เบอร์โทร<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="tel" id="tel" placeholder="" required />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>อีเมล<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="" required />
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
                                        <label>ตำบล<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="mo" id="mo" placeholder="" required />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>อำเภอ / เขต<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="del" id="del" placeholder="" required />
                                        <div class="validation"></div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>จังหวัด<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="jaw" id="jaw" placeholder="" required />
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
                                    <span id="val"> <?php echo $price_detail->order_total; ?> </span>
                                    <input type="hidden" value="<?php echo $price_detail->order_total; ?>" id="psum" name="psum">
                                    <span class="float-right">บาท</span>
                                </p>
                                
                                <p>ราคาค่าจัดส่ง&emsp;&emsp;&emsp;
                                    <?php 
                                        $sumqty = $price_detail->qty;
                                        $deli_type = $price_detail->delivery_type;
                                        $del_order = $price_detail->order_total;
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
                                        <span id="val"> 30 </span>
                                        <input type="hidden" value="<?php echo $bin;?>" id="pda" name="pda">
                                        <span span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 2) && ($sumqty <= 5)){ ?> 
                                        <span id="val"> 50 </span>
                                        <input type="hidden" value="<?php echo $bina;?>" id="pda" name="pda">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 6) && ($sumqty <= 11)){ ?> 
                                        <span id="val"> 100 </span>
                                        <input type="hidden" value="<?php echo $binb;?>" id="pda" name="pda">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 12) &&($sumqty <= 15)){ ?> 
                                        <span id="val"> 130 </span>
                                        <input type="hidden" value="<?php echo $binc;?>" id="pda" name="pda">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 16) && ($sumqty <= 20)){ ?> 
                                        <span id="val"> 160 </span>
                                        <input type="hidden" value="<?php echo $bind;?>" id="pda" name="pda">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if($sumqty > 20){ ?> 
                                        <span id="val"> 200 </span>
                                        <input type="hidden" value="<?php echo $bine;?>" id="pda" name="pda">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>
                                    <?php }else{ ?>
                                        <?php if($del_order <= 400){ ?> 
                                            <span id="val"> 12 </span>
                                            <input type="hidden" value="<?php echo $dela;?>" id="pda" name="pda">
                                            <span span class="float-right">บาท</span>
                                        <?php } ?>

                                        <?php if($del_order > 400){ ?> 
                                            <span id="val"> <?php echo ceil($del_order * $delb); ?> </span>
                                            <input type="hidden" value="<?php echo ceil($del_order * $delb);?>" id="pda" name="pda">
                                            <span span class="float-right">บาท</span>
                                        <?php } ?>
                                    <?php } ?>    
                                </p>
                                
                                <p>ราคารวมทั้งหมด&emsp;&emsp; 
                                    <?php
                                        $sumqty = $price_detail->qty; 
                                        $sumprice = $price_detail->order_total;
                                        $del_order = $price_detail->order_total;
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
                                        <span id="val"> <?php echo $sumprice + $bin; ?> </span>
                                        <input type="hidden" value="<?php echo $sumprice + $bin;?>" id="pdaa" name="pdaa">
                                        <span span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 2) && ($sumqty <= 5)){ ?> 
                                        <span id="val"> <?php echo $sumprice + $bina; ?> </span>
                                        <input type="hidden" value="<?php echo $sumprice + $bina;?>" id="pdaa" name="pdaa">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 6) && ($sumqty <= 11)){ ?> 
                                        <span id="val"> <?php echo $sumprice + $binb; ?> </span>
                                        <input type="hidden" value="<?php echo $sumprice + $binb;?>" id="pdaa" name="pdaa">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 12) &&($sumqty <= 15)){ ?> 
                                        <span id="val"> <?php echo $sumprice + $binc; ?> </span>
                                        <input type="hidden" value="<?php echo $sumprice + $binc;?>" id="pdaa" name="pdaa">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if(($sumqty >= 16) && ($sumqty <= 20)){ ?> 
                                        <span id="val"> <?php echo $sumprice + $bind; ?> </span>
                                        <input type="hidden" value="<?php echo $sumprice + $bind;?>" id="pdaa" name="pdaa">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php if($price_detail->qty > 20){ ?> 
                                        <span id="val"> <?php echo $sumprice + $bine; ?> </span>
                                        <input type="hidden" value="<?php echo $sumprice + $bine;?>" id="pdaa" name="pdaa">
                                        <span class="float-right">บาท</span>
                                    <?php } ?>

                                    <?php }else{ ?>
                                        <?php if($del_order <= 400){ ?> 
                                            <span id="val"> <?php echo $del_order + $dela; ?> </span>
                                            <input type="hidden" value="<?php echo $del_order + $dela;?>" id="pdaa" name="pdaa">
                                            <span span class="float-right">บาท</span>
                                        <?php } ?>

                                        <?php if($del_order > 400){ ?> 
                                            <span id="val"> <?php echo $sumsen; ?> </span>
                                            <input type="hidden" value="<?php echo $sumsen;?>" id="pdaa" name="pdaa">
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