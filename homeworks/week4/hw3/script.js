document.addEventListener('DOMContentLoaded', () => {

	//連線要帶的資料
	let id = 'im0ctjsrcauz1sud8rdfsdusuvu17c';
	let game = 'League%20of%20Legends';
	let limit = 20;
	let url = 'https://api.twitch.tv/kraken/streams/?client_id=' + id + '&game=' + game + '&limit=' + limit;
	
	//連線
	let request = new XMLHttpRequest();
	request.open('GET', url, true);
	request.onload = () => {  
	    //成功取得資料
	    if (request.status >= 200 && request.status < 400) {
		  	let strData = JSON.parse(request.responseText).streams;
			
		  	//取得資料後的動作
			for (let i=0; i<strData.length; i++) {
				//產生 live stream 的元素
				let strDiv = document.createElement('div');
				strDiv.setAttribute('class', 'stream');
				
				//live stream 內的 HTML
				let strHtml = `						
					<a href="${strData[i].channel.url}" target="_blank">
					<div class="preview">
						<img src="${strData[i].preview.medium}" />
					</div>
					<div class="description">
						<div class="logo">
							<img src="${strData[i].channel.logo}" />
						</div>
						<div class="title">
							<div class="status">${strData[i].channel.status}</div>
							<div class="name">${strData[i].channel.display_name}</div>
						</div>
					</div>
					</a>
				`
				//在 container 內塞入元素
				let strsContainer = document.querySelector('.strs-container');
				strsContainer.appendChild(strDiv).innerHTML = strHtml ;
			}

	    } else {
		    document.querySelector('.str-container').innerText = 'error'

	    }
	};

	request.onerror = () => {
		document.querySelector('.str-container').innerText = 'error'
	};

	request.send();

})

