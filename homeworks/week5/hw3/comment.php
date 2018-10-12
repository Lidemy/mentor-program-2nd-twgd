<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>twgd hw5-3 會員制留言板</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="./css/main.css">
		<link rel="stylesheet" type="text/css" href="./css/comment.css">
	</head>

	<body>
<?php 	require("_navbar.php"); ?>

		<div class="web__container">
			<div class="title">我要留言</div>
			<div class="board__container">

<?php 	if (isset($_COOKIE["user_id"])) {
			require_once("../connect.php");
			$user_id = $_COOKIE["user_id"];
			$sql_user = "SELECT * FROM `twgd_users` WHERE `user_id` = '$user_id'";
			$result_user = $conn->query($sql_user);
			$row_user = $result_user->fetch_assoc();
			$nickname = $row_user["nickname"];
			require("./_comment_form.php");  //引入留言表單
		} else { ?>
			<div class="redirection">
				想要留言？
				<a class="btn__comment" href="login.php">登入留言</a>
			</div>
<?php 	} ?>
			</div>


<?php
	
	require_once ("../connect.php"); //連接資料庫

	// 讀取 comments 第一層
	$sql = "SELECT * FROM `twgd_comments` INNER JOIN `twgd_users` ON twgd_comments.user_id = twgd_users.user_id WHERE `parent_id`=0 ORDER BY time DESC"; 
	$result = $conn->query($sql);

	// 設定頁數
	$total = $result->num_rows;
	$number = 10;
	$pages = ceil($total/$number);

	if (!isset($_GET["page"])){ 
	        $page = 1; 
	    } else {
	        $page = $_GET["page"]; 
	    }
	    $start = ($page-1) * $number; 
	    $result = $conn->query($sql .' LIMIT '. $start . ', ' . $number);

	//顯示 comments 第一層
	for($i=1; $i<= $result->num_rows; $i++) {
		$row = $result->fetch_assoc(); 
		$parent_id = $row["com_id"]; ?>

			<div class="board__container">
				<div class="comment__container">
					<div class="status">
						<div class="nickname"> <?= $row["nickname"] ?> </div>
						<div class="time"> <?= $row["time"]?> </div>
					</div>				
					<div class="content"> <?= $row["content"]?> </div>
				</div>

<?php	// 讀取 comments 第二層 (回覆)
		$sql_rpy = "SELECT * FROM `twgd_comments` INNER JOIN `twgd_users` ON twgd_comments.user_id = twgd_users.user_id WHERE `parent_id` = " . $parent_id . " ORDER BY time"; 
		$result_rpy = $conn->query($sql_rpy); 

		// 顯示 comments 第二層 (回覆)
		for($j=1; $j<= $result_rpy->num_rows; $j++) {
			$row_rpy = $result_rpy->fetch_assoc();	?>


				<div class="reply">
					<div class="status">
						<div class="nickname"><?= $row_rpy["nickname"] ?> </div>
						<div class="time"><?= $row_rpy["time"] ?> </div>
					</div>
					<div class="content"><?= $row_rpy["content"] ?> </div>
				</div>

<?php	} ?>

				<div class="reply">

	<?php 	if (isset($_COOKIE["user_id"])) {
				require("./_reply_form.php"); // 引入回覆表單
			} else { ?>
				<div class="redirection">
					想要回覆？
					<a class="btn__reply" href="login.php">登入回覆</a>
				</div>
	<?php 	} ?>
				    
				</div>

			</div>
<?php
	} ?>
		
		</div>

<?php
	$conn->close();
	require('./_footer.php'); //共同頁尾
?>

	</body>
</html>
