<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="bootstrap admin template">
	<meta name="author" content="">

	<title>Edit Product | Back Office </title>

	<link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
	<link rel="shortcut icon" href="../assets/images/favicon.ico">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="vendor/summernote/summernote-bs4.css">
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
	<!-- Upload -->
	<link href="vendor/upload/css/jquery.fileuploader.css" media="all" rel="stylesheet">
	<link rel="stylesheet" href="vendor/dropify/dropify.css">

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
	include('included_upload_product.php');
	if(!empty($_POST))
	{	
		if(product_edit())
		{
			echo '<script>
			     alert("แก้ไขข้อมูลสำเร็จ");
			     window.location.href = "product.php"
			      </script>';
			exit;
		}
	}

	if(empty($_GET['id']))
	{
		header('location: product.php');
		exit;
	}
	
	$product_detail = product_detail($_GET['id']);

	?>

	<!-- Page -->
	<div class="page">
		<div class="page-content container-fluid">
			<div class="row" data-plugin="matchHeight" data-by-row="true">
				<div class="col-xxl-12 col-lg-12">		
					<!-- Panel Static Labels -->
		          	<div class="panel">
			            <div class="panel-heading">
			              <h3 class="panel-title">Edit Product</h3>
			            </div>
			            <div class="panel-body container-fluid">
			              	<form id="aboutusAdd" name="aboutusAdd" class="form-horizontal" method="post" enctype="multipart/form-data">
				                <div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="title">Name</label>
				                  	<input type="text" class="form-control" id="name" name="name" value="<?php echo $product_detail->name; ?>" required>
				                </div>
								<div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="price">Price</label>
				                  	<input type="text" class="form-control" id="price" name="price" value="<?php echo $product_detail->price; ?>" required>
				                </div>
								<div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="xs">Size xs</label>
				                  	<input type="text" class="form-control" id="size_xs" name="size_xs" value="<?php echo $product_detail->size_xs; ?>">
				                </div>
								<div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="s">Size s</label>
				                  	<input type="text" class="form-control" id="size_s" name="size_s" value="<?php echo $product_detail->size_s; ?>">
				                </div>
								<div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="m">Size m</label>
				                  	<input type="text" class="form-control" id="size_m" name="size_m" value="<?php echo $product_detail->size_m; ?>">
				                </div>
								<div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="l">Size l</label>
				                  	<input type="text" class="form-control" id="size_l" name="size_l" value="<?php echo $product_detail->size_l; ?>">
				                </div>
								<div class="form-group form-material" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="xl">Size xl</label>
				                  	<input type="text" class="form-control" id="size_xl" name="size_xl" value="<?php echo $product_detail->size_xl; ?>">
				                </div>
								<div class="form-group form-material">
									<label class="form-control-label" for="category">Category</label>
									<select class="form-control" name="sub_cate">
                                        <?php 
                                            $category_list = cat_list();
                                            foreach ( $category_list as $category_detail ) : 
                                        ?>
										<optgroup label="<?php echo $category_detail->c_name;?>">

                                            <?php $subcate_list = subcate_list($category_detail->c_name); ?>
												<?php foreach ( $subcate_list as $subcate_detail ) : ?>
													<option value="<?php echo $subcate_detail->sub_id; ?>"<?php if($product_detail->cat_name == $subcate_detail->sub_id){ echo 'selected'; } ?>><?php echo $subcate_detail->subcate_name; ?></option>
											<?php endforeach; ?>
										</optgroup>
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group form-material" data-plugin="formMaterial">
									<label class="form-control-label" for="detail">Description</label>
									<textarea class="form-control summernote" rows="4" id="description" name="description">
										<?php echo $product_detail->dsc; ?>
									</textarea>
								</div>
								<div class="form-group form-material form-material-file" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="image">Image</label>
			                      	<input type="file" id="covImg" name="covImg" data-plugin="dropify" data-default-file="<?php echo '../assets/images/product/cover/' . $product_detail->id . '/' . $product_detail->img_cover; ?>" data-allowed-file-extensions="png jpg"/>
									<p class="help-block"><i>Image size: 1950x900px</i></p>
				                </div>
								<div class="form-group form-material form-material-file" data-plugin="formMaterial">
				                  	<label class="form-control-label" for="image">Images</label>
				                  	<?php
										// this variable is comming from the included file		
										$input = $FileUploader->generateInput();
										echo $input;
									?>
									<p class="help-block"><i>Image size: 900x1024px</i></p>
				                </div>
				                <div class="text-right">
				                	<input type="hidden" name="logo_id" value="<?php echo $product_detail->id; ?>">
						            <button type="submit" class="btn btn-animate btn-animate-side btn-success">
						              	<span><i class="icon wb-check" aria-hidden="true"></i> Save</span>
						            </button>
						            <button type="button" class="btn btn-animate btn-animate-side btn-default btn-outline" onclick="window.location.href = 'product.php';">
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

	<script>
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
		data = new FormData();
		data.append("file", file);

		$.ajax({
			data		: data
			,type		: 'post'
			,dataType	: 'json'
			,xhr		: function(){
				var myXhr = $.ajaxSettings.xhr();
				
				if(myXhr.upload)
					myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
				
				return myXhr;
			}
			,url		: uploadUrl + '?action=upload_image&path=product'
			,cache		: false
			,contentType: false
			,processData: false
			,success	: function(dataPresponse){
				
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

	function deleteFile(fileUrl)
	{
		data = new FormData();
		data.append("file_url", fileUrl);

		$.ajax({
			data		: data
			,type		: 'post'
			,url		: uploadUrl + '?action=delete_image&path=product'
			,cache		: false
			,contentType: false
			,processData: false
			,success	: function(url){
				console.log(url);
			}
		});
	}
	</script>
    
</body>
</html>
