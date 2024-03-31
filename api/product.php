<?php session_set_cookie_params(60*60*12);
session_start(); 
include('../server/connection.php');
date_default_timezone_set('Asia/Bangkok');
$decode = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['svn_fname'])) {
    // The session variable 'svn_fname' is not set, so deny access
    header('HTTP/1.1 403 Forbidden');
    echo 'Access Denied';
    exit;
}

$sivanat_user = $_SESSION['svn_fname'];

if(@$_POST['case']=='add_product'){
 /* GET New product ID */
$query = " SELECT IFNULL(CONCAT('P', LPAD(MAX(CAST(SUBSTRING(product_id, 2) AS UNSIGNED))+1, 5, '0')), 'P00001') AS product_id FROM `product_info` 
";  
$stmt = $conn->query($query);  
while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$product_id =  $row['product_id'];
}  
	try{
	/* IMAGE */
		$filename = $_FILES['file']['name'];
		$new_filename =  $product_id.'_'.rand().'.jpg';
		$images = $_FILES["file"]["tmp_name"]; 
		$width=700; //*** Fix Width & Heigh (Autu caculate) ***//
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromJPEG($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageJPEG($images_fin,"../assets/img/product/".$new_filename);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
	/* Insert */
		$query = "  INSERT INTO `product_info`(`product_id`, `product_name`, `product_img`, `cat_id`, `cat_sub_id`, `product_barcode`, `unit`, `unit_cost`, `unit_price`, `pack`, `pack_cost`, `pack_price`, `create_user`, `create_date`,`edit_date`, `product_active`) 
		VALUES ('".$product_id."','".$_POST['product_name']."','".$new_filename."','".$_POST['cat_id']."','".$_POST['cat_sub_id']."','".$_POST['product_barcode']."','".$_POST['unit']."','".$_POST['unit_cost']."','".$_POST['unit_price']."','".$_POST['pack']."','".$_POST['pack_cost']."','".$_POST['pack_price']."','".$sivanat_user."',now(),now(),'1')
						";  
		$stmt = $conn->query( $query ); 
		$data[0] = array("status"=>"1");
	} catch(PDOException $e) {	
		$data[0] = array("status"=>"0","error_message" => $e->getMessage());
	}
	echo json_encode(@$data);
}else if(@$decode['case']=='chk_product'){
 /* GET New product ID */
$query = " SELECT `nIndex`, `product_id`, `product_name`, `product_img`
,(SELECT cat_name FROM product_category WHERE cat_id = t1.cat_id) AS cat_name
,(SELECT cat_sub_name FROM product_category_sub WHERE cat_sub_id = t1.cat_sub_id) AS cat_sub_name
,unit,`unit_price`,pack, `pack_price`, `product_active`, `create_user`, `create_date`, `edit_user`, `edit_date` FROM `product_info` AS t1
 ORDER BY nIndex DESC
";  
$stmt = $conn->query($query);  
while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
	$data[] = $row;
}   
	echo json_encode(@$data);
}else if(@$decode['case']=='active_product'){
	try {
		$data[0] = array('status'=>1);
		$query = "UPDATE product_info SET product_active='".$decode['product_active']."' WHERE nIndex = '".$decode['nIndex']."' ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array("status"=>"1");
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='product_data_edit'){
 /* GET New product ID */
$query = " SELECT `nIndex`, `product_id`, `product_name`, `product_img`
,cat_id,cat_sub_id,product_barcode,unit_cost,pack_cost
,unit,`unit_price`,pack, `pack_price`, `product_active`, `create_user`, `create_date`, `edit_user`, `edit_date` FROM `product_info` AS t1 WHERE nIndex = '".$decode['nIndex']."'
 ORDER BY nIndex DESC
";  
$stmt = $conn->query($query);  
while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
	$data[] = $row;
}   
	echo json_encode(@$data);
}else if(@$decode['case']=='active_product'){
	try {
		$data[0] = array('status'=>1);
		$query = "UPDATE product_info SET product_active='".$decode['product_active']."' WHERE nIndex = '".$decode['nIndex']."' ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array("status"=>"1");
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$_POST['case']=='edit_product'){
	$query = " SELECT product_id FROM `product_info` WHERE nIndex = '".$_POST['nIndex']."'
	";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$product_id =  $row['product_id'];
	}  

	$condition_image="";
	
	if ($_FILES['file']['name']!=="") {
    	$filename = $_FILES['file']['name'];
		$new_filename =  $product_id.'_'.rand().'.jpg';
		$images = $_FILES["file"]["tmp_name"];
		$new_images = "Thumbnails_".$_FILES["file"]["name"];
		$width=1000; //*** Fix Width & Heigh (Autu caculate) ***//
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromJPEG($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageJPEG($images_fin,"../assets/img/product/".$new_filename);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
		$condition_image = ", `product_img` =  '".$new_filename."'";
	}

	try{
		$query = "  
			UPDATE  `product_info` 
			SET `product_name` =  '".$_POST['product_name']."'
			 ".$condition_image."
			 ,`cat_id` = '".$_POST['cat_id']."'
			 ,`cat_sub_id` = '".$_POST['cat_sub_id']."'
			 ,`product_barcode` =   '".$_POST['product_barcode']."'
			 ,`unit` = '".$_POST['unit']."'
			 ,`unit_cost` =  '".$_POST['unit_cost']."'
			 ,`unit_price` ='".$_POST['unit_price']."'
			 ,`pack` = '".$_POST['pack']."'
			 ,`pack_cost` =  '".$_POST['pack_cost']."'
			 ,`pack_price` = '".$_POST['pack_price']."'
			 ,`edit_user` =  '".$_SESSION['svn_fname']."'
			 ,`edit_date` = now()
			WHERE nIndex = '".$_POST['nIndex']."'
		";  
		$stmt = $conn->query( $query ); 
		$data[0] = array("status"=>"1");
	} catch(PDOException $e) {	
		$data[0] = array("status"=>"0","error_message" => $e->getMessage());
	}
	echo json_encode(@$data);
// }else if (@$decode['case'] == 'TaskPro') {
//     try {
//         // Generate task ID
//         function generateTaskIdFromMySQL($conn) {
//             $currentYear = date('y');
//             $nextTaskId = '';
//             $query = "SELECT MAX(CAST(SUBSTRING(task_id, 6) AS UNSIGNED)) AS max_task_id FROM delivery_task WHERE task_id LIKE 'SV$currentYear%'";
//             $stmt = $conn->query($query);
//             $row = $stmt->fetch(PDO::FETCH_ASSOC);
//             $maxTaskId = $row['max_task_id'];

//             if ($maxTaskId === null) {
//                 $maxTaskId = 0;
//             }

//             $maxTaskId++;

//             $paddedTaskId = str_pad($maxTaskId, 6, '0', STR_PAD_LEFT);

//             $nextTaskId = 'SV' . $currentYear . $paddedTaskId;
//             return $nextTaskId;
//         }

//         $taskId = generateTaskIdFromMySQL($conn); // Pass $conn to the function

//         // Insert into delivery_task table
//         $customerId = $decode['cus_id'];
//         $taskDatetime = $decode['Taskdatetime'];
//         $taskStatus = 1;
// 		$product_id = $decode['find_product'];
// 		$product_active = 1;
// 		$product_qty = $decode['product_qty'];

//         $query_task = "INSERT INTO `delivery_task` (`task_id`, `cus_id`, `task_datetime`, `sale_user`, `task_status`)
//                     VALUES ('$taskId', '$customerId', '$taskDatetime', '$sivanat_user', '$taskStatus')";

//         $stmt_task = $conn->query($query_task);

// 		$query_product = "INSERT INTO `delivery_task_product` (`task_id`, `product_id`, `product_active`, `product_qty`, `create_datetime`, `sale_user`)
// 					VALUES ('$taskId', '$product_id', '$product_active', '$product_qty', NOW(), '$sivanat_user')";

// 		$stmt_product = $conn->query($query_product);
// 		if ($stmt_task && $stmt_product) {
//             $data[0] = array('status' => 1);
//         } else {
// 			$data[0] = array('status' => 0);
//         }
//     } catch (PDOException $e) {
//         $data[0]['error_message'] = $e->getMessage();
// 	}
//     echo json_encode($data);
}else if (@$decode['case'] == 'TaskProduct') {
    try {
        // Generate task ID
        function generateTaskIdFromMySQL($conn) {
            $currentYear = date('y');
            $nextTaskId = '';
            $query = "SELECT MAX(CAST(SUBSTRING(task_id, 6) AS UNSIGNED)) AS max_task_id FROM delivery_task WHERE task_id LIKE 'SV$currentYear%'";
            $stmt = $conn->query($query);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $maxTaskId = $row['max_task_id'];

            if ($maxTaskId === null) {
                $maxTaskId = 0;
            }

            $maxTaskId++;

            $paddedTaskId = str_pad($maxTaskId, 6, '0', STR_PAD_LEFT);

            $nextTaskId = 'SV' . $currentYear . $paddedTaskId;
            return $nextTaskId;
        }

        $taskId = generateTaskIdFromMySQL($conn); 

        $customerId = $decode['cus_id'];
        $taskDatetime = $decode['Taskdatetime'];
        $taskStatus = 1;
        
        if (empty($decode['product'])) {
			$product_id = 0; 
			$order_qty = 0; 
			$product_active = 0;
		
			$query_product = "INSERT INTO `delivery_task_product` (`task_id`, `product_id`, `product_active`, `order_qty`, `create_datetime`, `sale_user`)
							VALUES ('$taskId', '$product_id', '$product_active', '$order_qty', NOW(), '$sivanat_user')";
		
			$stmt_product = $conn->query($query_product);
		
			if (!$stmt_product) {
				$data[0] = array('status' => 0);
				echo json_encode($data);
				exit; 
			}
		} else {
			foreach ($decode['product'] as $index => $product_id) {
				$product_active = 1;
				$order_qty = $decode['order_qty'][$index];
				$product_type = $decode['product_type'][$index];

				$query_product = "INSERT INTO `delivery_task_product` (`task_id`, `product_id`, `product_active`, `order_qty`,`product_type`, `create_datetime`, `sale_user`)
						VALUES ('$taskId', '$product_id', '$product_active', '$order_qty', '$product_type', NOW(), '$sivanat_user')";
		
				$stmt_product = $conn->query($query_product);
		
				if (!$stmt_product) {
					$data[0] = array('status' => 0);
					echo json_encode($data);
					exit;
				}
			}
		}
        
        $query_task = "INSERT INTO `delivery_task` (`task_id`, `cus_id`, `task_datetime`, `sale_user`, `task_status`)
                    VALUES ('$taskId', '$customerId', '$taskDatetime', '$sivanat_user', '$taskStatus')";

        $stmt_task = $conn->query($query_task);

        if ($stmt_task) {
            $data[0] = array('status' => 1);
        } else {
            $data[0] = array('status' => 0);
        }
    } catch (PDOException $e) {
        $data[0]['error_message'] = $e->getMessage();
    }
    echo json_encode(@$data);

}else if(@$decode['case'] == 'main_task') {
    try {
        $data[0] = array('status' => 0);
		$cusID = $decode['cus_id'];
		$query = "SELECT 
		dt.task_id,
		dt.cus_id, 
		dt.task_datetime, 
		dt.task_status, 
		-- GROUP_CONCAT(delivery_task_product.product_id SEPARATOR ',') AS product_ids,
		-- GROUP_CONCAT(product_info.product_name SEPARATOR ',') AS product_names,
		dtp.product_active, 
		dtp.order_qty, 
		dtp.create_datetime, 
		dtp.last_datetime
	FROM 
		delivery_task AS dt       
	INNER JOIN 
		delivery_task_product AS dtp ON dt.task_id = dtp.task_id
	LEFT JOIN 
		product_info AS pi ON dtp.product_id = pi.product_id
	WHERE 
		dt.cus_id = '{$cusID}'
	GROUP BY 
		dtp.task_id
	ORDER BY 
		dt.task_id DESC
	";
        $stmt = $conn->query($query);
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$data[0] = array('status' => 1);
                $data[] = $row;
            }
        }
    } catch (PDOException $e) {
        $data[0]['error_message'] = $e->getMessage();
    }
    echo json_encode(@$data);
} else if (@$decode['case'] == 'task_success') {
    try {
        $data[0] = array('status' => 0);
        $taskID = $decode['taskID'];
		$last_datetime = $decode['last_datetime'];
        
        // Update delivery_task table
        $query_task = "UPDATE `delivery_task` SET `task_status` = 2 WHERE `task_id` = '{$taskID}'";
        $stmt_task = $conn->query($query_task);

        // Update delivery_task_product table
        $query_product = "UPDATE `delivery_task_product` SET `product_active` = 2 , `last_datetime` = '{$last_datetime}' WHERE `task_id` = '{$taskID}'";
        $stmt_product = $conn->query($query_product);

        // Check if both queries were successful
        if ($stmt_task && $stmt_product) {
            $data[0] = array('status' => 1);
        } else {
			$data[0] = array('status' => 0);
        }
    } catch (PDOException $e) {
        $data[0]['error_message'] = $e->getMessage();
	}
    echo json_encode($data);
} else if (@$decode['case'] == 'product_task_show') {
	try {
		$data[0] = array('status' => 0);
		$query = "SELECT `nIndex`, `product_id`, `product_name`, `product_img`
		,(SELECT cat_name FROM product_category WHERE cat_id = t1.cat_id) AS cat_name
		,(SELECT cat_sub_name FROM product_category_sub WHERE cat_sub_id = t1.cat_sub_id) AS cat_sub_name
		,unit,`unit_price`,pack, `pack_price`, `product_active`, `create_user`, `create_date`, `edit_user`, `edit_date` FROM `product_info` AS t1
		 ORDER BY nIndex DESC
		";
		$stmt = $conn->query($query);
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$data[0] = array('status' => 1);
				$data[] = $row;
			}
		}
	} catch (PDOException $e) {
		$data[0]['error_message'] = $e->getMessage();
	}
	echo json_encode($data);
}else if (@$decode['case'] == 'product_details') {
    try {
        // $total_price = 0; // เพิ่มตัวแปรเพื่อเก็บราคารวมทั้งหมด

        $task_id = $decode['task_id'];
        $query = "SELECT dtp.product_id, dtp.order_qty , dtp.product_type, pi.product_name , pi.unit , pi.unit_price , pi.pack , pi.pack_price
        FROM delivery_task_product AS dtp
        JOIN product_info AS pi ON dtp.product_id = pi.product_id
        WHERE dtp.task_id = '{$task_id}'";

        $stmt = $conn->query($query);
        // if ($stmt->rowCount() > 0) {
        //     $data = []; // สร้างอาร์เรย์ใหม่
        //     $data[0] = array('status' => 1);

        //     foreach ($stmt as $row) {
        //         // คำนวณราคารวมของแต่ละแถว
		// 		if ($row['product_type'] == 'unit') {
        //             $row_total_price = ceil($row['unit_price']);
        //         } elseif ($row['product_type'] == 'pack') {
        //             $row_total_price = ceil($row['pack_price']);
        //         }

        //         // เพิ่มข้อมูลราคารวมของแถวนี้เข้าไปในอาร์เรย์ใหม่
        //         $row['price'] = $row_total_price;
        //         $data[] = $row;
        //     }
        // }
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$data[0] = array('status' => 1);
				if ($row['product_type'] == 'unit') {
					$row_total_price = ceil($row['unit_price']);
				} elseif ($row['product_type'] == 'pack') {
					$row_total_price = ceil($row['pack_price']);
				}
				// เพิ่มข้อมูลราคารวมของแถวนี้เข้าไปในอาร์เรย์ใหม่
				$row['price'] = $row_total_price;
				$data[] = $row;
			}
		}
    } catch (PDOException $e) {
        $data = array(); // สร้างอาร์เรย์ใหม่
        $data[0] = array('status' => 0, 'error_message' => $e->getMessage());
    }

    // // เพิ่มข้อมูลราคารวมทั้งหมดในอาร์เรย์ใหม่
    // $data[]['total_price'] = $total_price;

    echo json_encode($data);


}





?>
