<?php 
/*
刪除留言
*/

	if (isset($_POST["com_id"]) && isset($_POST["csrftoken"]) && isset($_COOKIE["csrftoken"])){
		
		require("../connect.php");

		$com_id = $_POST["com_id"];
		$csrftoken = $_POST["csrftoken"];
		
		if ($csrftoken === $_COOKIE["csrftoken"]) {
			$sql = "DELETE FROM `twgd_comments` WHERE `com_id` = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("i", $com_id);

			if ($stmt->execute()){
				header("location:./comment.php");
			} else {
				echo "資料庫錯誤";
			}
			$stmt->close();
		} else {
			echo "安捏母湯喔";
		}		
		$conn->close();
	}

?>