<?php session_set_cookie_params(60*60*12);
session_start(); 
include('../server/connection.php');
date_default_timezone_set('Asia/Bangkok');
$decode = json_decode(file_get_contents('php://input'), true);

if(@$decode['case']=='chk_login'){
	try {
			$data[0] = array("status" => '0','error_message' => 'ไม่พบข้อมูลผู้ใช้งาน โปรดตรวจสอบอีกครั้ง');
		    $query = "  SELECT  `branch_id`,(SELECT branch_name FROM branch_info WHERE branch_id = t1.branch_id LIMIT 1) as branch_name,emp_img, `emp_id`, `emp_fname`, `emp_position`, `user_active`, `permission`, `username`, `password` FROM `user_info` AS t1 WHERE `username` = '".$decode['username']."'
                     ";  
        	$stmt = $conn->query( $query );  
	        while ($row = $stmt->fetch( PDO::FETCH_ASSOC )){ 
		        if (password_verify($decode['password'], $row['password'])){
		         if($row['user_active']==1){
					$_SESSION['svn_id'] = $row['emp_id'];
					$_SESSION['svn_branch'] = $row['branch_id'];
					$_SESSION['svn_branch_name'] = $row['branch_name'];
					$_SESSION['svn_fname'] = $row['emp_fname'];
					$_SESSION['svn_permission'] = $row['permission'];
					$_SESSION['svn_position'] = $row['emp_position'];
					$_SESSION['svn_img'] = $row['emp_img'];
				 	$data[0] = array("status" => '1',"user_fname"=>$row['emp_fname'],"branch_id"=>$row['branch_id']);
				 }else{
				 	$data[0] = array("status" => '0','error_message' => 'User นี้ถูกล็อคการใช้งาน กรุณาติดต่อผู้ดูแลระบบ');
				 }
				} else {
				 	$data[0] = array("status" => '0','error_message' => 'รหัสผ่านไม่ถูกต้อง ตรวจสอบอีกครั้ง');
				}
	        }  
	} catch(PDOException $e) {
			$data[0] = array("status" => '0','error_message' => $e->getMessage());
	}
    echo json_encode(@$data);
}if(@$decode['case']=='logout'){
	try {
		session_destroy();
	} catch(PDOException $e) {
			$data[0] = array("status" => '0','error_message' => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='chk_all_branch'){
			$data[0] = array('status'=>0);
		    $query = "  SELECT branch_id,branch_name FROM branch_info ORDER BY branch_id 
                     ";  
        	$stmt = $conn->query($query);  
	        while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
				$data[0] = array('status'=>1);
				$data[] = $row;
	        }  
    echo json_encode(@$data);
}else if(@$_POST['case']=='add_user'){
/* GET Employee ID */
$query = " SELECT COALESCE(CONCAT('".$_POST["branch_id"]."', LPAD(COALESCE(MAX(CAST(RIGHT(emp_id, 3) AS SIGNED)), 0) + 1, 3, '0')), CONCAT('".$_POST["branch_id"]."', '001')) AS new_emp_id FROM user_info WHERE branch_id = '".$_POST["branch_id"]."';
			";  
$stmt = $conn->query($query);  
while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
	$new_emp_id =  $row['new_emp_id'];
}  
	try{
	/* IMAGE */
		$filename = $_FILES['file']['name'];
		$new_filename =  $new_emp_id.'_'.rand().'.jpg';
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
		ImageJPEG($images_fin,"../assets/img/user/".$new_filename);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
	/* Insert */
		if($_POST['position']=="ผู้จัดการร้าน"){
			$permission = "manager";
		}else if($_POST['position']=="ผู้ช่วยผู้จัดการร้าน"){
			$permission = "support";
		}else if($_POST['position']=="พนักงานขาย"){
			$permission = "sale";
		}else if($_POST['position']=="พนักงานขนส่ง"){
			$permission = "delivery";
		}else{
			$permission = "general";
		}
	
		$hashed_password = password_hash($new_emp_id, PASSWORD_DEFAULT);


		$query = "  INSERT INTO `user_info`( `branch_id`, `emp_fname`, `emp_position`, `emp_dob`, `emp_address`, `emp_tel`, `emp_id`, `username`, `password`, `permission`, `emp_img`, `create_user`, `create_date`, `edit_date`, `user_active`) 
		VALUES ('".$_POST['branch_id']."','".$_POST['fname']."','".$_POST['position']."','".$_POST['dob']."','".$_POST['address']."','".$_POST['phone_no']."','".$new_emp_id."','".$new_emp_id."','".$hashed_password."','".$permission."','".$new_filename."','".$sivanat_user."',now(),now(),1)
						";  
		$stmt = $conn->query( $query ); 
		$data[0] = array("status"=>"1");
	} catch(PDOException $e) {	
		$data[0] = array("status"=>"0","error_message" => $e->getMessage());
	}
	echo json_encode(@$data);
}else if(@$decode['case']=='check_user'){
	try {
		$data[0] = array('status'=>1);
		$query = " SELECT t1.nIndex, t1.branch_id,t2.branch_name, t1.emp_id, t1.emp_fname, t1.emp_position,t1.emp_img,t1.edit_date, t1.user_active FROM `user_info` AS t1 LEFT JOIN branch_info AS t2 ON t1.branch_id = t2.branch_id
	                     ";  
	    $stmt = $conn->query( $query ); 
	    while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
			$data[] = $row;
	    }  
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='active_user'){
	try {
		$data[0] = array('status'=>1);
		$query = "UPDATE user_info SET user_active='".$decode['user_active']."' WHERE nIndex = '".$decode['nIndex']."' ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array("status"=>"1");
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='emp_data_edit'){
	try {
		$data[0] = array('status'=>1);
		$query = " SELECT * FROM user_info WHERE nIndex = '".$decode['nIndex']."' ";  
	    $stmt = $conn->query( $query ); 
	    while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
			$data[] = $row;
	    }  
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$_POST['case']=='edit_user'){
	$query = " SELECT emp_id FROM user_info WHERE nIndex = '".$_POST['nIndex']."'
	";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$emp_id =  $row['emp_id'];
	}  
	$condition_image="";
	if ($_FILES['file']['name']!=="") {
    	$filename = $_FILES['file']['name'];
		$new_filename =  $emp_id.'_'.rand().'.jpg';
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
		ImageJPEG($images_fin,"../assets/img/user/".$new_filename);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
		$condition_image = ", `emp_img` = '".$new_filename."'";
	}

	if($_POST['position']=="ผู้จัดการร้าน"){
		$permission = "manager";
	}else if($_POST['position']=="ผู้ช่วยผู้จัดการร้าน"){
		$permission = "support";
	}else if($_POST['position']=="พนักงานขาย"){
		$permission = "sale";
	}else if($_POST['position']=="พนักงานขนส่ง"){
		$permission = "delivery";
	}else{
		$permission = "general";
	}

	try{
		$query = "  
			UPDATE `user_info`
			SET `branch_id` = '".$_POST['branch_id']."'
			, `emp_fname` = '".$_POST['fname']."'
			, `emp_position` = '".$_POST['position']."'
			, `emp_dob` = '".$_POST['dob']."'
			, `emp_address` = '".$_POST['address']."'
			, `emp_tel` = '".$_POST['phone_no']."'
			, `permission` = '".$permission."'
			".$condition_image."
			, `edit_date` = NOW()
			WHERE nIndex = '".$_POST['nIndex']."'
		";  
		$stmt = $conn->query( $query ); 
		$data[0] = array("status"=>"1");
	} catch(PDOException $e) {	
		$data[0] = array("status"=>"0","error_message" => $e->getMessage());
	}
	echo json_encode(@$data);
}else if(@$decode['case']=='reset_password'){
	$query = " SELECT emp_id FROM user_info WHERE nIndex = '".$decode['nIndex']."'
	";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		$emp_id =  $row['emp_id'];
	}  
	
	try{
		$hashed_password = password_hash($emp_id, PASSWORD_DEFAULT);
		$query = "  
			UPDATE `user_info`
			SET `password` = '".$hashed_password."'
			WHERE nIndex = '".$decode['nIndex']."'
		";  
		$stmt = $conn->query( $query ); 
		$data[0] = array("status"=>"1");
	} catch(PDOException $e) {	
		$data[0] = array("status"=>"0","error_message" => $e->getMessage());
	}
	echo json_encode(@$data);
}else if(@$decode['case']=='change_password'){
	$correct_pass = 0;
	$query = " SELECT password FROM user_info WHERE emp_id = '".$_SESSION['svn_id']."'
	";  
	$stmt = $conn->query($query);  
	while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
		if (password_verify($decode['old_password'], $row['password'])){
			$correct_pass = 1;
		}else{
			$data[0] = array("status"=>"0","error_message" => "กรอกรหัสผ่านเดิมไม่ถูกต้อง");
		}
	}  

	if($correct_pass=="1"){
		$hashed_password = password_hash($decode['new_password'], PASSWORD_DEFAULT);
		try{
			$query = "  
			UPDATE `user_info`
			SET `password` = '".$hashed_password."'
			WHERE emp_id = '".$_SESSION['svn_id']."'
			";  
			$stmt = $conn->query( $query ); 
			$data[0] = array("status"=>"1");
		}catch(PDOException $e){
			$data[0] = array("status"=>"0","error_message" => $e->getMessage());
		}
	}

	echo json_encode(@$data);
}

$sivanat_user = $_SESSION['svn_fname'];
?>
