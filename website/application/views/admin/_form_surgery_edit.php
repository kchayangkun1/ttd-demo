<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="bootstrap admin template">
	<meta name="author" content="">

	<title>ศัลยกรรม & สกิน | Lenista Clinic </title>
	<link rel="shortcut icon" href="<?=base_url('./assets/img/core-img/logo.png');?>">

<!-- Stylesheets -->
<link rel="stylesheet" href="<?=base_url('./assets/admin/assets/css/bootstrap.css');?>">
<link type="text/css" rel="stylesheet" href="<?=base_url('./assets/admin/vendor/summernote/summernote-bs4.css');?>">
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

<!-- Upload -->
<link href="<?=base_url('./assets/admin/vendor/upload/css/jquery.fileuploader.css');?>" media="all" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url('./assets/admin/vendor/dropify/dropify.css');?>">

<!-- Fonts -->
<link rel="stylesheet" href="<?=base_url('./assets/admin/assets/fonts/web-icons/web-icons.min.css');?>">
<link rel="stylesheet" href="<?=base_url('./assets/admin/assets/fonts/font-awesome/font-awesome.min.css');?>">
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

<!--[if lt IE 9]>
<script src="vendor/html5shiv/html5shiv.min.js"></script>
<![endif]-->

<!--[if lt IE 10]>
<script src="vendor/media-match/media.match.min.js"></script>
<script src="vendor/respond/respond.min.js"></script>
<![endif]-->

<!-- Scripts -->
<script src="<?=base_url('./assets/admin/vendor/breakpoints/breakpoints.js');?>"></script>
<script>
	Breakpoints();
</script>
<style>
optgroup{
	font-weight: 700;
}
</style>
<style>
optgroup{
	font-weight: 700;
}
</style>
</head>
<body class="">
	<!-- menu -->
	<?php $this->load->view('admin/menu'); ?>
	<!-- end -->
	<?php 

		//$this->load->model('upload_product_model');
		// call images product list uploaded
		// multiple image
		//$FileUploader=$this->upload_product_model->fileUploaded($product_dcs[0]['id']);
	
	?>

	<!-- Page -->
	<div class="page">
		<div class="page-content container-fluid">
			<div class="row" data-plugin="matchHeight" data-by-row="true">
				<div class="col-xxl-12 col-lg-12">		
					<!-- Panel Static Labels -->
		          	<div class="panel">
			            <div class="panel-heading">
			              <h3 class="panel-title">แก้ไข ศัลยกรรม & สกิน</h3>
			            </div>
			            <div class="panel-body container-fluid">
			              	<form action="<?=base_url('Admin/surgicalUpdate');?>" id="productEdit" name="productEdit" class="form-horizontal" method="post" enctype="multipart/form-data">
				                <div class="form-group form-material" data-plugin="formMaterial">
									<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" 
                    				value="<?=$this->security->get_csrf_hash();?>" >
				                  	<label class="form-control-label" for="name">Name</label>
				                  	<input type="text" class="form-control" id="name" name="name" placeholder="" value="<?=$product_dcs[0]['name']; ?>" required>
				                </div>
								<div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="short_desc">Short Description</label>
				                  	<input type="text" class="form-control" id="short_desc" name="short_desc" placeholder="" value="<?=$product_dcs[0]['short_desc']; ?>" required>
				                </div>
								<div class="form-group form-material" data-plugin="formMaterial">
									<label class="form-control-label" for="detail">Description</label>
									<textarea class="form-control summernote" rows="4" id="description" name="description">
										
										<?=htmlspecialchars_decode($product_dcs[0]['description'], ENT_NOQUOTES); ?>
									</textarea>
								</div>
								<div class="form-group form-material">
								<label class="form-control-label" for="types">หมวดหมู่</label>
									<select class="form-control" name="brand" id="brand_id" required>
                                        <option value="">-- please select --</option>
                                        <?php 
										// 
										foreach ($brand_lists as $brand_dsc) : ?>
                                            <option value="<?=$brand_dsc['id']; ?>"  <?php if($product_dcs[0]['brand'] == $brand_dsc['id']){ echo 'selected'; } ?>><?=$brand_dsc['name']; ?></option>
                                        <?php endforeach ?>
									</select>
								</div>
								<div class="form-group form-material">
									<label class="form-control-label" for="car">หมวดหมู่ย่อย</label>
									<select class="form-control" name="car" id="printCarHTMLOpt" required>
                                            
									</select>
								</div>
								<!-- <div class="form-group form-material">
									<label class="form-control-label" for="model">Model</label>
										<select class="form-control" name="model" id="printModelsHTMLOpt" required>
											
										</select>
								</div> -->
								<div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="link">Link Video</label>
				                  	<input type="text" class="form-control" id="alink" name="alink" value="<?=$product_dcs[0]['link']; ?>">
				                </div>
								<div class="form-group form-material form-material-file" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="image">Images Cover</label>
									  
			                      	<input type="file" id="covImg" name="covImg" data-plugin="dropify" data-default-file="<?=base_url('./assets/images/product/cover/'.$product_dcs[0]['id'].'/'.$product_dcs[0]['img_cover']);?>" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG"/>
									<p class="help-block"><i>Image size: 1200x900px</i></p>
				                </div>
				                <!-- <div class="form-group form-material form-material-file" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="image">Images</label>
				                  	<?php
										//echo $FileUploader;
									?>
									<p class="help-block"><i>Image size: 945x643px</i></p>
				                </div> -->
								
				                <div class="text-right">
				                	<input type="hidden" name="product_id" value="<?=$product_dcs[0]['id']; ?>">
						            <button type="submit" class="btn btn-animate btn-animate-side btn-success">
						              	<span><i class="icon wb-check" aria-hidden="true"></i> Save</span>
						            </button>
						            <button type="button" class="btn btn-animate btn-animate-side btn-default btn-outline" onclick="window.location.href = '<?=base_url('Admin/listProduct');?>';">
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
    <script type="text/javascript" src="<?=base_url('./assets/admin/vendor/summernote/summernote-bs4.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/switchery/switchery.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/intro-js/intro.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/screenfull/screenfull.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/slidepanel/jquery-slidePanel.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/skycons/skycons.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/aspieprogress/jquery-asPieProgress.min.js');?>"></script>
	<script src="<?=base_url('./assets/admin/vendor/matchheight/jquery.matchHeight-min.js');?>"></script>

	<!-- <?//=base_url('File_upload/upfile/?action=upload_image&path=product');?>'; -->
	<script type="text/javascript">
        var uploadUrl = '<?=base_url('File_upload/upfile/');?>';
    </script>
	<script type="text/javascript">
	$(document).ready(function() {
		var brID = '<?php echo $product_dcs[0]['brand'];?>';
		var car_ID = '<?=$product_dcs[0]['car'];?>';
		console.log('brID=' + brID);
		// onload select option selected
		$.ajax({
			type 	: 'POST',
			url 	: '<?=base_url("Admin/filterCarBrand"); ?>',
			data 	: {bid:brID,cid:car_ID,action:'editRow', '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash(); ?>'},
			success: function(data) {
				console.log(data);
				// printCarHTMLOpt
				$("#printCarHTMLOpt").html(data);      	
			}
		});
		// on change brand
		// get cars by brand id
		$('#brand_id').on('change', function() {
			var brandID = $('#brand_id').val();
			$('#printModelsHTMLOpt').empty().append('<option>--please select Brand--</option>');
			if ($(this).val() === '') {
				$('#printCarHTMLOpt').empty().append('<option>--please select Brand--</option>');
				$('#printModelsHTMLOpt').empty().append('<option>--please select Brand & Car--</option>');
				
				return false;
			} else {
				$('#printModelsHTMLOpt').empty().append('<option>--please select Car--</option>');
				console.log('brandID=' + brandID);
				$.ajax({
					type 	: 'POST',
					url 	: '<?=base_url("Admin/filterCarBrand"); ?>',
					data 	: {bid:brandID,action:'addNew', '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash(); ?>'},
					success: function(data) {
						console.log(data);
						$("#printCarHTMLOpt").html(data);      	
					}
				});
			}
		});
		//  end
	});
	// end
		
		// window.onload = GetCarModelSelected;
		// // onload car model selected
		// function GetCarModelSelected() {
		// 	var carID = '<?=$product_dcs[0]['car'];?>';
		// 	var modlID = '<?=$product_dcs[0]['model'];?>';
		// 	console.log('carID=' + carID);
		// 	// onload select option selected
		// 	$.ajax({
		// 		type 	: 'POST',
		// 		url 	: '<?=base_url("Admin/filterCarModels"); ?>',
		// 		data 	: {cid:carID,mid:modlID,action:'editRow', '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash(); ?>'},
		// 		success: function(data) {
		// 			console.log(data);
		// 			$("#printModelsHTMLOpt").html(data);      	
		// 		}
		// 	});
		// }
		// get models by car id
		// $('#printCarHTMLOpt').on('change', function() {
		// 	var carID = $('#printCarHTMLOpt').val();
		// 	console.log('carID=' + carID);
		// 	if ($(this).val() === '') {
		// 		$('#printModelsHTMLOpt').empty().append('<option>-- please select Car --</option>');
		// 		return false;
		// 	} else {
		// 		console.log('carID=' + carID);
		// 		$.ajax({
		// 			type 	: 'POST',
		// 			url 	: '<?=base_url("Admin/filterCarModels"); ?>',
		// 			data 	: {cid:carID,action:'addNew', '<?=$this->security->get_csrf_token_name(); ?>':'<?=$this->security->get_csrf_hash(); ?>'},
		// 			success: function(data) {
		// 				console.log(data);
		// 				$("#printModelsHTMLOpt").html(data);      	
		// 			}
		// 		});
		// 	}
		// });
		// end

	$(document).ready(function() {
  		$('#description').summernote({ 
  			height				: 150
			,callbacks: {
		        onImageUpload: function(files) {
		            url = $(this).data('upload'); //path is defined as data attribute for  textarea
		            sendFile(files[0], url, $(this));
		        }
		        ,onMediaDelete : function($target, editor, $editable) {
	          		deleteFile($target[0].src); // img 

	         		// remove element in editor 
	         		$target.remove();
	    		}
		    }
		    
  		});
	});

	function sendFile(file, url, $editor)
	{
		var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

		data = new FormData();
		data.append("file", file);
        data.append(csrfName, csrfHash);

		$.ajax({
			data		: data
			,type		: 'post'
			,dataType	: 'json'
			,xhr		: function(){
				var myXhr = $.ajaxSettings.xhr();
				
				if(myXhr.upload)
					myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
				
				return myXhr;
			},
			url		: uploadUrl + '?action=upload_image&path=product',
			cache		: false,
			contentType: false,
			processData: false,
			success	: function(dataPresponse){
				
				if(dataPresponse.success == '1')
				{
					$editor.summernote('insertImage', dataPresponse.image_url);
				}
				else
				{
					alert(dataPresponse.message);
				}
			}
		});
	}

	function progressHandlingFunction(e)
	{
		if(e.lengthComputable)
		{
			$('progress').attr({value:e.loaded, max:e.total});
			
			// reset progress on complete
			if (e.loaded == e.total) {
				$('progress').attr('value','0.0');
			}
		}
	}

	function deleteFile(fileUrl, url)
	{
		console.log('fileUrl=' + fileUrl);
		var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

		data = new FormData();
		data.append("file_url", fileUrl);
		data.append(csrfName, csrfHash);

		$.ajax({
			data		: data,
			type		: 'post',
			url			: uploadUrl + '?action=delete_image&path=product',
			cache		: false,
			contentType: false,
			processData: false,
			success	: function(url){
				console.log(url);
			}
		});
	}
	</script>
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

	<!-- Upload -->
	<script src="<?=base_url('./assets/admin/vendor/upload/js/jquery.fileuploader.js');?>" type="text/javascript"></script>
	<script src="<?=base_url('./assets/admin/vendor/upload/js/custom.js');?>" type="text/javascript"></script>
	<script src="<?=base_url('./assets/admin/vendor/dropify/dropify.min.js');?>"></script>
</body>
</html>
