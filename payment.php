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
<?PHP 
    include "config/init.php";
    $cats_list = cat_list();
    $orderies_list = orderies_list($_GET['id']);

    if(empty($_GET['id'])){
        header( "location: index" );
        exit(0);	
    }

    if(!empty($_POST))
    {		
        if(pay_add())
        {
            echo '<script>
                alert("ชำระเงินสำเร็จ ขอบคุณที่ใช้บริการ");
				window.location.href = "index"
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
                    <li><a href="contact">ติดต่อเรา</a></li>

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
                                <p>ชื่อ-นามสกุล : <?php echo $orderies_list[0]->customer; ?></p>
                                <p>เบอร์โทร : <?php echo $orderies_list[0]->order_tel; ?></p>
                                <p>ที่อยู่ : <?php echo $orderies_list[0]->order_address; ?></p>
                                <p>ตำบล : <?php echo $orderies_list[0]->order_mo; ?></p>
                                <p>อำเภอ : <?php echo $orderies_list[0]->order_del; ?></p>
                                <p>จังหวัด : <?php echo $orderies_list[0]->order_jaw; ?></p>
                                <p>รห้สไปรยณีย์ : <?php echo $orderies_list[0]->order_pos; ?></p>
                            </div>
                            <div class="col-md-5">
                                <p>เลขออร์เดอร์ : <?php echo $orderies_list[0]->order_no; ?></p>
                                <div class="data ">
                                    <div class="back-cart color-black ">
                                        <p>ราคาสินค้า&emsp;&emsp;&emsp;&emsp; 
                                            <span id="val"> <?php echo $orderies_list[0]->order_total; ?></span>
                                            <span class="float-right">บาท</span>
                                        </p>

                                        <p>ราคาค่าจัดส่ง&emsp;&emsp;&emsp; 
                                            <span id="val"> <?php echo $orderies_list[0]->order_delivery; ?> </span>
                                            <span class="float-right">บาท</span>
                                        </p>

                                        <p>ราคารวมทั้งหมด&emsp;&emsp; 
                                            <span id="val"> <?php echo $orderies_list[0]->order_smprice; ?> </span>
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
                                    <img src="img/cradit/kbang.png" alt="" class="icon-cadit">
                                    <p>เลขบัญชี : 014-1-574760</p>
                                </div>

                                <div class="cadit">
                                    <img src="img/cradit/scb.png" alt="" class="icon-cadit">
                                    <p>เลขบัญชี : 406-3-553004</p>
                                </div>

                                <div class="cadit">
                                    <img src="img/cradit/kb.png" alt="" class="icon-cadit">
                                    <p>เลขบัญชี : 868-0-118563</p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">

                                <img src="img/pay.jpg" alt="" class="img-pay">

                            </div>
                        </div>
                    </div>

                    <!-- 2 -->

                    <div class="payment-p pay-pad ">
                        <div class="text-center">
                            <div class="payment-text">
                                <h2>แจ้งชำระเงิน</h2>

                            </div>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form">
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label>วันที่ชำระเงิน<span class="required">*</span></label>
                                                <input type="text" name="dates" class="form-control" id="dates"
                                                    placeholder="" required />
                                                <div class="validation"></div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>เวลาชำระเงิน<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="times" id="times"
                                                    placeholder="" required />
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
                                    <input type="hidden" name="order_id" value="<?php echo $orderies_list[0]->id; ?>">
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
    <script src="js/script.js"></script>
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