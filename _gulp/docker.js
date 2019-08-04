const gulp = require('gulp');
const config = require('./_config.json');
const exec = require('child_process').exec;


gulp.task('docker:copy', function copy_docker (callback) {
    return exec('docker cp ' + config.paths.dist + '/' + config.themeZipName + ' '
        + config.docker.wpContainerName + ':' + config.docker.themeFile, function (err, stdout, stderr) {
            console.log(stdout);
            console.log(stderr);
            callback(err);
        });
});

gulp.task('docker:deploy-theme', gulp.series('docker:copy', function docker_deploy (callback) {
    return exec('docker run --volumes-from ' + config.docker.wpContainerName + ' --network container:' 
                    + config.docker.wpContainerName + ' ' + config.docker.wpcli_image + ' theme install ' 
                    + config.docker.themeFile + ' --force --activate', function (err, stdout, stderr) {
            console.log(stdout);
            console.log(stderr);
            callback(err);
        });
}));

gulp.task('docker', gulp.series('docker:copy','docker:deploy-theme'));