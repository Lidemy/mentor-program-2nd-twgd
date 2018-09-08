var add = require('./hw5')

describe("hw5", function() {
  it("should return correct answer when a=111111111111111111111111111111111111 and b=111111111111111111111111111111111111", function() {
    expect(add('111111111111111111111111111111111111', '111111111111111111111111111111111111')).toBe('222222222222222222222222222222222222')
  })

  it("should return correct answer when a=10 and b=10", function() {
    expect(add('10', '10')).toBe('20')
  })

  it("should return correct answer when a=789 and b=456", function() {
    expect(add('789', '456')).toBe('1245')
  })

  it("should return correct answer when a=12312383813881381381 and b=129018313819319831", function() {
    expect(add('12312383813881381381', '129018313819319831')).toBe('12441402127700701212')
  })
})
