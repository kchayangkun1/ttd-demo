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

  if (!isset($_SESSION["cart"])){
    echo "<script> 
            window.history.back(); 
          </script>";
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
                <h3>ตระกร้าสินค้า</h3>
            </header>

        </div>
    </section>
    <!-- #intro -->




    <main id="main">



        <!--==========================
      Services cart
    ============================-->


        <section id="cart-page" class="section-product">
            <div class="container">

                <div class="mar-t">
                    <h2>สินค้าในตระกร้าของคุณ</h2>
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
                                <?php if ( isset($_SESSION["cart"]['num']) and $_SESSION["cart"]['num'] > 0 ) : ?>
                                <tbody>
                                <?php 
                                    $total = 0;
                                    foreach ($_SESSION["cart"]['id'] as $value) : 
                                        $subtotal 	= $_SESSION["cart"]['qty'][$value] * $_SESSION["cart"]['price'][$value];
                                        $total 		+= $subtotal;
								?>
                                    <tr>
                                        <td class="text-center">
                                            <img class="img-cart" src="<?php echo 'assets/images/product/cover/' . $_SESSION['cart']['id'][$value] . '/' . $_SESSION['cart']['img'][$value];?>">
                                        </td>
                                        <td class="td-text"><?php echo $_SESSION["cart"]['name'][$value]; ?></td>
                                        <td class="text-center"><?php echo $_SESSION["cart"]['price'][$value]; ?>.-</td>
                                        <td class="text-center"><?php echo $_SESSION["cart"]['qty'][$value]; ?></td>
                                        <td class="text-center"><?php echo $_SESSION["cart"]['size'][$value]; ?></td>
                                        <td class="text-center"><?php echo number_format( $subtotal ); ?>.-</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" onclick="delCart(<?php echo $_SESSION['cart']['id'][$value]; ?>)" class="tdA" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                        <hr class="height-hr">
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                        <div class="col-md-9">
                            
                            <div class="sand">
                                <h2>เลือกวิธีการขนส่ง</h2>
                                    <select name="dela" id="dela">
                                        <option value="">--กรุณาเลือกการจัดส่ง--</option>
                                        <option value="0">J&T express</option>
                                        <option value="1">เก็บเงินปลายทาง</option>
                                    </select>
                                <!-- <input type="radio" id="dela" name="dela" value="0"> J&T express<br> -->
                                <!-- <input type="radio" id="dela" name="dela" value="1"> เก็บเงินปลายทาง<br> -->
                            </div>
                            <div class=" float-life buttom-text">
                                <a href="">
                                    <button class="button-back ">
                                        << กลับไปซื้อสินค้า </button> </a> <a href="">
                                </a>
                            </div>
                            
                        </div>

                            <div class="col-md-3 text-center ">
                                <div class="back-cart color-black">
                                    <p>ราคารวม &emsp;&emsp;<span id="val"> <?php echo number_format( $total );?> </span> &emsp; บาท</p>
                                </div>
                                <button type="button" onclick="checkOut();" name="btn" class="button-buy">ชำระเงิน</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
        </section>

    </main>

    <!--==========================
    Footer
  ============================-->
    <div class="modal fade" id="myDelCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ยืนยันลบสินค้า</h4>
                </div>
                <div class="modal-body delcart">
                    <form class="form-box delcart-form">
                        <div class="buttons-box clearfix">
                            <input type="hidden" id="dpid" name="dpid" value="">
                            <button class="btn btn-danger">ลบสินค้า</button>
                            <button class="btn btn-default" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>



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
    <script type="text/javascript">
        function delCart(id) {
            $('#dpid').val(id);
            $('#myDelCart').modal('show');
        }

        $(document).on('submit','form.delcart-form',function(){
            $.ajax({
                type 	: 'GET',
                url 	: 'ajaxQuery.php?action=delCart',
                data 	: $('.delcart-form').serialize(),
                success : function(response) {
                    var obj = JSON.parse(response);
                    if (obj.result) {
                        location.reload();
                    }
                }
            });
        });

        function checkOut() {
            var dela = $('#dela').val();

            console.log(dela);
            if(dela == ''){
                alert('กรุณาเลือกการจัดส่ง');
            }else{
                $.ajax({
                    type: 'POST',
                    url: 'ajaxQuery.php',
                    data: {
                        dela: dela,
                        action: 'checkOut'
                    },
                    success: function (response) {
                        var obj = JSON.parse(response);
                            // console.log(obj);
                        if (obj.result) {
                            window.location.href = 'data?id=' + obj.order_id;
                        }
                    }
                });
            }
		}
    </script>
</body>

</html>