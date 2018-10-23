$('form').submit( e => {
    const username = $(e.target).find('input[name="username"]').val();
    const password = $(e.target).find('input[name="password"]').val();
    if (username === ''|| password === ''){
        e.preventDefault();
        const notice = '帳號密碼不可以空白';
        $(e.target).find('.notice').text(notice);
    }
})