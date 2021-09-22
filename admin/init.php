<?php 
session_start();

function check_login()
{
	if(!empty($_SESSION['user']))
	{
		return true;
	}

	return false;
}

require_once '../config/database.conf.php';
$db_config  = $config['database'][$config['database']['connect_type']];
$db_connected = mysqli_connect($db_config['host'], $db_config['username'], $db_config['password'], $db_config['database_name']);

mysqli_set_charset($db_connected, $config['database']['charset']);

if ( isset( $_POST['is_login'] ) ) {

	$password = md5( $_POST['password'] );
	$sql = "
		select *
		from tbl_admin
		where username = '{$_POST['username']}' and password = '{$password}'
	";

	$result = query($sql);

	if (!empty($result)) {
		$_SESSION['user']['user_id']   	= $result[0]->id;
		$_SESSION['user']['username']  	= $result[0]->username;
		$_SESSION['user']['group_id']  	= $result[0]->group_id;
		$_SESSION['user']['first_name'] = $result[0]->first_name;
		$_SESSION['user']['last_name'] 	= $result[0]->last_name;
		header('location: index.php');
	}
}

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

function slide_list()
{
	$sql	= "SELECT *
				FROM tbl_banner
				WHERE is_active = '1' ";
	
	return query($sql);
}

function product_list()
{
	$sql	= "SELECT p.*, s.subcate_name, s.cate_id
				FROM tbl_product p
				INNER JOIN tbl_subcategory s ON s.sub_id = p.cat_name
				WHERE p.is_active = '1'
				ORDER BY p.id ASC";
	
	return query($sql);
}

function cat_add() {
	$created = date('Y-m-d');

	$sql	 = "INSERT INTO tbl_category
				(c_name, create_date) 
				VALUE 
				('{$_POST['name']}', '{$created}')";
	// exit;
	return query($sql);
}

function cates_list()
{
	$sql	= "SELECT *
				FROM tbl_subcategory
				WHERE is_active = '1'";
	
	return query($sql);
}

function cat_list()
{
	$sql	= "SELECT *
				FROM tbl_category
				WHERE is_active = 1";
	
	return query($sql);
}

function review_list()
{
	$sql	= "SELECT *
				FROM tbl_review
				WHERE is_active = '1' ";
	
	return query($sql);
}

function cates_detail($id)
{	
	$wheres[] = "sub_id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM tbl_subcategory
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function cat_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM tbl_category
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function slide_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM tbl_banner
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function product_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM tbl_product
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function subcate_list($id = '')
{	
	if (!empty($id)) {
		$wheres[] = "cate_id = '{$id}'";
	}

	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM tbl_subcategory
				{$where}
				ORDER BY sub_id ASC";
	
	return query($sql);
}

function review_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM tbl_review
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function slide_add() {
	$created = date('Y-m-d');

	$sql	 = "INSERT INTO tbl_banner
				(name, create_date) 
				VALUE 
				('{$_POST['name']}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$slide_id = mysqli_insert_id($db_connected);

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../assets/images/banner/' . $slide_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $storage_path . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				$sql = "UPDATE tbl_banner SET img_cover = '{$file_name}' WHERE id = '{$slide_id}'";
				query($sql);
			}
		}
	}

	return $added;
}

function review_add() {
	$created = date('Y-m-d');

	$sql	 = "INSERT INTO tbl_review
				(name, dsc, create_date) 
				VALUE 
				('{$_POST['name']}', '{$_POST['description']}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$slide_id = mysqli_insert_id($db_connected);

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../assets/images/review/' . $slide_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $storage_path . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				$sql = "UPDATE tbl_review SET img_cover = '{$file_name}' WHERE id = '{$slide_id}'";
				query($sql);
			}
		}
	}

	return $added;
}

function review_edit() {
	$update_date 	= date('Y-m-d');
	$logo_id 	= $_POST['logo_id'];

	$sql = "UPDATE tbl_review
			SET name = '{$_POST['name']}', dsc = '{$_POST['description']}', update_date = '{$update_date}'
			WHERE id = '{$logo_id}'";
	// exit;
	$updated = query($sql);

	if(!empty($updated))
	{
		global $db_connected;

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../assets/images/review/' . $logo_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $filePath . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				$sql = "UPDATE tbl_review SET img_cover = '{$file_name}' WHERE id = '{$logo_id}'";
				query($sql);
			}
		}
	}

	return $updated;
}

function product_add() {
	$created = date('Y-m-d');

	$sql	 = "INSERT INTO tbl_product
				(name, cat_name, size_xs, size_s, size_m, size_l, size_xl, price, dsc, create_date) 
				VALUE 
				('{$_POST['name']}', '{$_POST['sub_cate']}', '{$_POST['size_xs']}', '{$_POST['size_s']}', '{$_POST['size_m']}', '{$_POST['size_l']}', '{$_POST['size_xl']}', '{$_POST['price']}', '{$_POST['description']}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$slide_id = mysqli_insert_id($db_connected);

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../assets/images/product/cover/' . $slide_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $storage_path . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				$sql = "UPDATE tbl_product SET img_cover = '{$file_name}' WHERE id = '{$slide_id}'";
				query($sql);
			}
		}

		if (!empty($_FILES['pdImg'])) {
			include('vendor/upload/class.fileuploader.php');

			$filePath 	= '../assets/images/product/' . $slide_id . '/';
			$path 		= realpath($filePath);

			if ( !is_dir($path) ) {
				mkdir($filePath);
			}

			// initialize FileUploader
		    $FileUploader = new FileUploader('pdImg', array(
		        'uploadDir' => $filePath,
		        'title' 	=> 'name'
		    ));

		    // call to upload the files
    		$data = $FileUploader->upload();

    		// if uploaded and success
		    if($data['isSuccess'] && count($data['files']) > 0) {
		        // get uploaded files
		        $uploadedFiles = $data['files'];
		    }

		    // get the fileList
			$fileList = $FileUploader->getFileList();			

			if ( !empty($fileList) ) {
				$i = 1;
				foreach ($fileList as $img) {
					$sql = "INSERT INTO tbl_product_image (product_id, img_name, order_id, create_date) VALUE ('{$slide_id}', '{$img['name']}', '{$i}', '{$created}')";
					query($sql);

					$i++;
				}
			}
		}
	}

	return $added;
}

function slide_edit() {
	$update_date 	= date('Y-m-d');
	$slide_id 	= $_POST['slide_id'];

	$sql = "UPDATE tbl_banner
			SET name = '{$_POST['name']}', update_date = '{$update_date}'
			WHERE id = '{$slide_id}'";
	// exit;
	$updated = query($sql);

	if(!empty($updated))
	{
		global $db_connected;

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../assets/images/banner/' . $slide_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $filePath . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				/*$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				resizeImg( $originalFile, $targetFile, $file_extension, 1000, 1000 );*/
				$sql = "UPDATE tbl_banner SET img_cover = '{$file_name}' WHERE id = '{$slide_id}'";
				query($sql);
			}
		}
	}

	return $updated;
}

function cat_edit() {
	$update_date 	= date('Y-m-d');
	$slide_id 	= $_POST['slide_id'];

	$sql = "UPDATE tbl_category
			SET c_name = '{$_POST['name']}', update_date = '{$update_date}'
			WHERE id = '{$slide_id}'";
	// exit;
	return query($sql);
}

function cates_add() {
	$created = date('Y-m-d');

	$sql	 = "INSERT INTO tbl_subcategory
				(subcate_name, cate_id, create_date) 
				VALUE 
				('{$_POST['name']}', '{$_POST['brand']}', '{$created}')";
	// exit;
	return query($sql);
}

function cates_edit() {
	$update_date 	= date('Y-m-d H:i:s');
	$slide_id 	= $_POST['slide_id'];

	$sql = "UPDATE tbl_subcategory
			SET subcate_name = '{$_POST['name']}', cate_id = '{$_POST['brand']}', update_date = '{$update_date}'
			WHERE sub_id = '{$slide_id}'";
	// exit;
	return query($sql);
}

function logo_list()
{
	$sql	= "SELECT *
				FROM tbl_logo
				WHERE is_active = '1'
				ORDER BY id ASC
				LIMIT 1";
	
	return query($sql);
}

function logo_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM tbl_logo
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function logo_add() {
	$created = date('Y-m-d H:i:s');

	$sql	 = "INSERT INTO tbl_logo
				(name, short_desc, address, create_date) 
				VALUE 
				('{$_POST['name']}', '{$_POST['short_desc']}', '{$_POST['address']}', '{$created}')";
	// exit;
	$added = query($sql);

	if(!empty($added))
	{
		global $db_connected;

		$logo_id = mysqli_insert_id($db_connected);

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../assets/images/logo/' . $logo_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $storage_path . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				$originalFile 	= $file_path;
				$targetFile 	= $file_path;

				$sql = "UPDATE tbl_logo SET img_cover = '{$file_name}' WHERE id = '{$logo_id}'";
				query($sql);
			}
		}
	}

	return $added;
}

function product_edit() {
	$update_date 	= date('Y-m-d');
	$logo_id 	= $_POST['logo_id'];

	$sql = "UPDATE tbl_product
			SET name = '{$_POST['name']}', cat_name = '{$_POST['sub_cate']}', size_xs = '{$_POST['size_xs']}', size_s = '{$_POST['size_s']}', size_m = '{$_POST['size_m']}', size_l = '{$_POST['size_l']}', size_xl = '{$_POST['size_xl']}', price = '{$_POST['price']}', dsc = '{$_POST['description']}', update_date = '{$update_date}'
			WHERE id = '{$logo_id}'";
	// exit;
	$updated = query($sql);

	if(!empty($updated))
	{
		global $db_connected;

		if(!empty($_FILES['covImg']))
		{
			$file_name		= $_FILES['covImg']["name"];
			$file_name		= preg_replace('/[^\w\._]+/', '_', $file_name);
			$filePath 		= '../assets/images/product/cover/' . $logo_id . '/';
			$file_path		= $filePath . $file_name;

			if ( !is_dir($filePath) ) {
				mkdir($filePath);
			}
			
			if(file_exists($file_path))
			{
				$number			= 2;
				$file_exists	= true;
				$file_extension	= null;

				preg_match('/(\.([a-zA-Z]+))$/i', $file_name, $matchs);
				if(!empty($matchs[2]))
				{
					$file_extension = $matchs[2];
				}

				$file_name_only	= preg_replace("/(\.{$file_extension})/i", null, $file_name);

				while(file_exists($file_path))
				{
					$file_name = $file_name_only . "_{$number}.{$file_extension}";
					$file_path = $filePath . $file_name;
					
					$number++;
				}
			}

			$moved = move_uploaded_file($_FILES['covImg']["tmp_name"], $file_path);

			if($moved)
			{
				$sql = "UPDATE tbl_product SET img_cover = '{$file_name}' WHERE id = '{$logo_id}'";
				query($sql);
			}
		}
	}

	return $updated;
}

function recommend_list()
{
	$sql	= "SELECT *
				FROM tbl_product
				WHERE is_active = '1' AND is_recommend = '1'
				ORDER BY id ASC";
	
	return query($sql);
}

function promotion_list()
{
	$sql	= "SELECT *
				FROM tbl_product
				WHERE is_active = '1' AND promotion = '1'
				ORDER BY id ASC";
	
	return query($sql);
}

function order_list()
{
	$sql	= "SELECT *
				FROM tbl_order
				WHERE is_active = '1'
				ORDER BY id DESC";
	
	return query($sql);
}

function order_detail($id)
{	
	$wheres[] = "id = '{$id}'";
	$where	= (!empty($wheres)) ? 'WHERE ' . implode('AND ', $wheres) : null;

	$sql	= "SELECT *
				FROM tbl_order
				{$where}
				LIMIT 1";
	
	$result = query($sql);

	return (!empty($result)) ? current($result) : false;
}

function order_edit() {
	// $update_date 	= date('Y-m-d H:i:s');
	$order_id 	= $_POST['order_id'];

	$sql = "UPDATE tbl_order
			SET is_check = '1', is_status = '1'
			WHERE id = '{$order_id}'";
	// exit;
	$updated = query($sql);

	return $updated;
}

function storage_path($destination = null)
{
	 if(!empty($destination))
		 {
		  	$destination = $destination . DIRECTORY_SEPARATOR;
		 }

 	return preg_replace('/((\\\|\/)admin)/', DIRECTORY_SEPARATOR, __DIR__) . 'assets/images/description' . DIRECTORY_SEPARATOR . $destination;
	}

function storage_url($destination = null)
{
 if(!empty($destination))
 {
  $destination = $destination . '/';
 }

 $_uri = explode('/', $_SERVER['PHP_SELF']);
 
 array_pop($_uri);
 array_pop($_uri);
 
 $_uri[0]= $_SERVER['HTTP_HOST'];
 $_uri[] = 'assets/images/description';
 $uri = implode('/', $_uri);

 return "http://{$uri}/{$destination}";
}

?>

