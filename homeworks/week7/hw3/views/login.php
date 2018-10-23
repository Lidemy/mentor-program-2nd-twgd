<?php 
	/*
	檔案：登入頁面
	*/
	
	//引入檢查 Cookie 的檔案
	require("../controllers/check_user_certificate.php");

	//引入控制登入操作的檔案
	require("../controllers/login_check-user.php");
?>

<!DOCTYPE html>
<html>
<?php require('_head.php'); ?>
	<body>
		<div class="container">
			<div class="title">登入會員</div>

			<div class="form">

				<form action="./login.php" method="POST">
					<div class="input">
						<div class="input__que">帳號</div>

			<?php 	if (isset($_POST["username"])) { ?>
						<input class="input__ans" type="text" name="username" value="<?= validation($_POST["username"]) ?>" >
			<?php 	} else { ?>
						<input class="input__ans" type="text" name="username" placeholder="你的帳號">
			<?php 	} ?>
						
					</div>
					<div class="input">
						<div class="input__que">密碼</div>

			<?php 	if (isset($_POST["username"])) { ?>
						<input class="input__ans" type="password" name="password" value="<?= validation($_POST["password"]) ?>" >
			<?php 	} else { ?>
						<input class="input__ans" type="password" name="password" placeholder="你的密碼">
			<?php 	} ?>

						
					</div>
					<div class="input">
						<input class="input__btn" type="submit" name="submit" value="登入">
					</div>

					<div class="notice"><?php if (isset($notice)) echo $notice; ?></div>
					
				</form>

			</div>	

			<div class="redirection">
				還不是會員嗎？
				<a href="./signup.php">註冊會員</a>
			</div>
			

			

		</div>

<?php require_once("./_footer.php") ?>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="../js/login.js"></script>
	</body>
</html>







