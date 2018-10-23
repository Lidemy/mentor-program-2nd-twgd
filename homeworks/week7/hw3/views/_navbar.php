<nav class="navbar navbar-dark bg-dark fixed-top">
	<a class="navbar-brand mb-0 h1" href="./comment.php">留言板</a>
  	
<?php 	

	if (isset($_COOKIE["cer_id"])) { 

		//建立連線
		require("../../connect.php");

		//檢查資料庫裡有沒有這個通行證 (cer_id)
		$cer_id = $_COOKIE["cer_id"];

		$sql = "SELECT * FROM `twgd_users_certificate` WHERE `cer_id` = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $cer_id);
		$stmt->execute();

		if ($result = $stmt->get_result()) {
			//有這個通行證 (cer_id) 就顯示登出按鈕 ?>

		<a class="btn btn-outline-info my-2 my-sm-0" href="./logout.php">登出</a>

<?php	} else {
			//查無通行證的話，清空 Cookie 並跳到登入頁
			setcookie("cer_id", "", time()-1);
			header("location:./login.php");
		}
		$stmt->close();
		$conn->close();
	} else { ?>

		<a class="btn btn-outline-info my-2 my-sm-0" href="./login.php">登入/註冊</a>
		
<?php 	} ?>
		

</nav>