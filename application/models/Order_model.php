
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function orderies_list($id)
    {

        $this->db->select('
            tbl_order.id,
            tbl_order.customer,
            tbl_order.order_year,
            tbl_order.order_no,
            tbl_order.order_tel,
            tbl_order.order_email,
            tbl_order.order_address,
            tbl_order.order_mo,
            tbl_order.order_del,
            tbl_order.order_jaw,
            tbl_order.order_pos,
            tbl_order.order_cost,
            tbl_order.order_total,
            tbl_order.order_delivery,
            tbl_order.delivery_type,
            tbl_order.order_smprice,
            tbl_order.is_timestamp,
            tbl_order.is_check,
            tbl_order.is_status,
            tbl_order.is_active,
            tbl_order.is_recommend,
            tbl_order.create_date,
            tbl_order.update_date,
            tbl_province.province_id,
            tbl_province.province_th,
            tbl_tambon.district_id,
            tbl_tambon.district_th,
            tbl_tambon.tambon_id,
            tbl_tambon.tambon_th
        ');
        $this->db->from('tbl_order');
        $this->db->join('tbl_province', 'tbl_order.order_jaw = tbl_province.province_id', 'left');
        $this->db->join('tbl_tambon', 'tbl_order.order_del = tbl_tambon.district_id AND tbl_order.order_mo = tbl_tambon.tambon_id', 'left');
        $this->db->where('tbl_order.is_active', 1);
        $this->db->where('tbl_order.is_timestamp', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function payslip($arr)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");

        if($arr['image_cover'] !=''){
            $data = array(
                'order_date'    => $arr['dates'],
                'order_time'    => $arr['times'],
                'order_cost'    => $arr['summoney'],
                'slip'          => $arr['image_cover'],
                'update_date'   => $cur_date
            );
            $this->db->where('id', $arr['order_id']);
            $this->db->update('tbl_order', $data);
            return $this->db->affected_rows();
        } else {
            return false;
        }

    }

    public function today_list()
    {
        
        $datenow = date('Y-m-d');  

        $this->db->select('*');
        $this->db->from('tbl_order');
        $this->db->where('is_active', 1);
        $this->db->like('create_date', $datenow); // Produces: WHERE `create_date` LIKE '%2021-09-30%' ESCAPE '!'
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function order_detail($id)
    {
        $this->db->select('
            tbl_order.id,
            tbl_order.customer,
            tbl_order.order_year,
            tbl_order.order_no,
            tbl_order.order_tel,
            tbl_order.order_email,
            tbl_order.order_address,
            tbl_order.order_mo,
            tbl_order.order_del,
            tbl_order.order_jaw,
            tbl_order.order_pos,
            tbl_order.order_date,
            tbl_order.order_time,
            tbl_order.order_cost,
            tbl_order.order_total,
            tbl_order.order_delivery,
            tbl_order.delivery_type,
            tbl_order.order_smprice,
            tbl_order.slip,
            tbl_order.is_timestamp,
            tbl_order.is_check,
            tbl_order.is_status,
            tbl_order.is_active,
            tbl_order.is_recommend,
            tbl_order.create_date,
            tbl_order.update_date,
            tbl_province.province_id,
            tbl_province.province_th,
            tbl_tambon.tambon_id,
            tbl_tambon.tambon_th,
            tbl_tambon.district_th,
            tbl_tambon.district_id
        ');
        $this->db->from('tbl_order');
        $this->db->join('tbl_province', 'tbl_order.order_jaw = tbl_province.province_id', 'left');
        $this->db->join('tbl_tambon', 'tbl_order.order_mo = tbl_tambon.tambon_id AND tbl_order.order_del = tbl_tambon.district_id', 'left');
        $this->db->where('tbl_order.id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function item_list($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_order_desc');
        $this->db->where('order_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function updateIs_check($orderid)
    {
        
        $data = array(
            'is_check'  => '1',
            'is_status' => '1'
        );
        $this->db->where('id', $orderid);
        $this->db->update('tbl_order', $data);
        return $this->db->affected_rows();

    }

    public function order_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_order');
        $this->db->where('is_active', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();

    }

}

?>