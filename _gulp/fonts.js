const gulp = require('gulp');
const config = require('./_config.json');

gulp.task('build:fonts', function () {
    return gulp.src('node_modules/@fortawesome/fontawesome-free/webfonts/**/*.{eot,svg,ttf,woff,woff2}')
        .pipe(gulp.dest(config.paths.build + '/fonts'));
});