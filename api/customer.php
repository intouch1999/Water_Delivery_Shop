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

if(@$decode['case']=='deli_add_customer'){
	try {
    
        $query = " SELECT IFNULL(CONCAT('C', LPAD(MAX(CAST(SUBSTRING(cus_id, 2) AS UNSIGNED))+1, 5, '0')), 'C00001') AS cus_id FROM `delivery_customer` 
        ";  
        $stmt = $conn->query($query);  
        while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
                $cus_id =  $row['cus_id'];
        }  
    
		$query = " INSERT INTO `delivery_customer`(`cus_id`, `cus_name`, `comp_type`, `cus_tel`,cus_contact, `cus_address`, `lat`, `lon`, `tax_cus_name`, `tax_main_branch`, `tax_cus_branch`, `tax_cus_id`, `tax_cus_addr`, `tax_cus_postcode`, `create_user`, `create_datetime`) VALUES ('{$cus_id}','{$decode['deli_cus_name']}','{$decode['comp_type']}','{$decode['deli_cus_tel']}','{$decode['deli_cus_contact']}','{$decode['deli_cus_address']}','{$decode['lat']}','{$decode['long']}','{$decode['tax_cus_name']}','{$decode['tax_main_branch']}','{$decode['tax_cus_branch']}','{$decode['tax_cus_id']}','{$decode['tax_cus_addr']}','{$decode['tax_cus_postcode']}','".$sivanat_user."',now())
	                     ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array('status'=>1);
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='chk_deli_customer'){  

    $data[0] = array('status'=>0);
	$query = "  SELECT `cus_id`, `cus_name`, CASE WHEN `comp_type` = 'general' THEN 'ทั่วไป' WHEN `comp_type` = 'company' THEN 'นิติบุคคล' ELSE comp_type END as comp_type , `cus_address`, `lat`, `lon`, `create_user`, `create_datetime` FROM `delivery_customer`
			 ";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$data[0] = array('status'=>1);
		$data[] = $row;
	}  

    echo json_encode(@$data);
} else if(@$decode['case']=='deli_edit_customer'){  

	$query = "  SELECT `cus_id`, `cus_name`, `comp_type`, `cus_tel`,cus_contact, `cus_address`, `lat`, `lon`, `tax_cus_name`, `tax_main_branch`, `tax_cus_branch`, `tax_cus_id`, `tax_cus_addr`, `tax_cus_postcode`, `create_user`, `create_datetime` FROM `delivery_customer` WHERE cus_id = '{$decode['cus_id']}'
			 ";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){  
		$data[] = $row;
	}  

    echo json_encode(@$data);
} else if(@$decode['case']=='deli_edit_customer_submit'){
	try {
		$query = " 
	     UPDATE delivery_customer
		 SET `cus_name` = '{$decode['deli_cus_name']}'
		 , `comp_type` = '{$decode['comp_type']}'
		 , `cus_tel` = '{$decode['deli_cus_tel']}'
		 , cus_contact = '{$decode['deli_cus_contact']}'
		 , `cus_address` = '{$decode['deli_cus_address']}'
		 , `lat` = '{$decode['lat']}'
		 , `lon` = '{$decode['long']}'
		 , `tax_cus_name` = '{$decode['tax_cus_name']}'
		 , `tax_main_branch` = '{$decode['tax_main_branch']}'
		 , `tax_cus_branch` = '{$decode['tax_cus_branch']}'
		 , `tax_cus_id` = '{$decode['tax_cus_id']}'
		 , `tax_cus_addr` = '{$decode['tax_cus_addr']}'
		 , `tax_cus_postcode` = '{$decode['tax_cus_postcode']}'
		 , `create_user` = '".$sivanat_user."'
		 , `create_datetime` = now()
		 WHERE `cus_id` = '{$decode['cus_id']}'
		";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array('status'=>1);
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
} else if(@$decode['case']=='deli_task'){
// 	try {
// 	$data = array();
// 	$data[0] = array('status' => 0);
	
// 	$searchCus = $decode['SearchCus'];
	
// 	$query = "SELECT `cus_id`, `cus_name`, `comp_type`, `cus_address`, `lat`, `lon`, `create_user`, `create_datetime` FROM `delivery_customer` WHERE `cus_name` = :searchCus";
	
// 	$stmt = $conn->prepare($query);
// 	$stmt->bindParam(':searchCus', $searchCus, PDO::PARAM_STR);
// 	$stmt->execute();
	
// 		if ($stmt->rowCount() > 0) {
// 			$data[0]['status'] = 1;
// 			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
// 				$data[] = $row;
// 			}
// 		} else {
// 			$data[0]['status'] = 0;
// 		}

// 	} catch(PDOException $e) {
// 	$data[0]['error_message'] = $e->getMessage();
// }
try {
    $data = array();
    $data[0] = array('status' => 0);
    
    $searchCus = $decode['SearchCus'];
    
    $query = "SELECT `cus_id`, `cus_name`, `comp_type`, `cus_address`, `lat`, `lon`, `create_user`, `create_datetime` FROM `delivery_customer` WHERE `cus_name` = '$searchCus'";
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $data[0]['status'] = 1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
    } else {
        $data[0]['status'] = 0;
    }

} catch(PDOException $e) {
    $data[0]['error_message'] = $e->getMessage();
}

	echo json_encode($data);
	
} else if(@$decode['case']=='searchcus'){
	// try {
	// 	$data = array();
	// 	$data[0] = array('status' => 0);
		
	// 	$searchCus = $decode['SearchCus'];
		
	// 	$query = "SELECT `cus_id`, `cus_name`, `comp_type`, `cus_address`, `lat`, `lon`, `create_user`, `create_datetime` FROM `delivery_customer` WHERE `cus_name` OR `cus_address` LIKE :searchCus";
		
	// 	$stmt = $conn->prepare($query);
	// 	$searchCus = "%".$searchCus."%";
	// 	$stmt->bindParam(':searchCus', $searchCus, PDO::PARAM_STR);
	// 	$stmt->execute();
		
	// 	if ($stmt->rowCount() > 0) {
	// 		$data[0]['status'] = 1;
	// 		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	// 			$data[] = $row;
	// 		}
	// 	}
	// } catch(PDOException $e) {
	// 	$data[0]['error_message'] = $e->getMessage();
	// }
	try {
		$data = array();
		$data[0] = array('status' => 0);
	
		$searchCus = $decode['SearchCus'];
		$searchCus = htmlspecialchars($searchCus);
	
		$query = "SELECT `cus_id`, `cus_name`, `comp_type`, `cus_address`, `lat`, `lon`, `create_user`, `create_datetime` FROM `delivery_customer` WHERE `cus_name` LIKE '%$searchCus%' OR `cus_address` LIKE '%$searchCus%'";
	
		$stmt = $conn->query($query);
	
			if ($stmt->rowCount() > 0) {
				$data[0]['status'] = 1;
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$data[] = $row;
				}
			} else {
				$data[0]['status'] = 0;
			}
		
	} catch (PDOException $e) {
		$data[0]['error_message'] = $e->getMessage();
	}
	
	echo json_encode($data);
// } else if(@$_REQUEST['case']=='select_cus_datatable'){
// 	try {
// 		$data = array();
	
// 		$query = "SELECT `cus_id`, `cus_name`, `comp_type`, `cus_address` FROM `delivery_customer` ORDER BY cus_id ASC";
	
// 		$stmt = $conn->query($query);
	
// 		if ($stmt->rowCount() > 0) {
// 			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
// 				$data[] = $row;
// 			}
// 		}
// 	} catch (PDOException $e) {
// 		$data[0]['error_message'] = $e->getMessage();
// 	}
	
// 	echo json_encode($data);
// }
} else if(isset($_GET['case']) && $_GET['case'] === 'select_cus_datatable') {
    try {
        // เชื่อมต่อกับฐานข้อมูล (ให้แทนที่ด้วยข้อมูลการเชื่อมต่อของคุณ)
        $conn = new PDO('mysql:host=localhost;dbname=ชื่อฐานข้อมูล', 'ชื่อผู้ใช้', 'รหัสผ่าน');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // เตรียมคำสั่ง SQL เพื่อดึงข้อมูลลูกค้า
        $query = "SELECT `cus_id`, `cus_name`, `comp_type`, `cus_address` FROM `delivery_customer` ORDER BY cus_id ASC";

        // ดำเนินการค้นหาข้อมูล
        $stmt = $conn->query($query);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data); // ส่งข้อมูลในรูปแบบ JSON กลับไปยัง AJAX
        } else {
            echo json_encode([]); // ส่งข้อมูลว่างกลับไปถ้าไม่มีข้อมูล
        }
    } catch (PDOException $e) {
        echo json_encode(array('error_message' => $e->getMessage())); // ส่งข้อความข้อผิดพลาดกลับไปในรูปแบบ JSON กรณีเกิดข้อผิดพลาด
    }
} else {
    echo json_encode(array('error_message' => 'Invalid request')); // ส่งข้อความข้อผิดพลาดกลับไปในรูปแบบ JSON กรณีไม่พบคำขอที่ถูกต้อง
}




?>