const gulp = require('gulp');
const config = require('./_config.json');
var del = require('del');

gulp.task('clean:styles', function () {
    return del([config.paths.build+ '/css/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('clean:fonts', function () {
    return del([config.paths.build + '/fonts/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('clean:scripts', function () {
    return del([config.paths.build + '/js/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('clean:languages', function() {
    return del([config.paths.build + '/languages/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('clean:build', function () {
    return del([config.paths.build + '/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('clean:dist', function () {
    return del([config.paths.dist + '/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('clean', gulp.series('clean:styles', 'clean:scripts', 'clean:fonts', 'clean:languages', 'clean:build', 'clean:dist'));
