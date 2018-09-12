var gulp = require('gulp'),
	sass = require('gulp-sass');
	
gulp.task('css', function() {
	gulp.src('./scss/*.scss')
		.pipe(sass())
		.pipe(gulp.dest('./css'));
});
	
