var gulp = require('gulp');


gulp.task('watch', function(){
	gulp.watch([
		'./css/**/*.*'
	], ['sass']);

	gulp.watch([
		'./js/**/*.*'
	], ['webpack']);
});