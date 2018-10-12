<?php 
	require_once ('../connect.php'); //連接資料庫

	$username = $password = $password2 = $nickname = '';

	//判斷變數是否存在 & 驗證
	if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["nickname"])) { 
		$username = $_POST["username"];
		$password = $_POST["password"];
		$password2 = $_POST["password2"];
		$nickname = $_POST["nickname"];

		// 判斷表單有沒有空值
		if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["nickname"])) {  		

			// 檢查帳號是否已經註冊
			$sql = "SELECT * FROM `twgd_users` WHERE `username` = '$username'" ;
			$result = $conn->query($sql);
			if ($result->num_rows === 0) {
				
				// 密碼確認
				if ($password === $password2) {

					//寫入資料庫
					$sql = "INSERT INTO twgd_users(username, password, nickname) VALUES ('$username', '$password', '$nickname')";
					if ($conn->query($sql)) {
						$success = '註冊成功！即將自動為你登入';
						$user_id = $conn->insert_id;
						setcookie("user_id", $user_id, time()+3600*24);
						header("refresh:1 ; url=comment.php");
					} else {
						$notice = '連線出錯';
					}
					
				} else {
					$notice = '請檢查密碼是否輸入正確';
				}

			} else {
				$notice = '帳號已經有人使用';
			}		

		} else {
			$notice = '請填寫完整再送出';
		}	
	}

	$conn->close();

?>

