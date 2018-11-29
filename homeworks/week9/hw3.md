
```
console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)
```

輸出：
```
1
3
5
2
4
```

順序  | call stack          | WebAPIs       | task queue | console  | 說明
-----|---------------------|---------------|------------|----------|--------------
1    | main()              |               |            |          | 全域程式 main() 放入 call stack
2    | log(1) , main()     |               |            |        1 | log(1) 放入 call stack 最上方，執行「輸出 1」。
3    | main()              |               |            |        1 | call stack 最上方的 log(1) 已執行完，所以從 call stack 抽離。
4    | setTimeout , main() |               |            |        1 | setTimeout 放入 call stack。
5    | main()              | Timer(0)cb()  |            |        1 | setTimeout 中的 callback function（ 稱 cb() ）被放到 WebAPIs 中，並開始倒數。setTimeout 執行完，從 call stack 抽離。
6    | log(3) , main()     |               | cb()       |      1 3 | WebAPIs 中的 timer 0 秒倒數時間到，cb() 被放到 task queue 中等待。同時，log(3) 被放入 call stack，執行「輸出 3」。
7    | main()              |               | cb()       |      1 3 | call stack 最上方的 log(3) 已執行完，所以從 call stack 抽離。
8    | setTimeout , main() |               | cb()       |      1 3 | setTimeout 放入 call stack。
9    | main()              | Timer(0)cb()  | cb()       |      1 3 | setTimeout 中的 cb() 被放到 WebAPIs 中，並開始倒數。setTimeout 執行完，從 call stack 抽離。
10   | log(5) , main()     |               | cb() , cb()|    1 3 5 | WebAPIs 中的 timer 0 秒倒數時間到，cb() 被放到 task queue 中等待。同時，log(5) 被放入 call stack，執行「輸出 5」。
11   | main()              |               | cb() , cb()|    1 3 5 | call stack 最上方的 log(5) 已執行完，所以從 call stack 抽離。
12   |                     |               | cb() , cb()|    1 3 5 | 全域程式 main() 已執行完，所以從 call stack 抽離。此時 call stack 已沒有執行項目。
13   | log(2) , cb()       |               | cb()       |  1 3 5 2 | call stack 沒有執行項目的時候，event loop 把 task queue 的第一個項目拉到 call stack 中。執行「輸出 2」。
14   | cb()                |               | cb()       |  1 3 5 2 | call stack 最上方的 log(2) 已執行完，所以從 call stack 抽離。
15   |                     |               | cb()       |  1 3 5 2 | cb() 已執行完，所以從 call stack 抽離。此時 call stack 已沒有執行項目。
16   | log(4) , cb()       |               |            |1 3 5 2 4 | call stack 沒有執行項目的時候，event loop 把 task queue 剩下的項目拉到 call stack 中。執行「輸出 4」。
17   | cb()                |               |            |1 3 5 2 4 | call stack 最上方的 log(4) 已執行完，所以從 call stack 抽離。
18   |                     |               |            |1 3 5 2 4 | cb() 已執行完，所以從 call stack 抽離。結束。
