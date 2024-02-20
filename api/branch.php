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

if(@$decode['case']=='chk_branch'){
	try {
		$data[0] = array('status'=>1);
		$query = "  SELECT t1.`branch_id`, t1.`branch_name`, t1.`lock_status`,COALESCE(COUNT(t2.branch_id), 0) AS count_user
		 FROM `branch_info` t1 LEFT JOIN user_info t2 ON t1.branch_id = t2.branch_id AND t2.user_active = 1
		 GROUP BY t1.`branch_id`, t1.`branch_name`, t1.`lock_status`
	                     ";  
	    $stmt = $conn->query( $query ); 
	    while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
			$data[] = $row;
	    }  
	} catch(PDOException $e) {
	  $data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
    echo json_encode(@$data);
}else if(@$decode['case']=='add_branch'){
	try {
		$query = "  INSERT INTO `branch_info`(`branch_id`, `branch_name`, `create_user`, `create_datetime`, `lock_status`) VALUES ('".trim($decode['branch_id'])."','".trim($decode['branch_name'])."','".$sivanat_user."',now(),'0')
	                     ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array('status'=>1);
	} catch(PDOException $e) {
		$data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
	echo json_encode(@$data);
}else if(@$decode['case']=='change_branch'){
	try {
		$query = "  UPDATE branch_info SET branch_name = '".trim($decode['branch_name'])."' WHERE branch_id = '".$decode['branch_id']."'
		                 ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array('status'=>1);
	} catch(PDOException $e) {
		$data[0] = array('status'=>0,"error_message" => $e->getMessage());
	}
	echo json_encode(@$data);
}else if(@$decode['case']=='del_branch'){
	try {
		$query = "  DELETE FROM `branch_info` WHERE branch_id = '".$decode['branch_id']."'
	                     ";  
	    $stmt = $conn->query( $query ); 
		$data[0] = array('status'=>1);
	} catch(PDOException $e) {
		$data[0] = array('status'=>0,"error_message" => $e->getMessage());
	} 
	echo json_encode(@$data);
}
?>