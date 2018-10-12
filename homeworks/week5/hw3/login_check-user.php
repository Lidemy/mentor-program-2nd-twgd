<?php
	require_once ('../connect.php'); //連接資料庫

	$username = $password = '';

	//判斷變數是否存在
	if (isset($_POST["username"]) && isset($_POST["password"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];

		// 驗證空值
		if (!empty($_POST["username"]) && !empty($_POST["password"])) {

			// 驗證會員帳號密碼
			$sql = "SELECT * FROM `twgd_users` WHERE `username` = '$username' ";
			$result = $conn->query($sql);
			
			// 檢查是否有這個帳號
			if ($result->num_rows) {
				$row = $result->fetch_assoc();

				// 驗證密碼
				if ($row["password"] === $password) {
					$user_id = $row["user_id"];
					setcookie("user_id", $user_id, time()+3600*24);
					header("location:comment.php");
				} else {
					$notice = "密碼有誤";
				}
			} else {
				$notice = "你還沒註冊帳號";
			}
		} else {
			$notice = "帳號密碼不可以空白";
		}	
	}

	$conn->close();

?>
