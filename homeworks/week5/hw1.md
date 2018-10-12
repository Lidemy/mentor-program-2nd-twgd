## 資料庫名稱：comments

### Table 名稱：comments

| 欄位名稱 | 欄位型態 | 說明 |
|---------|---------|------|
|  id     | integer | 留言 id (auto_incredement)(Primary) |
| nickname | varchar(64) |  暱稱  |
| content   | text | 留言內容  |
| parent_id | integer | 上層留言的 id |
| time   | timestamp | 留言時間戳記 (預設值：CURRENT_TIMESTAMP、屬性：null)  |

- timestamp 型態預設的選項內容是：「預設值：CURRENT_TIMESTAMP」、「屬性：on update CURRENT_TIMESTAMP」，意思是「新增」及「編輯」資料的時候，都會更新時間戳記。因此若只想記錄「新增」留言時的時間，要另外把「屬性」設定為 null。



## 導入會員系統之後


### Table 名稱：comments


| 欄位名稱 | 欄位型態 | 說明 |
|---------|---------|------|
|  com_id     | integer | 留言 id (auto_incredement)(Primary) |
| content   | text | 留言內容  |
| parent_id | integer | 上層留言的 id |
| time   | timestamp | 留言時間戳記 (預設值：CURRENT_TIMESTAMP、屬性：null)  |
| user_id | integer | 會員 id |


### Table 名稱：users


| 欄位名稱 | 欄位型態 | 說明 |
|---------|---------|------|
| user_id | integer | 會員 id (auto_incredement)(Primary) |
| username | varchar(16) |  帳號  |
| password | varchar(16) |  密碼  |
| nickname | varchar(64) |  暱稱  |



