var gulp = require("gulp"),
	uglify = require('gulp-uglify'),
	minifyCss = require('gulp-minify-css');


gulp.task('uglify-js', function() {
  return gulp.src( [
        './../script.js',

    ], {'base' : './../' })
    .pipe(uglify())
    .pipe(gulp.dest('./..'));
});



gulp.task('minify-css', function() {
  return gulp.src( [
        './../style.css',

    ], {'base' : './../' })
    .pipe(minifyCss({compatibility: 'ie8'}))
    .pipe(gulp.dest('./..'));
});