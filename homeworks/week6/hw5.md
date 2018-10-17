## 請說明 SQL Injection 的攻擊原理以及防範方法

### SQL Injection 攻擊原理
利用網站使用 SQL 字串拼接方式查詢資料庫的弱點，輸入特殊字元加以拼接字串，改變語法上的邏輯，進行非法的操作。

例如：

網站原本有一段 Query statement 如下：
`"SELECT * FROM users WHERE name ='user' AND password = 'password'"`

若有心人在 user 對應欄位輸入：`'OR 1=1 --`
( 輸入 `'` 將 name 的欄位關閉，加入 `OR 1=1` 恆等條件，並用 `--` 將後方註解)

使得 Query statement 變為：
`"SELECT * FROM customers WHERE name =''OR 1=1"`

達到改變語法邏輯的目的，略過密碼驗證。

### 防範方法

1. 對使用者的輸入進行過濾，如過濾一些特殊的符號：如單引號(‘) 、分號(;)、注釋符號(--)。

2. 使用 Prepared Statement，進行參數化查詢
簡單來說，就是先告訴資料庫你要查詢的語句，請資料庫預先準備好參數，再把值傳進來做處理。避免 Statement 被拼接修改。

舉例：(MySQLi 用法)
```
// prepare
$stmt = $conn->prepare("INSERT INTO users (username, email) VALUES (?, ?)");

// bind
$stmt->bind_param("ss", $username, $email);

// set parameters and execute
$username = "gakki";
$email = "gakki@gakki.com";
$stmt->execute();
```

## 請說明 XSS 的攻擊原理以及防範方法

### XSS (Cross-site scripting) 攻擊原理

透過注入 HTML 標籤插入程式碼，當使用者瀏覽網頁的時候，注入網頁中的程式碼就會被執行，進而達到非法操作。
通常利用 HTML 的 `<script>` 標籤注入 JavaScript 程式碼到網頁上。

例如：

有人在原本應該顯示純文字的地方，注入：
`<script>alert('得罪了方丈還想走？沒那麼容易！')</script>`

那麼載入網頁時這段程式碼會被執行，瀏覽器會 alert 訊息出來。

### 防範方法

- HTML escape，對使用者的輸入進行過濾

例如：使用 PHP 的 `htmlspecialchars()` 預先過濾使用者的輸入。


## 請說明 CSRF 的攻擊原理以及防範方法

### CSRF (Cross-site request forgery) 攻擊原理

在使用者「登入」網站的狀態，在「使用者不知情」的情況下，讓使用者執行某個操作，利用使用者的身分來發送 Request。
（CSRF 攻擊並不是直接獲取使用者的帳戶控制權。）

例如：

網站的刪除文章功能，單純使用了 GET：`/delete?articleId=1234`，而且在實際刪除文章之前，沒有進一步再確認的動作。
若有壞心人在其他網站，設下連結：
`<a href='user_site/delete?articleId=1234'>結衣的可愛照片，不看嗎？</a>`
誘騙使用者 ( 一片真心的結衣粉絲 ) 按下連結，使用者就會在不知情的情況下，刪除了文章。


### 防範方法

總而言之，就是要確保多一步驗證。

- 使用 CSRF token
server 端生成一組隨機的 token 放在隱藏的 input，並另外存在 Session，發 Request 上來時要驗證這組 token。因為攻擊者並不會知道這組 token 的值，所以沒有辦法偽造，發 Request 上來的時候，token 不一樣就不會成功執行。而 Double Submit Cookie 是一樣的概念，只是 token 是存在 Cookie。

例如：

刪除文章的做法
```
<form action="https://user_site/delete" method="POST">
  <input type="hidden" name="id" value="1234"/>
  <input type="hidden" name="csrftoken" value="jqwpeoriopwfdcko"/>
  <input type="submit" value="刪除"/>
</form>
```


## 請舉出三種不同的雜湊函數

### SHA-1
2017 年 Google 宣布攻破，證實碰撞 ( 不過攻破投入的資源非常大 )。

### bcrypt

目前 PHP `password_hash()` 支援的預設演算法。

### Argon2

目前 PHP `password_hash()` 支援的演算法。



## 請去查什麼是 Session，以及 Session 跟 Cookie 的差別

### 什麼是 Session

Session 是一種機制，主要用來紀錄使用者資訊，讓 Server 可以「分辨」同個使用者發出的 request。
因為 HTTP 是無狀態的設計，Server 不會記得 client 的狀態，為了解決這個問題，才有 Session 機制的產生。
早期 Session 機制的運作全部要工程師自己寫出來，現在則有語言或框架提供的 Session 可以直接使用。

Session 機制中，預設會用 Cookie 在 client 端儲存一組 session id。（ 例如：PHP Session 會設一組名稱為 PHPSESSID 的 Cookie ）
這是因為資料存在 Server 端，Server 端有不同使用者的資訊，為了分辨使用者，在瀏覽器送出 request 時，這組 session id 就會被送到 Server 端， Server 端就會找到相對應的使用者資訊給瀏覽器。

### Session 跟 Cookie 的差別

Session 與Cookie 最主要的差異在於「資料儲存的位置」：
- Session 資料是保存在 Server 端，比起 Cookie 相對安全。
- Cookie 是保存在 Client 端。


## `include`、`require`、`include_once`、`require_once` 的差別

### `include`、`require` 的差別：

基本上的功用是差不多的，都是引入檔案，好比把被引入檔案內的程式碼複製貼上過來一樣。主要的差別是：

- `include` 在執行時，如果被引入的檔案發生錯誤的話，會顯示警告，不會立刻停止；
- `require` 如果被引入的檔案發生錯誤的話，會顯示錯誤，立刻終止程式，不再往下執行。

### `include`、`include_once` 的差別 ( `require`、`require_once` 的差別) ：

- `include` (`require`)：若檔案已經在其他地方被引入過，還是會重複引入。
- `include_once` (`require_once`)：在引入檔案前，會先檢查檔案是否已經在其他地方被引入過了。若有，就不會再重複引入。



------

參考來源：
SQL Injection 部分：
- https://forum.gamer.com.tw/Co.php?bsn=60292&sn=11005
- https://www.gss.com.tw/index.php/focus/security/838-gss0051
- https://ithelp.ithome.com.tw/articles/10189201
- https://www.w3schools.com/php/php_mysql_prepared_statements.asp

XSS 部分：
- https://forum.gamer.com.tw/Co.php?bsn=60292&sn=11267
- https://zh.wikipedia.org/wiki/跨網站指令碼

CSRF 部分：
- https://blog.techbridge.cc/2017/02/25/csrf-introduction/
- https://zh.wikipedia.org/wiki/跨站请求伪造

Session 部分：
- https://openhome.cc/Gossip/ServletJSP/BehindHttpSession.html
- http://fred-zone.blogspot.com/2014/01/web-session.html
- https://codertw.com/伺服器/152321/


