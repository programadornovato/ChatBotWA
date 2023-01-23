var gulp = require('gulp');
var phpunit = require('gulp-phpunit');
var notify = require('gulp-notify');

gulp.task('test', function() {
    gulp.src('')
        .pipe(phpunit('', {notify: false}))
        .on('error', notify.onError({
            title: "RiveScript PHP",
            message: "Tests failed.",
            icon: __dirname + '/tests/resources/failed.png'
        }))
        .pipe(notify({
            title: "RiveScript PHP",
            message: "Tests passed!",
            icon: __dirname + '/tests/resources/success.png'
        }));
});

gulp.task('watch', function() {
    gulp.watch('**/*.php', ['test']);
    gulp.watch('**/*.rive', ['test']);
});

gulp.task('default', ['test', 'watch']);
