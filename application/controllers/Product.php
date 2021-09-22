<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
         $_get = $this->security->xss_clean($this->input->get());
         $product_id= $this->uri->segment(3);
         
            $config['base_url'] = base_url().'product/page/'.$product_id.'/';
            if (count($_get) > 0) $config['suffix'] = '/?' . http_build_query($_get, '', "&");
            if (count($_get) > 0) $config['first_url'] = $config['base_url'].'/?'.http_build_query($_get);
            $config['total_rows'] = $this->Product_model->countProGroup($product_id);

            $config['per_page'] = 8;        
            $config['uri_segment'] = 4;   
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
 
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
            $this->pagination->initialize($config);        
            $data['page_start'] = $page;
            $data['pagination'] = $this->pagination->create_links();        
            $data['products_list'] = $this->Product_model->products_list($config["per_page"], $page,$product_id); 

            $data['cats_list'] = $this->Cart_model->cat_list();
            $data['caties_list'] = $this->Product_model->caties_list($product_id);
 
            $this->load->view('head',$data);
            $this->load->view('product/list_product',$data);
    }
    public function detail()
    {
        $product_id = $this->uri->segment(3);
    
        $data['cats_list'] = $this->Cart_model->cat_list(); 
        $data['producties_list'] = $this->Product_model->producties_list($product_id); 
    
        $data['products_img_list'] = $this->Product_model->products_img_list($product_id); 
        $data['rands_list'] = $this->Product_model->rands_list(); 

        $this->load->view('head',$data);
        $this->load->view('product/list_desc_product',$data);
    
    }















































    // display product html form
	public function listAll(){
        @$categoryID = $this->uri->segment(4);
        if(isset($categoryID)){
            if(is_numeric($categoryID)){
                @$filterID = $categoryID;
            } else{
                // invalid
                redirect('/Error/error_404');
            }

        }
            
        $config['base_url'] = base_url().'Product/listAll';        
        $config['total_rows'] = $this->Product_model->countRows(); // จำนวนข้อมูลทั้งหมด;        
        $config['per_page'] = 12;        
        $config['uri_segment'] = 3;        
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li>';        
        $config['first_tag_close'] = '</li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="prev">';        
        $config['prev_tag_close'] = '</li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li>';        
        $config['next_tag_close'] = '</li>';        
        $config['last_tag_open'] = '<li>';        
        $config['last_tag_close'] = '</li>';        
        $config['cur_tag_open'] = '<li class="active"><a href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li>';        
        $config['num_tag_close'] = '</li>';

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);        
        $data['page_start'] = $page;
        $data['pagination'] = $this->pagination->create_links();        
        $data['product_list'] = $this->Product_model->getPageData($config["per_page"], $page, @$filterID); 
        
        $data['category_list'] = $this->Category_model->getAll();

        $this->load->view('head'); // navbar
        $this->load->view('product/list_product',$data); // ส่งข้อมูลออกไปที่ member_veiw
		$this->load->view('footer');
        
    }

    public function show_detail($reqID){
        @$reqID = $this->uri->segment(3);
        // validate number only
        if(isset($reqID)){
            if(is_numeric($reqID)){
                @$filterID = $reqID;
            } else{
                // invalid
                redirect('/Error/error_404');
            }

        }

        $cateID = $this->security->xss_clean($filterID);
        $data['produt_desc'] = $this->Product_model->product_detail($cateID); 
        $data['product_img'] = $this->Product_model->product_img_list($cateID);
        $data['product_related'] = $this->Product_model->getRelated($cateID); 

        $this->load->view('head'); // navbar
        $this->load->view('product/list_desc_product',$data); // ส่งข้อมูลออกไปที่ member_veiw
		$this->load->view('footer');

    }

    /**
     * show function
     * display product & details
     * call api show product & details
     * ajax live search by pNameTH
     * @return array jsonencode
     */
    public function show(){
		$this->security->get_csrf_token_name(); // initial CSRF name
        $this->security->get_csrf_hash(); // get CSRF Token generate
        if(!empty($this->input->post('query'))){
            $search_txt = $this->input->post('query');
        } else{}
    }

}
