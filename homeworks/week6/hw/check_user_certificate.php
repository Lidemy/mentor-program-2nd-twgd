<?php
/*
檔案功能：檢查 Cookie，用來驗證 users_certificate，檢查會員登入狀態
*/

//確認有無設置 cookie
if (isset($_COOKIE["cer_id"])) {
	//建立連線
	require("../connect.php");

	//檢查資料庫裡有沒有這個通行證 (cer_id)
	$cer_id = $_COOKIE["cer_id"];
	$sql = "SELECT * FROM `twgd_users_certificate` WHERE `cer_id` = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $cer_id);
	$stmt->execute();
	
	if ($result = $stmt->get_result()) {
		//有這個通行證 (cer_id) 就轉址到留言板
		header("location:./comment.php"); 
	} else {
		//查無通行證的話，清空 Cookie 並跳到登入頁
		setcookie("cer_id", "", time()-1);
		header("location:./login.php");
	}
	$stmt->close();
	$conn->close();
}



?>