<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class about extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Cart_model'); 
		$this->load->model('Product_model');
		$this->load->model('Review_model'); 
	}

    public function index()
	{
		$data['cats_list'] = $this->Cart_model->cat_list(); 
		$data['products_sele_list'] = $this->Product_model->products_sele_list(); 
		$data['reviewies_list'] = $this->Review_model->reviewies_list();

		$this->load->view('head',$data);
		$this->load->view('aboutus',$data);
	}
}
