<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="bootstrap admin template">
	<meta name="author" content="">

	<title>All Order | Rogue Coffee </title>

	<link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
	<link rel="shortcut icon" href="../assets/images/favicon.ico">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="vendor/summernote/summernote-bs4.css">
	<link rel="stylesheet" href="assets/css/bootstrap-extend.css">
	<link rel="stylesheet" href="assets/css/site.css">
	<link rel="stylesheet" href="assets/css/order.css">

	<!-- Plugins -->
	<link rel="stylesheet" href="vendor/animsition/animsition.css">
	<link rel="stylesheet" href="vendor/asscrollable/asScrollable.css">
	<link rel="stylesheet" href="vendor/switchery/switchery.css">
	<link rel="stylesheet" href="vendor/intro-js/introjs.css">
	<link rel="stylesheet" href="vendor/slidepanel/slidePanel.css">
	<link rel="stylesheet" href="vendor/flag-icon-css/flag-icon.css">
	<link rel="stylesheet" href="assets/css/v2.css">

	<!-- Upload -->
	<link href="vendor/upload/css/jquery.fileuploader.css" media="all" rel="stylesheet">
	<link rel="stylesheet" href="vendor/dropify/dropify.css">

	<!-- Fonts -->
	<link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
	<link rel="stylesheet" href="assets/fonts/font-awesome/font-awesome.min.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">

	<!-- Scripts -->
	<script src="vendor/breakpoints/breakpoints.js"></script>
	<script>
		Breakpoints();
	</script>
</head>
<body class="animsition dashboard">

	<?php $current_file = basename(__FILE__); ?>
	<?php include 'header.php'; ?>
	<?php 
		$order_detail = order_detail($_GET['id']);

		if(!empty($_POST))
		{	
			if(order_edit())
			{
				echo '<script>
					alert("ออเดอร์เสร็จเรียบร้อยแล้ว");
					window.location.href = "index.php"
					</script>';
				exit;
			}
		}

		function item_list()
        {
			$order_id = $_GET['id'];
            $sql	= "SELECT *
                        FROM tbl_order_desc
                        WHERE order_id = '$order_id'
                        ORDER BY rank ASC";
            
            return query($sql);
		}

		// $orid = $_GET['id'];
		// query("UPDATE tbl_order SET is_check = '1' WHERE id = '$orid'");
		
		$item_list = item_list();
	?>

	<!-- Page -->
	<div class="page">
		<div class="page-content container-fluid">
			<div class="row" data-plugin="matchHeight" data-by-row="true">
			<div class="col-lg-7">		
					<!-- Panel Static Labels -->
		          	<div class="panel">
			            <div class="panel-heading">
						  <h1 class="panel-title">รายการอาหาร :</h1>
			            </div>
			            <div class="panel-body container-fluid">
							<table class="table table-striped">
								<thead>
								<tr>
									<th>จำนวน</th>
									<th>รายการ</th>
									<th>ไซส์</th>
									<th>ราคา</th>
								</tr>
								</thead>
								<tbody>
							<?php foreach ($item_list as $item_detail) : ?>
								<tr>
									<td><?php echo $item_detail->qty; ?>x</td>
									<td><?php echo $item_detail->product_name; ?> <br> 
									<td><?php echo $item_detail->t_size; ?></td>
									<td><?php echo number_format($item_detail->total); ?>.-</td>
								</tr>
							<?php endforeach ?>
								<tr >
									<td class="padding-top-30 text-right" colspan="3">
									<p>ค่าขนส่ง <?php echo number_format($order_detail->order_delivery); ?> บาท</p>
									<h3>รวมทั้งหมด <?php echo number_format($order_detail->order_smprice); ?> บาท</h3></td>
								</tr>
								</tbody>
							</table>

						</div>
					  </div>
		          	<!-- End Panel Static Labels -->			
				</div>

				<div class="col-lg-5">		
					<div class="panel">
						<div class="row">
							<div class="col-lg-12">
								<!-- Panel Static Labels -->
									<div class="panel-heading">
										<h1 class="panel-title">ข้อมูลลูกค้า :</h1>
									</div>
									<div class="panel-body">
										<h4> <strong>ชื่อลูกค้า :</strong>  <?php echo $order_detail->customer; ?></h4>
										<h4><strong>เบอร์โทรศัพท์ :</strong>  <?php echo $order_detail->order_tel; ?></h4>
										<h4><strong>อีเมล์ :</strong> <?php echo $order_detail->order_email; ?></h4>
										<h4><strong>ที่อยู่ :</strong> <?php echo $order_detail->order_address; ?>  <strong>ตำบล :</strong> <?php echo $order_detail->order_mo; ?></h4>
										<h4> <strong>อำเภอ/เขต :</strong> <?php echo $order_detail->order_del; ?> <strong>จังหวัด :</strong> <?php echo $order_detail->order_jaw; ?>   <strong>รห้สไปรษณีย์ :</strong> <?php echo $order_detail->order_pos; ?></h4>
											
											
										<h4><strong>วันที่ชำระเงิน :</strong>  <?php echo $order_detail->order_date; ?> <strong>เวลาที่ชำระเงิน :</strong>  <?php echo $order_detail->order_time; ?></h4>
										<h4><strong>จำนวนเงินที่ชำระ : </strong> <?php echo $order_detail->order_cost; ?> บาท</h4>
										<?php if ($order_detail->delivery_type == '0') : ?>
											<h4><strong>การจัดส่ง :</strong> J&T</h4>
										<?php else : ?>
											<h4><strong>การจัดส่ง :</strong> ชำระค่าจัดส่งปลายทาง</h4>
										<?php endif ?>
										<?php if (!empty($order_detail->slip)) : ?>	
											<h4>หลักฐานการโอนเงิน :</h4>		
											<div class="img-slip">
												<img src="../assets/images/slip/<?php echo $order_detail->id; ?>/<?php echo $order_detail->slip; ?>" class="img-res">
											</div>
										<?php else : ?>
											<div class="panel-body container-fluid">
												<h4>ยังไม่มีการชำระเงิน</h4>
											</div>
										<?php endif ?>
										
										<a href="tel:<?php echo $order_detail->order_tel; ?>" class="btn btn-warning"><i class="fa fa-phone" aria-hidden="true"></i> โทรหาลูกค้า</a>
										</div>
									</div>
								<!-- End Panel Static Labels -->			
							</div>			
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Page -->
	
	<?php include 'footer.php'; ?>
	
	<!-- Core-->
	<script src="vendor/babel-external-helpers/babel-external-helpers.js"></script>
	<script src="vendor/jquery/jquery.js"></script>
	<script src="vendor/popper-js/umd/popper.min.js"></script>
	<script src="vendor/bootstrap/bootstrap.js"></script>
	<script src="vendor/animsition/animsition.js"></script>
	<script src="vendor/mousewheel/jquery.mousewheel.js"></script>
	<script src="vendor/asscrollbar/jquery-asScrollbar.js"></script>
	<script src="vendor/asscrollable/jquery-asScrollable.js"></script>
	<script src="vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

	<!-- Plugins -->	
	<script type="text/javascript" src="vendor/summernote/summernote-bs4.js"></script>
	<script src="vendor/switchery/switchery.js"></script>
	<script src="vendor/intro-js/intro.js"></script>
	<script src="vendor/screenfull/screenfull.js"></script>
	<script src="vendor/slidepanel/jquery-slidePanel.js"></script>
	<script src="vendor/skycons/skycons.js"></script>
	<script src="vendor/aspieprogress/jquery-asPieProgress.min.js"></script>
	<script src="vendor/matchheight/jquery.matchHeight-min.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="js/custom.js"></script>
	<script type="text/javascript" src="plugin/moment-2.10.2/moment.min.js"></script>
	<script type="text/javascript" src="plugin/bootstrap-datetimepicker-4.17.37/bootstrap-datetimepicker.min.js"></script>

	<script type="text/javascript">var uploadUrl = 'upload.php';</script>

	<!-- Scripts -->
	<script src="assets/js/Component.js"></script>
	
	<script src="assets/js/Plugin.js"></script>
	<script src="assets/js/Base.js"></script>
	<script src="assets/js/Config.js"></script>
	<script src="assets/js/all.js"></script>
	<script src="assets/js/Section/Menubar.js"></script>
	<script src="assets/js/Section/GridMenu.js"></script>
	<script src="assets/js/Section/Sidebar.js"></script>
	<script src="assets/js/Section/PageAside.js"></script>
	<script src="assets/js/Plugin/menu.js"></script>

	<script src="assets/js/config/colors.js"></script>
	<script src="assets/js/config/tour.js"></script>

	<!-- Page -->
	<script src="assets/js/Site.js"></script>
	<script src="assets/js/Plugin/asscrollable.js"></script>
	<script src="assets/js/Plugin/slidepanel.js"></script>
	<script src="assets/js/Plugin/switchery.js"></script>
	<script src="assets/js/Plugin/matchheight.js"></script>

	<script src="assets/js/v1.js"></script>
	<!-- Upload -->
	<script src="vendor/upload/js/jquery.fileuploader.js" type="text/javascript"></script>
	<script src="vendor/upload/js/custom.js" type="text/javascript"></script>
	<script src="vendor/dropify/dropify.min.js"></script>

	<!-- Initiate Portoflio Script -->
	<script src="extensions/portfolio/isotope.min.js"></script>
    <script src="extensions/portfolio/portfolio.js"></script>

    <!-- Fancybox/Lightbox -->
    <script type="text/javascript" src="extensions/fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="extensions/fancybox/jquery.fancybox.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="extensions/fancybox/jquery.fancybox.css" media="screen" />
    <script type="text/javascript" src="extensions/fancybox/jquery.fancybox-media.js"></script>


	<script>

		function ShowInput(){
		index = document.getElementById('promotion').value;
		if(index == '1'){
			document.getElementById('priceProduct').style.display='';
		} else {
			document.getElementById('priceProduct').style.display='none';
		}
		}
	</script>

</body>
</html>
