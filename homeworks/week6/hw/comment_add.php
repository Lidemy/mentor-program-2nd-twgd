<?php

	

	// 寫入主要留言
	if (isset($_POST['user_id']) && isset($_POST['content']) && isset($_POST['csrftoken']) && isset($_POST['parent_id']) && !empty($_POST['content'])) {

		require('../connect.php'); //連接資料庫

		$user_id = $_POST['user_id'];
		$content = htmlspecialchars($_POST['content']);
		$parent_id = $_POST['parent_id'];
		$csrftoken = $_POST['csrftoken'];

		if ($csrftoken === $_COOKIE["csrftoken"]) {

			$sql = "INSERT INTO twgd_comments(user_id, content, parent_id) VALUES (?, ?, ?)"; 
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("isi",$user_id, $content, $parent_id);
			
			if ($stmt->execute()) {
				header("location:comment.php");  
			} else {
			    echo "連線錯誤";
			}
			$stmt->close();
		}
		$conn->close();
	}


?>
