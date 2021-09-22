<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class province extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination'); 
        $this->load->model('Province_model');
	}
    public function getAumphur(){

        $this->security->get_csrf_token_name(); 
        $this->security->get_csrf_hash(); 

        $proid = $this->security->xss_clean($this->input->post('proid', TRUE));
       
        $aumphurs = $this->Province_model->fetchAumphur($proid);

        $opt ='';
        $opt .='<option value="">-- เขต/อำเภอ --</option>';
        foreach ($aumphurs as $aump_val) {
            $opt .='<option value="'.$aump_val['district_id'].'" >'.$aump_val['district_th'].'</option>';
        }
        echo  $opt; 
    }
    
    public function getTumbon()
    {
        $this->security->get_csrf_token_name();
        $this->security->get_csrf_hash(); 

        $aumphurId = $this->security->xss_clean($this->input->post('aumphurId', TRUE));
        $tumbons = $this->Province_model->fetchTumbon($aumphurId);

        $opt ='';
        $opt .='<option value="">-- แขวง/ตำบล --</option>';
        foreach ($tumbons as $tumbon_val) {
            $opt .='<option value="'.$tumbon_val['tambon_id'].'" >'.$tumbon_val['tambon_th'].'</option>';
        }
        echo  $opt; 
    }
}
