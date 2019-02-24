var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var cleanCSS = require('gulp-clean-css');
var autoprefixer = require('gulp-autoprefixer');
var wpPot = require('gulp-wp-pot');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var del = require('del');
var zip = require('gulp-zip');
var uglify = require('gulp-uglify');
var conf = require('./gulp-config.json');
var paths = conf.paths;
var docker = conf.docker;

var exec = require('child_process').exec;


gulp.task('sass', function () {
    var stream = gulp.src(paths.sass + '/*.scss')
        
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(autoprefixer('last 2 versions'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(paths.css))
    return stream;
});



gulp.task('minify-css',gulp.series('sass', function minify_css () {
    var cssFiles = [paths.css + '/theme.css'];

    return gulp.src(cssFiles )
        
        .pipe(concat('theme.css'))
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(cleanCSS())

        .pipe(rename({ extname: '.min.css' }))
        .pipe(sourcemaps.write('./'))
      
        .pipe(gulp.dest(paths.css));
}));

gulp.task('clean-css', function () {
    return del([paths.css + '/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('dist-css', gulp.series('clean-css', 'minify-css'));

gulp.task('concat-js', function () {
    var scriptFiles = [
        'node_modules/popper.js/dist/umd/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
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
        'node_modules/popper.js/dist/umd/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        paths.vendor + '/underscores/js/skip-link-focus-fix.js'
    ];
    return gulp.src(scriptFiles)
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(concat('theme.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.js));
});

gulp.task('javascripts', gulp.series('concat-js', 'uglify-js'));

gulp.task('clean-js', function () {
    return del([paths.js + '/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('dist-js', gulp.series('clean-js', 'javascripts'));


gulp.task('fonts', function () {
    return gulp.src('node_modules/@fortawesome/fontawesome-free/webfonts/**/*.{eot,svg,ttf,woff,woff2}')
        .pipe(gulp.dest(paths.font));
});

gulp.task('clean-fonts', function () {
    return del([paths.font + '/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('dist-fonts',  gulp.series('clean-fonts', 'fonts'));

gulp.task('translate', function () {

    var phpFiles = ['./*.php',
        './inc/**/*.php',
        './template-parts/**/*.php',
        './page-templates/**/*.php'];

    return gulp.src(phpFiles)
        .pipe(wpPot({
            domain: 'andrewasquith',
            package: 'Andrew Asquith'
        }))
        .pipe(gulp.dest(paths.languages + '/andrewasquith.pot'));
});

gulp.task('clean-languages', function() {
    return del([paths.languages + '/**']).then(paths => {
        console.log('Files and folders deleted:\n', paths.join('\n'));
    });
});

gulp.task('dist-languages', gulp.series('clean-languages', 'translate'));

gulp.task('copy-wp', function () {
    var wpFiles = [
        './style.css',
        './LICENSE',
        './screenshot.png',
        './*.php',
        './inc/**/*',
        './template-parts/**/*',
        './page-templates/**/*.php',
        './languages/**/*'
    ];
    
    return gulp.src(wpFiles, { base: './' })
        .pipe(gulp.dest(paths.build));
});

gulp.task('dist-wp', gulp.series('copy-wp'));

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

gulp.task('clean', gulp.series('clean-css', 'clean-js', 'clean-fonts', 'clean-languages', 'clean-build', 'clean-dist'));

gulp.task('dist-prod', gulp.series('clean-dist', 'dist-css', 'dist-js', 'dist-fonts', 'dist-languages', 'dist-wp', function dist_prod () {
    var distFiles = [
        paths.build + '/**/*',
        '!' + paths.js + '/theme.js',
        '!' + paths.js + '/theme.min.js.map',
        '!' + paths.css + '/theme.css',
        '!' + paths.css + '/theme.min.css.map'
    ];

    return gulp.src(distFiles, { base: './build/' })
        .pipe(zip(conf.themeZipName))
        .pipe(gulp.dest(paths.dist));

}));

gulp.task('dist-dev', gulp.series('clean-dist', 'dist-css', 'dist-js', 'dist-fonts', 'dist-languages', 'dist-wp', function dist_dev () {
    var distFiles = [
        paths.build + '/**/*',
        '!' + paths.js + '/theme.js',
        '!' + paths.css + '/theme.css'
    ];

    return gulp.src(distFiles, { base: './build/' })
        .pipe(zip(conf.themeZipName))
        .pipe(gulp.dest(paths.dist));
}));

gulp.task('copy-docker', gulp.series('dist-dev', function copy_docker (callback) {
    exec('docker cp ' + paths.dist + '/' + conf.themeZipName + ' '
        + docker.wpContainerName + ':' + docker.themeFile, function (err, stdout, stderr) {
            console.log(stdout);
            console.log(stderr);
            callback(err);
        });
}));

gulp.task('dist-docker', gulp.series('copy-docker', function dist_docker (callback) {
    exec('docker run --volumes-from ' + docker.wpContainerName + ' --network container:' + docker.wpContainerName
        + ' ' + docker.wpcli_image + ' theme install ' + docker.themeFile + ' --force --activate', function (err, stdout, stderr) {
            console.log(stdout);
            console.log(stderr);
            callback(err);
        });
}));