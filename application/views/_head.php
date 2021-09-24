<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="<?=base_url('./assets/img/logo/logo.png');?>" rel="icon">
  <link href="<?=base_url('./assets/img/logo/logo.png');?>" rel="apple-touch-icon">

<link rel="stylesheet" href="<?=base_url('./assets/style.css');?>">


<header id="header" class="fixed-top">
     <!-- Navigation -->
     
     <nav class="navbar navbar-expand-lg fixed-top navbar-light" > 
        <div class="container">
            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Pavo</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="#"><img src="<?=base_url('./assets/img/logo/logo.png');?>" alt="alternative"></a> 

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link page-scroll" href="<?=base_url('home/index');?>">HOME<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link page-scroll" href="<?=base_url('product/category');?>">PRODUCT</a>
                    </li>
                </ul>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

  </header>


   
   
