## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？

### 什麼是 DNS？

Domain Name System 
功能：將 Domain 與 IP 位置對應，能夠讓人更方便地存取網際網路。

- Google Public DNS 對 Google 的好處
  利於 Google 蒐集數據。
  例如：蒐集網站被造訪的狀況。

  其他類似的 Public DNS 服務：Quad 9 (9.9.9.9)， Cloudflare (1.1.1.1)

- Google Public DNS 對一般大眾的好處
  - 好記
  - 通常比 ISP 提供的預設 DNS 更新更即時、解析速度更快 ( 解析不需要轉太多層、有 cache 技術 )，加速使用者瀏覽速度。
  - 安全機制：自動幫使用者過濾掉惡意網站。也確保可以連到正確的網站。


## 什麼是資料庫的 lock？為什麼我們需要 lock？

### 什麼是資料庫的 lock？

為了交易的一致性與隔離性，在同一時間內只允許一個交易對特定資料進行讀寫。
Lock 就像是：資料會先被做一個「記號」，其他交易會根據這個記號等待，不會同時執行操作。

### 為什麼我們需要 lock？

避免多人同時存取資料時，發生的問題：更新遺失（lost update）、髒讀（dirty read）、無法重複的讀取（unrepeatable read）、幻讀（phantom read）等等。
若沒有 lock，有可能造成問題，像是：車票超賣。


## NoSQL 跟 SQL 的差別在哪裡？

### NoSQL
- 不需要資料架構 (Schema)
- 不支援 JOIN
- 不使用 SQL 作為查詢語言

### SQL
- 有資料架構 (Schema)
- 支援 JOIN
- 使用 SQL 作為查詢語言


## 資料庫的 ACID 是什麼？

為了確保 Transaction 執行正確，資料庫在更新資料時，必須具備四個特性：

- 不可分割性 ( 或稱原子性 )(Atomicity)：
  一個 Transaction 的操作，要不全部完成，要不全部失敗。若執行過程發生錯誤，會被恢復到 Transaction 執行前的狀態。

- 一致性 (Consistency)：
  Transaction 執行前後，資料的完整性沒有被破壞。( 例如：轉帳金額，轉帳前後金錢總額必須相等。也就是匯出與匯入的金額必須一致。 )

- 隔離性 (Isolation)：
  不同 Transaction 之間不會互相影響。( 例如：不能同時更新資料 )
  
- 持久性 (Durability)：
  Transaction 完成之後，修改必須被永久保存下來，也就是寫入的資料不會不見。