function stars(n) {
  return Array(n).fill().map(
    function(value, index) {
      return '*'.repeat(index+1)
    }
  )
}

module.exports = stars;