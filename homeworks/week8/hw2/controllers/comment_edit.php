<?php 
/*
檔案功能：編輯留言
*/

if (isset($_POST["com_id"]) && isset($_POST["content"]) && isset($_POST["csrftoken"]) && !empty($_POST["content"])){

	require("../../connect.php");

	$com_id = $_POST["com_id"];
	$content = htmlspecialchars($_POST["content"]);
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

	// update data
	$sql = "UPDATE `twgd_comments` SET `content` = ? WHERE `com_id` = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("si", $content, $com_id);

	if (!$stmt->execute()){	
		$arr = array(
			'result' => 'error',
			'message' => '資料庫怪怪的'
		);
		echo json_encode($arr);
		return;
	} 

	// output
	$sql_edit = "SELECT * FROM `twgd_comments` WHERE com_id = ? ";
	$stmt_edit = $conn->prepare($sql_edit);
	$stmt_edit->bind_param("i", $com_id);

	if (!$stmt_edit->execute()){
		$arr = array(
			'result' => 'error',
			'message' => '資料庫怪怪的'
		);	
		echo json_encode($arr);
		return;
	} 

	$arr = $stmt_edit->get_result()->fetch_assoc();
	echo json_encode($arr);
	
	// close
	$stmt->close();
	$stmt_edit->close();
	$conn->close();
}


?>


