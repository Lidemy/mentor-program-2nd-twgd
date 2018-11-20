// 原本應該放在專案根目錄，交作業時放在 hw2 資料夾

const path = require('path');

module.exports = {
    entry: './homeworks/week10/hw2/index.js',
    output: {
        path: path.resolve(__dirname, './homeworks/week10/hw2/dist'),
        filename: 'bundle.js'
    }
}