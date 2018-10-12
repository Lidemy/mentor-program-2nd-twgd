<?php 
	if(isset($_COOKIE["user_id"])) {

	    header("location:comment.php");

	} 
	
	require("./signup_add-user.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>twgd hw5-3 註冊會員</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="./css/main.css" />
		<link rel="stylesheet" type="text/css" href="./css/login&signup.css" />

	</head>
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
						<input class="input__ans" type="text" name="username" value="<?= $_POST["username"] ?>" >
			<?php 	} else { ?>
						<input class="input__ans" type="text" name="username" placeholder="你的帳號">
			<?php 	} ?>
 						
					</div>

					<div class="input">
						<div class="input__que">密碼</div>

			<?php 	if (isset($_POST["username"])) { ?>
						<input class="input__ans" type="password" name="password" value="<?= $_POST["password"] ?>" >
			<?php 	} else { ?>
						<input class="input__ans" type="password" name="password" placeholder="你的密碼">
			<?php 	} ?>

					
					</div>
					<div class="input">
						<div class="input__que">確認密碼</div>

			<?php 	if (isset($_POST["username"])) { ?>
						<input class="input__ans" type="password" name="password2" value="<?= $_POST["password2"] ?>" >
			<?php 	} else { ?>
						<input class="input__ans" type="password" name="password2" placeholder="再次輸入密碼">
			<?php 	} ?>

						
					</div>
					
					<div class="input">
						<div class="input__que">暱稱</div>

			<?php 	if (isset($_POST["username"])) { ?>
						<input class="input__ans" type="text" name="nickname" value="<?= $_POST["nickname"] ?>" >
			<?php 	} else { ?>
						<input class="input__ans" type="text" name="nickname" placeholder="你的暱稱">
			<?php 	} ?>

						
					</div>

					<div class="input">
						<input class="input__btn" type="submit" name="submit" value="註冊">
					</div>

		<?php 	if (isset($notice)){ ?>

					<div class="notice"><?= $notice; ?></div>

		<?php 	}	?>
					

				</form>
		
		
			</div>

			<div class="redirection">
				已經註冊會員了？
				<a href="login.php">登入會員</a>
			</div>

		</div>

<?php require_once("./_footer.php") ?>


	</body>
</html>


