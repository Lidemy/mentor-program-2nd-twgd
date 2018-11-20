const list = []

const addTodo = todo => {
	if (todo !== '') {
		list.push({
			value:todo,
			state:''
		});
		$('#input-add').val('');
		render()
	}
}


const removeTodo = id => {
	list.splice(id, 1)
	render()
}


const doneTodo = id => {
	if(list[id].state){
		list[id].state = '';
	}else{
		list[id].state = 'done';
	}
	render();
}


const editTodo = (id, value) => {
	list[id].value = value;
	render();
}


const render = () => {
	$('.list-group').empty()
	list.forEach( (item, index) => {
		let el = `
		<li class="list-group-item list-row ${item.state}">
			<div class="btn-circle checkbox">✓</div>
			<div class="index hidden">${index}</div>
			<div class="list-text" contenteditable="true">${item.value}</div>
			<div class="btn-circle delete">✕</div>
		</li>`	
		$('.list-group').append(el);	
	});	
}


// 點擊新增
$('#button-addon2').click(() => {
	let value = $('#input-add').val();
	addTodo(value);
})

// 按 Enter 新增
$('#input-add').keydown( e => {
	if(e.key === 'Enter'){
		let value = $('#input-add').val();
		addTodo(value);
	}
})


// 刪除 Todo
$('.list-group').on('click', '.delete', e => {
	let index = $(e.target).parent().find('.index').text();
	removeTodo(index);
})


// 完成及取消 Todo
$('.list-group').on('click', '.checkbox', e => {
	let index = $(e.target).parent().find('.index').text();
	doneTodo(index);
})


// 編輯 list 時的效果
$('.list-group').on('focus', '.list-text', e => {
	$(e.target).parent().addClass('edit');
})


// 結束編輯 list & 更新資料
$('.list-group').on('blur', '.list-text', e => {
	$(e.target).parent().removeClass('edit');
	let index = $(e.target).parent().find('.index').text();
	let edited = $(e.target).text();
	editTodo(index, edited);
})

