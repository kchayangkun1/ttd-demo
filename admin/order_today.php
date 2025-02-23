<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="bootstrap admin template">
	<meta name="author" content="">

	<title>Order List | Back Office </title>

	<link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
	<link rel="shortcut icon" href="../assets/images/favicon.ico">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/bootstrap-extend.css">
	<link rel="stylesheet" href="assets/css/site.css">

	<!-- Plugins -->
	<link rel="stylesheet" href="vendor/animsition/animsition.css">
	<link rel="stylesheet" href="vendor/asscrollable/asScrollable.css">
	<link rel="stylesheet" href="vendor/switchery/switchery.css">
	<link rel="stylesheet" href="vendor/intro-js/introjs.css">
	<link rel="stylesheet" href="vendor/slidepanel/slidePanel.css">
	<link rel="stylesheet" href="vendor/flag-icon-css/flag-icon.css">
	<link rel="stylesheet" href="assets/css/v2.css">

	<link rel="stylesheet" href="vendor/bootstrap-table/bootstrap-table.css?v4.0.2">

	<!-- Fonts -->
	<link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
	<link rel="stylesheet" href="assets/fonts/font-awesome/font-awesome.min.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">

	<!--[if lt IE 9]>
	<script src="vendor/html5shiv/html5shiv.min.js"></script>
	<![endif]-->

	<!--[if lt IE 10]>
	<script src="vendor/media-match/media.match.min.js"></script>
	<script src="vendor/respond/respond.min.js"></script>
	<![endif]-->

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
        function today_list()
        {
			$datenow = date('Y-m-d');  
            $sql	= "SELECT *
                        FROM tbl_order
                        WHERE is_active = '1' AND create_date LIKE '%$datenow%'
                        ORDER BY id DESC";
            
            return query($sql);
        }

		$today_list = today_list(); 
    ?>

	<!-- Page -->
	<div class="page">
		<div class="page-content container-fluid">

	      	<!-- Panel Other -->
	      	<div class="panel">
		        <div class="panel-heading">
		          	<h3 class="panel-title">Today</h3>
		        </div>
		        <div class="panel-body">
		          	<div class="row row-lg">
			            <div class="col-md-12">
			              	<!-- Example Toolbar -->
			              	<div class="example-wrap">			                  
			                  	<div class="bootstrap-table">
			                  		<div class="fixed-table-toolbar">
			                  			<div class="bs-bars pull-left">
			                  				<div class="btn-group hidden-sm-down" id="exampleToolbar" role="group">
							                    <!-- <button type="button" class="btn btn-success btn-outline btn-sm" onclick="window.location.href = '';">
							                      	<i class="icon wb-plus" aria-hidden="true"></i> Add Product
							                    </button> -->
			                  				</div>
			                  			</div>
			                  		</div>
			                  		<div class="" style="padding-bottom: 0px;">
			                  			<div class="fixed-table-body">
			                  				<table id="exampleTableToolbar" data-mobile-responsive="true" class="table table-hover" data-pagination="true" data-search="true" style="margin-top: 0px;">
			                    				<thead style="">
			                    					<tr>
			                    						<th style="" data-field="id" data-align="center">
			                    							<div class="th-inner ">#</div>
			                    							<div class="fht-cell"></div>
			                    						</th>
			                    						<th style="" data-field="order">
			                    							<div class="th-inner ">Number Order</div>
			                    							<div class="fht-cell"></div>
			                    						</th>
			                    						<th style="" data-field="name">
			                    							<div class="th-inner ">Name</div>
			                    							<div class="fht-cell"></div>
			                    						</th>
			                    						<th style="" data-field="">
			                    							<div class="th-inner ">Tel.</div>
			                    							<div class="fht-cell"></div>
			                    						</th>
			                    						<th style="" data-field="check" data-align="center">
			                    							<div class="th-inner ">Check Silp</div>
			                    							<div class="fht-cell"></div>
			                    						</th>
			                    						<th style="" data-field="created">
			                    							<div class="th-inner ">Created</div>
			                    							<div class="fht-cell"></div>
			                    						</th>
			                    						<th style="" data-field="edit" data-align="center" data-width="120px">
			                    							<div class="th-inner "></div>
			                    							<div class="fht-cell"></div>
			                    						</th>
			                    					</tr>
			                    				</thead>
			                    				<?php if(!empty($today_list)) : ?>
			                  					<tbody>
			                  						<?php 
													$i = 0;
													foreach($today_list as $order_detail) : 
													?>
			                  						<tr> 
			                  							<td class=""><?php echo $i+1; ?></td> 
			                  							<td style=""><?php echo $order_detail->order_no; ?></td>
			                  							<td style=""><?php echo $order_detail->customer; ?></td>
			                  							<td style=""><?php echo $order_detail->order_tel; ?></td>
						                                <td style="">
			                  								<?php if ($order_detail->is_check == '1') : ?>
							                                      <button class="btn btn-sm btn-success btn-icon btn-floating" type="button"><i class="icon wb-check" aria-hidden="true"></i></button>
						                                    <?php else : ?>
							                                      <button class="btn btn-sm btn-danger btn-icon btn-floating" type="button"><i class="icon wb-close" aria-hidden="true"></i></button>
						                                    <?php endif; ?>
						                                </td> 
			                  							<td style=""><?php echo date("d/m/Y ", strtotime( $order_detail->create_date ) ); ?></td>
			                  							<td>
			                  								<button type="button" class="btn btn-round btn-warning btn-sm" onclick="window.location.href = 'order_detail.php?id=<?php echo $order_detail->id; ?>';"><i class="icon wb-search" aria-hidden="true"></i></button>
															<button type="button" class="btn btn-round btn-danger btn-sm" onclick="delO(<?php echo $order_detail->id; ?>)"><i class="icon wb-close" aria-hidden="true"></i></button>
			                  							</td> 
			                  						</tr>
			                  						<?php
			                  							$i++;
			                  						endforeach; 
			                  						?>
			                  					</tbody>
			                  					<?php endif; /* if(!empty($service_list)) : */ ?>
			                  				</table>
			                  			</div>
			                  			<div class="fixed-table-pagination" style="display: none;"></div>
			                  		</div>
				                  	<div class="clearfix"></div>
				                </div>
			              	</div>
			              	<!-- End Example Toolbar -->
			            </div>	         
		          	</div>
		        </div>
	      </div>
	      <!-- End Panel Other -->
    </div>
	</div>
	<!-- End Page -->
	
	<?php include 'footer.php'; ?>

    <div class="modal fade bs-example-modal-sm" id="newChange" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel2">Change</h4>
				</div>
				<div class="modal-body">
					<h4>คุณต้องการเปลี่ยนสถานะรายการนี้ใช่หรือไม่ ?</h4>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="order_id" name="order_id">
					<input type="hidden" id="newStatus" name="newStatus">
					<button type="button" class="btn btn-success" onclick="changenew()"><i class="fa fa-check"></i> Confirm</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade bs-example-modal-sm" id="modaldelete" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel2">Delete</h4>
				</div>
				<div class="modal-body">
					<h4>คุณต้องการลบรายการนี้หรือไม่ ?</h4>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="oid" name="oid">
					<button type="button" class="btn btn-success" onclick="deleteOrder()"><i class="fa fa-check"></i> Confirm</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /modals -->
	
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
	<script src="vendor/switchery/switchery.js"></script>
	<script src="vendor/intro-js/intro.js"></script>
	<script src="vendor/screenfull/screenfull.js"></script>
	<script src="vendor/slidepanel/jquery-slidePanel.js"></script>
	<script src="vendor/skycons/skycons.js"></script>
	<script src="vendor/aspieprogress/jquery-asPieProgress.min.js"></script>
	<script src="vendor/matchheight/jquery.matchHeight-min.js"></script>

	<script src="vendor/bootstrap-table/bootstrap-table.js?v4.0.2"></script>
	<script src="vendor/bootstrap-table/extensions/mobile/bootstrap-table-mobile.min.js?v4.0.2"></script>

	<!-- Scripts -->
	<script src="assets/js/Component.js"></script>
	<script src="assets/js/Plugin.js"></script>
	<script src="assets/js/Base.js"></script>
	<script src="assets/js/Config.js"></script>

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

	<script src="assets/js/tables/bootstrap.js?v4.0.2"></script>

	<script type="text/javascript">

    function newChange(oid, status)
	{
		$('#order_id').val(oid);
		$('#newStatus').val(status)
		$('#newChange').modal('show');
	}

    function changenew()
    {
   		$.ajax({
		  	type 	: 'POST',
		  	url 	: 'funcQuery.php',
		  	data 	: {oid:$('#order_id').val(), st:$('#newStatus').val(), action:'newOrder'},
		  	success: function(data) {
		        	if (data == 'true') {
		        		location.reload();
		        	} else {
		        		console.log(data);
		        	}        	
		        }
		});
	}

	function delO(oid)
    {
    	$('#oid').val(oid);
    	$('#modaldelete').modal('show');
    }

     function deleteOrder()
    {
   		$.ajax({
		  	type 	: 'POST',
		  	url 	: 'funcQuery.php',
		  	data 	: {oid:$('#oid').val(), action:'delOrder'},
		  	success: function(data) {
		        	if (data == 'true') {
		        		location.reload();
		        	} else {
		        		console.log(data);
		        	}        	
		        }
		});
	}

	</script>
</body>
</html>
