function printFactor(n) {
  var output = 1;
  for(var i=2; i<=n ; i++){
  	if(n%i === 0){
  	  output += '\n' + i;
  	}
  }
  return output;
}