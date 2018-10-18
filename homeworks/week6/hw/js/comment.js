
const qAll = n => document.querySelectorAll(n);
const q = n => document.querySelector(n);

//展開回覆留言表單
for(let i=0; i<qAll('.expand').length; i++) {
	qAll('.expand')[i].addEventListener('click', e => {
		//console.log(e);
		showReplyForm(e);

		//取消
		q('.cancel').addEventListener('click', e => {
			//console.log(e);
			cancelReplyForm(e);	
		})
		
	})
}


//展開編輯留言表單
for(let i=0; i<qAll('.edit').length; i++) {
	qAll('.edit')[i].addEventListener('click', e => {
		//console.log(e);
		showEditForm(e);	

		//取消
		q('.cancel').addEventListener('click', e => {
			//console.log(e);
			cancelEditForm(e);	
		})		
	})
}



const showReplyForm = t => {
	t.target.hidden = true;
	let user_id = t.path[1].children[1].innerText;
	let parent_id = t.path[1].children[2].innerText;

	let reply_form = `
		<form action="./comment_add.php" method="POST">
			<div class="status">
				<div class="nickname nickname__reply">${nickname}</div>
			</div>
			<input class="input__user_id" type="hidden" name="user_id" value="${user_id}">
			<div>
				<textarea class="textarea__content" name="content" rows="3" placeholder="留下回覆"></textarea>
			</div>
			<input type="hidden" name="parent_id" value="${parent_id}">
			<input type="hidden" name="csrftoken" value="${csrftoken}"/>
			<div class="cancel btn__reply">取消</div>
			<input class="btn__comment" type="submit" name="submit" value="回覆">
		</form>
	`
	let form = document.createElement('div');
	t.path[1].appendChild(form).innerHTML = reply_form;
}

const cancelReplyForm = t => {
	let removeNode = t.path[3].lastChild;
	t.path[3].removeChild(removeNode);
	t.path[3].children[0].hidden = false;
}

const showEditForm = t => {
	let com_id = t.path[1].children[1].innerText;
	let value = t.path[2].children[1].innerText;
	let comment_form_edit = `
		<form action="./comment_edit.php" method="POST">			
			<div>
				<textarea class="textarea__content" name="content" rows="5">${value}</textarea>
			</div>
			<input type="hidden" name="com_id" value="${com_id}">
			<input type="hidden" name="csrftoken" value="${csrftoken}"/>
			<div class="cancel btn__reply">取消</div>
			<input class="btn__comment" type="submit" name="submit" value="更新">
		</form>
	`
	let form = document.createElement('div');
	t.path[2].appendChild(form).innerHTML = comment_form_edit;
	t.path[2].children[1].hidden = true;
	t.target.parentNode.style.display = "none";
}

const cancelEditForm = t => {
	let removeNode = t.path[3].lastChild;
	t.path[3].removeChild(removeNode);
	t.path[3].children[1].hidden = false;
	t.path[3].children[2].style.display = "flex";
}




