<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class payment extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('pagination'); 
		$this->load->model('Cart_model'); 
		$this->load->model('Product_model');
		$this->load->model('Review_model'); 
        $this->load->model('Province_model');
        $this->load->model('Order_model'); 
	}
    public function order()
    {
        $orderid = $this->security->xss_clean($this->input->get('id', TRUE));
        
		$data['cats_list'] = $this->Cart_model->cat_list(); 
        $data['orderies_list'] = $this->Order_model->orderies_list($orderid);
        
		$this->load->view('head',$data);
		$this->load->view('payment/list_payment',$data);
    }

    public function pay_add()
    {
        $this->security->get_csrf_token_name(); 
        $this->security->get_csrf_hash(); 

        $order_id = $this->security->xss_clean($this->input->post('order_id', TRUE));
        $dates = $this->security->xss_clean($this->input->post('dates', TRUE));
        $times = $this->security->xss_clean($this->input->post('times', TRUE));
        $summoney = $this->security->xss_clean($this->input->post('summoney', TRUE));
        $timestamp = $this->security->xss_clean($this->input->post('timestamp', TRUE));

        $updated 	= date('Y-m-d');

        if(!empty($_FILES['slipImg']['name'])){
            $config['upload_path']      = 'assets/images/slip/';
            $config['file_name']        = $_FILES['slipImg']['name'];
            $config['allowed_types']    = 'jpg|png|jpeg|JPG|PNG|JPEG'; 
            $config['file_ext_tolower'] = TRUE; 
            $config['overwrite']        = TRUE; 
            $config['max_size']         = '0';  
            $config['max_width']        = '0';  
            $config['max_height']       = '0'; 
            $config['max_filename']     = '0'; 
            $config['remove_spaces']    = TRUE; 
            $config['detect_mime']      = TRUE; 
            $config['encrypt_name']     = TRUE;

            $this->upload->initialize($config);    
            $this->upload->do_upload('slipImg'); 
                
            $file_upload=$this->upload->data('file_name');  
            if($this->upload->display_errors()){ 
                echo $this->upload->display_errors();  
            }else{  
                $image_type=$this->upload->data('image_type');
                $file_size=$this->upload->data('file_size');
                $file_path=$this->upload->data('file_path');

                $data = array(
                    'order_id'      => $order_id,
                    'dates'         => $dates,
                    'times'         => $times,
                    'summoney'      => $summoney,
                    'updated'       => $updated,
                    'image_cover'   =>  $file_upload,
                );
                $res = $this->Order_model->payslip($data);
                if($res > 0 ){
                    echo "<script>
                    alert('ชำระเงินสำเร็จ ขอบคุณที่ใช้บริการ');
                    window.location.href='".base_url("home/")."';
                </script>";
                }
            }
        }else {
            echo "<script>
                alert('กรุณาอัพโหลดหลักฐานการชำระเงิน');
                window.location.href='".base_url("payment/order/?id=".$timestamp)."';
            </script>";
        }
    }
}
