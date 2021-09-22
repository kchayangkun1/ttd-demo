<?php
require_once 'config/database.conf.php';
$db_config  = $config['database'][$config['database']['connect_type']];
$db_connected = mysqli_connect($db_config['host'], $db_config['username'], $db_config['password'], $db_config['database_name']);

mysqli_set_charset($db_connected, $config['database']['charset']);

function query($command_sql)
{
 GLOBAL $db_connected;

 if(!empty($db_connected) and is_object($db_connected) and (get_class($db_connected) == 'mysqli'))
 {
  $query_resource = mysqli_query($db_connected, $command_sql);
 }
 
 if(preg_match('/^\s*(select)\s*/i', $command_sql))
 {
  if(!empty($query_resource))
  {
   $i  = 0;
   $result = array();
   while($row = mysqli_fetch_object($query_resource))
   {
    $result[$i] = $row;
    $i++;
   }

   mysqli_free_result($query_resource);

   return $result;
  }
 }
 else
 {
  if(!empty($query_resource)) return true;
 }
 
 return false;
}

date_default_timezone_set("Asia/Bangkok");

function ip_address()
{
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if(filter_var($client, FILTER_VALIDATE_IP))
	{
	    $ip = $client;
	}
	elseif(filter_var($forward, FILTER_VALIDATE_IP))
	{
	    $ip = $forward;
	}
	else
	{
	    $ip = $remote;
	}

	return $ip;
}

if ( !empty($_POST) ) {
	if ( $_POST['action'] == 'queryProduct' ) {
		$pid = $_POST['pid'];

		if ( !empty($pid) ) {
			$wheres[] = "id = '{$pid}'";
		}

		$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

		$sql	= "SELECT *
					FROM tbl_menu
					{$where}
					LIMIT 1";
		
		$result = query($sql);

		if ( !empty( $result ) ) {
			$data['result'] = 'true';
			$data['data'] 	= $result;
		} else {
			$data['result'] = 'false';
		}
	}
	
	if ( $_POST['action'] == 'checkOut' ) {
		if ( !isset($_SESSION) ) {
			session_start();
		}
	
		$created 	= date('Y-m-d');
		$year 		= date('Y');
		$maxResult 	= current( query("SELECT IFNULL(MAX(id)+1, 1) AS qid FROM tbl_order WHERE order_year = '{$year}'") );
		$maxID 		= $maxResult->qid;
		$pono 		= 'ORDER' . '-' . sprintf("%04d",$maxID) . $year;
		$current_mktime = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
		$is_timestamp = $maxID . $current_mktime;
		$dela 		= $_POST['dela'];

	
		$sql = "INSERT INTO tbl_order 
				(order_no, order_year, is_timestamp, delivery_type, create_date)
				VALUES
				('{$pono}', '{$year}', '{$is_timestamp}', '{$dela}', '{$created}')";
	
		$added = query($sql);
	
		if(!empty($added))
		{
			$order_id = mysqli_insert_id($db_connected);
	
			$delivery = 0;
			$pss = 0;
			foreach ($_SESSION["cart"]['id'] as $key => $value){
		
				$ps = 0;
				$subdp = $_SESSION["cart"]['qty'][$key];
				$pss += ($subdp * 10);
			}

			$totl_delivery = $delivery;

			$rank = 0;
	
			$sqldelivery = "UPDATE tbl_order
							SET order_delivery = '$totl_delivery'
							WHERE id = '{$order_id}'";
	
			query($sqldelivery);
	
			foreach ($_SESSION['cart']['id'] as $key => $value) {
				$total 	= $_SESSION['cart']['qty'][$key] * $_SESSION['cart']['price'][$key];
				$rank++;
				$totl_delivery += $total;
	
				$sqlDesc = "INSERT INTO tbl_order_desc 
						(order_id, product_id, product_name, qty, t_size, subtotal, total, rank) 
						VALUE 
						('{$order_id}', '{$_SESSION['cart']['id'][$key]}', '{$_SESSION['cart']['name'][$key]}', '{$_SESSION['cart']['qty'][$key]}', '{$_SESSION['cart']['size'][$key]}', '{$_SESSION['cart']['price'][$key]}', '{$total}', '{$rank}')";
				query($sqlDesc);
			}
	
			$sqlUpdate = "UPDATE tbl_order
							SET order_total = '{$totl_delivery}'
							WHERE id = '{$order_id}'";
	
			$updated = query($sqlUpdate);
		}

		if ( !empty( $result ) ) {
			$data['order_id'] = $is_timestamp;
			$data['result'] = 'true';
		} else {
			$data['order_id'] = $is_timestamp;
			$data['result'] = 'false';
		}
		
		unset( $_SESSION["cart"] );
		
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
		// date_default_timezone_set("Asia/Bangkok");
	
		// $sToken = "c5jHvRWf7Ej7BeSf1lRbLNFaFPQfzl0DO9AxZYui1lz";
		// $sMessage = "มีรายการสั่งซื้อใหม่เข้ามาค่ะ\n $pono\n กรุณาตรวจสอบ https://brickhousesolutions.co.th/coffee/admin";
	
		
		// $chOne = curl_init(); 
		// curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
		// curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
		// curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
		// curl_setopt( $chOne, CURLOPT_POST, 1); 
		// curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
		// $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
		// curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
		// curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
		// $result = curl_exec( $chOne ); 
	}
}

if(!empty($_POST)){
	if($_POST['action'] == 'checkMoneys'){

		$fname = $_POST['fname'];
		$tel = $_POST['tel'];
		$ceate = date('Y-m-d');

		$sql = "SELECT * FROM tbl_order WHERE customer = '{$fname}' AND order_tel = '{$tel}'";


		$result = query($sql);

		if ( !empty( $result ) ) {
			$data = $result;
		} else {
			$data = 'false';
		}
	}
}


if ( !empty($_GET) ) {
	if ( $_GET['action'] == 'addCart' ) {	
		if ( !isset($_SESSION) ) {
			session_start();
		}

		$wheres[] = "id = '{$_GET["pid"]}'";
		
		$where	= (!empty($wheres)) ? 'WHERE ' . implode(' AND ', $wheres) : null;

		$sql	= "SELECT *
					FROM tbl_product
					{$where}
					LIMIT 1";
		
		$check = query($sql);

		if ( !isset($_SESSION["cart"]['num']) ) {
			$_SESSION["cart"]['num']					= 1;
			$_SESSION["cart"]['id'][$_GET["pid"]] 		= $_GET["pid"];
			$_SESSION["cart"]['qty'][$_GET["pid"]] 		= $_GET["qty"];
			$_SESSION["cart"]['size'][$_GET["pid"]] 	= $_GET["pets"];
			$_SESSION["cart"]['name'][$_GET["pid"]] 	= $check[0]->name;
			$_SESSION["cart"]['img'][$_GET["pid"]] 		= $check[0]->img_cover;
			$_SESSION["cart"]['price'][$_GET["pid"]] 	= $check[0]->price;
		} else {
			$key = array_search($_GET["pid"], $_SESSION["cart"]['id']);

			if ((string)$key != "") {
				$_SESSION["cart"]['qty'][$key] += $_GET["qty"];
			} else {
				$_SESSION["cart"]['num'] 					+= 1;
				$_SESSION["cart"]['id'][$_GET["pid"]] 		= $_GET["pid"];
				$_SESSION["cart"]['qty'][$_GET["pid"]] 		= $_GET["qty"];
				$_SESSION["cart"]['size'][$_GET["pid"]] 	= $_GET["pets"];
				$_SESSION["cart"]['name'][$_GET["pid"]] 	= $check[0]->name;
				$_SESSION["cart"]['img'][$_GET["pid"]] 		= $check[0]->img_cover;
				$_SESSION["cart"]['price'][$_GET["pid"]] 	= $check[0]->price;

			}		
		}

		$data['result'] = 'true';
	}

	if ( $_GET['action'] == 'delCart' ) {
		if ( !empty($_GET["dpid"]) ) {
			if ( !isset($_SESSION) ) {
				session_start();
			}
	
			$_SESSION["cart"]['num'] -= 1;
			unset( $_SESSION["cart"]['id'][$_GET["dpid"]] );
			unset( $_SESSION["cart"]['qty'][$_GET["dpid"]] );
			unset( $_SESSION["cart"]['size'][$_GET["dpid"]] );
			unset( $_SESSION["cart"]['name'][$_GET["dpid"]] );
			unset( $_SESSION["cart"]['img'][$_GET["dpid"]] );
			unset( $_SESSION["cart"]['price'][$_GET["dpid"]] );
			
			$data['result'] = 'true';
		} else {
			$data['result'] = 'false';
		}
	}
}

echo json_encode($data);

?>