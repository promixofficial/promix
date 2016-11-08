var gulp = require('gulp'),
    gls = require('gulp-live-server');


gulp.task('server', function() {
    var sources = [
        './../**/*.php',
        './../**/*.css',
        './../**/*.js',
        '!.*/dev/**/*.*'
    ];

    var server = gls.static('./',process.env.PORT, process.env.IP);
    server.start();

    //use gulp.watch to trigger server actions(notify, start or stop)
    return gulp.watch(sources, function (file) {
        server.notify.apply(server, [file]);
    });
}); 