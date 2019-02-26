const gulp = require('gulp');
const config = require('./_gulp/_config.json');

require('require-dir')('./_gulp');

const zip = require('gulp-zip');

gulp.task('build', gulp.series('clean', 'build:styles', 'build:scripts', 'build:fonts', 'build:wp'));


gulp.task('dist', gulp.series('clean', 'build', function dist () {
    
    return gulp.src(config.paths.build + '/**/*', { base: config.paths.build })
        .pipe(zip(config.themeZipName))
        .pipe(gulp.dest(config.paths.dist));

}));


gulp.task('docker:dev', gulp.series('dist','docker'));

