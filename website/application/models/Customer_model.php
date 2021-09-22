<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

    public function getCustomer(){
       
        $this->db->select('*');
        $this->db->from('tb_branch as a');
        $this->db->join('tb_customer as b', 'a.id_number_branch = b.branch_id', 'inner');
        $this->db->order_by('a.name_branch', 'ASC');
      
        $query = $this->db->get();
        $query->num_rows();
        $result = $query->result_array();

        return $result;
    }

    public function getRecord($uid){
            
            $this->db->select('*');
            $this->db->from('tb_customer');
            $this->db->where('cusid', $uid);
            $query = $this->db->get();
            $query->num_rows();
            $result = $query->result_array();

            return $result;

    }
    // ข้อมูลสุขภาพ | 
    public function healthInfo($uid1){
        $this->db->select('*');
        $this->db->from('tb_customer_healthinfo');
        $this->db->where('cusid', $uid1);
        $query = $this->db->get();
        $query->num_rows();
        $result = $query->result_array();
        return $result;
        
    }
    // โรคประจำตัว
    public function disease($uid2){
        $this->db->select('*');
        $this->db->from('tb_customer_disease');
        $this->db->where('cusid', $uid2);
        $query = $this->db->get();
        $query->num_rows();
        $result = $query->result_array();
        return $result;
    }
}

?>