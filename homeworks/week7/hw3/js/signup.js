$('form').submit( e => {
    const username = $(e.target).find('input[name="username"]').val();
    const password = $(e.target).find('input[name="password"]').val();
    const password2 = $(e.target).find('input[name="password2"]').val();
    const nickname = $(e.target).find('input[name="nickname"]').val();
    
    if (username === ''|| password === ''|| password2 === ''|| nickname === ''){
        e.preventDefault();
        const notice = '請填寫完整再送出';
        $(e.target).find('.notice').text(notice);
    }
})