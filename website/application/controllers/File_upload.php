<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_upload extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('upload'); 
        $this->load->library('session');
	}
	public function upfile(){
        $this->security->get_csrf_token_name(); 
		$this->security->get_csrf_hash(); 

        if($this->input->get('action') == 'upload_image')
        {
            if(!empty($_FILES['file']))
            {
                $config['upload_path'] = './assets/images/description/'.$this->input->get('path').'/';
                $config['file_name']        = $_FILES['file']["name"];
                $config['allowed_types']    = 'jpg|png|jpeg|JPG|PNG|JPEG'; 
                $config['file_ext_tolower'] = TRUE; 
                $config['overwrite']        = TRUE; 
                $config['max_size']         = '0';  
                $config['max_width']        = '0';  
                $config['max_height']       = '0'; 
                $config['max_filename']       = '0'; 
                $config['remove_spaces']    = TRUE; 
                $config['detect_mime']    = TRUE; 
                $config['encrypt_name'] = TRUE; 

                $this->upload->initialize($config); 
                $this->upload->do_upload('file'); 
                    
                $file_upload=$this->upload->data('file_name'); 
                if($this->upload->display_errors()){ 
                    echo $this->upload->display_errors();  
                    $data['message'] = 'Ooops! Your upload triggered the following error.';
                }else{  
                    $image_type=$this->upload->data('image_type');
                    $file_size=$this->upload->data('file_size');
                    
                    $file_name		= $file_upload;
                    $storage_path	= $this->storage_path($this->input->get('path'));
                    $file_url		= $storage_path . $file_name;
    
                    $data = array(
                        'success'		=> 1,
                        'image_url'	=> $file_url,
                        'message'		=> null
                    );
                }
            }
        }

        if($this->input->get('action') == 'delete_image')
        {
            $file_url = $this->input->post('file_url');
            $get_path = $this->input->get('path');

            if(!empty($file_url))
            {
                $_file	= explode('/', $file_url);
                $fileName	= end($_file);
                $d_name = './assets/images/description/'.$get_path.'/'.$fileName;
                
                if(unlink($d_name)){
                    $data = array(
                        'success'		=> true,
                        'image_url'	    => $d_name,
                        'message'		=> 'deleted successfully'
                    );
                } else {
                    $data = array(
                        'success'		=> false,
                        'image_url'	    => $d_name,
                        'message'		=> 'errors occured'
                    );
                }
            }
        }

        echo json_encode($data);
        exit;
    }

    public function uploadedProduct()
    {
        $product_id = $this->uri->segment(3);
        return $product_id;
        
    }

    function storage_path($destination = null)
    {
        if(!empty($destination))
            {
                $destination = $destination . str_replace("\\", '/', DIRECTORY_SEPARATOR);
            }

        base_url('assets/images/description/'.$destination);

        return base_url('./assets/images/description/'.$destination);
    }

    function storage_url($destination = null)
    {
        if(!empty($destination))
        {
            $destination = $destination . '/';
        }

        $_uri = explode('/', $_SERVER['PHP_SELF']);
        print_r($_uri);
        die();
        
        array_pop($_uri);
        array_pop($_uri);
        
        $_uri[0]= $_SERVER['HTTP_HOST'];
        $_uri[] = 'assets/images/description';
        $uri = implode('/', $_uri);

        return "https://{$uri}/{$destination}";
    }

}
