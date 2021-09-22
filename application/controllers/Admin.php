<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation'); 
        $this->load->library('upload'); 
        $this->load->library('session');
        $this->load->model('Order_model'); 
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Review_model'); 
        $this->load->model('upload_product_model'); 
	}
    
	public function home(){
        if(!empty($this->session->userdata('user'))){
           
            $this->load->view('admin/home'); // 
        }
        else{
            
            redirect('Login','refresh');
        }
    }

    public function orderToday()
    {   
        if(!empty($this->session->userdata('user'))){
           
            $data['today_list'] = $this->Order_model->today_list(); 

            $this->load->view('admin/list_ordertoday', $data); //     
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }

    }

    public function order_detail(){
        
        if(!empty($this->session->userdata('user'))){
            $order_id = $this->uri->segment(3);
           
            $data['order_detail'] = $this->Order_model->order_detail($order_id); 
            $data['item_list'] = $this->Order_model->item_list($order_id); 

            $this->load->view('admin/list_order_desc', $data); //     
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }
    }
    public function order_edit()
    {
        if(!empty($this->session->userdata('user'))){
            $this->security->get_csrf_token_name(); // initial CSRF name
            $this->security->get_csrf_hash(); // get CSRF Token generate
            $orderid = $this->security->xss_clean($this->input->post('orderid', TRUE));
            $action = $this->security->xss_clean($this->input->post('action', TRUE));
    
            if(!empty($orderid) && $action =='orderedit'){
                $response = $this->Order_model->updateIs_check($orderid);
    
                if($response == 1){
                    echo 'true';
                } else {
                    echo 'false';
                }
            } else{
                echo 'false';
            }
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }
    }

    public function order_list(){
        if(!empty($this->session->userdata('user'))){
           
            $data['order_list'] = $this->Order_model->order_list(); 
            $this->load->view('admin/list_order', $data); //     
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }
    }

    public function history_detail()
    {
        if(!empty($this->session->userdata('user'))){
           
            $order_id = $this->uri->segment(3);
            $data['order_detail'] = $this->Order_model->order_detail($order_id); 
            $data['item_list'] = $this->Order_model->item_list($order_id); 
            

            $this->load->view('admin/historydesc', $data); //     
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }
    }
    public function listCategory()
    { 
        if(!empty($this->session->userdata('user'))){
            $data['cat_list'] = $this->Category_model->getAll(); // call model

            $this->load->view('admin/list_category', $data); //   
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }
    }
    public function formCategory()
    {
        if(!empty($this->session->userdata('user'))){
            $this->load->view('admin/form_category'); // 
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }
    }

    public function cat_add()
    {
        if(!empty($this->session->userdata('user'))){
            // add
            $this->security->get_csrf_token_name(); 
            $this->security->get_csrf_hash();
            $c_name = $this->security->xss_clean($this->input->post('name', TRUE));
            $res = $this->Category_model->create($c_name); 

            if($res > 0 ){
                echo "<script>
                    alert('Success!');
                    window.location.href='".base_url("Admin/listCategory")."';
                </script>";
            } else {
                echo "<script>
                    alert('Error!, Please try again!');
                    window.location.href='".base_url("Admin/formCategory")."';
                </script>";
            }
        }
        else{
            redirect('Login','refresh');
        }
    }

    public function edit_category()
    {
        if(!empty($this->session->userdata('user'))){
            $cate_id = $this->uri->segment(3);

            $data['cat_detail'] = $this->Category_model->getName($cate_id);
            $this->load->view('admin/form_category_edit', $data); //  
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }
    }

    public function update_category()
    {
        if(!empty($this->session->userdata('user'))){
            $this->security->get_csrf_token_name(); 
            $this->security->get_csrf_hash();
            $c_name = $this->security->xss_clean($this->input->post('name', TRUE));
            $cate_id = $this->security->xss_clean($this->input->post('cate_id', TRUE));
            
            $res = $this->Category_model->update($c_name,$cate_id); 

            if($res > 0 ){
                echo "<script>
                    alert('Success!');
                    window.location.href='".base_url("Admin/listCategory")."';
                </script>";
            } else {
                echo "<script>
                    alert('Error!, Please try again!');
                    window.location.href='".base_url("Admin/formCategory")."';
                </script>";
            }
        }
        else{
            redirect('Login','refresh');
        }

    }
    public function delCategory()
    {
        if(!empty($this->session->userdata('user'))){
            // id:$('#cate_id').val(), action:'delCate'
            $this->security->get_csrf_token_name(); // initial CSRF name
            $this->security->get_csrf_hash(); // get CSRF Token generate
            $cid = $this->security->xss_clean($this->input->post('id', TRUE));
            $caction = $this->security->xss_clean($this->input->post('action', TRUE));
    
            if(!empty($cid) && $caction =='delCate'){
                $response = $this->Category_model->distroy($cid);
    
                if($response == 1){
                    echo 'true';
                } else {
                    echo 'false';
                }
            } else{
                echo 'false';
            }
        }
        else{
            redirect('Login','refresh');
        }

    }

    public function listSubcategory()
    {
        if(!empty($this->session->userdata('user'))){
            $data['cates_list'] = $this->Category_model->fetchSubcategory();
            $this->load->view('admin/list_subcategory', $data); //  
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }
    }
    public function formSubcategory()
    {
        if(!empty($this->session->userdata('user'))){
            $data['brand_list'] = $this->Category_model->getAll();
            $this->load->view('admin/form_subcategory',$data); // 
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }
    }

    public function subcategory_add()
    {
        if(!empty($this->session->userdata('user'))){
            // add
            $this->security->get_csrf_token_name(); 
            $this->security->get_csrf_hash();
            $c_name = $this->security->xss_clean($this->input->post('name', TRUE));
            $brand = $this->security->xss_clean($this->input->post('brand', TRUE));
            $res = $this->Category_model->subcate_create($c_name,$brand); 

            if($res > 0 ){
                echo "<script>
                    alert('Success!');
                    window.location.href='".base_url("Admin/listSubcategory")."';
                </script>";
            } else {
                echo "<script>
                    alert('Error!, Please try again!');
                    window.location.href='".base_url("Admin/formSubcategory")."';
                </script>";
            }
        }
        else{
            redirect('Login','refresh');
        }
    }
    public function edit_subcategory()
    {
        if(!empty($this->session->userdata('user'))){
            $subcate_id = $this->uri->segment(3);

            $data['cates_detail'] = $this->Category_model->getSubcate($subcate_id);
            $data['brand_list'] = $this->Category_model->getAll();
            $this->load->view('admin/form_subcategory_edit', $data); //  
        }
        else{
            //If no session, redirect to login page
            redirect('Login','refresh');
        }
    }

    public function update_subcategory()
    {
        if(!empty($this->session->userdata('user'))){
            $this->security->get_csrf_token_name(); 
            $this->security->get_csrf_hash();
            $c_name = $this->security->xss_clean($this->input->post('name', TRUE));
            $cate_id = $this->security->xss_clean($this->input->post('brand', TRUE));
            $sub_id = $this->security->xss_clean($this->input->post('sub_id', TRUE));
            
            $res = $this->Category_model->update_subcate($c_name,$cate_id,$sub_id); 

            if($res > 0 ){
                echo "<script>
                    alert('Success!');
                    window.location.href='".base_url("Admin/listSubcategory")."';
                </script>";
            } else {
                echo "<script>
                    alert('Error!, Please try again!');
                    window.location.href='".base_url("Admin/edit_subcategory/".$sub_id)."';
                </script>";
            }
        }
        else{
            redirect('Login','refresh');
        }

    }
    public function delSubcate()
    {
        if(!empty($this->session->userdata('user'))){
            
            $this->security->get_csrf_token_name(); // initial CSRF name
            $this->security->get_csrf_hash(); // get CSRF Token generate
            $cid = $this->security->xss_clean($this->input->post('id', TRUE));
            $caction = $this->security->xss_clean($this->input->post('action', TRUE));
    
            if(!empty($cid) && $caction =='delSubcate'){
                $response = $this->Category_model->distroy_subcate($cid);
                if($response == 1){
                    echo 'true';
                } else {
                    echo 'false';
                }
            } else{
                echo 'false';
            }
        }
        else{
            redirect('Login','refresh');
        }
    }
    
    public function list_reviews()
    {
        if(!empty($this->session->userdata('user'))){
            $data['review_list'] = $this->Review_model->reviewies_list();
            
            $this->load->view('admin/list_review', $data); //  
        }
        else{
            redirect('Login','refresh');
        }

    }

    public function form_review()
    {
        if(!empty($this->session->userdata('user'))){
            
            $this->load->view('admin/form_review'); //  
        }
        else{
            redirect('Login','refresh');
        }
    }

    public function create_review()
    {
        if(!empty($this->session->userdata('user'))){
            $this->security->get_csrf_token_name(); // initial CSRF name
            $this->security->get_csrf_hash(); // get CSRF Token generate
            $rw_name = $this->security->xss_clean($this->input->post('name', TRUE));
            $rw_dsc = $this->input->post('description', FALSE);

            $review_id = $this->Review_model->create($rw_name,$rw_dsc);
            
            if(!empty($_FILES['covImg']['name'])){
                $folderName = './assets/images/review/'.$review_id.'/';
                if(!is_dir($folderName))
                {
                    mkdir($folderName,0777);
                    $config['upload_path'] = $folderName;
                } else{
                    $config['upload_path'] = $folderName; 
                }
                    
                $config['file_name']        = $_FILES['covImg']['name'];
                $config['allowed_types']    = 'jpg|png|jpeg|JPG|PNG|JPEG'; 
                $config['file_ext_tolower'] = TRUE;
                $config['overwrite']        = TRUE;
                $config['max_size']         = '0'; 
                $config['max_width']        = '0'; 
                $config['max_height']       = '0'; 
                $config['max_filename']       = '0';
                $config['remove_spaces']    = TRUE; 
                $config['detect_mime']    = TRUE; 
                // $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config); 
                $this->upload->do_upload('covImg'); 
                    
                $file_upload=$this->upload->data('file_name'); 
                if($this->upload->display_errors()){ 
                    echo $this->upload->display_errors();  
                }else{  
                    $image_type=$this->upload->data('image_type');
                    $file_size=$this->upload->data('file_size');
                    $file_path=$this->upload->data('file_path');

                    $dataArr = array(
                        'image_type'    =>  $image_type,
                        'file_size'     =>  $file_size,
                        'file_path'     =>  $file_path,
                        'image_cover'   =>  $file_upload,
                        'rw_id'       => $review_id
                    );
                }
                
                $response = $this->Review_model->fileUpload($dataArr);

                if($response > 0){
                    echo "<script>
                        alert('Success!');
                        window.location.href='".base_url("Admin/list_reviews")."';
                    </script>";
                } else {
                    echo "<script>
                        alert('failed!');
                        window.location.href='".base_url("Admin/form_review")."';
                    </script>";
                }

            } else{
                echo "<script>
                        alert('Not found! Please browse file');
                        window.location.href='".base_url("Admin/form_review")."';
                </script>";
            }   
        }
        else{
            redirect('Login','refresh');
        }
    }
    public function review_edit()
    {   
        if(!empty($this->session->userdata('user'))){
            $rw_id = $this->uri->segment(3);
            $data['review_detail'] = $this->Review_model->getDesc($rw_id); 
            $this->load->view('admin/form_review_edit', $data); //  
        }
        else{
            redirect('Login','refresh');
        }
    }

    public function review_update()
    {
        if(!empty($this->session->userdata('user'))){
            $this->security->get_csrf_token_name(); 
            $this->security->get_csrf_hash();
            $rw_name = $this->security->xss_clean($this->input->post('name', TRUE));
            $rw_dsc = $this->input->post('description', FALSE);
            $review_id = $this->security->xss_clean($this->input->post('rw_id', TRUE));
            
            if(!empty($_FILES['covImg']['name'])){
                $folderName = './assets/images/review/'.$review_id.'/';
                if(!is_dir($folderName))
                {
                    mkdir($folderName,0777);
                    $config['upload_path'] = $folderName; 
                } else{
                    $config['upload_path'] = $folderName; 
                }
                    
                $config['file_name']        = $_FILES['covImg']['name'];
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
                $this->upload->do_upload('covImg');
                    
                @$file_upload=$this->upload->data('file_name');
                if($this->upload->display_errors()){ 
                    echo $this->upload->display_errors();  
                }else{  
                    @$image_type=$this->upload->data('image_type');
                    @$file_size=$this->upload->data('file_size');
                    @$file_path=$this->upload->data('file_path');
                }
            } 
            $dataArr = array(
                'name'          => $rw_name,
                'desc'          => $rw_dsc,
                'image_type'    =>  @$image_type,
                'file_size'     =>  @$file_size,
                'file_path'     =>  @$file_path,
                'image_cover'   =>  @$file_upload,
                'rw_id'         => @$review_id
            );  
            $response = $this->Review_model->update($dataArr);
            if($response > 0){
                echo "<script>
                    alert('Success!');
                    window.location.href='".base_url("Admin/list_reviews")."';
                </script>";
            } else {
                echo "<script>
                    alert('failed!');
                    window.location.href='".base_url("Admin/review_edit/".$review_id)."';
                </script>";
            }
        }
        else{
            redirect('Login','refresh');
        }

    }
    public function delReview()
    {
        if(!empty($this->session->userdata('user'))){
            
            $this->security->get_csrf_token_name(); 
            $this->security->get_csrf_hash();
            $rwid = $this->security->xss_clean($this->input->post('id', TRUE));
            $rwaction = $this->security->xss_clean($this->input->post('action', TRUE));
    
            if(!empty($rwid) && $rwaction =='delReview'){
                $response = $this->Review_model->distroy($rwid);
                if($response == 1){
                    echo 'true';
                } else {
                    echo 'false';
                }
            } else{
                echo 'false';
            }
        }
        else{
            redirect('Login','refresh');
        }
    }

    public function list_product()
    {
        if(!empty($this->session->userdata('user'))){
            $data['product_list'] = $this->Product_model->fetchAll();

            $this->load->view('admin/list_product', $data); //  
        }
        else{
            redirect('Login','refresh');
        } 
    }

    public function changeRecom()
    {
        if(!empty($this->session->userdata('user'))){
            
            $this->security->get_csrf_token_name(); 
            $this->security->get_csrf_hash(); 
            $pid = $this->security->xss_clean($this->input->post('id', TRUE));
            $pst = $this->security->xss_clean($this->input->post('st', TRUE));
            $paction = $this->security->xss_clean($this->input->post('action', TRUE));
    
            if(!empty($pid) && $paction =='chgRcm'){
                $response = $this->Product_model->update_recomm($pid,$pst);
                if($response == 1){
                    echo 'true';
                } else {
                    echo 'false';
                }
            } else{
                echo 'false';
            }
        }
        else{
            redirect('Login','refresh');
        }
    }

    public function delete_product()
    {
        if(!empty($this->session->userdata('user'))){
            
            $this->security->get_csrf_token_name();
            $this->security->get_csrf_hash(); 
            $pid = $this->security->xss_clean($this->input->post('id', TRUE));
            $paction = $this->security->xss_clean($this->input->post('action', TRUE));
    
            if(!empty($pid) && $paction =='delete'){
                $response = $this->Product_model->distroy($pid);
                if($response == 1){
                    echo 'true';
                } else {
                    echo 'false';
                }
            } else{
                echo 'false';
            }
        }
        else{
            redirect('Login','refresh');
        }
    }

    public function form_product()
    {
        if(!empty($this->session->userdata('user'))){
            $data['category_list'] = $this->Category_model->getAll();
            $this->load->view('admin/form_product',$data); //  
        }
        else{
            redirect('Login','refresh');
        }
    }
    public function addProduct(){
        if(!empty($this->session->userdata('user'))){
            $this->security->get_csrf_token_name(); 
            $this->security->get_csrf_hash();
    
            $name = $this->security->xss_clean($this->input->post('name', TRUE));
            $price = $this->security->xss_clean($this->input->post('price', TRUE));
            $size_xs = $this->security->xss_clean($this->input->post('size_xs', TRUE));
            $size_s = $this->security->xss_clean($this->input->post('size_s', TRUE));
            $size_m = $this->security->xss_clean($this->input->post('size_m', TRUE));
            $size_l = $this->security->xss_clean($this->input->post('size_l', TRUE));
            $size_xl = $this->security->xss_clean($this->input->post('size_xl', TRUE));
            $sub_cate = $this->security->xss_clean($this->input->post('sub_cate', TRUE));
            $description = $this->input->post('description', FALSE);
            
            $data = array(
                'name'          => $name,
                'price'         => $price,
                'size_xs'       => $size_xs,
                'size_s'        => $size_s,
                'size_m'        => $size_m,
                'size_l'        => $size_l,
                'size_xl'       => $size_xl,
                'sub_cate'      => $sub_cate,
                'description'   => $description
            );
            $last_pid = $this->Product_model->create($data); 
            if($last_pid > 0){
            
                if(!empty($_FILES['covImg']['name'])){
                    $folderName = './assets/images/product/cover/'.$last_pid.'/';
                    if(!is_dir($folderName))
                    {
                        mkdir($folderName,0777);
                        $config['upload_path'] = $folderName; 
                    } else{
                        $config['upload_path'] = $folderName;
                    }
                    $config['file_name']        = $_FILES['covImg']['name'];
                    $config['allowed_types']    = 'jpg|png|jpeg|JPG|PNG|JPEG';
                    $config['file_ext_tolower'] = TRUE; 
                    $config['overwrite']        = TRUE; 
                    $config['max_size']         = '0';  
                    $config['max_width']        = '0';  
                    $config['max_height']       = '0'; 
                    $config['max_filename']       = '0'; 
                    $config['remove_spaces']    = TRUE; 
                    $config['detect_mime']    = TRUE;
                    // $config['encrypt_name'] = TRUE; 
        
                    $this->upload->initialize($config);    
                    $this->upload->do_upload('covImg'); 
                        
                    $file_upload=$this->upload->data('file_name');  
                    if($this->upload->display_errors()){ 
                        echo $this->upload->display_errors();  
                    }else{  
                        $image_type=$this->upload->data('image_type');
                        $file_size=$this->upload->data('file_size');
                        $file_path=$this->upload->data('file_path');
        
                        $dataArr = array(
                            'image_cover'   => $file_upload,
                            'pd_id'         => $last_pid
                        );
                        $resimg = $this->Product_model->updatefileUpload($dataArr);
                        if($resimg > 0){
                            $dataimg = array(); 
                            $countfiles = count($_FILES['productImg']['name']);
                            if($countfiles > 0){
                                $folderName = './assets/images/product/'.$last_pid.'/';
                                if(!is_dir($folderName))
                                {
                                    mkdir($folderName,0777);
                                    $config['upload_path'] = $folderName; 
                                } else{
                                    $config['upload_path'] = $folderName;
                                }
                                for($i=0;$i<$countfiles;$i++){
                                    if(!empty($_FILES['productImg']['name'][$i])){
                                        $_FILES['file']['name'] = $_FILES['productImg']['name'][$i];
                                        $_FILES['file']['type'] = $_FILES['productImg']['type'][$i];
                                        $_FILES['file']['tmp_name'] = $_FILES['productImg']['tmp_name'][$i];
                                        $_FILES['file']['error'] = $_FILES['productImg']['error'][$i];
                                        $_FILES['file']['size'] = $_FILES['productImg']['size'][$i];
                        
                                        $config['upload_path'] = $folderName;
                                        $config['file_name'] = $_FILES['productImg']['name'][$i];
                                        $config['allowed_types']    = 'jpg|png|jpeg|JPG|PNG|JPEG'; 
                                        $config['file_ext_tolower'] = TRUE; 
                                        $config['overwrite']        = TRUE; 
                                        $config['max_size']         = '0'; 
                                        $config['max_width']        = '0'; 
                                        $config['max_height']       = '0'; 
                                        $config['max_filename']       = '0'; 
                                        $config['remove_spaces']    = TRUE; 
                                        $config['detect_mime']    = TRUE;
                                        // $config['encrypt_name'] = TRUE; 
                            
                                        //$this->load->library('upload',$config); 
                                        $this->upload->initialize($config); 

                                        if($this->upload->do_upload('file')){
                                            $uploadData = $this->upload->data();
                                            $filename1 = $uploadData['file_name'];
                                            
                                            $dataArr2[] = array(
                                                'image_cover'   => $filename1,
                                            );
                                        }
                                    }
                                }
                            
                                $response = $this->Product_model->insertProductImg($dataArr2,$last_pid);

                                if($response > 0){
                                    echo "<script>
                                        alert('Success!');
                                            window.location.href='".base_url("Admin/list_product")."';
                                    </script>";
                                } else {
                                    echo "<script>
                                        alert('failed!');
                                        window.location.href='".base_url("Admin/list_product")."';
                                    </script>";
                                }
                            } else {
                                echo "<script>
                                    alert('Please Upload album');
                                    window.location.href='".base_url("Admin/list_product")."';
                                </script>";
                            } 
                        } else {
                            echo "<script>
                                alert('Product Updated, Warning! The Images Cover.');
                                window.location.href='".base_url("Admin/list_product")."';
                            </script>";
                        }
                    }
                } else{
                    echo "<script>
                        alert('Please Upload image');
                        window.location.href='".base_url("Admin/list_product")."';
                    </script>";
                }    
            } else {
                echo "<script>
                    alert('failed! Please try again!');
                    window.location.href='".base_url("Admin/form_product")."';
                </script>";
            }   
        }
        else{
            redirect('Login','refresh');
        }
    }
    public function product_edit()
    {   
        if(!empty($this->session->userdata('user'))){
            $pid = $this->uri->segment(3);
            
            $data['category_list'] = $this->Category_model->getAll();
            $data['product_detail'] = $this->Product_model->product_detail($pid);
            
            $this->load->view('admin/form_product_edit', $data); //  
        }
        else{
            redirect('Login','refresh');
        }
    }

    public function updateProduct(){
        if(!empty($this->session->userdata('user'))){
            $this->security->get_csrf_token_name(); 
            $this->security->get_csrf_hash();
    
            $name = $this->security->xss_clean($this->input->post('name', TRUE));
            $price = $this->security->xss_clean($this->input->post('price', TRUE));
            $size_xs = $this->security->xss_clean($this->input->post('size_xs', TRUE));
            $size_s = $this->security->xss_clean($this->input->post('size_s', TRUE));
            $size_m = $this->security->xss_clean($this->input->post('size_m', TRUE));
            $size_l = $this->security->xss_clean($this->input->post('size_l', TRUE));
            $size_xl = $this->security->xss_clean($this->input->post('size_xl', TRUE));
            $sub_cate = $this->security->xss_clean($this->input->post('sub_cate', TRUE));
            $description = $this->input->post('description', FALSE);
            $product_id = $this->security->xss_clean($this->input->post('product_id', TRUE));
            
            $data = array(
                'name'          => $name,
                'price'         => $price,
                'size_xs'       => $size_xs,
                'size_s'        => $size_s,
                'size_m'        => $size_m,
                'size_l'        => $size_l,
                'size_xl'       => $size_xl,
                'sub_cate'      => $sub_cate,
                'description'   => $description,
                'product_id'    => $product_id
            );
            $res1 = $this->Product_model->update_product($data);
            
            if(!empty($_FILES['covImg']['name'])){
                $folderName = './assets/images/product/cover/'.$product_id.'/';
                if(!is_dir($folderName))
                {
                    mkdir($folderName,0777);
                    $config['upload_path'] = $folderName; 
                } else{
                    $config['upload_path'] = $folderName;
                }
                $config['file_name']        = $_FILES['covImg']['name'];
                $config['allowed_types']    = 'jpg|png|jpeg|JPG|PNG|JPEG'; 
                $config['file_ext_tolower'] = TRUE; 
                $config['overwrite']        = TRUE; 
                $config['max_size']         = '0';  
                $config['max_width']        = '0';  
                $config['max_height']       = '0'; 
                $config['max_filename']       = '0'; 
                $config['remove_spaces']    = TRUE; 
                $config['detect_mime']    = TRUE; 
                // $config['encrypt_name'] = TRUE;
                
                $this->upload->initialize($config);
                $this->upload->do_upload('covImg');
                $file_upload=$this->upload->data('file_name'); 
                if($this->upload->display_errors()){ 
                    echo $this->upload->display_errors();  
                }else{      
                    @$dataArr = array(
                        'image_cover'   => $file_upload,
                        'pd_id'         => $product_id
                    );
                    $res2 = $this->Product_model->updatefileUpload(@$dataArr);
                }
            } 
            $dataimg = array(); 
            $countfiles = count($_FILES['productImg']['name']);
            if($countfiles > 0){
                $folderName = './assets/images/product/'.$product_id.'/'; 
                if(!is_dir($folderName))
                {
                    mkdir($folderName,0777);
                    $config['upload_path'] = $folderName; 
                } else{
                    $config['upload_path'] = $folderName;
                }
                for($i=0;$i<$countfiles;$i++){
                    if(!empty($_FILES['productImg']['name'][$i])){
                        $_FILES['file']['name'] = $_FILES['productImg']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['productImg']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['productImg']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['productImg']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['productImg']['size'][$i];
            
                        $config['upload_path'] = $folderName;
                        $config['file_name'] = $_FILES['productImg']['name'][$i];
                        $config['allowed_types']    = 'jpg|png|jpeg|JPG|PNG|JPEG'; 
                        $config['file_ext_tolower'] = TRUE; 
                        $config['overwrite']        = TRUE; 
                        $config['max_size']         = '0'; 
                        $config['max_width']        = '0'; 
                        $config['max_height']       = '0'; 
                        $config['max_filename']       = '0';
                        $config['remove_spaces']    = TRUE; 
                        $config['detect_mime']    = TRUE;
                        // $config['encrypt_name'] = TRUE; 
                
                        //Load upload library
                        //$this->load->library('upload',$config); 
                        $this->upload->initialize($config);

                        // File upload
                        if($this->upload->do_upload('file')){
                            $uploadData = $this->upload->data();
                            @$filename1 = $uploadData['file_name'];

                            @$dataArr2[] = array(
                                'image_cover'   => $filename1,
                            );
                        }
                    }
                }
                $res3 = $this->Product_model->insertProductImg(@$dataArr2,$product_id);
                
            }
            if($res1 > 0 || $res2 > 0 || $res3 > 0){
                echo "<script>
                    alert('Success!');
                        window.location.href='".base_url("Admin/list_product")."';
                </script>";
            } else {
                echo "<script>
                    alert('failed!');
                    window.location.href='".base_url("Admin/list_product")."';
                </script>";
            }
        }
        else{
            redirect('Login','refresh');
        }   
    }

    // public function userManual()
    // {
    //     if(!empty($this->session->userdata('user'))){
    //         $this->load->helper('download');
    //         $file = './assets/file/glovepfs.pdf';
    //         force_download($file, NULL);
    //     }
    //     else{
    //         redirect('Login','refresh');
    //     }
    // }
}

