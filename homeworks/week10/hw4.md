## gulp 跟 webpack 有什麼不一樣？我們可以不用它們嗎？

雖然 Gulp 跟 Webpack 都可以 compile CSS、轉換 JavaScript，但是兩者是不一樣的東西。

- Gulp 是一個自動化建置工具。
  可以不用。只不過專案變大之後，工作會變得很繁瑣。

- Webpack 是一個包裝模組化 JavaScript 的工具。用於採用「模組化開發」的專案。
  如果不用 Webpack，就無法使用像 `import` `export` 這樣的模組化匯入及匯出程式。


## hw3 把 todo list 這樣改寫，可能會有什麼問題？

- 效能變差：因為就算只有更新一筆資料還是要重新 render 全部畫面，資料量很大時，效能會有明顯影響。


## CSS Sprites 與 Data URI 的優缺點是什麼？

### CSS Sprites

- 優點
  - 減少 server 端的圖檔數量，減少發送的 HTTP requests，因而減少 server 的負載。
  - 同上原因，減少瀏覽器載入網頁的時間。
  - 因為 sprites 只需載入一次，圖片顯示更快速。

- 缺點
  - 開發時間更費時：要花更多時間在合併、切分圖片，及設定背景的位置。
  - 維護時間也很費時：如果遇到需要修改的情況，需要再重新產生一次 sprite。
  - 不適合做 SEO：相較於 CSS background，有些圖片比較適合放在 HTML 裡面，例如，<img> 可以設定 `Alt` 屬性文字描述，對 SEO 更有幫助。

### Data URI

- 優點
  - 直接寫進 HTML 或 CSS，避免發送過多的 HTTP requests 數量，可以增進網頁效能。
  - 加速瀏覽器載入網頁的速度。

- 缺點
  - 瀏覽器無法個別對圖片快取：因為是直接寫在網頁中，如果網頁每次有變更就會每次都重新抓取圖片資料。
  - 可讀性差：不像載入圖片可以直接透過檔名辨識內容。
  - 維護較麻煩：當檔案有變化時，每個內嵌 Data URI 的網頁都要重新產生編碼。
  - Data URI 採用的 Base64 編碼會讓檔案比原圖檔大。


------
### 參考資料：


- https://medium.com/@hulitw/introduction-mvc-spa-and-ssr-545c941669e9

#### CSS Sprites 部分：
- https://getlevelten.com/blog/ahmad-kharbat/css-image-sprites-pros-and-cons

#### Data URI 部分：
- https://medium.com/cubemail88/data-uri-前端優化-d83f833e376d
- https://webmasters.stackexchange.com/questions/56701/image-data-uri-and-seo
- https://blog.gtwang.org/web-development/minimizing-http-request-using-data-uri/
- https://blog.darkthread.net/blog/data-uri