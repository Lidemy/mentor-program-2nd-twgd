<form action="./comment_add.php" method="POST">
	<div class="status">
		<div class="nickname"><?= $nickname ?></div>
	</div>
	<input class="input__user_id" type="hidden" name="user_id" value="<?= $_COOKIE['user_id'] ?>">
	<div>
		<textarea class="textarea__content" name="content" rows="3" placeholder="留下回覆"></textarea>
	</div>
	<input type="hidden" name="parent_id" value="<?= $row["com_id"]?>">
	<input class="btn__reply" type="submit" name="submit" value="回覆">
</form>