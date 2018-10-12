<?php
	setcookie("user_id", "", time()-1);
	header("location:comment.php");
?>