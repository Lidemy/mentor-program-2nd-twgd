var isPrime = require('./hw3')

describe("hw3", function() {
  it("should return correct answer when n = 1", function() {
    expect(isPrime(1)).toBe(false)
  })

  it("should return correct answer when n = 2", function() {
    expect(isPrime(2)).toBe(true)
  })

  it("should return correct answer when n = 3", function() {
    expect(isPrime(3)).toBe(true)
  })

  it("should return correct answer when n = 10", function() {
    expect(isPrime(10)).toBe(false)
  })

  it("should return correct answer when n = 37", function() {
    expect(isPrime(37)).toBe(true)
  })

  it("should return correct answer when n = 38", function() {
    expect(isPrime(38)).toBe(false)
  })
})