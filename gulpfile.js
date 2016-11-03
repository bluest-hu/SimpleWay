/**
 * Created by hubery on 2016/10/23.
 */

// import gulp
var gulp = require('gulp');
// gulp-sass
var sass = require('gulp-sass');
// css minify
var cssMinify = require('gulp-minify-css');
// sourcemaps
var sourcemaps = require('gulp-sourcemaps');
// gulp-uglify

//var uglify = require('gulp-uglify');
var concat = require('gulp-concat');

// scss
gulp.task('scss', function () {
    gulp.src(['scss/**/*.scss', 'scss/**/*.css'])
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./style/'));
});

gulp.task('css-min', function () {
    gulp.src('style/**/*.css')
        .pipe(cssMinify())
        .pipe(gulp.dest('./style/'));

});

gulp.task('concat', function () {
    gulp.src("style/**/*.css")
        .pipe(concat('main.min.css'))
        .pipe(gulp.dest('./style/'));


});

// default
gulp.task('default', ['scss', 'css-min', 'concat']);

var scssWtcher = gulp.watch('scss/**/*.scss', ['default']);

scssWtcher.on("change", function () {
    console.log("scss changeed");
});




