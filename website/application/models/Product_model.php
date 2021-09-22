<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function products_sele_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('is_active', 1);
        $this->db->where('is_recommend', 1);
        $this->db->limit(8);
        $query = $this->db->get();
        return $query->result_array();
        
    }
    public function product_detail($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
        
    }
    public function producties_list($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('is_active', 1);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
        
    }
    public function products_img_list($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_product_image');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        return $query->result_array();

    }
    public function rands_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('is_active', 1);
        $this->db->order_by('is_active', 'RANDOM');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function caties_list($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_subcategory');
        $this->db->where('is_active', 1);
        $this->db->where('sub_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    // ไว้สำหรับนับข้อมูลทั้งหมด total_rows
    public function countProGroup($pid)
    {   
        return $this->db->where(['is_active'=> 1])->where('cat_name',$pid)->from("tbl_product")->count_all_results();
    }

    public function products_list($limit, $start, $pid)
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('is_active', '1');
        $this->db->where('cat_name', $pid);
        $this->db->limit($limit, $start); 
        $query = $this->db->get();
        return $query->result_array();
        
    }

    public function fetchAll()
    {
        $this->db->select('p.*, s.subcate_name, s.cate_id');
        $this->db->from('tbl_product AS p');
        $this->db->join('tbl_subcategory AS s', 's.sub_id = p.cat_name', 'inner');
        $this->db->where('p.is_active', '1');
        $this->db->order_by('p.id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function update_recomm($id,$st)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d");

        $data = array(
            'is_recommend'  => $st,
            'update_date'   => $cur_date
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_product', $data);
        return $this->db->affected_rows();
    }

    public function distroy($id)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d");

        $data = array(
            'is_active'  => $st,
            'update_date'   => $cur_date
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_product', $data);
        return $this->db->affected_rows();
    }
    public function create($arr)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d");
    
        $data = array(
            'name'          => $arr['name'],
            'cat_name'      => $arr['sub_cate'],
            'size_xs'       => $arr['size_xs'],
            'size_s'        => $arr['size_s'],
            'size_m'        => $arr['size_m'],
            'size_l'        => $arr['size_l'],
            'size_xl'       => $arr['size_xl'],
            'price'         => $arr['price'],
            'dsc'           => $arr['description'],
            'create_date'   => $cur_date,
            'update_date'   => $cur_date
        );
        $this->db->insert('tbl_product', $data);
        $insert_id = $this->db->insert_id();
        $result =$this->db->affected_rows();
        if ($result > 0) {
            return $insert_id;
        } else {
            return FALSE;
        }
    }

    // update image Cover
    public function updatefileUpload($dataArr)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d");

        $data = array(
            'img_cover' => $dataArr['image_cover'],
            'update_date' => $cur_date
        );
        $this->db->where('id', $dataArr['pd_id']);
        $this->db->update('tbl_product', $data);
        return $this->db->affected_rows();
    }

    // upload product image
    public function insertProductImg($dataArr2,$last_pid)
    {
        $i = 1;
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");
        
        foreach($dataArr2 as $val) {
            $dataToSave = array(
                'product_id'    => $last_pid,
                'img_name'      => $val['image_cover'],
                'order_id'      => $i,
                'create_date'   => $cur_date
            );
           $this->db->insert('tbl_product_image', $dataToSave);
            $i++;
         }
        return $this->db->affected_rows() > 0;
    }
    public function update_product($arr){
        
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d");
        
        $data = array(
            'name'          => $arr['name'],
            'cat_name'      => $arr['sub_cate'],
            'size_xs'       => $arr['size_xs'],
            'size_s'        => $arr['size_s'],
            'size_m'        => $arr['size_m'],
            'size_l'        => $arr['size_l'],
            'size_xl'       => $arr['size_xl'],
            'price'         => $arr['price'],
            'dsc'           => $arr['description'],
            'update_date'   => $cur_date
        );

        $this->db->where('id', $arr['product_id']);
        $this->db->update('tbl_product', $data);
        return $this->db->affected_rows(); 
    }



















































































    // for Admin
    public function fetchAllSurgerySkin()
    {
        $this->db->select('
            tbl_product.id,
            tbl_product.name AS p_name,
            tbl_product.is_active,
            tbl_product.is_recommend,
            tbl_product.is_status,
            tbl_product.create_date,
            tbl_product.update_date,
            tbl_car.`name` AS car_name,
            tbl_brand.`name` AS brand_name
        ');
        $this->db->from('tbl_product');
        $this->db->join('tbl_brand', 'tbl_product.brand = tbl_brand.id', 'left');
        $this->db->join('tbl_car', 'tbl_product.car = tbl_car.id', 'left');
        $this->db->where('tbl_product.is_active', 1);
        $this->db->order_by('tbl_product.id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }
    }

    // public function fetchAll(){
    
    //     $this->db->select('*');
    //     $this->db->from('tbl_product');
    //     $this->db->where('is_active', 1);
    //     $this->db->order_by('id', 'ASC');
    //     $query = $this->db->get();
    //     if($query->num_rows() > 0){
    //         $result = $query->result_array();
    //         return $result;
    //     } else {
    //         return false;
    //     }

    // }

    public function productRand(){
        $this->db->select('
            tbl_product.id,
            tbl_product.url_name,
            tbl_product.name,
            tbl_product.brand,
            tbl_product.car,
            tbl_product.model,
            tbl_product.is_active,
            tbl_brand.id AS brand_id,
            tbl_brand.name AS brand_name,
            tbl_brand.is_active AS brand_active,
            tbl_model.id AS model_id,
            tbl_model.name AS model_name
        ');
        $this->db->from('tbl_product');
        $this->db->join('tbl_brand', 'tbl_product.brand = tbl_brand.id', 'INNER');
        $this->db->join('tbl_model', 'tbl_product.model = tbl_model.id', 'INNER');
        $this->db->where('tbl_product.is_active', 1);
        $this->db->order_by('tbl_product.id', 'RANDOM');
        $this->db->limit(1);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }
    }

    // car_list
    public function car_list($id){
       
        if(!empty($id)){
            $where=$this->db->where('c.brand_id=', $id);
        }
        $this->db->select('c.*, b.name AS brand_name');
        $this->db->from('tbl_car AS c');
        $this->db->join('tbl_brand AS b', 'c.brand_id = b.id', 'inner');
        $this->db->where('c.is_active', 1);
        $where;
        $this->db->order_by('c.id', 'ASC');

        $query = $this->db->get();
      //  print_r($this->db->last_query());    

        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }

    }
    // for drop down menu ศัลยกรรม&สกิน
    public function listMenuSurgerySkin($brandId)
    {
       
        if(!empty($brandId)){
            $where=$this->db->where('tbl_brand.id=', $brandId);
        }
        $this->db->select('
            tbl_product.id AS p_id,
            tbl_product.name AS p_name,
            tbl_product.is_active,
            tbl_brand.id AS brand_id,
            tbl_brand.name AS brand_name,
            tbl_car.id AS car_id,
            tbl_car.name AS car_name
        ');
        $this->db->from('tbl_product');
        $this->db->join('tbl_brand', 'tbl_product.brand = tbl_brand.id', 'inner');
        $this->db->join('tbl_car', 'tbl_product.car = tbl_car.id', 'inner');
        $this->db->where('tbl_product.is_active', 1);
        $where;
        $this->db->order_by('tbl_product.id', 'ASC');
        $this->db->limit(8);

        $query = $this->db->get();
      //  print_r($this->db->last_query());    

        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }
    }
    // model_list
    public function model_list($id){
        
        if(!empty($id)){
            $where=$this->db->where('m.car_id=', $id);
        }

        $this->db->select('m.*, c.name AS car_name, p.url_name');
        $this->db->from('tbl_model AS m');
        $this->db->join('tbl_car AS c', 'm.car_id = c.id', 'inner');
        $this->db->join('tbl_product AS p', 'p.id = m.id', 'inner');
        $where;
        $this->db->order_by('p.id', 'DESC');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }

    }
    
    // update product
    public function update($dataArr)
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");
        // 
        $data = array(
            'name'          => $dataArr['pd_name'],
            'short_desc'    => $dataArr['pd_short_dsc'],
            'description'   => $dataArr['pd_dsc'],
            'brand'         => $dataArr['pd_brand_id'],
            'car'           => $dataArr['pd_car_id'],
            'link'          => $dataArr['pd_alink'],
            'update_date'   => $cur_date
        );
        $this->db->where('id', $dataArr['pd_id']);
        $this->db->update('tbl_product', $data);

        $result =$this->db->affected_rows();
        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }



    public function uploadProductImages($dataArr2,$last_pid)
    {
        // unlink($filePath . $value['name']);
        $i = 1;
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");
        // // 
        foreach($dataArr2 as $val) {
            $dataToSave = array(
                'product_id'    => $last_pid,
                'img_name'      => $val['image_cover'],
                'image_type'    => $val['image_type'],
                'file_size'     => $val['file_size'],
                'file_path'     => $val['file_path'],
                'order_id'      => $i,
                'create_date'   => $cur_date
            );
           $this->db->insert('tbl_product_image', $dataToSave);
            $i++;
         }
        return $this->db->affected_rows() > 0;
    }
    // updateUploadProductImages($dataArr2,$pdid,$folderName)
    public function updateUploadProductImages($dataArr2,$pdid,$folderName)
    {
        $i = 1;
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");

        // check is extis images name where product_id
        $this->db->select('
            tbl_product_image.img_id,
            tbl_product_image.product_id,
            tbl_product_image.img_name
        ');
        $this->db->from('tbl_product_image');
        $this->db->where('product_id', $pdid);
        $query = $this->db->get();
        $num = $query->num_rows();
        if($num > 0){
            $result = $query->result_array();
           
            // delete & unlink before upload
            foreach($result as $val){
                $this->db->where('product_id', $pdid);
                $this->db->where('img_name', $val['img_name']);
                $this->db->delete('tbl_product_image');
                // unlink in directory
                unlink($folderName . $val['img_name']);
            }
    
            $deteated = $this->db->affected_rows();
            if($deteated > 0){
                // upload
                foreach($dataArr2 as $val) {
                    $dataToSave1 = array(
                        'product_id'    => $pdid,
                        'img_name'      => $val['image_cover'],
                        'image_type'    => $val['image_type'],
                        'file_size'     => $val['file_size'],
                        'file_path'     => $val['file_path'],
                        'order_id'      => $i,
                        'create_date'   => $cur_date
                    );
                    $this->db->insert('tbl_product_image', $dataToSave1);
                    $i++;
                }
                return $this->db->affected_rows() > 0;
            } else {
                return FALSE;
            }
        } else {
            // null
            // upload
            foreach($dataArr2 as $val) {
                $dataToSave = array(
                    'product_id'    => $pdid,
                    'img_name'      => $val['image_cover'],
                    'image_type'    => $val['image_type'],
                    'file_size'     => $val['file_size'],
                    'file_path'     => $val['file_path'],
                    'order_id'      => $i,
                    'create_date'   => $cur_date
                );
                $this->db->insert('tbl_product_image', $dataToSave);
                $i++;
            }
            $res = $this->db->affected_rows();
            if($res > 0 ){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }

    public function getDsc($getID)
    {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('id', $getID);
        $this->db->limit(1); 
        $query = $this->db->get();

        if($query->num_rows() > 0 ) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    // Change status 'Hot Deal New Arrival Sold'
    public function changeStatus($pID,$pstatus)
    {
        $data = array(
            'is_status' => $pstatus
        );
        $this->db->where('id', $pID);
        $this->db->update('tbl_product', $data);
        $result =$this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // // destroy
    public function destroy($pid,$status){

        $data = array(
            'is_active' => $status
        );
        $this->db->where('id', $pid);
        $this->db->update('tbl_product', $data);
        $result =$this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}


?>