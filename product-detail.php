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
  $producties_list = producties_list($_GET['id']);
  $products_img_list = products_img_list($_GET['id']);
  $rands_list = rands_list();
  
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
                    <li class="drop-down pro-nav"><a class="active">สินค้า</a>
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
                <h3><?php echo $producties_list[0]->name; ?></h3>
            </header>

        </div>
    </section>
    <!-- #intro -->

    <main id="main">

        <!--==========================
      Services product detail
    ============================-->
        <section id="detail" class="section-product">
            <div class="container">
                <form method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <?php foreach($products_img_list as $products_img_detail) : ?>
                        <div class="mySlides">
                            <img src="assets/images/product/<?php echo $products_img_detail->product_id; ?>/<?php echo $products_img_detail->img_name; ?>"
                                class="img-responsive">
                        </div>
                        <?php endforeach ?>

                        <a class="prev" onclick="plusSlides(-1)">❮</a>
                        <a class="next" onclick="plusSlides(1)">❯</a>


                        <div class="row">
                            <div class="container">
                                <?php foreach($products_img_list as $products_img_detailies) : ?>
                                <div class="column">
                                    <img class="demo cursor"
                                        src="assets/images/product/<?php echo $products_img_detailies->product_id; ?>/<?php echo $products_img_detailies->img_name; ?>"
                                        style="width:100%" onclick="currentSlide(1)">
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-text">
                            <h2><?php echo $producties_list[0]->name; ?></h2>
                            <p><?php echo nl2br($producties_list[0]->dsc); ?></p>
                            <h3>ราคา : <?php echo number_format($producties_list[0]->price, 2); ?>.-</h3>

                            <div class="input-append">
                                <h4 class="float-left">Size :&emsp; </h4>
                                <select name="pets" id="pets">
                                    <option value="">--กรุณาเลือกไซส์--</option>
                                    <?php foreach($producties_list as $producties_d) : ?>
                                        <?php if($producties_d->size_xs != ""){ ?>
                                            <option value="<?php echo $producties_d->size_xs; ?>"><?php echo $producties_d->size_xs; ?></option>
                                        <?php } ?>
                                        <?php if($producties_d->size_s != ""){ ?>
                                            <option value="<?php echo $producties_d->size_s; ?>"><?php echo $producties_d->size_s; ?></option>
                                        <?php } ?>
                                        <?php if($producties_d->size_m != ""){ ?>
                                            <option value="<?php echo $producties_d->size_m; ?>"><?php echo $producties_d->size_m; ?></option>
                                        <?php } ?>
                                        <?php if($producties_d->size_l != ""){ ?>
                                            <option value="<?php echo $producties_d->size_l; ?>"><?php echo $producties_d->size_l; ?></option>
                                        <?php } ?>
                                        <?php if($producties_d->size_xl != ""){ ?>
                                            <option value="<?php echo $producties_d->size_xl; ?>"><?php echo $producties_d->size_xl; ?></option>
                                        <?php } ?>
                                        <?php if($producties_d->size_xs == "" && $producties_d->size_s == "" && $producties_d->size_m == "" && $producties_d->size_l == "" && $producties_d->size_xl == ""){ ?>
                                            <option>--กรุณาติดต่อเจ้าของ เพื่อทำการเพิ่มไซส์--</option>
                                        <?php } ?>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="input-append">
                                <h4 class="float-left">จำนวน :&emsp; </h4>
                                <button class="btn btn-mini incr-btn" type="button" data-action="decrease"> - </button>
                                <input class="span1 text-center quantity" id="quantity" name="quantity"
                                    style="max-width:34px" size="16" type="text" value="1" readonly>
                                <button class="btn btn-mini incr-btn" type="button" data-action="increase"> + </button>
                            </div>
                            
                            <input type="hidden" value="<?php echo $_GET['id'];?>" id="pid" name="pid">
                            <button class="button-detail" type="button" onclick="addCart()"> หยิบใส่ตะกร้า </button>


                        </div>
                    </div>

                    <div class="col-md-12 mar-t">

                        <div class="text-center mar-t contact-detail">
                            <h2>สินค้าที่เกี่ยวข้อง</h2>
                        </div>
                        <div class="row">
                            <?php foreach($rands_list as $rands_detail) : ?>
                            <div class="col-md-3 mar-b">
                                <div class="card">
                                    <a href="product-detail?id=<?php echo $rands_detail->id; ?>">
                                        <div class="product-text">
                                            <img src="assets/images/product/cover/<?php echo $rands_detail->id; ?>/<?php echo $rands_detail->img_cover; ?>" alt="" class="img-responsive">

                                            <h2><?php echo $rands_detail->name; ?></h2>
                                            <!-- <p>Size S M L</p> -->
                                            <h1><?php echo $rands_detail->price; ?>.-</h1>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </section><!-- #product -->




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

    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 2000); // Change image every 2 seconds
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            // var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            // captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>

    <script type="text/javascript">
        $(".incr-btn").on("click", function (e) {
            var $button = $(this);
            var oldValue = $button.parent().find('.quantity').val();
            $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
            if ($button.data('action') == "increase") {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below 1
                if (oldValue > 1) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 1;
                    $button.addClass('inactive');
                }
            }
            $button.parent().find('.quantity').val(newVal);
            e.preventDefault();

        });

        function addCart() {
            var pid = $('#pid').val();
            var qty = $('#quantity').val();
            var pets = $('#pets').val();

            console.log(pid + ' : ' + qty);
            if((pets == '')){
                alert('กรุณาเลือกไซส์');
            }else{
                $.ajax({
                    type: 'GET',
                    url: 'ajaxQuery.php',
                    data: {
                        pid: pid,
                        qty: qty,
                        pets: pets,
                        action: 'addCart'
                    },
                    crossDomain: true,
                    success: function (response) {
                        var obj = JSON.parse(response);
                        if (obj.result) {
                            location.reload();
                        }
                    }
                });
            }
        }
    </script>
</body>

</html>