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
		if ($decode['pay_status'] == '1') {
			$pay_status = 1;
			$pay_datetime = date('Y-m-d H:i:s');
		} else {
			$pay_status = 0;
			$pay_datetime = null;
		}

		// if ($decode['pay_type'] == 'cash') {
		// 	$pay_type = 0;
		// } else if ($decode['pay_type'] == 'transfer') {
		// 	$pay_type = 1;
		// } else if ($decode['pay_type'] == 'credit') {
		// 	$pay_type = 2;
		// }
		$pay_type = $decode['pay_type'];

		$pay_total = $decode['pay_total'];
		$price_total = $decode['totalPrice'];

        
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
				$product_price = $decode['product_price'][$index];

				$query_product = "INSERT INTO `delivery_task_product` (`task_id`, `product_id`, `product_active`, `product_price`, `order_qty`, `create_datetime`, `sale_user`)
						VALUES ('$taskId', '$product_id', '$product_active', '$product_price', '$order_qty', NOW(), '$sivanat_user')";
		
				$stmt_product = $conn->query($query_product);
		
				if (!$stmt_product) {
					$data[0] = array('status' => 0);
					echo json_encode($data);
					exit;
				}
			}
		}
        
        $query_task = "INSERT INTO `delivery_task` (`task_id`, `cus_id`, `task_datetime`, `sale_user`, `task_status` , `pay_status`, `pay_type`, `price_total`, `pay_total`,`pay_datetime`)
                    VALUES ('$taskId', '$customerId', '$taskDatetime', '$sivanat_user', '$taskStatus', '$pay_status', '$pay_type', '$price_total', '$pay_total', '$pay_datetime')";

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
}	else if (@$_POST['case'] == 'task_success') {
    try {
        $data = array('status' => 0);
        $taskID = $_POST['task_id'];
        $pay_type = $_POST['pay_type'];
        $pay_total = $_POST['amount'];
        $last_datetime = $_POST['last_datetime'];

        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
			$image = $_FILES['img']['tmp_name'];
			$image_name = $taskID. '.jpg';
			$image_base64 = base64_encode($image_name);
			$image_path = '../assets/img/task/' . $image_base64;
		
			move_uploaded_file($image, $image_path);

            // อัปเดตฐานข้อมูล
            if (empty($pay_total)) {
                $query_task = "UPDATE `delivery_task` SET `task_status` = 2, `suc_img` = '{$image_name}' WHERE `task_id` = '{$taskID}'";
            } else {
                $query_task = "UPDATE `delivery_task` SET `task_status` = 2, `pay_type` = '{$pay_type}', `pay_total` = '{$pay_total}', `pay_datetime` = '{$last_datetime}', `suc_img` = '{$image_name}' WHERE `task_id` = '{$taskID}'";
            }
            $stmt_task = $conn->query($query_task);

            // อัปเดตตาราง delivery_task_product
            $query_product = "UPDATE `delivery_task_product` SET `product_active` = 2, `last_datetime` = '{$last_datetime}' WHERE `task_id` = '{$taskID}' AND `product_active` = 1";
            $stmt_product = $conn->query($query_product);

            if ($stmt_task && $stmt_product) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
        } else {
            $data['error_message'] = 'Error uploading image.';
        }
    } catch (PDOException $e) {
        $data['error_message'] = $e->getMessage();
    }
    echo json_encode(@$data);

	
} else if (@$decode['case'] == 'task_cancel') {
	try {
		$data[0] = array('status' => 0);
        $taskID = $decode['taskID'];
		$last_datetime = $decode['last_datetime'];
        
        // Update delivery_task table
        $query_task = "UPDATE `delivery_task` SET `task_status` = 0 WHERE `task_id` = '{$taskID}'";
        $stmt_task = $conn->query($query_task);

        // // Update delivery_task_product table
        // $query_product = "UPDATE `delivery_task_product` SET `product_active` = 0 , `last_datetime` = '{$last_datetime}' WHERE `task_id` = '{$taskID}'";
        // $stmt_product = $conn->query($query_product);

        // Check if both queries were successful
        // if ($stmt_task && $stmt_product) {
			if ($stmt_task) {
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
		WHERE product_active = 1 OR product_active = 2
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
		$query = "SELECT 
						dt.task_id, 
						dt.cus_id, 
						dt.task_datetime, 
						dt.task_status, 
						dt.pay_status, 
						dt.pay_type, 
						dt.pay_total,
						dtp.product_id, 
						CASE 
							WHEN dtp.order_true IS NOT NULL AND dtp.order_true != 0 THEN dtp.order_true
							ELSE dtp.order_qty
						END AS QTY, 
						pi.product_name, 
						pi.unit, 
						pi.unit_price, 
						pi.pack, 
						pi.pack_price,
						pi.product_active,
						dt.pay_total,
						dt.price_total,
						dtp.product_price
					FROM 
						delivery_task AS dt
					JOIN 
						delivery_task_product AS dtp ON dt.task_id = dtp.task_id
					JOIN 
						product_info AS pi ON dtp.product_id = pi.product_id
					WHERE 
						dt.task_id = '{$task_id}' AND (dtp.product_active = '1' OR dtp.product_active = '2')
					ORDER BY
						dtp.product_id
							";
	
        $stmt = $conn->query($query);
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$data[0] = array('status' => 1);
				$data[] = $row;
			}
		}
    } catch (PDOException $e) {
        $data = array(); // สร้างอาร์เรย์ใหม่
        $data[0] = array('status' => 0, 'error_message' => $e->getMessage());
    }

    echo json_encode($data);
} else if (@$decode['case'] == 'update_task') {
	try {
		$task_id = $decode['task_id'];
		$product_id = $decode['product_id'];
		$pay_status = $decode['pay_status'];
		$pay_type = $decode['pay_type'];
		$pay_total = $decode['pay_total'];
		$task_datetime = $decode['task_datetime'];
		$price_total = $decode['totalPrice'];

		foreach ($decode['product_id'] as $index => $product_id) {
			$order_true = $decode['order_true'][$index];		
			$product_price = $decode['product_price'][$index];
			if ($order_true == 0) {
				$query_product = "UPDATE `delivery_task_product` 
					SET `order_true` = 0 , `order_qty` = 0 , product_active = 0
					WHERE `product_id` = '$product_id' AND `task_id` = '$task_id'";
			} else {
				$query_product = "UPDATE `delivery_task_product`
					SET `order_true` = '$order_true' , `product_price` = '$product_price'
					WHERE `product_id` = '$product_id' AND `task_id` = '$task_id' AND (`product_active` = '1' OR `product_active` = '2')";
			}
		
			$stmt_product = $conn->query($query_product);
		
			if (!$stmt_product) {
				$data[0] = array('status' => 0);
				echo json_encode($data);
				exit;
			}
		}
		
		$query = "UPDATE delivery_task 
		SET pay_status = '{$pay_status}' , pay_type = '{$pay_type}' , pay_total = '{$pay_total}' , task_datetime = '{$task_datetime}' , price_total = '{$price_total}'
		WHERE task_id = '{$task_id}' AND (task_status = '1' OR task_status = '2')";

		$stmt = $conn->query($query);
		if ($stmt) {
            $query_select = "SELECT dtp.task_id, dtp.product_id, dtp.product_price
			FROM `delivery_task_product` AS dtp 
			WHERE dtp.task_id = '{$task_id}' AND (dtp.product_active = '1' OR dtp.product_active = '2')
 		";
            $stmt_select = $conn->query($query_select);
            $selected_data = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
			
            $data[0] = array('status' => 1);
            $data[] = array('product' => $selected_data);
		} else {
			$data[0] = array('status' => 0);
		}

	} catch (PDOException $e) {
		$data[0] = array('status' => 0, 'error_message' => $e->getMessage());
	}
	echo json_encode(@$data);
} else if (@$decode['case'] == 'more_product') {
    try {
        $task_id = $decode['task_id'];
        $product_id = $decode['product_id'];
        
		// $query_check_status = "SELECT task_status FROM `delivery_task` WHERE task_id = '$task_id'";
        // $stmt_check_status = $conn->query($query_check_status);
        // $task_status_row = $stmt_check_status->fetch(PDO::FETCH_ASSOC);
        // $task_status = $task_status_row['task_status'];

		// if ($task_status != 2) {
        //     // กรณี task_status ไม่เป็น 2 ให้ทำการเพิ่มสินค้า
        //     foreach ($decode['product_id'] as $index => $product_id) {
        //         $order_true = $decode['order_true'][$index];
        //         $product_price = $decode['product_price'][$index];
            
        //         $query = "INSERT INTO `delivery_task_product` (`task_id`, `product_id`, `product_active`, `product_price`, `order_true`, `create_datetime`, `sale_user`) 
        //         VALUES ('$task_id', '$product_id', '1', '$product_price', '$order_true', NOW(), '$sivanat_user')
        //         ";
                
        //         $stmt_insert_product = $conn->query($query);
        
        //         if (!$stmt_insert_product) {
        //             $data[0] = array('status' => 0);
        //             echo json_encode($data);
        //             exit;
        //         }
        //     }
		// } else {
		// 	// กรณี task_status เป็น 2 ให้ทำการเพิ่มสินค้า
		// 	$data[0] = array('status' => 0);
		// 	echo json_encode($data);
		// 	exit;
		// }

		foreach ($decode['product_id'] as $index => $product_id) {
			$order_true = $decode['order_true'][$index];
			$product_price = $decode['product_price'][$index];
		
			$query = "INSERT INTO `delivery_task_product` (`task_id`, `product_id`, `product_active`, `product_price`, `order_true`, `create_datetime`, `sale_user`) 
			VALUES ('$task_id', '$product_id', '1', '$product_price', '$order_true', NOW(), '$sivanat_user')
			";
			
			$stmt_insert_product = $conn->query($query);
	
			if (!$stmt_insert_product) {
				$data[0] = array('status' => 0);
				echo json_encode($data);
				exit;
			}
		}
		
        if ($stmt_insert_product) {
		// เลือกข้อมูลทั้งหมดของ delivery_task_product
		$query_select = "SELECT dtp.task_id, dtp.product_id, dtp.product_price,
		IF (dtp.order_true IS NOT NULL AND dtp.order_true != 0, dtp.order_true, dtp.order_qty) AS QTY
		FROM `delivery_task_product` AS dtp 
		WHERE dtp.task_id = '$task_id' AND (dtp.product_active = '1' OR dtp.product_active = '2')";
		$stmt_select = $conn->query($query_select);
		$selected_data = $stmt_select->fetchAll(PDO::FETCH_ASSOC);

		// อัปเดตราคารวมสินค้า
		$query_update_total_price = "UPDATE `delivery_task` AS dt 
			SET `price_total` = (
				SELECT SUM(dtp.product_price)
				FROM `delivery_task_product` AS dtp 
				INNER JOIN `product_info` AS pi ON dtp.product_id = pi.product_id 
				WHERE 
					dtp.`task_id` = '$task_id' 
					AND (dtp.`product_active` = '1' OR dtp.`product_active` ='2')
					AND dtp.`product_id` = pi.product_id
			)
			WHERE dt.`task_id` = '$task_id' 
			;
		";

		$stmt_update_total_price = $conn->query($query_update_total_price);


            $data[0] = array('status' => 1);
            $data[] = array('product' => $selected_data);
        } else {
            $data[0] = array('status' => 0);
        }

    } catch (PDOException $e) {
        $data[0] = array('status' => 0, 'error_message' => $e->getMessage());
    }
    echo json_encode(@$data);

} else if (@$decode['case'] == 'table_branch') {
    try {
        $date = $decode['date'];
        $data[0] = array('status' => 0);
        $query = "SELECT 
                        dc.cus_id, 
                        dc.cus_name, 
                        dc.cus_address, 
                        dc.cus_tel,
                        dt.task_id, 
                        dt.task_datetime , 
                        GROUP_CONCAT(dtp.product_id) AS product_ids,
                        GROUP_CONCAT(CASE 
                                            WHEN dtp.order_true IS NOT NULL AND dtp.order_true != 0 THEN dtp.order_true
                                            ELSE dtp.order_qty
                                        END) AS order_quantities,
						dtp.sale_user,
						dc.cus_tel,
						dt.task_status,
						Group_concat(pi.product_name) AS product_names,
						dc.lat,
						dc.lon,
						dt.price_total,
						dt.pay_total
                    FROM 
                        `delivery_customer` AS dc
                    INNER JOIN 
                        delivery_task AS dt ON dc.cus_id = dt.cus_id 
                    INNER JOIN 
                        delivery_task_product AS dtp ON dt.task_id = dtp.task_id
					INNER JOIN
						product_info AS pi ON dtp.product_id = pi.product_id
                    WHERE 
                        CAST(dt.task_datetime AS DATE) = '{$date}' AND dtp.task_id = dt.task_id AND (dtp.product_active = '1' OR dtp.product_active = '2')
                    GROUP BY 
                        dt.task_id
					ORDER BY
					 dt.task_id DESC
						
						";
            
        $stmt = $conn->query($query);

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[0] = array('status' => 1);
                $productIds = explode(',', $row['product_ids']);
                $orderQuantities = explode(',', $row['order_quantities']);
				$product_name = explode(',', $row['product_names']);
                $productArray = array();
                foreach ($productIds as $key => $productId) {
                    $productArray[] = array('product_name' => $product_name[$key],'product_id' => $productId, 'order_quantity' => $orderQuantities[$key]);
                }

                // เรียงลำดับสินค้าตามรหัสสินค้า
                usort($productArray, function($a, $b) {
                    return strcmp($a['product_id'], $b['product_id']);
                });

                $row['products'] = $productArray;
                $data[] = $row;
            }
        }
    } catch (PDOException $e) {
        $data[0]['error_message'] = $e->getMessage();
    }
    echo json_encode(@$data);
} else if (@$decode['case'] == 'calendarEvents') {
	try {
		$data[0] = array('status' => 0);
		$query = "SELECT 
						dc.cus_id, 
						dc.cus_name, 
						dt.task_id, 
						dt.task_datetime,
						dt.task_status
					FROM 
						`delivery_customer` AS dc
					INNER JOIN 
						delivery_task AS dt ON dc.cus_id = dt.cus_id
					WHERE
						dt.task_status = 1 OR dt.task_status = 2
					";

		$stmt = $conn->query($query);

		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$data[0] = array('status' => 1);
				$data[] = $row;
			}
		} else {
			$data[0] = array('status' => 0);
		}
	} catch (PDOException $e) {
		$data[0]['error_message'] = $e->getMessage();
	}
	echo json_encode(@$data);
} else if (@$decode['case'] == 'suc_img') {

	try {
		$data[0] = array('status' => 0);
		$query = "SELECT `suc_img` FROM `delivery_task` WHERE `task_id` = '{$decode['task_id']}'";
		$stmt = $conn->query($query);
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$row['suc_img'] = base64_encode($row['suc_img']);
				$data[0] = array('status' => 1);
				$data[] = $row;
			}
		} else {
			$data[0] = array('status' => 0);
		}
	} catch (PDOException $e) {
		$data[0]['error_message'] = $e->getMessage();
	}
	echo json_encode(@$data);
}

?>
