const gulp = require('gulp');
const config = require('./_config.json');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');

var env = process.env.NODE_ENV || 'development';

var scriptFiles = [
    'node_modules/popper.js/dist/umd/popper.js',
    'node_modules/bootstrap/dist/js/bootstrap.js',
    config.paths.vendor + '/underscores/js/skip-link-focus-fix.js'
];

gulp.task('build:scripts', function styles() {
    if (env == "production") {
        return prodscripts();
    } else {
        return devscripts();
    }
});

function devscripts() {

    return gulp.src(scriptFiles)
        .pipe(sourcemaps.init())
        .pipe(concat('theme.js'))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.paths.build + '/js'));
}

function prodscripts() {

    return gulp.src(scriptFiles)
        .pipe(concat('theme.js'))
        .pipe(uglify())
        .pipe(gulp.dest(config.paths.build+ '/js'));
}