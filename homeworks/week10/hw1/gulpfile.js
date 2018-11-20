// 引用 gulp
const gulp = require('gulp');

// 引用 plugin
const sass = require('gulp-sass');
const babel = require('gulp-babel');
const minifyCSS = require('gulp-minify-css');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const rename = require('gulp-rename');

/* gulp 4.0 官方建議寫法 */

// 1. 把 scss 編譯成 css
function scssToCss(){
    return gulp.src('./src/sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./dist/css'));
};

// 2. 把 js 用 babel 轉成 ES5 語法
function jsToEs5(){
    return gulp.src('./src/js/*.js')
    .pipe(babel())
    .pipe(gulp.dest('./dist/js'));
};

// 3. 把 css 以及 js 壓縮 ( 包含合併與重新命名 )
function cssToMincss(){
    return gulp.src('./dist/css/*.css')
    .pipe(concat('all.css'))
    .pipe(minifyCSS())
    .pipe(rename(function(path){
        path.basename += '.min';
        path.extname = '.css';
    }))
    .pipe(gulp.dest('./dist/css'));
};

function jsToMinjs(){
    return gulp.src('./dist/js/*.js')
    .pipe(concat('all.js'))
    .pipe(uglify())
    .pipe(rename(function(path){
        path.basename += '.min';
        path.extname = '.js';
    }))
    .pipe(gulp.dest('./dist/js'));
};

// tasks
exports.sass = scssToCss;
exports.babel = jsToEs5;
exports.minifyCSS = cssToMincss;
exports.uglify = jsToMinjs;

exports.default = gulp.series(  // 按順序執行
    gulp.parallel(scssToCss, jsToEs5), // 同步編譯 css & js
    gulp.parallel(cssToMincss, jsToMinjs) // 同步壓縮 css & js
);



/* gulp 3 版本寫法 ( gulp 4 也支援 )

// 1. 把 scss 編譯成 css
gulp.task('sass', function(){
    return gulp.src('./src/sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./dist/css'));
});

// 2. 把 js 用 babel 轉成 ES5 語法
gulp.task('babel', function(){
    return gulp.src('./src/js/*.js')
    .pipe(babel())
    .pipe(gulp.dest('./dist/js'));
});

// 3. 把 css 以及 js 壓縮 ( 包含合併與重新命名 )
gulp.task('minifyCSS', function(){
    return gulp.src('./dist/css/*.css')
    .pipe(concat('all.css'))
    .pipe(minifyCSS())
    .pipe(rename(function(path){
        path.basename += '.min';
        path.extname = '.css';
    }))
    .pipe(gulp.dest('./dist/css'));
});

gulp.task('uglify', function(){
    return gulp.src('./dist/js/*.js')
    .pipe(concat('all.js'))
    .pipe(uglify())
    .pipe(rename(function(path){
        path.basename += '.min';
        path.extname = '.js';
    }))
    .pipe(gulp.dest('./dist/js'));
});

gulp.task('default', gulp.series(
    gulp.parallel('sass','babel'),
    gulp.parallel('minifyCSS','uglify')
));

// P.S. gulp 4.0 不支援下面寫法
// gulp.task('default', ['sass', 'babel', 'minifyCSS', 'uglify']);

*/

