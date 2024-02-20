<?php session_start(); 
include('../server/connection.php');
$decode = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['svn_fname'])) {
    // The session variable 'svn_fname' is not set, so deny access
    header('HTTP/1.1 403 Forbidden');
    echo 'Access Denied';
    exit;
}

$sivanat_user = $_SESSION['svn_fname'];

if(@$decode['case']=='add_category'){
	try {
		$query = " INSERT INTO `product_category`(`cat_name`, `create_user`, `create_datetime`) VALUES ('".trim($decode['cat_name'])."','".$sivanat_user."',now())
	                     ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array('status'=>1);
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='del_category'){
	try {
		$query = " DELETE FROM `product_category` WHERE cat_id = '".$decode['cat_id']."' ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array('status'=>1);
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='chk_category'){
	$data[0] = array('status'=>0);
	$query = " SELECT t1.cat_id, t1.cat_name, COALESCE(COUNT(t2.cat_sub_id), 0) AS sub_category_count
				FROM product_category t1
				LEFT JOIN product_category_sub t2 ON t1.cat_id = t2.cat_id
				GROUP BY t1.cat_id, t1.cat_name;
			 ";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$data[0] = array('status'=>1);
		$data[] = $row;
	}  

echo json_encode(@$data);
}else if(@$decode['case']=='chk_sub_category'){
	$data[0] = array('status'=>0);
	$query = " SELECT t1.`cat_sub_id`, t1.`cat_id`, t1.`cat_sub_name`, t2.cat_name ,COALESCE(COUNT(t3.product_id), 0) AS product_count FROM `product_category_sub` AS t1 LEFT JOIN `product_category` AS t2 ON t1.cat_id = t2.cat_id LEFT JOIN `product_info` AS t3 ON t1.cat_sub_id = t3.cat_sub_id GROUP BY t1.`cat_sub_id`, t1.`cat_id`, t1.`cat_sub_name`, t2.cat_name ORDER BY cat_id,cat_sub_id;
			 ";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$data[0] = array('status'=>1);
		$data[] = $row;
	}  

echo json_encode(@$data);
}else if(@$decode['case']=='add_sub_category'){
	try {
		$query = " INSERT INTO `product_category_sub`( `cat_id`, `cat_sub_name`, `cat_create`, `cat_datetime`)  VALUES ('".$decode['cat_id']."','".trim($decode['cat_sub_name'])."','".$sivanat_user."',now())
	                     ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array('status'=>1);
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='del_sub_category'){
	try {
		$query = " DELETE FROM `product_category_sub` WHERE `cat_sub_id` = '".$decode['cat_sub_id']."' ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array('status'=>1);
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='change_category'){
	try {
		if($decode['type']=='หมวดหมู่'){
			$query = " UPDATE `product_category` SET cat_name =  '".trim($decode['val'])."' WHERE `cat_id` = '".$decode['id']."' ";  
		}else if($decode['type']=='ประเภท'){
			$query = " UPDATE `product_category_sub` SET cat_sub_name =  '".trim($decode['val'])."' WHERE `cat_sub_id` = '".$decode['id']."' ";  
		}
	    $stmt = $conn->query( $query ); 
		$data[0] = array('status'=>1);
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='select_sub_category'){
	$data[0] = array('status'=>0);
	$query = " SELECT `cat_sub_id`, `cat_sub_name` FROM `product_category_sub` WHERE  `cat_id` = '".$decode['cat_id']."'
			 ";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$data[0] = array('status'=>1);
		$data[] = $row;
	}  
	echo json_encode(@$data);
}else if(@$decode['case']=='chk_deli_category'){
	$data[0] = array('status'=>0);
	$query = " SELECT t1.`delivery_cat_id`, t1.`delivery_cat_name`, COALESCE(COUNT(t2.`product_id`), 0) AS product_count
	FROM `delivery_category` AS t1
	LEFT JOIN `delivery_product` AS t2 ON t1.`delivery_cat_id` = t2.`delivery_cat_id`
	GROUP BY t1.`delivery_cat_id`, t1.`delivery_cat_name`;
			 ";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$data[0] = array('status'=>1);
		$data[] = $row;
	}  

echo json_encode(@$data);
}else if(@$_REQUEST['case']=='search_product'){
	$data[0] = array('status'=>0);
	$query = " SELECT `product_id`, `product_name` FROM `product_info` WHERE  `product_active` = '1' 
	AND (`product_id` like '%{$_REQUEST['search']}%' OR `product_name` like '%{$_REQUEST['search']}%')
			 ";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$data[0] = array('status'=>1);
		$data[] = $row;
	}  

echo json_encode(@$data);
}else if(@$decode['case']=='submit_cat_deli_product'){
	$product_name = $decode['product_name'];
	$product_temp = explode("|",$product_name);

	if (is_array($product_temp) && count($product_temp) > 1) {
		$product_temp[0] = trim($product_temp[0]);
		$product_temp[1] = trim($product_temp[1]);
		$chk_product_db = 0;

		$query = " SELECT 1 FROM `product_info` WHERE product_active = 1 AND product_id = '{$product_temp[0]}'
				";  
		$stmt = $conn->query($query);  
		while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
			$chk_product_db = 1;
		}   

		if(@$chk_product_db == 1){
			try{
				$query = " INSERT INTO `delivery_product`(`delivery_cat_id`, `product_id`, `delivery_type`, `create_user`, `create_datetime`) 
				VALUES ('{$decode['delivery_cat_id']}','{$product_temp[0]}','{$decode['delivery_type']}','{$sivanat_user}',now())
						";  
				$stmt = $conn->query($query);  
			$data[0] = array('status'=>1);
			} catch(PDOException $e) {
				$data[0] = array('status'=>0,"error_message" => $e->getMessage()); 
			}
		}else{
			$data[0] = array('status'=>0,"error_message"=>"ขออภัย ข้อมูลไม่ถูกต้อง กรุณาระบุและเลือกข้อมูลเท่านั้น"); 
		}
	}else{
		$data[0] = array('status'=>0,"error_message"=>"ขออภัย ข้อมูลไม่ถูกต้อง กรุณาระบุและเลือกข้อมูลเท่านั้น"); 
	}
echo json_encode(@$data); 
}else if(@$decode['case']=='del_deli_cat_product'){
	
		try{
				$query = " DELETE FROM  `delivery_product` WHERE nIndex = '{$decode['nIndex']}'
						";  
				$stmt = $conn->query($query);  
			$data[0] = array('status'=>1);
			} catch(PDOException $e) {
				$data[0] = array('status'=>0,"error_message" => $e->getMessage()); 
			}

echo json_encode(@$data); 
}else if(@$decode['case']=='chk_deli_product'){
	$data[0] = array('status'=>0);
	$query = " SELECT t1.nIndex,t1.delivery_type,t1.product_id,t2.delivery_cat_name,t3.product_name , `delivery_type` FROM `delivery_product` AS t1 INNER JOIN `delivery_category` AS t2 ON t1.delivery_cat_id = t2.delivery_cat_id LEFT JOIN product_info AS t3 ON t1.product_id = t3.product_id;
			 ";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$data[0] = array('status'=>1);
		$data[] = $row;
	}  
echo json_encode(@$data);
}

?>