<?php
	/*
	登出頁
	*/
	session_start();
	
	//清除 Session
	session_unset();
		
	//清空 csrftoken Cookie
	setcookie("csrftoken", "", time()-1, "/");
	
	//轉回留言板
	header("location:./comment.php");
?>