<?php

require_once ('../connect.php'); //連接資料庫

// 寫入主要留言
if (isset($_POST['nickname']) && isset($_POST['content']) && !empty($_POST['nickname']) && !empty($_POST['content'])) {
	$nickname = $_POST['nickname'];
	$content = $_POST['content'];
	$parent_id = $_POST['parent_id'];
	$sql = "INSERT INTO twgd_guestcomments(nickname, content, parent_id) VALUES ('$nickname', '$content', $parent_id)"; 
	
	if ($conn->query($sql) === TRUE) {
		header("location:comment.php");  
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
}


// 讀取資料庫
$sql = "SELECT * FROM `twgd_guestcomments` WHERE `parent_id`=0 ORDER BY time DESC"; 
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


?>





<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>twgd hw5-2</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="style.css">

	</head>
	<body>
		<div class="web__container">

			<div class="title">我要留言</div>

			<div class="board__container">
				<form action="comment.php" method="POST">
					<input class="input__nickname" type="text" name="nickname" placeholder="你的暱稱">			
					<textarea class="textarea__content" name="content" rows="5" placeholder="你想說什麼？"></textarea>
					<input type="hidden" name="parent_id" value="0">
					<input class="btn__comment" type="submit" name="submit" value="留言">
				</form>
			</div>


<?php

//顯示留言
for($i=1; $i<= $result->num_rows; $i++) {
	$row = $result->fetch_assoc(); 
	$parent_id = $row["id"];

?>


			<div class='board__container'>

				<div class="nickname"> <?php echo $row["nickname"] ?> </div>
				<div class="time"> <?php echo $row["time"]?> </div>
				<div class="content"> <?php echo $row["content"]?> </div>
				

<?php

	//顯示回覆
	$sql_rpy = "SELECT * FROM `twgd_guestcomments` WHERE `parent_id` = " . $parent_id . " ORDER BY time"; 
	$result_rpy = $conn->query($sql_rpy); 
	for($j=1; $j<= $result_rpy->num_rows; $j++) {
		$row_rpy = $result_rpy->fetch_assoc();	



?>


				<div class="reply">
					<div class="nickname"><?php echo $row_rpy["nickname"] ?> </div>
					<div class="time"><?php echo $row_rpy["time"] ?> </div>
					<div class="content"><?php echo $row_rpy["content"] ?> </div>
				</div>



<?php

	}

?>


				<div class="reply">
				    <form action="comment.php" method="POST">
						<input class="input__nickname" type="text" name="nickname" placeholder="你的暱稱">
						<textarea class="textarea__content" name="content" rows="3" placeholder="留下回覆"></textarea>
						<input type="hidden" name="parent_id" value="<?php echo $row["id"]?>">
						<input class="btn__reply" type="submit" name="submit" value="回覆">
					</form>
				</div>

			</div>


<?php

}

?>
		
		</div>

		<footer class="footer">

<?php
for($i=1; $i<=$pages; $i++){
	echo   "<a href='comment.php?page=" . $i . "'> [ " . $i . " ] </a>";
}?>

		</footer>

	</body>
</html>
