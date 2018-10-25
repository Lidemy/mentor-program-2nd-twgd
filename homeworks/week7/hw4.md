## Bootstrap 是什麼？

Bootstrap 是一個開源的網頁前端 library。針對大部分網頁常用的元件去進行一套基本的介面設計，網頁開發者可以快速地套用，讓前端開發更快速容易。

Bootstrap 提供 RWD 網格系統、預先建構好的元件、基於 jQuery 開發的 plugins 等等，Bootstrap 也預先處理好一些跨瀏覽器可能會產生的問題。


## 請簡介網格系統以及與 RWD 的關係

### 網格系統

網格系統的原理就是把網頁寬度切割成數等分 ( 例如：12 等分 ) 為單位，然後設定各種元件要佔幾個「單位」寬，藉此取代用 `pixel` 來設定寬度。

簡單來說，就是預先設計出 如： col-1 ~ col-12 等 12 種寬度的 css class，透過設定這些 class 的組合來決定網頁版面的佈局。

### 與 RWD 的關係

網格系統輔助開發者更易於實作 RWD。

網格系統是基於相對比例的概念來設計佈局，更好因應頁面寬度調整時的設定與問題。
只要設定不同 column 在不同頁面寬度下的比例，就可達成在不同頁面寬度所想呈現的佈局，而不會跑版。


## 請找出任何一個與 Bootstrap 類似的 library

- [Foundation](https://foundation.zurb.com)

其他還有：
- [Materialize](https://materializecss.com)
- [Semantic UI](https://semantic-ui.com)


## jQuery 是什麼？

jQuery 是一個 Javascript 的 library。

透過 jQuery 可以用更簡潔的語法來：操作 DOM、處理事件、使用 AJAX、建立動畫效果等等，藉此增進開發者的開發速度。

例如選取 Elements 的語法：

原生語法：
`document.querySelectorAll('.class');`

jQuery 語法：
`$('.my #awesome selector');`


## jQuery 與 vanilla JS 的關係是什麼？

vanilla JS 就是原生的 JavaScript。
jQuery 是基於 Javascript 所寫的 library，所以 jQuery 的底層運作本質上就是 vanilla JS。


-----
### 參考資料來源：

#### Bootstrap 部分

- https://ithelp.ithome.com.tw/articles/10120582

#### jQuery 部分

- https://medium.com/程式人月刊/原生的-javascript-用法-vanilla-js-e53d3cdb5e8
- https://www.ithome.com.tw/voice/106182
- http://vanilla-js.com ( 這個偽官網大開嘲諷 XD )





