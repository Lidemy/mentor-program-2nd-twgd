<nav class="navbar">
	<ul>

<?php 	

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
			//有這個通行證 (cer_id) 就顯示登出按鈕 ?>

		<li><a href="logout.php">登出</a></li>

<?php	} else {
			//查無通行證的話，清空 Cookie 並跳到登入頁
			setcookie("cer_id", "", time()-1);
			header("location:./login.php");
		}
		$stmt->close();
		$conn->close();
	} else { ?>

		<li><a href="login.php">登入/註冊</a></li>
		
<?php 	} ?>
		
	</ul>
</nav>