
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

    public function cat_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query->result_array();

    }
    // get subcategory by category id
    public function cats_list($cate_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_subcategory');
        $this->db->where('is_active', 1);
        $this->db->where('cate_id', $cate_id);
        $this->db->order_by('sub_id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // get product for add to cart
    public function addTotcart($prodict_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('id', $prodict_id);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result_array();

    }

    public function getMaxId()
    {

        $year = date('Y');
        
        $this->db->select_max('id', 'qid');
        $this->db->from('tbl_order');
        $this->db->where('order_year', $year);
        $query = $this->db->get();
        $max_id = $query->row();

        if($max_id->qid > 0){
            $number = $max_id->qid + 1;
        } else {
            $number = 1;
        }
        
        return $number;

    }

    public function addNew($arr)
    {
        $data = array(
            'order_no'      => $arr['pono'],
            'order_year'    => $arr['order_year'],
            'is_timestamp'  => $arr['is_timestamp'],
            'delivery_type' => $arr['delivery_type'],
            'create_date'   => $arr['create_date']
        );
        $this->db->insert('tbl_order', $data);
        $insert_id = $this->db->insert_id();
        $result =$this->db->affected_rows();
        return $insert_id;


    }
    public function updateOrder($totl_delivery,$order_id)
    {

        $data = array(
            'order_delivery'    => $totl_delivery
        );
        $this->db->where('id', $order_id);
        $this->db->update('tbl_order', $data);
        return $this->db->affected_rows();

    }

    public function insertOrderDesc($arr)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");
        $i=0;
        foreach($arr as $val) {
            $dataToSave = array(
                'order_id'      => $val['order_id'],
                'product_id'    => $val['product_id'],
                'product_name'  => $val['product_name'],
                'qty'           => $val['qty'],
                't_size'        => $val['t_size'],
                'subtotal'      => $val['subtotal'],
                'total'         => $val['total'],
                'rank'          => $val['rank'],
                'update_date'   => $cur_date
            );
           $this->db->insert('tbl_order_desc', $dataToSave);
            $i++;
         }
        return $this->db->affected_rows() > 0;
    }

    public function updateOrderTotal($totl_delivery,$order_id)
    {

        $data = array(
            'order_total'   => $totl_delivery
        );
        $this->db->where('id', $order_id);
        $this->db->update('tbl_order', $data);
        return $this->db->affected_rows();

    }

    public function getOrderSummary($order_id)
    {

        $this->db->select('
            o.*,
            SUM(od.qty) AS qty
        ');
        $this->db->from('tbl_order AS o');
        $this->db->join('tbl_order_desc AS od', 'od.order_id = o.id', 'inner');
        $this->db->where('o.is_active', 1);
        $this->db->where('o.is_timestamp', $order_id);
        // $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function updateOrderAddress($arr)
    {

        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");
// 
        $data = array(
            'customer'          => $arr['fname'],
            'order_tel'         => $arr['tel'],
            'order_email'       => $arr['email'],
            'order_address'     => $arr['message'],
            'order_jaw'         => $arr['province'],
            'order_del'         => $arr['district'],
            'order_mo'          => $arr['tambon'],
            'order_pos'         => $arr['poscode'],
            'order_delivery'    => $arr['shippingprice'],
            'order_smprice'     => $arr['grandtotal'],
            'update_date'       => $cur_date
        );
        $this->db->where('is_timestamp', $arr['order_id']);
        $this->db->where('is_active', 1);
        $this->db->update('tbl_order', $data);
        return $this->db->affected_rows();
    }

}

?>