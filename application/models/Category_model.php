<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    // query all product catgory
    public function getAll(){

        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('is_active', 1);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getSubByCateId($cate_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_subcategory');
        $this->db->where('cate_id', $cate_id);
        $query = $this->db->get();
        return $query->result_array();

    }
    public function create($c_name){
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");
    
        $data = array(
            'c_name'        => $c_name,
            'is_active'     => '1',
            'create_date'   =>  $cur_date,
            'update_date'   =>  $cur_date
        );
        $this->db->insert('tbl_category', $data);
        return $this->db->affected_rows();
    }

    public function getName($cate_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('id', $cate_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update($c_name,$cate_id)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d");

        $data = array(
            'c_name' => $c_name,
            'update_date'   =>  $cur_date
        );
        $this->db->where('id', $cate_id);
        $this->db->update('tbl_category', $data);
        return $this->db->affected_rows();
    }

    public function distroy($cateid)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d");

        $data = array(
            'is_active' => '0',
            'update_date'   =>  $cur_date
        );
        $this->db->where('id', $cateid);
        $this->db->update('tbl_category', $data);
        return $this->db->affected_rows();

    }

    public function fetchSubcategory()
    {   
        $this->db->select('*');
        $this->db->from('tbl_subcategory');
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function subcate_create($name,$cateName)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");
    
        $data = array(
            'cate_id'       => $cateName,
            'subcate_name'  => $name,
            'is_active'     =>  '1',
            'create_date'   => $cur_date,
            'update_date'   => $cur_date
        );
        $this->db->insert('tbl_subcategory', $data);
        return $this->db->affected_rows();
    }

    public function getSubcate($subcate_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_subcategory');
        $this->db->where('sub_id', $subcate_id);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function update_subcate($c_name,$cate_id,$sub_id)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d");

        $data = array(
            'subcate_name'  => $c_name,
            'cate_id'       => $cate_id,
            'update_date'   =>  $cur_date
        );
        $this->db->where('sub_id', $sub_id);
        $this->db->update('tbl_subcategory', $data);
        return $this->db->affected_rows();
    }

    public function distroy_subcate($subcateid)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");

        $data = array(
            'is_active' => '0',
            'update_date'   =>  $cur_date
        );
        $this->db->where('sub_id', $subcateid);
        $this->db->update('tbl_subcategory', $data);
        return $this->db->affected_rows();
        
    }





















    

    


}


?>