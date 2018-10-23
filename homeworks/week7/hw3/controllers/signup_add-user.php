<?php 
/*
檔案功能：註冊 / 新增使用者
*/
	require('../../connect.php'); //連接資料庫

	//判斷變數是否存在 & 驗證
	if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["nickname"])) { 
		$username = validation($_POST["username"]);
		$password = validation($_POST["password"]);
		$password2 = validation($_POST["password2"]);
		$nickname = validation($_POST["nickname"]);

		// 判斷表單有沒有空值
		if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["nickname"])) {  		

			// 檢查帳號是否已經註冊
			$sql = "SELECT * FROM `twgd_users` WHERE `username` = ?" ;
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows === 0) {
				
				// 密碼確認
				if ($password === $password2) {

					// 使用者帳密 寫入資料庫
					$hash = password_hash($password, PASSWORD_DEFAULT);

					$sql_hash = "INSERT INTO twgd_users(username, password, nickname) VALUES (?, ?, ?)";
					$stmt_hash = $conn->prepare($sql_hash);
					$stmt_hash->bind_param("sss",$username, $hash, $nickname);

					if ($stmt_hash->execute()) {						
						
						//產生一組亂數 cer_id 寫入資料庫
						$cer_id = md5(time().rand().uniqid());
						$sql_cer = "INSERT INTO `twgd_users_certificate` (cer_id, username) VALUES (?, ?)";
						$stmt_cer = $conn->prepare($sql_cer);
						$stmt_cer->bind_param("ss",$cer_id, $username);

						if ($stmt_cer->execute()) {
							
							//設置 Cookie，然後自動登入並轉址到留言板
							setcookie("cer_id", $cer_id, time()+3600*24, "/twgd");
							$success = '註冊成功！即將自動為你登入';
							header("refresh:1 ; url=../views/comment.php");

						} else {
							header("location:../views/signup.php");
						}
						$stmt_cer->close();

					} else {
						$notice = '連線出錯';
					}
					$stmt_hash->close();
					
				} else {
					$notice = '請檢查密碼是否輸入正確';
				}

			} else {
				$notice = '帳號已經有人使用';
			}
			$stmt->close();	

		} else {
			//$notice = '請填寫完整再送出';
		}	
	}
	
	$conn->close();

	// 驗證前後空格、反斜線、html 標籤
	function validation($value) {
		$value = trim($value);
		$value = stripcslashes($value);
		$value = htmlspecialchars($value);
		return $value;
	}

?>

