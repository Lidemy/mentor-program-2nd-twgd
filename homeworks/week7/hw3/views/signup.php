<?php 
	/*
	檔案：註冊頁面
	*/
	
	//引入檢查 Cookie 的檔案
	require("../controllers/check_user_certificate.php");
	
	//引入控制註冊操作的檔案
	require("../controllers/signup_add-user.php");
?>

<!DOCTYPE html>
<html>
<?php require('_head.php'); ?>

	<body>
		<div class="container">
			<div class="title">註冊會員</div>

			<div class="form">

				<form action="./signup.php" method="POST">

					<?php if (isset($success)){ ?>

					<div class="success"><?= $success; ?></div>

					<?php }	?>

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
						<div class="input__que">確認密碼</div>

			<?php 	if (isset($_POST["username"])) { ?>
						<input class="input__ans" type="password" name="password2" value="<?= validation($_POST["password2"]) ?>" >
			<?php 	} else { ?>
						<input class="input__ans" type="password" name="password2" placeholder="再次輸入密碼">
			<?php 	} ?>

						
					</div>
					
					<div class="input">
						<div class="input__que">暱稱</div>

			<?php 	if (isset($_POST["username"])) { ?>
						<input class="input__ans" type="text" name="nickname" value="<?= validation($_POST["nickname"]) ?>" >
			<?php 	} else { ?>
						<input class="input__ans" type="text" name="nickname" placeholder="你的暱稱">
			<?php 	} ?>

						
					</div>

					<div class="input">
						<input class="input__btn" type="submit" name="submit" value="註冊">
					</div>

					<div class="notice"><?php if (isset($notice)) echo $notice; ?></div>

				</form>
		
		
			</div>

			<div class="redirection">
				已經註冊會員了？
				<a href="login.php">登入會員</a>
			</div>

		</div>

<?php require_once("./_footer.php") ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="../js/signup.js"></script>
	</body>
</html>


