const gulp = require('gulp');
const config = require('./_config.json');
var wpPot = require('gulp-wp-pot');

gulp.task('wp:languages', function wp_languages () {

    var phpFiles = ['./*.php',
        './inc/**/*.php',
        './template-parts/**/*.php',
        './page-templates/**/*.php'];

    return gulp.src(phpFiles)
        .pipe(wpPot({
            domain: 'andrewasquith',
            package: 'Andrew Asquith'
        }))
        .pipe(gulp.dest(config.paths.build + '/languages/andrewasquith.pot'));
});

gulp.task('build:wp', gulp.series('wp:languages', function build_wp () {
    var wpFiles = [
        './style.css',
        './LICENSE',
        './screenshot.png',
        './*.php',
        './inc/**/*',
        './blocks/**/*',
        './template-parts/**/*',
        './page-templates/**/*.php',
        './languages/**/*'
    ];
    
    return gulp.src(wpFiles, { base: './' })
        .pipe(gulp.dest(config.paths.build));
}));


