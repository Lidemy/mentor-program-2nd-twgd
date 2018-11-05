<?php 
/*
檔案功能：刪除留言
*/

	if (isset($_POST["com_id"]) && isset($_POST["csrftoken"]) && isset($_COOKIE["csrftoken"])){
		
		require("../../connect.php");

		$com_id = $_POST["com_id"];
		$csrftoken = $_POST["csrftoken"];
		
		// csrf token
		if (!$csrftoken === $_COOKIE["csrftoken"]) {
			$arr = array(
				'result' => 'error',
				'message' => 'csrf 驗證怪怪的'
			);
			echo json_encode($arr);	
			return;
		}

		// delete data
		$sql = "DELETE FROM `twgd_comments` WHERE `com_id` = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $com_id);

		if (!$stmt->execute()){
			$arr = array(
				'result' => 'error',
				'message' => '資料庫怪怪的'
			);
			echo json_encode($arr);	
			return;
		}

		$arr = array('result' => 'success');
		echo json_encode($arr);

		// close
		$stmt->close();
		$conn->close();
	}

?>