<footer class="footer">

	<div class="footer__pages">

<?php
	if (isset($pages)) {
		for($i=1; $i<=$pages; $i++){ ?>

			<a href="comment.php?page=<?= $i ?>"><?= $i ?></a>

<?php 	}
 	} ?>

	</div>
		

	<div class="footer__aboutme">
		<a href="./comment.php">留言板</a><br>
		這是 <a href="https://github.com/twgd">TWGD</a> 的 <a href="https://github.com/Lidemy/mentor-program-2nd-twgd">mentor-program-2nd</a> 作業
	</div>

		
</footer>