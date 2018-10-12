<?php

	require_once ('../connect.php'); //連接資料庫

	$content = '';
	// 寫入主要留言
	if (isset($_POST['user_id']) && isset($_POST['content']) && !empty($_POST['content'])) {
		$user_id = $_POST['user_id'];
		$content = $_POST['content'];
		$parent_id = $_POST['parent_id'];
		$sql = "INSERT INTO twgd_comments(user_id, content, parent_id) VALUES ('$user_id', '$content', $parent_id)"; 
		
		if ($conn->query($sql) === TRUE) {
			header("location:comment.php");  
		} else {
		    echo "連線錯誤";
		}
	}
	$conn->close();

?>
