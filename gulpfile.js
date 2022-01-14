'use strict';

const { src, dest, watch, series, parallel } = require('gulp');
const sourcemaps = require('gulp-sourcemaps');

const sass = require('gulp-sass');
const cssnano = require('cssnano');
var rename = require('gulp-rename');
const postcss = require('gulp-postcss');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const babel = require('gulp-babel');
const autoprefixer = require('autoprefixer');

// File paths
const files = {
	sassPath: 'scss/**/*.scss',
	jsPath: 'js/*.js'
}

function sassTask() {
	return src(files.sassPath)
		.pipe(sourcemaps.init())
		.pipe(sass.sync({outputStyle: 'compressed'}).on('error', sass.logError))
		.pipe(postcss([autoprefixer(), cssnano() ]))
		.pipe(rename("main.min.css"))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('css'))
}
function jsTask(){
	return src([files.jsPath])
		.pipe(sourcemaps.init())
		.pipe(babel({
			presets: ['@babel/preset-env']
		}))
		.pipe(concat('built.min.js'))
		.pipe(uglify())
		.pipe(sourcemaps.write('.'))
		.pipe(dest('js')
	);
}

function watchTask(){
	watch(files.sassPath, sassTask);
	watch(files.jsPath, jsTask);
}

// run sass or js task independently
exports.sass = sassTask;
exports.js = jsTask;

// run sass and js tasks together
exports.all = series( parallel(sassTask, jsTask));

// watch sass and js files and compile automatically when a changed is made
exports.watch = watchTask;


