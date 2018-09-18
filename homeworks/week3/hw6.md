## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。

- `<table></table>`：表示整個表格的區塊。與 `<tr></tr>`、`<th></th>`、`<td></td>` 一起使用。
	  `<tr></tr>`(table row)：表示橫列。
    `<th></th>`(table header)：表格資料的標題。
	  `<td></td>`(table data/cell)：表格的資料欄位。
  
  舉例：一個三列兩欄的表格
  ```
  <table>
    <tr>
      <th>姓氏</th>
      <th>名稱</th> 
    </tr>
    <tr>
      <td>新垣</td>
      <td>結衣</td> 
    </tr>
    <tr>
      <td>石原</td>
      <td>さとみ</td> 
    </tr>
  </table>
  ```


- `<em></em>`：強調。
  
  舉例：```<em>我是強調科科</em>```
  (有些瀏覽器預設會有斜體效果，但不是用來做為斜體的功能。若要效果變化要用 CSS)

- `<small></small>`：以較小文字顯示。通常用來標示版權宣告。
  
  舉例：```<small>© Company 2017-2018</small>```
  (有些瀏覽器預設會有字體變小效果，但不是用來做為字體變小的功能。若要效果變化要用 CSS)


## 請問什麼是盒模型（box model）

HTML 標記出來的元素，可以視作一個盒子容器。
盒子的 `width`/`height`、`padding`、`border`、`margin` 屬性之間的設置，構成盒子模型。

- `width`/`height`：內容主體寬高。
- `border`：內容的框線。
- `padding`：內側間距（ 框線以內到內容的間距 ）
- `margin`：外側間距（ 框線以外到其他元素的距離 ）

其中，眼睛可見 ( 可套用顏色、背景 ) 的範圍包括：`width`/`height`、`padding`、`border`，因此計算可見寬高的時候，內容主體的 `width`/`height` + `padding` + `border` 的值，才是整塊可見範圍的尺寸。

以參考圖舉例：若要計算可見 ( 可套用顏色、背景 ) 寬度，會是：`200 + 10*2 + 5*2`。

參考圖：
![box model範例](https://i1.read01.com/SIG=1drs1o4/30415a6c6e433030.jpg)


## 請問 display: inline, block 跟 inline-block 的差別是什麼？

- `inline`

  - 元素若沒強制換行，會「水平排列」顯示下去。
  - 沒有寬高概念 ( 無法設定 `width`/`height` 尺寸 )。無法設定上下間距。

- `block`

  - 元素會由上而下換行「垂直排列」。
  - 有寬高概念 ( 可以設定 `width`/`height` 尺寸 )。可以設定上下左右 `padding`、`margin`。

- `inline-block`

  - 與 `inline` 一樣，元素水平排列不自動換行。但可以像 `block` 一樣設定 `width`/`height` 及上下左右的 `padding`、`margin`。


## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

- `static`（一般）：預設值
  - 依 html 原始碼順序預設排列，「不會被特別定位」在頁面上特定位置。

- `relative`（相對）

  - 以「原本自己的位置」為基準，設定偏移屬性 (`left` `top` `right` `bottom`)。若沒有設定偏移屬性，則效果跟 `static` 一樣。
  - 與 `absolute` 不同的是：`relative` 區塊原本的空間仍會保留。不會影響到原本其他元素所在的位置。

- `absolute`（絕對）

  - 以「指定的元素」為基準，設定偏移屬性 (`left` `top` `right` `bottom`)。
    如何找「指定的元素」：會往上層找第一個「有被指定位置（`static` 以外）」的父元素或祖先元素為基準。
  - 若找不到「指定的元素」，則以 `body` 為基準。「拉動捲軸會跟著頁面移動」。
  - 與 `relative` 不同的是：`absolute` 原本顯示的區塊，會自動由後續的元素遞補進去。

- fixed（固定）

  - `fixed` 是永遠以「瀏覽器視窗」為基準，設定偏移屬性 (`left` `top` `right` `bottom`)。
  - 與 `absolute` 不同的是：「拉動捲軸不會跟著頁面移動」。

