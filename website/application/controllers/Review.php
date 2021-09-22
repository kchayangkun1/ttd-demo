<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class review extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->library('pagination'); 
		$this->load->model('Cart_model'); 
		$this->load->model('Product_model');
		$this->load->model('Review_model'); 

	}

    public function page()
	{
		$data['cats_list'] = $this->Cart_model->cat_list();
		$data['products_sele_list'] = $this->Product_model->products_sele_list(); 
         
         $_get = $this->security->xss_clean($this->input->get());
         $num_page= $this->uri->segment(3);
         
            $config['base_url'] = base_url().'review/page/';
            if (count($_get) > 0) $config['suffix'] = '/?' . http_build_query($_get, '', "&");
            if (count($_get) > 0) $config['first_url'] = $config['base_url'].'/?'.http_build_query($_get);
            $config['total_rows'] = $this->Review_model->countReview(); 

            $config['per_page'] = 6;        
            $config['uri_segment'] = 3;   
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['first_link']       = false;
            $config['last_link']        = false;
            $config['full_tag_open']    = '<ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul>';
            $config['attributes']       = ['class' => 'page-link'];
            $config['first_tag_open']   = '<li class="page-item">';
            $config['first_tag_close']  = '</li>';
            $config['prev_tag_open']    = '<li class="page-item">';
            $config['prev_tag_close']   = '</li>';
            $config['next_tag_open']    = '<li class="page-item">';
            $config['next_tag_close']   = '</li>';
            $config['last_tag_open']    = '<li class="page-item">';
            $config['last_tag_close']   = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
 
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
            $this->pagination->initialize($config);        
            $data['page_start'] = $page;
            $data['pagination'] = $this->pagination->create_links();        
            $data['review_list'] = $this->Review_model->fetchDesign($config["per_page"], $page); 

		    $data['cats_list'] = $this->Cart_model->cat_list();
 
            $this->load->view('head',$data);
            $this->load->view('reviews/list_review',$data);
	}
}
