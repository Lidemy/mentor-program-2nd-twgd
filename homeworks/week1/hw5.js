function join(arr, concatStr) {
  var output = arr[0];
  for(var i=1; i < arr.length; i++){
  	output += concatStr + arr[i];
  }
  return output;
}

function repeat(str, times) {
  var output = str;
  for(var i=2; i <= times; i++){
  	output += str;
  }
  return output;
}