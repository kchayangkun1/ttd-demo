<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation'); 
		$this->load->model('Authenticate_model');
	}

	public function isLogedIn(){
		$this->security->get_csrf_token_name(); 
		$token =$this->security->get_csrf_hash();

		$usename =$this->security->xss_clean($this->input->post('username', TRUE));
		$passwd =$this->security->xss_clean($this->input->post('password', TRUE));

		if($usename !='' && $passwd !='' && $token !=''){
			$response = $this->Authenticate_model->checkLoggedIn($usename,$passwd);
			if($response['status'] ==200){
				$arrayData = array(
					"status"			=>'success',
					"name"				=>$usename,
					"token"				=>$token,
					"is_user_logged_in"	=> 'true'
				);
				redirect('Admin/home');
			} else {	
				$arrayData = array(
					"status"=> 'error',
					"message"=>'',
					"name"=>'',
					"token"=>$token,
					"is_user_logged_in"	=> 'false'
				);
				redirect('login','refresh');
			}	
		} 
	}
}