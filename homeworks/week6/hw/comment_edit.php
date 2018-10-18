<?php 
/*
編輯留言
*/

if (isset($_POST["com_id"]) && isset($_POST["content"]) && isset($_POST["csrftoken"]) && !empty($_POST["content"])){

	require("../connect.php");

	$com_id = $_POST["com_id"];
	$content = htmlspecialchars($_POST["content"]);
	$csrftoken = $_POST["csrftoken"];

	if ($csrftoken === $_COOKIE["csrftoken"]) {
		$sql = "UPDATE `twgd_comments` SET `content` = ? WHERE `com_id` = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("si", $content, $com_id);

		if ($stmt->execute()){	
			
			header("location:./comment.php");
		} else {
			echo "連線錯誤";
		}
		$stmt->close();
	}
	$conn->close();
}


?>


