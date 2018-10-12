<nav class="navbar">
	<ul>

<?php 	if (isset($_COOKIE["user_id"])) { ?>

		<li><a href="logout.php">登出</a></li>

<?php	} else { ?>

		<li><a href="login.php">登入/註冊</a></li>
		
<?php 	} ?>
		
	</ul>
</nav>