## 1. 什麼是 DOM？

### Document Object Model ( 文件物件模型 )

是文件 (HTML、XML) 的「結構化」表示形式 ( 通常稱之為 DOM tree)，其中每個 HTML 元素都表示為一個節點 (Node)。做為網頁與程式語言的溝通介面。透過操作 DOM property 及 DOM method 可以存取或改變文件的架構、內容、屬性、樣式等等。 

DOM property 例如：
`innerHTML`：元素內的HTML

DOM method 例如：
`appendChild(node)`：插入新的子元素


## 2. 什麼是 Ajax？

### Asynchronous JavaScript and XML ( 非同步的 JavaScript 與 XML )

是一種網頁無需刷新頁面，與伺服器進行資料交換的技術。
透過 Ajax 技術，向伺服器發送 request 時候，不必等待 response 回傳，可以同時繼續執行後續的程式碼。等到有了 response 回來，再來處理這個程序。

舉例來說：
如果沒用 Ajax 技術的網頁，通常點擊一個按鈕就要刷新一次頁面，如果只要更新網頁的一部份，還是要等待頁面刷新。
用了 Ajax 技術的網頁，點擊按鈕，只會有要更新的部分有變化，「頁面本身不用刷新」。

- 如何使用 Ajax 技術發送 Request？ 透過 `XMLHttpRequest` 物件，向伺服器發送 request。



## 3. HTTP method 有哪幾個？有什麼不一樣？

- `GET`：取得資料。

- `POST`：新增一項資料。如果存在會新增一個新的。

- `PUT`：利用「更新」的方式，新增一項資料。
  - 與 `POST` 不同之處：像是「replace 」的概念，假如已經存在就替換，如果沒有就新增。

- `PATCH`：增加或「部分更新」一筆新的資料。
  - 與 `POST` 不同之處：附加新的資料在「已經存在的資料」。類似「擴充」或是「點餐加點」的概念。

- `DELETE`：刪除指定資料。

- `OPTIONS`：描述指定資源的 methods。也就是傳回允許的 methods。「只會取得 HTTP header的資料」。

- `HEAD`：與 GET 相同，但沒有 response body。「只會取得 HTTP header的資料」。


## 4. GET 跟 POST 有哪些區別，可以試著舉幾個例子嗎？

### GET

- 帶參數的位置：參數帶在 URL 上作為 QueryString 的一部分。
常見的例子就是到搜尋網站：`http://tw.search.yahoo.com/` 搜尋之後網址列變成：`http://tw.search.yahoo.com/search?p=hello+world&fr=yfp&ei=utf-8&v=0`
- 安全性較低：不適合放敏感資訊 (如：密碼 )，因為參數會顯示在網址列上。如：`https://www.aaa.com/?user=aaa&password=bbb`
- 資料傳遞量：因為是透過 URL 帶資料，會受限於 QueryString 長度限制。

### POST

- 帶參數的位置：POST 把資料帶在 request body 裡面。
- 安全性較高：適合拿來放敏感資訊 (如：密碼)，回傳網址不會改變。例如：`https://www.aaa.com/` 回傳後一樣是 `https://www.aaa.com/`
- 資料傳遞量：資料長度沒有限制，允許大量傳輸。


## 5. 什麼是 RESTful API？

REST 全名 Resource Representational State Transfer (具象狀態傳輸)，是一種網路設計架構風格。而實踐 REST 風格被實作出來的 API，就稱為 RESTful API。借用 HTTP 協定做為基礎，讓 API 規格簡單一致。

RESTful API 簡而言之的特色：
- 使用 URI 來定位資源
- 用 HTTP 動詞（ GET、POST、PUT 和 DELETE ）來描述對資源的操作。

這樣做的好處就是資源和操作分離，只需要一個接口再搭配相對應的 HTTP method 就可以完成，且 API 的可讀性很高，更好對資源管理，也讓串接 API 的人可以快速地了解 API ，省去不必要的溝通。

RESTful API 舉例來說：
`GET http://www.store.com/products` 取得所有產品列表。
( HTTP method 表示相對應的操作動詞、可讀性高的 URI、資源名稱多用複數名詞)
 

## 6. JSON 是什麼？

### JavaScript Object Notation 

是一種資料格式。以易於閱讀的純文字為基礎，用來傳輸資料物件。

具體格式：`{name:value}`
`name` 型態是一個 string；
`value` 型態可以是一個 string、number、object、boolean、array 或是 null 值。

範例：

```
{
      "firstName": "John",
      "lastName": "Smith",
      "sex": "male",
      "age": 25,
      "address": 
      {
          "streetAddress": "21 2nd Street",
          "city": "New York",
          "state": "NY",
          "postalCode": "10021"
      },
      "phoneNumber": 
      [
          {
            "type": "home",
            "number": "212 555-1234"
          },
          {
            "type": "fax",
            "number": "646 555-4567"
          }
      ]
  }
```

典型的應用是做為 Ajax 的資料交換格式。(Ajax 原本資料交換是透過 XML，後來因為 JSON 的輕便性，逐漸受到重視，成為 Ajax 最主要的資料交換格式。)


## 7. JSONP 是什麼？

### JSONP (JSON with Padding)

是 JSON 的一種「使用方式」，可以讓網頁從別的網域要到資料。

原理是利用 script 標籤可以跨網域的特性，script 是其中一個不受跨網域限制的 HTML 標籤。

利用 script 標籤引入資料，實務上會搭配 Callback Function，範例：

```
 <script src="http://server2.example.com/RetrieveUser?UserId=1823&jsonp=parseResponse">
 </script>
<script>
	function parseResponse(response) {
		console.log(response);
	}
</script>

```


## 8. 要如何存取跨網域的 API？

有兩種方式：

- JSONP：如上述。
缺點：只能使用 GET method，參數必須帶在網址上。

- CORS 跨來源資源共享 (cross-origin resource sharing)：

是一份瀏覽器技術的規範，透過添加額外的 HTTP header 使網站取得存取其他網域伺服器特定資源的權限。

當請求不同網域的資源時，會建立一個跨來源 HTTP 請求（cross-origin HTTP request）。所以想跨網域存取的話，Server 必須在 Response 的 Header 裡面加上`Access-Control-Allow-Origin`。當瀏覽器收到 Response 後，若檢查到裡面有包含發起 Request 的 Origin 的話，就會允許通過，讓程式順利接收到 Response。

舉例：`Access-Control-Allow-Origin: *`  `*` 代表接受任何一個 Origin。

此外，與 JSONP 不同，CORS 除了 GET 以外也支援其他的 HTTP 請求。

### 以上兩種跨網域存取方式，都要確保 Server 端有加上 `Access-Control-Allow-Origin` 才可以確保存取。








