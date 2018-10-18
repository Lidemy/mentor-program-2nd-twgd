<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>twgd week6 會員制留言板</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="./css/main.css">
		<link rel="stylesheet" type="text/css" href="./css/comment.css">
	</head>

	<body>
<?php 	require("_navbar.php"); ?>

		<div class="web__container">
			<div class="title">我要留言</div>
			<div class="board__container">

	<?php 	// 如果登入，顯示留言表單
			if (isset($_COOKIE["cer_id"])) {

				//檢查資料庫裡有沒有這個通行證 (cer_id)
				require("../connect.php");
				$cer_id = $_COOKIE["cer_id"];
				$sql_user = "SELECT * FROM `twgd_users_certificate` INNER JOIN `twgd_users` ON twgd_users_certificate.username = twgd_users.username WHERE `cer_id` = ?";
				$stmt_user = $conn->prepare($sql_user);
				$stmt_user->bind_param("s", $cer_id);
				$stmt_user->execute();

				if ($result_user = $stmt_user->get_result()) {
					//有這個通行證 產生一組 csrftoken
					$csrftoken = md5(time().rand());
					setcookie("csrftoken", $csrftoken);

					//有這個通行證 就顯示留言表單
					$row_user = $result_user->fetch_assoc();
					$nickname = $row_user["nickname"];
					require("./_comment_form.php"); 
				
				} else {
					//查無通行證的話，清空 Cookie 並跳到登入頁
					setcookie("cer_id", "", time()-1);
					header("location:./login.php");
				}
				$conn->close();		
			} else { ?>
				<div class="redirection">
					想要留言？
					<a class="btn__comment" href="login.php">登入留言</a>
				</div>
	<?php 	} ?>
			</div>


<?php
	//連接資料庫
	require("../connect.php"); 

	// 讀取 comments 第一層
	$sql = "SELECT * FROM `twgd_comments` INNER JOIN `twgd_users` ON twgd_comments.user_id = twgd_users.user_id WHERE `parent_id`=0 ORDER BY time DESC"; 
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();

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
	    $stmt = $conn->prepare($sql . " LIMIT ? , ? ");
	    $stmt->bind_param("ii", $start, $number);
	    $stmt->execute();
		$result = $stmt->get_result();

	//顯示 comments 第一層
	for($i=1; $i<= $result->num_rows; $i++) {
		$row = $result->fetch_assoc(); 
		$parent_id = $row["com_id"]; ?>

			<div class="board__container">
				<div class="comment__container">
					<div class="status">
						<div class="nickname"> <?= $row["nickname"] ?></div>
						<div>
							<div class="time"><?= $row["time"]?></div>
				<?php 	if ($row["time_edit"]) { ?>
							<div class="time">已編輯 <?= $row["time_edit"]?></div> 
				<?php	} ?>	
						</div>
					</div>				
					<div class="content"> <?= $row["content"]?></div>

		<?php 	//會員可以 編輯 & 刪除留言
				if (isset($row_user) && $row["user_id"] === $row_user["user_id"]){ ?>		
					<div class="edit-container">
						<!--編輯按鈕-->
						<div class="edit btn__reply">編輯</div>
						<div class="hidden"><?= $row["com_id"] ?></div>
						<!--刪除按鈕-->
						<form action="./comment_delete.php" method="POST">
						  <input type="hidden" name="com_id" value="<?= $row['com_id'] ?>"/>
						  <input type="hidden" name="csrftoken" value="<?= $csrftoken ?>"/>
						  <input class="delete btn__reply" type="submit" value="刪除"/>
						</form>
					</div>
					
		<?php 	} ?>
				</div>

<?php	// 讀取 comments 第二層 (回覆)
		$sql_rpy = "SELECT * FROM `twgd_comments` INNER JOIN `twgd_users` ON twgd_comments.user_id = twgd_users.user_id WHERE `parent_id` = ? ORDER BY time"; 
		$stmt_rpy = $conn->prepare($sql_rpy);
		$stmt_rpy->bind_param("i", $parent_id);
		$stmt_rpy->execute();
		$result_rpy = $stmt_rpy->get_result();

		// 顯示 comments 第二層 (回覆)
		for($j=1; $j<= $result_rpy->num_rows; $j++) {
			$row_rpy = $result_rpy->fetch_assoc();	

			// 如果是會員自己的回覆，背景顯示不同顏色
			if ($row["user_id"] === $row_rpy["user_id"]){ ?>
				<div class="reply self">
		<?php	} else { ?>
				<div class="reply">
	<?php	} ?>	<div class="status">
						<div class="nickname nickname__reply"><?= $row_rpy["nickname"] ?></div>
						<div>
							<div class="time"><?= $row_rpy["time"] ?></div>
				<?php 	if ($row_rpy["time_edit"]) { ?>
							<div class="time">已編輯 <?= $row_rpy["time_edit"]?></div> 
				<?php	} ?>						
						</div>					
					</div>
					<div class="content"><?= $row_rpy["content"] ?></div>

		<?php 	//編輯 & 刪除留言
				if (isset($row_user) && $row_rpy["user_id"] === $row_user["user_id"]){ ?>		
					<div class="edit-container">
						<!--編輯按鈕-->
						<div class="edit btn__reply">編輯</div>
						<div class="hidden"><?= $row_rpy["com_id"] ?></div>
						<!--刪除按鈕-->
						<form action="./comment_delete.php" method="POST">
						  <input type="hidden" name="com_id" value="<?= $row_rpy['com_id'] ?>"/>
						  <input type="hidden" name="csrftoken" value="<?= $csrftoken ?>"/>
						  <input class="delete btn__reply" type="submit" value="刪除"/>
						 </form>
					</div>
		<?php 	} ?>
				</div>

<?php	} ?>

				<div class="reply">

	<?php 	// 如果登入，顯示回覆表單
			if (isset($row_user)) { ?>

					<div class="expand">
						點我發表回覆
					</div>
					<div class="hidden"><?= $row_user["user_id"] ?></div>
					<div class="hidden"><?= $row["com_id"] ?></div>
<?php
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
	//引入頁尾
	require('./_footer.php'); 
	$result->close();
	$result_rpy->close();
	$conn->close();
?>
		<script type="text/javascript">
			let csrftoken = "<?php if (isset($csrftoken)) echo $csrftoken ?>";
			let nickname = "<?php if (isset($nickname)) echo $nickname ?>";
		</script>
		<script type="text/javascript" src="./js/comment.js"></script>

	</body>
</html>
