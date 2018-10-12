## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼

### TEXT

- 固定的最大長度 65535 字元。無法設定最大長度。
- 只能設定特定長度為索引。

### VARCHAR

- 可變的最大長度 65535 字元。要設定最大長度。
- 可以全部設為索引。


## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又會以什麼形式帶去 Server？

Cookie 是伺服器送給使用者的瀏覽器儲存的資料 ( 存在 client 端 )。通常儲存使用者的各種偏好設定，也包含使用者個人的識別資訊 ( 例如：姓名、帳號、email 等等)。瀏覽器會儲存 Cookie 並在下次發送 Request 的時候，將 Cookie 的資訊帶給伺服器。

使用 HTTP Request 的 Header 區塊來帶資料。例如：

Request Header 會顯示一列：
`Cookie: user_id=value`

Response Header 會顯示一列：
`Set-Cookie: user_id=value; expires=Thu, 01-Jan-1970 00:00:01 GMT; Max-Age=0`


## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？

- 使用 Cookie 儲存登入狀態：Cookie 是存在 client 端的資料，可以透過偽造非法登入後台。
  通常應該使用 Session 來儲存登入狀態的資料，Session 是保存在 server 端，相對安全。

- 密碼存明碼：若資料庫被駭，會員的帳號密碼會一覽無遺。通常密碼應該用「雜湊函式」處理過後再儲存。

