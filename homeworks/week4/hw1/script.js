document.addEventListener('DOMContentLoaded', () => {
	//選擇元素的函式
	const q = n => document.querySelector(n);

	let holder = ''; //算式列
	let	list = ''; //承接目前按的數字與顯示計算結果
	let opeArr = []; //準備做計算的陣列

	//按鍵事件
	q('.keypad__container').addEventListener('click', e => {

		let key = e.target.innerText;

		//更新算式列的函式
		const newHolder = () => {
			holder += key;
			q('.holder').innerText = holder;
		}
		//更新顯示數字的函式
		const newList = () => {
			list += key;
			q('.list').innerText = list;
		}
		
		//按下每個按鍵的動作
		if (key === 'AC') {  // 清除鍵
			holder = '';
			list = '';
			q('.holder').innerText = holder;
			q('.list').innerText = '0';
			opeArr = []; 
		} else if (parseInt(key) > 0 && parseInt(key) <= 9) {  //數字 1~9
			newHolder();
			newList();
		} else if (key === '0' && list !== '' && holder !=='') {  // 數字0 不能出現在最高位數
			newHolder();
			newList();
		} else if (key === '+' || key === '-' || key ==='×' || key ==='÷') {  //加減乘除號
			newHolder();
			opeArr.push(list);
			list = '';
		} else if (key === '=') {  //等號
			//還在思考下面這塊更簡化的寫法...
			if (holder.indexOf('+') !== -1){
				opeArr.push(list);
				list = opeArr.map(num => parseInt(num)).reduce((a, b) => a + b);
				q('.list').innerText = list;
			} else if (holder.indexOf('-') !== -1){
				opeArr.push(list);
				list = opeArr.map(num => parseInt(num)).reduce((a, b) => a - b);
				q('.list').innerText = list;
			} else if (holder.indexOf('×') !== -1){
				opeArr.push(list);
				list = opeArr.map(num => parseInt(num)).reduce((a, b) => a * b);
				q('.list').innerText = list;
			} else if (holder.indexOf('÷') !== -1){
				opeArr.push(list);
				list = opeArr.map(num => parseInt(num)).reduce((a, b) => a / b);
				q('.list').innerText = list;
			}
			opeArr = [];
		} else {
			// 小數點罷工
		}
	})
})

		



	/*
	最初寫法超級重複，留著紀念

	// 清除鍵
	q('#ac').addEventListener('click', () => {
		holder = '';
		list = '0';
		addArr = []; 
		minArr = []; 
		mulArr = []; 
		divArr = []; 
		q('.holder').innerText = holder;
		q('.list').innerText = list;
	})
	
	// 數字鍵 0~9
	q('#num__0').addEventListener('click', () => {
		//算式列 
		if(holder !== '') { // 0 不能出現在最高位數
			holder += 0;
			q('.holder').innerText = holder;
		}
		//目前顯示數字 
		if(list !== '0') { // 0 不能出現在最高位數
			list += 0;
			q('.list').innerText = list;
		}
	})

	q('#num__1').addEventListener('click', () => {
		//算式列 
		holder += 1;
		q('.holder').innerText = holder;
		//目前顯示數字 
		if(list === '0') { // 0 不能出現在最高位數
			list = '1';
		} else {
			list += 1;
		}
		q('.list').innerText = list;
	})
	
	q('#num__2').addEventListener('click', () => {
		holder += 2;
		q('.holder').innerText = holder;
		if(list === '0') {
			list = '2';
		} else {
			list += 2;
		}
		q('.list').innerText = list;
	})

	q('#num__3').addEventListener('click', () => {
		holder += 3;
		q('.holder').innerText = holder;
		if(list === '0') {
			list = '3';
		} else {
			list += 3;
		}
		q('.list').innerText = list;
	})

	q('#num__4').addEventListener('click', () => {
		holder += 4;
		q('.holder').innerText = holder;
		if(list === '0') {
			list = '4';
		} else {
			list += 4;
		}
		q('.list').innerText = list;
	})

	q('#num__5').addEventListener('click', () => {
		holder += 5;
		q('.holder').innerText = holder;
		if(list === '0') {
			list = '5';
		} else {
			list += 5;
		}
		q('.list').innerText = list;
	})

	q('#num__6').addEventListener('click', () => {
		holder += 6;
		q('.holder').innerText = holder;
		if(list === '0') {
			list = '6';
		} else {
			list += 6;
		}
		q('.list').innerText = list;
	})

	q('#num__7').addEventListener('click', () => {
		holder += 7;
		q('.holder').innerText = holder;
		if(list === '0') {
			list = '7';
		} else {
			list += 7;
		}
		q('.list').innerText = list;
	})

	q('#num__8').addEventListener('click', () => {
		holder += 8;
		q('.holder').innerText = holder;
		if(list === '0') {
			list = '8';
		} else {
			list += 8;
		}
		q('.list').innerText = list;
	})

	q('#num__9').addEventListener('click', () => {
		holder += 9;
		q('.holder').innerText = holder;
		if(list === '0') {
			list = '9';
		} else {
			list += 9;
		}
		q('.list').innerText = list;
	})

	// 運算元
	//加號
	q('#ope__add').addEventListener('click', () => {
		if(holder !== '') {
		//運算子不能出現在最前面
			holder += '+';
			q('.holder').innerText = holder;
		}
		addArr.push(list);
		list = '0';
	})

	//減號
	q('#ope__min').addEventListener('click', () => {
		if(holder !== '') {
			holder += '-';
			q('.holder').innerText = holder;
		}
		minArr.push(list);
		list = '0';
	})

	//乘號
	q('#ope__mul').addEventListener('click', () => {
		if(holder !== '') {
			holder += '×';
			q('.holder').innerText = holder;
		}
		mulArr.push(list);
		list = '0';
	})

	//除號
	q('#ope__div').addEventListener('click', () => {
		if(holder !== '') {
			holder += '÷';
			q('.holder').innerText = holder;
		}
		divArr.push(list);
		list = '0';
	})

	// 等號
	q('#ope__equ').addEventListener('click', () => {
		if(addArr) {
			addArr.push(list);
			list = addArr.map(num => parseInt(num)).reduce((a, b) => a + b);
			q('.list').innerText = list;
		}
		if(minArr) {
			minArr.push(list);
			list = minArr.map(num => parseInt(num)).reduce((a, b) => a - b);
			q('.list').innerText = list;
		}
		if(minArr) {
			mulArr.push(list);
			list = mulArr.map(num => parseInt(num)).reduce((a, b) => a * b);
			q('.list').innerText = list;
		}
		if(minArr) {
			divArr.push(list);
			list = divArr.map(num => parseInt(num)).reduce((a, b) => a / b);
			q('.list').innerText = list;
		}
		addArr = []; 
		minArr = []; 
		mulArr = []; 
		divArr = []; 
	})
	*/

