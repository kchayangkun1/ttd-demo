<nav class="navbar navbar-expand-md navbar-dark fixed-top " <?php if($this->uri->segment(2)=='detail'){echo 'style="background-color: #1d3c51;"';}?>>
<div class="d-flex justify-content-center  col-lg-2 col-2 col-sm-2 col-md-2 col-xl-2">
      <a class="navbar-brand" href="">
          <img id="img-product"class="d-block w-100" align="right" src="<?=base_url('assets/img/logo/logo.png');?>" alt="logo" style="width: 36%;  height: auto;"></a>
      </div>
      <button id="toggler-navbar" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse collapse navbar-collapse  col-10 col-sm-10  col-md-10 col-lg-10 col-xl-10 justify-content-end w-100" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
          
            <a class="nav-link" href="<?=base_url('home/index');?>">HOME <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('product/category');?>">PRODUCT</a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- <?=base_url('assets/img/logo/logo.png');?> -->