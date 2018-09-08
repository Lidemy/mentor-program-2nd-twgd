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

module.exports = alphaSwap