系統圖：http://poketrainer.tw/twgd/week8/hw1.svg

------

### 系統設計需求：
- 基本：
    - 穩定
    - 即時
    - 短網址不容易被預測 (安全性考量)

- 延伸需求：
    - 使用者可自訂短網址
    - 蒐集數據：例如網址觸及次數、來源等等。（資料的蒐集與分析應該是短網址服務背後很重要的目的）


### 基本系統設計及演算
- 如何產生短網址的『唯一值』：
    - 自增序列算法：
      產生自增序列 ID，對應到 62 進制，生成短網址，來達到不可重複。但這樣容易被預測，所以要讓 62 進制的字母不按順序排列，來達到不易預測。

- 轉址機制：如果查到有對應的短網址，就 status code 302，把存在資料庫的 url 帶到 request header 的 location；沒有的話，status code 404，顯示錯誤。另外，爲了達到可以統計數據的需求，採取 status code 302 (temporary) 而不是 301 (permanent)。


### Database 設計考量
- 短網址系統儲存的資料本質：
    - 數以千計的資料
    - 每筆資料都很小
    - 資料間不需要關聯
    - 「讀」的比重高於「寫」
- Database 類型：NoSQL (易於 scale)


### Data 劃分與 Replication
考量到資料量非常龐大以及易於 scaling，要劃分資料儲存在不同的 Database server。

若依短網址開頭字母劃分，有可能造成 server 不平衡的問題。( 因為字母分佈不平均 )
- 使用 hash based 的方式：比較容易平均分散。

( P.S. 這些 Database 的設計概念，覺得滿需要實作經驗的，目前所能理解的概念都很模糊... )


### 快取 Cache 設計
考量效能，使用 Cache
- 快取經常被觸及的 url，以減輕資料庫負擔。
- 快取滿的時候，先拋棄最不常被使用的 url (Least Recently Used (LRU))
- 快取 Replication：當 master 有新的快取更新時，其他 slave 也要 update。


### Load Balancer 負載平衡設計
通常 server 數量不會只有一台，需要 Load Balancer 來分流。
- 放在 Clients 和 App servers 之間。
- 放在 App Servers 和 database servers 之間。
- 放在 App Servers 和 Cache servers 之間。


### Database 資料清理
考慮是否釋放 Database 太久沒用的短網址？
不過主動搜尋到期的短網址來做清理，也會造成資料庫額外的負擔。另外想一想，不清好像也沒關係，其實單筆資料也沒佔到多大空間，Database 空間會越來越便宜。
覺得有釋放 Cache 應該比較重要，因為 Cache 比 Database 更貴(?

-----
參考資料：
- [Designing a URL Shortening service like TinyURL (Preview)](https://www.educative.io/collection/page/5668639101419520/5649050225344512/5668600916475904)
- https://cn.soulmachine.me/2017-04-10-how-to-design-tinyurl/
- https://hufangyun.com/2017/short-url/