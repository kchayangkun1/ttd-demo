<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class howtoorder extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Cart_model'); 
		$this->load->model('Product_model'); 

	}

    public function index()
	{
		$data['cats_list'] = $this->Cart_model->cat_list();
		$this->load->view('head',$data);
		$this->load->view('howto_order',$data);
        
	}
}
