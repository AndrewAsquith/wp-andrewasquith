const gulp = require('gulp');
const config = require('./_config.json');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const cleanCSS = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');

var env = process.env.NODE_ENV || 'development';

gulp.task('build:styles', function build_styles() {
    if (env == "production") {
        return prodstyles();
    } else {
        return devstyles();
    }
});

function devstyles() {

    return gulp.src(config.paths.sass + '/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.paths.build + '/css'));
}

function prodstyles() {

    return gulp.src(config.paths.sass + '/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(cleanCSS())
        .pipe(gulp.dest(config.paths.build + '/css'));
}
