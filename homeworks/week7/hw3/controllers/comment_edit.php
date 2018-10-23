<?php 
/*
檔案功能：編輯留言
*/

if (isset($_POST["com_id"]) && isset($_POST["content"]) && isset($_POST["csrftoken"]) && !empty($_POST["content"])){

	require("../../connect.php");

	$com_id = $_POST["com_id"];
	$content = htmlspecialchars($_POST["content"]);
	$csrftoken = $_POST["csrftoken"];

	if ($csrftoken === $_COOKIE["csrftoken"]) {

		$sql = "UPDATE `twgd_comments` SET `content` = ? WHERE `com_id` = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("si", $content, $com_id);

		if ($stmt->execute()){	
			$sql_edit = "SELECT * FROM `twgd_comments` WHERE com_id = ? ";
			$stmt_edit = $conn->prepare($sql_edit);
			$stmt_edit->bind_param("i", $com_id);
			$stmt_edit->execute();
			$arr = $stmt_edit->get_result()->fetch_assoc();
			echo json_encode($arr);
			
			$stmt_edit->close();
		} else {
			//echo "連線錯誤";
		}
		$stmt->close();
	}
	$conn->close();
}


?>


