<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class contact extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation'); 
		$this->load->model('Cart_model'); 
		$this->load->model('Product_model');
	}
	public function index()
	{
		$data['cats_list'] = $this->Cart_model->cat_list();

		$this->load->view('head',$data);
		$this->load->view('contact/list_contact',$data);
	}
    
    public function send(){
        $this->security->get_csrf_token_name(); 
        $this->security->get_csrf_hash(); 

		$fullname =$this->security->xss_clean($this->input->post('name', TRUE));
		$recived =$this->security->xss_clean($this->input->post('email', TRUE));
		$tel =$this->security->xss_clean($this->input->post('subject', TRUE));
		$message =$this->security->xss_clean($this->input->post('message', TRUE));

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == FALSE)
		{
			redirect('contact/', 'refresh');
		}
		else
		{ 
		    require_once APPPATH.'third_party/phpmailer/class.phpmailer.php';
			$mail = new PHPMailer();

			$mail->CharSet 		= "utf-8";
			$mail->IsSMTP();
			$mail->SMTPDebug 	= 1;
			$mail->SMTPAuth 	= true;
			$mail->Host 		= "mail.glovepfs.com"; 
			$mail->Port 		= 587;
			$mail->Username 	= "support@glovepfs.com";
			$mail->Password 	= "Pot2HVx1r"; 

			$mail->SetFrom("support@glovepfs.com", "glovepfs");
			$mail->Subject = 'Contact from : '.$fullname;

			$msg = 'ชื่อ - นามสกุล : ' .$fullname. '<br />';
            $msg .= 'มือถือ : ' .$tel. '<br />';
            $msg .= 'อีเมล : ' .$recived. '<br />';

			$mail->MsgHTML($msg);
            $mail->AddAddress($recived);
            $mail->addCC('pfshosting@gmail.com', 'Information');

			if(!$mail->Send()) {
				echo "<script>
					alert('ส่งขอบความไม่สำเร็จ กรุณาลองอีกครั้ง ขอบคุณค่ะ');
					window.location.href='".base_url("contact/")."';
				</script>";
			} else {
				$message = 'send';
				echo "<script>
					alert('ระบบได้ทำการส่งอีเมล์เรียบร้อยแล้ว เจ้าหน้าที่จะติดต่อคุณโดยเร็วที่สุด ขอบคุณค่ะ');
                    window.location.href='".base_url("contact/")."';
				</script>";
			}
        }
	}

}
