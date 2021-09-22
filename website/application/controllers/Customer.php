<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
	}
	public function index(){
        $this->load->view('banner_tab');
        $this->load->view('head');
        $this->load->view('menu');
        $this->load->view('customer/list_customer');
        $this->load->view('footer');
    }

    public function add(){
        $this->load->view('head');
        $this->load->view('customer/cus_form');
    } 

}
