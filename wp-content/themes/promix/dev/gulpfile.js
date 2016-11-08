var gulp = require('gulp');
require('require-dir')('./gulp');


gulp.task('default',['serve']);


gulp.task('compile', ['sass']);

gulp.task('minify-all', ['uglify-js','minify-css']);

gulp.task('build', ['compile'], function(){
	gulp.start('minify-all');
});

gulp.task('serve', ['watch','server']);