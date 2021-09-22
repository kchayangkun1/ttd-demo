<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="bootstrap admin template">
	<meta name="author" content="">

	<title>Category | General S</title>

	<link rel="apple-touch-icon" href="<?php echo base_url('assets/admin/assets/images/apple-touch-icon.png');?>">
	<link rel="shortcut icon" href="<?php echo base_url('./assets/images/logo/logo.png');?>">

    <!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/css/bootstrap.css');?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/summernote/summernote-bs4.css');?>">
  	<link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/css/bootstrap-extend.css');?>">
  	<link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/css/site.css');?>">

	<!-- Plugins -->
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/animsition/animsition.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/asscrollable/asScrollable.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/switchery/switchery.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/intro-js/introjs.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/slidepanel/slidePanel.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/css/v2.css');?>">

    	<!-- Upload -->
	<link href="<?php echo base_url('assets/admin/vendor/upload/css/jquery.fileuploader.css');?>" media="all" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/dropify/dropify.css');?>">

    

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
	<?php
		$this->load->view('admin/menu');
	?>
	<!-- end -->
    <!-- Page -->
	<div class="page">
		<div class="page-content container-fluid">
			<div class="row" data-plugin="matchHeight" data-by-row="true">
				<div class="col-xxl-12 col-lg-12">		
					<!-- Panel Static Labels -->
		          	<div class="panel">
			            <div class="panel-heading">
			              <h3 class="panel-title">Categories Add</h3>
			            </div>
			            <div class="panel-body container-fluid">
			              	<form action="<?=base_url('Admin/addCategory');?>" id="productAdd" name="productAdd" class="form-horizontal" method="post" enctype="multipart/form-data">
				                <div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="name">Name</label>
									<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" 
                                    value="<?=$this->security->get_csrf_hash();?>" >
				                  	<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
				                </div>
								<div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="short_desc">Short Description</label>
				                  	<input type="text" class="form-control" id="short_desc" name="short_desc" placeholder="Short Description" required>
				                </div>
				                <div class="text-right">
						            <button type="submit" class="btn btn-animate btn-animate-side btn-success">
						              	<span><i class="icon wb-check" aria-hidden="true"></i> Save</span>
						            </button>
						            <button type="button" class="btn btn-animate btn-animate-side btn-default btn-outline" onclick="window.location.href = 'categories.php';">
						              	<span><i class="icon wb-close" aria-hidden="true"></i> Close</span>
						            </button>
          						</div>
			              	</form>
			            </div>
		          	</div>
		          	<!-- End Panel Static Labels -->			
				</div>
			</div>
		</div>
	</div>
	<!-- End Page -->

     <!-- footer -->
	<?php $this->load->view('admin/footer'); ?>

      <!-- script -->
	<?php
		$this->load->view('admin/script-js');
	?>
	<!-- end script -->
    
	<!-- Plugins -->	
	<script type="text/javascript" src="<?php echo base_url('assets/admin/vendor/summernote/summernote-bs4.js');?>"></script>
	
    <!-- var uploadUrl = 'upload.php'; -->
    <script type="text/javascript">
        var uploadUrl = '<?=base_url('File_upload/upfile');?>';
    </script>
	<!-- Upload -->
	<script src="<?php echo base_url('assets/admin/vendor/upload/js/jquery.fileuploader.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/admin/vendor/upload/js/custom.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/admin/vendor/dropify/dropify.min.js');?>"></script>
