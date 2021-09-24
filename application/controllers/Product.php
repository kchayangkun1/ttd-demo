<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->library('pagination'); 
		$this->load->model('Product_model');
       
    }
    // หน้ารวมหมวดหมู่สินค้า
    public function category()
   {
    $this->load->view('head');
    $this->load->view('product/list_category');
    $this->load->view('footer');
   }
    // หน้าสินค้า เช่น เก้าอีั้ทั้งหมด
   public function page()
   {
    $this->load->view('head');
    $this->load->view('product/list_product');


   }
//    หน้ารายละเอียดสินค้า เช่น รายละเอียดเก้าอี้ 1
   public function detail()
   {
    //  $product_id = $this->uri->segment(3);

    $this->load->view('head');
    $this->load->view('product/list_desc_product');
    $this->load->view('footer');
    
   }
}
