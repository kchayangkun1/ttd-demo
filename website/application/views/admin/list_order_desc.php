<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="bootstrap admin template">
	<meta name="author" content="">

	<title>Order Today | glovepfs </title>

	<link rel="shortcut icon" href="<?=base_url('./assets/img/logo.png');?>">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?=base_url('./assets/admin/assets/css/bootstrap.css');?>">
	<link rel="stylesheet" href="<?=base_url('./assets/admin/assets/css/bootstrap-extend.css');?>">
	<link rel="stylesheet" href="<?=base_url('./assets/admin/assets/css/site.css');?>">

	<!-- Plugins -->
	<link rel="stylesheet" href="<?=base_url('./assets/admin/vendor/animsition/animsition.css');?>">
	<link rel="stylesheet" href="<?=base_url('./assets/admin/vendor/asscrollable/asScrollable.css');?>">
	<link rel="stylesheet" href="<?=base_url('./assets/admin/vendor/switchery/switchery.css');?>">
	<link rel="stylesheet" href="<?=base_url('./assets/admin/vendor/intro-js/introjs.css');?>">
	<link rel="stylesheet" href="<?=base_url('./assets/admin/vendor/slidepanel/slidePanel.css');?>">
	<link rel="stylesheet" href="<?=base_url('./assets/admin/vendor/flag-icon-css/flag-icon.css');?>">
	<link rel="stylesheet" href="<?=base_url('./assets/admin/assets/css/v2.css');?>">

	<link rel="stylesheet" href="<?=base_url('./assets/admin/vendor/bootstrap-table/bootstrap-table.css?v4.0.2');?>">

	<!-- Fonts -->
	<link rel="stylesheet" href="<?=base_url('./assets/admin/assets/fonts/web-icons/web-icons.min.css');?>">
	<link rel="stylesheet" href="<?=base_url('./assets/admin/assets/fonts/font-awesome/font-awesome.min.css');?>">
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


	<!-- Scripts -->
	<script src="<?=base_url('./assets/admin/vendor/breakpoints/breakpoints.js');?>"></script>
	<script>
		Breakpoints();
	</script>
</head>
<body class="">
	<!-- menu -->
	<?php $this->load->view('admin/menu'); ?>
	<!-- end -->
    <!-- Page -->
	<div class="page">
		<div class="page-content container-fluid">
			<div class="row" data-plugin="matchHeight" data-by-row="true">
				<div class="col-lg-7">		
					<!-- Panel Static Labels -->
		          	<div class="panel">
			            <div class="panel-heading">
						  <h1 class="panel-title">เลขออเดอร์ : <?=$order_detail[0]['order_no']; ?></h1>
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
									<td><?=$item_detail['qty']; ?>x</td>
									<td><?=$item_detail['product_name']; ?></td>
									<td><?=strtoupper($item_detail['t_size']); ?></td>
									<td><?=number_format($item_detail['total'],2); ?>.-</td>
								</tr>
							<?php endforeach ?>
								<tr >
									<td class="padding-top-30 text-right" colspan="3">
									<p>ค่าขนส่ง <?=number_format($order_detail[0]['order_delivery'],2); ?> บาท</p>
									<h3>รวมทั้งหมด <?=number_format($order_detail[0]['order_smprice'],2); ?> บาท</h3></td>
								</tr>
								</tbody>
							</table>

						</div>
						<div class="back-grey">
							<div class="panel-hide">
								<div class="panel-body container-fluid">
									<h2>สถานะการส่งซื้อ :</h2>
										<div class="text-left">
											<input type="hidden" name="order_id" value="<?=$order_detail[0]['id']; ?>">
											<button type="button" onclick="is_check(<?=$order_detail[0]['id'];?>);" class="btn btn-animate btn-animate-side btn-success">
												<span><i class="icon wb-check" aria-hidden="true"></i> Complete</span>
											</button>
											<button type="button" class="btn btn-animate btn-animate-side btn-warning btn-outline" onclick="window.location.href = '<?=base_url('Admin/orderToday');?>';">
												<span><i class="icon wb-close" aria-hidden="true"></i> Close</span>
											</button>
										</div>
								</div>
							</div>
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
										<h4> <strong>ชื่อลูกค้า :</strong>  <?=$order_detail[0]['customer']; ?></h4>
										<h4><strong>เบอร์โทรศัพท์ :</strong>  <?=$order_detail[0]['order_tel']; ?></h4>
										<h4><strong>อีเมล์ :</strong> <?=$order_detail[0]['order_email']; ?></h4>
										<h4><strong>ที่อยู่ :</strong> <?=$order_detail[0]['order_address']; ?>
                                        <h4><strong>แขวง/ตำบล :</strong> <?=$order_detail[0]['tambon_th']; ?></h4>
										<h4> <strong>อำเภอ/เขต :</strong> <?=$order_detail[0]['district_th']; ?> <strong>จังหวัด :</strong> <?=$order_detail[0]['province_th']; ?>   <strong>รห้สไปรษณีย์ :</strong> <?=$order_detail[0]['order_pos']; ?></h4>
										
										<h4><strong>วันที่ชำระเงิน :</strong>  <?=$order_detail[0]['order_date']; ?> <strong>เวลาที่ชำระเงิน :</strong>  <?=$order_detail[0]['order_time']; ?></h4>
										<h4></h4>
										<h4><strong>จำนวนเงินที่ชำระ : </strong> <?=$order_detail[0]['order_cost']; ?> บาท</h4>
										<?php if ($order_detail[0]['delivery_type'] == '0') : ?>
											<h4><strong>การจัดส่ง :</strong> J&T</h4>
										<?php else : ?>
											<h4><strong>การจัดส่ง :</strong> ชำระค่าจัดส่งปลายทาง</h4>
										<?php endif ?>
										<?php if (!empty($order_detail[0]['slip'])) : ?>	
											<h4><strong>หลักฐานการโอนเงิน :</strong> </h4>		
												<div class="img-slip">
                                                    <?php if($order_detail[0]['slip'] !='') : ?>
                                                        <img src="<?=base_url('./assets/images/slip/'.$order_detail[0]['slip']);?>" class="img-res">
                                                    <?php else : ?>
                                                        <img src="<?=base_url('./assets/images/slip/noimg.jpg');?>" class="img-res">
                                                    <?php endif; ?>
												</div>
										<?php else : ?>
											<div class="panel-body container-fluid">
												<h4>ยังไม่มีการชำระเงิน</h4>
											</div>
										<?php endif ?>
                                        <h4><strong>เบอร์ติดต่อ : </strong> <?=$order_detail[0]['order_tel']; ?> บาท</h4>
										
										<!-- <a href="tel:<?//=$order_detail[0]['order_tel']; ?>" class="btn btn-warning"><i class="fa fa-phone" aria-hidden="true"></i> โทรหาลูกค้า</a> -->

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
	<!-- End Page -->
	<div class="modal fade bs-example-modal-sm" id="modalChange" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel2">เปลี่ยนสถานะ</h4>
				</div>
				<div class="modal-body">
					<h4>คุณต้องการเปลี่ยนสถานะใช่หรือไม่ ?</h4>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="orderid" name="orderid">
					<button type="button" class="btn btn-success" onclick="completeStatus()"><i class="fa fa-check"></i> Confirm</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /modals -->
	<!-- footer -->
	<?php
		$this->load->view('admin/footer');
	?>

	<!-- Core-->
	<script src="<?=base_url('./assets/admin/vendor/babel-external-helpers/babel-external-helpers.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/jquery/jquery.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/popper-js/umd/popper.min.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/bootstrap/bootstrap.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/animsition/animsition.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/mousewheel/jquery.mousewheel.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/asscrollbar/jquery-asScrollbar.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/asscrollable/jquery-asScrollable.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/ashoverscroll/jquery-asHoverScroll.js');?>"></script>

	<!-- Plugins -->
	<script src="<?=base_url('./assets/admin/vendor/switchery/switchery.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/intro-js/intro.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/screenfull/screenfull.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/slidepanel/jquery-slidePanel.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/skycons/skycons.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/aspieprogress/jquery-asPieProgress.min.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/matchheight/jquery.matchHeight-min.js');?>"></script>

	<script src="<?=base_url('./assets/admin/vendor/bootstrap-table/bootstrap-table.js?v4.0.2');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/bootstrap-table/extensions/mobile/bootstrap-table-mobile.min.js?v4.0.2');?>"></script>

	<!-- Scripts -->
	<script src="<?=base_url('./assets/admin/assets/js/Component.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Plugin.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Base.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Config.js');?>"></script>

	<script src="<?=base_url('./assets/admin/assets/js/Section/Menubar.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Section/GridMenu.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Section/Sidebar.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Section/PageAside.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Plugin/menu.js');?>"></script>

	<script src="<?=base_url('./assets/admin/assets/js/config/colors.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/config/tour.js');?>"></script>

	<!-- Page -->
	<script src="<?=base_url('./assets/admin/assets/js/Site.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Plugin/asscrollable.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Plugin/slidepanel.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Plugin/switchery.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/Plugin/matchheight.js');?>"></script>

	<script src="<?=base_url('./assets/admin/assets/js/v1.js');?>"></script>
	<script src="<?=base_url('./assets/admin/assets/js/tables/bootstrap.js?v4.0.2');?>"></script>

	<script type="text/javascript">
	$(document).ready(function() {
		// bind change event handler
		$('#p_status').change(function() {
			// update disabled property
			$("#conf_st").prop('disabled', this.value == '');
			// trigger change event to set initial value
		}).change();
	});

	function is_check(pid)
    {
		console.log('pid=' + pid);
    	$('#orderid').val(pid);
    	$('#modalChange').modal('show');
    }

    function completeStatus()
    {
        $.ajax({
		  	type 	: 'POST',
		  	url 	: '<?=base_url("Admin/order_edit"); ?>',
		  	data 	: {orderid:$('#orderid').val(), action:'orderedit', '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash(); ?>'},
		  	success: function(data) {
				if (data = 'true') {
					alert("ออเดอร์เสร็จเรียบร้อยแล้ว");
                    window.location.href = '<?=base_url('Admin/orderToday');?>'; 
		        } else {
		        	alert("ออเดอร์ไม่เสร็จ");
    				location.reload();
		        }      	
		    }
		});

	}



	</script>

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
