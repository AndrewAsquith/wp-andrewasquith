var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var cleanCSS = require('gulp-clean-css');
var autoprefixer = require('gulp-autoprefixer');

var plumber = require('gulp-plumber');
var sequence = require('gulp-sequence');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var del = require('del');
const zip = require('gulp-zip');

var uglify = require('gulp-uglify');

var conf = require('./gulp-config.json');
var paths = conf.paths;

gulp.task('sass', function () {
    var stream = gulp.src(paths.sass + '/*.scss')
        .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(sass({ errLogToConsole: true }))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(sourcemaps.write(undefined, { sourceRoot: null }))
        .pipe(gulp.dest(paths.css))
    return stream;
});

gulp.task('minify-css', function () {
    return gulp.src(paths.css + '/theme.css')
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(cleanCSS({ compatibility: '*' }))
        .pipe(plumber({
            errorHandler: function (err) {
                console.log('Error: ' + err);
                this.emit('end');
            }
        }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.css));
});

gulp.task('clean-css', function () {
    return del([paths.css + '/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('dist-css', function (callback) {
    return sequence('clean-css', 'sass', 'minify-css')(callback);
});

gulp.task('concat-js', function () {
    var scriptFiles = [
        paths.vendor + '/popper/popper.js',
        paths.vendor + '/bootstrap4/js/bootstrap.js',
        paths.vendor + '/underscores/js/skip-link-focus-fix.js'
    ];
    return gulp.src(scriptFiles)
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(concat('theme.js'))
        .pipe(sourcemaps.write(undefined, { sourceRoot: null }))
        .pipe(gulp.dest(paths.js));
});

gulp.task('uglify-js', function () {
    var scriptFiles = [
        paths.vendor + '/popper/popper.js',
        paths.vendor + '/bootstrap4/js/bootstrap.js',
        paths.vendor + '/underscores/js/skip-link-focus-fix.js'
    ];
    return gulp.src(scriptFiles)
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(concat('theme.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.js));
});

gulp.task('javascripts', ['concat-js', 'uglify-js']);

gulp.task('clean-js', function () {
    return del([paths.js + '/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('dist-js', function (callback) {
    return sequence('clean-js', 'javascripts')(callback);
});


gulp.task('fonts', function () {
    return gulp.src(paths.vendor + '/fontawesome5/webfonts/**/*.{eot,svg,ttf,woff,woff2}')
        .pipe(gulp.dest(paths.font));
});

gulp.task('clean-fonts', function () {
    return del([paths.font + '/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('dist-fonts', function (callback) {
    return sequence('clean-fonts', 'fonts')(callback);
});

gulp.task('copy-wp', function () {
    var wpFiles = [
        './style.css',
        './LICENSE',
        './screenshot.png',
        './*.php',
        './inc/**/*',
        './template-parts/**/*',
        './languages/**/*'
    ]
    return gulp.src(wpFiles, { base: './' })
        .pipe(gulp.dest(paths.build));
});

gulp.task('dist-wp', function (callback) {
    return sequence('clean-build', 'copy-wp')(callback);
});

gulp.task('clean-build', function () {
    return del([paths.build + '/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('clean-dist', function () {
    return del(['./dist/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('clean', ['clean-css', 'clean-js', 'clean-fonts', 'clean-build', 'clean-dist']);

gulp.task('dist-prod', ['clean-dist', 'dist-css', 'dist-js', 'dist-fonts', 'dist-wp'], function () {
    var distFiles = [
        paths.build + '/**/*',
        '!' + paths.js + '/theme.js',
        '!' + paths.js + '/theme.min.js.map',
        '!' + paths.css + '/theme.css',
        '!' + paths.css + '/theme.min.css.map'
    ];

    return gulp.src(distFiles, { base: './' })
        .pipe(zip('andrewasquith.zip'))
        .pipe(gulp.dest(paths.dist));

});

gulp.task('dist-dev', ['clean-dist', 'dist-css', 'dist-js', 'dist-fonts', 'dist-wp'], function () {
    var distFiles = [
        paths.build + '/**/*',
        '!' + paths.js + '/theme.js',
        '!' + paths.css + '/theme.css'
    ];

    return gulp.src(distFiles, { base: './' })
        .pipe(zip('andrewasquith.zip'))
        .pipe(gulp.dest(paths.dist));
});