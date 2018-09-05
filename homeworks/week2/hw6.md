## hw1：好多星星

### 第一版：

這是我看到題目第一個想到的解法：

1. 先想到用 `for loop` 來跑。
2. 產生一個 `array`
3. `for loop` 裡要處理：`'*'` 數量依 `n` 遞增，再塞入 `array` 中。

``` javascript
function stars(n) {
  var arr = [];
  var star = '';
  for(var i = 1; i <= n; i++){
  	star += '*'; // '*' 遞增
  	arr.push(star); // 塞入 `array` 中
  }
  return arr;
}
```


### 第二版：

因為看過 huli 第一期作業的講解，知道有另一種解法，這次交作業來嘗試寫寫看：

1. 用 `Array(n)` 直接產生長度為 `n` 的 array
2. 用 `.map()` 呼叫 `function` 讓 `'*'` 正確產生。
3. `Array(n)` 是產生沒有 values 的 array，`.map()` 不能處理沒有 values 的 array，所以要加上 `.fill()`。


``` javascript
function stars(n) {
  return Array(n).fill().map(
    function(value, index){
      return '*'.repeat(index+1)
    }
  )
}
```

這個解法用了不少 array method，但有些 method 我還沒有很熟練，一開始很容易在句法上出錯。

尤其是 `.map()` 句法的預設參數是 `function(value, index, array)`，剛開始寫的時候天真以為我高興放什麼順序都可以，把 `value` 跟 `index` 參數位置放反了，一直輸出錯的東西。


## hw2：大小寫互換

先想解法：

1. 宣告一個全轉大寫的 string，一個全轉小寫的 string
2. 用 `for loop` 一個一個字比對，輸出相反的大小寫

``` javascript
function alphaSwap(str) {
  var upstr = str.toUpperCase();
  var lowstr = str.toLowerCase();
  var output = '';
  for(var i = 0; i < str.length; i++) {
    if(upstr[i] === str[i]) {
      output += lowstr[i];
    } else {
      output += upstr[i];
    }
  }
  return output;
}
```

目前最熟悉的還是使用迴圈來解問題，只是解法看起來超級土法煉鋼XD

- 可以改進的地方：這題 Codewars 上面也有，看了別人的解法，發現可以轉成 array 用 `.map()` 來處理。另外，`if...else` 判斷式也可以改用 ternary 來表示，更為簡潔。


## hw3：判斷質數

- 先想解法：

1. 用 `for loop` 檢查有沒有可以整除 `n` 的數
2. 要記得排除 1 

``` javascript
function isPrime(n) {
  for(var i = 2; i < n; i++){
  	if(n % i === 0){
  	  return false;
  	}
  }	
  return n !== 1; // 其他不等於 1 的數就是質數。因為 1 不是質數。
}
```

`for loop` 跟 `%` 目前已經可以很熟悉地運用了。

另外，熟悉 Booleans 概念後，就學會直接使用如 `return n !== 1` 這種寫法。不然以前只會用 `if` 判斷式，有點多此一舉。


## hw4：判斷迴文

- 先想解法：

反轉 string，再判斷反轉前後是否一樣。

``` javascript
function isPalindromes(str) {
  var s = str.split('').reverse().join('');
  return s === str;
}
```

後來發現可以不用另外宣告一個新的變數，來接反轉出來的 string，可以用以下的寫法就好：

``` javascript
function isPalindromes(str) {
  return str === str.split('').reverse().join('');
}
```

這題在 Codewars 及 第一週作業都練習過反轉 string，算是熟悉了。

現在漸漸學習越來越多的內建函式，有 array 跟 string 都可以用的，也有只能用在 array 或 string 上的，其實有時候會一時混肴，但目前也只能靠多練習題目來熟悉而已，也許以後常用就不會混淆了XD


## hw5：大數加法

這題解法雖然提示要用小學生「直式加法」來做，但還是嘔心瀝血了好久才完成。
因為電腦跟人不一樣，必須要很明確的下指令讓電腦判斷：什麼條件要繼續計算？怎麼進位？等等。
讓我卡關最久的就是：如何把「條件的判斷」用程式碼表達出來。

### 第一版：用 `for loop`

- 解題思路：

1. 馬上想到用 `for loop` 來跑直式加法
2. 接下來思考怎麼加總出數字：用 `parseInt()` 把 string 轉成 number
3. 思考怎麼取個位數字：用 `(num % 10)`
4. 怎麼取進位數字：用 `Math.floor(num / 10)`

- 後來遇到了問題：

  - a 跟 b 的位數不一樣的時候，`for loop` 的條件要怎麼分別定義 a[index] 跟 b[index]？
  - 最後一位有進位的時候，怎麼讓迴圈繼續跑？

(這時候先放棄這個解法)


### 第二版：用 `while loop` 來判斷

因為 `for loop` 遇到了問題，想到了可以用 `while loop` 寫寫看：

1. 用 `.pop()` 直接取出最後一位，可以不用管 a[index] 跟 b[index]。
2. `while loop` 的條件只要下：還有數字的時候就繼續跑。

- 又遇到問題：

  - 怎麼用程式碼來表示：還有數字的時候就繼續跑？
  - 位數不一樣的時候，要怎麼補 0 進去？

- 想到解決關鍵：用 `||`
  
  這種看似很基本的邏輯條件判斷，我覺得若沒透過解題目來感受，其實沒那麼容易善用。


``` javascript
function add(a, b) {
  var arrA = a.split('');
  var arrB = b.split('');
  var ans = '';
  var c = 0;
  while(arrA.length || arrB.length || c ) {
  	var num = c + parseInt(arrA.pop() || 0, 10) + parseInt(arrB.pop() || 0, 10);
  	ans = (num % 10) + ans;
  	c = Math.floor(num / 10);
  }
  return ans;
}
```

最後，在寫心得的時候，突然靈光一閃，想到 `for loop` 解法：
在 `for loop` 的條件設兩個變數就好了XD

``` javascript
function add(a, b) {
  var ans = '';
  var c = 0;
  for(var i = a.length-1, j = b.length-1; i >= 0 || j >= 0 || c; i--, j--) {
    var num = c + parseInt(a[i] || 0, 10) + parseInt(b[j] || 0, 10)
    ans = (num % 10) + ans;
    c = Math.floor(num / 10);
  }
  return ans;
}
```
