## CSS 預處理器是什麼？我們可以不用它嗎？

### CSS 預處理器是什麼？
定義了一套新的語法，讓撰寫 CSS 樣式的過程增加了一些程式的特性（例如：變數、類似函式的概念等等）。
可以讓 CSS 撰寫更簡潔，用預處理器的語法編寫完樣式後，只要再編譯成 CSS 文件即可。

優點：提高開發速度，可讀性更好，更易維護。

### 我們可以不用它嗎？
可以。
用原生 CSS 還是可以做出想要的網頁，只是當網頁複雜度越來越高的時候，原生的 CSS 會變得很難維護。


## 請舉出任何一個跟 HTTP Cache 有關的 Header 並說明其作用。
- Etage 與 if-None-Match
  作用：檢查快取檔案「內容有無更動」。
  作用機制：Server 回傳 Response 時會帶上 `Etag`；快取過期時，瀏覽器會發送 Request 帶上 `If-None-Match` 詢問資料是否有變動。
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

## Stack 跟 Queue 的差別是什麼？

運作規則：
- Stack：後進先出 (LIFO, Last In First Out)
- Queue：先進先出 (FIFO, First-In-First-Out)


## 請去查詢資料並解釋 CSS Selector 的權重是如何計算的（不要複製貼上，請自己思考過一遍再自己寫出來）

CSS Selector 權重高的優先生效，權重可以看做 `0-0-0-0` 這樣四個位數來計算。越左邊的層級，權重越高；數字越大，權重越高。


### 基本權重：

- * (全站預設值)：`0-0-0-0`
- Element：`0-0-0-1`
- Class、psuedo-class、attribute：`0-0-1-0`
- ID：`0-1-0-0`
- inline style attribute ( 寫在 HTML 行內的 CSS )：`1-0-0-0` 

- !important：`1-0-0-0-0` (蓋過以上所有權重)

整理：!important > inline style > ID > Class、psuedo-class、attribute > Element > * (全站預設值)


### 權重計算舉例
- ul li：
  element * 2 =  `0-0-0-2`

- form input[type=email]：
  element * 2、attribute * 1 = `0-0-1-2`

- input[type=email]:not(.class)：
  element * 1、class * 1、attribute * 1 = `0-0-2-1`
  ( :not() 的權重是 0 )


### 相同權重的狀況：
- 後寫的覆蓋先寫的


-----
### 參考資料
- https://ithelp.ithome.com.tw/articles/10196454
- http://muki.tw/tech/css-specificity-document/