/**
 * First, include gulp and gulp-connect-php
 */

var gulp          = require('gulp');
    connect       = require('gulp-connect-php'),
    browserSync   = require('browser-sync'),
    sass          = require('gulp-sass'),
    autoprefixer  = require('gulp-autoprefixer'),
    uglifycss     = require('gulp-uglifycss');

/**
 * Second, create a task to start a PHP server
 */

gulp.task('serve', function() {
  // Initiate browserSync
  connect.server({}, function (){
    browserSync({
      proxy: '127.0.0.1:8000'
    });
  });
  // Watch for changes in PHP files and reload the browser
  gulp.watch("assets/scss/**/*.scss", ['sass']);
  // Watch for changes in PHP files and reload the browser
  gulp.watch('**/*.twig').on('change', function () {
    browserSync.reload();
  });
});

gulp.task('sass', function() {
  return gulp.src("assets/scss/**/*.scss")
    .pipe(sass())
    // Use autoprefixer
    .pipe(autoprefixer())
    // Use uglifycss
    .pipe(uglifycss())
    // Put compiled files in "assets/css"
    .pipe(gulp.dest("assets/css"))
    // Inject css when changes occur
    .pipe(browserSync.stream());
});

/**
 * Third, set the `serve` task to be the default task
 */

gulp.task('default', ['serve']);