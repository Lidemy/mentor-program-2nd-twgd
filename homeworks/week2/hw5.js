/*
// while loop
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

module.exports = add;
*/


// for loop
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
module.exports = add;

