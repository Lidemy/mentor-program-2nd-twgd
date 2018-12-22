## 為什麼我們需要 React？可以不用嗎？

- 因為產品變得越來越龐大與複雜的時候，需要有方法幫助我們用更簡單的方式來開發與維護。
- 可以不用。React 就只是一個 library。

## React 的思考模式跟以前的思考模式有什麼不一樣？

- 畫面是由一個個 component 組成
  把畫面設想成是由一個個元件組成，元件之下又有更小的元件組成。我認為這樣的思考方式很直覺，像在拼裝積木一樣。
  
- 由「狀態 (state)』來決定「看到的 (View) 」
  不直接去思考如何操作及修改 UI；而是去思考如何修改資料 (state)，並重新 render 畫面。

- Client side rendering：
  除了第一次的 render 到 Server side 拿資料外，後面都用 JavaScript 來產生 HTML。


## state 跟 props 的差別在哪裡？

- props：父元件傳遞給子元件讀取的資料。是父元件與子元件間的溝通橋樑。

- state：紀錄元件自己內部狀態的資料。可以修改，若要修改必須用 setState 這個方法。

簡單來說：「別人傳進來的是 props，自己用的是 state」


## 請列出 React 的 lifecycle 以及其代表的意義

- Mounting：當元件的 instance 建立時，顯示在 DOM 的時候。

    - constructor()：建構初始化物件。
    - getDerivedStateFromProps()：初始 render 時調用。
    - render()：每次 props 或是 state 被改變時調用。
    - componentDidMount()：元件 render 到畫面後調用。

- Updating：當 props 或是 state 改變時，re-render 的時候。

    - getDerivedStateFromProps()：接收到新的 props 和state 時調用。
    - shouldComponentUpdate()：接收到新的 props 和state 之後，在觸發 re-render 之前調用。
    - render()：每次 props 或是 state 被改變時調用。
    - getSnapshotBeforeUpdate()：抓取 render 到執行渲染畫面更新前，所保持的畫面狀態。
    - componentDidUpdate()：在 component 被 update 之後調用。

- Unmounting：元件將要從 DOM 移除的時候。

    - componentWillUnmount()：元件要被移除的時候調用。


圖像化請參考：http://projects.wojtekmaj.pl/react-lifecycle-methods-diagram/


------

### 參考資料

#### React Lifecycle
- https://reactjs.org/docs/react-component.html#the-component-lifecycle
- https://ithelp.ithome.com.tw/articles/10185194
- https://ianchuu.com/2018/07/27/reactlife/index.html





