<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_model extends CI_Model {


    public function reviewies_list()
    {
        
        $this->db->select('*');
        $this->db->from('tbl_review');
        $this->db->where('is_active', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();

    }

    // ไว้สำหรับนับข้อมูลทั้งหมด total_rows
    public function countReview()
    {   
        return $this->db->where(['is_active'=> 1])->from("tbl_review")->count_all_results();
    }

    public function fetchDesign($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('tbl_review');
        $this->db->where('is_active', '1');
        $this->db->limit($limit, $start); 
        $query = $this->db->get();
        return $query->result_array();
        
    }
    // add new reccord
    public function create($name,$dsc)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");
       
            $data = array(
                'name'          => $name,
                'dsc'           => $dsc,
                'is_active'     =>'1',
                'create_date'   => $cur_date,
                'update_date'   => $cur_date
            );
            $this->db->insert('tbl_review', $data);
            $insert_id = $this->db->insert_id();
            $result =$this->db->affected_rows();
            
            if ($result > 0) {
                return $insert_id;
            } else {
                return FALSE;
            }
    }
    public function fileUpload($dataArr)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");
       
        $data = array(
            'img_cover'     => $dataArr['image_cover'],
            'update_date'   => $cur_date
        );
        $this->db->where('id', $dataArr['rw_id']);
        $this->db->update('tbl_review', $data);

        $result =$this->db->affected_rows();
        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function getDesc($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_review');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update($arr)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");
        
        if($arr['image_cover'] !=''){
            $data = array(
                'name'          => $arr['name'],
                'dsc'           => $arr['desc'],
                'img_cover'     => $arr['image_cover'],
                'update_date'   => $cur_date
            );
        } else {
            $data = array(
                'name'          => $arr['name'],
                'dsc'           => $arr['desc'],
                'update_date'   => $cur_date
            );
        }
        $this->db->where('id', $arr['rw_id']);
        $this->db->update('tbl_review', $data);
        return $this->db->affected_rows();
    }

    public function distroy($id)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");

        $data = array(
            'is_active'     => '0',
            'update_date'   => $cur_date
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_review', $data);
        return $this->db->affected_rows();
    }

}


?>