var syntax        = 'sass', // выберете используемый синтаксис sass или scss, и перенастройте нужные пути в файле gulp.js и папки в вашего шаблоне wp
		gulpversion   = '4'; // Выберете обязателньо свою версию Gulp: 3 или 4

var gulp          = require('gulp'),
    autoprefixer  = require('gulp-autoprefixer'),
    browsersync   = require('browser-sync'),
    concat        = require('gulp-concat'),
    cache         = require('gulp-cache'),
    cleancss      = require('gulp-clean-css'),
    ftp           = require('vinyl-ftp'),
		imagemin      = require('gulp-imagemin'),
		notify        = require('gulp-notify'),
		pngquant      = require('imagemin-pngquant'),
		gutil         = require('gulp-util' ),
		rename        = require('gulp-rename'),
		rsync         = require('gulp-rsync'),
		sass          = require('gulp-sass'),
		uglify        = require('gulp-uglify');

	
// Незабываем менять 'wp-gulp.loc' на свой локальный домен
gulp.task('browser-sync', function() {
	browsersync({
		proxy: "kirilovka.apteka.loc",
		notify: false,
		// open: false,
		// tunnel: true,
		// tunnel: "gulp-wp-fast-start", //Demonstration page: http://gulp-wp-fast-start.localtunnel.me
	})
});


// Обьединяем файлы sass, сжимаем и переменовываем
gulp.task('styles', function() {
	return gulp.src('src/sass/main.scss')
	.pipe(sass({ outputStyle: 'expand' }).on("error", notify.onError()))
	//.pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(concat('style.min.css'))
	.pipe(autoprefixer(['last 15 versions']))
	.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
	.pipe(gulp.dest('src/css'))
	.pipe(browsersync.stream())
});


// Обьединяем файлы скриптов, сжимаем и переменовываем
gulp.task('scripts', function() {
	return gulp.src([
		'src/js/script.js',
		])
	.pipe(concat('scripts.min.js'))
	// .pipe(uglify()) // Mifify js (opt.)
	.pipe(gulp.dest('src/js'))
	.pipe(browsersync.reload({ stream: true }))
});


// сжимаем картинки в папке images в шаблоне, и туда же возвращаем в готовом виде
gulp.task('imgmin-theme', function() {
	return gulp.src('src/images/**/*')
	.pipe(cache(imagemin())) // Cache Images
	.pipe(gulp.dest('src/images'));
});



if (gulpversion == 3) {
  gulp.task('watch', ['styles', 'scripts', 'browser-sync'], function() {
	  gulp.watch(['src/sass/**/*.scss','src/css/*.css'], ['styles']); // Наблюдение за sass файлами в папке sass в теме
	  gulp.watch(['src/js/**/*.js'], ['scripts']); // Наблюдение за JS файлами js в теме
    gulp.watch('src/**/*.php', browsersync.reload) // Наблюдение за sass файлами php в теме
  });
  gulp.task('default', ['watch']);
}


if (gulpversion == 4) {
	gulp.task('watch', function() {
		gulp.watch('src/sass/**/*.scss', gulp.parallel('styles')); // Наблюдение за sass файлами в папке sass в теме
		gulp.watch(['src/js/**/*.js'], gulp.parallel('scripts')); // Наблюдение за JS файлами в папке js
    gulp.watch('src/**/*.php', browsersync.reload) // Наблюдение за sass файлами php в теме
	});
	gulp.task('default', gulp.parallel('styles', 'scripts', 'browser-sync', 'watch'));
}
