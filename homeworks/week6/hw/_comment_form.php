<form action="./comment_add.php" method="POST">
	<div class="status">
		<div class="nickname"><?= $nickname ?></div>
	</div>
	<input class="input__user_id" type="hidden" name="user_id" value="<?= $row_user["user_id"] ?>">
	<div>
		<textarea class="textarea__content" name="content" rows="5" placeholder="你想說什麼？"></textarea>
	</div>
	<input type="hidden" name="parent_id" value="0">
	<input type="hidden" name="csrftoken" value="<?= $csrftoken ?>"/>
	<input class="btn__comment" type="submit" name="submit" value="留言">
</form>




