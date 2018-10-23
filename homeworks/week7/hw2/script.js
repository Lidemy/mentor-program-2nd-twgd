// 新增 Todo

// 點擊新增
$('#button-addon2').click(() => {
	addNewTodo();
})

// 按 Enter 新增
$('#input-add').keydown( e => {
	if(e.key === 'Enter'){
		addNewTodo();
	}
})

const addNewTodo = () => {
	// 取 input 的值
	let value = $('#input-add').val();
	if (value !== '') {
		// 複製一個新的 list-row
		let listRow = $('.list-row').first().clone().removeClass('hidden');
		// 放入 value
		listRow.find('.list-text').text(value);
		// append
		$('.list-group').append(listRow);
		// 清空 input
		$('#input-add').val('');
	}
}

// 刪除 Todo
$('.list-group').on('click','.delete', e => {
	$(e.target).parent().remove();	
})

// 完成及取消 Todo
$('.list-group').on('click', '.checkbox', e => {
	$(e.target).parent().toggleClass('done');
})

// 編輯 list 時的效果
$('.list-group').on('focus', '.list-text', e => {
	$(e.target).parent().addClass('edit');
})

// 結束編輯 list 時的效果
$('.list-group').on('blur', '.list-text', e => {
	$(e.target).parent().removeClass('edit');
})

