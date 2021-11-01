// jshint node: true, esversion: 6

// Strict mode
'use strict';

// Core
const fs = require('fs');

// Modules
const contrast = require('contrast-color');
const del = require('del');
const gulp = require('gulp');

// Plugins
const autoprefixer = require('gulp-autoprefixer');
const concat = require('gulp-concat');
const csso = require('gulp-csso');
const filter = require('gulp-filter');
const plumber = require('gulp-plumber');
const rename = require('gulp-rename');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const touch = require('gulp-touch-fd');
const uglify = require('gulp-uglify');

// Data
const sites = require('./data/sites.json');

// Configuration
const cssSrc = [
    './src/scss/**/*.scss'
];

const jsSrc = './src/js/**/*.js';
const jsAdminSrc = './src/admin-js/**/*.js';

const cssDest = './dist/css';
const jsDest = './dist/js';
const jsAdminDest = './dist/admin-js';

const cssCacheDir = './cache/scss';

// Tasks
function cssClean() {
    return del(cssDest);
}

function jsClean() {
    return del(jsDest);
}

function jsAdminClean() {
    return del(jsAdminDest);
}

function cssBuild() {
    // Assemble Sass variables from JSON site data.
    let bgColors = [];
    let fgColors = [];

    let bgList = '';
    let fgList = '';

    let bgItems = [];
    let fgItems = [];

    let output = '';

    for (let site in sites) {
        let bgName = `${site}-color`;
        let fgName = `${site}-contrast-color`;

        let bgColor = sites[site].color;
        let fgColor = contrast.contrastColor({bgColor: bgColor});

        bgColors.push(`$${bgName}: ${bgColor};`);
        fgColors.push(`$${fgName}: ${fgColor};`);

        bgItems.push(`${site}: $${bgName}`);
        fgItems.push(`${site}: $${fgName}`);
    }

    bgList = '$site-colors: (' + bgItems.join(', ') + ');';
    fgList = '$site-contrast-colors: (' + fgItems.join(', ') + ');';

    output = bgColors.join(' ') + fgColors.join(' ') + bgList + fgList;

    // Create cache directory if it does not already exist.
    if (!fs.existsSync(cssCacheDir)) {
        fs.mkdirSync(cssCacheDir, {
            recursive: true
        });
    }

    // Write Sass variables.
    fs.writeFileSync(cssCacheDir + '/_colors.scss', output);

    // Compile CSS.
    return gulp.src(cssSrc)
        .pipe(plumber())

        // Create map(s) and write uncompressed development version
        .pipe(sourcemaps.init())
        .pipe(sass.sync({
            includePaths: ['.'],
            quietDeps: true
        }).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(cssDest))
        .pipe(touch())

        // Remove map(s) and write compressed production version
        .pipe(filter('**/*.css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(csso())
        .pipe(gulp.dest(cssDest))
        .pipe(touch());
}

function jsBuild() {
    return gulp.src(jsSrc)
        .pipe(plumber())

        // Create map(s) and write uncompressed development version
        .pipe(sourcemaps.init())
        .pipe(concat('script.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(jsDest))
        .pipe(touch())

        // Remove map(s) and write compressed production version
        .pipe(filter('**/*.js'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest(jsDest))
        .pipe(touch());
}

function jsAdminBuild() {
    return gulp.src(jsAdminSrc)
        .pipe(plumber())

        // Create map(s) and write uncompressed development version
        .pipe(sourcemaps.init())
        .pipe(concat('script.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(jsDest))
        .pipe(touch())

        // Remove map(s) and write compressed production version
        .pipe(filter('**/*.js'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest(jsAdminDest))
        .pipe(touch());
}

const cssTask = gulp.series(cssClean, cssBuild);
const jsTask = gulp.series(jsClean, jsBuild);
const jsAdminTask = gulp.series(jsAdminClean, jsAdminBuild);

// Combined
function watch() {
    gulp.watch(cssSrc, cssTask);
    gulp.watch(jsSrc, jsTask);
    gulp.watch(jsAdminSrc, jsAdminTask);
}

const build = gulp.parallel(cssTask, jsTask, jsAdminTask);

// Public
exports.default = build;
exports.watch = watch;
