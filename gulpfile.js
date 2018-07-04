var gulp = require('gulp');
var uglify = require('gulp-uglify');
var rename = require("gulp-rename");
var pump = require('pump');


gulp.task('default', function (cb) {
    pump([
          gulp.src('js/*.js'),
          uglify(),
          rename({ suffix: '.min' }),
          gulp.dest('js')
      ],
      cb
    );
});