# 「循序漸進理解 HTTP Cache 機制」文章重點整理

- 主旨：談 Server 跟瀏覽器之間的 Cache 機制。
- cache 的功用：節省資源損耗 ( 節省流量與載入時間 )
- 與 cache 有關的 Header：
  - Expires
  - Cache-Control 
    - max-age
    - no-store
    - no-cache
  - Last-Modified 與 If-Modified-Since
  - Etage 與 if-None-Match
- 首頁的快取策略


## 與 cache 有關的 Header

### 與「cache 期限」有關的 Header
目的：判斷 cache 有無過期。若沒有過期，瀏覽器「不發送 Request」。

- `Expires`
  - 作用：設定快取的到期時間。( 設定：一個時間點 )
  - 用法：`Expires: Wed, 21 Oct 2017 07:28:00 GMT`
  - 缺點：瀏覽器依「電腦時間」來判斷，若用戶調整電腦時間，`Expires` 就不能正常發揮作用了。

- `Cache-Control：max-age`
  - 作用：設定快取的期限。( 設定：經過多久時間 )
  - 用法：`Cache-Control: max-age=31536000` (max-age 單位是秒數)

> 若 `Expires` 跟 `max-age` 同時出現，`max-age` 會覆蓋過 `Expires`

### 與「cache 可用性」有關的 Header
目的：快取到期，不見得不能繼續使用。只要與 server 溝通確認資料有無更新，就可以判斷要繼續沿用快取，或重新抓取資料。

- `Last-Modified` 與 `If-Modified-Since`
  - 作用：判斷檔案是否有更新 ( 依：檔案「修改時間」)
  - 作用機制：Server 回傳 Response 時會帶上 `Last-Modified`，表示檔案上次更新時間；快取過期時，瀏覽器會發送 Request 帶上 `If-Modified-Since` 詢問某個時間點之後是否有更新。有更新的話，就抓取新的資料；若沒有更新的話，就回傳 Status code 304，繼續沿用目前的快取檔案。
  例如：
  ```
    // Response
    Last-Modified: ( 時間 )
    Cache-Control: max-age=31536000

    // Request
    GET /file
    If-Modified-Since: ( 時間 )
  ```
  - 缺點：若檔案內容沒有變更，重新存檔還是會更新修改時間，因此依檔案「修改時間」來判斷可能不太完備。所以若可以依「內容有無更動」來判斷，會是個更好的方法。

- Etage 與 if-None-Match
  - 作用：判斷檔案是否有更新。 ( 依：檔案「內容有無更動」)
  - 作用機制：Server 回傳 Response 時會帶上 `Etag`；快取過期時，瀏覽器會發送 Request 帶上 `If-None-Match` 詢問資料是否有變動。
  如果 `If-None-Match` 的值不符合現在這個 `Etag` 就代表有更新，要回傳新的資料；沒有的話，就回傳 Status code 304。
  例如：
  ```
    // Response
    Cache-Control: max-age=31536000
    Etag: x123fdd

    // Request
    GET /file
    If-None-Match:x123fdd
  ```

### 與「如何使用 cache」有關的 Header

- `Cache-Control：no-store`
  - 作用：完全不使用快取。每次都會向 server 請求資料，「不會有資訊被快取住」。
  - 通常用在：含有機密資料的頁面。

- `Cache-Control：no-cache`
  - 作用：永遠檢查快取。每次都會發送 Request 檢查是否有更新。(用法等同於：`Pragma: no-cache`)
  - 通常用在：首頁。


## 首頁的快取策略

- 目的：首頁不常變動，但希望只要一變動，使用者可以馬上看到變化。但不使用快取的話，每次都要抓取資源會非常損耗流量。因此，可以快取頁面，但只要頁面有更新，就立刻抓取新的頁面。
- 做法：
  1. 不管檔案更不更新，瀏覽器都會發 Request：
    - `Cache-Control: max-age=0` 搭配 `Etag`
      原理：設定快取為 0 秒過期，也就是馬上過期，瀏覽器每次都會詢問 server 檔案有沒有更新。

    - `Cache-Control: no-cache`
      原理同上。

  2. 只要檔案不更新，瀏覽器就不會發 Request：
    針對不同檔案採取不同的快取策略。把 `Etag` 的機制實作在首頁裡面。
    例如：
    首頁 render 畫面完全交給引入的 script.js 檔案。
    若 javascript 檔案更新的話，不從 script.js 檔案更新，而是在 index.html 裡更新引入的連結為 script_update.js 檔案。
    - index.html
    快取策略設為：`Cache-Control: no-cache`    
    - script.js
    快取策略設為：`Cache-Control: max-age=31536000`

    如此就可以做到，javascript 檔案若沒有更新就不會發 Request；更新了，瀏覽器才會發 Request 載入。
    

-------
其他參考資料：
- https://blog.techbridge.cc/2017/06/17/cache-introduction/
- https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/http-caching?hl=zh-tw