function Stack() {
    let items = [];
    this.push = element => {
        items[items.length] = element;
    }
    this.pop = () => {
        let item = items.splice(items.length-1, 1)
        return item.toString();
    }
    // 判斷是否還有元素
    this.isEmpty = () => {
        return items.length === 0;
    }
    // 清空
    this.clear = () => {
        items = [];
    }
    // 判斷堆疊內的元素數量
    this.size = () => {
        return items.length;
    }
}

function Queue() {
    let items = [];
    this.push = element => {
        items[items.length] = element;
    }
    this.pop = () => {
        let item = items.splice(0, 1);
        return item.toString();
    }
    this.isEmpty = () => {
        return items.length === 0;
    }
    this.clear = () => {
        items = [];
    }
    this.size = () => {
        return items.length;
    }
}


var stack = new Stack()
stack.push(10)
stack.push(5)
console.log(stack.pop()) // 5
console.log(stack.pop()) // 10

var queue = new Queue()
queue.push(1)
queue.push(2)
console.log(queue.pop()) // 1
console.log(queue.pop()) // 2