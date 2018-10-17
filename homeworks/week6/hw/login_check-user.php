<?php
	//連接資料庫
	require('../connect.php'); 

	//判斷變數是否存在
	if (isset($_POST["username"]) && isset($_POST["password"])) {
		$username = validation($_POST["username"]);
		$password = validation($_POST["password"]);

		// 驗證空值
		if (!empty($_POST["username"]) && !empty($_POST["password"])) {

			// 驗證會員帳號密碼
			$sql = "SELECT * FROM `twgd_users` WHERE `username` = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$result = $stmt->get_result();
			
			// 檢查是否有這個帳號
			if ($result->num_rows) {
				$row = $result->fetch_assoc();
				$hash = $row["password"];

				// 驗證密碼
				if (password_verify($password ,$hash)) {
					
					//產生一組亂數 cer_id 寫入資料庫
					$cer_id = md5(time().rand().uniqid());
					$sql_cer = "INSERT INTO `twgd_users_certificate` (cer_id, username) VALUES (?, ?)";
					$stmt_cer = $conn->prepare($sql_cer);
					$stmt_cer->bind_param("ss",$cer_id, $username);

					if ($stmt_cer->execute()) {

						//設置 Cookie，然後自動登入並轉址到留言板
						setcookie("cer_id", $cer_id, time()+3600*24);
						header("location:./comment.php");
					} else {
						header("location:./login.php");
					}
					$stmt_cer->close();
							
				} else {
					$notice = "密碼有誤";
				}
			} else {
				$notice = "你還沒註冊帳號";
			}
			$stmt->close();

		} else {
			$notice = "帳號密碼不可以空白";
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
