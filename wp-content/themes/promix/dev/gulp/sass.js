var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer');


gulp.task('sass', function () {
    return gulp.src(['./css/**/*.scss'])
    .pipe(sass({
        outputStyle: 'compressed',
        errLogToConsole: true,
        onError: function(err) {
        }
    }))
    .pipe(autoprefixer('last 2 version'))
    .pipe(gulp.dest('./../'));
});