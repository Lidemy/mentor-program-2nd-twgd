## React Router 背後的原理你猜是怎麼實作的？

參考了網路上的資源，以目前可以理解的部分來推測。
另外，`<BrowserRouter>` 跟 `<HashRouter>` 底層是兩種不同的實作概念。

### <BrowserRouter>：使用 HTML5 的 History API。
( history 這個 API 我還不太熟 )

1. 使用 `pushState()` 或 `replaceState()`，來達到改變網址但不刷新頁面。
    `pushState()` 是多增加一筆歷史紀錄；`replaceState()` 是替換目前這一筆歷史紀錄。
    但這兩個方法都不會觸發 `popstate` 事件。 

2. 監聽 popstate 事件
    ```
    window.addEventListener('popstate', cb )
    ```
    要頁面前進或後退，才會觸發 popstate 事件。
3. 觸發事件，透過 callback function 來 setState
4. render 相對應的畫面


### <HashRouter>：使用 hash。

( 如同老師在 week13 週一的直播教學 )
1. 改變 Hash，來達到改變網址但不刷新頁面：
    ```
    window.location.hash = 'hash'
    ```
2. 監聽 hashchange 事件
    ```
    window.addEventListener('hashchange', cb )
    ```
3. 觸發事件，透過 callback function 來 setState
4. render 相對應的畫面


## SDK 與 API 的差別是什麼？

SDK 是一套開發工具箱；API 是一個連接應用程式的接口。


- SDK ( Software Development Kit, 軟體開發套件 )
  - 幫一個產品或平台開發應用程式的工具包。通常有針對各系統或平台的 SDK，例如：Facebook Android SDK、Facebook SDK v5 for PHP。
  - 包含各式各樣開發工具，通常也包含 APIs。
  例如：
  『Facebook JavaScript SDK：一整套豐富的用戶端功能，用來新增社交外掛程式、「Facebook 登入」和 Graph API 呼叫。』
  https://developers.facebook.com/docs/javascript


- API ( Application Programming Interface, 應用程式介面 )
  - 提供給應用程式使用的一組程式。是一種介面、接口。開發者無須考慮底層細節。
  - 經常會是 SDK 的一部分。
  例如：
  『Facebook 提供的圖形 API：是應用程式讀取與寫入 Facebook 社交關係圖的主要方法。』
  https://developers.facebook.com/docs/graph-api/
  

## 在用 Ajax 的時候，預設是不會把 Cookie 帶上的，要怎麼樣才能把 Cookie 一起帶上？

透過設置 `withCredentials` 屬性，設為：`true`。

P.S.
- ajax 預設會帶同源的 cookie，不會帶不同源的。
- 同源下，使用 `withCredentials` 這個屬性會被忽略。


用法：[MDN-withCredentials](https://developer.mozilla.org/zh-CN/docs/Web/API/XMLHttpRequest/withCredentials)
```
var xhr = new XMLHttpRequest();
xhr.open('GET', 'http://example.com/', true);
xhr.withCredentials = true;
xhr.send(null);
```


------

### 參考資料整理：

- [從路由原理出發，深入閱讀理解react-router 4.0的原始碼](https://www.itread01.com/content/1544419810.html)
- [API ? SDK? 傻傻分清楚](https://blog.jyny.tw/2013/01/api-sdk.html)
- [【误】Ajax不会自动带上cookie/利用withCreadentials带上cookie](https://zhuanlan.zhihu.com/p/28818954)