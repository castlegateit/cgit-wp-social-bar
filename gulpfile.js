var gulp = require('gulp');
var concat = require('gulp-concat');
var maps = require('gulp-sourcemaps');
var plumber = require('gulp-plumber');
var prefix = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');


var del = require('del');

var src = 'resources/scss/';
var dst = 'resources/';

gulp.task('clean:css', gulp.series(function () {
    return del(dst + '/*.css');
}));

gulp.task('compile:css', gulp.series(['clean:css'], function () {
    return gulp.src(src + '/**/*.scss')
        .pipe(maps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(prefix({remove: false}))
        .pipe(rename({extname: '.css'}))
        .pipe(maps.write('.'))
        .pipe(gulp.dest(dst));
}));

gulp.task('default', gulp.series(['compile:css']));

gulp.task('watch', gulp.series(['default'], function () {
    gulp.watch(src + '/scss/**/*.scss', gulp.series(['compile:css']));
}));
