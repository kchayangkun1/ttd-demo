<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="bootstrap admin template">
	<meta name="author" content="">

	<title>Category | General S</title>

	<link rel="apple-touch-icon" href="<?php echo base_url('assets/admin/assets/images/apple-touch-icon.png');?>">
	<link rel="shortcut icon" href="<?php echo base_url('./assets/images/logo/logo.png');?>">

    <!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/css/bootstrap.css');?>">
  	<link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/css/bootstrap-extend.css');?>">
  	<link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/css/site.css');?>">

	<!-- Plugins -->
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/animsition/animsition.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/asscrollable/asScrollable.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/switchery/switchery.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/intro-js/introjs.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/slidepanel/slidePanel.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/css/v2.css');?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/bootstrap-table/bootstrap-table.css?v4.0.2');?>">

	<!-- Fonts -->
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/fonts/font-awesome/font-awesome.min.css');?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">
  	<link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/fonts/web-icons/web-icons.css');?>">
  	
	<!--[if lt IE 9]>
	<script src="vendor/html5shiv/html5shiv.min.js"></script>
	<![endif]-->

	<!--[if lt IE 10]>
	<script src="vendor/media-match/media.match.min.js"></script>
	<script src="vendor/respond/respond.min.js"></script>
	<![endif]-->

	<!-- Scripts -->
	<script src="<?php echo base_url('assets/admin/vendor/breakpoints/breakpoints.js');?>"></script>
	<script>
		Breakpoints();
	</script> 
</head>
<body class="animsition dashboard">
    <!-- menu -->
	<?php $this->load->view('admin/menu');?>
	<!-- end -->
    <!-- Page -->
	<div class="page">
        <!-- flash message -->
        <?php if($this->session->flashdata('success')){ ?>
            <div class="modal" id="modalSuccess" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="width: 294px;text-align: center;">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 38px;"></i></p>
                        <br>
                        <strong></strong><?=$this->session->flashdata('success');?></p>
                    </div>
                    </div>
                </div>
            </div>
        <?php } else if($this->session->flashdata('error')){  ?>

            <div class="modal" id="modalError" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="width: 294px;text-align: center;">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: red;font-size: 38px;"></i>    </p>
                        <br>
                        <strong></strong><?=$this->session->flashdata('error'); ?></p>
                    </div>
                    </div>
                </div>
            </div>
        <?php } ?>

		<div class="page-content container-fluid">
	      	<!-- Panel Other -->
	      	<div class="panel">
		        <div class="panel-heading">
		          	<h3 class="panel-title">Categories</h3>
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
							                    <button type="button" class="btn btn-success btn-outline btn-sm" onclick="window.location.href = '<?=base_url('Admin/createCategory');?>';">
							                      	<i class="icon wb-plus" aria-hidden="true"></i> Add Categories
							                    </button>
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
			                    						<th style="" data-field="name">
			                    							<div class="th-inner ">Name</div>
			                    							<div class="fht-cell"></div>
			                    						</th>
			                    						<th style="" data-field="">
			                    							<div class="th-inner ">Created</div>
			                    							<div class="fht-cell"></div>
			                    						</th>
			                    						<th style="" data-field="edit" data-align="center" data-width="120px">
			                    							<div class="th-inner "></div>
			                    							<div class="fht-cell"></div>
			                    						</th>
			                    					</tr>
			                    				</thead>
			                    				<?php if(!empty($list_categories)) : ?>
			                  					<tbody>
			                  						<?php 
													$i = 0;
													foreach($list_categories as $cate_detail) : 
													?>
			                  						<tr> 
			                  							<td class=""><?=$i+1; ?></td> 
			                  							<td style=""><?=$cate_detail['categories_name']; ?></td>
			                  							<td style=""><?=date("d/m/Y H:i:s", strtotime($cate_detail['create_date'])); ?></td>
			                  							<td>
			                  								<button type="button" class="btn btn-round btn-warning btn-sm" onclick="window.location.href = '<?=base_url('Admin/editCategory/'.$cate_detail['categories_id']);?>'"><i class="icon wb-pencil" aria-hidden="true"></i></button>
			                  								<button type="button" class="btn btn-round btn-danger btn-sm" onclick="delC(<?=$cate_detail['categories_id']; ?>)"><i class="icon wb-close" aria-hidden="true"></i></button>
			                  							</td> 
			                  						</tr>
			                  						<?php
			                  							$i++;
			                  						endforeach; 
			                  						?>
			                  					</tbody>
			                  					<?php endif; /* if(!empty($promotion_list)) : */ ?>
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
    <!-- modal -->
    <div class="modal fade bs-example-modal-sm" id="modalChange" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel2">Change</h4>
				</div>
				<div class="modal-body">
					<h4>คุณต้องการเปลี่ยนสถานะหรือไม่ ?</h4>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="categories_id" name="categories_id">
					<input type="hidden" id="sStatus" name="sStatus">
					<button type="button" class="btn btn-success" onclick="changeSt()"><i class="fa fa-check"></i> Confirm</button>
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
					<h4>คุณต้องการลบสิ่งนี้หรือไม่ ?</h4>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="cate_id" name="cate_id">
					<button type="button" class="btn btn-success" onclick="deleteCategories()"><i class="fa fa-check"></i> Confirm</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

    <!-- end modal -->
    <!-- footer -->
	<?php
		$this->load->view('admin/footer');
	?>
    <!-- script -->
	<?php
		$this->load->view('admin/script-js');
	?>
	<!-- end script -->

<script src="<?php echo base_url('assets/admin/vendor/bootstrap-table/bootstrap-table.js?v4.0.2');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-table/extensions/mobile/bootstrap-table-mobile.min.js?v4.0.2');?>"></script>
<script src="<?php echo base_url('assets/admin/assets/js/tables/bootstrap.js?v4.0.2');?>"></script>

<script type="text/javascript">
$('#modalSuccess').modal('show');
$('#modalError').modal('show');
	function stsChange(cid, status)
    {
    	$('#categories_id').val(cid);
    	$('#sStatus').val(status)
    	$('#modalChange').modal('show');
    }

    function changeSt()
    {
   		$.ajax({
		  	type 	: 'POST',
		  	url 	: 'funcQuery.php',
		  	data 	: {cid:$('#categories_id').val(), st:$('#sStatus').val(), action:'changeSts'},
		  	success: function(data) {
		        	if (data == 'true') {
		        		location.reload();
		        	} else {
		        		console.log(data);
		        	}        	
		        }
		});
	}

	function delC(cid)
    {
    	$('#cate_id').val(cid);
    	$('#modaldelete').modal('show');
    }

     function deleteCategories()
    {
        console.log($('#cate_id').val());
   		$.ajax({
		  	type 	: 'POST',
		  	url 	: '<?=base_url("Admin/distroyCategory");?>',
		  	data 	: {cid:$('#cate_id').val(), action:'delCategories','<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash(); ?>'},
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