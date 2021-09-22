<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cart extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->library('session');
        $this->load->library('pagination');
		
		$this->load->model('Cart_model'); 
		$this->load->model('Product_model');
		$this->load->model('Review_model'); 
        $this->load->model('Province_model');
	}
    public function index()
    {
		$data['cats_list'] = $this->Cart_model->cat_list();
		
		$this->load->view('head',$data);
		$this->load->view('cart/list_cart',$data);
		
    }
    public function addToCart()
    {
        $this->security->get_csrf_token_name(); 
        $this->security->get_csrf_hash(); 
        $pid = $this->security->xss_clean($this->input->post('pid', TRUE));
        $qty = $this->security->xss_clean($this->input->post('qty', TRUE));
        $pets = $this->security->xss_clean($this->input->post('pets', TRUE));
        $action = $this->security->xss_clean($this->input->post('action', TRUE));
    
        if(!empty($pid) && $action =='addCart'){
            $res = $this->Cart_model->addTotcart($pid);
            
            if ( !isset($_SESSION["cart"]['num']) ) {
                $_SESSION["cart"]['num']			= 1;
                $_SESSION["cart"]['id'][$pid] 		= $pid;
                $_SESSION["cart"]['qty'][$pid] 		= $qty;
                $_SESSION["cart"]['size'][$pid] 	= $pets;
                $_SESSION["cart"]['name'][$pid] 	= $res[0]['name'];
                $_SESSION["cart"]['img'][$pid] 		= $res[0]['img_cover'];
                $_SESSION["cart"]['price'][$pid] 	= $res[0]['price'];
            } else {
                $key = array_search($pid, $_SESSION["cart"]['id']);
                if ((string)$key != "") {
                    $_SESSION["cart"]['qty'][$key] += $qty;
                } else {
                    $_SESSION["cart"]['num'] 					+= 1;
                    $_SESSION["cart"]['id'][$pid] 		= $pid;
                    $_SESSION["cart"]['qty'][$pid] 		= $qty;
                    $_SESSION["cart"]['size'][$pid] 	= $pets;
                    $_SESSION["cart"]['name'][$pid] 	= $res[0]['name'];
                    $_SESSION["cart"]['img'][$pid] 		= $res[0]['img_cover'];
                    $_SESSION["cart"]['price'][$pid] 	= $res[0]['price'];
                }
            }
            $data['result'] = 'true';
        } else{
            echo 'false';
        }
        echo json_encode($data);
    }

    public function delCart()
    {
        $dpid = $this->security->xss_clean($this->input->post('dpid', TRUE));
        $action = $this->security->xss_clean($this->input->post('action', TRUE));
        
        if ($action == 'delcartItem' ) {
            if ( !empty($dpid) ) {
                if (!isset($_SESSION) ) {
                   $this->session->all_userdata();
                }
        
                $_SESSION["cart"]['num'] -= 1;
                unset( $_SESSION["cart"]['id'][$dpid] );
                unset( $_SESSION["cart"]['qty'][$dpid] );
                unset( $_SESSION["cart"]['size'][$dpid] );
                unset( $_SESSION["cart"]['name'][$dpid] );
                unset( $_SESSION["cart"]['img'][$dpid] );
                unset( $_SESSION["cart"]['price'][$dpid] );
                
                $data['result'] = 'true';
            } else {
                $data['result'] = 'false';
            }
        }
        echo json_encode($data);
    }
    public function checkOut()
    {
        $action = $this->security->xss_clean($this->input->post('action', TRUE));
        $dela = $this->security->xss_clean($this->input->post('dela', TRUE));
        
        if ($action == 'checkOut') {
            if (!isset($_SESSION) ) {
                $this->session->all_userdata();
            }

            $resmax_id = $this->Cart_model->getMaxId();
        
            $year 		= date('Y');
            $created    = date('Y-m-d');
            $pono 		= 'ORDER' . '-' . sprintf("%04d",$resmax_id) . $year;
            
            $cur_time = mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
            $is_timestamp = $resmax_id . $cur_time;

            $data = array(
                'pono'          => $pono,
                'order_year'    => $year,
                'is_timestamp'  => $is_timestamp,
                'delivery_type' => $dela,
                'create_date'   => $created
            );
            $order_id = $this->Cart_model->addNew($data);

            $delivery = 0;
			$pss = 0;
            foreach ($_SESSION["cart"]['id'] as $key => $value){
				$ps = 0;
				$subdp  = $_SESSION["cart"]['qty'][$key];
				$pss    += ($subdp * 10);

			}

            $totl_delivery = $delivery;
            $rank = 0;

            $updated = $this->Cart_model->updateOrder($totl_delivery,$order_id);
            if($updated > 0 ){
                foreach ($_SESSION['cart']['id'] as $key => $value) {
                    $total 	= $_SESSION['cart']['qty'][$key] * $_SESSION['cart']['price'][$key];
                    $rank++;
                    $totl_delivery += $total;

                    $orderDsc[] =array(
                        'order_id'  => $order_id,
                        'product_id'    => $_SESSION['cart']['id'][$key],
                        'product_name'  => $_SESSION['cart']['name'][$key],
                        'qty'           => $_SESSION['cart']['qty'][$key],
                        't_size'        => $_SESSION['cart']['size'][$key],
                        'subtotal'      => $_SESSION['cart']['price'][$key],
                        'total'         => $total,
                        'rank'          => $rank
                    );

                }

                $ordererdesc = $this->Cart_model->insertOrderDesc($orderDsc);
                if($ordererdesc > 0){
                    $result = $this->Cart_model->updateOrderTotal($totl_delivery,$order_id);
                } else{
                    return false;
                }

            } else{
                return false;
            }
            if ($result > 0 ) {
                $data['order_id'] = $is_timestamp;
                $data['result'] = 'true';
            } else {
                $data['order_id'] = $is_timestamp;
                $data['result'] = 'false';
            }
            echo json_encode($data);
        }
    }

    public function details()
    {
        $orderid = $this->security->xss_clean($this->input->get('id', TRUE));

		$data['cats_list'] = $this->Cart_model->cat_list(); 
        $data['provinces'] = $this->Province_model->fetchAll();
        $data['price_list'] = $this->Cart_model->getOrderSummary($orderid);
        
		$this->load->view('head',$data);
		$this->load->view('cart/list_order_desc',$data);
    }

    public function shipping()
    {
        date_default_timezone_set("Asia/Bangkok");
        $cur_date = date("Y-m-d H:i:s");

        $fname = $this->security->xss_clean($this->input->post('fname', TRUE));
        $tel = $this->security->xss_clean($this->input->post('tel', TRUE));
        $email = $this->security->xss_clean($this->input->post('email', TRUE));
        $message = $this->security->xss_clean($this->input->post('message', TRUE));
    
        $province = $this->security->xss_clean($this->input->post('inputProvince', TRUE));
        $district = $this->security->xss_clean($this->input->post('inputDistrict', TRUE));
        $tambon = $this->security->xss_clean($this->input->post('inputTumbon', TRUE));
        $poscode = $this->security->xss_clean($this->input->post('pos', TRUE));
        $shippingprice = $this->security->xss_clean($this->input->post('shippingprice', TRUE)); 
        $grandtotal = $this->security->xss_clean($this->input->post('grandtotal', TRUE)); 
        $order_id	= $this->security->xss_clean($this->input->post('orderid', TRUE)); 

        $data = array(
            'fname'         => $fname,
            'tel'           => $tel,
            'email'         => $email,
            'message'       => $message,
            'province'      => $province,
            'district'      => $district,
            'tambon'        => $tambon,
            'poscode'       => $poscode,
            'shippingprice' => $shippingprice,
            'grandtotal'    => $grandtotal,
            'order_id'      => $order_id,
            'update_date'   => $cur_date
        );
        $response = $this->Cart_model->updateOrderAddress($data);

        if($response > 0){
            redirect('payment/order/?id='.$order_id);
        } else {
            redirect('error/error_404');
        }
    }

}
