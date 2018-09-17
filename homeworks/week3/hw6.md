## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。

- `<table></table>`：表示整個表格的區塊。與 `<tr></tr>`、`<th></th>`、`<td></td>` 一起使用。
	  `<tr></tr>`：表示橫欄。
    `<th></th>`：表格資料的標題。
	  `<td></td>`：表格的資料欄位。
- `<em></em>`：強調。
- `<small></small>`：以較小文字顯示。通常用來標示版權宣告。


## 請問什麼是盒模型（box model）

HTML 標記出來的元素，可以視作一個盒子容器。
盒子的 width/height、padding、border、margin 屬性之間的設置，構成盒子模型。

- width/height：內容主要寬高。
- border：是內容的框線。
- padding：是內側間距（框線以內到內容的間距）
- margin：是外側間距（框線以外到其他元素的距離）

其中，眼睛可見 (可套用顏色、背景) 的範圍包括：width/height、padding、border，因此計算可見寬高的時候，內容的 width/height 必須再加上 padding、border 的值。


## 請問 display: inline, block 跟 inline-block 的差別是什麼？

- inline

  - 元素若沒強制換行，會「水平排列」顯示下去。
  - 沒有寬高概念。(無法設定 width/height 尺寸)
  - 無法設定上下間距。

- block

  - 元素會由上而下自動換行「垂直排列」。
  - 有寬高概念。(可以設定 width/height 尺寸)
  - 可以設定上下左右 padding、margin。

- inline-block

  - 與 inline 一樣，元素水平排列不自動換行。但以 block 方式顯示，可以設定 width/height 及上下左右的 padding、margin。


## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

- static（一般）：預設值
  - 「不會被特別定位」在頁面上特定位置。

- relative（相對）

  - 以「原本顯示的位置」為基準，指定配置位置。若沒有設定偏移，則效果跟 static 一樣。
  - 與 absolute 不同的是：relative 區塊原本的空間仍會保留。不會影響到原本其他元素所在的位置。

- absolute（絕對）

  - 以指定的「基準元素」為基準，指定配置位置。若沒有指定，則以 body 為基準。
    (指定的「基準元素」會往上層找有指定位置的父元素或祖先元素)
  - 與 relative 不同的是：absolute 原本顯示的區塊，會自動由後續的元素遞補進去。

- fixed（固定）

  - fixed 是永遠以 body（瀏覽器視窗）為基準，「拉動捲軸不會跟著移動」。






