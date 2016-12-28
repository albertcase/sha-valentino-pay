// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var minify = require('gulp-minify-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename'),
    imagemin = require('gulp-imagemin'),
    sourcemaps = require("gulp-sourcemaps"),
    del = require('del'),
    babel = require("gulp-babel"),
    browserSync = require('browser-sync').create();

//Define the app path
var path = {
    all:['./template/*.html','./src/assets/css/*.css','./src/assets/js/*.js','./src/assets/js/lib/*.js'],
    template:['./src/*.html'],
    css:['./src/assets/css/*.css'],
    js:['./src/assets/js/lib/zepto.min.js','./src/assets/js/lib/pre-loader.js','./src/assets/js/rem.js','./src/assets/js/common.js','./src/assets/js/wxshare.js','./src/assets/js/api.js','./src/assets/js/home.js'],
    homejs:['./src/assets/js/lib/zepto.min.js','./src/assets/js/lib/pre-loader.js','./src/assets/js/rem.js','./src/assets/js/common.js','./src/assets/js/wxshare.js','./src/assets/js/api.js','./src/assets/js/home.js'],
    images:['./src/assets/images/*'],
};
// Browser-sync
gulp.task('browser-sync', function() {
    browserSync.init(path.all,{
        server: {
            baseDir: "./",
            startPath: ''
        }
    });
});

// Not all tasks need to use streams
// A gulpfile is just another node program and you can use any package available on npm
gulp.task('clean', function() {
    // You can use multiple globbing patterns as you would with `gulp.src`
    return del(['build']);
});


//css
gulp.task('css',['clean'],function () {
    // 1. 找到文件
    gulp.src(path.css)
        //.pipe(concat('style.css'))
        // 2. 压缩文件
        .pipe(minify())
        // 3. 另存为压缩文件
        .pipe(gulp.dest('./src/dist/css'));
});

// Concatenate & Minify
gulp.task('scripts_home',['clean'], function() {
    return gulp.src(path.homejs)
        .pipe(concat('home_all.js'))
        .pipe(gulp.dest('./src/dist'))
        .pipe(rename('home_all.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./src/dist/js'));
});

// Watch Files For Changes
gulp.task('watch', ['clean'],function() {
    gulp.watch(path.homejs, ['scripts_home']);
    gulp.watch(path.css,['css']);
});

// Default Task
gulp.task('default', ['watch', 'scripts_home','css','browser-sync']);


