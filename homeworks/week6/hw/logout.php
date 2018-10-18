<?php
	/*
	登出頁
	*/
	
	//清除資料庫的 cer_id (每次登入都更新一個 cer_id)
	require("../connect.php");
	$cer_id = $_COOKIE["cer_id"];

	$sql = "DELETE FROM `twgd_users_certificate` WHERE `cer_id` = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $cer_id);
	if ($stmt->execute()) {
		
		//清空 Cookie 並轉回留言板
	    setcookie("cer_id", "", time()-1);
	    setcookie("csrftoken", "", time()-1);
		header("location:./comment.php");
	} else {
	    echo "資料庫錯誤";
	}
	$stmt->close();
	$conn->close();

?>